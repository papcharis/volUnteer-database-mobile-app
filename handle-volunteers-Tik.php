<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="my-staff-style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

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

    <div class="rectangle"> </div>

    <?php
        include 'db_connection.php';

        $conn = open_con();

        session_start();
        if (!isset($_SESSION['loggedin'])) {
            header('Location: login.html');
            exit;
        }

        $act_id = $_GET["ActID"];
        $vol_username = $_GET["VolUserName"];
        $motivationalLetter = 'Hello';


        $sql3 = "SELECT motivationalLetter FROM applies WHERE Activity_ID='$act_id' AND Volunteer_Username='$vol_username' ";
        $sql3_result = $conn->query($sql3);
        if ($sql3_result->num_rows > 0) {
            $record = $sql3_result->fetch_row();
            $motivationalLetter = $record[0];
        }

        $sql0 = "SELECT ActName FROM voluntary_activity WHERE Activity_ID='$act_id'";
        $sql0_result = $conn->query($sql0);
        if ($sql0_result->num_rows > 0) {
            $record = $sql0_result->fetch_row();
            $act_name = $record[0];
        }

        $act_name = strlen($act_name) > 23 ? substr($act_name,0,23)."..." : $act_name;
        echo '<div class="myevents-header">
          '.$act_name.'
          </div>';

        $sql2 = "SELECT Age, Sex , First_Name, Last_Name FROM volunteer_profile WHERE username='$vol_username'";
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

        $RecPos = 168;
        $ImPos = 257;
        $NamePos = 180;
        $AgePos = 195;
        $LetterPos = 220;

        echo '<div class="rectangle-prof" style="top: '.$RecPos.'px"></div>';
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
        echo '<div class="Age" style="top:'.$AgePos.'px">Age = '.$age.' </div>';
        echo '<div class="Letter" style="top:'.$LetterPos.'px">'.$motivationalLetter.' </div>';
    ?>

    <form action="hire-insert.php?ActID=<?php echo $act_id?>&VolUserName=<?php echo $vol_username?>" method="post" autocomplete="off">
        <div class="Role_Title">
            <label for="Role_Title">Role Title:</label><br>
            <input type="text" name="Role_Title" id="Role_Title" required>
        </div>
        <div class="Role_Description">
            <label for="Role_Description">Role_Description:</label><br>
            <input type="text" name="Role_Description"id="Role_Description">
        </div>
        <div class="HoursPerDay">
            <label for="HoursPerDay">HoursPerDay:</label><br>
            <input type="text" name="HoursPerDay" id="HoursPerDay">
        </div>
        <div class="Days">
            <label for="Days">Days:</label><br>
            <input type="text" name="Days" id="Days">
        </div>

        <input type="submit" value="ADD VOLUNTEER">
     </form>



</body>
