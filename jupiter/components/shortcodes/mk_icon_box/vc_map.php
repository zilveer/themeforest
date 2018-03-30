<?php
global $mk_options;

vc_map(array(
    "name" => __("Icon Box", "mk_framework") ,
    "base" => "mk_icon_box",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-icon-box vc_mk_element-icon',
    'description' => __('Powerful & versatile Icon Boxes.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "mk-li-smile",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Title Font Size", "mk_framework") ,
            "param_name" => "text_size",
            "value" => "16",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Description", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Enter your content.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Read More Text", "mk_framework") ,
            "param_name" => "read_more_txt",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Read More URL", "mk_framework") ,
            "param_name" => "read_more_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                __('Simple Minimal', "mk_framework") => "simple_minimal",
                __('Simple Ultimate', "mk_framework") => "simple_ultimate",
                __('Boxed', "mk_framework") => "boxed"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Icon Size", "mk_framework") ,
            "param_name" => "icon_size",
            "value" => array(
                __('Small', "mk_framework") => "small",
                __('Medium', "mk_framework") => "medium",
                __('Large', "mk_framework") => "large",
                __('X-large', "mk_framework") => "x-large"
            ) ,
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple_ultimate',
                    'simple_minimal'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Circle container", "mk_framework") ,
            "param_name" => "rounded_circle",
            "value" => "false",
            "description" => __("Enable this option if you want your icon to be contained by a circle. This option will only work for icon size of Small and Medium.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple_ultimate'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Icon Location", "mk_framework") ,
            "param_name" => "icon_location",
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Top', "mk_framework") => "top"
            ) ,
            "description" => __("The horizontal and vertical location of Icon related to the box content", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple_ultimate',
                    'boxed'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Circle container", "mk_framework") ,
            "param_name" => "circled",
            "value" => "false",
            "description" => __("Enable this option if you want your icon to be contained by a circle.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple_minimal'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => $mk_options['skin_color'],
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Container (circle) Background Color", "mk_framework") ,
            "param_name" => "icon_circle_color",
            "value" => $mk_options['skin_color'],
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'boxed',
                    'simple_minimal'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Container (circle) Border Color", "mk_framework") ,
            "param_name" => "icon_circle_border_color",
            "value" => "",
            "description" => __("Optionally you can set a border for icon circle container. To disable border just leave this field blank.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'boxed',
                    'simple_minimal'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Title Color", "mk_framework") ,
            "param_name" => "title_color",
            "value" => "",
            "description" => __("Optionally you can modify Title color inside this shortcode.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Paragraph Color", "mk_framework") ,
            "param_name" => "txt_color",
            "value" => "",
            "description" => __("Optionally you can modify text color inside this shortcode.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Paragraph Link Color", "mk_framework") ,
            "param_name" => "txt_link_color",
            "value" => "",
            "description" => __("Optionally you can modify links color that are inside description.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin",
            "value" => "30",
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
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));