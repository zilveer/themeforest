<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Dropcap_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_drc', array( &$this, 'drc_shortcode' ) );
    }

    public function drc_shortcode( $atts, $content = null ) {
        $output = $text = $subtext = '';


        $output .= '<span class="dropcap">'.$content.'</span>';

        return $output;
    }

}

Clubix_Dropcap_Shortcode::get_instance();