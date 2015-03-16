
<html>
<head>
    <meta charset="UTF-8">
	<title>Road Trip Planner</title>
	<link href="tripSelected.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="wrap">
		<header>
			<h1>Road Trip Planner</h1> 
		</header>
		<h2>View a Shared Road Trip</h2>
		<br>
		<form action="viewOther.php" method="post">
		<label for="username">What is the username of the person's trip you wish to view?</label>
		<input type="text" name="username" id="username" /><br/>
		<input type="submit" value="Find"/><br>
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

if(isset($_POST['username'])) {
	$username = $_POST['username'];

	echo "<p>$username Shared Trip</p>";
	$one = 1;
	/* create a prepared statement */
	if ($stmt = $mysqli->prepare("SELECT start, end, miles, stop1, stop2, stop3, stop4, total FROM road_trip_db WHERE name=? AND share =?")) {
		
		/* bind parameters for markers */
		$stmt->bind_param("si", $username, $one);

		/* execute query */
		$stmt->execute();
		
		 /* bind result variables */
		$stmt->bind_result($st, $en, $mil, $s1, $s2, $s3, $s4, $total);

		/* fetch value */
		if($stmt->fetch()) {
		
			echo "
			<p>
			Begin = $st
			<br>
			End = $en
			<br>
			Miles = $mil
			<br>
			Stop 1 = $s1
			<br>
			Stop 2 = $s2
			<br>
			Stop 3 = $s3
			<br>
			Stop 4 = $s4
			<br>
			Total = $total
			<br>
			</p>
			";
		}
		
	}
}
		
	
			






?>