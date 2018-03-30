<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}
 
if( !function_exists('ut_theme_options') ) { 
    
    function ut_theme_options( $ut_theme_options = array() ) {
        
        /* remove default theme options array */
        $ut_theme_options = array();
       
        return $ut_theme_options;
        
    }
    
    add_filter( 'unite_framework_theme_settings', 'ut_theme_options' );
    
}