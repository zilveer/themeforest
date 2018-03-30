<?php
	
global $espresso_twitter_settings;	
	
// Parse errors will be thrown in PHP 4
if (version_compare(PHP_VERSION, '5.0.0', '>=')) {
	include_once('TwitterAPIExchange.php');
	$espresso_twitter_settings = array(
		'oauth_access_token' => ot_get_option('twitter_oauth_access_token'),
		'oauth_access_token_secret' => ot_get_option('twitter_oauth_access_token_secret'),
		'consumer_key' => ot_get_option('twitter_consumer_key'),
		'consumer_secret' => ot_get_option('twitter_consumer_secret')
	);
} else {
	class TwitterHelper {
		function get_tweets() {
			trigger_error("Please upgrade to PHP 5 in order to use twitter widget", E_USER_ERROR);
		}
	}
}

function espresso_add_links($tweet_text) {
   $tweet_text = str_replace(array(/*':', '/', */'%'), array(/*'<wbr></wbr>:', '<wbr></wbr>/', */'<wbr></wbr>%'), $tweet_text);
   $tweet_text = preg_replace('~(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)~', '<a href="$1" target="_blank">$1</a>', $tweet_text);
   $tweet_text = preg_replace('~@([a-zA-Z0-9_]+)~', ' <a href="http://twitter.com/$1" rel="nofollow" target="_blank">@$1</a>', $tweet_text);
   $tweet_text = preg_replace('~[\s]+@([a-zA-Z0-9_]+)~', ' <a href="http://twitter.com/$1" rel="nofollow" target="_blank">@$1</a>', $tweet_text);
   $tweet_text = preg_replace('~[\s]+#([a-zA-Z0-9_]+)~', ' <a href="http://twitter.com/search?q=%23$1" rel="nofollow" target="_blank">#$1</a>', $tweet_text);
   return $tweet_text;
}