<?php
add_action('widgets_init', 'location_load_widgets');

function location_load_widgets()
{
	register_widget('Location_Widget');
}

class Location_Widget extends WP_Widget {
	
	function Location_Widget()
	{
		$widget_ops = array('classname' => 'location', 'description' => 'Location & Social Icons.');

		$control_ops = array('id_base' => 'location-widget');

		parent::__construct('location-widget', 'Progression: Contact Us', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$contact_subtitle = $instance['contact_subtitle'];
		$address = $instance['address'];
		$phone = $instance['phone'];
		$int_phone = $instance['int_phone'];
		$email = $instance['email'];

		echo $before_widget;

		if($title) {
			echo  $before_title.$title.$after_title;
		} ?>
			
			
		
		<?php if($contact_subtitle): ?><h6 class="heading-address-widget"><?php echo $contact_subtitle; ?></h6><?php endif; ?>
		<?php if($address): ?><div class="address-widget"><?php echo $address; ?></div><?php endif; ?>
		<?php if($phone): ?><div class="phone-widget"><span><?php _e( 'Phone:', 'progression' ); ?></span> <?php echo $phone; ?></div><?php endif; ?>
		<?php if($int_phone): ?><div class="mobile-widget"><span><?php _e( 'Mobile:', 'progression' ); ?></span> <?php echo $int_phone; ?></div><?php endif; ?>
		<?php if($email): ?>	<div class="e-mail-widget"><span><?php _e( 'E-mail:', 'progression' ); ?></span> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div><?php endif; ?>
		
		
		
		<div class="social-icons">
				<?php if(of_get_option('rss_link_widget')): ?>
				<a class="rss" href="<?php echo of_get_option('rss_link_widget'); ?>" target="_blank">r</a>
				<?php endif; ?>
				<?php if(of_get_option('facebook_link_widget')): ?>
				<a class="facebook" href="<?php echo of_get_option('facebook_link_widget'); ?>" target="_blank">F</a>
				<?php endif; ?>
				<?php if(of_get_option('twitter_link_widget')): ?>
				<a class="twitter" href="<?php echo of_get_option('twitter_link_widget'); ?>" target="_blank">t</a>
				<?php endif; ?>
				<?php if(of_get_option('skype_link_widget')): ?>
				<a class="skype" href="<?php echo of_get_option('skype_link_widget'); ?>" target="_blank">s</a>
				<?php endif; ?>
				<?php if(of_get_option('vimeo_link_widget')): ?>
				<a class="vimeo" href="<?php echo of_get_option('vimeo_link_widget'); ?>" target="_blank">v</a>
				<?php endif; ?>
				<?php if(of_get_option('linkedin_link_widget')): ?>
				<a class="linkedin" href="<?php echo of_get_option('linkedin_link_widget'); ?>" target="_blank">l</a>
				<?php endif; ?>
				<?php if(of_get_option('dribbble_link_widget')): ?>
				<a class="dribbble" href="<?php echo of_get_option('dribbble_link_widget'); ?>" target="_blank">d</a>
				<?php endif; ?>
				<?php if(of_get_option('forrst_link_widget')): ?>
				<a class="forrst" href="<?php echo of_get_option('forrst_link_widget'); ?>" target="_blank">f</a>
				<?php endif; ?>
				<?php if(of_get_option('flickr_link_widget')): ?>
				<a class="flickr" href="<?php echo of_get_option('flickr_link_widget'); ?>" target="_blank">n</a>
				<?php endif; ?>
				<?php if(of_get_option('google_link_widget')): ?>
				<a class="google" href="<?php echo of_get_option('google_link_widget'); ?>" target="_blank">g</a>
				<?php endif; ?>
				<?php if(of_get_option('youtube_link_widget')): ?>
				<a class="youtube" href="<?php echo of_get_option('youtube_link_widget'); ?>" target="_blank">y</a>
				<?php endif; ?>
				<div class="clearfix"></div>
		</div><!-- close .social-icons -->
		
		
		<?php echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['contact_subtitle'] = $new_instance['contact_subtitle'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['int_phone'] = $new_instance['int_phone'];
		$instance['email'] = $new_instance['email'];
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Visit us', 'contact_subtitle' => '', 'address' => '', 'phone' => '', 'int_phone' => '', 'email' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('contact_subtitle'); ?>">Sub-Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('contact_subtitle'); ?>" name="<?php echo $this->get_field_name('contact_subtitle'); ?>" value="<?php echo $instance['contact_subtitle']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>">Address:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>">Phone:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('int_phone'); ?>">Mobile:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('int_phone'); ?>" name="<?php echo $this->get_field_name('int_phone'); ?>" value="<?php echo $instance['int_phone']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">Email Address:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		
	<?php
	}
}
?>