<?php
	include_once "read_one.php";

	function readProductName($productId) {
		$jsonObject = dbReadProduct($productId);
		$jsonData = json_decode($jsonObject, true);
		return $jsonData[0]["productName"];
	}

	function readProductCost($productId) {
		$jsonObject = dbReadProduct($productId);
		$jsonData = json_decode($jsonObject, true);
		return $jsonData[0]["productPrice"];
	}

	function readProductQuantity($productId) {
		$jsonObject = dbReadProduct($productId);
		$jsonData = json_decode($jsonObject, true);
		return $jsonData[0]["productQuantity"];
	}
?>