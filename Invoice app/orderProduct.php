<?php
	session_start();
	echo "Welcome " . $_SESSION["user"];
	if(!isset($_SESSION['userType'])) {
		header("Location: index.php?invalidUser='true'");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<meta http-equiv = "X-UA-Compatible" content = "IE=edge">
	<meta name = "viewport" content = "width=device-width,initial-scale=1.0">
	<title>Order your products</title>
	<link rel = "stylesheet" href = "style.css">
	<link rel = "stylesheet" href = "orderPageStyle.css">
</head>
<body>
	<nav>
		<ul>
			<?php
				if(strcmp($_SESSION['userType'], "admin") == 0) {
					echo "<li><a href = 'adminHomePage.php'>Home</a></li>
					<li><a href = 'adminViewUser.php'>View all users</a></li>
					<li><a href = 'newProduct.php'>Add a new Product</a></li>
					<li><a href = 'viewProducts.php'>View all the products</a></li>
					<li><a href = 'updateProduct.php'>Update products</a></li>
					<li><a href = 'deleteProduct.php'>Delete product</a></li>";
				}
				else if(strcmp($_SESSION['userType'], "employee") == 0) {
					echo "<li><a href = 'newProduct.php'>Add a new Product</a></li>
					<li><a href = 'viewProducts.php'>View all the products</a></li>
					<li><a href = 'updateProduct.php'>Update products</a></li>
					<li><a href = 'deleteProduct.php'>Delete product</a></li>";
				}
			?>
			<li><a href = "orderProduct.php" class = "active">Order products</a></li>
			<li><a href = "api/logic/logout.php">Logout</a></li>
		</ul>
	</nav>
	<?php
		if(!isset($_SESSION['orderPage'])) {
			header("Location: api/logic/controllerOrderProducts.php?viewAllProducts='true'");
		}
		echo "<form method = 'post' action = 'api/logic/controllerOrderProducts.php'>";
		echo $_SESSION['orderPage'];
		echo "<br/>";
		echo "<input type = 'submit' name = 'orderProducts' value = 'confirmOrder'/></form>";
		$_SESSION['orderPage'] = null;
	?>
</body>
</html>