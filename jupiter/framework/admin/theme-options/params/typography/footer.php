<?php
$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_footer_typography",
    "name" => __("Typography / Footer", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Footer Title Size', "mk_framework") ,
            "id" => "footer_title_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "14",
            "type" => "range"
        ) ,
        array(
            "name" => __('Footer Title Weight', "mk_framework") ,
            "id" => "footer_title_weight",
            "default" => 'bolder',
            "type" => "font_weight"
        ) ,
        array(
            "name" => __('Footer Title Text Case', "mk_framework") ,
            "id" => "footer_title_transform",
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
            "name" => __('Footer Text Size', "mk_framework") ,
            "id" => "footer_text_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "14",
            "type" => "range"
        ) ,
        array(
            "name" => __('Footer Text Weight', "mk_framework") ,
            "id" => "footer_text_weight",
            "default" => 400,
            "type" => "font_weight"
        ) ,
        array(
            "name" => __('Footer Copyright Font Size', "mk_framework") ,
            "id" => "copyright_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "11",
            "type" => "range"
        ) ,
        array(
            "name" => __('Footer Copyright Letter Spacing', "mk_framework") ,
            "id" => "copyright_letter_spacing",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "default" => "1",
            "type" => "range"
        ) ,
    ) ,
);
