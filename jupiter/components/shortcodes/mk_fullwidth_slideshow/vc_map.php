<?php
vc_map(array(
    "name" => __("Fullwidth Slideshow", "mk_framework"),
    "base" => "mk_fullwidth_slideshow",
    'icon' => 'icon-mk-fullwidth-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Fullwdith image slider.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "range",
            "heading" => __("Top & Bottom Padding", "mk_framework"),
            "param_name" => "padding",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "value" => "30",
            "type" => "range"
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Top and Bottom Borders Color", "mk_framework"),
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Box Background Color", "mk_framework"),
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "upload",
            "heading" => __("Background Image", "mk_framework"),
            "param_name" => "bg_image",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", "mk_framework"),
            "param_name" => "attachment",
            "width" => 150,
            "value" => array(
                __('Scroll', "mk_framework") => "scroll",
                __('Fixed', "mk_framework") => "fixed"
            ),
            "description" => __("The background-attachment property sets whether a background image is fixed or scrolls with the rest of the page. <a href='http://www.w3schools.com/CSSref/pr_background-attachment.asp'>Read More</a>", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Background Position", "mk_framework"),
            "param_name" => "bg_position",
            "width" => 300,
            "value" => array(
                __('Left Top', "mk_framework") => "left top",
                __('Center Top', "mk_framework") => "center top",
                __('Right Top', "mk_framework") => "right top",
                __('Left Center', "mk_framework") => "left center",
                __('Center Center', "mk_framework") => "center center",
                __('Right Center', "mk_framework") => "right center",
                __('Left Bottom', "mk_framework") => "left bottom",
                __('Center Bottom', "mk_framework") => "center bottom",
                __('Right Bottom', "mk_framework") => "right bottom"
            ),
            "description" => __("First value defines horizontal position and second vertical positioning.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Enable 3D background", "mk_framework"),
            "param_name" => "enable_3d",
            "value" => "false"
        ),
        array(
            "type" => "range",
            "heading" => __("3D Speed Factor", "mk_framework"),
            "param_name" => "speed_factor",
            "min" => "-10",
            "max" => "10",
            "step" => "0.1",
            "unit" => 'factor',
            "value" => "0.3",
            "type" => "range"
        ),
        array(
            "type" => "attach_images",
            "heading" => __("Add Images", "mk_framework"),
            "param_name" => "images",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Stretch Images to the Container?", "mk_framework"),
            "param_name" => "stretch_images",
            "value" => "false",
            "description" => __("If enabled, the images will scale up to fit the container.", "mk_framework")
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