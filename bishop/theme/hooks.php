<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * @package Yithems
 */

/*
 * =SETUP=
 */

/**
 * @see yit_setup_theme
 */
add_action( 'wp_head', 'yit_detect_javascript', 0 );
add_action( 'after_setup_theme', 'yit_setup_theme' );
add_action( 'wp', 'yit_skin_header' );
add_filter( 'body_class', 'yit_add_body_class' );
add_action( 'admin_init', 'yit_add_field_to_testimonial_meta' );
if(is_shop_installed()) add_action( 'wp_enqueue_scripts', 'yit_woocommerce_object', 110 );
add_filter( 'yit_og_type' , 'yit_get_og_type' );
// misc
add_action( 'init', 'yit_remove_wp_admin_bar' );
add_filter( 'yit_button_style', 'yit_button_style' );
add_filter( 'yit_get_testimonial_categories', 'yit_get_testimonial_categories' );
add_filter( 'yit_get_portfolios', 'yit_get_portfolios' );
add_filter( 'comments_open', 'my_comments_open', 10, 2 );
add_filter( 'pings_open', 'my_comments_open', 10, 2 );
add_action( 'after_setup_theme', 'init_portfolio_layouts');
add_action( 'after_setup_theme', 'init_slider_layouts' );

add_filter( 'script_loader_src', 'yit_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'yit_remove_script_version', 15, 1 );
add_action( 'wp_enqueue_scripts', 'yit_add_testimonial_slider_script', 15 );


add_filter( 'yit_get_contact_forms', 'yit_get_contact_forms' );
add_filter( 'yith_maintenance_options', 'yit_set_maintenance_skin');

add_filter( 'wp_head', 'yit_body_background' );

add_filter( 'document_title_separator' , create_function( '', 'return "|";' ) );

add_action( 'yit_searchform', 'yit_searchform', 10 );

if ( ! is_admin() || defined( 'DOING_AJAX' ) ) {

    /**
     * organizzati per macroaree:
     *
     * - head
     * - header
     * - primary
     *   - content
     *   - sidebar
     * - footer
     */


    /*
     * =HEAD=
     */
    add_action( 'wp_head', 'yit_favicon' );
    add_action( 'wp_head', 'yit_change_container_width' );
    add_action( 'wp_head', 'yit_header_background' );
    add_action( 'wp_head', 'yit_add_blog_stylesheet', 0 );
    add_action( 'wp_head', 'yit_og' );
    add_action( 'wp_head', 'yit_comment_script');

    /*
     * =HEADER=
     */
    add_action( 'yit_header', 'yit_back_to_top', 4 );
    add_action( 'yit_header', 'yit_start_wrapper', 5 );
    add_action( 'yit_header', 'yit_start_header', 10 );
    add_action( 'yit_header', 'yit_infobar', 90 );
    add_action( 'yit_header', 'yit_end_header', 100 );
    add_action( 'yit_header', 'yit_slider_header', 120 );
    add_action( 'yit_header', 'yit_map', 130 );
    add_action( 'yit_header', 'yit_slogan', 140 );

    add_action( 'yit_header_slogan', 'yit_slogan',  10 );  // just for 404 when header is hidden
      /*
     * =PRIMARY=
     */

    add_action( 'yit_primary', 'yit_start_primary', 5 );
    add_action( 'yit_after_primary_starts', 'yit_blog_big_post_start', 10 );
    add_action( 'yit_before_primary_ends', 'yit_blog_big_post_end', 10 );
    add_action( 'yit_before_primary_ends', 'yit_blog_big_next_post', 15 );
    add_action( 'yit_primary', 'yit_end_primary', 90 );

    // content
    add_action( 'yit_primary', 'yit_primary_content', 10 );
    add_action( 'yit_primary', 'yit_primary_sidebar_two', 20 );
    add_action( 'yit_primary', 'yit_primary_sidebar', 30 );

    // loop
    if ( file_exists( YIT_PATH . '/my-account.php' ) && function_exists( 'WC' ) ) {

        if ( ! ( version_compare( WC()->version , '2.6', '>=' ) ) ) {

            add_action( 'yit_content_loop', 'yit_my_account_template', 5 );

        }

    }
    add_action( 'yit_content_loop', 'yit_content_loop', 10 );

    /*
     * =FOOTER=
     */
    add_action( 'yit_footer', 'yit_footer', 10 );
    add_action( 'yit_footer_big', 'yit_footer_big', 20 );
    add_action( 'yit_copyright', 'yit_copyright', 30 );
    add_action( 'yit_footer', 'yit_end_wrapper', 90 );

	/* quick view */
	add_action( 'wp_footer', 'yit_quick_view' );

    /*
     * =WIDGET=
     */
    add_filter( 'widget_title', 'yit_decode_title' );
    add_filter( 'widget_text', 'do_shortcode' );

    /* widget categories */

    add_filter( 'widget_categories_args', 'yit_exclude_categories_list_widget' );
    add_filter( 'widget_categories_dropdown_args', 'yit_exclude_categories_list_widget' );

    /*
     * PAGE
     */

    add_action( 'yit_404', 'yit_404', 10 );
} else {
    add_action( 'admin_init', 'yit_remove_ult_banner' );
    add_action( 'admin_init', 'yit_remove_notice_visual_composer' );
    //add_action( 'admin_init', 'yit_remove_rev_slider_banner' );
}