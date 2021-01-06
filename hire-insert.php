<?php
    include 'db_connection.php';
    session_start();
    $conn = open_con();

    $Role_Title  = $_POST['Role_Title'];
    $Role_Description = $_POST['Role_Description'];
    $hoursPerDay = $_POST['HoursPerDay'];
    $Days = $_POST['Days'];
    $act_id = $_GET['ActID'];
    $vol_username = $_GET['VolUserName'];

    if($stmt2 = $conn->prepare('INSERT INTO hires (Role_Title,Role_Description, hoursPerDay, Days ,Volunteer_Username, Activity_ID) VALUES (?,?,?,?, ?, ?)')){
        $stmt2->bind_param('ssssss',  $Role_Title, $Role_Description,  $hoursPerDay, $Days, $vol_username, $act_id);
        $stmt2->execute();
    }
    else{
        echo 'INSERT ERROR';
    }


    header('Location: handle-volunteers.php?ActID='.urldecode($act_id).'');

    $conn->close();

?>
