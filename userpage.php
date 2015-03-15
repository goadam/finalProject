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
		<h2>Road Trip Select</h2>
		<form action="userpage.php" method="post">
		<label for="select">Please type the name of the roadtrip you want to view.</label>
		<input type="text" name="select" id="select" /><br/>
		<input type="submit" value="Select"/><br>
	</div>
</body>
</html>


<?php
session_start();
echo "this is". $_SESSION['user'];

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
			echo "<p>$destination</p>";
			echo "<br>";
		}
	}

?>