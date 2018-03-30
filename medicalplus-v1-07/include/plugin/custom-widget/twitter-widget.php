<?php
/**
 * Plugin Name: Goodlayers Twitter Widget
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show feeds from twitter.
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'twitter_widget' );
function twitter_widget() {
	register_widget( 'Twitter' );
}

class Twitter extends WP_Widget {

	// Initialize the widget
	function Twitter() {
		parent::__construct('twitter-widget', __('Twitter (Goodlayers)','gdl_back_office'), 
			array('description' => __('A widget that show Twitter feeds.', 'gdl_back_office')));  
	}

	// Output of the widget
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$twitter_username = $instance['twitter_username'];
		$show_num = $instance['show_num'];
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];		
		$cache_time = $instance['cache_time'];		
		
		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
		
		$last_cache_time = get_option('gdl_twitter_widget_last_cache_time', 0);
		$diff = time() - $last_cache_time;
		$crt = $cache_time * 3600;		
		if(empty($last_cache_time) || $diff >= $crt){
		
			$connection = getConnectionWithAccessToken($consumer_key, $consumer_secret, $access_token, $access_token_secret);
			$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_username."&count=" . $show_num) or die('Couldn\'t retrieve tweets! Wrong username?');
			
			if(!empty($tweets->errors)){
				if($tweets->errors[0]->message == 'Invalid or expired token'){
					echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href="https://dev.twitter.com/apps" target="_blank">here</a>!' . $after_widget;
				}else{
					echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
				}
				return;
			}

			$tweets_data = array();
			for($i = 0;$i <= count($tweets); $i++){
				if(!empty($tweets[$i])){
					$tweets_data[$i]['created_at'] = $tweets[$i]->created_at;
					$tweets_data[$i]['text'] = $tweets[$i]->text;			
					$tweets_data[$i]['status_id'] = $tweets[$i]->id_str;			
				}	
			}			
			
			update_option('gdl_twitter_widget_tweets',serialize($tweets_data));							
			update_option('gdl_twitter_widget_last_cache_time',time());		
		}else{
			$tweets_data = maybe_unserialize(get_option('gdl_twitter_widget_tweets'));
		}
		
		echo '<div class="twitter-whole">';
		echo '<ul id="twitter_update_list">';
		foreach( $tweets_data as $each_tweet ){
			echo '<li>';
			echo '<span>' . convert_links($each_tweet['text']) . '</span>';
			echo '<a target="_blank" href="http://twitter.com/'.$twitter_username.'/statuses/'.$each_tweet['status_id'].'">'.relative_time($each_tweet['created_at']).'</a>';
			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';

		// Closing of widget
		echo $after_widget;	
	}

	// Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$twitter_username = esc_attr( $instance[ 'twitter_username' ] );
			$show_num = esc_attr( $instance[ 'show_num' ] );
			$consumer_key = esc_attr( $instance[ 'consumer_key' ] );
			$consumer_secret = esc_attr( $instance[ 'consumer_secret' ] );
			$access_token = esc_attr( $instance[ 'access_token' ] );
			$access_token_secret = esc_attr( $instance[ 'access_token_secret' ] );
			$cache_time = esc_attr( $instance[ 'cache_time' ] );
		} else {
			$title = '';
			$twitter_username = '';
			$show_num = '5';
			$consumer_key = '';
			$consumer_secret = '';
			$access_token = '';
			$cache_time = '1';
		}
		?>

		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<!-- Twitter Username -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e( 'Twitter username :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $twitter_username; ?>" />
		</p>		
		
		<!-- Show Num --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" type="text" value="<?php echo $show_num; ?>" />
		</p>
		
		<!-- Consumer Key --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer Key :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" value="<?php echo $consumer_key; ?>" />
		</p>

		<!-- Consumer Secret --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer Secret :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
		</p>

		<!-- Access Token --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Access Token :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" type="text" value="<?php echo $access_token; ?>" />
		</p>

		<!-- Access Token Secret --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>"><?php _e('Access Token Secret :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" type="text" value="<?php echo $access_token_secret; ?>" />
		</p>		

		<!-- Cache Time --> 
		<p>
			<label for="<?php echo $this->get_field_id( 'cache_time' ); ?>"><?php _e('Cache Time (hour) :', 'gdl_back_office'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'cache_time' ); ?>" name="<?php echo $this->get_field_name( 'cache_time' ); ?>" type="text" value="<?php echo $cache_time; ?>" />
		</p>	
		
	<?php
	}
	
	// Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['twitter_username'] = strip_tags( $new_instance['twitter_username'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );
		$instance['consumer_key'] = strip_tags( $new_instance['consumer_key'] );
		$instance['consumer_secret'] = strip_tags( $new_instance['consumer_secret'] );
		$instance['access_token'] = strip_tags( $new_instance['access_token'] );
		$instance['access_token_secret'] = strip_tags( $new_instance['access_token_secret'] );
		$instance['cache_time'] = strip_tags( $new_instance['cache_time'] );
		return $instance;
	}	
}

?>