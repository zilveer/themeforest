<?php
    vc_map(array(
        "name" => __("Animated Columns", "mk_framework") ,
        "base" => "mk_animated_columns",
        'icon' => 'icon-mk-animated-columns vc_mk_element-icon',
        'description' => __('Columns with cool animations.', 'mk_framework') ,
        "category" => __('General', 'mk_framework') ,
        "params" => array(
            array(
                "type" => "range",
                "heading" => __("Column Height", "mk_framework") ,
                "param_name" => "column_height",
                "value" => "500",
                "min" => "100",
                "max" => "1200",
                "step" => "1",
                "unit" => 'px',
                "description" => __("Set the columns height", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("How many Columns?", "mk_framework") ,
                "param_name" => "column_number",
                "value" => "4",
                "min" => "1",
                "max" => "8",
                "step" => "1",
                "unit" => 'columns',
                "description" => __("How many columns would you like to show in one row?", "mk_framework")
            ) ,

            array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Animated Columns', 'mk_framework' ),
            'param_name'  => 'columns',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
        ),

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
                "description" => __("Sort retrieved pricing items by parameter.", 'mk_framework') ,
                "param_name" => "orderby",
                "value" => $mk_orderby,
                "type" => "dropdown"
            ) ,
            array(
                "type" => "dropdown",
                "heading" => __("Column Content & Style", "mk_framework") ,
                "param_name" => "style",
                "value" => array(
                    "Full featured (All content)" => "full",
                    "Simple (Icon + Title)" => "simple",
                ) ,
                "description" => __("Choose what type of content should be placed inside columns. Each style has different content and hover scenarios.", "mk_framework")
            ) ,
            array(
                'type' => 'range',
                "heading" => __("Title Font Size", "mk_framework") ,
                "param_name" => "title_size",
                "value" => "20",
                "min" => "9",
                "max" => "60",
                "step" => "1",
                "unit" => 'px',
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Columns Border Color", "mk_framework") ,
                "param_name" => "border_color",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Columns background Color", "mk_framework") ,
                "param_name" => "bg_color",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Columns background Hover Color", "mk_framework") ,
                "param_name" => "bg_hover_color",
                "value" => "",
                "description" => __("Columns background color will change to this color once the user's mouse rolls over on a particular column.", "mk_framework")
            ) ,

            array(
                "type" => "dropdown",
                "heading" => __("Icon Size", "mk_framework") ,
                "param_name" => "icon_size",
                "value" => array(
                    __('16px', "mk_framework") => "16",
                    __('32px', "mk_framework") => "32",
                    __('48px', "mk_framework") => "48",
                    __('64px', "mk_framework") => "64",
                    __('128px', "mk_framework") => "128"
                ) ,
                "description" => __("Choose the icon size by pixel.", "mk_framework")
            ) ,

            array(
                "type" => "colorpicker",
                "heading" => __("Icon Color", "mk_framework") ,
                "param_name" => "icon_color",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,

            array(
                "type" => "colorpicker",
                "heading" => __("Icon Hover Color", "mk_framework") ,
                "param_name" => "icon_hover_color",
                "value" => "",
                "description" => __("Columns Icon color will change to this color once the user's mouse rolls over on a particular column.", "mk_framework")
            ) ,

            array(
                "type" => "colorpicker",
                "heading" => __("Text Color (Active)", "mk_framework") ,
                "param_name" => "txt_color",
                "value" => "",
                "description" => __("The color of title and description inside the column. Description text though, is 70% translucent.", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Text Color (Hover)", "mk_framework") ,
                "param_name" => "txt_hover_color",
                "value" => "",
                "description" => __("Column's title and description color will change to this color once the user's mouse rolls over on a particular column.", "mk_framework")
            ) ,

            array(
                "type" => "colorpicker",
                "heading" => __("Button Color (Active)", "mk_framework") ,
                "param_name" => "btn_color",
                "value" => "",
                "description" => __("The color of button inside the column.", "mk_framework")
            ) ,

            array(
                "type" => "colorpicker",
                "heading" => __("Button Color (Hover)", "mk_framework") ,
                "param_name" => "btn_hover_color",
                "value" => "",
                "description" => __("Column's button color will change to this color once the user's mouse rolls over on a particular column.", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Button Text Color (Hover)", "mk_framework") ,
                "param_name" => "btn_hover_txt_color",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            $add_css_animations,

            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework") ,
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            )
        )
    ));