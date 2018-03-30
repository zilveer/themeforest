<?php

    vc_map(array(
        "name" => __("Category Showcase", "mk_framework"),
        "base" => "mk_category",
        'icon' => 'vc_mk_element-icon',
        'description' => __( 'Taxonomy Loop for posts, portfolio, news and product categories.', 'mk_framework' ),
        "category" => __('Loops', 'mk_framework'),
        "params" => array(
            array(
                "heading" => __("Choose Loop Feed", 'mk_framework'),
                "description" => __("Using this option you will choose which taxonomy to bring into this loop", 'mk_framework'),
                "param_name" => "feed",
                "value" => array(
                    __("Post Category", 'mk_framework') => "post",
                    __("Portfolio Category", 'mk_framework') => "portfolio",
                    __("Woocommerce Product Category", 'mk_framework') => "product",
                    __("News Category", 'mk_framework') => "news",

                ),
                "type" => "dropdown"
            ),
            array(
                'type'        => 'autocomplete',
                'heading'     => __( 'Select Specific Categories to Show', 'mk_framework' ),
                'param_name'  => 'specific_categories_post',
                'settings' => array(
                                    'multiple' => true,
                                    'sortable' => true,
                                    'unique_values' => true,
                                    // In UI show results except selected. NB! You should manually check values in backend
                                ),
                'description' => __( 'Search for category name to get autocomplete suggestions', 'mk_framework' ),
                "dependency" => array(
                    'element' => "feed",
                    'value' => array(
                        'post'
                    )
                )
            ), 
            array(
                "type" => "textfield",
                "heading" => __("Select Specific Categories", "mk_framework"),
                "param_name" => "specific_categories_other",
                "value" => '',
                "description" => __("You will need to go to Wordpress Dashboard => post type => post type Categories. In the right hand find Slug column and paste them here. add comma to separate them.", "mk_framework"),
                "dependency" => array(
                    'element' => "feed",
                    'value' => array(
                        'product',
                        'portfolio',
                        'news' 
                    )
                )
            ),
             array(
                "heading" => __("Image Size", 'mk_framework'),
                "description" => __("", 'mk_framework'),
                "param_name" => "image_size",
                "value" => mk_get_image_sizes(),
                "type" => "dropdown"
            ),
            /*array(
               "type" => "group_heading",
               "title" => __("Moe Setting?", "mk_framework"),
               "param_name" => "moe_title",
               "style" => "border: 0; font-size: 18px;"
            ),*/
            array(
                "type" => "toggle",
                "heading" => __("Show Description", "mk_framework"),
                "param_name" => "description",
                "value" => "false",
                "description" => __("", "mk_framework")
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework"),
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            ),
            array(
                'type' => 'item_id',
                'heading' => __( 'Item ID', 'mk_framework' ),
                'param_name' => "item_id"
            ),

            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "type" => "group_heading",
                "title" => __("Layout", "mk_framework"),
                "param_name" => "layout_title",
                "style" => "border: 0; font-size: 18px;"
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "type" => "range",
                "heading" => __("How Many Columns?", "mk_framework"),
                "param_name" => "columns",
                "value" => "4",
                "min" => "2",
                "max" => "4",
                "step" => "1",
                "unit" => 'columns',
                "description" => __("How many categories would you like your users to view?", "mk_framework")
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "heading" => __("Layout Style", 'mk_framework'),
                "description" => __("", 'mk_framework'),
                "param_name" => "layout_style",
                "value" => array(
                    __("Grid", 'mk_framework') => "grid",
                    __("Masonry", 'mk_framework') => "masonry"
                ),
                "type" => "dropdown"
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "type" => "range",
                "heading" => __("Row Height", "mk_framework"),
                "param_name" => "row_height",
                "value" => "300",
                "min" => "100",
                "max" => "1000",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework"),
                "dependency" => array(
                    'element' => "layout_style",
                    'value' => array(
                        'grid'
                    )
                )
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "heading" => __("Item Spacing", 'mk_framework'),
                "description" => __("Space between loop items.", 'mk_framework'),
                "param_name" => "gutter",
                "value" => "0",
                "min" => "0",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "type" => "range",
            ),

            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "type" => "group_heading",
                "title" => __("Styles & Animations", "mk_framework"),
                "param_name" => "layout_title",
                "style" => "border: 0; font-size: 18px;"
            ),
             array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "type" => "colorpicker",
                "heading" => __("Title / Description Color", "mk_framework"),
                "param_name" => "text_color",
                "value" => "",
                "description" => __("", "mk_framework")
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "heading" => __("Title / Description Animations  ( on mouse over)", 'mk_framework'),
                "description" => __("", 'mk_framework'),
                "param_name" => "title_hover",
                "value" => array(
                    __("None", 'mk_framework') => "none",
                    __("Simple", 'mk_framework') => "simple",
                    __("Framed", 'mk_framework') => "framed",
                    __("Modern", 'mk_framework') => "modern",
                    __("Editorial", 'mk_framework') => "editorial",
                ),
                "type" => "dropdown",
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "heading" => __("Image Animations  ( on mouse over)", 'mk_framework'),
                "description" => __("", 'mk_framework'),
                "param_name" => "image_hover",
                "value" => array(
                    __("None", 'mk_framework') => "none",
                    __("Blur", 'mk_framework') => "blur",
                    __("Gradient", 'mk_framework') => "gradient",
                    __("Zoom", 'mk_framework') => "zoom",
                    __("Slide", 'mk_framework') => "slide",
                ),
                "type" => "dropdown",
            ),
            array(
                "group" => __('Styles & Colors', 'mk_framework'),
                "type" => "colorpicker",
                "heading" => __("Overlay Color", "mk_framework"),
                "param_name" => "overlay_color",
                "value" => "",
                "description" => __("", "mk_framework")
            ),
        )
    ));