<?php

$general_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_sidebar",
    "name" => __("General / Custom Sidebar", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Create a new sidebar", "mk_framework") ,
            "desc" => __("Enter a name for new sidebar. It must be a valid name which starts with a letter, followed by letters, numbers, spaces, or underscores", "mk_framework") ,
            "id" => "sidebars",
            "default" => '',
            "type" => 'custom_sidebar',
        ) ,
        array(
            "name" => __("Activate Sidebars For Custom Post Types", "mk_framework") ,
            "desc" => __("Select post types you would like assigning custom sidebars for their single page. You can use this option to choose a custom sidebar for your third party plugin post types.", "mk_framework") ,
            "id" => "custom_sidebars",
            "default" => '',
            "options" => Mk_Options_Framework::get_post_types(),
            "type" => 'multiselect',
        ) ,
    ) ,
);
