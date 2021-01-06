<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="myevents-pending-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
  <div class="inprogress">
    <a href="./myevents-pending.php">Pending</a>
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

    find_myevents($conn, 'pending');
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
