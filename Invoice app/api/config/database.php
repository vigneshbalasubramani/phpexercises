<?php
	class Database {
		public $connection;

		public function connect() {
			$config = parse_ini_file('config.ini');
			$this -> connection = null;
			try{
				$this -> connection = new PDO("mysql:host = " . $config['host'] . ";dbName = " . $config['dbName'], $config['username'], $config['password']);
			}
			catch(PDOException $e) {
				echo $e -> getMessage();
			}
		}

		public function close() {
			$this -> connection = null;
		}

	}
 ?>