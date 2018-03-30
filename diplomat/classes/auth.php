<?php

add_action('wp_ajax_nopriv_tmm_user_login', array('TMM_Auth', 'user_login'));
add_action('wp_ajax_tmm_user_login', array('TMM_Auth', 'user_login'));
add_action('wp_ajax_nopriv_tmm_user_register', array('TMM_Auth', 'user_register'));
add_action('wp_ajax_nopriv_tmm_user_reset_pwd', array('TMM_Auth', 'reset_pwd'));

class TMM_Auth {

	public static function user_login() {

		$user = wp_signon();

		if (is_wp_error($user)) {
			$error = $user->get_error_codes();
			//$message = ucfirst( str_replace('_', ' ', __($error[0]))) . '!';
			$message = $user->get_error_message($error[0]);
			wp_die( $message );
		}

		echo 1;
		exit();
	}

	public static function user_register() {
		$user_name = trim($_POST['user_name']);
		$user_email = trim($_POST['user_email']);
		$user_id = username_exists($user_name);
		$error = array();
		$message = '';

		if (!is_email($user_email)) {
			$error[] = esc_html__('Wrong email!', 'diplomat');
		}

		if ($user_id) {
			$error[] = esc_html__('User already exists!', 'diplomat');
		}

		if (email_exists($user_email)) {
			$error[] = esc_html__('Email already exists!', 'diplomat');
		}

		if (!$error) {
			$random_password = wp_generate_password();
			$user_id = wp_create_user($user_name, $random_password, $user_email);

			if (class_exists('TMM_Ext_Mail_Subscriber')) {
				update_user_option($user_id, THEMEMAKERS_APP_MAIL_SUBSCRIBER_PREFIX . 'user_group', TMM_Ext_Mail_Subscriber::get_users_groups());
			}

			$subject = __('Welcome to ', 'diplomat') . get_bloginfo('name', 'display');
			$content = 'Hello __USERNAME__! Your password is: __PASSWORD__';
			$content = str_replace("__USERNAME__", $user_name, $content);
			$content = str_replace("__PASSWORD__", $random_password, $content);

			TMM_Users::send_email($user_email, $subject, $content);

			$message = esc_html__('Login details have been emailed to you, please check your mailbox.', 'diplomat');
		} else {
			$error = $error[0];
		}

		echo json_encode( array('error' => $error, 'message' => $message) );
		exit;
	}

	public static function reset_pwd() {

		$error = array();
		$message = '';

		$errors = self::retrieve_password();
		if ( !is_wp_error($errors) ) {
			$message = esc_html__('Check your mailbox!', 'diplomat');
		} else {
			$error = $errors->get_error_messages();
			$error = $error[0];
		}

		echo json_encode( array('error' => $error, 'message' => $message) );
		exit();
	}

	public static function retrieve_password(){
		global $wpdb, $wp_hasher;

		$errors = new WP_Error();

		if ( empty( $_POST['user_login'] ) ) {
			$errors->add('empty_username', esc_html__('<strong>ERROR</strong>: Enter a username or e-mail address.', 'diplomat'));
		} else if ( strpos( $_POST['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
			if ( empty( $user_data ) )
				$errors->add('invalid_email', esc_html__('<strong>ERROR</strong>: There is no user registered with that email address.', 'diplomat'));
		} else {
			$login = trim($_POST['user_login']);
			$user_data = get_user_by('login', $login);
		}

		/**
		 * Fires before errors are returned from a password reset request.
		 *
		 * @since 2.1.0
		 */
		do_action( 'lostpassword_post' );

		if ( $errors->get_error_code() )
			return $errors;

		if ( !$user_data ) {
			$errors->add('invalidcombo', esc_html__('<strong>ERROR</strong>: Invalid username or e-mail.', 'diplomat'));
			return $errors;
		}

		// Redefining user_login ensures we return the right case in the email.
		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;

		/**
		 * Fires before a new password is retrieved.
		 *
		 * @since 1.5.0
		 * @deprecated 1.5.1 Misspelled. Use 'retrieve_password' hook instead.
		 *
		 * @param string $user_login The user login name.
		 */
		do_action( 'retreive_password', $user_login );

		/**
		 * Fires before a new password is retrieved.
		 *
		 * @since 1.5.1
		 *
		 * @param string $user_login The user login name.
		 */
		do_action( 'retrieve_password', $user_login );

		/**
		 * Filter whether to allow a password to be reset.
		 *
		 * @since 2.7.0
		 *
		 * @param bool true           Whether to allow the password to be reset. Default true.
		 * @param int  $user_data->ID The ID of the user attempting to reset a password.
		 */
		$allow = apply_filters( 'allow_password_reset', true, $user_data->ID );

		if ( ! $allow )
			return new WP_Error('no_password_reset', esc_html__('Password reset is not allowed for this user', 'diplomat'));
		else if ( is_wp_error($allow) )
			return $allow;

		// Generate something random for a password reset key.
		$key = wp_generate_password( 20, false );

		/**
		 * Fires when a password reset key is generated.
		 *
		 * @since 2.5.0
		 *
		 * @param string $user_login The username for the user.
		 * @param string $key        The generated password reset key.
		 */
		do_action( 'retrieve_password_key', $user_login, $key );

		// Now insert the key, hashed, into the DB.
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . WPINC . '/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );

		$message = esc_html__('Someone requested that the password be reset for the following account:', 'diplomat') . "\r\n\r\n";
		$message .= network_home_url( '/' ) . "\r\n\r\n";
		$message .= sprintf(esc_html__('Username: %s', 'diplomat'), $user_login) . "\r\n\r\n";
		$message .= esc_html__('If this was a mistake, just ignore this email and nothing will happen.', 'diplomat') . "\r\n\r\n";
		$message .= esc_html__('To reset your password, visit the following address:', 'diplomat') . "\r\n\r\n";
		$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

		if ( is_multisite() )
			$blogname = $GLOBALS['current_site']->site_name;
		else
			/*
			 * The blogname option is escaped with esc_html on the way into the database
			 * in sanitize_option we want to reverse this for the plain text arena of emails.
			 */
			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

		$title = sprintf( esc_html__('[%s] Password Reset', 'diplomat'), $blogname );

		/**
		 * Filter the subject of the password reset email.
		 *
		 * @since 2.8.0
		 *
		 * @param string $title Default email title.
		 */
		$title = apply_filters( 'retrieve_password_title', $title );

		/**
		 * Filter the message body of the password reset mail.
		 *
		 * @since 2.8.0
		 * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
		 *
		 * @param string  $message    Default mail message.
		 * @param string  $key        The activation key.
		 * @param string  $user_login The username for the user.
		 * @param WP_User $user_data  WP_User object.
		 */
		$message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );

		if ( $message && !wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) )
			wp_die( esc_html__('The e-mail could not be sent.', 'diplomat') . "<br />\n" . esc_html__('Possible reason: your host may have disabled the mail() function.', 'diplomat') );

		return true;
	}

}
