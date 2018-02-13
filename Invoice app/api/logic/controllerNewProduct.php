<?php
	include_once '../products/create.php';
	include_once '../objects/product.php';
	include_once 'controllerAuthenticateUser.php';
	include_once '../products/response.php';
	include_once 'login.php';

	if(!isset($_SESSION)){
		session_start();
	}	
	
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
		
		return dbInsertProduct($product);
	}

	if(isset($_POST['addProduct'])) {
		$productName = $_POST['productName'];
		$productQuantity = $_POST['productQuantity'];
		$productUnit = $_POST['productUnit'];
		$productPrice = $_POST['productPrice'];
		authenticateEmployee();
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
		if(addProduct($jsonObject)) {
			echo "successfully inserted<br/>";
		}
		else{
			echo "cannot be inserted<br/>";
		}
		echo "<a href = '../../newProduct.php'>Go Back</a>";

	}
	else {
		$json = file_get_contents("php://input");
		if(login($json) == null) {
			echo $jsonFailureResponse;
		}
		else {
			if(addProduct($json)) {
				echo $jsonSuccessResponse;
			}
			else {
				echo $jsonFailureResponse;
			}
		}
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