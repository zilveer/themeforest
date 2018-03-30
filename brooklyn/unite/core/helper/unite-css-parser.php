<?php if (!defined('UT_VERSION')) {
    exit; // exit if accessed directly
}


/** 
 * Simple CSS Minifier for dynamic generated CSS
 *
 * @return    string
 *
 * @access    public
 * @since     1.0.0
 * @version   1.0.0
 */

if ( !function_exists( 'ut_minify_css' ) ) {
    
    function ut_minify_css($buffer) { 
        
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
        
        return $buffer;
        
    }
    
    add_filter( 'ut_minify_css', 'ut_minify_css' );
    
}


/** 
 * Simple HEX to RGB Function
 *
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */
 
if( !function_exists('ut_hex_to_rgb') ) :

    function ut_hex_to_rgb( $hex ) {
        
        if( empty( $hex ) ) {
            return;
        }

        $hex = preg_replace("/#/", "", $hex);
        $color = array();
     
        if(strlen($hex) == 3) {
            $color['r'] = hexdec(substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(substr($hex, 2, 1) . $b);
        }
        else if(strlen($hex) == 6) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        }
        
        $color = implode(',', $color);
        
        return $color;
        
    }

endif;


/** 
 * Simple RGBA to RGB Function
 *
 * @return    string
 *
 * @access    public
 * @since     1.1.0
 * @version   1.0.0
 */

if( !function_exists('ut_rgba_to_rgb') ) :

    function ut_rgba_to_rgb( $rgba ) {
        
        if( empty( $rgba ) ) {
            return;
        }
        
        /* check if hex */
        if ( preg_match( '/^#[a-f0-9]{6}$/i', $rgba ) ) {
            $rgba = ut_hex_to_rgb( $rgba );
        }
        
        $rgb = preg_replace( '/[^0-9,]/', '', $rgba );
        $rgb = explode( ',', $rgb );
        
        if( count( $rgb ) === 4 ) {
            $stack = array_pop( $rgb );            
        }        
        
        $rgb = implode( ',', $rgb );
        
        return 'rgb(' . $rgb . ')';
        
    }

endif;


/** 
 * Create a custom CSS color
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */

if ( !function_exists( '_ut_theme_create_css_colorpicker' ) ) {
    
    function _ut_theme_create_css_colorpicker( $selector, $settings ) {
        
        if( empty( $selector ) ) {
            return;
        }
        
        /* create css string */
        $css = NULL;
        
        $css .= $selector . ' {'; 
            
            //@todo color  
            
        $css .= '}';
        
        /* return css string */
        return $css;        
        
    }

}


/** 
 * Create a custom CSS background
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */

if ( !function_exists( '_ut_theme_create_css_background' ) ) {
    
    function _ut_theme_create_css_background( $selector, $settings ) {
        
        if( empty( $selector ) ) {
            return;
        }
        
        /* create css string */
        $css = NULL;
        
        $css .= $selector . ' {'; 
            
            /* background-image */
            if( !empty( $settings['background-image'] ) ) {                
                $css .= 'background-image: url("' . $settings['background-image'] . '");'. "\n";
            }
            
            /* background-color */
            if( !empty( $settings['background-color'] ) ) {                
                $css .= 'background-color: ' . $settings['background-color'] . ';'. "\n";
            }
            
            /* background-repeat */
            if( !empty( $settings['background-repeat'] ) ) {                
                $css .= 'background-repeat: ' . $settings['background-repeat'] . ';'. "\n";
            }
            
            /* background-size */
            if( !empty( $settings['background-size'] ) ) {                
                $css .= 'background-size: ' . $settings['background-size'] . ';'. "\n";               
            }
            
            /* background-position */
            if( !empty( $settings['background-position'] ) ) {                
                $css .= 'background-position: ' . $settings['background-position'] . ';'. "\n";               
            }
            
             /* background-attachment */
            if( !empty( $settings['background-attachment'] ) ) {                
                $css .= 'background-attachment: ' . $settings['background-attachment'] . ';'. "\n";               
            }
            
        $css .= '}';
        
        /* return css string */
        return $css;
        
    }

}

/** 
 * Extract a CSS Color
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.0.0
 */

if ( !function_exists( '_ut_extract_color' ) ) {
    
    function _ut_extract_color( $settings ) {
        
        if( empty( $selector ) ) {
            return;
        }
        
        if( !empty( $settings['background-color'] ) ) {
            
            return $settings['background-color'];
            
        }
        
        return false;
        
    }

}


/** 
 * Create a custom CSS background
 *
 * @return    string
 *
 * @access    private
 * @since     1.1.0
 * @version   1.0.0
 */

if ( !function_exists( '_ut_theme_create_css_border' ) ) {
    
    function _ut_theme_create_css_border( $selector, $settings ) {
        
        if( empty( $selector ) ) {
            return;
        }
        
        /* create css string */
        $css = NULL;
        
        $css .= $selector . ' {'; 
            
            foreach( $settings as $skey => $setting ) {
                                
                foreach( $setting as $key => $value ) {
                    
                    if( !empty( $value ) ) {
                    
                        if( $key == 'border-top-width' || $key == 'border-right-width' || $key == 'border-bottom-width' || $key == 'border-left-width' ) {
                            
                            $value = preg_replace( "/px/", "", $value );
                            
                            $css .= $key . ':' . $value . 'px;';
                            
                        } else {
                            
                            $css .= $key . ':' . $value . ';';
                            
                        }
                    
                    }
                    
                }
            
            }            
            
        $css .= '}';
        
        /* return css string */
        return $css;
        
    }

}









