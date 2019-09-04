<?php 
			
		function verify($email,$password){
			$errors = array();
			if (!isset($email) || strlen(trim($email)) < 1) {
				$errors[]='Email is missing or invalid';
			}
			if (!isset($password) || strlen(trim($password)) < 1) {
				$errors[]='Password is missing or invalid';
			}
			return $errors;

		}
 ?>