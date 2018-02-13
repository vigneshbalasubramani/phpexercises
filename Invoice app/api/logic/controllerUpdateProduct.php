<?php
	if(!isset($_SESSION)){
		session_start();
	}	
	include_once '../products/update.php';
	include_once '../products/read_one.php';
	include_once '../products/read_specifics.php';
	include_once 'controllerAuthenticateUser.php';
	include_once '../products/response.php';
	include_once 'login.php';

	$jsonData;

	// function initializeVariables() {
		
	// }

	function updateProductPrice($jsonObject) {
		$json = json_decode($jsonObject, true);
		$productId = $json['productId'];
		$productPrice = $json['productPrice'];
		return dbUpdateProductPrice($productId, $productPrice);
			// echo "success";
		// echo "failure";
	}

	function updateProductQuantity($jsonObject) {
		$json = json_decode($jsonObject, true);
		$productId = $json['productId'];
		$productQuantity = $json['productQuantity'];
		return dbUpdateProductQuantity($productId, $productQuantity);
			// echo "success";
		// echo "failure";
	}

	function updateProduct($jsonObject) {
		$json = json_decode($jsonObject, true);
		if($json["productQuantity"] != null && $json["productPrice"] != null) {
			if(updateProductQuantity($jsonObject) && updateProductPrice($jsonObject)) {
				return 1;
			}
		}
		else if($json["productPrice"] != null && $json["productQuantity"] == null) {
			if(updateProductPrice($jsonObject)) {
				return 2;
			}
		}
		else if($json["productQuantity"] != null && $json["productPrice"] == null) {
			if(updateProductQuantity($jsonObject)) {
				return 3;
			}
		}
		return 0;
	}

	if(isset($_POST['updateProduct'])) {
		// $userId = $_POST['userId'];
		authenticateEmployee();
		$jsonData = array();
		$jsonData["task"] = "update";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["productId"] = $_POST['productId'];
		$jsonData["productQuantity"] = trim($_POST['productQuantity']);
		$jsonData["productPrice"] = trim($_POST['productPrice']);
		$jsonObject = json_encode($jsonData);
		$response = updateProduct($jsonObject);
		if($response == 0) {
			echo "your update request is invalid";
		}
		else if($response == 1) {
			echo "successfully updated price and quantity of " . readProductName($jsonData["productId"]) . " to " . $jsonData["productPrice"] . " and " . $jsonData["productQuantity"] . " respectively";
		}
		else if($response == 2) {
			echo "successfully updated price of " . readProductName($jsonData["productId"]) . " to " . $jsonData["productPrice"];
		}
		else {
			echo "successfully updated quantity of " . readProductName($jsonData["productId"]) . " to" . $jsonData["productQuantity"];
		}
		echo "<a href = '../../updateProduct.php'>Go Back</a>";
	}
	else {
		$json = file_get_contents("php://input");
		if(login($json) == null) {
			echo $jsonFailureResponse;
		}
		else {
			if(updateProduct($json) == 0) {
				echo $jsonFailureResponse;
			}
			else {
				echo $jsonSuccessResponse;
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