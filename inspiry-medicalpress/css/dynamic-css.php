<?php
/*-----------------------------------------------------------------------------------*/
//	Generate Dynamic CSS
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'generate_dynamic_css' ) ){
    function generate_dynamic_css(){

        global $theme_options;

        $header_nav_border_color = $theme_options['header_nav_border_color'];
        $responsive_menu_bar_bg_color = $theme_options['responsive_menu_bar_bg_color'];
        $overall_link_color = $theme_options['overall_link_color'];
        $default_btn_bg = $theme_options['default_btn_bg'];
        $default_btn_text_color = $theme_options['default_btn_text_color'];
        $read_more_btn_bg = $theme_options['read_more_btn_bg'];
        $read_more_btn_text_color = $theme_options['read_more_btn_text_color'];
        $appo_form_heading_bg = $theme_options['appo_form_heading_bg_color'];
        $appo_form_bg = $theme_options['appo_form_bg_color'];
//        $appo_fields_border = $theme_options['appo_fields_border_color'];
        $appo_calendar_hover = $theme_options['appo_calendar_hover_color'];

        $footer_border_color = $theme_options['footer_border_color'];
        $footer_link_color = $theme_options['footer_link_color'];
        $footer_social_icons_color = $theme_options['footer_social_icons_color'];

        $dynamic_css = array(

            //Header Navigation Border Color
            array(
                'elements'	=>	'nav.main-menu ul > li ul li',
                'property'	=>	'border-color',
                'value'		=> 	$header_nav_border_color
            ),


            //Over All Link Color
            array(
                'elements'	=>	'a',
                'property'	=>	'color',
                'value'		=> 	$overall_link_color['regular']
            ),
            array(
                'elements'	=>	'a:hover, a:focus',
                'property'	=>	'color',
                'value'		=> 	$overall_link_color['hover']
            ),


            //Default Button Background and Text Color
            array(
                'elements'	=>	'form input[type="submit"], .woocommerce a.added_to_cart, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #respond input[type="submit"]',
                'property'	=>	'background-color',
                'value'		=> 	$default_btn_bg['regular']
            ),
            array(
                'elements'	=>	'form input[type="submit"]:hover, form input[type="submit"]:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input[type="submit"]:hover',
                'property'	=>	'background-color',
                'value'		=> 	$default_btn_bg['hover']
            ),
            array(
                'elements'	=>	'form input[type="submit"], .woocommerce a.added_to_cart, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #respond input[type="submit"]',
                'property'	=>	'color',
                'value'		=> 	$default_btn_text_color['regular']
            ),
            array(
                'elements'	=>	'form input[type="submit"]:hover, form input[type="submit"]:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input[type="submit"]:hover',
                'property'	=>	'color',
                'value'		=> 	$default_btn_text_color['hover']
            ),


            //Read More Button Background and Text Color
            array(
                'elements'	=>	'.read-more, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
                'property'	=>	'background-color',
                'value'		=> 	$read_more_btn_bg['regular']
            ),
            array(
                'elements'	=>	'.read-more:hover, .read-more:focus, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
                'property'	=>	'background-color',
                'value'		=> 	$read_more_btn_bg['hover']
            ),
            array(
                'elements'	=>	'.read-more, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt',
                'property'	=>	'color',
                'value'		=> 	$read_more_btn_text_color['regular']
            ),
            array(
                'elements'	=>	'.read-more:hover, .read-more:focus, .woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
                'property'	=>	'color',
                'value'		=> 	$read_more_btn_text_color['hover']
            ),

            //Appointment Form Heading Background Color
            array(
                'elements'	=>	'.home-slider .make-appoint',
                'property'	=>	'background-color',
                'value'		=> 	$appo_form_heading_bg['regular']
            ),
            array(
                'elements'	=>	'.home-slider .make-appoint:hover',
                'property'	=>	'background-color',
                'value'		=> 	$appo_form_heading_bg['hover']
            ),

            //Appointment Form Background Color
            array(
                'elements'	=>	'.home-slider .appointment, .home-slider .appointment-form, .ui-datepicker-header',
                'property'	=>	'background-color',
                'value'		=> 	$appo_form_bg
            ),

            //Appointment Form Fields Bottom Border Color
//            array(
//                'elements'	=>	'.home-slider input[type="text"], .home-slider input[type="email"], .home-slider input[type="number"], .home-slider textarea',
//                'property'	=>	'border-color',
//                'value'		=> 	$appo_fields_border
//            ),

            //Appointment Form Calender Hover,Active and Focus Color
            array(
                'elements'	=>	'td .ui-state-active, td .ui-state-hover, td .ui-state-highlight, .ui-datepicker-header .ui-state-hover',
                'property'	=>	'background-color',
                'value'		=> 	$appo_calendar_hover
            ),

            //Footer Border Color
            array(
                'elements'	=>	'#main-footer, .footer-bottom, #main-footer .widget ul, #main-footer .widget ul li',
                'property'	=>	'border-color',
                'value'		=> 	$footer_border_color
            ),


            //Footer Link Color
            array(
                'elements'	=>	'#main-footer .widget a',
                'property'	=>	'color',
                'value'		=> 	$footer_link_color['regular']
            ),
            array(
                'elements'	=>	'#main-footer .widget a:hover',
                'property'	=>	'color',
                'value'		=> 	$footer_link_color['hover']
            ),
            array(
                'elements'	=>	'#main-footer .widget a:active',
                'property'	=>	'color',
                'value'		=> 	$footer_link_color['active']
            ),


            //Footer Social Icons
            array(
                'elements'	=>	'.footer-bottom .footer-social-nav li .fa',
                'property'	=>	'color',
                'value'		=> 	$footer_social_icons_color['regular']
            ),
            array(
                'elements'	=>	'.footer-bottom .footer-social-nav li .fa:hover',
                'property'	=>	'color',
                'value'		=> 	$footer_social_icons_color['hover']
            ),
            array(
                'elements'	=>	'.footer-bottom .footer-social-nav li .fa:active',
                'property'	=>	'color',
                'value'		=> 	$footer_social_icons_color['active']
            )

        );

        // hide home slider plus sign if configured from theme options
        if ( $theme_options['display_slider_plus_sign'] == '0' ) {
            $dynamic_css[] = array(
                'elements'	=>	'.home-slider .slide-content h1:after',
                'property'	=>	'display',
                'value'		=> 	'none'
            );
        }

        // media query max width 530px
        $dynamic_css_max_width_530px = array(

            //Responsive menu bar background color
            array(
                'elements'	=>	'.mean-container .mean-bar',
                'property'	=>	'background-color',
                'value'		=> 	$responsive_menu_bar_bg_color
            ),

        );

        $prop_count = count($dynamic_css);

        if( $prop_count > 0 ){

            echo "<style type='text/css' id='inspiry-dynamic-css'>\n\n";        // before styles

            // common styles
            foreach($dynamic_css as $css_unit ) {
                if(!empty($css_unit['value'])) {
                    echo $css_unit['elements']."{\n";
                    echo $css_unit['property'].":".$css_unit['value'].";\n";
                    echo "}\n\n";
                }
            }

            /* css for media query for max width 530px */
            if ( count( $dynamic_css_max_width_530px ) > 0 ) {
                echo "@media only screen and (max-width: 530px) {\n";
                foreach( $dynamic_css_max_width_530px as $css_unit ) {
                    if ( !empty( $css_unit['value'] ) ) {
                        echo $css_unit['elements']."{\n";
                        echo $css_unit['property'].":".$css_unit['value'].";\n";
                        echo "}\n\n";
                    }
                }
                echo "}\n";
            }

            echo '</style>';        // end of styles
        }
    }
}
add_action('wp_head', 'generate_dynamic_css');