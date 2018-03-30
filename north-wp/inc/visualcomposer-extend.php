<?php
// Shortcodes 
$shortcodes = THB_THEME_ROOT_ABS.'/vc_templates/';
$files = glob($shortcodes.'/thb_?*.php');
foreach ($files as $filename)
{
	require get_template_directory().'/vc_templates/'.basename($filename);
}

/* Visual Composer Mappings */
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
// Adding animation to columns
vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Animation",
	"admin_label" => true,
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"Left" => "animation right-to-left",
		"Right" => "animation left-to-right",
		"Top" => "animation bottom-to-top",
		"Bottom" => "animation top-to-bottom",
		"Scale" => "animation scale",
		"Fade" => "animation fade-in"
	),
	"description" => ""
));
vc_add_param("vc_column_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => "Animation",
	"admin_label" => true,
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"Left" => "animation right-to-left",
		"Right" => "animation left-to-right",
		"Top" => "animation bottom-to-top",
		"Bottom" => "animation top-to-bottom",
		"Scale" => "animation scale",
		"Fade" => "animation fade-in"
	),
	"description" => ""
));

// Add parameters to rows
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Disable Column Padding",
	"param_name" => "column_padding",
	"value" => array(
		"" => "false"
	),
	"description" => "You can have columns without spaces using this option"
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Remove Row Padding",
	"param_name" => "row_padding",
	"value" => array(
		"" => "true"
	),
	"description" => "If you enable this, this row won't leave padding on the sides"
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	"heading" => "Enable Full Width",
	"param_name" => "thb_full_width",
	"value" => array(
		"" => "true"
	),
	"description" => "If you enable this, this row will fill the screen"
));

// Button shortcode
vc_map( array(
	"name" => __("Button", 'north'),
	"base" => "thb_button",
	"icon" => "thb_vc_ico_button",
	"class" => "thb_vc_sc_button",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => "Caption",
			"admin_label" => true,
			"param_name" => "caption",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => "Link URL",
			"param_name" => "link",
			"value" => "",
			"description" => ""
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'description' => __( 'Select icon from library.', 'js_composer' ),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Open link in",
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "",
				"New window" => "true"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Size",
			"param_name" => "size",
			"value" => array(
				"Small button" => "small",
				"Medium button" => "medium",
				"Big button" => "large"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Button color",
			"param_name" => "color",
			"value" => array(
				"Accent Color" => "accent",
				"Black" => "black",
				"White" => "white"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Animation",
			"param_name" => "animation",
			"value" => array(
				"None" => "",
				"Left" => "animation right-to-left",
				"Right" => "animation left-to-right",
				"Top" => "animation bottom-to-top",
				"Bottom" => "animation top-to-bottom",
				"Scale" => "animation scale",
				"Fade" => "animation fade-in"
			),
			"description" => ""
		)
	),
	"description" => "Add an animated button"
) );

// Divider Shortcode
vc_map( array(
	"name" => __("Dividers", 'north'),
	"base" => "thb_dividers",
	"icon" => "thb_vc_ico_dividers",
	"class" => "thb_vc_sc_dividers",
	"category" => "by Fuel Themes",
	"show_settings_on_create" => true,
	"params" => array(
		array(
		    "type" => "dropdown",
		    "heading" => "Style",
		    "param_name" => "style",
		    "admin_label" => true,
		    "value" => array(
		    	'Style 1' => "style1",
		    	'Style 2' => "style2",
		    	'Style 3' => "style3",
		    	'Style 4' => "style4",
		    	'Style 5' => "style5",
		    	'Style 6' => "style6",
		    	'Style 7' => "style7",
		    	'Style 8' => "style8"
		    ),
		    "description" => "This changes the style of the dividers"
		),
	),
	"description" => "Divide your content with different divider styles."
) );

// Gap shortcode
vc_map( array(
	"name" => __("Gap", 'north'),
	"base" => "thb_gap",
	"icon" => "thb_vc_ico_gap",
	"class" => "thb_vc_sc_gap",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
		  "type" => "textfield",
		  "heading" => "Gap Height",
		  "param_name" => "height",
		  "admin_label" => true,
		  "description" => "Enter height of the gap in px."
		)
	),
	"description" => "Add a gap to seperate elements"
) );

