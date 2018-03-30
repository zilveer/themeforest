<?php
/**
 * This file contains functions related to Login, Register and Forgot Password Features
 */


if ( ! function_exists( 'inspiry_is_user_restricted' ) ) :
	/**
	 * Checks if current user is restricted or not
	 *
	 * @return bool
	 */
	function inspiry_is_user_restricted() {

		global $current_user;
		get_currentuserinfo();

		// get restricted level from theme options
		$restricted_level = get_option( 'theme_restricted_level' );
		if ( ! empty( $restricted_level ) ) {
			$restricted_level = intval( $restricted_level );
		} else {
			$restricted_level = 0;
		}

		// Redirects user below a certain user level to home url
		// Ref: https://codex.wordpress.org/Roles_and_Capabilities#User_Level_to_Role_Conversion
		if ( $current_user->user_level <= $restricted_level ) {
			return true;
		}

		return false;
	}
endif;


if ( ! function_exists( 'inspiry_restrict_admin_access' ) ) :
	/**
	 * Restrict user access to admin if his level is equal or below restricted level
	 * Or request is an AJAX request or delete request from my properties page
	 */
	function inspiry_restrict_admin_access() {

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			// let it go
		} else if ( isset( $_GET[ 'action' ] ) && ( $_GET[ 'action' ] == 'delete' ) ) {
			// let it go as it is from my properties delete button
		} else {
			if ( inspiry_is_user_restricted() ) {
				wp_redirect( esc_url_raw( home_url( '/' ) ) );
				exit;
			}
		}

	}

	add_action( 'admin_init', 'inspiry_restrict_admin_access' );
endif;


if ( ! function_exists( 'inspiry_hide_admin_bar' ) ) :
	/**
	 * Hide the admin bar on front end for users with user level equal to or below restricted level
	 */
	function inspiry_hide_admin_bar() {
		if ( is_user_logged_in() ) {
			if ( inspiry_is_user_restricted() ) {
				add_filter( 'show_admin_bar', '__return_false' );
			}
		}
	}

	add_action( 'init', 'inspiry_hide_admin_bar', 9 );
endif;


if ( ! function_exists( 'inspiry_ajax_login' ) ) :
	/**
	 * AJAX login request handler
	 */
	function inspiry_ajax_login() {

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'inspiry-ajax-login-nonce', 'inspiry-secure-login' );

		// Nonce is checked, get the POST data and sign user on
		inspiry_auth_user_login( $_POST[ 'log' ], $_POST[ 'pwd' ], __( 'Login', 'framework' ) );

		die();
	}

	// Enable the user with no privileges to request ajax login
	add_action( 'wp_ajax_nopriv_inspiry_ajax_login', 'inspiry_ajax_login' );

endif;


if ( ! function_exists( 'inspiry_auth_user_login' ) ) :
	/**
	 * This function process login request and displays JSON response
	 *
	 * @param $user_login
	 * @param $password
	 * @param $login
	 */
	function inspiry_auth_user_login( $user_login, $password, $login ) {

		$info = array();
		$info[ 'user_login' ] = $user_login;
		$info[ 'user_password' ] = $password;
		$info[ 'remember' ] = true;

		$user_signon = wp_signon( $info, false );

		if ( is_wp_error( $user_signon ) ) {
			echo json_encode( array(
				'success' => false,
				'message' => __( '* Wrong username or password.', 'framework' ),
			) );
		} else {
			wp_set_current_user( $user_signon->ID );
			echo json_encode( array(
				'success' => true,
				'message' => $login . ' ' . __( 'successful. Redirecting...', 'framework' ),
				'redirect' => $_POST[ 'redirect_to' ]
			) );
		}

		die();
	}
endif;


