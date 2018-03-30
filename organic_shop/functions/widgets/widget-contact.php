<?php

// Widget Class
class qns_contact_widget extends WP_Widget {


/* ------------------------------------------------
	Widget Setup
------------------------------------------------ */

	function qns_contact_widget() {
		$widget_ops = array( 'classname' => 'contact_widget', 'description' => __('Display Contact Details', 'qns') );
		$control_ops = array( 'width' => 300, 'height' => 300, 'id_base' => 'contact_widget' );
		parent::__construct( 'contact_widget', __('Custom Contact Widget', 'qns'), $widget_ops, $control_ops );
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
			// Fetch options stored in $qns_data
			global $qns_data; 
		
			echo '<ul>';	
						
				if ( $qns_data['phone_number'] ) :
					echo '<li class="contact-phone">' . $qns_data['phone_number'] . '</li>';
				else :
					echo '<li class="contact-phone">' . __('Not available','qns') . '</li>';
				endif;
						
				if ( $qns_data['email_address'] ) :
					echo '<li class="contact-mail">' . $qns_data['email_address'] . '</li>';
				else :
					echo '<li class="contact-mail">' . __('Not available','qns') . '</li>';
				endif;
							
			echo '</ul>';
		?>

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
		'title' => 'Customer Services'
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
add_action( 'widgets_init', 'qns_contact_widget' );

// Register Widget
function qns_contact_widget() {
	register_widget( 'qns_contact_widget' );
}