<html>
<head>
    <title>Add New Watering Event | PingreenHouse</title>
</head>
<body>
    <?php
        include 'schedule.php';
        include "../../Utility/config.php";

        $beds = $_POST['beds'];
        $days = $_POST['days'];
        $startTime = $_POST['startTime'];
        $duration = Schedule::minutesToSeconds($_POST['durMinutes'], $_POST['durSeconds']);

        Schedule::addEvent($beds, $days, $startTime, $duration);
    ?>

    <script type="text/javascript">
        window.location = "../../../index.php";
    </script>
</body>
</html>