<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

//AJAX callbacks
add_action('wp_ajax_app_authentication_user_logout', array('TMM_Ext_Authentication', 'user_logout'));
add_action('wp_ajax_nopriv_app_authentication_user_login', array('TMM_Ext_Authentication', 'user_login'));
add_action('wp_ajax_app_authentication_user_login', array('TMM_Ext_Authentication', 'user_login'));
add_action('wp_ajax_nopriv_app_authentication_user_register', array('TMM_Ext_Authentication', 'user_register'));
add_action('wp_ajax_nopriv_tmm_auth_lostpass', array('TMM_Ext_Authentication', 'lost_password'));

class TMM_Ext_Authentication {

	public static function get_application_path() {
		return TMM_EXT_PATH . '/authentication';
	}

	public static function get_application_uri() {
		return TMM_EXT_URI . '/authentication';
	}

	public static function draw_auth_panel() {
		if(TMM::get_option('show_auth_panel', TMM_APP_CARDEALER_PREFIX) !== '0') {
			$data = array();
			return TMM::draw_free_page(self::get_application_path() . '/views/auth_panel.php', $data);
		} else {
			return '';
		}

	}

	public static function user_logout() {
		wp_logout();
	}

	public static function user_login() {
		$user_login = trim($_REQUEST['user_login']);
		$user_pass = trim($_REQUEST['user_pass']);

		if (wp_authenticate($user_login, $user_pass)) {
			$credentials['user_login'] = $user_login;
			$credentials['user_password'] = $user_pass;
			$credentials['remember'] = true;
			$user = wp_signon($credentials, false);

			if (!is_wp_error($user)) {
				ob_clean();
				echo 1;
				wp_die();
			}
		}
		
		wp_die(__('Wrong data', 'cardealer'));
	}

	public static function user_register() {
		$user_name = trim($_REQUEST['user_name']);
		$user_email = trim($_REQUEST['user_email']);

		if (!is_email($user_email)) {
			_e('Wrong email!', 'cardealer');
			exit;
		}

		$user_id = username_exists($user_name);
		if (!$user_id AND email_exists($user_email) == false) {
			$random_password = wp_generate_password();
			$user_id = wp_create_user($user_name, $random_password, $user_email);
			remove_action( 'send_email_changed_user_role', array('TMM_Cardealer_User', 'send_email_changed_user_role'), 10 );
			wp_update_user(array('ID' => $user_id, 'role' => TMM_Cardealer_User::get_default_user_role()));
			add_action( 'send_email_changed_user_role', array('TMM_Cardealer_User', 'send_email_changed_user_role'), 10, 2 );
			//*****
			if (class_exists('TMM_Ext_Mail_Subscriber')) {
				update_user_option($user_id, THEMEMAKERS_APP_MAIL_SUBSCRIBER_PREFIX . 'user_group', TMM_Ext_Mail_Subscriber::get_users_groups());
			}

			/* Send email notification */
			global $tmm_config;
			$subject = __( TMM::get_option('new_user_email_subject', TMM_APP_CARDEALER_PREFIX), 'cardealer' );
			$message = __( TMM::get_option('new_user_email', TMM_APP_CARDEALER_PREFIX), 'cardealer' );

			if (empty($subject)) {
				$subject = $tmm_config['emails']['create_user']['subject'];
			}

			if (empty($message)) {
				$message = $tmm_config['emails']['create_user']['message'];
			}

			$message = str_replace(
				array('__USER__', '__USERNAME__', '__PASSWORD__', '__SITENAME__'),
				array($user_name, $user_name, $random_password, get_bloginfo('name')),
				$message );

			TMM_Cardealer_User::send_email($user_email, $subject, $message);
			_e('Login details have been emailed to you, please check your mailbox.', 'cardealer');
			exit;
		}

		printf(__('User already exists. Please try different username or process with "Forgot your password" option. <a href="%s">Reset password</a>', 'cardealer'), wp_lostpassword_url());
		exit;
	}

