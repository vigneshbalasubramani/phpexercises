<?php
	if(isset($_GET['invalidCredentials'])){
		echo "invalid Credentials. Please try again";
	}
	if(isset($_GET['invalidUser'])) {
		echo "login first to proceed";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Login page</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Login to proceed</h1>
	<form action="api/logic/login.php" method="post" class = "form">
		<label for = "username">Username :</label>
		<input type="text" name="username" id="username" placeholder="alphabets only" pattern = "[a-z A-Z]+" required><br>
		<label for = "password">Password :</label>
		<input type = "password" name = "password" id = "password" placeholder="minimum 6 characters" minlength="6" required><br>
		<input type = "submit" name = "login" value="login">
	</form>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<!-- <script src = "jsonConverter.js"></script> -->
</body>
</html>