<?php
vc_map(array(
    "name" => __("Dropcaps", "mk_framework") ,
    "base" => "mk_dropcaps",
    'icon' => 'icon-mk-dropcaps vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Dropcaps element shortcode.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "holder" => "div",
            "heading" => __("Dropcaps Character", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                __('Simple', "mk_framework") => "simple-style",
                __('Fancy', "mk_framework") => "fancy-style"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework") ,
            "param_name" => "size",
            "value" => "34",
            "min" => "12",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'fancy-style'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Padding", "mk_framework") ,
            "param_name" => "padding",
            "value" => "10",
            "min" => "5",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can set padding for dropcaps.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'fancy-style'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework") ,
            "param_name" => "background_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'fancy-style'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'fancy-style'
                )
            )
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