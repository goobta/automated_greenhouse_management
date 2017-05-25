<?php
/**
 * www.github.com/agupta231
 * Date: 5/22/17
 */

class Schedule {
    public function generateSchedule() {
        $connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        echo "<table>";

        for($i = 1; $i <= Config::$bedCount; $i++) {
            echo '<tr class="header"><th>Bed ' . $i . ' [<span>Show</span>]</th></tr>';

            $query = "SELECT Id, Weekday, StartTime, Duration FROM " . Config::$dbName . "." . Config::$dbTableName . " WHERE Bed LIKE " . $i;
            $result = $connection->query($query);

            if($result->num_rows > 0) {

                $dayData = [];

                while ($row = $result->fetch_assoc()) {
                    $dayData[] = $row;
                }

                foreach($dayData as $key => $row) {
                    $day[$key] = $row["Weekday"];
                    $time[$key] = $row["StartTime"];
                }

                array_multisort($day, SORT_ASC, $time, SORT_ASC, $dayData);

                foreach($dayData as $row) {
                    echo "<tr>";
                    echo "<td>" . Schedule::numberToDay($row["Weekday"]) . "</td>";
                    echo "<td>" . $row["StartTime"] . "</td>";
                    echo "<td>" . $row["Duration"] . "</td>";
                    echo "<td><a href='php/Blocks/Schedule/editEventForm.php?id=" . $row['Id'] . "&wd=" . $row['Weekday'] . "&st=" . $row['StartTime'] . "&dur=" . $row['Duration'] . "&bn=" . $i . "'>Edit</a></td>";
                    echo "</tr>";
                }

            }
            else {
                echo "<tr><td>No Watering Schedule Set</td></tr>";
            }
        }

        echo "</table>";

        $connection->close();

    }
    public static function addEvent() {
        
    }
    public static function editEvent($id, $bed, $weekDay, $startTime, $duration) {
        $connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        $query = "UPDATE " . Config::$dbName . "." . Config::$dbTableName . " SET Weekday='" . $weekDay . "', Bed='" . $bed . "', StartTime='" . $startTime . "', Duration='" . $duration . "' WHERE Id='" . $id . "'";

        if($connection->query($query) == TRUE) {
            echo "Event updated successfully";
        }
        else {
            echo "Event updating failed";
        }
    }
    public static function deleteEvent($id) {
        $connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        $query = "DELETE FROM " . Config::$dbName . "." . Config::$dbTableName . " WHERE Id LIKE " . $id;

        if($connection->query($query) == TRUE) {
            echo "Event deleted sucessfully";
        }
        else {
            echo "Event deletion failed";
        }

        $connection->close();
    }
    public static function numberToDay($day_number) {
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
    public static function minutesToSeconds($minutes, $seconds) {
        return $minutes * 60 + $seconds;
    }
    public static function secondsToMinutes($rawSeconds) {
        $minutes = floor($rawSeconds / 60);
        $seconds = $rawSeconds - $minutes * 60;

        return [$minutes, $seconds];
    }
}