<?php
	vc_map(array(
		"name" => __("Blog Showcase", "mk_framework"),
		"base" => "mk_blog_showcase",
		'icon' => 'icon-mk-blog-portfolio-showcase vc_mk_element-icon',
		"category" => __('Loops', 'mk_framework'),
		'description' => __( 'Showcase your blog posts.', 'mk_framework' ),
		"params" => array(
		    array(
	            'type'        => 'autocomplete',
	            'heading'     => __( 'Select specific Categories', 'mk_framework' ),
	            'param_name'  => 'cat',
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
	            'heading'     => __( 'Select specific Posts', 'mk_framework' ),
	            'param_name'  => 'posts',
	            'settings' => array(
	                                'multiple' => true,
	                                'sortable' => true,
	                                'unique_values' => true,
	                                // In UI show results except selected. NB! You should manually check values in backend
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
	                                // In UI show results except selected. NB! You should manually check values in backend
	                            ),
	            'description' => __( 'Search for user ID, Username, Email Address to get autocomplete suggestions', 'mk_framework' ),
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
		        "heading" => __("Post Excerpt Length", "mk_framework"),
		        "description" => __("Define the length of the excerpt by number of characters. Zero will disable excerpt.", 'mk_framework'),
		        "param_name" => "excerpt_length",
		        "value" => "200",
		        "min" => "0",
		        "max" => "2000",
		        "step" => "1",
		        "unit" => 'characters'
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
		        "type" => "textfield",
		        "heading" => __("Extra class name", "mk_framework"),
		        "param_name" => "el_class",
		        "value" => "",
		        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
		    )
		)
	));