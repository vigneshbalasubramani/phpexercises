<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>First php exercise</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form method = "post">
		<table>
			<tbody>
				<tr>
					<td><label for = "name">Name:</label></td>
					<td><input type = "text" name = "name" id = "name" required/></td>
				</tr>
				<tr>
					<td><label for = "dob">Date of birth:</label></td>
					<td><input type = "date" name = "dob" id = "dob" required/></td>
				</tr>
				<tr>
					<td><label for = "number1">Number 1:</label></td>
					<td><input type = "text" name = "number1" id = "number1" pattern = "[0-9]+" title = "numbers only" required/></td>
				</tr>
				<tr>
					<td><label for = "number2">Number 2:</label></td>
					<td><input type = "text" name = "number2" id = "number2" pattern = "[0-9]+" title = "numbers only" required/></td>
				</tr>
				<tr>
					<td><input type = "submit" name = "submit" value = "add"/></td>
				</tr>
				<tr>
					<td><input type = "submit" name = "submit" value = "multiply"/></td>
				</tr>
			</tbody>
		</table>
	</form>
<?php 
		$name = $_POST['name'];
		$dob = $_POST['dob'];
		$number1 = $_POST['number1'];
		$number2 = $_POST['number2'];
		$submit = $_POST['submit'];

	function addTwoNumbers($number1, $number2) {
		$sum = $number1 + $number2;
		return $sum;
	}

	function multiplyTwoNumbers($number1, $number2) {
		$product = $number1 * $number2;
		return $product;
	}

	function addToDatabase($name, $dob) {
		$database = "php_tutorial";
		$host = "mysql:host=localhost;dbname=php_tutorial";
		$username = "vignesh";
		$password =  "asdfgf";
		$sql = "insert into users(name, dob) values(:name, :dob)";
		try{
			$connection = new PDO($host, $username, $password);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$statement = $connection->prepare($sql);
			$statement->bindParam(':name', $name);
			$statement->bindParam(':dob', $dob);
			if($statement->execute()){
				echo "successfully insert";
			} else {
				echo "fail";
			}
		}
		catch(PDOException $e) {
			echo "connection failed" . $e->getMessage();
		}
		$connection = null;
	}

	if(isset($submit)) {
		if($submit == 'add') {
			$result = addTwoNumbers($number1, $number2);
		}
		else {
			$result = multiplyTwoNumbers($number1, $number2);
		}
		addToDatabase($name, $dob);
		$output = 'welcome ' . $name . '<br/>' . $dob . '<br/>' . $result;
		echo "<textarea>" . $output . "</textarea>";
	}
?>

</body>
</html>
