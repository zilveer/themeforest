<?php

/**
 * Plugin Name: R-Twitter Widget
 * Plugin URI: http://rascals.eu
 * Description: Display latest tweets from twitter.
 * Version: 1.1.1
 * Author: Rascals Labs
 * Author URI: http://rascals.eu
 */
 
class r_twitter_widget extends WP_Widget {

	/* Widget setup */ 
	function __construct() {

		/* Widget settings */
		$widget_ops = array(
			'classname' => 'widget_r_twitter',
			'description' => _x('Display latest tweets from twitter', 'R-Twitter Widget', SHORT_NAME)
		);

		/* Widget control settings */
		$control_ops = array(
			'width' => 200,
			'height' => 200,
			'id_base' => 'r-twitter-widget'
		);
		
		/* Create the widget */ 
		parent::__construct('r-twitter-widget', _x('R-Twitter', 'Twitter Widget (RT)', SHORT_NAME), $widget_ops, $control_ops);
		
	}

	/* Display the widget on the screen */ 
	function widget($args, $instance) {
		
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$username = $instance['username'];
		$limit = ($instance['limit'] != '') ? $limit = $instance['limit'] : $limit = 3;
		$replies = ($instance['replies'] != '') ? $replies = $instance['replies'] : $replies = 'false';
		$consumer_key = (isset($instance['consumer_key']) && $instance['consumer_key'] != '') ? $consumer_key = $instance['consumer_key'] : $consumer_key = '';
		$consumer_secret = (isset($instance['consumer_secret']) && $instance['consumer_secret'] != '') ? $consumer_secret = $instance['consumer_secret'] : $consumer_secret = '';
		$access_token = (isset($instance['access_token']) && $instance['access_token'] != '') ? $access_token = $instance['access_token'] : $access_token = '';
		$access_token_secret = (isset($instance['access_token_secret']) && $instance['access_token_secret'] != '') ? $access_token_secret = $instance['access_token_secret'] : $access_token_secret = '';
		
		echo $before_widget;
		
		if (isset($title)) echo $before_title . $title . $after_title;
		
		$options = array(
			'limit'               => $limit,
			'username'            => $username,
			'replies'             => $replies,
			'consumer_key'        => $consumer_key,
			'consumer_secret'     => $consumer_secret,
			'access_token'        => $access_token,
			'access_token_secret' => $access_token_secret
		);
		echo r_parse_twitter($options);
		
		echo $after_widget;
		
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['consumer_key'] = strip_tags($new_instance['consumer_key']);
		$instance['consumer_secret'] = strip_tags($new_instance['consumer_secret']);
		$instance['access_token'] = strip_tags($new_instance['access_token']);
		$instance['access_token_secret'] = strip_tags($new_instance['access_token_secret']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['replies'] = strip_tags($new_instance['replies']);
		
		return $instance;
	}
	function form($instance) {
		
		$defaults = array('title' => _x('Tweets', 'R-Twitter Widget', SHORT_NAME), 'username' => '', 'consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '', 'limit' => '3', 'replies' => 'true');
		$instance = wp_parse_args((array)$instance, $defaults);
		echo '<p>';
			echo '<label for="' . $this->get_field_id('title') . '">' . _x('Title:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('title') . '" type="text" name="' . $this->get_field_name('title') . '" value="' . $instance['title'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('username') . '">' . _x('Username:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('username') . '" type="text" name="' . $this->get_field_name('username') . '" value="' . $instance['username'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('consumer_key') . '">' . _x('Consumer key:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('consumer_key') . '" type="text" name="' . $this->get_field_name('consumer_key') . '" value="' . $instance['consumer_key'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('consumer_secret') . '">' . _x('Consumer secret:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('consumer_secret') . '" type="text" name="' . $this->get_field_name('consumer_secret') . '" value="' . $instance['consumer_secret'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('access_token') . '">' . _x('Access token:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('access_token') . '" type="text" name="' . $this->get_field_name('access_token') . '" value="' . $instance['access_token'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('access_token_secret') . '">' . _x('Access token secret:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('access_token_secret') . '" type="text" name="' . $this->get_field_name('access_token_secret') . '" value="' . $instance['access_token_secret'] . '" class="widefat" />';
		echo '</p>';
		echo '<p>';
			echo '<label for="' . $this->get_field_id('limit') . '">' . _x('Number of tweets to show:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
			echo '<input id="' . $this->get_field_id('limit') . '" type="text" name="' . $this->get_field_name('limit') . '" value="' . $instance['limit'] . '" class="widefat" />';
			echo '<small style="line-height:12px;">' . _x('20 is the maximum', 'R-Twitter Widget', SHORT_NAME) . '</small>';
		echo '</p>';
		echo '<p>';
			if ($instance['replies']) $checked = 'checked="checked"';
			else $checked = '';
			echo '<input class="checkbox" type="checkbox" value="true" id="' . $this->get_field_id('replies') . '" ' . $checked . ' name="' . $this->get_field_name('replies') . '" />';
			echo '<label for="' . $this->get_field_id('replies') . '"> ' . _x('Display replies:', 'R-Twitter Widget', SHORT_NAME) . '</label>';
		echo '</p>';

	}
	
}

register_widget('r_twitter_widget');

?>