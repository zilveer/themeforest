<?php
vc_map(array(
    "name" => __("Moving Image", "mk_framework") ,
    "base" => "mk_moving_image",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-moving-image vc_mk_element-icon',
    'description' => __('Images powered by CSS3 moving animations.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "upload",
            "heading" => __("Upload Your image", "mk_framework") ,
            "param_name" => "src",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Animation Style", "mk_framework") ,
            "param_name" => "axis",
            "value" => array(
                "Vertical" => "vertical",
                "Horizontally" => "horizontal",
                "Pulse" => "pulse",
                "Tossing" => "tossing"
            ) ,
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
                __('Center', "mk_framework") => "center"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Title & Alt", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("For SEO purposes you may need to fill out the title and alt property for this image", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Link", "mk_framework") ,
            "param_name" => "link",
            "value" => "",
            "description" => __("Link this image to a URL. Include http://", "mk_framework")
        ) ,
        $add_css_animations,
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));