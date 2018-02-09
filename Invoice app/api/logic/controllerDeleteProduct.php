<?php
	include_once '../products/delete.php';
	include_once '../objects/product.php';
	include_once '../products/read_specifics.php';

	session_start();
	if(!isset($_SESSION['userType'])){
		header("Location: ../../index.php?invalidUser='true'");
	}
	$jsonData;

	// function initializeVariables() {
		
	// }

	function deleteProduct($jsonObject) {
		$json = json_decode($jsonObject, true);

		return dbDeleteProduct($json['productId']);
			// echo "success";
		// echo "failure";
	}

	if(isset($_POST['deleteProduct'])) {
		// $userId = $_POST['userId'];
		// initializeVariables();
		$jsonData = array();
		$jsonData["task"] = "delete";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["productId"] = $_POST['productId'];
		$jsonObject = json_encode($jsonData);
		$productName = readProductName($jsonData['productId']);
		if(deleteProduct($jsonObject)) {
			echo "successfully deleted " . $productName;
		}
		else{
			echo "product id " . $jsonData['productId'] . "does not exist";
		}
		echo "<br/><a href = '../../deleteProduct.php'>Go Back</a>";
	}
	else {
		$json = file_get_contents("php://input");

		if(deleteProduct($json)){

			$jsonResponse = array(
				"status" => "success"
			);
			echo json_encode($jsonResponse);
		}
		else {
			$jsonResponse = array(
				"status" => "failure"
			);
			echo json_encode($jsonResponse);
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