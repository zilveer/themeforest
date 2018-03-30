<?php
vc_map(array(
    "name" => __("News Tab", "mk_framework") ,
    "base" => "mk_news_tab",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-news-tab vc_mk_element-icon',
    'description' => __('News feed in tabs style.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget Title", "mk_framework") ,
            "param_name" => "widget_title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Tab Title", "mk_framework") ,
            "param_name" => "tab_title",
            "value" => "News",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Mobile Friendly Tabs?", "mk_framework") ,
            "description" => __("If enabled tabs functionality will removed in mobile devices, each tab and its content will be inserted below each other.", "mk_framework") ,
            "param_name" => "responsive",
            "value" => array(
                "Yes please!" => "true",
                "No!" => "false"
            ) ,
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));