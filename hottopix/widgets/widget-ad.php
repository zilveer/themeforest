<?php
/**
 * Plugin Name: Ad Widget
 */

add_action( 'widgets_init', 'ht_ad_load_widgets' );

function ht_ad_load_widgets() {
	register_widget( 'ht_ad_widget' );
}

class ht_ad_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function ht_ad_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ht_ad_widget', 'description' => __('A widget that displays an ad of any size.', 'ht_ad_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ht_ad_widget' );

		/* Create the widget. */
		$this->__construct( 'ht_ad_widget', __('Hot Topix: Ad Widget', 'ht_ad_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$code = $instance['code'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>

			<div class="widget-ad">
				<h3><?php _e( 'Advertisement', 'mvp-text' ); ?></h3>
				<?php echo stripslashes($code); ?>
			</div><!--widget-ad-->

		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
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