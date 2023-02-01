<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");



require("../database/database.php");
$conn = new DB();
$check = false;
$products  = $conn->get_all_data('products',"status = 1");



if(count($products) != 0) $check = true;


// if(isset($_POST['order_add']))


if(isset($_POST['products'])) {
    print_r($_POST['products']);
}
if(isset($_POST['product_quantity'])) {
    print_r($_POST['product_quantity']);
}





 
?>
<section class="container-fluid">


    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Thêm hóa đơn</h6>
        </div>
        <div class="order card-body">
            <form action="" method="POST">

                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">
                                Mã hóa đơn
                            </label>
                            <input type="text" name="order_code" id="order_code" class="form-control"
                                value="<?php $date = new DateTimeImmutable(); echo $date->getTimestamp();  ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">
                                Ngày
                            </label>
                            <input type="text" name="order_date" class="form-control"
                                value="<?php echo date('Y-m-d h:m:s');?>" id="order_code" readonly>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Họ tên khách hàng</label>
                            <input type="text" name="username" id="" class="form-control validate">
                        </div>
                        <div class="col-md-6">
                            <label for="">Số điện thoại</label>
                            <input type="text" name="order_phone" id="" class="form-control validate"
                                pattern="(84|0[3|5|7|8|9])+([0-9]{8})\b">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" name="order_address" id="" class="form-control validate">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="table-body">

                                <select class="custom-select tm-select-accounts" id="select-product"
                                    name="product_category" value="">
                                    <option>-- Chọn sản phẩm--</option>
                                    <?php
                                    if($check) {
                                          foreach($products as $p){
                                        ?>
                                    <option value="<?= $p['product_id']; ?>"><?=$p['product_name']; ?></option>

                                    <?php }} ?>
                                </select>


                            </div>
                            <!-- end table body -->
                        </div>

                        <div class="col-md-6">
                            <div id="product_selected">
                                <ul id="main-list">

                                </ul>

                            </div>

                        </div>

                    </div>
                </div>


                <button class="btn btn-primary" type="submit" name="order_add">Thêm hóa đơn</button>
            </form>
        </div>
    </div>

</section>



<script>

</script>