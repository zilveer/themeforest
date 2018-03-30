<?php
/**
* @KingSize 2011
* The PHP code for setup Theme widget twitter.
* Begin creating widget twitter
* Twitter
*/
/**
*	 Feed user twitter
**/

class wm_Twitter extends WP_Widget {
	function wm_Twitter() {
		$widget_ops = array('classname' => 'wm_Twitter', 'description' => 'Display your recent Twitter feed' );
		//$this->WP_Widget('wm_Twitter', 'KingSize Twitter Widget', $widget_ops);
		parent::__construct('wm_Twitter', 'KingSize Twitter Widget', $widget_ops); 
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$twitter_username = empty($instance['twitter_username']) ? ' ' : apply_filters('widget_title', $instance['twitter_username']);
		
		$consumerKey = empty($instance['consumerKey']) ? ' ' : apply_filters('widget_title', $instance['consumerKey']);
		$consumerSecret = empty($instance['consumerSecret']) ? ' ' : apply_filters('widget_title', $instance['consumerSecret']);
		$accessToken = empty($instance['accessToken']) ? ' ' : apply_filters('widget_title', $instance['accessToken']);
		$accessTokenSecret = empty($instance['accessTokenSecret']) ? ' ' : apply_filters('widget_title', $instance['accessTokenSecret']);

		$title = $instance['title'];
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 5;
		}
		
		if(empty($title))
		{
			$title = 'Recent Tweets';
		}
		
		if(!empty($items) && !empty($twitter_username))
		{
			// user timeline
			include_once (get_template_directory() . "/lib/twitter/twitter.class.php");

			// ENTER HERE YOUR CREDENTIALS (see readme.txt)
			$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

			$tweets = $twitter->load(Twitter::ME);

			//$obj_twitter = new Twitter($twitter_username); 
			//$tweets = $obj_twitter->get($items);

			if(!empty($tweets))
			{
				echo '<h3 class="widget-title">'.$title.'</h3>';
				echo '<ul id="twitter_list">';
				$i=1;
				foreach($tweets as $tweet)
				{
					if($i > $items)
					   break;

					echo '<li>';
					
					if(isset($tweet->text))
					{
						echo '<a class="tweet_link" href="http://twitter.com/'.$tweet->user->screen_name.'">'.$tweet->text.'</a>';
					}
					
					echo '</li>';

					$i++;
				}
				
				echo '</ul>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);

		$instance['consumerKey'] = strip_tags($new_instance['consumerKey']);
		$instance['consumerSecret'] = strip_tags($new_instance['consumerSecret']);
		$instance['accessToken'] = strip_tags($new_instance['accessToken']);
		$instance['accessTokenSecret'] = strip_tags($new_instance['accessTokenSecret']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'twitter_username' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$twitter_username = strip_tags($instance['twitter_username']);
		$title = strip_tags($instance['title']);

		$consumerKey = strip_tags($instance['consumerKey']);
		$consumerSecret = strip_tags($instance['consumerSecret']);
		$accessToken = strip_tags($instance['accessToken']);
		$accessTokenSecret = strip_tags($instance['accessTokenSecret']);



?>
			<p><label for="<?php echo $this->get_field_id('twitter_username'); ?>">Username (without @): <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('consumerKey'); ?>">Consumer Key: <input class="widefat" id="<?php echo $this->get_field_id('consumerKey'); ?>" name="<?php echo $this->get_field_name('consumerKey'); ?>" type="text" value="<?php echo esc_attr($consumerKey); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('consumerSecret'); ?>">Consumer Secret: <input class="widefat" id="<?php echo $this->get_field_id('consumerSecret'); ?>" name="<?php echo $this->get_field_name('consumerSecret'); ?>" type="text" value="<?php echo esc_attr($consumerSecret); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('accessToken'); ?>">Access Token: <input class="widefat" id="<?php echo $this->get_field_id('accessToken'); ?>" name="<?php echo $this->get_field_name('accessToken'); ?>" type="text" value="<?php echo esc_attr($accessToken); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('accessTokenSecret'); ?>">Access Token Secret: <input class="widefat" id="<?php echo $this->get_field_id('accessTokenSecret'); ?>" name="<?php echo $this->get_field_name('accessTokenSecret'); ?>" type="text" value="<?php echo esc_attr($accessTokenSecret); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Set # of tweets to display: <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>

			<p><label><a href="https://dev.twitter.com/apps" target="_BLANK">Create and View Twitter Apps</a></label></p>
<?php
	}
}

register_widget('wm_Twitter');

/**
*	End  Feed user twitter
**/
?>
