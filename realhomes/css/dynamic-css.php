<?php
if( !function_exists( 'generate_dynamic_css' ) ){
    function generate_dynamic_css(){

        // Header
        $theme_header_bg_color = get_option('theme_header_bg_color');
        $theme_header_text_color = get_option('theme_header_text_color');
        $theme_header_link_hover_color = get_option('theme_header_link_hover_color');
        $theme_header_border_color = get_option('theme_header_border_color');

        // Drop Down Menu
        $theme_main_menu_text_color = get_option('theme_main_menu_text_color');
        $theme_menu_bg_color = get_option('theme_menu_bg_color');
        $theme_menu_text_color = get_option('theme_menu_text_color');
        $theme_menu_hover_bg_color = get_option('theme_menu_hover_bg_color');

        // Phone Icon and Number
        $theme_phone_bg_color = get_option('theme_phone_bg_color');
        $theme_phone_text_color = get_option('theme_phone_text_color');
        $theme_phone_icon_bg_color = get_option('theme_phone_icon_bg_color');

        // Logo
        $theme_logo_text_color = get_option('theme_logo_text_color');
        $theme_logo_text_hover_color = get_option('theme_logo_text_hover_color');

        // Tagline
        $theme_tagline_text_color = get_option('theme_tagline_text_color');
        $theme_tagline_bg_color = get_option('theme_tagline_bg_color');

        // Banner title
        $theme_banner_text_color = get_option('theme_banner_text_color');
        $theme_banner_sub_text_color = get_option('theme_banner_sub_text_color');
        $theme_banner_title_bg_color = get_option('theme_banner_title_bg_color');
        $theme_banner_sub_title_bg_color = get_option('theme_banner_sub_title_bg_color');

        // Slide
        $theme_slide_title_color = get_option('theme_slide_title_color');
        $theme_slide_title_hover_color = get_option('theme_slide_title_hover_color');
        $theme_slide_desc_text_color = get_option('theme_slide_desc_text_color');
        $theme_slide_price_color = get_option('theme_slide_price_color');
        $theme_slide_know_more_text_color = get_option('theme_slide_know_more_text_color');
        $theme_slide_know_more_bg_color = get_option('theme_slide_know_more_bg_color');
        $theme_slide_know_more_hover_bg_color = get_option('theme_slide_know_more_hover_bg_color');

        // property item
        $theme_property_item_bg_color = get_option('theme_property_item_bg_color');
        $theme_property_item_border_color = get_option('theme_property_item_border_color');
        $theme_property_title_color = get_option('theme_property_title_color');
        $theme_property_title_hover_color = get_option('theme_property_title_hover_color');
        $theme_property_price_text_color = get_option('theme_property_price_text_color');
        $theme_property_price_bg_color = get_option('theme_property_price_bg_color');
        $theme_property_status_text_color = get_option('theme_property_status_text_color');
        $theme_property_status_bg_color = get_option('theme_property_status_bg_color');
        $theme_property_desc_text_color = get_option('theme_property_desc_text_color');
        $theme_more_details_text_color = get_option('theme_more_details_text_color');
        $theme_more_details_text_hover_color = get_option('theme_more_details_text_hover_color');
        $theme_property_meta_text_color = get_option('theme_property_meta_text_color');
        $theme_property_meta_bg_color = get_option('theme_property_meta_bg_color');

        // Footer
        $theme_disable_footer_bg = get_option('theme_disable_footer_bg');
        $theme_footer_bg_img = get_option('theme_footer_bg_img');
        $theme_footer_widget_title_color = get_option('theme_footer_widget_title_color');
        $theme_footer_widget_text_color = get_option('theme_footer_widget_text_color');
        $theme_footer_widget_link_color = get_option('theme_footer_widget_link_color');
        $theme_footer_widget_link_hover_color = get_option('theme_footer_widget_link_hover_color');
        $theme_footer_border_color = get_option('theme_footer_border_color');

        // Button
        $theme_button_text_color = get_option('theme_button_text_color');
        $theme_button_bg_color = get_option('theme_button_bg_color');
        $theme_button_hover_text_color = get_option('theme_button_hover_text_color');
        $theme_button_hover_bg_color = get_option('theme_button_hover_bg_color');

        $dynamic_css = array(

                            //Header background color
                            array(
                                'elements'	=>	'.header-wrapper, #currency-switcher #selected-currency, #currency-switcher-list li',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_header_bg_color
                            ),
                            //Logo
                            array(
                                'elements'	=>	'#logo h2 a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_logo_text_color
                            ),
                            array(
                                'elements'	=>	'#logo h2 a:hover, #logo h2 a:focus, #logo h2 a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_logo_text_hover_color
                            ),
                            //Tagline
                            array(
                                'elements'	=>	'.tag-line span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_tagline_text_color
                            ),
                            array(
                                'elements'	=>	'.tag-line span',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_tagline_bg_color
                            ),
                            //Banner title
                            array(
                                'elements'	=>	'.page-head h1.page-title span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_banner_text_color
                            ),
                            array(
                                'elements'	=>	'.page-head h1.page-title span',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_banner_title_bg_color
                            ),
                            array(
                                'elements'	=>	'.page-head p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_banner_sub_text_color
                            ),
                            array(
                                'elements'	=>	'.page-head p',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_banner_sub_title_bg_color
                            ),
                            //Header Text color
                            array(
                                'elements'	=>	'.header-wrapper, #contact-email, #contact-email a, .user-nav a, .social_networks li a, #currency-switcher #selected-currency, #currency-switcher-list li',
                                'property'	=>	'color',
                                'value'		=> 	$theme_header_text_color
                            ),
                            //Header Link Hover color
                            array(
                                'elements'	=>	'#contact-email a:hover, .user-nav a:hover',
                                'property'	=>	'color',
                                'value'		=> 	$theme_header_link_hover_color
                            ),
                            //Header Border color
                            array(
                                'elements'	=>	'#header-top, .social_networks li a, .user-nav a, .header-wrapper .social_networks, #currency-switcher #selected-currency, #currency-switcher-list li',
                                'property'	=>	'border-color',
                                'value'		=> 	$theme_header_border_color
                            ),
                            //Drop Down Menu Text color
                            array(
                                'elements'	=>	'.main-menu ul li a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_main_menu_text_color
                            ),
                            //Drop Down Menu background color
                            array(
                                'elements'	=>	'.main-menu ul li.current-menu-ancestor > a, .main-menu ul li.current-menu-parent > a, .main-menu ul li.current-menu-item > a, .main-menu ul li.current_page_item > a, .main-menu ul li:hover > a, .main-menu ul li ul, .main-menu ul li ul li ul',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_menu_bg_color
                            ),
                            //Drop Down Menu Text color
                            array(
                                'elements'	=>	'.main-menu ul li.current-menu-ancestor > a, .main-menu ul li.current-menu-parent > a, .main-menu ul li.current-menu-item > a, .main-menu ul li.current_page_item > a, .main-menu ul li:hover > a, .main-menu ul li ul, .main-menu ul li ul li a, .main-menu ul li ul li ul, .main-menu ul li ul li ul li a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_menu_text_color
                            ),
                            //Drop Down Menu hover background color
                            array(
                                'elements'	=>	'.main-menu ul li ul li:hover > a, .main-menu ul li ul li ul li:hover > a',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_menu_hover_bg_color
                            ),
                            // Slide
                            array(
                                'elements'	=>	'.slide-description h3, .slide-description h3 a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_title_color
                            ),
                            array(
                                'elements'	=>	'.slide-description h3 a:hover, .slide-description h3 a:focus, .slide-description h3 a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_title_hover_color
                            ),
                            array(
                                'elements'	=>	'.slide-description p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_desc_text_color
                            ),
                            array(
                                'elements'	=>	'.slide-description span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_price_color
                            ),
                            array(
                                'elements'	=>	'.slide-description .know-more',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_know_more_text_color
                            ),
                            array(
                                'elements'	=>	'.slide-description .know-more',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_slide_know_more_bg_color
                            ),
                            array(
                                'elements'	=>	'.slide-description .know-more:hover',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_slide_know_more_hover_bg_color
                            ),
                            //property item
                            array(
                                'elements'	=>	'.property-item',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_item_bg_color
                            ),
                            array(
                                'elements'	=>	'.property-item, .property-item .property-meta, .property-item .property-meta span',
                                'property'	=>	'border-color',
                                'value'		=> 	$theme_property_item_border_color
                            ),
                            array(
                                'elements'	=>	'.property-item h4, .property-item h4 a, .es-carousel-wrapper ul li h4 a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_title_color
                            ),
                            array(
                                'elements'	=>	'.property-item h4 a:hover, .property-item h4 a:focus, .property-item h4 a:active, .es-carousel-wrapper ul li h4 a:hover, .es-carousel-wrapper ul li h4 a:focus, .es-carousel-wrapper ul li h4 a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_title_hover_color
                            ),
                            array(
                                'elements'	=>	'.property-item .price, .es-carousel-wrapper ul li .price, .property-item .price small',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_price_text_color
                            ),
                            array(
                                'elements'	=>	'.property-item .price, .es-carousel-wrapper ul li .price',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_price_bg_color
                            ),
                            array(
                                'elements'	=>	'.property-item figure figcaption',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_status_text_color
                            ),
                            array(
                                'elements'	=>	'.property-item figure figcaption',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_status_bg_color
                            ),
                            array(
                                'elements'	=>	'.property-item p, .es-carousel-wrapper ul li p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_desc_text_color
                            ),
                            array(
                                'elements'	=>	'.more-details, .es-carousel-wrapper ul li p a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_more_details_text_color
                            ),
                            array(
                                'elements'	=>	'.more-details:hover, .more-details:focus, .more-details:active, .es-carousel-wrapper ul li p a:hover, .es-carousel-wrapper ul li p a:focus, .es-carousel-wrapper ul li p a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_more_details_text_hover_color
                            ),
                            array(
                                'elements'	=>	'.property-item .property-meta span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_meta_text_color
                            ),
                            array(
                                'elements'	=>	'.property-item .property-meta',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_meta_bg_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget .title',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_title_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget .textwidget, #footer .widget, #footer-bottom p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_text_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget ul li a, #footer .widget a, #footer-bottom a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_link_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget ul li a:hover, #footer .widget ul li a:focus, #footer.widget ul li a:active, #footer .widget a:hover, #footer .widget a:focus, #footer .widget a:active, #footer-bottom a:hover, #footer-bottom a:focus, #footer-bottom a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_link_hover_color
                            ),
                            array(
                                'elements'	=>	'#footer-bottom',
                                'property'	=>	'border-color',
                                'value'		=> 	$theme_footer_border_color
                            ),
                            //button
                            array(
                                'elements'	=>	'.real-btn',
                                'property'	=>	'color',
                                'value'		=> 	$theme_button_text_color
                            ),
                            array(
                                'elements'	=>	'.real-btn',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_button_bg_color
                            ),
                            array(
                                'elements'	=>	'.real-btn:hover, .real-btn.current',
                                'property'	=>	'color',
                                'value'		=> 	$theme_button_hover_text_color
                            ),
                            array(
                                'elements'	=>	'.real-btn:hover, .real-btn.current',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_button_hover_bg_color
                            ),

                        );

        if( $theme_disable_footer_bg == 'true' ){
            //Disable Footer Background Image
            $dynamic_css[] =  array(
                'elements'	=>	'#footer-wrapper',
                'property'	=>	'background-image',
                'value'		=> 	"none"
            );
            $dynamic_css[] =  array(
                'elements'	=>	'#footer-wrapper',
                'property'	=>	'padding-bottom',
                'value'		=> 	"0px"
            );
        }else{
            if(!empty($theme_footer_bg_img)){
                //Footer Background Image
                $dynamic_css[] =  array(
                    'elements'	=>	'#footer-wrapper',
                    'property'	=>	'background-image',
                    'value'		=> 	"url($theme_footer_bg_img)"
                );
            }
        }

        $dynamic_css_above_980px = array(
            //Phone Number background color
            array(
                'elements'	=>	'.contact-number, .contact-number .outer-strip',
                'property'	=>	'background-color',
                'value'		=> 	$theme_phone_bg_color
            ),
            //Phone Number background color
            array(
                'elements'	=>	'.contact-number',
                'property'	=>	'color',
                'value'		=> 	$theme_phone_text_color
            ),
            //Phone Icon background color
            array(
                'elements'	=>	'.contact-number .fa-phone',
                'property'	=>	'background-color',
                'value'		=> 	$theme_phone_icon_bg_color
            )
        );




        $prop_count = count($dynamic_css);

        if($prop_count > 0)
        {
            echo "<style type='text/css' id='dynamic-css'>\n\n";

            foreach($dynamic_css as $css_unit )
            {
                if(!empty($css_unit['value']))
                {
                    echo $css_unit['elements']."{\n";
                    echo $css_unit['property'].":".$css_unit['value'].";\n";
                    echo "}\n\n";
                }
            }

            /* CSS For min width 980px */
            echo "@media (min-width: 980px) {\n";
            foreach($dynamic_css_above_980px as $css_unit )
            {
                if(!empty($css_unit['value']))
                {
                    echo $css_unit['elements']."{\n";
                    echo $css_unit['property'].":".$css_unit['value'].";\n";
                    echo "}\n\n";
                }
            }
            echo "}\n";

            echo '</style>';
        }
    }
}

add_action('wp_head', 'generate_dynamic_css');