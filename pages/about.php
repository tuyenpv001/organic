<div class="container_fluid bg-light">
	<div class="container">
		<div class="title d-flex align-items-center justify-content-between">
				<div class="title-container">
					<h2 class="title--main">
						Về chúng tôi
					</h2>
				</div>
				
			
	
				<div class="path-container">
					<p class="path">Trang chủ/ Về chúng tôi</p>
				</div>
		</div>
	</div>
</div>


<section id="about" class="container mt-main">
	<div class="about_welcome text-center">
		<h3 class="about__text">Welcome to your organic store</h3>
		<p class="about__sub__text">be heathly organic food</p>
	</div>

	<div class="about_cards row mt-60">
		<?php 
			require("./resources/resource.php");
			foreach($images_about as $value) {
		 ?>
			<div class="col-md-4">
				<div class="card">
					<div class="card__img">
						<img src="<?php echo $value['img'];  ?>" alt="img card">
					</div>
					

					<div class="card__detail">
						<h3 class="card__title">
							<?php echo $value['title'];  ?>
						</h3>
						<p class="card__text mt-30">
							<?php echo $value['sub_text'];  ?>
						</p>
					</div>
				</div>
			</div>	

		<?php 
			}
		 ?>
	</div>
</section>



<section class="container about__detail">

		<div class="row">
			<?php 
				foreach ($about_detail as $value) {
			 ?>

			 	<div class="col-md-3 d-flex justify-content-center">
			 		<div class="about__card">
			 			<span class="about__numberic">
			 				<?php echo $value["numberic"]; ?>
			 			</span>
			 			<br>
			 			<span class="about_description">
			 				<?php echo $value["description"]; ?>
			 			</span>
			 		</div>

			 	</div>

			<?php } ?>
		</div>

	
</section>