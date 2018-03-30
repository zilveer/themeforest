<?php
/**
 * Theme sprecific functions and definitions
 */


/* Theme setup section
------------------------------------------------------------------- */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) $content_width = 1170; /* pixels */

// Add theme specific actions and filters
// Attention! Function were add theme specific actions and filters handlers must have priority 1
if ( !function_exists( 'ancora_theme_setup' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_theme_setup', 1 );
	function ancora_theme_setup() {

		// Register theme menus
		add_filter( 'ancora_filter_add_theme_menus',		'ancora_add_theme_menus' );

		// Register theme sidebars
		add_filter( 'ancora_filter_add_theme_sidebars',	'ancora_add_theme_sidebars' );

		// Set theme name and folder (for the update notifier)
		add_filter('ancora_filter_update_notifier', 		'ancora_set_theme_names_for_updater');
	}
}


// Add/Remove theme nav menus
if ( !function_exists( 'ancora_add_theme_menus' ) ) {
	//add_filter( 'ancora_action_add_theme_menus', 'ancora_add_theme_menus' );
	function ancora_add_theme_menus($menus) {
		
		//For example:
		//$menus['menu_footer'] = __('Footer Menu', 'ancora');
		//if (isset($menus['menu_panel'])) unset($menus['menu_panel']);
		
		if (isset($menus['menu_side'])) unset($menus['menu_side']);
		return $menus;
	}
}


// Add theme specific widgetized areas
if ( !function_exists( 'ancora_add_theme_sidebars' ) ) {
	//add_filter( 'ancora_filter_add_theme_sidebars',	'ancora_add_theme_sidebars' );
	function ancora_add_theme_sidebars($sidebars=array()) {
		if (is_array($sidebars)) {
			$theme_sidebars = array(
				'sidebar_main'		=> __( 'Main Sidebar', 'ancora' ),
				'sidebar_footer'	=> __( 'Footer Sidebar', 'ancora' )
			);
			if (ancora_exists_woocommerce()) {
				$theme_sidebars['sidebar_cart']  = __( 'WooCommerce Cart Sidebar', 'ancora' );
			}
			$sidebars = array_merge($theme_sidebars, $sidebars);
		}
		return $sidebars;
	}
}

// Set theme name and folder (for the update notifier)
if ( !function_exists( 'ancora_set_theme_names_for_updater' ) ) {
	//add_filter('ancora_filter_update_notifier', 'ancora_set_theme_names_for_updater');
	function ancora_set_theme_names_for_updater($opt) {
		$opt['theme_name']   = 'Blessing';
		$opt['theme_folder'] = 'blessing';
		return $opt;
	}
}



/* Include framework core files
------------------------------------------------------------------- */

require_once( get_template_directory().'/fw/loader.php' );
?>