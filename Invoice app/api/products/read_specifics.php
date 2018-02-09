<?php
	include_once "read_one.php";

	function readProductName($productId) {
		$jsonObject = dbReadProduct($productId);
		var_dump($jsonObject);
		$jsonData = json_decode($jsonObject, true);
		return $jsonData[0]["productName"];
	}
?>