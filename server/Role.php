<?php
	
	class Role{

		function __construct(){
			require_once 'Config.php';
			require_once 'DB_Role.php';
		}

		function __destruct() {
			 
		}
		public function getRoleID($roleName){
			$db_role 	= new DB_Role();
			return($db_role->getRoleID($roleName));
		}

	}

?>
