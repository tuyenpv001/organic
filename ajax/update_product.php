<?php 
	require("../database/database.php");
	$id = $_POST['id'];
	$data = array("status" => 0);
	$conn = new DB();
	$conn->update_data('products',$data, "product_id = {$id}");

	$mess = array();
	
	$mess['status'] = 1; 

	echo json_encode($mess);


 ?>