<?php

	class KeyGenerator{

		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
		}

		public function generateClientSalt() {
		    require_once 'Config.php';
		    $characters = CLIENT_SALT_CHARACTERS;
		    $randomString = '';
		    for ($i = 0; $i < 10; $i++) {
		        $randomString .= $characters[rand(0, strlen($characters) - 1)];
		    }
		    unset($characters);
		    return $randomString;
		}
		public function generateSalt($cost){
			// Create a random salt
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

			// Prefix information about the hash so PHP knows how to verify it later.
			// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
			$salt = sprintf("$2a$%02d$", $cost) . $salt;

			return $salt;

		}
		public function generateHash($password, $salt){
			return(crypt($password, $salt));
		}
		//Function to decode the pass based on salt and algo
		public function decodePass($encodedPass, $salt){
			//TO BE UPDATED
			return $encodedPass;
		}
	}

?>