<?php 
/**
 * Your Inspiration Themes
 * 
 * Filters and actions
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

// SETUP
// -----------------------------------------------------------
add_action( 'after_setup_theme'  , 'yit_setup_theme'        );            
//add_action( 'wp_head', 'yit_load_buttons_style', 1 );  too much time
add_filter( 'body_class'         , 'yit_browser_body_class' ); 
add_filter( 'wp_head'            , 'yit_body_background' );
add_action( 'wp_head'            , 'yit_get_sidebar_setting' );
add_filter( 'yit_custom_style'   , create_function( '$css', 'return $css . yit_get_option( "custom-style" );' ) );
add_action( 'wp_footer'          , create_function( '', 'echo "<!-- START GOOGLE ANALYTICS --> " . yit_get_option( "google-analytics-code" ) . " <!-- END GOOGLE ANALYTICS -->";' ), 10 );
add_action( 'wp_footer'          , create_function( '', 'echo "<!-- CUSTOM SCRIPT -->" . yit_get_option( "custom-script" ) . "<!-- END CUSTOM SCRIPT -->";' ), 11 );

if( isset( $_GET['page'] ) && $_GET['page'] == 'yit_panel_backup' ) {
    add_action( 'admin_print_scripts', 'yit_delete_cache_ajax', 20 );
    add_action( 'admin_print_scripts', 'yit_reset_theme_options_ajax', 30 );
    add_action( 'admin_print_scripts', 'yit_delete_custom_sidebars_ajax', 30 );
    add_action( 'admin_print_scripts', 'yit_delete_resized_images_ajax', 40 );
    add_action( 'admin_print_scripts', 'yit_install_sampledata_ajax', 50 );
    add_action( 'admin_print_scripts', 'yit_confirm_sample_data', 60 );
}

add_action( 'wp_ajax_delete_cache', 'yit_delete_cache_callback' );
add_action( 'wp_ajax_reset_theme_options', 'yit_reset_theme_options_callback' );
add_action( 'wp_ajax_delete_custom_sidebars', 'yit_delete_custom_sidebars_callback' );
add_action( 'wp_ajax_delete_resized_images', 'yit_delete_resized_images_callback' );
add_action( 'wp_ajax_install_sampledata', 'yit_install_sampledata_callback' );

// TEMPLATE
// -----------------------------------------------------------
add_filter( 'yit_submenu_tabs_sidebars_manager_custom_post_type', 'yit_tab_sidebars_sidebars_manager_shop_sidebar' );     
add_filter( 'nav_menu_css_class', 'yit_check_for_submenu', 10, 2 );


// CONTENT
// -----------------------------------------------------------  
remove_filter( 'the_content', 'wpautop'            );
    //remove_filter( 'the_content', 'shortcode_unautop'  );
remove_filter( 'the_content', 'prepend_attachment' );      
remove_filter( 'the_content', 'do_shortcode', 11   ); // AFTER wpautop()
add_filter( 'widget_text', 'do_shortcode' );    
add_filter( 'the_content', 'yit_clean_text'     ); // here there is wpautop, shortcodes and prepend attachment 
add_filter( 'the_content_more_link', 'yit_sc_more_link', 10, 3 );  //shortcode in more links          
add_filter( 'yit_title_special_characters', 'yit_title_special_characters' );
//add_filter( 'wp_title', 'yit_remove_chars_title' );


// WIDGETS
// -----------------------------------------------------------           
add_filter( 'dynamic_sidebar_params', 'yit_widget_first_last_classes' );

add_filter( 'document_title_parts', 'yit_get_title', 10 );