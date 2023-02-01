<?php 
    if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");
  require("../controllers/db.php");
  $check = false;
  $total_row = 0;
  $conn = new DB();
  $users = $conn->get_all_data('user', "role = 'member'");
  if($users && count($users) > 0) $check = true;

  // print_r($users);



  if(isset($_GET['act']) && $_GET['act'] == 'active' && isset($_GET['id'])){
        $data = array('status' => 1);

        $result = $conn->update_data('user',$data, " user_id  = {$_GET['id']}");
        if($result) {
            echo '<script>
            swal("Kích hoạt", "Kích hoạt tài khoản thành công!!", "success");
            </script>';
        }
  }










  $conn->disconnect();
  unset($conn);
  function get_status($status){
    if($status) return "đã kích hoạt";
    return "Chưa kích hoạt";
  }
 ?>


<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách nhân viên</h6>
        </div>


        <div class="card-body">
            <div class="card-action-wrapper d-flex justify-content-between align-items-center">
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

                <div class="d-flex justify-content-between align-items-center">
                    <label>Search:<input type="search" id="search-product" name="search"
                            class="form-control form-control-sm" placeholder="search">
                    </label>
                </div>
            </div>
        </div>
        <!-- end card action -->


        <div class="table-responsive">
            <ul class="table-header row">
                <li class="col-1"><span class="square"></span></li>
                <li class="col-2">Họ và tên</li>
                <li class="col-2">Email</li>
                <li class="col-2">Số điện thoại</li>
                <li class="col-2">Trạng thái</li>
                <li class="col-2"></li>
            </ul>
            <div class="table-body">
                <!-- Display List products -->
                <ul id="list-product">
                    <?php 
                        if($check) {
                          foreach($users as $u){
                        
                     ?>
                    <li class="row align-items-center table-item">
                        <div class="col-1"><input type="checkbox" name=""></div>
                        <div class="col-2"><?= $u['username'];  ?></div>
                        <div class="col-2"><?= $u['email']; ?></div>
                        <div class="col-2"><?= $u['number_phone'];   ?></div>
                        <div class="col-2"><?= get_status($u['status']);   ?></div>
                        <div class="col-2 d-flex justify-content-center">
                            <?php 
                                if($u['status']) echo '<a class="?page=members&act=delete&id="'.$u['user_id'].'"
                                data-id="'.$u['user_id'].'"><i class="fa-regular fa-trash-can"></i></a>';
                                else echo '<a href="?page=members&act=active&id="'.$u['user_id'].'" class="mx-2 edit">kích
                                hoạt</a>';
                            ?>


                        </div>
                    </li>
                    <?php 
                          } }
                       ?>
                </ul>
                <!-- End display list products -->
            </div>
            <!-- end table body -->


            <div class="card-pagination d-flex justify-content-between align-items-center">
                <div>
                    <p>Hiển thị
                        <span><?= $check ? count($users) : 0; ?></span>/<span><?= $total_row ? $total_row:0;  ?></span>
                        sản phẩm
                    </p>
                </div>

                <div>
                    <ul class="pagination">
                        <li class="pagination-item"><a href="" class="pagination-link">Prev</a></li>
                        <li class="pagination-item"><a href="" class="pagination-link">1</a></li>
                        <li class="pagination-item"><a href="" class="pagination-link pg-active">2</a></li>
                        <li class="pagination-item"><a href="" class="pagination-link">3</a></li>
                        <li class="pagination-item"><a href="" class="pagination-link">Next</a></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- end table -->



    </div>
    <!-- end card body -->
</div>
</div>