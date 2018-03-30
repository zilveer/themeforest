<?php
vc_map(array(
    "name" => __("Testimonials", "mk_framework") ,
    "base" => "mk_testimonials",
    'icon' => 'icon-mk-testimonial-slideshow vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework') ,
    'description' => __('Shows Testimonials in multiple styles.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "heading" => __("Style", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "style",
            "value" => array(
                __("Avant garde", 'mk_framework') => "avantgarde",
                __("Boxed", 'mk_framework') => "boxed",
                __("Modern", 'mk_framework') => "modern",
                __("Simple Centered", 'mk_framework') => "simple"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "heading" => __("Show as?", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "show_as",
            "value" => array(
                __("Slideshow", 'mk_framework') => "slideshow",
                __("Column Based", 'mk_framework') => "column"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "range",
            "heading" => __("How many Columns", "mk_framework") ,
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "4",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("If Column based is selected from the option above, you will need to set in how many columns, testimonials will be showed up.", "mk_framework") ,
            "dependency" => array(
                'element' => "show_as",
                'value' => array(
                    'column'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Skin", "mk_framework") ,
            "param_name" => "skin",
            "value" => array(
                __('Dark', "mk_framework") => "dark",
                __('Light', "mk_framework") => "light"
            ) ,
            "description" => __("This option is only for 'Simple Centered' style and you can use it when you need to place this shortcode inside a page section with dark background.", "mk_framework") ,
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'simple',
                    'avantgarde'
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
            "unit" => 'testimonial',
            "description" => __("How many testimonial you would like to show? (-1 means unlimited)", "mk_framework")
        ) ,
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Categories', 'mk_framework' ),
            'param_name'  => 'categories',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for category name to get autocomplete suggestions', 'mk_framework' ),
        ),
        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Testimonials', 'mk_framework' ),
            'param_name'  => 'testimonials',
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
            "type" => "range",
            "heading" => __("Animation Speed", "mk_framework") ,
            "param_name" => "animation_speed",
            "value" => "700",
            "min" => "100",
            "max" => "3000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "show_as",
                'value' => array(
                    'slideshow'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Slideshow Speed", "mk_framework") ,
            "param_name" => "slideshow_speed",
            "value" => "7000",
            "min" => "1000",
            "max" => "20000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "show_as",
                'value' => array(
                    'slideshow'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Content Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => "#777777",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Author Color", "mk_framework") ,
            "param_name" => "author_color",
            "value" => "#444444",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Skill Color", "mk_framework") ,
            "param_name" => "skill_color",
            "value" => "#777777",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework") ,
            "param_name" => "font_size",
            "value" => "18",
            "min" => "14",
            "max" => "48",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Style", "mk_framework") ,
            "param_name" => "font_style",
            "value" => array(
                __('Italic', "mk_framework") => "italic",
                __('Normal', "mk_framework") => "normal",
                __('Default', "mk_framework") => "inherit",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Text Transform", "mk_framework") ,
            "param_name" => "text_transform",
            "value" => array(
                __('Default', "mk_framework") => "initial",
                __('None', "mk_framework") => "none",
                __('Uppercase', "mk_framework") => "uppercase",
                __('Lowercase', "mk_framework") => "lowercase",
                __('Capitalize', "mk_framework") => "capitalize"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Letter Spacing", "mk_framework") ,
            "param_name" => "letter_spacing",
            "value" => "0",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Space between each character.", "mk_framework")
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
