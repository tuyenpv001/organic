<?php 
		
	function set_star_review($number) {
		$result = '';
		if($number != 0) {
			for ($i=1; $i <= $number ; $i++) { 
				$result .= ' <i class="fa fa-star"></i>';
			};

			return $result;	
		};


		return '<i class="fa fa-star-o"></i>';
		

	}


 ?>