<?php
vc_map(array(
    "name" => __("FAQ", "mk_framework") ,
    "base" => "mk_faq",
    'icon' => 'icon-mk-faq vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework') ,
    'description' => __('Shows FAQ posts in multiple styles.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "width" => 150,
            "value" => array(
                __('Fancy', "mk_framework") => "fancy",
                __('Simple', "mk_framework") => "simple"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("[All] Link Title", "mk_framework"),
            "param_name" => "view_all_text",
            "value" => "All",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Sortable?", "mk_framework") ,
            "param_name" => "sortable",
            "value" => "true",
            "description" => __("Disable this option if you do not want sortable filter navigation.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Count", "mk_framework") ,
            "param_name" => "count",
            "value" => "50",
            "min" => "-1",
            "max" => "300",
            "step" => "1",
            "unit" => 'FAQs'
        ) ,
        array(
            "type" => "range",
            "heading" => __("Offset", "mk_framework") ,
            "param_name" => "offset",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("Number of post to displace or pass over. It means based on your order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "mk_framework")
        ) ,
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Categories', 'mk_framework' ),
            'param_name'  => 'faq_cat',
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
            "heading" => __("Order", 'mk_framework') ,
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework') ,
            "param_name" => "order",
            "value" => array(
                __("ASC (ascending order)", 'mk_framework') => "ASC",
                __("DESC (descending order)", 'mk_framework') => "DESC"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => __("Orderby", 'mk_framework') ,
            "description" => __("Sort retrieved FAQ items by parameter.", 'mk_framework') ,
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Pane Content Background Color", "mk_framework") ,
            "param_name" => "background_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
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