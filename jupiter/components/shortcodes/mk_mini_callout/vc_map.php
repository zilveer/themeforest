<?php
vc_map(array(
    "name" => __("Mini Callout Box", "mk_framework") ,
    "base" => "mk_mini_callout",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-mini-callout-box vc_mk_element-icon',
    'description' => __('Small callout box for important infos.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Description", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Enter your content.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button Text", "mk_framework") ,
            "param_name" => "button_text",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Button URL", "mk_framework") ,
            "param_name" => "button_url",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));
