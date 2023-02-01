<?php 

	ob_start();
	if(isset($_COOKIE['user'])) header("location: ?page=cart");





	ob_flush();




 ?>






<div class="container_fluid bg-light">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="title-container">
                <h2 class="title--main">
                    Đăng ký
                </h2>
            </div>



            <div class="path-container">
                <p class="path">Trang chủ/ Đăng ký</p>
            </div>
        </div>
    </div>
</div>

<?php

	$error = array();
	$data = array();
	if(isset($_POST['f_name'])) {
		$data['first_name']  = trim($_POST['f_name']);
	}
	if(isset($_POST['l_name'])) {
		$data['last_name']  = trim($_POST['l_name']);
	}
	if(isset($_POST['email'])) {
		$data['email']  = $_POST['email'];
	}
	if(isset($_POST['password'])) {
		$data['password']  = $_POST['password'];
	}
	if(isset($_POST['password_confirm'])) {
		$data['password_confirm']  = $_POST['password_confirm'];
	
		if($data['password'] != $data['password_confirm']) {
			$error['match_password'] = 'mật khẩu và xác nhận mật khẩu không khớp';
		}
	}

	if(empty($error) && !empty($data)) {
		$active_token = md5($data['email'].time());
		$data["password"] = md5($data["password"]);
		$data['token'] = $active_token;
		unset($data['password_confirm']);
		$link_active = base_url("?page=active&mod=user&action=active&token={$active_token}");

		// echo $link_active;

		$conn->insert_data("user",$data);

		send_email($data['email'], "{$data['first_name']} {$data['last_name']}", $link_active);
		unset($data);
	}
	
 ?>

<section id="register" class="mt-5">
    <div class="container d-flex justify-content-center">
        <form action="?page=register&type=submit" method="POST" class="form__register">

            <div class="checkout__input">
                <label class="label">Tên</label>
                <input type="text" name="f_name"
                    value="<?php if(isset($data['first_name'])) echo $data['first_name'];  ?>"
                    class="input form-control" placeholder="first name" required>
            </div>
            <div class="checkout__input mt-40">
                <label>Họ</label>
                <input type="text" name="l_name"
                    value="<?php if(isset($data['last_name'])) echo $data['last_name'];  ?>" class="input form-control"
                    placeholder="last name" required>
            </div>


            <div class="checkout__input mt-40">
                <label>Email</label>
                <input type="email" name="email" value="<?php if(isset($data['email'])) echo $data['email'];  ?>"
                    class="input form-control" placeholder="email" required>
            </div>
            <div class="checkout__input mt-40">
                <label>Mật khẩu</label>
                <input type="password" name="password"
                    value="<?php if(isset($data['password'])) echo $data['password'];  ?>" class="input form-control"
                    placeholder="password" required>
            </div>
            <div class="checkout__input mt-40">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirm"
                    value="<?php if(isset($data['password_confirm'])) echo $data['password_confirm'];  ?>"
                    class="input form-control" placeholder="confirm password" required>

                <?php 
					if(isset($error['match_password'])) {
						echo '<p class="error_mess">'.$error['match_password'].'</p>';
					}
				 ?>

            </div>
            <div class="btn-container text-center  mt-60">
                <button type="submit" name="register" class="btn btn-primary btn-login">Đăng ký</button>
                <p class="form__subtext">Bạn đã có tài khoản? <a href="?page=login">Đăng nhập</a></p>
            </div>

        </form>




    </div>
</section>