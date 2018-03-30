<?php
/**
 *
 */
class mysiteContact{

	private static $form_id = 1;
	
	/**
	 *
	 */
	function _form_id() {
	    return self::$form_id++;
	}
	
	/**
	 *
	 */
	function contactform( $atts = null, $content = null ) {
		if( $atts == 'generator' )
			return;
		
		extract(shortcode_atts(array(
	        'email'		=> '',
			'subject'	=> '',
			'success'	=> '',
			'captcha'	=> '',
			'akismet'	=> '',
			'sidebar'	=> false
	    ), $atts));
	
		$out = '';

		$form_id = self::_form_id();
		$mysite_form_id = 'mysite_form' . $form_id;
		$url = esc_url( add_query_arg( array() ) ) . '#' . $mysite_form_id;
		$required_error = '';

		$form_inputs = array();
		$submit_button = false;
		$form_inputs['mysite_email'] = ( is_email( trim( $email ) ) ) ? trim( $email ) : get_option('admin_email');
		$form_inputs['mysite_subject'] = ( !empty( $subject ) ) ? $subject : false;
		$form_inputs['success'] = ( !empty( $success ) ) ? $success : 'mail_sent';
		$form_inputs['akismet'] = ( $akismet == 'true' ) ? true : false;
		$form_inputs['sidebar'] = ( !empty( $sidebar ) ) ? true : false;
		
		if( isset( $_POST['_mysite_form_nonajax_response']['errored_fields'] ) )
			foreach( $_POST['_mysite_form_nonajax_response']['errored_fields'] as $key => $value )
				$errored_fields[$value] = $value;
				
		if( empty( $content ) ) {
			$content = '[name label="' . __( 'Name:', MYSITE_TEXTDOMAIN ) . '" required="true"][email label="' . __( 'Email:', MYSITE_TEXTDOMAIN ) . '" required="true"][textarea label="' . __( 'Message:', MYSITE_TEXTDOMAIN ) . '" required="true"]';
			
			if( empty( $captcha ) )
				$content .= '[captcha]';
		}
			
		
		if ( preg_match_all("/\[([^\s^\]]+)\s?([^\]]*)/", $content, $matches ) ) {
			
			mysite_stripslashes();
			
			$out .= '<div id="' . $mysite_form_id . '" class="mysite_form">';
			
			$out .= '<form action="' . esc_url_raw( $url ) . '" method="post">';
			
			$out .= ( ( isset( $_POST['_mysite_form_nonajax_response'] ) ) && ( $_POST['_mysite_form_nonajax_response']['id'] == $form_id ) &&
			( !$_POST['_mysite_form_nonajax_response']['sidebar'] || empty( $_POST['_mysite_form_nonajax_response']['errored_fields'] ) ) ) ?
			$_POST['_mysite_form_nonajax_response']['messages'] : '';
			
			for( $i = 0; $i < count($matches[0]); $i++ ) {
				
				$out .= '<div class="mysite_form_row ' . $matches[1][$i] . '_row' . '">';
				
				$field_id = 'mysite_field' . $i . $form_id;
				$matches[2][$i] = shortcode_parse_atts( $matches[2][$i] );
				
				if( isset( $errored_fields ) )
					$required_error = ( !in_array( $field_id, $errored_fields ) ) ? '' : ' required_error';
				
				$required = ( $matches[1][$i] == 'captcha' ? 'captcha'
				: ( empty( $matches[2][$i]['required'] ) ? false
				: ( $matches[1][$i] == 'email' ? 'email'
				: 'true' 
				)));
				$label = ( !empty( $matches[2][$i]['label'] ) ) ? $matches[2][$i]['label'] : '&nbsp;';
				
				if( $required == 'captcha' ) {
					$num1 = rand(1,10);
					$num2 = rand(1,10);
					$label = $num1 .' + '. $num2 . ' ';
				}
				$out .= '<label for="' . $field_id . '">' . $label;
				if( ( $required ) && ( $required != 'captcha' ) ) {
					$out .= '<span class="star">*</span>';
				}
				$out .= '</label>';
				
				if( $matches[1][$i] == 'textfield' || $matches[1][$i] == 'name' || $matches[1][$i] == 'email' || $required == 'captcha' ) {
					$out .= '<input type="text" name="' . $field_id . '" id="' . $field_id . '" class="textfield' . $required_error .
					( $matches[1][$i] != 'textfield' ? ' ' . $matches[1][$i] : '' ) . '' . ( $required ? ' required' : '' ) . '" value="' .
					( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" />';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
					
					if( $required == 'captcha' ) {
						$form_inputs['fields'][$field_id]['captcha'] = $num1+$num2;
					}
				}
				
				if( $matches[1][$i] == 'textarea' ) {
					$out .= '<textarea name="' . $field_id . '" id="' . $field_id . '" class="textarea' . $required_error . ( $required ? ' required' : '' ) . '" rows="5" cols="40">' .
					( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '</textarea>';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
				}
				
				if( $matches[1][$i] == 'checkbox' ) {
					$out .= '<input type="checkbox" name="' . $field_id . '" id="' . $field_id . '" class="styled' . $required_error . ( $required ? ' required' : '' ) . '"' .
					( isset( $_POST[$field_id] ) ? ' checked="checked"' : '' ) . ' value="1" />';
					$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
				}
				
				if( $matches[1][$i] == 'radio' ) {
					if( !empty( $matches[2][$i]['value'] ) ) {
						$options = explode( ',', $matches[2][$i]['value'] );
						foreach( $options as $key => $value ) {
							$radio_id = $field_id . '_' . $key;
							$out .= '<input type="radio" name="' . $field_id . '" id="' . $radio_id . '" class="styled' . $required_error . ( $required ? ' required': '' ) . '"' .
							( !isset( $_POST[$field_id] ) ? ( $key == 0 ? ' checked="checked"' : '' ) : ( $_POST[$field_id] == $key  ? ' checked="checked"' : '' ) ) . ' value="' . $key . '" />';
							$out .= '<label for="' . $radio_id . '" class="radio_label">' . $value . '</label>';
						}
						$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'value' => $options, 'required' => $required );
					}
				}
				
				if( $matches[1][$i] == 'select' ) {
					if( !empty( $matches[2][$i]['value'] ) ) {
						$options = explode( ',', $matches[2][$i]['value'] );
						$out .= '<select name="' . $field_id . '" id="' . $field_id . '" class="styled' . $required_error . ( $required ? ' required' : '' ) . '">';
						foreach( $options as $key => $value ) {
							$out .= '<option value="' . $value . '"' .
							( !isset( $_POST[$field_id] ) ? '' : ( $_POST[$field_id] == $value ? ' selected="selected"' : '' ) ) . '>' . $value . '</option>';
						}
						$out .= '</select>';
						$form_inputs['fields'][$field_id] = array( 'type' => $matches[1][$i], 'label' => $label, 'required' => $required );
					}
				}
				
				if( $matches[1][$i] == 'submit' ) {
					$submit_button = true;
					$submit_value = ( !empty( $matches[2][$i]['value'] ) ) ? $matches[2][$i]['value'] : 'Submit';
					$out .= '<input type="submit" value="' . $submit_value . '" class="contact_form_submit fancy_button" />';
					
					$out .= '<div class="mysite_contact_feedback">';
					$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
					$out .= '</div>';
				}
				
				if( $matches[1][$i] == 'autoresponder' ) {
					$name = ( !empty( $matches[2][$i]['fromname'] ) ) ? $matches[2][$i]['fromname'] : get_bloginfo('name');
					$email = ( !empty( $matches[2][$i]['fromemail'] ) ) ? trim( $matches[2][$i]['fromemail'] ) : $form_inputs['mysite_email'];
					$subject = ( !empty( $matches[2][$i]['subject'] ) ) ? $matches[2][$i]['subject'] : false;
					$message = ( !empty( $matches[2][$i]['message'] ) ) ? $matches[2][$i]['message'] : false;
					$form_inputs['autoresponder'][] = array( 'name' => $name, 'email' => $email, 'subject' => $subject, 'message' => $message );
				}
				
				$out .= '</div>';
			}
			
			if( $captcha == 'true' ) {
				
				$field_id = "mysite_field{$i}{$form_id}";
				
				if( isset( $errored_fields ) )
					$required_error = ( !in_array( $field_id, $errored_fields ) ) ? '' : ' required_error';
				
				$out .= '<div class="mysite_form_row captcha_row">';
				
				$num1 = rand(1,10);
				$num2 = rand(1,10);
				$label = $num1 .' + '. $num2 . ' ';
					
				$out .= '<label for="' . $field_id . '">' . $label . '</label>';

				$out .= '<input type="text" name="' . $field_id . '" id="' . $field_id . '" class="textfield required' . $required_error .  '" value="' .
				( isset( $_POST[$field_id] ) ? esc_attr( $_POST[$field_id] ) : '' ) . '" />';
				$form_inputs['fields'][$field_id] = array( 'type' => 'captcha', 'label' => $label, 'required' => 'captcha' );
				
				$form_inputs['fields'][$field_id]['captcha'] = $num1+$num2;
					
				$out .= '</div>';
			}
			
			if( !$submit_button ) {
				$out .= '<div class="mysite_form_row">';
				$out .= '<input type="submit" value="' . __( 'Submit', MYSITE_TEXTDOMAIN ) . '" class="contact_form_submit fancy_button" />';
				
				$out .= '<div class="mysite_contact_feedback">';
				$out .= '<img src="' . esc_url( THEME_IMAGES_ASSETS . '/transparent.gif' ) . '" style="background-image: url(' . THEME_IMAGES_ASSETS . '/preloader.png);">';
				$out .= '</div>';
				
				$out .= '</div>';
			}
			
			$honeypot_captcha_input = array('mysite_required', 'mysite_name_required', 'mysite_email_required',  'mysite_date_required', 'mysite_zip_required' );
			$honeypot_captcha_rand = array_rand( $honeypot_captcha_input, 2 );
			
			foreach( $honeypot_captcha_rand as $key ) {
				$out .= '<div class="mysite_form_row ' . $honeypot_captcha_input[$key] . '">';
				$out .= '<input type="text" name="' . $honeypot_captcha_input[$key] . '" id="' . $honeypot_captcha_input[$key] . '" />';
				$out .= '</div>';
				$form_inputs['fields'][$honeypot_captcha_input[$key]] = array( 'required' => 'honeypot' );
			}
			
			$encode_form_inputs = mysite_encode( $form_inputs, $serialize = true );
			
			$out .= '<div class="mysite_form_row" style="display:none;">';
			$out .= '<input type="hidden" name="_mysite_form" value="' . $form_id . '">';
			$out .= '<input type="hidden" name="_mysite_form_encode" value="' . $encode_form_inputs . '">';
			$out .= '</div>';
			
			$out .= '</form>';
			$out .= '</div>';
		}
		
		if( $sidebar == false )
			return $out;
		else
			return $out;
	}
	
	/**
	 *
	 */
	function _options( $class ) {
		$shortcode = array();

		$class_methods = get_class_methods( $class );

		foreach( $class_methods as $method ) {
			if( $method[0] != '_' ) {
				$shortcode[] = call_user_func(array( &$class, $method ), $atts = 'generator' );
			}
		}

		$options = array(
			'name' => 'Contact Form',
			'value' => 'contactform',
			'custom' => 'contact'
		);

		return $options;
	}

}

?>