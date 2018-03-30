<?php if (!defined('ABSPATH')) {
    exit; // exit if accessed directly
}

/**
 * Get default option for select / radio or checkbox
 * used for data sanitization
 *
 * Helper function to return the default option value.
 *
 * @param     string    the option ID
 * @param     string    the option Source
 * @return    mixed 
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
if ( ! function_exists( '_ut_get_default_option_value' ) ) {

    function _ut_get_default_option_value( $option_id, $group_id, $source = 'theme_options', $meta_box_id = '' ) {
        
        if( empty( $option_id ) ) {
            return;
        }
        
        /* get default options */
        if( $source == 'theme_options' ) {
            
            $default_options = ut_theme_options();
            
        } elseif( $source == 'meta_box' && get_option( 'unite_recognized_metaboxes' ) !== false && !empty( $meta_box_id ) ) {
            
            $recognized_metaboxes = get_option( 'unite_recognized_metaboxes' );
            
            if( isset( $recognized_metaboxes[$meta_box_id]['function'] ) && function_exists( $recognized_metaboxes[$meta_box_id]['function'] ) ) {
            
                $default_options = call_user_func( $recognized_metaboxes[$meta_box_id]['function'] );
            
            }
            
        } else {
            
            /* no valid source */
            return;
        
        }
        
        /* find option key */
        foreach( (array) $default_options['settings'] as $default_option ) {
            
            
            if( $option_id == $default_option['id'] && isset( $default_option['default'] ) && '' != $default_option['default'] && empty( $group_id ) ) {
                
                return $default_option['default'];
                
                break;
                
            /* option is inside a group*/
            } elseif( $option_id == $default_option['id'] && $default_option['type'] == 'group' && !empty( $group_id ) ) {
            
                foreach( $default_option['fields'] as $field ) {
                    
                    if( $group_id == $field['id'] && isset( $field['default'] ) && '' != $field['default'] ) {
                        
                        return $field['default'];
                        
                        break;
                          
                    } 
                    
                }
            
            }
            
        }
        
    }

}

/**
 * Get option choices for select / radio or checkbox
 * used for data sanitization
 *
 * Helper function to return the default option value.
 *
 * @param     string    the option ID
 * @param     string    the option Source
 * @return    mixed 
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( ! function_exists( '_ut_get_default_option_choices' ) ) {

    function _ut_get_default_option_choices( $option_id, $group_id, $source = 'theme_options', $meta_box_id = '' ) {
        
        if( empty( $option_id ) ) {
            return;
        }
                
        /* get default options */
        if( $source == 'theme_options' ) {
            
            $default_options = ut_theme_options();
            
        } elseif( $source == 'meta_box' && get_option( 'unite_recognized_metaboxes' ) !== false && !empty( $meta_box_id ) ) {
            
            $recognized_metaboxes = get_option( 'unite_recognized_metaboxes' );
                        
            if( isset( $recognized_metaboxes[$meta_box_id]['function'] ) && function_exists( $recognized_metaboxes[$meta_box_id]['function'] ) ) {
            
                $default_options = call_user_func( $recognized_metaboxes[$meta_box_id]['function'] );
            
            }
            
        } else {
            
            /* no valid source */
            return;
        
        }
                
        /* find option key */
        foreach( (array) $default_options['settings'] as $default_option ) {
            
            if( $option_id == $default_option['id'] && $default_option['type'] == 'group' && !empty( $group_id ) ) {
            
                foreach( $default_option['fields'] as $field ) {
                    
                    if( $group_id == $field['id'] && isset( $field['choices'] ) && '' != $field['choices'] ) {
                        
                        return $field['choices'];
                        
                        break;
                          
                    } 
                    
                }
            
            } elseif( $option_id == $default_option['id'] && isset( $default_option['choices'] ) && '' != $default_option['choices'] && empty( $group_id ) ) {
                
                return $default_option['choices'];
                
                break;
                
            }
            
        }
        
    }

}

