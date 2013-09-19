<?php

	class DB_User{

		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
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
