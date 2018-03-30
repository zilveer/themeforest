<?php
// Contact Form Widget Class
class Theme_Widget_Contact_Form extends WP_Widget {

	function Theme_Widget_Contact_Form() {
		$widget_ops = array('classname' => 'widget_contact_form', 'description' => __( 'Displays a email contact form.', 'theme_admin') );
		$this->WP_Widget('contact-form', THEME_NAME . ' - ' . __('Contact Form', 'theme_admin'), $widget_ops);
		
		if ( is_active_widget(false, false, $this->id_base) ){
			add_action( 'wp_print_scripts', array(&$this, 'add_script') );
		}
	}
	
	function add_script(){
		
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Email Us', 'theme_front') : $instance['title'], $instance, $this->id_base);
		$email= $instance['email'];
		
		$home_url = home_url();

		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		echo <<<RET
<form class="theme-form ajax-form validate-form" method="post" action="$home_url/wp-admin/admin-ajax.php">
	<input type="hidden" name="action" value="do_contact" />
	<input type="hidden" name="to" value="$email" />
	<div class="input-wrap">
		<i class="icon icon-asterisk"></i>
		<textarea placeholder="Message ..." name="message" data-rule-required="true" data-msg-required="Please fill the message."></textarea>
	</div>
	<div class="input-wrap" style="display:none;">
		<input name="email" type="email" placeholder="Email ..." />
	</div>
	<div class="input-wrap">
		<i class="icon icon-asterisk"></i>
		<input name="from" type="email" placeholder="Email ..." data-rule-required="true" data-msg-required="Please fill your email." data-rule-email="true" data-msg-email="Please enter valid email." />
	</div>
	<div class="input-wrap"><div class="form-response"></div></div>
	<div class="input-wrap"><input type="submit" class="button button-primary" name="submit" value="Submit" /></div>
</form>
RET;
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : get_bloginfo('admin_email');
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'theme_admin'); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Your Email', 'theme_admin'); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>	
<?php
	}
}
register_widget('Theme_Widget_Contact_Form');