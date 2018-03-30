<?php
if (class_exists ( 'Woocommerce' )) {
	vc_map ( array (
			"name" => 'Shop Carousel',
			"base" => "cs-shop-carousel",
			"icon" => "cs_icon_for_vc",
			"category" => __ ( 'CS Hero', 'wp_nuvo' ),
			"description" => __ ( 'Shop Carousel', 'wp_nuvo' ),
			"params" => array (
					array (
						"type" => "textfield",
						"heading" => __ ( 'Heading', 'wp_nuvo' ),
						"param_name" => "title",
						"admin_label" => true
					),
					array(
					    "type" => "dropdown",
					    "heading" => esc_html__("Heading size", 'wp_nuvo'),
					    "param_name" => "heading_size",
					    "value" => array(
					        "Default"   => "h3",
					        "Heading 1" => "h1",
					        "Heading 2" => "h2",
					        "Heading 3" => "h3",
					        "Heading 4" => "h4",
					        "Heading 5" => "h5",
					        "Heading 6" => "h6"
					    ),
					    "description" => 'Select your heading size for title.'
					),
					array (
				        "type" => "dropdown",
				        "class" => "",
				        "heading" => __ ( "Heading Align", 'wp_nuvo' ),
				        "param_name" => "title_align",
				        "value" => array (
				            "Left" => "text-left",
				            "Center" => "text-center",
				            "Right" => "text-right"
				        ),
				        "description" => esc_html__("Select align for Title", 'wp_nuvo')
				    ),
					array(
					    "type" => "colorpicker",
					    "heading" => esc_html__('Heading Color', 'wp_nuvo'),
					    "param_name" => "title_color",
					),
					array (
				        "type" => "dropdown",
				        "class" => "",
				        "heading" => __ ( "Heading Style", 'wp_nuvo' ),
				        "param_name" => "heading_style",
				        "value" => array (
				            "Default" => "default",
				            "Border Bottom" => "border-bottom",
				            "Overline" => "overline",
				            "Underline" => "underline",
				            "Line Through" => "line-through",
				            "Dotted Bottom" =>"dotted-bottom"
				        ),
				        "description" => esc_html__("Select heading style", 'wp_nuvo')
				    ),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Sub Heading', 'wp_nuvo' ),
							"param_name" => "subtitle",
					),
					array(
					    "type" => "dropdown",
					    "heading" => esc_html__("Sub Heading size", 'wp_nuvo'),
					    "param_name" => "subtitle_heading_size",
					    "value" => array(
					        "Default"   => "h4",
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
							"type" => "",
							"heading" => __ ( 'Source Option', 'wp_nuvo' ),
							"param_name" => "source_option",
							'value' => '',
					),
					array (
							"type" => "pro_taxonomy",
							"taxonomy" => "product_cat",
							"heading" => __ ( "Categories", 'wp_nuvo' ),
							"param_name" => "category",
							"description" => __ ( "Note: By default, all your projects will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Show Item title', 'wp_nuvo' ),
							"param_name" => "show_title",
							"value" => array (
								__("Yes", 'wp_nuvo') => '1',
	                			__("No", 'wp_nuvo') => '0'
							),
							"description" => __ ( 'Show/Hide title of each product.', 'wp_nuvo' )
					),

					array(
					    "type" => "colorpicker",
					    "heading" => esc_html__('Items Heading Color', 'wp_nuvo'),
					    "param_name" => "item_title_color"
					),
					array(
					    "type" => "dropdown",
					    "heading" => esc_html__("Item Heading size", 'wp_nuvo'),
					    "param_name" => "item_heading_size",
					    "value" => array(
					        "Default"   => "h3",
					        "Heading 1" => "h1",
					        "Heading 2" => "h2",
					        "Heading 3" => "h3",
					        "Heading 4" => "h4",
					        "Heading 5" => "h5",
					        "Heading 6" => "h6"
					    ),
					    "description" => 'Select your heading size for each item title.'
					),
					array (
						"type" => "dropdown",
						"heading" => __ ( 'Show image', 'wp_nuvo' ),
						"param_name" => "show_image",
						"value" => array (
							__("Yes", 'wp_nuvo') => '1',
                			__("No", 'wp_nuvo') => '0'
						),
						"description" => __ ( 'Show/Hide image of each product.', 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Crop image', 'wp_nuvo' ),
							"param_name" => "crop_image",
							"value" => array (
								__("No", 'wp_nuvo') => '0',
								__("Yes", 'wp_nuvo') => '1'

							),
							"description" => __ ( 'Crop or not crop image on your product.', 'wp_nuvo' )
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Width image', 'wp_nuvo' ),
							"param_name" => "width_image",
							"description" => __ ( 'Enter the width of image. Default: 360.', 'wp_nuvo' )
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Height image', 'wp_nuvo' ),
							"param_name" => "height_image",
							"description" => __ ( 'Enter the height of image. Default: 240.', 'wp_nuvo' )
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Image border radius', 'wp_nuvo' ),
							"param_name" => "image_border",
							"description" => __ ( 'Enter style border radius for image. Ex 3px for rounded, or 50% for circle.', 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Show Category', 'wp_nuvo' ),
							"param_name" => "show_category",
							"value" => array (
								__("Yes", 'wp_nuvo') => '1',
	                			__("No", 'wp_nuvo') => '0'
							),
							"description" => __ ( 'Show/Hide Category of post', 'wp_nuvo' )
					),

					array (
							"type" => "dropdown",
							"heading" => __ ( 'Show price', 'wp_nuvo' ),
							"param_name" => "show_price",
							"value" => array (
									__ ( "Yes", 'wp_nuvo' ) => '1',
									__ ( "No", 'wp_nuvo' ) => '0',
							),
							"description" => __ ( 'Show or hide price on your Product.', 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Show add to cart', 'wp_nuvo' ),
							"param_name" => "show_add_to_cart",
							"value" => array (
									__ ( "Yes, please", 'wp_nuvo' ) => '1',
									__ ( "No, please", 'wp_nuvo' ) => '0'
							),
							"description" => __ ( 'Show or hide add to cart on your Product.', 'wp_nuvo' )
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Number of posts to show per page', 'wp_nuvo' ),
							"param_name" => "posts_per_page",
							'value' => '12',
							"description" => __ ( 'The number of posts to display on each page. Set to "-1" for display all posts on the page.', 'wp_nuvo' )
					),
					array (
							"type" => "",
							"heading" => __ ( 'Carousel Style', 'wp_nuvo' ),
							"param_name" => "carousel_style",
							'value' => '',
							"description" => __ ( 'All config of Carousel', 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"class" => "",
							"heading" => __ ( "Style", 'wp_nuvo' ),
							"param_name" => "style",
							"value" => array (
									"Style 1" => "layout-1",
									"Style 2" => "layout-2"
							),
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
							"type" => "textfield",
							"heading" => __ ( 'Speed', 'wp_nuvo' ),
							"param_name" => "speed",
							"description" => __ ( 'Enter the speed of carousel. Default: 500.', 'wp_nuvo' )
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
							"type" => "dropdown",
							"heading" => __ ( 'Auto scroll', 'wp_nuvo' ),
							"param_name" => "auto_scroll",
							"value" => array (
									__ ( "Yes", 'wp_nuvo' ) => '1',
									__ ( "No", 'wp_nuvo' ) => '0'
							),
							"description" => __ ( 'Auto scroll.', 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Show Navigation', 'wp_nuvo' ),
							"param_name" => "show_nav",
							"value" => array (
									__ ( "Yes, please", 'wp_nuvo' ) => '1',
									__ ( "No, please", 'wp_nuvo' ) => '0'
							),
							"description" => __ ( 'Show or hide navigation.', 'wp_nuvo' )
					),
					array (
							"type" => "dropdown",
							"heading" => __ ( 'Show Pager', 'wp_nuvo' ),
							"param_name" => "show_pager",
							"value" => array (
									__ ( "Yes, please", 'wp_nuvo' ) => '1',
									__ ( "No, please", 'wp_nuvo' ) => '0',
							),
							"description" => __ ( 'Show or hide pager on your carousel shop.', 'wp_nuvo' )
					),

					array (
							"type" => "",
							"heading" => __ ( 'Order Style', 'wp_nuvo' ),
							"param_name" => "order_styke",
							'value' => '',
							"description" => __ ( 'All config of Order', 'wp_nuvo' )
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
							"value" => array (
									"None" => "none",
									"Ascending" => "asc",
									"Descending" => "desc"
							),
							"description" => __ ( 'Order ("none", "asc", "desc").', 'wp_nuvo' )
					),
					array (
							"type" => "",
							"heading" => __ ( 'Extra Param', 'wp_nuvo' ),
							"param_name" => "extra_param",
							'value' => '',
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Read More Link', 'wp_nuvo' ),
							"param_name" => "morelink",
							'value' => '',
					),
					array (
							"type" => "textfield",
							"heading" => __ ( 'Read More Text', 'wp_nuvo' ),
							"param_name" => "moretext",
							'value' => '',
					)
			)
	) );
}