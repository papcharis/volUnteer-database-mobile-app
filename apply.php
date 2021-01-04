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
  $va2 = $_SESSION['username'];
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
  <a href="">
    <div class="send"></div>
    <div class="send-1">
      Send
    </div>
  </a>
  <div class="text-1">
    Apply
  </div>
  <div class="text-2">
    Username:
  </div>
</body>

</html>
