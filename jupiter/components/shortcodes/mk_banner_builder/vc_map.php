<?php
vc_map(array(
    "name" => __("Banner Builder", "mk_framework"),
    "base" => "mk_banner_builder",
    'icon' => 'icon-mk-custom-box vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Banner Builder.', 'mk_framework' ),
    //'deprecated' => '4.9',
    "params" => array(
         array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Posts', 'mk_framework' ),
            'param_name'  => 'slides',
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
            "heading" => __("Min Height", "mk_framework"),
            "param_name" => "height",
            "value" => "200",
            "min" => "50",
            "max" => "1200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("You can adjust a min height to avoid height changes between your slide items which may distract the viewer.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Top & Bottom Padding", "mk_framework"),
            "param_name" => "padding",
            "value" => "30",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This option will help you to give your own custom vertical spacing.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Animation Style", "mk_framework"),
            "param_name" => "animation_style",
            "width" => 300,
            "value" => array(
                __('Fade', "mk_framework") => "fade",
                __('Slide', "mk_framework") => "slide"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("ASC (ascending order)", 'mk_framework') => "ASC",
                __("DESC (descending order)", 'mk_framework') => "DESC"
            ),
            "type" => "dropdown"
        ),
        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved slides items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),

        array(
            "type" => "toggle",
            "heading" => __("Autoplay", "mk_framework"),
            "param_name" => "autoplay",
            "value" => "true",
            "description" => __("Enable this option if you would like slider to autoplay.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Slideshow Speed", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "5000",
            "min" => "2000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("Time elapsed between each autoplay sliding case.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Animation Duration", "mk_framework"),
            "param_name" => "animation_duration",
            "value" => "600",
            "min" => "200",
            "max" => "10000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("Speed of animation.", "mk_framework")
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