<?php
/**
 * Minimal Graphical Skin Class
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @deprecated Since 1.6.0
 */


if ( ! class_exists( 'Total_Minimal_Graphical_Skin' ) ) {
    
    class Total_Minimal_Graphical_Skin {

        /**
         * Main constructor
         */
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'load_styles' ), 999 );
        }

        /**
         * Load custom stylesheet for this skin
         */
        public function load_styles() {
            wp_enqueue_style( 'minimal-graphical-skin', WPEX_SKIN_DIR_URI .'classes/minimal-graphical/css/minimal-graphical-style.css', array( 'wpex-style' ), '1.0', 'all' );
        }

    }

}
$wpex_minimal_graphical_skin = new Total_Minimal_Graphical_Skin();