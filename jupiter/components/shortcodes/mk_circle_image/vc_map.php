<?php
    vc_map(array(
        "name" => __("Circle Image Frame", "mk_framework") ,
        "base" => "mk_circle_image",
        "category" => __('General', 'mk_framework') ,
        'icon' => 'icon-mk-circle-image-frame vc_mk_element-icon',
        'description' => __('Adds a circled image element.', 'mk_framework') ,
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Heading Title", "mk_framework") ,
                "param_name" => "heading_title",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "upload",
                "heading" => __("Upload Your image", "mk_framework") ,
                "param_name" => "src",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Image Diameter", "mk_framework") ,
                "param_name" => "image_diameter",
                "value" => "500",
                "min" => "10",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px',
                "description" => __("The diameter of circle containing your image", "mk_framework")
            ) ,
            array(
                "type" => "textfield",
                "heading" => __("Image Link", "mk_framework") ,
                "param_name" => "link",
                "value" => "",
                "description" => __("Optionally you can link your image.", "mk_framework")
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