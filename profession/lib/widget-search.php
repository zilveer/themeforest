<?php

// Widget class
class PixFlow_Search_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		THEME_SLUG . '_Search', // Base ID
			THEME_SLUG . ' - Search', // Name
			array( 'description' => __( 'Displays custom search form', TEXTDOMAIN ) ) // Args
		);
	}
		
	function widget( $args, $instance ) {
		extract( $args );

		// Our variables from the widget settings
		$title       = apply_filters('widget_title', $instance['title'] );
		$placeholder = $instance['placeholder'];

		// Before widget (defined by theme functions file)
		echo $before_widget;

		// Display the widget title if one was input
		if ( $title )
			echo $before_title . $title . $after_title;

		// Display Search form
		 ?>
		 
		<br >
		<div class="search">
			<form action="<?php echo home_url( '/' ); ?>">
				<fieldset>
					<input type="text" name="s" placeholder="<?php echo $placeholder ?>" value="">
					<input type="submit" value="">
				</fieldset>
		  </form>
		</div>

	
	<?php

		// After widget (defined by theme functions file)
		echo $after_widget;
		
	}

		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		// Strip tags to remove HTML (important for text inputs)
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['placeholder'] = strip_tags( $new_instance['placeholder'] );

		return $instance;
	}
		 
	function form( $instance ) {

		// Set up some default widget settings
		$defaults = array(
			'title' => 'Search',
			'placeholder' => __('Search', TEXTDOMAIN)
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		
	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', TEXTDOMAIN) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Widget Placeholder text: Text Input -->
	<p>	
		<label for="<?php echo $this->get_field_id( 'placeholder' ); ?>"><?php _e('Placeholder:', TEXTDOMAIN) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'placeholder' ); ?>" name="<?php echo $this->get_field_name( 'placeholder' ); ?>" value="<?php echo $instance['placeholder']; ?>" />
	</p>
	
	<?php
		}
		
}

// register widget
add_action( 'widgets_init', create_function( '', 'register_widget( "PixFlow_Search_Widget" );' ) );

?>