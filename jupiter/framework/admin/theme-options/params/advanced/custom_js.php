<?php
$advanced_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_custom_js",
    "name" => __("Advanced / Custom JS", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Custom JS", "mk_framework") ,
            "desc" => __("You can write your own custom Javascript here in textarea. So you wont need to modify theme files.", "mk_framework") ,
            "id" => "custom_js",
            "default" => '',
            "rows" => 30,
            "type" => "textarea"
        ) ,
    ) ,
);
