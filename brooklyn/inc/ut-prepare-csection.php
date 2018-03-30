<?php

if( !function_exists('ut_return_csection_state') ) {

    function ut_return_csection_state( $csection_for ) {
                
        $csection_match = false;
        
        if( !empty( $csection_for ) && is_array( $csection_for ) ) :	
        
            foreach( $csection_for as $key => $conditional ) {
                                
                if( $conditional() && $conditional != 'is_singular' ) {

                    $csection_match = true;
                    
                    /* front page gets handeled as a page too */
                    if( $conditional == 'is_page' && is_front_page() ) {
                        
                        $csection_match = false;
                    
                    } elseif( $conditional == 'is_single' && is_singular('portfolio') ) {
                       
                        $csection_match = false;
                            
                    } else {
                    
                        /* we have a match , so we can stop the loop */
                        break;
                    
                    }
                    
                }
                
                if( $conditional('portfolio') && $conditional == 'is_singular' ) {
                    
                    $csection_match = true;
                    break;
                
                }                
            
            }
        
        endif;
        
        return $csection_match ? 'on' : 'off';  
    
    }
    
}

if( !function_exists('ut_return_csection_config') ) {

    function ut_return_csection_config( $option = '' , $fallback = '' , $single = true ) {
        
        /* no option has been set - leave here */
        if( empty( $option ) ) {
            return;
        }
        
        $option = trim( $option );
        
        /* store post ID for later use */
        $hero_post_id = !ut_is_shop() ? get_the_ID() : get_option( 'woocommerce_shop_page_id' );
        
        /* front and blog settings are stored inside the theme options */
        if( is_front_page() || is_home() || is_single() && !is_singular( 'portfolio' ) ) {
            
            if( $option == 'ut_activate_csection' ) {
                                
                $ut_activate_csection = ot_get_option( 'ut_activate_csection' );

                /* fallback */
                if( !is_array( $ut_activate_csection ) ) {
                                        
                    return $ut_activate_csection;
                    
                } else {               
                
                    return ut_return_csection_state( $ut_activate_csection );
                    
                }
                
            }            
            
            if( empty( $fallback ) && isset( $option ) ) {        
                return ot_get_option( $option );
            }
            
            elseif( !empty( $fallback ) && isset( $option ) ) {        
                return ot_get_option( $option , $fallback );
            }
            
            elseif( !empty( $fallback ) && !isset( $option ) ) {
                return $fallback;
            }
            
            else {
                return false;
            }
        
        /* page hero settings are provided by meta boxes*/        
        } else {
            
            /* option exceptions */
            if( $option == 'ut_activate_csection' ) {
            
                $ut_activate_csection = get_post_meta( $hero_post_id , $option , $single );
                
                if( $ut_activate_csection == 'global' || empty( $ut_activate_csection ) ) {
                    
                    $ut_activate_csection = ot_get_option( 'ut_activate_csection' );
                                        
                    /* fallback */
                    if( !is_array( $ut_activate_csection ) ) {
                                            
                        return $ut_activate_csection;
                    
                    } else {               
                    
                        return ut_return_csection_state($ut_activate_csection);
                        
                    }                    
                    
                } else {
                    
                    return $ut_activate_csection;
                
                }
            
            }            
            
            $value = get_post_meta( $hero_post_id , $option , $single );            
            
            /* check if theme default */
            if( $option == 'ut_show_scroll_up_button' ) {
                
                $ut_global = get_post_meta( $hero_post_id , 'ut_show_scroll_up_button' , $single );
                
            } else {
                
                $ut_global = get_post_meta( $hero_post_id , 'ut_activate_csection' , $single );
                
            }
            
            /* get all other options directly from meta */
            if( empty( $fallback ) && !empty($value) && $ut_global != 'global' ) {
                                                
                return $value;
                
            } 
            
            elseif( !empty( $fallback ) && !empty($value) && $ut_global != 'global' ) { 
                                                                
                return !empty( $value ) ? $value : $fallback;
                
            }
            
            /* let's check if a global inside the theme options panel is available */
            elseif( empty($value) && ot_get_option($option) != '' || $ut_global == 'global' && ot_get_option($option) != '') {
                
                $value = ot_get_option($option, $fallback);                
                return $value;
            
            } 
            
            elseif( !empty( $fallback ) && !isset( $option ) ) {

                return $fallback;
                            
            }
            
            else {
                
                return false;
                
            }        
        
        }
        
    }
    
} ?>