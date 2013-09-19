<?php
	session_start();

	//Include Classes
	require 'Config.php';
	require 'User.php';
	require 'KeyGenerator.php';

	//Display error if the request is GET
	if(BLOCK_GET && $_SERVER['REQUEST_METHOD'] == 'GET')
		exit(json_encode(array("status" => 0,"message"=>  "GET request not supported")));
	
	$receivedData = json_decode(file_get_contents("php://input"));

	//Display error if no JSON Object found
	if(BLOCK_NO_JSON && !is_object($receivedData))
		exit(json_encode(array("status" => 0,"message"=>  "No JSON object found")));

	
	//Create Objects
	$user     			= new User();
	$keyGen             = new KeyGenerator();
	
	if(isset($receivedData->{"type"})){
		$response = '';
		switch ($receivedData->{"type"}) {
		    case 'registerUser':
		        if(isset($receivedData->{"user"}) && isset($receivedData->{"clientID"})){
		        	$userDetails = $receivedData->{"user"};
		        	$clientID   = $receivedData->{"clientID"};

		        	$response = $user->registerUser($userDetails,$clientID);
		        }
		        else{
		        	exit(json_encode(array("status" => 0,"message"=> "All fields needs to be set")));
		        }
		    break;
		    case 'getSalt':
		    	if(session_id()){
    				$salt = $keyGen->generateClientSalt();
    				$_SESSION['salt']=$salt;
    				echo json_encode(array("status" => 1,"data" => $salt));
    			}
		    break;
		}
	}
	else {
	    exit(json_encode(array("status" => 0,"message"=> "All fields needs to be set")));
	}
?>
