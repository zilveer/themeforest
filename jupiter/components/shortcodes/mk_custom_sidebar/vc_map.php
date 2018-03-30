<?php
vc_map(array(
    "name" => __("Widgetized Sidebar", "mk_framework") ,
    "base" => "mk_custom_sidebar",
    'icon' => 'icon-mk-custom-sidebar vc_mk_element-icon',
    'description' => __('Place Widgetized sidebar', 'mk_framework') ,
    "category" => __('Structure', 'mk_framework') ,
    "params" => array(
        array(
            'type' => 'widgetised_sidebars',
            'heading' => __('Sidebar', 'mk_framework') ,
            'param_name' => 'sidebar',
            'description' => __('Select the widget area to be shown in this sidebar.', 'mk_framework')
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));