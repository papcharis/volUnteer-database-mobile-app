<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="review-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="SHORTCUT ICON" HREF="./images/favicon.png">
</head>

<body>
  <?php
    session_start();
    $va = $_GET["ActName"];

    include 'db_connection.php';
    $conn = open_con();

    $stmt = $conn->prepare('SELECT First_Name FROM volunteer_profile WHERE username=?');
    $stmt->bind_param('s',$_SESSION['username']);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows>0){
      $stmt->bind_result($fname);
      $stmt->fetch();
    }
    else{
      echo "Query did not work out.";
    }
    $stmt2 = $conn->prepare('SELECT Activity_ID FROM voluntary_activity WHERE ActName=?');
    $stmt2->bind_param('s',$va);
    $stmt2->execute();
    $stmt2->store_result();
    if($stmt2->num_rows>0){
      $stmt2->bind_result($actid);
      $stmt2->fetch();
    }
    else{
      echo "Query did not work out.";
    }

    echo '<div class="title" style = "position: absolute;
            width: auto;
            height: 18px;
            left: calc(50% - 155px);
            top: 398px;
            font-family: Montserrat;
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            text-transform: uppercase;
            line-height: 29px;
            text-align: center;
            color: #000000;">';
    echo  $va;
    echo '</div>';
    echo '<div class="welcome" style = "position: absolute;
            width: 300px;
            height: 20px;
            left: 49px;
            top: 551px;
            font-family: Montserrat;
            font-style: normal;
            font-weight:600px;
            font-size: 14px;
            line-height: 18px;
            color: #000000;">';
    echo 'Hello ';
    echo  $fname;
    echo '! A Review has a special importance for us!';
    echo '</div>';

  ?>


  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./volunteer.php">Vol<mark>U</mark>nteer</a>
  </div>
  <div class="myevents">
    <img src="./images/myevents.svg" alt="" />
  </div>
  <div class="events">
    <img src="./images/events-photo.png" alt="" />
  </div>
  <div class="line"></div>
  <div class="rectangle-1"></div>

  <div class="text-1">
    Review:
  </div>
  <div class="text-2">
    Rating:
  </div>


  <form action="review-insert.php?actid=<?php echo $actid ?>" method="post">
    <div class="Rating">
      <select name="Rating" id="Rating" require>
      <option value="0">0</option><option value="1">1</option><option value="2">2</option>
      <option value="3">3</option><option value="4">4</option><option value="5">5</option>
      </select>
    </div>
    <div class="ReviewTextBox">
      <p>
        <input type="text" name="ReviewTextBox" id="ReviewTextBox">
      </p>
    </div>
    <input type="submit" value="Send">
  </form>
</body>


</html>
