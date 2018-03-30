<?php
vc_map(array(
    "name" => __("Employees", "mk_framework") ,
    "base" => "mk_employees",
    'icon' => 'icon-mk-employees vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework') ,
    'description' => __('Shows Employees posts in multiple styles.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "mk_framework") ,
            "param_name" => "style",
            "width" => 300,
            "value" => array(
                __('Simple', "mk_framework") => "simple",
                __('Boxed', "mk_framework") => "boxed",
                __('Classic', "mk_framework") => "classic"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Column", "mk_framework") ,
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "5",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("Defines how many column to be in one row.", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Rounded Employee's Photo", "mk_framework") ,
            "param_name" => "rounded_image",
            "value" => "true",
            "description" => __("When enabled, employee photos have rounded corners.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Grayscale Employee's Photo", "mk_framework") ,
            "param_name" => "grayscale_image",
            "value" => "true",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Box background Color", "mk_framework") ,
            "param_name" => "box_bg_color",
            "value" => "",
            "description" => __("This option is only for Boxed style.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'boxed'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Box Border Color", "mk_framework") ,
            "param_name" => "box_border_color",
            "value" => "",
            "description" => __("This option is only for Boxed style.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'boxed'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Count", "mk_framework") ,
            "param_name" => "count",
            "value" => "10",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'employee',
            "description" => __("How many Employees you would like to show? (-1 means unlimited)", "mk_framework")
        ) ,
         array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Categories', 'mk_framework' ),
            'param_name'  => 'categories',
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
            'heading'     => __( 'Select specific Employees', 'mk_framework' ),
            'param_name'  => 'employees',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                                // In UI show results except selected. NB! You should manually check values in backend
                            ),
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
        ),
        array(
            "type" => "range",
            "heading" => __("Offset", "mk_framework") ,
            "param_name" => "offset",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("Number of post to displace or pass over. It means based on the order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Description", "mk_framework") ,
            "param_name" => "description",
            "value" => "true",
            "description" => __("If you dont want to show Employees description disable this option.", "mk_framework")
        ) ,
        array(
            "heading" => __("Order", 'mk_framework') ,
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework') ,
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => __("Orderby", 'mk_framework') ,
            "description" => __("Sort retrieved employee items by parameter.", 'mk_framework') ,
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ) ,
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Employee Name Color", "mk_framework") ,
            "param_name" => "name_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => __('Color', 'mk_framework') ,
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Employee Position Color", "mk_framework") ,
            "param_name" => "position_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => __('Color', 'mk_framework') ,
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Employee About Color", "mk_framework") ,
            "param_name" => "about_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => __('Color', 'mk_framework') ,
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Employee Social Color", "mk_framework") ,
            "param_name" => "social_color",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => __('Color', 'mk_framework') ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple',
                    'boxed'
                )
            )
        ),
    )
));
