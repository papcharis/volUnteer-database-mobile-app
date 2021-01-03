<!DOCTYPE html>
<?php
$conn = new mysqli("localhost", "root", "patzaria4ever", "mydb");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="eventschedule-style.css" />
  <link href="calendar.css" type="text/css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>
  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./volunteer.php">Vol<mark>U</mark>nteer</a>
  </div>
<?php
include 'calendar.php';

$calendar = new Calendar();

echo $calendar->show();
echo $calendar->eventsOfMonth($conn);
?>
<div class="vl"></div>
</body>
</html>
