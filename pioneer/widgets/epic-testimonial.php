<?php
/**
 * Plugin Name: Calibra Testimonial Widget
 * Plugin URI: http://themeforest.net
 * Description: Displays a random testimonial.
 * Version: 0.1
 * Author: Epicthemes
 * Author URI: http://themeforest.net/user/Epicthemes
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'testimonial_load_widgets' );

/**
 * Register our widget.
 * 'Epic_Testimonial_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function testimonial_load_widgets() {
	register_widget( 'Epic_Testimonial_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Epic_Testimonial_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Epic_Testimonial_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'example', 'description' => __('Displays a random testimonial', 'example') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'testimonial-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'testimonial-widget', __('Epic - Testimonial widget', 'example'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		
		epic_random_testimonial();
		





		///////////////////////////////////////////

		/* After widget (defined by themes). */
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
		$defaults = array( 'title' => __('Testimonial', 'example') );
		
		 ?>
<!-- Widget Title: Text Input -->
<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
						<?php _e('Title:', 'hybrid'); ?>
			</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
</p>

<?php
	}
}
?>
