<?php
$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_sidebar_typography",
    "name" => __("Typography / Sidebar", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Title Size', "mk_framework") ,
            "id" => "sidebar_title_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "14",
            "type" => "range"
        ) ,
        array(
            "name" => __('Title Weight', "mk_framework") ,
            "id" => "sidebar_title_weight",
            "default" => 'bolder',
            "type" => "font_weight"
        ) ,
        array(
            "name" => __('Title Text Case', "mk_framework") ,
            "id" => "sidebar_title_transform",
            "default" => 'uppercase',
            "options" => array(
                "none" => __('None', "mk_framework"),
                "uppercase" => __('Uppercase', "mk_framework"),
                "capitalize" => __('Capitalize', "mk_framework"),
                "lowercase" => __('Lower case', "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __('Text Size', "mk_framework") ,
            "id" => "sidebar_text_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "14",
            "type" => "range"
        ) ,
        array(
            "name" => __('Text Weight', "mk_framework") ,
            "id" => "sidebar_text_weight",
            "default" => 400,
            "type" => "font_weight"
        ) ,
    ) ,
);
