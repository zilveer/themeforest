<?php
class mTheme_Address_Widget extends WP_Widget {

	function mTheme_Address_Widget() {
		$widget_ops = array('classname' => 'mtheme_contact_widget', 'description' => __( 'Display your contact details', 'mthemelocal') );
		$this->WP_Widget('contact_details',MTHEME_NAME .' - '. __('Address', 'mthemelocal'), $widget_ops);
		
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'mthemelocal') : $instance['title'], $instance, $this->id_base);
		$text = $instance['text'];
		$phone = $instance['phone'];
		$cellphone = $instance['cellphone'];
		$email= $instance['email'];
		$address = $instance['address'];
		$city = $instance['city'];
		$state = $instance['state'];
		$zip = $instance['zip'];
		$name = $instance['name'];
		
		if(!empty($city) && !empty($state)){ 
			$city = $city.',&nbsp;'.$state;
		}elseif(!empty($state)){
			$city = $state;
		}
		
		
		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;
		
		?>
			<ul class="contact_address_block">
			<?php if(!empty($text)):?><li class="about_info"><?php echo $text;?></li><?php endif;?>
			<?php if(!empty($name)):?><li><span class="contact_name"><?php echo $name;?></span></li><?php endif;?>
			<?php if(!empty($address)):?><li><span class="contact_address"><?php echo $address;?></span></li><?php endif;?>
			<li>
			<?php if(!empty($city)):?><span class="contact_city"><?php echo $city;?></span><?php endif;?>
			<?php if(!empty($zip)):?><span class="contact_zip"><?php echo $zip;?></span><?php endif;?>
			</li>
			
			<?php if(!empty($phone)):?><li><span class="contact_phone"><?php echo $phone;?></span></li><?php endif;?>
			<?php if(!empty($cellphone)):?><li><span class="contact_mobile"><?php echo $cellphone;?></span></li><?php endif;?>
			<?php if(!empty($email)):?><li><span class="contact_email"><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></span></li><?php endif;?>
			</ul>
		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['cellphone'] = strip_tags($new_instance['cellphone']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['city'] = strip_tags($new_instance['city']);
		$instance['state'] = strip_tags($new_instance['state']);
		$instance['zip'] = strip_tags($new_instance['zip']);
		$instance['name'] = strip_tags($new_instance['name']);
		

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$text = isset($instance['text']) ? esc_attr($instance['text']) : '';
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$cellphone = isset($instance['cellphone']) ? esc_attr($instance['cellphone']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$city = isset($instance['city']) ? esc_attr($instance['city']) : '';
		$state = isset($instance['state']) ? esc_attr($instance['state']) : '';
		$zip = isset($instance['zip']) ? esc_attr($instance['zip']) : '';
		$name = isset($instance['name']) ? esc_attr($instance['name']) : '';
	?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Intro text:', 'mthemelocal'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" ><?php echo $text; ?></textarea></p>
		
		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Company:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php echo $state; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e('Zip:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('cellphone'); ?>"><?php _e('Cell phone:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('cellphone'); ?>" name="<?php echo $this->get_field_name('cellphone'); ?>" type="text" value="<?php echo $cellphone; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('e-mail:', 'mthemelocal'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
		
<?php
	}

}
register_widget('mTheme_Address_Widget');