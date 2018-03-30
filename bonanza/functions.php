<?php   

/***************************************************************************
    Built by UFO Themes. http://www.ufothemes.com
    Copyright (C) 2012 UFO Themes    
***************************************************************************/ 

global $theme_shortname; 
global $theme_options;

$theme_shortname = 'bonanza';
$theme_options = get_option( $theme_shortname . '_options' );

$template_dir = get_template_directory();

// Load iCore Framework and Theme Options
require_once ( $template_dir . '/icore/icore-init.php' );



/*** Load Theme Related Files ***/

// Load Theme Setup files
require_once ( $template_dir . '/includes/icore/theme-functions.php' );
// Load Theme Sidebars
require_once ( $template_dir . '/includes/icore/theme-sidebars.php' );
// Load Theme Filters
require_once ( $template_dir . '/includes/icore/theme-filters.php' );
// Load Theme Javascript
require_once ( $template_dir . '/includes/icore/theme-scripts.php' );
// Load Theme Setup files
require_once ( $template_dir . '/includes/icore/theme-taxonomies.php' );
// Load Theme Widgets
require_once ( $template_dir . '/includes/icore/theme-widgets.php' );
// Load Theme Setup files
require_once ( $template_dir . '/includes/icore/theme-customizer.php' );
// Load Google fonts
require_once ( $template_dir . '/includes/icore/fonts.php' );
// Load Theme Shortcodes
require_once ( $template_dir . '/ufo-shortcodes/shortcodes.php' );


/*** Load WooCommerce Related Files ***/

//Load WooCommerce Config
if ( class_exists('woocommerce') ) {
	require_once ( $template_dir . '/includes/woocommerce/woocommerce-config.php');
}
?>