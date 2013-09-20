<?php
/**
 * Database config variables
 */

//Set Debug for Localhost 
if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' || $_SERVER["SERVER_ADDR"] == '::1') {
	define("DB_STRING","mysql:host=localhost;dbname=db_user_auth");
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");

	define("DEBUG",true);
}
else{
	define("DB_STRING","mysql:host=localhost;dbname=db_user_auth");
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");

	define("DEBUG",false);
}

define("BLOCK_GET", true);
define("BLOCK_NO_JSON", false);

//Timeout for new registration
//Time in seconds
define("CLIENT_SALT_LENGTH", 10);
define("CLIENT_SALT_CHARACTERS","0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");

//DB Storage SALT
define("SALT_LENGTH", 10);
define("TIMEOUT_REGISTRATION", 600);

//User ROLES
define("CUSTOMER", 'Customer');
define("HDRESSER", 'HairDresser');
define("ADMIN", 'Admin');
define("SUPERADMIN", 'SuperAdmin');


/*System Definitions*/
define("Version","0.0.1");

?>