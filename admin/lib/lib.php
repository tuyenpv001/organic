<?php 
	require_once("cloudinary/upload_img.php");
	

 function display_value($value,$product) {
  if(array_key_exists($value,$product)) echo $product[$value];
  else echo ''; 
 }


function display_status($status, $name = ''){
    $status_mess = '';
    // if($status) return 'còn hàng';

    // return 'hết hàng';
    switch($name){
        case 'user':
            $status_mess = $status ? 'đã kích hoạt': 'chưa kích hoạt';
            break;
        default:
            $status_mess = $status ? 'còn hàng' : 'hết hàng';
            break;
    }


    return $status_mess;
}

function display_expire($unit)
{
    switch($unit) {
        case 'month':
            return 'tháng';
        case 'day':
            return 'ngày';
        case 'year':
            return 'năm';
    }

    return '';
}

 ?>