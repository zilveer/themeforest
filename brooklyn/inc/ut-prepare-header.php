<?php

if( !function_exists('ut_return_header_config') ) {

    function ut_return_header_config( $option = '' , $fallback = '' , $single = true ) {
        
        /* no option has been set - leave here */
        if( empty( $option ) ) {
            return;
        }
        
        $option = trim( $option );
        
        if( is_front_page() ) {
            
            if( ot_get_option('ut_front_navigation_config', 'on' ) != 'off' ) {
                
                return ot_get_option( $option, $fallback );    
                
            }
            
            $glob_key = $option;
            $option = str_replace('ut_', 'ut_front_', $option );
            
            return ot_get_option( $option, ot_get_option( $glob_key ) );
        
        } elseif( is_home() ) {
            
            if( ot_get_option('ut_blog_navigation_config', 'on' ) != 'off' ) {
                
                return ot_get_option( $option, $fallback );    
                
            }
            
            $glob_key = $option;
            $option = str_replace('ut_', 'ut_blog_', $option );
            
            return ot_get_option( $option, ot_get_option( $glob_key ) );            
            
            
        } elseif( is_single() && !is_singular('portfolio') ) {
            
            
            return ot_get_option( $option, $fallback );    
            
        
        } else {
            
            return ot_get_option( $option, $fallback );
            
            /* @todo
            global $post;        
            
            /* check if we use globals or not 
            if( get_post_meta( $post->ID, 'ut_navigation_config', true ) == 'on' || !get_post_meta( $post->ID, 'ut_navigation_config', true ) ) {
                
                return ot_get_option( $option, $fallback );
            
            }
            
            return get_post_meta( $post->ID, $option, $single );
            */
        
        }
        
    }
    
}