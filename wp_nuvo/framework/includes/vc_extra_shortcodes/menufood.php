<?php
vc_map(array(
    "name" => 'Menu Food',
    "base" => "cs-menufood",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero', 'wp_nuvo'),
    "description" => esc_html__('For Restaurant Menu.', 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "pro_taxonomy",
            "taxonomy" => "restaurantmenu_category",
            "heading" => esc_html__("Categories", 'wp_nuvo'),
            "param_name" => "category",
            "description" => esc_html__("Note : Select a category (default show all).", 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Show/Hidden Category Heading", 'wp_nuvo'),
            "param_name" => "show_hidden_category_heading",
            "value" => array(
                "Show" => "1",
                "Hidden" => "2"
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Category Heading", 'wp_nuvo'),
            "param_name" => "category_heading",
            "value" => array(
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 3" => "h3",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6"
            ),
            "description" => esc_html__('Select your heading size for category title.', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Category Padding', 'wp_nuvo'),
            "param_name" => "category_padding",
            "value" => '60px 0 40px 0',
            "description" => esc_html__('Enter the padding for categories.', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Number posts', 'wp_nuvo'),
            "param_name" => "num_post",
            "value" => '6',
            "description" => esc_html__('Enter the number posts in categories.', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Post Heading", 'wp_nuvo'),
            "param_name" => "post_heading",
            "value" => array(
                "Heading 3" => "h3",
                "Heading 1" => "h1",
                "Heading 2" => "h2",
                "Heading 4" => "h4",
                "Heading 5" => "h5",
                "Heading 6" => "h6"
            ),
            "description" => esc_html__('Select your heading size for post title.', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Layout', 'wp_nuvo'),
            "param_name" => "layout",
            "value" => array(
                'Layout 1' => '1',
                'Layout 2' => '2',
                'Layout 3' => '3'
            )
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Number Colunm (1...4)', 'wp_nuvo'),
            "param_name" => "layout_colunm",
            "value" => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4'
            ),
            "description" => esc_html__('Select the number colunm of menu. Default: 1 colunm (min 1 and max 4)', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Excerpt Length', 'wp_nuvo'),
            "param_name" => "excerpt_length",
            "value" => '',
            "description" => esc_html__('The length of the excerpt, number of words to display.', 'wp_nuvo')
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Show Price', 'wp_nuvo'),
            "param_name" => "show_price",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            )
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Enable Link', 'wp_nuvo'),
            "param_name" => "show_link",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            )
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Show Image', 'wp_nuvo'),
            "param_name" => "image",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            )
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Crop Image', 'wp_nuvo'),
            "param_name" => "crop_image",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            )
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Width image', 'wp_nuvo'),
            "param_name" => "width_image",
            "description" => esc_html__('Enter the width of image. Default: 200.', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Height image', 'wp_nuvo'),
            "param_name" => "height_image",
            "description" => esc_html__('Enter the height of image. Default: 200.', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Order by', 'wp_nuvo'),
            "param_name" => "orderby",
            "value" => array(
                "Default" => "",
                "Title" => "title",
                "Date" => "date",
                "ID" => "ID"
            ),
            "description" => esc_html__('Order by ("Default", "Title", "Create Date", "ID").', 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__('Order', 'wp_nuvo'),
            "param_name" => "order",
            "value" => Array(
                "Default" => "",
                "DESC" => "DESC",
                "ASC" => "ASC"
            ),
            "description" => esc_html__('Order ("Default", "Asc", "Desc").', 'wp_nuvo')
        )
    )
)
);