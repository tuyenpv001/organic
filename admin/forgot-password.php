<?php 
    ob_start();
    require("../controllers/db.php");
    if(isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin");

    // print_r($_POST);
    $error = array();
    $data = array();
    $user = array();
    if(isset($_POST['email'])) {
        $data['email']  = $_POST['email'];
    }
       if(isset($_POST['role'])) {
        $data['role']  = $_POST['role'];
    }
    
    if(isset($_POST['reset'])){
        echo "ok";
        $data['password'] = md5($data['password']);
        $conn = new DB();

        // echo $conn->check_data_exists('user', "email = '{$data['email']}'");

        if($conn->check_data_exists('user', "email = '{$data['email']}' AND status = 1")){
            $user = $conn->get_all_data('user', "email = '{$data['email']}' AND password = '{$data['password']}' AND role = '{$data['role']}' " );  
        } else $error['email'] = "Email không tồn tại!";

        
    }
    


    ob_flush();
 ?>








<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css?v<?php echo time(); ?>" rel="stylesheet">

</head>









<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Quên mật khẩu</h1>
                                        <p class="mb-4">Vui lòng điền email để thay đổi mật khẩu.</p>
                                    </div>
                                    <form class="user" action="" method="POST">
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
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>

                                        <p class="text-danger mt-2">
                                            <?= isset($error['email']) ? $error['email']: "";   ?></p>
                                        <button class="btn btn-primary btn-user btn-block"> Đổi mật khẩu</button>

                                    </form>
                                    <hr>
                                    <!--   <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
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