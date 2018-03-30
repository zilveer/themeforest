<?php

add_action( 'widgets_init', 'tie_latest_tweet_widget' );
function tie_latest_tweet_widget() {
	register_widget( 'tie_Latest_Tweets' );
}
class tie_Latest_Tweets extends WP_Widget {

	function tie_Latest_Tweets() {
		$widget_ops 	= array( 'classname' => 'twitter-widget'  );
		$control_ops 	= array( 'width' => 250, 'height' => 350, 'id_base' => 'latest_tweets_widget' );
		parent::__construct( 'latest_tweets_widget', THEME_NAME .' - '.__( 'Twitter' , 'tie') , $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets 		= $instance['no_of_tweets'];
		$twitter_username 	= $instance['username'];
		$consumer_key 		= $instance['consumer_key'];
		$consumer_secret	= $instance['consumer_secret'];
		$widget_id 			= $args['widget_id'];
		$cacheTime			= 30;

	if( !empty($twitter_username) && !empty($consumer_key) && !empty($consumer_secret) ){

	    $token 			= get_option( 'tie_TwitterToken'.$widget_id );
		$twitter_data 	= get_transient( 'list_tweets'.$widget_id );

		if( empty( $twitter_data ) ){
		 
			if( !$token ) {
				// preparing credentials
				$credentials = $consumer_key . ':' . $consumer_secret;
				$toSend = base64_encode($credentials);
		 
				// http post arguments
				$args = array(
					'method' 		=> 'POST',
					'httpversion' 	=> '1.1',
					'blocking' 		=> true,
					'headers' 		=> array(
							'Authorization' => 'Basic ' . $toSend,
							'Content-Type' 	=> 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);
		 
				add_filter('https_ssl_verify', '__return_false');
				$response 	= wp_remote_post('https://api.twitter.com/oauth2/token', $args);
				$keys 		= json_decode(wp_remote_retrieve_body($response));
		 
				if($keys) {
					// saving token to wp_options table
					update_option( 'tie_TwitterToken'.$widget_id , $keys->access_token);
					$token = $keys->access_token;
				}
			}
			
			// we have bearer token wether we obtained it from API or from options
			$args = array(
				'httpversion' 	=> '1.1',
				'blocking' 		=> true,
				'headers' 		=> array(
						'Authorization' => "Bearer $token"
				)
			);
		 
			add_filter('https_ssl_verify', '__return_false');
			$api_url 	= "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=$twitter_username&count=$no_of_tweets";
			$response 	= wp_remote_get($api_url, $args);

			if (!is_wp_error($response)) {
				$twitter_data = json_decode(wp_remote_retrieve_body($response));
				set_transient( 'list_tweets'.$widget_id  , $twitter_data, 60 * $cacheTime);
			} 

	    }
		
		echo $before_widget;
			echo $before_title; ?>
			<a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a>
		<?php echo $after_title; 

			if( is_array($twitter_data)){
            		$i=0;
					$hyperlinks 	= true;
					$twitter_users 	= true;
					$update 		= true;
					echo '
<div class="twitter-widget-content" >
<ul class="twitter_update_list">';
		            foreach($twitter_data as $item){
		                    $msg 		= $item->text;
		                    $permalink 	= 'http://twitter.com/#!/'. $twitter_username .'/status/'. $item->id_str;
		                    $link 		= $permalink;
		                     echo '
<li class="twitter-item">
	<i class="fa fa-twitter"></i>';
		                      if ($hyperlinks){    $msg = $this->hyperlinks($msg); }
		                      if ($twitter_users){ $msg = $this->twitter_users($msg); }
		                      echo $msg;
		                    if($update) {
		                      $time = strtotime($item->created_at);
		                      if ( ( abs( time() - $time) ) < 86400 ){
		                        $h_time = sprintf( __ti( '%s ago' ), human_time_diff( $time ) );

		                      }else{
		                        $h_time = date( 'Y/m/d' , $time);
		                      }
							  echo '<small class="twitter-timestamp"><abbr title="' . date( 'Y/m/d H:i:s' , $time ) . '">' . $h_time . '</abbr></small>';
		                     }
		                    echo '</li>
';
		                    $i++;
		                    if ( $i >= $no_of_tweets ) break;
		            }
					echo '</ul> </div>
';
            	}
				else{ 
					?> <a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a> 
<?php			}
            ?>
		<?php

		echo $after_widget;
	}
	else{
		echo $before_widget;
		echo $before_title; ?>
			<a href="http://twitter.com/<?php echo $twitter_username  ?>"><?php echo $title ; ?></a>
		<?php echo $after_title; 
		echo "Error Can't Get Tweets ... incorrect account info .";
		echo $after_widget;
	}
}

	function update( $new_instance, $old_instance ) {
		$id = explode("-", $this->get_field_id("widget_id"));
		$widget_id =  $id[1] . "-" . $id[2];

		$instance 						= $old_instance;
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] 		= strip_tags( $new_instance['no_of_tweets'] );
		$instance['username'] 			= strip_tags( $new_instance['username'] );
		$instance['consumer_key'] 		= strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret'] 	= strip_tags( $new_instance['consumer_secret'] );
		
		delete_option(    'tie_TwitterToken'.$widget_id );
		delete_transient( 'list_tweets'.$widget_id );
		return $instance;
	}

	function form( $instance ) {

		$defaults = array( 'title' =>__('@Follow Me' , 'tie') , 'no_of_tweets' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
	
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e( 'Consumer key:' , 'tie') ?> </label>
			<input id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" value="<?php echo $instance['consumer_key']; ?>" class="widefat" type="text" />
		</p>		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e( 'Consumer secret:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" value="<?php echo $instance['consumer_secret']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e( 'Number of Tweets to show:' , 'tie') ?></label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo $instance['no_of_tweets']; ?>" type="text" size="3" />
		</p>							

	<?php
	}
	
		/**
	 * Find links and create the hyperlinks
	 */
	private function hyperlinks($text) {
	    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
	    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
	    // match name@address
	    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
	        //mach #trendingtopics. Props to Michael Voigt
	    $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
	    return $text;
	}
	/**
	 * Find twitter usernames and link to them
	 */
	private function twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\?|\?|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}
	
}
?>