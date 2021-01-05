<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="apply-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <?php session_start();
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
          width: auto;
          height: 20px;
          left: 49px;
          top: 501px;
          font-family: Montserrat;
          font-style: normal;
          font-weight: 600;
          font-size: 16px;
          line-height: 20px;
          color: #000000;">';
  echo 'Hello ';
  echo  $fname;
  echo '! Its time to volunteer!';
  echo '</div>';

?>

  <form action="apply-insert.php?actid=<?php echo $actid ?>" method="post">
    <div class="motivationalLetter">
      <p>
          <input type="text" name="motivationalLetter" placeholder="Tell us why you want to participate.." id="motivationalLetter">
      </p>
    </div>
      <input type="submit" value="Send">

  </form>


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
    Apply
  </div>
</body>



</html>
