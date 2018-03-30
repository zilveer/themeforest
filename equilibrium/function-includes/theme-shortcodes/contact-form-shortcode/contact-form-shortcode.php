<?php

function onioneye_contact_form( $atts ) {
	
	$prefix = uniqid();
	
	extract( shortcode_atts( array(
	  'email' => '',
	  'subject' => __( 'Contact Form Email', 'onioneye' ),
	  'on_success' => __( 'Thank you for your message. You will get an answer as soon as possible.', 'onioneye' ),
	  'on_failure' => __( 'There has been a mistake while sending the message. Please try again.', 'onioneye' ),
	  'invalid_email' => __( "Please enter a valid email address (youremail@yourdomain.com).", 'onioneye' ),
	  'incomplete' => __( "Please make sure all fields are filled out correctly.", 'onioneye' )	  
	), $atts ) );
	
	return '<form id="' . $prefix . 'contact-form" class="contact-form" action="' . htmlentities( $_SERVER['PHP_SELF'] ) . '" method="post">' .
	           	'<fieldset>' .
	      	    	'<label for="' . $prefix . 'name">' . __('Name', 'onioneye') . ': *</label>' . 
	                '<input type="text" id="' . $prefix . 'name" name="name" value="" />' . 
	           	'</fieldset>' . 
	           	'<fieldset>' .
	               	'<label for="' . $prefix . 'email">' . __('Email', 'onioneye') . ': *</label>' .
	              	'<input type="text" id="' . $prefix. 'email" name="email" value="" />' .
	           	'</fieldset>' .
	           	'<fieldset>' .
	               	'<label for="' . $prefix . 'message">' . __('Message', 'onioneye') . ': *</label>' .
	               	'<textarea id="' . $prefix . 'message" name="message" cols="300" rows="12"></textarea>' .
	           	'</fieldset>' .    
	        	'<fieldset>' .
	          		'<input type="submit" id="' . $prefix . 'submit-mail" name="submitmail" value="' . __( 'Send Message', 'onioneye' ) . '" />' .
		      		'<img id="' . $prefix . 'loading" class="invisible loading-img" src="' . get_template_directory_uri() . '/images/layout/loading.gif" alt="' . __( 'Loading...', 'onioneye' ) . '" />' .
	        	'</fieldset>' .
	        	'<input type="hidden" id="' . $prefix . 'myemail" name="myemail" value="' .  $email . '" />' . 
	        	'<input type="hidden" id="' . $prefix . 'subject" name="subject" value="' . $subject . '" />' . 
	        	'<input type="hidden" id="' . $prefix . 'success" name="success" value="' . $on_success . '" />' .
	        	'<input type="hidden" id="' . $prefix . 'failure" name="failure" value="' . $on_failure . '" />' .
	        	'<input type="hidden" id="' . $prefix . 'invalid" name="invalid" value="' . $invalid_email . '" />' .
	        	'<input type="hidden" id="' . $prefix . 'incomplete" name="incomplete" value="' . $incomplete . '" />' .
				'<p id="' . $prefix . 'form-status" class="form-status"><span class="status-icon"></span><span id="' . $prefix . 'status-message"></span></p>' .
		   '</form>' .
	       '<script>' .
	       '/* <![CDATA[ */ ' .
	           'jQuery(function() { ' .
				   'var sendButton = jQuery("#" + ' . json_encode( $prefix ) . ' + "submit-mail"); ' . 
				   'var formStatus = jQuery("#" + ' . json_encode( $prefix ) . ' + "form-status"); ' .
				   'var statusMessage = jQuery("#" + ' . json_encode( $prefix ) . ' + "status-message"); ' .
				   'var form = jQuery("#" + ' . json_encode( $prefix ) . ' + "contact-form"); ' .
				   'var loading = jQuery("#" + ' . json_encode( $prefix ) . ' + "loading"); ' .
				   'sendButton.click(function(event) { ' .
						'event.preventDefault(); ' . 
						'jQuery.ajax({ ' .
							'url : "' . get_template_directory_uri() .  '" + "/function-includes/theme-shortcodes/contact-form-shortcode/ajax.php", ' . 
							'dataType: "json", ' .
							'type: "POST", ' .                                                                      
							'data: "name="' . ' + jQuery("#" + ' . json_encode( $prefix ) . ' + "name").val() + "\u0026email=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "email").val() + "\u0026message=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "message").val() + ' .
								   '"\u0026myemail=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "myemail").val() + "\u0026success=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "success").val() + "\u0026failure=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "failure").val() + ' .
								   '"\u0026invalid=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "invalid").val() + "\u0026incomplete=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "incomplete").val() + "\u0026subject=" + jQuery("#" + ' . json_encode( $prefix ) . ' + "subject").val(), ' .
							'beforeSend: function() { ' .
								'sendButton.disabled = true;' .						
								'loading.css("visibility", "visible");' .
							'}, ' .
							'success: function(response) { ' .
								'sendButton.disabled = false; ' .
								'loading.css("visibility", "hidden"); ' .
								'if(response.type === "success") { ' .
									'statusMessage.text(response.message); ' .
									'if(formStatus.hasClass("error")) { formStatus.removeClass("error"); } ' .		
									'formStatus.addClass("success").css("display", "block"); ' .
								'} ' .
								'else { ' .								
									'statusMessage.text(response.message); ' .		
									'if(formStatus.hasClass("success")) { formStatus.removeClass("success"); } ' .
									'formStatus.addClass("error").css("display", "block"); ' .
								'} ' .
							'} ' .
						'}); ' .
					'}); ' .
				'}); ' .
				'/* ]]> */ ' .
				'</script>';
}

add_shortcode( 'contact_form', 'onioneye_contact_form' );
?>