<?php
	include '../products/read_one.php';
	session_start();
	if(isset($_POST['login'])) {
		$userType = dbAuthenticateUser($_POST['username'], $_POST['password']); 
		if($userType == null) {
			echo "invalid credentials<br/>";
		}
		else if($userType == "admin"){
			$_SESSION['user'] = $_POST['username'];
			$_SESSION['userType'] = $userType;
			header("Location: ../../adminHomePage.php");
		}
		else {
			$_SESSION['user'] = $_POST['username'];
			$_SESSION['userType'] = $userType;
			header("Location: ../../newProduct.php");
		}
	}
	// }
	// 	if(isset($_POST['login'])) {
	// 		echo $_POST['data'];
	// 	}

	// 	echo $_POST['data'];
	// echo "hello";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login page</title>
	<link rel="stylesheet" href="../../style.css">
</head>
<body>
	<h1>Login to proceed</h1>
	<form action="login.php" method="post" class = "form">
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