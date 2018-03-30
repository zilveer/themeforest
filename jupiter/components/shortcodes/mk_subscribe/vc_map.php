<?php
    vc_map(array(
        "name" => __("Mailchimp Subscribe Form", "mk_framework") ,
        "base" => "mk_subscribe",
        'icon' => 'icon-mk-news-tab vc_mk_element-icon',
        'description' => __('', 'mk_framework') ,
        "category" => __('General', 'mk_framework') ,
        "params" => array(

            // General Settings
            array(
                "type" => "textfield",
                "heading" => __("Placeholder Text", "mk_framework") ,
                "param_name" => "placeholder_text",
                "value" => "Your e-mail",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "textfield",
                "heading" => __("Button Text", "mk_framework") ,
                "param_name" => "button_text",
                "value" => "SEND",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "textfield",
                "heading" => __("List ID", "mk_framework") ,
                "param_name" => "list_id",
                "value" => "",
                "description" => __("i.e: '6edd80a499'", "mk_framework")
            ) ,
            array(
                "type" => "checkbox",
                "heading" => __("Send Opt-in Mails", "mk_framework") ,
                "param_name" => "optin",
                "value" => "",
                "description" => __("Sends a 'click to subscribe' mail", "mk_framework")
            ) ,
            $add_css_animations,
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework") ,
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            ) ,

            // Styles & Color Settings
            array(
                "type" => "range",
                "heading" => __("Corner Radius", "mk_framework") ,
                "param_name" => "corner_radius",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "value" => "0",
                "min" => "0",
                "max" => "100",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Space between button and input", "mk_framework") ,
                "param_name" => "space_between",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "value" => "0",
                "min" => "0",
                "max" => "20",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "dropdown",
                "heading" => __("Size", "mk_framework") ,
                "param_name" => "subscribe_size",
                "value" => array(
                    __('Large', "mk_framework") => "large",
                    __('Medium', "mk_framework") => "medium",
                ) ,
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("Choose the icon size by pixel.", "mk_framework")
            ) ,
            array(
               "type" => "group_heading",
               "title" => __("Button Settings?", "mk_framework"),
               "param_name" => "color_button_title",
               "group" => __('Styles & Colors', 'mk_framework') ,
               "style" => "border: 0; font-size: 16px; font-weight:bold; padding:15px 0 0; border-top: 1px solid #cccccc;"
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Button background color", "mk_framework") ,
                "param_name" => "btn_bg_color",
                "value" => "",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Button text color", "mk_framework") ,
                "param_name" => "btn_text_color",
                "value" => "#eee",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "dropdown",
                "heading" => __("Button border style", "mk_framework") ,
                "param_name" => "btn_border_style",
                "value" => array(
                    __('Solid', "mk_framework") => "solid",
                    __('Dashed', "mk_framework") => "dashed",
                    __('Dotted', "mk_framework") => "dotted",
                    __('None', "mk_framework") => "none",
                ) ,
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("Choose the icon size by pixel.", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Button border width", "mk_framework") ,
                "param_name" => "btn_border_width",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "value" => "1",
                "min" => "1",
                "max" => "10",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework"),
                "dependency" => array(
                    'element' => "btn_border_style",
                    'value' => array(
                        'solid',
                        'dashed',
                        'dotted'
                    )
                )
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Button border color", "mk_framework") ,
                "param_name" => "btn_border_color",
                "value" => "#eee",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,

            array(
               "type" => "group_heading",
               "title" => __("Text Input settings?", "mk_framework"),
               "param_name" => "color_input_title",
               "group" => __('Styles & Colors', 'mk_framework') ,
               "style" => "border: 0; font-size: 16px; font-weight:bold; padding:15px 0 0; border-top: 1px solid #cccccc;"
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Text input background color", "mk_framework") ,
                "param_name" => "input_bg_color",
                "value" => "",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Placeholder color", "mk_framework") ,
                "param_name" => "input_placeholder_color",
                "value" => "#eee",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "dropdown",
                "heading" => __("Text input border style", "mk_framework") ,
                "param_name" => "input_border_style",
                "value" => array(
                    __('Solid', "mk_framework") => "solid",
                    __('Dashed', "mk_framework") => "dashed",
                    __('Dotted', "mk_framework") => "dotted",
                    __('None', "mk_framework") => "none",
                ) ,
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("Choose the icon size by pixel.", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Text input border width", "mk_framework") ,
                "param_name" => "input_border_width",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "value" => "1",
                "min" => "1",
                "max" => "10",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Text input border color", "mk_framework") ,
                "param_name" => "input_border_color",
                "value" => "#eee",
                "group" => __('Styles & Colors', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,

            // Hover Styles Settings
            array(
               "type" => "group_heading",
               "title" => __("Button Settings?", "mk_framework"),
               "param_name" => "hover_button_title",
               "group" => __('Hover Options', 'mk_framework') ,
               "style" => "border: 0; font-size: 16px; font-weight:bold; padding:15px 0 0;"
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Button background color", "mk_framework") ,
                "param_name" => "btn_hover_bg_color",
                "value" => "",
                "group" => __('Hover Options', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Button text color", "mk_framework") ,
                "param_name" => "btn_hover_text_color",
                "value" => "",
                "group" => __('Hover Options', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Button border color", "mk_framework") ,
                "param_name" => "btn_hover_border_color",
                "value" => "",
                "group" => __('Hover Options', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,

            // Focus Style Settings
            array(
               "type" => "group_heading",
               "title" => __("Text input settings?", "mk_framework"),
               "param_name" => "hover_button_title",
               "group" => __('Focus Options', 'mk_framework') ,
               "style" => "border: 0; font-size: 16px; font-weight:bold; padding:15px 0 0;"
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Text input background color", "mk_framework") ,
                "param_name" => "input_focus_bg_color",
                "value" => "",
                "group" => __('Focus Options', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,

            array(
                "type" => "colorpicker",
                "heading" => __("Placeholder color", "mk_framework") ,
                "param_name" => "input_focus_placeholder_color",
                "value" => "",
                "group" => __('Focus Options', 'mk_framework') ,
                "description" => __("", "mk_framework")
            ) ,
        )
    ));