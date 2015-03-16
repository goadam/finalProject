<html>
<head>
    <meta charset="UTF-8">
	<title>Road Trip Planner</title>
	<link href="userpage.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrap">
		<header>
			<h1>My Road Trip Planner</h1> 
		</header>
		<h2>Road Trip Select</h2>
		<form action="tripSelected.php" method="post">
		<label for="selected">Please type the name of the roadtrip you want to view.</label>
		<input type="text" name="selected" id="selected" /><br/>
		<input type="submit" value="Select"/><br>
		<br>
		Or click
		<a href ="newTrip.php">here</a>
		for new trip.
		<br>
		Click
		<a href ="viewOther.php">here</a>
		to view another user's trip.
		<br>
		Click
		<a href ="logout.php">here</a>
		to logout.
	</div>
</body>
</html>


<?php
session_start();
include "storedInfo.php";

if(!isset($_SESSION['logged_in'])) {
		$_SESSION['logged_in'] = 0;	
}
	
if($_SESSION['logged_in'] == 0) {
			echo '<script> window.location="http://web.engr.oregonstate.edu/~martinad/final/roadTrip.html"</script>';
	}
	
$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'martinad-db', $myPassword, 'martinad-db');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$username = $_SESSION['user'];
	
	/* create a prepared statement */
	if ($stmt = $mysqli->prepare("SELECT end FROM road_trip_db WHERE name=?")) {
		
		/* bind parameters for markers */
		$stmt->bind_param("s", $username);

		/* execute query */
		$stmt->execute();
		
		 /* bind result variables */
		$stmt->bind_result($destination);

		/* fetch value */
		while($stmt->fetch()) {
			if($destination != "")
				echo "<li>$destination</li>";
		}
	}

?>