/** 
 * Create a custom CSS typography
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.1.0
 */

if ( !function_exists( '_ut_theme_create_css_typography' ) ) {
    
    function _ut_theme_create_css_typography( $selector, $settings ) {
        
        if( empty( $selector ) ) {
            return;
        }
        
        /* check if family is part of the google familiy */
        if( apply_filters( 'ut_google_fonts', true ) ) {
            
            $google_fonts = get_option( 'unite_installed_google_fonts' );
            
            if( isset( $settings['font-family'] ) && !empty( $google_fonts[$settings['font-family']]['family'] ) ) {
                
                $settings['font-family'] = $google_fonts[$settings['font-family']]['family'];              
                
            }
        
        }  
        
        /* create css string */        
        $css = $selector . ' {' . "\n";
            
            /* font-family */
            if( !empty( $settings['font-family'] ) ) {                
                $css .= 'font-family: "' . $settings['font-family'] . '";'. "\n";               
            }
            
            /* font-size */
            $font_size_unit = !empty( $settings['font-size-unit'] ) ? $settings['font-size-unit'] : 'px';
            
            if( !empty( $settings['font-size'] ) ) {                
                $css .= 'font-size: ' . $settings['font-size'] . $font_size_unit . ';'. "\n";
            }
            
            /* color */
            if( !empty( $settings['color'] ) ) {                
                $css .= 'color: ' . $settings['color'] . ';'. "\n";
            }            
            
            /* font-weight */
            if( !empty( $settings['font-weight'] ) ) {                
                $css .= 'font-weight: ' . $settings['font-weight'] . ';'. "\n";
            }
            
            /* font-style */
            if( !empty( $settings['font-style'] ) ) {                
                $css .= 'font-style: ' . $settings['font-style'] . ';'. "\n";
            }
            
            /* text-decoration */
            if( !empty( $settings['text-decoration'] ) ) {
                $css .= 'text-decoration: ' . $settings['text-decoration'] . ';'. "\n";
            } 
            
            /* text-transform */
            if( !empty( $settings['text-transform'] ) ) {
                $css .= 'text-transform: ' . $settings['text-transform'] . ' !important;'. "\n";
            }
            
            /* letter-spacing */
            $letter_spacing_unit = !empty( $settings['letter-spacing-unit'] ) ? $settings['letter-spacing-unit'] : 'px';
            
            if( !empty( $settings['letter-spacing'] ) ) {
                
                $settings['letter-spacing'] = preg_replace( "/px/", "", $settings['letter-spacing'] );                   
                $css .= 'letter-spacing: ' . $settings['letter-spacing'] . $letter_spacing_unit . ';'. "\n";
                
            }
            
            /* text-align */
            if( !empty( $settings['text-align'] ) ) {
                $css .= 'text-align: ' . $settings['text-align'] . ';'. "\n";
            }                        
            
        $css .= '}';
        
        /* return css string */
        return $css;        
        
    }

}


/** 
 * Parses CSS fields from Theme Options into the Theme Header
 *
 * @return    string
 *
 * @access    private
 * @since     1.0.0
 * @version   1.1.0
 */
 
if( !function_exists('_ut_theme_css_parser') ) {

    function _ut_theme_css_parser() {
        
        $recognized_css_fields = array(
            'background',            
            'css',
            'colorpicker',
            'measurement',
            'typography'
        );
                
        /* start css */        
        $css = '<style type="text/css">' . "\n";
        
        /* get theme options array */
        $theme_options = ut_theme_options();
        
        /* get saved theme options array */
        $saved_options = get_option( ut_options_key() );
        
        if( !empty( $theme_options['settings'] )  && is_array( $theme_options['settings'] ) ) {
        
            foreach( (array) $theme_options['settings'] as $settings_key => $setting ) {
                                    
                /* check for selector and for options type */
                if( !empty( $setting['selector'] ) && isset( $setting['type'] ) && in_array( $setting['type'], $recognized_css_fields ) || isset( $setting['type'] ) && $setting['type'] === 'css' ) {
                                        
                    /* get saved option */
                    if( !empty( $saved_options ) && is_array( $saved_options ) ) {
                        
                        foreach( (array) $saved_options as $options_key => $option ) {
                            
                            /* we have a match */
                            if( $setting['id'] == $options_key && ( is_array( $option ) && array_filter( $option ) && $setting['type'] != 'css' ) ) {
                                
                                /* render css */
                                $css .= call_user_func( '_ut_theme_create_css_' . $setting['type'], $setting['selector'], $option );
                                
                            }
                            
                            if( $setting['id'] == $options_key && $setting['type'] === 'css' ) {
                                
                                /* render css */
                                $css .= $option . "\n";
                            
                            }
                            
                        }
                    
                    }
                
                }
            
            }
        
        }
        
        /* end css */
        $css .= '</style>' . "\n";            
        
        echo apply_filters( 'ut_minify_css', $css );
           
    }
    
    add_action('wp_head' , '_ut_theme_css_parser', 99 );

}