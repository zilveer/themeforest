<?php

/**
 * Suggest things to do after a theme update
 *
 * @package wpv
 */
class WpvUpdateNotice {
	/**
	 * Key for the option which holds the last theme version
	 * 
	 * @var string
	 */
	public static $last_version_key = '-vamtam-last-theme-version';

	/**
	 * checks if the theme has been updated
	 * and the update message has not been dismissed
	 */
	public static function check() {
		$current_version = WpvFramework::get_version();
		$last_known_version = get_option( THEME_SLUG . self::$last_version_key );

		if ( $current_version !== $last_known_version || ! wpv_get_option( 'theme-update-notice-dismissed' ) ) {
			$GLOBALS['wpv_only_smart_less_compilation'] = true;
			$status = wpv_finalize_custom_css();

			if ( 'smart less failed' === trim( $status ) ) {
				add_action( 'admin_notices', array( __CLASS__, 'after_update_notice' ) );
				add_action( 'wpv_after_save_theme_options', array( __CLASS__, 'dismiss_notice') );

				wpv_update_option( 'last-theme-version', $current_version );
				wpv_update_option( 'theme-update-notice-dismissed', false );
			} else {
				self::dismiss_notice();
			}
		}
	}

	/**
	 * Display the update notice
	 */
	public static function after_update_notice() {
		echo '<div class="error fade"><p><strong>'; // xss ok;
		_e( 'It is highly recommended that you regenerate your theme\'s CSS cache.', 'health-center' );
		echo '</strong></p><p>'; // xss ok
		printf( __( 'We advise you to head over to the <a href="%s">theme options</a> and click the "Save Changes" button. This will ensure that you are seeing the latest styles and that all theme caches have been cleared.', 'health-center' ), admin_url( 'admin.php?page=wpv_general' ) );
		echo '</p></div>'; // xss ok;
	}

	/**
	 * dissmiss the notice once the theme options have been saved
	 */
	public static function dismiss_notice() {
		update_option( THEME_SLUG . self::$last_version_key, WpvFramework::get_version() );
		wpv_update_option( 'theme-update-notice-dismissed', true );
	}
}