<?php 
	require_once("../database/config.php");
	require_once("../models/Category.php");

	class DB_Category {

		private $connect;
		function __construct()  {
			$this->connect = mysqli_connect(SERVER_NAME,USERNAME,PASSWORD,DBNAME);
			if (!$this->connect) {
		  		die("Connection failed: " . mysqli_connect_error());
			}
		}

		function __destruct() {
			// echo "Instance has beeb destroyed!!";
				mysqli_close($this->connect); 

		}

		function get_all_data($table){
			$data = array();
			
			$sql = 'select * from '.$table;

			$result = mysqli_query($this->connect,$sql);

			if(mysqli_num_rows($result) > 0){

				if(mysqli_num_rows($result) == 1){
					$data =  mysqli_fetch_assoc($result);
				}else {
					while($row = mysqli_fetch_assoc($result)){
						// $data[] = $row;
						$data[] = new Category($row['category_id'],$row['category_name']);

						// print_r($row);
					}
				}
				
			} 
		
			return $data;
		}
		

	}


 ?>