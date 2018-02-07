<?php
	Class User {
		private $userName;
		private $userType;
		private $userPassword;

		public function setUserName ($value) {
			$this -> userName = $value;
		}

		public function setUserType ($value) {
			$this -> userType = $value;
		}

		public function setUserPassword ($value) {
			$this -> userPassword = $value;
		}

		public function getUserName() {
			return $this -> userName;
		}

		public function getUserType() {
			return $this -> userType;
		}

		public function getUserPassword() {
			return $this -> userPassword;
		}
	}
?>