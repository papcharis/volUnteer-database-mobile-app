<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="organizer-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>

  <?php
    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
      header('Location: index.html');
      exit;
    }
  ?>

  <a href="logout.php">
    <div class="logout">
      <img src="./images/logout-icon.svg" alt="" />
    </div>
  </a>

  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./organizer.php">Vol<mark>U</mark>nteer</a>
  </div>

  <a href="./organizer-myevents.php">
    <div class="rectangle-1"></div>
    <div class="button-1">
      <img src="./images/organizer-button-1.svg" alt="" />
    </div>
    <div class="events">
      MY EVENTS
    </div>
  </a>
  <div>

</div>
  <a href="organizer-profile.php">
    <div class="rectangle-2"></div>
    <div class="button-2">
      <img src="./images/organizer-button-2.svg" alt="" />
    </div>
    <div class="profile">
      ORGANIZER<br> PROFILE
    </div>
  </a>


  <a href="my-staff.php">
    <div class="rectangle-3"></div>
    <div class="button-3">
      <img src="./images/organizer-button-3.svg" alt="" />
    </div>
    <div class="explore">
      MY STAFF
    </div>
  </a>


  <a href="add-event.php">
    <div class="rectangle-4"></div>
    <div class="button-4">
      <img src="./images/organizer-button-4.svg" alt="" />
    </div>
    <div class="myevents">
      ADD EVENT
    </div>
  </a>



</body>

</html>
