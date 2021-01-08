<!DOCTYPE html>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="register_style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="SHORTCUT ICON" HREF="./images/favicon.png">
</head>

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
		echo '<div class="logo-image" style="  position: absolute;
			width: 146px;
			height: 142px;
			left: 114px;
			top: 38px;">';
		echo  '<img src="./images/logo-login.png" alt="" />';
		echo '</div>';
		echo '<div class="logo" style="position: absolute;
		top: 205px;
		left: 50%;
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
		font-family: Baloo;
		text-decoration: none;
		font-style: normal;
		font-weight: normal;
		font-size: 42px;
		line-height: 76px;
		letter-spacing: -0.02em;
		color: #000000;">';
		echo 'Vol<mark>U</mark>nteer';
		echo '</div>';
		echo '<div class="error-message" style="position: absolute;
			width: 272px;
			height: 51px;
			left: 51px;
			top: 345px;
			font-family: Montserrat;
			font-style: normal;
			font-weight: 500;
			font-size: 20px;
			line-height: 29px;
			text-align: center;
			color: #000000;">';
		echo 'Username already exists, please choose another!';
		echo '</div>';
		echo '<script type="text/javascript">
		(function() {

			var preload = document.getElementById("preload");
			var loading = 0;
			var id = setInterval(frame, 64);

		 function frame() {
			 if (loading == 50) {
					 clearInterval(id);
					 window.open("./register-organizer.html", "_self");
				 }
				else {
				 loading = loading + 1;
			 }
		 }
	 })();
</script>';
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
