<?php
/*
* Original plugin by Autommattic, forked by truethemes to include reCAPTCHA and Site Option settings.
*/

/*
Plugin Name: Grunion Contact Form
Description: Add a contact form to any post, page or text widget.  Emails will be sent to the post's author by default, or any email address you choose.  As seen on WordPress.com.
Plugin URI: http://automattic.com/#
AUthor: Automattic, Inc.
Author URI: http://automattic.com/
Version: 2.3
License: GPLv2 or later
*/

/*
* mod by tt, redefine file path. Use back original CONSTANT
*/
define( 'GRUNION_PLUGIN_DIR', TT_EXTENDED . "/grunion-contact-form/");
define( 'GRUNION_PLUGIN_URL', get_template_directory_uri()."/framework/extended/grunion-contact-form/");


if ( is_admin() )
	require_once GRUNION_PLUGIN_DIR . '/admin.php';
	
/*
* mod by tt, require two more files.
*/
require_once GRUNION_PLUGIN_DIR . '/truethemes-recaptchalib.php'; //reCAPTCHA library mod by tt.	
require_once GRUNION_PLUGIN_DIR . '/truethemes-recaptcha-functions.php'; //reCAPTCHA functions by tt.


// take the content of a contact-form shortcode and parse it into a list of field types
function contact_form_parse( $content ) {
	// first parse all the contact-field shortcodes into an array
	global $contact_form_fields, $grunion_form;
	$contact_form_fields = array();

	if ( empty( $_REQUEST['action'] ) || $_REQUEST['action'] != 'grunion_shortcode_to_json' ) {
			wp_print_styles( 'grunion.css' );
	}
	
	$out = do_shortcode( $content );


/*
* mod by tt, the following labels of 'Email' has been changed to 'Email Address', and label 'Message' has been changed to 'Comments'
*/	
	if ( empty($contact_form_fields) || !is_array($contact_form_fields) ) {
		// default form: same as the original Grunion form
		$default_form = '
		[contact-field label="'.__('Name','tt_theme_framework').'" type="name" required="true" /]
		[contact-field label="'.__('Email Address','tt_theme_framework').'" type="email" required="true" /]
		[contact-field label="'.__('Website','tt_theme_framework').'" type="url" /]';
		if ( 'yes' == strtolower($grunion_form->show_subject) )
			$default_form .= '
			[contact-field label="'.__('Subject','tt_theme_framework').'" type="subject" /]';
		$default_form .= '
		[contact-field label="'.__('Comments','tt_theme_framework').'" type="textarea" /]';

		$out = do_shortcode( $default_form );
	}

	return $out;
}

