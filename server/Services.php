<?php
//Initial gateway for all calls into Server
	//Include Classes
	require 'Config.php';
	require 'User.php';

	//Display error if the request is GET
	if(BLOCK_GET && $_SERVER['REQUEST_METHOD'] == 'GET')
		die(json_encode(array("status" => 0,"message"=>  "GET request not supported")));
	
	$receivedData = json_decode(file_get_contents("php://input"));

	//Display error if no JSON Object found
	if(BLOCK_NO_JSON && !is_object(json_decode($receivedData)))
		die(json_encode(array("status" => 0,"message"=>  "No JSON object found")));

	
	//Create Objects
	$user     			= new User();

	
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
		        	die(json_encode(array("status" => 0,"message"=> "All fields needs to be set")));
		        }
		    break;
		}
	}
	else {
	    die(json_encode(array("status" => 0,"message"=> "All fields needs to be set")));
	}
?>
