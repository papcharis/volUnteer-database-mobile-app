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
    $Role_Title = " ";

    if($stmt2 = $conn->prepare('INSERT INTO hires (Role_Title, Volunteer_Username, Activity_ID)) VALUES (?, ?, ?)')){
        $stmt2->bind_param('sss',  $Role_Title, $vol_username, $act_id);
        $stmt2->execute();
    }
    else{
        echo 'INSERT ERROR';
    }

    $sql0 = "DELETE FROM applies WHERE (Volunteer_Username='.$vol_username.' && Activity_ID='.$act_id.')";


    // header('Location: handle-volunteers.php?ActID='.urldecode($act_id).'');

    $conn->close();

?>