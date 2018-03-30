<?php
$advanced_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_export_options",
    "name" => __("Advanced / Export Theme Options", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Export Options", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "theme_export_options",
            "default" => '',
            "type" => "export"
        ) ,
    ) ,
);
