<?php
vc_map(array(
    "name" => __("Pricing Table (Builder)", "mk_framework"),
    "base" => "mk_pricing_table_2",
    'icon' => 'icon-mk-pricing-table vc_mk_element-icon',
    'description' => __( 'Shows Pricing table Posts.', 'mk_framework' ),
    "category" => __('Loops', 'mk_framework'),
    "params" => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "heading" => __("Offers", "mk_framework"),
            "param_name" => "content",
            "value" => "",
            "description" => __("Please add your 'offers' text. Note : List of offers must be an unordered list. If you dont need offers list, leave this field empty. The number of the list items should match the number of your pricing items list as well.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("How Many Tables?", "mk_framework"),
            "param_name" => "table_number",
            "value" => "4",
            "min" => "1",
            "max" => "4",
            "step" => "1",
            "unit" => 'table',
            "description" => __("How many pricing tables would you like your users to view?", "mk_framework")
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Tables', 'mk_framework' ),
            'param_name'  => 'tables',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
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
            "description" => __("Sort retrieved pricing items by parameter.", 'mk_framework'),
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