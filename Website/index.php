<html>
<head>
    <title>Pingree Greenhouse</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>
<body>
    <div id="container">

        <?php
            include "php/Blocks/schedule.php";
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
</body>
</html>