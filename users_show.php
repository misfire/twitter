<?php

require 'app_tokens.php';
require 'tmhOAuth.php';



$connection = new tmhOAuth(array('consumer_key'=> $consumer_key, 'consumer_secret' => $consumer_secret,
 'user_token' => $user_token, 'user_secret' => $user_secret));

//Get @justinbieber's account info

$connection->request('GET',$connection->url('1.1/users/show'),
	array('screen_name'=>'justinbieber'));

//get HTTP response code for api request

$response_code = $connection->response['code'];

//convert the json response into an array

$response_data = json_decode($connection->response['response'],true);

// 200 success
if($response_code<>200){
	print "Error: $response_code\n";

}

// Display the response array

print_r($response_data);

print($response_data['status']['text']);


?>