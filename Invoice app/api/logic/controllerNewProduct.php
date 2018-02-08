<?php
	include_once '../products/create.php';
	include_once '../objects/product.php';

	session_start();
	$productName;
	$productQuantity;
	$productUnit;
	$productPrice;

	// function initializeVariables() {
		
	// }

	function addProduct($jsonObject) {
		$json = json_decode($jsonObject, true);
		$product = new Product();
		$product -> setProductName($json["data"]["productName"]);
		$product -> setProductQuantity($json["data"]["productQuantity"]);
		$product -> setProductUnit($json["data"]["productUnit"]);
		$product -> setProductPrice($json["data"]["productPrice"]);
		if(dbInsertProduct($product)) {
			echo "successfully inserted<br/>";
			echo "<a href = '../../newProduct.php'>Go Back</a>";
		}
		// echo "failure";
	}

	if(isset($_POST['addProduct'])) {
		$productName = $_POST['productName'];
		$productQuantity = $_POST['productQuantity'];
		$productUnit = $_POST['productUnit'];
		$productPrice = $_POST['productPrice'];
		// initializeVariables();
		$jsonData = array();
		$jsonData["task"] = "add";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["data"] = array(
			"productName" => $productName,
			"productQuantity" => $productQuantity,
			"productUnit" => $productUnit,
			"productPrice" => $productPrice
		);
		$jsonObject = json_encode($jsonData);
		addProduct($jsonObject);
	}
	else {
		$json = json_decode(file_get_contents("php://input"), true);
		$product = new Product();
		$product -> setProductName($json["data"]["productName"]);
		$product -> setProductQuantity($json["data"]["productQuantity"]);
		$product -> setProductUnit($json["data"]["productUnit"]);
		$product -> setProductPrice($json["data"]["productPrice"]);
		if(dbInsertProduct($product)) {
			$jsonResponse = array(
				"status" => "success"
			);
		}
		else {
			$jsonResponse = array(
				"status" => "failure"
			);
		}
		echo json_encode($jsonResponse);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login page</title>
	<link rel="stylesheet" href="../../style.css">
</head>
</html>