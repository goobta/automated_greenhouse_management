<?php
/**
 * www.github.com/agupta231
 * Date: 5/24/17
 */

include "config.php";

$connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
else {
    print "We all good fam";
}
