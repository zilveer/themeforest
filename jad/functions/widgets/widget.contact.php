<?php

class SG_Widget_Contact extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_contact', 'description' => __('Contact Information Widget' , SG_TDN));
		parent::__construct('sg-contact', __('SG - Contact', SG_TDN), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __('Contact Us', SG_TDN) : __($instance['title']), $instance, $this->id_base );
		$phone = apply_filters( 'widget_text', $instance['phone'], $instance );
		$email = apply_filters( 'widget_text', $instance['email'], $instance );
		$address = apply_filters( 'widget_text', __($instance['address']), $instance );
		echo $before_widget;
		echo $before_title . $title . $after_title; ?>
			<ul class="contacts">
			<?php
				if (!empty($phone)) echo '<li class="cont-phone">' . $phone . '</li>';
				if (!empty($email)) echo '<li class="cont-email"><a href="mailto:' . antispambot($email, 1) . '">' . $email . '</a></li>';;
				if (!empty($address)) echo '<li class="cont-adress">' . nl2br($address) . '</li>';;
			?>
			</ul>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['phone'] = strip_tags($new_instance['phone']);
		$instance['email'] = strip_tags($new_instance['email']);
		if ( current_user_can('unfiltered_html') )
			$instance['address'] =  $new_instance['address'];
		else
			$instance['address'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['address']) ) );
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'phone' => '', 'email' => '', 'address' => '' ) );
		$title = strip_tags($instance['title']);
		$phone = strip_tags($instance['phone']);
		$email = strip_tags($instance['email']);
		$address = esc_textarea($instance['address']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', SG_TDN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', SG_TDN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', SG_TDN); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', SG_TDN); ?></label>
		<textarea class="widefat" rows="4" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea>
<?php
	}
}