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

    $sql = "DELETE FROM applies WHERE Activity_ID='$act_id' && Volunteer_Username='$vol_username'";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . $conn->error;
    } 

    header('Location: handle-volunteers.php?ActID='.urldecode($act_id).'');

    $conn->close();

?>