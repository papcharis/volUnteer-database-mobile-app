<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="explore-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>
</html>

<?php
include "db_connection.php";
$conn = open_con();

$search = $_GET['search'];

$search = htmlspecialchars($search);


$sql = "SELECT ActName, volunteersNeeded,City,Start_Date ,DATEDIFF(End_Date,Start_Date) AS Duration FROM voluntary_activity
        WHERE (ActName LIKE '%".$search."%') OR (City LIKE '%".$search."%')
        OR (Organizer_ID IN (SELECT organizer_profile.Organizer_ID FROM organizer_profile JOIN voluntary_activity
        ON organizer_profile.organizer_ID = voluntary_activity.organizer_ID
        WHERE Name LIKE '%".$search."%')) AND Start_Date > curdate();";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $RecPos = 280;
    $ActNamePos = 284;
    $DurationPos= 310;
    $RolePos = 330;
    $LocPos = 353;
    $ButtonPos = 340;
    $TextPos = 345;

    $text1 = 284;
    $text2 = 310;
    $text3 = 332;
    $text4 = 353;
    $text5 = 284;
    $text6 = 284;

    while($row = $result->fetch_assoc()){
      echo '<div class="rectangle"  style = "
      position: absolute;
      width: 320px;
      height: 100px;
      left: 27px;
      top: '.$RecPos.'px;
      background: #C1D5D5;
      border-radius: 15px;"></div>';
    }
  }
}
else{
  echo "THERE ARE NO ACTIVITIES RELATED TO YOUR SEARCH";
}

?>
