
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form</title>
	<meta charset="UTF-8">
</head>
<body>
	<h2>New User Login</h2>
	<form action="newLogin.php" method="post">
	<label for="username">Username</label>
	<input type="text" id="username" name="username" /><br/>
	<label for="password">Password</label>
	<input type="text" name="password" id="password" /><br/>
	<input type="submit" value="Login"/>
	<br>
	</script>
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
		
		if($username == "") {
			echo 'Please enter a username.';
		} elseif ($name == $username){
			echo 'Username already taken.';
		} else {
			if(isset($_POST['password'])) {
				$password = $_POST['password'];
				if($password == "") {
					echo "Please enter a password";
				} elseif (strlen($password) < 6) {
					echo "Password must be 6 characters long.";
				} else {
					$stmt = $mysqli->prepare("INSERT INTO road_trip_db (pw, name) VALUES (?,?)");
			
					/* bind parameters for markers */
					$stmt->bind_param("ss", $password, $username);
			
					/* execute query */
					$stmt->execute();
					$_SESSION['user'] = $username;
					$_SESSION['pass'] = $password;
					echo '<script> window.location="http://web.engr.oregonstate.edu/~martinad/final/userpage.php"</script>';
				}
			}
		}
		
		/* close statement */
		$stmt->close();
	}
}

/* close connection */
$mysqli->close();

?>
