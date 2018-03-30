<?php
/**
 * Plugin Name: Tag Cloud Widget
 */

add_action( 'widgets_init', 'mvp_tags_load_widgets' );

function mvp_tags_load_widgets() {
	register_widget( 'mvp_tags_widget' );
}

class mvp_tags_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_tags_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_tags_widget', 'description' => __('A custom Tag Cloud widget.', 'mvp_tags_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_tags_widget' );

		/* Create the widget. */
		$this->__construct( 'mvp_tags_widget', __('Osage: Tag Cloud Widget', 'mvp_tags_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>


				<div class="tag-cloud">
					<?php wp_tag_cloud(array('smallest' => 12, 'largest' => 12, 'unit' => 'px', 'number' => $number, 'orderby' => 'count', 'order' => 'DESC' )); ?>
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
		$instance['number'] = strip_tags( $new_instance['number'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'number' => 40);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of Tags to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>