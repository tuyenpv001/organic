<?php 
	require_once("../database/config.php");
	
	class DB {

		private $connect;
		function __construct()  {
			$this->connect = mysqli_connect(SERVER_NAME,USERNAME,PASSWORD,DBNAME);

			if (!$this->connect) {
		  		die("Connection failed: " . mysqli_connect_error());
			}

		}

		// function get_connect() {
		// 	return $this->connect;
		// }
		function disconnect(){
			mysqli_close($this->connect);
		}
			

		//GET DATA 
		/*
			@table - name table
		*/
		function get_all_data($table, $where=''){
			$data = array();
			$where = !empty($where) ? " where {$where} " : "";
			$sql = 'select * from '.$table.' '.$where;

			$result = mysqli_query($this->connect,$sql);

			if(mysqli_num_rows($result) > 0){

				// if(mysqli_num_rows($result) == 1){
					// $data =  mysqli_fetch_assoc($result);
				// }else {
					while($row = mysqli_fetch_assoc($result)){
						$data[] = $row;
					}
				// }
				
			} 

			return $data;
		}

		function get_data($table,$column='', $where = '') {
			$data = array();

			$where = !empty($where) ? " where {$where} " : "";
			if(empty($column))
				$sql = 'select * from '.$table.$where;
			$sql = 'select '.$column.' from '.$table.$where;
			$result = mysqli_query($this->connect,$sql);

			if(mysqli_num_rows($result) > 0){

				if(mysqli_num_rows($result) == 1){
					$data =  mysqli_fetch_assoc($result);
				}else {
					while($row = mysqli_fetch_assoc($result)){
						$data[] = $row;
					}
				}
				
			} 

			if(!empty($data)){
				return $data;
			}
			
			$data['error'] = "Empty data!!!";
			return $data;
		}


		function get_num_row($table, $where='') {
			$numb = 0;
			$where = !empty($where) ? " where {$where} " : "";
			$sql = 'select * from '.$table.' '.$where;

			$result = mysqli_query($this->connect,$sql);
			if($result)
				$numb = mysqli_num_rows($result);

			return $numb;

		}

		//INSERT DATA 
		function insert_data($table, $data){

			$column = '(';
			$values = 'values (';
			$count = 0;
			foreach ($data as $key => $value) {
				
			
				if($count == count($data) - 1){
					$column .= "{$key} ) ";
					$values .= "'".$value."') ";		
				} else {
					$column .= "{$key}, ";
					$values .= "'".$value."', ";	
				}

				$count++;
				 
			}
			
			$sql = "insert into ".$table." ".$column." ".$values;

			if(mysqli_query($this->connect,$sql)) {
				mysqli_close($this->connect);
				return 1;
			}

			return 0;
		}




		// UPDATE table_name
		// SET column1 = value1, column2 = value2, ...
		// WHERE condition; 
		function update_data($table, $data, $where=''){

			$where =  $where ? "WHERE {$where}" : '';
			$values = '';

			$count = 0;
			foreach ($data as $key => $value) {
				
			
				if($count == count($data) - 1){
					$values .= "{$key} =  '{$value}' ";
				} else {
					$values .= "{$key} =  '{$value}', ";
				}

				$count++;
				 
			}

			$sql = "update ".$table." set ".$values." ".$where;
			// echo $sql;
			if(mysqli_query($this->connect,$sql)) {
				
				return 1;
			}

			return 0;
		}




		function check_data_exists($table, $where=''){

			$where = $where ? "WHERE {$where}": '';

			$sql = "select * from ".$table." ".$where;
			$result = mysqli_query($this->connect,$sql);
			if(mysqli_num_rows($result)) {
				return 1;
			}

			return 0;
		}

	}


	
	// $conn = new DB();
	
	// if (!$conn) {
  	// 	die("Connection failed: " . mysqli_connect_error());
	// }


	// $conn->insert_data('user',$data);


 ?>