<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Đăng nhập quản trị</title>

    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css?v<?php echo time(); ?>" rel="stylesheet">

</head>


<?php
   if(isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin");
   require("../controllers/db.php");

$error = array();
$data = array();
if(isset($_POST['f_name'])) {
    $data['first_name']  = mb_strtolower(trim($_POST['f_name']));
}
if(isset($_POST['l_name'])) {
    $data['last_name']  = mb_strtolower(trim($_POST['l_name']));
}
if(isset($_POST['email'])) {
    $data['email']  = $_POST['email'];
}
if(isset($_POST['role'])) {
    $data['role']  = $_POST['role'];
}
if(isset($_POST['gender'])) {
    $data['gender']  = $_POST['gender'];
}
if(isset($_POST['gender'])) {
    $data['number_phone']  = $_POST['phone'];
}
if(isset($_POST['password'])) {
    $data['password']  = $_POST['password'];
}
if(isset($_POST['b_date'])) {
    $data['birthday']  = $_POST['b_date'];
    $dateOfBirth=$_POST['b_date'];
    $today=date("Y-m-d");
    $diff=date_diff(date_create($dateOfBirth),date_create($today));
    // echo'Ageis'.$diff->format('%y');

    if($diff->format('%y') < 18 ) {
        $error['b_date'] = "Bạn chưa đủ 18 tuổi";
    }
}
if(isset($_POST['password_confirm'])) {
    $data['password_confirm']  = $_POST['password_confirm'];

    if($data['password'] != $data['password_confirm']) {
        $error['match_password'] = 'Mật khẩu và xác nhận mật khẩu không khớp';
    }
}



if(empty($error) && !empty($data)) {
    $active_token = md5($data['email'].time());
    $data["password"] = md5($data["password"]);
    $data['token'] = $active_token;
    unset($data['password_confirm']);
   
    $conn = new DB();
    // echo $link_active;

    $result = $conn->insert_data("user",$data);
    if($result) header("location: http://localhost/ogranic/admin/login.php");

}



?>




<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Tạo tài khoản mới!</h1>
                            </div>
                            <form class="user" action="" method="POST">
                                <div class="form-group row">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="radio" name="role" id="admin" value="admin" class=""
                                            <?php if(isset($data['role']) && $data['role'] == 'admin') echo 'checked';?>>
                                        <label for="admin">Quản lý</label>
                                    </div> -->
                                    <div class="col-sm-6">
                                        <input type="radio" name="role" id="member" value="member" class=""
                                            <?php if(isset($data['role']) && $data['role'] == 'member') echo 'checked';?>>
                                        <label for="member">Nhân viên</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="exampleFirstName">Tên</label>
                                        <input type="text" name="f_name" class="form-control" required
                                            value="<?php if(isset($data['first_name'])) echo $data['first_name'];  ?>"
                                            id="exampleFirstName" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="exampleLastName">Họ</label>
                                        <input type="text" name="l_name" class="form-control" required
                                            value="<?php if(isset($data['last_name'])) echo $data['last_name'];  ?>"
                                            id="exampleLastName" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="radio" name="gender" id="men" value="men" class=""
                                            <?php if(isset($data['gender']) && $data['gender'] == 'men') echo 'checked';?>>
                                        <label for="men">Name</label>
                                        <div></div>
                                        <input type="radio" name="gender" id="women" value="women" class=""
                                            <?php if(isset($data['gender']) && $data['gender'] == 'women') echo 'checked';?>>
                                        <label for="men">Nữ</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="">Ngày sinh: </label><input type="date" name="b_date" id="date"
                                            class="form-control" required
                                            value="<?php if(isset($data['birthday'])) echo $data['birthday']?>">
                                        <p class="text-danger">
                                            <?php if(isset($error['b_date'])) echo $error['b_date'];?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <input type="email" name="email" class="form-control" required
                                        value="<?php if(isset($data['email'])) echo $data['email'];  ?>"
                                        id="exampleInputEmail" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Số điện thoại</label>
                                    <input type="text" name="email" class="form-control"
                                        value="<?php if(isset($data['email'])) echo $data['email'];  ?>" required
                                        pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b" id="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="exampleInputPassword">Mật khẩu</label>
                                        <input type="password" name="password" class="form-control" required
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="exampleRepeatPassword">Nhập lại mật khẩu</label>
                                        <input type="password" name="password_confirm" class="form-control" required
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <?php 
                                    if(isset($error['match_password'])) {
                                        echo '<p class="error_mess">'.$error['match_password'].'</p>';
                                    }
                                ?>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Đăng ký
                                </button>
                                <hr>

                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="http://localhost/ogranic/admin/login.php">Bạn đã có tài khoản?
                                    Đăng nhập!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





    <!-- Bootstrap core JavaScript-->
    <script src="../public/vendor/jquery/jquery.min.js"></script>
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../public/js/sb-admin-2.min.js"></script>

</body>

</html>