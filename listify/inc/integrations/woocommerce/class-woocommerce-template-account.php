<?php
/**
 * WooCommerce "My Account" page.
 *
 * @since 1.5.0
 */
class Listify_WooCommerce_Template_Account {

	/**
	 * Hook in to WordPress
	 *
	 * @since unknown
	 * @return void
	 */
	public static function setup_actions() {
		// remove account navigation
		remove_action( 'woocommerce_account_navigation', 'woocommerce_account_navigation' );

		// add the account avatar
		add_action( 'woocommerce_account_navigation', array( __CLASS__, 'add_avatar_to_dashboard' ), 99 );

		// adjust form-login.php Login title
		add_action( 'woocommerce_before_customer_login_form', array( __CLASS__, 'add_filter_login_form_strings' ) );
		add_action( 'woocommerce_login_form_start', array( __CLASS__, 'remove_filter_login_form_strings' ) );

		// adjust form-login.php Register title
		add_action( 'woocommerce_login_form_end', array( __CLASS__, 'add_filter_login_form_strings' ), 20 );
		add_action( 'woocommerce_register_form_start', array( __CLASS__, 'remove_filter_login_form_strings' ) );
		
		// adjust form-login.php Forgot Password link
		// add_action( 'woocommerce_login_form', array( __CLASS__, 'add_filter_login_form_strings' ) );
		// add_action( 'woocommerce_login_form_end', array( __CLASS__, 'remove_filter_login_form_strings' ), 5 );
	}

	/**
	 * Add the avatar to the My Account dashboard page.
	 * 
	 * @since 1.5.0
	 * @return void
	 */
	public static function add_avatar_to_dashboard() {
		if ( '' != WC()->query->get_current_endpoint() ) {
			return;
		}

		$current_user = wp_get_current_user();

		printf( 
			'<div class="woocommerce-MyAccount-avatar">%s</div>',
			get_avatar( $current_user->user_email, 100 )
		);
	}

	/**
	 * Add a gettext filter for the `myaccount/form-login.php` template file.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function add_filter_login_form_strings() {
		add_filter( 'gettext', array( __CLASS__, 'filter_login_form_strings' ), 10, 3 );
	}

	/**
	 * Remove a gettext filter for the `myaccount/form-login.php` template file.
	 *
	 * @since 1.7.0
	 * @return void
	 */
	public static function remove_filter_login_form_strings() {
		remove_filter( 'gettext', array( __CLASS__, 'filter_login_form_strings' ), 10, 3 );
	}

	/**
	 * Filter gettext for the `myaccount/form-login.php` template file.
	 *
	 * @since 1.7.0
	 * @param string $translated
	 * @param string $original
	 * @param string $domain
	 * @return string $translated
	 */
	public static function filter_login_form_strings( $translated, $original, $domain ) {
		if ( 'woocommerce' != $domain ) {
			return $translated;
		}

		if ( 'Login' == $original ) {
			$translated = get_theme_mod( 'content-login-title', 'Hey, welcome back!' );
		}

		if ( 'Register' == $original ) {
			$translated = get_theme_mod( 'content-register-title', sprintf( 'Sign up for %s', get_bloginfo( 'name' ) ) );
		}

		if ( 'Lost your password?' == $original ) {
			$translated = _x( 'I forgot', 'reset password link', 'listify' );
		}

		return $translated;

	}

}
add_action( 'after_setup_theme', array( 'Listify_WooCommerce_Template_Account', 'setup_actions' ) );
