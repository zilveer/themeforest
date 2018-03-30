<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Datepicker
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( 'ut_render_option_datepicker' ) ) {
  
    function ut_render_option_datepicker( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        // @todo
        
    
    }

}