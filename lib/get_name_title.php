
<?php 
	function get_name_title($name) {

		switch ($name) {
			case 'about':
				$name = 'Về chúng tôi';
				break;
			case 'cart':
				$name = 'Giỏ hàng';
				break;
			case 'product':
				$name = 'Sản phẩm';
				break;
			case 'contact':
				$name = 'Liên hệ';
				break;
			case 'store':
				$name = 'Cửa hàng';
				break;
			case 'login':
				$name = 'Đăng nhập';
				break;
			case 'register':
				$name = 'Đăng ký';
				break;
			case 'user':
				$name = 'Thông tin người dùng';
				break;
		}



		return $name;
	};
 ?>
