<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="my-staff-style.css" />
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
  <div class="mystaff">
    <img src="./images/my-staff-icon.svg" alt="" />
  </div>
  <div class="mystaff-header">
    My Staff
  </div>
  <div class="line"></div>

<?php
  session_start();

  include("db_connection.php");
  $conn = open_con();

  $stmt = $conn->prepare('SELECT Name, ActName, Title, Staff_ID FROM staff JOIN voluntary_activity ON staff.Activity_ID = voluntary_activity.Activity_ID
          WHERE Organizer_ID = ?');

  $stmt->bind_param('s',$_SESSION['organizer_ID']);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0){

    $RecPos = 214;
    $LinePos= 243.49;
    $NamePos = 224;
    $EventPos = 250;
    $TitlePos = 272;
    $IdPos = 295;


    while($row = $result->fetch_assoc()){
      echo '<div class="rectangle"  style = "
      position: absolute;
      width: 320px;
      height: 100px;
      left: 27px;
      top: '.$RecPos.'px;
      background: rgba(51, 108, 131, 0.48);
      border-radius: 15px;"></div>

      <div class = "small-line" style="top:'.$LinePos.'px;"></div>
      <div class= "name-text" style="top:'.$NamePos.'px;">'.$row['Name'].'</div>
      <div class= "event-text" style="top:'.$EventPos.'px;">Event: '.$row['ActName'].'</div>
      <div class= "title-text" style="top:'.$TitlePos.'px;">Title: '.$row['Title'].'</div>
      <div class= "ID-text" style="top:'.$IdPos.'px;">Staff ID: '.$row['Staff_ID'].'</div>
      '

      ;



      $RecPos = $RecPos +140;
      $LinePos = $LinePos + 140;
      $NamePos = $NamePos + 140;
      $EventPos = $EventPos + 140;
      $TitlePos = $TitlePos + 140;
      $IdPos = $IdPos + 140;
    }
  }
  else{
    echo '<div class="message" style= "position: absolute;
              width: 272px;
              height: 51px;
              left: 51px;
              top: 355px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: 500;
              font-size: 24px;
              line-height: 29px;
              text-align: center;
              color: #000000;">';
    echo "You have not staff right now";
  }
 ?>

</body>

</html>
