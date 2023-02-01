<?php 
	include("../database/config.php");
	include("../models/Product.php");

	class DB_1{

		private $connect;
		function __construct()  {
			$this->connect = mysqli_connect(SERVER_NAME,USERNAME,PASSWORD,DBNAME);

			if (!$this->connect) {
		  		die("Connection failed: " . mysqli_connect_error());
			}
		}

		function __destruct() {
			// echo "Instance has beeb destroyed!!";
		}
		function get_connect() {
			return $this->connect;
		}

		function disconnect(){
			mysqli_close($this->connect); 
		}

		//GET DATA 
		/*
			@table - name table
		*/
		function get_all_data($table,$where = '' ,$limit = ''){
			$data = array();
			$where = $where ? "WHERE {$where}" : ' ';
			$limit = $limit ? "LIMIT {$limit}" : "";
			$sql = 'select * from '.$table.' '.$where.' '.$limit;

			$result = mysqli_query($this->connect,$sql);

			if(mysqli_num_rows($result) > 0){

					while($row = mysqli_fetch_assoc($result)){
						$data[] = new Product($row['product_id'],$row['product_code'],$row['product_name'],
												$row['product_category'],$row['product_price'],
												$row['product_quantity'],$row['product_unit'],$row['product_tags'],
												$row['product_sub_description'],$row['product_description'],
												$row['product_images'],$row['product_permalink'],
												$row['status'],$row['product_date_add'],$row['product_expire'],$row['product_expire_unit']
												);

					
					}				
				
			} 
			
			return $data;
		}

		function get_num_rows($table, $where='') {
			$numb = 0;
			$where = !empty($where) ? " where {$where} " : "";
			$sql = 'select * from '.$table.' '.$where;

			$result = mysqli_query($this->connect,$sql);
			if($result)
				$numb = mysqli_num_rows($result);

			return $numb;

		}
		
	}



 ?>