<?php

vc_map(array(
    "name" => __("Slideshow Box", "mk_framework") ,
    "base" => "mk_slideshow_box",
    "as_parent" => array(
        'except' => 'mk_page_section'
    ) ,
    "content_element" => true,
    "show_settings_on_create" => true,
    "description" => __("Slideshow Box For your contents.", "mk_framework") ,
    'icon' => 'icon-mk-custom-box vc_mk_element-icon',
    "category" => __('General', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "attach_images",
            "heading" => __("Add Images", "mk_framework") ,
            "param_name" => "images",
            "value" => "",
            "description" => __("Add images to your background slideshow", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Cover whole background", "mk_framework") ,
            "param_name" => "background_cover",
            "description" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework") ,
            "value" => "true"
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Repeat", "mk_framework") ,
            "param_name" => "bg_repeat",
            "value" => array(
                __('Repeat', "mk_framework") => "repeat",
                __('No Repeat', "mk_framework") => "no-repeat",
                __('Horizontal Repeat', "mk_framework") => "repeat-x",
                __('Vertical Repeat', "mk_framework") => "repeat-y"
            ) ,
            "description" => __("", "mk_framework") ,
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Position", "mk_framework") ,
            "param_name" => "bg_position",
            "width" => 300,
            "value" => array(
                __('Center Center', "mk_framework") => "center center",
                __('Left Top', "mk_framework") => "left top",
                __('Center Top', "mk_framework") => "center top",
                __('Right Top', "mk_framework") => "right top",
                __('Left Center', "mk_framework") => "left center",
                __('Right Center', "mk_framework") => "right center",
                __('Left Bottom', "mk_framework") => "left bottom",
                __('Center Bottom', "mk_framework") => "center bottom",
                __('Right Bottom', "mk_framework") => "right bottom"
            ) ,
            "description" => __("First value defines horizontal position and second vertical positioning.", "mk_framework"),
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Slideshow Speed", "mk_framework") ,
            "param_name" => "slideshow_speed",
            "min" => "1000",
            "max" => "10000",
            "step" => "1",
            "unit" => 'ms',
            "value" => "3000"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Transition Speed", "mk_framework") ,
            "param_name" => "transition_speed",
            "min" => "100",
            "max" => "5000",
            "step" => "1",
            "unit" => 'ms',
            "value" => "1000"
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Color Overlay", "mk_framework") ,
            "param_name" => "overlay",
            "value" => "",
            "description" => __("The overlay layer Color. You will need to change the alpha using this color picker to give an opacity to the color you choose.", "mk_framework") ,
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Overlay Mask Pattern?", "mk_framework") ,
            "param_name" => "slideshow_mask",
            "description" => __("Creates an overlay repeated pattern on your slideshow.", "mk_framework") ,
            "value" => "false"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Section Min Height", "mk_framework") ,
            "param_name" => "section_height",
            "value" => "400",
            "min" => "0",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Full Screen Height?", "mk_framework") ,
            "param_name" => "full_height",
            "value" => array(
                __('No', "mk_framework") => "false",
                __('Yes', "mk_framework") => "true"
            ) ,
            "description" => __("Using this option you can make this slideshow box's height to cover the whole visible screen height (Not document height). Please note that if the inner content is larger than the window height, this feature will be disabled. Full height is browser resize sensitive and completely responsive.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Full Screen Width Content?", "mk_framework") ,
            "param_name" => "full_width_cnt",
            "value" => array(
                __('No', "mk_framework") => "false",
                __('Yes', "mk_framework") => "true"
            ) ,
            "description" => __("If you enable this option you're shortcodes within Slideshow Box will become full width", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Padding Top", "mk_framework") ,
            "param_name" => "padding_top",
            "value" => "10",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The space between the content and top border of slideshow content section", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Padding Bottom", "mk_framework") ,
            "param_name" => "padding_bottom",
            "value" => "10",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The space between the content and bottom border of slideshow content section", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ) ,
    ) ,
    "js_view" => 'VcColumnView'
));