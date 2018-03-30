<?php
/*
 * Thanks https://github.com/micc83/Twitter-API-1.1-Client-for-Wordpress
 *
 * Twitter Widget
 *
 * @author 		SamaThemes
 * @category 	Widgets
 * @extends 	WP_Widget
 * @version 1.2.4
 */
 
add_action('widgets_init', 'Sama_Widget_Twitter::register_this_widget');

class Sama_Widget_Twitter extends WP_Widget {
	
	protected $_transient_key = 'sama-tweet';
	
	function __construct() {
	
		$widget_ops = array(
				'classname'   => 'widget-twitter-feed',
				'description' => __( 'Show recent twitter feed!', 'theme-majesty')
		);
		
		parent::__construct('widget-twitter-feed', 'SAMA :: '. __('Twitter', 'theme-majesty'), $widget_ops );	
		$this->_transient_key = $this->_transient_key . $this->id_base;
	}
	
	static function register_this_widget () {
		register_widget(__class__);
	}
	
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget ($args, $instance) {
	
		extract($args);
		
		$title      		= apply_filters( 'widget_title', $instance['title']);
		$numbers      		= absint( $instance['numbers']);
		$username  			= esc_attr( $instance['username']);
		$apikey  		= $instance['apikey'];
		$apisecret  	= $instance['apisecret'];
		$updatetime			= absint( $instance['updatetime'] );
		$bearer_token		= $instance['bearer_token'];
		
		if ( isset( $bearer_token ) && $bearer_token == false ) {
			return;
		}
		
		echo $before_widget;
		
		if ( ! empty( $title ) ) { 
			echo $before_title . $title . $after_title;
		}
		
		if ( false === ( $tweets = get_transient( $this->_transient_key ) ) ) {
			
			$query = 'count='.$numbers.'&include_entities=true&include_rts=true&screen_name='.$username.'';		
			$tweets = $this->query( $query, $bearer_token );
			if ( $tweets == false ) {
				// if connection failure
			} else {
				$tweets = $this->get_recent_tweet( $tweets );
				set_transient( $this->_transient_key, $tweets, $updatetime );
			}
		}
		
		if ( $tweets ) { ?>
			<ul class="tweet">
				<?php foreach( $tweets as $tweet ) { ?>
					<li><p><i class="fa fa-twitter<?php if( is_rtl() ) { echo ' fa-flip-horizontal';} ?>"></i>
						<?php echo $tweet['text']; ?>
						<br/><?php echo $tweet['time']; ?>
					</p></li>
		<?php } ?>
			</ul>
		<?php 
		
		}
		echo $after_widget;
	}
	
	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update ($new_instance, $old_instance) {
		
		$instance 						= $old_instance;
		$instance['title']      		= esc_attr( $new_instance['title'] );
		$instance['username']  			= esc_attr( $new_instance['username'] );
		$instance['apikey']  		= wp_strip_all_tags( $new_instance['apikey'] );
		$instance['apisecret']  	= wp_strip_all_tags( $new_instance['apisecret'] );
		$instance['updatetime']  		= absint( $new_instance['updatetime'] );
		
		$bearer_token = $this->get_bearer_token( $instance['apikey'], $instance['apisecret'] );
		if ( $bearer_token == false ) {
			$instance['bearer_token'] 	 = false;
			$instance['apisecret']  = '';
		} else {
			$instance['bearer_token'] = $bearer_token;
		}
		
		if ( absint($new_instance['numbers']) != 0 ) {
			$instance['numbers'] = $new_instance['numbers'];
		}
		delete_transient( $this->_transient_key );
		
		return $instance;		
	}
	
	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
	
		$defaults = array( 
			'title'				=> '',
			'username' 			=> '', 
			'numbers' 			=> '5',
			'apikey'		=> '',
			'apisecret'	=> '',
			'updatetime'		=> 3600,
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults);
	?>
		<?php
			if( isset( $instance['bearer_token'] ) && $instance['bearer_token'] == false ) {
				echo '<p>'. __( 'Can\'t get the bearer token, check your credentials', 'theme-majesty' ) . '</p>';
			}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e( 'Twitter Username:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('username'); ?>" id="<?php echo $this->get_field_id('username'); ?>" value="<?php echo esc_attr($instance['username']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numbers'); ?>"><?php _e( 'Number of Tweets:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('numbers'); ?>" id="<?php echo $this->get_field_id('numbers'); ?>" value="<?php echo absint($instance['numbers']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('apikey'); ?>"><?php _e( 'API Key:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('apikey'); ?>" id="<?php echo $this->get_field_id('apikey'); ?>" value="<?php echo wp_strip_all_tags($instance['apikey']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('apisecret'); ?>"><?php _e( 'API Secret:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="password" name="<?php echo $this->get_field_name('apisecret'); ?>" id="<?php echo $this->get_field_id('apisecret'); ?>" value="<?php echo wp_strip_all_tags($instance['apisecret']); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('updatetime'); ?>"><?php _e( 'Update time in seconds:', 'theme-majesty'); ?> </label>
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('updatetime'); ?>" id="<?php echo $this->get_field_id('updatetime'); ?>" value="<?php echo absint($instance['updatetime']); ?>" />
		</p>
						
	<?php
	}
	