// Iconbox shortcode
vc_map( array(
	"name" => __("Iconbox", 'north'),
	"base" => "thb_iconbox",
	"icon" => "thb_vc_ico_iconbox",
	"class" => "thb_vc_sc_iconbox",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => true, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'description' => __( 'Select icon from library.', 'js_composer' ),
		),
		array(
		  "type"              => "colorpicker",
		  "holder"            => "div",
		  "class"             => "",
		  "heading"           => "Icon Color",
		  "param_name"        => "icon_color",
		  "description"       => ""
		),
		array(
			"type" => "attach_image", //attach_images
			"class" => "",
			"heading" => "Image",
			"param_name" => "image",
			"description" => "Use image instead of icon? Image uploaded should be 100*100"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => "Heading",
			"param_name" => "heading",
			"value" => "",
			"admin_label" => true,
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => "Heading Color",
			"param_name" => "heading_color",
			"value" => "",
			"description" => "You can change the heading color from here"
		),
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => "Content",
			"param_name" => "content",
			"value" => "",
			"description" => ""
		),
		array(
		  "type"              => "colorpicker",
		  "holder"            => "div",
		  "class"             => "",
		  "heading"           => "Content Color",
		  "param_name"        => "content_color",
		  "description"       => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Animation",
			"param_name" => "animation",
			"value" => array(
				"None" => "",
				"Left" => "animation right-to-left",
				"Right" => "animation left-to-right",
				"Top" => "animation bottom-to-top",
				"Bottom" => "animation top-to-bottom",
				"Scale" => "animation scale",
				"Fade" => "animation fade-in"
			),
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => "Add Button?",
			"param_name" => "use_btn",
			"value" => array(
				"" => "true"
			),
			"description" => "Check if you want to add a button."
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => "Button Caption",
			"param_name" => "btn_content",
			"value" => "",
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => "Button Link URL",
			"param_name" => "btn_link",
			"value" => "",
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Button Icon",
			"param_name" => "btn_icon",
			"value" => thb_getIconArray(),
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Button Open link in",
			"param_name" => "btn_target_blank",
			"value" => array(
				"Same window" => "",
				"New window" => "true"
			),
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Button Size",
			"param_name" => "btn_size",
			"value" => array(
				"Small button" => "small",
				"Medium button" => "medium",
				"Big button" => "big"
			),
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Button Style",
			"param_name" => "btn_style",
			"value" => array(
				"Fill" => "",
				"Outline" => "outline"
			),
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Button color",
			"param_name" => "btn_color",
			"value" => array(
				"Accent" => "accent",
				"Black" => "black",
				"White" => "white"
			),
			"description" => "",
			"dependency" => Array('element' => "use_btn", 'not_empty' => true)
		)
	),
	"description" => "Iconboxes with different animations"
) );

// Image shortcode
vc_map( array(
	"name" => "Image",
	"base" => "thb_image",
	"icon" => "thb_vc_ico_image",
	"class" => "thb_vc_sc_image",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"class" => "",
			"heading" => "Select Image",
			"param_name" => "image",
			"description" => ""
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => "Full Width?",
			"param_name" => "full_width",
			"value" => array(
				"" => "true"
			),
			"description" => "If selected, the image will always fill its container"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Animation",
			"param_name" => "animation",
			"value" => array(
				"None" => "",
				"Left" => "animation right-to-left",
				"Right" => "animation left-to-right",
				"Top" => "animation bottom-to-top",
				"Bottom" => "animation top-to-bottom",
				"Scale" => "animation scale",
				"Fade" => "animation fade-in"
			),
			"description" => ""
		),
		array(
		  "type" => "textfield",
		  "heading" => "Image size",
		  "param_name" => "img_size",
		  "description" => "Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size."
		),
		array(
		  "type" => "dropdown",
		  "heading" => "Image alignment",
		  "param_name" => "alignment",
		  "value" => array("Align left" => "left", "Align right" => "right", "Align center" => "center"),
		  "description" => "Select image alignment."
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => "Link to Full-Width Image?",
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			)
		),
		array(
		  "type" => "vc_link",
		  "heading" => "Image link",
		  "param_name" => "img_link",
		  "description" => "Enter url if you want this image to have link.",
		  "dependency" => Array('element' => "lightbox", 'is_empty' => true)
		)
	),
	"description" => "Add an animated image"
) );

