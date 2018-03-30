<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Blockquote_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_blockquote', array( &$this, 'blockquote_shortcode' ) );
    }

    public function blockquote_shortcode( $atts ) {
        $output = $text = '';

        extract( shortcode_atts( array(
            'text'          => 'Add some text here.',
        ), $atts ) );


        $output .= '<blockquote><p>'.do_shortcode($text).'</p>';
        $output .= '</blockquote>';

        return $output;
    }

}

Clubix_Blockquote_Shortcode::get_instance();