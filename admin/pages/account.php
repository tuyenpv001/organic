<?php
    if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");

        // print_r($_COOKIE['user_ad']);
?>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cài đặt tài khoản</h6>
        </div>


        <div class="card-body">


            <form action="" class="tm-signup-form row">
                <div class="form-group col-lg-6">
                    <label>Quyền truy cập</label>
                    <select class="custom-select">
                        <option>-- chọn quyền --</option>
                        <option value="admin" <?= $_COOKIE['user_ad']['role'] == "admin"? "selected":"";?>>Quản lý
                        </option>
                        <option value="member" <?= $_COOKIE['user_ad']['role'] == "member"? "selected":"";?>>Nhân viên
                        </option>
                    </select>
                </div>
                <div class="form-group col-lg-6">
                    <label for="name">Họ tên</label>
                    <input id="name" name="name" value="<?php echo $_COOKIE['user_ad']['username']?>" type="text"
                        class="form-control validate" />
                </div>
                <div class="form-group col-lg-6">
                    <label for="email">Email</label>
                    <input id="email" name="email" value="<?php echo $_COOKIE['user_ad']['email']?>" type="email"
                        class="form-control validate" />
                </div>
                <div class="form-group col-lg-6">
                    <label for="password">Mật khẩu</label>
                    <input id="password" name="password" type="password" class="form-control validate" />
                </div>
                <div class="form-group col-lg-6">
                    <label for="password2">Nhật lại mật khẩu</label>
                    <input id="password2" name="password2" type="password" class="form-control validate" />
                </div>
                <div class="form-group col-lg-6">
                    <label for="phone">Số điện thoại</label>
                    <input id="phone" name="phone" value="<?php echo $_COOKIE['user_ad']['numer_phone'];?>" type="tel"
                        class="form-control validate" />
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block text-uppercase">
                        Cập nhật tài khoản
                    </button>
                </div>
            </form>
        </div>
        <!-- end card action -->





    </div>
    <!-- end card body -->
</div>
</div>