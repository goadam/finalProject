<?php
session_start();
header("Location: http://web.engr.oregonstate.edu/~martinad/final/userpage.php");
include "storedInfo.php";
$mysqli = new mysqli('oniddb.cws.oregonstate.edu', 'martinad-db', $myPassword, 'martinad-db');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$zero = 0;
	/* create a prepared statement */
	if ($stmt = $mysqli->prepare("UPDATE road_trip_db SET share=? WHERE end=?")) {
		
		/* bind parameters for markers */
		$stmt->bind_param("is", $zero, $_SESSION['sel']);

		/* execute query */
		$stmt->execute();

	}
?>