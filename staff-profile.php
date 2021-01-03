<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="staff-profile-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./organizer.php">Vol<mark>U</mark>nteer</a>
  </div>
  <div class="myprofile">
    <img src="./images/staff.svg" alt="" />
  </div>
  <div class="rectangle"></div>
  <a href="">
    <div class="edit"></div>
    <div class="edit-1">
        Edit
    </div>
  </a>
  <div class="back">
    <a href="">
      <img src="./images/back-staff.svg" alt="" />
    </a>
  </div>
  <div class="profile-pic">
  <?php
    $bg = array('profile-1.png', 'profile-2.png', 'profile-3.png', 'profile-4.png', 'profile-5.png', 'profile-6.png');
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
  <div class="line"></div>
  <div class="profile-icon-1">
    <img src="./images/id-icon.svg" alt="" />
  </div>
  <div class="profile-icon-2">
    <img src="./images/age-icon.svg" alt="" />
  </div>
  <div class="profile-icon-3">
    <img src="./images/role-icon.svg" alt="" />
  </div>

</body>

</html>
