<?php 
	ob_start();
	
	if(isset($_COOKIE['user'])) header("location: ?page=cart");


	$error = array();
	$data = array();
	$user = array();
	if(isset($_POST['email'])) {
		$data['email']  = $_POST['email'];
	}
	if(isset($_POST['password'])) {
		$data['password']  = $_POST['password'];
	}
	
	if(isset($_SESSION['user'])) {
		$data['email'] = $_SESSION['user']['email'];
	}


	if(isset($_POST['login'])){
		$data['password'] = md5($data['password']);
		$conn = new DB();

		// echo $conn->check_data_exists('user', "email = '{$data['email']}'");

		if($conn->check_data_exists('user', "email = '{$data['email']}' AND status = 1")){
			$user = $conn->get_all_data('user', "email = '{$data['email']}' AND password = '{$data['password']}' AND role = 'user'" );	

			if(empty($user)) {
				$error['mess'] = "Đăng nhập sai email/ mật khẩu";
			}
			
		} else $error['email'] = "Email không tồn tại!";

		
		// print_r($user);

		if(!empty($user)){
			setcookie('user[first_name]', $user['first_name'], time()+3600, "/");
			setcookie('user[last_name]', $user['last_name'], time()+3600, "/");
			setcookie('user[username]', $user['username'], time()+3600, "/");
			setcookie('user[numer_phone]', $user['number_phone'], time()+3600, "/");
			setcookie('user[email]', $user['email'], time()+3600, "/");
			setcookie('user[token]', $user['token'], time()+3600, "/");
			setcookie('user[status]', $user['status'], time()+3600, "/");
			setcookie('user[role]', $user['role'], time()+3600, "/");

			header("location: ?page=cart");
		}

		
	}
	



	ob_flush();
 ?>



<div class="container_fluid bg-light">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="title-container">
                <h2 class="title--main">
                    Đăng nhập
                </h2>
            </div>



            <div class="path-container">
                <p class="path">Trang chủ/ Đăng nhập</p>
            </div>
        </div>
    </div>
</div>


<section id="login" class="mt-60">
    <div class="container d-flex justify-content-center">
        <form action="?page=login&type=submit" method="POST" class="form__register mt-5">

            <div class="checkout__input">
                <label>Email</label>
                <input type="text" name="email" value="<?php if(isset($data['email'])) echo $data['email'];  ?>"
                    class="" placeholder="vd: abc@gmail.com" required>
                <p class="text-danger mt-2"><?= isset($error['email']) ? $error['email']: "";   ?></p>
            </div>
            <div class="checkout__input mt-40">
                <label>Mật khẩu</label>
                <input type="password" hidden disabled>
                <input type="password" name="password" class="" placeholder="Mật khẩu" required>
            </div>

            <div class="mess-error text-danger mt-2">
                <?= isset($error['mess']) ? $error['mess']: "";   ?>
            </div>

            <div class="btn-container text-center  mt-60">

                <button type="submit" name="login" class="btn btn-primary btn-login">Đăng nhập</button>
                <p class="form__subtext">Đăng ký tài khoản? <a href="?page=register">Đăng ký</a></p>
            </div>

        </form>
    </div>



</section>