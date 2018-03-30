<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Colorpicker
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_colorpicker' ) ) {
  
    function ut_render_option_colorpicker( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
                
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="colorpicker" data-panel-for="' , esc_attr( $id ) , '">'; 
            
            echo '<input type="text" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" value="' , esc_attr( $value ) , '" class="ut-color-picker ut-option-element ut-color-mode-' , $mode , '" data-mode="' , $mode , '" />';            
            
            if( 'rgb' == $mode ) {
                
                echo '<span class="unite-tooltip"><a title="' . esc_html__( 'You can also insert HEX colors', 'unite-admin' ) . '" class="ut-backend-button" href="#">?</a></span>';    
                
            }
            
        echo '</div>';   
        
    }

}