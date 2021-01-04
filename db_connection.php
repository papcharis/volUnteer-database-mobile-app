<?php

function open_con(){
  $conn = new mysqli("localhost", "root", "charis23101998", "mydb");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}

function close_con($conn){
  $conn->close();
}

?>
