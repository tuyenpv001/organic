
<?php 


    $conn  = new DB();

    $products = $conn->get_all_data('products','', 4);
    $categories = $conn->get_all_data('categories','', 5);
    // print_r($products);
    // print_r($categories);
    
 ?>

<!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="./public/img/categories/cat-1.jpg">
                            <h5><a href="#"><?php if(!empty($categories)) echo $categories[0]['category_name'];  ?></a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="./public/img/categories/cat-2.jpg">
                            <h5><a href="#"><?php if(!empty($categories)) echo $categories[2]['category_name'];  ?></a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="./public/img/categories/cat-3.jpg">
                            <h5><a href="#"><?php if(!empty($categories)) echo $categories[1]['category_name'];  ?></a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="./public/img/categories/cat-4.jpg">
                            <h5><a href="#"><?php if(!empty($categories)) echo $categories[3]['category_name'];  ?></a></h5>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->



       <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản Phẩm</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Tất cả</li>
                            <li data-filter=".oranges"><?php if(!empty($categories)) echo ucwords($categories[1]['category_name']);  ?></li>
                            <li data-filter=".fresh-meat"><?php if(!empty($categories)) echo ucwords($categories[0]['category_name']);  ?></li>
                            <li data-filter=".vegetables"><?php if(!empty($categories)) echo ucwords($categories[3]['category_name']);  ?></li>
                            <li data-filter=".fastfood"><?php if(!empty($categories)) echo ucwords($categories[2]['category_name']);  ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php 
                    if(!empty($products)) {
                        foreach ($products as $p) {
                 ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="<?php echo $p['product_images'] ?>">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="?page=product&permalink=<?= $p['product_permalink']; ?>"><?php echo ucwords($p['product_name']); ?></a></h6>
                                <h5><?php echo product_price($p['product_price']); ?></h5>
                            </div>
                        </div>
                    </div>

                 <?php 
                        }
                    }
                  ?>
               
               
              
             
            
              
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="./public/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="./public/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->










    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>Sản phẩm bán chạy</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                    <?php 
                                            if(!empty($products)) {
                                                foreach ($products as $p) {
                                     ?>
                             
                                <a href="?page=product&permalink=<?= $p['product_permalink']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo $p['product_images']; ?>" alt="<?php echo ucwords($p['product_name']); ?>">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo ucwords($p['product_name']); ?></h6>
                                        <span><?php echo product_price($p['product_price']); ?></span>
                                    </div>
                                </a>
                      
                                     <?php } } ?>
                                 </div>
                             <div class="latest-prdouct__slider__item">
                                        <?php 
                                                if(!empty($products)) {
                                                    foreach ($products as $p) {
                                         ?>
                             
                                <a href="?page=product&permalink=<?= $p['product_permalink']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo $p['product_images']; ?>" alt="<?php echo ucwords($p['product_name']); ?>">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo ucwords($p['product_name']); ?></h6>
                                        <span><?php echo product_price($p['product_price']); ?></span>
                                    </div>
                                </a>
                      
                                    <?php } } ?>
                                 </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>Đánh giá nhiều nhất</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                  <?php 
                                    if(!empty($products)) {
                                        foreach ($products as $p) {
                             ?>
                           
                                <a href="?page=product&permalink=<?= $p['product_permalink']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo $p['product_images']; ?>" alt="<?php echo ucwords($p['product_name']); ?>">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo ucwords($p['product_name']); ?></h6>
                                        <span><?php echo product_price($p['product_price']); ?></span>
                                    </div>
                                </a>
                           
                         <?php } } ?>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                       <?php 
                                    if(!empty($products)) {
                                        foreach ($products as $p) {
                             ?>
                           
                                <a href="?page=product&permalink=<?= $p['product_permalink']; ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="<?php echo $p['product_images']; ?>" alt="<?php echo ucwords($p['product_name']); ?>">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo ucwords($p['product_name']); ?></h6>
                                        <span><?php echo product_price($p['product_price']); ?></span>
                                    </div>
                                </a>
                           
                         <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
