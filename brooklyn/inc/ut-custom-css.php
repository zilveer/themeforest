<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Changes HEX to RGB
 *
 * @param     string     Hex Color.
 * @return    string
 *
 * @access    public
 * @since     1.0
 */

if( !function_exists('ut_hex_to_rgb') ) :

    function ut_hex_to_rgb( $hex ) {
        
        if( empty($hex) ) {
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
 * CSS Minifier
 *
 * @param     string     CSS.
 * @return    string
 *
 * @access    public
 * @since     1.0
 */

if ( !function_exists( 'ut_minify_css' ) ) {
    
    function ut_minify_css( $buffer ) { 
        
        $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
        $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
        return $buffer;
        
    }
    
    add_filter( 'ut-custom-css' , 'ut_minify_css' );
        
}

/**
 * Create Typography Settings
 *
 * @param     array     Font Settings.
 * @return    string
 *
 * @access    public
 * @since     4.0
 */
 
if ( !function_exists( 'ut_create_typography_css' ) ) {
    
    function ut_create_typography_css( $tag = '', $font_settings = '', $color = '' ) { 
        
        if( empty( $tag ) || empty( $font_settings ) ) {
            return;
        }
        
        $font_settings = array_filter( $font_settings );
        
        if( $color ) {
            $font_settings['color'] = $color;            
        }
        
        $font_settings = implode(' ', array_map(
            function ($v, $k) { return sprintf("%s:%s;", $k, $v); },
            $font_settings,
            array_keys( $font_settings )
        ) );
        
        if( $font_settings ) {
            return $tag . '{' . $font_settings . '}';
        }
        
    }

 }


/**
 * Create Custom Button
 *
 * @param     string    
 * @param     array     Button Settings.
 * @return    string
 *
 * @access    public
 * @since     1.0
 */

if( !function_exists('ut_create_button_style') ) :
    
    function ut_create_button_style( $div = '' , $button_settings = array() ) {
        
        if( empty($div) || empty($button_settings) ) {
            
            // nothing to do here, let's leave
            return;
            
        }
        
        $button = $div . '{';
            
            if( !empty( $button_settings['font-size'] ) ) {
            
                $button.= 'font-size:' . $button_settings['font-size'] . ' !important;';
            
            }
            
            if( !empty( $button_settings['text-transform'] ) ) {
            
                $button.= 'text-transform:' . $button_settings['text-transform'] . ' !important;';
            
            }
                        
            if( !empty( $button_settings['color'] ) ) {
            
                $button.= 'background:' . $button_settings['color'] . ' !important;';
            
            }
            
            if( !empty( $button_settings['text_color'] ) ) {
            
                $button.= 'color:' . $button_settings['text_color'] . ' !important;';
            
            }
            
            if( !empty( $button_settings['border_radius'] ) ) {
            
                $button.= 'border-radius:' . $button_settings['border_radius'] . 'px !important;';
            
            }
            
            if( !empty( $button_settings['border_color'] ) ) {
            
                $button.= 'border-color:' . $button_settings['border_color'] . ' !important;';
            
            } else {
            
                $button.= 'border: none !important;';
            
            }
            
            $button.= 'padding:0.8em 1em;';
            $button.= 'letter-spacing: 1px;';                    
            $button.= '-webkit-transition:0.2s all linear; -moz-transition:0.2s all linear; transition:0.2s all linear;';
            
            
        $button.= '}';
        
        $button.= $div.':hover {';
            
            if( !empty($button_settings['hover_color'] ) ) {
            
                $button.= 'background:' . $button_settings['hover_color'] . ' !important;';
            
            } 
            
            if( !empty($button_settings['text_hover_color'] ) ) {
            
                $button.= 'color:' . $button_settings['text_hover_color'] . ' !important;';
            
            }  
            
            if( !empty($button_settings['border_hover_color'] ) ) {
            
                $button.= 'border-color:' . $button_settings['border_hover_color'] . ' !important;';
            
            } 
            
        $button.= '}';
        
        return $button;
        
    }    

endif;


/*
|--------------------------------------------------------------------------
| Create Section Headline Style
|--------------------------------------------------------------------------
*/
if( !function_exists('create_section_headline_style') ) :

    function create_section_headline_style( $div = '',  $style = 'pt-style-1' , $color = '' , $height = '' , $width = '' ) {
        
        if( empty( $color ) ) {
            
            // nothing to do here, let's leave
            return;
            
        }
                
        switch ( $style ) {
            
            case 'pt-style-1':
                
                return '
                    ' . $div . ' .pt-style-1 .section-title span,
                    ' . $div . ' .pt-style-1 .page-title span {
                        background: ' . $color . ';
                    }
                ';
                
            break;
            
            case 'pt-style-2':
                
                return '
                '.$div.' .pt-style-2 .page-title:after, 
                '.$div.' .pt-style-2 .parallax-title:after, 
                '.$div.' .pt-style-2 .section-title:after {
                    background-color: ' . $color . ';
                    height: ' . $height .';
                    width: ' . $width . ';
                }';
                
            break;
            
            case 'pt-style-3':
                
                return '
                    '.$div.' .pt-style-3 .page-title span, 
                    '.$div.' .pt-style-3 .parallax-title span, 
                    '.$div.' .pt-style-3 .section-title span { 
                        background:' . $color . ';            
                        -webkit-box-shadow:0 0 0 3px' . $color . '; 
                        -moz-box-shadow:0 0 0 3px' . $color . '; 
                        box-shadow:0 0 0 3px' . $color . '; 
                    }
                ';                
                
            break;
            
            case 'pt-style-4':
                
                return '
                '.$div.' .pt-style-4 .page-title span, 
                '.$div.' .pt-style-4 .parallax-title span, 
                '.$div.' .pt-style-4 .section-title span {
                    border:3px solid ' . $color . ';
                }';
                
            break;
            
            case 'pt-style-5':
                
                return '
                '.$div.' .pt-style-5 .page-title span, 
                '.$div.' .pt-style-5 .parallax-title span, 
                '.$div.' .pt-style-5 .section-title span {
                    background:' . $color . ';            
                    -webkit-box-shadow:0 0 0 3px' . $color . '; 
                    -moz-box-shadow:0 0 0 3px' . $color . '; 
                    box-shadow:0 0 0 3px' . $color . '; 
                }';
                
            break;
            
            
            case 'pt-style-6':
                
                return '
                '.$div.' .pt-style-6 .page-title:after, 
                '.$div.' .pt-style-6 .parallax-title:after, 
                '.$div.' .pt-style-6 .section-title:after {
                    border-bottom: 1px dotted ' . $color . ';
                }';
            
            break;
            
            
        }
        
    }

endif;


/*
|--------------------------------------------------------------------------
| Create Custom Background
|--------------------------------------------------------------------------
*/

if ( !function_exists( 'ut_create_css_background' ) ) {
    
    function ut_create_css_background( $object , $background_settings ) { 
                
        /* no settings array or html object = leave here */    
        if( !is_array($background_settings) || empty($object) ) {
            return NULL;
        }
                
        $skipfixed = false;
        
        $css = $object . '{';
        
        $key_exceptions = array( 'background-color' , 'background-image' , 'background-size' );
        
        /* exception for mobiles and tablets */
        if( unite_mobile_detection()->isMobile() && ( isset($background_settings['background-size']) && $background_settings['background-size'] == 'cover' ) && ( isset($background_settings['background-attachment']) && $background_settings['background-attachment'] == 'fixed' ) ) {
            $skipfixed = true;
        }
        
        foreach( $background_settings as $key => $value) {            
            
            if( in_array( $key , $key_exceptions ) ) {
                
                switch( $key ) {
                    
                    case 'background-color' : $css .= 'background: '.$value.';';
                    break;
                    
                    case 'background-image' : $css .= $key . ':' . 'url("'.$value.'");';
                    break;
                    
                    case 'background-size' : $css .= $key . ':' . $value . ' !important;';
                    
                }
                
            } else {
                
                if($skipfixed && $key == 'background-attachment') {    
                   
                   continue; 
                
                } else {
                
                    $css .= $key . ':' . $value . ' !important;';
                
                }
                
            }
            
        }
        
        $css .= '}';
        
        return $css;
                    
    }
    
}

/*
|--------------------------------------------------------------------------
| Create Global Headline Style ( Fallback Function )
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'ut_create_global_headline_font_style' ) ) {

    function ut_create_global_headline_font_style( $object = '', $font_style = '', $global_font_type = 'ut_global_headline_font_type', $global_google_font_style = 'ut_global_google_headline_font_style', $ut_global_headline_font_style = 'ut_global_headline_font_style', $ut_global_headline_font_style_settings = 'ut_global_headline_font_style_settings', $ut_global_headline_websafe_font_style = 'ut_global_headline_websafe_font_style_settings', $ut_global_headline_font_color = 'ut_global_headline_font_color' ) {
        
        if( empty( $object ) ) {
            return;
        }
    
        $font = $font_attr = $font_color = NULL;
        $google_fonts              = ut_recognized_google_fonts();
        $ut_recognized_font_styles = ut_recognized_font_styles();
        
        $font_styles = array(
            'regular' => 'normal',
            'normal'  => 'normal',
            'italic'  => 'italic'
        );
        
        /* font settings */
        if( $ut_global_headline_font_style_settings ) {
        
            $font_settings = ot_get_option( $ut_global_headline_font_style_settings );
            if( $font_settings && array_filter( $font_settings ) ) {
            
                $font_attr = implode(';', array_map(
                    function ($v, $k) { return sprintf("%s:%s", $k, $v); },
                    array_filter( $font_settings ),
                    array_keys( array_filter( $font_settings ) )
                ));
            
            }
        
        }
        
        /* global font color */
        if( ot_get_option($ut_global_headline_font_color) ) {
            
            $font_color = 'color: ' . ot_get_option($ut_global_headline_font_color) . ';';   
        
        }
        
        
        if( !empty( $font_style ) && $font_style != 'global' ) {
            
            return $object . '{ font-family: ' . $ut_recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; ' . $font_attr . '; ' . $font_color . ' }'. "\n";
        
        } else {
            
            if( ot_get_option( $global_font_type , 'ut-font') == 'ut-google' ) {
            
                $ut_global_google_headline_font_style = ot_get_option($global_google_font_style);                
                
                if( !empty($google_fonts[$ut_global_google_headline_font_style['font-id']]['family']) ) {
                
                    $font .= $object . ' {';
                        
                        $font .= 'font-family:"'.$google_fonts[$ut_global_google_headline_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                        
                        if( !empty($ut_global_google_headline_font_style['font-weight']) ) {
                            $font .= ' font-weight: ' . $ut_global_google_headline_font_style['font-weight'] . ';';    
                        }
                        
                        if( !empty($ut_global_google_headline_font_style['font-size']) ) {
                            $font .= ' font-size: ' . $ut_global_google_headline_font_style['font-size'] . ';';    
                        }
                        
                        if( !empty($ut_global_google_headline_font_style['font-style']) && isset($font_styles[$ut_global_google_headline_font_style['font-style']]) ) {
                            $font .= ' font-style: ' . $font_styles[$ut_global_google_headline_font_style['font-style']] . ';';    
                        }
                        
                        if( !empty($ut_global_google_headline_font_style['line-height']) ) {
                            $font .= ' line-height: ' . $ut_global_google_headline_font_style['line-height'] . ';';    
                        }
                        
                        if( !empty($ut_global_google_headline_font_style['text-transform']) ) {
                            $font .= ' text-transform: ' . $ut_global_google_headline_font_style['text-transform'] . ';';    
                        }
                        
                        $font .= $font_color;
                        
                    $font .= '}';
                    
                    return $font;
                
                } else {
                    
                    /* fallback if user has not chosen a google font yet */
                    $font_style = ot_get_option( $ut_global_headline_font_style , 'semibold' );
                    return $object . '{ font-family: ' . $ut_recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; ' . $font_attr . ' ' . $font_color . ' }'. "\n";
                    
                }
            
            } elseif( ot_get_option( $global_font_type , 'ut-font') == 'ut-websafe' ) {
                
                return ut_create_typography_css( $object, ot_get_option( $ut_global_headline_websafe_font_style , 'semibold' ), ot_get_option($ut_global_headline_font_color) ) ;
                
            } else {
                
                /* font face */
                $font_style = ot_get_option( $ut_global_headline_font_style , 'semibold' );
                return $object . '{ font-family: ' . $ut_recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; ' . $font_attr . ' ' . $font_color . ' }'. "\n";
            
            }
            
        }
        
    }

}

