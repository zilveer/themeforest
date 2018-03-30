<?php

class Zn_Twitter_Helper{
	static $instance = null;

	function get_instance(){
		if( null == self::$instance ){
			self::$instance = new self();
		}
		return self::$instance;
	}

	function __construct(){

	}

	static public function getConnectionWithAccessToken( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret ){
		if ( ! class_exists( 'TwitterOAuth' ) ) {
			if ( ! require_once( THEME_BASE . '/template_helpers/widgets/twitter/twitteroauth.php' ) ) {
				if(defined('WP_DEBUG') && WP_DEBUG) {
					error_log(__METHOD__. "() Error: Couldn't find TwitterOAuth.php here: " . THEME_BASE . '/template_helpers/widgets/twitter/twitteroauth.php' );
				}
				return null;
			}
		}
		$connection = new TwitterOAuth( $cons_key, $cons_secret, $oauth_token, $oauth_token_secret );
		return $connection;
	}


	static public function relative_time( $a ){
		//get current timestampt
		$b = strtotime( "now" );
		//get timestamp when tweet created
		$c = strtotime( $a );
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour   = $minute * 60;
		$day    = $hour * 24;
		$week   = $day * 7;

		if ( is_numeric( $d ) && $d > 0 ) {
			//if less then 3 seconds
			if ( $d < 3 ) {
				return __( "right now", 'zn_framework' );
			}
			//if less then minute
			if ( $d < $minute ) {
				return floor( $d ) . __( " seconds ago", 'zn_framework' );
			}
			//if less then 2 minutes
			if ( $d < $minute * 2 ) {
				return __( "about 1 minute ago", 'zn_framework' );
			}
			//if less then hour
			if ( $d < $hour ) {
				return floor( $d / $minute ) . __( " minutes ago", 'zn_framework' );
			}
			//if less then 2 hours
			if ( $d < $hour * 2 ) {
				return __( "about 1 hour ago", 'zn_framework' );
			}
			//if less then day
			if ( $d < $day ) {
				return floor( $d / $hour ) . __( " hours ago", 'zn_framework' );
			}
			//if more then day, but less then 2 days
			if ( $d > $day && $d < $day * 2 ) {
				return __( "yesterday", 'zn_framework' );
			}
			//if less then year
			if ( $d < $day * 365 ) {
				return floor( $d / $day ) . __( " days ago", 'zn_framework' );
			}
			//else return more than a year
			return __( "over a year ago", 'zn_framework' );
		}
	}


	//convert links to clickable format
	// @internal
	//@see $this->widget()
	static public function convert_links( $status, $targetBlank = true, $linkMaxLen = 250 ){
		// the target
		$target = $targetBlank ? " target=\"_blank\" " : "";

		// convert link to url
		$pattern = "/((http:\/\/|https:\/\/)[^ )]+)/";
		// $status = preg_replace( "/((http:\/\/|https:\/\/)[^ )]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status );

		$status = preg_replace_callback( $pattern, array('Zn_Twitter_Helper','replace_link'), $status );

		// convert @ to follow
		$status = preg_replace( "/(@([_a-z0-9\-]+))/i", "<a href=\"//twitter.com/$2\" title=\"Follow $2\" $target >$1</a>", $status );

		// convert # to search
		$status = preg_replace( "/(#([_a-z0-9\-]+))/i", "<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>", $status );

		// return the status
		return $status;
	}


	static public function get_twitter_script(){
		return "jQuery(window).on('load',function () { jQuery.getScript('//platform.twitter.com/widgets.js'); });";
	}

	// Internal
	//@see $this->widget()
	static public function replace_link( $matches ){
		$linkMaxLen = 250;
		$text = strlen($matches[1]) >= $linkMaxLen ? substr($matches[1],0,$linkMaxLen).'...': $matches[1];
		$return = '<a href="'.$matches[1].'" title="'.$matches[1].'" target="_blank">'. $text .'</a>';
		return $return;
	}


	/**
	 * Will return an array of tweets or WP_Error
	 * @param  array  $args the configuration
	 */
	static public function get_tweets( $args = array() ){
		$defaults = array(
			'cachetime' => 1,
			'consumerkey' => null,
			'consumersecret' => null,
			'accesstoken' => null,
			'accesstokensecret' => null,
			'username' => null,
		);

		$args = wp_parse_args( $args, $defaults );

		// Check if all needed arguments were passed
		if ( empty( $args['consumerkey'] ) ||
			 empty( $args['consumersecret'] ) ||
			 empty( $args['accesstoken'] ) ||
			 empty( $args['accesstokensecret'] ) ||
			 empty( $args['username'] ) )
		{
			return new WP_Error( 'broke', __( 'Please fill all widget/element settings!', 'zn_framework' ) );
		}


		// Get cached tweets
		$cached_tweets = get_transient('znhg_twitter_'. $args['username'] );

		if( false == $cached_tweets ){

			$connection = self::getConnectionWithAccessToken(
				$args['consumerkey'],
				$args['consumersecret'],
				$args['accesstoken'],
				$args['accesstokensecret']
			);

			if(empty($connection) || !($connection instanceof TwitterOAuth)){
				return new WP_Error( 'broke', __( "Couldn't retrieve tweets! Wrong username?", 'zn_framework' ));
			}
			$tweets = $connection->get( "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" .$args['username'] . "&count=10" );

			if ( ! empty( $tweets->errors ) ) {
				if ( $tweets->errors[0]->message == 'Invalid or expired token' ) {
					$url = 'https://dev.twitter.com/apps';
					echo '<strong>' . $tweets->errors[0]->message . '!</strong><br />' . __( "You'll need to regenerate it", 'zn_framework' ) . ' <a href="'.$url.'" target="_blank">' . __( 'here', 'zn_framework' ) . '</a>!';
				}
				else {
					echo '<strong>' . $tweets->errors[0]->message . '</strong>';
				}
				return;
			}


			$cached_tweets = array();
			for ( $i = 0; $i <= count( $tweets ); $i ++ ) {
				if ( ! empty( $tweets[ $i ] ) ) {
					$cached_tweets[ $i ]['created_at'] = $tweets[ $i ]->created_at;
					$cached_tweets[ $i ]['text']       = $tweets[ $i ]->text;
					$cached_tweets[ $i ]['status_id']  = $tweets[ $i ]->id_str;
				}
			}

			$cache_time = 60 * 60 * intval($args['cachetime']);
			set_transient('znhg_twitter_'. $args['username'], $cached_tweets, $cache_time );

		}

		return $cached_tweets;

	}
}