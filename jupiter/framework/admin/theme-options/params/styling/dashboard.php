<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_dashboard_skin",
    "name" => __("Styling & Coloring / Side Dashboard", "mk_framework") ,
    "desc" => __("This section allows you to modify the coloring of Side Dashboard elements.", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Background Color', "mk_framework") ,
            "id" => "dash_bg_color",
            "default" => "#444",
            "type" => "color"
        ) ,
        array(
            "name" => __('Widget Title Color', "mk_framework") ,
            "id" => "dash_title_color",
            "default" => "#fff",
            "type" => "color"
        ) ,
        array(
            "name" => __('Widget Text Color', "mk_framework") ,
            "id" => "dash_text_color",
            "default" => "#eee",
            "type" => "color"
        ) ,
        array(
            "name" => __('Widget Links Color', "mk_framework") ,
            "id" => "dash_links_color",
            "default" => "#fafafa",
            "type" => "color"
        ) ,
        array(
            "name" => __('Widget Links Hover Color', "mk_framework") ,
            "id" => "dash_links_hover_color",
            "default" => "",
            "type" => "color"
        ) ,
        array(
            "name" => __('Navigation Links Color', "mk_framework") ,
            "id" => "dash_nav_link_color",
            "default" => "#fff",
            "type" => "color"
        ) ,
        array(
            "name" => __('Navigation Links Hover Color', "mk_framework") ,
            "id" => "dash_nav_link_hover_color",
            "default" => "#fff",
            "type" => "color"
        ) ,
        array(
            "name" => __('Navigation Links Hover Background Color', "mk_framework") ,
            "id" => "dash_nav_bg_hover_color",
            "default" => "",
            "type" => "color"
        ) ,
    ) ,
);
