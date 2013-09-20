<?php
	

	//Include Classes
	require 'Config.php';
	require 'User.php';
	require 'KeyGenerator.php';
	session_start();
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
		    case 'registerCustomer':
		        if(isset($receivedData->{"user"}) && isset($receivedData->{"password"})){
		        	if($_SESSION['salt']){
		        		$password  = $keyGen->decodePass($receivedData->{"password"}, $_SESSION['salt']);
		        		$response = $user->registerUser($receivedData->{"user"}, $password, CUSTOMER);
		        		session_destroy();
		        	}
		        	else
		        		exit(json_encode(array("status" => 0,"message"=> "Need to receive salt")));
		        	//$response = $user->registerUser($userDetails,$clientID);
		        }
		        else{
		        	exit(json_encode(array("status" => 0,"message"=> "All fields needs to be set")));
		        }
		    break;
		    case 'registerHairDresser':
		        if(isset($receivedData->{"user"}) && isset($receivedData->{"password"})){
		        	if($_SESSION['salt']){
		        		$password  = $keyGen->decodePass($receivedData->{"password"}, $_SESSION['salt']);
		        		$response = $user->registerUser($receivedData->{"user"}, $password, HDRESSER);
		        		session_destroy();
		        	}
		        	else
		        		exit(json_encode(array("status" => 0,"message"=> "Need to receive salt")));
		        	//$response = $user->registerUser($userDetails,$clientID);
		        }
		        else{
		        	exit(json_encode(array("status" => 0,"message"=> "All fields needs to be set")));
		        }
		    break;
		    case 'getSalt':
		    		//Start a temporary session to store salt.
    				$_SESSION['salt']=$keyGen->generateClientSalt();
    				echo json_encode(array("status" => 1,"data" => $_SESSION['salt']));
		    break;
		}
	}
	else {
	    exit(json_encode(array("status" => 0,"message"=> "Type field not set")));
	}

?>
