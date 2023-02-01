<?php 

	class Category {
		private $category_id;
		private $category_name;


		function __construct($id,$name){
			$this->category_id = $id;
			$this->category_name =  $name;
			

		}

		function get_id(){
			return $this->category_id;
		}

		function get_name() {
			return $this->category_name;
		}

	}

 ?>