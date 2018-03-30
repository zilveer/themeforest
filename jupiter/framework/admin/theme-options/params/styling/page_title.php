<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_header_banner_skin",
    "name" => __("Styling & Coloring / Page Title", "mk_framework") ,
    "desc" => __("In this section you can modify coloring of Header Page Title and Subtitle.", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Page Title Color', 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "page_title_color",
            "default" => "#4d4d4d",
            "type" => "color"
        ) ,
        array(
            "name" => __("Text Shadow for Title?", "mk_framework") ,
            "desc" => __("If you enable this option 1px gray shadow will appear in page title.", "mk_framework") ,
            "id" => "page_title_shadow",
            "default" => 'false',
            "type" => "toggle"
        ) ,
        array(
            "name" => __('Page Subtitle Color', 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "page_subtitle_color",
            "default" => "#a3a3a3",
            "type" => "color"
        ) ,
        array(
            "name" => __("Breadcrumb Skin", "mk_framework") ,
            "id" => "breadcrumb_skin",
            "default" => 'dark',
            "options" => array(
                "light" => __('For Light Background', "mk_framework") ,
                "dark" => __('For Dark Background', "mk_framework")
            ) ,
            "type" => "radio"
        ) ,
        array(
            "name" => __('Page Title Border Bottom Color', 'mk_framework') ,
            "desc" => __("", "mk_framework") ,
            "id" => "banner_border_color",
            "default" => "#ededed",
            "type" => "color"
        ) ,
    ) 
);
