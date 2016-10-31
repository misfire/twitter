<?php

//require 'app_tokens.php';
//require 'tmhOAuth.php';
require_once('TwitterAPIExchange.php');

$settings = array(
    'oauth_access_token' => "zZfosXqiJtfg4mSCraog",
    'oauth_access_token_secret' => "fOovLCOqh1eGW0S5loLrXIwpuJnipPJbGd8cVY0tc",
    'consumer_key' => "14993946-w3QgA5cpYi3va2XWI6QunJ3giVld9oXNneOlxseDf",
    'consumer_secret' => "NEhmjZNofrT6MmAneIFs5F8m8987hZt1fpQa1f5KBpE"
);

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=dannychenmusic&count=20';

//$connection = new tmhOAuth(array('consumer_key'=> $consumer_key, 'consumer_secret' => $consumer_secret,
// 'user_token' => $user_token, 'user_secret' => $user_secret));

$connection = new TwitterAPIExchange($settings);

//Get my timeline info!!!


$connection->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();

//$connection->request('GET',$connection->url('1.1/statuses/user_timeline'),
 // array('screen_name'=>'dannychenmusic'));

//get HTTP response code for api request

$response_code = $connection->response['code'];

//convert the json response into an array

$response_data = json_decode($connection->response['response'],true);

// 200 success
if($response_code<>200){
  print "Error: $response_code\n";

}

// Display the response array FOR DEBUGS

//print_r($response_data);


?>

<?php
/**
 * convert @user_mentions into links!!
 * 
 */
function linkEnts($response) {

    // Convert tweet text to array of one-character strings
    $tweetstring = str_split($response['text']);

    // Insert starting and closing link tags at indices...

    // @user_mentions :D
    foreach ($response['entities']['user_mentions'] as $ent) {
        $link = "https://twitter.com/" . $ent['screen_name'];       
        $tweetstring[$ent['indices'][0]] = "<a href=\"$link\">" . $tweetstring[$ent['indices'][0]];
        $tweetstring[$ent['indices'][1] - 1] .= "</a>";         
    }

    // for #hashtags
    foreach ($response['entities']['hashtags'] as $ent) {
      $link = "https://www.twitter.com/search?q=%23" . $ent['text'];
      $tweetstring[$ent['indices'][0]] = "<a href=\"$link\">" . $tweetstring[$ent['indices'][0]];
      $tweetstring[$ent['indices'][1] - 1] .= "</a>";

    }

    // for hyperlinks

    foreach ($response['entities']['urls'] as $ent) {
      $link = $ent['expanded_url'];
      $tweetstring[$ent['indices'][0]] = "<a href=\"$link\">" . $tweetstring[$ent['indices'][0]];
      $tweetstring[$ent['indices'][1] - 1] .= "</a>";

    }

    // Convert array back to string
    $result = implode('', $tweetstring);
    return $result;

}
?>  

<!DOCTYPE html>
<html>
  <head>
    <title>Danny's Code Samples</title>
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

          <h1>Danny's Code Samples</h1>
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
    
    <?php echo linkEnts($response_data[0]) ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data[0]['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[1]['user']['screen_name'] . ">" . $response_data[1]['user']['name'] . "</a>" ?></h4>
    
    <?php echo linkEnts($response_data[1]) ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data[1]['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[2]['user']['screen_name'] . ">" . $response_data[2]['user']['name'] . "</a>" ?></h4>
    
    <?php echo linkEnts($response_data[2]) ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data[2]['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[3]['user']['screen_name'] . ">" . $response_data[3]['user']['name'] . "</a>" ?></h4>
    
    <?php echo linkEnts($response_data[3]) ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data[3]['created_at'])); ?> </p>
  </div>
</div>

<div class="media">
  <a class="pull-left" href="#">
    <img class="media-object" data-src="holder.js/64x64" src="http://a0.twimg.com/profile_images/3304148517/ca5b7a3855c7293f78bd755373656146_normal.jpeg">
  </a>
  <div class="media-body">
    <h4 class="media-heading"><?php echo "<a href=" . "http://www.twitter.com/" . $response_data[4]['user']['screen_name'] . ">" . $response_data[4]['user']['name'] . "</a>" ?></h4>
    
    <?php echo linkEnts($response_data[4]) ?>


       <p> <?php echo date("l M j \- g:ia",strtotime($response_data[4]['created_at'])); ?> </p>
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

