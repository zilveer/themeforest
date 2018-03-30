<?php
/**
 * Plugin Name: Contact Page Headquarter Widget
 * Description: A widget that displays headquarter details.
 * Version: 1.0
 * Author: Jan Intia
 * Author URI: http://themeforest.net/user/janintia
 */


add_action( 'widgets_init', 'contact_page_widget' );


function contact_page_widget() {
	register_widget( 'contact_page_headquarter_widget' );
}

class contact_page_headquarter_widget extends WP_Widget {

	function contact_page_headquarter_widget() {
		$widget_ops = array( 'classname' => 'headquarter-widget', 'description' => __('A widget that displays headquarter details. Usually placed on the Contact Page Sidebar', 'morphis') );
		
		$control_ops = array( 'width' => 300, 'height' => 550, 'id_base' => 'headquarter-widget' );
		
		$this->WP_Widget( 'headquarter-widget', __('MORPHIS: Headquarter Widget', 'morphis'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['headquarter_name'] );		
		
		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;
			
		if($instance['headquarter_info'] != '')
			printf('<p>'. $instance['headquarter_info'] .'</p>');
		
		
		printf('<ul class="clearfix hq-detail">');
		
		foreach($instance as $instance_key => $instance_val){
		
			if(!empty($instance_val) && $instance_key != 'title' && $instance_key != 'headquarter_info' && $instance_key != 'headquarter_name') :				
				switch ($instance_key) {
					case "tel_no":  
						printf('<li>' . __( 'Tel', 'morphis' ) . ': '. $instance_val .'</li>');
					break;
					case "fax_no":  
						printf('<li>' . __( 'Fax', 'morphis' ) . ': '. $instance_val .'</li>');
					break;
					case "email_add":  
						printf('<li>' . __( 'Email', 'morphis' ) . ': <a href="mailto:'. $instance_val .'">'. $instance_val .'</a></li>');
					break;					
				}				
				
			endif;
			
		}
		
		printf('</ul>');
		
		printf('<p>'. $instance['business_add'] .'</p>');
		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );	
		$instance['headquarter_name'] = strip_tags( $new_instance['headquarter_name'] );			
		$instance['headquarter_info'] = strip_tags( $new_instance['headquarter_info'] );			
		$instance['tel_no'] = strip_tags( $new_instance['tel_no'] );		
		$instance['fax_no'] = strip_tags( $new_instance['fax_no'] );		
		$instance['email_add'] = strip_tags( $new_instance['email_add'] );		
		$instance['business_add'] = strip_tags( $new_instance['business_add'] );		

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.		
		$defaults = array( 
				'title' => __('Headquarters', 'morphis'), 
				'headquarter_name' => 'New York', 
				'headquarter_info' => 'Vel, in porttitor aliquam dictumst vel nec placerat lundium cursus risus! Pulvinar nec aliquam odio lectus aliquet duis duis eros purus odio nascetur proin nunc.', 
				'tel_no' => '1-800-000', 
				'fax_no' => '1-800-101', 
				'name' => 'Jan Intia', 
				'email_add' => 'mailme@this', 
				'business_add' => '201 Varick Street 12th Floor New York, NY'
			);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'headquarter_name' ); ?>"><?php _e('Headquarter Title:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'headquarter_name' ); ?>" name="<?php echo $this->get_field_name( 'headquarter_name' ); ?>" value="<?php echo $instance['headquarter_name']; ?>" style="width:80%;" />
		</p>		
		
		<p>
			<label for="<?php echo $this->get_field_id( 'headquarter_info' ); ?>"><?php _e('Description:', 'morphis'); ?></label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'headquarter_info' ); ?>" name="<?php echo $this->get_field_name( 'headquarter_info' ); ?>" style="width:80%;"><?php echo $instance['headquarter_info']; ?></textarea>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'tel_no' ); ?>"><?php _e('Tel No.:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tel_no' ); ?>" name="<?php echo $this->get_field_name( 'tel_no' ); ?>" value="<?php echo $instance['tel_no']; ?>" style="width:50%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'fax_no' ); ?>"><?php _e('Fax No.:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'fax_no' ); ?>" name="<?php echo $this->get_field_name( 'fax_no' ); ?>" value="<?php echo $instance['fax_no']; ?>" style="width:50%;" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'email_add' ); ?>"><?php _e('Email Address:', 'morphis'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email_add' ); ?>" name="<?php echo $this->get_field_name( 'email_add' ); ?>" value="<?php echo $instance['email_add']; ?>" style="width:50%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'business_add' ); ?>"><?php _e('Business Address:', 'morphis'); ?></label>
			<textarea rows="6" id="<?php echo $this->get_field_id( 'business_add' ); ?>" name="<?php echo $this->get_field_name( 'business_add' ); ?>" style="width:80%;"><?php echo $instance['business_add']; ?></textarea>
		</p>

	<?php
	}
}

?>