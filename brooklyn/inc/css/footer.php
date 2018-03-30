<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'UT_Footer_CSS' ) ) {	
    
    class UT_Footer_CSS {
        
        private $css;
        
        function __construct() {
             
            add_action('wp_head' , array( $this, 'custom_css' ) ); 
            
        }        
        
        function custom_css() {
            
            /* global accent color */
            $accentcolor = get_option('ut_accentcolor' , '#F1C40F');
            
            /* available google fonts */
            $google_fonts = ut_recognized_google_fonts();
            
            /* default font styles */
            $recognized_font_styles = ut_recognized_font_styles();
            
            /* Footer Widget Titles Font Style */
            if( ot_get_option('ut_footer_widgets_headline_font_type' , 'ut-font') == 'ut-google' ) {
             
                    $ut_footer_widgets_headline_google_font_style = ot_get_option('ut_footer_widgets_headline_google_font_style');                
                
                    if( !empty( $google_fonts[ $ut_footer_widgets_headline_google_font_style['font-id']]['family'] ) ) {
                    
                        $font = '#ut-sitebody .ut-footer-area h3.widget-title {';
                            
                            $font .= 'font-family:"'.$google_fonts[$ut_footer_widgets_headline_google_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty( $ut_footer_widgets_headline_google_font_style['font-weight']) ) {
                                $font .= ' font-weight: ' .  $ut_footer_widgets_headline_google_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty( $ut_footer_widgets_headline_google_font_style['font-size']) ) {
                                $font .= ' font-size: ' .  $ut_footer_widgets_headline_google_font_style['font-size'] . ';';    
                            }
                            
                            if( !empty( $ut_footer_widgets_headline_google_font_style['font-style']) && isset($font_styles[ $ut_footer_widgets_headline_google_font_style['font-style']]) ) {
                                $font .= ' font-style: ' . $font_styles[ $ut_footer_widgets_headline_google_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty( $ut_footer_widgets_headline_google_font_style['line-height']) ) {
                                $font .= ' line-height: ' .  $ut_footer_widgets_headline_google_font_style['line-height'] . ';';    
                            }
                            
                            if( !empty( $ut_footer_widgets_headline_google_font_style['text-transform']) ) {
                                $font .= ' text-transform: ' .  $ut_footer_widgets_headline_google_font_style['text-transform'] . ';';    
                            }
                            
                        $font .= '}';
                        
                        $this->css .= $font;
                    
                    } else {
                    
                        /* fallback if user has not chosen a google font yet */
                        $font_style = ot_get_option('ut_footer_widgets_headline_font_style' , 'semibold');
                        if( isset($recognized_font_styles[$font_style]) ) {
                            $this->css .= '#ut-sitebody .ut-footer-area h3.widget-title { font-family: ' . $recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";
                        }
                    }
            
            } elseif( ot_get_option('ut_footer_widgets_headline_font_type' , 'ut-font') == 'ut-websafe' ) {
                
                    $this->css .= ut_create_typography_css('#ut-sitebody .ut-footer-area h3.widget-title', ot_get_option('ut_footer_widgets_headline_websafe_font_style') );    
                
            } else {
                
                $font_style = ot_get_option('ut_footer_widgets_headline_font_style' , 'semibold');
                if( isset($recognized_font_styles[$font_style]) ) {
                    $this->css .= '#ut-sitebody .ut-footer-area h3.widget-title { font-family: ' . $recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";                     
                }
                
            }
            
            /* record output */
            ob_start(); ?>
            
            
            <?php if( ot_get_option('ut_footer_skin') == 'ut-footer-custom' ) { ?>
            
                <?php if( ot_get_option('ut_scroll_up_button_icon_color') ) : ?>
                
                /* Scroll To Top Button */
                #ut-sitebody .toTop {
                    color:<?php echo ot_get_option('ut_scroll_up_button_icon_color'); ?>;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_scroll_up_button_background_color') ) : ?>
                
                /* Scroll To Top Button */
                #ut-sitebody .toTop {
                    background:<?php echo ot_get_option('ut_scroll_up_button_background_color'); ?>;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_scroll_up_button_icon_color_hover') ) : ?>
                
                #ut-sitebody .toTop:hover,
                #ut-sitebody .toTop:focus,
                #ut-sitebody .toTop:active {
                    color:<?php echo ot_get_option('ut_scroll_up_button_icon_color_hover'); ?>;    
                }            
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_scroll_up_button_shadow', 'on' ) == 'off' ) : ?>
                
                /* Scroll To Top Button - Shadow */
                #ut-sitebody .toTop {
                     -webkit-box-shadow:none;
                        -moz-box-shadow:none;
                             box-shadow:none;   
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_scroll_up_button_border_radius', 'on' ) == 'off' ) : ?>
                
                /* Scroll To Top Button - Border */ 
                #ut-sitebody .toTop {
                     -webkit-border-radius:0;
                        -moz-border-radius:0;
                             border-radius:0;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_headline_color') ) : ?>
                
                /* Footer Widget Title */
                #ut-sitebody .ut-footer-area .widget-title,
                #ut-sitebody .ut-footer-area .widget-title a,
                #ut-sitebody .ut-footer-area .widget-title a:hover,
                #ut-sitebody .ut-footer-area .widget-title a:focus,
                #ut-sitebody .ut-footer-area .widget-title a:active,
                #ut-sitebody .ut-footer-area h1,
                #ut-sitebody .ut-footer-area h2,
                #ut-sitebody .ut-footer-area h3,
                #ut-sitebody .ut-footer-area h4,
                #ut-sitebody .ut-footer-area h5,
                #ut-sitebody .ut-footer-area h6 {
                    color:<?php echo ot_get_option('ut_footer_widgets_headline_color'); ?> !important;
                }
                
                <?php endif; ?>
                
                <?php if( ot_get_option('ut_footer_widgets_text_color') ) : ?>
                 
                /* Footer Color */
                #ut-sitebody .ut-footer-area,
                #ut-sitebody .ut-footer-area select,
                #ut-sitebody .ut-footer-area textarea,
                #ut-sitebody .ut-footer-area input[type="text"],
                #ut-sitebody .ut-footer-area input[type="tel"],
                #ut-sitebody .ut-footer-area input[type="email"],
                #ut-sitebody .ut-footer-area input[type="password"],
                #ut-sitebody .ut-footer-area input[type="number"],
                #ut-sitebody .ut-footer-area input[type="search"] {
                    color:<?php echo ot_get_option('ut_footer_widgets_text_color'); ?> !important;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_text_font_size') ) : ?>
                
                /* Footer Font Size */
                #ut-sitebody .ut-footer-area,
                #ut-sitebody .ut-footer-area select,
                #ut-sitebody .ut-footer-area textarea,
                #ut-sitebody .ut-footer-area input[type="text"],
                #ut-sitebody .ut-footer-area input[type="tel"],
                #ut-sitebody .ut-footer-area input[type="email"],
                #ut-sitebody .ut-footer-area input[type="password"],
                #ut-sitebody .ut-footer-area input[type="number"],
                #ut-sitebody .ut-footer-area input[type="search"] {
                    font-size:<?php echo ot_get_option('ut_footer_widgets_text_font_size'); ?> !important;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_link_color') ) : ?>
                
                /* Footer Link */
                #ut-sitebody .ut-footer-area a {
                    color:<?php echo ot_get_option('ut_footer_widgets_link_color'); ?> !important;   
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_link_color_hover') ) : ?>
                
                /* Footer Link Hover */
                #ut-sitebody .ut-footer-area a:hover,
                #ut-sitebody .ut-footer-area a:focus,
                #ut-sitebody .ut-footer-area a:active {
                    color:<?php echo ot_get_option('ut_footer_widgets_link_color_hover'); ?> !important;   
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_border_color') ) : ?>
                 
                /* Footer Border Color */
                #ut-sitebody .ut-footer-area li,
                #ut-sitebody .ut-archive-tags a,
                #ut-sitebody .widget_tag_cloud a,
                #ut-sitebody table,
                #ut-sitebody tr,
                #ut-sitebody td,
                #ut-sitebody .ut-footer-area select,
                #ut-sitebody .ut-footer-area textarea,
                #ut-sitebody .ut-footer-area input[type="text"],
                #ut-sitebody .ut-footer-area input[type="tel"],
                #ut-sitebody .ut-footer-area input[type="email"],
                #ut-sitebody .ut-footer-area input[type="password"],
                #ut-sitebody .ut-footer-area input[type="number"],
                #ut-sitebody .ut-footer-area input[type="search"] {
                    border-color:<?php echo ot_get_option('ut_footer_widgets_border_color'); ?> !important;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_border_color_hover') ) : ?>
                
                /* Footer Border Color Hover */
                #ut-sitebody .ut-footer-area select:active,
                #ut-sitebody .ut-footer-area textarea:active,
                #ut-sitebody .ut-footer-area input[type="text"]:active,
                #ut-sitebody .ut-footer-area input[type="tel"]:active,
                #ut-sitebody .ut-footer-area input[type="email"]:active,
                #ut-sitebody .ut-footer-area input[type="password"]:active,
                #ut-sitebody .ut-footer-area input[type="number"]:active,
                #ut-sitebody .ut-footer-area input[type="search"]:active,
                #ut-sitebody .ut-footer-area select:focus,
                #ut-sitebody .ut-footer-area textarea:focus,
                #ut-sitebody .ut-footer-area input[type="text"]:focus,
                #ut-sitebody .ut-footer-area input[type="tel"]:focus,
                #ut-sitebody .ut-footer-area input[type="email"]:focus,
                #ut-sitebody .ut-footer-area input[type="password"]:focus,
                #ut-sitebody .ut-footer-area input[type="number"]:focus,
                #ut-sitebody .ut-footer-area input[type="search"]:focus,
                #ut-sitebody .ut-archive-tags a:hover,
                #ut-sitebody .widget_tag_cloud a:hover,
                #ut-sitebody .ut-archive-tags a:active,
                #ut-sitebody .widget_tag_cloud a:active,
                #ut-sitebody .ut-archive-tags a:focus,
                #ut-sitebody .widget_tag_cloud a:focus {
                    border-color:<?php echo ot_get_option('ut_footer_widgets_border_color_hover'); ?> !important;
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_icon_color') ) : ?>
                
                /* Footer Icons */
                #ut-sitebody .ut-footer-area .fa,
                #ut-sitebody .ut-footer-area  a .fa,
                #ut-sitebody .widget_categories li::before, 
                #ut-sitebody .widget_pages li::before, 
                #ut-sitebody .widget_nav_menu li::before, 
                #ut-sitebody .widget_recent_entries li::before, 
                #ut-sitebody .widget_meta li::before, 
                #ut-sitebody .widget_archive li::before,
                #ut-sitebody .ut_widget_contact .ut-address::before, 
                #ut-sitebody .ut_widget_contact .ut-phone::before, 
                #ut-sitebody .ut_widget_contact .ut-fax::before, 
                #ut-sitebody .ut_widget_contact .ut-email::before, 
                #ut-sitebody .ut_widget_contact .ut-internet::before,
                #ut-sitebody .tweet_list li::before {
                    color:<?php echo ot_get_option('ut_footer_widgets_icon_color'); ?> !important;   
                }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option('ut_footer_widgets_icon_color_hover') ) : ?>
                
                /* Footer Icons Hover */
                #ut-sitebody .ut-footer-area a:hover .fa,
                #ut-sitebody .ut-footer-area a:active .fa,
                #ut-sitebody .ut-footer-area a:focus .fa {
                    color:<?php echo ot_get_option('ut_footer_widgets_icon_color_hover'); ?> !important;   
                }
                
                <?php endif; ?>
            
            <?php } /* end custom skin */ ?>
            
            
            <?php if( ot_get_option('ut_subfooter_text_color') ) : ?>
            
            /* Sub Footer Text Color */
            #ut-sitebody .footer-content,
            #ut-sitebody .footer-content .copyright {
                color:<?php echo ot_get_option('ut_subfooter_text_color'); ?> !important;      
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_subfooter_link_color') ) : ?>
            
            /* Sub Footer Link Color */
            #ut-sitebody .footer-content a {
                color:<?php echo ot_get_option('ut_subfooter_link_color'); ?>;   
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_subfooter_link_color_hover') ) : ?>
            
            #ut-sitebody .footer-content a:hover,
            #ut-sitebody .footer-content a:focus,
            #ut-sitebody .footer-content a:active {
                color:<?php echo ot_get_option('ut_subfooter_link_color_hover'); ?>;   
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_subfooter_icon_color') ) : ?>
            
            /* Sub Footer Icon Color */
            #ut-sitebody .footer-content .fa {
                color:<?php echo ot_get_option('ut_subfooter_icon_color'); ?> !important;   
            }
            
            <?php endif; ?>
            
            
            <?php if( ot_get_option('ut_subfooter_headline_color') ) : ?>
            
            /* Sub Footer Headline Color */
            #ut-sitebody .footer-content h1,
            #ut-sitebody .footer-content h2,
            #ut-sitebody .footer-content h3,
            #ut-sitebody .footer-content h4,
            #ut-sitebody .footer-content h5,
            #ut-sitebody .footer-content h6 {
                color:<?php echo ot_get_option('ut_subfooter_headline_color'); ?> !important;    
            }
            
            <?php endif; ?>
                        
            
            <?php
            
            $this->css .= ob_get_clean();
            
            
            /* copyright */
            if(  ot_get_option('ut_subfooter_font_weight' , 'normal') == 'bold' ) {
                
                $this->css .= '.copyright { font-family: "ralewaysemibold", Helvetica, Arial, sans-serif !important; }';
                
            }
            
            /* output css */
            echo ut_minify_css( '<style type="text/css">' . $this->css . '</style>' );
        
        }  
            
    }

}

new UT_Footer_CSS;