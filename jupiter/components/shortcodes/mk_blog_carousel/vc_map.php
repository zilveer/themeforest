<?php
    vc_map(array(
    "name" => __("Posts Carousel", "mk_framework"),
    "base" => "mk_blog_carousel",
    'icon' => 'icon-mk-blog-carousel vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework'),
    'description' => __( 'Shows blog posts in carousel.', 'mk_framework' ),
    "params" => array(
        array(
            "heading" => __("Choose Post Type", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "post_type",
            "value" => array(
                __("Blog", 'mk_framework') => "post",
                __("News", 'mk_framework') => "news"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Heading Title", "mk_framework"),
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'View All Page', 'mk_framework' ),
            'param_name'  => 'view_all',
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
        ),
        array(
            "type" => "range",
            "heading" => __("How many Posts?", "mk_framework"),
            "param_name" => "count",
            "value" => "10",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("How many Posts would you like to show? (-1 means unlimited)", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Enable Excerpt", "mk_framework"),
            "param_name" => "enable_excerpt",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "post_type",
                'value' => array(
                    'post'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Offset", "mk_framework"),
            "param_name" => "offset",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("Number of post to displace or pass over, it means based on your order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "mk_framework")
        ),

        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Categories', 'mk_framework' ),
            'param_name'  => 'cat',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for category name to get autocomplete suggestions', 'mk_framework' ),
            "dependency" => array(
                'element' => "post_type",
                'value' => array(
                    'post'
                )
            )
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Posts', 'mk_framework' ),
            'param_name'  => 'posts',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
            "dependency" => array(
                'element' => "post_type",
                'value' => array(
                    'post'
                )
            )
        ),

         array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Authors', 'mk_framework' ),
            'param_name'  => 'author',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for user ID, Username, Email Address to get autocomplete suggestions', 'mk_framework' ),
        ),
        array(
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC"

            ),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved Blog items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));