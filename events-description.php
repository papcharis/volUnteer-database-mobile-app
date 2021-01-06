<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="events-description-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  $va = $_GET["ActName"];

  include 'db_connection.php';
  $conn = open_con();

  $sql = "SELECT ActName,voluntary_activity.City,voluntary_activity.Street,voluntary_activity.ZipCode,VolunteersNeeded,Start_Date,End_Date,Name FROM voluntary_activity JOIN Organizer_Profile ON Organizer_Profile.organizer_ID=voluntary_activity.organizer_ID
          WHERE ActName = '$va'" ;
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
  // output data of each row
    while($row = $result->fetch_assoc()) {
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
      echo  $row["ActName"];
      echo '</div>';
      echo '<div class="org" style = "position: absolute;
              width: 210px;
              height: 24px;
              left: 49px;
              top: 488px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: normal;
              font-size: 14px;
              display: flex;
              align-items: flex-end;
              line-height: 14px;
              color: #000000;">';
      echo  $row["Name"];
      echo '</div>';
      echo '<div class="dur" style = "position: absolute;
              width: 186px;
              height: 18px;
              left: 164px;
              top: 550px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: normal;
              font-size: 14px;
              line-height: 17px;
              text-align: center;
              color: #544A4A;">';
      echo date("d/m/Y", strtotime($row["Start_Date"]));
      echo '&nbsp;-&nbsp;';
      echo date("d/m/Y", strtotime($row["End_Date"]));
      echo '</div>';
      echo '<div class="vn" style = "position: absolute;
              width: 111px;
              height: 18px;
              left: 199px;
              top: 575px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: normal;
              font-size: 14px;
              line-height: 17px;
              text-align: center;
              color: #544A4A;">';
      echo $row["VolunteersNeeded"];
      echo '&nbsp;Volunteers';
      echo '</div>';
      echo '<div class="loc" style = "position: absolute;
              width: auto;
              height: 33px;
              left: 140px;
              top: 600px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: normal;
              font-size: 14px;
              line-height: 17px;
              color: #544A4A;
              overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;">';
     $out = strlen($row["Street"]) > 25 ? substr($row["Street"],0,25)."..." : $row["Street"];
     if( $out == NULL ){
         echo '-';
     }
     else{echo $out;}
      echo '<br>';
      echo $row["City"].'&nbsp;&nbsp;'.$row["ZipCode"];
      echo '</div>';
      echo '<a href="./apply.php?ActName='.urldecode($row["ActName"]).'">';
      echo  '<div class="apply">';
      echo '</div>';
      echo  '<div class="apply-1">';
      echo    'Apply';
      echo  '</div>';
      echo '</a>';
      $va2=$row["Name"];
  }
} else {
  echo "0 results";
}
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
  <a href="view-organizer-profile.php?orgname=<?php echo $va2 ?>">
    <div class="viewprofile"></div>
    <div class="viewprofile-1">
      view profile
    </div>
  </a>
  <div class="text-1">
    Organized by:
  </div>
  <div class="rectangle-2"></div>
  <div class="text-2">
    Event Duration:
  </div>
  <div class="text-3">
    Volunteers Needed:
  </div>
  <div class="text-4">
    Location:
  </div>
</body>

</html>
