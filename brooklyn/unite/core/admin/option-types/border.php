<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Border
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
if ( ! function_exists( 'ut_render_option_border' ) ) {
  
    function ut_render_option_border( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
                
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="border" data-panel-for="' , esc_attr( $id ) , '">';
            
            echo '<table class="form-table">';
            
            echo '<thead>';
            
                echo '<tr>';
                
                    echo '<th></th>';
                    
                    if( !in_array('border-styles', $disable ) ) {
                    
                        echo '<th>' . esc_html__( 'Border Style', 'unite-admin' ) .'</th>';
                    
                    }
                    
                    if( !in_array('border-width', $disable ) ) {
                    
                        echo '<th>' . esc_html__( 'Border Width', 'unite-admin' ) .'</th>';
                    
                    }
                    
                    if( !in_array('border-color', $disable ) ) {  
                    
                        echo '<th>' . esc_html__( 'Border Color', 'unite-admin' ) .'</th>';
                    
                    }
                    
                echo '</tr>';            
            
            echo '</thead>';
            
            if( !in_array('border-top', $disable ) ) {            
                
                echo '<tr>';
                    
                    echo '<td>' . esc_html__( 'Border Top', 'unite-admin' ) .':</td>';
                                    
                    /* Border Style */ 
                    if( !in_array( 'border-styles', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Style', 'unite-admin' ) .'">';
                        
                            $border_styles = _ut_recognized_border_styles();
                            
                            echo '<div class="ut-select">';
                            
                                echo '<select name="' , esc_attr( $name ) , '[border-top][border-top-style]" id="' , esc_attr( $id ) , '-border-top-style" class="ut-option-element">';
                                
                                echo '<option value="">' . esc_html__( 'border-style', 'unite-admin' ) . '</option>';
                                
                                /* loop through background repeat choices */
                                if( !empty( $border_styles ) ) {
                                    
                                    $border_top_style = isset( $value['border-top']['border-top-style'] ) ? esc_attr( $value['border-top']['border-top-style'] ) : '';
                                    
                                    foreach ( (array) $border_styles as $option => $label ) {
                                        
                                        echo '<option value="' , esc_attr( $option ) , '" ' , selected( $border_top_style, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                        
                                    }
                                    
                                }
                                
                                echo '</select>';
                            
                            echo '</div>';
                        
                        echo '</td>';   
                        
                    }
                    
                    /* Border Width  */ 
                    if( !in_array( 'border-width', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Width', 'unite-admin' ) .'">';
                        
                            $border_top_width = isset( $value['border-top']['border-top-width'] ) ? esc_attr( $value['border-top']['border-top-width'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-top][border-top-width]" id="' , esc_attr( $id ) , '-border-top-width" value="' , esc_attr( $border_top_width ) , '" class="ut-option-element ut-tiny-width" /><div class="ut-input-addon">px</div>'; 
                        
                        echo '</td>';
                        
                    }
                    
                    /* Colorpicker */
                    if( !in_array( 'border-color', $disable ) ) {            
                        
                        echo '<td data-label="' . esc_html__( 'Border Color', 'unite-admin' ) .'">';     
                        
                            $border_top_color = isset( $value['border-top']['border-top-color'] ) ? esc_attr( $value['border-top']['border-top-color'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-top][border-top-color]" id="' , esc_attr( $id ) , '-border-top-color" value="' , esc_attr( $border_top_color ) , '" class="ut-color-picker ut-option-element ut-color-mode-' , $mode , '" data-mode="' , $mode , '" />';  
                        
                        echo '</td>';
                    
                    }
                
                echo '</tr>';
            
            }
            
            if( !in_array('border-right', $disable ) ) {            
                
                echo '<tr>';
                    
                    echo '<td>' . esc_html__( 'Border Right', 'unite-admin' ) .':</td>';
                                    
                    /* Border Style */ 
                    if( !in_array( 'border-styles', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Style', 'unite-admin' ) .'">';
                        
                            $border_styles = _ut_recognized_border_styles();
                            
                            echo '<div class="ut-select">';
                            
                                echo '<select name="' , esc_attr( $name ) , '[border-right][border-right-style]" id="' , esc_attr( $id ) , '-border-right-style" class="ut-option-element">';
                                
                                echo '<option value="">' . esc_html__( 'border-style', 'unite-admin' ) . '</option>';
                                
                                /* loop through background repeat choices */
                                if( !empty( $border_styles ) ) {
                                    
                                    $border_right_style = isset( $value['border-right']['border-right-style'] ) ? esc_attr( $value['border-right']['border-right-style'] ) : '';
                                    
                                    foreach ( (array) $border_styles as $option => $label ) {
                                        
                                        echo '<option value="' , esc_attr( $option ) , '" ' , selected( $border_right_style, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                        
                                    }
                                    
                                }
                                
                                echo '</select>';
                            
                            echo '</div>';
                        
                        echo '</td>';   
                        
                    }
                    
                    /* Border Width  */ 
                    if( !in_array( 'border-width', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Width', 'unite-admin' ) .'">';
                        
                            $border_right_width = isset( $value['border-right']['border-right-width'] ) ? esc_attr( $value['border-right']['border-right-width'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-right][border-right-width]" id="' , esc_attr( $id ) , '-border-right-width" value="' , esc_attr( $border_right_width ) , '" class="ut-option-element ut-tiny-width" /><div class="ut-input-addon">px</div>';
                        
                        echo '</td>';
                        
                    }
                    
                    /* Colorpicker */
                    if( !in_array( 'border-color', $disable ) ) {            
                        
                        echo '<td data-label="' . esc_html__( 'Border Color', 'unite-admin' ) .'">';     
                        
                            $border_right_color = isset( $value['border-right']['border-right-color'] ) ? esc_attr( $value['border-right']['border-right-color'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-right][border-right-color]" id="' , esc_attr( $id ) , '-border-right-color" value="' , esc_attr( $border_right_color ) , '" class="ut-color-picker ut-option-element ut-color-mode-' , $mode , '" data-mode="' , $mode , '" />';  
                        
                        echo '</td>';
                    
                    }
                
                echo '</tr>';
            
            }
            
            if( !in_array('border-bottom', $disable ) ) {            
                
                echo '<tr>';
                    
                    echo '<td>' . esc_html__( 'Border Bottom', 'unite-admin' ) .':</td>';
                                    
                    /* Border Style */ 
                    if( !in_array( 'border-styles', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Style', 'unite-admin' ) .'">';
                        
                            $border_styles = _ut_recognized_border_styles();
                            
                            echo '<div class="ut-select">';
                            
                                echo '<select name="' , esc_attr( $name ) , '[border-bottom][border-bottom-style]" id="' , esc_attr( $id ) , '-border-bottom-style" class="ut-option-element">';
                                
                                echo '<option value="">' . esc_html__( 'border-style', 'unite-admin' ) . '</option>';
                                
                                /* loop through background repeat choices */
                                if( !empty( $border_styles ) ) {
                                    
                                    $border_bottom_style = isset( $value['border-bottom']['border-bottom-style'] ) ? esc_attr( $value['border-bottom']['border-bottom-style'] ) : '';
                                    
                                    foreach ( (array) $border_styles as $option => $label ) {
                                        
                                        echo '<option value="' , esc_attr( $option ) , '" ' , selected( $border_bottom_style, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                        
                                    }
                                    
                                }
                                
                                echo '</select>';
                            
                            echo '</div>';
                        
                        echo '</td>';   
                        
                    }
                    
                    /* Border Width  */ 
                    if( !in_array( 'border-width', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Width', 'unite-admin' ) .'">';
                        
                            $border_bottom_width = isset( $value['border-bottom']['border-bottom-width'] ) ? esc_attr( $value['border-bottom']['border-bottom-width'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-bottom][border-bottom-width]" id="' , esc_attr( $id ) , '-border-bottom-width" value="' , esc_attr( $border_bottom_width ) , '" class="ut-option-element ut-tiny-width" /><div class="ut-input-addon">px</div>';
                        
                        echo '</td>';
                        
                    }
                    
                    /* Colorpicker */
                    if( !in_array( 'border-color', $disable ) ) {            
                        
                        echo '<td data-label="' . esc_html__( 'Border Color', 'unite-admin' ) .'">';     
                        
                            $border_bottom_color = isset( $value['border-bottom']['border-bottom-color'] ) ? esc_attr( $value['border-bottom']['border-bottom-color'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-bottom][border-bottom-color]" id="' , esc_attr( $id ) , '-border-bottom-color" value="' , esc_attr( $border_bottom_color ) , '" class="ut-color-picker ut-option-element ut-color-mode-' , $mode , '" data-mode="' , $mode , '" />';  
                        
                        echo '</td>';
                    
                    }
                
                echo '</tr>';
            
            }
            
            if( !in_array('border-left', $disable ) ) {            
                
                echo '<tr>';
                    
                    echo '<td>' . esc_html__( 'Border Left', 'unite-admin' ) .':</td>';
                                    
                    /* Border Style */ 
                    if( !in_array( 'border-styles', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Style', 'unite-admin' ) .'">';
                        
                            $border_styles = _ut_recognized_border_styles();
                            
                            echo '<div class="ut-select">';
                            
                                echo '<select name="' , esc_attr( $name ) , '[border-left][border-left-style]" id="' , esc_attr( $id ) , '-border-left-style" class="ut-option-element">';
                                
                                echo '<option value="">' . esc_html__( 'border-style', 'unite-admin' ) . '</option>';
                                
                                /* loop through background repeat choices */
                                if( !empty( $border_styles ) ) {
                                    
                                    $border_left_style = isset( $value['border-left']['border-left-style'] ) ? esc_attr( $value['border-left']['border-left-style'] ) : '';
                                    
                                    foreach ( (array) $border_styles as $option => $label ) {
                                        
                                        echo '<option value="' , esc_attr( $option ) , '" ' , selected( $border_left_style, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                        
                                    }
                                    
                                }
                                
                                echo '</select>';
                            
                            echo '</div>';
                        
                        echo '</td>';   
                        
                    }
                    
                    /* Border Width  */ 
                    if( !in_array( 'border-width', $disable ) ) {
                        
                        echo '<td data-label="' . esc_html__( 'Border Width', 'unite-admin' ) .'">';
                            
                            $border_left_width = isset( $value['border-left']['border-left-width'] ) ? esc_attr( $value['border-left']['border-left-width'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-left][border-left-width]" id="' , esc_attr( $id ) , '-border-left-width" value="' , esc_attr( $border_left_width ) , '" class="ut-option-element ut-tiny-width" /><div class="ut-input-addon">px</div>';
                        
                        echo '</td>';
                        
                    }
                    
                    /* Colorpicker */
                    if( !in_array( 'border-color', $disable ) ) {            
                        
                        echo '<td data-label="' . esc_html__( 'Border Color', 'unite-admin' ) .'">';  
                        
                            $border_left_color = isset( $value['border-left']['border-left-color'] ) ? esc_attr( $value['border-left']['border-left-color'] ) : '';
                            echo '<input type="text" name="' , esc_attr( $name ) , '[border-left][border-left-color]" id="' , esc_attr( $id ) , '-border-left-color" value="' , esc_attr( $border_left_color ) , '" class="ut-color-picker ut-option-element ut-color-mode-' , $mode , '" data-mode="' , $mode , '" />';  
                        
                        echo '</td>';
                    
                    }
                
                echo '</tr>';
            
            }
            
            echo '</table>';
        
        echo '</div>';
        
    }

}