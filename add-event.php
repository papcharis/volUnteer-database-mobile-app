<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="add-event-style.css" />
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
  <div class="myevents">
    <img src="./images/myevents.svg" alt="" />
  </div>
  <div class="addevent-header">
    Add Event
  </div>
  <div class="line"></div>
  <div class="rectangle"></div>

  <form action="add-event-insert.php" method="post" autocomplete="off">
    <div class="activity_name">
      <label for="activity_name">Activity Name:</label><br>
      <input type="text" name="activity_name" id="activity_name" required>
    </div>
    <div class="city">
      <label for="city">City:</label><br>
      <input type="text" name="city"id="city">
    </div>
    <div class="zipcode">
      <label for="zipcode">Zipcode:</label><br>
      <input type="text" name="zipcode" id="zipcode">
    </div>
    <div class="address">
      <label for="address">Address:</label><br>
      <input type="text" name="address" id="address">
    </div>
    <div class="numofvol">
      <label for="numofvol">Number of VolUnteers:</label><br>
      <input type="text" name="numofvol" id="numofvol">
    </div>
    <div class="startdate">
      <label for="startdate">Start Date:</label><br>
      <input type="date" name="startdate" id="startdate" required>
    </div>
    <div class="enddate">
      <label for="enddate">End Date:</label><br>
      <input type="date" name="enddate" id="enddate" required>
    </div>
    <input type="submit" value="ADD EVENT">
  </form>

</body>
</html>
