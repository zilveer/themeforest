<?php
/**
 *
 */

class MySite_Contact_Widget extends WP_Widget {
    
	/**
	 *
	 */
    function MySite_Contact_Widget() {
		$widget_ops = array( 'classname' => 'mysite_contact_widget', 'description' => __( 'Quickly add contact info to your sidebar (e.g. address, phone #, email)', MYSITE_ADMIN_TEXTDOMAIN ) );
		$control_ops = array( 'width' => 400, 'height' => 200 );
		$this->WP_Widget( 'contact', sprintf( __( '%1$s - Contact Us', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ), $widget_ops, $control_ops );
    }

	/**
	 *
	 */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __( 'Contact Info', MYSITE_TEXTDOMAIN ) : $instance['title'], $instance, $this->id_base);
		$name = ( isset( $instance['name'] ) ? $instance['name'] : '' );
		$address = ( isset( $instance['address'] ) ? $instance['address'] : '' );
		$city = ( isset( $instance['city'] ) ? $instance['city'] : '' );
		$state = ( isset( $instance['state'] ) ? $instance['state'] : '' );
		$zip = ( isset( $instance['zip'] ) ? $instance['zip'] : '' );
		$phone = ( isset( $instance['phone'] ) ? $instance['phone'] : '' );
		$email = ( isset( $instance['email'] ) ? $instance['email'] : '' );
		?>
	
        <?php echo $before_widget; ?>

		<?php echo $before_title . $title . $after_title; ?>
		
		<?php if ( $name ) : ?>
		<span class="contact_widget_name"><?php echo $name; ?></span><br /> <?php endif; ?>
		<?php if ( $address ) : ?>
		<span class="contact_widget_address"><?php echo $address; ?></span><br /> <?php endif; ?>
		<?php if ( $city ) : ?>
		<span class="contact_widget_city"><?php echo $city; ?>,&nbsp;<?php echo $state; ?></span>&nbsp; <?php endif; ?>
		<?php if ( $zip ) : ?>
		<span class="contact_widget_zip"><?php echo $zip; ?></span><br /> <?php endif; ?>
		<?php if ( $phone ) : ?>
		<span class="contact_widget_phone"><?php echo $phone; ?></span><br /> <?php endif; ?>
		<?php if ( $email ) : ?>
		<span class="contact_widget_email"><a href="#" rel="<?php echo mysite_nospam( $email ); ?>" class="email_link_replace"><?php echo mysite_nospam( $email ); ?></a></span><br /> <?php endif; ?>

        <?php echo $after_widget;
	}

	/**
	 *
	 */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['name'] = strip_tags($new_instance['name']);
		$instance['address'] = strip_tags($new_instance['address']);
		$instance['city'] = strip_tags($new_instance['city']);
		$instance['state'] = strip_tags($new_instance['state']);
		$instance['zip'] = strip_tags($new_instance['zip']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['email'] = strip_tags($new_instance['email']);
			
        return $instance;
    }

	/**
	 *
	 */
    function form($instance) {				
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$name = isset($instance['name']) ? esc_attr($instance['name']) : '';
		$address = isset($instance['address']) ? esc_attr($instance['address']) : '';
		$city = isset($instance['city']) ? esc_attr($instance['city']) : '';
		$state = isset($instance['state']) ? esc_attr($instance['state']) : '';
		$zip = isset($instance['zip']) ? esc_attr($instance['zip']) : '';
		$phone = isset($instance['phone']) ? esc_attr($instance['phone']) : '';
		$email = isset($instance['email']) ? esc_attr($instance['email']) : '';
		?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e( 'Name:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></p>

		<p><label for="<?php echo $this->get_field_name('address'); ?>"><?php _e( 'Address:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('city'); ?>"><?php _e( 'City:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('city'); ?>" name="<?php echo $this->get_field_name('city'); ?>" type="text" value="<?php echo $city; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('state'); ?>"><?php _e( 'State:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('state'); ?>" name="<?php echo $this->get_field_name('state'); ?>" type="text" value="<?php echo $state; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('zip'); ?>"><?php _e( 'Zip:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('zip'); ?>" name="<?php echo $this->get_field_name('zip'); ?>" type="text" value="<?php echo $zip; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e( 'Phone:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_name('email'); ?>"><?php _e( 'Email:', MYSITE_ADMIN_TEXTDOMAIN ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></p>

        <?php
    }

}

?>