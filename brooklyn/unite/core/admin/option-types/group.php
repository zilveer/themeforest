<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Group
 *
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( 'ut_render_option_group' ) ) {
  
    function ut_render_option_group( $settings = array() ) {
    
        /* extract variables */
        extract( $settings );
        
        $dependency = ut_create_dependency( $settings['required'] );
        
        echo '<div class="ut-admin-panel-content ' , $grid , ' clearfix" '. $dependency .' data-optiontype="group" data-panel-for="' , esc_attr( $id ) , '">'; 
        
        $last_id = 0;
        
        echo '<div class="ut-repeat-group-loop">';
            
            if ( is_array( $value ) && ! empty( $value ) ) {
                                                
                foreach( (array) $value as $g => $groupitem ) {
                    
                    echo '<section class="ut-admin-panel ut-repeat-group clearfix">';                    
                        
                        echo '<header class="ut-admin-panel-header ut-repeat-group-heading clearfix">';
                            
                            echo '<h3 class="ut-admin-panel-header-title">Accordion</h3>';
                            echo '<div class="ut-admin-panel-actions">';
                                echo '<a href="#" class="ut-delete-group"><i class="fa fa-trash-o"></i></a>';
                            echo '</div>';
                             
                        echo '</header>';
                        
                        echo '<div class="ut-admin-panel-content ut-repeat-group-content">';
                        
                        foreach( (array) $fields as $f => $field ) {
                            
                            /* assign needed values */
                            $field['name']  = $id . '][' . $last_id . '][' . $field['id'];
                            $field['value'] = !empty( $groupitem[$field['id']] ) ? $groupitem[$field['id']] : '';
                            $field['id']    = $field['id'] . '_' . $last_id;
                            
                            /* prepare field settings */
                            $settings = ut_prepare_settings_field( $field, $source, $source_key );
                            
                            /* check for dependencies*/
                            if( !empty( $settings['required'] ) ) {
                                
                                $settings['required'][0] = $settings['required'][0] . '_' . $last_id;
                                                            
                            }
                            
                            /* render single group option */
                            $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                            
                            if( function_exists( $function_by_type ) && $settings['type'] != 'group' ) {
                                
                                $class = isset( $settings['class'] ) ? $settings['class'] : '';
                                
                                if( $settings['type'] != 'info' ) {
                                
                                    echo '<section class="ut-admin-group-panel ' . $class . ' clearfix">';
                                
                                }
                                
                                if( $field['type'] != 'info' ) {                                
                                
                                    echo '<header class="ut-admin-panel-header grid-50 mobile-grid-100 clearfix">';
                                    
                                        echo '<h3 class="ut-admin-panel-header-title">' , $field['title'] , '</h3>';
                                        
                                        if( !empty( $field['desc'] ) ) {
                                        
                                            echo '<span class="ut-admin-panel-description">' , $field['desc'] , '</span>';
                                        
                                        }
                                        
                                    echo '</header>';
                                    
                                    call_user_func( $function_by_type, $settings );
                                
                                } else {    
                                    
                                    call_user_func( $function_by_type, $settings );
                                
                                }
                                
                                if( $settings['type'] != 'info' ) {
                                
                                    echo '</section>';
                                    
                                }
                                
                            } else {
                                
                                /* @todo - add error message markup */
                                esc_html_e( 'Function does not exist or not supported!', 'unite-admin' );     
                            
                            }
                            
                            echo '<div class="clear"></div>';
                        
                        }
                        
                        echo '</div>';
                        
                    echo '</section>';
                    
                    $last_id++;
                    
                }
            
            }
            
                               
            if( !empty( $fields ) ) {
                
                echo '<section class="ut-admin-panel ut-repeat-group clearfix ut-to-copy ut-hide">';
                
                    echo '<header class="ut-admin-panel-header ut-repeat-group-heading clearfix">';
                        
                        echo '<h3 class="ut-admin-panel-header-title">Accordion</h3>';
                        
                        echo '<div class="ut-admin-panel-actions">';
                            echo '<a href="#" class="ut-delete-group"><i class="fa fa-trash-o"></i></a>';
                        echo '</div>';
                        
                    echo '</header>';
                    
                    echo '<div class="ut-admin-panel-content ut-repeat-group-content">';
                    
                    foreach ( (array) $fields as $key => $field ) {
                        
                        /* assign values */
                        $field['name'] = $id . '][' . $last_id . '][' . $field['id'];                        
                        $field['id']   = $field['id'] . '_' . $last_id;
                        
                        /* prepare field settings */
                        $settings = ut_prepare_settings_field( $field, $source, $source_key );
                        
                        /* check for dependencies*/
                        if( !empty( $settings['required'] ) ) {
                            
                            $settings['required'][0] = $settings['required'][0] . '_' . $last_id;
                                                        
                        }
                        
                        /* render single group option */                        
                        $function_by_type = str_replace( '-', '_', 'ut_render_option_' . $settings['type'] );
                        
                        if( function_exists( $function_by_type ) && $settings['type'] != 'group' ) {
                            
                            $class = isset( $field['class'] ) ? $field['class'] : '';
                            
                            if( $field['type'] != 'info' ) {
                                
                                echo '<section class="ut-admin-group-panel ut-group-item-to-copy ' . $class . ' clearfix">';
                            
                            }
                            
                            if( $field['type'] != 'info' ) {                                
                                
                                echo '<header class="ut-admin-panel-header grid-50 mobile-grid-100 clearfix">';
                                
                                    echo '<h3 class="ut-admin-panel-header-title">' , $field['title'] , '</h3>';
                                    
                                    if( !empty( $field['desc'] ) ) {
                                    
                                        echo '<span class="ut-admin-panel-description">' , $field['desc'] , '</span>';
                                    
                                    }
                                    
                                echo '</header>';
                                
                                call_user_func( $function_by_type, $settings );
                            
                            } else {    
                                    
                                call_user_func( $function_by_type, $settings );
                            
                            }
                            
                            if( $field['type'] != 'info' ) {
                                
                                echo '</section>';
                                
                            }                            
                            
                        } else {
                            
                            /* @todo - add error message markup */
                            esc_html_e( 'Function does not exist or not supported!', 'unite-admin' );    
                        
                        }
                        
                        echo '<div class="clear"></div>';
                    
                    }
                    
                    echo '</div>';
                    
                echo '</section>';
                
            }
        
        echo '</div>';
        
        echo '<button type="button" class="ut-do-copy ut-backend-button ut-green-button"><i class="fa fa-plus"></i>' , esc_html__('Add' , 'unite-admin') , '</button>';
        
        echo '</div>'; 
        
    }

}