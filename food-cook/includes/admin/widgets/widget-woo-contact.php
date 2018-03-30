<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}
?>
<?php

class Woo_widget_contact extends WP_Widget {

	// Widget Settings
	function Woo_widget_contact() {
		$widget_ops = array('description' => __('Display your Contact Informations', 'woothemes') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact' );
		 WP_Widget::__construct( 'contact', __( 'Dahz - Contact', 'woothemes' ), $widget_ops, $control_ops );
	}

	// Widget Output
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;
		if ( $instance['img'] != '' ){
		    echo  $before_title . '<img src="'. $instance['img'] .'">'. $after_title;
		} else {
			// ------
			echo $before_title . $title . $after_title;
		}
		?>

		<address>
			<?php if($instance['text']): ?>
			<p> <?php echo $instance['text']; ?></p>
			<?php endif; ?>

			<?php if($instance['phone']): ?>
			<span class="phone"><p><i class="fa fa-phone"></i><?php _e( 'Phone', 'woothemes' ) ?> : <?php echo $instance['phone']; ?></p></span>
			<?php endif; ?>

			<?php if($instance['fax']): ?>
			<span class="fax"><p> <i class="fa fa-file"></i><?php _e( 'Fax', 'woothemes' ) ?> : <?php echo $instance['fax']; ?></p></span>
			<?php endif; ?>

			<?php if($instance['email']): ?>
			<span class="email"><p><i class="fa fa-envelope"></i><?php _e( 'E-Mail', 'woothemes' ) ?> : <a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a></p></span>
			<?php endif; ?>

			<?php if($instance['web']): ?>
			<span class="web"><p><i class="fa fa-globe"></i><?php _e( 'Web', 'woothemes' ) ?> : <a href="<?php echo $instance['web']; ?>"><?php echo $instance['web']; ?></a></p></span>
			<?php endif; ?>

			<?php if($instance['address']): ?>
			<span class="address"><p><i class=" fa fa-map-marker "></i><?php echo $instance['address']; ?></p></span>
			<?php endif; ?>
		</address>

		<?php
		echo $after_widget;
		// ------
	}

	// Update
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
		$instance['img'] = $new_instance['img'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['web'] = $new_instance['web'];

		return $instance;
	}

	// Backend Form
	function form($instance) {

		$defaults = array('title' => 'Contact Info', 'img' => '', 'text' => '', 'address' => '', 'phone' => '', 'fax' => '', 'email' => '', 'web' => '');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input type="text" class="widefat"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('img'); ?>">Title image URL ( Optional ):</label>
			<input type="text" class="widefat"  id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" value="<?php echo $instance['img']; ?>" />
		</p>

		 <p>
     		 <textarea class="widefat" rows="7" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>
  		  </p>

		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>">Address:</label>
			<input type="text" class="widefat"  id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>">Phone:</label>
			<input type="text" class="widefat"  id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>">Fax:</label>
			<input type="text" class="widefat"  id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $instance['fax']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>">Email:</label>
			<input type="text" class="widefat"  id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('web'); ?>">Website URL:</label>
			<input type="text"  class="widefat"  id="<?php echo $this->get_field_id('web'); ?>" name="<?php echo $this->get_field_name('web'); ?>" value="<?php echo $instance['web']; ?>" />
		</p>

    <?php }
}


	register_widget('Woo_widget_contact');



?>