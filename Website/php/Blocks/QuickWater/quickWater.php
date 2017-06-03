<html>
<head>
    <title>Quick Water | PingreenHouse</title>
</head>
<body>
    <?php
        include '../Schedule/schedule.php';

        $beds = $_POST['beds'];

        $minutes = (isset($_POST['durMinutes']) ? $_POST['durMinutes'] : 0);
        $seconds = (isset($_POST['durSeconds']) ? $_POST['durSeconds'] : 0);

        $duration = Schedule::minutesToSeconds($minutes, $seconds);

        foreach($beds as $bed) {
            exec("python /home/pi/Documents/automated_greenhouse_management/Python/Water.py " . $bed . " " . $duration . " > /dev/null 2>/dev/null &");

            sleep(1);
        }

        echo "Job Sent <br><br>";

        echo '<a href="../../../index.php"><button>Return to dashboard</button></a>';
    ?>
</body>
</html>