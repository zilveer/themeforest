<?php
vc_map(array(
    "name" => 'Post Columns',
    "base" => "cs-post-columns",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero', 'wp_nuvo'),
    "description" => __ ( 'Show list Post by Category', 'wp_nuvo' ),
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
            "type" => "pro_taxonomy",
            "taxonomy" => "category",
            "heading" => esc_html__("Categories", 'wp_nuvo'),
            "param_name" => "category",
            "description" => esc_html__("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => esc_html__("Colunm", 'wp_nuvo'),
            "param_name" => "colunm",
            "value" => array(
                "1" => "1",
                "2" => "2",
                "3" => "3",
                "4" => "4"
            )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Number of posts to show per page', 'wp_nuvo'),
            "param_name" => "posts_per_page",
            'value' => '6',
            "description" => esc_html__('The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'wp_nuvo')
        )
    )
));