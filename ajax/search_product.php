<?php 


	require("../database/database.php");
	$text = $_POST['text'];
	$data = array();
	$conn = new DB();
	$data = $conn->get_all_data('products',"product_name LIKE '%{$text}%'");


	echo json_encode($data);


 ?>