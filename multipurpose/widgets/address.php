<?php
add_action('widgets_init', 'address_widget_register');

function address_widget_register() {
	register_widget('Address_Widget');
}

class Address_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'address_widget',
			__('MultiPurpose Contact Info Widget', 'multipurpose'),
			array('description' => esc_attr__('Shows an address with a telephone number and e-mail', 'multipurpose'))
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters('widget_title', $instance['title']); 
	    $address = $instance['address']; 
	    $phone = $instance['phone'];
	    $email = $instance['email'];
	      
	    echo $args['before_widget'];  
	    if (!empty($title)) {
	    	echo $args['before_title'] . $title . $args['after_title'];  
	    }  
	    if (!empty($address)) {
	    	echo '<p>'. nl2br($address) . '</p>';
	    }
	    if(!empty($phone) || !empty($email)) {
	    	echo '<p>';
	    	if(!empty($phone)) echo esc_attr__('Phone', 'multipurpose') . ': ' . $phone;
	    	if(!empty($phone) && !empty($email)) echo "<br>";
	    	if(!empty($email)) echo esc_attr__('E-mail', 'multipurpose') . ': <a href="mailto:' . $email . '"">' . $email . '</a>';
	    	echo '</p>';
	    }  
	    echo $args['after_widget'];  
	}

	public function form($instance) {
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('Title:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php 
		if (isset($instance['address'])) {
			$address = $instance['address'];
		} else {
			$address = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('address'); ?>"><?php esc_attr_e('Address:', 'multipurpose'); ?></label> 
		<textarea class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" rows="2" cols="30"><?php echo esc_attr($address); ?></textarea>
		</p>
		<?php 
		if (isset($instance['phone'])) {
			$phone = $instance['phone'];
		} else {
			$phone = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('phone'); ?>"><?php esc_attr_e('Phone:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo esc_attr($phone); ?>" />
		</p>
		<?php 
		if (isset($instance['email'])) {
			$email = $instance['email'];
		} else {
			$email = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id('email'); ?>"><?php esc_attr_e('E-mail:', 'multipurpose'); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
		</p>
		<?php
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';
		$instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
		return $instance;
	}	
}
?>