function contact_form_render_field( $field ) {
	global $contact_form_last_id, $contact_form_errors, $contact_form_fields, $current_user, $user_identity;
	
/*
* mod by tt, get option setting for success message and required text
*/	
$contact_successmsg = stripslashes(get_option('st_contact_successmsg'));
$contact_required = stripslashes(get_option('st_contact_required'));	

	
	$r = '';
	
	$field_id = $field['id'];
	if ( isset($_POST[ $field_id ]) ) {
		$field_value = stripslashes( $_POST[ $field_id ] );
	} elseif ( is_user_logged_in() ) {
		// Special defaults for logged-in users
		if ( $field['type'] == 'email' )
			$field_value = $current_user->data->user_email;
		elseif ( $field['type'] == 'name' )
			$field_value = $user_identity;
		elseif ( $field['type'] == 'url' )
			$field_value = $current_user->data->user_url;
		else
			$field_value = $field['default'];
	} else {
		$field_value = $field['default'];
	}
	
	$field_value = wp_kses($field_value, array());

	$field['label'] = html_entity_decode( $field['label'] );
	$field['label'] = wp_kses( $field['label'], array() );


/*
* mod by tt, in the following if statements, the part that contains --- '<span>'. __("required") . '</span>' 
* has been mod to '<span>'. __($contact_required) . '</span>' ---  to reflect user enter "required" text in Site Options.
*/


	if ( $field['type'] == 'email' ) {
		$r .= "\n<div>\n";
		$r .= "\t\t<label for='".esc_attr($field_id)."' class='grunion-field-label ".esc_attr($field['type']) . ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>" . htmlspecialchars( $field['label'] ) . ( $field['required'] ? '<span>'. __($contact_required) . '</span>' : '' ) . "</label>\n";
		$r .= "\t\t<input type='text' name='".esc_attr($field_id)."' id='".esc_attr($field_id)."' value='".esc_attr($field_value)."' class='".esc_attr($field['type'])."'/>\n";
		$r .= "\t</div>\n";
	} elseif ( $field['type'] == 'textarea' ) {
		$r .= "\n<div>\n";
		$r .= "\t\t<label for='".esc_attr($field_id)."' class='".esc_attr($field['type']) . ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>" . htmlspecialchars( $field['label'] ) . ( $field['required'] ? '<span>'. __($contact_required) . '</span>' : '' ) . "</label>\n";
		$r .= "\t\t<textarea name='".esc_attr($field_id)."' id='contact-form-comment-".esc_attr($field_id)."' rows='20'>".htmlspecialchars($field_value)."</textarea>\n";
		$r .= "\t</div>\n";
	} elseif ( $field['type'] == 'radio' ) {
		$r .= "\t<div><label class='". ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>" . htmlspecialchars( $field['label'] ) . ( $field['required'] ? '<span>'. __($contact_required) . '</span>' : '' ) . "</label>\n";
		foreach ( $field['options'] as $option ) {
			$r .= "\t\t<input type='radio' name='".esc_attr($field_id)."' value='".esc_attr($option)."' class='".esc_attr($field['type'])."' ".( $option == $field_value ? "checked='checked' " : "")." />\n";
 			$r .= "\t\t<label class='".esc_attr($field['type']) . ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>". htmlspecialchars( $option ) . "</label>\n";
			$r .= "\t\t<div class='clear-form'></div>\n";
		}
		$r .= "\t\t</div>\n";
	} elseif ( $field['type'] == 'checkbox' ) {
		$r .= "\t<div>\n";
		$r .= "\t\t<input type='checkbox' name='".esc_attr($field_id)."' value='".__('Yes','tt_theme_framework')."' class='".esc_attr($field['type'])."' ".( $field_value ? "checked='checked' " : "")." />\n";
		$r .= "\t\t<label class='".esc_attr($field['type']) . ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>\n";
		$r .= "\t\t". htmlspecialchars( $field['label'] ) . ( $field['required'] ? '<span>'. __($contact_required) . '</span>' : '' ) . "</label>\n";
		$r .= "\t\t<div class='clear-form'></div>\n";
		$r .= "\t</div>\n";
	} elseif ( $field['type'] == 'select' ) {
		$r .= "\n<div>\n";
		$r .= "\t\t<label for='".esc_attr($field_id)."' class='".esc_attr($field['type']) . ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>" . htmlspecialchars( $field['label'] ) . ( $field['required'] ? '<span>'. __($contact_required) . '</span>' : '' ) . "</label>\n";
		$r .= "\t<select name='".esc_attr($field_id)."' id='".esc_attr($field_id)."' value='".esc_attr($field_value)."' class='".esc_attr($field['type'])."'/>\n";
		foreach ( $field['options'] as $option ) {
			$option = html_entity_decode( $option );
			$option = wp_kses( $option, array() );
			$r .= "\t\t<option".( $option == $field_value ? " selected='selected'" : "").">". esc_html( $option ) ."</option>\n";
		}
		$r .= "\t</select>\n";
		$r .= "\t</div>\n";
	} else {
		// default: text field
		// note that any unknown types will produce a text input, so we can use arbitrary type names to handle
		// input fields like name, email, url that require special validation or handling at POST
		$r .= "\n<div>\n";
		$r .= "\t\t<label for='".esc_attr($field_id)."' class='".esc_attr($field['type']) . ( contact_form_is_error($field_id) ? ' form-error' : '' ) . "'>" . htmlspecialchars( $field['label'] ) . ( $field['required'] ? '<span>'. __($contact_required) . '</span>' : '' ) . "</label>\n";
		$r .= "\t\t<input type='text' name='".esc_attr($field_id)."' id='".esc_attr($field_id)."' value='".esc_attr($field_value)."' class='".esc_attr($field['type'])."'/>\n";
		$r .= "\t</div>\n";
	}
	
	return $r;
}

function contact_form_validate_field( $field ) {
	global $contact_form_last_id, $contact_form_errors, $contact_form_values;

	$field_id = $field['id'];
	$field_value = isset($_POST[ $field_id ]) ? stripslashes($_POST[ $field_id ]) : '';

	# pay special attention to required email fields
	if ( $field['required'] && $field['type'] == 'email' ) {
		if ( !is_email( $field_value ) ) {
			if ( !is_wp_error( $contact_form_errors ) ) {
				$contact_form_errors = new WP_Error();
			}

			$contact_form_errors->add( $field_id, sprintf( __( '%s requires a valid email address','tt_theme_framework' ), $field['label'] ) );
		}
	} elseif ( $field['required'] && !trim($field_value) ) {
		if ( !is_wp_error($contact_form_errors) ) {
			$contact_form_errors = new WP_Error();
		}

		$contact_form_errors->add( $field_id, sprintf( __('%s is required','tt_theme_framework'), $field['label'] ) );
	}
	
	$contact_form_values[ $field_id ] = $field_value;
}

function contact_form_is_error( $field_id ) {
	global $contact_form_errors;
	
	return ( is_wp_error( $contact_form_errors ) && $contact_form_errors->get_error_message( $field_id ) );
}

