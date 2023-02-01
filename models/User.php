<?php 

	class User {

		protected $user_id;
		protected $first_name;
		protected $last_name;
		protected $username;
		protected $email;
		protected $number_phone;
		protected $password;
		protected $token;
		protected $status;
		protected $role;


		function __construct(){}


		function get_id(){
			return $this->user_id;
		}
		function get_first_name(){
			return $this->first_name;
		}
		function set_first_name($firstname){
			$this->first_name = $firstname;
		}
		function get_last_name(){
			return $this->last_name;
		}
		function set_last_name($lastname) {
			$this->last_name = $lastname;
		}
		function get_username(){
			return $this->username;
		}
		function get_email(){
			return $this->email;
		}

		function get_phone(){
			return $this->number_phone;
		}
		function get_status(){
			return $this->status;
		}

		function get_role() {
			return $this->role;
		}
		function set_role($role){
			$this->role = $role;
		}











	}













 ?>