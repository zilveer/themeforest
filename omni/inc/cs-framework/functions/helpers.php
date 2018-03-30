<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Add framework element
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_add_element' ) ) {
	function cs_add_element( $field = array(), $value = '', $unique = '' ) {

		$output     = '';
		$depend     = '';
		$sub        = ( isset( $field['sub'] ) ) ? 'sub-' : '';
		$unique     = ( isset( $unique ) ) ? $unique : '';
		$languages  = cs_language_defaults();
		$class      = 'CSFramework_Option_' . $field['type'];
		$wrap_class = ( isset( $field['wrap_class'] ) ) ? ' ' . $field['wrap_class'] : '';
		$hidden     = ( isset( $field['show_only_language'] ) && ( $field['show_only_language'] != $languages['current'] ) ) ? ' hidden' : '';
		$is_pseudo  = ( isset( $field['pseudo'] ) ) ? ' cs-pseudo-field' : '';

		if ( isset( $field['dependency'] ) ) {
			$hidden = ' hidden';
			$depend .= ' data-' . $sub . 'controller="' . $field['dependency'][0] . '"';
			$depend .= ' data-' . $sub . 'condition="' . $field['dependency'][1] . '"';
			$depend .= ' data-' . $sub . 'value="' . $field['dependency'][2] . '"';
		}

		$output .= '<div class="cs-element cs-field-' . $field['type'] . $is_pseudo . $wrap_class . $hidden . '"' . $depend . '>';

		if ( isset( $field['title'] ) ) {
			$field_desc = ( isset( $field['desc'] ) ) ? '<p class="cs-text-desc">' . $field['desc'] . '</p>' : '';
			$output .= '<div class="cs-title"><h4>' . $field['title'] . '</h4>' . $field_desc . '</div>';
		}

		$output .= ( isset( $field['title'] ) ) ? '<div class="cs-fieldset">' : '';

		$value = ( ! isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
		$value = ( isset( $field['value'] ) ) ? $field['value'] : $value;

		if ( class_exists( $class ) ) {
			ob_start();
			$element = new $class( $field, $value, $unique );
			$element->output();
			$output .= ob_get_clean();
		} else {
			$output .= '<p>' . __( 'This field class is not available!', 'cs-framework' ) . '</p>';
		}

		$output .= ( isset( $field['title'] ) ) ? '</div>' : '';
		$output .= '<div class="clear"></div>';
		$output .= '</div>';

		return $output;

	}
}

/**
 *
 * Encode string for backup options
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
	function cs_encode_string( $string ) {
		return rtrim( strtr( call_user_func( 'base' . '64' . '_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
	}
}

/**
 *
 * Decode string for backup options
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
	function cs_decode_string( $string ) {
		return unserialize( gzuncompress( stripslashes( call_user_func( 'base' . '64' . '_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
	}
}

/**
 *
 * Get google font from json file
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_google_fonts' ) ) {
	function cs_get_google_fonts() {

		global $cs_google_fonts;

		if ( ! empty( $cs_google_fonts ) ) {

			return $cs_google_fonts;

		} else {

			ob_start();
			cs_locate_template( 'fields/typography/google-fonts.json' );
			$json = ob_get_clean();

			$cs_google_fonts = json_decode( $json );

			return $cs_google_fonts;
		}

	}
}

/**
 *
 * Get icon fonts from json file
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_icon_fonts' ) ) {
	function cs_get_icon_fonts( $file ) {

		ob_start();
		cs_locate_template( $file );
		$json = ob_get_clean();

		return json_decode( $json );

	}
}

/**
 *
 * Array search key & value
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_array_search' ) ) {
	function cs_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] == $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, cs_array_search( $sub_array, $key, $value ) );
			}

		}

		return $results;

	}
}

/**
 *
 * Getting POST Var
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_var' ) ) {
	function cs_get_var( $var, $default = '' ) {

		if ( isset( $_POST[ $var ] ) ) {
			return $_POST[ $var ];
		}

		if ( isset( $_GET[ $var ] ) ) {
			return $_GET[ $var ];
		}

		return $default;

	}
}

/**
 *
 * Getting POST Vars
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_get_vars' ) ) {
	function cs_get_vars( $var, $depth, $default = '' ) {

		if ( isset( $_POST[ $var ][ $depth ] ) ) {
			return $_POST[ $var ][ $depth ];
		}

		if ( isset( $_GET[ $var ][ $depth ] ) ) {
			return $_GET[ $var ][ $depth ];
		}

		return $default;

	}
}

/**
 *
 * Load options fields
 *
 * @since   1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_load_option_fields' ) ) {
	function cs_load_option_fields() {

		$located_fields = array();

		foreach ( glob( CS_DIR . '/fields/*/*.php' ) as $cs_field ) {
			$located_fields[] = basename( $cs_field );
			cs_locate_template( str_replace( CS_DIR, '', $cs_field ) );
		}

		$override_name = apply_filters( 'cs_framework_override', 'cs-framework-override' );
		$override_dir  = get_template_directory() . '/' . $override_name . '/fields';

		if ( is_dir( $override_dir ) ) {

			foreach ( glob( $override_dir . '/*/*.php' ) as $override_field ) {

				if ( ! in_array( basename( $override_field ), $located_fields ) ) {

					cs_locate_template( str_replace( $override_dir, '/fields', $override_field ) );

				}

			}

		}

		do_action( 'cs_load_option_fields' );

	}
}