// generic shortcode that handles all of the major input types
// this parses the field attributes into an array that is used by other functions for rendering, validation etc
function contact_form_field( $atts, $content, $tag ) {
	global $contact_form_fields, $contact_form_last_id, $grunion_form;
	
	$field = shortcode_atts( array(
		'label' => null,
		'type' => 'text',
		'required' => false,
		'options' => array(),
		'id' => null,
		'default' => null,
	), $atts);
	
	// special default for subject field
	if ( $field['type'] == 'subject' && is_null($field['default']) )
		$field['default'] = $grunion_form->subject;
	
	// allow required=1 or required=true
	if ( $field['required'] == '1' || strtolower($field['required']) == 'true' )
		$field['required'] = true;
	else
		$field['required'] = false;
		
	// parse out comma-separated options list
	if ( !empty($field['options']) && is_string($field['options']) )
		$field['options'] = array_map('trim', explode(',', $field['options']));

	// make a unique field ID based on the label, with an incrementing number if needed to avoid clashes
	$id = $field['id'];
	if ( empty($id) ) {
		$id = sanitize_title_with_dashes( $contact_form_last_id . '-' . $field['label'] );
		$i = 0;
		while ( isset( $contact_form_fields[ $id ] ) ) {
			$i++;
			$id = sanitize_title_with_dashes( $contact_form_last_id . '-' . $field['label'] . '-' . $i );
		}
		$field['id'] = $id;
	}
	
	$contact_form_fields[ $id ] = $field;
	
	if ( $_POST )
		contact_form_validate_field( $field );
	
	return contact_form_render_field( $field );
}

add_shortcode('contact-field', 'contact_form_field');


function contact_form_shortcode( $atts, $content ) {
	global $post;

	$default_to = get_option( 'admin_email' );
	$default_subject = "[" . get_option( 'blogname' ) . "]";

	if ( !empty( $atts['widget'] ) && $atts['widget'] ) {
		$default_subject .=  " Sidebar";
	} elseif ( $post->ID ) {
		$default_subject .= " ". wp_kses( $post->post_title, array() );
		$post_author = get_userdata( $post->post_author );
		$default_to = $post_author->user_email;
	}

	extract( shortcode_atts( array(
		'to' => $default_to,
		'subject' => $default_subject,
		'show_subject' => 'no', // only used in back-compat mode
		'widget' => 0 //This is not exposed to the user. Works with contact_form_widget_atts
	), $atts ) );

	 $widget = esc_attr( $widget );

	if ( ( function_exists( 'faux_faux' ) && faux_faux() ) || is_feed() )
		return '[contact-form]';

	global $wp_query, $grunion_form, $contact_form_errors, $contact_form_values, $user_identity, $contact_form_last_id, $contact_form_message;
	
	// used to store attributes, configuration etc for access by contact-field shortcodes
	$grunion_form = new stdClass();
	$grunion_form->to = $to;
	$grunion_form->subject = $subject;
	$grunion_form->show_subject = $show_subject;

	if ( $widget )
		$id = 'widget-' . $widget;
	elseif ( is_singular() )
		$id = $wp_query->get_queried_object_id();
	else
		$id = $GLOBALS['post']->ID;
	if ( !$id ) // something terrible has happened
		return '[contact-form]';

	if ( $id == $contact_form_last_id )
		return;
	else
		$contact_form_last_id = $id;

	ob_start();
		wp_nonce_field( 'contact-form_' . $id );
		$nonce = ob_get_contents();
	ob_end_clean();


	$body = contact_form_parse( $content );

	$r = "<div id='contact-form-$id'>\n";

/****mod by tt, comment out original errors message
	
	$errors = array();
	if ( is_wp_error( $contact_form_errors ) && $errors = (array) $contact_form_errors->get_error_codes() ) {
		$r .= "<div class='form-error'>\n<h3>" . __( 'Error!' ) . "</h3>\n<ul class='form-errors'>\n";
		foreach ( $contact_form_errors->get_error_messages() as $message )
			$r .= "\t<li class='form-error-message' style='color: red;'>$message</li>\n";
		$r .= "</ul>\n</div>\n\n";
	}

***/

/*
* mod by tt, add in our version of errors message
*/

	$errors = array();
	if ( is_wp_error( $contact_form_errors ) && $errors = (array) $contact_form_errors->get_error_codes() ) {
		$r .= "<div class=\"tt-notification error closeable\"><p style=\"font-size:12px;\">\n";
		foreach ( $contact_form_errors->get_error_messages() as $message )
			$r .= "\t- $message<br />";
		$r .= "</p>";
		$r .= "\n</div>\n\n";
		
	}
/**end of error message mod by tt**/


/****mod by tt, comment out original contact form
	
	$r .= "<form action='#contact-form-$id' method='post' class='contact-form commentsblock'>\n";
	$r .= $body;
	$r .= "\t<p class='contact-submit'>\n";
	$r .= "\t\t<input type='submit' value='" . __( "Submit &#187;" ) . "' class='pushbutton-wide'/>\n";
	$r .= "\t\t$nonce\n";
	$r .= "\t\t<input type='hidden' name='contact-form-id' value='$id' />\n";
	$r .= "\t</p>\n";
	$r .= "</form>\n</div>";

***/


/*
*mod by tt, add in our version of contact form with recaptcha via helper function tt_get_recaptcha_form()
*/
	$r .= tt_get_recaptcha_form($id,$body,$nonce);
	
/**end of contact form mod by tt**/

	
	// form wasn't submitted, just a GET
	if ( empty($_POST) )
		return $r;


/*
*mod by tt, add in reCAPTCHA verify, it will reprint contact form if recaptcha verification fails.
*/
		
    //check recaptcha
	require_once GRUNION_PLUGIN_DIR . '/truethemes-recaptchalib.php';
	$captcha_public = get_option('st_publickey');
	$captcha_private = get_option('st_privatekey');//get recaptcha private key from options panel
	if(!empty($captcha_private)&&!empty($captcha_public)){
	$resp = tt_recaptcha_check_answer ($captcha_private,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]); //verify captcha entered with server.
     
	     //if invalid we return error                           
 	    if (!$resp->is_valid) {
	        global $contact_form_errors;
			$new_contact_form_errors = new WP_Error();
			
			//if there is existing error, we clone it.
			if($contact_form_errors){
			$new_contact_form_errors = clone $contact_form_errors;
			}

			$new_contact_form_errors->add("$id-recaptcha", sprintf( __('Invalid CAPTCHA','tt_theme_framework'), '' ) );
			
			//echo '<pre>'; print_r($new_contact_form_errors); echo '</pre>';			
			
			$r = "<div id='contact-form-$id'>\n";
	
			$errors = array();
			if ( is_wp_error( $new_contact_form_errors ) && $errors = (array) $new_contact_form_errors->get_error_codes() ) {
			$r .= "<div class=\"tt-notification error closeable\"><p style=\"font-size:12px;\">\n";
				foreach ( $new_contact_form_errors->get_error_messages() as $message ){
				$r .= "\t - $message<br />";
				}//end foreach
			$r .= "\n</div>\n\n";			
			}//end if(is_wp_error
	    

	    $r .= tt_get_recaptcha_form($id,$body,$nonce);
	    return $r;
	    
	    }

	}//end if($captcha_private)
	
