<?php 

App::import('Vendor', 'redis/RedisBaseAbs');

class RedisBase extends RedisBaseAbs {
	
	function __destruct() {}
	
	function disconnect() {
		parent::__destruct();
	}
	
	public function __call($name, $args) {
        $result = parent::__call($name,$args);
        debug($result);
		return $result;
	}

}