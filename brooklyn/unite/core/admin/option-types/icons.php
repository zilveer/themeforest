<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Icon Chooser
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_icons' ) ) {
  
    function ut_render_option_icons( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
                        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="select" data-panel-for="' , esc_attr( $id ) , '">';
                
        if( function_exists('ut_recognized_icons') ) {
            
            echo '<select class="ut-icon-select" id="' , esc_attr( $id ) , '" name="' , esc_attr( $name ) , '">';
                
                echo '<option value="">' . esc_html( 'Select Icon', 'unite' ) . '</option>';
                            
                foreach( ut_recognized_icons() as $key => $icon ) {

                     echo '<option value="fa ' , $icon , '" ' , selected( $value, 'fa ' . $icon, false ) , '>' , 'fa ' , $icon , '</option>';
                
                }
            
            echo '</select>';
        
        }
        
        echo '</div>';
    
    }

}