<?php

require 'app_tokens.php';
require 'tmhOAuth.php';



$connection = new tmhOAuth(array('consumer_key'=> $consumer_key, 'consumer_secret' => $consumer_secret,
 'user_token' => $user_token, 'user_secret' => $user_secret));

//Get @justinbieber's account info

$connection->request('GET',$connection->url('1.1/statuses/user_timeline'),
  array('screen_name'=>'dannychenmusic'));

//get HTTP response code for api request

$response_code = $connection->response['code'];

//convert the json response into an array

$response_data = json_decode($connection->response['response'],true);

// 200 success
if($response_code<>200){
  print "Error: $response_code\n";

}

// Display the response array

//print_r($response_data);


?>

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

          <h1>Danny's Twitter Page</h1>
             <ul class="nav nav-tabs">
      <li class="active">
        <a href="#">Twitter</a>
        </li>
        <li><a href="#">Google Maps</a></li>
        <li><a href="#">Instagram</a></li>
        </div>
        <p class="lead">This shows the latest five tweets from my twitter.</p>
         
<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[0]['user']['screen_name'] . ">" . $response_data[0]['user']['name'] . "</a>" ?></h4>
    
    <?php echo $response_data[0]['text'] ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[1]['user']['screen_name'] . ">" . $response_data[1]['user']['name'] . "</a>" ?></h4>
    
    <?php echo $response_data[1]['text'] ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[2]['user']['screen_name'] . ">" . $response_data[2]['user']['name'] . "</a>" ?></h4>
    
    <?php echo $response_data[2]['text'] ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[3]['user']['screen_name'] . ">" . $response_data[3]['user']['name'] . "</a>" ?></h4>
    
    <?php echo $response_data[3]['text'] ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[4]['user']['screen_name'] . ">" . $response_data[4]['user']['name'] . "</a>" ?></h4>
    
    <?php echo $response_data[4]['text'] ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data['created_at'])); ?> </p>
  </div>
</div>


      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

