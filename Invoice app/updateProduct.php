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
			<li><a href = "viewProducts.php">View all the products</a></li>
			<li><a href = "updateProduct.php" class = 'active'>Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<h1>Enter the product ID here to update</h1>
	<form action = "api/logic/controllerUpdateProduct.php" method = "post">
		<label for = "productId">Product Id :</label>
		<input type = "text" name = "productId" id = "productId" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<label for = "productQuantity">Product Quantity :</label>
		<input type = "text" name = "productQuantity" id = "productQuantity" placeholder = "numbers only" pattern = "[0-9]+"/>
		<br/>
		<label for = "productPrice">Product Price :</label>
		<input type = "text" name = "productPrice" id = "productPrice" placeholder = "numbers only" pattern = "[0-9]+"/>
		<br/>
		<input type = "submit" name = "updateProduct" value = "update product"/>
	</form>
</body>
</html>