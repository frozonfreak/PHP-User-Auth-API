<?php
//Initial gateway for all calls into Server


	//Get requests from Client
	//JSON cannot work with regular $_POST and $_GET
	$data = file_get_contents("php://input");
	$receivedData = json_decode($data);
<<<<<<< HEAD
	
=======
	print_r($_SERVER);
>>>>>>> 8d55cfedbf80318f7c6799501a4f9ead88371f56
	$id = explode("/", $_SERVER['REQUEST_URI']);
	print_r($_SERVER['REQUEST_METHOD']);
	print_r($id);
	
	if(is_object(json_decode($data))){
		echo "JSON Object found";
	}
	else{
		echo "Normal Object found";
	}

	if(!$id)
		die("No Valid data received");

	//Include Classes
	include_once 'Config.php';
	include_once 'User.php';


	//Create Objects
	$user     			= new User();

	
	if(isset($receivedData->{"type"})){
		$response = '';
		switch ($receivedData->{"type"}) {
		    case 'registerUser':
		        if(isset($receivedData->{"user"}) && isset($receivedData->{"clientID"})){
		        	//if(DEBUG)
		        	//	print_r($receivedData);
		        	
		        	$userDetails = $receivedData->{"user"};
		        	$clientID   = $receivedData->{"clientID"};

		        	$response = $user->registerUser($userDetails,$clientID);
		        }
		        else{
		        	$response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
		        	echo json_encode($response);
		        }
		        
		    break;
<<<<<<< HEAD
		    
=======
		    case 'registeriOSDevice':
		    	if(isset($receivedData->{"deviceToken"}) && isset($receivedData->{"clientID"})){
		        	$deviceToken = $receivedData->{"deviceToken"};
		        	$clientID   = $receivedData->{"clientID"};
		        	$IPAddress  = $receivedData->{"ipAddress"};

		        	$response = $push_notification->registeriOSDevice($deviceToken,$clientID, $IPAddress);
		        }
		        else{
		        	$response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
		        	echo json_encode($response);
		        }
		    break;
		    case 'registerProfessional':
		    	if(isset($receivedData->{"professionalDetails"}) && isset($receivedData->{"clientID"})){

		        	$professionalDetails = $receivedData->{"professionalDetails"};
		        	$clientID   = $receivedData->{"clientID"};

		        	$response = $professional->registerProfessional($professionalDetails,$clientID);
		        }
		        else{
		        	$response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
		        	echo json_encode($response);
		        }
		    break;
		    case 'registerLocation':
		    	if(isset($receivedData->{"locationDetails"}) && isset($receivedData->{"clientID"})){

		        	$locationDetails = $receivedData->{"locationDetails"};
		        	$clientID   = $receivedData->{"clientID"};

		        	$response = $location->registerLocation($locationDetails,$clientID);
		        }
		        else{
		        	$response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
		        	echo json_encode($response);
		        }
		    break;
		    case 'checkStatus':
		    	if(isset($receivedData->{"clientID"})){

		        	$clientID   = $receivedData->{"clientID"};

		        	$response = $system->checkStatus($clientID);
		        }
		        else{
		        	$response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
		        	echo json_encode($response);
		        }
		    break;
		    case 'getUserList':
		    	if(isset($receivedData->{"clientID"})){

		        	$clientID   = $receivedData->{"clientID"};

		        	$response = $user->getUserList($clientID);
		        }
		        else{
		        	$response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
		        	echo json_encode($response);
		        }
		    break;
>>>>>>> 8d55cfedbf80318f7c6799501a4f9ead88371f56
		}
	}
	else {

	    $response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
	    echo json_encode($response);
	}
?>
