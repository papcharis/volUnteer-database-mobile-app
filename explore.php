<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="explore-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="SHORTCUT ICON" HREF="./images/favicon.png">
  
</head>

<body>

  <div class="logo-image">
    <img src="./images/logo.png" alt="" />
  </div>
  <div class="logo">
    <a href="./volunteer.php">Vol<mark>U</mark>nteer</a>
  </div>
  <div class="myevents">
    <img src="./images/search_icon.svg" alt="" />
  </div>
  <div class="explore-header">
    Explore
  </div>
  <div class="line"></div>
  <div class="upcoming">
    Upcoming Voluntary Activities
  </div>
	<form action="explore-results.php" method="GET" class="search_rectangle">
		<input type="text" placeholder="Search something.." name="search" />
		<input type="submit" value="" />
	</form>

<?php
  include("db_connection.php");
  $conn = open_con();

  $sql = "SELECT ActName, volunteersNeeded,voluntary_activity.City,Start_Date ,End_Date,Name FROM voluntary_activity JOIN organizer_profile
          ON voluntary_activity.Organizer_ID = organizer_profile.organizer_ID WHERE Start_Date > curdate()
          ORDER BY Start_Date";

  $result = $conn->query($sql);

  $bg = array('#FFC59D','#D9B8CB','#C1D5D5','#FFC59D','#D9B8CB','#C1D5D5','#FFC59D','#D9B8CB','#C1D5D5');
  $sg = array('#FF842E','#993E73','#7CA7A7','#FF842E','#993E73','#7CA7A7','#FF842E','#993E73','#7CA7A7');
  $i = 0;

  if ($result->num_rows > 0) {
    // output data of each row
    $RecPos = 316;
    $DurationPos= 346;
    $OrgPos = 366;
    $LocPos = 389;

    $text1 = 320;
    $text2 = 346;
    $text3 = 368;
    $text4 = 389;

    $selectedLg = 385;
    $selectedNg = 391;


    while($row = $result->fetch_assoc()) {
      echo '<div class="rectangle"  style = "
      position: absolute;
      width: 320px;
      height: 100px;
      left: 27px;
      top: '.$RecPos.'px;
      background: '.$bg[$i].';
      border-radius: 15px;"></div>';

      echo '<div class="duration" style = "
      top: '.$DurationPos.'px;
      "
      >
          <img src="./images/duration-small.svg" alt="" />
      </div>';

      echo '<div class="organizer" style = "
      top: '.$OrgPos.'px;
      ">
          <img src="./images/organizer-small.svg" alt="" />
      </div>';

      echo '<div class="location" style = "
      top: '.$LocPos.'px;
      ">
          <img src="./images/location-small.svg" alt="" />
      </div>';

      $row['ActName'] = strlen($row['ActName']) > 30 ? substr($row['ActName'],0,30)."..." : $row['ActName'];

      echo '<div class="actname" style = "
      top: '.$text1.'px;
      ">
      '.$row['ActName'].'
      </div>';

      echo '<div class="durationText" style = "
      top: '.$text2.'px;
      ">
      '.$row['Start_Date'].' - '.$row['End_Date'].'
      </div>';

      echo '<div class="orgText" style = "
      top: '.$text3.'px;
      ">
      '.$row['Name'].'
      </div>';

      echo '<div class="locationText" style = "
      top: '.$text4.'px;
      ">
      '.$row['City'].'
      </div>';

      echo '<a href="./events-description.php?ActName='.urldecode($row["ActName"]).'">';
      echo  '<div class="more" style = "
      position: absolute;
      width: 72px;
      height: 26px;
      left: 263px;
      top: '.$selectedLg.'px;
      background: '.$sg[$i].';
      border-radius: 15px;"></div>';
      echo  '</a>';
      echo '<a href="./events-description.php?ActName='.urldecode($row["ActName"]).'">';
      echo  '<div class="more-1" style="
      position: absolute;
      width: 72px;
      height: 29px;
      left: 259px;
      top: '.$selectedLg.'px;
      font-family: Montserrat;
      font-style: normal;
      font-weight: 600;
      font-size: 16px;
      line-height: 28px;
      text-align: center;
      text-decoration: none;
      color: #000000;">';
      echo   ' More';
      echo '&nbsp;';
      echo  '</div>';
      echo  '</a>';
      echo '<a href="./events-description.php?ActName='.urldecode($row["ActName"]).'">';
      echo '<div class="more-1" style="
      position: absolute;
      width: 72px;
      height: 29px;
      left: 288px;
      top: '.$selectedNg.'px;">';
      echo    '<img src="./images/arrow-small.svg" alt="" />';
      echo  '</div>';
      echo  '</a>';

      $RecPos = $RecPos +120;
      $DurationPos= $DurationPos + 120;
      $OrgPos = $OrgPos + 120;
      $LocPos = $LocPos + 120;
      $selectedLg = $selectedLg + 120;
      $selectedNg = $selectedNg + 120;

      $text1 = $text1 + 120;
      $text2 = $text2 + 120;
      $text3 = $text3 + 120;
      $text4 = $text4 + 120;

      $i++;
      if($i==8){
        $i=0;
      }
  }
}
  else{
    echo "THERE ARE NO ACTIVITIES RELATED TO YOUR SEARCH";
  }
  ?>


</body>

</html>
