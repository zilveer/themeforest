<?php
/**
 * Plugin Name: About Widget
 */

add_action( 'widgets_init', 'solopine_about_load_widget' );

function solopine_about_load_widget() {
	register_widget( 'solopine_about_widget' );
}

class solopine_about_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function solopine_about_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'solopine_about_widget', 'description' => __('A widget that displays an About widget', 'solopine_about_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'solopine_about_widget' );

		/* Create the widget. */
		parent::__construct( 'solopine_about_widget', __('Hemlock: About Me', 'solopine_about_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image = $instance['image'];
		$description = $instance['description'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		?>
			
			<div class="about-widget">
			
			<?php if($image) : ?>
			<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
			<?php endif; ?>
			
			<?php if($description) : ?>
			<p><?php echo $description; ?></p>
			<?php endif; ?>	
			
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
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['description'] = $new_instance['description'];

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'About Me', 'image' => '', 'description' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:96%;" />
		</p>
		
		<!-- image url -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>">Image URL:</label>
			<input id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" style="width:96%;" /><br />
			<small>Insert your image URL. For best result use 300px width.</small>
		</p>

		<!-- description -->
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">About me text:</label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" style="width:95%;" rows="6"><?php echo $instance['description']; ?></textarea>
		</p>


	<?php
	}
}

?>