<?php
/**
 * Your Inspiration Themes
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

/* === HEADER */
add_action( 'yit_head', 'yit_head', 10 );
add_action( 'wp_enqueue_scripts', 'yit_add_custom_styles' );
add_action( 'wp_enqueue_scripts', 'yit_add_custom_scripts' );
add_action( 'yit_topbar', 'yit_topbar', 10 );
add_action( 'yit_header', 'yit_header', 10 );
add_action( 'yit_logo', 'yit_logo', 10 );
add_action( 'yit_main_navigation', 'yit_main_navigation', 10 );
add_action( 'yit_after_header', 'yit_slider_section', 10 );
add_action( 'yit_after_header', 'yit_map', 20 );      
add_action( 'yit_after_header', 'yit_slogan', 30 );
add_filter( 'yit_og_type' , 'yit_get_og_type' );
if(is_shop_installed()) add_action( 'wp_enqueue_scripts', 'yit_woocommerce_object', 110 );

add_filter( 'document_title_separator' , create_function( '', 'return "|";' ) );

add_filter( 'wp_page_menu_args', 'yit_page_menu_args' );
add_filter( 'wp_page_menu', 'yit_page_menu', 10, 2 );

add_filter( 'wp_head', 'yit_header_background' );
add_filter( 'wp_head', 'yit_meta_bg' );

/* === PAGE */
add_action( 'yit_page_content', 'yit_page_content', 10 );
add_action( 'yit_loop_page', 'yit_loop_page', 10 );
add_action( 'yit_before_primary', 'yit_is_primary_start', 10 ); 
add_action( 'yit_after_primary', 'yit_is_primary_end', 10 );
add_action( 'yit_404', 'yit_404', 10 );                       
add_action( 'yit_loop_page', 'yit_page_meta', 5 );
add_action( 'yit_loop', 'yit_page_meta', 5 );
add_action( 'yit_loop_single_portfolio', 'yit_page_meta', 5 );

/* === BLOG */
add_action( 'yit_comments', 'yit_comments', 10 );
add_action( 'yit_comments_password_required', 'yit_comments_password_required', 10 );
add_action( 'yit_comments_navigation', 'yit_comments_navigation', 10 );
add_action( 'yit_enqueue_blog_stuffs', create_function( '', 'yit_wp_enqueue_style( 100, "blog-big", get_template_directory_uri() . "/theme/templates/blog/big/css/style.css" );' ) );
add_action( 'yit_enqueue_blog_stuffs', create_function( '', 'yit_wp_enqueue_style( 100, "blog-small", get_template_directory_uri() . "/theme/templates/blog/small/css/style.css" );' ) );
add_action( 'yit_enqueue_blog_stuffs', create_function( '', 'yit_wp_enqueue_style( 100, "blog-elegant", get_template_directory_uri() . "/theme/templates/blog/elegant/css/style.css" );' ) );
add_action( 'yit_enqueue_blog_stuffs', create_function( '', 'yit_wp_enqueue_style( 100, "blog-pinterest", get_template_directory_uri() . "/theme/templates/blog/pinterest/css/style.css" );' ) );
add_action( 'yit_trackbacks', 'yit_trackbacks', 10 );


add_action( 'comment_form_top', create_function( '', 'echo "<div class=\"row\">";' ) );
add_action( 'comment_form', create_function( '', 'echo "</div>";' ) );


/* === LOOP */
add_action( 'yit_loop', 'yit_loop', 10 );
add_action( 'yit_loop_internal', 'yit_loop_internal', 10 );
add_action( 'yit_loop_blog_big', 'yit_loop_blog_big', 10 );
add_action( 'yit_loop_blog_small', 'yit_loop_blog_small', 10 );
add_action( 'yit_loop_blog_elegant', 'yit_loop_blog_elegant', 10 );
add_action( 'yit_loop_blog_pinterest', 'yit_loop_blog_pinterest', 10 );
add_action( 'yit_archives', 'yit_archives', 10 );

/* === MISC */
add_action( 'yit_searchform', 'yit_searchform', 10 );
add_action( 'yit_extra_content', 'yit_extra_content', 10 );

add_filter( 'yith_wcmg_tab_options', 'yit_remove_items_options_yith_wcmg' );

/* === FOOTER */
add_action( 'yit_footer', 'yit_footer', 10 );
add_action( 'yit_footer_big', 'yit_footer_big', 10 );
add_action( 'yit_copyright', 'yit_copyright', 10 );

/* === SIDEBAR */
add_action( 'yit_default_sidebar', 'yit_default_sidebar', 10 );

/* === UNREGISTER POST TYPES */
add_action('init', 'yit_unregister_post_types', 10);

add_filter( 'yit_admin_menu_theme_options', 'yit_remove_tab_sc' );
add_filter( 'yit_admin_submenu_theme_options', 'yit_remove_tab_sc' );

/* == BACK TO TOP == */
add_action( 'yit_after_header', 'yit_back_to_top', 0 );

/* == REMOVE WP ADMIN BAR == */
add_action( 'init', 'yit_remove_wp_admin_bar' );