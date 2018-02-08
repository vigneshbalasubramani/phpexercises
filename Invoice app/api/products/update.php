<?php
	include_once '../config/database.php';
	include_once '../objects/product.php';

	$database;
	$statement;

	function dbUpdateProductQuantity($productId, $productQuantity) {
		if(dbUpdate("update invoice.product set product_quantity = ? where product_id = ?", [$productQuantity, $productId])) {
			return true;
		}
		else {
			return false;
		}
	}

	function dbUpdateProductPrice($productId, $productPrice) {
		if(dbUpdate("update invoice.product set product_price = ? where product_id = ?", [$productPrice, $productId])) {
			return true;
		}
		else {
			return false;
		}
	}

	function dbUpdate($query, $param) {
		$statement;
		try{
			$database = new Database();
			$database -> connect();
			$statement = $database -> connection -> prepare($query);
			$statement -> execute($param);
		}
		catch(PDOException $e) {
			echo $e -> getMessage();
			return false;
		}
		$database -> close();
		return true;
	}

	// dbUpdateProductQuantity(1, 10);
	// dbUpdateProductPrice(1, 50);

?>