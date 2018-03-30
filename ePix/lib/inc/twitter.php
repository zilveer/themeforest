<?php

/* ------------------------------------
:: TWITTER FEED CYCLE
------------------------------------*/

	$twitteruser = ( !of_get_option("twitter_usrname") ) ? '' : of_get_option("twitter_usrname");
	$notweets    = ( !of_get_option("twitter_feednum") ) ? 5 : of_get_option("twitter_feednum");
	
	
	$consumerkey = ( !of_get_option("twitter_conkey") ) ? "5rbZijwKFEYQEV5H6htg" : of_get_option("twitter_conkey");
	$consumersecret = ( !of_get_option("twitter_consecret") ) ? "ebF7giIqkzQsyrM1Ci3AhRubWUbYbER2USAPGWAoxM" : of_get_option("twitter_consecret");
	$accesstoken = ( !of_get_option("twitter_acctoken") ) ? "163850809-K8HyFkvPh19n2UQfhHQNocIi0x9xRTjXsMw3Stn0" : of_get_option("twitter_acctoken");
	$accesstokensecret = ( !of_get_option("twitter_acctokensecret") ) ? "4I6yI3JkfeRQvYMNav9h35GDWtBDNgaQ7P1xbwUYeU" : of_get_option("twitter_acctokensecret");

	// Cache Twitter Feed
	$twitterTransient = 'themeva_twitterfeed';
	$cacheTime = 10;
	delete_transient($twitterTransient);

	if(false === ($tweets = get_transient($twitterTransient)))
	{
		require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	
		wp_deregister_script('jquery-cycle');
		wp_register_script('jquery-cycle',get_template_directory_uri().'/js/jquery.cycle.plugin.min.js',false,array('jquery'));
		wp_enqueue_script('jquery-cycle'); 
	
		$connection = new TwitterOAuth( $consumerkey, $consumersecret, $accesstoken, $accesstokensecret );
	
		$tweets = $connection->get(
			'statuses/user_timeline',
				array(
					'screen_name'     => $twitteruser,
					'count'           => $notweets
				)
		);

		if( $connection->http_code != 200 )
		{
			$tweets = get_transient($twitterTransient);
		}

		// Save Tweets to Cache
		set_transient($twitterTransient, $tweets, 60 * $cacheTime);
	}
	
	$tweets = get_transient($twitterTransient);
	
	$twitter_array = array(
		'twitter_data' => $tweets,
	);
	
	wp_deregister_script('twitter-feed');	
	wp_register_script('twitter-feed',get_template_directory_uri().'/js/twitter.feed.min.js',false,array('jquery'));
	wp_localize_script('twitter-feed', 'TWITTERFC', $twitter_array );
	wp_enqueue_script('twitter-feed');	
	
	?>

    <div class="tweets">
        <div class="tweettitle">
        	<span class="twitterfollow">
            	<a href="http://www.twitter.com/<?php echo $twitteruser; ?>">
                	<i class="fa fa-twitter"></i>
				</a>
			</span>
		</div>
        <div id="tweet_quote_wrapper">
            <div id="tweet_container"></div>
        </div>
        <br class="clear" />
    </div>