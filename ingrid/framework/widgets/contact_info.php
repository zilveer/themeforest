<?php

/* WIDGET - CONTACT INFO */


class tp_widget_contact_info extends WP_Widget {
	
	

	function tp_widget_contact_info() {
		$widget_ops = array('classname' => 'tp_widget_contact_info', 'description' => __('Display contact info with icons','ingrid') );
		parent::__construct('tp_widget_contact_info', '* Contact Information', $widget_ops);
	}


	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		
		if(!empty($instance['tp_widget_contact_info_title'])){ print $before_title . $instance['tp_widget_contact_info_title'] . $after_title; }
	
		echo '
		<ul class="contact_nfo">';
			if(!empty($instance['tp_widget_contact_info_address'])){ echo '<li class="address"><i class="fa fa-map-marker"></i><span><strong>'.__('Address','ingrid').'</strong><br />'.$instance['tp_widget_contact_info_address'].'</span></li>'; }
			if(!empty($instance['tp_widget_contact_info_phone'])){ echo '<li class="phone"><i class="fa fa-phone"></i><span><strong>'.__('Phone','ingrid').'</strong><br />'.$instance['tp_widget_contact_info_phone'].'</span></li>'; }
			if(!empty($instance['tp_widget_contact_info_email'])){ echo '<li class="email"><i class="fa fa-envelope"></i><span><strong>'.__('Email','ingrid').'</strong><br />'.$instance['tp_widget_contact_info_email'].'</span></li>'; }
		echo '	
		</ul>
		';
		
		echo $after_widget;
	}

	
	function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['tp_widget_contact_info_title'] = strip_tags($new_instance['tp_widget_contact_info_title']);						
		$instance['tp_widget_contact_info_address'] = $new_instance['tp_widget_contact_info_address'];	
		$instance['tp_widget_contact_info_phone'] = $new_instance['tp_widget_contact_info_phone'];	
		$instance['tp_widget_contact_info_email'] = $new_instance['tp_widget_contact_info_email'];	
		
		update_option('tp_widget_contact_info_title',$instance['tp_widget_contact_info_title']);
		update_option('tp_widget_contact_info_address',$instance['tp_widget_contact_info_address']);
		update_option('tp_widget_contact_info_phone',$instance['tp_widget_contact_info_phone']);
		update_option('tp_widget_contact_info_email',$instance['tp_widget_contact_info_email']);
        return $instance;
    }

	
	function form($instance) {
		$defaults = array( 'tp_widget_contact_info_title' => '', 'tp_widget_contact_info_address' => '', 'tp_widget_contact_info_phone' => '', 'tp_widget_contact_info_email' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
				
		echo '<p><label>'.__('Title','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_contact_info_title').'" type="text" name="'.$this->get_field_name('tp_widget_contact_info_title').'" value="'.esc_attr($instance['tp_widget_contact_info_title']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Address','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_contact_info_address').'" type="text" name="'.$this->get_field_name('tp_widget_contact_info_address').'" value="'.esc_attr($instance['tp_widget_contact_info_address']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Phone','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_contact_info_phone').'" type="text" name="'.$this->get_field_name('tp_widget_contact_info_phone').'" value="'.esc_attr($instance['tp_widget_contact_info_phone']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		<p><label>'.__('Email','ingrid').':</label>
		<input id="'.$this->get_field_id('tp_widget_contact_info_email').'" type="text" name="'.$this->get_field_name('tp_widget_contact_info_email').'" value="'.esc_attr($instance['tp_widget_contact_info_email']).'" style="font-size: 11px; width: 100%; margin-bottom: 10px;" /></p>
		';
	 }
}

register_widget('tp_widget_contact_info');
?>