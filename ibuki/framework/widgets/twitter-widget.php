<?php

class AZ_Widget_Twitter extends WP_Widget {

	function AZ_Widget_Twitter() {

		$widget_ops = array(
			'classname' => 'az_widget_twitter', 
			'description' => __('Use this widget to display your latest tweets.', AZ_THEME_NAME) 
		);
		$control_ops = array('id_base' => 'az_widget_twitter');
		parent::__construct('az_widget_twitter', __('Custom Twitter Widget', AZ_THEME_NAME), $widget_ops, $control_ops);
	}

	function widget($args, $instance) {

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		
		echo $before_widget;
		echo $before_title . $title . $after_title;
		
		$replies = ($instance['replies'] != 'true') ? 'false' : 'true';

		$opts = array(
			"exclude_replies" => $replies
		);

		if(function_exists('getTweets')) {

			echo '<ul class="list_tweets' . '-' . $this->number . '">';
			
			$tweets = getTweets($instance['username'], $instance['limit'], $opts);
			if(is_array($tweets)) {
				foreach($tweets as $tweet){
					if($tweet['text']){
						$the_tweet = $tweet['text'];
						if(is_array($tweet['entities']['user_mentions'])){
							foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
								$the_tweet = preg_replace('/@'.$user_mention['screen_name'].'/i', '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>', $the_tweet);
							}
						}
						if(is_array($tweet['entities']['hashtags'])){
							foreach($tweet['entities']['hashtags'] as $key => $hashtag){
								$the_tweet = preg_replace('/#'.$hashtag['text'].'/i', '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>', $the_tweet);
							}
						}
						if(is_array($tweet['entities']['urls'])){
							foreach($tweet['entities']['urls'] as $key => $link){
								$the_tweet = preg_replace('`'.$link['url'].'`', '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>', $the_tweet);
							}
						}
						echo '<li>';
						echo '<span class="tweet_text">';
						echo $the_tweet;
						echo '</span>';
						echo '<span class="tweet_timestamp"><a href="https://twitter.com/'.$instance['username'].'/status/'.$tweet['id_str'].'" target="_blank">'.date('h:i A M d',strtotime($tweet['created_at']. '- 8 hours')).'</a></span>';
						echo '</li>';
					}
				}
			}
			echo '</ul>';
			
		} else {
			echo '<span>Please install <a href="http://wordpress.org/plugins/oauth-twitter-feed-for-developers/">oAuth Twitter Feed for Developers</a> plugin</span>';
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['replies'] = strip_tags($new_instance['replies']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		return $instance;
	}
	
	function form($instance)	{

		$defaults = array(
			'title' => 'Twitter Widget',
			'username' => '',
			'limit' => 5,
			'replies' => 'true'
		);

		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', AZ_THEME_NAME) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username', AZ_THEME_NAME) ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php echo $instance['username']; ?>">
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Number of tweets', AZ_THEME_NAME) ?></label>
			<select id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>">
				<?php for($i = 1; $i <= 10; $i++) : $selected = ($instance['limit'] == $i) ? ' selected="selected"' : '' ?>
				<option value="<?php echo $i; ?>"<?php echo $selected ?>><?php echo $i; ?></option>
				<?php endfor; ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('replies'); ?>"><?php _e('Exclude Replies', AZ_THEME_NAME) ?></label>
			<?php $checked = ($instance['replies'] == 'true') ? ' checked=""' : '' ?>
			<input type="checkbox" id="<?php echo $this->get_field_id('replies'); ?>" name="<?php echo $this->get_field_name('replies'); ?>" value="true"<?php echo $checked; ?>>
		</p>
		
	<?php }
	
}

add_action('widgets_init', 'az_widget_twitter');

function az_widget_twitter() {
	register_widget('AZ_Widget_Twitter');
}