if ( ! function_exists( 'inspiry_ajax_register' ) ) :
	/**
	 * AJAX register request handler
	 */
	function inspiry_ajax_register() {

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'inspiry-ajax-register-nonce', 'inspiry-secure-register' );

		// Nonce is checked, Get to work
		$info = array();
		$info[ 'user_nicename' ] = $info[ 'nickname' ] = $info[ 'display_name' ] = $info[ 'first_name' ] = $info[ 'user_login' ] = sanitize_user( $_POST[ 'register_username' ] );
		$info[ 'user_pass' ] = sanitize_text_field( $_POST[ 'register_pwd' ] );
		$info[ 'user_email' ] = sanitize_email( $_POST[ 'register_email' ] );

		// Register the user
		$user_register = wp_insert_user( $info );

		if ( is_wp_error( $user_register ) ) {

			$error = $user_register->get_error_codes();
			if ( in_array( 'empty_user_login', $error ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( $user_register->get_error_message( 'empty_user_login' ) )
				) );
			} elseif ( in_array( 'existing_user_login', $error ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'This username already exists.', 'framework' )
				) );
			} elseif ( in_array( 'existing_user_email', $error ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'This email is already registered.', 'framework' )
				) );
			}

		} else {
			inspiry_auth_user_login( $info[ 'user_login' ], $info[ 'user_pass' ], __( 'Registration', 'framework' ) );
		}

		die();
	}

	// Enable the user with no privileges to request ajax register
	add_action( 'wp_ajax_nopriv_inspiry_ajax_register', 'inspiry_ajax_register' );

endif;


if ( ! function_exists( 'inspiry_ajax_reset_password' ) ) :
	/**
	 * AJAX reset password request handler
	 */
	function inspiry_ajax_reset_password() {

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'inspiry-ajax-forgot-nonce', 'inspiry-secure-reset' );

		$account = $_POST[ 'reset_username_or_email' ];
		$error = "";
		$get_by = "";

		if ( empty( $account ) ) {
			$error = __( 'Provide a valid username or email address!', 'framework' );
		} else {
			if ( is_email( $account ) ) {
				if ( email_exists( $account ) ) {
					$get_by = 'email';
				} else {
					$error = __( 'No user found for given email!', 'framework' );
				}
			} elseif ( validate_username( $account ) ) {
				if ( username_exists( $account ) ) {
					$get_by = 'login';
				} else {
					$error = __( 'No user found for given username!', 'framework' );
				}
			} else {
				$error = __( 'Invalid username or email!', 'framework' );
			}
		}

		if ( empty ( $error ) ) {

			// Generate new random password
			$random_password = wp_generate_password();

			// Get user data by field ( fields are id, slug, email or login )
			$target_user = get_user_by( $get_by, $account );

			$update_user = wp_update_user( array(
				'ID' => $target_user->ID,
				'user_pass' => $random_password
			) );

			// if  update_user return true then send user an email containing the new password
			if ( $update_user ) {

				$from = get_option( 'admin_email' ); // Set whatever you want like mail@yourdomain.com

				if ( ! isset( $from ) || ! is_email( $from ) ) {
					$site_name = strtolower( $_SERVER[ 'SERVER_NAME' ] );
					if ( substr( $site_name, 0, 4 ) == 'www.' ) {
						$site_name = substr( $site_name, 4 );
					}
					$from = 'admin@' . $site_name;
				}

				$to = $target_user->user_email;
				$website_name = get_bloginfo( 'name' );
				$subject = sprintf( __( 'Your New Password For %s', 'framework' ), $website_name );
				$sender = sprintf( __( 'From: %s <%s>', 'framework' ), $website_name, $from ) . "\r\n";
				$message = sprintf( __( 'Your new password is: %s', 'framework' ), $random_password );

				// email header
				$header = 'Content-type: text/html; charset=utf-8' . "\r\n";
				$header = apply_filters( "inspiry_password_reset_header", $header );
				$header .= $sender;

				$mail = wp_mail( $to, $subject, $message, $header );

				if ( $mail ) {
					$success = __( 'Check your email for new password', 'framework' );
				} else {
					$error = __( 'Failed to send you new password email!', 'framework' );
				}

			} else {
				$error = __( 'Oops! Something went wrong while resetting your password!', 'framework' );
			}
		}

		if ( ! empty( $error ) ) {
			echo json_encode(
				array(
					'success' => false,
					'message' => $error
				)
			);
		} elseif ( ! empty( $success ) ) {
			echo json_encode(
				array(
					'success' => true,
					'message' => $success
				)
			);
		}

		die();
	}

	// Enable the user with no privileges to request ajax password reset
	add_action( 'wp_ajax_nopriv_inspiry_ajax_forgot', 'inspiry_ajax_reset_password' );

endif;

