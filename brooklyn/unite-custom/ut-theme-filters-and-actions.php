<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Extra Classs For Body
 *
 * @access    public 
 * @since     1.0.0
 * @version   1.0.0
 */ 
if ( ! function_exists( 'ut_body_classes' ) ) :

    function ut_body_classes( $classes ) {
        
        if( ot_get_option( 'ut_site_border', 'hide' ) == 'show' ) {
            $classes[] = 'ut-site-border';
        }
        
        if( ot_get_option( 'ut_top_header', 'hide' ) == 'show' ) {
            $classes[] = 'ut-has-top-header';
        }
        
        if( !is_front_page() && !is_home() && ( get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) == 'off' || !get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) ) ) {
            $classes[] = 'has-no-hero';
        }
        
        if( is_home() && !ut_return_hero_config('ut_hero_type') ) {
            $classes[] = 'has-no-hero';
        }        
                    
        return $classes;        
        
    }
    
    add_filter( 'body_class', 'ut_body_classes' );
    
endif;


/**
 * Loader Overlay Markup
 *
 * @access    public 
 * @since     4.1.0
 * @version   1.0.1
 */ 
 
if ( ! function_exists( 'ut_loader_overlay' ) ) :

    function ut_loader_overlay( $classes ) {
        
        if( ot_get_option( 'ut_use_image_loader' ) == 'on' ) {
					
            if( ut_dynamic_conditional( 'ut_use_image_loader_on' ) ) {
        
                echo '<div class="ut-loader-overlay"></div>';
                echo '<div id="qLoverlay"><div class="ut-inner-overlay"></div></div>';
            
            }
        
        }
        

        
        
    }
    
    add_action( 'ut_before_header_hook', 'ut_loader_overlay' );
    
endif;