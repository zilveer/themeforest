<?php
/**
 * Plugin Name: Contact Details Widget
 * Description: A widget that displays contact details either on the sidebar or in the footer.
 * Version: 1.0
 * Author: Jan Intia
 * Author URI: http://themeforest.net/user/janintia
 */


add_action( 'widgets_init', 'contact_detail_widget' );


function contact_detail_widget() {
	register_widget( 'contact_widget' );
}

class contact_widget extends WP_Widget {

	function contact_widget() {
		$widget_ops = array( 'classname' => 'contact-detail', 'description' => __('A widget that displays contact details', 'morphis') );
		
		$control_ops = array( 'width' => 300, 'height' => 550, 'id_base' => 'contact-detail' );
		
		$this->WP_Widget( 'contact-detail', __('MORPHIS: Contact Details', 'morphis'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
		
		printf('<ul class="clearfix">');
		
		foreach($instance as $instance_key => $instance_val){
			if(!empty($instance_val) && $instance_key != 'title') :				
				switch ($instance_key) {
					case "tel_no":  
						printf('<li>' . __( 'Tel', 'morphis' ) . ': '. $instance_val .'</li>');
					break;
					case "email_add":  
						printf('<li>' . __( 'Email', 'morphis' ) . ': <a href="mailto:'. $instance_val .'">'. $instance_val .'</a></li>');
					break;
					case "business_add":  
						printf('<li>' . __( 'Address', 'morphis' ) . ': '. $instance_val .'</li>');
					break;
				}				
			endif;
		}
		
		printf('</ul>');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );	
		$instance['tel_no'] = strip_tags( $new_instance['tel_no'] );		
		$instance['email_add'] = strip_tags( $new_instance['email_add'] );		
		$instance['business_add'] = strip_tags( $new_instance['business_add'] );		

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.		
		$defaults = array( 'title' => __('Contact Us', 'morphis'), 'tel_no' => '(555) 213-1800', 'name' => 'Jan Intia', 'email_add' => 'youremail@address.com', 'business_add' => '399 Old New Republic St., Downtown Country YY 3077' );
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Heading Title:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'tel_no' ); ?>"><?php _e('Tel/Fax No.:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tel_no' ); ?>" name="<?php echo $this->get_field_name( 'tel_no' ); ?>" value="<?php echo $instance['tel_no']; ?>" style="width:80%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email_add' ); ?>"><?php _e('Email Address:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email_add' ); ?>" name="<?php echo $this->get_field_name( 'email_add' ); ?>" value="<?php echo $instance['email_add']; ?>" style="width:80%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'business_add' ); ?>"><?php _e('Business Address:', 'morphis'); ?></label>
			<textarea rows="10" id="<?php echo $this->get_field_id( 'business_add' ); ?>" name="<?php echo $this->get_field_name( 'business_add' ); ?>" style="width:80%;"><?php echo $instance['business_add']; ?></textarea>
		</p>

	<?php
	}
}

?>