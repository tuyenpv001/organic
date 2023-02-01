<?php 
require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
// configure globally via a JSON object


Configuration::instance([
  'cloud' => [
    'cloud_name' => 'dcdjjysyu', 
    'api_key' => '867976852253863', 
    'api_secret' => 'eexHerSDDMtye0Ci3VGlFDd7cCc'],
  'url' => [
    'secure' => true]]);

	
	function get_url_img($image){

		// $_FILES['img']['tmp_name']
		$data = (new UploadApi())->upload($image, [
			
	  		  'folder' => 'organic/', 
		]);

		return $data['secure_url'];
	}

	// if(isset($_POST["upload"])) {
	// 	// echo $_POST['img'];
	// 	print_r($_FILES['img']);
	// 	// $file = $_FILES['img'];

	// 	$data = (new UploadApi())->upload($_FILES['img']['tmp_name'], [
			
	//   		  'folder' => 'organic/', 
	// 	]);

	// 	echo $data['secure_url'];
	// }

 ?> 


 
<!--  <form method="POST" action="" enctype="multipart/form-data">
 	<input type="file" name="img">

 	<button type="submit" name="upload">upload</button>

 </form>

 -->

