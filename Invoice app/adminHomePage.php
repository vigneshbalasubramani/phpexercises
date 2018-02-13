<?php 
	session_start();
	echo "Welcome " . $_SESSION["user"];
	if(!isset($_SESSION['userType'])) {
		header("Location: index.php?invalidUser='true'");
	}
	else if(strcmp($_SESSION['userType'], "admin") != 0) {
		header("Location: index.php?invalidUser='true'");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Admin home page</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href = "adminHomePage.php" class = 'active'>Home</a></li>
			<li><a href = "api/logic/controllerViewUser.php?viewUsers='true'">View all users</a></li>
			<li><a href = "newProduct.php">Add a new Product</a></li>
			<li><a href = "viewProducts.php">View all the products</a></li>
			<li><a href = "updateProduct.php">Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "orderProduct.php">Order products</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<h1>Create a new user here</h1>
	<form action = "api/logic/controllerNewUser.php" method = "post">
		<label for = "username">User Name :</label>
		<input type = "text" name = "username" id = "username" placeholder = "alphabets only" pattern = "[a-z A-Z]+" required/>
		<br/>
		<label for = "password">Password :</label>
		<input type = "text" name = "password" id = "password" placeholder = "atleast 6 characters" minlength = "6" required/>
		<br/>
		<label>User Type :</label>
		<select name = "userType">
			<option value = "admin">admin</option>
			<option value = "employee">employee</option>
			<option value = "customer">customer</option>
		</select><br/>
		<input type = "submit" name = "addUser" value = "add new user"/>
	</form>
</body>
</html>