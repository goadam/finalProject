<?php
session_start();
?>

<html>
<head>
	<title>Form</title>
</head>
<body>
	<h2>Returning User Login</h2>
	<form action="newUser.php" method="post">
	<label for="username">Username</label>
	<input type="text" name="username" id="username" /><br/>
	<label for="password">Password</label>
	<input type="text" name="username" id="password" /><br/>
	<input type="submit" value="Login"/><br>
	Click
	<a href ="newLogin.php">here</a>
	for new user.
</body>
</html>