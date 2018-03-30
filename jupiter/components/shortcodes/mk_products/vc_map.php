<?php
vc_map(array(
    "name" => __("Product Loop", "mk_framework"),
    "base" => "mk_products",
    'icon' => 'vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework'),
    'description' => __( '', 'mk_framework' ),
    "params" => array(
        array(
            "heading" => __("Layout type", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "layout",
            "value" => array(
                __("Compact & Overlay", 'mk_framework') => "compact",
                __("Open & Separated", 'mk_framework') => "open",
            ),
            "type" => "dropdown",
        ),
        array(
            "heading" => __("Columns", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "columns",
            "value" => array(
                __("2 columns", 'mk_framework') => "2",
                __("3 columns", 'mk_framework') => "3",
                __("4 columns", 'mk_framework') => "4",
            ),
            "type" => "dropdown",
        ),
        array(
            "heading" => __("Image Size", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "image_size",
            "value" => mk_get_image_sizes(),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Display", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "display",
            "value" => array(
                __("Recent Products", 'mk_framework') => "recent",
                __("Featured Products", 'mk_framework') => "featured",
                __("Top Rated Products", 'mk_framework') => "top_rated",
                __("Products on Sale", 'mk_framework') => "products_on_sale",
                __("Best Selling Products", 'mk_framework') => "best_sellings"
            ),
            "type" => "dropdown"
        ),
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
        ),
        array(
            "type" => "range",
            "heading" => __("How many Posts?", "mk_framework"),
            "param_name" => "count",
            "value" => "12",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("How many Posts would you like to show? (-1 means unlimited, please note that unlimited will be overrided the limit you defined at : Wordpress Sidebar > Settings > Reading > Blog pages show at most.)", "mk_framework")
        ),

        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved Blog items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown",
            "dependency" => array(
                'element' => "display",
                'value' => array(
                    'top_rated',
                    'products_on_sale',
                    'best_sellings',
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
            "type" => "dropdown",
            "dependency" => array(
                'element' => "display",
                'value' => array(
                    'top_rated',
                    'products_on_sale',
                    'best_sellings',
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Quick view", "mk_framework"),
            "param_name" => "show_quickview",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'open'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Show category in product loop", "mk_framework"),
            "param_name" => "show_category",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'open'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Show rating in product loop", "mk_framework"),
            "param_name" => "show_rating",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'open'
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
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Product Title color", "mk_framework"),
            "param_name" => "color_product_title",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'compact',
                    'open'
                )
            )

        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Product Category color", "mk_framework"),
            "param_name" => "color_product_category",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'open'
                )
            )
        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Product Image Border color", "mk_framework"),
            "param_name" => "color_product_border",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'open'
                )
            )
        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Price color", "mk_framework"),
            "param_name" => "color_product_price",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'compact',
                    'open'
                )
            )
        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Sale Price color", "mk_framework"),
            "param_name" => "color_product_price_sale",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'compact',
                    'open'
                )
            )
        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Orginal Price color", "mk_framework"),
            "param_name" => "color_product_price_orginal",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'compact',
                    'open'
                )
            )
        ),
        array(
            "group" => __('Styles & Colors', 'mk_framework'),
            "type" => "colorpicker",
            "heading" => __("Product rating color", "mk_framework"),
            "param_name" => "color_product_rating",
            "value" => "",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "layout",
                'value' => array(
                    'compact',
                    'open'
                )
            )
        ),
    )
));