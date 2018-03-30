<?php
$ecommerce_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_woo_single",
    "name" => __("Woocommerce / Single Product", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Woocommerce Single Product Layout", "mk_framework") ,
            "id" => "woocommerce_single_layout",
            "default" => "full",
            "options" => array(
                "left" => __("Left Sidebar", "mk_framework") ,
                "right" => __("Right Sidebar", "mk_framework") ,
                "full" => __("Full Layout", "mk_framework")
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "name" => __("Single Product Page Title", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "woocommerce_single_product_title",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Show Single Social Network", "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "woocommerce_single_social_network",
            "default" => 'true',
            "type" => "toggle"
        ) ,
        array(
            "name" => __("Previous & Next Arrows", "mk_framework") ,
            "desc" => __("Using this option you can turn on/off the navigation arrows when viewing the WooCommerce single page.", "mk_framework") ,
            "id" => "woo_single_prev_next",
            "default" => 'true',
            "type" => "toggle"
        ) ,    
        array(
            "name" => __("Show Previous & Next for Same Categories?", "mk_framework") ,
            "desc" => __("If enabled, the same categories in adjacent posts will be shown.", "mk_framework") ,
            "id" => "woo_prev_next_same_category",
            "default" => 'true',
            "type" => "toggle"
        ) ,
    ) ,
);
