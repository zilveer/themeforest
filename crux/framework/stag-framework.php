<?php
/**
 * StagFramework
 *
 * @package StagFramework
 * @since 2.0.0
 * @version 2.0.1.3
 * @author Ram Ratan Maurya (Codestag)
 * @link https://mauryaratan.me
 * @link https://codestag.com
 * @copyright Ram Ratan Maurya (Codestag)
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class StagFramework{
	/**
	 * Current framework version.
	 *
	 * @var string
	 */
	public $version = '2.0.1.3';

	function __construct() {

		define( 'STAG_FRAMEWORK_VERSION', $this->version );

		if ( function_exists( 'wp_get_theme' ) ) {
			if ( is_child_theme() ) {
				$temp_obj  = wp_get_theme();
				$theme_obj = wp_get_theme( $temp_obj->get('Template') );
			} else {
				$theme_obj = wp_get_theme();
			}

			$theme_version    = $theme_obj->get('Version');
			$theme_name       = $theme_obj->get('Name');
			$theme_uri        = $theme_obj->get('ThemeURI');
			$theme_author     = $theme_obj->get('Author');
			$theme_author_uri = $theme_obj->get('AuthorURI');

		}

		define( 'STAG_THEME_NAME', $theme_name );
		define( 'STAG_THEME_VERSION', $theme_version );
		define( 'STAG_THEME_URI', $theme_uri );
		define( 'STAG_THEME_AUTHOR', $theme_author );
		define( 'STAG_THEME_AUTHOR_URI', $theme_author_uri );

		define( 'STAG_SUPPORT_URI', 'https://codestag.com/support/' );
		define( 'STAG_HOME', 'https://codestag.com' );

		add_action( 'init', array( $this, 'stag_init' ), 2 );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'scripts_and_styles' ) );

		$this->include_theme_files();
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since  2.0.1.3
	 *
	 * @param  string $hook Page name where to enqueue the admin styles.
	 * @return void
	 */
	public function scripts_and_styles( $hook ) {
		if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
			// Scripts
			wp_enqueue_media();
			wp_register_script( 'stag-admin-metabox', get_template_directory_uri() . '/framework/assets/js/stag-admin-metabox.js', array( 'jquery', 'wp-color-picker' ) );
			wp_enqueue_script( 'stag-admin-metabox' );

			// Styles
			wp_register_style( 'stag-admin-metabox', get_template_directory_uri() . '/framework/assets/css/stag-admin-metabox.css', array( 'wp-color-picker' ), STAG_FRAMEWORK_VERSION );
			wp_enqueue_style('stag-admin-metabox');
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	/**
	 * Initiate theme components.
	 *
	 * @since  2.0.1.3
	 * @return void
	 */
	public function stag_init() {
		if ( stag_is_theme_activated() ) {
			flush_rewrite_rules();
			header( 'Location: ' . admin_url( 'admin.php?page=stagframework&activated=true' ) );
		}

		$data = get_option('stag_framework_options');

		if ( is_child_theme() ) {
		    $temp_obj = wp_get_theme();
		    $theme_obj = wp_get_theme( $temp_obj->get('Template') );
		} else {
		    $theme_obj = wp_get_theme();
		}

		$data['theme_name'] = $theme_obj->get('Name');
	    $data['theme_version'] = $theme_obj->get('Version');

		$data['framework_version'] = STAG_FRAMEWORK_VERSION;
		$data['stag_framework']    = array();
		update_option('stag_framework_options', $data);

		$stag_values = get_option('stag_framework_values');
		if ( !is_array($stag_values) ) update_option( 'stag_framework_values', array() );
	}

	/**
	 * Add admin menus.
	 *
	 * @since  2.0.1.3
	 * @return void
	 */
	public function admin_menu() {
		add_menu_page( STAG_THEME_NAME, STAG_THEME_NAME, 'manage_options', 'stagframework', 'stag_options_page', 'dashicons-admin-generic', 31 );
		add_submenu_page('stagframework', __('Theme Options', 'stag'), __('Theme Options', 'stag'), 'manage_options', 'stagframework', 'stag_options_page' );
	}

	/**
	 * Load Framework files
	 *
	 * @since  2.0.1.3
	 * @return void
	 */
	private function include_theme_files() {
		$path = get_template_directory() . '/framework/';

		require_once( $path . '/classes/class-admin-backup.php' );
		require_once( $path . '/classes/class-tgm-plugin-activation.php' );
		require_once( $path . '/classes/class-stag-widget.php' );

		require_once( $path . 'stag-admin-interface.php' );
		require_once( $path . 'stag-admin-functions.php' );
		require_once( $path . 'stag-admin-metaboxes.php' );

		require_once( $path . 'stag-theme-functions.php' );

		/**
		 * Schema.org markup helper.
		 *
		 * @since 2.0.1.2
		 */
		require_once( $path . 'stag-markup-helper.php' );
	}
}

$GLOBALS['stagFramework'] = new StagFramework();
