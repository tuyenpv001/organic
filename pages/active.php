<?php 
	
	$token = $_GET['token'];

	// echo $token;
	$token_user = $conn->get_data('user', 'email' ,"token = '{$token}'");
	
	$data = array(
		'status' => 1
	);

	$result = $conn->update_data('user', $data, "email = '{$token_user['email']}'");
	
	if($result){
		$_SESSION['user']['email'] =  $token_user['email'];
	}	
 ?>


<div class="container_fluid bg-light">
	<div class="container">
		<div class="title d-flex align-items-center justify-content-between">
				<div class="title-container">
					<h2 class="title--main">
						Xác nhận tài khoản
					</h2>
				</div>
				
			
	
				<div class="path-container">
					<p class="path">Trang chủ/ Xác nhận tài khoản</p>
				</div>
		</div>
	</div>
</div>


<section>
		
	<div class="container">
		<?php 
			if($result) {
				echo '<p>Xác nhận tài khoản thành công!!!<a href="?page=login">Đăng nhập.</a></p>';
			}
		 ?>
	</div>

</section>