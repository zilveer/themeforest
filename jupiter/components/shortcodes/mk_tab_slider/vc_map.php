<?php
vc_map(array(
    "name" => __("Tab Slider", "mk_framework") ,
    "base" => "mk_tab_slider",
    'icon' => 'icon-mk-tab-slider vc_mk_element-icon',
    "category" => __('General', 'mk_framework') ,
    'description' => __('Tab based slider.', 'mk_framework') ,
    "params" => array(
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Tabs', 'mk_framework' ),
            'param_name'  => 'tabs',
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
            "description" => __("Sort retrieved slides items by parameter.", 'mk_framework') ,
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => __("Slideshow Speed", "mk_framework") ,
            "param_name" => "autoplay_time",
            "value" => "5000",
            "min" => "0",
            "max" => "50000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("If set to zero the autoplay will be disabled, any number above zeo will define the delay between each slide transition.", "mk_framework") ,
            'type' => 'range'
        ) ,
        $add_css_animations,
        array(
            "heading" => __("Navigation Button Size", "mk_framework") ,
            "param_name" => "button_size",
            "value" => "20",
            "min" => "15",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework") ,
            'type' => 'range'
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Navigation Button Color", "mk_framework") ,
            "param_name" => "button_color",
            "value" => "",
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