<?php
/**
 * Contact Form Functions
 *
 * Process contact form via AJAX, reCAPTCHA optional
 * Contact form is shown with Contact page template
 */

/**
 * Place contacts from Theme Options into an array
 */

if ( ! function_exists( 'risen_contacts' ) ) {

	function risen_contacts() {

		$contacts_array = array();

		$contacts = trim( risen_option( 'contacts' ) );

		if ( ! empty( $contacts ) ) {

			$contacts = explode( "\n", $contacts );


			foreach( $contacts as $contact ) {

				list( $name, $email ) = explode( ',', $contact );

				$name = trim( $name );
				$email = trim( $email );

				if ( $name && $email ) {
					$contacts_array[$name] = $email;
				}

			}

		}

		return $contacts_array;

	}

}

/**
 * Output contacts as <options>
 */

if ( ! function_exists( 'risen_contact_options' ) ) {

	function risen_contact_options( $selected_contact = false, $show_email = false ) {

		$options = '';

		$contacts = risen_contacts();

		foreach( $contacts as $contact_name => $contact_email ) {
			$options .= '<option value="' . md5( $contact_email ) . '"' . ( $selected_contact == md5( $contact_email ) ? ' selected="selected"' : '' ) . '>' . esc_html( $contact_name ) . ( ! empty( $show_email ) ? ', ' . esc_html( $contact_email ) : '' ) . '</option>';
		}

		return $options;

	}

}

/**
 * Display contact form
 * Shortcode uses this
 */

if ( ! function_exists( 'risen_contact_form' ) ) {

	function risen_contact_form() {

		// load form template from contact-form.php template in theme root
		$contact_form = risen_get_template_part_contents( 'contact-form' );

		return $contact_form;

	}

}

/**
 * Process AJAX contact form submission
 */

function risen_contact_form_submit() {

	// Security - check nonce, prevent external requests
	check_ajax_referer( 'risen_contact_form_nonce', 'nonce' );

	// Process Form
	if ( ! empty( $_POST ) ) {

		// Prepare Post Values
		$fields = array( 'to', 'name', 'email', 'message' );
		$values = array();
		foreach ( $fields as $field ) {
			$values[$field] = ! empty( $_POST[$field] ) ? trim( stripslashes( $_POST[$field] ) ) : '';
		}

		// Check Values
		$errors = array();

			// To
			if ( empty( $values['to'] ) ) {
				$errors[] = __( '<b>To</b> cannot be left blank', 'risen' );
			} else if ( risen_check_injection( $values['to'] ) ) {
				$errors[] = __( '<b>To</b> is invalid', 'risen' );
			} else {

				// get "to" email based on md5
				$contacts = risen_contacts();
				foreach( $contacts as $contact_name => $contact_email ) {
					if ( $values['to'] == md5( $contact_email ) ) {
						$send_to = $contact_email;
						break;
					}
				}

				// have bad "to" address
				if ( empty( $send_to ) ) {
					$errors[] = __( '<b>To</b> is invalid', 'risen' );
				}

			}

			// Name
			if ( empty( $values['name'] ) ) {
				$errors[] = __( '<b>Name</b> cannot be left blank', 'risen' );
			} else if ( risen_check_injection( $values['name'] ) ) {
				$errors[] = __( '<b>Name</b> is invalid', 'risen' );
			}

			// E-mail
			if ( empty( $values['email'] ) ) {
				$errors[] = __( '<b>E-mail</b> cannot be left blank', 'risen' );
			} else if ( ! filter_var($values['email'], FILTER_VALIDATE_EMAIL ) || ! preg_match( '/\..+$/', $values['email'] ) || risen_check_injection( $values['email'] ) ) {
				$errors[] = __( '<b>E-mail</b> is invalid', 'risen' );
			}

			// Message
			if (empty( $values['message'] ) ) {
				$errors[] = __( '<b>Message</b> cannot be left blank', 'risen' );
			}

			// reCAPTCHA
			$recaptcha_public_key = risen_option( 'recaptcha_public_key' ); // keys provided in theme options
			$recaptcha_private_key = risen_option( 'recaptcha_private_key' );
			$recaptcha_lang = get_locale();
			if ( $recaptcha_public_key && $recaptcha_private_key ) { // reCAPTCHA is being used
				$lang = "en";
				$resp = null;
				$error = null;
				$reCaptcha = new ReCaptcha( $recaptcha_private_key );
				if ($_POST["g-recaptcha-response"]) {
				    $resp = $reCaptcha->verifyResponse(
				        $_SERVER["REMOTE_ADDR"],
				        $_POST["g-recaptcha-response"]
				    );
				}
				if ( ! ( $resp != null && $resp->success ) ) {
					$errors[] = _x( '<b>reCAPTCHA</b> is incorrect', 'recaptcha', 'risen' );
				}
			}

		// Error(s)? Compile 'em
		if ( ! empty( $errors ) ) {

			$error_list = '<ul>';

			foreach ( $errors as $error ) {
				$error_list .= '<li>' . $error . '</li>';
			}

			$error_list .= '</ul>';

		}

		// No Errors, Send
		else {

			// Send Message
			if ( ! defined( 'RISEN_DISABLE_MAIL' ) || false == RISEN_DISABLE_MAIL ) { // don't send emails when using demo child theme

				// Get "from" data from WordPress general settings
				$from_email = get_bloginfo( 'admin_email' );
				$from_name = get_bloginfo( 'blogname' ) ? get_bloginfo( 'blogname' ) : $from_email;

				$subject = sprintf( __( 'Contact form message from %s', 'risen' ), $values['name'] );

				$body    = sprintf( __( '%1$s (%2$s) sent the following message', 'risen' ), $values['name'], $values['email'] ) . "\n";
				$body    .= "-----------------------------------------------------------\n\n";
				$body    .= $values['message'];

				$headers = "From: $from_name <$from_email>\r\n";
				$headers .= "Reply-To: " . $values['name'] . " <" . $values['email'] . "> \r\n";

				wp_mail( $send_to, $subject, $body, $headers );

			}

		}

		// The response is JavaScript
		header( "Content-type: text/javascript" );

		// Message Box
		$result_msg = '';

		// Prepare error box
		if ( ! empty( $error_list ) ) {
			$result_msg .= '<div id="contact-error" class="box">';
			$result_msg .= $error_list;
			$result_msg .= '</div>';
		}

		// Prepare success box and blank the form
		else {

			$result_msg .= '<div id="contact-success" class="box">';
			$result_msg .= '	' . __( 'Your message has been sent.', 'risen' );
			$result_msg .= '</div>';

			echo "jQuery('#contact-form')[0].reset();"; // blank the form

		}

		// Show message box
		if ( ! empty( $result_msg ) ) {
			echo "jQuery('#contact-form-result').hide();";
			echo "jQuery('#contact-form-result').html('$result_msg').fadeIn();";
		}

	}

	// You! Stop right there!
	exit;

}

/**
 * Check for Injection
 * This helps prevent spam attacks
 */

if ( ! function_exists( 'risen_check_injection' ) ) {

	function risen_check_injection($s) {

		$injections = array();

		$injections[] = "\r";
		$injections[] = "\n";
		$injections[] = "bcc:";
		$injections[] = "cc:";
		$injections[] = "to:";
		$injections[] = "from:";
		$injections[] = "content-type:";
		$injections[] = "mime-version:";
		$injections[] = "multipart\/mixed";
		$injections[] = "content-transfer-encoding:";

		foreach ( $injections as $injection ) {
			if ( preg_match( "/" . $injection . "/i", $s ) ) {
				return true;
			}
		}

		return false;

	}

}
