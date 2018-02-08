<?php
	include_once '../products/read.php';
	include_once '../products/read_one.php';
	include_once '../objects/product.php';

	session_start();
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

	if(isset($_POST['viewAllProducts'])) {
		// $userId = $_POST['userId'];
		// initializeVariables();
		$jsonData = array();
		$jsonData["task"] = "viewAll";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonObject = json_encode($jsonData);
		$jsonResponse = json_decode(viewProducts($jsonObject), true);
		$jsonResponseData = $jsonResponse['products'];
		$userDetails = "<table><tr><th>Product Id</th><th>Product name</th><th>Product Quantity</th><th>Product Unit</th><th>Product Price</th></tr>";
		for($count = 0; $count < count($jsonResponseData); $count++){
			$userDetails = $userDetails . "<tr>";
			foreach ($jsonResponseData[$count] as $key => $value) {
				$userDetails = $userDetails . "<td>" . $value . "</td>";
			}
			$userDetails = $userDetails . "</tr>";
		}
		$userDetails = $userDetails . "</table>";
		
		echo $userDetails;
		echo "<a href = '../../viewProducts.php'>Go Back</a>";
	}
	else if(isset($_POST['viewProduct'])) {
		$jsonData = array();
		$jsonData["task"] = "view";
		$jsonData["target"] = "product";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["productId"] = $_POST['productId'];
		$jsonObject = json_encode($jsonData);
		$jsonResponseData = json_decode(viewProduct($jsonObject), true);
		$productDetails = "<table><tr><th>Product Id</th><th>Product name</th><th>Product Quantity</th><th>Product Unit</th><th>Product Price</th><th>Fetch status</th></tr><tr>";
		foreach ($jsonResponseData as $key => $value) {
			$productDetails = $productDetails . "<td>" . $value . "</td>";
		}
		$productDetails = $productDetails . "</tr>";
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