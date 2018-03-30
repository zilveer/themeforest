<?php
vc_map(array(
    "name" => __("Portfolio", "mk_framework"),
    "base" => "mk_portfolio",
    'icon' => 'icon-mk-portfolio vc_mk_element-icon',
    "category" => __('Loops', 'mk_framework'),
    'description' => __( 'Portfolio loops are here.', 'mk_framework' ),
    "params" => array(
        array(
            "heading" => __("Style", 'mk_framework'),
            "description" => __("Select which Portfolio loop style you would like to use.", 'mk_framework'),
            "param_name" => "style",
            "value" => array(
                __("Classic", 'mk_framework') => "classic",
                __("Grid", 'mk_framework') => "grid",
                __("Masonry", 'mk_framework') => "masonry"
            ),
            "type" => "dropdown"
        ),

        array(
            "heading" => __("Hover Scenarios", 'mk_framework'),
            "description" => __("This is what happens when user hovers over a portfolio item. Different animations and styles will be showed up on each scenario.", 'mk_framework'),
            "param_name" => "hover_scenarios",
            "value" => array(
                __("Slide Box", 'mk_framework') => "slidebox",
                __("Fade Box", 'mk_framework') => "fadebox",
                __("Zoom In Box", 'mk_framework') => "zoomin",
                __("Zoom Out Box", 'mk_framework') => "zoomout",
                __("Light Zoom In", 'mk_framework') => "light-zoomin",
                __("3D Cube", 'mk_framework') => "cube",
                __("None (only link to the single portfolio page)", 'mk_framework') => "none"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid',
                    'masonry'
                )
            )
        ),
        array(
            "heading" => __("Grid Spacing", 'mk_framework'),
            "description" => __("Space between items in grid and masonry portfolio styles.", 'mk_framework'),
            "param_name" => "grid_spacing",
            "value" => "4",
            "min" => "0",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "type" => "range",
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid',
                    'masonry'
                )
            )
        ),
        array(
            "heading" => __("Image Size", 'mk_framework'),
            "description" => __("Please note that this option will not work for Masonry option.", 'mk_framework'),
            "param_name" => "image_size",
            "value" => mk_get_image_sizes(),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'classic',
                    'grid',
                    'masonry'
                )
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "range",
            "heading" => __("Image Height", "mk_framework"),
            "param_name" => "height",
            "value" => "300",
            "min" => "100",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Please note that this option will not work in Masonry portfolio style.", "mk_framework"),
            "dependency" => array(
                'element' => "image_size",
                'value' => array(
                    'crop'
                )
            )
        ),
        array(
            "type" => "toggle",
            "heading" => __("Shows Posts Using Ajax?", "mk_framework"),
            "param_name" => "ajax",
            "value" => "false",
            "description" => __("If you enable this option the portfolio posts items will be viewed in the same page above the portfolio loop.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid',
                    'masonry'
                )
            )
        ),
        
        array(
            "type" => "range",
            "heading" => __("How many Columns?", "mk_framework"),
            "param_name" => "column",
            "value" => "3",
            "min" => "1",
            "max" => "6",
            "step" => "1",
            "unit" => 'columns',
            "description" => __("How many columns you would like to show in one row? Please note that the actual size you will get will be different with 10px tolerance. 3, 4, 5, 6 column with sidebar layouts will be 2 columns.", "mk_framework"),
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'grid',
                    'classic'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Post Excerpt Length", "mk_framework"),
            "description" => __("Define the length of the excerpt by number of characters. Zero will disable excerpt.", 'mk_framework'),
            "param_name" => "excerpt_length",
            "value" => "200",
            "min" => "0",
            "max" => "2000",
            "step" => "1",
            "unit" => 'characters',
            "dependency" => array(
                'element' => "style",
                'value' => array(
                    'classic'
                )
            )
        ),
        array(
            "heading" => __("Choose Meta Element", 'mk_framework'),
            "description" => __("Choose the type of meta data you would like to show in portfolio loop items.", 'mk_framework'),
            "param_name" => "meta_type",
            "value" => array(
                __("Category", 'mk_framework') => "category",
                __("Date", 'mk_framework') => "date",
                __("None", 'mk_framework') => "none",
            ),
            "type" => "dropdown"
        ),
        array(
            "type" => "toggle",
            "heading" => __("Show Permalink?", "mk_framework"),
            "param_name" => "permalink_icon",
            "value" => "true",
            "description" => __("If do not need portfolio single post you can remove permalink from image hover icon and title.", "mk_framework")
        ),
        array(
            "type" => "toggle",
            "heading" => __("Show Zoom Link?", "mk_framework"),
            "param_name" => "zoom_icon",
            "value" => "true",
            "description" => __("If do not need portfolio single post you can remove zoom link from image hover icon and title.", "mk_framework")
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
            "type" => "toggle",
            "heading" => __("Sortable?", "mk_framework"),
            "description" => __("", "mk_framework"),
            "param_name" => "sortable",
            "value" => 'true',
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Sortable Align?", "mk_framework"),
            "param_name" => "sortable_align",
            "value" => array(
                __("Left", 'mk_framework') => "left",
                __("Center", 'mk_framework') => "center",
                __("Right", 'mk_framework') => "right"
            ),
            "dependency" => array(
                'element' => "sortable",
                'value' => array(
                    'true',
                )
            )

        ),
        array(
            "heading" => __("Sortable Style", 'mk_framework'),
            "description" => __("The look of sortable section of portfolio loop", 'mk_framework'),
            "param_name" => "sortable_style",
            "value" => array(
                __("Classic", 'mk_framework') => "classic",
                __("Outline", 'mk_framework') => "outline"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "sortable",
                'value' => array(
                    'true',
                )
            )
        ),
        array(
            "heading" => __("Sortable Mode", 'mk_framework'),
            "description" => __("Ajax Mode retrieves the result by searching through the whole portfolio posts. On the other hand, Static Mode searches to find results only in the same page.", 'mk_framework'),
            "param_name" => "sortable_mode",
            "value" => array(
                __("Ajax", 'mk_framework') => "ajax",
                __("Static", 'mk_framework') => "static"
            ),
            "type" => "dropdown",
            "dependency" => array(
                'element' => "sortable",
                'value' => array(
                    'true',
                )
            )
        ),
        array(
            "type" => "textfield",
            "heading" => __("Sortable [All] Link Title", "mk_framework"),
            "param_name" => "sortable_all_text",
            "value" => "All",
            "description" => __("", "mk_framework")
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Sortable Background Custom Color (Outline Style)", "mk_framework"),
            "param_name" => "sortable_bg_color",
            "value" => "#1a1a1a",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "sortable_style",
                'value' => array(
                    'outline'
                )
            )
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Sortable Text Custom Color (Outline Style)", "mk_framework"),
            "param_name" => "sortable_txt_color",
            "value" => "#cccccc",
            "description" => __("", "mk_framework"),
            "dependency" => array(
                'element' => "sortable_style",
                'value' => array(
                    'outline'
                )
            )
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
            "description" => __("Sort retrieved Blog items by parameter.", 'mk_framework'),
            "param_name" => "orderby",
            "value" => $mk_orderby,
            "type" => "dropdown"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "mk_framework"),
            "param_name" => "target",
            "value" => $target_arr,
            "description" => __("Target for title permalink and image hover permalink icon.", "mk_framework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        ),
    )
));