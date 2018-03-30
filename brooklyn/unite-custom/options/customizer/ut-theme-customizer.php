<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

if( !function_exists('ut_theme_customizer') ) { 
    
    function ut_theme_customizer( $ut_customizer_options = array() ) {
        
        
        $ut_customizer_options[] = array(
        
        );
        
        //return $ut_customizer_options;
    
    }
    
    add_filter( 'unite_customizer_options', 'ut_theme_customizer' );

}