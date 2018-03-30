<?php

#-----------------------------------------------------------------
# Contact Form Shortcodes
#-----------------------------------------------------------------

// Contact shortcode function
//...............................................
function theme_contact_form($atts, $content = null) {

	// To
	if (isset($atts['to'])) $atts['to'] = trim($atts['to']);

	// Subject
	if (isset($atts['subject'])) $atts['subject'] = trim($atts['subject']);

	// Thank you message
	if (isset($atts['thankyou'])) $atts['thankyou'] = trim($atts['thankyou']);

	// Button text
	if (isset($atts['button'])) $atts['button'] = trim($atts['button']);

	// Captcha
	if (isset($atts['captcha'])) $atts['captcha'] = strtolower(trim($atts['captcha']));

	// return the form
	return make_theme_contact_form($atts); 
}

function strEnc($value) {

	// return the encrypte valueform
	return base64_encode($value); 
}

// Add shortcode
//...............................................
add_shortcode('contact_form', 'theme_contact_form' );  


#-----------------------------------------------------------------
# Contact Form Functions
#-----------------------------------------------------------------

// Create contact form
//................................................................
if ( ! function_exists( 'make_theme_contact_form' ) ) :
	
	function make_theme_contact_form($form = false) {
		global $contact_fields, $themeScripts;
		
		if (!isset($themeScripts['jquery-validate'])) {
			// add the script needed. Not ideal, but necessary until another way is found.
			echo '<script type="text/javascript" src="'.FRAMEWORK_URL.'extensions/contact-fields/js/jquery.validate.min.js"></script>';
			echo '<script type="text/javascript" src="'.FRAMEWORK_URL.'extensions/contact-fields/js/ajaxForm.js"></script>';
			$themeScripts['jquery-validate'] = true;
		}
		
		// Unique ID. Enables multiple forms on a single page.
		$id = base_convert(microtime(), 10, 36); // a random id generated for each form. 
		
		// get the main data from the database
		$contact_form_data = $contact_fields->get_defaults();
		$contact_fields_data = $contact_fields->get_fields();
		
		if ( count($contact_fields_data) <= 0 ) {
			return '<p><code>'. __('No form fields created. Go to: "Settings > Contact Form" to create fields.', 'framework') .'</code></p>';
		}
		
		// set all variables based on defaults
		$send_to = $contact_form_data['to'];
		$subject = $contact_form_data['subject'];
		$thankyou_message = $contact_form_data['thankyou'];
		$button = $contact_form_data['button'];
		$use_captcha = $contact_form_data['captcha'];
		$fields = $contact_fields_data;
		$error_messages = array();
		$hidden_to = '';
		$hidden_subject = '';
		$theFields = '';
		
		if ($form && is_array($form)) {
			// the form data array was provided, override defaults as provided
			if (isset($form['to'])) $send_to = $form['to'];
			if (isset($form['subject'])) $subject = $form['subject'];
			if (isset($form['thankyou'])) $thankyou_message = $form['thankyou'];
			if (isset($form['button'])) $button = $form['button'];
			if (isset($form['captcha'])) {
				$use_captcha = ($form['captcha'] == 'yes') ? 1 : 0;
			}
			if (isset($form['fields'])) {
				$items = explode(',', $form['fields']);
				// get each field name included and recreate the $fileds array with the data
				$new_fields = array();
				foreach ((array) $items as $item) :
					$item = sanitize_title($item);
					if (is_array($contact_fields_data[$item])) {
						$new_fields[$item] = $contact_fields_data[$item];
					}
				endforeach;
				if (!empty($new_fields)) $fields = $new_fields;
			}
		}

		// Special Fields
		// The "to" and "subject" fields may need to be included as hidden fields if their values were
		// specified in the shortcode and differ from the database defaults.
		if ($send_to != $contact_form_data['to']) {
			$hidden_to = '<input type="hidden" name="_R" value="'. strEnc($send_to) .'" />';
		}
		if ($subject != $contact_form_data['subject']) {
			$hidden_subject = '<input type="hidden" name="_S" value="'. strEnc($subject) .'" />';
		}
		
		// Image verification
		if ($use_captcha) {
			
			//session_start(); // part of including CAPTCHA
			if (!isset($_SESSION)) session_start(); // if captcha
			
			// add captcha to the fields array
			$fields['form_captcha'] = array(
				'field_type' => 'captcha', 
				'key' => 'captcha', 
				'alias' => 'captcha',
				'required' => true, 
				'error_required' => __('You must enter the verification code', 'framework'),
				'minlength' => 4,
				'maxlength' => '',
				'size' => array('width' => 150, 'height' => '')
			);
		}

		// get all the inputs and fields
		foreach ((array) $fields as $field) {

			$field_class = 'formField';
			$field_style = '';
			$labelClass = 'formTitle';
			$field['alias'] = (isset($field['alias'])) ? $field['alias'] : '';
			$field_id = $field['alias'].'_'.$id;
			$field_min = ($field['minlength']) ? 'minlength="'.$field['minlength'].'"' : '';
			$field_max = ($field['maxlength']) ? 'maxlength="'.$field['maxlength'].'"' : '';
			$values = (isset($field['values'])) ? explode(',', $field['values']) : '';
			
			// text input class
			$field_class .= ($field['field_type'] == 'text' || $field['field_type'] == 'textarea') ? ' textInput' : '';
			
			// input labels 
			$field_label = (isset($field['label'])) ? esc_attr(strip_tags($field['label'])) : '';
			// for inputs with placeholder class
			if ($field['field_type'] == 'text' || $field['field_type'] == 'textarea' || $field['field_type'] == 'captcha') {
				$labelClass .= " hidden";
			}
			
			// required field
			if ($field['required']) {
				// add required class
				$field_class .= ' required';
				// error message
				if ($field['error_required']) {
					// add custom "required" error message
					$error_messages[$field['alias']]['required'] = $field['error_required'];
				}
			}
			// validated field
			if ( isset($field['validation']) && $field['validation']) {
				// make sure field type can have validation
				if ($field['field_type'] == 'text' || $field['field_type'] == 'textarea') {
					// add validation class
					$field_class .= ' '.$field['validation'];
					// error message
					if ($field['error_validation']) {
						// add custom "required" error message
						$error_messages[$field['alias']][$field['validation']] = $field['error_validation'];
					}
				}
			}

			// width/height setting
			if (isset($field['size']['width']) && $field['size']['width']) {
				// add width
				$field_style .= ' width: '. (int)$field['size']['width'] .'px;';
			}
			if (isset($field['size']['height']) && $field['size']['height']) {
				// add height
				$field_style .= ' height: '. (int)$field['size']['height'] .'px;';
			}
			$field_style = 'style="'. trim($field_style) .'"';
			
			if ($field['field_type'] !== 'hidden') {
				// opening container element (not needed for hidden fields)
				$theFields .= '<div class="fieldContainer field_type_'.$field['field_type'].'">';
			}

			// the default label
			$defaultLabel = '<label for="'.$field_id.'" class="'.$labelClass.'">'.$field_label.'</label>';
			// the default caption
			$theCaption = (isset($field['caption'])) ? html_entity_decode(stripslashes($field['caption'])) : '';
			$defaultCaption = '<div class="formCaption">'.$theCaption.'</div>';

			switch ($field['field_type']) {
				case 'hidden':
					$theFields .= '<input type="hidden" id="'.$field_id.'" name="'.$field['alias'].'" value="'. $field['values'] .'" />';
					break;
				case 'text':
					$theFields .= $defaultLabel;
					$theFields .= '<input type="text" id="'.$field_id.'" name="'.$field['alias'].'" class="'. trim($field_class) .'" placeholder="'.$field_label.'" '.$field_style.' '.$field_min.' '.$field_max.' >';
					$theFields .= $defaultCaption;
					break;
				case 'textarea':
					$theFields .= $defaultLabel;
					$theFields .= '<textarea id="'.$field_id.'" name="'.$field['alias'].'" class="'. trim($field_class) .'" placeholder="'.$field_label.'" '.$field_style.' '.$field_min.' '.$field_max.'></textarea>';
					$theFields .= $defaultCaption;
					break;
				case 'select':
					$options = '<option value=""></option>'; // blank first option
					foreach ((array) $values as $value) :
						$options .= '<option value="'.sanitize_title($value).'">'.trim($value).'</option>';
					endforeach;
					$theFields .= $defaultLabel;
					$theFields .= '<select id="'.$field_id.'" name="'.$field['alias'].'" class="'. trim($field_class) .' selectInput" '.$field_style.'>';
					$theFields .= $options;
					$theFields .= '</select>';
					$theFields .= $defaultCaption;
					break;
				case 'radio':
					$theFields .= '<label for="'.$field_id.'" class="'.$labelClass.' radioSetTitle">'.$field_label.'</label>';
					$n = 1;
					foreach ((array) $values as $value) :
						$theFields .= '<label for="'.$field_id.'_'.$n.'" class="radioLabel">';
						$theFields .= '<input type="'.$field['field_type'].'" id="'.$field_id.'_'.$n.'" name="'.$field['alias'].'" class="'. trim($field_class) .' radioInput" value="'.sanitize_title($value).'" />';
						$theFields .= '<span>'.trim($value).'</span></label>';
						$n++;
					endforeach;
					$theFields .= $defaultCaption;
					break;
				case 'checkbox':
					$theFields .= '<label for="'.$field_id.'" class="checkboxLabel">';
 					$theFields .= '<input type="hidden" id="'.$field_id.'" name="'.$field['alias'].'" class="'. trim($field_class) .' checkboxInput" value="No" />';
 					$theFields .= '<input type="'.$field['field_type'].'" id="'.$field_id.'" name="'.$field['alias'].'" class="'. trim($field_class) .' checkboxInput" />';
					$theFields .= '<span>'.$field_label.'</span></label>';
					$theFields .= $defaultCaption;
					break;
				case 'captcha':
					$theFields .= '<img src="'. FRAMEWORK_URL .'extensions/contact-fields/inc/captcha/captcha.php?_'. base_convert(mt_rand(0x1679616, 0x39AA3FF), 10, 36) .'" id="image_'.$field_id.'" />' . 
								  '<br />';
								  
					$theFields .= '<div>';
					$theFields .= '<label for="'.$field_id.'" class="'.$labelClass.' captchaLabel">'.__('Image Verification', 'framework').'</label>';
					$theFields .= '<input type="text" id="'.$field_id.'" name="'.$field['alias'].'" class="required textInput" placeholder="'.__('Image Verification', 'framework').'" '.$field_style.' '.$field_min.' '.$field_max.' />';
					$theFields .= '<div class="formCaption">'.
								  '<a href="#" onclick="document.getElementById(\'image_'.$field_id.'\').src=\''. FRAMEWORK_URL .'extensions/contact-fields/inc/captcha/captcha.php?_\'+Math.random(); return false;" id="refresh_img_'.$field_id.'">'.
								  __('Refresh image?', 'framework') .
								  '</a></div>';
					$theFields .= '</div>';
					break;
			}

			if ($field['field_type'] !== 'hidden') {
				// closing container element (not needed for hidden fields)
				$theFields .= '</div>';
			}
		}
		
		// Create the output and return
		//................................................................
		$content = '';

		// this code initializes the JS validation for the form
		$content .= '
		<script type="text/javascript">
			jQuery(document).ready(function($) { 
				$("#form_'.$id.'").validate({ 
					submitHandler: function(form) {
						ajaxContact(form);	// form is valid, submit it
						return false;
					},
					errorElement: "em",
					errorPlacement: function(error, element) {
						error.appendTo( element.closest("div") );
					},
					highlight: function(element, errorClass, validClass) {
						$(element).addClass(errorClass).removeClass(validClass);
						$(element).closest(".fieldContainer").addClass(errorClass);
					},
					unhighlight: function(element, errorClass, validClass) {
						$(element).removeClass(errorClass).addClass(validClass);
						$(element).closest(".fieldContainer").removeClass(errorClass);
					},
					messages: {';
					$msg_cnt = 1;
					$msg_total = count($error_messages);
					foreach ($error_messages as $field => $error) :
						$content .= '"' . $field .'" : {';
						$err_cnt = 1;
						$err_total = count($error);
						foreach ($error as $type => $message) :
							$output = $type .': "'. $message .'"';
							$content .= ($err_cnt == $err_total) ? $output : $output.',';
							$err_cnt++;
						endforeach;
						$content .= ($msg_cnt == $msg_total) ? '}' : '},';
						$msg_cnt++;
					endforeach;
		$content .= '}
				});
			});
		</script>';
		
		// Start of form
		$content .= '
		<div class="contactFormWrapper" style="position:relative;">
			<div class="formMessages-top" style="position:absolute;">
				<div class="formSuccess" style="display:none;">'.html_entity_decode(stripslashes($thankyou_message)).'</div>
			</div>
			<form class="cmxform publicContactForm" id="form_'.$id.'" method="post">
				<fieldset><legend>'.__('Contact Form', 'framework').'</legend>';
			
		// Form fields
		$content .= $theFields;
			
		// End of from
		$content .= '
					<div class="contactFormBottom">
						<button type="submit" class="formSubmit">'.$button.'</button>
						<span class="sending invisible"><img src="'. FRAMEWORK_URL .'extensions/contact-fields/images/ajax-loader.gif" width="24" height="24" alt="'. __('Loading...', 'framework') .'" class="sendingImg" style="display:none;"></span>
						'. $hidden_to . $hidden_subject .'
						<input class="" type="hidden" name="mail_action" value="send" />
					</div>
				</fieldset>
			</form>
			<div class="formMessages-bottom">
				<div class="formError" style="display:none;"></div>
			</div>
		</div>';
		
		return $content;
		
		}

endif;

?>