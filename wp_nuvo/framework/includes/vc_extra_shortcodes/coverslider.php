<?php
vc_map(array(
    "name" => 'Cover Slider',
    "base" => "cs-coverslider",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero', 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__('Title', 'wp_nuvo'),
            "param_name" => "title"
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Description', 'wp_nuvo'),
            "param_name" => "description"
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('From Source', 'wp_nuvo'),
            "param_name" => "source",
            "value" => array(
            	'-Select Source-' => '',
                'Chefs Specials'=>'chefs_specials',
                'Latest Events' => 'latest_events',
                'Custom' => 'custom',
            ),
            "description" => esc_html__('Select source for Slider', 'wp_nuvo')
        ),
        array(
            "type" => "pro_taxonomy",
            "taxonomy" => "restaurantmenu_category",
            "heading" => esc_html__("Categories", 'wp_nuvo'),
            "param_name" => "menucategory",
            "dependency"=> array(
                'element' => 'source',
                'value' => array('chefs_specials')
            ),
            "description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo')
        ),
        array(
            "type" => "pro_taxonomy",
            "taxonomy" => "event-categories",
            "heading" => esc_html__("Categories", 'wp_nuvo'),
            "param_name" => "eventcategory",
            "dependency"=> array(
                'element' => 'source',
                'value' => array('latest_events')
            ),
            "description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Items', 'wp_nuvo'),
            "param_name" => "items",
            "value" => 3,
            "description" => esc_html__('Limit items', 'wp_nuvo'),
            "dependency"=> array(
                'element' => 'source',
                'value' => array('chefs_specials','latest_events')
            )
        ),
        array(
            "type" => "textarea_html",
            "heading" => esc_html__('Custom html', 'wp_nuvo'),
            "param_name" => "content",
            "value" => 3,
            "description" => esc_html__('Only for custom source', 'wp_nuvo'),
            "dependency"=> array(
                'element' => 'source',
                'value' => array('custom')
            )
        )
    )
));