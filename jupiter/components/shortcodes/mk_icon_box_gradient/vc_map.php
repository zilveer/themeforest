<?php
    vc_map(array(
    "name" => __("Icon Box Gradient", "mk_framework") ,
    "base" => "mk_icon_box_gradient",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-icon-box vc_mk_element-icon',
    'description' => __('Powerful & versatile Icon Boxes.', 'mk_framework') ,
    "params" => array(

        array(
            "heading" => __("Icon Size", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "icon_size",
            "value" => array(
                __("16", 'mk_framework') => "16",
                __("32", 'mk_framework') => "32",
                __("48", 'mk_framework') => "48",
                __("64", 'mk_framework') => "64",
                __("128", 'mk_framework') => "128",
            ) ,
            "type" => "dropdown"
        ) ,

        array(
            "type" => "textfield",
            "heading" => __("Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "mk-li-smile",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
        ) ,
        array(
            "heading" => __("Container Shape", 'mk_framework') ,
            "description" => __("Works properly only in Webkit browsers. Fallback to circle shape for others", 'mk_framework') ,
            "param_name" => "holder_shape",
            "border" => 'true',
            "value" => array(
                'shape/circle.png' => "circle",
                'shape/hexagon.png' => "hexagon",
                'shape/hexagon2.png' => "hexagon2",
                'shape/pentagon.png' => "pentagon",
                'shape/square.png' => "square",
                'shape/square2.png' => "square2",
                'shape/starz.png' => "starz",
            ) ,
            "type" => "visual_selector"
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Text Color Type", "mk_framework") ,
            "param_name" => "color_style",
            "default" => "",
            "value" => array(
                __('Single Color', "mk_framework") => "single_color",
                __('Gradient Color', "mk_framework") => "gradient_color"
            ) ,
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Container Color", "mk_framework") ,
            "param_name" => "container_color",
            "edit_field_class" => "vc_col-sm-6 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'single_color'
                )
            )
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Container Hover Color", "mk_framework") ,
            "param_name" => "container_hover_color",
            "edit_field_class" => "vc_col-sm-6 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'single_color'
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
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'gradient_color'
                )
            ) ,
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("To", "mk_framework") ,
            "param_name" => "grandient_color_to",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'gradient_color'
                )
            ) ,
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "grandient_color_style",
            "edit_field_class" => "vc_col-sm-3 vc_column",
            "value" => array(
                __('Linear', "mk_framework") => "linear",
                __('Radial', "mk_framework") => "radial"
            ) ,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'gradient_color'
                )
            ) ,
        ),
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
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "grandient_color_style",
                'value' => array(
                    'linear'
                )
            ) ,
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Gradient Fallback Color", "mk_framework") ,
            "param_name" => "grandient_color_fallback",
            //"edit_field_class" => "vc_col-sm-3",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'gradient_color'
                )
            ) ,
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "edit_field_class" => "vc_col-sm-6 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Icon Hover Color", "mk_framework") ,
            "param_name" => "icon_hover_color",
            "edit_field_class" => "vc_col-sm-6 vc_column",
            "value" => "",
            "description" => __("", "mk_framework") ,
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
            "param_name" => "title_size",
            "value" => "20",
            "min" => "5",
            "max" => "40",
            "step" => "1",
            "unit" => 'px'
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Weight", "mk_framework") ,
            "param_name" => "title_weight",
            "width" => 150,
            "value" => array(
                __('Default', "mk_framework") => "inherit",
                __('Bold', "mk_framework") => "bold",
                __('Bolder', "mk_framework") => "bolder",
                __('Normal', "mk_framework") => "normal",
                __('Light', "mk_framework") => "300"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Title Font Color", "mk_framework") ,
            "param_name" => "title_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Title Top Padding", "mk_framework") ,
            "param_name" => "title_top_padding",
            "value" => "10",
            "min" => "5",
            "max" => "60",
            "step" => "1",
            "unit" => 'px'
        ) ,
        array(
            "type" => "range",
            "heading" => __("Title Bottom Padding", "mk_framework") ,
            "param_name" => "title_bottom_padding",
            "value" => "10",
            "min" => "5",
            "max" => "60",
            "step" => "1",
            "unit" => 'px'
        ) ,

        array(
            "type" => "textarea_html",
            "holder" => "div",
            'toolbar' => 'full',
            "heading" => __("Description", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Enter your content.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Description Color", "mk_framework") ,
            "param_name" => "content_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Box Align", "mk_framework") ,
            "param_name" => "align",
            "description" => __("This option will align the whole box content.", "mk_framework") ,
            "value" => array(
                "Center" => "center",
                "Left" => "left",
                "Right" => "right",
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Read More URL", "mk_framework") ,
            "param_name" => "read_more_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));