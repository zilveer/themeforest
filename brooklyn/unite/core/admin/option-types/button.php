<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Button Designer
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
if ( ! function_exists( 'ut_render_option_button' ) ) {
    
    function ut_render_option_button( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="button" data-panel-for="' , esc_attr( $id ) , '">';
            
            echo '<table class="form-table">';
            
            echo '<thead>';
            
                echo '<tr>';
                                        
                    echo '<th>' . esc_html__( 'Border Style', 'unite-admin' ) .'</th>';
                    
                echo '</tr>';            
            
            echo '</thead>';
            
            
            
            
            
            
            
                
            
            
        echo '</div>';                
    
    }    
    
}