<?php

App::import('Vendor', 'redis/RedisForAbs');
App::import('Vendor', 'redis');

class RedisTest extends RedisForAbs {
    private $redisDatabase = null;
    private static $instance = null;

    public static function Instance() {
        if(self::$instance === null) {
            self::$instance = new RedisTest();
        }

        return self::$instance;
    }

    protected function __construct() {
        parent::__construct();
        
        // $this->hostname = Configure::read('RedisForNotificationMailing.host');
        // $this->port     = Configure::read('RedisForNotificationMailing.port');

        // $this->hostname = 
        // $this->port     = Configure::read('RedisForNotificationMailing.port');
    }

    protected function getTest() {
        try {
    	   return $this->store->smembers(30);
        } catch(Exception $e) {
            debug($e->getMessage());
        }
    }

}