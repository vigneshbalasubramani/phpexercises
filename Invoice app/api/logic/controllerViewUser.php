<?php
	include_once '../products/read.php';
	include_once '../objects/user.php';

	session_start();
	if(!isset($_SESSION['userType']) || strcmp($_SESSION['userType'], "admin") != 0){
		header("Location: ../../index.php");
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

	if(isset($_POST['viewUser'])) {
		// $userId = $_POST['userId'];
		// initializeVariables();
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
		
		echo $userDetails;
		echo "<a href = '../../adminViewUser.php'>Go Back</a>";
	}
	else {
		$json = json_decode(file_get_contents("php://input"), true);

		echo dbReadUsers();
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