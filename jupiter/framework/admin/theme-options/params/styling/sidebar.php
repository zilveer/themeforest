<?php

$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_sidebar_skin",
    "name" => __("Styling & Coloring / Sidebar", "mk_framework") ,
    "desc" => __("This section allows you to modify the coloring of sidebar elements.", "mk_framework") ,
    "fields" => array(
        array(
        "name" => __('Sidebar Title Color', "mk_framework"),
        "id" => "sidebar_title_color",
        "default" => "#333333",
        "type" => "color"
    ),
    array(
        "name" => __('Sidebar Text Color', "mk_framework"),
        "id" => "sidebar_text_color",
        "default" => "#999999",
        "type" => "color"
    ),
    array(
        "name" => __('Sidebar Links Color', "mk_framework"),
        "id" => "sidebar_links_color",
        "default" => "#999999",
        "type" => "color"
    ),
    array(
        "name" => __('Sidebar Links Hover Color', "mk_framework"),
        "id" => "sidebar_links_hover_color",
        "default" => "",
        "type" => "color"
    ),
    ) ,
);