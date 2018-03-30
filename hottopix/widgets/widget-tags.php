<?php
/**
 * Plugin Name: Tags Widget
 */

add_action( 'widgets_init', 'ht_tags_load_widgets' );

function ht_tags_load_widgets() {
	register_widget( 'ht_tags_widget' );
}

class ht_tags_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function ht_tags_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ht_tags_widget', 'description' => __('A custom Tag Cloud widget.', 'ht_tags_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ht_tags_widget' );

		/* Create the widget. */
		$this->__construct( 'ht_tags_widget', __('Hot Topix: Tags Widget', 'ht_tags_widget'), $widget_ops, $control_ops );
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
		?>

				<div class="tag-cloud">
				<?php wp_tag_cloud('smallest=12&largest=12&unit=px&number=40&orderby=count&order=DESC'); ?>
				</div>


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
		$instance['title'] = strip_tags( $new_instance['title'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Tags');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>


	<?php
	}
}

?>