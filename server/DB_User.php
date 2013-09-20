<?php

	class DB_User{

		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
		}
		public function checkUserEmailExists($userEmail){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$stmt = $db->prepare('SELECT * FROM user WHERE contact_email=?');
				$stmt->bindParam(1, $userEmail, PDO::PARAM_INT);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				return (!$row ? true : false);

			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "Unable to query database")));
			}
		}
		public function insertUserToDB($userDetails, $hash, $salt,  $roleid){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$stmt = $db->prepare ("INSERT INTO user (first_name, last_name, contact_no, contact_email, password_hash, salt, avatar, fb_id, role_id, gender, status, registration_date) VALUES (:first_name, :last_name, :contact_no, :contact_email, :password_hash, :salt, :avatar, :fb_id, :role_id, :gender, :status, NOW())");
				/*$stmt -> bindParam(':first_name', $userDetails[0]->firstName);
				$stmt -> bindParam(':last_name', $userDetails[0]->surName);
				$stmt -> bindParam(':contact_no', $userDetails[0]->contactNo);
				$stmt -> bindParam(':contact_email', $userDetails[0]->email);
				$stmt -> bindParam(':password_hash', $hash);
				$stmt -> bindParam(':salt', $salt);
				$stmt -> bindParam(':avatar', '0');
				$stmt -> bindParam(':fb_id', '0');
				$stmt -> bindParam(':role_id', '0');
				$stmt -> bindParam(':gender', $userDetails[0]->gender);
				$stmt -> bindParam(':status', '1');*/
				if($stmt->execute(array(':first_name' => $userDetails[0]->firstName, ':last_name'=> $userDetails[0]->surName, ':contact_no'=> $userDetails[0]->contactNo, ':contact_email'=> $userDetails[0]->email, ':password_hash'=> $hash, ':salt'=> $salt, ':avatar'=> '0', ':fb_id'=> '0', ':role_id'=> $roleid, ':gender'=> $userDetails[0]->gender, ':status'=> '1')))
					return true;
				else
					return false;
			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "Unable to query database")));
			}
		}
		
	}

?>
