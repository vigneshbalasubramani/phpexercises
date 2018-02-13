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
			<li><a href = "newProduct.php" class = 'active'>Add a new Product</a></li>
			<li><a href = "viewProducts.php">View all the products</a></li>
			<li><a href = "updateProduct.php">Update products</a></li>
			<li><a href = "deleteProduct.php">Delete product</a></li>
			<li><a href = "orderProduct.php">Order products</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<h1>Create a new product here</h1>
	<form action = "api/logic/controllerNewProduct.php" method = "post">
		<label for = "productName">Product Name :</label>
		<input type = "text" name = "productName" id = "productName" placeholder = "alphabets only" pattern = "[a-z A-Z]+" required/>
		<br/>
		<label for = "productQuantity">Product Quantity :</label>
		<input type = "text" name = "productQuantity" id = "productQuantity" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<label for = "productUnit">Product Unit :</label>
		<input type = "text" name = "productUnit" id = "productUnit" placeholder = "alphabets only" pattern = "[a-z A-Z]+" required/>
		<br/>
		<label for = "productPrice">Product Price :</label>
		<input type = "text" name = "productPrice" id = "productPrice" placeholder = "numbers only" pattern = "[0-9]+" required/>
		<br/>
		<input type = "submit" name = "addProduct" value = "add new product"/>
	</form>
</body>
</html>