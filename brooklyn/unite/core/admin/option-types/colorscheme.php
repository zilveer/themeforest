<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Colorscheme Select
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_colorscheme' ) ) {
  
    function ut_render_option_colorscheme( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
                
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-panel-for="' , esc_attr( $id ) , '" data-optiontype="radio">'; 
            
             /* loop through choices */
            if( !empty( $choices ) ) {                
                
                foreach ( (array) $choices as $scheme => $info ) {
                   
                    echo '<div class="ut-color-scheme-box" data-scheme="' , $scheme , '">';
                          
                        echo '<input name="' , esc_attr( $name ) , '" id="' , $scheme , '" value="' , $info['file'] , '" type="radio" ' , checked( $value, $info['file'], false ) , '>';
                        echo '<label for="' , $scheme , '">';
                                                      
                            if( !empty( $info['palette'] ) ) {
                                               
                                echo '<table class="color-palette">';
                                    echo '<tbody>';
                                        echo '<tr>';
                                            
                                            foreach( $info['palette'] as $color ) {
                                                echo '<td style="background-color: ' , $color , '">&nbsp;</td>';
                                            }
        
                                        echo '</tr>';
                                    echo '</tbody>';
                                echo '</table>';
                            
                            }
                            
                        echo '<span class="ut-color-scheme-badge">' , $info['name'] , '</span>';
                    
                    echo '</label>';      
                    echo '</div>';
                    
                }                
                
            }
                
        
        echo '</div>';   
        
    }

}