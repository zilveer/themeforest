<?php
/**
 *
 */

class MySite_Contact_Form_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_Contact_Form_Widget() {
		$widget_ops = array( 'classname' => 'mysite_contact_form_widget', 'description' => __( 'Quickly add a contact form to your sidebar', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 200, 'height' => 200 );
		$this->WP_Widget( 'contact_form', sprintf( __( '%1$s - Contact Form', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {

       	extract( $args );
       	$title = apply_filters('widget_title', empty($instance['title']) ? __( 'Contact Info', MYSITE_TEXTDOMAIN ) : $instance['title'], $instance, $this->id_base);
		$email = ( isset( $instance['email'] ) ? $instance['email'] : '' );
		$captcha = ( !empty( $instance['enable_captcha'] ) ) ? 'true' : false;
		$akismet = ( !empty( $instance['enable_akismet'] ) ) ? 'true' : false;
		
		$out = '';
        $out .= $before_widget;
		$out .= $before_title . $title . $after_title;
		
		$out .= '[contactform email="' . $email . '" captcha="' . $captcha . '" akismet="' . $akismet . '" sidebar="true"] ';
		$out .= '[name label="Name:" required="true"] ';
		$out .= '[email label="Email:" required="true"] ';
		$out .= '[textarea label="Message:" required="true"] ';
		$out .= '[/contactform]';
		
		$out .= $after_widget;
		
		echo do_shortcode( $out );
	}

	/**
	 *
	 */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['enable_captcha'] = !empty($new_instance['enable_captcha']) ? 1 : 0;
		$instance['enable_akismet'] = !empty($new_instance['enable_akismet']) ? 1 : 0;
			
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		$enable_captcha = isset( $instance['enable_captcha'] ) ? (bool) $instance['enable_captcha'] : false;
		$enable_akismet = isset( $instance['enable_akismet'] ) ? (bool) $instance['enable_akismet'] : false;
			
		?><p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Email:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('enable_captcha'); ?>" name="<?php echo $this->get_field_name('enable_captcha'); ?>"<?php checked( $enable_captcha ); ?> />
		<label for="<?php echo $this->get_field_id('enable_captcha'); ?>"><?php _e( 'Enable Captcha?', MYSITE_ADMIN_TEXTDOMAIN ); ?></label></p>
		
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('enable_akismet'); ?>" name="<?php echo $this->get_field_name('enable_akismet'); ?>"<?php checked( $enable_akismet ); ?> />
		<label for="<?php echo $this->get_field_id('enable_akismet'); ?>"><?php _e( 'Enable Akismet?', MYSITE_ADMIN_TEXTDOMAIN ); ?></label></p>
		
        <?php
	}

}

?>