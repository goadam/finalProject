<?php

include 'storedInfo.php';
$username = "";
$password = "";
$db = new mysqli('oniddb.cws.oregonstate.edu', 'martinad-db', $myPassword, 'martinad-db');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

if(isset($_POST['username'])) {
	$username = $_POST['username'];
	if (!($result = $db->prepare("SELECT * FROM road_trip_db WHERE name=?"))) {
		echo "Prepare failed: (" . $db->errno . ") " . $db->error;
	}

	echo "$username";
	if (!$result->bind_param("s", $username)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$result->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	print_r($result);
	
	//$result->close();
	
}

if(isset($_POST['password'])) {
	$password = $_POST['password'];
}

if (!($InsStmt = $db->prepare("INSERT INTO road_trip_db(name, pw) VALUES (?, ?)"))) {
		echo "Prepare failed: (" . $db->errno . ") " . $db->error;
	}

	if (!$InsStmt->bind_param("ss", $username, $password)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}

	if (!$InsStmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	$InsStmt->close();

?>