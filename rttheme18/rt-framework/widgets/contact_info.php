<?php
#
# RT-Theme Contact Info
#

class Contact_Info extends WP_Widget {

	function __construct() {
		$opts =array(
					'classname' 	=> 'widget_contact_info',
					'description' 	=> __( 'Use this widget to display your contact details with icons.', 'rt_theme_admin' )
				);

		parent::__construct('contact_info', '['. RT_THEMENAME.']   '.__('Contact Info', 'rt_theme_admin'), $opts);
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		$title                  = apply_filters('widget_title', $instance['title']) ;		 
		$address                = rt_wpml_t( RT_THEMESLUG , 'Address', $instance['address'] );
		$phone_1                = rt_wpml_t( RT_THEMESLUG , 'Phone 1', $instance['phone_1'] ); 
		$phone_2                = rt_wpml_t( RT_THEMESLUG , 'Phone 2', $instance['phone_2'] );
		$fax_1                  = rt_wpml_t( RT_THEMESLUG , 'Fax 1', $instance['fax_1'] ); 
		$fax_2                  = rt_wpml_t( RT_THEMESLUG , 'Fax 2', $instance['fax_2'] );		
		$mail_1                 = rt_wpml_t( RT_THEMESLUG , 'Email 1', $instance['mail_1'] );
		$mail_2                 = rt_wpml_t( RT_THEMESLUG , 'Email 2', $instance['mail_2'] );
		$support_mail_1         = rt_wpml_t( RT_THEMESLUG , 'Support Email 1', $instance['support_mail_1'] );
		$support_mail_2         = rt_wpml_t( RT_THEMESLUG , 'Support Email 2', $instance['support_mail_2'] );
		$map_link               = rt_wpml_t( RT_THEMESLUG , 'Map Link', $instance['map_link'] );
		$contact_form_link      = rt_wpml_t( RT_THEMESLUG , 'Contact Form Link', $instance['contact_form_link'] ); 
		$map_link_text          = rt_wpml_t( RT_THEMESLUG , 'Map Link Text', $instance['map_link_text'] );
		$contact_form_link_text = rt_wpml_t( RT_THEMESLUG , 'Contact Form Link Text', $instance['contact_form_link_text'] ); 


 
		//Contact Info
 		$contactInfo = '<ul class="with_icons default default_size">';
		
		if(!empty($address)) 			$contactInfo .= '<li><span class="icon-home"></span>'.$address.'</li>';
		if(!empty($phone_1)) 			$contactInfo .= '<li><span class="icon-phone"></span>'.$phone_1.'</li>';
		if(!empty($phone_2))			$contactInfo .= '<li><span class="icon-phone"></span>'.$phone_2.'</li>';
		if(!empty($fax_1)) 				$contactInfo .= '<li><span class="icon-print"></span>'.$fax_1.'</li>';
		if(!empty($fax_2))				$contactInfo .= '<li><span class="icon-print"></span>'.$fax_2.'</li>';		
		if(!empty($mail_1)) 			$contactInfo .= '<li><span class="icon-mail-1"></span><a href="mailto:'.$mail_1.'">'.$mail_1.'</a></li>';
		if(!empty($mail_2)) 			$contactInfo .= '<li><span class="icon-mail-1"></span><a href="mailto:'.$mail_2.'">'.$mail_2.'</a></li>'; 
		if(!empty($support_mail_1)) 	$contactInfo .= '<li><span class="icon-lifebuoy"></span><a href="mailto:'.$support_mail_1.'">'.$support_mail_1.'</a></li>';
		if(!empty($support_mail_2)) 	$contactInfo .= '<li><span class="icon-lifebuoy"></span><a href="mailto:'.$support_mail_2.'">'.$support_mail_2.'</a></li>';
		if(!empty($map_link)) 			$contactInfo .= '<li><span class="icon-map"></span><a href="'.$map_link.'" title="'.$map_link_text.'">'.$map_link_text.'</a></li>';
		if(!empty($contact_form_link)) 	$contactInfo .= '<li><span class="icon-pencil-1"></span><a href="'.$contact_form_link.'" title="'.$contact_form_link_text.'">'.$contact_form_link_text.'</a></li>';
		
		$contactInfo .= '</ul>';
		 

		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo $contactInfo;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		 
		$instance = $old_instance;
		$instance['title']					= ($new_instance['title']);  
		$instance['address']				= ($new_instance['address']);	
		$instance['phone_1']				= ($new_instance['phone_1']);
		$instance['phone_2']				= ($new_instance['phone_2']);
		$instance['fax_1']					= ($new_instance['fax_1']);
		$instance['fax_2']					= ($new_instance['fax_2']);		
		$instance['mail_1']					= ($new_instance['mail_1']);
		$instance['mail_2']					= ($new_instance['mail_2']);
		$instance['support_mail_1']			= strip_tags($new_instance['support_mail_1']);
		$instance['support_mail_2']			= strip_tags($new_instance['support_mail_2']);
		$instance['contact_form_link']		= strip_tags($new_instance['contact_form_link']);
		$instance['map_link']				= strip_tags($new_instance['map_link']);		
		$instance['contact_form_link_text']	= strip_tags($new_instance['contact_form_link_text']);
		$instance['map_link_text']			= strip_tags($new_instance['map_link_text']);
		
		rt_wpml_register_string( RT_THEMESLUG , 'Address', strip_tags($new_instance['address']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Phone 1', strip_tags($new_instance['phone_1']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Phone 2', strip_tags($new_instance['phone_2']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Fax 1', strip_tags($new_instance['fax_1']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Fax 2', strip_tags($new_instance['fax_2']) ) ;		
		rt_wpml_register_string( RT_THEMESLUG , 'Email 1', strip_tags($new_instance['mail_1']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Email 2', strip_tags($new_instance['mail_2']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Support Email 1', strip_tags($new_instance['support_mail_1']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Support Email 2', strip_tags($new_instance['support_mail_2']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Map Link', strip_tags($new_instance['map_link']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Contact Form Link', strip_tags($new_instance['contact_form_link']) ) ;				
		rt_wpml_register_string( RT_THEMESLUG , 'Map Link Text', strip_tags($new_instance['map_link_text']) ) ;
		rt_wpml_register_string( RT_THEMESLUG , 'Contact Form Link Text', strip_tags($new_instance['contact_form_link_text']) ) ;
		
		return $instance;
	}

	function form( $instance ) {
		$title                  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$address                = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$phone_1                = isset($instance['phone_1']) ? esc_attr($instance['phone_1']) : '';
		$phone_2                = isset($instance['phone_2']) ? esc_attr($instance['phone_2']) : '';
		$fax_1                  = isset($instance['fax_1']) ? esc_attr($instance['fax_1']) : '';
		$fax_2                  = isset($instance['fax_2']) ? esc_attr($instance['fax_2']) : '';		
		$mail_1                 = isset($instance['mail_1']) ? esc_attr($instance['mail_1']) : '';
		$mail_2                 = isset($instance['mail_2']) ? esc_attr($instance['mail_2']) : '';
		$support_mail_1         = isset($instance['support_mail_1']) ? esc_attr($instance['support_mail_1']) : '';
		$support_mail_2         = isset($instance['support_mail_2']) ? esc_attr($instance['support_mail_2']) : '';
		$map_link               = isset($instance['map_link']) ? esc_attr($instance['map_link']) : '';
		$contact_form_link      = isset($instance['contact_form_link']) ? esc_attr($instance['contact_form_link']) : '';
		$map_link_text          = isset($instance['map_link_text']) ? esc_attr($instance['map_link_text']) : '';
		$contact_form_link_text = isset($instance['contact_form_link_text']) ? esc_attr($instance['contact_form_link_text']) : '';
		
		// Categories
		$rt_getcat = RTTheme::rt_get_categories();
		

?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title ?>" /></p>
 
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('phone_1'); ?>"><?php _e('Phone 1:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone_1'); ?>" name="<?php echo $this->get_field_name('phone_1'); ?>" type="text" value="<?php echo $phone_1; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('phone_2'); ?>"><?php _e('Phone 2:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone_2'); ?>" name="<?php echo $this->get_field_name('phone_2'); ?>" type="text" value="<?php echo $phone_2; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('fax_1'); ?>"><?php _e('Fax 1:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fax_1'); ?>" name="<?php echo $this->get_field_name('fax_1'); ?>" type="text" value="<?php echo $fax_1; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('fax_2'); ?>"><?php _e('Fax 2:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fax_2'); ?>" name="<?php echo $this->get_field_name('fax_2'); ?>" type="text" value="<?php echo $fax_2; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('mail_1'); ?>"><?php _e('Email 1:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('mail_1'); ?>" name="<?php echo $this->get_field_name('mail_1'); ?>" type="text" value="<?php echo $mail_1; ?>" /></p>		

		<p><label for="<?php echo $this->get_field_id('mail_2'); ?>"><?php _e('Email 2:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('mail_2'); ?>" name="<?php echo $this->get_field_name('mail_2'); ?>" type="text" value="<?php echo $mail_2; ?>" /></p>		

		<p><label for="<?php echo $this->get_field_id('support_mail_1'); ?>"><?php _e('Support Email 1:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('support_mail_1'); ?>" name="<?php echo $this->get_field_name('support_mail_1'); ?>" type="text" value="<?php echo $support_mail_1; ?>" /></p>		
 	
		<p><label for="<?php echo $this->get_field_id('support_mail_2'); ?>"><?php _e('Support Email 2:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('support_mail_2'); ?>" name="<?php echo $this->get_field_name('support_mail_2'); ?>" type="text" value="<?php echo $support_mail_2; ?>" /></p>
 	
		<p><label for="<?php echo $this->get_field_id('contact_form_link'); ?>"><?php _e('Contact Form Link:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('contact_form_link'); ?>" name="<?php echo $this->get_field_name('contact_form_link'); ?>" type="text" value="<?php echo $contact_form_link; ?>" /></p>				

		<p><label for="<?php echo $this->get_field_id('contact_form_link_text'); ?>"><?php _e('Contact Form Link Text:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('contact_form_link_text'); ?>" name="<?php echo $this->get_field_name('contact_form_link_text'); ?>" type="text" value="<?php echo empty($contact_form_link_text) ? __('Contact Form','rt_theme_admin') : $contact_form_link_text; ?>" /></p>				
 	 	
		<p><label for="<?php echo $this->get_field_id('map_link'); ?>"><?php _e('Map Link:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('map_link'); ?>" name="<?php echo $this->get_field_name('map_link'); ?>" type="text" value="<?php echo $map_link; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('map_link_text'); ?>"><?php _e('Map Link Text:', 'rt_theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('map_link_text'); ?>" name="<?php echo $this->get_field_name('map_link_text'); ?>" type="text" value="<?php echo empty($map_link_text) ? __('Find us on map','rt_theme_admin') : $map_link_text; ?>" /></p>								
<?php } } ?>