<?php
	include '../products/create.php';
	include '../objects/user.php';

	session_start();
	$userName;
	$userType;
	$userPassword;
	$jsonData;

	// function initializeVariables() {
		
	// }

	function addUser($jsonObject) {
		$json = json_decode($jsonObject, true);
		$user = new User();
		$user -> setUserName($json["data"]["username"]);
		$user -> setUserType($json["data"]["userType"]);
		$user -> setUserPassword($json["data"]["password"]);
		if(dbInsertUser($user)) {
			// echo "success";
		}
		// echo "failure";
	}

	if(isset($_POST['addUser'])) {
		$userName = $_POST['username'];
		$userPassword = $_POST['password'];
		$userType = $_POST['userType'];
		// initializeVariables();
		$jsonData = array();
		$jsonData["task"] = "add";
		$jsonData["target"] = "user";
		$jsonData["source"] = $_SESSION['user'];
		$jsonData["data"] = array(
			"username" => $userName,
			"password" => $userPassword,
			"userType" => $userType
		);
		$jsonObject = json_encode($jsonData);
		addUser($jsonObject);
		echo "successfully inserted";
		echo "<br/><a href = '../../adminHomePage.php'>Go Back</a>"

	}
	else {
		$json = json_decode(file_get_contents("php://input"), true);
		$user = new User();
		$user -> setUserName($json["data"]["username"]);
		$user -> setUserType($json["data"]["userType"]);
		$user -> setUserPassword($json["data"]["password"]);
		if(dbInsertUser($user)) {
			$jsonResponse = array(
				"status" => "success"
			);
		}
		else {
			$jsonResponse = array(
				"status" => "failure";
			);
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