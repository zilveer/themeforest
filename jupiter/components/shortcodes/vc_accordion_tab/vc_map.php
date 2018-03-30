<?php
vc_map(array(
    "name" => __("Accordion Section", "mk_framework") ,
    "base" => "vc_accordion_tab",
    "allowed_container_element" => 'vc_row',
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "description" => __("Accordion section title.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name (optional)", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        )
    ) ,
    'js_view' => 'VcAccordionTabView'
));
