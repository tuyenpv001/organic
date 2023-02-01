<?php

require("../database/database.php");
$id = $_POST['id'];
$data = array();
$conn = new DB();

$data =$conn->get_all_data('products',"product_id = {$id}");

$GLOBALS['or_product'][] = $data;


echo json_encode($data);




?>