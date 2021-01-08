<!DOCTYPE html>
<html lang='en'>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="add-staff-style.css" />
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

        $sql = "SELECT ActName FROM voluntary_activity WHERE Activity_ID = '$act_id'";
        $sql_result = $conn->query($sql);
        if ($sql_result->num_rows > 0) {
            $record = $sql_result->fetch_row();
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

        ?>


    <form action="add-staff-insert.php?ActID=<?php echo $act_id?>" method="post" autocomplete="off">
        <div class="Name">
            <label for="Name">Name:</label><br>
            <input type="text" name="Name" id="Name" required>
        </div>
        <div class="Age">
            <label for="Age">Age:</label><br>
            <input type="text" name="Age" id="Age">
        </div>
        <div class="Title">
            <label for="Title">Title:</label><br>
            <input type="text" name="Title" id="Title">
        </div>


        <input type="submit" value="ADD STAFF MEMBER">
     </form>




</body>

</html>