	/**
	 * Get the token from oauth Twitter API
	 *
	 * @return string Oauth Token
	 */
	private function get_bearer_token( $apikey, $apisecret ) {
			
		$bearer_token_credentials = $apikey . ':' . $apisecret;
		$bearer_token_credentials_64 = base64_encode( $bearer_token_credentials );
		
		$args = array(
				'method'                => 'POST',
				'timeout'               => 5,
				'redirection'        	=> 5,
				'httpversion'        	=> '1.0',
				'blocking'              => true,
				'headers'               => array(
											'Authorization'     => 'Basic ' . $bearer_token_credentials_64,
											'Content-Type'      => 'application/x-www-form-urlencoded;charset=UTF-8',
											'Accept-Encoding'	=> 'gzip'
				),
				'body'                  => array( 'grant_type' => 'client_credentials' ),
				'cookies'               => array()
		);
		
		$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );
		
		if ( is_wp_error( $response ) || 200 != $response['response']['code'] ) {
			$result = false;
		} else {
			$result = json_decode( $response['body'] );
		}
		
		return $result->access_token;			
	}
	
	/**
	 * Query twitter's API
	 *
	 *
	 * @param string $query Insert the query in the format "count=1&include_entities=true&include_rts=true&screen_name=micc1983!
	 * @param string $bearer_token
	 *
	 * @return bool|object Return an object containing the result
	 */
	public function query( $query, $bearer_token ) {
			
			$args = array(
				'method'			=> 'GET',
				'timeout'			=> 5,
				'redirection'		=> 5,
				'httpversion'		=> '1.0',
				'blocking'			=> true,
				'headers'           => array(
										'Authorization'     => 'Bearer ' . $bearer_token,
										'Accept-Encoding'	=> 'gzip'
				),
				'body'               => null,
				'cookies'            => array()
			);
			
			$response = wp_remote_get( 'https://api.twitter.com/1.1/statuses/user_timeline.json?' . $query, $args );
			
			if ( is_wp_error( $response ) || 200 != $response['response']['code'] ){
				
				return false;	
			}
			
			return json_decode( $response['body'] );	
	}
	
	/**
	 * recent tweets as array.
	 *
	 * @access private
	 * @param object recent tweets.
	 * @return array recent tweets.
	 */
	private function get_recent_tweet( $tweets ) {
	
		$recent_tweets = array();
		$i = 0;
		foreach ( $tweets as $tweet ) {
			
			$text 		= esc_attr( $tweet->text );
			$urls 		= $tweet->entities->urls;
			$mentions 	= $tweet->entities->user_mentions;
			$hashtags 	= $tweet->entities->hashtags;
			
			if( $urls ){
				foreach( $urls as $url ){
					if( strpos($text,$url->url ) !== false){
						$text = str_replace( $url->url,'<a href="'.esc_url($url->url).'">'.$url->url.'</a>',$text );	
					}
				}
			}
			
			if( $mentions && true ){
				foreach( $mentions as $mention ){
					if( strpos($text,$mention->screen_name ) !== false){
						$text = str_replace("@".$mention->screen_name." ",'<a href="http://twitter.com/'.$mention->screen_name.'">@'.$mention->screen_name.'</a> ',$text);	
					}
				}
			}
			if( $hashtags && true ){
				foreach( $hashtags as $hashtag ){
					if( strpos($text,$hashtag->text) !== false ){
						$text = str_replace('#'.$hashtag->text." ",'<a href="http://twitter.com/search?q=%23'.$hashtag->text.'">#'.$hashtag->text.'</a> ',$text);	
					}
				}
			}
			
			$text = str_replace('<a ','<a rel="nofollow"', $text);
			$recent_tweets[$i]['text'] = $text;
			$recent_tweets[$i]['time'] = $this->getTimeAgo($tweet->created_at);
			$i++;
		}
		
		return $recent_tweets;
	}
	
	/**
	 * return time as twitter format.
	 *
	 * @access private
	 * @param time.
	 * @return time as twitter format time.
	 */
	private function getTimeAgo( $time ) {
	
		   	$tweettime 	= strtotime($time); // This is the value of the time difference - UK + 1 hours (3600 seconds)
		   	$nowtime 	= time();
		   	$timeago 	= ($nowtime-$tweettime);
		   	$thehours 	= floor($timeago/3600);
		   	$theminutes = floor($timeago/60);
		   	$thedays 	= floor($timeago/86400);
  			/********************* Checking the times and returning correct value */
		   	if( $theminutes < 60 ) {
				if( $theminutes < 1 ) {
					$timemessage = esc_html__('Less than 1 minute ago', 'theme-majesty');
				} elseif( $theminutes == 1 ) {
					$timemessage = sprintf( esc_html__('%d minute ago', 'theme-majesty'), $theminutes );
				} else {
					$timemessage = sprintf( esc_html__('%d minutes ago', 'theme-majesty'), $theminutes );
				}
			} elseif( $theminutes > 60 && $thedays < 1 ) {
				 if( $thehours == 1 ){
					$timemessage = sprintf( esc_html__('%d hour ago', 'theme-majesty'), $thehours );
				 } else {
					$timemessage = sprintf( esc_html__('%d hours ago', 'theme-majesty'), $thehours );
				 }
			} else {
				if( $thedays == 1 ){
					$timemessage = sprintf( esc_html__('%d yesterday', 'theme-majesty'), $thedays );
				} else {
					$timemessage = sprintf( esc_html__('%d days ago', 'theme-majesty'), $thedays );
				}
			}
		return $timemessage;	
	}
	
	
} // End of class