/**end of recaptcha verify mod by tt**/


	if ( is_wp_error($contact_form_errors) )
		return $r;

	
	$emails = str_replace( ' ', '', $to );
	$emails = explode( ',', $emails );
	foreach ( (array) $emails as $email ) {
		if ( is_email( $email ) && ( !function_exists( 'is_email_address_unsafe' ) || !is_email_address_unsafe( $email ) ) )
			$valid_emails[] = $email;
	}

	$to = ( $valid_emails ) ? $valid_emails : $default_to;

	$message_sent = contact_form_send_message( $to, $subject, $widget );

	if ( is_array( $contact_form_values ) )
		extract( $contact_form_values );

	if ( !isset( $comment_content ) )
		$comment_content = '';
	else
		$comment_content = wp_kses( $comment_content, array() );


	$r = "<div id='contact-form-$id'>\n";

/**** mod by tt, comment out existing error and success message
	$errors = array();
	if ( is_wp_error( $contact_form_errors ) && $errors = (array) $contact_form_errors->get_error_codes() ) :
		$r .= "<div class='form-error'>\n<h3>" . __( 'Error!' ) . "</h3>\n<p>\n";
		foreach ( $contact_form_errors->get_error_messages() as $message )
			$r .= "\t$message<br />\n";
		$r .= "</p>\n</div>\n\n";
	else :
		$r .= "<h3>" . __( 'Message Sent' ) . "</h3>\n\n";
		$r .= wp_kses($contact_form_message, array('br' => array(), 'blockquote' => array())) . "</div>";
****/


/**mod by tt, add in our error and success message**/

	$errors = array();
	if ( is_wp_error( $contact_form_errors ) && $errors = (array) $contact_form_errors->get_error_codes() ) :
		$r .= "<div class=\"tt-notification error closeable\"><p style=\"font-size:12px;\">\n";
		foreach ( $contact_form_errors->get_error_messages() as $message )
			$r .= "\t- $message<br />";
		$r .= "</p>";
		$r .= "\n</div>\n\n";
	else :
		$r .= "</div>";
		$contact_successmsg = stripslashes(get_option('st_contact_successmsg'));
$contact_required = stripslashes(get_option('st_contact_required'));
		
		echo '<div class="tt-notification success closeable"><p style="font-size:12px;">'.$contact_successmsg.'</p></div>';

/**end mod **/		

		
		// Reset for multiple contact forms. Hacky
		$contact_form_values['comment_content'] = '';

		return $r;
	endif;

	return $r;
}
add_shortcode( 'contact-form', 'contact_form_shortcode' );

