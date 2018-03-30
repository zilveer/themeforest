<?php
vc_map(array(
    "name" => __("Photo Album", "mk_framework"),
    "base" => "mk_photo_album",
    'icon' => 'icon-mk-gallery vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework'),
    'description' => __( 'Photo Albums with loads of styles.', 'mk_framework' ),
    "params" => array(
        /*array(
            "heading" => __("Style", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "style",
            "value" => array(
                __("Grid", 'mk_framework') => "grid",
                __("Masonry", 'mk_framework') => "masonry"
            ),
            "type" => "dropdown"
        ),*/
        array(
            "type" => "range",
            "heading" => __("Space Between Grids", "mk_framework"),
            "param_name" => "space",
            "value" => "5",
            "min" => "0",
            "max" => "30",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
        ),

        array(
            "type" => "range",
            "heading" => __("How many column?", "mk_framework"),
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "4",
            "step" => "1",
            "unit" => 'column',
            "description" => __("", "mk_framework"),
        ),

        array(
            "heading" => __("Image Size", 'mk_framework'),
            "description" => __("Please note that this option will not work for Masonry option.", 'mk_framework'),
            "param_name" => "image_size",
            "value" => mk_get_image_sizes(),
            "type" => "dropdown"
        ),

       /* array(
            "heading" => __("Full height Album?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "full_height",
            "default" => "false",
            "value" => array(
                __("No", 'mk_framework') => "false",
                __("Yes", 'mk_framework') => "true"
            ),
            "type" => "dropdown"
        ),*/

        array(
            "type" => "range",
            "heading" => __("Album height?", "mk_framework"),
            "param_name" => "album_height",
            "value" => "300",
            "min" => "100",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            /*"dependency" => array(
                'element' => "full_height",
                'value' => array(
                    'false'
                )
            )*/
        ),
        array(
            "heading" => __("Show Description?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "description_preview",
            "default" => "false",
            "value" => array(
                __("Yes", 'mk_framework') => "true",
                __("No", 'mk_framework') => "false",
            ),
            "type" => "dropdown"
        ),

        array(
            "heading" => __("Show Preview thumbnails?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "thumbnail_preview",
            "default" => "false",
            "value" => array(
                __("Yes", 'mk_framework') => "true",
                __("No", 'mk_framework') => "false",
            ),
            "type" => "dropdown"
        ),

         array(
            "heading" => __("Show Overlay?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "overlay_preview",
            "default" => "false",
            "value" => array(
                __("Yes", 'mk_framework') => "true",
                __("No", 'mk_framework') => "false",
            ),
            "type" => "dropdown"
        ),

        array(
            "type" => "range",
            "heading" => __("Offset", "mk_framework"),
            "param_name" => "offset",
            "value" => "0",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("Number of post to displace or pass over, it means based on your order of the loop, this number will define how many posts to pass over and start from the nth number of the offset.", "mk_framework")
        ),

        array(
            "type" => "range",
            "heading" => __("How many Posts?", "mk_framework"),
            "param_name" => "count",
            "value" => "10",
            "min" => "-1",
            "max" => "50",
            "step" => "1",
            "unit" => 'posts',
            "description" => __("How many Posts would you like to show? (-1 means unlimited)", "mk_framework")
        ),

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
            'heading'     => __( 'Select specific Posts', 'mk_framework' ),
            'param_name'  => 'posts',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for post ID or post title to get autocomplete suggestions', 'mk_framework' ),
        ),

        array(
            'type'        => 'autocomplete',
            'heading'     => __( 'Select specific Authors', 'mk_framework' ),
            'param_name'  => 'author',
            'settings' => array(
                                'multiple' => true,
                                'sortable' => true,
                                'unique_values' => true,
                            ),
            'description' => __( 'Search for user ID, Username, Email Address to get autocomplete suggestions', 'mk_framework' ),
        ),

        array(
            "type" => "toggle",
            "heading" => __("Show Pagination?", "mk_framework"),
            "param_name" => "pagination",
            "value" => "true",
            "description" => __("Disable this option if you do not want pagination for this loop.", "mk_framework")
        ),
        array(
            "heading" => __("Pagination Style", 'mk_framework'),
            "description" => __("Select which pagination style you would like to use on this loop.", 'mk_framework'),
            "param_name" => "pagination_style",
            "value" => array(
                __("Classic Pagination Navigation", 'mk_framework') => "1",
                __("Load More button", 'mk_framework') => "2",
                __("Load More on page scroll", 'mk_framework') => "3"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "pagination",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "heading" => __("Orderby", 'mk_framework'),
            "description" => __("Sort retrieved Blog items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
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
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ),

        array(
           "type" => "group_heading",
           "title" => __("Title/Description Styles?", "mk_framework"),
           "param_name" => "title_description_style_title",
           "style" => "border: 0; font-size: 18px; padding:0;",
           "group" => __('Styles & Colors', 'mk_framework'),
        ),

        array(
            "heading" => __("Show Title/Description by default (on mouse out)?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "show_title_desc_without_hover",
            "value" => array(
                __("No", 'mk_framework') => "false",
                __("Yes", 'mk_framework') => "true",
            ),
            "type" => "dropdown",
            "group" => __('Styles & Colors', 'mk_framework')
        ),

        array(
            "heading" => __("Title/Description container style", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "title_preview_style",
            "value" => array(
                __("None", 'mk_framework') => "none",
                __("Bottom Bar", 'mk_framework') => "bar",
                __("Bottom Gradient", 'mk_framework') => "gradient"
            ),
            "type" => "dropdown",
            "group" => __('Styles & Colors', 'mk_framework')
        ),

        array(
            "type" => "range",
            "heading" => __("Title Font size?", "mk_framework"),
            "param_name" => "title_font_size",
            "value" => "25",
            "min" => "10",
            "max" => "80",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "group" => __('Styles & Colors', 'mk_framework'),
        ),

        array(
            "type" => "range",
            "heading" => __("Description Font size?", "mk_framework"),
            "param_name" => "description_font_size",
            "value" => "15",
            "min" => "10",
            "max" => "20",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework"),
            "group" => __('Styles & Colors', 'mk_framework'),
            "dependency" => array(
                'element' => "description_preview",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
           "type" => "group_heading",
           "title" => __("Preview Thumbnail Styles?", "mk_framework"),
           "param_name" => "preview_thumbnail_style_title",
           "style" => "border: 0; font-size: 18px; padding:0;",
           "group" => __('Styles & Colors', 'mk_framework'),
           "dependency" => array(
                'element' => "thumbnail_preview",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "type" => "toggle",
            "heading" => __("Show Preview Thumbnail by default (on mouse out)?", "mk_framework"),
            "param_name" => "show_thumbnail_without_hover",
            "value" => "false",
            "description" => __("", "mk_framework"),
            "group" => __('Styles & Colors', 'mk_framework'),
            "dependency" => array(
                'element' => "thumbnail_preview",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "heading" => __("Thumbnail Shape", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "thumbnail_shape",
            "value" => array(
                __("Rectangle Frame ", 'mk_framework') => "rectangle",
                __("Circle Frame", 'mk_framework') => "circle",
                __("Diamond Frame", 'mk_framework') => "diamond"
            ),
            "type" => "dropdown",
            "group" => __('Styles & Colors', 'mk_framework'),
            "dependency" => array(
                'element' => "thumbnail_preview",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
           "type" => "group_heading",
           "title" => __("Overlay Styles?", "mk_framework"),
           "param_name" => "overlay_style_title",
           "style" => "border: 0; font-size: 18px; padding:0;",
           "group" => __('Styles & Colors', 'mk_framework'),
           "dependency" => array(
                'element' => "overlay_preview",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "heading" => __("Show Overlay by default (on mouse out)?", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "show_overlay_without_hover",
            "value" => array(
                __("No", 'mk_framework') => "false",
                __("Yes", 'mk_framework') => "true",
            ),
            "type" => "dropdown",
            "group" => __('Styles & Colors', 'mk_framework'),
            "dependency" => array(
                'element' => "overlay_preview",
                'value' => array(
                    'true'
                )
            )
        ),

        array(
            "type" => "colorpicker",
            "heading" => __("Overlay Color", "mk_framework"),
            "param_name" => "overlay_background",
            "value" => "",
            "description" => __("", "mk_framework"),
            "group" => __('Styles & Colors', 'mk_framework'),
            "dependency" => array(
                'element' => "overlay_preview",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "heading" => __("Title / Description Animation (on mouse over)", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "title_animation",
            "value" => array(
                __("Fade in", 'mk_framework') => "fade_in",
                __("Slide from bottom", 'mk_framework') => "slide_from_bottom",
                __("Scale in", 'mk_framework') => "scale_in"
            ),
            "type" => "dropdown",
            "group" => __('Hover Options', 'mk_framework'),
            "dependency" => array(
                'element' => "show_title_desc_without_hover",
                'value' => array(
                    'false'
                )
            )
        ),

        // array(
        //     "type" => "colorpicker",
        //     "heading" => __("Overlay Color", "mk_framework"),
        //     "param_name" => "overlay_hover_background",
        //     "value" => "",
        //     "description" => __("", "mk_framework"),
        //     "group" => __('Hover Options', 'mk_framework'),
        //     "dependency" => array(
        //         'element' => "overlay_preview",
        //         'value' => array(
        //             'true'
        //         )
        //     )
        // ),

        array(
            "heading" => __("Overlay Animation (on mouse over)", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "overlay_hover_animation",
            "value" => array(
                __("Fade in", 'mk_framework') => "fade_in",
                __("Ripple", 'mk_framework') => "ripple",
            ),
            "type" => "dropdown",
            "group" => __('Hover Options', 'mk_framework'),
            "dependency" => array(
                'element' => "show_overlay_without_hover",
                'value' => array(
                    'false'
                )
            )
        ),

        array(
            "heading" => __("Cover Image Animation (on mouse over)", 'mk_framework'),
            "description" => __("", 'mk_framework'),
            "param_name" => "cover_image_hover_animation",
            "value" => array(
                __("None", 'mk_framework') => "none",
                __("Slide", 'mk_framework') => "slide",
                __("Blur", 'mk_framework') => "blur"
            ),
            "type" => "dropdown",
            "group" => __('Hover Options', 'mk_framework'),
        ),
    )
));