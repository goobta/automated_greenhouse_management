<html>
<head>
    <title>Delete Watering Event | PingreenHouse</title>
</head>
<body>
    <?php
        include "schedule.php";
        include "../../Utility/config.php";

        $id = $_GET['id'];

        Schedule::deleteEvent($id);
    ?>
</body>
