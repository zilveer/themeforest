<?php
/* --------------------------------------------------------------------- */
/* Shortcode Lstest Twitter */
/* --------------------------------------------------------------------- */
add_shortcode('cs-latest-twitter', 'cs_latest_twitter_render');

function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
    $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
    return $connection;
}

function cs_latest_twitter_render($instance) {
	
    extract(shortcode_atts(array(
                'twittertitle' => '',
                'heading_size'=>'h4',
                'consumerkey' => '2Jd4h7mTLRi7XHlWMpX4w',
                'consumersecret' => 'M3n1cMi3HPSmpKUJNgdPFmzjlDkXIDRTf1oHZIkM',
                'accesstoken' => '1406608410-6TbCsgWzjqWD2aagTslnPd4ShxbWP9ZoFyXbiEN',
                'accesstokensecret' => 'bnd86DE8Rm8A93MlwnylOGlWc8dvmQHrjzQT8BaI',
                'tweetstoshow' => '3',
                'showavatar' => 'yes',
                'username' => 'realjoomlaman',
                    ), $instance));

    $consumer_key = $consumerkey;
    $consumer_secret = $consumersecret;
    $access_token = $accesstoken;
    $access_token_secret = $accesstokensecret;
    $twitter_id = $username;
    $show_date = $showavatar;
    $count = (int) $tweetstoshow;
    
    echo "<$heading_size>$twittertitle</$heading_size>";
    
    if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) {
    	$transName = 'list_tweets_'.$twitter_id;
    	$cacheTime = 10;
    	if(false === ($twitterData = get_transient($transName))) {
    
    		$token = get_option('cfTwitterToken_'.$twitter_id);
    
    		// get a new token anyways
    		delete_option('cfTwitterToken_'.$twitter_id);
    
    		// getting new auth bearer only if we don't have one
    		if(!$token) {
    			// preparing credentials
    			$credentials = $consumer_key . ':' . $consumer_secret;
    			$toSend = base64_encode($credentials);
    
    			// http post arguments
    			$args = array(
    					'method' => 'POST',
    					'httpversion' => '1.1',
    					'blocking' => true,
    					'headers' => array(
    							'Authorization' => 'Basic ' . $toSend,
    							'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
    					),
    					'body' => array( 'grant_type' => 'client_credentials' )
    			);
    
    			add_filter('https_ssl_verify', '__return_false');
    			$response = wp_remote_post('https://api.twitter.com/oauth2/token', $args);
    
    			$keys = json_decode(wp_remote_retrieve_body($response));
    
    			if($keys) {
    				// saving token to wp_options table
    				$token = $keys->access_token;
    			}
    		}
    		// we have bearer token wether we obtained it from API or from options
    		$args = array(
    				'httpversion' => '1.1',
    				'blocking' => true,
    				'headers' => array(
    						'Authorization' => "Bearer $token"
    				)
    		);
    
    		add_filter('https_ssl_verify', '__return_false');
    		$api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$twitter_id.'&count='.$count;
    		$response = wp_remote_get($api_url, $args);
    
    		set_transient($transName, wp_remote_retrieve_body($response), 60 * $cacheTime);
    	}
    	@$twitter = json_decode(get_transient($transName), true);
    	if($twitter && is_array($twitter)) {
    		//var_dump($twitter);
    		?>
    		<div class="twitter-box">
    			<div class="twitter-holder">
    				<div class="b">
    					<div class="tweets-container">
    						<ul id="jtwt">
    							<?php foreach($twitter as $tweet): ?>
    							<li class="jtwt_tweet">
    								<p class="jtwt_tweet_text">
    								<?php
    								$latestTweet = $tweet['text'];;
    								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
    								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
    								echo $latestTweet;
    								?>
    								</p>
    								<?php
    								$twitterTime = strtotime($tweet['created_at']);
    								$timeAgo = tp_relative_time($twitterTime);
    								?>
    								<?php if($show_date == 'yes'): ?>
    								<a href="http://twitter.com/<?php echo $tweet['user']['screen_name']; ?>/statuses/<?php echo $tweet['id_str']; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a>
    								<?php endif; ?>
    							</li>
    							<?php endforeach; ?>
    						</ul>
    					</div>
    				</div>
    			</div>
    			<span class="arrow"></span>
    		</div>
    		<?php }}
}
if (!function_exists('tp_convert_links')) {

    function tp_convert_links($status, $targetBlank=true, $linkMaxLen=250) {

        // the target
        $target = $targetBlank ? " target=\"_blank\" " : "";

        // convert link to url
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        preg_match($reg_exUrl, $status, $url);
        $status = isset($url[0])?(!empty($url[0])?str_replace($url[0],'<a '.$target.' href="'.esc_url($url[0]).'">'.$url[0].'</a>',$status):$status):$status;

        // return the status
        return $status;
    }

}
//convert dates to readable format
if (!function_exists('tp_relative_time')) {

    function tp_relative_time($a) {
        //get current timestampt
        $b = strtotime("now");
        //get timestamp when tweet created
        $c = strtotime($a);
        //get difference
        $d = $b - $c;
        //calculate different time values
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;

        if (is_numeric($d) && $d > 0) {
            //if less then 3 seconds
            if ($d < 3)
                return "right now";
            //if less then minute
            if ($d < $minute)
                return floor($d) . " seconds ago";
            //if less then 2 minutes
            if ($d < $minute * 2)
                return "about 1 minute ago";
            //if less then hour
            if ($d < $hour)
                return floor($d / $minute) . " minutes ago";
            //if less then 2 hours
            if ($d < $hour * 2)
                return "about 1 hour ago";
            //if less then day
            if ($d < $day)
                return floor($d / $hour) . " hours ago";
            //if more then day, but less then 2 days
            if ($d > $day && $d < $day * 2)
                return "yesterday";
            //if less then year
            if ($d < $day * 365)
                return floor($d / $day) . " days ago";
            //else return more than a year
            return "over a year ago";
        }
    }

}
?>