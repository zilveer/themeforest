<?php

/**
* Social networks Api's . 
* PLEASE DO NOT MODIFY THIS FILE
*
* @author : VanThemes ( http://www.vanthemes.com )
* 
*/

/*
*   Twitter Api Connection
****************************************************************************************/
function van_twitter_connection( $api_url, $transName ){

	$consumer_key 		= van_get_option('twitter_consumer_key');
	$consumer_secret	= van_get_option('twitter_consumer_secret');

	$token                 	= get_option("van_twitter_token");
	$consumer_changes	= get_option("van_consumer_key");
	$output 			= get_transient( $transName );


	if ( empty( $output ) ) {
	
		if(  $consumer_key && $consumer_secret ){

			if ( !$consumer_changes || $consumer_changes !==  $consumer_key || !$token ) {

				// update consumer key
				update_option('van_consumer_key', $consumer_key );

				// preparing credentials
				$credentials 	= $consumer_key . ':' . $consumer_secret;
				$toSend 		= base64_encode($credentials);

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
				$response 	= wp_remote_post('https://api.twitter.com/oauth2/token', $args);
				$keys 	= json_decode( stripslashes( wp_remote_retrieve_body($response) ) );

				if( $keys ) {
					// saving token to wp_options table
					update_option('van_twitter_token', $keys->access_token );
					$token = $keys->access_token;
				}

			}
			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array('Authorization' => "Bearer $token" )
			);

			add_filter('https_ssl_verify', '__return_false');

			$response = wp_remote_get($api_url, $args);

			if (!is_wp_error($response)) {
				$output = json_decode( wp_remote_retrieve_body( $response ), true );
				set_transient($transName, $output, 60 * 5);

			} else {
				$output = get_transient( $transName );
			}

		}
	}

	return $output;

}

/*
*   Recent Tweets Functions 
****************************************************************************************/
function van_recent_tweets( $tweets_count = 4 ){

	$twitter_username 		=  van_get_option("twitter_username");;
	$output 				= "";

	if ( $twitter_username ) {
		
		$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $twitter_username  . "&count=" . $tweets_count;
		$twitter_data = van_twitter_connection( $api_url, "van_tweets_list" );
		
		if( is_array($twitter_data) ) {
			
			$output .= '<ul class="tweets-list">';
				$i = 0;
				foreach($twitter_data as $tweet){

					$i++;

				   	if( $tweet['text'] ){
				       		$the_tweet = $tweet['text'];

						// User_mentions must link to the mentioned user's profile
						if(is_array($tweet['entities']['user_mentions'])){
							foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
							$the_tweet = preg_replace( '/@'.$user_mention['screen_name'].'/i','<a href="' . esc_url( 'http://www.twitter.com/' . $user_mention['screen_name'] ) .'" target="_blank">@'.$user_mention['screen_name'].'</a>', $the_tweet);
							}
						}
						// Hashtags must link to a twitter.com search with the hashtag as the query
						if(is_array($tweet['entities']['hashtags'])){
							foreach($tweet['entities']['hashtags'] as $key => $hashtag){
								$the_tweet = preg_replace('/#'.$hashtag['text'].'/i','<a href="' . esc_url( 'https://twitter.com/search?q=%23' . $hashtag['text'] . '&src=hash' ) . '" target="_blank">#'.$hashtag['text'].'</a>',$the_tweet);
							}
						}
						// Links in Tweet text must be displayed using the display_url
						if(is_array($tweet['entities']['urls'])){
							foreach($tweet['entities']['urls'] as $key => $link){
								$the_tweet = preg_replace( '`'.$link['url'].'`', '<a href="' . esc_url( $link['url'] ) .'" target="_blank">'.$link['url'].'</a>', $the_tweet);
							}
						}

						// Time 
						$time = strtotime( $tweet['created_at'] );

						if ( ( abs( time() - $time) ) < 86400 ) $h_time = sprintf( __('%s ago','van'), human_time_diff( $time ) );
						else $h_time = date_i18n( __('F d, Y','van'), $time);

						$output .= '<li>';
							$output .= '<img src="' . VAN_IMG . '/twitter-icon.png" data-retina="' . VAN_IMG . '/twitter-icon@2x.png" class="retina" width="32" height="32" alt="" >';
							$output .= $the_tweet;
							$output .= '<span class="twitter-timestamp"><abbr title="' . date_i18n( __('F d, Y','van' ), $time) . __(' at ','van') . date_i18n( __('h:i a','van' ), $time) .'">' . $h_time . '</abbr></span>';
						$output .= '</li>';	

						if ( $i == $tweets_count ) {
							break;
						}

			
					} else {
						$output .= __("There is an error in twitter widget, please make sure that you have set up the Twitter API settings", "van");
					}
				}

			$output .= '</ul>';
		}else {
			$output .= __("There is an error in twitter widget, please make sure that you have set up the Twitter API settings", "van");
		}
	}

	return $output;

}

