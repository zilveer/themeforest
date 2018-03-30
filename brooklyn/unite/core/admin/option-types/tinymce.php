<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Tiny MCE
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
if ( ! function_exists( 'ut_render_option_tinymce' ) ) {
  
    function ut_render_option_tinymce( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="textarea" data-panel-for="' , esc_attr( $id ) , '">'; 
            
            wp_editor( 
                $value, 
                esc_attr( $id ), 
                array(
                    'wpautop'       => false,
                    'media_buttons' => true,
                    'textarea_name' => esc_attr( $name ),
                    'textarea_rows' => esc_attr( $rows ),
                    'tinymce'       => true,              
                ) 
            );
            
        echo '</div>';
         
    }

}