<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


class SocialIcons {
    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_isocial', array( &$this, 'shortcode' ) );
    }

    public function shortcode( $atts, $content = null ) {
        $output = $icon = $href = $target = '';

        extract( shortcode_atts( array(
            'icon'         => 'fa-facebook',
            'href'         => '#',
            'target'       => '_blank',
        ), $atts ) );

        $output .= '<li><a href="'.$href.'" target="'.$target.'"><i class="fa '.$icon.'"></i></a></li>';

        return $output;
    }



}
SocialIcons::get_instance();