/*
*	Twitter followers counter
*********************************************************/
function van_twitter_followers(){

	$t_followers 		= ( get_option("van_tfollowers_count") ) ? get_option("van_tfollowers_count") : 0;
	$twitter_username 	= van_get_option("twitter_username");

	if ( $twitter_username ) {
		$api_url    = "https://api.twitter.com/1.1/users/show.json?screen_name=" . $twitter_username;
		$followers = van_twitter_connection( $api_url, "van_tfollowers_count" );

		if ( isset( $followers["followers_count"] ) && !empty( $followers["followers_count"] ) ) {
			$t_followers = $followers["followers_count"];
			update_option("van_tfollowers_count", $t_followers);
		}

	}
	echo @number_format_i18n( $t_followers );
}
/*
*	Facebook Fans Count
******************************************************************/
function van_facebook_fans( $page_id  ){

	$transName      = 'van_fans_count';
	$facebook_fans = 0;

	if ( false === ( $facebook_fans = get_transient($transName) ) ) {

		if ( is_callable("json_decode") ) {

			$response = wp_remote_get('http://graph.facebook.com/' . $page_id);

			if ( !is_wp_error($response) ) {
				$data_json = json_decode( $response['body'] );
				$facebook_fans = isset( $data_json->likes ) ? $data_json->likes : get_option($transName);
			} else {
				$facebook_fans = get_option($transName);
			}

		         update_option($transName, $facebook_fans);
			set_transient($transName, $facebook_fans, 60 * 2);

		}
	}
	echo @number_format_i18n($facebook_fans);
}

/*
*	Vimeo  subscribers Count
******************************************************************/
function van_vimeo_subscribers( $channel ){

	$transName      = 'van_vimeo_subscribers';
	$vimeo_subscribers = 0;

	if ( false === ( $vimeo_subscribers = get_transient($transName) ) ) {

		if ( is_callable("json_decode") ) {

			$response = wp_remote_get('http://vimeo.com/api/v2/channel/' . $channel . '/info.json');

			if ( !is_wp_error($response) ) {
				$data_json = json_decode( $response['body'] );
				$vimeo_subscribers = $data_json->total_subscribers;
			} else {
				$vimeo_subscribers = get_option($transName);
			}

		         update_option($transName, $vimeo_subscribers);
			set_transient($transName, $vimeo_subscribers, 60 * 2);
		}
	}
	echo @number_format_i18n($vimeo_subscribers);
}

/*
*	Youtube subscribers Count
******************************************************************/
function van_youtube_subscribers( $channel ){

	$transName      = 'van_youtube_subscribers';
	$youtube_subscribers = 0;

	if ( false === ( $youtube_subscribers = get_transient($transName) ) ) {

		if ( is_callable("json_decode") ) {

			$response = wp_remote_get('http://gdata.youtube.com/feeds/api/users/' . $channel . '?v=2&alt=json');

			if ( !is_wp_error($response) ) {
				$data_json = json_decode( wp_remote_retrieve_body($response), true );
				$youtube_subscribers = $data_json['entry']['yt$statistics']['subscriberCount'];
			} else {
				$youtube_subscribers = get_option($transName);
			}

		         update_option($transName, $youtube_subscribers);
			set_transient($transName, $youtube_subscribers, 60 * 2);

		}
	}
	echo @number_format_i18n($youtube_subscribers);
}

/*
*	Dribbble subscribers Count
******************************************************************/
function van_dribbble_followers( $user ){

	$transName      = 'van_dribbble_followers';
	$dribbble_followers = 0;

	if ( false === ( $dribbble_followers = get_transient($transName) ) ) {

		if ( is_callable("json_decode") ) {

			$response = wp_remote_get('http://api.dribbble.com/' . $user);

			if ( !is_wp_error($response) ) {
				$data_json = json_decode( wp_remote_retrieve_body($response) );
				$dribbble_followers = $data_json->followers_count;
			} else {
				$dribbble_followers = get_option($transName);
			}

		         update_option($transName, $dribbble_followers);
			set_transient($transName, $dribbble_followers, 60 * 2);

		}
	}
	echo @number_format_i18n($dribbble_followers);
}
/*
*	Google+ followers Count
******************************************************************/
function van_gplus_followers( $id )  {

	$transName      = 'van_gplus_followers';
	$gresult	       = '';
	$gplus_followers = 0;

	if ( false === ( $gplus_followers = get_transient($transName) ) ) {

		if ( is_callable("json_decode") ) {
		
			$link = "https://plus.google.com/".$id;
			$gplus = array(
				'method'    => 'POST',
				'sslverify' => false,
				'timeout'   => 30,
				'headers'   => array( 'Content-Type' => 'application/json' ),
				'body'      => '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $link . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]'
			); 
			$response = wp_remote_get( 'https://clients6.google.com/rpc', $gplus );
			if ( !is_wp_error($response) ) {

				$data_json = json_decode( wp_remote_retrieve_body($response), true );

				if ( isset( $data_json[0]['result']['metadata']['globalCounts'] ) ) {

					foreach($data_json[0]['result']['metadata']['globalCounts'] as $gcount){
						$gresult .= $gcount;  
					}

					if( 0 != $gcount){
						$gplus_followers = $gcount;
						update_option($transName, $gplus_followers);
						set_transient($transName, $gplus_followers, 60 * 2);
					} else {
						$gplus_followers = get_option($transName);
					}
				}else{
					$gplus_followers = get_option($transName);
				}


			}else{
				$gplus_followers = get_option($transName);
			}
		}

	}
	echo @number_format_i18n($gplus_followers);

 }