<?php

require_once ('include/defines.php');

// Admin framework
if( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/admin/framework.php' ) ) {
	// The loader will load all of the extensions automatically based on your $redux_opt_name
	require_once( get_template_directory() . '/admin/loader.php' );
	
	// Metaboxes
	require_once ( get_template_directory() . '/include/metabox-config.php');

    require_once( get_template_directory() . '/admin/framework.php' );
}
if ( !isset( $global_theme_options ) && file_exists( get_template_directory() . '/include/admin-config.php' ) ) {
    require_once( get_template_directory() . '/include/admin-config.php' );
}

// Support for automatic plugin installation
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/class-tgm-plugin-activation.php');
require_once(  get_template_directory() . '/components/helper_classes/tgm-plugin-activation/required_plugins.php');

// Widgets
require_once(  get_template_directory() . '/components/widgets/widgets.php');

// Util functions
require_once ( get_template_directory() . '/include/util_functions.php');

// Add theme support
require_once ( get_template_directory() . '/include/theme-support-config.php');

// Theme setup
require_once ( get_template_directory() . '/include/setup-config.php');

// Enqueue scripts
require_once ( get_template_directory() . '/include/scripts-config.php');

// Hooks
require_once ( get_template_directory() . '/include/hooks-config.php');

// Blog comments and pagination
require_once ( get_template_directory() . '/include/blog-config.php');

// Visual Composer
if ( function_exists( 'vc_set_as_theme' ) ) {
	require_once ( get_template_directory() . '/include/vc-config.php');
}

// Woocommerce
if( function_exists('is_woocommerce') ){
	require_once ( get_template_directory() . '/include/woocommerce-config.php');
}

?>