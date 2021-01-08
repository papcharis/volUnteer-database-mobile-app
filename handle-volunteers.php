<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="handle-volunteers-style.css" />
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
              width: 233px;
              height: 18px;
              left: 9px;
              top: 128px;
              font-family: Montserrat;
              font-style: normal;
              font-weight: 600;
              font-size: 30px;
              line-height: 37px;
              text-align: center;
              color: #000000;">
          '.$act_name.'
          </div>';


    echo '<div class="applied">
    <a href="handle-volunteers.php?ActID='.urldecode($act_id).'">Applied </a>
    </div>';
    echo '<div class="chosen">
    <a href="handle-volunteers-chosen.php?ActID='.urldecode($act_id).'">Chosen</a>
    </div>';


    $sql1 = "SELECT Volunteer_Username FROM applies WHERE Activity_ID='$act_id' AND Volunteer_Username NOT IN (SELECT Volunteer_Username FROM hires WHERE Activity_ID='$act_id ')";
    $result = $conn->query($sql1);

    $age=0;
    $sex='';

    if ($result->num_rows > 0) {

      $RecPos = 260;
      $ImPos = 352;
      $TikPos= 295;
      $XPos = 295;
      $NamePos = 276;
      $AgePos = 298;



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

        echo '<div class="Tik"  style =
          "top: '.$TikPos.'px;
           left: 250px;  ">
              <a href="handle-volunteers-Tik.php?ActID='.urldecode($act_id).'&VolUserName='.$curr_username.'">
                <img src="./images/tik.svg" alt="" />
              </a>
           </div>';

           echo '<div class="Xi" style =
           "top: '.$XPos.'px;
            left: 300px;  ">
            <a <a href="handle-volunteers-Xi.php?ActID='.urldecode($act_id).'&VolUserName='.$curr_username.'">
              <img src="./images/xi.svg" alt="" />
            </a>
           </div>';

        $RecPos = $RecPos + 100;
        $ImPos = $ImPos + 100;
        $TikPos= $TikPos + 100;
        $XPos = $XPos + 100;
        $NamePos = $NamePos+100;
        $AgePos = $AgePos +100;
      }


    }

    $conn->close();
  ?>

</body>

</html>
