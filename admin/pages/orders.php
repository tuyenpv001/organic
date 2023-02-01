<?php   
if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");
require("../controllers/db.php");
$check = false;
$status = 'success';
if(isset($_GET['status'])) $status = $_GET['status'];
$conn = new DB();

$orders = $conn->get_all_data('orders', "order_status = '{$status}'");


if(!empty($orders)) $check = true;

// print_r($orders);




if(isset($_GET['status']) && isset($_GET['id'])){
    echo 'ok';
    $act = $_GET['status'];
    $id = $_GET['id'];
    switch ($act) {
        case 'pending':
            $result = $conn-> update_data('orders', array("order_status" =>'success', "order_delivery" => "shipping"), "order_id =  '{$id}'");
            if($result) echo '<script>
            swal("Đã duyệt", "Đơn hàng đã được duyệt", "success");
            </script>';
            header("location: ?page=orders");
            break;
        case 'cancel':
            $result = $conn-> update_data('orders', array("order_status" =>'cancel', "order_delivery" => ""), "order_id =  '{$id}'");
            if($result) echo '<script>
            swal("Đã hủy", "Đơn hàng đã được hủy", "success");
            </script>';
            header("location: ?page=orders");
            break;

        
     
    }
}
















function get_status($status) {
    switch ($status) {
        case 'pending':
            $status = 'đang chờ duyệt';
            break;
        case 'success':
            $status = 'thành công';
            break;
        case 'cancel':
            $status = 'đã hủy';
            break;
        case 'approved':
            $status = 'đã duyệt';
            break;
        case 'shipping':
            $status = 'đang giao hàng';
            break;
        case 'deliveried':
            $status = 'đã giao';
            break;
            
            
    }

    return $status;
}



?>





<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách hóa đơn</h6>
        </div>


        <div class="card-body">
            <div class="card-action-wrapper d-flex justify-content-between align-items-center">
                <div>
                    <a href="?page=add-order" class="card-btn">+ Thêm đơn hàng</a>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <label>Show
                            <select name="dataTable_length" aria-controls="dataTable"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </label>
                    </div>

                    <div class="mx-5">
                        <label>Search:<input type="search" class="form-control form-control-sm" placeholder="search">
                        </label>
                    </div>
                </div>
            </div>
            <!-- end card action -->


            <div class="table-responsive">
                <ul class="table-header row">

                    <li class="col-2">Họ tên</li>
                    <li class="col-2">Số điện thoại</li>
                    <li class="col-2">Tổng tiền</li>
                    <li class="col-2">Địa chỉ</li>
                    <li class="col-2">Trạng thái</li>
                    <li class="col-2"></li>
                </ul>
                <div class="table-body">
                    <ul class="align-items-center">
                        <?php
                            if($check){
                                foreach ($orders as $o) {
                                
                    
                    ?>
                        <li class="row align-items-center">
                            <div class="col-2"><?= $o['username']; ?></div>
                            <div class="col-2"><?= $o['order_phone']; ?></div>
                            <div class="col-2"><?= $o['total']; ?></div>
                            <div class="col-2"><?= $o['order_address']; ?></div>
                            <div class="col-2"><?= get_status($o['order_status']); ?></div>
                            <div class="col-2">
                                <?php 
                                    if($status == 'success' || $status == 'cancel' ) echo ' <a class="detail edit" data-id="'.$o['order_id'].'">Chi tiết</a>';
                                    else {
                                        echo '
                                        <a href="?page=orders&status=pending&id='.$o['order_id'].'" class="mx-2
                                        edit"
                                        data-id="'.$o['order_id'].'">Duyệt</a>
                                        <a href="?page=orders&status=cancel&id='.$o['order_id'].'" class="delete cancel" data-id="'.$o['order_id'].'">Hủy</a>';

                                }
                                ?>

                            </div>
                        </li>

                        <?php } }?>


                    </ul>


                </div>
                <!-- end table body -->


                <div class="card-pagination d-flex justify-content-between align-items-center">
                    <div>
                        <p>Hiển thị <span>5</span>/<span>10</span> sản phẩm</p>
                    </div>

                    <div>
                        <ul class="pagination">
                            <li class="pagination-item"><a href="" class="pagination-link">prev</a></li>
                            <li class="pagination-item"><a href="" class="pagination-link">1</a></li>
                            <li class="pagination-item"><a href="" class="pagination-link pg-active">2</a></li>
                            <li class="pagination-item"><a href="" class="pagination-link">3</a></li>
                            <li class="pagination-item"><a href="" class="pagination-link">next</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <!-- end table -->



        </div>
        <!-- end card body -->
    </div>
</div>



<section id="order_detail">

    <div class="card shadow">
        <div class="card-body">
            <div id="btn-close">X</div>
            <ul class="table-header">
                <li class="row">
                    <div class="col-2">Ảnh</div>
                    <div class="col-4">Tên sản phẩm</div>
                    <div class="col-2">Giá </div>
                    <div class="col-2">Số lượng</div>
                </li>
            </ul>
            <ul id="mainList" class="">


            </ul>
        </div>

    </div>

</section>