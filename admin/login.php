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
    ob_start();
    require("../controllers/db.php");
    if(isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin");

    

    $error = array();
    $data = array();
    $user = array();
    if(isset($_POST['email'])) {
        $data['email']  = $_POST['email'];
    }
    if(isset($_POST['password'])) {
        $data['password']  = $_POST['password'];
    }
     if(isset($_POST['role'])) {
        $data['role']  = $_POST['role'];
       
    } else    $error['mess_role'] = "Vui lòng chọn quyền đăng nhập";
    
    if(isset($_GET['act']) && isset($_POST['reset_password'])) {
        $data['reset_password']  = $_POST['reset_password'];
    }

    if(isset($_POST['login'])){

        $data['password'] = md5($data['password']);
        $conn = new DB();

        // // echo $conn->check_data_exists('user', "email = '{$data['email']}'");

        if($conn->check_data_exists('user', "email = '{$data['email']}' AND role = '{$data['role']}' AND status = 1 ")){
            $user = $conn->get_all_data('user', "email = '{$data['email']}' AND password = '{$data['password']}' AND role = '{$data['role']}' AND status = 1 " );  
            
            if(empty($user)) {
                $error['mess'] = "Đăng nhập sai email/ mật khẩu";
            }
            
        } else $error['email'] = "Email không tồn tại!";

        
        // print_r($user);

        if(!empty($user)){
            // echo "Da chay";
            setcookie('user_ad[username]', $user[0]['username'], time()+3600, "/");
            setcookie('user_ad[numer_phone]', $user[0]['number_phone'], time()+3600, "/");
            setcookie('user_ad[email]', $user[0]['email'], time()+3600, "/");
            setcookie('user_ad[token]', $user[0]['token'], time()+3600, "/");
            setcookie('user_ad[status]', $user[0]['status'], time()+3600, "/");
            setcookie('user_ad[role]', $user[0]['role'], time()+3600, "/");
            // echo "Da chay";
            header("location: http://localhost/ogranic/admin");
        }
        
        unset($conn);
    }
    


    if(isset($_POST['reset'])){
        if($data['password'] != $data['reset_password']){
            $error['err-pass'] = "Mật khẩu không trùng";
        }
    }

    // print_r($_COOKIE);

    ob_flush();
 ?>






<body class="bg-gradient-primary">

    <div class="container item-center">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Quản trị</h1>
                                    </div>
                                    <form class="user" method="POST" action="">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Admin</label>
                                                    <input type="radio" name="role" value="admin"
                                                        <?php if(isset($data['role']) && $data['role'] == 'admin') echo 'checked'; ?>>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nhân viên</label>
                                                    <input type="radio" name="role" value="member"
                                                        <?php if(isset($data['role']) && $data['role'] == 'member') echo 'checked'; ?>>
                                                </div>

                                                <p class="text=danger">

                                                    <?= isset($error['mess_role']) ?   $error['mess_role']: "";   ?>



                                                </p>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="<?php if(isset($data['email'])) echo $data['email'];  ?>"
                                                placeholder="Nhập email">
                                            <p class="text-danger mt-2">
                                                <?= isset($error['email']) ? $error['email']: "";   ?></p>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" hidden>
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Nhập mật khẩu">
                                            <p class="mess-error text-danger mt-2">
                                                <?= isset($error['mess']) ? $error['mess']: "";   ?>
                                            </p>
                                        </div>

                                        <?php 

                                            if(isset($_GET['act'])){
                                                echo '
                                                    <div class="form-group">
                                                        <input type="password" hidden>
                                                        <input type="password" name="reset_password" class="form-control form-control-user"
                                                            id="exampleInputPassword" placeholder="nhập lại mật khẩu">
                                                          
                                                    </div>

                                                ';
                                            } else echo "";

                                         ?>
                                        <p class="mess-error text-danger mt-2">
                                            <?php 
                                                        if(isset($error['err-pass'])) echo $error['err-pass'];

                                                     ?>
                                        </p>



                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            <?php echo isset($_GET['act']) ? 'Đổi mật khẩu' : 'Đăng nhập' ?>
                                        </button>
                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <?php 
                                            if(isset($error) && !empty($error)){
                                         ?>
                                        <a class="small" href="login.php?act=reset">Quên mật khẩu?</a>

                                        <?php } ?>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="http://localhost/ogranic/admin/register.php">Bạn chưa có
                                            tài khoản? Đăng ký!</a>
                                    </div>
                                </div>
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