<?php 
	session_start();
	echo "Welcome " . $_SESSION["user"];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>New product</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<nav>
		<ul>
			<li><a href = "newProduct.php">Add a new Product</a></li>
			<li><a href = "viewProducts.php" class = "active">View all the products</a></li>
			<li><a href = "updateProduct.php">Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<form action = "api/logic/controllerViewProducts.php" method = "post">
		<label for = "productId">Product ID :</label>
		<input type = "text" name = "productId" id = "productId" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<input type = "submit" name = "viewProduct" value = "view Product"/>
	</form>
	<form action = "api/logic/controllerViewProducts.php" method = "post">
		<input type = "submit" name = "viewAllProducts" value = "view All Products"/>
	</form>
</body>
</html>