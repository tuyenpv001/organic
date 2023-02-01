<?php

require("../database/database.php");
$id = $_POST['id'];
$data = array();
$conn = new DB();

$data =$conn->get_all_data('order_detail',"order_id = {$id}");
$data = json_decode($data['products'], false,512, JSON_UNESCAPED_UNICODE);

echo json_encode($data);




?>