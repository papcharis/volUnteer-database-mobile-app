<!DOCTYPE html>
<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>volUnteer</title>
  <link rel="stylesheet" href="register_style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<?php
session_start();

// Try and connect using the info above.
include 'db_connection.php';
$conn = open_con();

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $conn->prepare('SELECT username,password FROM accountsv WHERE username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();


  if ($stmt->num_rows > 0) {
  	$stmt->bind_result($username, $password);
  	$stmt->fetch();
  	// Account exists, now we verify the password.
  	// Note: remember to use password_hash in your registration file to store the hashed passwords.
  	if (password_verify($_POST['password'], $password)) {
  		// Verification success! User has loggedin!
  		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
  		session_regenerate_id();
  		$_SESSION['loggedin'] = TRUE;
  		$_SESSION['username'] = $_POST['username'];
  		header('Location: volunteer.php');
  	} else {
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
				width: 255px;
				height: 51px;
				left: 59px;
				top: 345px;
				font-family: Montserrat;
				font-style: normal;
				font-weight: 500;
				font-size: 22px;
				line-height: 29px;
				text-align: center;
				color: #000000;">';
			echo 'Incorrect password!';
			echo '</div>';
			echo '<script type="text/javascript">
			(function() {

				var preload = document.getElementById("preload");
				var loading = 0;
				var id = setInterval(frame, 64);

			 function frame() {
				 if (loading == 40) {
						 clearInterval(id);
						 window.open("./login.html", "_self");
					 }
					else {
					 loading = loading + 1;
				 }
			 }
		 })();
 </script>';
  	}
  } else {
  	// Incorrect username
		if ($stmt2 = $conn->prepare('SELECT organizer_ID,username,password FROM accountso WHERE username = ?')) {
			// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
			$stmt2->bind_param('s', $_POST['username']);
			$stmt2->execute();
			// Store the result so we can check if the account exists in the database.
			$stmt2->store_result();
			if ($stmt2->num_rows > 0) {
				$stmt2->bind_result($organizerID, $username, $password);
				$stmt2->fetch();
				// Account exists, now we verify the password.
				// Note: remember to use password_hash in your registration file to store the hashed passwords.
				if (password_verify($_POST['password'], $password)) {
					// Verification success! User has loggedin!
					// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
					session_regenerate_id();
					$_SESSION['loggedin'] = TRUE;
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['organizer_ID'] = $organizerID;
					header('Location: organizer.php');
				} else {
					// Incorrect password
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
						width: 255px;
						height: 51px;
						left: 59px;
						top: 345px;
						font-family: Montserrat;
						font-style: normal;
						font-weight: 500;
						font-size: 22px;
						line-height: 29px;
						text-align: center;
						color: #000000;">';
					echo 'Incorrect password!';
					echo '</div>';
					echo '<script type="text/javascript">
					(function() {

						var preload = document.getElementById("preload");
						var loading = 0;
						var id = setInterval(frame, 64);

		 		   function frame() {
		 		     if (loading == 40) {
		 		         clearInterval(id);
		 		         window.open("./login.html", "_self");
		 		       }
		 		      else {
		 		       loading = loading + 1;
		 		     }
		 		   }
		 		 })();
     </script>';
				}
  	}
		else{
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
			echo "There is no volUnteer or organizer with this username!";
			echo '</div>';
			echo '<script type="text/javascript">
			(function() {

				var preload = document.getElementById("preload");
				var loading = 0;
				var id = setInterval(frame, 64);

			 function frame() {
				 if (loading == 50) {
						 clearInterval(id);
						 window.open("./login.html", "_self");
					 }
					else {
					 loading = loading + 1;
				 }
			 }
		 })();
 </script>';
		}
	}
}

	$stmt->close();
}

close_con($conn);
?>
