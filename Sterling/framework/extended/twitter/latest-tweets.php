<?php
/*
Plugin Name: Twitter Timeline for Sterling Theme
Plugin URI: 
Description: Twitter Timeline Shortcode using Twitter API version 1.1
Author: Denzel Chia
Version: 2.0
Author URI:
*/

//Code modified from http://stackoverflow.com/questions/12916539/simplest-php-example-retrieving-user-timeline-with-twitter-api-version-1-1
//create application example from http://stackoverflow.com/questions/12916539/simplest-php-example-retrieving-user-timeline-with-twitter-api-version-1-1


/*
* Add in API key settings in Site Options.
*/

function truethemes_add_twitter_api_settings($options){
$options[] = array(
			"name" => __('Twitter OAuth','tt_theme_framework'),
			"type" => "heading");

$options[] = array(
			"name"  => __('Twitter oAuth','tt_theme_framework'),
			"std"   => __('As of June 11, 2013 Twitter has shutdown their public API and the latest tweets functionality now requires the authentication credentials listed below. <strong>Need Assistance?</strong> <a href="https://support.truethemes.net/?knowledgebase=twitter-feed-down-latest-tweets-not-displaying" target="_blank">View this HelpDesk article &rarr;</a>','tt_theme_framework'),
			"class" => "heading-parent",
			"type"  => "info");
			
$options[] = array(
			"name" => __('Consumer key','tt_theme_framework'),
			"desc" => __('Enter your twitter application\'s Consumer key here.','tt_theme_framework'),
			"id"   => "twitter_api_consumer_key",
			"type" => "text");	
			
$options[] = array(
			"name" => __('Consumer secret','tt_theme_framework'),
			"desc" => __('Enter your twitter application\'s Consumer Secret here.','tt_theme_framework'),
			"id"   => "twitter_api_consumer_secret",
			"type" => "text");		
			
			
$options[] = array(
			"name" => __('Access Token','tt_theme_framework'),
			"desc" => __('Enter your twitter application\'s Access token here.','tt_theme_framework'),
			"id"   => "twitter_api_access_token",
			"type" => "text");	
									
$options[] = array(
			"name" => __('Access Token secret','tt_theme_framework'),
			"desc" => __('Enter your twitter application\'s Access Token Secret here.','tt_theme_framework'),
			"id"   => "twitter_api_access_token_secret",
			"type" => "text");	
			
$options[] = array( 
			"name"    => __('Cache Timing','tt_theme_framework'),
			"desc"    => __('Due to twitter API call limits and page loading speeds, we must cache our data. Please select the cache timing. Fresh tweets will only be updated after the cache timing expires.','tt_theme_framework'),
			"id"      => "twitter_cache_timing",
			"type"    => "select",
			"options" => array(1800=>'30 minutes',3600=>'1 hour',7200=>'2 Hours',10800=>'3 hours'));			
							
$options[] = array( 
			"name"    => __('Cache Status','tt_theme_framework'),
			"desc"    => __('Use this option to turn off cache when setting up your Tweets so that changes get reflected immediately. Remember to turn cache back on after you\'ve confirmed all is working well.','tt_theme_framework'),
			"id"      => "twitter_cache_status",
			"type"    => "select",
			"options" => array('enable'=>'Turn on Cache','disable'=>'Turn off Cache'));			
						
return $options;
}
if(class_exists('woocommerce')):
	add_filter('theme_option_woocommerce_settings','truethemes_add_twitter_api_settings');
else:
	add_filter('theme_option_jslide_settings','truethemes_add_twitter_api_settings');
endif;

