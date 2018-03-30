<?php
vc_map(array(
    "name" => __("Image Box", "mk_framework"),
    "base" => "mk_imagebox",
    "content_element" => true,
    'icon' => 'icon-mk-content-box vc_mk_element-icon',
    "as_parent" => array('only' => 'mk_imagebox_item'),
    "category" => __('Slideshows', 'mk_framework'),
    'params' => array(
        array(
            "heading" => __("Show as?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "show_as",
            "value" => array(
                __("Slideshow", 'mk_framework') => "slideshow",
                __("Column Based", 'mk_framework') => "column"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "toggle",
            "heading" => __("Slideshow Navigation?", "mk_framework"),
            "param_name" => "scroll_nav",
            "value" => "true",
            "description" => __("This option will give you the ability to turn on/off the slider next/previous navigation.", "mk_framework"),
            "dependency" => array(
                'element' => "show_as",
                'value' => array(
                    'slideshow'
                )
            ),
        ),
        array(
            "type" => "range",
            "heading" => __("Slides Per View", "mk_framework"),
            "param_name" => "per_view",
            "value" => "4",
            "min" => "1",
            "max" => "10",
            "step" => "1",
            "unit" => 'slides',
            "description" => __("How many Boxes per view?", "mk_framework"),
            "dependency" => array(
                'element' => "show_as",
                'value' => array(
                    'slideshow'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("How many Columns?", "mk_framework"),
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "6",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("If Column based is selected from the option above, you will need to set in how many columns, image boxes will be showed up.", "mk_framework"),
            "dependency" => array(
                'element' => "show_as",
                'value' => array(
                    'column'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Item Padding", "mk_framework"),
            "param_name" => "padding",
            "value" => "20",
            "min" => "5",
            "max" => "40",
            "step" => "1",
            "unit" => 'px',
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
            "heading" => __("Slideshow Speed", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "5000",
            "min" => "0",
            "max" => "50000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("If set to zero the autoplay will be disabled, any number above zeo will define the delay between each slide transition.", "mk_framework"),
            'type' => 'range'
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    ),
    "js_view" => 'VcColumnView'
));