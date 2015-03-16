
<!DOCTYPE html>
<html>
<head>
	<title>Road Trip Planner</title>
	<link href="login.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrap">
		<header>
				<h1>My Road Trip Planner</h1> 
		</header>
		<h2>Returning User Login</h2>
		<form action="login.php" method="post">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" /><br/>
		<label for="password">Password</label>
		<input type="password" name="password" id="password" /><br/>
		<input type="submit" value="Login"/><br>
		<br>
		Click
		<a href ="newLogin.php">here</a>
		for new user.
		<br>
</body>
</html>


<?php
session_start();
include "storedInfo.php";

if(!isset($_SESSION['logged_in'])) {
		$_SESSION['logged_in'] = 0;	
	}

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'martinad-db', $myPassword, 'martinad-db');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$username = "";
$password = "";

if(isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
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
		
		if($username == "") {
			echo 'Please enter a username.';
		} elseif ($name == $username){
			
			if(isset($_POST['password'])) {
				$password = $_POST['password'];
				
				if($password == "") {
					echo "Please enter a password";
				} else {
					$stmt2 = $mysqli->prepare("SELECT pw FROM road_trip_db WHERE name=?");
		
					/* bind parameters for markers */
					$stmt2->bind_param("s", $username);
					
					/* execute query */
					$stmt2->execute();
					
					/* bind result variables */
					$stmt2->bind_result($dbpassword);
					
					/* fetch value */
					$stmt2->fetch();
					
					if($password == $dbpassword) {
						$_SESSION['user'] = $username;
						$_SESSION['pass'] = $password;
						$stmt2->close();
					
						$_SESSION['logged_in'] = 1;	
	
						echo '<script> window.location="http://web.engr.oregonstate.edu/~martinad/final/userpage.php"</script>';
					} else {
						echo "Password is incorrect.";
					}
				}
			}
		} else {
			echo "username not found.";
		}
	}
}

/* close connection */
$mysqli->close();

?>