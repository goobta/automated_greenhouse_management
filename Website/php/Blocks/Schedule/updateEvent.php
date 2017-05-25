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
    ?>

    <a href="index.php"><button>Go Back</button></a>
    <a href="deleteEvent.php?id=" <?php echo $id ?>><button>Delete Event</button></a>

</body>
</html>