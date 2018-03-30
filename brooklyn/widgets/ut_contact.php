<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

class WP_Widget_Contact extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'ut_widget_contact', 'ut_widget_contact_description' => __( 'Insert your contact data in here!', 'unitedthemes') );
		parent::__construct('ut_contact', __('United Themes - Contact', 'unitedthemes'), $widget_ops);
		$this->alt_option_name = 'ut_widget_contact';

	}
	
	function form($instance) {
	
	$title    = ( isset($instance['title']) ) ? esc_attr($instance['title']) : ''; 
	$address  = ( isset($instance['address']) ) ? esc_attr($instance['address']) : '';
	$phone    = ( isset($instance['phone']) ) ? esc_attr($instance['phone']) : '';
	$fax      = ( isset($instance['fax']) ) ? esc_attr($instance['fax']) : '';
	$email    = ( isset($instance['email']) ) ? esc_attr($instance['email']) : '';
	$internet = (isset($instance['internet']) ) ? esc_attr($instance['internet']) : '';
	
	?>

    <label><?php _e('Title', 'unitedthemes'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" /></label>
    <label><?php _e('Address', 'unitedthemes'); ?>: <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea></label>
	<label><?php _e('Phone', 'unitedthemes'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $phone; ?>" /></label>
    <label><?php _e('Fax', 'unitedthemes'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $fax; ?>" /></label>
   	<label><?php _e('Email', 'unitedthemes'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $email; ?>" /></label>
   	<label><?php _e('Internet', 'unitedthemes'); ?>: <input type="text" style="width:100%;" id="<?php echo $this->get_field_id('internet'); ?>" name="<?php echo $this->get_field_name('internet'); ?>" value="<?php echo $internet; ?>" /></label>
	
	<?php

    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function widget( $args, $instance ){

	extract( $args );
	extract( $instance );

	if( $title )
	    $title = $before_title.do_shortcode($title).$after_title;

	$text = ( isset($text) ) ? do_shortcode( $text ) : '';
	$text.= '<ul>';
	
	if(!empty($address)) {
		
        $text.= '<li class="ut-address"><div>';
		$text.= wpautop( $address ).'</div></li>';	
        
	}
	
	if(!empty($phone)) {
		
        $text.= '<li class="ut-phone"><div>';
		$text.= $phone.'</div></li>';	
        
	}
	
	if(!empty($fax)) {
		
        $text.= '<li class="ut-fax"><div>';
		$text.= $fax.'</div></li>';		
        
	}
	
	if(!empty($email)) {
		
        $text.= '<li class="ut-email"><div><a href="mailto:' . esc_attr( $email ) . '">'. $email .'</a>';
		$text.= '</div></li>';	
        
	}
	if(!empty($internet)) {
		
        $text.= '<li class="ut-internet"><div>';
		$text.= $internet.'</div></li>';	
        
	}
	
	
	$text.= '</ul>';

	echo "$before_widget
	    	$title
			$text
		  $after_widget";
    }

}

add_action( 'widgets_init', create_function( '', 'return register_widget("wp_widget_contact");' ) );

?>
