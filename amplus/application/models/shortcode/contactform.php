<?php

class BFIShortcodeContactFormModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'contactform'; 
    
    public function render($content = NULL, $unusedAttributeString = '') {
        bfi_wp_enqueue_script('jquery-validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.10.0/jquery.validate.min.js', array('jquery'), NULL, true);
        
        $randID = "contactform-".rand(10000,99999);
    
        // generate the additional fields
        $additionalFields = explode(',', bfi_get_option(BFI_SHORTNAME.'_contact_additional_fields'));
        $additionalFieldNames = array();
        $additionalFieldIDs = array();
        foreach ($additionalFields as $key => $field) {
            if (trim($field) == "") continue;
            $additionalFieldNames[] = trim($field);
            $additionalFieldIDs[] = 'additional_field_'.$key; 
        }
        $additionalFields = "";
        $additionalRequires = "";
        
        foreach ($additionalFieldNames as $key => $field) {
            /* 
             * compute positioning
             */
            $locationClass = "";
            // if these 2 are NOT equal and we are at the last field, make it full width
            if ((int)(count($additionalFieldNames) / 2) * 2 != count($additionalFieldNames) &&
                $key == count($additionalFieldNames) - 1) {
                $additionalFields .= "<div class='clearfix'></div>";
            // else, all fields are either left or right
            } else {
                if ($key % 2 == 0) { // left field
                    $additionalFields .= "<div class='clearfix'></div>";
                    $locationClass = "left";
                } else { // right field
                    $locationClass = "right";
                }
            }
            
            /*
             * form placeholder and labels
             */
            $required = "";
            if (preg_match('/\*$/', $field)) {
                $required = 'required="required"';
                $field = preg_replace('/\s?\*$/', ' *', $field);
            }
            $placeholder = strtolower(trim(preg_replace('#\[[^\]]+\]#', '', $field)));
            $placeholder = preg_replace('#  #', ' ', $placeholder);
            $placeholder = preg_replace('#\s?\*#', '', $placeholder);
            
            /*
             * The required messages
             */
            if ($required) {
                $additionalRequires .= ",
                    {$additionalFieldIDs[$key]}: {
        			    required: '".sprintf(__("The %s field is required.", BFI_I18NDOMAIN), $placeholder)."'
        			}
        			";
			}
			
            $placeholder = sprintf(__('Your %s', BFI_I18NDOMAIN), $placeholder);
            $fieldLabel = do_shortcode($field);
            $additionalFields .= "
                <p class='$locationClass'>
                    <label>$fieldLabel</label>
                    <input type='text' name='{$additionalFieldIDs[$key]}' class='bfi_{$additionalFieldIDs[$key]}' $required placeholder='$placeholder'/>
                </p>";
        }
        unset($additionalFieldNames);
        
        // additional field IDs for javascript
        $additionalFieldData = '';
        foreach ($additionalFieldIDs as $id) {
            $additionalFieldData .= "+'&$id='+jQuery('#$randID .bfi_$id').val()";
        }
        unset($additionalFieldIDs);
        
        // recaptcha
        $recaptcha = function_exists('bfi_recaptcha_contactform_display') ? bfi_recaptcha_contactform_display() : '';
        
        $emailSenderScript = BFILoader::getOverridableLibraryFile('includes/send-email.php', true);
        
        return "
            ".do_shortcode("[infobox type='success' class='$randID bfi_sent'   style='display: none']".__('Message sent', BFI_I18NDOMAIN)."[/infobox]")."
            <form class='contactform' id='$randID' novalidate>
                                <a name='errors' style='line-height: 0; height: 0;'></a>
                                <div class='error_container'></div>
                                ".do_shortcode("[infobox type='error' style='display: none' id='errorclone'][/infobox]")."
                                <small class='error' style='display: inline'></small>
                <input type='hidden' name='disable' value=''/>
                <p class='name'>
                    <label><i class='icon-user icon-large'></i> ".__('Name *', BFI_I18NDOMAIN)."</label>
                    <input type='name' name='name' id='name' class='bfi_name' required='required' placeholder='".__('Your name', BFI_I18NDOMAIN)."'/>
                </p>
                <p class='email'>
                    <label><i class='icon-envelope-alt icon-large'></i> ".__('Email *', BFI_I18NDOMAIN)."</label>
                    <input type='email' name='email' class='bfi_email' required='required' placeholder='".__('Your email address', BFI_I18NDOMAIN)."'/>
                </p>
                $additionalFields
                <p class='message'>
                    <label><i class='icon-comment icon-large'></i> ".__('Message *', BFI_I18NDOMAIN)."</label>
                    <textarea name='message' required='required' class='bfi_message' cols='30' rows='10' placeholder='".__('Your message', BFI_I18NDOMAIN)."' style='display:block'></textarea>
                </p>
                $recaptcha
                ".do_shortcode("[infobox type='error' class='bfi_failed' style='display: none']".__('There was an error sending your message, please try again later.', BFI_I18NDOMAIN)."[/infobox]")."
                             
                ".do_shortcode("[button class='bfi_submit' onclick='if (jQuery(&#39;#$randID&#39;).validate == undefined) { return false; } jQuery(&#39;#$randID&#39;).submit(); return false;' href='#' label='".__('Send message', BFI_I18NDOMAIN)."']")."
                ".do_shortcode("[button class='bfi_reset' onclick='jQuery(&#39;#$randID&#39;)&#91;0&#93;.reset(); return false;' href='#' bg='#aaa' label='".__('Reset', BFI_I18NDOMAIN)."']")."
                <div class='clearfix'></div>
            </form>
            <script>
jQuery(document).ready(function($){
    // somehow the name field won't update the errors. manually do it
    $('#$randID .button.bfi_submit').click(function() {
        $('#$randID input[required=\"required\"]').keyup(function() {
            $('#$randID').validate().resetForm(); $('#$randID').validate().form();
        });
    });
	$('#$randID .bfi_submit').click(function() {
		$('#$randID .bfi_sent').fadeOut();
		$('#$randID .bfi_failed').fadeOut();
	});
	$('#$randID .bfi_reset').click(function() {
		$('#$randID .bfi_sent').fadeOut();
		$('#$randID .bfi_failed').fadeOut();
	});

	var validator = $('.contactform').validate({
		rules: {
			email: {
				required: true
			},
			message: {
				required: true
			},
     	    name: {
				required: true
		    },
			recaptcha_response_field: {
				required: true
			},
		},
		messages: {
	        name: {
	            required: '".__("The name field is required.", BFI_I18NDOMAIN)."'
	        },
			recaptcha_response_field: {
				required: '".__("The captcha field is required.", BFI_I18NDOMAIN)."'
			},
			email: {
				required: '".__("The email field is required.", BFI_I18NDOMAIN)."',
				email: '".__("Please enter a valid email address.", BFI_I18NDOMAIN)."'
			},
			message: {
				required: '".__("The message field is required.", BFI_I18NDOMAIN)."'
			}
			$additionalRequires
	    },
	    errorClass: 'error icon-warning-sign',
	    errorContainer: '',
	    errorLabelContainer: '#$randID .error_container',
	    errorElement: 'div',
		errorPlacement: function(error, element) {
		},
	    invalidHandler: function(form, validator) {
            // $('html, body').animate({
            //  scrollTop: $('.error_container').offset().top - 50
            // }, 1000);
		},
		submitHandler: function(form) {
			$('#$randID .bfi_submit').attr('disabled', 'disabled');
			$('#$randID .bfi_reset').attr('disabled', 'disabled');
			$('#$randID .bfi_sent').fadeOut();
			$('#$randID .bfi_failed').fadeOut();
			data = 	'name='+jQuery('#$randID .bfi_name').val()+
					'&email='+jQuery('#$randID .bfi_email').val()+
					'&message='+jQuery('#$randID .bfi_message').val()+
					'&recaptcha_challenge_field='+jQuery('#$randID [name=\"recaptcha_challenge_field\"]').val()+
					'&recaptcha_response_field='+jQuery('#$randID [name=\"recaptcha_response_field\"]').val()
					$additionalFieldData;
			jQuery.ajax({
				type: 'POST',
				url: '$emailSenderScript',
				data: data,
				cache: false,
				success: function(html) {
					if (html == '1') { // OK
						$('#$randID').slideUp();
						$('.$randID.bfi_sent').fadeIn();
						$('html, body').animate({
							scrollTop: $('.$randID.bfi_sent').offset().top - 50
						}, 1000);
	                } else if (html == '2') { // Captcha error
	                    Recaptcha.reload();
						$('#$randID .bfi_submit').removeAttr('disabled');
						$('#$randID .bfi_reset').removeAttr('disabled');
						validator.showErrors({'recaptcha_response_field': '".__("The captcha you entered did not match.", BFI_I18NDOMAIN)."'});
						$('html, body').animate({
							scrollTop: $('.error_container').offset().top - 50
						}, 1000);
	                } else { // Sending error	
						$('#$randID .bfi_failed').fadeIn();
						$('#$randID .bfi_submit').removeAttr('disabled');
						$('#$randID .bfi_reset').removeAttr('disabled');
	                }
				}
			});
		}
	});
});
            </script>";
    }
}
