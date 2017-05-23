<?php
/**
 * www.github.com/agupta231
 * Date: 5/22/17
 */

include "php/Utility/config.php";

class Schedule {
    public function generateSchedule() {
        echo "<table id='schedule' width=100%>";

        echo "
            <tr>
                <td></td>
                <td>Sun</td>
                <td>Mon</td>
                <td>Tue</td>
                <td>Wed</td>
                <td>Thu</td>
                <td>Fri</td>
                <td>Sat</td>
            </tr>
        ";

        for ($i = 0; $i < 24; $i++) {
            echo "
                <tr>
                    <td>" . $i . ":00</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>";
        }
        echo "</table>";

        $connection = new mysqli(Config::$dbHost, Config::$dbUsername, Config::$dbPass, Config::$dbName);

        if($connection->connect_error) {
            die("Connection Failed: " . $connection->connect_error);
        }

        $query = "SELECT id, bed, day, time, duration, pressure FROM Events";
        $result = $connection->query($query);

        if($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

            }
        }

    }
    public static function addEvent() {

    }
    private function createEventUI() {

    }
}