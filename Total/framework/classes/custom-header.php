<?php
/**
 * Adds support for the Custom Header image and adds it to the header
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Custom_Header' ) ) {

    class WPEX_Custom_Header {

        /**
         * Main constructor
         *
         * @since 1.6.3
         */
        public function __construct() {
            add_filter( 'after_setup_theme', array( 'WPEX_Custom_Header', 'add_support' ) );
            add_filter( 'wpex_head_css', array( 'WPEX_Custom_Header', 'custom_header_css' ), 99 );
        }

        /**
         * Retrieves cached CSS or generates the responsive CSS
         *
         * @since 1.6.0
         */
        public static function add_support() {
            add_theme_support( 'custom-header', apply_filters( 'wpex_custom_header_args', array(
                'default-image'          => '',
                'width'                  => 0,
                'height'                 => 0,
                'flex-width'             => true,
                'flex-height'            => true,
                'admin-head-callback'    => 'wpex_admin_header_style',
                'admin-preview-callback' => 'wpex_admin_header_image',
            ) ) );
        }

        /**
         * Displays header image as a background for the header
         *
         * @since 1.6.0
         */
        public static function custom_header_css( $output ) {
            if ( $header_image = get_header_image() ) {
                $output .= '#site-header,.is-sticky #site-header{background-image:url('. $header_image .');background-size: cover;}';
            }
            return $output;
        }

    }
}
new WPEX_Custom_Header();