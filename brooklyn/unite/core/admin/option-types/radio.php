<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Radio
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_radio' ) ) {
  
    function ut_render_option_radio( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="radio" data-panel-for="' , esc_attr( $id ) , '">'; 
                        
            /* loop through choices */
            if( !empty( $choices ) ) {
                
                foreach ( (array) $choices as $option => $label ) {
                    
                    echo '<label class="ut-radio"><input class="ut-option-element" type="radio" value="' , esc_attr( $option ) , '" name="' , esc_attr( $name ) , '" ' , checked( $value, $option, false ) , ' />' , esc_attr( $label ) , '</label>';
                    
                }        
                
            }
        
        echo '</div>'; 
        
    }

}