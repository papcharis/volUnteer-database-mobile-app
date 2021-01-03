<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="handle-volunteers-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
  <div class="applied">
    <a href="./organizer-myevents.php">Applied</a>
  </div>
  <div class="chosen">
    <a href="./organizer-myevents-comp.php">Chosen</a>
  </div>
  <div class="rejected">
    <a href="./organizer-myevents-comp.php">Rejected</a>
  </div>
  <span class="dot"></span>
  <div class="line"></div>
  <div class="rectangle"></div>
  <div class="duration">
    <img src="./images/tik.svg" alt="" />
  </div>  <div class="staff">
    <img src="./images/xi.svg" alt="" />
  </div>
  <div class="profile-pic">
  <?php
    $bg = array('profile-small-1.png', 'profile-small-2.png', 'profile-small-3.png', 'profile-small-4.png', 'profile-small-5.png', 'profile-small-6.png');
    $i = rand(0, count($bg)-1);
    $selectedBg = "$bg[$i]";
  ?>
  </div>
  <style type="text/css">
    <!--
      .profile-pic{
          background: url(images/<?php echo $selectedBg; ?>) no-repeat;
          position: absolute;
          width: 160px;
          height: 160px;
          top: 243px;
          left: 50%;
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
        }
        >
  </style>
  <a href="">
    <div class="edit"></div>
    <div class="edit-1">
      Edit Event
    </div>
    <div class="edit-2">
      <img src="./images/arrow-small.svg" alt="" />
    </div>
  </a>
  <a href="">
    <div class="handle"></div>
    <div class="handle-1">
      Handle Volunteers
    </div>
    <div class="handle-2">
      <img src="./images/arrow-small.svg" alt="" />
    </div>
  </a>


</body>

</html>
