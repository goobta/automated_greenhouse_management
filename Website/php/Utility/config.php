<?php
/**
 * www.github.com/agupta231
 * Date: 5/22/17
 */

class Config {
    public static $dbHost = 'localhost';
//    public static $dbUsername = 'PingServer';
//    public static $dbPass = 'PingreenHouse2017';

    public static $dbUsername = 'root';
    public static $dbPass = 'root';

    public static $dbName = 'pingreenhouse';
    public static $dbTableName = "events";

    public static $bedCount = 4;

    public static function createConnection() {
        $connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        return $connection;
    }
}

