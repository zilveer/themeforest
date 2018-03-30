<?php
vc_map(array(
    "name" => __("Font icons", "mk_framework") ,
    "base" => "mk_font_icons",
    'icon' => 'icon-mk-font-icon vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Advanced font icon element', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Icon Color Type", "mk_framework") ,
            "param_name" => "color_style",
            "default" => "single_color",
            "value" => array(
                __('Single Color', "mk_framework") => "single_color",
                __('Gradient Color', "mk_framework") => "gradient_color"
            ) ,
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "mk_framework") ,
            "param_name" => "color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "color_style",
                'value' => array(
                    'single_color'
                )
            )
        ),
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
            "type" => "dropdown",
            "heading" => __("Icon Size", "mk_framework") ,
            "param_name" => "size",
            "value" => array(
                "16px" => "small",
                "32px" => "medium",
                "48px" => "large",
                "64px" => "x-large",
                "128px" => "xx-large",
                "256px" => "xxx-large"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Horizontal Margin", "mk_framework") ,
            "param_name" => "margin_horizental",
            "value" => "4",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can give padding to the icon. this padding will be applied to left and right side of the icon", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Vertical Margin", "mk_framework") ,
            "param_name" => "margin_vertical",
            "value" => "4",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can give padding to the icon. this padding will be applied to top and bottom of them icon", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Circle Box?", "mk_framework") ,
            "param_name" => "circle",
            "value" => "false",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Circle Color", "mk_framework") ,
            "param_name" => "circle_color",
            "value" => "",
            "description" => __("If Circle Enabled you can set the rounded box background color using this color picker.", "mk_framework"),
            "dependency" => array(
                'element' => "circle",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Circle Border Width", "mk_framework") ,
            "param_name" => "circle_border_width",
            "value" => "1",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "circle",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Circle Border Style", "mk_framework") ,
            "param_name" => "circle_border_style",
            "width" => 150,
            "value" => array(
                __('Solid', "mk_framework") => "solid",
                __('Dashed', "mk_framework") => "dashed",
                __('Dotted', "mk_framework") => "dotted"
            ) ,
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "circle",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Circle Border Color", "mk_framework") ,
            "param_name" => "circle_border_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "circle",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Icon Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('No Align', "mk_framework") => "none",
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ) ,
            "description" => __("Please note that align left and right will make the icons to float, therefore in order to keep your page elements from wrapping into each other you should add a padding divider shortcode right after the last icon.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Link", "mk_framework") ,
            "param_name" => "link",
            "value" => "",
            "description" => __("You can optionally link your icon. please provide full URL including http://", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Link Target", "mk_framework") ,
            "param_name" => "target",
            "value" => $target_arr,
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