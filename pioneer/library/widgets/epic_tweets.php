<?php
/**
 * Plugin Name: Epic Twitter feed
 * Plugin URI: http://epicthemes.net
 * Description: Displays a list of twitter posts.
 * Version: 1.0
 * Author: Epic Media Labs Ltd.
 * Author URI: http://epicthemes.net

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'epic_tweets_load_widgets' );

/**
 * Register our widget.
 * 'Epic_Latestposts_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function epic_tweets_load_widgets() {
	register_widget( 'Epic_Tweets_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Epic_Tweets_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Epic_Tweets_Widget() {
		/* Widget settings. */
		$epictweetswidget_ops = array( 'classname' => 'widget_twitter', 'description' => __('Displays a list of latest twitter updates', 'epic') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'epictweets-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'epictweets-widget', __('Twitter feed', 'epic'), $epictweetswidget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
	
		
		
		
		
		
		

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
			
			echo epic_tweets();
		
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		
		$defaults = array( 'title' => __('Sign in and register', 'epic') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
?>




		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'epic'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

	
	<?php
	}
}

?>