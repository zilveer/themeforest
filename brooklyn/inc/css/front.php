<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'UT_Front_CSS' ) ) {	
    
    class UT_Front_CSS {
        
        private $css;
        
        function __construct() {
            
            add_action('wp_head' , array( $this, 'custom_css' ) ); 
            
        }        
        
        public function custom_css() {
            
            if( !is_front_page() ) {
                return;
            }
                        
            /* global accent color */
            $accentcolor = get_option('ut_accentcolor' , '#F1C40F');
            
            /**
             * Hero Scroll Down
             */
            
            if( ot_get_option('ut_front_hero_down_arrow_color') ) {
                $this->css .= '#ut-hero .hero-down-arrow a { color: ' . ot_get_option('ut_front_hero_down_arrow_color') . '; }';
            }
            
            if( ot_get_option('ut_front_hero_down_arrow_scroll_position') != '' ) {
                $this->css .= '#ut-hero .hero-down-arrow { left: ' . ot_get_option('ut_front_hero_down_arrow_scroll_position') . '%; }';
            }
            
            if( ot_get_option('ut_front_hero_down_arrow_scroll_position_vertical') != '' ) {
                $this->css .= '#ut-hero .hero-down-arrow { bottom: ' . ot_get_option('ut_front_hero_down_arrow_scroll_position_vertical') . 'px; }';
            }
 
            /* output css */
            echo ut_minify_css( '<style type="text/css">' . $this->css . '</style>' );
        
        }  
            
    }

}

new UT_Front_CSS;