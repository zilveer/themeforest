<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Typography
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_typography' ) ) {
  
    function ut_render_option_typography( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="typography" data-panel-for="' , esc_attr( $id ) , '">';
            
            /* font color */  
            if( !in_array( 'color', $disable ) ) {
                
                 echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Color:', 'unite-admin' ) , '</legend>';
                    
                    $color = isset( $value['color'] ) ? esc_attr( $value['color'] ) : '';
                    
                    echo '<input type="text" name="' , esc_attr( $name ) , '[color]" id="' , esc_attr( $id ) , '-color" value="' , $color , '" class="ut-color-picker ut-option-element" />';
                
                echo '</fieldset>';
                
            }
            
            /* font familiy */
            if( !in_array('font-family', $disable ) ) {
                
                $font_families = _ut_recognized_font_families();
                
                echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Family:', 'unite-admin' ) , '</legend>';
                    
                    echo '<div class="ut-select">';
                    
                        echo '<select data-group="' , esc_attr( $id ) , '" name="' , esc_attr( $name ) , '[font-family]" id="' , esc_attr( $id ) , '-family" class="ut-option-element ut-font-select">';
                        
                            echo '<option value="">' . esc_html__( 'font-family', 'unite-admin' ) . '</option>';
                            
                            /* loop through font families */
                            if( !empty( $font_families ) ) {
                                
                                $fontfamily = isset( $value['font-family'] ) ? esc_attr( $value['font-family'] ) : '';
                                
                                foreach ( (array) $font_families as $option => $label ) {
                                    
                                    /* apply google font config if necessary */
                                    if( apply_filters( 'ut_google_fonts', true ) ) {
                                        
                                        /* get font collection */
                                        $google_fonts = get_option( 'unite_installed_google_fonts' );
                                        
                                        /* default values */
                                        $match_font = false;
                                                                         
                                        if( is_array( $google_fonts ) && !empty( $google_fonts ) ) {
                                            
                                            foreach( $google_fonts as $font => $settings ) {
                                                
                                                if( $font === $option ) {
                                                    
                                                    /* we have a match */
                                                    $match_font = true;
        
                                                    /* variants */
                                                    $variants = !empty( $settings['variants'] ) && is_array( $settings['variants'] ) ? implode( ',', $settings['variants'] ) : '';                                            
                                                    
                                                    echo '<option data-font-type="google" data-variants="' , $variants , '" value="' , esc_attr( $option ) , '" ' , selected( $fontfamily, $option, false ) , '>' , esc_attr( $label ) , '</option>';                                            
                                                
                                                }
                                                   
                                            }
                                            
                                        }
                                        
                                        if( !$match_font ) {
                                        
                                            echo '<option data-font-type="web" data-variants="' . implode( ',', array_keys( _ut_recognized_font_weights() ) )  . '" value="' , esc_attr( $option ) , '" ' , selected( $fontfamily, $option, false ) , '>' , esc_attr( $label ) , '</option>';
                                        
                                        }
                                        
                                    } else {
                                            
                                        echo '<option data-font-type="web" data-variants="' . implode( ',', array_keys( _ut_recognized_font_weights() ) )  . '" value="' , esc_attr( $option ) , '" ' , selected( $fontfamily, $option, false ) , '>' , esc_attr( $label ) , '</option>';
                                    
                                    }
                                    
                                }
                                
                            }                
                        
                        echo '</select>';
                    
                    echo '</div>';
                
                echo '</fieldset>';
                
            }
            
            /* font weight */
            if( !in_array( 'font-weight', $disable ) ) {
                
                 echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Weight:', 'unite-admin' ) , '</legend>';
                    
                    $font_weights = _ut_recognized_font_weights();
                    
                    echo '<div class="ut-select ut-select-small">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[font-weight]" id="' , esc_attr( $id ) , '-font-weight" class="ut-option-element">';
                            
                            echo '<option value="">' . esc_html__( 'font-weight', 'unite-admin' ) . '</option>';
                            
                             /* loop through font weights */
                            if( !empty( $font_weights ) ) {                        
                                
                                $fontweight = isset( $value['font-weight'] ) ? esc_attr( $value['font-weight'] ) : '';
                                
                                foreach ( (array) $font_weights as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $fontweight, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                }                        
                                
                            }                    
                            
                        echo '</select>';
                    
                    echo '</div>';
                
                echo '</fieldset>';    
                
            }
            
            /* font familiy */
            if( !in_array('font-size', $disable ) ) {
                
                echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Size:', 'unite-admin' ) , '</legend>';
                    
                    $font_size = isset( $value['font-size'] ) ? esc_attr( $value['font-size'] ) : '';
                    
                    echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '[font-size]" id="' , esc_attr( $id ) , '" value="' , esc_attr( $font_size ) , '" class="ut-option-element ut-tiny-width" />';                
                    
                    $font_units = _ut_recognized_font_size_units();
                    
                    echo '<div class="ut-select">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[font-size-unit]" id="' , esc_attr( $id ) , '-size-unit" class="ut-option-element">';
                            
                            echo '<option value="">' . esc_html__( 'font-size', 'unite-admin' ) . '</option>';
                            
                             /* loop through font weights */
                            if( !empty( $font_units  ) ) {                        
                                
                                $fontunit = isset( $value['font-size-unit'] ) ? esc_attr( $value['font-size-unit'] ) : '';
                                
                                foreach ( (array) $font_units as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $fontunit, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                }                        
                                
                            }  
                            
                        echo '</select>';
                    
                    echo '</div>';
                
                echo '</fieldset>';
                
            }
            
            /* line height */
            if( !in_array('line-height', $disable ) ) {
                
                echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Line Height:', 'unite-admin' ) , '</legend>';
                    
                    $line_height = isset( $value['line-height'] ) ? esc_attr( $value['line-height'] ) : '';
                    
                    echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '[line-height]" id="' , esc_attr( $id ) , '" value="' , esc_attr( $line_height ) , '" class="ut-option-element ut-tiny-width" />'; 
                    
                    $line_height_units = _ut_recognized_font_size_units();
                    
                    echo '<div class="ut-select">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[line-height-unit]" id="' , esc_attr( $id ) , '-line-height-unit" class="ut-option-element">';
                            
                            echo '<option value="">' . esc_html__( 'line-height', 'unite-admin' ) . '</option>';
                            
                             /* loop through font weights */
                            if( !empty( $line_height_units  ) ) {                        
                                
                                $lineheightunit = isset( $value['line-height-unit'] ) ? esc_attr( $value['line-height-unit'] ) : '';
                                
                                foreach ( (array) $line_height_units as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $lineheightunit, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                }                        
                                
                            }  
                            
                        echo '</select>';
                    
                    echo '</div>';
                        
                echo '</fieldset>';
                
            }
            
            /* letter spacing */
            if( !in_array('letter-spacing', $disable ) ) {
                
                echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Letter Spacing:', 'unite-admin' ) , '</legend>';
                    
                    $letter_spacing = isset( $value['letter-spacing'] ) ? esc_attr( $value['letter-spacing'] ) : '';
                    
                    echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '[letter-spacing]" id="' , esc_attr( $id ) , '" value="' , esc_attr( $letter_spacing ) , '" class="ut-option-element ut-tiny-width" />'; 
                    
                    $letter_spacing_units = _ut_recognized_font_size_units();
                    
                    echo '<div class="ut-select">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[letter-spacing-unit]" id="' , esc_attr( $id ) , '-letter-spacing-unit" class="ut-option-element">';
                            
                            echo '<option value="">' . esc_html__( 'letter-spacing', 'unite-admin' ) . '</option>';
                            
                             /* loop through font weights */
                            if( !empty( $letter_spacing_units  ) ) {                        
                                
                                $letterspacingunit = isset( $value['letter-spacing-unit'] ) ? esc_attr( $value['letter-spacing-unit'] ) : '';
                                
                                foreach ( (array) $letter_spacing_units as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $letterspacingunit, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                }                        
                                
                            }  
                            
                        echo '</select>';
                    
                    echo '</div>';
                    
                echo '</fieldset>';
                
            }
            
            /* font style */
            if( !in_array( 'font-style', $disable ) ) {
                
                 echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Style:', 'unite-admin' ) , '</legend>';
                
                    $font_styles = _ut_recognized_font_styles();
                    
                    echo '<div class="ut-select ut-select-small">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[font-style]" id="' , esc_attr( $id ) , '-style" class="ut-option-element">';
                            
                            echo '<option value="">' . esc_html__( 'font-style', 'unite-admin' ) . '</option>';
                            
                            /* loop through font weights */
                            if( !empty( $font_styles ) ) {                        
                                
                                $fontstyle = isset( $value['font-style'] ) ? esc_attr( $value['font-style'] ) : '';
                                
                                foreach ( (array) $font_styles as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $fontstyle, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                }                        
                                
                            }                    
                            
                        echo '</select>';
                    
                    echo '</div>';
                
                echo '</fieldset>';
            
            }
            
            /* text decoration */
            if( !in_array( 'text-decoration', $disable ) ) {
                
                 echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Decoration:', 'unite-admin' ) , '</legend>';
                
                    $text_decorations = _ut_recognized_text_decorations();
                    
                    echo '<div class="ut-select ut-select-small">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[text-decoration]" id="' , esc_attr( $id ) , '-decoration" class="ut-option-element">';
                            
                             echo '<option value="">' . esc_html__( 'text-decoration', 'unite-admin' ) . '</option>';
                            
                            /* loop through text decorations */
                            if( !empty( $text_decorations ) ) {
                                
                                $textdecoration = isset( $value['text-decoration'] ) ? esc_attr( $value['text-decoration'] ) : '';
                                
                                foreach ( (array) $text_decorations as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $textdecoration, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                } 
                            
                            }                    
                            
                        echo '</select>';                
                    
                    echo '</div>';
            
                echo '</fieldset>';
                 
            }
            
            /* text transform */
            if( !in_array( 'text-transform', $disable ) ) {
                
                 echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Transform:', 'unite-admin' ) , '</legend>';            
            
                    $text_transforms = _ut_recognized_text_transforms();
                    
                    echo '<div class="ut-select ut-select-small">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[text-transform]" id="' , esc_attr( $id ) , '-transform" class="ut-option-element">';
                            
                             echo '<option value="">' . esc_html__( 'text-transform', 'unite-admin' ) . '</option>';
                            
                            /* loop through text transforms */
                            if( !empty( $text_transforms ) ) {
                                
                                $texttransform = isset( $value['text-transform'] ) ? esc_attr( $value['text-transform'] ) : '';
                                
                                foreach ( (array) $text_transforms as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $texttransform, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                } 
                            
                            }                    
                            
                        echo '</select>';
                    
                    echo '</div>';
                
                echo '</fieldset>';
                    
            }
            
            /* text align */
            if( !in_array( 'text-align', $disable ) ) {
                
                echo '<fieldset>';
                    
                    echo '<legend>' , esc_html( 'Align:', 'unite-admin' ) , '</legend>';
                
                    $text_align = _ut_recognized_text_align();
                    
                    echo '<div class="ut-select ut-select-small">';
                    
                        echo '<select name="' , esc_attr( $name ) , '[text-align]" id="' , esc_attr( $id ) , '-transform" class="ut-option-element">';
                            
                             echo '<option value="">' . esc_html__( 'text-align', 'unite-admin' ) . '</option>';
                            
                            /* loop through text transforms */
                            if( !empty( $text_align ) ) {
                                
                                $textalign = isset( $value['text-align'] ) ? esc_attr( $value['text-align'] ) : '';
                                
                                foreach ( (array) $text_align as $option => $label ) {
                                
                                    echo '<option value="' , esc_attr( $option ) , '" ' , selected( $textalign, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                                    
                                } 
                            
                            }                    
                            
                        echo '</select>';
                    
                    echo '</div>';
                
                echo '</fieldset>';
                    
            }
            
            /* font preview */            
            if( !in_array( 'preview', $disable ) ) {
                        
                /* font preview field */
                echo '<div class="ut-font-preview">';
                    
                    echo esc_html__( 'The quick brown fox jumps over the lazy dog.' , 'unite-admin' );
                    
                echo '</div>';            
            
            }
        
        echo '</div>';           
        
    }

}