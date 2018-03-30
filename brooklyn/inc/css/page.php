<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'UT_Page_CSS' ) ) {	
    
    class UT_Page_CSS {
        
        private $css;
        
        function __construct() {
             
            add_action('wp_head' , array( $this, 'custom_css' ) ); 
            
        }        
        
        function headline_style( $div = '',  $style = 'pt-style-1' , $color = '' , $height = '' , $width = '' ) {
        
            if( empty( $color ) ) {
                return;
            }
                    
            switch ( $style ) {
                
                case 'pt-style-1':
                    
                    return '
                    ' . $div . ' span {
                        background: ' . $color . ';
                    }
                    ';
                    
                break;
                
                case 'pt-style-2':
                    
                    return '
                    '.$div.':after {
                        background-color: ' . $color . ';
                        height: ' . $height .';
                        width: ' . $width . ';
                    }';
                    
                break;
                
                case 'pt-style-3':
                    
                    return '
                        '.$div.' span { 
                            background:' . $color . ';            
                            -webkit-box-shadow:0 0 0 3px' . $color . '; 
                            -moz-box-shadow:0 0 0 3px' . $color . '; 
                            box-shadow:0 0 0 3px' . $color . '; 
                        }
                    ';                
                    
                break;
                
                case 'pt-style-4':
                    
                    return '
                    '.$div.' span {
                        border:3px solid ' . $color . ';
                    }';
                    
                break;
                
                case 'pt-style-5':
                    
                    return '
                    '.$div.' span {
                        background:' . $color . ';            
                        -webkit-box-shadow:0 0 0 3px' . $color . '; 
                        -moz-box-shadow:0 0 0 3px' . $color . '; 
                        box-shadow:0 0 0 3px' . $color . '; 
                    }';
                    
                break;
                
                
                case 'pt-style-6':
                    
                    return '
                    '.$div.':after {
                        border-bottom: 1px dotted ' . $color . ';
                    }';
                
                break;
                
                
            }
            
        }
        
        public function custom_css() {
            
            global $post;
            
            if( is_front_page() || is_home() ) {
                return;
            }
            
            /* global accent color */
            $accentcolor = get_option('ut_accentcolor' , '#F1C40F');
            
            if( !isset( $post->ID ) ) {
                return;
            }
                        
            /**
             * Hero Color Styling
             */
            
            if( get_post_meta( $post->ID ,'ut_page_hero_global_content_style' , true ) == 'on' ) {
                
                $ut_page_caption_title_color = ot_get_option('ut_global_hero_company_slogan_color');
                $ut_hero_caption_description_color = ot_get_option('ut_global_hero_catchphrase_color');
                $ut_page_caption_slogan_color = ot_get_option('ut_global_hero_expertise_slogan_color');
                $ut_page_caption_slogan_background_color = ot_get_option('ut_global_hero_expertise_slogan_background_color');
                
            } else {
                
                $ut_page_caption_title_color = get_post_meta( $post->ID ,'ut_page_caption_title_color' , true );
                $ut_hero_caption_description_color = get_post_meta( $post->ID ,'ut_page_caption_description_color' , true ); 
                $ut_page_caption_slogan_color = get_post_meta( $post->ID ,'ut_page_caption_slogan_color' , true );
                $ut_page_caption_slogan_background_color = get_post_meta( $post->ID ,'ut_page_caption_slogan_background_color' , true);
                
            }
                        
            /* add to CSS */
            if( !empty( $ut_page_caption_title_color ) ) {
                $this->css .= '.hero-title { color: ' . $ut_page_caption_title_color . ';}';
            }
            if( get_post_meta( $post->ID ,'ut_page_caption_slogan_uppercase' , true) == 'on' ) {                    
                $this->css .= '.hero-title { text-transform: uppercase; }';
            }
                       
            /* add to CSS */
            $ut_hero_caption_description_websafe_font_style = get_post_meta( $post->ID ,'ut_page_caption_description_websafe_font_style' , true );
            if( !empty( $ut_hero_caption_description_websafe_font_style ) ) {
                $this->css .= ut_create_typography_css( '.hero-description-bottom', $ut_hero_caption_description_websafe_font_style );
            }
            
            /* add to CSS */
            if( !empty( $ut_hero_caption_description_color ) ) {
                $this->css .= '.hero-description-bottom { color: ' . $ut_hero_caption_description_color . ';}';
            }
            
            /* add to CSS */
            if( !empty( $ut_page_caption_slogan_color ) ) {
                $this->css .= '.hero-description { color: ' . $ut_page_caption_slogan_color . '}';
            }
            
            /* add to CSS */
            if( !empty( $ut_page_caption_slogan_background_color ) ) {
                $this->css .= '.hero-description { background: ' . $ut_page_caption_slogan_background_color . '; padding-bottom:0; margin-bottom: 5px; }';
            }
            
            $ut_page_caption_slogan_margin = get_post_meta( $post->ID ,'ut_page_caption_slogan_margin' , true);
            /* add to CSS */
            if( !empty( $ut_page_caption_slogan_margin ) ) {
                $this->css .= '#ut-hero .hdh { margin-bottom: ' . $ut_page_caption_slogan_margin . ';}';
            }
            
            $ut_page_hero_buttons_margin = get_post_meta( $post->ID ,'ut_page_hero_buttons_margin' , true);
            /* add to CSS */
            if( !empty( $ut_page_hero_buttons_margin ) ) {
                $this->css .= '#ut-hero .hero-btn-holder { margin-top: ' . $ut_page_hero_buttons_margin . '; }';
            }
            
            
            /**
             * Hero Scroll Down
             */
             
            $ut_page_scroll_down_arrow_color = get_post_meta( $post->ID ,'ut_page_scroll_down_arrow_color' , true);
            /* add to CSS */
            if( !empty( $ut_page_scroll_down_arrow_color ) ) {
                $this->css .= '#ut-hero .hero-down-arrow a { color: ' . $ut_page_scroll_down_arrow_color . '; }';
            }
            
            $ut_page_scroll_down_arrow_position = get_post_meta( $post->ID ,'ut_page_scroll_down_arrow_position' , true);
            /* add to CSS */
            if( $ut_page_scroll_down_arrow_position != '' ) {
                $this->css .= '#ut-hero .hero-down-arrow { left: ' . $ut_page_scroll_down_arrow_position . '%; }';
            }
            
            $ut_page_scroll_down_arrow_position_vertical = get_post_meta( $post->ID ,'ut_page_scroll_down_arrow_position_vertical' , true);
            /* add to CSS */
            if( $ut_page_scroll_down_arrow_position_vertical != '' ) {
                $this->css .= '#ut-hero .hero-down-arrow { bottom: ' . $ut_page_scroll_down_arrow_position_vertical . 'px; }';
            }
            
            
            
            
                        
            /**
             * Hero Fancy Border
             */
             
            if( get_post_meta( $post->ID , 'ut_page_hero_fancy_border' , true ) == 'on' ) {
                    
                $ut_page_fancy_border_color = get_post_meta( $post->ID , 'ut_page_fancy_border_color' , true);
                $ut_page_fancy_border_color = empty($ut_page_fancy_border_color) ? $accentcolor : $ut_page_fancy_border_color;
                
                $ut_page_fancy_border_background_color = get_post_meta( $post->ID , 'ut_page_fancy_border_background_color' , true);
                $ut_page_fancy_border_background_color = empty($ut_page_fancy_border_background_color) ? '#FFF' : $ut_page_fancy_border_background_color;
                
                $ut_page_fancy_border_size = get_post_meta( $post->ID , 'ut_page_fancy_border_size' , true);
                $ut_page_fancy_border_size = empty($ut_page_fancy_border_size) ? '10px' : $ut_page_fancy_border_size;
                
                $this->css .= '#ut-hero .ut-fancy-border { 
                    display: block; 
                    position: absolute; 
                    bottom: 0; 
                    left: 0; 
                    width: 100%; 
                    background:' . $ut_page_fancy_border_background_color . '; 
                    border-bottom:' . $ut_page_fancy_border_size . ';
                    border-color:' . $ut_page_fancy_border_color . '; 
                    border-style: dashed; 
                    z-index:9999; 
                }';
                
            }
            
            /**
             * Page Background
             */
             
            $ut_page_background_color = get_post_meta( $post->ID , 'ut_section_background_color' , true);
            /* add to CSS */
            if( !empty( $ut_page_background_color ) ) {
                $this->css .= '.main-content-background { background-color: ' . $ut_page_background_color . '; }';                
            } 
            
            
            /**
             * Page Title Settings
             */
            
            $ut_page_slogan_padding = get_post_meta( $post->ID , 'ut_section_slogan_padding' , true);                
            /* add to CSS */
            if( !empty( $ut_page_slogan_padding ) ) { 
                $this->css .= '#primary .page-primary-header { padding-bottom: ' . $ut_page_slogan_padding . '; }';                               
            }
            
            /* headlines */
            $ut_section_header_font_style = get_post_meta( $post->ID , 'ut_section_header_font_style' , true );
            $this->css .= ut_create_global_headline_font_style(
                                '#primary h1.page-title', 
                                $ut_section_header_font_style,
                                'ut_global_page_headline_font_type',
                                'ut_global_page_google_headline_font_style',
                                'ut_global_page_headline_font_style',
                                'ut_global_page_headline_font_style_settings',
                                'ut_global_page_headline_websafe_font_style_settings',
                                'ut_global_page_headline_font_color' );
            
            /* set title style */
            $ut_page_header_style = get_post_meta( $post->ID , 'ut_section_header_style', true );
            $ut_page_header_style = ( !empty( $ut_page_header_style ) && $ut_page_header_style != 'global' ) ? $ut_page_header_style : ot_get_option( 'ut_global_page_headline_style' );
            
            $ut_page_title_color = get_post_meta( $post->ID , 'ut_section_title_color' , true);
            if( !empty( $ut_page_title_color ) ) {
                $this->css .= '#primary h1.page-title { color: ' . $ut_page_title_color . '; }';
            }
            
            /* pt style 1 */
            $this->css .= $this->headline_style( '#primary .pt-style-1 h1.page-title', 'pt-style-1', ( !empty( $ut_page_background_color ) ? $ut_page_background_color : '#FFF' ) );            
            
            /* pt style 2 */
            $ut_page_headline_style_2_color  = get_post_meta( $post->ID , 'ut_section_headline_style_2_color' , true);
            $ut_page_headline_style_2_color  = !empty( $ut_page_headline_style_2_color ) ? $ut_page_headline_style_2_color : ot_get_option('ut_global_page_headline_style_2_color', '#222');
            
            $ut_page_headline_style_2_height = get_post_meta( $post->ID , 'ut_section_headline_style_2_height' , true);
            $ut_page_headline_style_2_height  = !empty( $ut_page_headline_style_2_height ) ? $ut_page_headline_style_2_height : ot_get_option('ut_global_page_headline_style_2_height', '1px');
            
            $ut_page_headline_style_2_width  = get_post_meta( $post->ID , 'ut_section_headline_style_2_width' , true);
            $ut_page_headline_style_2_width  = !empty( $ut_page_headline_style_2_width ) ? $ut_page_headline_style_2_width : ot_get_option('ut_global_page_headline_style_2_width', '30px');
            
            $this->css .= $this->headline_style( '#primary .pt-style-2 h1.page-title' , 'pt-style-2', $ut_page_headline_style_2_color, $ut_page_headline_style_2_height, $ut_page_headline_style_2_width );
            
            /* pt style 3 */
            $ut_page_title_color = !empty( $ut_page_title_color ) ? $ut_page_title_color : $accentcolor;
            $this->css .= $this->headline_style( '#primary header.page-header.pt-style-3', 'pt-style-3', $ut_page_title_color );
            
                        
            $ut_page_header_margin_left = get_post_meta( $post->ID , 'ut_section_header_margin_left' , true);
            /* add to CSS */
            if( !empty($ut_page_header_margin_left) ) {
                $this->css .= '#primary .page-header:not(.wpb_wrapper .page-header) { margin-left:'.$ut_page_header_margin_left.'; }';
            }
            
            $ut_page_header_margin_right = get_post_meta( $post->ID , 'ut_section_header_margin_right' , true); 
            /* add to CSS */ 
            if( !empty($ut_page_header_margin_right) ) {
                $this->css .= '#primary .page-header:not(.wpb_wrapper .page-header) { margin-right:'.$ut_page_header_margin_right.'; }';
            }
            
            
            /**
             * Page Title Glow
             */
             
            if( get_post_meta( $post->ID , 'ut_section_title_glow' , true) == 'on' ) {
                            
                $ut_page_title_color      = get_post_meta( $post->ID , 'ut_section_title_color' , true);
                $ut_page_title_glow_color = get_post_meta( $post->ID , 'ut_section_title_glow_color' , true);
                
                if( !empty( $ut_page_title_color ) ) {                                
                
                    $this->css .= '#primary .page-title.ut-glow { 
                        text-shadow: 0 0 40px ' . $ut_page_title_color . ', 2px 2px 3px black ; 
                    }'. "\n";
                
                }
                
                if( !empty( $ut_page_title_glow_color ) ) {                                
                
                    $this->css .= '#primary .page-title.ut-glow { 
                        text-shadow: 0 0 40px ' . $ut_page_title_glow_color . ', 2px 2px 3px black ; 
                    }'. "\n";
                
                }
                                            
            }
                        
            
            /**
             * Page Lead Settings
             */
            
            $ut_page_slogan_color = get_post_meta( $post->ID , 'ut_section_slogan_color' , true);
            /* add to CSS */
            if( !empty( $ut_page_slogan_color ) ) {
                $this->css .= '#primary .lead p { color: ' . $ut_page_slogan_color . '; }'; 
            }
            
            $ut_section_slogan_padding_left  = get_post_meta( $post->ID , 'ut_section_slogan_padding_left' , true);
            /* add to CSS */
            if( !empty($ut_section_slogan_padding_left) ) {
                $this->css .= '#primary .lead p { padding-left: ' . $ut_section_slogan_padding_left . '; }'; 
            }
            
            $ut_section_slogan_padding_right = get_post_meta( $post->ID , 'ut_section_slogan_padding_right' , true);
            /* add to CSS */
            if( !empty($ut_section_slogan_padding_right) ) {
                $this->css .= '#primary .lead p { padding-right: ' . $ut_section_slogan_padding_right . '; }'; 
            }  
            
           
            /**
             * Content Section Title Settings
             */
            $this->css .= ut_create_global_headline_font_style('#primary .parallax-title' , 'global' );
            $this->css .= ut_create_global_headline_font_style('#primary .section-title' , 'global' );
            
            /* pt style 1 */
            $this->css.= $this->headline_style( '#primary .pt-style-1 .parallax-title', 'pt-style-1', ( !empty( $ut_page_background_color ) ? $ut_page_background_color : '#FFF' ) );
            $this->css.= $this->headline_style( '#primary .pt-style-1 .section-title' , 'pt-style-1', ( !empty( $ut_page_background_color ) ? $ut_page_background_color : '#FFF' ) );
             
            /* pt style 2 */
            $this->css .= $this->headline_style( '#primary .pt-style-2 .parallax-title', 'pt-style-2' , ot_get_option('ut_global_headline_style_2_color', '#222'), ot_get_option('ut_global_headline_style_2_height', '1px'), ot_get_option('ut_global_headline_style_2_width', '30px') );
            $this->css .= $this->headline_style( '#primary .pt-style-2 .section-title' , 'pt-style-2' , ot_get_option('ut_global_headline_style_2_color', '#222'), ot_get_option('ut_global_headline_style_2_height', '1px'), ot_get_option('ut_global_headline_style_2_width', '30px') );           
                       
            /**
             * Page Spacing
             */             
            
            if( get_post_meta( $post->ID , 'ut_page_padding_top' , true ) ) {
                $this->css .= '#primary { padding-top:' . get_post_meta( $post->ID , 'ut_page_padding_top' , true ) . ' !important; }';
            }
            
            if( get_post_meta( $post->ID , 'ut_page_padding_bottom' , true ) ) {
                $this->css .= '#primary { padding-bottom:' . get_post_meta( $post->ID , 'ut_page_padding_bottom' , true ) . ' !important; }';
            }
                       
           
            /**
             * Content Headlines
             */
            $ut_page_heading_color = get_post_meta( $post->ID , 'ut_section_heading_color' , true);
                
            /* add to CSS */
            if( !empty( $ut_page_heading_color ) ) {
                
                $this->css .= '#primary .entry-content h1 { color: ' . $ut_page_heading_color . ' !important; }'. "\n";
                $this->css .= '#primary .entry-content h2 { color: ' . $ut_page_heading_color . ' !important; }'. "\n"; 
                $this->css .= '#primary .entry-content h3 { color: ' . $ut_page_heading_color . ' !important; }'. "\n"; 
                $this->css .= '#primary .entry-content h4 { color: ' . $ut_page_heading_color . ' !important; }'. "\n"; 
                $this->css .= '#primary .entry-content h5 { color: ' . $ut_page_heading_color . ' !important; }'. "\n"; 
                $this->css .= '#primary .entry-content h6 { color: ' . $ut_page_heading_color . ' !important; }'. "\n";
                  
            }
            
            /**
             * Content Text Color
             */
            $ut_page_text_color = get_post_meta( $post->ID , 'ut_section_text_color' , true);
            
            /* add to CSS */
            if( !empty($ut_page_text_color) ) {
                $this->css.= '#primary .entry-content { color: ' . $ut_page_text_color . '; }'. "\n"; 
            }
            
            
            /**
             * Portfolio Navigation
             */
            if( is_singular('portfolio') ) {
            
                if( ot_get_option('ut_single_portfolio_navigation_background_color') ) {
                    
                   $this->css.= '#ut-portfolio-navigation-wrap { background: ' . ot_get_option('ut_single_portfolio_navigation_background_color') . ';}'; 
                    
                }
                
                if( ot_get_option('ut_single_portfolio_navigation_height') ) {
                    
                   $this->css.= '#ut-portfolio-navigation-wrap { height: ' . ot_get_option('ut_single_portfolio_navigation_height') . 'px;}';
                   $this->css.= '#ut-portfolio-navigation-wrap .fa { line-height: ' . ot_get_option('ut_single_portfolio_navigation_height') . 'px;}';  
                    
                }
                
                if( ot_get_option('ut_single_portfolio_navigation_arrow_color') ) {
                    
                   $this->css.= ' #ut-portfolio-navigation-wrap a { color: ' . ot_get_option('ut_single_portfolio_navigation_arrow_color') . ';}';
                   $this->css.= ' #ut-portfolio-navigation-wrap a:visited { color: ' . ot_get_option('ut_single_portfolio_navigation_arrow_color') . ';}';  
                    
                }
                
                if( ot_get_option('ut_single_portfolio_navigation_arrow_hover_color') ) {
                    
                   $this->css.= ' #ut-portfolio-navigation-wrap a:hover { color: ' . ot_get_option('ut_single_portfolio_navigation_arrow_hover_color') . ';}'; 
                   $this->css.= ' #ut-portfolio-navigation-wrap a:focus { color: ' . ot_get_option('ut_single_portfolio_navigation_arrow_hover_color') . ';}';
                   $this->css.= ' #ut-portfolio-navigation-wrap a:active { color: ' . ot_get_option('ut_single_portfolio_navigation_arrow_hover_color') . ';}';
                    
                }
                
                if( ot_get_option('ut_single_portfolio_back_to_main_color') ) {
                    
                   $this->css.= ' #ut-portfolio-navigation-wrap .ut-main-portfolio-link a { color: ' . ot_get_option('ut_single_portfolio_back_to_main_color') . ';}';
                   $this->css.= ' #ut-portfolio-navigation-wrap .ut-main-portfolio-link a:visited { color: ' . ot_get_option('ut_single_portfolio_back_to_main_color') . ';}';  
                    
                }
                
                if( ot_get_option('ut_single_portfolio_back_to_main_hover_color') ) {
                    
                   $this->css.= ' #ut-portfolio-navigation-wrap .ut-main-portfolio-link a:hover { color: ' . ot_get_option('ut_single_portfolio_back_to_main_hover_color') . ';}'; 
                   $this->css.= ' #ut-portfolio-navigation-wrap .ut-main-portfolio-link a:focus { color: ' . ot_get_option('ut_single_portfolio_back_to_main_hover_color') . ';}';
                   $this->css.= ' #ut-portfolio-navigation-wrap .ut-main-portfolio-link a:active { color: ' . ot_get_option('ut_single_portfolio_back_to_main_hover_color') . ';}';
                    
                }
            
            }
            
            /* output css */
            echo ut_minify_css( '<style type="text/css">' . $this->css . '</style>' );
        
        }  
            
    }

}

new UT_Page_CSS;