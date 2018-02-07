<?php
	session_start();
	$num1 = $_SESSION['number1'];
	$num2 = $_SESSION['number2'];
		class Connection {
			private $host = "mysql:host=localhost;dbname=php_tutorial";
			private $username = "vignesh";
			private $password = "asdfgf";
			private $insertUser = "insert into users(regno, dob) values(:name, :dob)";
			private $getUser = "select count(*) as c from users where regno = ? and dob = ?";
			private $checkUser = "select count(*) as c from users where regno = ?";
			public $connection, $statement;

			public function setConnection() {
				$this->connection = new PDO($this->host, $this->username, $this->password);
			}

			public function userAlreadyExists($name, $dob) {
				try{
					$statement = $this->connection->prepare($this->checkUser);
					$statement->execute([$name]);
					$resultset = $statement->fetchAll(PDO::FETCH_ASSOC);
					$connection = null;
					if(strcmp($resultset[0]['c'], "1") == 0){
						return true;
					}
					else {
						return false;
					}
				}
				catch(PDOException $e) {
					echo "<p>" . $e->getMessage() . "</p>";
				}
			}

			public function addUser($name, $dob) {
				try{
					if($this->userAlreadyExists($name, $dob)){
						echo "<p>" . "user already exists" . "</p>";
					}
					else{
						$statement = $this->connection->prepare($this->insertUser);
						$statement->bindParam(':name', $name);
						$statement->bindParam(':dob', $dob);
						$statement->execute();
						echo "<p>" . "successfully added" . "</p>";
					}
				}
				catch(Exception $e) {
					echo "<p>" . $e->getMessage() . "</p>";
				}
				$connection = null;
			}

			public function findUser($name, $dob) {
				try{
					$statement = $this->connection->prepare($this->getUser);
					$statement->execute([$name, $dob]);
					$resultset = $statement->fetchAll(PDO::FETCH_ASSOC);
					$connection = null;
					if(strcmp($resultset[0]['c'], "1") == 0){
						return true;
					}
					else {
						return false;
					}
				}
				catch(PDOException $e) {
					echo "<p>" . $e->getMessage() . "</p>";
				}
			}
		}

		if(isset($_POST['submit'])) {
			
			$conn = new Connection();
			$conn->setConnection();
			$name = $_POST['name'];
			$dob = $_POST['dob'];
			$submit = $_POST['submit'];
			if($submit == 'signup') {
				$conn->addUser($name, $dob);
			}
			else {
				$sum = $_POST['sum'];
				if(($num1 + $num2) == $sum) {
					if($conn -> findUser($name, $dob)) {
						echo "<p>" . "welcome user" . "</p>";
					}
					else {
						echo "<p>" . "invalid credentials" . "</p>";
					}
					unset($num1);
					unset($num2);
				}
				else {
					echo "<p>" . "invalid sum" . "</p>";
				}
			}
		}
	?>
	<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome user</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<a href = "login.php">Go Back</a>
</body>
</html>