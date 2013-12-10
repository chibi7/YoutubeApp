<?php 

App::import('Vendor', 'redis/RedisBase');

abstract class RedisForAbs {
	
	var $store = null;     
    private $timeout = 500;
	
	/* define in non abstract class */
	var $hostname = "127.0.0.1";
    var $port = "6379";    

    protected function __construct() {}
    		
    /**
     * OPEN
     * - Connect to Redis
     * - Calculate and set timeout for SETEX
     */
    private function _open() {
    	 
    	$hostname 	= $this->hostname;
    	$port 		= $this->port;
    	$timeout 	= $this->timeout;    		
    	
		if ($hostname !== null && $port !== null) {
			try {
				$redis = new RedisBase(compact('hostname', 'port', 'timeout'));
				$this->store = $redis;
			} 
			catch (RedisBaseException $e){
						
				// $this->store = false;						
				// ZLog::info('redis_error',array(
				// 	'message' => $e->getMessage(),
				// 	'host' 	  => $hostname,
				// 	'port'	  => $port,
				// 	'timeout' => $timeout
				// ));
								
			}
		}  		
		    	    	    
    }
    
    /** 
     * CLOSE
     * - Disconnect from Redis
     */
    private function _close() {
    	if(!$this->store) return false;
    	$this->store->disconnect();
    	return true;
    }
	
	public function __call($name, $args) {		
		if(is_null($this->store)){					
    		$this->_open();
    	}
    	
    	if($this->store !== false){      	    	
    		return call_user_func_array(array($this,$name),$args);
    	}
    	return;    	    
	}
	 	
	function __destruct() {
		$this->_close();
	}		
}