/*
|--------------------------------------------------------------------------
| Start Custom CSS
|--------------------------------------------------------------------------
*/
if ( !function_exists( 'unitedthemes_custom_css' ) ) {
       
    function unitedthemes_custom_css() {
        
        global $post;
                
        /* check for css cache */
        if( ot_get_option('ut_use_cache' , 'off') == 'on' && is_front_page() ) {
            
            $transient_prefix = unite_mobile_detection()->isMobile() ? '_mobile' : '_desktop';
            $ssl_prefix = is_ssl() ? '_ssl' : '_no_ssl'; 
            $language_prefix =  defined('ICL_LANGUAGE_CODE') ? '_' . ICL_LANGUAGE_CODE : '';
            
            $css = get_transient('ut_css_cache' . $transient_prefix . $language_prefix . $ssl_prefix );
            
            if( !empty( $css ) ) {
                echo apply_filters( 'ut-custom-css', $css );
                return;
            }
        
        }
        
        /* some needed variables first */
        $accentcolor      = get_option('ut_accentcolor' , '#F1C40F');
        $google_fonts     = ut_recognized_google_fonts();
        $ut_recognized_font_styles = ut_recognized_font_styles();
        $font_styles = array(
            'regular' => 'normal',
            'normal'  => 'normal',
            'italic'  => 'italic'
        );
        
        /* styleswitcher */
        if( !empty( $_GET['color'] ) ) {
            $accentcolor = '#'.$_GET['color'];
        }
                
        ob_start(); ?>
        
        <style type="text/css">
            
            <?php if( is_single() || is_home() ) : ?>
                
                /* sidebar align */
                #primary { 
                    float: <?php echo ot_get_option('ut_sidebar_align' , 'right') == 'right' ? 'left' : 'right'; ?> ; 
                }   
            
            <?php endif; ?>            
            
            ::-moz-selection { 
                background: <?php echo $accentcolor; ?>; 
            }
            
            ::selection { 
                background: <?php echo $accentcolor; ?>; 
            }
            
            a { 
                color: <?php echo $accentcolor; ?>; 
            }
            
            .ha-transparent #navigation ul li a:hover { 
                color: <?php echo $accentcolor; ?>; 
            }
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_headline_color') ) : ?>
            
            /* Sidebar Widget Title */
            #ut-sitebody #secondary .widget-title,
            #ut-sitebody #secondary .widget-title a,
            #ut-sitebody #secondary .widget-title a:hover,
            #ut-sitebody #secondary .widget-title a:focus,
            #ut-sitebody #secondary .widget-title a:active,
            #ut-sitebody #secondary h1,
            #ut-sitebody #secondary h2,
            #ut-sitebody #secondary h3,
            #ut-sitebody #secondary h4,
            #ut-sitebody #secondary h5,
            #ut-sitebody #secondary h6 {
                color:<?php echo ot_get_option('ut_global_sidebar_widgets_headline_color'); ?> !important;
            }
            
            <?php endif; ?>
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_text_color') ) : ?>
             
            /* Sidebar Color */
            #ut-sitebody #secondary,
            #ut-sitebody #secondary select,
            #ut-sitebody #secondary textarea,
            #ut-sitebody #secondary input[type="text"],
            #ut-sitebody #secondary input[type="tel"],
            #ut-sitebody #secondary input[type="email"],
            #ut-sitebody #secondary input[type="password"],
            #ut-sitebody #secondary input[type="number"],
            #ut-sitebody #secondary input[type="search"] {
                color:<?php echo ot_get_option('ut_global_sidebar_widgets_text_color'); ?> !important;
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_text_font_size') ) : ?>
            
            /* Sidebar Font Size */
            #ut-sitebody #secondary,
            #ut-sitebody #secondary select,
            #ut-sitebody #secondary textarea,
            #ut-sitebody #secondary input[type="text"],
            #ut-sitebody #secondary input[type="tel"],
            #ut-sitebody #secondary input[type="email"],
            #ut-sitebody #secondary input[type="password"],
            #ut-sitebody #secondary input[type="number"],
            #ut-sitebody #secondary input[type="search"] {
                font-size:<?php echo ot_get_option('ut_global_sidebar_widgets_text_font_size'); ?> !important;
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_link_color') ) : ?>
            
            /* Sidebar Link */
            #ut-sitebody #secondary a {
                color:<?php echo ot_get_option('ut_global_sidebar_widgets_link_color'); ?> !important;   
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_link_color_hover') ) : ?>
            
            /* Sidebar Link Hover */
            #ut-sitebody #secondary a:hover,
            #ut-sitebody #secondary a:focus,
            #ut-sitebody #secondary a:active {
                color:<?php echo ot_get_option('ut_global_sidebar_widgets_link_color_hover'); ?> !important;   
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_border_color') ) : ?>
             
            /* Sidebar Border Color */
            #ut-sitebody #secondary li,
            #ut-sitebody #secondary .ut-archive-tags a,
            #ut-sitebody #secondary .widget_tag_cloud a,
            #ut-sitebody #secondary table,
            #ut-sitebody #secondary tr,
            #ut-sitebody #secondary td,
            #ut-sitebody #secondary select,
            #ut-sitebody #secondary textarea,
            #ut-sitebody #secondary input[type="text"],
            #ut-sitebody #secondary input[type="tel"],
            #ut-sitebody #secondary input[type="email"],
            #ut-sitebody #secondary input[type="password"],
            #ut-sitebody #secondary input[type="number"],
            #ut-sitebody #secondary input[type="search"] {
                border-color:<?php echo ot_get_option('ut_global_sidebar_widgets_border_color'); ?> !important;
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_border_color_hover') ) : ?>
            
            /* Sidebar Border Color Hover */
            #ut-sitebody #secondary select:active,
            #ut-sitebody #secondary textarea:active,
            #ut-sitebody #secondary input[type="text"]:active,
            #ut-sitebody #secondary input[type="tel"]:active,
            #ut-sitebody #secondary input[type="email"]:active,
            #ut-sitebody #secondary input[type="password"]:active,
            #ut-sitebody #secondary input[type="number"]:active,
            #ut-sitebody #secondary input[type="search"]:active,
            #ut-sitebody #secondary select:focus,
            #ut-sitebody #secondary textarea:focus,
            #ut-sitebody #secondary input[type="text"]:focus,
            #ut-sitebody #secondary input[type="tel"]:focus,
            #ut-sitebody #secondary input[type="email"]:focus,
            #ut-sitebody #secondary input[type="password"]:focus,
            #ut-sitebody #secondary input[type="number"]:focus,
            #ut-sitebody #secondary input[type="search"]:focus,
            #ut-sitebody #secondary .ut-archive-tags a:hover,
            #ut-sitebody #secondary .widget_tag_cloud a:hover,
            #ut-sitebody #secondary .ut-archive-tags a:active,
            #ut-sitebody #secondary .widget_tag_cloud a:active,
            #ut-sitebody #secondary .ut-archive-tags a:focus,
            #ut-sitebody #secondary .widget_tag_cloud a:focus {
                border-color:<?php echo ot_get_option('ut_global_sidebar_widgets_border_color_hover'); ?> !important;
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_icon_color') ) : ?>
            
            /* Sidebar Icons */
            #ut-sitebody #secondary .fa,
            #ut-sitebody #secondary  a .fa,
            #ut-sitebody #secondary .widget_categories li::before, 
            #ut-sitebody #secondary .widget_pages li::before, 
            #ut-sitebody #secondary .widget_nav_menu li::before, 
            #ut-sitebody #secondary .widget_recent_entries li::before, 
            #ut-sitebody #secondary .widget_meta li::before, 
            #ut-sitebody #secondary .widget_archive li::before,
            #ut-sitebody #secondary .ut_widget_contact .ut-address::before, 
            #ut-sitebody #secondary .ut_widget_contact .ut-phone::before, 
            #ut-sitebody #secondary .ut_widget_contact .ut-fax::before, 
            #ut-sitebody #secondary .ut_widget_contact .ut-email::before, 
            #ut-sitebody #secondary .ut_widget_contact .ut-internet::before,
            #ut-sitebody #secondary .tweet_list li::before {
                color:<?php echo ot_get_option('ut_global_sidebar_widgets_icon_color'); ?> !important;   
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_global_sidebar_widgets_icon_color_hover') ) : ?>
            
            /* Sidebar Icons Hover */
            #ut-sitebody #secondary a:hover .fa,
            #ut-sitebody #secondary a:active .fa,
            #ut-sitebody #secondary a:focus .fa {
                color:<?php echo ot_get_option('ut_global_sidebar_widgets_icon_color_hover'); ?> !important;   
            }
            
            <?php endif; ?>
            
        </style>
        
        <?php
        
        $css = ob_get_clean();
        
        
        
        
        
        
        
        
        
        /* start css */
        $css .= '<style type="text/css">'. "\n";
            
            
            /* themecolor / accentcolor elements */                      
            $css .= '.ut-language-selector a:hover { color: ' . $accentcolor . '; }' . "\n";
            $css .= '.ut-custom-icon-link:hover i { color: ' . $accentcolor . ' !important; }' . "\n";    
            $css .= '.ut-hide-member-details:hover, #ut-blog-navigation a:hover, .light .ut-hide-member-details, .ut-mm-button:hover:before, .ut-mm-trigger.active .ut-mm-button:before, .ut-mobile-menu a:after { color: ' . $accentcolor . '; }'. "\n";            
            $css .= '.ut-header-light .ut-mm-button:before { color: ' . $accentcolor . '; }';
            $css .= '.lead span, .entry-title span, #cancel-comment-reply-link, .member-description-style-3 .ut-member-title,  .ut-twitter-rotator h2 a, .themecolor  { color: ' . $accentcolor . '; }'. "\n";            
            $css .= '.icons-ul i, .comments-title span, .member-social a:hover, .ut-parallax-quote-title span, .ut-member-style-2 .member-description .ut-member-title { color:' . $accentcolor . '; }'. "\n";        
            $css .= '.about-icon, .ut-skill-overlay, .ut-dropcap-one, .ut-dropcap-two, .ut-mobile-menu a:hover, .themecolor-bg, .ut-btn.ut-pt-btn:hover, .ut-btn.dark:hover { background:' . $accentcolor . '; }'. "\n";
            $css .= 'blockquote, div.wpcf7-validation-errors, .ut-hero-style-5 .hero-description, #navigation ul.sub-menu, .ut-member-style-3 .member-social a:hover { border-color:' . $accentcolor . '; }'. "\n";
            $css .= '.cta-section, .ut-btn.theme-btn, .ut-social-link:hover .ut-social-icon, .ut-member-style-2 .ut-so-link:hover { background:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.ut-social-title, .ut-service-column h3 span, .ut-rq-icon  { color:' . $accentcolor . '; }'. "\n";
            $css .= '.count, .ut-icon-list i { color:' . $accentcolor . '; }'. "\n";
            $css .= '.client-section, .ut-portfolio-pagination.style_two a.selected:hover, .ut-portfolio-pagination.style_two a.selected, .ut-portfolio-pagination.style_two a:hover, .ut-pt-featured { background:' . $accentcolor . ' !important; }'. "\n";
            $css .= 'ins, mark, .ut-alert.themecolor, .ut-portfolio-menu.style_two li a:hover, .ut-portfolio-menu.style_two li a.selected, .light .ut-portfolio-menu.style_two li a.selected:hover { background:' . $accentcolor . '; }'. "\n";
            $css .= '.footer-content i { color:' . $accentcolor . '; }'. "\n";
            $css .= '.copyright a:hover, .footer-content a:hover, .toTop:hover, .ut-footer-dark a.toTop:hover { color:' . $accentcolor . '; }'. "\n";
            $css .= 'blockquote span { color:' . $accentcolor . '; }'. "\n";
            $css .= '.entry-meta a:hover, #secondary a:hover, .page-template-templatestemplate-archive-php a:hover { color:' . $accentcolor . '; }'. "\n";
            $css .= 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .ut-header-dark .site-logo .logo a:hover { color:' . $accentcolor . '; }'. "\n";    
            $css .= 'a.more-link:hover, .fa-ul li .fa  { color:' . $accentcolor . '; }'. "\n";    
            $css .= '.ut-pt-featured-table .ut-pt-info .fa-li  { color: ' . $accentcolor . ' !important; }' . "\n";            
            $css .= '.button, input[type="submit"], input[type="button"], .dark button, .dark input[type="submit"], .dark input[type="button"], .light .button, .light input[type="submit"], .light input[type="button"] { background:' . $accentcolor . '; }'. "\n";
            $css .= '.img-hover { background:rgb(' . ut_hex_to_rgb($accentcolor) . ');    background:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.85); }'. "\n";
            $css .= '.portfolio-caption { background:rgb(' . ut_hex_to_rgb($accentcolor) . ');    background:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.85); }'. "\n";
            $css .= '.team-member-details { background:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.85 ); }'. "\n";
            $css .= '.ut-avatar-overlay { background:rgb(' . ut_hex_to_rgb($accentcolor) . '); background:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.85 ); }'. "\n";
            $css .= '.mejs-controls .mejs-time-rail .mejs-time-current, .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current, .format-link .entry-header a { background:' . $accentcolor . ' !important; }'. "\n";                        
            $css .= '.light .ut-portfolio-menu li a:hover, .light .ut-portfolio-pagination a:hover, .light .ut-nav-tabs li a:hover, .light .ut-accordion-heading a:hover { border-color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.light .ut-portfolio-menu li a:hover, .light .ut-portfolio-pagination a:hover, .ut-portfolio-list li strong, .light .ut-nav-tabs li a:hover, .light .ut-accordion-heading a:hover, .ut-custom-icon a:hover i:first-child { color:' . $accentcolor . ' !important; }'. "\n";            
            $css .= '.ut-portfolio-gallery-slider .flex-direction-nav a, .ut-gallery-slider .flex-direction-nav a, .ut-rotate-quote-alt .flex-direction-nav a, .ut-rotate-quote .flex-direction-nav a  { background:rgb(' . ut_hex_to_rgb($accentcolor) . '); background:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.85); }'. "\n";            
            $css .= '.light .ut-bs-wrap .entry-title a:hover, .light .ut-bs-wrap a:hover .entry-title  { color: ' . $accentcolor . '; }'. "\n";                
            $css .= '.ut-rated i { color: ' . $accentcolor . '; }'. "\n";
            $css .= '.ut-footer-area ul.sidebar a:hover { color: ' . $accentcolor . '; }'. "\n";  
            $css .= '.ut-footer-dark .ut-footer-area .widget_tag_cloud a:hover { color: ' . $accentcolor . '!important; }'. "\n";
            $css .= '.ut-footer-dark .ut-footer-area .widget_tag_cloud a:hover { border-color: ' . $accentcolor . '; }'. "\n";
            $css .= '.elastislide-wrapper nav span:hover { border-color: ' . $accentcolor . '; }'. "\n";
            $css .= '.elastislide-wrapper nav span:hover { color: ' . $accentcolor . '; }'. "\n";            
            $css .= '.ut-footer-so li a:hover { border-color: ' . $accentcolor . '; }'. "\n";
            $css .= '.ut-footer-so li a:hover i { color: ' . $accentcolor . '!important; }'. "\n";
            $css .= '.ut-pt-wrap.ut-pt-wrap-style-2 .ut-pt-featured-table .ut-pt-header { background:' . $accentcolor . '; }'. "\n";
            $css .= '.ut-pt-wrap-style-3 .ut-pt-info ul li, .ut-pt-wrap-style-3 .ut-pt-info ul, .ut-pt-wrap-style-3 .ut-pt-header, .ut-pt-wrap-style-3 .ut-btn.ut-pt-btn, .ut-pt-wrap-style-3 .ut-custom-row, .ut-pt-wrap-style-3 .ut-pt-featured-table .ut-btn { border-color:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.1); }'. "\n";  
            
            $css .= '.ut-pt-wrap-style-3 .ut-btn { color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.ut-pt-wrap-style-3 .ut-btn { text-shadow: 0 0 40px ' . $accentcolor . ', 2px 2px 3px black; }'. "\n";
            $css .= '.ut-pt-wrap-style-3 .ut-pt-featured-table .ut-btn { color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.ut-pt-wrap-style-3 .ut-pt-featured-table .ut-btn { text-shadow: 0 0 40px ' . $accentcolor . ', 2px 2px 3px black; }'. "\n";
            
            $css .= '.ut-pt-wrap-style-3 .ut-pt-featured-table .ut-pt-title { color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.ut-pt-wrap-style-3 .ut-pt-featured-table .ut-pt-title { text-shadow: 0 0 40px ' . $accentcolor . ', 2px 2px 3px black; }'. "\n";
            
            
            $css .= '.site-logo img { max-height: ' . ot_get_option('ut_site_logo_max_height' , '60') . 'px; }';
            
            
            
            /*
            |--------------------------------------------------------------------------
            | Glow Effect
            |--------------------------------------------------------------------------
            */
            $css .= '.ut-glow {
                color:'.$accentcolor.';
                text-shadow:0 0 40px '.$accentcolor.', 2px 2px 3px black; 
            }';
            
            /*
            |--------------------------------------------------------------------------
            | NEW Video Shortcode
            |--------------------------------------------------------------------------
            */
            
            $css .= '.light .ut-shortcode-video-wrap .ut-video-caption { border-color:rgba(' . ut_hex_to_rgb($accentcolor) . ', 1); }'. "\n";  
            $css .= '.light .ut-shortcode-video-wrap .ut-video-caption i { border-color:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.3); }'. "\n";
            $css .= '.light .ut-shortcode-video-wrap .ut-video-caption i { color:rgba(' . ut_hex_to_rgb($accentcolor) . ', 0.3); }'. "\n";
            
            $css .= '.light .ut-shortcode-video-wrap .ut-video-caption:hover i { border-color:rgba(' . ut_hex_to_rgb($accentcolor) . ', 1); }'. "\n";
            
            $css .= '.light .ut-shortcode-video-wrap .ut-video-caption:hover i { color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.light .ut-shortcode-video-wrap .ut-video-caption:hover i { text-shadow: 0 0 40px ' . $accentcolor . ', 2px 2px 3px black; }'. "\n";
            
            $css .= '.light .ut-video-loading { color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.light .ut-video-loading { text-shadow: 0 0 40px ' . $accentcolor . ', 2px 2px 3px black; }'. "\n";
            
            $css .= '.light .ut-video-caption-text { border-color:rgba(' . ut_hex_to_rgb($accentcolor) . ', 1); }'. "\n";
           
                      
            
            /*
            |--------------------------------------------------------------------------
            | Section animation
            |--------------------------------------------------------------------------
            */
            
            if( !unite_mobile_detection()->isMobile() && ot_get_option('ut_animate_sections' , 'on') == 'on' ) :
            
                    $css .= '
                    .js #main-content section .section-content,
                    .js #main-content section .section-header-holder {
                        opacity:0;
                    }';
                    
            endif;
            
            
            
            
            
            
            
            
            
            
            
            
            /* deprecated since 4.0.3 */
            $ut_navigation_padding_top      = ut_return_header_config( 'ut_navigation_padding_top' );
            $ut_navigation_padding_bottom   = ut_return_header_config( 'ut_navigation_padding_bottom' );
            
            if( !empty($ut_navigation_padding_top) ) {
            
                $css .= '#header-section { padding-top: ' . $ut_navigation_padding_top . '; }';
            
            }
            
            if( !empty($ut_navigation_padding_bottom) ) {
                
                $css .= '#header-section { padding-bottom: ' . $ut_navigation_padding_bottom . '; }';
            
            }
            
            /* deprecated since 4.0.3 */
            if( ut_return_header_config('ut_navigation_skin' , 'ut-header-light' ) == 'ut-header-light' ) {
                
                $ut_navigation_skin_light_bgcolor = ut_return_header_config('ut_navigation_skin_light_bgcolor');
                
                $ut_navigation_skin_bgcolor_opacity = ut_return_header_config('ut_navigation_skin_bgcolor_opacity');
                $ut_navigation_skin_bgcolor_opacity = !empty( $ut_navigation_skin_bgcolor_opacity ) ? $ut_navigation_skin_bgcolor_opacity : '95';
                
                if( !empty( $ut_navigation_skin_light_bgcolor ) ) {
                    
                    /* add to CSS */
                    $css .= '
                    #header-section.ut-header-light,
                    .ha-header.ha-transparent:hover,
                    .ha-header.ha-transparent:hover #navigation ul.sub-menu,
                    #header-section.ut-header-light #navigation ul.sub-menu {
                        background: rgba(' . ut_hex_to_rgb( $ut_navigation_skin_light_bgcolor ) . ' ,' . ( $ut_navigation_skin_bgcolor_opacity / 100 ) . ' ) ; 
                    }'; 
                    
                }
            
            /* deprecated since 4.0.3 */    
            } else {
                
                $ut_navigation_skin_dark_bgcolor = ut_return_header_config('ut_navigation_skin_dark_bgcolor');
                
                $ut_navigation_skin_bgcolor_opacity = ut_return_header_config('ut_navigation_skin_bgcolor_opacity');
                $ut_navigation_skin_bgcolor_opacity = !empty( $ut_navigation_skin_bgcolor_opacity ) ? $ut_navigation_skin_bgcolor_opacity : '95';
                
                if( !empty( $ut_navigation_skin_dark_bgcolor ) ) {
                    
                    /* add to CSS */
                    $css .= '
                    #header-section.ut-header-dark,
                    .ha-header.ha-transparent:hover,
                    .ha-header.ha-transparent:hover #navigation ul.sub-menu,
                    #header-section.ut-header-dark #navigation ul.sub-menu {
                        background: rgba(' . ut_hex_to_rgb( $ut_navigation_skin_dark_bgcolor ) . ' ,' . ( $ut_navigation_skin_bgcolor_opacity / 100 ) . ' ) ; 
                    }'; 
                    
                }
                    
            }
            
            
            
            
            
            
            if( ut_return_header_config('ut_navigation_shadow' , 'on' ) == 'off' ) {
                
                $css .= '.ha-header { box-shadow:none; }';
                
            }
            
            
            
            /*
            |--------------------------------------------------------------------------
            | Border Settings
            |--------------------------------------------------------------------------
            */
            if( ot_get_option('ut_site_border', 'hide' ) == 'show' ) { 
                
                $ut_site_border_color = ot_get_option( 'ut_site_border_color', '#FFF' );
                
                /* html border */
                $css .= 'html { background: ' . $ut_site_border_color . '; margin-left:30px; margin-right: 30px; }';
                
                if( ot_get_option('ut_site_border_body_color' ) ) {
                    
                    $css .= 'body, #main-content { background: ' . ot_get_option('ut_site_border_body_color' ) . '; }';
                
                }
                
                //$css .= '.ut-site-border .vc_row-has-fill { border-left:30px solid ' . $ut_site_border_color . ' ; border-right:30px solid ' . $ut_site_border_color . '; }';
                
                /* top header background */
                $css .= '#ut-top-header { background: ' . $ut_site_border_color . '; }';
                
                /* placeholder color */
                if( ut_return_header_config('ut_navigation_state' , 'off') == 'on' ) {
                
                    $css .= '#ut-top-header-placeholder { background: ' . $ut_site_border_color . '; }';
                
                }
                
                /* video position */
                
                if( !is_home() ) {
                
                    $css .= '#wrapper_mbYTP_ut-background-video-hero { min-width: 100% !important; }';
                    
                }
            }
            
            /*
            |--------------------------------------------------------------------------
            | Top Header Settings
            |--------------------------------------------------------------------------
            */
            if( ot_get_option('ut_top_header' , 'hide' ) == 'show' ) { 
                
                /* top header colors */
                $css .= '.ut-header-inner { color: ' . ot_get_option( 'ut_top_header_text_color', '#888' ) . '; }';                
                
                /* left */
                $css .= '#ut-top-header-left .fa { color: ' . ot_get_option( 'ut_top_header_icon_color', '#888' ) . '; }';
                $css .= '#ut-top-header-left a { color: ' . ot_get_option( 'ut_top_header_link_color', '#888' ) . '; }';
                $css .= '#ut-top-header-left a:hover { color: ' . ot_get_option( 'ut_top_header_link_color_hover', $accentcolor ) . '; }';
                
                /* right */
                $css .= '#ut-top-header-right .fa { color: ' . ot_get_option( 'ut_top_header_social_icon_color', '#888' ) . '; }';
                $css .= '#ut-top-header-right .fa:hover { color: ' . ot_get_option( 'ut_top_header_social_icon_color_hover', $accentcolor ) . '; }';
                    
                /* video size */
                $css .= '#ut-hero .ut-video-control, .ut-audio-control { bottom: 50px !important; }';
                
            }
            
            /*
            |--------------------------------------------------------------------------
            | Hero Settings
            |--------------------------------------------------------------------------
            */
                                    
            /* hero global settings */
            $ut_hero_type  = ut_return_hero_config('ut_hero_type');
            $ut_hero_style = ut_return_hero_config('ut_hero_style' , 'ut-hero-style-1');
            
            /* hero color settings */
            $css .= '.hero-title span:not(.ut-word-rotator) { color:' . $accentcolor . ' !important; }'. "\n";
            $css .= '.hero-title.ut-glow span { text-shadow: 0 0 40px ' . $accentcolor . ', 2px 2px 3px black; }'. "\n";
            
            $ut_company_slogan_color = ut_return_hero_config('ut_company_slogan_color');
            if( !empty($ut_company_slogan_color) ) { 
            
                $css .= '.hero-title.ut-glow { 
                    color: '.$ut_company_slogan_color.';
                    text-shadow: 0 0 40px ' . $ut_company_slogan_color . ', 2px 2px 3px black; 
                }'. "\n";            
            
            }           
            
            /* hero font size */
            $ut_hero_font_size = ut_return_hero_config( 'ut_hero_font_size' );
            
                /* add to CSS */
                if( !empty( $ut_hero_font_size ) && $ut_hero_style != 'ut-hero-style-11' ) {
                    $css .= '@media screen and (min-width: 1025px) { .hero-title { font-size: ' . $ut_hero_font_size . ' !important; line-height:1.2em !important; } }';            
                }
            
            /* hero catchphrase font settings */
            $ut_hero_catchphrase_websafe_font_style = ut_return_hero_config( 'ut_hero_catchphrase_websafe_font_style' );
            
                /* add to CSS */
                if( $ut_hero_catchphrase_websafe_font_style ) {
                    $css .= ut_create_typography_css( '#ut-hero .hero-description-bottom', $ut_hero_catchphrase_websafe_font_style );     
                }
                        
            /* hero primary button style for all pages  */            
            if( ut_return_hero_config('ut_main_hero_button_style' , 'default' ) == 'custom') {
                
                $button_settings = ut_return_hero_config('ut_main_hero_button_settings');
                
                /* add to CSS */
                $css.= ut_create_button_style('.hero-btn' , $button_settings );
                
            }
            
            /* hero second button style for all pages */            
            if( ut_return_hero_config('ut_second_hero_button_style' , 'default' ) == 'custom') {
                
                $button_settings = ut_return_hero_config('ut_second_hero_button_settings');
                
                /* add to CSS */
                $css.= ut_create_button_style('.hero-second-btn' , $button_settings );
                
            }            
            
            /* hero border bottom */
            if( ut_return_hero_config('ut_hero_buttons_margin') ) {
                $css.= '#ut-hero .hero-btn-holder { margin-top: ' . ut_return_hero_config('ut_hero_buttons_margin' , 0 ) . '; }';
            }
            
            /* hero border bottom */
            if( ut_return_hero_config('ut_hero_border_bottom' , 'off' ) == 'on') {
               
                /* add to CSS */
                if( ut_return_hero_config('ut_hero_overlay') == 'on') {
                    
                    $css.= '#ut-hero .parallax-overlay { border-bottom: '.ut_return_hero_config('ut_hero_border_bottom_width' , 1 ).'px '.ut_return_hero_config('ut_hero_border_bottom_style' , 'solid' ).' '.ut_return_hero_config('ut_hero_border_bottom_color' , $accentcolor ).'; }';
                    
                } else {
                    
                    $css.= '#ut-hero { border-bottom: '.ut_return_hero_config('ut_hero_border_bottom_width' , 1 ).'px '.ut_return_hero_config('ut_hero_border_bottom_style' , 'solid' ).' '.ut_return_hero_config('ut_hero_border_bottom_color' , $accentcolor ).'; }';
                    
                }
               
            }
            
            /* hero fancy border */
            if( ( is_home() || is_front_page() ) && ut_return_hero_config('ut_hero_fancy_border' , 'off' ) == 'on') {
                
                $css.= '
                #ut-hero .ut-fancy-border { 
                    display: block; 
                    position: absolute; 
                    bottom: 0; 
                    left: 0; 
                    width: 100%; 
                    background:' . ut_return_hero_config( 'ut_hero_fancy_border_background_color' , '#FFF' ) . '; 
                    border-bottom:' . ut_return_hero_config( 'ut_hero_fancy_border_size' , '10px' ) . ';
                    border-color:' . ut_return_hero_config( 'ut_hero_fancy_border_color' , $accentcolor ) . '; 
                    border-style: dashed; 
                    z-index:9999; 
                }';
                
            }
            
            /*
            |--------------------------------------------------------------------------
            | Body Font Style
            |--------------------------------------------------------------------------
            */
            
            if( ot_get_option('ut_body_font_color') ) {
                $css .= 'body .dark { color: ' . ot_get_option('ut_body_font_color') . ' ;}';    
            }
            
            
            if( ot_get_option('ut_body_font_type' , 'ut-font') == 'ut-google' ) {
                
                $ut_google_body_font_style = ot_get_option('ut_google_body_font_style');
                
                if( !empty($google_fonts[$ut_google_body_font_style['font-id']]['family']) ) {
                
                    $css .= 'body {';
                        /* familiy */
                        $css .= 'font-family:"'.$google_fonts[$ut_google_body_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif !important;';                    
                        
                        if( !empty($ut_google_body_font_style['font-weight']) ) {
                            $css .= ' font-weight: ' . $ut_google_body_font_style['font-weight'] . ';';    
                        }
                        
                        if( !empty($ut_google_body_font_style['font-size']) ) {
                            $css .= ' font-size: ' . $ut_google_body_font_style['font-size'] . ';';    
                        }
                        
                        if( !empty($ut_google_body_font_style['font-style']) && isset($font_styles[$ut_google_body_font_style['font-style']]) ) {
                            $css .= ' font-style: ' . $font_styles[$ut_google_body_font_style['font-style']] . ';';    
                        }
                        
                        if( !empty($ut_google_body_font_style['line-height']) ) {
                            $css .= ' line-height: ' . $ut_google_body_font_style['line-height'] . ';';    
                        }
                        
                        if( !empty($ut_google_body_font_style['text-transform']) ) {
                            $css .= ' text-transform: ' . $ut_google_body_font_style['text-transform'] . ';';    
                        }
                        
                    $css .= '}';
                
                } else {
                    
                    /* fallback if user has not chosen a google font yet */
                    $ut_body_font_style = ot_get_option('ut_body_font_style' , 'regular');
                    $css .= 'body { font-family: ' . $ut_recognized_font_styles[$ut_body_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                    
                }
            
            } elseif( ot_get_option('ut_body_font_type' , 'ut-font') == 'ut-websafe' ) {
            
                $css .= ut_create_typography_css( 'body', ot_get_option('ut_body_websafe_font_style') );
                
            } else {
                
                /* out for theme font */
                $ut_body_font_style = ot_get_option('ut_body_font_style' , 'regular');
                $css .= 'body { font-family: ' . $ut_recognized_font_styles[$ut_body_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                            
            }
            
            /*
            |--------------------------------------------------------------------------
            | Global Headlines Font Style
            |--------------------------------------------------------------------------
            */
            $headlines = array('h1','h2','h3','h4','h5','h6');
            
            foreach( $headlines as $headline ) {
                
                $headline_color = ot_get_option('ut_global_'.$headline.'_font_color');
                
                if( $headline_color ) {
                    $css .= '.dark ' . $headline . ' {  color: ' . $headline_color . '; }'. "\n";
                }
                
                if( ot_get_option('ut_global_'.$headline.'_font_type' , 'ut-font') == 'ut-google' ) {
                    
                    $headline_style = ot_get_option('ut_'.$headline.'_google_font_style');
                    
                    if( !empty($google_fonts[$headline_style['font-id']]['family']) ) {
                        
                        $css .= $headline . ' {';
                        
                            /* familiy */
                            $css .= 'font-family:"'.$google_fonts[$headline_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                        
                        if( !empty($headline_style['font-weight']) ) {
                            $css .= ' font-weight: ' . $headline_style['font-weight'] . ';';    
                        }
                        
                        if( !empty($headline_style['font-size']) ) {
                            $css .= ' font-size: ' . $headline_style['font-size'] . ';';    
                        }
                        
                        if( !empty($headline_style['font-style']) ) {
                            $css .= ' font-style: ' . $font_styles[$headline_style['font-style']] . ';';    
                        }
                        
                        if( !empty($headline_style['line-height']) ) {
                            $css .= ' line-height: ' . $headline_style['line-height'] . ';';    
                        }
                        
                        if( !empty($headline_style['text-transform']) ) {
                            $css .= ' text-transform: ' . $headline_style['text-transform'] . ';';    
                        }
                        
                        $css .= '}';                        
                        
                    } else {
                        
                        /* fallback if user has not chosen a google font yet */
                        $headline_style = ot_get_option('ut_'.$headline.'_font_style' , 'semibold');
                        $css .= $headline . ' { font-family: ' . $ut_recognized_font_styles[$headline_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                        
                    }
                    
                } elseif( ot_get_option('ut_global_'.$headline.'_font_type' , 'ut-font') == 'ut-websafe' ) {
                    
                    
                    $css .= ut_create_typography_css( $headline, ot_get_option('ut_'.$headline.'_websafe_font_style'), $headline_color );
                    
                
                } else {
                    
                    /* output for theme font */
                    $headline_style = ot_get_option('ut_'.$headline.'_font_style' , 'semibold');
                    $css .= $headline . ' { font-family: ' . $ut_recognized_font_styles[$headline_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                
                }
                
            }
            
            /*
            |--------------------------------------------------------------------------
            | General Section Headlines
            |--------------------------------------------------------------------------
            */
            
            $css .= create_section_headline_style('', 'pt-style-2', ot_get_option('ut_global_headline_style_2_color'), ot_get_option('ut_global_headline_style_2_height', '1px'), ot_get_option('ut_global_headline_style_2_width', '30px') );
            
            
            
            /**
             * Page Spacing
             */             
            
            if( ot_get_option( 'ut_vc_page_padding' ) == 'off' ) {
                //$css .= '.page #primary, .home #primary, .single #primary { padding-top: 0 !important; }';
                //$css .= '.page #primary, .home #primary, .single #primary { padding-bottom:0 !important; }';
            }
            
            
            
            /*
            |--------------------------------------------------------------------------
            | LightGallery
            |--------------------------------------------------------------------------
            */
            $css .= '.lg-progress-bar .lg-progress { background-color: ' . $accentcolor . '; }';
            $css .= '.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover { border-color: ' . $accentcolor . '; }';
            
            /*
            |--------------------------------------------------------------------------
            | Front Page
            |--------------------------------------------------------------------------
            */
            
            if( is_front_page() ) {
            
                /* front page hero header styling */
                $ut_front_catchphrase_color                 = ut_return_hero_config('ut_hero_catchphrase_color');
                $ut_front_company_slogan_color              = ut_return_hero_config('ut_hero_company_slogan_color');
                $ut_front_expertise_slogan_color            = ut_return_hero_config('ut_hero_expertise_slogan_color');
                $ut_front_expertise_slogan_background_color = ut_return_hero_config('ut_hero_expertise_slogan_background_color');
                
                $ut_front_expertise_margin                  = ot_get_option('ut_front_expertise_margin');    
                
                    /* add to CSS */
                    if( !empty( $ut_front_expertise_slogan_color ) ) {
                        $css.='.hero-description { color: ' . $ut_front_expertise_slogan_color . '}'. "\n";                        
                    }
                    if( !empty( $ut_front_expertise_slogan_background_color ) ) {
                        $css.='.hero-description { background: ' . $ut_front_expertise_slogan_background_color . '; padding-bottom:0; margin-bottom: 5px; }'. "\n";
                    }
                    if( !empty( $ut_front_expertise_margin ) ) {
                        $css.='#ut-hero .hdh { margin-bottom: ' . $ut_front_expertise_margin . '}'. "\n";
                    }                    
                    
                    /* add to CSS */            
                    if( !empty( $ut_front_catchphrase_color ) ) {                    
                        $css.='.hero-description-bottom { color: ' . $ut_front_catchphrase_color . '}'. "\n";                    
                    }
                    
                    /* add to CSS */
                    if( !empty( $ut_front_company_slogan_color ) ) {                    
                        
                        $css.='.hero-title { color: ' . $ut_front_company_slogan_color . ' }'. "\n";
                        $css.='.ut-hero-style-3 .hero-description { border-bottom: 3px solid ' . $ut_front_company_slogan_color . '  }'. "\n"; 
                        $css.='.ut-hero-style-6 .hero-title { border: 1px solid ' . $ut_front_company_slogan_color . '  }'. "\n";
                        $css.='.ut-hero-style-7 .hero-title { border: 3px solid ' . $ut_front_company_slogan_color . '  }'. "\n";
                        $css.='.ut-hero-style-8 .hero-title { border-bottom: 2px solid ' . $ut_front_company_slogan_color . '; border-top: 2px solid ' . $ut_front_company_slogan_color . '  }'. "\n";
                        $css.='.ut-hero-style-9 .hero-title { border-left: 3px solid ' . $ut_front_company_slogan_color . '; border-right: 3px solid ' . $ut_front_company_slogan_color . '  }'. "\n";
                        $css.='.ut-hero-style-10 .hero-title { border-left: 3px dashed ' . $ut_front_company_slogan_color . '; border-right: 3px dashed ' . $ut_front_company_slogan_color . '  }'. "\n";
                        
                    }
                
                    $ut_front_company_slogan_uppercase = ot_get_option('ut_front_company_slogan_uppercase' , 'on');
                
                    /* add to CSS */                
                    if( !empty( $ut_front_company_slogan_uppercase ) && $ut_front_company_slogan_uppercase == 'on' ) {
                        
                        $css.='.hero-title { text-transform: uppercase; }';
                    
                    }
                    
                    $ut_front_company_slogan_letterspacing = ot_get_option('ut_front_company_slogan_letterspacing');                    
                    /* add to CSS */                
                    if( !empty( $ut_front_company_slogan_letterspacing ) ) {
                        
                        $css.='.hero-title { letter-spacing: ' . $ut_front_company_slogan_letterspacing . '; }';
                    
                    }
            
            }
                        
            /* hero holder adjustment when navigation is visible */
            if( (ut_return_header_config('ut_navigation_state') == 'on_transparent' || ut_return_header_config('ut_navigation_state') == 'on') && ( $ut_hero_type == 'splithero' && ut_return_hero_config('ut_hero_split_content_type' , 'image') == 'image' )) {
                $css.= '#ut-hero .hero-holder { margin-top:80px; }';
            }
            
            /* header hero font style for front and blog */
            if( is_front_page() || is_singular('portfolio') || is_page() ) {                
                
                if( ot_get_option('ut_front_hero_font_type' , 'ut-font') == 'ut-google' ) {
                
                    $ut_google_front_page_hero_font_style = ot_get_option('ut_google_front_page_hero_font_style');
                    
                    if( !empty($google_fonts[$ut_google_front_page_hero_font_style['font-id']]['family']) ) {
                                                
                        if( $ut_hero_style == 'ut-hero-style-11') {
                            $css.= '#ut-hero .hdh .hero-description,';
                        }
                        
                        $css .= '.hero-title {';
                            
                            /* familiy */
                            $css .= 'font-family:"'.$google_fonts[$ut_google_front_page_hero_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty($ut_google_front_page_hero_font_style['font-weight']) ) {
                                $css .= ' font-weight: ' . $ut_google_front_page_hero_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty($ut_google_front_page_hero_font_style['font-size']) ) {
                                $css .= ' font-size: ' . $ut_google_front_page_hero_font_style['font-size'] . ';';    
                            }
                            
                            if( !empty($ut_google_front_page_hero_font_style['font-style']) ) {
                                $css .= ' font-style: ' . $font_styles[$ut_google_front_page_hero_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty($ut_google_front_page_hero_font_style['line-height']) ) {
                                $css .= ' line-height: ' . $ut_google_front_page_hero_font_style['line-height'] . ';';    
                            }
                            
                            if( !empty($ut_google_front_page_hero_font_style['text-transform']) ) {
                                $css .= ' text-transform: ' . $ut_google_front_page_hero_font_style['text-transform'] . ';';    
                            }
                            
                        $css .= '}';
                    
                    } else {
                        
                        /* fallback if user has not chosen a google font yet */
                        $ut_header_hero_font_style = ot_get_option('ut_front_page_hero_font_style' , 'semibold');
                        
                        if( $ut_hero_style == 'ut-hero-style-11') {
                            $css.= '#ut-hero .hdh .hero-description,';
                        }                        
                        
                        $css .= '.hero-title { font-family: ' . $ut_recognized_font_styles[$ut_header_hero_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                        
                    }
                
                } elseif( ot_get_option('ut_front_hero_font_type' , 'ut-font') == 'ut-websafe' ) {
                    
                    /* design exception for hero */ 
                    if( $ut_hero_style == 'ut-hero-style-11') {
                        $css.= '#ut-hero .hdh .hero-description,';
                    }
                    
                    $css .= ut_create_typography_css('.hero-title', ot_get_option('ut_front_page_hero_websafe_font_style') );
                    
                } else {
                    
                    /* out for theme font */
                    $ut_hero_font_style = ut_return_hero_config('ut_hero_font_style' , 'semibold');
                    
                    /* design exception for hero */ 
                    if( $ut_hero_style == 'ut-hero-style-11') {
                        $css.= '#ut-hero .hdh .hero-description,';
                    }
                    
                    $css .= '.hero-title { font-family: ' . $ut_recognized_font_styles[$ut_hero_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                                
                }

                
            }
            
            if( is_home() ) {
                
                if( ot_get_option('ut_blog_hero_font_type' , 'ut-font') == 'ut-google' ) {
            
                    $ut_google_blog_hero_font_style = ot_get_option('ut_google_blog_hero_font_style');
                    
                    if( !empty($google_fonts[$ut_google_blog_hero_font_style['font-id']]['family']) ) {
                        
                        /* design exception for hero */
                        if( $ut_hero_style == 'ut-hero-style-11') {
                            $css.= '#ut-hero .hdh .hero-description,';
                        }
                        
                        $css .= '.hero-title {';
                            /* familiy */
                            $css .= 'font-family:"'.$google_fonts[$ut_google_blog_hero_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty($ut_google_blog_hero_font_style['font-weight']) ) {
                                $css .= ' font-weight: ' . $ut_google_blog_hero_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty($ut_google_blog_hero_font_style['font-size']) ) {
                                $css .= ' font-size: ' . $ut_google_blog_hero_font_style['font-size'] . ';';    
                            }
                            
                            if( !empty($ut_google_blog_hero_font_style['font-style']) ) {
                                $css .= ' font-style: ' . $font_styles[$ut_google_blog_hero_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty($ut_google_blog_hero_font_style['line-height']) ) {
                                $css .= ' font-style: ' . $ut_google_blog_hero_font_style['line-height'] . ';';    
                            }
                            
                            if( !empty($ut_google_blog_hero_font_style['text-transform']) ) {
                                $css .= ' text-transform: ' . $ut_google_blog_hero_font_style['text-transform'] . ';';    
                            }
                            
                        $css .= '}';
                    
                    } else {
                        
                        /* fallback if user has not chosen a google font yet */
                        $ut_header_hero_font_style = ot_get_option('ut_blog_hero_font_style' , 'semibold');    
                        $css .= '.hero-title { font-family: ' . $ut_recognized_font_styles[$ut_header_hero_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                        
                    }
                    
                } elseif( ot_get_option('ut_blog_hero_font_type' , 'ut-font') == 'ut-websafe' ) {
                    
                    $css .= ut_create_typography_css('.hero-title', ot_get_option('ut_blog_hero_websafe_font_style') );
                    
                } else {
                    
                    /* out for theme font */
                    $ut_header_hero_font_style = ot_get_option('ut_blog_hero_font_style' , 'semibold');    
                    $css .= '.hero-title { font-family: ' . $ut_recognized_font_styles[$ut_header_hero_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                                
                }

            }
            
            
            /* hero header background image for tablet slider */
            if( $ut_hero_type == 'tabs' ) {
                
                $ut_tabs_headline_style = ut_return_hero_config('ut_tabs_headline_style' , 'semibold');
                $css .= ut_create_global_headline_font_style('.ut-tablets-title' , $ut_tabs_headline_style);
                
                /* hero type tabs uses a different header image */            
                $css .= ut_create_css_background( '.hero .parallax-scroll-container' , ut_return_hero_config('ut_hero_image' , '' , true ));
                
            }
            
            /* dynamic hero */
            if( $ut_hero_type == 'dynamic' ) {
                
                $css .= '#ut-hero.hero { height: ' . ut_return_hero_config('ut_hero_dynamic_content_height','60') . '%; min-height: ' . ut_return_hero_config('ut_hero_dynamic_content_height','60') . '%; height: calc(' . ut_return_hero_config('ut_hero_dynamic_content_height','60') . '% + 80px) !important; }';
                $css .= '#ut-hero.hero .hero-inner { vertical-align: ' . ut_return_hero_config( 'ut_hero_dynamic_content_v_align', 'middle' ) . '; }';
                $css .= '#ut-hero.hero .hero-holder { padding-bottom: ' . ut_return_hero_config( 'ut_hero_dynamic_content_margin_bottom', '40px' ) . '; }';
                
            }            
            
            /* hero header background image for image hero */
            if( $ut_hero_type == 'image' || $ut_hero_type == 'splithero' || $ut_hero_type == 'dynamic' ) {
                
                $ut_hero_image = ut_return_hero_config('ut_hero_image');                            
                
                if( is_array( $ut_hero_image ) && !empty( $ut_hero_image['background-image'] ) ) {
                    
                    /*no background if rain effect is active */
                    $css .= ut_create_css_background( '.hero .parallax-scroll-container' , $ut_hero_image );
                    
                } elseif( !empty( $ut_hero_image ) && !is_array( $ut_hero_image ) ) {
                    
                    /* fallback to version 1.0 */
                    $css .= '.hero .parallax-scroll-container { background-image: url(' . esc_url( $ut_hero_image ) . '); }'. "\n";
                
                }                
            
            }
            
            /* video poster */
            if( $ut_hero_type == 'video' ) :
                
                /* video poster image for mobile devices */
                $ut_video_poster = ut_return_hero_config('ut_video_poster');
                
                /* hero can be an image , so we need to check the hero type */
                if( !empty( $ut_video_poster ) && ut_return_hero_config('ut_video_source' , 'youtube') == 'youtube' || !empty( $ut_video_poster ) && unite_mobile_detection()->isMobile() ) {
                    $css .= '.hero { 
                        background-image: url(' . esc_url( $ut_video_poster ) . ');
                        background-size: cover !important;
                        background-attachment: scroll !important;
                    }'. "\n";                    
                }
                
                if( unite_mobile_detection()->isMobile() ) {
                                    
                    $css .= '.ut-video-control {
                        display:none !important;
                    }';
                
                }
                
            endif;            
            
            /* video position for selfhosted video */
            if( ut_return_hero_config('ut_video_source' , 'youtube') == 'selfhosted' && !unite_mobile_detection()->isMobile() && ut_return_hero_config('ut_video_containment' , 'hero') == 'body' && is_front_page() ) {                
                $css .= '.ut-video-container { position:fixed; }';                               
            }
                        
            /* split hero */
            if( $ut_hero_type == 'splithero' ) {
                
                $split_image_max_width = ut_return_hero_config('ut_hero_split_image_width');
                
                /* check if value is available */
                $split_image_max_width = empty($split_image_max_width) ? '60' : $split_image_max_width;
                
                $css .= '#ut-hero .ut-split-image { max-width: ' . $split_image_max_width . '% !important; }';
                
            
            }
            
            /* split hero - video padding */
            if( $ut_hero_type == 'splithero' ) {
            
                $ut_split_video_box_padding = ut_return_hero_config('ut_hero_split_video_box_padding');
                $ut_split_video_box_padding = !isset($ut_split_video_box_padding) ? '20' : $ut_split_video_box_padding;
                
                $css .= '.ut-hero-video-boxed { padding: ' . str_replace("px" , "" , $ut_split_video_box_padding) . '; }';                
            
            }
            
            /* slider arrow colors */
            if( $ut_hero_type == 'slider' ) {
                
                $ut_background_slider_arrow_background_color = ut_return_hero_config('ut_background_slider_arrow_background_color');
                if( !empty( $ut_background_slider_arrow_background_color ) ) {
                    $css .= '#ut-hero .ut-flex-control { background: ' . $ut_background_slider_arrow_background_color . '; }';
                    $css .= '#ut-hero .ut-flex-control:visited { background: ' . $ut_background_slider_arrow_background_color . '; }';
                }
                
                $ut_background_slider_arrow_background_color_hover = ut_return_hero_config('ut_background_slider_arrow_background_color_hover');
                if( !empty( $ut_background_slider_arrow_background_color_hover ) ) {
                    $css .= '#ut-hero .ut-flex-control:hover { background: ' . $ut_background_slider_arrow_background_color_hover . '; }';
                    $css .= '#ut-hero .ut-flex-control:focus { background: ' . $ut_background_slider_arrow_background_color_hover . '; }';
                    $css .= '#ut-hero .ut-flex-control:active{ background: ' . $ut_background_slider_arrow_background_color_hover . '; }';
                }
                
                $ut_background_slider_arrow_color = ut_return_hero_config('ut_background_slider_arrow_color');
                if( !empty( $ut_background_slider_arrow_color ) ) {
                    $css .= '#ut-hero .ut-flex-control { color: ' . $ut_background_slider_arrow_color . '; }';
                    $css .= '#ut-hero .ut-flex-control:visited { color: ' . $ut_background_slider_arrow_color . '; }';
                }
                
                $ut_background_slider_arrow_color_hover = ut_return_hero_config('ut_background_slider_arrow_color_hover');                
                if( !empty( $ut_background_slider_arrow_color_hover ) ) {
                    $css .= '#ut-hero .ut-flex-control:hover { color: ' . $ut_background_slider_arrow_color_hover . '; }';
                    $css .= '#ut-hero .ut-flex-control:focus { color: ' . $ut_background_slider_arrow_color_hover . '; }';
                    $css .= '#ut-hero .ut-flex-control:active{ color: ' . $ut_background_slider_arrow_color_hover . '; }';
                }
                
            }            
            
            /* hero header background image for animated image hero */
            if( $ut_hero_type == 'animatedimage' ) {
                
                $header_image = ut_return_hero_config('ut_hero_animated_image');
                
                if( !empty($header_image) ) {
                
                    /* get image ID by url*/
                    $imageID = ut_get_image_id( $header_image );
                    
                    /* grab image imnformation */                    
                    $imageinfo = wp_get_attachment_image_src( $imageID , 'full' );                    
                                        
                    /* background */
                    $css .= '.hero { 
                            background-position: 0px 0px;
                            background-repeat: repeat-x;
                            background-image: url(' . esc_url( $header_image ) . '); 
                            -webkit-animation: animatedBackground 60s linear infinite;
                            -moz-animation: animatedBackground 60s linear infinite;
                            animation: animatedBackground 60s linear infinite;
                        }'. "\n";
                    
                    $css .= '@media screen and (max-width: 1024px) {
                        
                        .hero {
                            -webkit-animation: none !important;
                            -moz-animation: none !important;
                            animation: none !important;
                        }
                        
                    }';
                    
                    $css .= '@keyframes animatedBackground {
                                from { background-position: 0 0; }
                                to { background-position: '.$imageinfo[1].'px 0; }
                            }
                            @-webkit-keyframes animatedBackground {
                                from { background-position: 0 0; }
                                to { background-position: '.$imageinfo[1].'px 0; }
                            }
                            @-moz-keyframe animatedBackground {
                                from { background-position: 0 0; }
                                to { background-position: '.$imageinfo[1].'px 0; }
                            }';
                    
                    }
                    
            }
            
            /* fancy slider */
            $fancy_slider_height = $ut_hero_type == 'transition' ? ut_return_hero_config('ut_fancy_slider_height' , '600px') : '';
            if ( !empty( $fancy_slider_height ) ) {
                $css .= '.ut-fancy-slider-fullwidth { height: ' . $fancy_slider_height . '; }';
                $css .= '.ut-fancy-slider-fullwidth .hero-inner { height: ' . $fancy_slider_height . '; }';
            }
            
            /* header overlay styling */
            $ut_hero_overlay_color = ut_return_hero_config('ut_hero_overlay_color');
            $ut_hero_overlay_color_opacity = ut_return_hero_config('ut_hero_overlay_color_opacity' , '0.8');
                                    
            if( !empty($ut_hero_overlay_color) ) {
                $css.= '.hero .parallax-overlay { background-color: rgba(' . ut_hex_to_rgb( $ut_hero_overlay_color ) . ' , ' . $ut_hero_overlay_color_opacity . ' ); }'. "\n";
            }
                        
            /* blog hero header styling */
            $ut_blog_catchphrase_color                 = ut_return_hero_config('ut_hero_catchphrase_color');
            $ut_blog_company_slogan_color              = ut_return_hero_config('ut_hero_company_slogan_color');
            $ut_blog_expertise_slogan_color            = ut_return_hero_config('ut_hero_expertise_slogan_color');
            $ut_blog_expertise_slogan_background_color = ut_return_hero_config('ut_hero_expertise_slogan_background_color');
            
            $ut_blog_expertise_margin                  = ot_get_option('ut_blog_expertise_margin');
                    
            /* add to CSS */
            if( !empty( $ut_blog_expertise_slogan_color ) && is_home() ) {
                $css.='.hero-description { color: ' . $ut_blog_expertise_slogan_color . '}'. "\n";                        
            }
            if( !empty( $ut_blog_expertise_slogan_background_color ) && is_home() ) {
                $css.='.hero-description { background: ' . $ut_blog_expertise_slogan_background_color . '; padding-bottom:0; margin-bottom: 5px; }'. "\n";
            }
            if( !empty( $ut_blog_expertise_margin ) && is_home() ) {
                $css.='#ut-hero .hdh { margin-bottom: ' . $ut_blog_expertise_margin . '}'. "\n";
            }
            
            if( !empty( $ut_blog_catchphrase_color ) && is_home() ) {
                
                $css.='.hero-description-bottom { color: ' . $ut_blog_catchphrase_color . '}'. "\n";
                
            }
            
            if( !empty( $ut_blog_company_slogan_color ) && is_home() ) {
                
                $css.='.hero-title { color: ' . $ut_blog_company_slogan_color . ' }'. "\n";
                $css.='.ut-hero-style-3 .hero-description { border-bottom: 3px solid ' . $ut_blog_company_slogan_color . '  }'. "\n"; 
                $css.='.ut-hero-style-6 .hero-title { border: 1px solid ' . $ut_blog_company_slogan_color . '  }'. "\n";
                $css.='.ut-hero-style-7 .hero-title { border: 3px solid ' . $ut_blog_company_slogan_color . '  }'. "\n";
                $css.='.ut-hero-style-8 .hero-title { border-bottom: 2px solid ' . $ut_blog_company_slogan_color . '; border-top: 2px solid ' . $ut_blog_company_slogan_color . '  }'. "\n";
                $css.='.ut-hero-style-9 .hero-title { border-left: 3px solid ' . $ut_blog_company_slogan_color . '; border-right: 3px solid ' . $ut_blog_company_slogan_color . '  }'. "\n";
                $css.='.ut-hero-style-10 .hero-title { border-left: 3px dashed ' . $ut_blog_company_slogan_color . '; border-right: 3px dashed ' . $ut_blog_company_slogan_color . '  }'. "\n";
                
            }
            
            $ut_blog_company_slogan_uppercase = ot_get_option('ut_blog_company_slogan_uppercase' , 'on');
            
            if( !empty( $ut_blog_company_slogan_uppercase ) && is_home() && $ut_blog_company_slogan_uppercase == 'on' ) {
                
                $css.='.hero-title { text-transform: uppercase; }';
            
            }
            
            $ut_blog_company_slogan_letterspacing = ot_get_option('ut_blog_company_slogan_letterspacing');                    
            /* add to CSS */                
            if( !empty( $ut_blog_company_slogan_letterspacing ) ) {
                
                $css.='.hero-title { letter-spacing: ' . $ut_blog_company_slogan_letterspacing . '; }';
            
            }
            
            /* check if contact section is active*/
            $ut_activate_csection = ut_return_csection_config('ut_activate_csection');
            
            /* only get contact section styles if footer is active */
            if( $ut_activate_csection == 'on' ) {
                
                /* fancy border */
                if( ot_get_option('ut_csection_fancy_border' , 'off' ) == 'on') {
                    
                    $css.= '
                    #contact-section .ut-fancy-border { 
                        display: block; 
                        position: absolute; 
                        bottom: 0; 
                        left: 0; 
                        width: 100%; 
                        background:' . ot_get_option( 'ut_csection_fancy_border_background_color' , '#FFF' ) . '; 
                        border-bottom:' . ot_get_option( 'ut_csection_fancy_border_size' , '10px' ) . ';
                        border-color:' . ot_get_option( 'ut_csection_fancy_border_color' , $accentcolor ) . '; 
                        border-style: dashed; 
                        z-index:9999; 
                    }';
                    
                }
                                        
                /* contact section header styling */
                $ut_csection_header_slogan_color = ot_get_option('ut_csection_header_slogan_color');
                $ut_csection_header_expertise_slogan_color = ot_get_option('ut_csection_header_expertise_slogan_color');
                
                $ut_csection_header_style = ot_get_option('ut_csection_header_style' , 'pt-style-1');
                $ut_csection_header_style = $ut_csection_header_style == 'global' ? ot_get_option('ut_global_headline_style') : $ut_csection_header_style;
                
                /* pt style 3 needs a fallback */
                if( empty($ut_csection_header_slogan_color) && $ut_csection_header_style == 'pt-style-3') {
                    $ut_csection_header_slogan_color = $accentcolor;
                }
                
                if( !empty( $ut_csection_header_slogan_color ) ) {
                    
                    $css.='#contact-section .parallax-title { color: ' . $ut_csection_header_slogan_color . '}'. "\n";
                    $css.= create_section_headline_style('#contact-section' , $ut_csection_header_style , $ut_csection_header_slogan_color);
                    
                }
                
                /* pt style 2 */
                if( ot_get_option('ut_csection_header_style' , 'pt-style-1') == 'pt-style-2') {                
                
                    $ut_csection_headline_style_2_color  = ot_get_option('ut_csection_headline_style_2_color');
                    $ut_csection_headline_style_2_color  = !empty( $ut_csection_headline_style_2_color ) ? $ut_csection_headline_style_2_color : ot_get_option('ut_global_headline_style_2_color', '#222');
                    
                    $ut_csection_headline_style_2_height = ot_get_option('ut_csection_headline_style_2_height');
                    $ut_csection_headline_style_2_height  = !empty( $ut_csection_headline_style_2_height ) ? $ut_csection_headline_style_2_height : ot_get_option('ut_global_headline_style_2_height', '1px');
                    
                    $ut_csection_headline_style_2_width  = ot_get_option('ut_csection_headline_style_2_width');
                    $ut_csection_headline_style_2_width  = !empty( $ut_csection_headline_style_2_width ) ? $ut_csection_headline_style_2_width : ot_get_option('ut_global_headline_style_2_width', '30px');
                    
                    $css .= create_section_headline_style( '#contact-section .pt-style-2', $ut_csection_headline_style_2_color, $ut_csection_headline_style_2_height, $ut_csection_headline_style_2_width );
                
                }
                
                if( ot_get_option('ut_csection_header_style' , 'pt-style-1') == 'global' ) {
                    
                    $css .= create_section_headline_style( '#contact-section .pt-style-2', ot_get_option('ut_global_headline_style_2_color', '#222'), ot_get_option('ut_global_headline_style_2_height', '1px'), ot_get_option('ut_global_headline_style_2_width', '30px') );
                
                }
                
                
                if( !empty( $ut_csection_header_expertise_slogan_color ) ) {
                    
                    $css.='#contact-section .lead { color: ' . $ut_csection_header_expertise_slogan_color . ' }'. "\n";
                    
                }
                
                if( ot_get_option('ut_csection_title_uppercase' , 'off') == 'on' ) {
                    $css.='#contact-section .parallax-title { text-transform: uppercase; }';
                }
                
                $css .= '#contact-section .parallax-title span span { color:' . $accentcolor . '; }'. "\n";                
                                
                /* contact section section styles */
                $csection_background = null;
                $csection_background_type = ot_get_option('ut_csection_background_type' , 'image');
                $csection_parallax = ot_get_option('ut_csection_parallax' , 'on');
            
                /* contact section styling */
                if( $csection_background_type == 'image' ) {
                    
                    $ut_csection_background_image = ut_return_csection_config('ut_csection_background_image');                
                    
                    if( is_array( $ut_csection_background_image ) && !empty( $ut_csection_background_image['background-image'] ) ) {                    
                        
                        if( $csection_parallax == 'on' && !unite_mobile_detection()->isMobile() ) {
                        
                            $csection_background .= ut_create_css_background( '#contact-section .parallax-scroll-container' , $ut_csection_background_image );
                        
                        } else {
                        
                            $csection_background .= ut_create_css_background( '#contact-section' , $ut_csection_background_image );                        
                        
                        }
                        
                        /* store for later use */
                        $ut_csection_background_image = $ut_csection_background_image['background-image'];
                        
                    
                    } elseif( !is_array( $ut_csection_background_image ) ) {
                        
                        if( $csection_parallax == 'on' && !unite_mobile_detection()->isMobile() ) {
                        
                            $csection_background .= !empty( $ut_csection_background_image ) ? '#contact-section .parallax-scroll-container { background-image: url(' . esc_url( $ut_csection_background_image ) . '); }'. "\n" : '';
                        
                        } else {
                        
                            $csection_background .= !empty( $ut_csection_background_image ) ? '#contact-section { background-image: url(' . esc_url( $ut_csection_background_image ) . '); }'. "\n" : '';                        
                        
                        }
                        
                    }
                    
                }
                /* video poster image */
                if( $csection_background_type == 'video' && unite_mobile_detection()->isMobile() || unite_mobile_detection()->isMobile() && ot_get_option('ut_front_video_containment' ,'hero') == 'body' ) {
                    
                    $ut_csection_video_poster = ot_get_option('ut_csection_video_poster');    
                    
                    /* video poster image for mobile devices */    
                    $css .= '#contact-section { 
                          background-image: url(' . esc_url( $ut_csection_video_poster ) . '); 
                          background-size: cover !important;
                          background-attachment: scroll !important;
                    }'. "\n";
                
                }
                
                /* there is no image, so we check if a background color has been set */
                $ut_csection_background_color = ot_get_option('ut_csection_background_color');
                if( empty( $ut_csection_background_image ) || empty( $ut_csection_video_poster ) ) {
                    
                    $csection_background .= !empty( $ut_csection_background_color ) ? '#contact-section { background: ' . $ut_csection_background_color . '; }'. "\n" : '';
                    
                    if( !empty( $ut_csection_background_color ) ) {
                        $css.= '#contact-section .section-header.pt-style-1 .section-title span { background-color: ' . $ut_csection_background_color . '; }'. "\n"; 
                    }
                    
                }
               
                /* add to CSS */
                $css .= $csection_background;
                
                /* contact section header font style */
                if( ot_get_option('ut_csection_header_font_type' , 'ut-font') == 'ut-google' ) {
                 
                        $ut_csection_header_google_font_style = ot_get_option('ut_csection_header_google_font_style');                
                    
                        if( !empty($google_fonts[ $ut_csection_header_google_font_style['font-id']]['family']) ) {
                        
                            $font = '#contact-section .parallax-title {';
                                
                                $font .= 'font-family:"'.$google_fonts[$ut_csection_header_google_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                                
                                if( !empty( $ut_csection_header_google_font_style['font-weight']) ) {
                                    $font .= ' font-weight: ' .  $ut_csection_header_google_font_style['font-weight'] . ';';    
                                }
                                
                                if( !empty( $ut_csection_header_google_font_style['font-size']) ) {
                                    $font .= ' font-size: ' .  $ut_csection_header_google_font_style['font-size'] . ';';    
                                }
                                
                                if( !empty( $ut_csection_header_google_font_style['font-style']) && isset($font_styles[ $ut_csection_header_google_font_style['font-style']]) ) {
                                    $font .= ' font-style: ' . $font_styles[ $ut_csection_header_google_font_style['font-style']] . ';';    
                                }
                                
                                if( !empty( $ut_csection_header_google_font_style['line-height']) ) {
                                    $font .= ' line-height: ' .  $ut_csection_header_google_font_style['line-height'] . ';';    
                                }
                                
                                if( !empty( $ut_csection_header_google_font_style['text-transform']) ) {
                                    $font .= ' text-transform: ' .  $ut_csection_header_google_font_style['text-transform'] . ';';    
                                }
                                
                            $font .= '}';
                            
                            $css .= $font;
                        
                        } else {
                        
                            /* fallback if user has not chosen a google font yet */
                            $font_style = ot_get_option('ut_csection_header_font_style' , 'semibold');
                            if( isset($ut_recognized_font_styles[$font_style]) ) {
                                $css .= '#contact-section .parallax-title, #contact-section .section-title { font-family: ' . $ut_recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";
                            }
                        }
                
                } elseif( ot_get_option('ut_csection_header_font_type' , 'ut-font') == 'ut-websafe' ) {
                    
                        $css .= ut_create_typography_css('#contact-section .parallax-title, #contact-section .section-title', ot_get_option('ut_csection_header_websafe_font_style') );    
                    
                } else {
                    
                    $font_style = ot_get_option('ut_csection_header_font_style' , 'semibold');
                    if( isset($ut_recognized_font_styles[$font_style]) ) {
                        $css .= '#contact-section .parallax-title, #contact-section .section-title { font-family: ' . $ut_recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";                     
                    }
                    
                }
                
                
                
                 /* contact section border styling */
                if( ot_get_option('ut_activate_csection_border' , 'off') == 'on' ) {
                    
                    /* border settings */
                    $ut_csection_border_color = ot_get_option('ut_csection_border_color');                                
                    $ut_csection_border_color = !empty($ut_csection_border_color) ? $ut_csection_border_color : $accentcolor;                                
                    $ut_csection_border_width = ot_get_option('ut_csection_border_width'); 
                    $ut_csection_border_width = !empty( $ut_csection_border_width) ?  $ut_csection_border_width : '1'; 
                    $ut_csection_border_style =  ot_get_option('ut_csection_border_style'); 
                    $ut_csection_border_style = !empty( $ut_csection_border_style) ?  $ut_csection_border_style : 'solid';                               
                   
                    /* add to CSS */
                    $ut_csection_overlay = ut_return_csection_config('ut_csection_overlay', 'on');                    
                    if( $ut_csection_overlay == 'on' ) {
                    
                        $css.= '#contact-section .parallax-overlay { border-top: '.$ut_csection_border_width.'px '.$ut_csection_border_style.' '.$ut_csection_border_color.'; }';
                        
                    } else {
                        
                        $css.= '#contact-section { border-top: '.$ut_csection_border_width.'px '.$ut_csection_border_style.' '.$ut_csection_border_color.'; }';
                        
                    }
                
                }                
                
                /* contact section box styling */
                $ut_left_csection_content_area_color  = ot_get_option('ut_left_csection_content_area_color');
                $ut_right_csection_content_area_color = ot_get_option('ut_right_csection_content_area_color');
                
                $ut_left_csection_content_area_opacity  = ot_get_option('ut_left_csection_content_area_opacity' , '0.8' );
                $ut_right_csection_content_area_opacity = ot_get_option('ut_right_csection_content_area_opacity', '0.8' );
                
                    $css .= !empty( $ut_left_csection_content_area_color )  ? '#contact-section .ut-left-footer-area { background: rgb(' . ut_hex_to_rgb( $ut_left_csection_content_area_color ) . ',' . $ut_left_csection_content_area_opacity . '); }'. "\n" : '';
                    $css .= !empty( $ut_left_csection_content_area_color )  ? '#contact-section .ut-left-footer-area { background: rgba(' . ut_hex_to_rgb( $ut_left_csection_content_area_color ) . ',' . $ut_left_csection_content_area_opacity . '); }'. "\n" : '';
                    $css .= !empty( $ut_right_csection_content_area_color ) ? '#contact-section .ut-right-footer-area { background: rgb(' . ut_hex_to_rgb( $ut_right_csection_content_area_color ) . ',' . $ut_right_csection_content_area_opacity . '); }'. "\n" : '';
                    $css .= !empty( $ut_right_csection_content_area_color ) ? '#contact-section .ut-right-footer-area { background: rgba(' . ut_hex_to_rgb( $ut_right_csection_content_area_color ) . ',' . $ut_right_csection_content_area_opacity . '); }'. "\n" : '';
                
                /* contact section overlay color */
                $ut_csection_overlay = ut_return_csection_config('ut_csection_overlay', 'on');
                $ut_csection_overlay_color = ut_return_csection_config('ut_csection_overlay_color');
                $ut_csection_overlay_opacity = ut_return_csection_config('ut_csection_overlay_opacity' , '0.8');
                
                    $css .= !empty( $ut_csection_overlay_color )  ? '#contact-section .parallax-overlay { background: rgb(' . ut_hex_to_rgb( $ut_csection_overlay_color ) . ',' . $ut_csection_overlay_opacity . '); }'. "\n" : '';
                    $css .= !empty( $ut_csection_overlay_color )  ? '#contact-section .parallax-overlay { background: rgba(' . ut_hex_to_rgb( $ut_csection_overlay_color ) . ',' . $ut_csection_overlay_opacity . '); }'. "\n" : '';
                
                /* contact section header padding bottom */
                $ut_csection_header_padding_bottom = ot_get_option('ut_csection_header_padding_bottom');
                if( !empty( $ut_csection_header_padding_bottom ) ) {
                    $css .= '#contact-section .parallax-header, #contact-section .section-header { padding-bottom: ' . $ut_csection_header_padding_bottom . '; }';   
                }
                
                /* contact section section padding */
                $ut_csection_padding_top    = ot_get_option('ut_csection_padding_top');
                $ut_csection_padding_bottom = ot_get_option('ut_csection_padding_bottom');
                
                    /* fallback if there is no entry */
                    $ut_csection_padding_top = empty($ut_csection_padding_top) ? '80px' : $ut_csection_padding_top;
                    $ut_csection_padding_bottom = empty($ut_csection_padding_bottom) ? '60px' : $ut_csection_padding_bottom;
                    
                    if( $ut_csection_overlay == 'on' ) {
                    
                        $css .= '#contact-section .parallax-overlay { padding-top:' . $ut_csection_padding_top . '; padding-bottom:' . $ut_csection_padding_bottom . '; }'. "\n";                        
                        $css .= '#contact-section .ut-offset-anchor { top:-' . ( 79 + str_replace("px" , "" , $ut_navigation_padding_top) + str_replace("px" , "" , $ut_navigation_padding_bottom) ) . 'px; }'. "\n";
                        
                    } else {
                        
                        $css .= '#contact-section { padding-top:' . $ut_csection_padding_top . '; padding-bottom:' . $ut_csection_padding_bottom . '; }'. "\n";
                        $css .= '#contact-section .ut-offset-anchor { top:-' . ( 79 + str_replace("px" , "" , $ut_csection_padding_top) + str_replace("px" , "" , $ut_navigation_padding_top) + str_replace("px" , "" , $ut_navigation_padding_bottom) ) . 'px; }'. "\n";
                        
                    }
                    
                
            } /* end $ut_activate_csection */
            
            
            /* theme options misc settings */
            if( ot_get_option('ut_global_blockquote_headline_color') ) {
                
                $css .= 'blockquote { color: ' . ot_get_option('ut_global_blockquote_headline_color') . ' ;}';
                
            }
            
            if( ot_get_option('ut_blockquote_font_type' , 'ut-font') == 'ut-google' ) {
            
                    $ut_google_blockquote_font_style = ot_get_option('ut_google_blockquote_font_style');
                    
                    if( !empty($google_fonts[$ut_google_blockquote_font_style['font-id']]['family']) ) {
                    
                        $css .= 'blockquote {';
                            /* familiy */
                            $css .= 'font-family:"'.$google_fonts[$ut_google_blockquote_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty($ut_google_blockquote_font_style['font-weight']) ) {
                                $css .= ' font-weight: ' . $ut_google_blockquote_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty($ut_google_blockquote_font_style['font-size']) ) {
                                $css .= ' font-size: ' . $ut_google_blockquote_font_style['font-size'] . ';';    
                            }
                            
                            if( !empty($ut_google_blockquote_font_style['font-style']) ) {
                                $css .= ' font-style: ' . $font_styles[$ut_google_blockquote_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty($ut_google_blockquote_font_style['text-transform']) ) {
                                $css .= ' text-transform: ' . $ut_google_blockquote_font_style['text-transform'] . ';';    
                            }
                            
                        $css .= '}';
                    
                    } else {
                        
                        /* fallback if user has not chosen a google font yet */
                        $ut_blockquote_font_style = ot_get_option('ut_blockquote_font_style' , 'semibold');    
                        $css .= 'blockquote { font-family: ' . $ut_recognized_font_styles[$ut_blockquote_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                        
                    }
                
                } elseif( ot_get_option('ut_blockquote_font_type' , 'ut-font') == 'ut-websafe' ) {
                    
                    $css .= ut_create_typography_css('blockquote', ot_get_option('ut_blockquote_websafe_font_style') );
                    
                } else {
                    
                    /* out for theme font */
                    $ut_blockquote_font_style = ot_get_option('ut_blockquote_font_style' , 'semibold');    
                    $css .= 'blockquote { font-family: ' . $ut_recognized_font_styles[$ut_blockquote_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                                
            }
            
            
            
            if( ot_get_option('ut_global_lead_color') ) {
                
                $css .= '.lead p { color: ' . ot_get_option('ut_global_lead_color') . ' ;}';
                
            }
            
            
            if( ot_get_option('ut_global_lead_font_type' , 'ut-font') == 'ut-google' ) {
            
                    $ut_google_lead_font_style = ot_get_option('ut_google_lead_font_style');
                    
                    if( !empty($google_fonts[$ut_google_lead_font_style['font-id']]['family']) ) {
                    
                        $css .= '.lead, .taxonomy-description {';
                            /* familiy */
                            $css .= 'font-family:"'.$google_fonts[$ut_google_lead_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty($ut_google_lead_font_style['font-weight']) ) {
                                $css .= ' font-weight: ' . $ut_google_lead_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty($ut_google_lead_font_style['font-size']) ) {
                                $css .= ' font-size: ' . $ut_google_lead_font_style['font-size'] . ' !important;';    
                            }
                            
                            if( !empty($ut_google_lead_font_style['font-style']) ) {
                                $css .= ' font-style: ' . $font_styles[$ut_google_lead_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty($ut_google_lead_font_style['text-transform']) ) {
                                $css .= ' text-transform: ' . $ut_google_lead_font_style['text-transform'] . ';';    
                            }
                            if( !empty($ut_google_lead_font_style['line-height']) ) {
                                $css .= ' line-height: ' . $ut_google_lead_font_style['line-height'] . ';';    
                            }
                            
                        $css .= '}';
                    
                    } else {
                        
                        /* fallback if user has not chosen a google font yet */
                        $ut_lead_font_style = ot_get_option('ut_lead_font_style' , 'semibold');    
                        $css .= '.lead, .taxonomy-description { font-family: ' . $ut_recognized_font_styles[$ut_lead_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                        
                    }
                
                } elseif( ot_get_option('ut_global_lead_font_type' , 'ut-font') == 'ut-websafe' ) {
                    
                    $css .= ut_create_typography_css('.lead, .taxonomy-description', ot_get_option('ut_lead_websafe_font_style') );                    
                    
                } else {
                    
                    /* out for theme font */
                    $ut_lead_font_style = ot_get_option('ut_lead_font_style' , 'semibold');    
                    $css .= '.lead, .taxonomy-description { font-family: ' . $ut_recognized_font_styles[$ut_lead_font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif; }'. "\n";
                                
            }
            
            
            /* pre loader settings */
            $css .= ut_create_typography_css( '#qLpercentage', ot_get_option('ut_image_loader_percentage_font') );
            $css .= '#ut-loader-logo { max-width: ' . ot_get_option( 'ut_image_loader_logo_max_width', 100 ) . 'px;}';
            $css .= '#qLoverlay { background: ' . ot_get_option('ut_image_loader_background' , '#FFF') .'; }';
            $css .= '.ut-loading-bar-style2 .ut-loading-bar-style2-ball-effect { background-color: ' . ot_get_option('ut_image_loader_bar_color' , '#FFF') . '; }';
            $css .= '.ut-loading-bar-style3-outer { border-color: ' . ot_get_option('ut_image_loader_bar_color' , '#FFF') . '; }';
            $css .= '.ut-loading-bar-style-3-inner { background-color: ' . ot_get_option('ut_image_loader_bar_color' , '#FFF') . '; }';
            $css .= '.ut-loader__bar4, .ut-loader__ball4 { background: ' . ot_get_option('ut_image_loader_bar_color' , '#FFF') . '; }';            
            $css .= '.ut-loading-bar-style5-inner { color: ' . ot_get_option('ut_image_loader_bar_color' , '#FFF') . '; }';            
            $css .= '.ut-inner-overlay .ut-loading-text p { color: ' . ot_get_option('ut_image_loader_text_color' ) . ' !important; }';
            $css .= ut_create_typography_css( '.ut-inner-overlay .ut-loading-text p', ot_get_option('ut_image_loader_font') );
            $css .= '.ut-inner-overlay .ut-loading-text { margin-top: ' . ot_get_option( 'ut_image_loader_text_margin_top', 20 ) . 'px !important; }';
            $css .= '.ut-loader-overlay { background: '.ot_get_option('ut_image_loader_background' , '#FFF').'}'. "\n";                
        

            
                        
            /*
            |--------------------------------------------------------------------------
            | Footer Skin & Border
            |--------------------------------------------------------------------------
            */
            
            if( ot_get_option('ut_footer_skin' , 'ut-footer-light' ) == 'ut-footer-light' ) {
                
                $ut_footer_skin_light_bgcolor = ot_get_option('ut_footer_skin_light_bgcolor');
                
                if( !empty( $ut_footer_skin_light_bgcolor ) ) {
                    
                    /* add to CSS */
                    $css .= '.footer, a.toTop {
                        background: '.$ut_footer_skin_light_bgcolor.' ;
                    }'; 
                    
                }
                
            } else {
                
                $ut_footer_skin_dark_bgcolor = ot_get_option('ut_footer_skin_dark_bgcolor');
                
                if( !empty( $ut_footer_skin_dark_bgcolor ) ) {
                    
                   /* add to CSS */ 
                   $css .= '.footer.ut-footer-dark, .ut-footer-dark a.toTop {
                        background: '.$ut_footer_skin_dark_bgcolor.' ;
                   }'; 
                    
                }
                    
            }
            
            /* footer border */
            $ut_footer_skin_border = ot_get_option('ut_footer_skin_border');
            
                /* add to CSS */            
                if( !empty($ut_footer_skin_border) ) {
                    
                    $css .= '.footer { border-top: 1px solid '.$ut_footer_skin_border.'; }';
                    $css .= 'a.toTop { border: 1px solid '.$ut_footer_skin_border.'; border-bottom: none; }';
                } 
            
            /* subfooter backgroundcolor  */
            $ut_subfooter_bgcolor = ot_get_option('ut_subfooter_bgcolor');
            
                /* add to CSS */            
                if( !empty($ut_subfooter_bgcolor) ) {
                    
                   /* add to CSS */ 
                   $css .= '.footer .footer-content {
                        background: '.$ut_subfooter_bgcolor.' ;
                        padding-top: 20px;
                   }';
                    
                }
                         
            /* subfooter paddingtop  */
            $ut_subfooter_padding_top = ot_get_option( 'ut_subfooter_padding_top' );
            
                /* add to CSS */            
                if( !empty( $ut_subfooter_padding_top ) ) {
                    
                   /* add to CSS */ 
                   $css .= '.footer .footer-content {
                        padding-top: '.$ut_subfooter_padding_top.';
                   }';
                    
                }          
                                        
            /* individual section styles , only run this query for front page */            
            if( is_front_page() ) {
                
                /* retrieve query arguements */
                $pagequery = ut_prepare_front_query();                            
                
                if( !empty( $pagequery ) ) {
            
                    $css_query = new WP_Query( $pagequery );
                    
                    if ( $css_query->have_posts() ) :
                    
                        while ( $css_query->have_posts() ) : $css_query->the_post();
                                                        
                            $ut_section_video_state = get_post_meta( $css_query->post->ID , 'ut_section_video_state' , true );
                            
                                /* 
                                 * split section
                                 */
                                $ut_section_width = get_post_meta( $css_query->post->ID , 'ut_section_width' , true);
                                if( $ut_section_width == 'split' ) {
                                    
                                    /* try to get featured image */
                                    $fullsize = wp_get_attachment_url( get_post_thumbnail_id( $css_query->post->ID ) );
                                    
                                    if( !empty( $fullsize ) ) {
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-split-screen-poster{ background: url("' . $fullsize . '") }';
                                    }
                                    
                                    /* padding settings */
                                    $ut_split_section_margin_top = get_post_meta( $css_query->post->ID , 'ut_split_section_margin_top' , true);
                                    $ut_split_section_margin_bottom = get_post_meta( $css_query->post->ID , 'ut_split_section_margin_bottom' , true);
                                    
                                    /* fallback if there is no entry */
                                    $ut_split_section_margin_top = empty($ut_split_section_margin_top) ? '' : $ut_split_section_margin_top;
                                    $ut_split_section_margin_bottom = empty($ut_split_section_margin_bottom) ? '' : $ut_split_section_margin_bottom;
                                    
                                    $ut_split_content_align = get_post_meta( $css_query->post->ID , 'ut_split_content_align' , true);
                                    
                                    if( !empty( $ut_split_content_align ) && $ut_split_content_align == 'right' ) {
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-split-content-right { margin-top:' . $ut_split_section_margin_top . '; }'. "\n";
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-split-content-right { margin-bottom:' . $ut_split_section_margin_bottom . '; }'. "\n";
                                    }
                                    
                                    if( !empty( $ut_split_content_align ) && $ut_split_content_align == 'left' ) {                                    
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-split-content-left  { margin-top:' . $ut_split_section_margin_top . ';  }'. "\n";
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-split-content-left  { margin-bottom:' . $ut_split_section_margin_bottom . ';  }'. "\n";
                                    }
                                  
                                }                          
                                
                                
                                /* section fancy border */
                                if( get_post_meta( $css_query->post->ID , 'ut_section_fancy_border' , true ) == 'on' ) {
                                    
                                    $ut_section_fancy_border_color = get_post_meta( $css_query->post->ID , 'ut_section_fancy_border_color' , true);
                                    $ut_section_fancy_border_color = empty($ut_section_fancy_border_color) ? $accentcolor : $ut_section_fancy_border_color;
                                    
                                    $ut_section_fancy_border_background_color = get_post_meta( $css_query->post->ID , 'ut_section_fancy_border_background_color' , true);
                                    $ut_section_fancy_border_background_color = empty($ut_section_fancy_border_background_color) ? '#FFF' : $ut_section_fancy_border_background_color;
                                    
                                    $ut_section_fancy_border_size = get_post_meta( $css_query->post->ID , 'ut_section_fancy_border_size' , true);
                                    $ut_section_fancy_border_size = empty($ut_section_fancy_border_size) ? '10px' : $ut_section_fancy_border_size;
                                    
                                    
                                    $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-fancy-border { 
                                        display: block; 
                                        position: absolute; 
                                        bottom: 0; 
                                        left: 0; 
                                        width: 100%; 
                                        background:' . $ut_section_fancy_border_background_color . '; 
                                        border-bottom:' . $ut_section_fancy_border_size . ';
                                        border-color:' . $ut_section_fancy_border_color . '; 
                                        border-style: dashed; 
                                        z-index:9999; 
                                    }';
                                    
                                }
                                                                
                                /* 
                                 * section padding
                                 */
                                
                                /* get overlay settings */
                                $ut_overlay_section = get_post_meta( $css_query->post->ID , 'ut_overlay_section' , true);                                
                                
                                /* padding settings */
                                $ut_section_padding_top = get_post_meta( $css_query->post->ID , 'ut_section_padding_top' , true);
                                $ut_section_padding_bottom = get_post_meta( $css_query->post->ID , 'ut_section_padding_bottom' , true);
                                $ut_section_slogan_padding = get_post_meta( $css_query->post->ID , 'ut_section_slogan_padding' , true );
                        
                                /* fallback if there is no entry */
                                $ut_section_padding_top = empty($ut_section_padding_top) ? '80px' : $ut_section_padding_top;
                                $ut_section_padding_bottom = empty($ut_section_padding_bottom) ? '60px' : $ut_section_padding_bottom;
                                $ut_section_slogan_padding = empty($ut_section_slogan_padding) ? '30px' : $ut_section_slogan_padding;    
                                
                                    /* add to CSS */
                                    if( $ut_overlay_section == 'on' ) {                                        
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-overlay { padding-top:' . $ut_section_padding_top . '; padding-bottom:' . $ut_section_padding_bottom . '; }'. "\n";
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-offset-anchor { top:-' . ( 79 + str_replace("px" , "" , $ut_navigation_padding_top) + str_replace("px" , "" , $ut_navigation_padding_bottom) ) . 'px; }'. "\n"; 
                                    } else {                                        
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . '{ padding-top:' . $ut_section_padding_top . '; padding-bottom:' . $ut_section_padding_bottom . '; }'. "\n";
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .ut-offset-anchor { top:-' . ( 79 + str_replace("px" , "" , $ut_section_padding_top) + str_replace("px" , "" , $ut_navigation_padding_top) + str_replace("px" , "" , $ut_navigation_padding_bottom) ) . 'px; }'. "\n"; 
                                    }
                                    
                                    $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-header { padding-bottom:' . $ut_section_slogan_padding . '; }'. "\n";
                                    $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-header { padding-bottom:' . $ut_section_slogan_padding . '; }'. "\n";                                    
                            
                                /* 
                                 * section header font
                                 */
                                
                                /* get font style */
                                $ut_section_header_font_style = get_post_meta( $css_query->post->ID , 'ut_section_header_font_style' , true );
                                
                                /* fallback if there is no entry */
                                $ut_section_header_font_style = empty($ut_section_header_font_style) ? 'semibold' : $ut_section_header_font_style;
                                
                                    /* add to CSS */
                                    $css .= ut_create_global_headline_font_style('#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-title' , $ut_section_header_font_style);
                                    $css .= ut_create_global_headline_font_style('#' . ut_clean_section_id($css_query->post->post_name) . ' .section-title' , $ut_section_header_font_style);                                
                                    
                                if($ut_section_video_state != 'on') {
                                
                                /* 
                                 * section parallax image
                                 */ 
                                    
                                /* get parallax settings*/
                                $ut_parallax_image = get_post_meta( $css_query->post->ID , 'ut_parallax_image' , true );
                                $ut_parallax_section = get_post_meta( $css_query->post->ID , 'ut_parallax_section' , true);
                                
                                /* image fallback to version 1.0 */
                                if( is_array( $ut_parallax_image ) && !empty( $ut_parallax_image['background-image'] ) ) {
                                    
                                    if( !empty( $ut_parallax_image ) && $ut_parallax_section == 'on' ) {
                                        
                                        $css .= ut_create_css_background( '#' . ut_clean_section_id( $css_query->post->post_name ) . ' .parallax-scroll-container' , $ut_parallax_image );
                                        
                                    } else {
                                        
                                        $css .= ut_create_css_background( '#' . ut_clean_section_id($css_query->post->post_name) , $ut_parallax_image );
                                        
                                    }
                                                                
                                } elseif( !is_array( $ut_parallax_image ) ) {
                                
                                    if( !empty( $ut_parallax_image ) && $ut_parallax_section == 'on' ) { 
                                        
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-scroll-container { background-image: url(' . esc_url( $ut_parallax_image ) . '); }'. "\n";
                                    
                                    } else {  
                                        
                                        $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' { background-image: url(' . esc_url( $ut_parallax_image ) . '); }'. "\n";
                                    
                                    }; 
                                
                                }                               
                                                                
                                /* 
                                 * section background color 
                                 */                            
                                $ut_section_background_color = get_post_meta( $css_query->post->ID , 'ut_section_background_color' , true);
                                
                                if(!empty($ut_section_background_color)) {
                                    /* add to CSS */
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . '{ background-color: ' . $ut_section_background_color . '; }'. "\n";
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-header.pt-style-1 .section-title span  { background-color: ' . $ut_section_background_color . '; }'. "\n";                            
                                }
                            }
                            
                            /* video poster for section */
                            if( unite_mobile_detection()->isMobile() && $ut_section_video_state != 'off' || unite_mobile_detection()->isMobile() && ot_get_option('ut_front_video_containment' ,'hero') == 'body' ) :
                                    
                                $ut_video_poster = get_post_meta( $css_query->post->ID , 'ut_section_video_poster' , true);
                                
                                if( !empty($ut_video_poster) ) {
                                    
                                    /* video poster image for mobile devices */    
                                    $css .= '#' . ut_clean_section_id($css_query->post->post_name) . ' { 
                                        background-image: url(' . esc_url( $ut_video_poster ) . '); 
                                        background-size: cover !important;
                                        background-attachment: scroll !important;
                                    }'. "\n";
                                    
                                } else {
                                    
                                    $ut_section_video_bgcolor = get_post_meta( $css_query->post->ID , 'ut_section_video_bgcolor' , true); 
                                    
                                    if( !empty($ut_section_video_bgcolor) ) {
                                        /* add to CSS */
                                        $css.= '#' . ut_clean_section_id($css_query->post->post_name) . '{ background-color: ' . $ut_section_video_bgcolor . '; }'. "\n";
                                        $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-header.pt-style-1 .section-title span  { background-color: ' . $ut_section_video_bgcolor . '; }'. "\n"; 
                                    }
                                }                                               
                                
                            endif; 
                            
                            /* 
                             * section title , text , heading and lead color 
                             */
                            
                            $ut_section_text_color = get_post_meta( $css_query->post->ID , 'ut_section_text_color' , true);
                            if(!empty($ut_section_text_color)) {
                                
                                /* add to CSS */
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content { color: ' . $ut_section_text_color . '; }'. "\n"; 
                                
                            }
                            
                            $ut_section_heading_color = get_post_meta( $css_query->post->ID , 'ut_section_heading_color' , true);
                            if( !empty($ut_section_heading_color) ) {
                                
                                /* add to CSS */
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content h1 { color: ' . $ut_section_heading_color . '; }'. "\n";
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content h2 { color: ' . $ut_section_heading_color . '; }'. "\n"; 
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content h3 { color: ' . $ut_section_heading_color . '; }'. "\n"; 
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content h4 { color: ' . $ut_section_heading_color . '; }'. "\n"; 
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content h5 { color: ' . $ut_section_heading_color . '; }'. "\n"; 
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-content h6 { color: ' . $ut_section_heading_color . '; }'. "\n";  
                            }  

                            $ut_section_header_style = get_post_meta( $css_query->post->ID , 'ut_section_header_style', true );
                            $ut_section_header_style = ( !empty($ut_section_header_style) && $ut_section_header_style != 'global' ) ? $ut_section_header_style : ot_get_option('ut_global_headline_style');                             
                            
                            $ut_section_title_color = get_post_meta( $css_query->post->ID , 'ut_section_title_color' , true);                            
                            
                            /* pt style 3 needs a fallback */
                            if( empty($ut_section_title_color) && $ut_section_header_style == 'pt-style-3') {
                                $ut_section_title_color = $accentcolor;
                            }
                            
                            if( !empty($ut_section_title_color) ) {
                                
                                /* add to CSS */
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-title { color: ' . $ut_section_title_color . '; }'. "\n";
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-title { color: ' . $ut_section_title_color . '; }'. "\n";
                                
                                $css.= create_section_headline_style( '#' . ut_clean_section_id($css_query->post->post_name) , $ut_section_header_style , $ut_section_title_color );
             
                            }
                            
                            $ut_section_headline_style_2_color  = get_post_meta( $css_query->post->ID , 'ut_section_headline_style_2_color' , true);
                            $ut_section_headline_style_2_color  = !empty( $ut_section_headline_style_2_color ) ? $ut_section_headline_style_2_color : ot_get_option('ut_global_headline_style_2_color', '#222');
                            
                            $ut_section_headline_style_2_height = get_post_meta( $css_query->post->ID , 'ut_section_headline_style_2_height' , true);
                            $ut_section_headline_style_2_height  = !empty( $ut_section_headline_style_2_height ) ? $ut_section_headline_style_2_height : ot_get_option('ut_global_headline_style_2_height', '1px');
                            
                            $ut_section_headline_style_2_width  = get_post_meta( $css_query->post->ID , 'ut_section_headline_style_2_width' , true);
                            $ut_section_headline_style_2_width  = !empty( $ut_section_headline_style_2_width ) ? $ut_section_headline_style_2_width : ot_get_option('ut_global_headline_style_2_width', '30px');
                            
                            $css .= create_section_headline_style( '#' . ut_clean_section_id($css_query->post->post_name), ' .pt-style-2', $ut_section_headline_style_2_color, $ut_section_headline_style_2_height, $ut_section_headline_style_2_width );
                            
                                           
                            /* 
                             * section title shadow
                             */
                            
                            if( get_post_meta( $css_query->post->ID , 'ut_section_title_glow' , true) == 'on' ) {
                                
                                $ut_section_title_color      = get_post_meta( $css_query->post->ID , 'ut_section_title_color' , true);
                                $ut_section_title_glow_color = get_post_meta( $css_query->post->ID , 'ut_section_title_glow_color' , true);
                                
                                if( !empty($ut_section_title_color) ) {                                
                                     
                                    /* add to CSS */ 
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-title.ut-glow { 
                                        text-shadow: 0 0 40px ' . $ut_section_title_color . ', 2px 2px 3px black ; 
                                    }'. "\n";
                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-title.ut-glow { 
                                        text-shadow: 0 0 40px ' . $ut_section_title_color . ', 2px 2px 3px black; 
                                    }'. "\n";
                                
                                }
                                
                                if( !empty($ut_section_title_glow_color) ) {                                
                                    
                                    /* add to CSS */
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-title.ut-glow { 
                                        text-shadow: 0 0 40px ' . $ut_section_title_glow_color . ', 2px 2px 3px black ; 
                                    }'. "\n";
                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .section-title.ut-glow { 
                                        text-shadow: 0 0 40px ' . $ut_section_title_glow_color . ', 2px 2px 3px black; 
                                    }'. "\n";
                                
                                }
                                                            
                            }
                            
                            
                            /* 
                             * section header spacing
                             */
                            $ut_section_header_margin_left  = get_post_meta( $css_query->post->ID , 'ut_section_header_margin_left' , true);
                            $ut_section_header_margin_right = get_post_meta( $css_query->post->ID , 'ut_section_header_margin_right' , true);
                                
                                /* add to CSS */
                                if( !empty($ut_section_header_margin_left) ) {
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' header.section-header { margin-left:'.$ut_section_header_margin_left.'; }'. "\n";
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' header.parallax-header { margin-left:'.$ut_section_header_margin_left.'; }'. "\n";
                                }
                                
                                /* add to CSS */ 
                                if( !empty($ut_section_header_margin_right) ) {
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' header.section-header { margin-right:'.$ut_section_header_margin_right.'; }'. "\n";
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' header.parallax-header { margin-right:'.$ut_section_header_margin_right.'; }'. "\n";
                                }
                            
                            /* 
                             * section p lead padding
                             */
                            $ut_section_slogan_padding_left  = get_post_meta( $css_query->post->ID , 'ut_section_slogan_padding_left' , true);
                            $ut_section_slogan_padding_right = get_post_meta( $css_query->post->ID , 'ut_section_slogan_padding_right' , true);
                                
                                /* add to CSS */
                                if( !empty($ut_section_slogan_padding_left) ) {                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .lead { padding-left: ' . $ut_section_slogan_padding_left . '; }'. "\n";                                    
                                }
                                
                                /* add to CSS */
                                if( !empty($ut_section_slogan_padding_right) ) {                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .lead { padding-right: ' . $ut_section_slogan_padding_right . '; }'. "\n";                                    
                                }
                            
                            /* 
                             * section lead color
                             */
                            $ut_section_slogan_color = get_post_meta( $css_query->post->ID , 'ut_section_slogan_color' , true);
                            
                                /* add to CSS */
                                if( !empty($ut_section_slogan_color) ) {
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .lead, #' . ut_clean_section_id($css_query->post->post_name) . ' .lead p { color: ' . $ut_section_slogan_color . '; }'. "\n"; 
                                }
                            
                            
                            /* 
                             * overlay color
                             */
                             
                            if( $ut_overlay_section == 'on') {
                                
                                $ut_overlay_color = get_post_meta( $css_query->post->ID , 'ut_overlay_color' , true);
                                $ut_overlay_color_opacity = get_post_meta( $css_query->post->ID , 'ut_overlay_color_opacity' , true);
                                $ut_overlay_color_opacity = !empty($ut_overlay_color_opacity) ? $ut_overlay_color_opacity : '0.8';

                                
                                /* add to CSS */
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-overlay { background-color: rgb(' . ut_hex_to_rgb($ut_overlay_color) . '); }'. "\n";
                                $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-overlay { background-color: rgba(' . ut_hex_to_rgb($ut_overlay_color) . ' , ' . $ut_overlay_color_opacity . ' ); }'. "\n";
                                
                            } 
                            
                            /* 
                             * section border top 
                             */
                            if( get_post_meta( $css_query->post->ID , 'ut_section_border_top' , true) == 'on' ) {
                                
                                /* border settings */
                                $ut_section_border_top_color = get_post_meta( $css_query->post->ID , 'ut_section_border_top_color' , true);                                
                                $ut_section_border_top_color = !empty($ut_section_border_top_color) ? $ut_section_border_top_color : $accentcolor;                                
                                $ut_section_border_top_width = get_post_meta( $css_query->post->ID , 'ut_section_border_top_width' , true); 
                                $ut_section_border_top_width = !empty( $ut_section_border_top_width) ?  $ut_section_border_top_width : '1'; 
                                $ut_section_border_top_style = get_post_meta( $css_query->post->ID , 'ut_section_border_top_style' , true); 
                                $ut_section_border_top_style = !empty( $ut_section_border_top_style) ?  $ut_section_border_top_style : 'solid';                               
                               
                                /* add to CSS */
                                if( $ut_overlay_section == 'on') {
                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-overlay { border-top: '.$ut_section_border_top_width.'px '.$ut_section_border_top_style.' '.$ut_section_border_top_color.'; }';
                                
                                } else {
                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . '{ border-top: '.$ut_section_border_top_width.'px '.$ut_section_border_top_style.' '.$ut_section_border_top_color.'; }';
                                
                                }
                            
                            }
                            
                            
                            /* 
                             * section border bottom 
                             */
                            if( get_post_meta( $css_query->post->ID , 'ut_section_border_bottom' , true) == 'on' ) {
                                
                                /* border settings */
                                $ut_section_border_bottom_color = get_post_meta( $css_query->post->ID , 'ut_section_border_bottom_color' , true);                                
                                $ut_section_border_bottom_color = !empty($ut_section_border_bottom_color) ? $ut_section_border_bottom_color : $accentcolor;                                
                                $ut_section_border_bottom_width = get_post_meta( $css_query->post->ID , 'ut_section_border_bottom_width' , true); 
                                $ut_section_border_bottom_width = !empty( $ut_section_border_bottom_width) ?  $ut_section_border_bottom_width : '1'; 
                                $ut_section_border_bottom_style = get_post_meta( $css_query->post->ID , 'ut_section_border_bottom_style' , true); 
                                $ut_section_border_bottom_style = !empty( $ut_section_border_bottom_style) ?  $ut_section_border_bottom_style : 'solid';                               
                               
                                /* add to CSS */
                                if( $ut_overlay_section == 'on') {
                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' .parallax-overlay { border-bottom: '.$ut_section_border_bottom_width.'px '.$ut_section_border_bottom_style.' '.$ut_section_border_bottom_color.'; }';

                                } else {
                                    
                                    $css.= '#' . ut_clean_section_id($css_query->post->post_name) . ' { border-bottom: '.$ut_section_border_bottom_width.'px '.$ut_section_border_bottom_style.' '.$ut_section_border_bottom_color.'; }';
                                
                                }
                            
                            }
                            
                                                        
                        endwhile;
                    
                    endif;
                    
                    wp_reset_postdata();
                    
                }
            
            } /* end front page styling */
            
            $css .= '.parallax-overlay-pattern.style_one { background-image: url(" '. THEME_WEB_ROOT .'/images/overlay-pattern.png") !important; }'. "\n";
            $css .= '.parallax-overlay-pattern.style_two { background-image: url(" '. THEME_WEB_ROOT .'/images/overlay-pattern2.png") !important; }'. "\n";
            
            /* custom css from theme option panel */
            $css .= ot_get_option('ut_custom_css');
            
            
        /* end css */    
        $css .= '</style>';
        
        /* check for css cache */
        if( ot_get_option('ut_use_cache' , 'off') == 'on' && is_front_page() ) {
            
            $transient_prefix = unite_mobile_detection()->isMobile() ? '_mobile' : '_desktop'; 
            $ssl_prefix = is_ssl() ? '_ssl' : '_no_ssl'; 
            $language_prefix =  defined('ICL_LANGUAGE_CODE') ? '_' . ICL_LANGUAGE_CODE : '';
                       
            $cacheTime = ot_get_option('ut_cache_ltime' , '10');            
            set_transient('ut_css_cache'. $transient_prefix . $language_prefix . $ssl_prefix , $css, 60 * $cacheTime);
        
        }
                
        echo apply_filters( 'ut-custom-css', $css );        
        
    }
    
    add_action('wp_head' , 'unitedthemes_custom_css');
    
} 

?>