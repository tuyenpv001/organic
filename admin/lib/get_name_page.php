<?php 
	function get_name_page($name,$status = '') {

		switch ($name) {
			case 'home':
				$name = 'Trang chủ';
				break;
			case 'products':
				$name = 'Sản phẩm';
				break;
			case 'login':
				$name = 'Đăng nhập';
				break;
			case 'register':
				$name = 'Đăng ký';
				break;
			case 'users':
				$name = 'Danh sách khách hàng';
				break;
			case 'orders':
				$name = 'Hóa đơn';
				break;
			case 'members':
				$name = 'Nhân viên';
				break;
			case 'add-product':
				$name = 'Thêm mới sản phẩm';
				break;
			case 'add-order':
				$name = 'Thêm mới đơn hàng';
				break;
						
			default:
				$name = "Trang chủ";
				break;
		}


		switch($status) {
			case "pending":
				$status = "đang chờ duyệt";
				break;
			case "successfully":
				$status = "thành công";
				break;
			case "cancel":
				$status = "đã hủy";
				break;
		}

		return $name.' '.$status;
	};
 ?>