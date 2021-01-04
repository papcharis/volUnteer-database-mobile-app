<?php
include 'db_connection.php';
session_start();

// $letter = mysqli_real_escape_string($link, $_REQUEST['motivationalLetter']);
$randomID  = str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT);
$va = $_GET["actid"];
$conn = open_con();
if (!isset($randomID, $_POST['motivationalLetter'], $_SESSION['username'], $va)) {
	// Could not get the data that should have been sent.
	exit('Data not received, try again');
}
if($stmt2 = $conn->prepare('INSERT INTO applies (applicationID, motivationalLetter, Volunteer_Username,Activity_ID) VALUES (?, ?, ?, ?)')){
  $stmt2->bind_param('ssss', $randomID, $_POST['motivationalLetter'], $_SESSION['username'], $va);
  $stmt2->execute();
}
else{
  echo 'Could not prepare statement 1.5';
}
header('Location: eventschedule.php');

$conn->close();
?>
