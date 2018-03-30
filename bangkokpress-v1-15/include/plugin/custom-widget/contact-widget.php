<?php
/**
 * Plugin Name: Goodlayers Contact Widget
 * Description: Contact From Widget.
 * Version: 1.0
 * Author: Goodlayers
 * Author URI: http://www.goodlayers.com
 *
 */

add_action( 'widgets_init', 'contact_widget' );
function contact_widget() {
	register_widget( 'contact' );
}

add_action('wp_ajax_submit_contact_widget','gdl_submit_contact_widget');
add_action('wp_ajax_nopriv_submit_contact_widget','gdl_submit_contact_widget');
function gdl_submit_contact_widget(){
		
	$captchaError = false;	
	$hasError = false;	
	
	if( $gdl_admin_translator == 'enable' ){
		$translator_send_complete = get_option(THEME_SHORT_NAME.'_translator_sending_complete_contact_widget', 'Thanks! Your email was sent');
		$translator_send_error = get_option(THEME_SHORT_NAME.'_translator_sending_error_contact_widget', 'Message cannot be sent to destination');
	}else{
		$translator_send_complete = __('Thanks! Your email was sent','gdl_front_end');
		$translator_send_error = __('Message cannot be sent to destination','gdl_front_end');
	}
	
	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['widget-contactName']) === '') {
			$hasError = true;
		} else {
			$name = trim($_POST['widget-contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['widget-email']) === '')  {
			$hasError = true;
		} else {
			$email = trim($_POST['widget-email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['widget-comments']) === '') {
			$hasError = true;
		} else {
			$comments = stripslashes(trim($_POST['widget-comments']));
		}
		
		//If there is no error, send the email
		if(!$hasError && !$captchaError) {
			$emailTo = trim($_POST['receiver-email']);
			$subject = 'Contact Form Submission from '.$name;
			
			$body = "Name: " . $name . "\r\n";
			$body = $body . "Email: " . $email . "\r\n";
			$body = $body . "Comments: " . $comments;
			
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n";
			$headers = $headers . 'Reply-To: ' . $email . "\r\n";
			$headers = $headers . 'Content-Type: text/plain; charset=UTF-8 ' . " \r\n";

			if( wp_mail($emailTo, $subject, $body, $headers)){
				die($translator_send_complete);
			}else{
				die($translator_send_error);
			}
		}
	}
	
	die($translator_send_error);
}

class contact extends WP_Widget {

	// Widget Setup
	function contact() {
		$widget_ops = array( 'classname' => 'contact-widget', 'description' => __('Contact From Widget.', 'gdl_back_office') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'contact-widget' );
		parent::__construct('contact-widget', __('Contact (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}


	// How to display the widget on the screen.
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('Contact Form', $instance['title'] );

		echo $before_widget;
		
		if($title) echo $before_title . $title . $after_title;

		// Translator words
		global $gdl_admin_translator;
		if( $gdl_admin_translator == 'enable' ){
			$translator_name = get_option(THEME_SHORT_NAME.'_translator_name_contact_widget', 'Name');
			$translator_email = get_option(THEME_SHORT_NAME.'_translator_email_contact_widget', 'Email');
			$translator_message = get_option(THEME_SHORT_NAME.'_translator_message_contact_widget', 'Message');
			$translator_require = get_option(THEME_SHORT_NAME.'_translator_require_contact_widget', '* Require');
			$translator_submit = get_option(THEME_SHORT_NAME.'_translator_submit_contact_widget', 'Submit');
			$translator_please_wait = get_option(THEME_SHORT_NAME.'_translator_please_wait_contact_widget', 'Please Wait...');
			$translator_email_invalid = get_option(THEME_SHORT_NAME.'_translator_email_invalid', '* Please enter a valid email address');
		}else{
			$translator_name =  __('Name','gdl_front_end');
			$translator_email = __('Email','gdl_front_end');
			$translator_message = __('Message','gdl_front_end');
			$translator_require = __('* Require','gdl_front_end');
			$translator_submit = __('Submit','gdl_front_end');
			$translator_please_wait = __('Please Wait...','gdl_front_end');
			$translator_email_invalid = __('* Please enter a valid email address','gdl_front_end');
		}
		
		?>
		
		<script type="text/javascript">
			/* Contact Form Widget*/
			jQuery(document).ready(function() {
				jQuery('form#contactForm').submit(function() {
					jQuery('form#contactForm .error').remove();
					var hasError = false;
					jQuery('.requiredField').each(function() {
						if(jQuery.trim(jQuery(this).val()) == '') {
							var labelText = jQuery(this).prev('label').text();
							jQuery(this).parent().append('<div class="error"><?php echo $translator_require; ?></div>');
							hasError = true;
							
						} else if(jQuery(this).hasClass('email')) {
							var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
							if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
								var labelText = jQuery(this).prev('label').text();
								jQuery(this).parent().append('<div class="error"><?php echo $translator_email_invalid; ?></div>');
								hasError = true;
							}
						}
					});
					
					if(!hasError) {
						jQuery('form#contactForm li.buttons button').fadeOut('normal', function() {
							jQuery(this).parent().append('<?php echo $translator_please_wait; ?>');
						});
						var formInput = jQuery(this).serialize();
						jQuery.post(jQuery(this).attr('action'),formInput, function(data){
							jQuery('form#contactForm').slideUp("fast", function() {				   
								jQuery(this).before('<p class="thanks">' + data + '</p>');
							});
						});
					}
					
					return false;
					
				});
			});			
		</script>			
				
		<div class="contact-widget-whole"> 				
			<div class="contact-widget">
					<form action="<?php echo admin_url( 'admin-ajax.php' ) ?>" id="contactForm" method="post">
				
						<ol class="forms">
							<li>
								<label><?php echo $translator_name; ?></label>
								<input type="text" name="widget-contactName" id="widget-contactName" value="<?php if(isset($_POST['widget-contactName'])) echo $_POST['widget-contactName'];?>" class="requiredField" />
							</li>
							<li>
								<label><?php echo $translator_email; ?></label>
								<input type="text" name="widget-email" id="widget-email" value="<?php if(isset($_POST['widget-email']))  echo $_POST['widget-email'];?>" class="requiredField email" />
							</li>
							<li class="textarea">
								<label><?php echo $translator_message; ?></label>
								<textarea name="widget-comments" id="widget-commentsText" class="requiredField"><?php if(isset($_POST['widget-comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['widget-comments']); } else { echo $_POST['widget-comments']; } } ?></textarea>
							</li>
							<li class="screenReader">
								<input type="text" name="checking" id="checking" class="screenReader" />
								<input type="text" name="receiver-email" id="receiver-email" class="screenReader" value="<?php echo $instance['email']; ?>" />
								<input type="text" name="action" id="action" class="screenReader" value="submit_contact_widget" />
							</li>
							<li class="buttons"><input type="hidden" name="submitted" id="submitted" value="true" /><button type="submit" class="button"><?php echo $translator_submit; ?></button></li>
						</ol>
					</form>
			</div>
			<div class="clear alignleft"></div>
		</div>	<!-- contact widget whole -->				
		<?php 

		echo $after_widget;
		
	}

	// Update the widget settings.
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = strip_tags( $new_instance['email'] );

		return $instance;
	}

	// Widget Settings
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Contact Widget', 'gdl_back_office'), 'email' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Widget Email: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Email:', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" class="width100" />
		</p>		
		
	<?php
	}
}

?>