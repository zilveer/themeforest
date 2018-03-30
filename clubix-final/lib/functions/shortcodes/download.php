<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_Download_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_dwn', array( &$this, 'download_shortcode' ) );
    }

    public function download_shortcode( $atts , $content = null) {
        $output = $image = $icon  = $text = $link = '';

        extract( shortcode_atts( array(
            'image'         => '',
            'icon'          => 'fa-cloud-download',
            'text'          => 'Download!',
            'link'          => '#'
        ), $atts ) );

        $url = wp_get_attachment_image_src($image, 'front_boxes');

        $output .= '<figure class="feature"><a href="'.$link.'">';
        $output .= '<span class="bg-feature"></span><div class="container-feature"><div class="content-feature">';
        $output .= '<i class="fa '.$icon.'"></i>';
        $output .= '<h4>'.$text.'</h4></div></div>';
        $output .= '<figcaption><img src="'.$url[0].'" alt=""></figcaption>';
        $output .= '</a></figure>';

        return $output;
    }
}

Clubix_Download_Shortcode::get_instance();