<?php
vc_map(array(
    "name" => __("Header", "mk_framework") ,
    "base" => "mk_header",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'vc_mk_element-icon',
    'description' => __('Adds header to anywhere in the content.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Header Style", "mk_framework") ,
            "param_name" => "style",
            "value" => array(
                __('1', "mk_framework") => "1",
                __('3', "mk_framework") => "3",
            ) ,
            "description" => __("In header shortcode you can only choose header style 1 and 3.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Header Align", "mk_framework") ,
            "param_name" => "align",
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Center', "mk_framework") => "center",
                __('Right', "mk_framework") => "right",
            ) ,
            "description" => __("", "mk_framework")
        ) ,

        array(
            "heading" => __("Hover Style", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "hover_styles",
            "value" => array(
                'header-hover-1.jpg' => "1",
                'header-hover-2.jpg' => "2",
                'header-hover-3.jpg' => "3",
                'header-hover-4.jpg' => "4",
                'header-hover-5.jpg' => "5",
            ) ,
            "type" => "visual_selector",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    '1'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Menu Location", "mk_framework") ,
            "param_name" => "menu_location",
            "value" => array(
                __('Primary Navigation', "mk_framework") => "primary-menu",
                __('Second Navigation', "mk_framework") => "second-menu",
                __('Third Navigation', "mk_framework") => "third-menu",
                __('Fourth Navigation', "mk_framework") => "fourth-menu",
                __('Fifth Navigation', "mk_framework") => "fifth-menu",
                __('Sixth Navigation', "mk_framework") => "sixth-menu",
                __('Seventh Navigation', "mk_framework") => "seventh-menu",
                __('Eighth Navigation', "mk_framework") => "eighth-menu",
                __('Ninth Navigation', "mk_framework") => "ninth-menu",
                __('tenth Navigation', "mk_framework") => "tenth-menu",
            ) ,
            "description" => __("", "mk_framework")
        ) ,

        array(
            "type" => "toggle",
            "heading" => __("Show Logo?", "mk_framework") ,
            "param_name" => "logo",
            "value" => "true",
            "description" => __("Using this option you can toggle on/off logo from header.", "mk_framework") ,
        ) ,

        array(
            "type" => "toggle",
            "heading" => __("Burger Icon", "mk_framework") ,
            "param_name" => "burger_icon",
            "value" => "true",
            "description" => __("Enable this option if you would like to have secondary menu. This menu will pop up once the burger icon is clicked. To change secondary menu settings go to: Theme Options > General > Header > Secondary Menu Settings", "mk_framework") ,
        ) ,

        array(
            "type" => "toggle",
            "heading" => __("Show Search Icon?", "mk_framework") ,
            "param_name" => "search_icon",
            "value" => "true",
            "description" => __("Using this option you can toggle on/off the search icon that triggers header search form.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    '1'
                )
            )
        ) ,

        array(
            "type" => "toggle",
            "heading" => __("Show WooCommerce Cart?", "mk_framework") ,
            "param_name" => "woo_cart",
            "value" => "true",
            "description" => __("Using this option you can toggle on/off the WooCommerce cart icon that shows the list of added products into shopping cart.", "mk_framework") ,
        ) ,

        
        
        array(
            "type" => "colorpicker",
            "heading" => __("Header Background Color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Header Border Color", "mk_framework") ,
            "param_name" => "border_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Header Links Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Links Hover Skin", "mk_framework") ,
            "param_name" => "text_hover_skin",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ) ,
    )
));
