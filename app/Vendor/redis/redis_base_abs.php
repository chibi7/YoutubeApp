<?php

abstract class RedisBaseAbs {

	const ERROR = '-';
	const INLINE = '+';
	const BULK = '$';
	const MULTIBULK = '*';
	const INTEGER = ':';

	protected $connection = false;
	protected $config = null;

	/**
	 * Open the connection to the Redis server.
	 * 
	 * @param   array $config the config array
	 * @throws  RedisException
	 */
	public function __construct(array $config = array ()) {
		
		$redisConnTimeout = 10;
		if(!is_null(Configure::read('Redis.conn_timeout')) && is_numeric(Configure::read('Redis.conn_timeout'))){
			$redisConnTimeout = Configure::read('Redis.conn_timeout');
		}
		
		$connStart = microtime(true);
		$this->connection = @ fsockopen($config['hostname'], $config['port'], $errno, $errstr, $redisConnTimeout);
		
		$this->config = $config;
				
		if (!$this->connection) {
			throw new RedisBaseException($errstr, $errno);
		}

		// if(Configure::read('InternalServices.enableLog')) {
		// 	$connEnd = microtime(true);
		// 	ZLog::raw('timeouts_all', sprintf(
		// 		// ip | Date | service name | url, hostname etc | timeout
		// 		'%s|%s|%s|%s|%s',
		// 		$_SERVER['REMOTE_ADDR'],
		// 		date('Y-m-d H:i:s', time()),
		// 		'redis',
		// 		$config['hostname'],
		// 		round(($connEnd - $connStart) * 1000, 4)
		// 	));
		// }
		
		// Jednostka timeout to _MIKRO_sekundy
		stream_set_timeout ( $this->connection, 0, Configure::read('Redis.timeout') * 1000000 );
	}

	/**
	 * Closes the connection to the Redis server.
	 */
	public function __destruct() {
		fclose($this->connection);
	}

	/**
	 * Runs the given command ($name) with any number of arguments.
	 * 
	 * @param   string   $name  the method (command)
	 * @param   array    $args  the method (command) arguments
	 * @return  string   the response
	 * @throws  RedisException
	 */
	public function __call($name, $args) {
				
		$result = null;
		$cmd = $this->buildCommand($name, $args);
		$this->sendCommand($cmd);
		$result = $this->readReply();
		return $result;
	}

	/**
	 * Builds the given command with any number of arguments.
	 * 
	 * @param   string   $cmd   the command
	 * @param   array    $args  the arguments
	 * @return  string   the full command
	 */
	public function buildCommand($cmd, $args) {
		$crlf = sprintf('%s%s', chr(13), chr(10));
		// Start building the command
		$command = '*' . (count($args) + 1) . $crlf;
		$command .= '$' . strlen($cmd) . $crlf;
		$command .= strtoupper($cmd) . $crlf;

		// Add all the arguments to the command
		foreach ($args as $arg) {
			$command .= '$' . strlen($arg) . $crlf;
			$command .= $arg . $crlf;
		}

		return $command;
	}

	/**
	 * Sends the given command to the Redis server.
	 * 
	 * @param   string   $command   the command to send
	 * @throws  RedisException
	 */
	public function sendCommand($command) {
		if (!$this->connection) {
			throw new RedisBaseException('You must be connected to a Redis server to send a command.', $this->config);
		}

		fwrite($this->connection, $command);
	}

	/**
	 * Reads in a reply from the Redis server.
	 * 
	 * @return  string  the reply
	 * @throws  RedisException
	 */
	public function readReply() {
		if (!$this->connection) {
			throw new RedisBaseException('You must be connected to a Redis server to send a command.', $this->config);
		}

		$reply = trim(fgets($this->connection));

		switch (substr($reply, 0, 1)) {
			case RedisBaseAbs :: ERROR :
				throw new RedisBaseException(substr(trim($reply), 4),$this->config);
				break;

			case RedisBaseAbs :: INLINE :
				$response = substr(trim($reply), 1);
				break;

			case RedisBaseAbs :: BULK :
				if ($reply == '$-1') {
					return null;
				}
				$response = $this->readBulkReply($reply);
				break;

			case RedisBaseAbs :: MULTIBULK :
				$count = substr($reply, 1);
				if ($count == '-1') {
					return null;
				}

				$response = array ();
				for ($i = 0; $i < $count; $i++) {
					$bulk_head = trim(fgets($this->connection));
					$response[] = $this->readBulkReply($bulk_head);
				}
				break;

			case RedisBaseAbs :: INTEGER :
				$response = substr(trim($reply), 1);
				break;
				
			case false :
				throw new RedisBaseException("server timeout", $this->config);
				break;
			
			default :
				throw new RedisBaseException("invalid server response: {$reply}", $this->config);
				break;
		}

		return $response;
	}

	/**
	 * Reads in a bulk reply from the Redis server.
	 * 
	 * @param   string   $reply     the reply
	 * @return  string   the bulk reply
	 * @throws  RedisException
	 */
	protected function readBulkReply($reply) {
		if (!$this->connection) {
			throw new RedisBaseException('You must be connected to a Redis server to send a command.', $this->config);
		}

		$response = null;
		$size = (int)substr($reply, 1);

		if($size >= 0) {
			if($size > 0) {
				$response = stream_get_contents($this->connection);
			}

			// Get rid of the CRLF at the end
			$crlf = fread($this->connection, 2);
			if($crlf != "\r\n") {
				// Coś tu jest nie tak..
				$data = array(
					'redis_size' => $size,
					'response'   => $response,
					'crlf'       => var_export($crlf, true),
				);

				// ZLog::info('redis_broken_reply', print_r($data, true));
			}
		}

		return $response;
	}

}

class RedisBaseException extends Exception {
	
	protected $redisConfig = null;
	
	public function __construct($message,$redisConfig){
		
		$this->redisConfig = $redisConfig;
		parent::__construct($message);
		
	}
	
	public function getRedisConfig(){
		return $this->redisConfig;
	}
	
	public function getDevelopersLogs(){
		
		$log = array();
		$log['msg'] = $this->getMessage();
		$log['config'] = $this->getRedisConfig();
		$log['stack'] = $this->getTraceAsString();
		return $log;
	}	
}