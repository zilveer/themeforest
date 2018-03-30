<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Text
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_text' ) ) {
  
    function ut_render_option_text( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );

        $dependency = ut_create_dependency( $settings['required'] );        
                   
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="text" data-panel-for="' , esc_attr( $id ) , '">';    
             
            echo '<input type="text" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" value="' , esc_attr( $value ) , '" class="ut-' , $width , '-width ut-option-element" />';
            
            if( !empty( $addon ) ) {
            
                echo '<div class="ut-input-addon">' , $addon , '</div>';
            
            }            
            
        echo '</div>';
           
        
    }

}