<?php
vc_map(array(
    "name" => __("Tooltip", "mk_framework") ,
    "base" => "mk_tooltip",
    'icon' => 'icon-mk-tooltip vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('Adds Tooltips to inline texts.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Text", "mk_framework") ,
            "param_name" => "text",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Tooltip Text", "mk_framework") ,
            "param_name" => "tooltip_text",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Tooltip URL", "mk_framework") ,
            "param_name" => "href",
            "value" => "",
            "description" => __("You can optionally link the tooltip text to a webpage.", "mk_framework")
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
