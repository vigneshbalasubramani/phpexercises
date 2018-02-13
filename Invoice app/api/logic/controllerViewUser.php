<?php
	include_once '../products/read.php';
	include_once '../objects/user.php';
	include_once 'controllerAuthenticateUser.php';
	include_once '../logic/login.php';
	include_once '../products/response.php';

	if(!isset($_SESSION)){
		session_start();
	}	

	$userName;
	$userType;
	$userPassword;
	$jsonData;

	// function initializeVariables() {
		
	// }

	function viewUser($jsonObject) {
		$json = json_decode($jsonObject, true);

		return dbReadUsers();
			// echo "success";
		// echo "failure";
	}

	if(isset($_GET['viewUsers'])) {
		// $userId = $_POST['userId'];
		authenticateAdmin();
		$jsonData = array();
		$jsonData["task"] = "view";
		$jsonData["target"] = "user";
		$jsonData["source"] = $_SESSION['user'];
		$jsonObject = json_encode($jsonData);
		$jsonResponse = json_decode(viewUser($jsonObject), true);
		$jsonResponseData = $jsonResponse['users'];
		$userDetails = "<table><tr><th>User Id</th><th>User name</th><th>User type</th></tr>";
		for($count = 0; $count < count($jsonResponseData); $count++){
			$userDetails = $userDetails . "<tr>";
			foreach ($jsonResponseData[$count] as $key => $value) {
				$userDetails = $userDetails . "<td>" . $value . "</td>";
			}
			$userDetails = $userDetails . "</tr>";
		}
		$userDetails = $userDetails . "</table>";
		
		$_SESSION['userDetails'] = $userDetails;
		header("Location: ../../adminViewUser.php");
	}
	else {
		$json = file_get_contents("php://input");
		if(login($json) != "admin") {
			echo $jsonFailureResponse;
		}
		else{
			echo viewUser($json);
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