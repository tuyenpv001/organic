<div class="container_fluid bg-light">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="title-container">
                <h2 class="title--main">
                    Giỏ hàng
                </h2>
            </div>



            <div class="path-container">
                <p class="path">Trang chủ/ Giỏ hàng</p>
            </div>
        </div>
    </div>
</div>

<?php 
    ob_start();

    if(isset($_GET['mess'])){
        if($_GET['mess'] == 'success'){
            echo '
            <script>
            swal("Thành công!","Bạn đã đặt hàng thành công","success");
            </script>
            ';
        }
    }


    $check =false;
    echo "<pre>";
    // print_r($_POST);
    echo "</pre>";
    if(isset($_POST['cart'])){
        // print_r($_POST);
        $check_id = false;
        // echo $_POST['p_id'];
        if(isset($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $key => $p){
              
                if($p['p_id'] == $_POST['p_id']){
                    $_SESSION['cart'][$key]['quantity'] += $_POST['quantity'];
                    $check_id =  true;
                    // print_r($p);
                    break;
                }
            }


            if(!$check_id) $_SESSION['cart'][] = $_POST;
            
        } else $_SESSION['cart'][] = $_POST;


           

    }   
        
    if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
        $check = true;
    }

   foreach($_POST as $key =>$value) unset($_POST[$key]);

    


   ob_flush();

 ?>



<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                    if($check){

                                        foreach($_SESSION['cart'] as $p){
                                 ?>
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="<?= $p['p_img'];?>" alt="" width="150px">
                                    <h5><?= $p['p_name']?></h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <?= $p['p_price']; ?>
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="<?= $p['quantity'];?>">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    <?= $p['p_price'] * $p['quantity'];?>
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close"></span>
                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="?page=store" class="primary-btn cart-btn">Tiếp tục mua hàng</a>
                    <a href="?page=cart$act=update" class="primary-btn cart-btn cart-btn-right"><span
                            class="icon_loading"></span>
                        Cập nhật giỏ hàng</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <!-- <div class="shoping__discount">
                            <h5>Mã giảm giá</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">ÁP DỤNG</button>
                            </form>
                        </div> -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Tổng tiền</h5>
                    <ul>
                        <!-- <li>Subtotal <span>$454.98</span></li> -->
                        <li>Tổng <span>
                                <?php
                                $total = 0;
                                if($check){
                                    foreach($_SESSION['cart'] as $p){
                                        $temp = $p['quantity'] * $p['p_price'];
                                        $total += $temp;
                                    }
                                }
                                echo $total;
                            ?>
                            </span></li>
                    </ul>
                    <a href="?page=checkout" class="primary-btn">Tiến hành đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->