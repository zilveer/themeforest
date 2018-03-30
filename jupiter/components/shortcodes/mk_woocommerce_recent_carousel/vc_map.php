<?php
if (class_exists('woocommerce')) {
    vc_map(array(
        "base" => "mk_woocommerce_recent_carousel",
        "name" => __("WooCommerce Carousel", "mk_framework") ,
        "category" => __('Plugins', 'mk_framework') ,
        'icon' => 'icon-mk-woo-recent-carousel vc_mk_element-icon',
        "params" => array(
            array(
                "heading" => __("Style", 'mk_framework') ,
                "description" => __("", 'mk_framework') ,
                "param_name" => "style",
                "value" => array(
                    __("Modern", 'mk_framework') => "modern",
                    __("Classic", 'mk_framework') => "classic"
                ) ,
                "type" => "dropdown"
            ) ,
            array(
                "type" => "textfield",
                "heading" => __("Title", "mk_framework") ,
                "param_name" => "title",
                "value" => "New Arrivals",
                "dependency" => array(
                    'element' => "style",
                    'value' => array(
                        'classic'
                    )
                )
            ) ,
            array(
                "heading" => __("Image Size", 'mk_framework') ,
                "description" => __("Please note that this option only only works for Modern Style", 'mk_framework') ,
                "param_name" => "image_size",
                "value" => mk_get_image_sizes(false, false, 'Woocommerce Recent Carousel'),
                "type" => "dropdown",
                "dependency" => array(
                    'element' => "style",
                    'value' => array(
                        'modern',
                    )
                )
            ) ,
            array(
                "type" => "toggle",
                "heading" => __("Featured Products?", "mk_framework") ,
                "param_name" => "featured",
                "value" => "false",
                "description" => __("Enable this option if you want to show featured products.", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Products Per View", "mk_framework") ,
                "param_name" => "per_view",
                "value" => "3",
                "min" => "1",
                "max" => "8",
                "step" => "1",
                "unit" => 'products',
                "description" => __("", "mk_framework") ,
                "dependency" => array(
                    'element' => "style",
                    'value' => array(
                        'modern'
                    )
                )
            ) ,
            array(
                'type'        => 'autocomplete',
                'heading'     => __( 'Select specific Categories', 'mk_framework' ),
                'param_name'  => 'category',
                'settings' => array(
                                    'multiple' => true,
                                    'sortable' => true,
                                    'unique_values' => true,
                                ),
                'description' => __( 'Search for category name to get autocomplete suggestions', 'mk_framework' ),
                 "dependency" => array(
                    'element' => "style",
                    'value' => array(
                        'modern'
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
                    'element' => "style",
                    'value' => array(
                        'modern'
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
                 "dependency" => array(
                    'element' => "style",
                    'value' => array(
                        'modern'
                    )
                )
            ),
            array(
                "type" => "range",
                "heading" => __("How many Posts?", "mk_framework") ,
                "param_name" => "per_page",
                "value" => "-1",
                "min" => "-1",
                "max" => "50",
                "step" => "1",
                "unit" => 'posts',
                "description" => __("How many Posts you would like to show? ( -1 means unlimited, please note that unlimited will be overridden by the limit you defined at : Wordpress Sidebar > Settings > Reading > Blog pages show at most.)", "mk_framework")
            ) ,
            array(
                "heading" => __("Order", 'mk_framework') ,
                "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework') ,
                "param_name" => "order",
                "value" => array(
                    __("DESC (descending order)", 'mk_framework') => "DESC",
                    __("ASC (ascending order)", 'mk_framework') => "ASC",
                ) ,
                "type" => "dropdown"
            ) ,
            array(
                "heading" => __("Orderby", 'mk_framework') ,
                "description" => __("Sort retrieved Woocommerce items by parameter.", 'mk_framework') ,
                "param_name" => "orderby",
                "value" => $mk_orderby,
                "type" => "dropdown"
            ) ,
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework") ,
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            )
        )
    ));
}
