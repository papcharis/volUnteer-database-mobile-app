<?php
// Change this to your connection info.
include 'db_connection.php';
$con = open_con();

// We check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['organizer_name'], $_POST['type'], $_POST['username'], $_POST['password'])) {
	// Could not get the data that should have been sent.
	exit('Data not received, try again');
}

if (empty($_POST['organizer_name']) || empty($_POST['type']) || empty($_POST['username']) || empty($_POST['password'])) {
	// One or more values are empty.
	exit('Please complete all the required info.');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT username FROM accountsv WHERE username = ? UNION SELECT username FROM accountso WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('ss', $_POST['username'], $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Usersname already exists, please choose another!';
	}
    else {

          // Username doesnt exists, insert new account
      if ($stmt2 = $con->prepare('INSERT INTO accountso (organizer_ID, username, password) VALUES (?, ?, ?)')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$organizerID = str_pad(mt_rand(1,99999),5,'0',STR_PAD_LEFT);
        $stmt2->bind_param('sss', $organizerID, $_POST['username'], $password);
        $stmt2->execute();

      if($stmt3 = $con->prepare('INSERT INTO organizer_profile (organizer_ID, Name, Type, City, Street, ZipCode) VALUES (?, ?, ?, ?, ?, ?)')){
        $stmt3->bind_param('isssss', $organizerID, $_POST['organizer_name'], $_POST['type'],
				$_POST['city'], $_POST['address'], $_POST['zipcode']);
        $stmt3->execute();
      }
      else{
        header('register-organizer.html');
      }

      header('Location: login.html');
      } else {
      // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
      echo 'Could not prepare statement! 1';
      }
	}
	$stmt->close();
}
else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement! 2';
}
$con->close();
?>
