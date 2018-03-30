<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/** 
 * CSS Color Settings
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists('_ut_theme_color_css') ) {

    function _ut_theme_color_css() {
        
        /* check transient css cache - no cache on WP_DEBUG */        
        $css = !WP_DEBUG ? get_transient( ut_transient_name( ut_options_key(), 'css' ) ) : false;
                
        if( !$css ) {
                
            ob_start(); ?>
            
            <style type="text/css">
                
            
            <?php
            
            $css = ob_get_clean();
            $css = apply_filters( 'ut_minify_css', $css );
                                                
            /* gets flushed on theme options save */
            set_transient( ut_transient_name( ut_options_key(), 'css' ), $css );            
            
        }
        
        echo $css;            
        
    }
    
    // add_action('wp_head' , '_ut_theme_color_css', 12 );
    
}