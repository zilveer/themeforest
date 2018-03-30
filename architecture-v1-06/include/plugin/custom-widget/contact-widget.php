<?php
/**
 * Plugin Name: Goodlayers Contact Widget
 * Plugin URI: http://goodlayers.com/
 * Description: A widget that show recent posts( Specified by category ).
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */ 
 
add_action( 'widgets_init', 'contact_widget' );
function contact_widget() {
	register_widget( 'Contact' );
}

class Contact extends WP_Widget {

	// Initialize the widget
	function Contact() {
		parent::__construct('contact-widget', __('Contact Form Widget (Goodlayers)','gdl_back_office'), 
			array('description' => __('A contact form widget.', 'gdl_back_office')));  
	}	

	// Output of the widget
	function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$email = $instance['email'];

		wp_reset_query();

		// Opening of widget
		echo $before_widget;
		
		// Open of title tag
		if ( $title ){ 
			echo $before_title . $title . $after_title; 
		}
			
		global $gdl_admin_translator;
		
		if( $gdl_admin_translator == 'enable' ){
			$gdl_name_string = get_option(THEME_SHORT_NAME.'_translator_name_contact_form', 'Name');
			$gdl_name_error_string = get_option(THEME_SHORT_NAME.'_translator_name_error_contact_form', 'Please enter your name');
			$gdl_email_string = get_option(THEME_SHORT_NAME.'_translator_email_contact_form', 'Email');
			$gdl_email_error_string = get_option(THEME_SHORT_NAME.'_translator_email_error_contact_form', 'Please enter a valid email address');
			$gdl_message_string = get_option(THEME_SHORT_NAME.'_translator_message_contact_form', 'Message');
			$gdl_message_error_string = get_option(THEME_SHORT_NAME.'_translator_message_error_contact_form', 'Please enter message');
			$gdl_submit_button = get_option(THEME_SHORT_NAME.'_translator_submit_contact_form','Submit');
		}else{
			$gdl_name_string = __('Name','gdl_front_end');
			$gdl_name_error_string =  __('Please enter your name','gdl_front_end');
			$gdl_email_string =  __('Email','gdl_front_end');
			$gdl_email_error_string =  __('Please enter a valid email address','gdl_front_end');
			$gdl_message_string =  __('Message','gdl_front_end');
			$gdl_message_error_string = __('Please enter message','gdl_front_end');
			$gdl_submit_button = __('Submit','gdl_front_end');
		}	
		?>
		<div class="contact-form-wrapper">
			<form class="gdl-contact-form">
				<ol class="forms">
					<li class="form-input">
						<strong><?php echo $gdl_name_string; ?> *</strong>
						<input type="text" name="name" class="require-field" />
						<div class="error">* <?php echo $gdl_name_error_string; ?></div>
					</li>
					<li class="form-input">
						<strong><?php echo $gdl_email_string; ?> *</strong>
						<input type="text" name="email" class="require-field email" />
						<div class="error">* <?php echo $gdl_email_error_string; ?></div>
					</li>
					<li class="form-textarea"><strong><?php echo $gdl_message_string; ?> *</strong>
						<textarea name="message" class="require-field"></textarea>
						<div class="error">* <?php echo $gdl_message_error_string; ?></div> 
					</li>
					<li><input type="hidden" name="receiver" value="<?php echo $email; ?>"></li>
					<li class="sending-result" id="sending-result" ><div class="message-box-wrapper green"></div></li>
					<li class="buttons">
						<button type="submit" class="contact-submit button"><?php echo $gdl_submit_button; ?></button>
						<div class="contact-loading"></div>
					</li>
				</ol>
			</form>
			<div class="clear"></div>
		</div>	
		<?php
		// Closing of widget
		echo $after_widget;
		
		wp_deregister_script('contact-form');
		wp_register_script('contact-form', GOODLAYERS_PATH.'/javascript/gdl-contactform.js', false, '1.0', true);
		wp_localize_script( 'contact-form', 'MyAjax', array( 'ajaxurl' => AJAX_URL ) );
		wp_enqueue_script('contact-form');			
	}
	
	// Widget Form
	function form( $instance ) {
		if ( $instance ) {
			$title = esc_attr( $instance[ 'title' ] );
			$email = esc_attr( $instance[ 'email' ] );
		} else {
			$title = '';
			$email = '';
		}
		?>
		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>	

		<!-- Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e( 'Email :', 'gdl_back_office' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
		</p>			
		<?php
	}	
	
	// Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = strip_tags( $new_instance['email'] );

		return $instance;
	}

}

?>