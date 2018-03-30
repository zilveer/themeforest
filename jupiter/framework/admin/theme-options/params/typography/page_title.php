<?php
$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_page_introduce_typography",
    "name" => __("Typography / Page Title", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Page Title Size', 'mk_framework') ,
            "id" => "page_introduce_title_size",
            "min" => "10",
            "max" => "120",
            "step" => "1",
            "unit" => 'px',
            "default" => "20",
            "type" => "range"
        ) ,
        array(
            "name" => __('Page Title Letter Spacing', 'mk_framework') ,
            "id" => "page_introduce_title_letter_spacing",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "default" => "2",
            "type" => "range"
        ) ,
        array(
            "name" => __('Page Title Weight', 'mk_framework') ,
            "id" => "page_introduce_weight",
            "default" => 400,
            "type" => "font_weight"
        ) ,
        array(
            "name" => __('Page Title Text Case', "mk_framework") ,
            "id" => "page_title_transform",
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
            "name" => __("Show Page Title", "mk_framework") ,
            "desc" => __("Using this option you can turn on/off page title throughout the site.", "mk_framework") ,
            "id" => "page_title_global",
            "default" => 'true',
            "type" => "toggle",
        ) ,
        array(
            "name" => __('Page Subtitle Size', 'mk_framework') ,
            "id" => "page_introduce_subtitle_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "14",
            "type" => "range"
        ) ,
        array(
            "name" => __('Page Subtitle Text Case', "mk_framework") ,
            "id" => "page_introduce_subtitle_transform",
            "default" => 'none',
            "options" => array(
                "none" => __('None', "mk_framework"),
                "uppercase" => __('Uppercase', "mk_framework"),
                "capitalize" => __('Capitalize', "mk_framework"),
                "lowercase" => __('Lower case', "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
    ) ,
);
