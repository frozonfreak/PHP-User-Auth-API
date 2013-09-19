<?php

	class KeyGenerator{

		function __construct(){
			require 'Config.php';
		}

		function __destruct() {
			 
		}

		public function generateClientSalt() {
		    require 'Config.php';
		    $characters = CLIENT_SALT_CHARACTERS;
		    $randomString = '';
		    for ($i = 0; $i < 10; $i++) {
		        $randomString .= $characters[rand(0, strlen($characters) - 1)];
		    }
		    unset($characters);
		    return $randomString;
		}
	}

?>