<?php
  session_start();

  if(!isset($_SESSION['loggedin'])){
    header('Location:login.html');
    exit;
  }

  include 'db_connection.php';
  $conn = open_con();

  $stmt = $conn->prepare('SELECT organizer_ID FROM accountso WHERE username = ?');

  $stmt->bind_param('s',$_SESSION['username']);
  $stmt->execute();
  $stmt->store_result();

  if($stmt->num_rows>0){
    $stmt->bind_result($orgID);
    $stmt->fetch();
  }
  else{
    echo "Query did not work out.";
  }

  $randomID  = str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT);

  if (!isset($randomID, $_POST['activity_name'],$_POST['city'],$_POST['address'],$_POST['zipcode'],$_POST['startdate'],$_POST['enddate'], $orgID)) {
  	// Could not get the data that should have been sent.
  	exit('Data not received, try again');
  }
  if($stmt2 = $conn->prepare('INSERT INTO voluntary_activity (Activity_ID, ActName, City,Street,ZipCode,VolunteersNeeded,Start_Date,End_Date,Organizer_ID) VALUES (?, ?, ?, ?,?, ?, ?, ? , ?)')){
    $stmt2->bind_param('sssssssss', $randomID, $_POST['activity_name'],$_POST['city'],$_POST['address'],$_POST['zipcode'], $_POST['numofvol'], $_POST['startdate'],$_POST['enddate'], $orgID);
    $stmt2->execute();
  }
  else{
    echo 'Could not prepare statement 1.5';
  }
  header('Location: organizer.php');


  $conn->close();
?>
