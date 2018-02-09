<?php
	session_start();
	echo "Welcome " . $_SESSION["user"];
	if(!isset($_SESSION['userType'])) {
		header("Location: index.php?invalidUser='true'");
	}
	else if(strcmp($_SESSION['userType'], "employee") == 0) {
		header("Location: index.php?invalidUser='true'");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin view users</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href = "adminHomePage.php">Home</a></li>
			<li><a href = "api/logic/controllerViewUser.php?viewUsers='true'" class = 'active'>View all users</a></li>
			<li><a href = "newProduct.php">Add a new Product</a></li>
			<li><a href = "viewProducts.php">View all the products</a></li>
			<li><a href = "updateProduct.php">Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<?php
		echo $_SESSION['userDetails'];
	?>
</body>
</html>