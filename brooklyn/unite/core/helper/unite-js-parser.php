<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}


/** 
 * Simple JavaScript Minifier
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( !function_exists( '_ut_compress_java' ) ) {

	function _ut_compress_java( $buffer ) {
		
		/* remove comments */
		$buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
		/* remove tabs, spaces, newlines, etc. */
		$buffer = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $buffer);
		/* remove other spaces before/after ) */
		$buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
	
		return $buffer;
		
	}
    
    add_filter( 'ut_theme_js_parser', '_ut_compress_java' );

}


/** 
 * Parses JS fields from Theme Options into the Theme Footer
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
 
if( !function_exists('_ut_theme_js_parser') ) {

    function _ut_theme_js_parser() {
        
        $js = NULL;
        
        /* get theme options array */
        $theme_options = ut_theme_options();
        
        /* get saved theme options array */
        $saved_options = get_option( ut_options_key() );        
                        
        if( !empty( $theme_options['settings'] )  && is_array( $theme_options['settings'] ) ) {
            
            foreach( (array) $theme_options['settings'] as $settings_key => $setting ) {
                
                if( isset( $setting['type'] ) && $setting['type'] ==='js' ) {
                    
                    /* get saved option */
                    if( !empty( $saved_options ) && is_array( $saved_options ) ) {
                        
                        foreach( (array) $saved_options as $options_key => $option ) {
                            
                            /* we have a match */
                            if( $setting['id'] == $options_key && !empty( $option ) ) {
                                
                                $js .= $option;
                                
                            }
                            
                        }
                    
                    }
                
                }                
                
            }
            
        }
        
        if( !WP_DEBUG ) {
        
            echo apply_filters( 'ut_theme_js_parser', $js );
        
        } else {
            
            echo $js;
        
       }
        
    }
    
    add_action( 'ut_footer_java_hook', '_ut_theme_js_parser', 100 );
    
}