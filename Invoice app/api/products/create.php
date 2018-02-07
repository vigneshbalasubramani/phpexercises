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
		dbInsert("insert into product values(, ?, ?, ?, ?)", $productDetails);
	}

	function dbInsertUser ($userBean) {
		$userDetails = array();
		$UserPassword = md5($userBean -> getUserPassword);
		array_push($userDetails, $userBean -> getUserName());
		array_push($userDetails, $userPassword);
		array_push($userDetails, $userBean -> getUserType());
		dbInsert("insert into user values(, ?, ?, ?)", $userDetails);
	}

	function dbInsert ($query, $params) {
		try{
			$database = new Database();
			$database -> connect();
			$statement = $database -> connection -> prepare($query);
			if($statement -> execute($params)) {
				return true;
			}
			return false;
		}
		catch(PDOException $e) {
			echo $e -> getMessage();
		}
	}

	// echo md5("asdfgf");
	

?>