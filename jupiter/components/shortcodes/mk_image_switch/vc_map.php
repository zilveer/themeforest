<?php
    vc_map(array(
        "name" => __("Image Switch", "mk_framework") ,
        "base" => "mk_image_switch",
        "category" => __('General', 'mk_framework') ,
        'description' => __('', 'mk_framework') ,
        'icon' => 'icon-mk-image vc_mk_element-icon',
        "params" => array(
            array(
                "type" => "upload",
                "heading" => __("Upload Your First image", "mk_framework") ,
                "param_name" => "src_first",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "upload",
                "heading" => __("Upload Your Second image", "mk_framework") ,
                "param_name" => "src_second",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "dropdown",
                "heading" => __("Image Hover Animation", "mk_framework") ,
                "param_name" => "hover_animation",
                "value" => array(
                    __('Without Fading', "mk_framework") => "without-fading",
                    __('Fading', "mk_framework") => "fading",
                ) ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Image Width", "mk_framework") ,
                "param_name" => "image_width",
                "value" => "800",
                "min" => "10",
                "max" => "2600",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Image Height", "mk_framework") ,
                "param_name" => "image_height",
                "value" => "350",
                "min" => "10",
                "max" => "5000",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "toggle",
                "heading" => __("Image Cropping", "mk_framework") ,
                "param_name" => "crop",
                "value" => "true",
                "description" => __("If you dont want to crop your image based on the dimensions you defined above disable this option. Only wdith will be used to give the image container max-width property.", "mk_framework")
            ) ,
            array(
                "type" => "toggle",
                "heading" => __("SVG Enable?", "mk_framework") ,
                "param_name" => "svg",
                "value" => "false",
                "description" => __("If enabled max-width property will be added to image tag and you should enable this option if you are using SVG format in this image shortcode.", "mk_framework")
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
                'type' => 'vc_link',
                'heading' => __( 'URL (Link)', 'mk_framework' ),
                'param_name' => 'link',
                'description' => __( 'Add link to image.', 'mk_framework' ),
            ),
            array(
                "type" => "range",
                "heading" => __("Margin Bottom", "mk_framework") ,
                "param_name" => "margin_bottom",
                "value" => "10",
                "min" => "-50",
                "max" => "300",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            $add_css_animations,
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework") ,
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
            )
        )
    ));