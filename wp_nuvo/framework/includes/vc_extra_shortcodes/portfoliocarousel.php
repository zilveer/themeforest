<?php
vc_map ( array (
		"name" => 'Portfolio Carousel',
		"base" => "cs-portfolio-carousel",
		"icon" => "cs_icon_for_vc",
		"category" => __ ( 'CS Hero', 'wp_nuvo' ),
		"description" => __ ( 'Portfolio Carousel', 'wp_nuvo' ),
		"params" => array (
				array (
						"type" => "textfield",
						"heading" => __ ( 'Title', 'wp_nuvo' ),
						"param_name" => "title",
				),
				array(
				    "type" => "dropdown",
				    "heading" => esc_html__("Heading size", 'wp_nuvo'),
				    "param_name" => "heading_size",
				    "value" => array(
				        "Default"   => "",
				        "Heading 1" => "h1",
				        "Heading 2" => "h2",
				        "Heading 3" => "h3",
				        "Heading 4" => "h4",
				        "Heading 5" => "h5",
				        "Heading 6" => "h6"
				    ),
				    "description" => 'Select your heading size for title.'
				),
				array(
				    "type" => "colorpicker",
				    "heading" => esc_html__('Title Color', 'wp_nuvo'),
				    "param_name" => "title_color",
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Sub Title', 'wp_nuvo' ),
						"param_name" => "subtitle",
				),
				array(
				    "type" => "dropdown",
				    "heading" => esc_html__("Sub Heading size", 'wp_nuvo'),
				    "param_name" => "subtitle_heading_size",
				    "value" => array(
				        "Default"   => "",
				        "Heading 1" => "h1",
				        "Heading 2" => "h2",
				        "Heading 3" => "h3",
				        "Heading 4" => "h4",
				        "Heading 5" => "h5",
				        "Heading 6" => "h6"
				    ),
				    "description" => 'Select your heading size for sub title.'
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Description', 'wp_nuvo' ),
						"param_name" => "description",
				),
				array (
						"type" => "pro_taxonomy",
						"taxonomy" => "portfolio_category",
						"heading" => __ ( "Categories", 'wp_nuvo' ),
						"param_name" => "category",
						"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo' )
				),
				array (
						"type" => "dropdown",
						"class" => "",
						"heading" => __ ( "Styles", 'wp_nuvo' ),
						"param_name" => "styles",
						"value" => array (
								"Style 1" => "style-1",
								"Style 2" => "style-2",
								"Style 3" => "style-3",
								"Style 4" => "style-4",
								"Style 5" => "style-5"
						),
				),
				array (
						"type" => "checkbox",
						"heading" => __ ( 'Crop image', 'wp_nuvo' ),
						"param_name" => "crop_image",
						"value" => array (
								__ ( "Yes, please", 'wp_nuvo' ) => true
						),
						"description" => __ ( 'Crop or not crop image on your Post.', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Width image', 'wp_nuvo' ),
						"param_name" => "width_image",
						"description" => __ ( 'Enter the width of image. Default: 300.', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Height image', 'wp_nuvo' ),
						"param_name" => "height_image",
						"description" => __ ( 'Enter the height of image. Default: 200.', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Width item', 'wp_nuvo' ),
						"param_name" => "width_item",
						"description" => __ ( 'Enter the width of item. Default: 150.', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Margin item', 'wp_nuvo' ),
						"param_name" => "margin_item",
						"description" => __ ( 'Enter the margin of item. Default: 20.', 'wp_nuvo' )
				),
				array (
						"type" => "dropdown",
						"class" => "",
						"heading" => __ ( "Rows", 'wp_nuvo' ),
						"param_name" => "rows",
						"value" => array (
								"1 row" => "1",
								"2 rows" => "2",
								"3 rows" => "3",
								"4 rows" => "4"
						),
				),
				array (
						"type" => "checkbox",
						"heading" => __ ( 'Auto scroll', 'wp_nuvo' ),
						"param_name" => "auto_scroll",
						"value" => array (
								__ ( "Yes, please", 'wp_nuvo' ) => true
						),
						"description" => __ ( 'Auto scroll.', 'wp_nuvo' )
				),
				array (
						"type" => "checkbox",
						"heading" => __ ( 'Same height', 'wp_nuvo' ),
						"param_name" => "same_height",
						"value" => array (
								__ ( "Yes, please", 'wp_nuvo' ) => true
						),
						"description" => __ ( 'Same height.', 'wp_nuvo' )
				),
				array (
						"type" => "checkbox",
						"heading" => __ ( 'Show navigation', 'wp_nuvo' ),
						"param_name" => "show_nav",
						"value" => array (
								__ ( "Yes, please", 'wp_nuvo' ) => true
						),
						"description" => __ ( 'Show or hide navigation on your carousel post.', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Excerpt Length', 'wp_nuvo' ),
						"param_name" => "excerpt_length",
						"value" => '',
						"description" => __ ( 'The length of the excerpt, number of words to display. Set to "-1" for no excerpt. Default: 100.', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Read More', 'wp_nuvo' ),
						"param_name" => "read_more",
						"value" => '',
						"description" => __ ( 'Enter desired text for the link or for no link, leave blank or set to \"-1\".', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( 'Number of posts to show per page', 'wp_nuvo' ),
						"param_name" => "posts_per_page",
						'value' => '12',
						"description" => __ ( 'The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'wp_nuvo' )
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( 'Order by', 'wp_nuvo' ),
						"param_name" => "orderby",
						"value" => array (
								"None" => "none",
								"Title" => "title",
								"Date" => "date",
								"ID" => "ID"
						),
						"description" => __ ( 'Order by ("none", "title", "date", "ID").', 'wp_nuvo' )
				),
				array (
						"type" => "dropdown",
						"heading" => __ ( 'Order', 'wp_nuvo' ),
						"param_name" => "order",
						"value" => Array (
								"None" => "none",
								"ASC" => "ASC",
								"DESC" => "DESC"
						),
						"description" => __ ( 'Order ("None", "Asc", "Desc").', 'wp_nuvo' )
				),
				array (
						"type" => "textfield",
						"heading" => __ ( "Extra class name", 'wp_nuvo' ),
						"param_name" => "el_class",
						"description" => __ ( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wp_nuvo' )
				)
		)
) );