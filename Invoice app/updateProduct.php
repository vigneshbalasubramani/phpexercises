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
			<li><a href = "viewProducts.php">View all the products</a></li>
			<li><a href = "updateProduct.php" class = "active">Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<form action = "api/logic/controllerUpdateProduct.php" method = "post">
		<label for = "productId">Product Id :</label>
		<input type = "text" name = "productId" id = "productId" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<label for = "productQuantity">Product Quantity :</label>
		<input type = "text" name = "productQuantity" id = "productQuantity" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<input type = "submit" name = "updateProductQuantity" value = "update product quantity"/>
	</form>
	<form action = "api/logic/controllerUpdateProduct.php" method = "post">
		<label for = "productId">Product Id :</label>
		<input type = "text" name = "productId" id = "productId" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<label for = "productPrice">Product Price :</label>
		<input type = "text" name = "productPrice" id = "productPrice" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<input type = "submit" name = "updateProductPrice" value = "update product price"/>
	</form>
</body>
</html>