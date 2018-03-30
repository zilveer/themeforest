<?php if(! defined('ABSPATH')) { return; }

/**
 * This file holds all methods hooked to WordPress' filters
 *
 * @package    Kallyas
 * @category   Filter Hooks
 * @author     Team Hogash
 * @since      3.8.0
 */

//<editor-fold desc=">>> WP HOOKS - FILTERS">



    /**
     * Shortcodes fixer
     */
    add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );

    /**
     * Remove the "Read More" tag from excerpt
     */
    add_filter( 'excerpt_more', 'clear_excerpt_more' );
    /**
     * Login Form - Stop redirecting if ajax is used
     */
    add_filter( "login_redirect", "zn_stop_redirecting", 10, 3 );
    /**
     * Check for boxed layout or full and add specific CSS class by filter
     */
    add_filter( 'body_class', 'zn_body_class_names' );

    /**
     * This filter should be used to retrieve the proper url to a page or post after the language is switched using WPML
     */
    add_filter('preview_post_link', 'th_wpml_get_url_for_language');

//</editor-fold desc=">>> WP HOOKS - FILTERS">
