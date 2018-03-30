<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Lists_Shortcode{

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_list', array( &$this, 'list_shortcode' ) );
        add_shortcode( 'clx_list_item', array( &$this, 'list_item_shortcode' ) );
    }

    public function list_shortcode($atts, $content = null) {
        $output = $type = $color = '';

        extract( shortcode_atts( array(
            /*
             * Type can be "default-list" or "primary-list"
             */
            'type'          => 'default-list',
            'color'         => ''
        ), $atts ) );

        if(strpos($type, 'default-list') != false){
            $output .= '<nav class="'.$type.'"><ul>';
            $output .= do_shortcode($content);
        }
        else{
            $output .= '<nav class="'.$type.'" data-icons-color="'.$color.'"><ul>';
            $output .= do_shortcode($content);
        }

        $output .= '</ul></nav>';


        return $output;
    }

    public function list_item_shortcode($atts, $content = null){
        $output = $element = $link = $icon = '';

        extract( shortcode_atts( array(
            'element'          => 'Element list',
            'link'             => '',
            'icon'             => 'fa-check'
        ), $atts ) );

        $output .= '<li><a href="'.$link.'"> <i class="fa '.$icon.'"></i> '.$element.' </a></li>';

        return $output;
    }
}

Clubix_Lists_Shortcode::get_instance();
