<?php

/**
* twitter widget
*/

class ch_twitter extends WP_Widget {

	public function ch_twitter() {
		$widget_ops = array(
			'classname'   => 'ch_twitter',
			'description' => __('Displays a twitter feed', 'ch')
		);
		parent::__construct('ch_twitter', __('Believe - Twitter', 'ch') , $widget_ops);
	}

	public function widget($args, $instance) {
		extract($args);
		$title      = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets', 'ch') : $instance['title'], $instance, $this->id_base);
		$username   = $instance['username'];
		$user_array = explode(',', $username);

		foreach ($user_array as $key => $user) {
			$user_array[$key] = '"' . $user . '"';
		}

		$avatar_size = (int)$instance['avatar_size'];

		if (empty($avatar_size))
			$avatar_size = 'null';

		$count = (int)$instance['count'];
		if ($count < 1)
			$count = 1;

		if(!empty($user_array)) {

			echo $before_widget;

			if (!empty($title)) {
				echo $before_title . $title . $after_title;
			}

			$id = rand(1, 10000);

			// Load JS
			wp_enqueue_script('jquery-tweet', get_template_directory_uri() . '/js/jquery.tweet.js', array('jquery'));
			wp_localize_script( 'jquery-tweet', 'twitter_ajax', array( 'twitterurl' => get_template_directory_uri() . '/functions/widgets/twitter/' ) );

			?>
			<script type="text/javascript">
				jQuery(function($) {
					$("#twitter_container_<?php echo $id; ?>").tweet({
						username: [<?php echo implode(',', $user_array); ?>],
						count: <?php echo $count; ?>,
						avatar_size: <?php echo $avatar_size; ?>,
						seconds_ago_text: '<?php _e('about %d seconds ago', 'ch'); ?>',
						a_minutes_ago_text: '<?php _e('about a minute ago', 'ch'); ?>',
						minutes_ago_text: '<?php _e('about %d minutes ago', 'ch'); ?>',
						a_hours_ago_text: '<?php _e('about an hour ago', 'ch'); ?>',
						hours_ago_text: '<?php _e('about %d hours ago', 'ch'); ?>',
						a_day_ago_text: '<?php _e('about a day ago', 'ch'); ?>',
						days_ago_text: '<?php _e('about %d days ago', 'ch'); ?>',
						loading_text: 'loading..'
					});
				});
			</script>
			<div id="twitter_container_<?php echo $id; ?>" class="twitter_container <?php if ($avatar_size != 'null') { ?>tweet_avatar<?php } ?>"></div>

			<?php
			echo $after_widget;
		}
	}

	public function update($new_instance, $old_instance) {
		$instance                = $old_instance;
		$instance['title']       = strip_tags($new_instance['title']);
		$instance['username']    = strip_tags($new_instance['username']);
		$instance['avatar_size'] = $new_instance['avatar_size'] ? (int)$new_instance['avatar_size'] : '';
		$instance['count']       = (int)$new_instance['count'];
		return $instance;
	}

	public function form($instance) {
		$title       = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$username    = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$avatar_size = isset($instance['avatar_size']) ? absint($instance['avatar_size']) : '';
		$count       = isset($instance['count']) ? absint($instance['count']) : 3;
		$display     = isset($instance['display']) ? $instance['display'] : 'latest';
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Usernames (separate with comas):', 'ch'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('avatar_size'); ?>"><?php _e('height and width of avatar if displayed (54px max)(optional)', 'ch'); ?></label>
			<input id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" type="text" value="<?php echo $avatar_size; ?>" size="3" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many tweets to display?', 'ch'); ?></label>
			<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" />
		</p>
		<?php
	}
}

register_widget('ch_twitter');