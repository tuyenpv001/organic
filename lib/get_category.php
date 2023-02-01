<?php 
	
	function get_category_by_id($number){
	
		$conn = new DB();

		$category = $conn->get_data('categories', 'category_name',"category_id = $number");

	
		$conn->disconnect();
		unset($conn);
	
		return $category['category_name'];
	}
	
 ?>