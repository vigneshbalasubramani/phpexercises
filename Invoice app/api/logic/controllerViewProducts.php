<?php
	include_once '../products/read.php';
	include_once '../products/read_one.php';
	include_once '../objects/product.php';

	session_start();
	if(!isset($_SESSION['userType'])) {
		header("Location: ../../index.php?invalidUser='true'");
	}
	$productName;
	$productQuantity;
	$productUnit;
	$productPrice;
	$jsonData;

	// function initializeVariables() {
		
	// }

	function viewProducts($jsonObject) {
		$json = json_decode($jsonObject, true);

		return dbReadProducts();
			// echo "success";
		// echo "failure";
	}

	function viewProduct($jsonObject) {
		$json = json_decode($jsonObject, true);

		return dbReadProduct($json['productId']);
			// echo "success";
		// echo "failure";
	}
	if(isset($_POST['viewProduct'])) {
		$jsonData = array();
		if(trim($_POST["productId"]) != null){
			$jsonData["productId"] = $_POST['productId'];
			$jsonObject = json_encode($jsonData);
			$jsonResponse = viewProduct($jsonObject);
			$jsonResponseData = json_decode($jsonResponse, true);
		}
		else {
			$jsonObject = json_encode($jsonData);
			$jsonResponse = viewProducts($jsonObject);
			$jsonResponseData = json_decode($jsonResponse, true);
			$jsonResponseData = $jsonResponseData['products'];
		}
		$productDetails = "<table><tr><th>Product Id</th><th>Product name</th><th>Product Quantity</th><th>Product Unit</th><th>Product Price</th></tr><tr>";
		for($count = 0; $count < count($jsonResponseData); $count++){
			$productDetails = $productDetails . "<tr>";
			foreach ($jsonResponseData[$count] as $key => $value) {
				$productDetails = $productDetails . "<td>" . $value . "</td>";
			}
			$productDetails = $productDetails . "</tr>";
		}
		$productDetails = $productDetails . "</table>";
		
		echo $productDetails;
		echo "<a href = '../../viewProducts.php'>Go Back</a>";	
	}
	else {
		$json = json_decode(file_get_contents("php://input"), true);
		$action = $json["task"];
		if(strcmp($action, "view") == 0){
			echo viewProduct(json_encode($json));
		}
		else {
			echo viewProducts(json_encode($json));
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