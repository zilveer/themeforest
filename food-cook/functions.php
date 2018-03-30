<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
    die ( 'You do not have sufficient permissions to access this page!' );
endif;

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

$functions_path = get_template_directory() . '/functions/';
$includes_path  = get_template_directory() . '/includes/';

// Don't load alt stylesheet from WooFramework
if ( ! function_exists( 'woo_output_alt_stylesheet' ) ) :
	function woo_output_alt_stylesheet() {}
endif;

// Don't load favicon from WooFramework
if ( ! function_exists( 'woo_output_custom_favicon' ) ) :
	function woo_output_custom_favicon() {}
endif;


// WooFramework init
require_once (  $functions_path . 'admin-init.php' );	

// theme init
require_once (  $includes_path . 'theme-init.php' );	

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/






/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>