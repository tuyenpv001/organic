<?php 
	session_start();
	require("./database/database.php");
	require("./plugins/sendmail.php");
	require("./inc/open_html.php");
	require("./lib/lib.php");

 ?>

<?php 
 	if(isset($_GET['page'])){
 		$page = $_GET["page"];
	 	$path = "pages/{$page}.php";
	 	if(file_exists($path)){
	 		$title_name = get_name_title($page);
	 		get_open_html($title_name);
	 		require("./inc/header.php");
	 		require($path);
	 	}
	 	else {
	 		get_open_html("404! Không tìm thấy trang");
	 		require("./inc/header.php");
	 		require('pages/404notfound.php');
	 	}
	 } 
	 else {
	 	get_open_html('Trang chủ');
	 	require("./inc/header.php");
	 	require("pages/home.php");
	 }
 	
  ?>


<?php 
 	require_once("./inc/footer.php");
  ?>

<?php 
  	require_once("./inc/close_html.php");
   ?>