/*
* function to get user timeline, does not require oAuth.
* @param string $user for username
* @param string $include_retweet, whether to include retweet or not.
* @param int $count, number of tweets to return.
*/
function truethemes_get_twitter_timeline($user,$include_retweet='true',$count){
$token = get_option('twitter_api_access_token');
$token_secret = get_option('twitter_api_access_token_secret');
$consumer_key = get_option('twitter_api_consumer_key');
$consumer_secret = get_option('twitter_api_consumer_secret');

$host = 'api.twitter.com';
$method = 'GET';
$path = '/1.1/statuses/user_timeline.json'; // api call path

$query = array( // query parameters
    'screen_name' => $user,
    'count' => $count,
    'include_rts' => $include_retweet
);

$oauth = array(
    'oauth_consumer_key' => $consumer_key,
    'oauth_token' => $token,
    'oauth_nonce' => (string)mt_rand(), // a stronger nonce is recommended
    'oauth_timestamp' => time(),
    'oauth_signature_method' => 'HMAC-SHA1',
    'oauth_version' => '1.0'
);

$oauth = array_map("rawurlencode", $oauth); // must be encoded before sorting
$query = array_map("rawurlencode", $query);

$arr = array_merge($oauth, $query); // combine the values THEN sort

asort($arr); // secondary sort (value)
ksort($arr); // primary sort (key)

// http_build_query automatically encodes, but our parameters
// are already encoded, and must be by this point, so we undo
// the encoding step
$querystring = urldecode(http_build_query($arr, '', '&'));

$url = "https://$host$path";

// mash everything together for the text to hash
$base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

// same with the key
$key = rawurlencode($consumer_secret)."&".rawurlencode($token_secret);

// generate the hash
$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

// this time we're using a normal GET query, and we're only encoding the query params
// (without the oauth params)
$url .= "?".http_build_query($query);
$url=str_replace("&amp;","&",$url); //Patch by @Frewuill

$oauth['oauth_signature'] = $signature; // don't want to abandon all that work!
ksort($oauth); // probably not necessary, but twitter's demo does it

// also not necessary, but twitter's demo does this too
//function add_quotes($str) { return '"'.$str.'"'; }
//$oauth = array_map("add_quotes", $oauth);

// this is the full value of the Authorization line
$auth = "OAuth " . urldecode(http_build_query($oauth, '', ', '));

// if you're doing post, you need to skip the GET building above
// and instead supply query parameters to CURLOPT_POSTFIELDS
$options = array( CURLOPT_HTTPHEADER => array("Authorization: $auth"),
                  //CURLOPT_POSTFIELDS => $postfields,
                  CURLOPT_HEADER => false,
                  CURLOPT_URL => $url,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_SSL_VERIFYPEER => false);         
                  
                  

// do our business
$feed = curl_init();
curl_setopt_array($feed, $options);
$json = curl_exec($feed);
curl_close($feed);

$twitter_data = json_decode($json);

return $twitter_data;

}

/*
* function to make twitter mention, link, hashtags, clickable.
* original script from http://www.snipe.net/2009/09/php-twitter-clickable-links/
*/
function truethemes_twitterify($ret) {
  $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $ret);
  $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>", $ret);
  $ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
  $ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
return $ret;
}

function truethemes_print_twitter_timeline($atts){
		extract(shortcode_atts(array(
  		'retweets' => 'true',
  		'num' => '3',
  		'user' => '', 
  		), $atts));
  		
if($retweets == 'false'){
$retweets = 0;
}
        //get PHP loaded extension names array, for checking of curl
        $extensions = get_loaded_extensions();
        //check for curl extension, if not installed disable script, show error message                
        if(!in_array('curl',$extensions)){
        $html = 'PHP curl extension is needed for twitter to work.';
        return $html;
        } 

//check if user has entered API keys, if not stop doing this.        
$token = get_option('twitter_api_access_token');
$token_secret = get_option('twitter_api_access_token_secret');
$consumer_key = get_option('twitter_api_consumer_key');
$consumer_secret = get_option('twitter_api_consumer_secret');
 
if(empty($token) || empty($token_secret) || empty($consumer_key) || empty($consumer_secret)){
        $html = 'Error - Missing API keys. Please setup Twitter oAuth API keys in Site Options.';
        return $html;
}

//set transient name using twitter username.
$transient_name = "tt_twitter_status_of_".$user;


//delete cache data if status set to Turn off Cache
$cache_status = get_option('twitter_cache_status');
if($cache_status == 'Turn off Cache'){
delete_transient("$transient_name");
}

//get cache data       
$transient = get_transient("$transient_name");

if ( empty( $transient ) ){        
//no cache data, it has expired, we get from twitter API
$twitter_status = truethemes_get_twitter_timeline($user,$retweets,$num);
$cache_timing = get_option('twitter_cache_timing');
	switch($cache_timing){
	case '30 minutes':
	$cache_timing = 1800;
	break;
	case '1 hour':
	$cache_timing = 3600;
	break;
	case '2 hour':
	$cache_timing = 7200;
	break;
	case '3 hour':
	$cache_timing = 10800;
	break;
	}

set_transient("$transient_name",$twitter_status,$cache_timing);
//echo 'new data';
}else{
//there is cache data we use it.
$twitter_status = $transient;
//echo 'cache data';
}

$html = '<ul class="twitterList">';
foreach($twitter_status as $status){
$html .= "<li><span>".truethemes_twitterify($status->text)."</span><br/>";
$html .= '<span class="tweet_days">['.human_time_diff(strtotime($status->created_at)).' ago]</span></li>';
}
$html.="</ul>";
return $html;
}
add_shortcode('latest_tweets','truethemes_print_twitter_timeline');
?>