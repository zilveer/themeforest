<?php
class twitter_widget extends WP_Widget 
{
	/** constructor */
    function twitter_widget() 
	{
		global $themename;
		$widget_options = array(
			'classname' => 'twitter_widget',
			'description' => 'Displays Twitter Feed'
		);
		$control_options = array('width' => 580);
        parent::__construct('gymbase_twitter', __('Twitter Feed', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$login = isset($instance['login']) ? $instance['login'] : "";
		$count = isset($instance['count']) ? $instance['count'] : "";
		$consumer_key = isset($instance['consumer_key']) ? $instance['consumer_key'] : "";
		$consumer_secret = isset($instance['consumer_secret']) ? $instance['consumer_secret'] : "";
		$access_token = isset($instance['access_token']) ? $instance['access_token'] : "";
		$access_token_secret = isset($instance['access_token_secret']) ? $instance['access_token_secret'] : "";

		echo $before_widget;
		require_once(get_template_directory() . '/libraries/tmhOAuth/tmhOAuth.php');
		require_once(get_template_directory() . '/libraries/tmhOAuth/tmhUtilities.php');

		$tmhOAuth = new tmhOAuth(array(
			'consumer_key'    => $consumer_key,
			'consumer_secret' => $consumer_secret,
			'user_token'      => $access_token,
			'user_secret'     => $access_token_secret
		));
		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
			'screen_name' => $login,
			'count' => $count,
			'include_rts' => 'true'
		));
		$response = $tmhOAuth->response;
		?>
		<div class="clearfix">
			<div class="header_left">
				<?php
				if($title) 
				{
					echo $before_title . $title . $after_title;
				}
				?>
			</div>
			<div class="header_right">
				<a href="#" class="latest_tweets_prev scrolling_list_control_left icon_small_arrow left_white"></a>
				<a href="#" class="latest_tweets_next scrolling_list_control_right icon_small_arrow right_white"></a>
			</div>
		</div>
		<div class="scrolling_list_wrapper">
			<ul class="scrolling_list latest_tweets">
				<?php
				gb_get_theme_file("/libraries/lib_autolink.php");
				$tweets = json_decode($response['response']);
				if(isset($tweets->errors))
					foreach($tweets->errors as $error)
						echo '<li class="icon_small_arrow right_white"><p>' . $error->message . '</p></li>';
				else
					foreach($tweets as $tweet)
						echo '<li class="icon_small_arrow right_white"><p>' .  autolink($tweet->text, 20, ' target="_blank"') . '<abbr title="' . date('c', strtotime($tweet->created_at)) . '" class="timeago">' . $tweet->created_at . '</abbr></p></li>';
				?>
			</ul>
		</div>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['login'] = isset($new_instance['login']) ? strip_tags($new_instance['login']) : '';
		$instance['count'] = isset($new_instance['count']) ? strip_tags($new_instance['count']) : '';
		$instance['consumer_key'] = isset($new_instance['consumer_key']) ? strip_tags($new_instance['consumer_key']) : '';
		$instance['consumer_secret'] = isset($new_instance['consumer_secret']) ? strip_tags($new_instance['consumer_secret']) : '';
		$instance['access_token'] = isset($new_instance['access_token']) ? strip_tags($new_instance['access_token']) : '';
		$instance['access_token_secret'] = isset($new_instance['access_token_secret']) ? strip_tags($new_instance['access_token_secret']) : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		global $themename;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$login = isset($instance['login']) ? esc_attr($instance['login']) : '';
		$count = isset($instance['count']) ? esc_attr($instance['count']) : '';
		$consumer_key = isset($instance['consumer_key']) ? esc_attr($instance['consumer_key']) : '';
		$consumer_secret = isset($instance['consumer_secret']) ? esc_attr($instance['consumer_secret']) : '';
		$access_token = isset($instance['access_token']) ? esc_attr($instance['access_token']) : '';
		$access_token_secret = isset($instance['access_token_secret']) ? esc_attr($instance['access_token_secret']) : '';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('login'); ?>"><?php _e('Login', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('login'); ?>" name="<?php echo $this->get_field_name('login'); ?>" type="text" value="<?php echo $login; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Count', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('consumer_key'); ?>"><?php _e('Consumer key', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" type="text" value="<?php echo $consumer_key; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>"><?php _e('Consumer secret', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" type="text" value="<?php echo $consumer_secret; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>"><?php _e('Access token', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" type="text" value="<?php echo $access_token; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>"><?php _e('Access token secret', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" type="text" value="<?php echo $access_token_secret; ?>" />
		</p>
		<p style="line-height: 200%;">
			Directions to get the Consumer key, Consumer secret, Access token and Access token secret:<br>
			1. <a href="https://dev.twitter.com/apps/new" target="_blank">Add a new Twitter application</a><br>
			2. Fill in Name, Description, Website, and Callback URL (don't leave any blank) with anything you want<br>
			3. Agree to rules, fill out captcha, and submit your application<br>
			4. Copy the Consumer key, Consumer secret, Access token and Access token secret into the fields above<br>
			5. Click the Save button at the bottom
		</p>
		<?php
	}
}
//register widget
add_action('widgets_init', create_function('', 'return register_widget("twitter_widget");'));
?>