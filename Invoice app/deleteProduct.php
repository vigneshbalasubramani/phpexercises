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
					<li><a href = 'adminViewUser.php'>View all users</a></li>";
				}
				?>
			<li><a href = "newProduct.php">Add a new Product</a></li>
			<li><a href = "viewProducts.php">View all the products</a></li>
			<li><a href = "updateProduct.php">Update products</a></li>
			<li><a href = "deleteProduct.php" class = 'active'>Delete product</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<h1>Enter the product ID to delete it</h1>
	<form action = "api/logic/controllerDeleteProduct.php" method = "post">
		<label for = "productId">Product Id :</label>
		<input type = "text" name = "productId" id = "productId" placeholder = "numbers" pattern = "[0-9]+" required/>
		<br/>
		<input type = "submit" name = "deleteProduct" value = "delete the product"/>
	</form>
</body>
</html>