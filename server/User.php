<?php

	class User{

		function __construct(){
			require_once 'Config.php';
		}

		function __destruct() {
			 
		}
		public function registerUser($userDetails, $clientID){

			$res='';
			include_once 'DB_User.php';
			include_once 'DB_Location.php';
			include_once 'DB_Professional.php';

			$db_user 		= new DB_User();
			$db_location 	= new DB_Location();
			$db_professional = new DB_Professional();

			//Check if user already Exists

			$result = $db_user->checkUserExists($userDetails);
			if(!$result){
				$result='';
				//Get Location ID
				$result = $db_location->getLocationID($userDetails[0]->preferredLocation);
				if($result){
					$locationID = $result[0]['id'];
					$result='';
					//Get Professional ID
					$result = $db_professional->getProfessionalID($userDetails[0]->preferredDresser);
					//If all data is successfully processed - Then register user
					print_r($result[0]['id']);
					if($result){
						$res = $db_user->registerUser($userDetails, $clientID, $locationID, $result[0]['id']);
						if($res)
						    $response = array("status" => 1,
						                      "message"=> "Registration Succesfull");
						else
						    $response = array("status" => 0,
						                      "message"=> "Error updating to DB");
					}
					else{
						$response = array("status" => 0,
					                  	"message"=> "Error Retrieving Professional ID");
					}
				}
				else{
					$response = array("status" => 0,
					                  "message"=> "Error Retrieving Location ID");
				}
			}
			else{
				$response = array("status" => 0,
					              "message"=> "User Already Exists");
			}

				echo json_encode($response); 
		}
		public function getUserList($clientID){
			$res='';
			include_once 'DB_User.php';

			$db_user 		= new DB_User();

			$res = $db_user->getUserList($clientID);
			$response = array("status" => 1,
						       "message"=> "Registration Succesfull",
						       "data" => $res);
			print_r($res);
			echo json_encode($response); 
			
		}

	}

?>
