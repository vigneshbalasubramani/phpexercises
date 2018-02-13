<?php
	include_once '../products/read.php';
	include_once 'controllerAuthenticateUser.php';
	include_once '../products/response.php';
	include_once 'login.php';
	include_once '../products/read_specifics.php';
	include_once '../products/update.php';
	require '../utility/fpdf.php';

	if(!isset($_SESSION)){
		session_start();
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

	function confirmOrder($jsonObject) {
		$json = json_decode($jsonObject, true);
		for ($count = 0; $count < count($json["data"]); $count++) {
			if(readProductQuantity($json["data"][$count]["productId"]) < $json["data"][$count]["productQuantity"]) {
				return false;
			}
		}
		for ($count = 0; $count < count($json["data"]); $count++) {
			dbReduceProductQuantity($json["data"][$count]["productId"], $json["data"][$count]["productQuantity"]);
		}
		return true;
	}

	if(isset($_POST['orderProducts'])) {
		authenticateUser();
		$orderInfo = array(
			"task" => "order"
		);
		$orderInfo["data"] = array();
		$orderDetails = "<table><tr><th>Sno</th><th>Product Name</th><th>Product cost</th><th>Quantity</th><th>Total Cost</th></tr>";
		// checking availability of products
		$sno = 1;
		$totalAmount = 0;
		foreach($_POST as $key => $value) {
			if($value != "confirmOrder" && trim($value) != "") {
				$name = readProductName($key);
				$cost = readProductCost($key);
				$netCost = $cost * $value;
				$orderDetails = $orderDetails . "<tr>";
				$orderDetails = $orderDetails . "<td>" . $sno++ . "</td>";
				$orderDetails = $orderDetails . "<td>" . $name . "</td>";
				$orderDetails = $orderDetails . "<td>" . $cost . "</td>";
				$orderDetails = $orderDetails . "<td>" . $value . "</td>";
				$orderDetails = $orderDetails . "<td>" . $netCost . "</td>";
				$orderDetails = $orderDetails . "</tr>";
				$totalAmount = $totalAmount + $netCost;
				$orderUnit = array(
					"productId" => $key,
					"productName" => $name,
					"productQuantity" => $value,
					"productPrice" => $netCost
				);
				array_push($orderInfo["data"], $orderUnit);
			}
		}
		if(confirmOrder(json_encode($orderInfo))) {
			$_SESSION['orderInfo'] = $orderInfo["data"];
			$_SESSION['totalAmount'] = $totalAmount;
			echo " Your Order is successfully submitted<br/>";
			echo "User name : " . $_SESSION['user'] . "<br/>";
			echo "your total bill amount is " . $totalAmount . "<br/>";
			echo $orderDetails;
			echo "<form method = 'post' action = 'controllerOrderProducts.php'>";
			echo "<input type = 'submit' name = 'printInvoice' value = 'print invoice'/><br/>";
			echo "</form><br/>";
			// dbReduceProductQuantity($key, $value);
		}
		else {
			echo "cannot order more than the available quantity<br/>";
		}
		echo "<a href = '../../orderProduct.php'>Go Back</a><br/>";
	}
	else if(isset($_GET['viewAllProducts'])) {
		authenticateUser();
		$jsonData = array();
		$jsonObject = json_encode($jsonData);
		$jsonResponse = viewProducts($jsonObject);
		$jsonResponseData = json_decode($jsonResponse, true);
		$jsonResponseData = $jsonResponseData['products'];
		$productDetails = "<table><tr><th>Product Id</th><th>Product name</th><th>Product Quantity</th><th>Product Unit</th><th>Product Price</th><th>Order Quantity</th></tr><tr>";
		for($count = 0; $count < count($jsonResponseData); $count++){
			if($jsonResponseData[$count]["productQuantity"] > 0) {
				$productDetails = $productDetails . "<tr>";
				foreach ($jsonResponseData[$count] as $key => $value) {
						$productDetails = $productDetails . "<td>" . $value . "</td>";
				}
				$productDetails = $productDetails . "<td><input type = 'number' min = '0' name = '" . $jsonResponseData[$count]['productId'] . "'/></td></tr>";
			}
		}
		$productDetails = $productDetails . "</table>";
		
		$_SESSION['orderPage'] = $productDetails;
		header("Location: ../../orderProduct.php");
		// echo "<a href = '../../viewProducts.php'>Go Back</a>";	
	}
	else if(isset($_POST['printInvoice'])) {
		$orderInfo = $_SESSION['orderInfo'];
		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(170,20,'Invoice of Order',0,0,'C');
		$pdf->Ln();
		$pdf->Cell(40,20,'Customer Name : ' . $_SESSION['user']);
		$pdf->Ln();
		$pdf->Cell(20,20,'Sno.');
		$pdf->Cell(50,20,'Product name');
		$pdf->Cell(50,20,'product quantity');
		$pdf->Cell(50,20,'cost(Rs.)');
		$pdf->Ln();
		for($count = 0; $count < count($orderInfo); $count++) {
				$pdf->Cell(20,20,$count+1);
			foreach($orderInfo[$count] as $key => $value) {
				if($key != "productId"){
					$pdf->Cell(50,20,$value);
				}
			}
			$pdf->Ln();
		}
		$pdf->Cell(40,20,'Total Amount : Rs. ' . $_SESSION['totalAmount']);
		$pdf->Ln();
		$pdf->Output();
		echo "<a href = '../../orderPage.php'>Go Back</a>";
	}
	else {
		$json = json_decode(file_get_contents("php://input"), true);
		$action = $json["task"];
		if(login(json_encode($json) == null)) {
			echo $jsonFailureResponse;
		}
		else {
			if(strcmp($action, "viewAll") == 0) {
				echo viewProducts(json_encode($json));
			}
			else {
				if(confirmOrder(json_encode($json))) {
					echo $jsonSuccessResponse;
				}
				else {
					echo $jsonFailureResponse;
				}
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