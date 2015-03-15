<?php
session_start();
?>

<html>
<head>
    <meta charset="UTF-8">
	<title>Road Trip Planner</title>
	<link href="roadTrip.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrap">
			<header>
				<h1>My Road Trip Planner</h1> 
			</header>
			<main id="mainContent">
				<br>
				<br>
				<form action="newTrip.php" method="post">
				<label for="Start">Start</label>
				<input type="text" name="start" id="start" /><br/>
				<label for="end">Destination</label>
				<input type="text" name="end" id="end" /><br/>
				<label for="miles">Distance in miles</label>
				<input type="text" name="miles" id="miles" /><br/>
				<label for="stop1">Stop1</label>
				<input type="text" name="stop1" id="stop1" /><br/>
				<label for="stop2">stop2</label>
				<input type="text" name="stop2" id="stop2" /><br/>
				<label for="stop3">Stop3</label>
				<input type="text" name="stop3" id="stop3" /><br/>
				<label for="stop4">Stop4</label>
				<input type="text" name="stop4" id="stop4" /><br/>
				<label for="total">Estimated Cost</label>
				<input type="text" name="total" id="total" /><br/>
				<input type="submit" value="submit"/><br>
			</main>
	</div>
</body>
</html>


<?php

session_start();
include "storedInfo.php";

$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'martinad-db', $myPassword, 'martinad-db');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

	$start = $_POST['start'];
	$end = $_POST['end'];
	$miles = $_POST['miles'];
	$s1 = $_POST['stop1'];
	$s2 = $_POST['stop2'];
	$s3 = $_POST['stop3'];
	$s4 = $_POST['stop4'];
	$total = $_POST['total'];
	
	$username = $_SESSION['user'];
	$password = $_SESSION['pass'];
	
	echo "newTrip username = $username";
/* create a prepared statement */
if((isset($_POST['start'])) && (isset($_POST['end']))) {
	
	if ($stmt = $mysqli->prepare("INSERT INTO road_trip_db (pw, name, start, end, miles, stop1, stop2, stop3, stop4, total) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
		/* bind parameters for markers */
		$stmt->bind_param("ssssissssi", $password, $username, $start, $end, $miles, $s1, $s2, $s3, $s4, $total);

		/* execute query */
		$stmt->execute();

		$stmt->close();
		echo '<script> window.location="http://web.engr.oregonstate.edu/~martinad/final/userpage.php"</script>';
	}
}
/* close connection */
$mysqli->close();
?>