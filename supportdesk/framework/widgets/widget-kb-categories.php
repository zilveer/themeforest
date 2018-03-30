<?php

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'st_kb_categories_widget' );


// Register widget.
function st_kb_categories_widget() {
	register_widget( 'st_kb_categories_widget' );
}

// Widget class.
class st_kb_categories_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function st_kb_categories_widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'st_kb_categories_widget', 'description' => __('A widget to display knowledge base categories', 'framework') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'st_kb_categories_widget' );

		/* Create the widget. */
		parent::__construct( 'st_kb_categories_widget', __('Knowledge Base Categories', 'framework'), $widget_ops, $control_ops );
	}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		/* Our variables from the widget settings. */
		$hierarchical = $instance['hierarchical'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?> 
        <?php /* Display the widget title if one was input (before and after defined by themes). */
				if ( $title )
					echo $before_title . $title . $after_title;

				?>
                  <ul>          
               <?php 
			    if ($hierarchical == true) {
				$args = array(
					'hierarchical'       => 1,
					'title_li'           => '',
					'taxonomy'           => 'st_kb_category'
				);
			   } else {
				$args = array(
					'hierarchical'       => 0,
					'title_li'           => '',
					'taxonomy'           => 'st_kb_category'
				);
			   }

			   wp_list_categories( $args ); ?>
		</ul>
		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['hierarchical'] = $new_instance['hierarchical'];

		return $instance;
	}
	

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Knowledge Base Categories'
		);
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
        <!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'framework') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        
		<!-- Widget Title: Text Input -->
		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('hierarchical'); ?>" name="<?php echo $this->get_field_name('hierarchical'); ?>"<?php checked( $hierarchical ); ?> />
		<label for="<?php echo $this->get_field_id('hierarchical'); ?>"><?php _e( 'Show hierarchy', 'framework' ); ?></label></p>
        
        
			

	
	<?php
	}
}
?>