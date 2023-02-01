<?php 
  if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");
  require("../database/database.php");

  $conn = new DB();
  $check = false;
  $users  = $conn->get_all_data('user',"role = 'user'");
  if(count($users) != 0) $check = true;
   ?>


<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách khách hàng</h6>
        </div>


        <div class="card-body">
            <div class="card-action-wrapper d-flex justify-content-between align-items-center">
                <div>
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
                </div>

                <div class="">
                    <div class="">
                        <label>Search:<input type="search" id="search-user" name="search"
                                class="form-control form-control-sm" placeholder="search">
                        </label>
                    </div>
                </div>
            </div>
            <!-- end card action -->


            <div class="table-responsive">
                <ul class="table-header row">
                    <li class="col-1"><span class="square"></span></li>
                    <li class="col-2">Họ tên</li>
                    <li class="col-3">Email</li>
                    <li class="col-2">Số điện thoại</li>
                    <li class="col-2">Trạng thái</li>
                    <li class="col-2"></li>
                </ul>
                <div class="table-body">
                    <ul id="list-user">
                        <?php 
                          if($check){
                            foreach($users as $user){
                          
                       ?>
                        <li class="row align-items-center table-item">
                            <div class="col-1"><input type="checkbox" name=""></div>
                            <div class="col-2"><?= $user['username'];   ?></div>

                            <div class="col-3" style="text-transform: initial;"><?= $user['email'];   ?></div>
                            <div class="col-2"><?= $user['number_phone'];   ?></div>
                            <div class="col-2"><?= display_status($user['status'], 'user');  ?></div>
                            <div class="col-2 d-flex justify-content-center">
                                <a href="" class="mx-2"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href=""><i class="fa-regular fa-trash-can"></i></a>
                            </div>
                        </li>
                        <?php 
                          } }
                         ?>
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


<?php 
    $conn = null;
 ?>