<?php
	session_start();
	require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
 
	$twitteruser = $_GET['twitterusername'];
	$notweets = $_GET['displaylimit'];
	$consumerkey = "Enter your consumer key here";
	$consumersecret = "Enter your consumer secret key here";
	$accesstoken = "Enter your access token here";
	$accesstokensecret = "Enter your access token secret here";
 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		return $connection;
	}
  
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	
	;
	echo json_encode($tweets);

?>