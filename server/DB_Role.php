<?php

	class DB_Role{

		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
		}
		public function getRoleID($roleName){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$stmt = $db->prepare('SELECT role_id FROM user_role WHERE role_name=?');
				$stmt->execute(array($roleName));
				$row = $stmt->fetch();
				return $row[0];

			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "Unable to query database")));
			}
		}
		
		
	}

?>
