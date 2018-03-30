<?php
/**
 * Plugin Name: Ad Widget
 */

add_action( 'widgets_init', 'mvp_ad_load_widgets' );

function mvp_ad_load_widgets() {
	register_widget( 'mvp_ad_widget' );
}

class mvp_ad_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_ad_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_ad_widget', 'description' => __('A widget that displays an ad of any size.', 'mvp-text') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_ad_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_ad_widget', __('Flex Mag: Ad Widget', 'mvp-text'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$code = $instance['code'];

		?>
			<div class="widget-ad left relative">
				<?php echo html_entity_decode($code); ?>
			</div><!--widget-ad-->
		<?php

	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['code'] = $new_instance['code'];


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'code' => 'Enter ad code here');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Ad code -->
		<p>
			<label for="<?php echo $this->get_field_id( 'code' ); ?>">Ad code:</label>
			<textarea id="<?php echo $this->get_field_id( 'code' ); ?>" name="<?php echo $this->get_field_name( 'code' ); ?>" style="width:96%;" rows="6"><?php echo $instance['code']; ?></textarea>
		</p>


	<?php
	}
}

?>