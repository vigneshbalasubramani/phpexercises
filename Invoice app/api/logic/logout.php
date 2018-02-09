<?php
	session_start();
	$_SESSION['userType'] = null;
	session_destroy();
	header("Location: ../../index.php");
?>