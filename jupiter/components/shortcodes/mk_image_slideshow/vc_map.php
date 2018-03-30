<?php
vc_map(array(
    "name" => __("Image Slideshow", "mk_framework"),
    "base" => "mk_image_slideshow",
    'icon' => 'icon-mk-image-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Simple image slideshow.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Heading Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "attach_images",
            "heading" => __("Add Images", "mk_framework"),
            "param_name" => "images",
            "value" => "",
            "description" => __("", "mk_framework")
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
            "description" => __("", "mk_framework")
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
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Top", "mk_framework"),
            "param_name" => "margin_top",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework"),
            "param_name" => "margin_bottom",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Animation Effect", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "effect",
            "value" => array(
                __("Fade", 'mk_framework') => "fade",
                __("Slide", 'mk_framework') => "slide"
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
            "heading" => __("Pause on Hover", "mk_framework"),
            "param_name" => "pause_on_hover",
            "value" => "false",
            "description" => __("Pauses the slideshow when hovering over slider, then resumes when no longer hovering", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Smooth Height", "mk_framework"),
            "param_name" => "smooth_height",
            "value" => "true",
            "description" => __("Allows height of slider to animate smoothly in horizontal mode", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Direction Nav", "mk_framework"),
            "param_name" => "direction_nav",
            "value" => "true",
            "description" => __("The next/pervious buttons to navigate between slides", "mk_framework")
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