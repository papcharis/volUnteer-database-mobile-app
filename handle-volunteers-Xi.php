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


    // header('Location: handle-volunteers.php?ActID='.urldecode($act_id).'');

    $conn->close();

?>