<html>
<head>
    <title>Updating Watering Event | PingreenHouse</title>
</head>
<body>
    <?php
        include "schedule.php";
        include "../../Utility/config.php";

        $id = $_GET['id'];
        $bedNumber = $_GET['bed_number'];
        $weekDay = $_GET['weekday'];
        $duration = Schedule::minutesToSeconds($_GET['durMinutes'], $_GET['durSeconds']);
        $startTime = $_GET['startTime'];

        Schedule::editEvent($id, $bedNumber, $weekDay, $startTime, $duration);
    ?>

    <script type="text/javascript">
        window.location = "../../../index.php";
    </script>
</body>
</html>