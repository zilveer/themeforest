<?php
    vc_map(array(
        "name" => __("Blog Teaser", "mk_framework"),
        "base" => "mk_blog_teaser",
        'icon' => 'icon-mk-blog vc_mk_element-icon',
        "category" => __('Loops', 'mk_framework'),
        'description' => __( 'Blog teaser style loops are here.', 'mk_framework' ),
        "params" => array(
            array(
                'type'        => 'autocomplete',
                'heading'     => __( 'Select specific Categories to Appear in slideshow', 'mk_framework' ),
                'param_name'  => 'slideshow_cat',
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
                'heading'     => __( 'Select specific Categories to appear as Side Thumbnails', 'mk_framework' ),
                'param_name'  => 'side_thumb_cat',
                'settings' => array(
                                    'multiple' => true,
                                    'sortable' => true,
                                    'unique_values' => true,
                                    // In UI show results except selected. NB! You should manually check values in backend
                                ),
                'description' => __( 'Search for category name to get autocomplete suggestions', 'mk_framework' ),
            ), 
            array(
                "type" => "range",
                "heading" => __("Images Height", "mk_framework"),
                "param_name" => "image_height",
                "value" => "350",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px'
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