function contact_form_send_message( $to, $subject, $widget ) {
	global $post;
	
 	if ( !isset( $_POST['contact-form-id'] ) )
		return;
		
	if ( ( $widget && 'widget-' . $widget != $_POST['contact-form-id'] ) || ( !$widget && $post->ID != $_POST['contact-form-id'] ) )
		return;

	if ( $widget )
		check_admin_referer( 'contact-form_widget-' . $widget );
	else
		check_admin_referer( 'contact-form_' . $post->ID );

	global $contact_form_values, $contact_form_errors, $current_user, $user_identity;
	global $contact_form_fields, $contact_form_message;
	
	// compact the fields and values into an array of Label => Value pairs
	// also find values for comment_author_email and other significant fields
	$all_values = $extra_values = array();
	
	foreach ( $contact_form_fields as $id => $field ) {
		if ( $field['type'] == 'email' && !isset( $comment_author_email ) ) {
			$comment_author_email = $contact_form_values[ $id ];
			$comment_author_email_label = $field['label'];
		} elseif  ( $field['type'] == 'name' && !isset( $comment_author ) ) {
			$comment_author = $contact_form_values[ $id ];
			$comment_author_label = $field['label'];
		} elseif ( $field['type'] == 'url' && !isset( $comment_author_url ) ) {
			$comment_author_url = $contact_form_values[ $id ];
			$comment_author_url_label = $field['label'];
		} elseif ( $field['type'] == 'textarea' && !isset( $comment_content ) ) {
			$comment_content = $contact_form_values[ $id ];
			$comment_content_label = $field['label'];
		} else {
			$extra_values[ $field['label'] ] = $contact_form_values[ $id ];
		}
		
		$all_values[ $field['label'] ] = $contact_form_values[ $id ];
	}

/*
	$contact_form_values = array();
	$contact_form_errors = new WP_Error();

	list($comment_author, $comment_author_email, $comment_author_url) = is_user_logged_in() ?
		add_magic_quotes( array( $user_identity, $current_user->data->user_email, $current_user->data->user_url ) ) :
		array( $_POST['comment_author'], $_POST['comment_author_email'], $_POST['comment_author_url'] );
*/

	$comment_author = stripslashes( apply_filters( 'pre_comment_author_name', $comment_author ) );

	$comment_author_email = stripslashes( apply_filters( 'pre_comment_author_email', $comment_author_email ) );

	$comment_author_url = stripslashes( apply_filters( 'pre_comment_author_url', $comment_author_url ) );
	if ( 'http://' == $comment_author_url )
		$comment_author_url = '';

	$comment_content = stripslashes( $comment_content );
	$comment_content = trim( wp_kses( $comment_content, array() ) );

	if ( empty( $contact_form_subject ) )
		$contact_form_subject = $subject;
	else
		$contact_form_subject = trim( wp_kses( $contact_form_subject, array() ) );
		
	$comment_author_IP = $_SERVER['REMOTE_ADDR'];

	$vars = array( 'comment_author', 'comment_author_email', 'comment_author_url', 'contact_form_subject', 'comment_author_IP' );
	foreach ( $vars as $var )
		$$var = str_replace( array("\n", "\r" ), '', $$var ); // I don't know if it's possible to inject this
	$vars[] = 'comment_content';

	$contact_form_values = compact( $vars );

	$spam = '';
	$akismet_values = contact_form_prepare_for_akismet( $contact_form_values );
	$is_spam = apply_filters( 'contact_form_is_spam', $akismet_values );
	if ( is_wp_error( $is_spam ) )
		return; // abort
	else if ( $is_spam === TRUE )
		$spam = '***SPAM*** ';

	if ( !$comment_author )
		$comment_author = $comment_author_email;
		
	$headers = 'From: ' . wp_kses( $comment_author, array() ) .
		' <' . wp_kses( $comment_author_email, array() ) . ">\r\n" .
		'Reply-To: ' . wp_kses( $comment_author_email, array() ) . "\r\n" .
		"Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\""; 
	$subject = apply_filters( 'contact_form_subject', $spam . $contact_form_subject );
	$subject = wp_kses( $subject, array() );

	$time = date_i18n( __('l F j, Y \a\t g:i a','tt_theme_framework'), current_time( 'timestamp' ) );


/** mod by tt, comment out original comment message setup 
	
	$extra_content = '';
	
	foreach ( $extra_values as $label => $value ) {
		$extra_content .= $label . ': ' . trim($value) . "\n";
		$extra_content_br .= wp_kses( $label, array() ) . ': ' . wp_kses( trim($value), array() ) . "<br />";
	}

	$message = $comment_author_label . ": " . $comment_author . "
" . $comment_author_email_label . ": " . $comment_author_email . "
" . $comment_author_url_label . ": " . $comment_author_url . "
" . $comment_content_label . ": " . $comment_content . "
$extra_content

" . __( "Time:" ) . " " . $time . "
" . __( "IP Address:" ) . " " . $comment_author_IP . "
" . __( "Contact Form URL:" ) . " " . get_permalink( $post->ID ) . "

";

***/


/*
*mod by tt,  construct message from posted form data!
*/

/**
Important Notes!
For the default fields, name, email, url and comment, there is no auto sequencing, you will need to rearrange the below message output sequence, by rearranging the codes!
For extra user added fields, the plugin had saved the sequance in an array and assigned to $extra_values.
I would not know how to made all auto sequencing!
**/   
    
    //added by denzel

    
    $message = null;
    
    //name, this is default content
    if(!empty($comment_author)){ //check whether got name enter.
    $message .= "$comment_author_label : $comment_author <br/>\n\n";   
    }
    
    //email, this is default content	
	if(!empty($comment_author_email)){ //check whether got email address enter.
    $message .= "$comment_author_email_label : $comment_author_email <br/>\n\n";   
    }
    
    //url, this is default content
    if(!empty($comment_author_url)){ //check whether got url enter.
    $message .= "$comment_author_url_label : $comment_author_url <br/>\n\n";   
    }
        
    //extra fields added by user;
    
    $extra_content = null;
	
	foreach ( $extra_values as $label => $value ) {
	    if(!empty($value)){
		$extra_content .= $label . ': ' . trim($value) . "<br/>\n\n";
		}
	}    
    
    if(!empty($extra_content)){
    $message .= $extra_content;   
    }
    
    //comment, this is default content
    if(!empty($comment_content)){ //check whether got comment content enter.
    $message .= "$comment_content_label : $comment_content <br/>\n\n\n";   
    }
        
    $message.= "Message was sent on"." ".$time."\n";			
	
/**end of email form message! ended by denzel **/
	

	// Construct message that is returned to user
	$contact_form_message = "<blockquote>";
	if (isset($comment_author_label))
		$contact_form_message .= wp_kses( $comment_author_label, array() ) . ": " . wp_kses( $comment_author, array() ) . "<br />";
    if (isset($comment_author_email_label))
		$contact_form_message .= wp_kses( $comment_author_email_label, array() ) . ": " . wp_kses( $comment_author_email, array() ) . "<br />"; 
    if (isset($comment_author_url_label))
		$contact_form_message .= wp_kses( $comment_author_url_label, array() ) . ": " . wp_kses( $comment_author_url, array() ) . "<br />";
	if (isset($comment_content_label))
		$contact_form_message .= wp_kses( $comment_content_label, array() ) . ": " . wp_kses( $comment_content, array() ) . "<br />";
	if (isset($extra_content_br))
		$contact_form_message .= $extra_content_br;
	$contact_form_message .= "</blockquote><br /><br />";


/*** mod by tt, comment out adding of verified user to message.

	if ( is_user_logged_in() ) {
		$message .= sprintf(
			__( "\nSent by a verified %s user." ),
			isset( $GLOBALS['current_site']->site_name ) && $GLOBALS['current_site']->site_name ? $GLOBALS['current_site']->site_name : '"' . get_option( 'blogname' ) . '"'
		);
	} else {
		$message .= __( "Sent by an unverified visitor to your site." );
	}

***/

	$message = apply_filters( 'contact_form_message', $message );
	$message = wp_kses( $message, array() );

	$to = apply_filters( 'contact_form_to', $to );

	foreach ( (array) $to as $to_key => $to_value ) {
		$to[$to_key] = wp_kses( $to_value, array() );
	}

	// keep a copy of the feedback as a custom post type
	$feedback_mysql_time = current_time( 'mysql' );
	$feedback_title = "{$comment_author} - {$feedback_mysql_time}";
	$feedback_status = 'publish';
	if ( $is_spam === TRUE )
		$feedback_status = 'spam';

	foreach ( (array) $akismet_values as $av_key => $av_value ) {
		$akismet_values[$av_key] = wp_kses( $av_value, array() );
	}

	foreach ( (array) $all_values as $all_key => $all_value ) {
		$all_values[$all_key] = wp_kses( $all_value, array() );
	}

	foreach ( (array) $extra_values as $ev_key => $ev_value ) {
		$ev_values[$ev_key] = wp_kses( $ev_value, array() );
	}

	# We need to make sure that the post author is always zero for contact
	# form submissions.  This prevents export/import from trying to create
	# new users based on form submissions from people who were logged in
	# at the time.
	#
	# Unfortunately wp_insert_post() tries very hard to make sure the post
	# author gets the currently logged in user id.  That is how we ended up
	# with this work around.
	global $do_grunion_insert;
	$do_grunion_insert = TRUE;
	add_filter( 'wp_insert_post_data', 'grunion_insert_filter', 10, 2 );

	$post_id = wp_insert_post( array(
		'post_date'		=> $feedback_mysql_time,
		'post_type'		=> 'feedback',
		'post_status'	=> $feedback_status,
		'post_parent'	=> $post->ID,
		'post_title'	=> wp_kses( $feedback_title, array() ),
		'post_content'	=> wp_kses($comment_content . "\n<!--more-->\n" . "AUTHOR: {$comment_author}\nAUTHOR EMAIL: {$comment_author_email}\nAUTHOR URL: {$comment_author_url}\nSUBJECT: {$contact_form_subject}\nIP: {$comment_author_IP}\n" . print_r( $all_values, TRUE ), array()), // so that search will pick up this data
		'post_name'		=> md5( $feedback_title )
	) );

	# once insert has finished we don't need this filter any more
	remove_filter( 'wp_insert_post_data', 'grunion_insert_filter' );
	$do_grunion_insert = FALSE;

	update_post_meta( $post_id, '_feedback_author', wp_kses( $comment_author, array() ) );
	update_post_meta( $post_id, '_feedback_author_email', wp_kses( $comment_author_email, array() ) );
	update_post_meta( $post_id, '_feedback_author_url', wp_kses( $comment_author_url, array() ) );
	update_post_meta( $post_id, '_feedback_subject', wp_kses( $contact_form_subject, array() ) );
	update_post_meta( $post_id, '_feedback_ip', wp_kses( $comment_author_IP, array() ) );
	update_post_meta( $post_id, '_feedback_contact_form_url', wp_kses( get_permalink( $post->ID ), array() ) );
	update_post_meta( $post_id, '_feedback_all_fields', $all_values );
	update_post_meta( $post_id, '_feedback_extra_fields', $extra_values );
	update_post_meta( $post_id, '_feedback_akismet_values', $akismet_values );
	update_post_meta( $post_id, '_feedback_email', array( 'to' => $to, 'subject' => $subject, 'message' => $message, 'headers' => $headers ) );

	do_action( 'grunion_pre_message_sent', $post_id, $all_values, $extra_values );

	if ( $is_spam !== TRUE )
		return wp_mail( $to, $subject, $message, $headers );
	elseif ( apply_filters( 'grunion_still_email_spam', FALSE ) == TRUE )
		return wp_mail( $to, $subject, $message, $headers );

	return true;
}

