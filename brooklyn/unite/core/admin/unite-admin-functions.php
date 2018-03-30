<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}

/**
 * Enqueue Widget Admin JS
 *
 * @since     1.0.0
 * @version   1.1.0
 */
if ( ! function_exists( '_ut_widget_scripts' ) ) :
    
    function _ut_widget_scripts() {
        
        $min = NULL;
            
        if( !WP_DEBUG ){
            $min = '.min';
        }
        
        /* admin css */
        wp_enqueue_style(
            'unite-widget-admin', 
            FW_WEB_ROOT . '/core/admin/assets/css/unite-widget-admin' . $min . '.css', 
            false, 
            UT_VERSION
        );

        /* register widget script */
        wp_enqueue_script(
            'unite-widget-admin', 
            FW_WEB_ROOT . '/core/admin/assets/js/unite-widget-admin' . $min . '.js', 
            array('jquery', 'jquery-ui-tabs'), 
            UT_VERSION
        );
             
    }
    
    add_action('admin_print_scripts-widgets.php', '_ut_widget_scripts');

endif;

/**
 * Helper function to return customizer link
 *
 * @return    string
 *
 * @access    public
 * @since     1.0
 */

function ut_get_customizer_link_attr( $key = '', $id = '' ) {
    
    if( empty( $key ) || empty( $id ) ) {
        return;    
    }    
    
    return 'data-customize-setting-link="' . esc_attr( $key.'['.$id .']' ) . '"';   
  
}

/**
 * Prepare Field Settings
 *
 * @param     array    Array of Settings
 * @param     string   source id of this field
 * @return    array    New Array with all necessary settings
 *
 * @access    public
 * @since     1.0.0
 * @version   1.1.0
 */
    
function ut_prepare_settings_field( $args, $source, $key ) {
    
    /* extract field settings */
    extract( $args );        
    
    if( empty( $id ) || empty( $type )  ) {
        return;
    }
    
    $options = '';
    
    switch( $source ) {
        
        case 'theme_options' :
        $options = get_option( $key, false );
        break;
        
        case 'meta_box' :
        break;
        
        default :
        break;            
        
    }
    
    /* set field value */
    $option_value = isset( $options[$id] ) && !empty( $options[$id] ) ? $options[$id] : '';    
            
    /* it it's an group item , there might be already a value */
    $option_value = isset( $value ) && !empty( $value ) ? $value : $option_value;
        
    /* set default value */
    if ( isset( $default ) && $option_value == '' ) {
        
        $option_value = $default;
            
    }
        
    /* check if at least we have all necessary defaults */
    $option_args = array(
        'type'       => $type,
        'id'         => $id,
        'name'       => $key . '[' . ( !empty($name) ? $name : $id ) . ']',
        'value'      => $option_value,
        'taxonomy'   => !empty( $taxonomy ) ? $taxonomy : '',
        'default'    => !empty( $default )  ? $default  : '',
        'title'      => !empty( $title )    ? $title    : '',
        'desc'       => !empty( $desc )     ? $desc     : '',
        'info'       => !empty( $info )     ? $info     : '',
        'grid'       => !empty( $grid )     ? $grid     : '',
        'rows'       => !empty( $rows )     ? $rows     : '10',
        'config'     => !empty( $config )   ? $config   : array(),
        'choices'    => !empty( $choices )  ? $choices  : array(),
        'labels'     => !empty( $labels )   ? $labels   : array( 'on'    => esc_html__( 'on', 'unite-admin' ) , 'off'   => esc_html__( 'off', 'unite-admin' ) ),
        'fields'     => !empty( $fields )   ? $fields   : array(),
        'required'   => !empty( $required ) ? $required : array(),
        'disable'    => !empty( $disable )  ? $disable  : array('none'),
        'mime'       => !empty( $mime )     ? $mime     : array(),
        'mode'       => !empty( $mode )     ? $mode     : 'hex',
        'addon'      => !empty( $addon )    ? $addon    : '',
        'source'     => !empty( $source )   ? $source   : '',
        'source_key' => !empty( $key)       ? $key      : '',
        'post_ID'    => !empty( $post_ID )  ? $post_ID  : '',
        'width'      => !empty( $width )    ? $width    : 'full',
        'class'      => !empty( $class )    ? $class    : ''
    );
    
    return $option_args;        

}


/**
 * Helper function to return encoded strings
 *
 * @return    string
 *
 * @access    public
 * @since     1.0
 */

function ut_base_encode( $value = '' ) {
    
    if( !$value ) {
        return;
    }
    
    $func = 'base64' . '_encode';
    return $func( $value );
  
}


/**
 * Helper function to return decoded strings
 *
 * @return    string
 *
 * @access    public
 * @since     1.0
 */
 
function ut_base_decode( $value = '' ) {
    
    if( !$value ) {
        return;
    }
    
    $func = 'base64' . '_decode';
    return $func( $value );
  
}

