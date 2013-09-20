<?php
	
	class User{

		function __construct(){
			require_once 'KeyGenerator.php';
			require_once 'Config.php';
			require_once 'DB_User.php';
			require_once 'Role.php';
		}

		function __destruct() {
			 
		}
		public function registerUser($userDetails, $password, $roleName){
			$keyGen     = new KeyGenerator();
			$db_user 	= new DB_User();
			$role 		= new Role();

			//Check if user Exists
			if($db_user->checkUserEmailExists($userDetails[0]->email)){

				$salt = $keyGen->generateSalt(SALT_LENGTH);
				$hash = $keyGen->generateHash($password, $salt);

				if($db_user->insertUserToDB($userDetails, $hash, $salt, $role->getRoleID($roleName)))
					echo json_encode(array("status" => 1,"message"=> "User Registered"));
				else
					echo json_encode(array("status" => 0,"message"=> "User Registration Failed"));
			}
			else
				exit(json_encode(array("status" => 0,"message"=> "User Email Exists")));
		}

		public function checkPass($password, $hash){
			return(crypt($password, $hash) == $hash? true: false);
		}

		public function userLogin($userID, $password){
			$db_user 	= new DB_User();
			if(!$db_user->checkUserEmailExists($userID)){
				if(this->checkPass($password, $$db_user->getPass($userID)))
					print_r("Password Matched");
				else
					print_r("Password Mismatch");
			}
			else
				exit(json_encode(array("status" => 0,"message"=> "User Does not Exists")));
		}
	}

?>
