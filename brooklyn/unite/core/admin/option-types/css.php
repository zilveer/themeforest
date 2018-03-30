<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * CSS Editor
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_css' ) ) {
  
    function ut_render_option_css( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );          
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-panel-for="' , esc_attr( $id ) , '">'; 
        
            echo '<label for="' , esc_attr( $id ) , '">' , $title , '</label>';        
            echo '<div data-mode="css" data-id="' , esc_attr( $id ) , '" id="' , esc_attr( $id ) , '_ace" class="ut-ace-editor">' , esc_attr( $value ) , '</div>';
            echo '<textarea rows="' , esc_attr( $rows ) , '" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" class="ut-full-width ut-hide ut-ace-textarea">' , esc_attr( $value ) , '</textarea>';
        
        echo '</div>';        
        
    }

}