function ut_load_theme_option( $options ) {
    
    if( !$options && !is_array( $options ) ) {
        return false;
    }
    
    /* get default options first */
    $theme_options = ut_theme_options();
    
    /* sanitized array */
    $sanitized_options = array();
    $sanitized_layout_options = array();
    
    /* layout flag */
    $has_layouts = false;    
    
    /* import theme options first. We cannot trust the new serialized data, so we compare with theme options and sanitize the values again */    
    if( isset( $options['unite_theme_supports_layouts'] ) && $options['unite_theme_supports_layouts'] ) {
        
        if( !empty( $options['unite_theme_layouts'] ) && is_array( $options['unite_theme_layouts'] ) ) {
               
            $has_layouts = true;
                
            foreach( (array) $options['unite_theme_layouts'] as $lkey => $layout ) {
                
                if( isset( $options['unite_theme_layouts_options'][$lkey] ) ) {
                    
                    foreach( (array) $options['unite_theme_layouts_options'][$lkey] as $okey => $value ) {
        
                        foreach( (array) $theme_options as $skey => $settings ) {
                            
                            if( 'settings' == $skey ) {
                                
                                foreach( $settings as $setting ) {
                                    
                                    if( $okey == $setting['id'] ) {
                                        
                                        $sanitized_layout_options[$lkey][$okey] = ut_sanitize_option( $value, $setting['type'], $okey, 'theme_options' );
                                        
                                    }                    
                                
                                }
                            
                            }
                        
                        }
                    
                    }
                
                }
                
            }            
            
        }
        
    }
    
    /* default option set */    
    if( !empty( $options[ut_options_key()] ) ) {
    
        foreach( (array) $options[ut_options_key()] as $okey => $value ) {
        
            foreach( (array) $theme_options as $skey => $settings ) {
                
                if( 'settings' == $skey ) {
                    
                    foreach( $settings as $setting ) {
                        
                        if( $okey == $setting['id'] ) {
                            
                            $sanitized_options[$okey] = ut_sanitize_option( $value, $setting['type'], $okey, 'theme_options' );
                            
                        }                    
                    
                    }
                
                }
            
            }
        
        }
    
    }
    
    /* now import dynamic sidebars and sidebar options */
    $sanitized_sidebars = array();
    
    if( !empty( $options['unite_theme_sidebars'] ) ) {
    
        foreach( (array) $options['unite_theme_sidebars'] as $key => $sidebar ) {
            
            foreach( $sidebar as $sidebar_attr_key => $sidebar_attr ) {
                
                $sanitized_sidebars[$key][esc_html( $sidebar_attr_key )] = esc_html( $sidebar_attr );
                
            }
            
        }
        
        if( array_filter( $sanitized_sidebars ) ) {
        
            update_option( 'unite_theme_sidebars', $sanitized_sidebars );     
                
        }
    
    }
    
    /* now import sidebar settings */
    if( !empty( $options['unite_theme_sidebar_settings'] ) ) {

        foreach( (array) $options['unite_theme_sidebar_settings'] as $key => $sidebar_option ) {
            
            if( !empty( $sidebar_option ) ) {
                
                update_option( esc_html( $key ), esc_html( $sidebar_option ) );
                
            }        
            
        }
        
    }
    
    if( $has_layouts ) {
        
        foreach( $sanitized_layout_options as $key => $layout_options ) {
            
            if( array_filter( $layout_options ) ) {
                
                update_option( $key, $layout_options );    
                
            }            
            
        }
    
    }
    
    if( array_filter( $sanitized_options ) ) {
        
        update_option( ut_options_key(), $sanitized_options );
        return true;
            
    } else {
        
        return false;
    
    }
    
}

/**
 * Helper function to sort array based on a second array
 *
 * @return    string
 *
 * @access    public
 * @since     1.0
 */
function ut_sort_array_by_array( array $toSort, array $sortByValuesAsKeys ) {
    
    $commonKeysInOrder   = array_intersect_key(array_flip($sortByValuesAsKeys), $toSort);
    $commonKeysWithValue = array_intersect_key($toSort, $commonKeysInOrder);
    $sorted              = array_merge($commonKeysInOrder, $commonKeysWithValue);
    
    return $sorted;
}

/**
 * Helper function to check if a folder is writeable
 * @return    string
 *
 * @access    public
 * @since     1.0
 */
if ( !function_exists( 'ut_is_writable' ) ) {
	
	function ut_is_writable( $path ) {
	
		if ( $path{strlen( $path )-1}=='/' ) {
			return ut_is_writable( $path . uniqid( mt_rand() ).'.tmp' );
		}
		
		if ( file_exists( $path ) ) {
			if ( !( $f = @fopen( $path, 'r+' ) ) )
				return false;
			fclose( $f );
			return true;
		}
		
		if ( !( $f = @fopen( $path, 'w' ) ) ) {
			return false;
        }
        
        fclose( $f );
		unlink( $path );
        
		return true;
		
	}
	
}

/**
 * Helper function to create option dependencies
 * @return    string
 *
 * @access    public
 * @since     1.0
 */
if ( !function_exists( 'ut_create_dependency' ) ) {
	
	function ut_create_dependency( $required ) {
        
        if( empty( $required ) ) {
            return;
        }
        
        $dependency = 'data-dependency="' . $required[0] . '"';
        $operator   = 'data-operator="' . $required[1] . '"';
        $value      = 'data-value="' . $required[2] . '"';        
        
        return $dependency . ' ' . $operator . ' ' . $value;
        
    }
    
}