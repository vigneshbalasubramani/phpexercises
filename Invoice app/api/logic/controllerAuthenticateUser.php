<?php 
	function authenticateAdmin() {
		if(!isset($_SESSION['userType'])) {
			header("Location: ../../index.php?invalidUser='true'");
		}
		else if(strcmp($_SESSION['userType'], "admin") != 0) {
			header("Location: ../../index.php?invalidUser='true'");
		}
	}

	function authenticateEmployee() {
		if(!isset($_SESSION['userType'])){
			header("Location: ../../index.php?invalidUser='true'");
		}
		else if(strcmp($_SESSION['userType'], "employee") != 0 && strcmp($_SESSION['userType'], "admin") != 0) {
			header("Location: ../../index.php?invalidUser='true'");
		}
	}

	function authenticateUser() {
		if(!isset($_SESSION['userType'])) {
			header("Location: ../../index.php?invalidUser='true'");			
		}
	}
?>