<?php
	include_once '../config/database.php';
	include_once '../objects/product.php';

	$database;
	$statement;

	function dbReadProducts() {
		$statement = dbRead("select * from invoice.product");
		$rowCount = $statement -> rowCount();
		if($rowCount > 0){
			$jsonArray = array();
			$jsonArray["products"] = array();
			while($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$productItem = array (
					"productId" => $product_id,
					"productName" => $product_name,
					"productQuantity" => $product_quantity,
					"productUnit" => $product_unit,
					"productPrice" => $product_price
				);
				$jsonArray["status"] = "success";
				array_push($jsonArray["products"], $productItem);
			}
		}
		else {
			$jsonArray["status"] = "error";
			echo "no products found";
		}
		return json_encode($jsonArray);
	}

	function dbReadUsers() {
		$statement = dbRead("select * from invoice.user");
		$rowCount = $statement -> rowCount();
		if($rowCount > 0){
			$jsonArray = array();
			$jsonArray["users"] = array();
			while($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
				extract($row);
				$userItem = array (
					"userId" => $user_id,
					"userName" => $user_name,
					"userType" => $user_type
				);
				$jsonArray["status"] = "success";
				array_push($jsonArray["users"], $userItem);
			}
		}
		else {
			$jsonArray["status"] = "error";
			echo "no users found";
		}
		return json_encode($jsonArray);
	}

	function dbRead($query) {
		$statement;
		try{
			$database = new Database();
			$database -> connect();
			$statement = $database -> connection -> prepare($query);
			$statement -> execute();
		}
		catch(PDOException $e) {
			echo $e -> getMessage();
		}
		$database -> close();
		return $statement;	
	}

	// dbReadProducts();

?>