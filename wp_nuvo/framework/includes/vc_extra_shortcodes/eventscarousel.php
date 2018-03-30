<?php
if (class_exists('EM_MS_Globals')) {
    vc_map(array(
        "name" => 'Event Carousel',
        "base" => "cs-event-carousel",
        "icon" => "cs_icon_for_vc",
        "category" => esc_html__('CS Hero', 'wp_nuvo'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__('Title', 'wp_nuvo'),
                "param_name" => "title"
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Heading size", 'wp_nuvo'),
                "param_name" => "heading_size",
                "value" => array(
                    "Default"   => "",
                    "Heading 1" => "h1",
                    "Heading 2" => "h2",
                    "Heading 3" => "h3",
                    "Heading 4" => "h4",
                    "Heading 5" => "h5",
                    "Heading 6" => "h6"
                ),
                "description" => 'Select your heading size for title.'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Sub Title', 'wp_nuvo'),
                "param_name" => "subtitle"
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Heading size", 'wp_nuvo'),
                "param_name" => "subtitle_heading_size",
                "value" => array(
                    "Default"   => "",
                    "Heading 1" => "h1",
                    "Heading 2" => "h2",
                    "Heading 3" => "h3",
                    "Heading 4" => "h4",
                    "Heading 5" => "h5",
                    "Heading 6" => "h6"
                ),
                "description" => 'Select your heading size for sub title.'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Description', 'wp_nuvo'),
                "param_name" => "description"
            ),
            array(
                "type" => "pro_taxonomy",
                "taxonomy" => "event-categories",
                "heading" => esc_html__("Categories", 'wp_nuvo'),
                "param_name" => "category",
                "description" => __("Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo')
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Crop image', 'wp_nuvo'),
                "param_name" => "crop_image",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Crop or not crop image on your Post.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Width image', 'wp_nuvo'),
                "param_name" => "width_image",
                "description" => esc_html__('Enter the width of image. Default: 300.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Height image', 'wp_nuvo'),
                "param_name" => "height_image",
                "description" => esc_html__('Enter the height of image. Default: 200.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Width item', 'wp_nuvo'),
                "param_name" => "width_item",
                "description" => esc_html__('Enter the width of item. Default: 150.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Margin item', 'wp_nuvo'),
                "param_name" => "margin_item",
                "description" => esc_html__('Enter the margin of item. Default: 20.', 'wp_nuvo')
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => esc_html__("Rows", 'wp_nuvo'),
                "param_name" => "rows",
                "value" => array(
                    "1 row" => "1",
                    "2 rows" => "2",
                    "3 rows" => "3",
                    "4 rows" => "4"
                )
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Auto scroll', 'wp_nuvo'),
                "param_name" => "auto_scroll",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Auto scroll.', 'wp_nuvo')
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Same height', 'wp_nuvo'),
                "param_name" => "same_height",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Same height.', 'wp_nuvo')
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Show navigation', 'wp_nuvo'),
                "param_name" => "show_nav",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Show or hide navigation on your carousel post.', 'wp_nuvo')
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Show title', 'wp_nuvo'),
                "param_name" => "show_title",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Show or hide title on your post.', 'wp_nuvo')
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Show date', 'wp_nuvo'),
                "param_name" => "show_date",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Show or hide date of your post.', 'wp_nuvo')
            ),
            array(
                "type" => "checkbox",
                "heading" => esc_html__('Show description', 'wp_nuvo'),
                "param_name" => "show_description",
                "value" => array(
                    esc_html__("Yes, please", 'wp_nuvo') => true
                ),
                "description" => esc_html__('Show or hide description of your post.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Excerpt Length', 'wp_nuvo'),
                "param_name" => "excerpt_length",
                "value" => '',
                "description" => esc_html__('The length of the excerpt, number of words to display. Set to "-1" for no excerpt. Default: 100.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Read More', 'wp_nuvo'),
                "param_name" => "read_more",
                "value" => '',
                "description" => esc_html__('Enter desired text for the link or for no link, leave blank or set to \"-1\".', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Number of posts to show per page', 'wp_nuvo'),
                "param_name" => "posts_per_page",
                'value' => '12',
                "description" => esc_html__('The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'wp_nuvo')
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra class name", 'wp_nuvo'),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wp_nuvo')
            )
        )
    ));
}
