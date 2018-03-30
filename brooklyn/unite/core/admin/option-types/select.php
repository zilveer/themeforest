<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Select
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_select' ) ) {
  
    function ut_render_option_select( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );        
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="select" data-panel-for="' , esc_attr( $id ) , '">'; 
            
            echo '<div class="ut-select">';
            
                echo '<select autocomplete="off" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-option-element">';
                                
                /* loop through choices */
                if( !empty( $choices ) ) {
                    
                    foreach ( (array) $choices as $option => $label ) {
                        
                        echo '<option value="' , esc_attr( $option ) , '" ' , selected( $value, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                        
                    }        
                    
                }
                
                echo '</select>';
                
            echo '</div>';
            
            if( !empty( $info ) ) {
                
                echo '<div class="clear"></div>';
                    
                echo '<div class="ut-alert ut-alert-info">' , $info , '</div>';
                
            }
            
        echo '</div>'; 
            
    }

}