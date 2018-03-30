<?php

$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_header_mobile_skin",
    "name" => __("Coloring / Header Mobile", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Header Background Color', "mk_framework") ,
            "id" => "header_mobile_bg",
            "default" => '',
            "type" => "color"
        ) ,
        array(
            "name" => __('Navigation Background Color', "mk_framework"),
            "id" => 'responsive_nav_color',
            "default" => '#fff',
            "type" => "color"
        ),
        array(
            "name" => __('Navigation Text Color', "mk_framework"),
            "id" => 'responsive_nav_txt_color',
            "default" => '#444444',
            "type" => "color"
        ),
        array(
            "name" => __('Search Form Input Background Color', "mk_framework") ,
            "id" => 'header_mobile_search_input_bg',
            "default" => '',
            "type" => "color"
        ) ,
        array(
            "name" => __('Search Form Input Text Color', "mk_framework") ,
            "id" => 'header_mobile_search_input_color',
            "default" => '',
            "type" => "color"
        ) ,
        array(
            "name" => __('Toolbar Background Color', "mk_framework") ,
            "id" => 'header_mobile_toolbar_bg',
            "default" => '',
            "type" => "color"
        ) ,
        array(
            "name" => __('Toolbar Text Color', "mk_framework") ,
            "id" => 'header_mobile_toolbar_color',
            "default" => '',
            "type" => "color"
        ) ,
        array(
            "name" => __('Toolbar Link Color', "mk_framework") ,
            "id" => 'header_mobile_toolbar_link_color',
            "default" => '',
            "type" => "color"
        ) ,
        array(
            "name" => __('Toolbar Social Icon Color', "mk_framework") ,
            "id" => 'header_mobile_toolbar_social_color',
            "default" => '',
            "type" => "color"
        ) ,

    ) ,
);