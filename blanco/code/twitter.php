<?php
 
function etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count) {
	
	$connection = getConnectionWithAccessToken($consumer_key,$consumer_secret,$user_token, $user_secret);
	$params = array(
		'screen_name' => $user,
		'count' => $count
	);
	
	$content = $connection->get("statuses/user_timeline",$params);
	
	//prar($content);
	
	return json_encode($content);
}

function getConnectionWithAccessToken($consumer_key,$consumer_secret,$oauth_token, $oauth_token_secret) {
	$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	return $connection;
}

function etheme_tweet_linkify($tweet) {
	$tweet = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $tweet);
	$tweet = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $tweet);
	$tweet = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $tweet);
	$tweet = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $tweet);
	return $tweet;
}


function etheme_store_tweets($file, $tweets) {
    ob_start(); // turn on the output buffering 
    $fo = fopen($file, 'w'); // opens for writing only or will creat it's not there
    if (!$fo) return etheme_print_tweet_error(error_get_last());
    $fr = fwrite($fo, $tweets); // writes to the file what was grabbed from the previouse function
    if (!$fr) return etheme_print_tweet_error(error_get_last());
    fclose($fo); // closes
    ob_end_flush(); // finishes and flushes the output buffer; 
}

function etheme_pick_tweets($file) {
    ob_start(); // turn on the output buffering 
    $fo = fopen($file, 'r'); // opens for reading only 
    if (!$fo) return etheme_print_tweet_error(error_get_last());
    $fr = fread($fo, filesize($file));
    if (!$fr) return etheme_print_tweet_error(error_get_last());
    fclose($fo);
    ob_end_flush();
    return $fr;
}

function etheme_print_tweet_error($errorArray) {
    return '<p class="eth-error">Error: ' . $errorArray['message'] . 'in ' . $errorArray['file'] . 'on line ' . $errorArray['line'] . '</p>';
}

function etheme_twitter_cache_enabled(){
	return true;
}

function etheme_print_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count, $cachetime=50) {
	if(etheme_twitter_cache_enabled()){
	    //setting the location to cache file
	    $cachefile = ETHEME_CODE_DIR . '/cache/twitterCache.json'; 
	    
	    // the file exitsts but is outdated, update the cache file
	    if (file_exists($cachefile) && ( time() - $cachetime > filemtime($cachefile)) && filesize($cachefile) > 0) {
	        //capturing fresh tweets
	        $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	        $tweets_decoded = json_decode($tweets, true);
	        //if get error while loading fresh tweets - load outdated file
	        if(! empty($tweets_decoded['error'])) {
	            $tweets = etheme_pick_tweets($cachefile);
	        }
	        //else store fresh tweets to cache
	        else
	            etheme_store_tweets($cachefile, $tweets);
	    }
	    //file doesn't exist or is empty, create new cache file
	    elseif (!file_exists($cachefile) || filesize($cachefile) == 0) {
	        $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	        $tweets_decoded = json_decode($tweets, true);
	        //if request fails, and there is no old cache file - print error
	        if($tweets_decoded['error'])
	            return 'Error: ' . $tweets_decoded['error'];
	        //make new cache file with request results
	        else
	            etheme_store_tweets($cachefile, $tweets);            
	    }
	    //file exists and is fresh
	    //load the cache file
	    else { 
	       $tweets = etheme_pick_tweets($cachefile);
	    }
	} else{
       $tweets = etheme_capture_tweets($consumer_key,$consumer_secret,$user_token,$user_secret,$user, $count);
	}

    $tweets = json_decode($tweets, true);
    $html = '';
    foreach ($tweets as $tweet) {
        $html .= '<p class="twitter-message">' . $tweet['text'] . '</p>';
    }
    $html = etheme_tweet_linkify($html);
    return $html;
}