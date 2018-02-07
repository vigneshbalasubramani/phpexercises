<?php
	class Product{
		private $productName;
		private $productPrice;
		private $productQuantity;
		private $productId;
		private $productUnit;

		public function setProductName($productName) {
			$this -> productName = $productName;
		}


		public function setProductPrice($productPrice) {
			$this -> productPrice = $productPrice;
		}


		public function setProductQuantity($productQuantity) {
			$this -> productQuantity = $productQuantity;
		}


		public function setProductUnit($productUnit) {
			$this -> productUnit = $productUnit;
		}


		public function setProductId($productId) {
			$this -> productId = $productId;
		}


		public function getProductName() {
			return $this -> productName;
		}

		public function getProductId() {
			return $this -> productId;
		}

		public function getProductQuantity() {
			return $this -> productQuantity;
		}

		public function getProductUnit() {
			return $this -> productUnit;
		}

		public function getProductPrice() {
			return $this -> productPrice;
		}
	}
?>