<?php
include 'db_connection.php';

$conn = open_con();

// $letter = mysqli_real_escape_string($link, $_REQUEST['ReviewTextBox']);
$randomID  = str_pad(mt_rand(1,9999999),7,'0',STR_PAD_LEFT);
$actID = $_GET["ActID"];

if (!isset($actID, $_POST['Name'], $_POST['Age'], $_POST['Title'], $randomID)) {
	// Could not get the data that should have been sent.
	exit('Data not received, try again');
}
if($stmt2 = $conn->prepare('INSERT INTO staff (Staff_ID, Title, Age, Name, Activity_ID) VALUES (?, ?, ?, ?, ?)')){
  $stmt2->bind_param('sssss', $randomID, $_POST['Title'], $_POST['Age'], $_POST['Name'], $actID);
  $stmt2->execute();
}
else{
  echo 'Could not prepare statement 1.5';
}
header('Location: ./organizer-myevents.php');

$conn = open_con();
?>
