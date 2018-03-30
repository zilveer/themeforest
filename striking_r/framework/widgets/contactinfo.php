<?php
/**
 * Contact Info Widget Class
 */
if (!class_exists('Theme_Widget_Contact_Info')) {
class Theme_Widget_Contact_Info extends WP_Widget {

	public function __construct(){
		$widget_ops = array('classname' => 'widget_contact_info', 'description' => __( 'Displays a list of contact info.', 'theme_admin') );
		parent::__construct('contact_info',THEME_SLUG.' - '. __('Contact Info', 'theme_admin'), $widget_ops);
		
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Us', 'striking-r') : $instance['title'], $instance, $this->id_base);
		$color = isset($instance['color'])?$instance['color']:'';
		$text = isset($instance['text'])?$instance['text']:'';
		$phone = isset($instance['phone'])?$instance['phone']:'';
		$cellphone = isset($instance['cellphone'])?$instance['cellphone']:'';
		$fax = isset($instance['fax'])?$instance['fax']:'';
		$email = isset($instance['email'])?$instance['email']:'';
		$email = str_replace('@','*',$email);
		$link = isset($instance['link'])?$instance['link']:'';
		$address = isset($instance['address'])?$instance['address']:'';
		$city = isset($instance['city'])?$instance['city']:'';
		$state = isset($instance['state'])?$instance['state']:'';
		$zip = isset($instance['zip'])?$instance['zip']:'';
		$name = isset($instance['name'])?$instance['name']:'';
		
		if(!empty($city) && !empty($state)){
			$city = $city.',&nbsp;'.$state;
		}elseif(!empty($state)){
			$city = $state;
		}
		
		
		echo $before_widget;
		if ( $title)
			echo $before_title . $title . $after_title;
		
		?>
			<div class="contact_info_wrap">
			<?php if(!empty($text)):?><p><?php echo $text;?></p><?php endif;?>
			
			<?php if(!empty($phone)):?><p><span class="icon_text icon_phone <?php echo $color;?>"><?php echo $phone;?></span></p><?php endif;?>
			<?php if(!empty($cellphone)):?><p><span class="icon_text icon_cellphone <?php echo $color;?>"><?php echo $cellphone;?></span></p><?php endif;?>
			<?php if(!empty($fax)):?><p><span class="icon_text icon_fax <?php echo $color;?>"><?php echo $fax;?></span></p><?php endif;?>
			<?php if(!empty($email)):?><p><a href="mailto:<?php echo $email;?>" class="icon_text icon_email <?php echo $color;?>"><?php echo $email;?></a></p><?php endif;?>
			<?php if(!empty($link)):?><p><a href="<?php echo $link;?>" target="_blank" class="icon_text icon_link <?php echo $color;?>"><?php echo $link;?></a></p><?php endif;?>
			<?php if(!empty($address)):?><p><span class="icon_text icon_home <?php echo $color;?>"><?php echo $address;?></span></p><?php endif;?>
			<?php if(!empty($city)||!empty($zip)):?><p class="contact_address">
				<?php if(!empty($city)):?><span><?php echo $city;?></span><?php endif;?>
				<?php if(!empty($zip)):?><span class="contact_zip"><?php echo $zip;?></span><?php endif;?>
			</p><?php endif;?>
			<?php if(!empty($name)):?><p><span class="icon_text icon_id <?php echo $color;?>"><?php echo $name;?></span></p><?php endif;?>
			</div>
		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['color'] = strip_tags($new_instance['color']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['cellphone'] = strip_tags($new_instance['cellphone']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['link'] = strip_tags($new_instance['link']);
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
		$color = isset($instance['color']) ? esc_attr($instance['color']) : '';
		$text = isset($instance['text']) ? esc_attr($instance['text']) : '';
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$cellphone = isset($instance['cellphone']) ? esc_attr($instance['cellphone']) : '';
		$fax = isset($instance['fax']) ? esc_attr($instance['fax']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$link = isset($instance['link']) ? esc_attr($instance['link']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$city = isset($instance['city']) ? esc_attr($instance['city']) : '';
		$state = isset($instance['state']) ? esc_attr($instance['state']) : '';
		$zip = isset($instance['zip']) ? esc_attr($instance['zip']) : '';
		$name = isset($instance['name']) ? esc_attr($instance['name']) : '';
	?>
		<p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e( 'Icons Color:', 'theme_admin' ); ?></label>
			<select name="<?php echo $this->get_field_name('color'); ?>" id="<?php echo $this->get_field_id('color'); ?>" class="widefat">
				<option value="default"<?php selected($color,'default');?>>Default</option>
				<option value="black"<?php selected($color,'black');?>>Black</option>
				<option value="gray"<?php selected($color,'gray');?>>Gray</option>
				<option value="yellow"<?php selected($color,'yellow');?>>Yellow</option>
				<option value="blue"<?php selected($color,'blue');?>>Blue</option>
				<option value="pink"<?php selected($color,'pink');?>>Pink</option>
				<option value="green"<?php selected($color,'green');?>>Green</option>
				<option value="rosy"<?php selected($color,'rosy');?>>Rosy</option>
				<option value="orange"<?php selected($color,'orange');?>>Orange</option>
				<option value="magenta"<?php selected($color,'magenta');?>>Magenta</option>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Introduce text:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('cellphone'); ?>"><?php _e('Cell phone:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('cellphone'); ?>" name="<?php echo $this->get_field_name('cellphone'); ?>" type="text" value="<?php echo $cellphone; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" type="text" value="<?php echo $fax; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('city'); ?>"><?php _e('City:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php echo $state; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e('Zip:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', 'theme_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></p>
		
<?php
	}

}
}