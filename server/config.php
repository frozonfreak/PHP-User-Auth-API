<?php
/**
 * Database config variables
 */

//Set Debug for Localhost 
if ( $_SERVER["SERVER_ADDR"] == '127.0.0.1' || $_SERVER["SERVER_ADDR"] == '::1') {
	define("DB_STRING","mysql:host=localhost;dbname=db_reservation");
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");

	define("DEBUG",true);
}
else{
	define("DB_STRING","mysql:host=localhost;dbname=db_reservation");
	define("DB_HOST", "localhost");
	define("DB_USER", "root");
	define("DB_PASSWORD", "root");

	define("DEBUG",false);
}


/*System Definitions*/
define("Version","0.0.1");

?>