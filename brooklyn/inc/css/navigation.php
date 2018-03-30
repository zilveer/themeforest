<?php

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'UT_Navigation_CSS' ) ) {	
    
    class UT_Navigation_CSS {
        
        private $css;
        
        function __construct() {
             
            add_action('wp_head' , array( $this, 'custom_css' ) ); 
            
        }        
        
        public function custom_css() {
            
            $accentcolor = get_option('ut_accentcolor' , '#F1C40F');
            
            /* available google fonts */
            $google_fonts = ut_recognized_google_fonts();
            
            /* default font styles */
            $recognized_font_styles = ut_recognized_font_styles();
            
            /* font setting string */
            $font = '';
            
            /* font weight fallback */
            $font_fallback = ut_return_header_config( 'ut_navigation_font_weight', 'normal' ) == 'bold' ? 'semibold' : 'regular';
                      
            /* Main Navigation */
            if( ot_get_option('ut_global_navigation_font_type' , 'ut-font') == 'ut-google' ) {
             
                    $ut_global_navigation_google_font_style = ot_get_option('ut_global_navigation_google_font_style');                
                
                    if( !empty( $google_fonts[ $ut_global_navigation_google_font_style['font-id']]['family'] ) ) {
                    
                        $font .= '#ut-sitebody #ut-mobile-menu a, #ut-sitebody #navigation ul li a {';
                            
                            $font .= 'font-family:"'.$google_fonts[$ut_global_navigation_google_font_style['font-id']]['family'].'", "Helvetica Neue", Helvetica, Arial, sans-serif;';                    
                            
                            if( !empty( $ut_global_navigation_google_font_style['font-weight']) ) {
                                $font .= ' font-weight: ' .  $ut_global_navigation_google_font_style['font-weight'] . ';';    
                            }
                            
                            if( !empty( $ut_global_navigation_google_font_style['font-size']) ) {
                                $font .= ' font-size: ' .  $ut_global_navigation_google_font_style['font-size'] . ';';    
                            }
                            
                            if( !empty( $ut_global_navigation_google_font_style['font-style']) && isset($font_styles[ $ut_global_navigation_google_font_style['font-style']]) ) {
                                $font .= ' font-style: ' . $font_styles[ $ut_global_navigation_google_font_style['font-style']] . ';';    
                            }
                            
                            if( !empty( $ut_global_navigation_google_font_style['line-height']) ) {
                                $font .= ' line-height: ' .  $ut_global_navigation_google_font_style['line-height'] . ';';    
                            }
                            
                            if( !empty( $ut_global_navigation_google_font_style['text-transform']) ) {
                                $font .= ' text-transform: ' .  $ut_global_navigation_google_font_style['text-transform'] . ';';    
                            }
                            
                        $font .= '}';
                    
                    } else {
                    
                        /* fallback if user has not chosen a google font yet */
                        $font_style = ot_get_option( 'ut_global_navigation_font_style', $font_fallback );
                        
                        if( isset($recognized_font_styles[$font_style]) ) {
                            
                            $font .= '#ut-sitebody #ut-mobile-menu a, #ut-sitebody #navigation ul li a { font-family: ' . $recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";
                            
                        }
                        
                    }
            
            } elseif( ot_get_option('ut_global_navigation_font_type' , 'ut-font') == 'ut-websafe' ) {
                
                $font .= ut_create_typography_css('#ut-sitebody #ut-mobile-menu a, #ut-sitebody #navigation ul li a', ot_get_option('ut_global_navigation_websafe_font_style') );    
                
            } else {
                
                $font_style = ot_get_option( 'ut_global_navigation_font_style' , $font_fallback );
                
                if( isset( $recognized_font_styles[$font_style] ) ) {
                    
                    $font .= '#ut-sitebody #ut-mobile-menu a, #ut-sitebody #navigation ul li a { font-family: ' . $recognized_font_styles[$font_style] . ', "Helvetica Neue", Helvetica, Arial, sans-serif;}'. "\n";
                    
                }                
                
            }
            
            /* Submenu */
            $font .= ut_create_typography_css('#ut-sitebody #navigation ul.sub-menu li > a', ot_get_option('ut_global_navigation_submenu_font_style') );
            
            
            /* Mobile */
            $font .= ut_create_typography_css('#ut-sitebody #ut-mobile-menu a', ot_get_option('ut_global_mobile_navigation_font_style') );
            
            ob_start();
            
            ?>
            
            <style type="text/css">
            
            <?php echo $font; ?>
            
            /* Text Logo
            ================================================== */
            
            <?php if( ot_get_option( 'ut_global_header_text_logo_websafe_font_style' ) ) : ?>
            
                <?php echo ut_create_typography_css( '#ut-sitebody h1.logo a', ot_get_option('ut_global_header_text_logo_websafe_font_style') ); ?>
            
            <?php endif; ?>
            
            
            /* Light Skin Navigation Settings
            ================================================== */
            
            <?php if( ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' ) == 'ut-header-light' ) : ?>
            
                #ut-sitebody #navigation li a:hover { color: <?php echo $accentcolor; ?>; }
                
                /* main navigation parents and ancestor */
                #ut-sitebody #navigation .selected,
                #ut-sitebody #navigation ul li.current_page_parent a.active,
                #ut-sitebody #navigation ul li.current-menu-ancestor a.active { color: <?php echo $accentcolor; ?>; }
                             
                #ut-sitebody #navigation ul li a:hover, 
                #ut-sitebody #navigation ul.sub-menu li a:hover { color: <?php echo $accentcolor; ?>; }     
                
                /* main navigation current page */
                #ut-sitebody #navigation ul.sub-menu li > a { color: #999999; }';
                #ut-sitebody #navigation ul li.current-menu-item:not(.current_page_parent) a,
                #ut-sitebody #navigation ul li.current_page_item:not(.current_page_parent) a { color: <?php echo $accentcolor; ?>; }';
                #ut-sitebody #navigation ul li.current-menu-item:not(.current_page_parent) .sub-menu li a { color: #999999; }';
                
                <?php if( ut_return_header_config( 'ut_navigation_level_one_color' ) )  { ?>
                    
                    #ut-sitebody #navigation ul li a { color: <?php echo ut_return_header_config( 'ut_navigation_level_one_color' ); ?>; }    
                
                <?php } ?>
                
                 <?php if( ut_return_header_config('ut_navigation_level_one_icon_color') ) { ?>
                    
                    #ut-sitebody #navigation ul li a:after { color: <?php echo ut_return_header_config('ut_navigation_level_one_icon_color'); ?>; }
                
                <?php } ?>
                
                
            <?php endif; ?>
            
            
            /* Dark Skin Navigation Settings
            ================================================== */
            
            <?php if( ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' ) == 'ut-header-dark' ) : ?>
            
                #ut-sitebody .ut-header-dark #navigation li a:hover { color:<?php echo $accentcolor; ?>; }'. "\n";
                
                /* main navigation parents and ancestor */
                #ut-sitebody .ut-header-dark #navigation .selected, 
                #ut-sitebody .ut-header-dark #navigation ul li.current_page_parent a.active,
                #ut-sitebody .ut-header-dark #navigation ul li.current-menu-ancestor a.active { color: <?php echo $accentcolor; ?>; }
                             
                #ut-sitebody .ut-header-dark #navigation ul li a:hover, 
                #ut-sitebody .ut-header-dark #navigation ul.sub-menu li a:hover { color: <?php echo $accentcolor; ?>; }     
                
                /* main navigation current page */
                #ut-sitebody .ut-header-dark #navigation ul.sub-menu li > a { color: #999999; }
                #ut-sitebody .ut-header-dark #navigation ul li.current-menu-item:not(.current_page_parent) a,
                #ut-sitebody .ut-header-dark #navigation ul li.current_page_item:not(.current_page_parent) a { color: <?php echo $accentcolor; ?>; }
                #ut-sitebody .ut-header-dark #navigation ul li.current-menu-item:not(.current_page_parent) .sub-menu li a { color: #999999; }
                
                <?php if( ut_return_header_config( 'ut_navigation_level_one_color' ) )  { ?>
                    
                    #ut-sitebody .ut-header-dark #navigation ul li a { color: <?php echo ut_return_header_config( 'ut_navigation_level_one_color' ); ?>; }    
                
                <?php } ?>
                
                <?php if( ut_return_header_config('ut_navigation_level_one_icon_color') ) { ?>
                    
                    #ut-sitebody .ut-header-dark #navigation ul li a:after { color: <?php echo ut_return_header_config('ut_navigation_level_one_icon_color'); ?>; }
                
                <?php } ?>
                
            <?php endif; ?>
            
            
            /* Custom Skin Navigation Settings
            ================================================== */
            
            <?php if( ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' ) == 'ut-header-custom' ) : ?>            
                
                
                /* Primary Skin Settings
                ================================================== */       
                <?php if( ot_get_option( 'ut_header_ps_text_logo_color' ) ) : ?>
                        
                    .ut-primary-custom-skin h1.logo a {
                        color:<?php echo ot_get_option( 'ut_header_ps_text_logo_color' ); ?>;   
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ps_text_logo_color_hover' ) ) : ?>
                
                    .ut-primary-custom-skin h1.logo a:hover,
                    .ut-primary-custom-skin h1.logo a:focus,
                    .ut-primary-custom-skin h1.logo a:active {
                        color:<?php echo ot_get_option( 'ut_header_ps_text_logo_color_hover' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ps_background_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin {
                        background:transparent !important;
                        background:<?php echo ot_get_option( 'ut_header_ps_background_color' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ps_shadow_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin.ha-header {
                       -webkit-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ps_shadow_color' ); ?>;
                          -moz-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ps_shadow_color' ); ?>;
                               box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ps_shadow_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ps_border_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin.ha-header {
                       border-bottom:1px solid <?php echo ut_return_header_config( 'ut_header_ps_border_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_navigation_ps_hover_state', 'off' ) == 'on' && ot_get_option( 'ut_header_ps_border_color_hover' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin:hover {
                       border-bottom:1px solid <?php echo ut_return_header_config( 'ut_header_ps_border_color_hover' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_navigation_ps_hover_state', 'off' ) == 'on' && ot_get_option( 'ut_header_ps_background_color_hover' ) ) : ?>
                    
                     #ut-sitebody #header-section.ut-primary-custom-skin:hover {
                        background:<?php echo ot_get_option( 'ut_header_ps_background_color_hover' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_navigation_ps_hover_state', 'off' ) == 'on' && ot_get_option( 'ut_header_ps_shadow_color_hover' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin.ha-header:hover {
                       -webkit-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ps_shadow_color_hover' ); ?>;
                          -moz-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ps_shadow_color_hover' ); ?>;
                               box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ps_shadow_color_hover' ); ?>;
                    }
                
                <?php endif; ?>
                                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_fl_color' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation ul li a {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_fl_color' ); ?>;   
                    }    
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_fl_color_hover' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation ul li a:hover,
                    #ut-sitebody .ut-primary-custom-skin #navigation ul li a:focus,
                    #ut-sitebody .ut-primary-custom-skin #navigation ul li a:active {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_fl_color_hover' ); ?> !important;   
                    }    
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_fl_dot_color' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation ul li a::after {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_fl_dot_color' ); ?> !important;   
                    }    
                
                <?php endif; ?>
                                
                
                <?php if( ot_get_option( 'ut_navigation_ps_hover_state', 'off' ) == 'on' && ut_return_header_config( 'ut_navigation_ps_hover_fl_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin.ha-header:hover #navigation ul li a {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_hover_fl_color' ); ?>;   
                    }    
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_navigation_ps_hover_state', 'off' ) == 'on' && ut_return_header_config( 'ut_navigation_ps_hover_fl_dot_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-primary-custom-skin:hover #navigation ul li a::after {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_hover_fl_dot_color' ); ?> !important;   
                    }    
                
                <?php endif; ?>
                                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_fl_active_color' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation .current_page_item > a, 
                    #ut-sitebody .ut-primary-custom-skin #navigation .current-menu-item > a,
                    #ut-sitebody .ut-primary-custom-skin #navigation .current_page_ancestor > a, 
                    #ut-sitebody .ut-primary-custom-skin #navigation .current-menu-ancestor > a,
                    #ut-sitebody .ut-primary-custom-skin #navigation ul li a.selected {
                         color:<?php echo ut_return_header_config( 'ut_navigation_ps_fl_active_color' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_sl_color' ) ) : ?>
            
                    #ut-sitebody .ut-primary-custom-skin #navigation ul.sub-menu li > a {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_sl_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_sl_color_hover' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation ul.sub-menu li > a:hover,
                    #ut-sitebody .ut-primary-custom-skin #navigation ul.sub-menu li > a:focus,
                    #ut-sitebody .ut-primary-custom-skin #navigation ul.sub-menu li > a:active  {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ps_sl_color_hover' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_sl_background_color' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation .sub-menu {
                        background:<?php echo ut_return_header_config( 'ut_navigation_ps_sl_background_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_sl_shadow_color' ) ) : ?>
                
                    #ut-sitebody .ut-primary-custom-skin #navigation ul.sub-menu {
                       -webkit-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_navigation_ps_sl_shadow_color' ); ?>;
                          -moz-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_navigation_ps_sl_shadow_color' ); ?>;
                               box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_navigation_ps_sl_shadow_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ps_sl_border_color' ) ) : ?>
                    
                    #ut-sitebody .ut-primary-custom-skin #navigation ul.sub-menu {
                        border-color:<?php echo ut_return_header_config( 'ut_navigation_ps_sl_border_color' ); ?> !important;
                    }
                
                <?php endif; ?>
                                
                
                /* Secondary Skin Settings
                ================================================== */
                <?php if( ot_get_option( 'ut_header_ss_text_logo_color' ) ) : ?>
                        
                    .ut-secondary-custom-skin h1.logo a {
                        color:<?php echo ot_get_option( 'ut_header_ss_text_logo_color' ); ?>;   
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ss_text_logo_color_hover' ) ) : ?>
                
                    .ut-secondary-custom-skin h1.logo a:hover,
                    .ut-secondary-custom-skin h1.logo a:focus,
                    .ut-secondary-custom-skin h1.logo a:active {
                        color:<?php echo ot_get_option( 'ut_header_ss_text_logo_color_hover' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ss_background_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-secondary-custom-skin {
                        background:transparent !important;
                        background:<?php echo ot_get_option( 'ut_header_ss_background_color' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ss_shadow_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-secondary-custom-skin.ha-header {
                       -webkit-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ss_shadow_color' ); ?>;
                          -moz-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ss_shadow_color' ); ?>;
                               box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_header_ss_shadow_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ot_get_option( 'ut_header_ss_border_color' ) ) : ?>
                
                    #ut-sitebody #header-section.ut-secondary-custom-skin.ha-header {
                       border-bottom:1px solid <?php echo ut_return_header_config( 'ut_header_ss_border_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_fl_color' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul li a {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ss_fl_color' ); ?>;   
                    }    
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_fl_color_hover' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul li a:hover,
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul li a:focus,
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul li a:active {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ss_fl_color_hover' ); ?> !important;   
                    }    
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_fl_dot_color' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul li a::after {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ss_fl_dot_color' ); ?> !important;   
                    }    
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_fl_active_color' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation .current_page_item > a, 
                    #ut-sitebody .ut-secondary-custom-skin #navigation .current-menu-item > a,
                    #ut-sitebody .ut-secondary-custom-skin #navigation .current_page_ancestor > a, 
                    #ut-sitebody .ut-secondary-custom-skin #navigation .current-menu-ancestor > a,
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul li a.selected {
                         color:<?php echo ut_return_header_config( 'ut_navigation_ss_fl_active_color' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_sl_color' ) ) : ?>
            
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul.sub-menu li > a {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ss_sl_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_sl_color_hover' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul.sub-menu li > a:hover,
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul.sub-menu li > a:focus,
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul.sub-menu li > a:active  {
                        color:<?php echo ut_return_header_config( 'ut_navigation_ss_sl_color_hover' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_sl_background_color' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation .sub-menu {
                        background:<?php echo ut_return_header_config( 'ut_navigation_ss_sl_background_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_sl_shadow_color' ) ) : ?>
                
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul.sub-menu {
                       -webkit-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_navigation_ss_sl_shadow_color' ); ?>;
                          -moz-box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_navigation_ss_sl_shadow_color' ); ?>;
                               box-shadow:0 1px 5px <?php echo ut_return_header_config( 'ut_navigation_ss_sl_shadow_color' ); ?>;
                    }
                
                <?php endif; ?>
                
                
                <?php if( ut_return_header_config( 'ut_navigation_ss_sl_border_color' ) ) : ?>
                    
                    #ut-sitebody .ut-secondary-custom-skin #navigation ul.sub-menu {
                        border-color:<?php echo ut_return_header_config( 'ut_navigation_ss_sl_border_color' ); ?> !important;
                    }
                
                <?php endif; ?>
                
                
                /* Mobile Navigation Settings
                ================================================== */
                @media (max-width: 1024px) {
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_trigger_icon' ) ) : ?>
                        
                        <?php $unicode = ut_get_fontawesome_unicode( ut_return_header_config( 'ut_mobile_navigation_trigger_icon' ) ); ?>
                        
                        <?php if( $unicode ) { ?>
                        
                            #ut-sitebody .ut-mm-trigger .ut-mm-button::before{ content: "\<?php echo $unicode; ?>";}
                        
                        <?php } ?>    
                        
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_background_color' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #header-section.ha-header {
                            background: <?php echo ut_return_header_config( 'ut_mobile_navigation_background_color' ); ?> !important; 
                        }
    
                    <?php endif; ?>
    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_link_color' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a {
                            color: <?php echo ut_return_header_config( 'ut_mobile_navigation_link_color' ); ?> !important; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_link_color_hover' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:hover,
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:focus,
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:active {
                            color: <?php echo ut_return_header_config( 'ut_mobile_navigation_link_color_hover' ); ?> !important; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_link_background_color' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a {
                            background: <?php echo ut_return_header_config( 'ut_mobile_navigation_link_background_color' ); ?> !important; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_link_background_color_hover' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:hover,
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:focus,
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:active {
                            background: <?php echo ut_return_header_config( 'ut_mobile_navigation_link_background_color_hover' ); ?> !important; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_dot_color' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a::after {
                            color: <?php echo ut_return_header_config( 'ut_mobile_navigation_dot_color' ); ?>; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_dot_color_hover' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a:hover::after {
                            color: <?php echo ut_return_header_config( 'ut_mobile_navigation_dot_color_hover' ); ?>; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_border_color' ) ) : ?>
                        
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu,
                        #ut-sitebody.ut-mobile-menu-open #ut-mobile-menu a {
                            border-color:<?php echo ut_return_header_config( 'ut_mobile_navigation_border_color' ); ?>;
                        }
                        
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_trigger_color' ) ) : ?>
                        
                        #ut-sitebody .ut-mm-trigger .ut-mm-button::before {
                            color: <?php echo ut_return_header_config( 'ut_mobile_navigation_trigger_color' ); ?>; 
                        }
    
                    <?php endif; ?>
                    
                    
                    <?php if( ut_return_header_config( 'ut_mobile_navigation_trigger_color_hover' ) ) : ?>
                        
                        #ut-sitebody .ut-mm-trigger .ut-mm-button:hover::before,
                        #ut-sitebody.ut-mobile-menu-open .ut-mm-trigger.active .ut-mm-button::before {
                            color: <?php echo ut_return_header_config( 'ut_mobile_navigation_trigger_color_hover' ); ?>; 
                        }
    
                    <?php endif; ?>

                }
            
            <?php endif; ?>
            
            </style>            
            
            <?php
            
            $this->css .= ob_get_clean();
            
            /* output css */
            echo ut_minify_css( $this->css );
        
        }  
            
    }

}

new UT_Navigation_CSS;