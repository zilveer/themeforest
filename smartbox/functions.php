<?php
/**
 * Main functions file
 *
 * @package Smartbox
 * @subpackage Frontend
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

// create theme
if( !class_exists( 'OxyTheme' ) ) {
    require_once get_template_directory() . '/inc/core/theme.php';

    $theme = new OxyTheme(
        array(
            'theme_name'   => 'SmartBox',
            'theme_short'  => 'smartbox',
            'text_domain'  => 'smartbox_textdomain',
            'min_wp_ver'   => '3.4',
            'option-pages' => array(
                'general',
                'portfolio',
                'blog',
                'flexslider',
                'social',
                'permalinks',
                '404',
                'advanced'
            ),
             'sidebars' => array(
                'sidebar'            => array( 'Main Sidebar', 'Main sidebar for blog and non full width pages' ),
                'above-nav-right'    => array( 'Top right', 'Above Navigation section to the right' ),
                'above-nav-left'     => array( 'Top left', 'Above Navigation section to the left' ),
                'footer-left'        => array( 'Footer left', 'Left footer section' ),
                'footer-right'       => array( 'Footer right', 'Right footer section' ),
                'footer'             => array( 'Footer', 'footer section' ),
            ),
            'widgets' => array(
                'Smartbox_twitter' => 'smartbox_twitter.php',
                'Smartbox_social'  => 'smartbox_social.php',
                'Smartbox_wpml_language_selector'  => 'smartbox_wpml_language_selector.php',
            ),
        )
    );
}

if(function_exists( 'set_revslider_as_theme' )){
    add_action( 'init', 'oxy_remove_revslider_nag' );
    function oxy_remove_revslider_nag() {
        update_option('revslider-valid-notice', 'false');
        set_revslider_as_theme();
    }
}

// include extra theme specific code
include INCLUDES_DIR . 'frontend.php';
include INCLUDES_DIR . 'custom_posts.php';
include INCLUDES_DIR . 'install-plugins.php';
