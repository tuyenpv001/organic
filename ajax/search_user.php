<?php 


	require("../database/database.php");
	$text = $_POST['text'];
	$data = array();
	$conn = new DB();
	$data = $conn->get_all_data('user',"username LIKE '%{$text}%'");


	echo json_encode($data);


 ?>