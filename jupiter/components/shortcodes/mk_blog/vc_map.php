<?php

vc_map(array(
    "name" => __("Blog", "mk_framework"),
    "base" => "mk_blog",
    'icon' => 'icon-mk-blog vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework'),
    'description' => __( 'Blog loops are here.', 'mk_framework' ),
    "params" => array(
        array(
            "heading" => __("Style", 'mk_framework'),
            "description" => __("Select which blog loop style you would like to use.", 'mk_framework'),
            "param_name" => "style",
            "value" => array(
                __("Modern", 'mk_framework') => "modern",
                __("Classic", 'mk_framework') => "classic",
                __("Newspaper", 'mk_framework') => "newspaper",
                __("Grid", 'mk_framework') => "grid",
                __("Spotlight", 'mk_framework') => "spotlight",
                __("Thumbnail", 'mk_framework') => "thumbnail",
                __("Magazine", 'mk_framework') => "magazine",
            ),
            "type" => "dropdown"
        ),

        array(
            "heading" => __("Blog Post Formats to Exclude", 'mk_framework'),
            "description" => __("Using this option you may want to exclude post Formats you do not want to show in this blog feed.", 'mk_framework'),
            "param_name" => "exclude_post_format",
            "options" => array(
                "image" => __('Image', "mk_framework") ,
                "video" => __('Video', "mk_framework") ,
                "audio" => __('Audio', "mk_framework") ,
                "portfolio" => __('Portfolio', "mk_framework") ,
                "twitter" => __('Twitter', "mk_framework") ,
                "blockquote" => __('Blockquote', "mk_framework") ,
                "instagram" => __('Instagram', "mk_framework") ,
            ),
            "type" => "multiselect"
        ),

             

        array(
            "type" => "range",
            "heading" => __("How many Columns?", "mk_framework"),
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "4",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("This option defines how many columns will be set in one row. Column only works for newspaper and grid styles.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid',
                    'newspaper',
                    'spotlight'
                )
            )
        ),
        array(
            "heading" => __("Thumbnail Align", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "thumbnail_align",
            "value" => array(
                __("Left", 'mk_framework') => "left",
                __("Right", 'mk_framework') => "right"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'thumbnail'
                )
            )
        ),
        array(
            "heading" => __("Magazine Style Align", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "magazine_strcutre",
            "value" => array(
                __("One Column", 'mk_framework') => 1,
                __("Two Columns (Featured post on left side)", 'mk_framework') => 2,
                __("Two Columns (Featured post on right side)", 'mk_framework') => 3,
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'magazine'
                )
            )
        ),
        array(
            "heading" => __("Image Size", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "image_size",
            "value" => mk_get_image_sizes(),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'modern',
                    'classic',
                    'newspaper',
                    'grid',
                    'spotlight',
                    'magazine',
                    'thumbnail'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Images Height", "mk_framework"),
            "param_name" => "grid_image_height",
            "value" => "350",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This option works only when you choose 'Resize & Crop' from the option above.", "mk_framework"),
            "dependency" => array(
                'element' => "image_size",
                'value' => array(
                    'crop'
                )
            ),array(
                'element' => "style",
                'value' => array(
                    'modern',
                    'classic',
                    'newspaper',
                    'grid',
                    'spotlight'
                )
            )
        ),

        array(
            "type" => "range",
            "heading" => __("How many Posts?", "mk_framework"),
            "param_name" => "post_count",
            "value" => "10",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("How many Posts would you like to show? (-1 means unlimited, please note that unlimited will be overrided the limit you defined at : Wordpress Sidebar > Settings > Reading > Blog pages show at most.)", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Offset", "mk_framework"),
            "param_name" => "post_offset",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("Number of posts to displace or pass over, it means based on your order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "mk_framework")
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Categories', 'mk_framework' ),
            'param_name'  => 'cat',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                                // In UI show results except selected. NB! You should manually check values in backend
                            ),
            'description' => __( 'Search for category name to get autocomplete suggestions', 'mk_framework' ),
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Posts', 'mk_framework' ),
            'param_name'  => 'posts',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                                // In UI show results except selected. NB! You should manually check values in backend
                            ),
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
        ),

        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Authors', 'mk_framework' ),
            'param_name'  => 'author',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                                // In UI show results except selected. NB! You should manually check values in backend
                            ),
            'description' => __( 'Search for user ID, Username, Email Address to get autocomplete suggestions', 'mk_framework' ),
        ),

        array(
            "type" => "toggle",
            "heading" => __("Transparent Border", "mk_framework"),
            "param_name" => "transparent_border",
            "value" => "false",
            "description" => __("Enable this option to remove borders", "mk_framework"),     
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ),

        array(
            "type" => "toggle",
            "heading" => __("Show Date?", "mk_framework"),
            "param_name" => "disable_meta",
            "value" => "true",
            "description" => __("Disable this option if you do not want to show post date.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Comments Count & Social Share", "mk_framework"),
            "param_name" => "comments_share",
            "value" => "true",
            "description" => __("Using this option you can disable Shocial Share and comments count from Blog loop.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'newspaper',
                    'classic',
                    'magazine'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Full Content in Blog Loop?", "mk_framework"),
            "param_name" => "full_content",
            "value" => "false",
            "description" => __("If you enable this option instead of blog excerpt the full post content will be shown.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'modern',
                    'classic',
                    'newspaper',
                    'grid'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Post Excerpt Length", "mk_framework"),
            "description" => __("Define the length of the excerpt by number of characters. Zero will disable excerpt.", 'mk_framework'),
            "param_name" => "excerpt_length",
            "value" => "200",
            "min" => "0",
            "max" => "2000",
            "step" => "1",
            "unit" => 'characters',
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'classic',
                    'modern',
                    'grid',
                    'newspaper',
                    'thumbnail'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Pagination?", "mk_framework"),
            "param_name" => "pagination",
            "value" => "true",
            "description" => __("Disable this option if you do not want pagination for this loop.", "mk_framework"),
        ),
        array(
            "heading" => __("Pagination Style", 'mk_framework'),
            "description" => __("Select which pagination style you would like to use on this loop.", 'mk_framework'),
            "param_name" => "pagination_style",
            "value" => array(
                __("Classic Pagination Navigation", 'mk_framework') => "1",
                __("Load more button", 'mk_framework') => "2",
                __("Load more on page scroll", 'mk_framework') => "3"
            ),
            "type" => "dropdown",
             "dependency" => array(
             'element' => "pagination",
             'value' => array(
                    'true',
                )
            )
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
        ),
    )
));