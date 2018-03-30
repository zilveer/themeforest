<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Info Box to seperate Sections
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
if ( ! function_exists( 'ut_render_option_info' ) ) {
    
    function ut_render_option_info( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<section class="ut-admin-panel-info ' , esc_attr( $class ) , '" ' . $dependency . ' data-optiontype="text" data-panel-for="' , esc_attr( $id ) , '">';
            
            echo '<h4>' . esc_html( $title ) . '</h4>';
            
            if( !empty( $desc ) ) {
                echo '<span>' . esc_html( $desc ) . '</span>';                
            }
            
        echo '</section>';
                
    
    }    
    
}