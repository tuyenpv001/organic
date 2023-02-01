<?php 
	
	class Product {
		protected $product_id;
		protected $product_code;
		protected $product_name;
		protected $product_category;
		protected $product_price;
		protected $product_quantity;
		protected $product_unit;
		protected $product_tags;
		protected $product_sub_description;
		protected $product_description;
		protected $product_image;
		protected $product_permalink;
		protected $status;
		protected $product_date_add;
		protected $product_expire;

		protected $product_expire_unit;
		// function __construct(){

		// }
		function __construct($product_id,$product_code,$product_name,$product_category,$product_price,
			$product_quantity,$product_unit, $product_tags,$product_sub_description,
			$product_description,$product_image,$product_permalink,$status,$product_date_add, $product_expire,$product_expire_unit) {

			$this->product_id = $product_id;
			$this->product_code = $product_code;
			$this->product_name = $product_name;
			$this->product_category = $product_category;
			$this->product_price = $product_price;
			$this->product_quantity = $product_quantity;
			$this->product_unit = $product_unit;
			$this->product_tags = $product_tags;
			$this->product_sub_description = $product_sub_description;
			$this->product_description = $product_description;
			$this->product_image = $product_image;
			$this->product_permalink = $product_permalink;
			$this->status = $status;
			$this->product_date_add = $product_date_add;
			$this->product_expire = $product_expire;

			$this->product_expire_unit = $product_expire_unit;
		}


		function get_id() {
			return $this->product_id;
		}
		function set_id(){
			return $this->product_id;
		}

		public function get_code() {
			return $this->product_code;
		}
		

		public function set_code($product_code) {
			$this->product_code = $product_code;
			
		}


		public function get_name() {
			return $this->product_name;
		}

		public function set_name($product_name) {
			$this->product_name = $product_name;
			
		}


		public function get_category() {
			return $this->product_category;
		}
		

		public function set_category($product_category) {
			$this->product_category = $product_category;
			
		}


		public function get_price() {
			return $this->product_price;
		}

		public function set_price($product_price) {
			$this->product_price = $product_price;
			
		}

		public function get_quantity() {
			return $this->product_quantity;
		}
		

		public function set_quantity($product_quantity) {
			$this->product_quantity = $product_quantity;
			
		}


		public function get_unit() {
			return $this->product_unit;
		}
		

		public function set_unit($product_unit) {
			$this->product_unit = $product_unit;
			
		}

		
		public function get_tags() {
			return $this->product_tags;
		}
		

		public function set_tags($product_tags) {
			$this->product_tags = $product_tags;
			
		}


		public function get_sub_description() {
			return $this->product_sub_description;
		}
		

		public function set_sub_description($product_sub_description) {
			$this->product_sub_description = $product_sub_description;
			
		}

		public function get_description() {
			return $this->product_description;
		}
		

		public function set_description($product_description) {
			$this->product_description = $product_description;
			
		}

		public function get_image() {
			return $this->product_image;
		}
		

		public function set_image($product_image) {
			$this->product_image = $product_image;
			
		}

		public function get_permalink() {
			return $this->product_permalink;
		}
		
		

		public function set_permalink($product_permalink) {
			$this->product_permalink = $product_permalink;
			
		}


		public function get_status() {
			return $this->status;
		}
		
		public function get_date_add() {
			return $this->product_date_add;
		}

		public function set_status($status) {
			$this->status = $status;
			
		}


		public function get_expire() {
			return $this->product_expire;
		}
		

		public function set_expire($product_expire) {
			$this->product_expire = $product_expire;
			
		}


	public function get_expire_unit() {
		return $this->product_expire_unit;
	}
	
	public function set_expire_unit($product_expire_unit){
		$this->product_expire_unit = $product_expire_unit;
	}
}


 ?>