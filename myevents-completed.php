<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="myevents-completed-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./volunteer.php">Vol<mark>U</mark>nteer</a>
  </div>
  <div class="myevents">
    <img src="./images/myevents.svg" alt="" />
  </div>
  <div class="myevents-header">
    My Events
  </div>
  <div class="upcoming">
    <a href="./myevents.php">Up-coming</a>
  </div>
  <div class="completed">
    <a href="./myevents-completed.php">Completed</a>
  </div>
  <span class="dot"></span>
  <div class="line"></div>

  <?php


    include 'find_myevents.php';
    include 'db_connection.php';
    $conn = open_con();

    find_myevents($conn, 'completed');
    $conn->close();
  ?>

  <!-- <div class="rectangle"></div>
  <div class="duration">
    <img src="./images/duration-small.svg" alt="" />
  </div>  <div class="role">
    <img src="./images/role-small.svg" alt="" />
  </div>  <div class="location">
    <img src="./images/location-small.svg" alt="" />
  </div>
  <a href="./review.php">
    <div class="review"></div>
    <div class="review-1">
      Review
    </div>
    <div class="review-2">
      <img src="./images/arrow-small.svg" alt="" />
    </div>
  </a> -->

</body>

</html>
