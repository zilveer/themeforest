<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'UT_Blog_CSS' ) ) {	
    
    class UT_Blog_CSS {
        
        private $css;
        
        function __construct() {
            
            add_action('wp_head' , array( $this, 'custom_css' ) ); 
            
        }        
        
        public function custom_css() {
            
            if( !is_home() && !is_single() ) {
                return;
            }
                        
            /* global accent color */
            $accentcolor = get_option('ut_accentcolor' , '#F1C40F');
            
            /**
             * Hero Scroll Down
             */
            
            if( ot_get_option('ut_blog_hero_down_arrow_color') ) {
                $this->css .= '#ut-hero .hero-down-arrow a { color: ' . ot_get_option('ut_blog_hero_down_arrow_color') . '; }';
            }
            
            if( ot_get_option('ut_blog_hero_down_arrow_scroll_position') != '' ) {
                $this->css .= '#ut-hero .hero-down-arrow { left: ' . ot_get_option('ut_blog_hero_down_arrow_scroll_position') . '%; }';
            }
            
            if( ot_get_option('ut_blog_hero_down_arrow_scroll_position_vertical') != '' ) {
                $this->css .= '#ut-hero .hero-down-arrow { bottom: ' . ot_get_option('ut_blog_hero_down_arrow_scroll_position_vertical') . 'px; }';
            }
            
            /**
             * Blog Pagination
             */
            if( ot_get_option('ut_blog_pagination_background_color') ) {
                    
               $this->css.= '#ut-blog-navigation { background: ' . ot_get_option('ut_blog_pagination_background_color') . ';}'; 
                
            }
            
            if( ot_get_option('ut_blog_pagination_height') ) {
                
               $this->css.= '#ut-blog-navigation { height: ' . ot_get_option('ut_blog_pagination_height') . 'px;}';
               $this->css.= '#ut-blog-navigation .fa { line-height: ' . ot_get_option('ut_blog_pagination_height') . 'px;}';  
                
            }
            
            if( ot_get_option('ut_blog_pagination_arrow_color') ) {
                
               $this->css.= '#ut-blog-navigation a { color: ' . ot_get_option('ut_blog_pagination_arrow_color') . ';}';
               $this->css.= '#ut-blog-navigation a:visited { color: ' . ot_get_option('ut_blog_pagination_arrow_color') . ';}';  
                
            }
            
            if( ot_get_option('ut_blog_pagination_arrow_hover_color') ) {
                
               $this->css.= '#ut-blog-navigation a:hover { color: ' . ot_get_option('ut_blog_pagination_arrow_hover_color') . ';}'; 
               $this->css.= '#ut-blog-navigation a:focus { color: ' . ot_get_option('ut_blog_pagination_arrow_hover_color') . ';}';
               $this->css.= '#ut-blog-navigation a:active { color: ' . ot_get_option('ut_blog_pagination_arrow_hover_color') . ';}';
                
            }            
            
            /* available google fonts */
            $google_fonts = ut_recognized_google_fonts();
            
            /* default font styles */
            $recognized_font_styles = ut_recognized_font_styles();
            
            /* Blog Widget Titles Font Style */
            if( ot_get_option('ut_global_blog_widgets_headline_font_type' , 'ut-font') == 'ut-google' ) {
             
                    $ut_global_blog_widgets_headline_google_font_style = ot_get_option('ut_global_blog_widgets_headline_google_font_style');                
                
                    if( !empty( $google_fonts[$ut_global_blog_widgets_headline_google_font_style['font-id']]['family'] ) ) {
                    
                        $font = '#ut-sitebody #secondary h3.widget-title {';
                            
                            $font .= 'font-family:"'.$google_fonts[$ut_global_blog_widgets_headline_google_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty( $ut_global_blog_widgets_headline_google_font_style['font-weight']) ) {
                                $font .= ' font-weight: ' .  $ut_global_blog_widgets_headline_google_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty( $ut_global_blog_widgets_headline_google_font_style['font-size']) ) {
                                $font .= ' font-size: ' .  $ut_global_blog_widgets_headline_google_font_style['font-size'] . ';';    
                            }
                            
                            if( !empty( $ut_global_blog_widgets_headline_google_font_style['font-style']) && isset($font_styles[ $ut_global_blog_widgets_headline_google_font_style['font-style']]) ) {
                                $font .= ' font-style: ' . $font_styles[ $ut_global_blog_widgets_headline_google_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty( $ut_global_blog_widgets_headline_google_font_style['line-height']) ) {
                                $font .= ' line-height: ' .  $ut_global_blog_widgets_headline_google_font_style['line-height'] . ';';    
                            }
                            
                            if( !empty( $ut_global_blog_widgets_headline_google_font_style['text-transform']) ) {
                                $font .= ' text-transform: ' .  $ut_global_blog_widgets_headline_google_font_style['text-transform'] . ';';    
                            }
                            
                        $font .= '}';
                        
                        $this->css .= $font;
                    
                    } else {
                    
                        /* fallback if user has not chosen a google font yet */
                        $font_style = ot_get_option('ut_global_blog_widgets_headline_font_style' , 'semibold');
                        if( isset($recognized_font_styles[$font_style]) ) {
                            $this->css .= '#ut-sitebody #secondary h3.widget-title { font-family: ' . $recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";
                        }
                    }
            
            } elseif( ot_get_option('ut_global_blog_widgets_headline_font_type' , 'ut-font') == 'ut-websafe' ) {
                
                    $this->css .= ut_create_typography_css('#ut-sitebody #secondary h3.widget-title ', ot_get_option('ut_global_blog_widgets_headline_websafe_font_style') );    
                
            } else {
                
                $font_style = ot_get_option('ut_global_blog_widgets_headline_font_style' , 'semibold');
                if( isset($recognized_font_styles[$font_style]) ) {
                    $this->css .= '#ut-sitebody #secondary h3.widget-title { font-family: ' . $recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";                     
                }
                
            }
            
            
            /**
             * Blog Titles
             */
            
            if( ot_get_option('ut_global_blog_titles_font_style') ) {
                
                $this->css .= ut_create_typography_css('.blog h2.entry-title', ot_get_option('ut_global_blog_titles_font_style') );    
            
            }
            
            /**
             * Single Post Titles
             */
            
            if( ot_get_option('ut_global_blog_single_titles_font_style') ) {
                
                $this->css .= ut_create_typography_css('.single-post h1.entry-title', ot_get_option('ut_global_blog_single_titles_font_style') );    
            
            }
            
            
            
            
            
            /* output css */
            echo ut_minify_css( '<style type="text/css">' . $this->css . '</style>' );
        
        }  
            
    }

}

new UT_Blog_CSS;