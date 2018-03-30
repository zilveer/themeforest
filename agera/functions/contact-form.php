<?php
$shortname = "agera";
$mp_option = agera_get_global_options();

$target_email =  $mp_option[$shortname.'_contact_email'];

//If the form is submitted
if(isset($_POST['submitted'])) {
	/* checking if 'checking' field is checked*/
	
	if(trim($_POST['checking']) !== '') {
		$checking_error = true;
	} else {
	/* checking 'author_cf' field */
		if(trim($_POST['author_cf']) === '') 
			$is_error = true; 
		else 
			$name = trim($_POST['author_cf']);
				
		/* checking 'email' address is submitted */
		if(trim($_POST['email_cf']) === '')  
			$is_error = true;
		// email validation
		else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email_cf']))) 
			$is_error = true;
		else 
			$email = trim($_POST['email_cf']);

		/* checking 'comment' field - if there is any text */	
		if(trim($_POST['message_cf']) === '') {
			$is_error = true;
		} else {
			if(function_exists('stripslashes')) 
					$comment = stripslashes(trim($_POST['message_cf']));
			else 
					$comment = trim($_POST['message_cf']);
		}
		
		/* if there is no errors email is send */	
		if(!isset($is_error)) {
			$emailTo = $target_email; // default wordpress email address

			$from    = "My blog - ".get_bloginfo('title'); 

			$subject = "Message from ".$name;
			$sendCopy = trim($_POST['send_copy']);
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $comment";
			$headers = "From: $from <".$email.">";
			print_r($emailTo);
			print_r($subject);
			print_r($body);
			print_r($header);
			echo $emailTo.' '.$subject.' '.$body.' '.$headers;
			mail($emailTo, $subject, $body, $headers);
			
			// sending email copy
			if($sendCopy == true) {
				$from = get_bloginfo('title');
				$subject = "Email copy sended to ".$emailTo;
				$headers = "From: $from <$email>";
				mail($emailTo, $subject, $body, $headers);
			}

			$email_send = true;
		}
	}
} ?>

<script type="text/javascript">

jQuery(document).ready(function($) {
	
	$.validator.addMethod("notEqual", function(value, element, param) {
		return value !== param;
	}, "Please input value!");
	 	
	/* Validation for contact form */
	$('#contact_form').validate({
		rules: {
			author_cf: {
				required: true,
				minlength: 2,
				notEqual: 'Name *'
			},
					
			email_cf: {
				required: true,
				email: true, 
				notEqual: 'Email *'
			},
			
			message_cf: {
				required: true,
				minlength: 5,
				notEqual: 'Message *'
				
			}			
		},
				
		messages: {
			author_cf: "<?php echo $mp_option[$shortname.'_cf_name_error']; ?>",
			email_cf: "<?php echo $mp_option[$shortname.'_cf_email_error']; ?>",
			message_cf: "<?php echo $mp_option[$shortname.'_cf_message_error']; ?>"
		}
	});
	
	$('form#contact_form').submit(function() {
		var $this = $(this);
		$this.find('.requiredField').removeClass('error');
		var hasError = false;
		$('.requiredField').each(function() {
			var $this = $(this);
			if(jQuery.trim($this.val()) == '') {
				var labelText = $this.prev('label').text();
				$this.addClass('error');
				hasError = true;
			} else if($this.hasClass('email_cf')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim($this.val()))) {
					var labelText = $this.prev('label').text();
					$this.addClass('error');
					hasError = true;
				}
			} else if($this.hasClass('author_cf')) {
				if($this.val().length < 1 || $this.val() == "Name *" ) {
					var labelText = $this.prev('label').text();
					$this.addClass('error');
					hasError = true;
				}
			} else if($this.hasClass('message_cf')) {
				if($this.val().length < 5 || $this.val() == "Message *" ) {
					$this.addClass('error');
					hasError = true;
				}
			}
		});
					
		if(!hasError) {
			var formInput = $this.serialize();
			$.post($this.attr('action'), formInput, function(data) {			   
				$this.find('.comments_form_text').after('<p class="cf-success"><?php echo $mp_option[$shortname.'_cf_success']; ?></p>');
			});
		} 
		
	return false;
				
	});
});

</script>
	<?php
	$output = '';
	
	 if(!isset($emailSent)) { 	
	 	 
	 $output .= '<form action="'.get_permalink().'" id="contact_form" method="post">';

			$output .= '<div class="comment-from-who">';
			$output .= '<p class="mpc-name">';
			$output .= '<input type="text" name="author_cf" id="author_cf" value="'.(isset($_POST['author_cf']) ? $_POST['author_cf'] : $mp_option[$shortname.'_cf_name'].' *').'" class="requiredField comments_form author_cf" tabindex="1" onfocus="if(this.value==\''.$mp_option[$shortname.'_cf_name'].' *\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$mp_option[$shortname.'_cf_name'].' *\';"/>';

				$output .= '</p>';
				$output .= '<p class="email">';
				$output .= '<input type="text" name="email_cf" id="email_cf" value="'. (isset($_POST['email_cf']) ? $_POST['email_cf'] : $mp_option[$shortname.'_cf_email'].' *') .'" class="requiredField comments_form email email_cf" tabindex="2" onfocus="if(this.value==\''.$mp_option[$shortname.'_cf_email'].' *\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$mp_option[$shortname.'_cf_email'].' *\';"/>';			
				$output .= '</p>';
				
			$output .= '</div>';
				
			$output .= '<div class="comments_form_text">';
			$output .=	'<p class="mess">';
				$output .= '<textarea name="message_cf" id="message_cf" rows="1" cols="1" class="requiredField comments_form text_f message_cf" tabindex="3" onfocus="if(this.value==\''.$mp_option[$shortname.'_cf_message'].' *\') this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$mp_option[$shortname.'_cf_message'].' *\';">'. (isset($_POST['message_cf']) ? (function_exists('stripslashes') ? stripslashes($_POST['message_cf']) : $_POST['message_cf'] ) : $mp_option[$shortname.'_cf_message'].' *').'</textarea>';
				$output .= '</p>';
					
				$output .= '<p class="form_btns">';
					
					/* SEND BUTTON */
					$output .= '<input name="submit" type="submit" id="submit" tabindex="6" value="'.$mp_option[$shortname.'_cf_send'].'" class="read_more send">';
					$output .= '</input>';
					
					$output .= '<input type="hidden" name="submitted" id="submitted" value="true" />';
						
				$output .= '</p>';

				$output .= '<p class="checking">';
					$output .= '<input type="text" name="checking" id="checking" class="checking" value="'. (isset($_POST['checking']) ? $_POST['checking'] : '') .'" style="display: none;"/>';
				$output .= '</p>';
				$output .= '</div>';
			$output .= '<div class="clear"></div>';
		
		$output .= '</form>'; // end form
		
		if(isset($hasError) || isset($captchaError)) { 
			$output .= '<p class="cf-error">'.$mp_option[$shortname.'_cf_error'].'</p>';
		 }
		 
		return $output;
 } 