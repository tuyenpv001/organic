<?php
setlocale(LC_MONETARY, 'vi_VI');
	$product; $count_reviews = 0;
	$check = false;
	if(isset($_GET['permalink'])){
		$permalink = $_GET['permalink'];

        $conn = new DB();
        $product = $conn->get_data('products','', "product_permalink = '{$permalink}'");
        // print_r($product);
        $count_reviews = $conn->get_num_row('review', " id  = {$product['product_id']}");




	}




    if (!empty($product)) $check = true;


?>


<section class="section__name mt-60">
    <div class="container d-flex justify-content-center aligns-items-center">
        <div>
            <h2 class="product__name--main">
                <?= $check ? $product['product_name']: 'ORS - Olive Oil' ?>
            </h2>
            <span class="product__path mt-4">
                Trang chủ/ Sản phẩm /<?= $check ? $product['product_name']: 'ORS - Olive Oil' ?>
            </span>
        </div>
    </div>
</section>


<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            src="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            alt="">
                        <img data-imgbigurl="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            src="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            alt="">
                        <img data-imgbigurl="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            src="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            alt="">
                        <img data-imgbigurl="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            src="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?= $check ? $product['product_name']: 'NO NAME' ?></h3>
                    <div class="product__details__rating">
                       <!--  <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i> -->
                        <?php 
                            echo set_star_review($count_reviews);
                         ?>
                            
                        <span><?= 
                            $count_reviews
                         ?> đánh giá</span>
                    </div>
                    <div class="product__details__price"><?= $check ? product_price($product['product_price']): 'NO NAME' ?></div>
                    <p></p>
                    <form action="?page=cart" method="POST">
                        <input type="hidden" name="p_name" value="<?= $check ? $product['product_name']: 'NO NAME' ?>">
                        <input type="hidden" name="p_price"
                            value="<?= $check ? $product['product_price']: 'NO NAME' ?>"> <input type="hidden"
                            name="p_link" value="<?= $check ? $product['product_permalink']: 'NO NAME' ?>">
                        <input type="hidden" name="p_img" value="<?= $check ? $product['product_images']: 'NO NAME' ?>">
                        <input type="hidden" name="p_id" value="<?= $check ? $product['product_id']: 'NO NAME' ?>">

                        <div class="product__invo">Số lượng: <span><?= $check ? quantity_invo($product['product_quantity']): '0' ?></span></div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" name="quantity" min="1" id="quantity-max"
                                        max="<?= $check ? $product['product_quantity']: 0; ?>">
                                </div>
                            </div>
                        </div>
                        <button href="#" class="primary-btn" type="submit" name="cart">Thêm vào giở hàng</button>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    </form>
                    <!-- <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Weight</b> <span>0.5 kg</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul> -->
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="tabs nav-tabs nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Thông tin sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Đánh
                                giá</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">

                                <?= $check ? $product['product_description']: 'NO NAME' ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <?php 
                    for ($i=0; $i < 4 ; $i++) { 
                 ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                        data-setbg="<?= $check ? $product['product_images']: '.public/img/product/details/product-details-2.jpg' ?>">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a
                                href="?page=product&permalink=<?= $check ? $product['product_permalink']: '' ?>"><?= $check ? $product['product_name']: 'NO NAME' ?></a>
                        </h6>
                        <h5><?= $check ? $product['product_price']: '0' ?></h5>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</section>
<!-- Related Product Section End -->