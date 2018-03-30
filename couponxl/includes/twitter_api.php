<?php 


class TwitterAPIExchange {
	
    public $oauth_access_token;
    public $oauth_access_token_secret;
    public $consumer_key;
    public $consumer_secret;
    public $postfields;
    private $getfield;
    protected $oauth;
    public $username;
    public $tweets;
	public $token;
	
	
	public function __construct( $settings ) {
        if (!isset($settings['oauth_access_token'])
            || !isset($settings['oauth_access_token_secret'])
            || !isset($settings['consumer_key'])
            || !isset($settings['consumer_secret'])
            || !isset($settings['username'])
            || !isset($settings['tweets']))
        {
            return false;
        }

        $this->oauth_access_token = $settings['oauth_access_token'];
        $this->oauth_access_token_secret = $settings['oauth_access_token_secret'];
        $this->consumer_key = $settings['consumer_key'];
        $this->consumer_secret = $settings['consumer_secret'];
		$this->username = $settings['username'];
		$this->tweets = $settings['tweets'];
	}
	
	public function twitter_authenticate($force = false) {
		$api_key = $this->consumer_key;
		$api_secret = $this->consumer_secret;
		$token = $this->token;
		if($api_key && $api_secret) {
			$bearer_token_credential = $api_key . ':' . $api_secret;
			$credentials = base64_encode($bearer_token_credential);
			
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

			add_filter('https_ssl_verify', '__return_false');
			$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

			if( !is_wp_error( $response) ){

				$keys = json_decode($response['body']);
				
				if($keys) {
					$this->token = $keys->{'access_token'};
				}
			}
		}
	}
	
	public function get_tweets() {
		$this->twitter_authenticate();
		
		$token = $this->token;
		$screen_name = $this->username;
		$tweets = $this->tweets;
		
		if($token && $screen_name) {
			$args = array(
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array( 
					'Authorization' => "Bearer $token"
				)
			);
			add_filter('https_ssl_verify', '__return_false');
			$api_url = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$screen_name&count=$tweets";
			
			$response = wp_remote_get( $api_url, $args );
			
			$res = json_decode( $response['body'], true);
			
			return $res;
		}
	}
}
?>