// Image Slider
vc_map( array(
	"name" => __("Image Slider", 'north'),
	"base" => "thb_slider",
	"icon" => "thb_vc_ico_slider",
	"class" => "thb_vc_sc_slider",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			"type" => "attach_images", //attach_images
			"class" => "",
			"heading" => "Select Images",
			"param_name" => "images",
			"admin_label" => true,
			"description" => ""
		),
		array(
		  "type" => "textfield",
		  "heading" => "Width",
		  "param_name" => "width",
		  "description" => "Enter the width of the images. The slider will fill the width of the container, so make sure you size the columns accordingly."
		),
		array(
		  "type" => "textfield",
		  "heading" => "Height",
		  "param_name" => "height",
		  "description" => "Enter the height of the images."
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => "Navigation Arrows",
			"param_name" => "navigation",
			"value" => array(
				"" => "true"
			),
			"description" => "Check this if you want to show navigation arrows."
		)
	),
	"description" => "Add an image slider"
) );

// Instagram
vc_map( array(
	"name" => __("Instagram", 'north'),
	"base" => "thb_instagram",
	"icon" => "thb_vc_ico_instagram",
	"class" => "thb_vc_sc_instagram",
	"category" => "by Fuel Themes",
	"params"	=> array(
	  
	  array(
	      "type" => "textfield",
	      "heading" => "Username",
	      "param_name" => "username",
	      "description" => "Instagram Username"
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => "Number of Photos",
	      "param_name" => "number",
	      "description" => "Number of Instagram Photos to retrieve"
	  ),
		array(
			"type" => "dropdown",
			"heading" => "Columns",
			"param_name" => "columns",
			"value" => array(
				'Six Columns' => "6",
				'Five Columns' => "5",
				'Four Columns' => "4",
				'Three Columns' => "3",
				'Two Columns' => "2"
			)
		),
	  array(
	      "type" => "checkbox",
	      "heading" => "Link Photos to Instagram?",
	      "param_name" => "link",
	      "value" => array(
				"" => "true"
			),
	      "description" => "Do you want to link the Instagram photos to instagram.com website?"
	  )
	),
	"description" => "Add Instagram Photos"
) );

// Notification shortcode
vc_map( array(
	"name" => __("Notification", 'north'),
	"base" => "thb_notification",
	"icon" => "thb_vc_ico_notification",
	"class" => "thb_vc_sc_notification",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Type",
			"param_name" => "type",
			"value" => array(
				"Information" => "information",
				"Success" => "success",
				"Warning" => "warning",
				"Error" => "error"
			),
			"description" => ""
		),
		array(
			"type" => "textarea",
			"class" => "",
			"heading" => "Content",
			"admin_label" => true,
			"param_name" => "content",
			"value" => "",
			"description" => ""
		)
	),
	"description" => "Display Notifications"
) );

// Single Product
vc_map( array(
	"name" => __("Single Product Page", 'north'),
	"base" => "thb_product_singlepage",
	"icon" => "thb_vc_ico_product_singlepage",
	"class" => "thb_vc_sc_product_singlepage",
	"category" => "by Fuel Themes",
	"params"	=> array(
	  array(
	      "type" => "textfield",
	      "heading" => "Product ID",
	      "param_name" => "product_id",
	      "admin_label" => true,
	      "description" => "Enter the product ID you would like to display"
	  )
	),
	"description" => "Add single product Page"
) );

