<?php 
	function get_open_html($name_page) {
		echo '
			<!DOCTYPE html>
			<html>
			<head>
				<title>
				'.$name_page.'
				</title>
			</head>
				<base href="http://localhost/ogranic/">
			
				
				
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

				  <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
				<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			    <!-- Css Styles -->
			    <link rel="stylesheet" href="./public/css/bootstrap.min.css" type="text/css">
			    <link rel="stylesheet" href="./public/css/font-awesome.min.css" type="text/css">
			    <link rel="stylesheet" href="./public/css/elegant-icons.css" type="text/css">
			    <link rel="stylesheet" href="./public/css/nice-select.css?v'.time().'" type="text/css">
			    <link rel="stylesheet" href="./public/css/jquery-ui.min.css" type="text/css">
			    <link rel="stylesheet" href="./public/css/owl.carousel.min.css" type="text/css">
			    <link rel="stylesheet" href="./public/css/slicknav.min.css" type="text/css">
			    <link rel="stylesheet" href="./public/css/style.css?v'.time().'" type="text/css">
			    
			<body>

		';
	}
 ?>

 	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->