/**
 * Get option choices for select / radio or checkbox from group option
 * used for data sanitization
 *
 * Helper function to return the default option value.
 *
 * @param     string    the option ID
 * @param     string    the option Source
 * @return    mixed 
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */
 
if ( ! function_exists( '_ut_get_default_group_option_type' ) ) {

    function _ut_get_default_group_option_type( $group_id, $option_id, $source = 'theme_options', $meta_box_id = '' ) {
        
        if( empty( $option_id ) || empty( $group_id ) ) {
            return;
        }
                
        /* get default options */
        if( $source == 'theme_options' ) {
            
            $default_options = ut_theme_options();
            
        } elseif( $source == 'meta_box' && get_option( 'unite_recognized_metaboxes' ) !== false && !empty( $meta_box_id ) ) {
            
            $recognized_metaboxes = get_option( 'unite_recognized_metaboxes' );            
            
            if( isset( $recognized_metaboxes[$meta_box_id]['function'] ) && function_exists( $recognized_metaboxes[$meta_box_id]['function'] ) ) {
                                
                $default_options = call_user_func( $recognized_metaboxes[$meta_box_id]['function'] );
            
            }
            
        } else {
            
            /* no valid source */
            return;
        
        }        
        
        /* find option key */
        foreach( (array) $default_options['settings'] as $default_option ) {
            
            /* group found */
            if( $group_id == $default_option['id'] && isset( $default_option['fields'] ) && is_array($default_option['fields']) ) {
                
                /* loop fields and search for single id */
                foreach( (array)$default_option['fields'] as $field ) {
                    
                    if( $option_id == $field['id'] && isset( $field['type'] ) ) {
                        
                        return $field['type'];
                    
                    }
                
                }
                
                break;
                
            }
            
        }
        
    }

}

/**
 * Sanitize Simple Text , Textarea
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
 
if( ! function_exists( '_ut_sanitize_text' ) ) {
  
    function _ut_sanitize_text( $input ) {
        
        global $allowedposttags;
        
        /* Note: In WordPress Multisite, only Super Admins have the unfiltered_html capability.  */
        if ( current_user_can( 'unfiltered_html' ) ) {
            
            return stripslashes( $input );
            
        } else {
            
            return wp_kses( $value, $allowedposttags );
        
        }        
        
    }
      
    add_filter( 'ut_sanitize_text', '_ut_sanitize_text' );
    add_filter( 'ut_sanitize_textarea', '_ut_sanitize_text' );
    
}

/**
 * Sanitize Upload
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
 
if( ! function_exists( '_ut_sanitize_upload' ) ) {
  
    function _ut_sanitize_upload( $input ) {
            
        return sanitize_text_field( $input );
        
    }
      
    add_filter( 'ut_sanitize_upload', '_ut_sanitize_upload' );
    
}


/**
 * Sanitize Colorpicker
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
 
if( ! function_exists( '_ut_sanitize_colorpicker' ) ) {
  
    function _ut_sanitize_colorpicker( $input ) {
        
        /* check if input is a valid hex color */
        if ( preg_match( '/^#[a-f0-9]{6}$/i', $input ) ) {
            return $input;
        } 
        
        return $input;
        
    }
      
    add_filter( 'ut_sanitize_colorpicker', '_ut_sanitize_colorpicker' );
    
}


/**
 * Sanitize Checkbox or Multiselect
 *
 * @param     Input Value
 * @param     Option Key / ID
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_choice_option_arrays' ) ) {
    
    function _ut_sanitize_choice_option_arrays( $input, $id, $group_id = '', $source = 'theme_options', $metabox_id = '' ) {
        
        $choices = _ut_get_default_option_choices( $id, $group_id, $source, $metabox_id );
                
        /* check if input exists in theme options */
        if ( is_array( $choices ) && array_key_exists( $input, $choices ) ) {
            
            return $input;
            
        } else {
            
            return _ut_get_default_option_value( $id, $group_id, $source, $metabox_id );
            
        }
        
    }
    
    add_filter( 'ut_sanitize_select', '_ut_sanitize_choice_option_arrays', 10 , 5 );

}


