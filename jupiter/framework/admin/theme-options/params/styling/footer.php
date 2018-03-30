<?php

$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_footer_skin",
    "name" => __("Styling & Coloring / Footer", "mk_framework") ,
    "desc" => __("Here you can modify coloring of Footer section.", "mk_framework") ,
    "fields" => array(
        array(
        "name" => __('Footer Top Border Thickness', "mk_framework"),
        "id" => "footer_top_thickness",
        "min" => "0",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "0",
        "type" => "range"
    ),
    array(
        "name" => __('Footer Top Border Color', "mk_framework"),
        "id" => "footer_top_border_color",
        "default" => "",
        "type" => "color"
    ),

    array(
        "name" => __('Footer Title Color', "mk_framework"),
        "id" => "footer_title_color",
        "default" => "#fff",
        "type" => "color"
    ),
    array(
        "name" => __('Footer Text Color', "mk_framework"),
        "id" => "footer_text_color",
        "default" => "#808080",
        "type" => "color"
    ),
    array(
        "name" => __('Footer Links Color', "mk_framework"),
        "id" => "footer_links_color",
        "default" => "#999999",
        "type" => "color"
    ),
    array(
        "name" => __('Footer Links Hover Color', "mk_framework"),
        "id" => "footer_links_hover_color",
        "default" => "",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Footer Background Color', "mk_framework"),
        "id" => "sub_footer_bg_color",
        "default" => "#43474d",
        "type" => "color"
    ),
    array(
        "name" => __('Sub Footer Navigation and Copyright Text Color', "mk_framework"),
        "id" => "sub_footer_nav_copy_color",
        "default" => "#8c8e91",
        "type" => "color"
    ),
    ) ,
);