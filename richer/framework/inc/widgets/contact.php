<?php


class widget_contact extends WP_Widget { 
	
	// Widget Settings
	function widget_contact() {
		$widget_ops = array('description' => __('Display your Contact Informations', 'richer') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact' );
		$this->__construct( 'contact', __('richer-Contact', 'richer'), $widget_ops, $control_ops );
	}
	
	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		// ------
		echo $before_widget;
		echo $before_title . $title . $after_title;
		$show_map = isset($instance['show_map']) ? 'true' : 'false';
		$contact_map = isset($instance['address']) ? $instance['address'] : '';
		$map_height = (isset($instance['map_height']) && $instance['map_height'] != '') ? $instance['map_height'] : '250px';
		$map_height = preg_replace('/[^0-9.]/', '', $map_height );
		if($show_map == 'true' && $contact_map != '') {
			echo do_shortcode('[map address="'.$contact_map.'" type="roadmap" width="100%" height="'.$map_height.'px" zoom="15" scrollwheel="true" scale="true" zoom_pancontrol="true"]');
		}
		?>
		<address>
			<?php if($instance['address']): ?>
			<span class="address"><?php echo $instance['address']; ?></span>
			<?php endif; ?>
	
			<?php if($instance['phone']): ?>
			<span class="phone"><strong><?php _e( 'Phone', 'richer') ?>:</strong> <?php echo $instance['phone']; ?></span>
			<?php endif; ?>
	
			<?php if($instance['fax']): ?>
			<span class="fax"><strong><?php _e( 'Fax', 'richer') ?>:</strong> <?php echo $instance['fax']; ?></span>
			<?php endif; ?>
	
			<?php if($instance['email']): ?>
			<span class="email"><strong><?php _e( 'E-Mail', 'richer') ?>:</strong> <a href="mailto:<?php echo esc_attr($instance['email']); ?>"><?php echo $instance['email']; ?></a></span>
			<?php endif; ?>
	
			<?php if($instance['web']): ?>
			<span class="web"><strong><?php _e( 'Web', 'richer') ?>:</strong> <a href="<?php echo esc_url($instance['web']); ?>"><?php echo $instance['web']; ?></a></span>
			<?php endif; ?>
		</address>
		
		<?php
		echo $after_widget;
		// ------
	}
	
	// Update
	function update( $new_instance, $old_instance ) {  
		$instance = $old_instance; 
		
		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['web'] = $new_instance['web'];
		$instance['show_map'] = $new_instance['show_map'];
		$instance['map_height'] = $new_instance['map_height'];

		return $instance;
	}
	
	// Backend Form
	function form($instance) {
		
		$defaults = array('title' => 'Contact Info', 'address' => '', 'phone' => '', 'fax' => '', 'email' => '', 'web' => '', 'show_map' => '', 'map_height' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php _e('Address:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" value="<?php echo esc_attr($instance['address']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php _e('Phone:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" value="<?php echo esc_attr($instance['phone']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('fax')); ?>"><?php _e('Fax:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('fax')); ?>" name="<?php echo esc_attr($this->get_field_name('fax')); ?>" value="<?php echo esc_attr($instance['fax']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" value="<?php echo esc_attr($instance['email']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('web')); ?>"><?php _e('Website URL:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('web')); ?>" name="<?php echo esc_attr($this->get_field_name('web')); ?>" value="<?php echo esc_attr($instance['web']); ?>" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_map'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_map')); ?>" name="<?php echo esc_attr($this->get_field_name('show_map')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('show_map')); ?>">Show map?</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('map_height')); ?>"><?php _e('Map height:','richer'); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('map_height')); ?>" name="<?php echo esc_attr($this->get_field_name('map_height')); ?>" value="<?php echo esc_attr($instance['map_height']); ?>" />
		</p>
		
    <?php }
}

// Add Widget
function widget_contact_init() {
	register_widget('widget_contact');
}
add_action('widgets_init', 'widget_contact_init');

?>