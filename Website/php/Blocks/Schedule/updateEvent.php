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

        $minutes = (isset($_POST['durMinutes']) ? $_POST['durMinutes'] : 0);
        $seconds = (isset($_POST['durSeconds']) ? $_POST['durSeconds'] : 0);

        $duration = Schedule::minutesToSeconds($minutes, $seconds);

        $startTime = $_GET['startTime'];

        Schedule::editEvent($id, $bedNumber, $weekDay, $startTime, $duration);
    ?>

    <script type="text/javascript">
        window.location = "../../../index.php";
    </script>
</body>
</html>