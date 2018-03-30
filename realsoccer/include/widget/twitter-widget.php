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

add_action( 'widgets_init', 'gdlr_twitter_widget' );
if( !function_exists('gdlr_twitter_widget') ){
	function gdlr_twitter_widget() {
		register_widget( 'Goodlayers_Twitter_Widget' );
	}
}

if( !class_exists('Goodlayers_Twitter_Widget') ){
	class Goodlayers_Twitter_Widget extends WP_Widget {

		// Initialize the widget
		function __construct(){
			parent::__construct(
				'gdlr-twitter-widget', 
				__('Goodlayers Twitter','gdlr_translate'), 
				array('description' => __('A widget that show twitter feeds.', 'gdlr_translate')));  
		}

		// Output of the widget
		function widget( $args, $instance ) {
			$title = apply_filters( 'widget_title', $instance['title'] );
			$twitter_username = $instance['twitter_username'];
			$show_num = $instance['show_num'];
			$consumer_key = $instance['consumer_key'];
			$consumer_secret = $instance['consumer_secret'];
			$access_token = $instance['access_token'];
			$access_token_secret = $instance['access_token_secret'];		
			$cache_time = $instance['cache_time'];		
			
			// Opening of widget
			echo $args['before_widget'];
			
			// Open of title tag
			if( !empty($title) ){ 
				echo $args['before_title'] . $title . $args['after_title']; 
			}
			
			$gdlr_twitter = get_option('gdlr_twitter', array());
			if( !is_array($gdlr_twitter) && !empty($gdlr_twitter) ){ 
				$gdlr_twitter = unserialize($gdlr_twitter);
			}
			if( !is_array($gdlr_twitter) ){	
				$gdlr_twitter = array(); 
			}
			
			if( empty($gdlr_twitter[$twitter_username][$show_num]['data']) ||
				empty($gdlr_twitter[$twitter_username][$show_num]['cache_time']) || 
				time() - intval($gdlr_twitter[$twitter_username][$show_num]['cache_time']) >= ($cache_time * 3600)){
			
				$tweets_data = gdlr_get_tweets($consumer_key, $consumer_secret, 
					$access_token, $access_token_secret, $twitter_username, $show_num);
				
				if( !empty($tweets_data) ){
					$gdlr_twitter[$twitter_username][$show_num]['data'] = $tweets_data;
					$gdlr_twitter[$twitter_username][$show_num]['cache_time'] = time();
					
					update_option('gdlr_twitter', $gdlr_twitter);	
				}
			}else{
				$tweets_data = $gdlr_twitter[$twitter_username][$show_num]['data'];
			}
			
			echo '<ul class="gdlr-twitter-widget">';
			foreach( $tweets_data as $tweet_data ){
				echo '<li>' . $tweet_data . '</li>';
			}
			echo '</ul>';

			// Closing of widget
			echo $args['after_widget'];	
		}

		// Widget Form
		function form( $instance ) {
			$title = isset($instance['title'])? $instance['title']: '';
			$twitter_username = isset($instance['twitter_username'])? $instance['twitter_username']: '';
			$show_num = isset($instance['show_num'])? $instance['show_num']: '5';
			$consumer_key = isset($instance['consumer_key'] )? $instance['consumer_key']: '';
			$consumer_secret = isset($instance['consumer_secret'])? $instance['consumer_secret']: '';
			$access_token = isset($instance['access_token'])? $instance['access_token']: '';
			$access_token_secret = isset($instance['access_token_secret'])? $instance['access_token_secret']: '';
			$cache_time = isset($instance['cache_time'])? $instance['cache_time']: '1';		
			?>
			<!-- Text Input -->
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdlr_translate' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>

			<!-- Twitter Username -->
			<p>
				<label for="<?php echo $this->get_field_id('twitter_username'); ?>"><?php _e( 'Twitter username :', 'gdlr_translate' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo $twitter_username; ?>" />
			</p>		
			
			<!-- Show Num --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" type="text" value="<?php echo $show_num; ?>" />
			</p>
			
			<!-- Consumer Key --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php _e('Consumer Key :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" value="<?php echo $consumer_key; ?>" />
			</p>

			<!-- Consumer Secret --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php _e('Consumer Secret :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
			</p>

			<!-- Access Token --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'access_token' ); ?>"><?php _e('Access Token :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'access_token' ); ?>" name="<?php echo $this->get_field_name( 'access_token' ); ?>" type="text" value="<?php echo $access_token; ?>" />
			</p>

			<!-- Access Token Secret --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'access_token_secret' ); ?>"><?php _e('Access Token Secret :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'access_token_secret' ); ?>" type="text" value="<?php echo $access_token_secret; ?>" />
			</p>		

			<!-- Cache Time --> 
			<p>
				<label for="<?php echo $this->get_field_id( 'cache_time' ); ?>"><?php _e('Cache Time (hour) :', 'gdlr_translate'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'cache_time' ); ?>" name="<?php echo $this->get_field_name( 'cache_time' ); ?>" type="text" value="<?php echo $cache_time; ?>" />
			</p>		
			<?php
		}
		
		// Update the widget
		function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = (empty($new_instance['title']))? '': strip_tags($new_instance['title']);
			$instance['twitter_username'] = (empty($new_instance['twitter_username']))? '': strip_tags($new_instance['twitter_username']);
			$instance['show_num'] = (empty($new_instance['show_num']))? '': strip_tags($new_instance['show_num']);
			$instance['consumer_key'] = (empty($new_instance['consumer_key']))? '': strip_tags($new_instance['consumer_key']);
			$instance['consumer_secret'] = (empty($new_instance['consumer_secret']))? '': strip_tags($new_instance['consumer_secret']);
			$instance['access_token'] = (empty($new_instance['access_token']))? '': strip_tags($new_instance['access_token']);
			$instance['access_token_secret'] = (empty($new_instance['access_token_secret']))? '': strip_tags($new_instance['access_token_secret']);
			$instance['cache_time'] = (empty($new_instance['cache_time']))? '': strip_tags($new_instance['cache_time']);
			return $instance;
		}	
	}
}
?>