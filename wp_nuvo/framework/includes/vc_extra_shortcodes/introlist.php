<?php
vc_map(array(
    "name" => esc_html__("Intro List", 'wp_nuvo'),
    "base" => "cs-introlist",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero', 'wp_nuvo'),
    "description" => esc_html__("Intro Posts.", 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "pro_taxonomy",
            "taxonomy" => "category",
            "heading" => esc_html__("Categories", 'wp_nuvo'),
            "param_name" => "category",
            "description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo')
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( 'Excerpt Length', 'wp_nuvo' ),
            "param_name" => "excerpt_length",
            "value" => '',
            "description" => __ ( 'The length of the excerpt, number of words to display. null for no excerpt.', 'wp_nuvo' )
        ),
        array (
            "type" => "checkbox",
            "heading" => __ ( 'Crop Big Images', 'wp_nuvo' ),
            "param_name" => "crop_big",
            "value" => array (
                __ ( "Yes, please", 'wp_nuvo' ) => true
            ),
            "description" => __ ( 'Crop or not crop image on your Post.', 'wp_nuvo' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( 'Width image', 'wp_nuvo' ),
            "param_name" => "big_width",
            "description" => __ ( 'Enter the width of image. Default: 465.', 'wp_nuvo' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( 'Height image', 'wp_nuvo' ),
            "param_name" => "big_height",
            "description" => __ ( 'Enter the height of image. Default: 340.', 'wp_nuvo' )
        ),
        array (
            "type" => "checkbox",
            "heading" => __ ( 'Crop Mini Images', 'wp_nuvo' ),
            "param_name" => "crop_mini",
            "value" => array (
                __ ( "Yes, please", 'wp_nuvo' ) => true
            ),
            "description" => __ ( 'Crop or not crop image on your Post.', 'wp_nuvo' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( 'Width image', 'wp_nuvo' ),
            "param_name" => "mini_width",
            "description" => __ ( 'Enter the width of image. Default: 465.', 'wp_nuvo' )
        ),
        array (
            "type" => "textfield",
            "heading" => __ ( 'Height image', 'wp_nuvo' ),
            "param_name" => "mini_height",
            "description" => __ ( 'Enter the height of image. Default: 170.', 'wp_nuvo' )
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( 'Order by', 'wp_nuvo' ),
            "param_name" => "orderby",
            "value" => array (
                "None" => "none",
                "Title" => "title",
                "Date" => "date",
                "ID" => "ID"
            ),
            "description" => __ ( 'Order by ("none", "title", "date", "ID").', 'wp_nuvo' )
        ),
        array (
            "type" => "dropdown",
            "heading" => __ ( 'Order', 'wp_nuvo' ),
            "param_name" => "order",
            "value" => Array (
                "None" => "none",
                "ASC" => "ASC",
                "DESC" => "DESC"
            ),
            "description" => __ ( 'Order ("None", "Asc", "Desc").', 'wp_nuvo' )
        ),
    )
));
?>