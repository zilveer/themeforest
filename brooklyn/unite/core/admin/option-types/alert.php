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
if ( ! function_exists( 'ut_render_option_alert' ) ) {
    
    function ut_render_option_alert( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<section class="ut-admin-panel ' , $grid , ' clearfix">';
        
            echo '<header class="ut-admin-panel-header"><h3 class="ut-admin-panel-header-title">' . esc_html( $title ) . '</header>';
            
            echo '<div class="ut-alert ' , esc_attr( $class ) , '">';
                
                if( !empty( $desc ) ) {
                    echo $desc;
                }
                
            echo '</div>';
        
        echo '</section>';        
    
    }    
    
}