<?php
include "db_connection.php";
$conn = open_con();

$sql = "SELECT username,Email FROM volunteer_profile";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
  if ($stmt2 = $conn->prepare('INSERT INTO accountsV (username, password,email) VALUES (?, ?, ?)')) {
    // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
    $password = password_hash('1234', PASSWORD_DEFAULT);
    $stmt2->bind_param('sss', $row['username'], $password, $row['Email']);
    $stmt2->execute();
}}
?>
