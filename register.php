<?php
// Change this to your connection info.
include 'db_connection.php';
$con = open_con();

// We check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Data not received, try again');
}


// Make sure the submitted registration values are not empty.
if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// One or more values are empty.
	exit('Please complete all the required info.');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT * FROM accounts WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Username exists, please choose another!';
	}
    else {
          // Username doesnt exists, insert new account
      if ($stmt = $con->prepare('INSERT INTO accounts (username, password,email) VALUES (?, ?, ?)')) {
        // We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
        $stmt->execute();

      if($stmt2 = $con->prepare('INSERT INTO volunteer_profile (First_Name,Last_Name,username,Email,City,Street,Zipcode,Age,Sex,Phone,ShortBio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')){
        $stmt2->bind_param('sssssssssss', $_POST['first_name'], $_POST['last_name'], $_POST['username'], $_POST['email']
        , $_POST['city'], $_POST['address'], $_POST['zipcode'], $_POST['age'], $_POST['sex'], $_POST['phone'], $_POST['bio']);
        $stmt2->execute();
      }
      else{
        echo 'Could not prepare statement 1.5';
      }

      header('Location: index.php');
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
