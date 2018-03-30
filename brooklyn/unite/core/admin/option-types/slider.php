<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Simple Slider
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_slider' ) ) {
  
    function ut_render_option_slider( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
                
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="slider" data-panel-for="' , esc_attr( $id ) , '">';
                            
            /* config */            
            $min   = !empty($config['min'])   ? $config['min']   : '0';
            $max   = !empty($config['max'])   ? $config['max']   : '1';
            $step  = !empty($config['step'])  ? $config['step']  : '0.1';
                        
            echo '<div class="ut-range-slider-wrap">';
                echo '<div class="ut-range-slider" data-min="' . $min . '" data-max="' . $max . '" data-step="' . $step . '" data-value="' . $value . '"></div>';
                echo '<span class="ut-range-value">' , esc_attr( $value ) , '</span>';
                echo '<input type="text" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" value="' , esc_attr( $value ) , '" class="widefat ut-hide ut-option-element" />';
            echo '</div>';
            
        echo '</div>';
    
    }

}