// populate an array with all values necessary to submit a NEW comment to Akismet
// note that this includes the current user_ip etc, so this should only be called when accepting a new item via $_POST
function contact_form_prepare_for_akismet( $form ) {

	$form['comment_type'] = 'contact_form';
	$form['user_ip']      = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
	$form['user_agent']   = $_SERVER['HTTP_USER_AGENT'];
	$form['referrer']     = $_SERVER['HTTP_REFERER'];
	//$form['blog']         = get_option( 'home' ); deprecated function, use home_url()
	$form['blog']         = home_url();

	$ignore = array( 'HTTP_COOKIE' );

	foreach ( $_SERVER as $k => $value )
		if ( !in_array( $k, $ignore ) && is_string( $value ) )
			$form["$k"] = $value;
			
	return $form;
}

// submit an array to Akismet. If you're accepting a new item via $_POST, run it through contact_form_prepare_for_akismet() first
function contact_form_is_spam_akismet( $form ) {
	if ( !function_exists( 'akismet_http_post' ) )
		return false;
		
	global $akismet_api_host, $akismet_api_port;

	$query_string = '';
	foreach ( array_keys( $form ) as $k )
		$query_string .= $k . '=' . urlencode( $form[$k] ) . '&';

	$response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port );
	$result = false;
	if ( 'true' == trim( $response[1] ) ) // 'true' is spam
		$result = true;
	return apply_filters( 'contact_form_is_spam_akismet', $result, $form );
}

