<?php

App::import('Vendor', 'redis/RedisForAbs');
App::import('Vendor', 'redis');

class RedisForVideo extends RedisForAbs {
    private $redisDatabase = null;
    private static $instance = null;

    public static function Instance() {
        if(self::$instance === null) {
            self::$instance = new RedisForVideo();
        }

        return self::$instance;
    }

    protected function __construct() {
        parent::__construct();
    }

    protected function getVideo($key) {
        $this->store->select(2);
        return $this->store->get($key);
    }

}