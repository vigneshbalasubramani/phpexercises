<?php
	include '../config/database.php';
	include '../objects/product.php';

	$database;
	$statement;

	function dbInsertProduct ($productBean) {
		$productDetails = array();
		array_push($productDetails, $productBean -> getProductName());
		array_push($productDetails, $productBean -> getProductQuantity());
		array_push($productDetails, $productBean -> getProductUnit());
		array_push($productDetails, $productBean -> getProductPrice());
		if(dbInsert("insert into invoice.product(product_name, product_quantity, product_unit, product_price) values(?, ?, ?, ?)", $productDetails)) {
			return true;
		}
		return false;
	}

	function dbInsertUser ($userBean) {
		$userDetails = array();
		$userPassword = md5($userBean -> getUserPassword());
		array_push($userDetails, $userBean -> getUserName());
		array_push($userDetails, $userPassword);
		array_push($userDetails, $userBean -> getUserType());
		if(dbInsert("insert into invoice.user(user_name, user_password, user_type) values(?, ?, ?)", $userDetails)) {
			return true;
		}
		return false;
	}

	function dbInsert ($query, $params) {
		try{
			$database = new Database();
			$database -> connect();
			$statement = $database -> connection -> prepare($query);
			if($statement -> execute($params)) {
				// echo "success";
				return true;
			}
			// var_dump($statement -> errorInfo());
			// echo "failure";
			return false;
		}
		catch(PDOException $e) {
			echo $e -> getMessage();
		}
	}

	// dbInsert("insert into invoice.product(product_name, product_quantity, product_unit, product_price) values(?, ?, ?, ?)", ['watch', 4, 'pcs',500]);

?>