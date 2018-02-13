<?php
	include_once '../products/create.php';
	include_once '../objects/user.php';
	include_once 'controllerAuthenticateUser.php';
	include_once '../products/response.php';
	include_once 'login.php';

	if(!isset($_SESSION)){
		session_start();
	}	
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
		
		return dbInsertUser($user);
			// echo "success";
		// echo "failure";
	}

	if(isset($_POST['addUser'])) {
		$userName = $_POST['username'];
		$userPassword = $_POST['password'];
		$userType = $_POST['userType'];
		authenticateAdmin();
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
		echo "<br/><a href = '../../adminHomePage.php'>Go Back</a>";

	}
	else {
		$json = file_get_contents("php://input");
		if(login($json) != "admin") {
			echo $jsonFailureResponse;
		}
		else {
			if(addUser($json)) {
				echo $jsonSuccessResponse;
			}
			else {
				echo $jsonFailureResponse;
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