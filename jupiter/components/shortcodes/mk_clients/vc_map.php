<?php
vc_map(array(
    "name" => __("Clients", "mk_framework") ,
    "base" => "mk_clients",
    'icon' => 'icon-mk-clients vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework') ,
    'description' => __('Shows Clients posts in multiple styles.', 'mk_framework') ,
    "params" => array(
        
        array(
            "heading" => __("Style", 'mk_framework') ,
            "description" => __("Choose clients loop style", 'mk_framework') ,
            "param_name" => "style",
            "value" => array(
                __("Carousel", 'mk_framework') => "carousel",
                __("Column", 'mk_framework') => "column"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => __("Border Style", 'mk_framework') ,
            "description" => __("Choose border style", 'mk_framework') ,
            "param_name" => "border_style",
            "value" => array(
                __("Boxed", 'mk_framework') => "boxed",
                __("Opened Edges", 'mk_framework') => "opened_edges"
            ) ,
            "type" => "dropdown",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'column'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("How many Columns?", "mk_framework") ,
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "6",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("Specify how many columns will be set in one row. This option works only for column style", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'column'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Column Gutter Space", "mk_framework") ,
            "param_name" => "gutter_space",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("The space between columns.", "mk_framework") ,
            "dependency" => array(
                'element' => "border_style",
                'value' => array(
                    'boxed'
                )
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Heading Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Count", "mk_framework") ,
            "param_name" => "count",
            "value" => "10",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'clients',
            "description" => __("How many Clients you would like to show? (-1 means unlimited)", "mk_framework")
        ) ,
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Clients', 'mk_framework' ),
            'param_name'  => 'clients',
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
            "description" => __("Sort retrieved client items by parameter.", 'mk_framework') ,
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Box Background Color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("Color of the box containing the client's logo", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Box Hover Background Color", "mk_framework") ,
            "param_name" => "bg_hover_color",
            "value" => "",
            "description" => __("Hover color of the box containing the client's logo", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Box Border Color", "mk_framework") ,
            "param_name" => "border_color",
            "value" => "",
            "description" => __("Border color of the box containing the client's logo", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Fit to Background", "mk_framework") ,
            "description" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area", "mk_framework") ,
            "param_name" => "cover",
            "value" => "false"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Logos Height", "mk_framework") ,
            "param_name" => "height",
            "value" => "110",
            "min" => "50",
            "max" => "300",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can change logos height using this option.", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Autoplay?", "mk_framework") ,
            "param_name" => "autoplay",
            "value" => "true",
            "description" => __("Disable this option if you do not want the client slideshow to autoplay.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Target", "mk_framework") ,
            "param_name" => "target",
            "width" => 200,
            "value" => $target_arr,
            "description" => __("Target for the links.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
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