// Single Product
vc_map( array(
	"name" => __("Single Product", 'north'),
	"base" => "thb_product_single",
	"icon" => "thb_vc_ico_product_single",
	"class" => "thb_vc_sc_product_single",
	"category" => "by Fuel Themes",
	"params"	=> array(
	  array(
	      "type" => "textfield",
	      "heading" => "Product ID",
	      "param_name" => "product_id",
	      "admin_label" => true,
	      "description" => "Enter the products ID you would like to display"
	  )
	),
	"description" => "Add WooCommerce product"
) );

// Products
vc_map( array(
	"name" => __("Products", 'north'),
	"base" => "thb_product",
	"icon" => "thb_vc_ico_product",
	"class" => "thb_vc_sc_product",
	"category" => "by Fuel Themes",
	"params"	=> array(
	  array(
	      "type" => "dropdown",
	      "heading" => "Product Sort",
	      "param_name" => "product_sort",
	      "value" => array(
	      	'Best Sellers' => "best-sellers",
	      	'Latest Products' => "latest-products",
	      	'Top Rated' => "top-rated",
			'Featured Products' => "featured-products",
	      	'Sale Products' => "sale-products",
	      	'By Category' => "by-category",
	      	'By Product ID' => "by-id",
	      	),
	      "description" => "Select the order of the products you'd like to show."
	  ),
	  array(
	      "type" => "checkbox",
	      "heading" => "Product Category",
	      "param_name" => "cat",
	      "value" => thb_productCategories(),
	      "description" => "Select the order of the products you'd like to show.",
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category'))
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => "Product IDs",
	      "param_name" => "product_ids",
	      "description" => "Enter the products IDs you would like to display seperated by comma",
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-id'))
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => "Carousel",
	      "param_name" => "carousel",
	      "value" => array(
	      	'Yes' => "yes",
	      	'No' => "no",
	      	),
	      "description" => "Select yes to display the products in a carousel."
	  ),
	  array(
	      "type" => "textfield",
	      "class" => "",
	      "heading" => "Number of Items",
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => "The number of products to show.",
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category', 'sale-products', 'top-rated', 'latest-products', 'best-sellers'))
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => "Columns",
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => "Select the layout of the products."
	  ),
	),
	"description" => "Add WooCommerce products"
) );

// Product List
vc_map( array(
	"name" => __("Product List", 'north'),
	"base" => "thb_product_list",
	"icon" => "thb_vc_ico_product_list",
	"class" => "thb_vc_sc_product_list",
	"category" => "by Fuel Themes",
	"params"	=> array(
		array(
		    "type" => "textfield",
		    "class" => "",
		    "heading" => "Title",
		    "param_name" => "title",
		    "value" => "",
		    "admin_label" => true,
		    "description" => "Title of the widget"
		),
	  array(
	      "type" => "dropdown",
	      "heading" => "Product Sort",
	      "param_name" => "product_sort",
	      "value" => array(
	      	'Best Sellers' => "best-sellers",
	      	'Latest Products' => "latest-products",
	      	'Top Rated' => "top-rated",
	      	'Sale Products' => "sale-products",
	      	'By Product ID' => "by-id"
	      	),
	      "admin_label" => true,
	      "description" => "Select the order of the products you'd like to show."
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => "Product IDs",
	      "param_name" => "product_ids",
	      "description" => "Enter the products IDs you would like to display seperated by comma",
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-id'))
	  ),
	  array(
	      "type" => "textfield",
	      "class" => "",
	      "heading" => "Number of Items",
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => "The number of products to show.",
	      "dependency" => Array('element' => "product_sort", 'value' => array('by-category', 'sale-products', 'top-rated', 'latest-products', 'best-sellers'))
	  )
	),
	"description" => "Add WooCommerce products in a list"
) );

// Shop Grid
vc_map( array(
	"name" => __("Product Category Grid", 'north'),
	"base" => "thb_grid",
	"icon" => "thb_vc_ico_grid",
	"class" => "thb_vc_sc_grid",
	"category" => "by Fuel Themes",
	"params"	=> array(
		array(
		  "type" => "checkbox",
		  "heading" => "Product Category",
		  "param_name" => "cat",
		  "value" => thb_productCategories(),
		  "description" => "Select the categories you would like to display"
		),
		array(
		  "type" => "dropdown",
		  "heading" => "Style",
		  "param_name" => "style",
		  "admin_label" => true,
		  "value" => array(
				'Style 1' => "style1",
				'Style 2' => "style2",
				'Style 3' => "style3"
		  ),
		  "description" => "This applies different grid structures"
		)
	),
	"description" => "Display Product Category Grid"
) );

