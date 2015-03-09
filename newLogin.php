<?php
session_start();
?>

<html>
<head>
	<title>Form</title>
</head>
<body>
	<h2>New User Login</h2>
	<form action="newUser.php" method="post">
	<label for="username">Username</label>
	<input type="text" name="username" id="username" /><br/>
	<label for="password">Password</label>
	<input type="text" name="password" id="password" /><br/>
	<input type="submit" value="Login"/>
</body>
</html>