<?php
$general_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_social_networks_section",
    "name" => __("General / Social Networks Settings", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Header Social Networks Location", "mk_framework") ,
            "desc" => __("Using this option you can set the social network icons location in header or simply disable them.", "mk_framework") ,
            "id" => "header_social_location",
            "default" => 'toolbar',
            "options" => array(
                "toolbar" => __('Header Toolbar', "mk_framework") ,
                "header" => __('Header Section', "mk_framework") ,
                "disable" => __('Disable', "mk_framework") ,
            ) ,
            "type" => "dropdown",

        ) ,
        array(
            "name" => __("Header Social Networks Style", "mk_framework") ,
            "desc" => __("Don't use Simple Rounded, Square Pointed & Square Rounded styles within Header Toolbar", "mk_framework") ,
            "id" => "header_social_networks_style",
            "default" => 'circle',
            "options" => array(
                "circle" => __('Circled', "mk_framework") ,
                "rounded" => __('Rounded', "mk_framework") ,
                "simple" => __('Simple', "mk_framework") ,
                "simple-rounded" => __('Simple Rounded', "mk_framework") ,
                "square-pointed" => __('Square Pointed', "mk_framework") ,
                "square-rounded" => __('Square Rounded', "mk_framework") ,
            ) ,
            "type" => "dropdown",
            "dependency" => array(
                   'element' => "header_social_location",
                   'value' => array(
                       'header',
                       'toolbar'
                   )
            ),  
        ) ,
        array(
            "name" => __("Icons Size", "mk_framework") ,
            "desc" => __("Icon size will be used for outline styles: Simple Rounded, Square Pointed & Square Rounded.", "mk_framework") ,
            "type" => "dropdown",
            "id" => "header_icon_size",
            "default" => "small",
            "options" => array(
                "small" => "Small",
                "medium" => "Medium",
                "large" => "Large",
            ) ,
            "dependency" => array(
                   'element' => "header_social_location",
                   'value' => array(
                       'header'
                   )
            ),   
        ) ,
        array(
            "name" => __("Add New Network", "mk_framework") ,
            "desc" => __("Select your social website and enter the full URL to your profile on the site, then click on add new button. then hit save settings.", "mk_framework") ,
            "id" => "header_social_networks_site",
            "default" => '',
            "type" => 'social_share',
            "dependency" => array(
                   'element' => "header_social_location",
                   'value' => array(
                       'header',
                       'toolbar'
                   )
            ),  
        ) ,
        array(
            "id" => "header_social_networks_url",
            "default" => "",
            "type" => 'hidden_input',
        ) ,
    ) ,
);