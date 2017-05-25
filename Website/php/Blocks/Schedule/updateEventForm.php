<html>
<head>
    <title>Edit Watering Event</title>
</head>
<body>
    <?php
        $id = $_GET['id'];
        $weekday = $_GET['wd'];
        $startTime = $_GET['st'];
        $duration = $_GET['dur'];

        echo $id;
        echo $weekday;
        echo $startTime;
        echo $duration
    ?>

    <a href="../../../index.php"><button>Go Back</button></a>
    <?php echo '<a href="deleteEvent.php?id=' . $id . '"><button>Delete Event</button></a>'; ?>

</body>
</html>