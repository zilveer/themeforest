<?php 

if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

if ( ! function_exists( 'unite_scripts' ) ) {

    function unite_scripts() {
        
        global $wp_query;
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
                
           
    }    
    
    add_action( 'wp_enqueue_scripts', 'unite_scripts' );
    
}