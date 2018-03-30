<?php
// Twitter Widget Class
class Theme_Widget_Twitter extends WP_Widget {

	function Theme_Widget_Twitter() {
		$widget_ops = array('classname' => 'widget_twitter', 'description' => __( 'Displays a list of twitter feeds', 'theme_admin' ) );
		$this->WP_Widget('grizzly-twitter', THEME_NAME . ' - '.__('Twitter', 'theme_admin'), $widget_ops);
		
		/*
		if ( is_active_widget(false, false, $this->id_base) ){
			add_action( 'wp_print_scripts', array(&$this, 'add_tweet_script') );
		}
		*/
	}

	function add_tweet_script(){
		// wp_enqueue_script('jquery-tweet', THEME_ADMIN_ASSETS_URI . '/libs/jquery.tweet.js');
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Tweets', 'theme_front') : $instance['title'], $instance, $this->id_base);
		$username= $instance['username'];
		$count = $instance['count'];
		
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		?>
		<div class="twitter-box">
			<?php if( theme_options('advance', 'twitter_consumer_key') &&
			theme_options('advance', 'twitter_consumer_secret') &&
			theme_options('advance', 'twitter_user_token') &&
			theme_options('advance', 'twitter_user_secret') ): ?>
				<span class="tweet" data-username="<?php echo $username; ?>" data-count="<?php echo $count; ?>" data-modpath="<?php echo admin_url( 'admin-ajax.php' ); ?>"></span>
			<?php else: ?>
				<p>Please set Twitter App info at "WP-Admin > Appearance > Theme Options > Advance > Twitter App"</p>
			<?php endif; ?>
			<a href="https://twitter.com/<?php echo $username; ?>" class="twitter-follow-button" data-show-count="false" data-lang="en" data-align="<?php echo ( theme_options('appearance', 'text_rtl') == 'on' )? 'right' : 'left'; ?>" data-width="200px">Follow @<?php echo $username; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['count'] = (int) $new_instance['count'];
		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$username = isset($instance['username']) ? esc_attr($instance['username']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'theme_admin'); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Username', 'theme_admin'); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many tweets to display?', 'theme_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		
<?php
	}
}
register_widget('Theme_Widget_Twitter');