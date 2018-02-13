<?php
	if(!isset($_SESSION)){
		session_start();
	}
	include_once '../products/read_one.php';
	if(isset($_POST['login'])) {
		$userType = dbAuthenticateUser($_POST['username'], $_POST['password']); 
		if($userType == null) {
			echo "invalid credentials<br/>";
			header("Location: ../../index.php?invalidCredentials='true'");
		}
		else {
			$_SESSION['user'] = $_POST['username'];
			$_SESSION['userType'] = $userType;
			if($userType == "admin"){
				header("Location: ../../adminHomePage.php");
			}
			else if($userType == "employee") {
			header("Location: ../../newProduct.php");				
			}
			else {
			header("Location: ../../orderProduct.php");				
			}
		}
	}

	function login($jsonObject) {
		$jsonData = json_decode($jsonObject, true);
		if(isset($jsonData['username']) && isset($jsonData['password'])){
			$userType = dbAuthenticateUser($jsonData['username'], $jsonData['password']);
			return $userType;
		}
		return null;
	}
	// }
	// 	if(isset($_POST['login'])) {
	// 		echo $_POST['data'];
	// 	}

	// 	echo $_POST['data'];
	// echo "hello";
?>