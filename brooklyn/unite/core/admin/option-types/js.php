<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * JS Editor
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_js' ) ) {
  
    function ut_render_option_js( $settings = array() ) {
        
        /* extract variables */
        extract( $settings ); 
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="textarea" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            echo '<label for="' , esc_attr( $id ) , '">' , $title , '</label>';        
            echo '<div data-mode="javascript" data-id="' , esc_attr( $id ) , '" id="' , esc_attr( $id ) , '_ace" class="ut-ace-editor">' ,  stripslashes( $value ) , '</div>';        
            echo '<textarea rows="' , esc_attr( $rows ) , '" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-full-width ut-hide ut-ace-textarea">' , stripslashes( $value ) , '</textarea>';
            
        echo '</div>';  
        
    }

}