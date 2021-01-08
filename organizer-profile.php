<?php
  session_start();

  if(!isset($_SESSION['loggedin'])){
    header('Location:login.html');
    exit;
  }

  include 'db_connection.php';
  $conn = open_con();

  $stmt = $conn->prepare('SELECT Name, Type, organizer_profile.organizer_ID, Street, City, ZipCode
                          FROM organizer_profile JOIN accountso on organizer_profile.organizer_ID = accountso.organizer_ID
                          WHERE username = ?');

  $stmt->bind_param('s',$_SESSION['username']);
  $stmt->execute();
  $stmt->store_result();
  if($stmt->num_rows>0){
    $stmt->bind_result($name,$type,$orgID,$street,$city,$zipcode);
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
  <link rel="stylesheet" href="organizer-profile-style.css" />
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
  <div class="myprofile">
    <img src="./images/org.svg" alt="" />
  </div>
  <div class="rectangle"></div>
  <a href="">
    <div class="edit"></div>
    <div class="edit-1">
        Edit
    </div>
  </a>
  <div class="profile-pic">
    <img src="./images/organizer-profile.png" alt="" />
  </div>
  <div class="line"></div>
  <div class="profile-icon-1">
    <img src="./images/org-icon.svg" alt="" />
  </div>
  <div class="profile-icon-2">
    <img src="./images/id-icon.svg" alt="" />
  </div>
  <div class="profile-icon-3">
    <img src="./images/loc-icon.svg" alt="" />
  </div>
  <div class="name"><?=$name?></div>
  <div class="orgType"><?=$type?></div>
  <div class="orgID"><?=$orgID?></div>
  <div class="street"><?=$street. ' ' .$city. ' ' .$zipcode?></div>

</body>

</html>
