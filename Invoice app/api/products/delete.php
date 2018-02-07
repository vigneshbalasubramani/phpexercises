<?php
	include '../config/database.php';
	include '../objects/product.php';

	$database;
	$statement;

	function dbDeleteUser($userId) {
		if(dbDelete("delete from invoice.user where user_id = ?", [$userId])) {
			echo 'success';
			return true;
		}
		else {
			return false;
		}
	}

	function dbDeleteProduct($productId) {
		if(dbDelete("delete from invoice.product where product_id = ?", [$productId])) {
			echo 'success';
			return true;
		}
		else {
			return false;
		}
	}

	function dbDelete($query, $param) {
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

	// dbDeleteProduct(3);

?>