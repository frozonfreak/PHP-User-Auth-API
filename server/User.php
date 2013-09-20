<?php
	
	class User{

		function __construct(){
			require_once 'KeyGenerator.php';
			require_once 'Config.php';
			require_once 'DB_User.php';
		}

		function __destruct() {
			 
		}
		public function registerUser($userDetails, $password){
			$keyGen     = new KeyGenerator();
			$db_user 	= new DB_User();

			//Check if user Exists
			if($db_user->checkUserEmailExists($userDetails[0]->email)){

				$salt = $keyGen->generateSalt(SALT_LENGTH);
				$hash = $keyGen->generateHash($password, $salt);
				if($db_user->insertUserToDB($userDetails, $hash, $salt))
					echo json_encode(array("status" => 1,"message"=> "User Registered"));
				else
					echo json_encode(array("status" => 0,"message"=> "User Registration Failed"));
				print_r($hash);
			}
			else
				exit(json_encode(array("status" => 0,"message"=> "User Email Exists")));
		}

		public function checkPass($password, $hash){
			if ( crypt($password, $hash) == $hash )
				return 1;
			else
				return 0;
		}
	}

?>
