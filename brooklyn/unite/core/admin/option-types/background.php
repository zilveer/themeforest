<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Background
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_background' ) ) {
  
    function ut_render_option_background( $settings = array() ) {
        
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="background" data-panel-for="' , esc_attr( $id ) , '">';
            
            /* Colorpicker */
            if( !in_array('background-color', $disable ) ) {            
                
                $backgroundcolor = isset( $value['background-color'] ) ? esc_attr( $value['background-color'] ) : '';
                echo '<input type="text" name="' , esc_attr( $name ) , '[background-color]" id="' , esc_attr( $id ) , '-color" value="' , esc_attr( $backgroundcolor ) , '" class="ut-color-picker ut-option-element" />';  
            
            }
            
            /* Background Image */ 
            if( !in_array('background-image', $disable ) ) {            
                                                          
                $backgroundimage = isset( $value['background-image'] ) ? esc_attr( $value['background-image'] ) : '';
                
                echo '<input autocomplete="off" type="text" name="' , esc_attr( $name ) , '[background-image]" id="' , esc_attr( $id ) , '" value="' , esc_attr( $backgroundimage ) , '" class="widefat ut-option-element" />';
                
                if( !empty( $backgroundimage ) ) {
                    echo '<img id="' , esc_attr( $id ) , '_preview" class="ut-image-preview" src="' . esc_url( $backgroundimage ) . '" alt="' , esc_attr( $title ) , '" />';
                }
                
                echo '<div class="clear"></div>';
                
                echo '<button data-mime="image" type="button" data-field="' , esc_attr( $id ) , '" data-title="' , esc_html__( 'Choose Image', 'unite-admin' ) , '" class="ut-upload-media ut-option-element ut-backend-button ut-blue-button"><i class="fa fa-upload"></i>' , esc_html__('Upload' , 'unite-admin') , '</button>';
                echo '<button type="button" data-field="' , esc_attr( $id ) , '" class="ut-delete-media ut-option-element ut-backend-button ut-red-button"><i class="fa fa-trash"></i>' , esc_html__('Delete' , 'unite-admin') , '</button>';
                echo '<div class="clear"></div>';
                
            }           
            
            /* Background Repeat*/ 
            if( !in_array('background-repeat', $disable ) ) {
            
                $background_repeat = _ut_recognized_background_repeats();
                
                echo '<div class="ut-select">';
                
                    echo '<select name="' , esc_attr( $name ) , '[background-repeat]" id="' , esc_attr( $id ) , '-repeat" class="ut-option-element">';
                    
                    echo '<option value="">' . esc_html__( 'background-repeat', 'unite-admin' ) . '</option>';
                    
                    /* loop through background repeat choices */
                    if( !empty( $background_repeat ) ) {
                        
                        $backgroundrepeat = isset( $value['background-repeat'] ) ? esc_attr( $value['background-repeat'] ) : '';
                        
                        foreach ( (array) $background_repeat as $option => $label ) {
                            
                            echo '<option value="' , esc_attr( $option ) , '" ' , selected( $backgroundrepeat, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                            
                        }
                        
                    }
                    
                    echo '</select>';
                
                echo '</div>';   
                
            }             
                        
            /* Background Attachment */
            if( !in_array('background-attachment', $disable ) ) {            
            
                $background_attachment =  _ut_recognized_background_attachments();
                
                echo '<div class="ut-select">';
                
                    echo '<select name="' , esc_attr( $name ) , '[background-attachment]" id="' , esc_attr( $id ) , '-attachment" class="ut-option-element">';
                    
                    echo '<option value="">' . esc_html__( 'background-attachment', 'unite-admin' ) . '</option>';
                    
                    /* loop through background repeat choices */
                    if( !empty( $background_attachment ) ) {
                        
                        $backgroundattachment = isset( $value['background-attachment'] ) ? esc_attr( $value['background-attachment'] ) : '';
                        
                        foreach ( (array) $background_attachment as $option => $label ) {
                            
                            echo '<option value="' , esc_attr( $option ) , '" ' , selected( $backgroundattachment, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                            
                        }        
                        
                    }
                    
                    echo '</select>';
                
                echo '</div>';
                
            }
            
            /* Background Position */
            if( !in_array('background-position', $disable ) ) {
                
                $background_position = _ut_recognized_background_positions();
                
                echo '<div class="ut-select">';
                
                    echo '<select name="' , esc_attr( $name ) , '[background-position]" id="' , esc_attr( $id ) , '-position" class="ut-option-element">';
                    
                    echo '<option value="">' . esc_html__( 'background-position', 'unite-admin' ) . '</option>';
                    
                    /* loop through background repeat choices */
                    if( !empty( $background_position ) ) {
                        
                        $backgroundposition = isset( $value['background-position'] ) ? esc_attr( $value['background-position'] ) : '';
                        
                        foreach ( (array) $background_position as $option => $label ) {
                            
                            echo '<option value="' , esc_attr( $option ) , '" ' , selected( $backgroundposition, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                            
                        }        
                        
                    }
                    
                    echo '</select>';
                
                echo '</div>';
                
            }
            
            /* Background Size */
            if( !in_array('background-size', $disable ) ) {
                
                $background_size = _ut_recognized_background_sizes();
                
                echo '<div class="ut-select">';
                               
                    echo '<select name="' , esc_attr( $name ) , '[background-size]" id="' , esc_attr( $id ) , '-size" class="ut-option-element">';
                    
                    echo '<option value="">' . esc_html__( 'background-size', 'unite-admin' ) . '</option>';
                    
                    /* loop through background repeat choices */
                    if( !empty( $background_size ) ) {
                        
                        $backgroundsize = isset( $value['background-size'] ) ? esc_attr( $value['background-size'] ) : '';
                        
                        foreach ( (array) $background_size as $option => $label ) {
                            
                            echo '<option value="' , esc_attr( $option ) , '" ' , selected( $backgroundsize, $option, false ) , '>' , esc_attr( $label ) , '</option>';                
                            
                        }        
                        
                    }
                    
                    echo '</select>';
                
                echo '</div>';
                
            }            
        
        echo '</div>';
        
    }

}