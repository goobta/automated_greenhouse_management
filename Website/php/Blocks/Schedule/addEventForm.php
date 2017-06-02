<html>
<head>
    <title>Add New Watering Event | PingreenHouse</title>
</head>
<body>
    <h2>Add New Watering Event</h2>
    <br>
    <form action="addEvent.php" method="post">
        Beds: <br/>
        <input type="checkbox" name="beds[]" value="1">1<br />
        <input type="checkbox" name="beds[]" value="2">2<br />
        <input type="checkbox" name="beds[]" value="3">3<br />
        <input type="checkbox" name="beds[]" value="4">4<br />

        Days: <br />
        <input type="checkbox" name="days[]" value="0">Sunday<br />
        <input type="checkbox" name="days[]" value="1">Monday<br />
        <input type="checkbox" name="days[]" value="2">Tuesday<br />
        <input type="checkbox" name="days[]" value="3">Wednesday<br />
        <input type="checkbox" name="days[]" value="4">Thursday<br />
        <input type="checkbox" name="days[]" value="5">Friday<br />
        <input type="checkbox" name="days[]" value="6">Saturday<br />

        Time: <input type="time" name="startTime" /><br />
        Duration: <input type="number" name="durMinutes"> Minutes <input type="number" name="durSeconds" /> Seconds <br>
        <input type="submit" value="Save" />
    </form>
</body>
</html>