if ( ! function_exists( 'adjustBrightness' ) ) {
	function adjustBrightness( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( - 255, min( 255, $steps ) );

		// Format the hex color string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Get decimal values
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );

		// Adjust number of steps and keep it inside 0 to 255
		$r = max( 0, min( 255, $r + $steps ) );
		$g = max( 0, min( 255, $g + $steps ) );
		$b = max( 0, min( 255, $b + $steps ) );

		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}
}

/*********************************************************************
 *-------------Function for conversion hex colors to rgb---------------
 **********************************************************************/

if ( ! function_exists( 'crum_ultimate_hex2rgb' ) ) {
	function crum_ultimate_hex2rgb( $hex, $opacity = 1 ) {
		$hex = str_replace( "#", "", $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';

		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgba; // returns an array with the rgb values
	}
}

/**
 * Send massage in contact forms by ajax.
 *
 * @return bool
 */
function do_omni_send_message() {

	if ( isset( $_POST['name'] ) && isset( $_POST['email'] ) && isset( $_POST['message'] ) ) {

		if ( 'antispam' === $_POST['type'] && ! empty( $_POST['answer'] ) ) {

			$antispam_answer = get_option( 'contact_form_antispam_' . $_POST['id'] );

			if ( $antispam_answer === $_POST['answer'] ) {
				$name_text    = esc_html__( 'Name', 'omni' );
				$email_text   = esc_html__( 'Email Address', 'omni' );
				$comment_text = esc_html__( 'Message', 'omni' );

				$name    = $_POST['name'];
				$email   = $_POST['email'];
				$subject = isset( $_POST['subject'] ) ? $_POST['subject'] : get_bloginfo( 'name' ) . esc_html__( ' - Contact Form Message', 'omni' );
				$message = $_POST['message'];
				if ( isset( $_POST['toSendEmail'] ) && ! empty( $_POST['toSendEmail'] ) ) {
					$admin_email = $_POST['toSendEmail'];
				} else {
					$admin_email = get_option( 'admin_email' );
				}
				$send_to = $admin_email;

				$body    = "$name_text: $name \n\n $email_text: $email \n\n $comment_text: $message";
				$headers = 'From: ' . $name . ' <' . $send_to . '>' . "\r\n" . 'Reply-To: ' . $email;
				$success = wp_mail( $send_to, $subject, $body, $headers );
				if ( $success ) {
					echo json_encode( array(
						'status'  => 'success',
						'message' => esc_html__( 'Thank you! Your email was sent successfully.', 'omni' )
					) );
					die();
				}
				if ( ! $success ) {
					echo json_encode( array(
						'status'  => 'error',
						'message' => esc_html__( 'Mail sent failed', 'omni' )
					) );
					die();
				}
			} else {
				echo json_encode( array(
					'status'  => 'error',
					'message' => esc_html__( 'Please, enter correct anti spam answer', 'omni' )
				) );
				die();
			}

		} elseif ( 'captcha' === $_POST['type'] && ! empty( $_POST['captcha'] ) ) {

			if ( isset( $_SESSION['secpic'] ) && isset( $_POST['captcha'] ) && ( $_SESSION['secpic'] === strtolower( $_POST['captcha'] ) ) ) {
				$name_text    = esc_html__( 'Name', 'omni' );
				$email_text   = esc_html__( 'Email Address', 'omni' );
				$comment_text = esc_html__( 'Message', 'omni' );

				$name    = $_POST['name'];
				$email   = $_POST['email'];
				$subject = isset( $_POST['subject'] ) ? $_POST['subject'] : esc_html__( 'From contact form on your site', 'omni' );
				$message = $_POST['message'];
				if ( isset( $_POST['toSendEmail'] ) && ! empty( $_POST['toSendEmail'] ) ) {
					$admin_email = $_POST['toSendEmail'];
				} else {
					$admin_email = get_option( 'admin_email' );
				}
				$send_to = $admin_email;

				$body    = "$name_text: $name \n\n $email_text: $email \n\n $comment_text: $message";
				$headers = 'From: ' . $name . ' <' . $send_to . '>' . "\r\n" . 'Reply-To: ' . $email;
				$success = wp_mail( $send_to, $subject, $body, $headers );
				if ( $success ) {
					echo json_encode( array(
						'status'  => 'success',
						'message' => esc_html__( 'Thank you! Your email was sent successfully.', 'omni' )
					) );
					die();
				}
				if ( ! $success ) {
					echo json_encode( array(
						'status'  => 'error',
						'message' => esc_html__( 'Mail sent failed', 'omni' )
					) );
					die();
				}
			} else {
				echo json_encode( array(
					'status'  => 'error',
					'message' => esc_html__( 'Please, enter correct captcha', 'omni' )
				) );
				die();
			}

		} else {
			$name_text    = esc_html__( 'Name', 'omni' );
			$email_text   = esc_html__( 'Email Address', 'omni' );
			$comment_text = esc_html__( 'Message', 'omni' );

			$name    = $_POST['name'];
			$email   = $_POST['email'];
			$subject = isset( $_POST['subject'] ) ? $_POST['subject'] : esc_html__( 'From contact form on your site', 'omni' );
			$message = $_POST['message'];
			if ( isset( $_POST['toSendEmail'] ) && ! empty( $_POST['toSendEmail'] ) ) {
				$admin_email = $_POST['toSendEmail'];
			} else {
				$admin_email = get_option( 'admin_email' );
			}
			$send_to = $admin_email;

			$body    = "$name_text: $name \n\n $email_text: $email \n\n $comment_text: $message";
			$headers = 'From: ' . $name . ' <' . $send_to . '>' . "\r\n" . 'Reply-To: ' . $email;
			$success = wp_mail( $send_to, $subject, $body, $headers );
			if ( $success ) {
				echo json_encode( array(
					'status'  => 'success',
					'message' => esc_html__( 'Thank you! Your email was sent successfully.', 'omni' )
				) );
				die();
			}
			if ( ! $success ) {
				echo json_encode( array(
					'status'  => 'error',
					'message' => esc_html__( 'Mail sent failed', 'omni' )
				) );
				die();
			}
		}

	}
}

add_action( 'wp_ajax_omni_send_message', 'do_omni_send_message' );
add_action( 'wp_ajax_nopriv_omni_send_message', 'do_omni_send_message' );

function omni_frontend_ajax() {

	wp_localize_script( 'global-js', 'omni_ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'omni_frontend_ajax' );