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
		public function insertUserToDB($userDetails, $hash, $salt){
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
				if($stmt->execute(array(':first_name' => $userDetails[0]->firstName, ':last_name'=> $userDetails[0]->surName, ':contact_no'=> $userDetails[0]->contactNo, ':contact_email'=> $userDetails[0]->email, ':password_hash'=> $hash, ':salt'=> $salt, ':avatar'=> '0', ':fb_id'=> '0', ':role_id'=> '0', ':gender'=> $userDetails[0]->gender, ':status'=> '1')))
					return true;
				else
					return false;
			}
			catch(Exception $e){
				exit(json_encode(array("status" => 0,"message"=> "Unable to query database")));
			}
		}
		public function checkUserExists($userDetails){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$sql = "SELECT id FROM user WHERE first_name=? AND last_name=?";
				$stmt = $db->prepare($sql);
				$stmt->execute(array($userDetails[0]->firstName, $userDetails[0]->surName));
				$response = $stmt->fetchAll();
if(DEBUG)	
	print_r($response[0]->id);
				$db = null;
				if(count($response)>0)
					return true;
				else
					return false;
			}
			catch(Exception $e){
				$db = null;
				$response = array("status" => 0,"message"=> $e);
				die(json_encode($response));
			}
		}
		public function registerUser($userDetails, $clientID, $locationID, $dresserID){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$sql = "INSERT INTO user(first_name, last_name, gender, preferred_location_id, preferred_dresser_id, client_id, register_date) values (:first_name, :last_name, :gender, :preferred_location_id, :preferred_dresser_id, :client_id, NOW())";
				$response = $db->prepare($sql);
				$response->execute(array(':first_name' => $userDetails[0]->firstName, ':last_name' => $userDetails[0]->surName, ':gender' => $userDetails[0]->gender, ':preferred_location_id' => $locationID, ':preferred_dresser_id' => $dresserID, ':client_id' => $clientID));
				$db = null;
				return 1;
			}
			catch(Exception $e){
				$db = null;
				$response = array("status" => 0,"message"=> $e);
				die(json_encode($response));
			}
		}
		public function getUserList($clientID){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$sql = "SELECT * FROM user WHERE client_id=?";
				$stmt = $db->prepare($sql);
				$stmt->execute(array($clientID));
				$response = $stmt->fetchAll();
if(DEBUG)	
	print_r($response[0]->id);
				$db = null;
				return $response;
			}
			catch(Exception $e){
				$db = null;
				$response = array("status" => 0,"message"=> $e);
				die(json_encode($response));
			}
		}
		public function getUserIDfromClientID($clientID){
			try{
				$db = new PDO(DB_STRING, DB_USER, DB_PASSWORD);
				$sql = "SELECT id FROM user WHERE client_id=?";
				$stmt = $db->prepare($sql);
				$stmt->execute(array($clientID));
				$response = $stmt->fetchAll();
if(DEBUG)	
	print_r($response[0]->id);
				$db = null;
				return $response;
			}
			catch(Exception $e){
				$db = null;
				$response = array("status" => 0,"message"=> $e);
				die(json_encode($response));
			}
		}

	}

?>