// submit a comment as either spam or ham
// $as should be a string (either 'spam' or 'ham'), $form should be the comment array
function contact_form_akismet_submit( $as, $form ) {
	global $akismet_api_host, $akismet_api_port;
	
	if ( !in_array( $as, array( 'ham', 'spam' ) ) )
		return false;

	$query_string = '';
	foreach ( array_keys( $form ) as $k )
		$query_string .= $k . '=' . urlencode( $form[$k] ) . '&';

	$response = akismet_http_post( $query_string, $akismet_api_host, '/1.1/submit-'.$as, $akismet_api_port );
	return trim( $response[1] );
}

function contact_form_widget_atts( $text ) {
	static $widget = 0;
	
	$widget++;

	return str_replace( '[contact-form', '[contact-form widget="' . $widget . '"', $text );
}
add_filter( 'widget_text', 'contact_form_widget_atts', 0 );

function contact_form_widget_shortcode_hack( $text ) {
	$old = $GLOBALS['shortcode_tags'];
	remove_all_shortcodes();
	add_shortcode( 'contact-form', 'contact_form_shortcode' );
	$text = do_shortcode( $text );
	$GLOBALS['shortcode_tags'] = $old;
	return $text;
}

function contact_form_init() {
	if ( function_exists( 'akismet_http_post' ) ) {
		add_filter( 'contact_form_is_spam', 'contact_form_is_spam_akismet', 10 );
		add_action( 'contact_form_akismet', 'contact_form_akismet_submit', 10, 2 );
	}
	if ( !has_filter( 'widget_text', 'do_shortcode' ) )
		add_filter( 'widget_text', 'contact_form_widget_shortcode_hack', 5 );

	// custom post type we'll use to keep copies of the feedback items
	register_post_type( 'feedback', array(
		'labels'	=> array(
			'name'			=> __( 'Messages','tt_theme_framework' ),
			'singular_name'	=> __( 'Message','tt_theme_framework' ),
			'search_items'	=> __( 'Search Message','tt_theme_framework' ),
			'not_found'		=> __( 'No message found','tt_theme_framework' ),
			'not_found_in_trash'	=> __( 'No message found','tt_theme_framework' )
		),
		//'menu_icon'		=> GRUNION_PLUGIN_URL . '/images/grunion-menu.png',
		'show_ui'		=> TRUE,
		'public'		=> FALSE,
		'rewrite'		=> FALSE,
		'query_var'		=> FALSE,
		'capability_type'	=> 'page'
	) );

	register_post_status( 'spam', array(
		'label'			=> 'Spam',
		'public'		=> FALSE,
		'exclude_from_search'	=> TRUE,
		'show_in_admin_all_list'=> FALSE,
		'label_count' => _n_noop( 'Spam <span class="count">(%s)</span>', 'Spam <span class="count">(%s)</span>' ),
		'protected'		=> TRUE,
		'_builtin'		=> FALSE
	) );
	
	/* Can be dequeued by placing the following in wp-content/themes/yourtheme/functions.php
	 *
	 * 	function remove_grunion_style() {
	 *		wp_deregister_style('grunion.css');
	 *	}
	 *	add_action('wp_print_styles', 'remove_grunion_style');
	 */
	
	// wp_register_style('grunion.css', GRUNION_PLUGIN_URL . 'css/grunion.css');
}
add_action( 'init', 'contact_form_init' );

