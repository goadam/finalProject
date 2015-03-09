<?php
session_start();
	if(!isset($_SESSION['visits'])) {
		$_SESSION['visits'] = 0;
	}
	
	if(!isset($_SESSION['logged_in'])) {
		$_SESSION['logged_in'] = 0;	
	}
	echo 'dsfasf';
	if($_SESSION['logged_in'] == 0){
		echo '<script> window.location="http://web.engr.oregonstate.edu/~martinad/final/login.php"</script>';
	}
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
				<h2></h2>
			</main>
	</div>
</body>
</html>