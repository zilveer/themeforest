<?php

	/*
	*
	*	Custom Video Widget
	*	------------------------------------------------
	*	Swift Framework v1.0
	* 	Copyright Swift Ideas 2013 - http://www.swiftideas.net
	*
	*/
	
	class Twitter_Widget extends WP_Widget {


	function Twitter_Widget() {
								
		// Widget settings
		$widget_ops = array('classname' => 'twitter-widget', 'description' => 'Display your latest tweets.');

		// Create the widget
		parent::__construct('twitter-widget', 'Swift Framework Twitter', $widget_ops);
	}
	
	
	function widget($args, $instance) {
		
		extract($args);
				
		// User-selected settings
		$title = apply_filters('widget_title', $instance['title']);
		$username = $instance['username'];
		$posts = $instance['posts'];

		// Before widget (defined by themes)
		echo $before_widget;

		// Title of widget (before and after defined by themes)
		if (!empty($title)) echo $before_title . $title . $after_title;
			
		// This check prevents fatal errors — which can't be turned off in PHP — when feed updates fail
		if (function_exists('getTweets')) :
			
			$result = '<ul class="widget-tweet-list">';
			$result .= latestTweet($posts, $username);
			$result .= '</ul>';
			$result .= '<div class="twitter-link"><a href="http://www.twitter.com/'. $username .'"><span>Follow</span> @'. $username .'</a></div>'; 
			// Display everything
			echo $result;


		// If loading from Twitter fails, display message
		else :
			echo '<p>Please install and activate the Twitter oAuth Developer Plugin.</p>';
		endif;

		// After widget (defined by themes)
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['posts'] = $new_instance['posts'];
		
		return $instance;
	}
	
	
	function form($instance) {

		// Set up some default widget settings
		$defaults = array('title' => 'Latest Tweets', 'username' => '', 'posts' => 5);
		$instance = wp_parse_args((array) $instance, $defaults);

?>
			
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>">Your Twitter username:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Display how many tweets?</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>">
		</p>
		
	<?php
		}
	}	
	
	add_action( 'widgets_init', 'loadTwitterWidget' );
	
	function loadTwitterWidget() {
		
		register_widget('Twitter_Widget');
	}

?>