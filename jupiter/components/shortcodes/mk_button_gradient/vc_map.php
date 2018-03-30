<?php

vc_map(array(
    "name" => __("Gradient Button", "mk_framework") ,
    "base" => "mk_button_gradient",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-button vc_mk_element-icon',
    'description' => __('Powerful & versatile button shortcode', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "dimension",
            "value" => array(
                __("2D", "mk_framework") => "two",
                __("Flat", "mk_framework") => "flat",
                __("Outline", "mk_framework") => "outline",
                __("Double Outline ", "mk_framework") => "double-outline"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textarea",
            "holder" => "div",
            "heading" => __("Button Text", "mk_framework") ,
            "param_name" => "content",
            "rows" => 1,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Size", "mk_framework") ,
            "param_name" => "size",
            "value" => array(
                "Small" => "small",
                "Medium" => "medium",
                "Large" => "large",
                "X-Large" => "x-large",
                "XX-Large" => "xx-large"
            ) ,
            "description" => __("", "mk_framework")
        ) ,

        //new added
        array(
            "type" => "dropdown",
            "heading" => __("Corner style", "mk_framework") ,
            "param_name" => "corner_style",
            "value" => array(
                "Pointed" => "pointed",
                "Rounded" => "rounded",
                "Full Rounded" => "full_rounded"
            ) ,
            "description" => __("How will your button corners look like?", "mk_framework") ,
            "dependency" => array(
                'element' => "dimension",
                'value' => array(
                    'two',
                    'flat'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("From", "mk_framework") ,
            "param_name" => "grandient_color_from",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("To", "mk_framework") ,
            "param_name" => "grandient_color_to",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "grandient_color_style",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(
                __('Linear', "mk_framework") => "linear",
                __('Radial', "mk_framework") => "radial"
            ) ,
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Angle", "mk_framework") ,
            "param_name" => "grandient_color_angle",

            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(
                __('Vertical ↓', "mk_framework") => "vertical",
                __('Horizontal →', "mk_framework") => "horizontal",
                __('Diagonal ↘', "mk_framework") => "diagonal_left_bottom",
                __('Diagonal ↗', "mk_framework") => "diagonal_left_top",
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "grandient_color_style",
                'value' => array(
                    'linear',
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Gradient Fallback Color", "mk_framework") ,
            "param_name" => "grandient_color_fallback",

            //"edit_field_class" => "vc_col-sm-3",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Button Text Color", "mk_framework") ,
            "param_name" => "text_color",
            "width" => 150,
            "value" => array(
                __('Light', "mk_framework") => "light",
                __('Dark', "mk_framework") => "dark",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button URL", "mk_framework") ,
            "param_name" => "url",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Target", "mk_framework") ,
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center",
                __('None', "mk_framework") => "none",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Full Width button?", "mk_framework") ,
            "param_name" => "fullwidth",
            "value" => "false",
            "description" => __("Using this option you can make the button full width and cover one row.", "mk_framework") 
        ) ,
        array(
            "type" => "range",
            "heading" => __("Custom Button Width", "mk_framework") ,
            "param_name" => "button_custom_width",
            "value" => "0",
            "min" => "0",
            "max" => "1500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "fullwidth",
                'value' => array(
                    'false',
                )
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button ID", "mk_framework") ,
            "param_name" => "id_second",
            "value" => "",
            "description" => __("If your want to use id for this button to refer it in your custom JS, fill this textbox.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Top", "mk_framework") ,
            "param_name" => "margin_top",
            "value" => "0",
            "min" => "-30",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "15",
            "min" => "-30",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Right", "mk_framework") ,
            "param_name" => "margin_right",
            "value" => "15",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        $add_css_animations,
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));