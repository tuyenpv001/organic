<?php
    require_once("./inc/inc.php");
    if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");
    ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Không tìm thấy trang</p>

        <a href="<?php base_url();?>">&larr; Quay lại trang chủ</a>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->