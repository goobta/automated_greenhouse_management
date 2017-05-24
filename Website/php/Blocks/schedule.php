<?php
/**
 * www.github.com/agupta231
 * Date: 5/22/17
 */

include "php/Utility/config.php";

class Schedule {
    public function generateSchedule() {
        $connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        echo "<table>";

        for($i = 1; $i <= Config::$bedCount; $i++) {
            echo '<tr class="header"><th>Bed ' . $i . ' <span>Show</span></th></tr>';

            $query = "SELECT Id, Weekday, StartTime, Duration, Pressure FROM " . Config::$dbName . "." . Config::$dbTableName . " WHERE Bed LIKE " . $i;
            $result = $connection->query($query);

            if($result->num_rows > 0) {

                $dayData = [];

                while ($row = $result->fetch_assoc()) {
                    $dayData[] = $row;
                }

                

            }
            else {
                echo "<tr><td>No Watering Schedule Set</td></tr>";
            }
        }

        echo "</table>";

    }
    public static function addEvent() {

    }
    public static function number_to_day($day_number) {
        switch ($day_number) {
            case 0:
                return "Sunday";

            case 1:
                return "Monday";

            case 2:
                return "Tuesday";

            case 3:
                return "Wednesday";

            case 4:
                return "Thursday";

            case 5:
                return "Friday";

            case 6:
                return "Saturday";
        }
    }
}