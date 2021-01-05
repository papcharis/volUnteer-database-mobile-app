<?php
include 'db_connection.php';
session_start();
$conn = open_con();

// $letter = mysqli_real_escape_string($link, $_REQUEST['ReviewTextBox']);
$randomID  = str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT);
$va = $_GET["actid"];
$sql2 = "SELECT Organizer_ID FROM voluntary_activity WHERE Activity_ID='$va'";
$act_result = $conn->query($sql2);
$record = $act_result->fetch_row();

$conn = open_con();
if (!isset($randomID, $_POST['ReviewTextBox'], $_SESSION['username'], $va)) {
	// Could not get the data that should have been sent.
	exit('Data not received, try again');
}
if($stmt2 = $conn->prepare('INSERT INTO reviews (Review_ID, Rating, Text, Volunteer_Username, Organization_ID) VALUES (?, ?, ?, ?, ?)')){
  $stmt2->bind_param('sssss', $randomID, $_POST['Rating'], $_POST['ReviewTextBox'], $_SESSION['username'], $record[0]);
  $stmt2->execute();
}
else{
  echo 'Could not prepare statement 1.5';
}
header('Location: ./myevents-completed.php');

$conn->close();
?>
