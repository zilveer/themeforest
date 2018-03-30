<?php
class ABdev_contact_info extends WP_Widget {
	
	function ABdev_contact_info(){
		$widget_ops = array(
			'classname' => 'contact-info', 
			'description' => __('Contact informations with icons', 'ABdev_aeron' ),
		);
		$control_ops = array(
			'id_base' => 'contact-info',
		);
		parent::__construct('contact-info', __('Contact Info', 'ABdev_aeron' ), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$telephone = $instance['telephone'];
		$fax = $instance['fax'];
		$email = $instance['email'];
		$company = $instance['company'];
		$address = $instance['address'];
		$state = $instance['state'];
		$map_link = $instance['map_link'];
		
		echo $before_widget;

		if($title){
			echo $before_title.$title.$after_title;
		}
		
		
		?>
		<div class='contact-info'>
			<?php
			if(!empty($telephone) || !empty($fax) || !empty($email)){
				echo'<p>';
				echo (!empty($telephone))? __('Tel: ', 'ABdev_aeron' ).$telephone.'<br>' : '';
				echo (!empty($fax))? __('Fax: ', 'ABdev_aeron' ).$fax.'<br>' : '';
				echo (!empty($email))? __('E-mail: ', 'ABdev_aeron' ).'<a href="mailto:'.$email.'">'.$email.'</a>' : '';
				echo'</p>';
			}
			if(!empty($company) || !empty($address) || !empty($state)){
				echo'<p>';
				echo (!empty($company))? $company.'<br>' : '';
				echo (!empty($address))? $address.'<br>' : '';
				echo (!empty($state))? $state : '';
				echo'</p>';
			}
			if(!empty($map_link)){
				echo '<a href="'.$map_link.'">'.__('Show on Map</a> <i class="ci_icon-location"></i>', 'ABdev_aeron' );
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance){
		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['telephone'] = strip_tags($new_instance['telephone']);
		$instance['fax'] = strip_tags($new_instance['fax']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['company'] = strip_tags($new_instance['company']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['state'] = strip_tags($new_instance['state']);
		$instance['map_link'] = strip_tags($new_instance['map_link']);

		return $instance;
	}

	
	function form($instance){
		$defaults = array('title' => 'Contacts');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('telephone'); ?>"><?php _e('Telephone:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('telephone'); ?>" name="<?php echo $this->get_field_name('telephone'); ?>" value="<?php echo $instance['telephone']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $instance['fax']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('company'); ?>"><?php _e('Company name:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('company'); ?>" name="<?php echo $this->get_field_name('company'); ?>" value="<?php echo $instance['company']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('state'); ?>"><?php _e('State:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" value="<?php echo $instance['state']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('map_link'); ?>"><?php _e('Map link:', 'ABdev_aeron');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('map_link'); ?>" name="<?php echo $this->get_field_name('map_link'); ?>" value="<?php echo $instance['map_link']; ?>" />
		</p>

		
	<?php
	}
}


function ABdev_contact_info_widget(){
	register_widget('ABdev_contact_info');
}

add_action('widgets_init', 'ABdev_contact_info_widget');