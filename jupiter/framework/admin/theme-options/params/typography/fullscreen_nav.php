<?php
$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_fullscreen_nav_typography",
    "name" => __("Typography / Full Screen Navigation", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Logo Margin?', "mk_framework") ,
            "desc" => __("This value will be applied as margin-bottom to logo.", "mk_framework") ,
            "id" => "fullscreen_nav_logo_margin",
            "min" => "0",
            "max" => "250",
            "step" => "1",
            "unit" => 'px',
            "default" => "125",
            "type" => "range"
        ) ,
        array(
            "name" => __('Menu Items Gutter Space', "mk_framework") ,
            "desc" => __("This value will be applied as padding to top and bottom of the item.", "mk_framework") ,
            "id" => "fullscreen_nav_menu_gutter",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "default" => "25",
            "type" => "range"
        ) ,
        array(
            "name" => __('Menu Items Font Size', "mk_framework") ,
            "id" => "fullscreen_nav_menu_font_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "16",
            "type" => "range"
        ) ,
        array(
            "name" => __('Menu Items Font Weight', "mk_framework") ,
            "id" => "fullscreen_nav_menu_font_weight",
            "default" => 'bolder',
            "type" => "font_weight"
        ) ,
        array(
            "name" => __('Menu Items Text Case', "mk_framework") ,
            "id" => "fullscreen_nav_menu_text_transform",
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
            "name" => __('Menu Items Letter Spacing', "mk_framework") ,
            "id" => "fullscreen_nav_menu_letter_spacing",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "default" => "0",
            "type" => "range"
        ) ,
    ) ,
);
