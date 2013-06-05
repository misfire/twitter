<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Sticky footer</h1>
        </div>
        <p class="lead">Pin a fixed-height footer to the bottom of the viewport in desktop browsers with this custom HTML and CSS.</p>
        <p>Use <a href="./sticky-footer-navbar.html">the sticky footer</a> with a fixed navbar if need be, too.</p>
      </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

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