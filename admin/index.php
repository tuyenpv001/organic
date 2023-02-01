<?php 
    session_start();
    if(!isset($_COOKIE['user_ad'])) header("location: http://localhost/ogranic/admin/login.php");
    require("./inc/header.php");
    require_once("./lib/lib.php");

 ?>

<?php 
    $status =  '';
    if(isset($_GET['page'])){

        if(isset($_GET['status'])) { $status = $_GET['status'];}
        $page = $_GET["page"];

        $path = "pages/{$page}.php";
        if(file_exists($path)){
            get_header($page, $status);
            require("./inc/nav.php");
            require($path);
        }
        else {
              get_header("404! Không tìm thấy trang") ;
              
            require('pages/404.php');
        }
     } 
     else {
         get_header("Trang chủ") ;
         require("./inc/nav.php");
        require("pages/index.php");
     }
    
  ?>


<?php 
    require_once("./inc/footer.php");
  ?>