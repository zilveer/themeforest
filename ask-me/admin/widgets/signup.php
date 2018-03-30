<?php
/* Signup */
add_action( 'widgets_init', 'widget_signup_widget' );
function widget_signup_widget() {
	register_widget( 'Widget_Signup' );
}

class Widget_Signup extends WP_Widget {

	function Widget_Signup() {
		$widget_ops = array( 'classname' => 'signup-widget'  );
		$control_ops = array( 'id_base' => 'signup-widget' );
		parent::__construct( 'signup-widget','Ask me - signup', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		if (!is_user_logged_in()) {
			echo $before_widget;
				if ( $title )
					echo $before_title.esc_attr($title).$after_title;?>
				<div class="widget_signup">
					<?php echo '<div class="form-style form-style-3">
						'.do_shortcode("[ask_signup]");
						echo '<div class="clearfix"></div>
					</div>';?>
				</div>
				<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance		   = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Signup','vbegy'));
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>