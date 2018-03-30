<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Change Theme Options Menu Name
 * do not change these values! 
 *
 * @return    string
 *
 * @access    private
 * @since     1.0
 */

/* activate theme panels */
add_filter( 'ut_show_theme_options' , '__return_false' ); /* new theme options - upcoming version */
add_filter( 'ut_show_export_import' , '__return_false' ); /* new theme options import export tool - upcoming version */
add_filter( 'ut_show_theme_info'    , '__return_true' );
add_filter( 'ut_show_demo_importer' , '__return_false' ); /* new demo importer - upcoming version */
add_filter( 'ut_show_header_manager', '__return_false' ); /* new header manager - upcoming version */

/* activate google fonts */
add_filter( 'ut_google_fonts' , '__return_false');
add_filter( 'ut_cache_google_fonts' , '__return_true'); /* to avoid unnecessary file or url requests */

/* activate sidebar support */
add_filter( 'ut_activate_sidebars'          , '__return_false' );
add_filter( 'ut_activate_secondary_sidebar' , '__return_false'); /* not available with this theme*/

/* don't change this if in doubt.*/
add_filter( 'ut_mobile_detect' , '__return_true' );
add_filter( 'ut_megamenu' , '__return_false' );

/* brooklyn overwrite until unite framework takes over control in a future version */
add_filter( 'ut_theme_options_page' , function() { return 'ot-theme-options'; } );
add_filter( 'ut_demo_importer_page' , function() { return 'ut_view_updater'; } );
add_filter( 'ut_sidebars_page'      , function() { return 'ut_sidebar_settings'; } );