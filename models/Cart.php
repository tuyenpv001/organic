 <?php

 	require_once("./Product.php");

	trait UserInfor {
	  function get_user(){
	  	return true;
	  }
	}





	class Cart extends Product{
		use UserInfor;

	}
?> 