/**
 * Add a contact form button to the post composition screen
 */
add_action( 'media_buttons', 'grunion_media_button', 999 );
function grunion_media_button( ) {
	global $post_ID, $temp_ID;
	$iframe_post_id = (int) (0 == $post_ID ? $temp_ID : $post_ID);
	$title = esc_attr( __( 'Add a custom form','tt_theme_framework' ) );
	$plugin_url = esc_url( GRUNION_PLUGIN_URL );
	$site_url = admin_url( "/admin-ajax.php?post_id=$iframe_post_id&amp;grunion=form-builder&amp;action=grunion_form_builder&amp;TB_iframe=true&amp;width=768" );

	//echo '<a href="' . $site_url . '&id=add_form" class="thickbox button" title="' . $title . '" style="padding-left:6px;">
	//<span class="wp-media-buttons-icon" style="background:url('.$plugin_url . '/images/grunion-form.png) 0 0 no-repeat;"></span>Add Form</a>';
	
	echo '<a href="' . $site_url . '&id=add_form" class="tt-add-form thickbox button" title="' . $title . '"><span class="wp-media-buttons-icon"></span>Add Form</a>';
}


if ( !empty( $_GET['grunion'] ) && $_GET['grunion'] == 'form-builder' ) {
	add_action( 'parse_request', 'parse_wp_request' );
	add_action( 'wp_ajax_grunion_form_builder', 'parse_wp_request' );
}

function parse_wp_request( $wp ) {
	display_form_view( );
	exit;
}

function display_form_view( ) {
	require_once GRUNION_PLUGIN_DIR . 'grunion-form-view.php';
}

/* function menu_alter() {
    echo '
	<style>
	#menu-posts-feedback .wp-menu-image img { display: none; }
	#adminmenu .menu-icon-feedback:hover div.wp-menu-image, #adminmenu .menu-icon-feedback.wp-has-current-submenu div.wp-menu-image, #adminmenu .menu-icon-feedback.current div.wp-menu-image { background: url("' .GRUNION_PLUGIN_URL . 'images/grunion-menu-hover.png") no-repeat 6px 7px !important; }
	#adminmenu .menu-icon-feedback div.wp-menu-image, #adminmenu .menu-icon-feedback div.wp-menu-image, #adminmenu .menu-icon-feedback div.wp-menu-image { background: url("' . GRUNION_PLUGIN_URL . 'images/grunion-menu.png") no-repeat 6px 7px !important; }
	</style>';
}

add_action('admin_head', 'menu_alter'); */

function grunion_insert_filter( $data, $postarr ) {
	global $do_grunion_insert;

	if ( $do_grunion_insert === TRUE ) {
		if ( $data['post_type'] == 'feedback' ) {
			if ( $postarr['post_type'] == 'feedback' ) {
				$data['post_author'] = 0;
			}
		}
	}

	return $data;
}