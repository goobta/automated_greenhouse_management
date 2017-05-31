<?php
/**
 * www.github.com/agupta231
 * Date: 5/30/17
 */

include "../../Utility/config.php";
include "../Schedule/schedule.php";

$connection = Config::createConnection();

$currentDay = Schedule::dayToNumber(date("l"));
$currentTime = date("H:i") . ":00";

$query = "SELECT Bed, Duration FROM " . Config::$dbName . "." . Config::$dbTableName . "WHERE WeekDay LIKE " . $currentDay . " AND StartTime LIKE " . $currentTime;
$result = $connection->query($query);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        exec("python " . getcwd() . "/../../../../Python/sendWateringEvent.py " . $row["Bed"] . " " . $row["Duration"]);
    }
}