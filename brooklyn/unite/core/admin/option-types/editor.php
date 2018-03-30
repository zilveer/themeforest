<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Editor
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_editor' ) ) {
  
    function ut_render_option_editor( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        /* editor config */
        $config = array(
            'drag_drop_upload'  => true,
            'textarea_name'     => esc_attr( $name ),
            'textarea_rows'     => esc_attr( $rows )
        ); 
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="textarea" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            echo '<label for="' , esc_attr( $id ) , '">' , $title , '</label>';
            
            /* build editor */        
            wp_editor( $value, esc_attr( $id ), $config );        
        
        echo '</div>';
                    
    }

}


