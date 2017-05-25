<html>
<head>
    <title>Edit Watering Event</title>
</head>
<body>
    <?php
        include "schedule.php";

        $id = $_GET['id'];
        $weekday = $_GET['wd'];
        $startTime = $_GET['st'];
        $duration = $_GET['dur'];
        $bedNumber = $_GET['bn'];

        $durationArray = Schedule::secondsToMinutes($duration);
    ?>

    <a href="../../../index.php"><button>Go Back</button></a>
    <?php echo '<a href="deleteEvent.php?id=' . $id . '"><button>Delete Event</button></a>'; ?>

    <form action="updateEvent.php" method="get">
        Bed: <input type="number" name="bed_number" value="<?php echo $bedNumber; ?>"/> <br />
        Day: <select name="weekday">
            <?php
                for($i = 0; $i < 7; $i++) {
                    if($i == $weekday) {
                        echo '<option value="' . $i . '" selected>' . Schedule::numberToDay($i) . '</option>';
                    }
                    else {
                        echo '<option value="' . $i . '">' . Schedule::numberToDay($i) . '</option>';
                    }
                }
            ?>
        </select> <br />
        Start Time: <input type="time" name="startTime" value="<?php echo $startTime; ?>"/><br />
        Duration: <input type="number" name="durMinutes" value="<?php echo $durationArray[0];?>"> Minutes <input type="number" name="durSeconds" value="<?php echo $durationArray[1];?>"> Seconds <br/>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="submit" value="Save">
    </form>

</body>
</html>