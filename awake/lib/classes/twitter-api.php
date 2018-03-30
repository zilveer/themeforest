<?php
/**
 *
 */
class Mysitemyway_Twitter {
	private static $instance;
	private $bearer_transient;
	private $tweets_transient;
	private $tweet_cache_time = 600; // Cache tweets for 10min
	
	/**
	 *
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	} // End get_instance()
	
	/**
	 *
	 */
	private function __construct() {
		$this->transien_names();
	} // End __construct()
	
	/**
	 *
	 */
	private function transien_names() {
		$theme_name = strtolower( THEME_NAME );
		$this->bearer_transient = $theme_name . '_msmw_twitter_bearer_token';
		$this->tweets_transient = '_' . $theme_name . '_msmw_cached_tweets';
	} // End transien_name()
	
	/**
	 *
	 */
	public function display_tweets( $username, $limit, $type ) {
		
		$username = trim( $username );
		
		// If the Twitter username is empty.... eject
		if( empty( $username ) )
			return __( 'Twitter not configured.', MYSITE_TEXTDOMAIN );
		
		$tweets = $this->get_tweets( $username );
		
		// Make sure we have at least one tweet
		if( !is_object( $tweets[0] ) )
			return __( 'No Twitter Messages.', MYSITE_TEXTDOMAIN );
		
		
		$out = '';
		$i = 0;
		foreach( $tweets as $j => $tweet ) {
			
			if( $type == 'widget' )
				$out .= '<li>';
			
			// The actual tweet
			$out .= '<a class="tweet target_blank" href="' . 'https://twitter.com/' . $username . '/status/' . $tweet->id . '">' . $tweet->text . '</a>';
			
			/*
			// Entities: "hashtags, urls, user_mentions" in that order
			foreach( $tweet->entities as $type => $entity ) {
			
				if( $type == 'hashtags' ) {
					foreach( $entity as $k => $hashtag ) {
						$out .= '<a style="display: inline;" href="https://twitter.com/search?q=%23' .
						$hashtag->text . '&src=hash" target="_blank" title="' . $hashtag->text . '">#' . $hashtag->text . '</a>&nbsp;';
					}
				
				} elseif ( $type == 'urls' ) {
					foreach( $entity as $k => $url ) {
						$out .= '<a style="display: inline;" href="' . $url->url . '" target="_blank" title="' . $url->expanded_url . '">' . $url->display_url . '</a>&nbsp;';
					}
				
				} elseif ( $type == 'user_mentions' ) {
					foreach($entity as $k => $user) {
						$out .= '<a style="display: inline;" href="https://twitter.com/' . $user->screen_name . '" target="_blank" title="' . $user->name . '">@' . $user->screen_name . '</a>&nbsp;';
					}
				}
			
			} // End foreach $tweet->entities;
			*/
			
			if( $type == 'widget' )
				$out .= '</li>';
			
			// Limit tweets that display
			$i++;
			if ( $i >= $limit ) break;
			
		} // End foreach $tweets;
		
		
		return $out;
		
	} // End display_tweets()
	
	/**
	 *
	 */
	public function get_tweets( $username ) {
	
		// We have cached tweets for this '$username' so return them
		if ( false !== ( $cached_tweets = get_transient( $username . $this->tweets_transient ) ) )
			return $cached_tweets;
		
		// If our bearer token transient isn't set we have nothing to do, so eject
		if ( false === ( $token = get_transient( $this->bearer_transient ) ) )
			return false;
		
		
		$count = 40;
		$response = false;
	
		// wp_remote_get() arguments
		$args = array(
			'httpversion' => '1.1',
			'blocking' => true,
			'headers' => array( 
				'Authorization' => "Bearer $token"
			)
		);
		add_filter( 'https_ssl_verify', '__return_false' );
		$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$username&count=$count&include_entities=true&include_rts=true";

		$request = wp_remote_get( $api_url, $args );

		// If the request was successful json_decode() the "body" and redefine '$response' variable
		if( !is_wp_error( $request ) && wp_remote_retrieve_response_code( $request ) == 200 )
		    $response = json_decode( wp_remote_retrieve_body( $request ) );
		
		// The json_decode() response from Twitter will be an array() of tweets, each tweet it's own object
		// so we'll check to make sure we have at least one tweet by doing a is_object() on '$response[0]'
		if( is_object( $response[0] ) ) {
			
			if ( false !== set_transient( $username . $this->tweets_transient, $response, $this->tweet_cache_time ) ) {
				return $response;
			} else {
				return false;
			}
			
			
		} else {
			return false;
		}
		
		
	} // End get_tweets()
	
	/**
	 * https://dev.twitter.com/docs/auth/application-only-auth
	 */
	public function verify_api( $option ) {
		
		$twitter_api_key = trim( $option['twitter_api_key'] );
		$twitter_api_secret = trim( $option['twitter_api_secret'] );
		
		// If our bearer token transient is set & the user for some reason changes their API keys delete the transient so we can re-verify
		if( ( get_transient( $this->bearer_transient ) ) && ( $twitter_api_key == '' || $twitter_api_secret == '' ) ) {
			delete_transient( $this->bearer_transient );
			return false;
		}
		
		// If both the $twitter_api_key & $twitter_api_secret are empty just return true; no need to verify
		if( $twitter_api_key == '' && $twitter_api_secret == '' )
			return true;
		
		// We need both $twitter_api_key & $twitter_api_secret to verify so if only one option is set return false;
		if( $twitter_api_key == '' || $twitter_api_secret == '' )
			return false;
		
		// Twitter's bearer token is already set, so return true;
		if ( false !== ( get_transient( $this->bearer_transient ) ) )
			return true;
		
		
		// If we're here we have both the $twitter_api_key & $twitter_api_secret variables & the transient isn't set so lets try & get a bearer token
		$response = false;

		// Construct our bearer token credential request
		$get_bearer_token = $twitter_api_key . ':' . $twitter_api_secret;
		$credentials = base64_encode( $get_bearer_token );

		// wp_remote_post() arguments
		$args = array(
			'method' => 'POST',
			'httpversion' => '1.1',
			'blocking' => true,
			'headers' => array( 
				'Authorization' => 'Basic ' . $credentials,
				'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
			),
			'body' => array( 'grant_type' => 'client_credentials' )
		);

		// Send our bearer token credential request to twitter
		add_filter( 'https_ssl_verify', '__return_false' );
		$request = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

		// If the request was successful json_decode() the "body" and redefine '$response' variable
		if( !is_wp_error( $request ) && wp_remote_retrieve_response_code( $request ) == 200 )
		    $response = json_decode( wp_remote_retrieve_body( $request ) );
		
		// We have a successful response so set the transient
		if( is_object( $response ) && isset( $response->access_token ) ) {
			
			if( set_transient( $this->bearer_transient, trim( $response->access_token ) ) ) {
				return true;
			} else {
				return false;
			}
						
		// The response was NOT successful so return false;
		} else {
			return false;
		}
		
	} // End verify_api()
	
} // End class

?>