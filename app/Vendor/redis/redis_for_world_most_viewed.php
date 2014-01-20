<?php

App::import('Vendor', 'redis/RedisForAbs');
App::import('Vendor', 'redis');

class RedisForWorldMostViewed extends RedisForAbs {
    private $redisDatabase = null;
    private static $instance = null;

    public static function Instance() {
        if(self::$instance === null) {
            self::$instance = new RedisForWorldMostViewed();
        }

        return self::$instance;
    }

    protected function __construct() {
        parent::__construct();
    }

    protected function getMovieList($code, $type, $timeshift) {
        $this->store->select(1);
        $key = sprintf("%s_%s_%s", $code, $type, $timeshift);
        return $this->store->get($key);
    }

}