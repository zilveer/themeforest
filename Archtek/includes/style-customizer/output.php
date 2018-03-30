<?php

add_action('wp_head', 'uxbarn_ctmzr_css_output');
add_action('wp_head', 'uxbarn_ctmzr_custom_css_output');

if( ! function_exists('uxbarn_ctmzr_css_output')) {

    function uxbarn_ctmzr_css_output() {
        
        // For resetting to default (delete all customized options)
        $is_reset = get_option('uxbarn_sc_reset_to_default');
        if($is_reset && $is_reset == 'reset_styles') {
            
            delete_option('uxbarn_sc_global_color_scheme');
            delete_option('uxbarn_sc_global_styles');
            delete_option('uxbarn_sc_site_background_styles');
            delete_option('uxbarn_sc_header_styles');
            delete_option('uxbarn_sc_header_site_logo');
            delete_option('uxbarn_sc_header_styles_background_opacity');
            delete_option('uxbarn_sc_menu_styles');
            delete_option('uxbarn_sc_submenu_styles');
            delete_option('uxbarn_sc_home_slider_styles');
            delete_option('uxbarn_sc_page_intro_styles');
            delete_option('uxbarn_sc_content_body_styles');
            delete_option('uxbarn_sc_content_background_styles');
            delete_option('uxbarn_sc_footer_body_styles');
            delete_option('uxbarn_sc_footer_background_styles');
            delete_option('uxbarn_sc_footer_bar_body_styles');
            delete_option('uxbarn_sc_footer_bar_background_styles');
            delete_option('uxbarn_sc_other_styles');
            delete_option('uxbarn_sc_other_styles_custom_css');
            delete_option('uxbarn_sc_reset_to_default');
            
        }
        
    ?>
        <style type="text/css">
        <?php 
            
            // Global: Colors
            $option_set = get_option('uxbarn_sc_global_color_scheme');
            
            if($option_set) {
                
                if($option_set != 'custom') {
                    
                    // MOVED TO "functions.php"
                    //wp_enqueue_style('color-scheme', get_template_directory_uri() . '/css/colors/' . $option_set . '.css', array('uxbarn-theme'));
                    
                } else {
                    
                    $option_set = get_option('uxbarn_sc_global_styles');
                    
                    // Primary color
                    uxbarn_ctmzr_print_css('a, a:visited, #root-menu li ul li a:hover, #root-menu li ul li:hover > a, .top-bar-section a:hover, #portfolio-item-meta a, .member-name a:hover, .blog-item .blog-title a:hover, .sub-blog-item .sub-blog-title a:hover, .sticky-badge', 
                        'color', $option_set, 'primary_color');
                        // specifically for blog title link
                    uxbarn_ctmzr_print_css('.blog-item .blog-title a:hover, .sub-blog-item .sub-blog-title a:hover', 
                        'color', $option_set, 'primary_color', '', ' !important');
                        
                    uxbarn_ctmzr_print_css('#header-search-button, .style2 .testimonial-bullets a.selected, .tags a:hover, #scrollUp:hover, .button, .pagination li.current a, .pagination li.current a:hover, #blog-pagination .current', 
                        'background', $option_set, 'primary_color');
                        
                    uxbarn_ctmzr_print_css('.portfolio-item-hover', 
                        'background', $option_set, 'primary_color', '', '', true, 0.8);
                        
                    uxbarn_ctmzr_print_css('.bottom-line, .has-line, .blog-item, .uxb_blog_posts .blog-item, .uxb_blog_posts .sub-blog-item, #root-container .vc_tta-style-theme-default.vc_tta-tabs-position-bottom .vc_tta-tabs-list .vc_tta-tab.vc_active a',
                        'border-bottom-color', $option_set, 'primary_color');
                        
                    uxbarn_ctmzr_print_css('#content-container blockquote, .ui-accordion-header.ui-state-active, .section-container.vertical-tabs > section.active > .title, .section-container.vertical-tabs > .section.active > .title, #root-container .vc_tta-accordion.vc_tta-style-theme-default .vc_tta-panels-container .vc_active .vc_tta-panel-heading a, #root-container .vc_tta-accordion.vc_tta-style-theme-default .vc_tta-panels-container .vc_active .vc_tta-panel-heading .vc_tta-title-text, #root-container .uxb-tabs.vertical-tabs .tab-items li.ui-state-active a, #root-container .vc_tta-style-theme-default.vc_tta-tabs-position-left .vc_tta-tabs-list .vc_tta-tab.vc_active a, #root-container .wpb_content_element.wpb_tour .wpb_tabs_nav li.ui-tabs-active a', 
                        'border-left-color', $option_set, 'primary_color');
                    
                    uxbarn_ctmzr_print_css('#root-container .vc_tta-style-theme-default.vc_tta-tabs-position-right .vc_tta-tabs-list .vc_tta-tab.vc_active a', 
                        'border-right-color', $option_set, 'primary_color');
                        
                    uxbarn_ctmzr_print_css('#intro-line hr.stick, .blog-item.single, .section-container.tabs > section.active > .title, .section-container.tabs > .section.active > .title, .section-container.auto > section.active > .title, .section-container.auto > .section.active > .title, .section-container.vertical-tabs > section.active > .title, .section-container.vertical-tabs > .section.active > .title, #root-container .wpb_content_element.wpb_tabs .wpb_tabs_nav li.ui-tabs-active a, #root-container .vc_tta-style-theme-default .vc_tta-tabs-list .vc_tta-tab.vc_active a', 
                        'border-top-color', $option_set, 'primary_color');
                    
                    uxbarn_ctmzr_print_css('@media only screen and (max-width: 767px) { .section-container.vertical-tabs > section.active > .title, .section-container.vertical-tabs > .section.active > .title, #root-container .wpb_content_element.wpb_tour .wpb_tabs_nav li.ui-tabs-active a, #root-container .vc_tta-tabs.vc_tta-style-theme-default .vc_tta-panels-container .vc_active .vc_tta-panel-heading a', 
                        'border-top-color', $option_set, 'primary_color', '', '', false, 1, true);
                    
                    uxbarn_ctmzr_print_css('.gallery-item:hover', 
                        'border-color', $option_set, 'primary_color');
                    
                    // Secondary color
                    uxbarn_ctmzr_print_css('.button:hover, #header-search-button:hover', 
                        'background', $option_set, 'secondary_color');
                    uxbarn_ctmzr_print_css('.blog-item .blog-title a:hover, .sub-blog-item .sub-blog-title a:hover', 
                        'color', $option_set, 'secondary_color');
                }
                
            } else {
                // MOVED TO "functions.php"
                // default blue color
                //wp_enqueue_style('color-scheme', get_template_directory_uri() . '/css/colors/blue.css', array('uxbarn-theme'));
            }

            // Global: Fonts
            $option_set = get_option('uxbarn_sc_global_styles');
            uxbarn_ctmzr_print_css('#logo h1, #header-search-input, .slider-caption .caption-title, #content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5, .testimonial-inner, #footer-content h5', 
                'font-family', $option_set, 'primary_font'); 
            uxbarn_ctmzr_print_css('#logo p, #root-menu, .slider-caption .caption-body, #content-container, #content-container .columns, #intro p, #footer-content-container, #footer-bar-container', 
                'font-family', $option_set, 'secondary_font');
        
            // Site Background
            $option_set = get_option('uxbarn_sc_site_background_styles');
            uxbarn_ctmzr_print_css('body', 'background-color', $option_set, 'background_color'); 
            uxbarn_ctmzr_print_css('body', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('body', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('body', 'background-position', $option_set, 'background_position');
            
            // Header
            $option_set = get_option('uxbarn_sc_header_styles');
            $header_color_opacity = get_option('uxbarn_sc_header_styles_background_opacity');
            uxbarn_ctmzr_print_css('#header-container', 
                        'background-color', $option_set, 'background_color', '', '', true, 
                        $header_color_opacity != false ? $header_color_opacity : 1);
            uxbarn_ctmzr_print_css('#header-container', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('#header-container', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('#header-container', 'background-position', $option_set, 'background_position');
            uxbarn_ctmzr_print_css('#logo, #logo h1', 'color', $option_set, 'text_color');
			
			// Mobile menu background
			//uxbarn_ctmzr_print_css('#mobile-menu', 'background', $option_set, 'background_color', '', '', true, 1);
            
            // Menu: Menu options
            $option_set = get_option('uxbarn_sc_menu_styles');
                // menu color
            uxbarn_ctmzr_print_css('#root-menu a', 'color', $option_set, 'color');
                // hovered menu color
            uxbarn_ctmzr_print_css('#root-menu > li > a:hover, #root-menu li:hover > a', 'color', $option_set, 'hover_color');
                // active menu color
            uxbarn_ctmzr_print_css('#root-menu > li > a.active, #root-menu > li.current-menu-item > a, #root-menu > li.current-menu-ancestor > a', 
                'color', $option_set, 'active_color');
                // hovered active menu color
            uxbarn_ctmzr_print_css('#root-menu li:hover > a.active, #root-menu > li > a.active:hover, #root-menu > li.current-menu-item:hover > a, #root-menu > li.current-menu-ancestor:hover > a', 
                'color', $option_set, 'hover_active_color');
			
			// Mobile menu text color
			//uxbarn_ctmzr_print_css('#mobile-menu .top-bar .toggle-topbar.menu-icon a', 'color', $option_set, 'active_color');
            
            
            // Menu: Submenu options
            $option_set = get_option('uxbarn_sc_submenu_styles');
                // submenu bg color
            uxbarn_ctmzr_print_css('#root-menu > li > a:hover, #root-menu li:hover > a, #root-menu li ul', 'background', $option_set, 'background_color');
                // submenu color
            uxbarn_ctmzr_print_css('#root-menu li ul li a', 'color', $option_set, 'color');
                // hovered submenu color
            uxbarn_ctmzr_print_css('#root-menu li ul li a:hover, #root-menu li ul li:hover > a', 'color', $option_set, 'hover_color', '', ' !important');
            
            
            // Home Slider: Caption colors
            $option_set = get_option('uxbarn_sc_home_slider_styles');
            uxbarn_ctmzr_print_css('.slider-caption .caption-title', 'color', $option_set, 'title_color');
            uxbarn_ctmzr_print_css('.slider-caption .caption-body', 'color', $option_set, 'body_color');
            // Home Slider: Controller 
            uxbarn_ctmzr_print_css('#slider-prev, #slider-next', 'background', $option_set, 'controller_color');
            
            // Page Intro: Colors
            $option_set = get_option('uxbarn_sc_page_intro_styles'); 
            uxbarn_ctmzr_print_css('#content-container #intro h1, #content-container #intro h2', 'color', $option_set, 'title_color');
            uxbarn_ctmzr_print_css('#content-container #intro p', 'color', $option_set, 'body_color');
            
            // Content: Body colors
            $option_set = get_option('uxbarn_sc_content_body_styles'); 
            uxbarn_ctmzr_print_css('#content-container h1, #content-container h2, #content-container h3, #content-container h4, #content-container h5', 'color', $option_set, 'heading_color');
            uxbarn_ctmzr_print_css('#inner-content-container', 'color', $option_set, 'text_color');
            
            if($option_set) {
                $use_link_color = false;
                $use_link_color = isset($option_set['use_link_color']) ? $option_set['use_link_color'] : $use_link_color;;
                
                if($use_link_color) { // if user wants to use custom link colors
                    uxbarn_ctmzr_print_css('#content-container a, #content-container a:visited', 'color', $option_set, 'link_color');
                    uxbarn_ctmzr_print_css('#content-container a:hover', 'color', $option_set, 'link_hover_color');
                } else { // else, use color from global color scheme
                    $option_set = get_option('uxbarn_sc_global_styles');
                    uxbarn_ctmzr_print_css('#content-container a, #content-container a:visited', 'color', $option_set, 'primary_color');
                    uxbarn_ctmzr_print_css('#content-container a:hover', 'color', $option_set, 'primary_color');
                }
            }
            
            
            // Content: Bg
            $option_set = get_option('uxbarn_sc_content_background_styles');
            uxbarn_ctmzr_print_css('#inner-content-container .row, .columns.with-sidebar, #content-container .fixed-box', 'background-color', $option_set, 'background_color');
            uxbarn_ctmzr_print_css('.columns.with-sidebar', 'background-color', $option_set, 'background_color', '', ' !important'); 
            uxbarn_ctmzr_print_css('#inner-content-container .row, .columns.with-sidebar, #content-container .fixed-box', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('#inner-content-container .row, .columns.with-sidebar, #content-container .fixed-box', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('#inner-content-container .row, .columns.with-sidebar, #content-container .fixed-box', 'background-position', $option_set, 'background_position');
            
            // Footer: Body colors
            $option_set = get_option('uxbarn_sc_footer_body_styles'); 
            uxbarn_ctmzr_print_css('#footer-content h5', 'color', $option_set, 'heading_color');
            uxbarn_ctmzr_print_css('#footer-content-container', 'color', $option_set, 'text_color');
            uxbarn_ctmzr_print_css('#footer-content a', 'color', $option_set, 'link_color');
            uxbarn_ctmzr_print_css('#footer-content a:hover', 'color', $option_set, 'link_hover_color');
            
            // Footer: Bg
            $option_set = get_option('uxbarn_sc_footer_background_styles');
            uxbarn_ctmzr_print_css('#footer-content-container', 'background-color', $option_set, 'background_color'); 
            uxbarn_ctmzr_print_css('#footer-content-container', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('#footer-content-container', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('#footer-content-container', 'background-position', $option_set, 'background_position');
            
            // Footer Bar: Body colors
            $option_set = get_option('uxbarn_sc_footer_bar_body_styles');
            uxbarn_ctmzr_print_css('#footer-bar-container', 'color', $option_set, 'text_color');
            uxbarn_ctmzr_print_css('#footer-bar-container a', 'color', $option_set, 'link_color');
            uxbarn_ctmzr_print_css('#footer-bar-container a:hover', 'color', $option_set, 'link_hover_color');
            
            // Footer Bar: Bg
            $option_set = get_option('uxbarn_sc_footer_bar_background_styles');
            uxbarn_ctmzr_print_css('#footer-bar-container', 'background-color', $option_set, 'background_color'); 
            uxbarn_ctmzr_print_css('#footer-bar-container', 'background-image', $option_set, 'background_image', 'url("', '")');
            uxbarn_ctmzr_print_css('#footer-bar-container', 'background-repeat', $option_set, 'background_repeat');
            uxbarn_ctmzr_print_css('#footer-bar-container', 'background-position', $option_set, 'background_position');
            
            // Other Styles
            $option_set = get_option('uxbarn_sc_other_styles');
            uxbarn_ctmzr_print_css('::-moz-selection', 'background', $option_set, 'text_selection_color');
            uxbarn_ctmzr_print_css('::selection', 'background', $option_set, 'text_selection_color');
            
        ?>
        </style> 
    <?php
        
    }

}


if( ! function_exists('uxbarn_ctmzr_custom_css_output')) {
    
    function uxbarn_ctmzr_custom_css_output() {
        
        $option_set = get_option('uxbarn_sc_other_styles_custom_css');
        if($option_set) {
            echo '<style type="text/css">' . wp_strip_all_tags( $option_set, true ) . '</style>';
        }
        
    }
	
}


if( ! function_exists('uxbarn_ctmzr_print_css')) {
	
    function uxbarn_ctmzr_print_css($selector, $property, $option_set, $option_name, $prefix='', $postfix='', $rgb=false, $opacity=1, $media_query=false, $echo=true) {
        
        $return = '';
        
        if($option_set) {
            
            if ( isset( $option_set[$option_name] ) ) {
            
                $value = $option_set[$option_name];
                
                if(!empty($value)) {
                    
                    // Check whether there is Google Fonts code contained. If so, wrap the font with double quotes and fallback font.
                    if(strpos($value,'[#GF#]') !== false) {
                        $value = str_replace('[#GF#]', '', $value);
    					$value_temp = explode(':', $value); // split and remove any weights out
    					$value = $value_temp[0];
                        $prefix = '"';
                        $postfix = '", sans-serif';
                    }
                    
                    // For background-image; when there is no image assigned, just don't print it out
                    if($property == 'background-image') {
                        if(empty($value)) {
                            $echo = false;
                        }
                    }
                    
                    // For typography and background set; when the user haven't selected any item (-1), 
                    // just don't print it out (use default style)
                    if($property == 'font-family' ||
                        $property == 'font-size' ||
                        $property == 'font-style' ||
                        $property == 'font-weight' ||
                        $property == 'line-height' ||
                        $property == 'background-position' ||
                        $property == 'background-repeat') {
                            
                        // "-1" means no selection so there is no custom css printed    
                        if($value == '-1' || empty($value)) {
                            $echo = false;
                        }
                    }
                        
                    
                    $return = sprintf('%s { %s: %s; }',
                                $selector, $property, $prefix.$value.$postfix
                            );
                            
                    if($media_query) {
                        $return = sprintf('%s { %s: %s; } }',
                                $selector, $property, $prefix.$value.$postfix
                            );
                            
                    }
                    
                    if($rgb) {
                        $rgb_value = uxbarn_hex2rgb($value);
                        
                        $value1 = 'rgb(' . $rgb_value[0] . ',' . $rgb_value[1] . ',' . $rgb_value[2] . ')';
                        $value2 = 'rgba(' . $rgb_value[0] . ',' . $rgb_value[1] . ',' . $rgb_value[2] . ',' . $opacity . ')';
                        
                        $return = sprintf('%s { %s: %s; %s: %s; }',
                                $selector, $property, $value1, $property, $value2
                            );
                    }
                    
                    if($echo) {
                        echo wp_strip_all_tags( $return );
                    }
                
                }
                
            }
            
        }
    }

}
    