/**
 * Sanitize Select, Radio
 *
 * @param     Input Value
 * @param     Option Key / ID
 * @param     Group ID ( optional )
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
 
if( !function_exists( '_ut_sanitize_choice_option_strings' ) ) {
    
    function _ut_sanitize_choice_option_strings( $input, $id, $group_id = '', $source = 'theme_options', $metabox_id = '' ) {        
        
        $choices = _ut_get_default_option_choices( $id, $group_id, $source, $metabox_id );
               
        /* check if input exists in theme options */
        if ( is_array( $choices ) && array_key_exists( $input, $choices ) ) {
            
            return $input;
            
        } else {
            
            return _ut_get_default_option_value( $id, $group_id, $source, $metabox_id );
            
        }
        
    }
    
    add_filter( 'ut_sanitize_select', '_ut_sanitize_choice_option_strings', 10 , 5 );
    add_filter( 'ut_sanitize_radio' , '_ut_sanitize_choice_option_strings', 10 , 5 );

}


/**
 * Sanitize Post ID
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_post_id' ) ) {
    
    function _ut_sanitize_post_id( $input ) {
        
        $sanitized_input = array();
        
        if( is_array( $input ) && !empty( $input ) ) {            
                        
            /* loop trough input array */
            foreach( $input as $key => $id ) {
                
                /* check if id is a valid post */
                if( get_post_status( intval($id) ) ) {
                                                            
                    $sanitized_input[$key] = $id;       
                        
                }
                
            }            
        
        } else {
            
            if( get_post_status( intval($input) ) ) {
                
                return $input; 
             
            }            
        
        }
        
        return $sanitized_input;
        
    }
    
    /* multiple option types use this validation */
    add_filter( 'ut_sanitize_page_checkbox', '_ut_sanitize_post_id' );
    add_filter( 'ut_sanitize_post_checkbox', '_ut_sanitize_post_id' );

}


/**
 * Sanitize JavaScript
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_js' ) ) {
    
    function _ut_sanitize_js( $input ) {
        
        /* Note: In WordPress Multisite, only Super Admins have the unfiltered_html capability.  */
        if ( current_user_can( 'unfiltered_html' ) ) {
            
            /* strip script tags */
            // preg_match( '', trim( $input ) ); @todo
            
            return  stripslashes( $input );
        
        }
            
    }
    
    add_filter( 'ut_sanitize_js', '_ut_sanitize_js' );

}


/**
 * Sanitize CSS
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_css' ) ) {
    
    function _ut_sanitize_css( $input ) {
        
        /* Note: In WordPress Multisite, only Super Admins have the unfiltered_html capability.  */
        if ( current_user_can( 'unfiltered_html' ) ) {
            
            /* strip script tags */
            // preg_match( '', trim($input) ); @todo
            
            return $input;
        
        }
            
    }
    
    add_filter( 'ut_sanitize_css', '_ut_sanitize_css' );

}


