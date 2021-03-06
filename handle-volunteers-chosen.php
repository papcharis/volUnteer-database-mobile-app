<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="handle-volunteers-chosen-style.css" />
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
  <div class="myevents">
    <img src="./images/myevents.svg" alt="" />
  </div>

  <span class="dot"></span>
  <div class="line"></div>

  <?php
    include 'db_connection.php';

    $conn = open_con();

    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: login.html');
        exit;
    }

    $act_id = $_GET["ActID"];

    $sql0 = "SELECT ActName FROM voluntary_activity WHERE Activity_ID='$act_id'";
    $sql0_result = $conn->query($sql0);
    if ($sql0_result->num_rows > 0) {
        $record = $sql0_result->fetch_row();
        $act_name = $record[0];
    }

    $act_name = strlen($act_name) > 23 ? substr($act_name,0,23)."..." : $act_name;
    echo '<div class="myevents-header" style="
              position: absolute;
              width: 360px;
              height: 18px;
              left: 9px;
              top: 128px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: 600;
              font-size: 24px;
              line-height: 37px;
              color: #000000;">
          '.$act_name.'
          </div>';


    echo '<div class="applied">
    <a href="handle-volunteers.php?ActID='.urldecode($act_id).'">Applied </a>
    </div>';
    echo '<div class="chosen">
    <a href="handle-volunteers-chosen.php?ActID='.urldecode($act_id).'">Chosen</a>
    </div>';


    $sql1 = "SELECT Volunteer_Username,Role_Title FROM hires WHERE Activity_ID='$act_id'";
    $result = $conn->query($sql1);

    $age=0;
    $sex='';

    if ($result->num_rows > 0) {

      $RecPos = 260;
      $ImPos = 352;
      $TikPos= 295;
      $XPos = 295;
      $NamePos = 276;
      $AgePos = 325;
      $RolePos = 308;
      $ViewPos = 323;



      while($row = $result->fetch_assoc()) {
        $curr_username = $row['Volunteer_Username'];

        $sql2 = "SELECT Age, Sex , First_Name, Last_Name FROM volunteer_profile WHERE username='$curr_username'";
        $sql2_result = $conn->query($sql2);
        if ($sql2_result->num_rows > 0) {
          $record = $sql2_result->fetch_row();
          $age = $record[0];
          $sex= $record[1];
          $name = $record[2] . " " .$record[3];
        }
        else {
            echo "QUERY ERROR";
        }

        echo '<div class="rectangle" style="top: '.$RecPos.'px"></div>';
        if($sex == 'F') {
          echo '<div class="image" style="top: '.$ImPos.'px">
          <img src=./images/profile-small-1.png alt="" />
          </div>';
        }
        else{
          echo '<div class="image" style="top: '.$ImPos.'px">
          <img src=./images/profile-small-2.png alt="" />
          </div>';
        }

        echo '<div class="Name" style="top:'.$NamePos.'px"> '.$name.' </div>';
        echo '<div class="Age" style="top:'.$AgePos.'px">Age : '.$age.' </div>';
        echo '<div class="Role" style="top:'.$RolePos.'px">Role : '.$row['Role_Title'].' </div>';

        echo '<a href="chosen-volunteer-profile.php?username='.urldecode($curr_username).'">
          <div class="viewprofile" style="top:'.$ViewPos.'px"></div>
          <div class="viewprofile-1" style="top:'.$ViewPos.'px">
            view profile
          </div>
        </a>';



        $RecPos = $RecPos + 120;
        $ImPos = $ImPos + 120;
        $TikPos= $TikPos + 120;
        $XPos = $XPos + 120;
        $NamePos = $NamePos+120;
        $AgePos = $AgePos +120;
        $RolePos = $RolePos + 120;
        $ViewPos = $ViewPos + 120;
      }


    }









    $conn->close();
  ?>

</body>

</html>
