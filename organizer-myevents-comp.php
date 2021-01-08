<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="organizer-myevents-comp-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="SHORTCUT ICON" HREF="./images/favicon.png">
</head>

<body>

  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./organizer.php">Vol<mark>U</mark>nteer</a>
  </div>
  <div class="myevents">
    <img src="./images/myevents.svg" alt="" />
  </div>
  <div class="myevents-header">
    My Events
  </div>
  <div class="upcoming">
    <a href="./organizer-myevents.php">Up-coming</a>
  </div>
  <div class="completed">
    <a href="./organizer-myevents-comp.php">Completed</a>
  </div>
  <div class="inprogress">
    <a href="./organizer-myevents-inprogress.php">In-Progress</a>
  </div>

  <span class="dot"></span>
  <div class="line"></div>

  <?php
    include 'find_myevents_org.php';
    include 'db_connection.php';
    $conn = open_con();

    find_myevents_org($conn, 'completed');
    $conn->close();
  ?>


</body>

</html>
