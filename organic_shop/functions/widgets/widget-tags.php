<?php

// Widget Class
class qns_tags_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_tags_widget() {
		$widget_ops = array( 'classname' => 'tags_widget', 'description' => __('Display Tags', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 300, 'id_base' => 'tags_widget' );
		parent::__construct( 'tags_widget', __('Custom Tags Widget', 'qns'), $widget_ops, $control_ops );
	}


/* ------------------------------------------------
	Display Widget
------------------------------------------------ */
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		 } ?>

			<?php 
				$args = array(
					'number'    => 100,
					'smallest'    => 14,
					'largest'    => 14,
					'unit'    => 'px',
					'format'    => 'list',
				);
					
			wp_tag_cloud( $args ); ?>
				
		<?php
		
		echo $after_widget;
	}	
	
	
/* ------------------------------------------------
	Update Widget
------------------------------------------------ */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	
	
/* ------------------------------------------------
	Widget Input Form
------------------------------------------------ */
	 
	function form( $instance ) {
		$defaults = array(
		'title' => 'Tags'
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'qns'); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
	<?php
	}	
	
}

// Add widget function to widgets_init
add_action( 'widgets_init', 'qns_tags_widget' );

// Register Widget
function qns_tags_widget() {
	register_widget( 'qns_tags_widget' );
}