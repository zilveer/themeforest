<?php
/**
 * Ancora Framework
 *
 * @package themerex
 * @since themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Framework directory path from theme root
if ( ! defined( 'ANCORA_FW_DIR' ) )		define( 'ANCORA_FW_DIR', '/fw/' );

// Theme timing
if ( ! defined( 'ANCORA_START_TIME' ) )	define( 'ANCORA_START_TIME', microtime());			// Framework start time
if ( ! defined( 'ANCORA_START_MEMORY' ) )	define( 'ANCORA_START_MEMORY', memory_get_usage());	// Memory usage before core loading

// Global variables storage
global $ANCORA_GLOBALS;
$ANCORA_GLOBALS = array();

/* Theme setup section
-------------------------------------------------------------------- */
if ( !function_exists( 'ancora_loader_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'ancora_loader_theme_setup', 20 );
	function ancora_loader_theme_setup() {
		// Before init theme
		do_action('ancora_action_before_init_theme');

		// Load current values for main theme options
		ancora_load_main_options();

		// Theme core init - only for admin side. In frontend it called from header.php
		if ( is_admin() ) {
			ancora_core_init_theme();
		}
	}
}


/* Include core parts
------------------------------------------------------------------------ */
// core.strings must be first - we use ancora_str...() in the ancora_get_file_dir()
// core.files must be first - we use ancora_get_file_dir() to include all rest parts
require_once( (file_exists(get_stylesheet_directory().(ANCORA_FW_DIR).'core/core.strings.php') ? get_stylesheet_directory() : get_template_directory()).(ANCORA_FW_DIR).'core/core.strings.php' );
require_once( (file_exists(get_stylesheet_directory().(ANCORA_FW_DIR).'core/core.files.php') ? get_stylesheet_directory() : get_template_directory()).(ANCORA_FW_DIR).'core/core.files.php' );
ancora_autoload_folder( 'core' );

// Include custom theme files
ancora_autoload_folder( 'includes' );

// Include theme templates
ancora_autoload_folder( 'templates' );

// Include theme widgets
ancora_autoload_folder( 'widgets' );
?>