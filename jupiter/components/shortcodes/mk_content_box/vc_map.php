<?php
    vc_map(array(
    "name" => __("Content Box", "mk_framework") ,
    "base" => "mk_content_box",
    "as_parent" => array(
        'except' => 'vc_row',
        'mk_page_section'
    ) ,
    "content_element" => true,
    "show_settings_on_create" => false,
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-content-box vc_mk_element-icon',
    'description' => __('Content Box with heading', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title Heading", "mk_framework") ,
            "param_name" => "heading",
            "value" => "",
            "description" => __("Add a title to your container box.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        $add_css_animations,
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    ) ,
    "js_view" => 'VcColumnView'
));