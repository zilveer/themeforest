<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Clubix_PLayer_Shortcode {

    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'clx_player', array( &$this, 'shortcode' ) );
    }

    public function shortcode( $atts ) {
        $output = $songs = '';

        extract( shortcode_atts( array(
            'songs'          => '',
        ), $atts ) );

        if ($songs == '') { $songs = array(); } else { $songs = explode(",", $songs); }

        $output .= '<div class="row"><div class="minimal-player">';
        $output .= clx_simple_song_player($songs);
        $output .= '</div></div>';

        return $output;
    }

}

Clubix_PLayer_Shortcode::get_instance();