// Product Categories
vc_map( array(
	"name" => __("Product Categories", 'north'),
	"base" => "thb_product_categories",
	"icon" => "thb_vc_ico_product_categories",
	"class" => "thb_vc_sc_product_categories",
	"category" => "by Fuel Themes",
	"params"	=> array(
	  array(
	      "type" => "checkbox",
	      "heading" => "Product Category",
	      "param_name" => "cat",
	      "value" => thb_productCategories(),
	      "description" => "Select the categories you would like to display"
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => "Columns",
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => "Select the layout of the products."
	  ),
	),
	"description" => "Add WooCommerce product categories"
) );

// Posts
vc_map( array(
	"name" => __("Posts", 'north'),
	"base" => "thb_post",
	"icon" => "thb_vc_ico_post",
	"class" => "thb_vc_sc_post",
	"category" => "by Fuel Themes",
	"params"	=> array(
	  array(
	      "type" => "dropdown",
	      "heading" => "Carousel",
	      "param_name" => "carousel",
	      "value" => array(
	      	'Yes' => "yes",
	      	'No' => "no",
	      	),
	      "description" => "Select yes to display the products in a carousel."
	  ),
	  array(
	      "type" => "textfield",
	      "class" => "",
	      "heading" => "Number of posts",
	      "param_name" => "item_count",
	      "value" => "4",
	      "description" => "The number of posts to show."
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => "Columns",
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => "Select the layout of the posts."
	  ),
	  array(
	      "type" => "checkbox",
	      "heading" => "Post Categories",
	      "param_name" => "cat",
	      "value" => thb_blogCategories(),
	      "description" => "Which categories would you like to show?"
	  ),
	),
	"description" => "Display Posts from your blog"
) );

// Team Member shortcode
vc_map( array(
	"name" => "Team Member",
	"base" => "thb_teammember",
	"icon" => "thb_vc_ico_teammember",
	"class" => "thb_vc_sc_teammember",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"class" => "",
			"heading" => "Select Team Member Image",
			"param_name" => "image",
			"description" => "Minimum size is 270x270 pixels"
		),
		array(
		  "type" => "textfield",
		  "heading" => "Name",
		  "param_name" => "name",
		  "admin_label" => true,
		  "description" => "Enter name of the team member"
		),
		array(
		  "type" => "textfield",
		  "heading" => "Position",
		  "param_name" => "position",
		  "description" => "Enter position/title of the team member"
		),
		array(
		  "type" => "textfield",
		  "heading" => "Facebook",
		  "param_name" => "facebook",
		  "description" => "Enter Facebook Link"
		),
		array(
		  "type" => "textfield",
		  "heading" => "Twitter",
		  "param_name" => "twitter",
		  "description" => "Enter Twitter Link"
		),
		array(
		  "type" => "textfield",
		  "heading" => "Pinterest",
		  "param_name" => "pinterest",
		  "description" => "Enter Pinterest Link"
		),
		array(
		  "type" => "textfield",
		  "heading" => "Linkedin",
		  "param_name" => "linkedin",
		  "description" => "Enter Linkedin Link"
		)
	),
	"description" => "Display your team members in a stylish way"
) );

// Thumbnail Gallery Shortcode
vc_map( array(
	"name" => "Thumbnail Gallery",
	"base" => "thb_thumbnail_gallery",
	"icon" => "thb_vc_ico_thumbnail_gallery",
	"class" => "thb_vc_sc_thumbnail_gallery",
	"category" => "by Fuel Themes",
	"params" => array(
		array(
			"type" => "attach_images", //attach_images
			"class" => "",
			"heading" => "Select Images",
			"param_name" => "images",
			"admin_label" => true,
			"description" => ""
		)
	),
	"description" => "Add a thumbnail carousel"
) );