<?php
/**
 * Plugin Name: Epic front end theme options
 * Plugin URI: http://epicthemes.net
 * Description: Displays a form for changing theme layout from frontend.
 * Version: 1.0
 * Author: Epic Media Labs Ltd.
 * Author URI: http://epicthemes.net
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'epic_feo_load_widgets' );



function epic_feo_load_widgets() {
	register_widget( 'Epic_Feo_Widget' );
}







class Epic_Feo_Widget extends WP_Widget {


	


	function Epic_Feo_Widget() {
		/* Widget settings. */
		$epic_feowidget_ops = array( 'classname' => 'epic', 'description' => __('User login and registration', 'epic') );

		/* Widget control settings. */
		$control_ops = array(  'id_base' => 'epic-feo-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'epic_feowidget', __('Epic user login and registration', 'epic'), $epic_tweetswidget_ops, $control_ops );
	}

		 
	function widget( $args, $instance ) {
		extract( $args );

	
		$title = apply_filters('widget_title', $instance['title'] );
		
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;
			
		
			echo epic_user_login();
		

		echo $after_widget;
		
		}

	

	

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		
		$defaults = array( 'title' => __('User login and registration', 'epic'));
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