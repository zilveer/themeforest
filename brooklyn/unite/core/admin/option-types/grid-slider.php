<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Grid Slider
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_grid_slider' ) ) {
  
    function ut_render_option_grid_slider( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="slider" data-panel-for="' , esc_attr( $id ) , '">';
            
            /* available grid sizes */
            $gridsizes = !empty( $config['gridsizes'] ) ? implode(',', $config['gridsizes'] ) : implode(',', array('40:60','50:50','60:40') ) ;
            
            $current_grid = !empty( $value ) ? explode( ':', $value ) : explode( ':', $default );
            
            /* box description */
            $leftdesc  = !empty( $config['left_desc'] )    ? esc_html( $config['left_desc'] ) : esc_html__( 'Left Box', 'unite-admin' );
            $rightdesc = !empty( $config['right_desc'] )   ? esc_html( $config['right_desc'] ) : esc_html__( 'Right Box', 'unite-admin' );
            
            echo '<div id="' , esc_attr( $id ) , '-preview" class="ut-grid-preview grid-parent">';
                
                echo '<div class="grid-' , ( $current_grid[0] ) , ' ut-grid-preview-left">';
                    echo '<div class="ut-grid-preview-item">';
                        echo $leftdesc , '<span>' , $current_grid[0] , '</span>';
                    echo '</div>';
                echo '</div>';
                
               echo '<div class="grid-' , ( $current_grid[1] ) , ' ut-grid-preview-right">';
                    echo '<div class="ut-grid-preview-item">';
                        echo $rightdesc , '<span>' , $current_grid[1] , '</span>';
                    echo '</div>';
                echo '</div>';
                
                echo '<div class="clear"></div>';    
                
            echo '</div>';
            
            echo '<div class="ut-grid-slider-wrap">';
                
                echo '<div class="ut-grid-slider" data-id="' , esc_attr( $id ) , '" data-gridsizes="' , $gridsizes , '" data-value="' , esc_attr( $value ) , '"></div>';
                
            echo '</div>';
            
            echo '<input type="text" name="' , esc_attr( $name ) , '" id="' , esc_attr( $id ) , '" value="' , esc_attr( $value ) , '" class="widefat ut-hide ut-option-element" />';
                
        echo '</div>';
    
    }

}