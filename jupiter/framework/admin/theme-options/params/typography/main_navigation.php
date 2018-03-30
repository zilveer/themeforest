<?php
$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_main_navigation_typography",
    "name" => __("Typography / Main Navigation", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Main Menu Items Gutter Space', "mk_framework") ,
            "desc" => __("This Value will be applied as padding to left and right of the item.", "mk_framework") ,
            "id" => "main_nav_item_space",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "default" => "20",
            "type" => "range"
        ) ,
        array(
            "name" => __('Top Level Menu Item Text Size', "mk_framework") ,
            "id" => "main_nav_top_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "13",
            "type" => "range"
        ) ,
        array(
            "name" => __('Top Menu Level Text Case', "mk_framework") ,
            "id" => "main_menu_transform",
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
            "name" => __('Top Menu Level Text Weight', "mk_framework") ,
            "id" => "main_nav_top_weight",
            "default" => 600,
            "type" => "font_weight"
        ) ,
        
        array(
            "name" => __('Sub Level Menu Item Text Size', "mk_framework") ,
            "id" => "main_nav_sub_size",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "default" => "12",
            "type" => "range"
        ) ,
        array(
            "name" => __('Sub Menu Level Text Case', "mk_framework") ,
            "id" => "main_nav_sub_transform",
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
            "name" => __('Sub Menu Level Text Weight', "mk_framework") ,
            "id" => "main_nav_sub_weight",
            "default" => 400,
            "type" => "font_weight"
        ) ,
        array(
            "name" => __('Top Level Menu Item Letter Spacing', "mk_framework") ,
            "id" => "main_nav_top_letter_spacing",
            "min" => "0",
            "max" => "5",
            "step" => "1",
            "unit" => 'px',
            "default" => "0",
            "type" => "range"
        ) ,
        array(
            "name" => __('Sub Level Menu Item Letter Spacing', "mk_framework") ,
            "id" => "main_nav_sub_letter_spacing",
            "min" => "0",
            "max" => "5",
            "step" => "1",
            "unit" => 'px',
            "default" => "1",
            "type" => "range"
        ) ,
    ) ,
);
