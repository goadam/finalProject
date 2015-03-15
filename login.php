
<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
</head>
<body>
	<h2>Returning User Login</h2>
	<form action="login.php" method="post">
	<label for="username">Username</label>
	<input type="text" name="username" id="username" /><br/>
	<label for="password">Password</label>
	<input type="text" name="password" id="password" /><br/>
	<input type="submit" value="Login"/><br>
	Click
	<a href ="newLogin.php">here</a>
	for new user.
</body>
</html>


<?php
session_start();
include "storedInfo.php";

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'martinad-db', $myPassword, 'martinad-db');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$username = "";
$password = "";

if(isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	echo "$username";
	/* create a prepared statement */
	if ($stmt = $mysqli->prepare("SELECT name FROM road_trip_db WHERE name=?")) {
		
		/* bind parameters for markers */
		$stmt->bind_param("s", $username);

		/* execute query */
		$stmt->execute();
		
		 /* bind result variables */
		$stmt->bind_result($name);

		/* fetch value */
		$stmt->fetch();
		
		$stmt->close();
		
		echo "name = $name";
		echo "password = $password";
		
		if($username == "") {
			echo 'Please enter a username.';
		} elseif ($name == $username){
			
			if(isset($_POST['password'])) {
				echo "1";
				$password = $_POST['password'];
				if($password == "") {
					echo "Please enter a password";
				} else {
					echo "2";
					$stmt2 = $mysqli->prepare("SELECT pw FROM road_trip_db WHERE name=?");
					echo "3 $username";
					/* bind parameters for markers */
					$stmt2->bind_param("s", $username);
					echo "4";
					/* execute query */
					$stmt2->execute();
					echo "5";
					/* bind result variables */
					$stmt2->bind_result($dbpassword);
					
					/* fetch value */
					$stmt2->fetch();
					echo "dbPass = $dbpassword";
					if($password == $dbpassword) {
						echo "END";
						$_SESSION['user'] = $username;
						
						$stmt2->close();
						echo '<script> window.location="http://web.engr.oregonstate.edu/~martinad/final/userpage.php"</script>';
					}
				}
			}
		}
	}
}

/* close connection */
$mysqli->close();

?>