	public static function lost_password() {

		$error = array();
		$message = '';

		$errors = self::retrieve_password();
		if ( !is_wp_error($errors) ) {
			$message = 'check_email';
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
			$errors->add('empty_username', esc_html__('Enter a username or e-mail address.', 'cardealer'));
		} else if ( strpos( $_POST['user_login'], '@' ) ) {
			$user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
			if ( empty( $user_data ) )
				$errors->add('invalid_email', esc_html__('There is no user registered with that email address.', 'cardealer'));
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
			$errors->add('invalidcombo', esc_html__('Invalid username or e-mail.', 'cardealer'));
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
			return new WP_Error('no_password_reset', esc_html__('Password reset is not allowed for this user', 'cardealer'));
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

		/* Send email to user */
		$message = esc_html__('Someone requested that the password be reset for the following account:', 'cardealer') . "<br><br>";
		$message .= network_home_url( '/' ) . "<br><br>";
		$message .= sprintf(esc_html__('Username: %s', 'cardealer'), $user_login) . "<br><br>";
		$message .= esc_html__('If this was a mistake, just ignore this email and nothing will happen.', 'cardealer') . "<br><br>";
		$message .= esc_html__('To reset your password, visit the following address:', 'cardealer') . "<br><br>";
		$message .= add_query_arg( array('key'=>$key, 'login'=>rawurlencode($user_login)), wp_lostpassword_url() ) . "<br>";

		if ( is_multisite() )
			$blogname = $GLOBALS['current_site']->site_name;
		else
			/*
			 * The blogname option is escaped with esc_html on the way into the database
			 * in sanitize_option we want to reverse this for the plain text arena of emails.
			 */
			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

		$title = sprintf( esc_html__('[%s] Password Reset', 'cardealer'), $blogname );

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

		if ( $message && !TMM_Cardealer_User::send_email( $user_email, wp_specialchars_decode( $title ), $message ) )
			wp_die( esc_html__('The e-mail could not be sent.', 'cardealer') . "<br />\n" . esc_html__('Possible reason: your host may have disabled the mail() function.', 'cardealer') );

		return true;
	}

	public static function check_password_reset_key($key, $login) {
		global $wpdb, $wp_hasher;

		$key = preg_replace( '/[^a-z0-9]/i', '', $key );

		if ( empty($key) || !is_string($key) ) {
			return __( 'Invalid key', 'cardealer' );
		}

		if ( empty($login) || ! is_string($login) ) {
			return __( 'Invalid login name', 'cardealer' );
		}

		$user = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->users WHERE user_login = %s", $login ) );

		if ( !empty($user) ) {
			if ( empty($wp_hasher) ) {
				require_once ABSPATH . 'wp-includes/class-phpass.php';
				$wp_hasher = new PasswordHash(8, true);
			}

			$valid = $wp_hasher->CheckPassword( $key, $user->user_activation_key );
		}

		if ( empty($user) || empty($valid) ) {
			return __( 'Invalid key', 'cardealer' );
		}

		return get_userdata($user->ID);
	}

	public static function reset_password_action() {
		$fields = array(
			'password_1',
			'password_2',
			'reset_key',
			'reset_login',
			'_wpnonce'
		);

		foreach ( $fields as $field ) {
			if ( !isset( $_POST[ $field ] ) ) {
				return;
			}
			$fields[ $field ] = $_POST[ $field ];
		}

		if ( !wp_verify_nonce( $fields['_wpnonce'], 'reset_password' ) ) {
			return;
		}

		$user = TMM_Ext_Authentication::check_password_reset_key( $fields['reset_key'], $fields['reset_login'] );
		$failed = false;

		if ( is_object($user) ) {

			if ( empty( $fields['password_1'] ) || $fields[ 'password_1' ] !== $fields[ 'password_2' ] ) {
				remove_action('tmm_notice', 10);
				add_action('tmm_notice', 'tmm_wrong_pass_notice', 10);

				function tmm_wrong_pass_notice() {
					echo '<div class="info">' . __( 'Passwords do not match.', 'cardealer' ) . '</div>';
				}
				$failed = true;
			}

			$errors = new WP_Error();

			do_action( 'validate_password_reset', $errors, $user );

			if ( !$failed ) {
				do_action( 'password_reset', $user, $fields['password_1'] );

				wp_set_password( $fields['password_1'], $user->ID );

				wp_password_change_notification( $user );

				wp_redirect( add_query_arg( 'reset', 'true', remove_query_arg( array( 'key', 'login' ) ) ) );
				exit;
			}
		}
	}

}

/**
 * Returns the url to the lost password url
 *
 * @param  string $url
 * @return string
 */
if (!function_exists('tmm_lostpassword_url')) {
	function tmm_lostpassword_url( $url = '' ) {
		$page_id = TMM::get_option('user_login_page', TMM_APP_CARDEALER_PREFIX);

		if (!$page_id) {
			return $url;
		}

		$password_reset_url = get_permalink($page_id);

		if ( $password_reset_url ) {
			return TMM_Helper::get_permalink_by_lang( $page_id, array( 'lost-password' => '' ), true );
		} else {
			return $url;
		}
	}
}

add_filter( 'lostpassword_url',  'tmm_lostpassword_url', 10, 1 );

/**
 * Add 'lost-password' to query args
 */
function tmm_add_endpoint_lost_pass() {
	add_rewrite_endpoint( 'lost-password', EP_ROOT | EP_PAGES );
}
add_action( 'init', 'tmm_add_endpoint_lost_pass' );

if ( !is_admin() ) {
	function tmm_add_query_var_lost_pass( $vars ) {
		$vars[] = 'lost-password';

		return $vars;
	}
	add_filter( 'query_vars', 'tmm_add_query_var_lost_pass', 0 );
}

if ( is_admin() ) {
	flush_rewrite_rules();
}

/**
 * Check reset password params
 */
add_action( 'wp_loaded', array( 'TMM_Ext_Authentication', 'reset_password_action' ), 20 );