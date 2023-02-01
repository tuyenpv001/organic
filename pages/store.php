<?php 
    ob_start();
    $check  = false;
    $conn = new DB();
    $products = $conn->get_data('products',"product_permalink,product_name,product_images,product_price,product_category" );
    if(!empty($products)) $check = true;
    // print_r($products);
    $categories = $conn->get_data('categories', 'category_name');
    $conn->disconnect();
    unset($conn);

    ob_flush();


 ?>

<div class="container_fluid bg-light">
    <div class="container">
        <div class="title d-flex align-items-center justify-content-between">
            <div class="title-container">
                <h2 class="title--main">
                    Cửa hàng
                </h2>
            </div>



            <div class="path-container">
                <p class="path">Trang chủ/ cửa hàng</p>
            </div>
        </div>
    </div>
</div>





<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Danh Mục</h4>
                        <ul>
                            <?php 
                                if(!empty($categories)){
                                    foreach($categories as $c) {
                                
                             ?>
                           
                            <li><a href="?page=store&categories=<?=$c['category_name']  ?>"><?= ucwords($c['category_name'])  ?></a></li>

                        <?php } } ?>
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Price</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10" data-max="540">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Sản phẩm mới nhất</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <?php 
                                        if($check) {
                                            foreach($products as $p){
                                        
                                     ?>
                                    <a href="?page=product&permalink=<?= $p['product_permalink']; ?>"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="<?= $p['product_images'];  ?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?= $p['product_name']; ?></h6>
                                            <span><?= product_price($p['product_price']); ?></span>
                                        </div>
                                    </a>

                                    <?php }  }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Siêu khuyến mãi</h2>
                    </div>
                    <div class="row">
                        <div class="product__discount__slider owl-carousel">
                            <?php 
                                    if($check) {
                                            foreach($products as $p){
                                        
                                     ?>
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg"
                                        data-setbg="<?= $p['product_images'];  ?>">
                                        <div class="product__discount__percent">-20%</div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span><?= ucwords(get_category_by_id($p['product_category'])); ?></span>
                                        <h5><a
                                                href="?page=product&permalink=<?= $p['product_permalink'];  ?>"><?= $p['product_name'];  ?></a>
                                        </h5>
                                        <div class="product__item__price"><?= product_price($p['product_price']);  ?>
                                            <span>0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }  }?>
                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sắp xếp</span>
                                <select>
                                    <option value="0">Mặc định</option>
                                    <option value="1">Thấp tới cao</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6><span>16</span>Sản phẩm</h6>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <?php 
                        if($check) {
                                foreach($products as $p){
                                        
                        ?>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="<?= $p['product_images'];?>">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a
                                        href="?page=product&permalink=<?= $p['product_permalink'];?>"><?= $p['product_name'];?></a>
                                </h6>
                                <h5 class="price__unit"><?= product_price($p['product_price']);?></h5>
                            </div>
                        </div>
                    </div>

                    <?php
                            }    } 
                    ?>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Product Section End -->