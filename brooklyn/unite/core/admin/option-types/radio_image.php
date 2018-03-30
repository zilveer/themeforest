<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Radio Image
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_radio_image' ) ) {
  
    function ut_render_option_radio_image( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="radio" data-panel-for="' , esc_attr( $id ) , '">'; 
                        
            /* loop through choices */
            if( !empty( $choices ) ) {                
                
                foreach ( (array) $choices as $option => $label ) {
                    
                    echo '<div class="ut-image-radio-wrap">';
                    
                        echo '<input id="' , esc_attr( $id ) , '-' , esc_attr( $option ) , '" class="ut-option-element ut-image-radio" type="radio" value="' , esc_attr( $option ) , '" name="' , esc_attr( $name ) , '" ' , checked( $value, $option, false ) , ' />';
                        echo '<label for="' , esc_attr( $id ) , '-' , esc_attr( $option ) , '" class="ut-image-radio-label">';
                            echo '<img alt="' , esc_attr( $label['name'] ) , '" src="' , esc_url( THEME_WEB_ROOT . '/unite-custom/options/img/' . $label['image'] ) , '" />';
                        echo '</label>';
                        
                        echo '<div class="ut-image-radio-checked"></div>';
                        echo '<div class="ut-image-radio-description">' , esc_html( $label['name'] ) , '</div>';
                        
                    echo '</div>';
                    
                }                
                
            }
        
        echo '</div>'; 
        
    }

}