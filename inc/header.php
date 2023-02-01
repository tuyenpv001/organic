<?php
    ob_start();
	$check = false;
    if(isset($_COOKIE['user'])) $check = true;
    ob_flush();
?>


<header>
    <div class="header--top">
        <div class="header__top--left">
            <ul>
                <li> <a href="?page=contact">Liên hệ</a>
                </li>
                <li> <a href="?page=support">Hỗ trợ</a>
                </li>

            </ul>
        </div>
        <div class="header__top--right">
            <ul>
                <?php if ($check) {
                 ?>
                <li><a href="?page=user"><?= $_COOKIE['user']['username'] ; ?></a></li>


                <?php } else { ?>
                <li><a href="?page=register"><?= $check ? '' : 'Đăng ký';?></a> </li>
                <li><a href="?page=login"><?= $check ? $user['name']: 'Đăng nhập';?></a></li>
                <?php } ?>
                <li> <a href="">Us dollar</a></li>
            </ul>
        </div>
    </div>
    <nav class="nav">
        <ul class="nav__list">
            <li class="nav__item">
                <a href="http://localhost/ogranic/" class="nav__link">Trang chủ</a>
            </li>
            <li class="nav__item">
                <a href="?page=store" class="nav__link">Cửa hàng</a>
            </li>
            <li class="nav__item">
                <a href="?page=about" class="nav__link">Về chúng tôi</a>
            </li>
        </ul>

        <div id="logo">
            <img src="./public/img/logo.svg" alt="logo">
        </div>

        <ul class="nav__list">
            <li class="nav__item">
                <a class="nav__link" id="icon__search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>tìm kiếm</span>
                </a>
            </li>
            <li class="nav__item">
                <a href="?page=cart" class="nav__link">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>giỏ hàng</span>
                </a>

            </li>

            <li class="nav__item">
                <a href="" class="nav__icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="" class="nav__icon"><i class="fa-brands fa-twitter"></i></a>
                <a href="" class="nav__icon"><i class="fa-brands fa-instagram"></i></a>
            </li>
        </ul>
    </nav>
</header>