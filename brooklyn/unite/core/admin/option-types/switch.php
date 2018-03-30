<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Switch
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( ! function_exists( 'ut_render_option_switch' ) ) {
  
    function ut_render_option_switch( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );        
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="switch" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            echo '<div class="ut-switch" data-on="' , $labels['on'] ,  '" data-off="' , $labels['off'] ,  '">';
               
                echo '<input name="' , esc_attr( $name ) , '" type="checkbox" id="' . esc_attr( $id ) . '" ' , ( isset( $value ) ? checked( 'on', $value ) : '' ) ,' />';               
                echo '<label for="' , esc_attr( $id ) , '"></label>';
                
            echo '</div>';
        
        echo '</div>';
               
    }

}