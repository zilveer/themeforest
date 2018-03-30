<?php
vc_map(array(
    "name" => __("Edge Slider", "mk_framework"),
    "base" => "mk_edge_slider",
    'icon' => 'icon-mk-edge-slider vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework'),
    'description' => __( 'Powerful Edge Slider.', 'mk_framework' ),
    "params" => array(
        array(
            "type" => "toggle",
            "heading" => __("First Element?", "mk_framework"),
            "param_name" => "first_el",
            "value" => "false",
            "description" => __("If you are not using this slideshow as first element in content then disable this option. This option is useful only when Transparent Header style is enabled in this page, having this option enabled will allow the header skin follow slide item's => header skin.", "mk_framework")
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Slideshow Background Color", "mk_framework"),
            "param_name" => "swiper_bg",
            "value" => "#000",
            "description" => __("Choose it for a color behind the slides. Useful with some animation types where background is revealed.", "mk_framework")
        ),

        array(
            "type" => "toggle",
            "heading" => __("Parallax Background?", "mk_framework"),
            "param_name" => "parallax",
            "value" => "false",
            "description" => __("Please note that Smooth Scroll option should be enabled for the parallax feature function correctly. Smooth Scroll option is loctated in Theme Options > General Settings > Global > Smooth Scroll.", "mk_framework")
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select Specific Slides', 'mk_framework' ),
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
            "heading" => __("Order", 'mk_framework'),
            "description" => __("Designates the ascending or descending order of the 'orderby' parameter.", 'mk_framework'),
            "param_name" => "order",
            "value" => array(
                __("DESC (descending order)", 'mk_framework') => "DESC",
                __("ASC (ascending order)", 'mk_framework') => "ASC",
                
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
            "heading" => __("Full Height?", "mk_framework"),
            "param_name" => "full_height",
            "value" => "true",
            "description" => __("If you do not want full screen height slideshow disable this option. If you disable this option set the height of slideshow using below option.", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Slideshow Height", "mk_framework"),
            "param_name" => "height",
            "value" => "700",
            "min" => "100",
            "max" => "2000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("This option only works when above option is disabled.", "mk_framework")
        ),
        array(
            "heading" => __("Animation Effect", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "animation_effect",
            "value" => array(
                __("Slide", 'mk_framework') => "slide",
                __("Slide Vertical", 'mk_framework') => "vertical_slide",
                __("Zoom", 'mk_framework') => "zoom",
                __("Zoom Out", 'mk_framework') => "zoom_out",
                __("Horizontal Curtain", 'mk_framework') => "horizontal_curtain",
                __("Fade", 'mk_framework') => "fade",
                __("Perspective Flip", 'mk_framework') => "perspective_flip",
                __("Kenburned", 'mk_framework') => "kenburned"
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework"),
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "range",
            "heading" => __("Pause Time", "mk_framework"),
            "param_name" => "slideshow_speed",
            "value" => "7000",
            "min" => "1000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("How long each slide will show.", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Direction Nav", "mk_framework"),
            "param_name" => "direction_nav",
            "width" => 300,
            "value" => array(
                __('Rounded Slide', "mk_framework") => "roundslide",
                __('Rounded', "mk_framework") => "round",
                __('Split', "mk_framework") => "slit",
                __('Thumbnail Flip', "mk_framework") => "thumbflip",
                __('-- No Navigation', "mk_framework") => "none"
            ),
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "mk_framework"),
            "param_name" => "pagination",
            "width" => 300,
            "value" => array(
                __('Stroke', "mk_framework") => "stroke",
                __('Small Dot With Stroke', "mk_framework") => "small_dot_stroke",
                __('-- No Pagination', "mk_framework") => "none"
            ),
            "description" => __("", "mk_framework")
        ),

        array(
            "type" => "toggle",
            "heading" => __("Scroll to Bottom Arrow", "mk_framework"),
            "param_name" => "skip_arrow",
            "value" => "true",
            "description" => __("", "mk_framework")
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