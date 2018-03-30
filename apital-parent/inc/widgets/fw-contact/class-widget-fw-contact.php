<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );

class Widget_Fw_Contact extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __( 'Contact Us Widget (works only in footer sidebars).', 'fw' ) );

		parent::__construct( false, __( 'Apital Contact Us', 'fw' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$params = array();

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$filepath = dirname( __FILE__ ) . '/views/widget.php';

		$data = array(
			'instance' => $params,
			'before_widget' => '',
			'after_widget'  => '',
		);

        if(defined('FW'))
        echo fw_render_view( $filepath, $data );
    }

	function update( $new_instance, $old_instance ) {
		$instance = wp_parse_args( (array) $new_instance, $old_instance );
        $instance['title'] = $new_instance['title'];
        $instance['text'] = $new_instance['text'];
        $instance['adress'] = $new_instance['adress'];
        $instance['phone'] = $new_instance['phone'];
        $instance['email'] = $new_instance['email'];
        $instance['website'] = $new_instance['website'];

		return $instance;
	}

	function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'adress' => '', 'phone' => '','email' => '','website' => '') );
        $title = ($instance['title']);
        $text = ($instance['text']);
        $email = $instance['email'];
        $adress = $instance['adress'];
        $phone = $instance['phone'];
        $website = $instance['website'];
        ?>

        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','fw'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php _e('Add short description:','fw'); ?></label>
            <textarea class="widefat" rows="5" cols="10" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo do_shortcode($text); ?></textarea></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('adress')); ?>"><?php _e('Address:','fw'); ?></label>
            <textarea class="widefat" rows="5" cols="10" id="<?php echo esc_attr($this->get_field_id('adress')); ?>" name="<?php echo esc_attr($this->get_field_name('adress')); ?>"><?php echo do_shortcode($adress); ?></textarea></p>


        <p><label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php _e('Phone:','fw'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:','fw'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('website')); ?>"><?php _e('Website:','fw'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('website')); ?>" name="<?php echo esc_attr($this->get_field_name('website')); ?>" type="text" value="<?php echo esc_attr($website); ?>" /></p>

<?php
	}
}


