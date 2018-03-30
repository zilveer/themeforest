<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Checkbox
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_checkbox' ) ) {
  
    function ut_render_option_checkbox( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="checkbox" data-panel-for="' , esc_attr( $id ) , '">'; 
        
            echo '<label for="' , esc_attr( $id ) , '">' , $title , '</label>';
            
            /* loop through choices */
            if( !empty( $choices ) ) {
                
                foreach ( (array) $choices as $option => $label ) {
                    
                    echo '<label class="ut-checkbox">';
                        
                        echo '<input value="' , $option , '" name="' , esc_attr( $name ) , '[' . $option . ']" id="' , esc_attr( $id ) , '-' , esc_attr( $option ) , '" type="checkbox" ' , ( isset( $value[$option] ) ? checked( $value[$option], $option, false ) : '' ) , '>';                
                        echo '<span>' , ( !empty( $label ) ? $label : esc_html__( 'Untitled', 'unite-admin' ) ) , '</span>'; 
                        
                    echo '</label>';
                    
                }        
                
            }            
        
        echo '</div>';        
               
    }

}