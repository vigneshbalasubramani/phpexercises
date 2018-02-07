<?php
		session_start();
		$num1;
		$num2;
		if(isset($num1)){
		}
		else{
			$_SESSION['number1'] = rand(0, 20);
			$num1 = $_SESSION['number1'];
		}
		if(isset($num2)){
			echo "new";
		}
		else{
			$_SESSION['number2'] = rand(0, 20); 
			$num2 = $_SESSION['number2'];
		}
	?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login or Signup</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Welcome to our login page</h1>
	<form method = "post" action = "welcomeuser.php">
		<table>
			<tbody>
				<tr>
					<td><label for = "name">Register Number:</label></td>
					<td><input type = "text" name = "name" id = "name" pattern = "[0-9]{12}" title = "12 digits only" required/></td>
				</tr>
				<tr>
					<td><label for = "dob">Date of birth:</label></td>
					<td><input type = "date" name = "dob" id = "dob" required/></td>
				</tr>
				<tr>
					<td><input type = "text" name = "number1" id = "number1" value = '<?= $_SESSION['number1'] ?>' disabled/></td>
					<td>
						<label>+</label>
					</td>
					<td><input type = "text" name = "number2" id = "number2" value = '<?= $_SESSION['number2'] ?>' disabled/></td>
				</tr>
				<tr>
					<td><label for = "sum">Sum :</label></td>
					<td><input type = "number" name = "sum" id = "sum" required/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type = "submit" name = "submit" value = "login"/></td>
				</tr>
			</tbody>
		</table>
	</form>
	<p>New user? Signup here</p>
	<a href = "signup.html">Sign up</a>
</body>
</html>