<?php
vc_map(array(
    "name" => __("Icon Box 2", "mk_framework") ,
    "base" => "mk_icon_box2",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-icon-box vc_mk_element-icon',
    'description' => __('Powerful & versatile Icon Boxes.', 'mk_framework') ,
    "params" => array(
        array(
            "heading" => __("Icon Type?", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "icon_type",
            "value" => array(
                __("Icon", 'mk_framework') => "icon",
                __("Image", 'mk_framework') => "image"
            ) ,
            "type" => "dropdown"
        ) ,

        array(
            "heading" => __("Icon/Image Size", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "icon_size",
            "value" => array(
                __("16", 'mk_framework') => "16",
                __("32", 'mk_framework') => "32",
                __("48", 'mk_framework') => "48",
                __("64", 'mk_framework') => "64",
                __("128", 'mk_framework') => "128",
                __("No Limit (Images only)", 'mk_framework') => "inherit"
            ) ,
            "type" => "dropdown"
        ) ,

        array(
            "type" => "upload",
            "heading" => __("Icon Image", "mk_framework") ,
            "param_name" => "icon_image",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'image'
                )
            )
        ) ,

        array(
            "type" => "textfield",
            "heading" => __("Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "mk-li-smile",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Background Color", "mk_framework") ,
            "param_name" => "icon_background_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Border Color", "mk_framework") ,
            "param_name" => "icon_border_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Icon Hover Color", "mk_framework") ,
            "param_name" => "icon_hover_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Hover Background Color", "mk_framework") ,
            "param_name" => "icon_hover_background_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Hover Border Color", "mk_framework") ,
            "param_name" => "icon_hover_border_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "icon_type",
                'value' => array(
                    'icon'
                )
            )
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
            "heading" => __("Description Font Color", "mk_framework") ,
            "param_name" => "description_color",
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
         array(
            "type" => "dropdown",
            "heading" => __("Read More Link Target", "mk_framework") ,
            "param_name" => "link_target",
            "width" => 200,
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