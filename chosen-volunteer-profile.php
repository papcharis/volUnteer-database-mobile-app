<?php

  include 'db_connection.php';
  $conn = open_con();

  $username = $_GET['username'];

  $stmt = $conn->prepare('SELECT First_Name,Last_Name,Email,Age,ShortBio,Phone,Sex FROM volunteer_profile WHERE username=?');
  $stmt->bind_param('s',$username);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows>0){
    $stmt->bind_result($fname,$lname,$email,$age,$shortBio,$phone,$sex);
    $stmt->fetch();
  }
  else{
    echo "Query did not work out.";
  }

  $stmt->close();
?>



<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="chosen-volunteer-profile-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./organizer.php">Vol<mark>U</mark>nteer</a>
  </div>
  <div class="myprofile">
    <img src="./images/myprofile.svg" alt="" />
  </div>
  <div class="rectangle"></div>
  <a href="">
    <div class="edit"></div>
    <div class="edit-1">
        Edit
    </div>
  </a>
  <div class="profile-pic">
  <?php
    if($sex=='M'){
      $bg = array('profile-3.png', 'profile-4.png','profile-6.png');
    }
    else{
      $bg = array('profile-1.png', 'profile-2.png','profile-5.png');
    }
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
    <img src="./images/profile-icon-1.svg" alt="" />
  </div>
  <div class="profile-icon-2">
    <img src="./images/profile-icon-2.svg" alt="" />
  </div>
  <div class="profile-icon-3">
    <img src="./images/profile-icon-3.svg" alt="" />
  </div>
  <div class="contact">Contact Info</div>
  <div class="line-2"></div>
  <div class="profile-icon-4">
    <img src="./images/profile-icon-4.svg" alt="" />
  </div>
  <div class="profile-icon-5">
    <img src="./images/profile-icon-5.svg" alt="" />
  </div>
  <div class="full-name"><?=$fname. ' ' .$lname?></div>
  <div class="username-text"><?=$username?></div>
  <div class="age-text"><?=$age?></div>
  <div class="shortBio-text"><?=$shortBio?></div>
  <div class="phone-text"><?=$phone?></div>
  <div class="email-text"><?=$email?></div>


</body>

</html>
