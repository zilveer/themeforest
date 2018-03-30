<?php

function om_widget_testimonials_init() {
	register_widget( 'om_widget_testimonials' );
}
add_action( 'widgets_init', 'om_widget_testimonials_init' );

/* Widget Class */

class om_widget_testimonials extends WP_Widget {

	function __construct() {
	
		parent::__construct(
			'om_widget_testimonials',
			__('Testimonials','om_theme'),
			array(
				'classname' => 'om_widget_testimonials',
				'description' => __('Use this widget to display testimonials', 'om_theme')
			)
		);
	}

	/* Front-end display of widget. */
		
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$instance['autorotate'] = intval($instance['autorotate']);
	
		echo $before_widget;
	
		if ( $title )
			echo $before_title . $title . $after_title;
		
		echo do_shortcode('[testimonials timeout='.$instance['autorotate'].($instance['category']?' category='.$instance['category']:'').']');
		
		echo $after_widget;
	}


	/* Sanitize widget form values as they are saved. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['category'] = $new_instance['category'];
		
		$instance['autorotate'] = $new_instance['autorotate'];
			
		return $instance;
	}


	/* Back-end widget form. */
		 
	function form( $instance ) {

		$defaults = array(
			'title' => __('Testimonials','om_theme'),
			'category' => 0,
			'autorotate' => 0,
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'om_theme') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Category: Select Box -->
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Testimonials category:', 'om_theme') ?></label>
			<?php
				$args = array(
					'show_option_all'    => __('All Categories', 'om_theme'),
					'hide_empty'         => 0, 
					'echo'               => 1,
					'selected'           => $instance['category'],
					'hierarchical'       => 0, 
					'name'               => $this->get_field_name( 'category' ),
					'id'         		     => $this->get_field_id( 'category' ),
					'class'              => '',
					'depth'              => 0,
					'tab_index'          => 0,
					'taxonomy'           => 'testimonials-type',
					'hide_if_empty'      => false 	
				);
		
				wp_dropdown_categories( $args );

			?>
		</p>
		
		<!-- Autorotate: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'autorotate' ); ?>"><?php _e('Autorotate (interval in milliseconds, 0 - to disable):', 'om_theme') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'autorotate' ); ?>" name="<?php echo $this->get_field_name( 'autorotate' ); ?>" value="<?php echo $instance['autorotate']; ?>" />
		</p>
		
		<?php
	}
}
?>