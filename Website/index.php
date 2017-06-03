<html>
<head>
    <title>Pingree Greenhouse</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/main.css" type="text/css">

    <script src="scripts/schedule.js"></script>

</head>
<body>
    <div id="container">

        <?php
            include "php/Blocks/Schedule/schedule.php";
            include "php/Utility/config.php";

        ?>

        <div id="banner">
            <h1>Pingree Greenhouse Control Panel</h1>
        </div>

        <div id="add_event">
            <a href="php/Blocks/Schedule/addEventForm.php"><button>Add Watering Event</button></a>
        </div>

        <br>

        <div id="schedule">
            <?php
                $schedule = new Schedule();
                $schedule->generateSchedule();
            ?>
        </div>

        <br>

        <div id="quick_water">
            <form >
                Beds: <br />
                <?php
                    for($i = 1; $i <= Config::$bedCount; $i++) {
                        echo "<input type=\"checkbox\" name=\"beds[]\" value=\"" . $i  ."\">" . $i . "<br />";
                    }
                ?>

                Duration: <input type="number" name="durMinutes"> Minutes <input type="number" name="durSeconds" /> Seconds <br>
                <input type="submit" value="Send Job">
            </form>
        </div>
    </div>

    <script src="scripts/schedule.js"></script>
</body>
</html>