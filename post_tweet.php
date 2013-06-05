<?php

//Load the app keys into memory

require 'app_tokens.php';
require 'tmhOAuth.php';

//Create an OAuth Connection to TWwitter API

$connection = new tmhOAuth(array('consumer_key'=> $consumer_key, 'consumer_secret' => $consumer_secret,
 'user_token' => $user_token, 'user_secret' => $user_secret));

//send a tweet

$code = $connection->request('POST',
	$connection->url('1.1/statuses/update'),
	array('status' => 'Hello Twitter, testing my first app I developed!!!'));

// a response code of 200 is a success
if($code == 200){
	print "Tweet Sent";
}else{
	print "Error:$code";

}	

?>