/**
 * Sanitize Background
 *
 * @param     Input Value
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_background' ) ) {
    
    function _ut_sanitize_background( $input ) {
        
        if( is_array( $input ) && !empty( $input ) ) {
            
            $sanitized_input = array();
            
            foreach( $input as $attribute => $value ) {
                
                switch( $attribute ) {
                    
                    case 'background-image' : 
                    $sanitized_input[$attribute] = apply_filters( 'ut_sanitize_upload', $value );                    
                    break;
                    
                    case 'background-color' : 
                    $sanitized_input[$attribute] = apply_filters( 'ut_sanitize_colorpicker', $value );                    
                    break;
                    
                    case 'background-repeat' : 
                    $sanitized_value = array_key_exists( $value, _ut_recognized_background_repeats() ) ? $value : '';     
                    $sanitized_input[$attribute] = $sanitized_value;
                    break;
                    
                    case 'background-attachment' :                     
                    $sanitized_value = array_key_exists( $value, _ut_recognized_background_attachments() ) ? $value : '';     
                    $sanitized_input[$attribute] = $sanitized_value;
                    break;
                    
                    case 'background-position' : 
                    $sanitized_value = array_key_exists( $value, _ut_recognized_background_positions() ) ? $value : '';     
                    $sanitized_input[$attribute] = $sanitized_value;
                    break;
                    
                    case 'background-size' :                     
                    $sanitized_value = array_key_exists( $value, _ut_recognized_background_sizes() ) ? $value : '';     
                    $sanitized_input[$attribute] = $sanitized_value;
                    break;
                    
                }
                
            }            
            
            return $sanitized_input;
            
        } else {
            
            return;
            
        }
            
    }
    
    add_filter( 'ut_sanitize_background', '_ut_sanitize_background' );

}


/**
 * Sanitize Group
 *
 * @param     Input Value, Group ID
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_group' ) ) {
    
    function _ut_sanitize_group( $input, $id, $source = 'theme_options', $metabox_id = '' ) {
                        
        if( is_array( $input ) && !empty( $input ) ) {
            
            $sanitized_input = array();
            
            foreach( $input as $key => $single_group ) {
                
                foreach( $single_group as $option_id => $value ) {
                    
                    /* get option type */
                    $type = _ut_get_default_group_option_type( $id, $option_id, $source, $metabox_id );                    
                    
                    if ( has_filter( 'ut_sanitize_'. $type ) ) {
                    
                        $sanitized_input[$key][$option_id] = apply_filters( 'ut_sanitize_' . $type, $value, $id, $option_id, $source, $metabox_id );
                    
                    }     
                
                }
                
            }
            
            return $sanitized_input;
            
        } else {
            
            return;
        
        }
             
    }
    
    add_filter( 'ut_sanitize_group', '_ut_sanitize_group', 10 , 5 );

}

/**
 * Sanitize Array
 *
 * @param     array
 * @return    array
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( '_ut_sanitize_array' ) ) {
    
    function _ut_sanitize_array( $data ) {
        
        if ( !is_array( $data ) || !count( $data ) ) {
            return array();
        }
        
        foreach ($data as $k => $v) {
            
            if ( !is_array( $v ) && !is_object( $v ) ) {
                $data[$k] = htmlspecialchars(trim($v));
            }
            
            if ( is_array( $v ) ) {
                $data[$k] = _ut_sanitize_array( $v );
            }
            
        }
    
        return $data;
        
    }

}

/**
 * Option Validation
 *
 * @param     Option Value
 * @param     Option Type
 * @param     Option ID
 * @param     Option Source can be meta_box ,taxonomy or theme_options
 * @param     Option Metabox ID
 * @return    mixed
 *
 * @access    public
 * @since     1.0
 */
if( !function_exists( 'ut_sanitize_option' ) ) {
    
    function ut_sanitize_option( $input = '', $type = '', $id, $source = 'theme_options', $metabox_id = '' ) {
                
        if( empty( $input ) || empty( $type ) || empty( $id ) ) {            
            return;            
        }
        
        if( $source == 'theme_options' ) {
        
            /* filter based sanitize */ 
            if ( has_filter( 'ut_sanitize_'. $type ) && $type == 'group' ) {
                            
                return apply_filters( 'ut_sanitize_' . $type, $input , $id, $source, $metabox_id );
            
            } elseif( has_filter( 'ut_sanitize_'. $type ) ) {
                
                return apply_filters( 'ut_sanitize_' . $type, $input , $id, '', $source, $metabox_id );
            
            }
        
        } else {                
        
            if( is_array( $input ) ) {
                
                return _ut_sanitize_array( $input );
                
            } else {
                
                return _ut_sanitize_text( $input );
                
            }
        
        }
        
        /* no filter available , let's use the default filter */
        return $input;
        
    }

}