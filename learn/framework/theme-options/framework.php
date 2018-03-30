<?php
/**
 * Theme Alien Options Framework
 * Premium theme option framework
 *
 * @package Theme Alien Options Framework
 */

/**
 * Main class to load framework
 *
 * @author Theme Alien
 * @version 1.0.1
 */
class Learn_Theme_Options {
	/**
	 * Store theme options
	 *
	 * @var array
	 */
	public static $options;

	/**
	 * Store theme default settings
	 *
	 * @var array
	 */
	public static $defaults = array();

	/**
	 * Initialize framework
	 *
	 * @since  1.0
	 *
	 * @return void
	 */
	public static function init() {
		// Load files
		self::load();

		// Theme options
		self::$options = apply_filters( 'learn_theme_options', null );

		if ( empty( self::$options ) ) {
			return;
		}

		// Default settings
		self::default_settings();

		if ( is_admin() ) {
			new Learn_Theme_Options_Admin( self::$options );
		}
	}


	/**
	 * Define default settings
	 *
	 * @since  1.0
	 *
	 * @return array fields
	 */
	public static function default_settings() {
		// Just store default values
		foreach ( self::$options['fields'] as $fields ) {
			foreach ( $fields as $field ) {
				if ( isset( $field['name'] ) ) {
					self::$defaults[$field['name']] = isset( $field['default'] ) ? $field['default'] : '';
				}

				// Store children fields of group
				if ( 'group' == $field['type'] ) {
					foreach ( $field['children'] as $child ) {
						self::$defaults[$child['name']] = isset( $child['default'] ) ? $child['default'] : '';
					}
				}
			}
		}
	}

	/**
	 * Register auto loader
	 *
	 * @since  1.0
	 *
	 * @return void
	 */
	public static function load() {
		if ( ! is_admin() )
		{
			return;
		}

		require_once LEARN_OPTIONS_DIR . '/framework/theme-options/inc/class-fields.php';
		require_once LEARN_OPTIONS_DIR . '/framework/theme-options/inc/class-admin.php';
	}

	/**
	 * Get theme option value
	 *
	 * @since  1.0
	 *
	 * @param  string $name Option name
	 *
	 * @return mixed
	 */
	public static function get_option( $name ) {
		global $_learn_theme_options;

		if ( null === $_learn_theme_options ) {
			$_learn_theme_options = get_theme_mods();
		}

		// Return saved setting
		if ( isset( $_learn_theme_options[$name] ) ) {
			return $_learn_theme_options[$name];
		}

		// Return default setting
		if ( isset( Learn_Theme_Options::$defaults[$name] ) ) {
			return Learn_Theme_Options::$defaults[$name];
		}

		return false;
	}
}

add_action( 'init', array( 'Learn_Theme_Options', 'init' ) );


/**
 * Get theme option value
 *
 * @since  1.0
 *
 * @param  string $name Option name
 *
 * @return mixed
 */
function learn_theme_option( $name ) {
    return apply_filters( 'learn_get_theme_option', Learn_Theme_Options::get_option( $name ), $name );
}
