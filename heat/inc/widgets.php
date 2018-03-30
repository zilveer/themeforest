<?php

/**
 * Makes a custom Widget for displaying Recent Twitter Updates available with Heat
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */

class twitter extends WP_Widget {

	function twitter() {
		$widget_ops = array( 'classname' => 'widget_recent_twitter_updates', 'description' => __( 'Use this widget to display your most recent Twitter updates.', 'mega' ) );
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'widget_recent_twitter_updates' );
		$this->WP_Widget( 'widget_recent_twitter_updates', __('Recent Twitter Updates', 'mega'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
 		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Twitter Updates', 'mega') : $instance['title'], $instance, $this->id_base);
		$username = empty( $instance['username'] ) ? 'envato' : $instance['username'];
		
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 2;
		
?>
		<?php // Initialize Tweetable Plugin ?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<div id="tweets-wrapper" class="clearfix"></div>
		<span id="twitter-username" class="hidden"><?php echo $username; ?></span>
		<span id="twitter-number" class="hidden"><?php echo $number; ?></span>
		<?php echo $after_widget; ?>

<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['number'] = absint( $new_instance['number'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'username' => 'envato', 'number' => '2' ) );
		$title = esc_attr( $instance['title'] );
		$username = esc_attr( $instance['username'] );
		$number = esc_attr( $instance['number'] );
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mega'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Your Twitter Username:', 'mega'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" />
	 
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of tweets to show:', 'mega'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p> 
<?php
	}
}