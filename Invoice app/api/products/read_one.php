<?php
	include_once '../config/database.php';
	include_once '../objects/product.php';

	$database;
	$statement;

	function dbReadProduct($productId) {
		$statement = dbReadonce("select * from invoice.product where product_id = ?", [$productId]);
		$rowCount = $statement -> rowCount();
		if($rowCount > 0){
			$row = $statement -> fetch(PDO::FETCH_ASSOC);
			extract($row);
			$product = array();
			$product[0] = array (
				"productId" => $product_id,
				"productName" => $product_name,
				"productQuantity" => $product_quantity,
				"productUnit" => $product_unit,
				"productPrice" => $product_price
			);
		}
		else {
			$product = array(
				"status" => "error"
			);
			echo "no products found";
		}
		return json_encode($product);
	}

	function dbReadUser($userId) {
		$statement = dbReadOnce("select * from invoice.user where user_id = ?", [$userId]);
		$rowCount = $statement -> rowCount();
		if($rowCount > 0){
			$row = $statement -> fetch(PDO::FETCH_ASSOC);
			extract($row);
			$userItem = array (
				"userId" => $user_id,
				"userName" => $user_name,
				"userType" => $user_type,
				"status" => "success"
			);
		}
		else {
			$userItem = array(
				"success" => "error"
			);
			echo "no users found";
		}
		return json_encode($userItem);
	}

	function dbAuthenticateUser($userName, $userPassword) {
		$encryptedPassword = md5($userPassword);
		$credentials = array( $userName, $encryptedPassword);
		$statement = dbReadOnce("select user_type from invoice.user where user_name = ? and user_password = ?", $credentials);
		$rowCount = $statement -> rowCount();
		if($rowCount > 0){
			$row = $statement -> fetch(PDO::FETCH_ASSOC);
			extract($row);
			echo $user_type;
			return $user_type;
		}
		else {
			return null;
		}
	}

	function dbReadOnce($query, $param) {
		$statement;
		try{
			$database = new Database();
			$database -> connect();
			$statement = $database -> connection -> prepare($query);
			$statement -> execute($param);
		}
		catch(PDOException $e) {
			echo $e -> getMessage();
		}
		$database -> close();
		return $statement;	
	}

	 // dbReadProduct(3);

?>