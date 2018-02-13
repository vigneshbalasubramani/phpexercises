<?php 
	session_start();
	if(!isset($_SESSION['userType'])) {
		header("Location: index.php?invalidUser='true'");
	}
	echo "Welcome " . $_SESSION["user"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>New product</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
		<ul>
			<?php
				if(strcmp($_SESSION['userType'], "admin") == 0) {
					echo "<li><a href = 'adminHomePage.php'>Home</a></li>
			<li><a href = 'api/logic/controllerViewUser.php?viewUsers=true'>View all users</a></li>";
				}
				?>
			<li><a href = "newProduct.php">Add a new Product</a></li>
			<li><a href = "viewProducts.php" class = 'active'>View all the products</a></li>
			<li><a href = "updateProduct.php">Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "orderProduct.php">Order products</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<h1>Enter the product ID to view it or view all products</h1>
	<form action = "api/logic/controllerViewProducts.php" method = "post">
		<label for = "productId">Product ID :</label>
		<input type = "text" name = "productId" id = "productId" placeholder = "numbers only" pattern = "[0-9]+"/>
		<br/>
		<input type = "submit" name = "viewProduct" value = "view Product"/>
	</form>
</body>
</html>