<html>
<head>
    <title>Pingree Greenhouse</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/main.css" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <div id="container">

        <?php
            include "php/Blocks/Schedule/schedule.php";
        ?>

        <div id="banner">
            <h1>Pingree Greenhouse Control Panel</h1>
        </div>

        <div id="water_tank_status">
        </div>

        <div id="quick_water">
        </div>

        <div id="settings">
        </div>

        <div id="schedule">
            <?php
                $schedule = new Schedule();
                $schedule->generateSchedule();
            ?>
        </div>
    </div>

    <script src="scripts/schedule.js"></script>
</body>
</html>