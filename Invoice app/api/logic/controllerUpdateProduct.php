<?php
	include_once '../products/update.php';

	session_start();
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

	if(isset($_POST['updateProductQuantity'])) {
		// $userId = $_POST['userId'];
		// initializeVariables();
		$jsonData = array();
		$jsonData["task"] = "updateQuantity";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["productId"] = $_POST['productId'];
		$jsonData["productQuantity"] = $_POST['productQuantity'];
		$jsonObject = json_encode($jsonData);
		if(updateProductQuantity($jsonObject)) {
			echo "successfully updated product quantity to " . $jsonData["productQuantity"];
		}
		else {
			echo "cannot update product quantity to " . $jsonData["productQuantity"];
		}
		echo "<a href = '../../updateProduct.php'>Go Back</a>";
	}
	else if(isset($_POST['updateProductPrice'])) {
		// $userId = $_POST['userId'];
		// initializeVariables();
		$jsonData = array();
		$jsonData["task"] = "updatePrice";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["productId"] = $_POST['productId'];
		$jsonData["productPrice"] = $_POST['productPrice'];
		$jsonObject = json_encode($jsonData);
		if(updateProductPrice($jsonObject)) {
			echo "successfully updated product price to " . $jsonData["productPrice"];
		}
		else {
			echo "cannot update product price to " . $jsonData["productPrice"];
		}
		echo "<a href = '../../updateProduct.php'>Go Back</a>";
	}
	else {
		$json = json_decode(file_get_contents("php://input"), true);
		$productId = $json['productId'];
		$productPrice = $json['productPrice'];
		$action = $json["task"];
		$jsonSuccessResponse = array(
			"status" => "success"
		);
		$jsonFailureResponse = array(
			"status" => "failure"
		);
		if(strcmp($action, "updatePrice") == 0){
			if(dbUpdateProductPrice($productId, $productPrice)) {
				echo json_encode($jsonSuccessResponse);
			}
			else {
				echo json_encode($jsonFailureResponse);
			}
		}
		else {
			if(dbUpdateProductQuantity($productId, $productQuantity)) {
				echo json_encode($jsonSuccessResponse);
			}
			else{
				echo json_encode($jsonFailureResponse);
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