<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Textarea
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_textarea' ) ) {
  
    function ut_render_option_textarea( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="textarea" data-panel-for="' , esc_attr( $id ) , '">'; 

            echo '<textarea rows="' , esc_attr( $rows ) , '" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-full-width ut-option-element">' , esc_attr( $value ) , '</textarea>';
        
        echo '</div>';
         
    }

}