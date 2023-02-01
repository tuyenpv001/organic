<?php 
if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");
  require("../controllers/products.php");
  $check = false;
  $total_row = 0;
  $conn = new DB_1();
  $products = $conn->get_all_data('products', 'status = 1');
  $total_row = $conn->get_num_rows('products');
  if($products && count($products) > 0) $check = true;
  $conn->disconnect();

  unset($conn);
 ?>


<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
        </div>


        <div class="card-body">
            <div class="card-action-wrapper d-flex justify-content-between align-items-center">
                <div>
                    <a href="?page=add-product" class="card-btn">+ Thêm sản phẩm</a>
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
                    <li class="col-1">Mã code</li>
                    <li class="col-1">Ảnh</li>
                    <li class="col-4">Tên sản phẩm</li>
                    <li class="col-1">Giá </li>
                    <li class="col-1">Số lượng</li>
                    <li class="col-1">Trạng thái</li>
                    <li class="col-2"></li>
                </ul>
                <div class="table-body">
                    <!-- Display List products -->
                    <ul id="list-product">
                        <?php 
                        if($check) {
                          foreach($products as $product){
                        
                     ?>
                        <li class="row align-items-center table-item">
                            <div class="col-1"><input type="checkbox" name=""></div>
                            <div class="col-1"><?= $product->get_code();   ?></div>
                            <div class="col-1">
                                <img src="<?= $product->get_image();   ?>" style="width: 75px;">
                            </div>
                            <div class="col-4"><?= $product->get_name();  ?></div>
                            <div class="col-1"><?= $product->get_price(); ?></div>
                            <div class="col-1"><?= $product->get_quantity();   ?></div>
                            <div class="col-1"><?= display_status($product->get_status());  ?></div>
                            <div class="col-2 d-flex justify-content-center">
                                <a href="?page=add-product&act=edit&id=<?= $product->get_code(); ?>" class="mx-2"><i
                                        class="fa-regular fa-pen-to-square"></i></a>
                                <a class="delete" data-id="<?= $product->get_id(); ?>"><i
                                        class="fa-regular fa-trash-can"></i></a>
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
                            <span><?= $check ? count($products) : 0; ?></span>/<span><?= $total_row ? $total_row:0;  ?></span>
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




<section class="popup-container hide">
    <div id="popup">
        <div class="popup-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="popup-body">
            <h3>Bạn có chắc chắn xóa sản phẩm này không?</h3>
        </div>

        <div class="popup-btn">

            <button id="btn-cancel" class="btn btn-secondary">
                Hủy
            </button>
            <button id="btn-ok" class="btn btn-primary">Chắc chắn</button>
        </div>
    </div>
</section>