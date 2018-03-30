<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Measurement
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( 'ut_render_option_measurement' ) ) {
  
    function ut_render_option_measurement( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
       // @todo
        
    
    }

}