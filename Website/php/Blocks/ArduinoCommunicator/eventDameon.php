<?php
/**
 * www.github.com/agupta231
 * Date: 5/30/17
 */

print getcwd();

include (dirname(__FILE__) . "/../../Utility/config.php");
include (dirname(__FILE__) . "/../Schedule/schedule.php");

$connection = Config::createConnection();

$currentDay = Schedule::dayToNumber(date("l"));
$currentTime = date("H:i") . ":00";

$query = "SELECT Bed, Duration FROM " . Config::$dbName . "." . Config::$dbTableName . "WHERE WeekDay LIKE " . $currentDay . " AND StartTime LIKE " . $currentTime;
$result = $connection->query($query);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        exec("python " . dirname(__FILE__) . "/../../../../Python/Water.py " . $row["Bed"] . " " . $row["Duration"] . " > /dev/null 2>/dev/null &");

        sleep(3);
    }
}