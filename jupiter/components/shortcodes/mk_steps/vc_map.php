<?php

vc_map(array(
    "name" => __("Process Builder", "mk_framework") ,
    "base" => "mk_steps",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-process-builder vc_mk_element-icon',
    'description' => __('Adds process steps element.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("How Many Steps?", "mk_framework") ,
            "param_name" => "step",
            "value" => "4",
            "min" => "2",
            "max" => "5",
            "step" => "1",
            "unit" => 'step',
            "description" => __("How many steps for the whole process? Each represented in a circular container.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Container Hover Color", "mk_framework") ,
            "param_name" => "hover_color",
            "value" => $skin_color,
            "description" => __("This color will be showed up once user rolls over the circular container.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 1 : Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon_1",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 1 : Title", "mk_framework") ,
            "param_name" => "title_1",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 1 : Description", "mk_framework") ,
            "param_name" => "desc_1",
            'margin_bottom' => 40,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 1 : Link", "mk_framework") ,
            "param_name" => "url_1",
            'margin_bottom' => 30,
            "value" => "",
            "description" => __("If you add a URL the title will be converted to a link. add http://", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 2 : Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon_2",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 2 : Title", "mk_framework") ,
            "param_name" => "title_2",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 2 : Description", "mk_framework") ,
            "param_name" => "desc_2",
            'margin_bottom' => 40,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 2 : Link", "mk_framework") ,
            "param_name" => "url_2",
            'margin_bottom' => 30,
            "value" => "",
            "description" => __("If you add a URL the title will be converted to a link. add http://", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 3 : Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon_3",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 3 : Title", "mk_framework") ,
            "param_name" => "title_3",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 3 : Description", "mk_framework") ,
            "param_name" => "desc_3",
            'margin_bottom' => 40,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 3 : Link", "mk_framework") ,
            "param_name" => "url_3",
            'margin_bottom' => 30,
            "value" => "",
            "description" => __("If you add a URL the title will be converted to a link. add http://", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 4 : Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon_4",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 4 : Title", "mk_framework") ,
            "param_name" => "title_4",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 4 : Description", "mk_framework") ,
            "param_name" => "desc_4",
            'margin_bottom' => 40,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 4 : Link", "mk_framework") ,
            "param_name" => "url_4",
            'margin_bottom' => 30,
            "value" => "",
            "description" => __("If you add a URL the title will be converted to a link. add http://", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 5 : Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon_5",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 5 : Title", "mk_framework") ,
            "param_name" => "title_5",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 5 : Description", "mk_framework") ,
            "param_name" => "desc_5",
            'margin_bottom' => 40,
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Step 5 : Link", "mk_framework") ,
            "param_name" => "url_5",
            'margin_bottom' => 30,
            "value" => "",
            "description" => __("If you add a URL the title will be converted to a link. add http://", "mk_framework")
        ) ,
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));