<?php
vc_map(array(
    "name" => __("Flip Box", "mk_framework") ,
    "base" => "mk_flipbox",
    'icon' => 'icon-mk-tab-slider vc_mk_element-icon',
    "category" => __('General', 'mk_framework') ,
    'description' => __('Flip based boxes.', 'mk_framework') ,
    'params' => array(
        array(
            "type" => "dropdown",
            "heading" => __("Flip Direction", "mk_framework") ,
            "param_name" => "flip_direction",
            "width" => 300,
            "value" => array(
                __('Horizontal', "mk_framework") => "horizontal",
                __('Vertical', "mk_framework") => "vertical"
            ) ,
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "colorpicker",
            "heading" => __("Front Background Color", "mk_framework") ,
            "param_name" => "front_background_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Back Background Color", "mk_framework") ,
            "param_name" => "back_background_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,

        array(
            "heading" => __("Minimum Height", "mk_framework") ,
            "param_name" => "min_height",
            "value" => "300",
            "min" => "250",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            'type' => 'range'
        ) ,

        array(
            "heading" => __("Icon Type", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "icon_type",
            "value" => array(
                __("Image", 'mk_framework') => "image",
                __("Icon", 'mk_framework') => "icon"
            ) ,
            "type" => "dropdown"
        ) ,

        array(
            "type" => "upload",
            "heading" => __("Image", "mk_framework") ,
            "param_name" => "image",
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
            "heading" => __("Icon Size", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "icon_size",
            "value" => array(
                __("16px", 'mk_framework') => "16",
                __("32px", 'mk_framework') => "32",
                __("64px", 'mk_framework') => "64",
                __("128px", 'mk_framework') => "128",
            ) ,
            "type" => "dropdown",
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
            "type" => "textfield",
            "heading" => __("Front Title", "mk_framework") ,
            "param_name" => "front_title",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "heading" => __("Front Title Font Size", "mk_framework") ,
            "param_name" => "front_title_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            'type' => 'range'
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Front Title Font Color", "mk_framework") ,
            "param_name" => "front_title_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "textfield",
            "heading" => __("Back Title", "mk_framework") ,
            "param_name" => "back_title",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "heading" => __("Back Title Font Size", "mk_framework") ,
            "param_name" => "back_title_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            'type' => 'range'
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Back Title Font Color", "mk_framework") ,
            "param_name" => "back_title_color",
            "value" => "",
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
            "type" => "textarea",
            "heading" => __("Front Description", "mk_framework") ,
            "param_name" => "front_desc",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "heading" => __("Front Description Font Size", "mk_framework") ,
            "param_name" => "front_desc_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            'type' => 'range'
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Front Description Font Color", "mk_framework") ,
            "param_name" => "front_desc_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "textarea",
            "heading" => __("Back Description", "mk_framework") ,
            "param_name" => "back_desc",
            "value" => "",
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "heading" => __("Back Description Font Size", "mk_framework") ,
            "param_name" => "back_desc_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            'type' => 'range'
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Back Description Font Color", "mk_framework") ,
            "param_name" => "back_desc_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "textfield",
            "heading" => __("Button Url", "mk_framework") ,
            "param_name" => "button_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Button Target", "mk_framework") ,
            "param_name" => "button_target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button Text", "mk_framework") ,
            "param_name" => "button_text",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Background Color", "mk_framework") ,
            "param_name" => "button_bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Button Hover Background Color", "mk_framework") ,
            "param_name" => "button_bg_hover_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Button Text Skin", "mk_framework") ,
            "param_name" => "button_text_skin",
            "width" => 300,
            "value" => array(
                __('Light', "mk_framework") => "light",
                __('Dark', "mk_framework") => "dark"
            ) ,
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));
