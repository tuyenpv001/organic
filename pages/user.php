<?php 
    ob_start();
    $check = false;

    if(isset($_COOKIE['user'])){
        $check = true;
    } else header("location: ?page=login");


    if(isset($_GET['act'])){
        if($_GET['act'] == 'logout') {
            setcookie('user[first_name]', $user['first_name'], time()-3600, "/");
			setcookie('user[last_name]', $user['last_name'], time()-3600, "/");
			setcookie('user[username]', $user['username'], time()-3600, "/");
			setcookie('user[numer_phone]', $user['number_phone'], time()-3600, "/");
			setcookie('user[email]', $user['email'], time()-3600, "/");
            setcookie('user[token]', $user['token'], time()-3600, "/");
            setcookie('user[status]', $user['status'], time()-3600, "/");
            setcookie('user[role]', $user['role'], time()-3600, "/");
            unset($_COOKIE['user']);

            header("location: ?page=login");
        }
    }


    ob_flush();
 ?>


<section class="section__name mt-60">
    <div class="container d-flex justify-content-center aligns-items-center">

        <h2 class="product__name--main">
            <?= $check ? $_COOKIE['user']['username'] : 'NO NAME' ?>
        </h2>

    </div>
</section>


<section class="section__main mt-130">
    <div class="container d-flex justify-content-start">
        <a href="?page=user&act=logout">Đăng xuất</a>
    </div>

</section>