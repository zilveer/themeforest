<?php
/**
 * WPV Widget Importer
 *
 * @package wpv
 * @subpackage Widget Importer
 */

if ( ! defined( 'WP_LOAD_IMPORTERS' ) )
	return;

/** Display verbose errors */
if(!defined('IMPORT_DEBUG')) {
	define( 'IMPORT_DEBUG', false );
}

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

if ( ! class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
		require $class_wp_importer;
}

/**
 * WordPress Importer class for managing the import process of a WXR file
 *
 * @package wpv
 * @subpackage Importer
 */
if ( class_exists( 'WP_Importer' ) ) {
class WPV_Widget_Import extends WP_Importer {
	function __construct() { /* nothing */ }

	/**
	 * Registered callback function for the WordPress Importer
	 *
	 * Manages the three separate stages of the WXR import process
	 */
	function dispatch() {
		$this->header();

		check_admin_referer( 'wpv-import' );
		$file = $_GET['file'];

		set_time_limit(0);
		$this->import( $file );

		$this->footer();
	}

	/**
	 * The main controller for the actual import stage.
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import( $file ) {
		add_filter( 'import_post_meta_key', array( $this, 'is_valid_meta_key' ) );
		add_filter( 'http_request_timeout', array( &$this, 'bump_request_timeout' ) );

		$this->import_start( $file );

		wp_suspend_cache_invalidation( true );

		$this->import_widgets($file);

		wp_suspend_cache_invalidation( false );

		$this->import_end();
	}

	function import_widgets($file) {
		$data = unserialize(base64_decode(file_get_contents($file)));

		$data['positions']['wp_inactive_widgets'] = array();
		wp_set_sidebars_widgets($data['positions']);

		foreach($data['widgets'] as $class=>$widget) {
			update_option($class, $widget);
		}
	}

	/**
	 * Parses the WXR file and prepares us for the task of processing parsed data
	 *
	 * @param string $file Path to the WXR file for importing
	 */
	function import_start( $file ) {
		if ( ! is_file($file) ) {
			echo '<p><strong>' . __( 'Sorry, there has been an error.', 'wordpress-importer' ) . '</strong><br />';
			echo __( 'The file does not exist, please try again.', 'wordpress-importer' ) . '</p>';
			$this->footer();
			die();
		}

		do_action( 'import_start' );
	}

	/**
	 * Performs post-import cleanup of files and the cache
	 */
	function import_end() {
		echo '<p>' . __( 'All done.', 'wordpress-importer' ) . ' <a href="' . admin_url() . '">' . __( 'Have fun!', 'wordpress-importer' ) . '</a>' . '</p>';

		$redirect = admin_url('admin.php?page=wpv_import');

		echo <<<REDIRECT
			<script>
				/*<![CDATA[*/
				setTimeout(function() {
					window.location = '$redirect';
				}, 3000);
				/*]]>*/
			</script>
REDIRECT;

		do_action( 'import_end' );
	}

	// Display import page title
	function header() {
		echo '<div class="wrap">';
		screen_icon();
		echo '<h2>' . __( 'Import Vamtam Widgets', 'wordpress-importer' ) . '</h2>';
	}

	// Close div.wrap
	function footer() {
		echo '</div>';
	}

	/**
	 * Added to http_request_timeout filter to force timeout at 60 seconds during import
	 * @return int 60
	 */
	function bump_request_timeout($imp) {
		return 60;
	}
}

} // class_exists( 'WP_Importer' )

function wpv_widget_importer_init() {
	$GLOBALS['wpv_widget_import'] = new WPV_Widget_Import();
	register_importer( 'wpv_widgets', 'Vamtam Widget Import', sprintf(__('Import widgets from Vamtam themes, not to be used as a stand-alone product.', 'health-center'), THEME_NAME), array( $GLOBALS['wpv_widget_import'], 'dispatch' ) );
}
add_action( 'admin_init', 'wpv_widget_importer_init' );
