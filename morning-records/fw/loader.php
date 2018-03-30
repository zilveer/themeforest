<?php
/**
 * Morning records Framework
 *
 * @package morning_records
 * @since morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Framework directory path from theme root
if ( ! defined( 'MORNING_RECORDS_FW_DIR' ) )			define( 'MORNING_RECORDS_FW_DIR', 'fw' );

// Theme timing
if ( ! defined( 'MORNING_RECORDS_START_TIME' ) )		define( 'MORNING_RECORDS_START_TIME', microtime(true));		// Framework start time
if ( ! defined( 'MORNING_RECORDS_START_MEMORY' ) )		define( 'MORNING_RECORDS_START_MEMORY', memory_get_usage());	// Memory usage before core loading
if ( ! defined( 'MORNING_RECORDS_START_QUERIES' ) )	define( 'MORNING_RECORDS_START_QUERIES', get_num_queries());	// DB queries used

// Include theme variables storage
get_template_part(MORNING_RECORDS_FW_DIR.'/core/core.storage');

// Theme variables storage
//$theme_slug = str_replace(' ', '_', trim(strtolower(get_stylesheet())));
//morning_records_storage_set('options_prefix', 'morning_records'.'_'.trim($theme_slug));	// Used as prefix to store theme's options in the post meta and wp options
morning_records_storage_set('options_prefix', 'morning_records');	// Used as prefix to store theme's options in the post meta and wp options
morning_records_storage_set('page_template', '');			// Storage for current page template name (used in the inheritance system)
morning_records_storage_set('widgets_args', array(			// Arguments to register widgets
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget_title">',
		'after_title'   => '</h6>',
	)
);

/* Theme setup section
-------------------------------------------------------------------- */
if ( !function_exists( 'morning_records_loader_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'morning_records_loader_theme_setup', 20 );
	function morning_records_loader_theme_setup() {

		morning_records_profiler_add_point(esc_html__('After load theme required files', 'morning-records'));

		// Before init theme
		do_action('morning_records_action_before_init_theme');

		// Load current values for main theme options
		morning_records_load_main_options();

		// Theme core init - only for admin side. In frontend it called from header.php
		if ( is_admin() ) {
			morning_records_core_init_theme();
		}
	}
}


/* Include core parts
------------------------------------------------------------------------ */
// Manual load important libraries before load all rest files
// core.strings must be first - we use morning_records_str...() in the morning_records_get_file_dir()
get_template_part(MORNING_RECORDS_FW_DIR.'/core/core.strings');
// core.files must be first - we use morning_records_get_file_dir() to include all rest parts
get_template_part(MORNING_RECORDS_FW_DIR.'/core/core.files');

// Include debug and profiler
get_template_part(morning_records_get_file_slug('core/core.debug.php'));

// Include custom theme files
morning_records_autoload_folder( 'includes' );

// Include core files
morning_records_autoload_folder( 'core' );

// Include theme-specific plugins and post types
morning_records_autoload_folder( 'plugins' );

// Include theme templates
morning_records_autoload_folder( 'templates' );

// Include theme widgets
morning_records_autoload_folder( 'widgets' );
?>