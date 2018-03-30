<?php
$styling_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_fullscreen_nav_skin",
    "name" => __("Styling & Coloring / Full Screen Navigation", "mk_framework") ,
    "desc" => __("This section allows you to modify the coloring of Full Screen navigation.", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __('Logo', "mk_framework") ,
            "id" => "fullscreen_nav_logo",
            "default" => 'dark',
            "options" => array(
                "none" => __('None', "mk_framework"),
                "light" => __('light', "mk_framework"),
                "dark" => __('Dark', "mk_framework"),
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __('Background Color', "mk_framework") ,
            "id" => "fullscreen_nav_bg_color",
            "default" => "#444",
            "type" => "color"
        ) ,
        array(
            "name" => __('Link Color', "mk_framework") ,
            "id" => "fullscreen_nav_link_color",
            "default" => "#fff",
            "type" => "color"
        ) ,
        array(
            "name" => __('Link Hover Color', "mk_framework") ,
            "id" => "fullscreen_nav_link_hov_color",
            "default" => "#444",
            "type" => "color"
        ) ,
        array(
            "name" => __('Link Hover Background Color', "mk_framework") ,
            "id" => "fullscreen_nav_link_hov_bg_color",
            "default" => "#fff",
            "type" => "color"
        ) ,
        array(
            "name" => __('Close Button Skin', "mk_framework") ,
            "id" => "fullscreen_close_btn_skin",
            "default" => 'light',
            "options" => array(
                "light" => __('light', "mk_framework"),
                "dark" => __('Dark', "mk_framework"),
            ) ,
            "type" => "dropdown"
        ) ,
    ) ,
);
