<?php
include "db_connection.php";
$conn = open_con();

$sql = "SELECT organizer_ID, Name FROM organizer_profile";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
  // echo $row['organizer_ID']. "<br>";
  if ($stmt2 = $conn->prepare('INSERT INTO accountso (organizer_ID,username,password) VALUES (?, ?, ?)')) {
    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
    $password = password_hash('1234', PASSWORD_DEFAULT);
    $stmt2->bind_param('sss', $row['organizer_ID'], $row['Name'], $password);
    $stmt2->execute();
  }
}
?>
