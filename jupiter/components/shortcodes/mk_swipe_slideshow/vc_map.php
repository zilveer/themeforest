<?php
vc_map(array(
    "name" => __("Swipe Slideshow", "mk_framework"),
    "base" => "mk_swipe_slideshow",
    'icon' => 'icon-mk-swipe-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Swipe enabled slideshow.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __("Add Images", "mk_framework"),
            "param_name" => "images",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Image Size", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "image_size",
            "value" => mk_get_image_sizes(),
            "type" => "dropdown",
        ),
        array(
            "type" => "range",
            "heading" => __("Width", "mk_framework"),
            "param_name" => "image_width",
            "value" => "770",
            "min" => "100",
            "max" => "1380",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "image_size",
                'value' => array(
                    'crop',
                )
            ) 
        ),
        array(
            "type" => "range",
            "heading" => __("Height", "mk_framework"),
            "param_name" => "image_height",
            "value" => "350",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "image_size",
                'value' => array(
                    'crop',
                )
            )
        ),
        array(
            "heading" => __("Slide Direction", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "direction",
            "value" => array(
                __("Horizontal", 'mk_framework') => "horizontal",
                __("Vertical", 'mk_framework') => "vertical"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Slideshow Speed", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "7000",
            "min" => "1000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Direction Nav", "mk_framework"),
            "param_name" => "direction_nav",
            "value" => "true",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));