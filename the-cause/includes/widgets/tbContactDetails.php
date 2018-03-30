<?php

// Contact details: data provided through theme options
class TB_Contact_Details extends WP_Widget {
	
	function TB_Contact_Details() {
		$widget_ops = array('classname' => 'tb_contact_details', 'description' => __( 'Contact details', 'the-cause') );		
		$this->WP_Widget('TB_Contact_Details', __('TB Contact Details', 'the-cause'), $widget_ops);
	
	}
	
	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Contact Details', 'the-cause') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

        $sidebarLogo = get_option('tb_sidebar_logo');
        $contactSidebar = get_option('tb_contact_sidebar');
		
		$tbAddress = get_option('tb_address');
		$tbPhoneTitle = get_option('tb_phone_title');
		$tbPhoneNumber = get_option('tb_phone_number');
		$tbEmailTitle = get_option('tb_email_title');
		$tbEmail = get_option('tb_email_email');
		$tbTwitter = get_option('tb_twitter');
		$tbFacebook = get_option('tb_facebook');
		$tbLinkedIn = get_option('tb_linked_in');
		
		echo '<p>';
		
		if ($tbAddress) {
			echo nl2br($tbAddress) . '<br><br>';
		}
		
		if ($tbPhoneNumber) echo "$tbPhoneTitle: $tbPhoneNumber<br>";
		
		if ($tbEmail) echo "$tbEmailTitle: <a href='mailto:$tbEmail'>$tbEmail</a><br>";
		
		echo '</p>';
		
		if ($tbTwitter || $tbFacebook || $tbLinkedIn) {
			echo '<ul class="footerSoc">';
			
			if ($tbTwitter) echo '<li><a href="' . $tbTwitter . '" title="Follow Us on Twitter" class="twitter">Follow Us on Twitter</a></li>';
			if ($tbFacebook) echo '<li><a href="' . $tbFacebook . '" title="Follow Us on Facebook" class="facebook">Follow Us on Facebook</a></li>';
			if ($tbLinkedIn) echo '<li><a href="' . $tbLinkedIn . '" title="Follow Us on LinkedIn" class="linkedin">Follow Us on LinkedIn</a></li>';
			
			echo '</ul>';
		}
		
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Contact Details' ) );
		$title = strip_tags($instance['title']);
	
	
	?>
	
        <p>
        	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'the-cause'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
            
	<?php
	}
}

function tb_register_contact_details() {
	
	register_widget('TB_Contact_Details');
	
	do_action('widgets_init');
}

add_action('init', 'tb_register_contact_details', 1);

?>