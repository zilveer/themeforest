<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Divider_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_text_divider', array( &$this, 'divider_text_shortcode' ) );
        add_shortcode( 'clx_divider', array( &$this, 'divider_shortcode' ) );
    }

    public function divider_shortcode( $atts ) {
        $output = $type = '';

        extract( shortcode_atts( array(
            'type'          => '',
        ), $atts ) );

        if($type != ''){
            $output .= '<hr class="duble">';
        }
        else{
            $output .= '<hr>';
        }

        return $output;
    }

    public function divider_text_shortcode( $atts ) {
        $output = $text = '';

        extract( shortcode_atts( array(
            'text'          => 'Heading',
        ), $atts ) );


        $output .= '<h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;">'.$text.'</h3>';
        $output .= '<div class="underline-bg">';
        $output .= '<div class="underline template-based-element-background-color"></div>';
        $output .= '</div>';

        return $output;
    }

}

Clubix_Divider_Shortcode::get_instance();