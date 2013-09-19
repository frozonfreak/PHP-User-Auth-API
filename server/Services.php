<?php
//Initial gateway for all calls into Server


	//Get requests from Client
	//JSON cannot work with regular $_POST and $_GET
	$data = file_get_contents("php://input");
	$receivedData = json_decode($data);
	
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
		    
		}
	}
	else {

	    $response = array("status" => 0,
	                      "message"=> "All fields needs to be set");
	    echo json_encode($response);
	}
?>
