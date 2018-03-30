<?php
global $OTfields;
$orangeThemes_general_options= array(



/* ------------------------------------------------------------------------*
 * HOME SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "homepage_blocks",
	"title" => "Homepage Blocks:",
	"id" => $OTfields->themeslug."_homepage_blocks",
	"blocks" => array(
		array(
			"title" => "3 Info Block",
			"type" => "homepage_info_blocks",
			"options" => array(
				array( "type" => "title", "title" => "Block 1", "home" => "yes" ),
				array(
					"type" => "select",
					"title" => "Icon",
					"id" => $OTfields->themeslug."_homepage_info_blocks_icon_1",
					"options"=>ot_entypo_icons(),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_blocks_title_1", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_info_blocks_text_1", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_blocks_link_1", "title" => "Link:", "home" => "yes" ),
				array( "type" => "title", "title" => "Block 2", "home" => "yes" ),
				array(
					"type" => "select",
					"title" => "Icon",
					"id" => $OTfields->themeslug."_homepage_info_blocks_icon_2",
					"options"=>ot_entypo_icons(),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_blocks_title_2", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_info_blocks_text_2", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_blocks_link_2", "title" => "Link:", "home" => "yes" ),
				array( "type" => "title", "title" => "Block 3", "home" => "yes" ),
				array(
					"type" => "select",
					"title" => "Icon",
					"id" => $OTfields->themeslug."_homepage_info_blocks_icon_3",
					"options"=>ot_entypo_icons(),
					"home" => "yes"
				),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_blocks_title_3", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_info_blocks_text_3", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_blocks_link_3", "title" => "Link:", "home" => "yes" ),

			),
		),
		array(
			"title" => "Info Box",
			"type" => "homepage_info_box",
			"options" => array(
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_box_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_info_box_text", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_box_button", "title" => "Button Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_box_link", "title" => "Link:", "home" => "yes" ),
				array(
					"type" => "select",
					"title" => "Button Target",
					"id" => $OTfields->themeslug."_homepage_info_box_target",
					"options"=>array(
						array("slug"=>"_self", "name"=>"Self"), 
						array("slug"=>"_blank", "name"=>"Blank"),
						),

					"home" => "yes"
				)

			),
		),
		array(
			"title" => "2 Info Boxes",
			"type" => "homepage_info_boxes",
			"options" => array(
				array( "type" => "title", "title" => "Block 1", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_boxes_title_1", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_info_boxes_text_1", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_boxes_link_1", "title" => "Link:", "home" => "yes" ),
				array( "type" => "upload", "id" => $OTfields->themeslug."_homepage_info_boxes_image_1", "title" => "Image:", "home" => "yes" ),
				array( "type" => "title", "title" => "Block 2", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_boxes_title_2", "title" => "Title:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_info_boxes_text_2", "title" => "Text:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_info_boxes_link_2", "title" => "Link:", "home" => "yes" ),
				array( "type" => "upload", "id" => $OTfields->themeslug."_homepage_info_boxes_image_2", "title" => "Image:", "home" => "yes" ),

			),
		),
		array(
			"title" => "Latest Featured Products",
			"type" => "homepage_featured_products",
			"options" => array(
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_featured_products_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_featured_products_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_featured_products_count", "title" => "Post Count:", "max" => "50", "home" => "yes" ),

			),
		),
		array(
			"title" => "Latest News & Menu Card",
			"type" => "homepage_latest_news_and_menu",
			"options" => array(
				array( "type" => "title", "title" => "Latest News", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_and_menu_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_and_menu_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_latest_news_and_menu_count", "title" => "Post Count:", "max" => "50", "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $OTfields->themeslug."_homepage_latest_news_and_menu_news_cat",
					"taxonomy" => "category",
					"title" => "Category",
					"home" => "yes"
				),
				array( "type" => "title", "title" => "Menu Card", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_and_menu_title_menu", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_and_menu_subtitle_menu", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "multiple_select", "id" => $OTfields->themeslug."_homepage_latest_news_and_menu_cat", "taxonomy" => "product_cat", "title" => "Categories:", "home" => "yes" ),

			),
		),
		array(
			"title" => "Latest Events & Menu Card",
			"type" => "homepage_latest_events_menu",
			"options" => array(
				array( "type" => "title", "title" => "Latest Events", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_menu_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_menu_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_latest_events_menu_count", "title" => "Post Count:", "max" => "50", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $OTfields->themeslug."_homepage_latest_events_menu_post_age", 
					"title" => __("How long show held events?", THEME_NAME), 
					"options"=>array(
						array("slug"=>"0", "name"=>"0 Days"), 
						array("slug"=>"1", "name"=>"1 Day"),
						array("slug"=>"2", "name"=>"2 Days"),
						array("slug"=>"3", "name"=>"3 Days"),
						array("slug"=>"4", "name"=>"4 Days"),
						array("slug"=>"5", "name"=>"5 Days"),
						array("slug"=>"6", "name"=>"6 Days"),
						array("slug"=>"7", "name"=>"7 Days"),
						array("slug"=>"14", "name"=>"14 Days"),
						array("slug"=>"30", "name"=>"30 Days"),
					),
					"home" => "yes" 
				),
				array( "type" => "title", "title" => "Menu Card", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_menu_title_menu", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_menu_subtitle_menu", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "multiple_select", "id" => $OTfields->themeslug."_homepage_latest_events_menu_cat", "taxonomy" => "product_cat", "title" => "Categories:", "home" => "yes" ),

			),
		),
		array(
			"title" => "Menu Card & Text/Shortcodes",
			"type" => "homepage_menu_html",
			"options" => array(
				array( "type" => "title", "title" => "Menu Card", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_menu_html_title_menu", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_menu_html_subtitle_menu", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "multiple_select", "id" => $OTfields->themeslug."_homepage_menu_html_cat", "taxonomy" => "product_cat", "title" => "Categories:", "home" => "yes" ),
				array( "type" => "title", "title" => "Text Field", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_menu_html_title_html", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_menu_html_subtitle_html", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_menu_html_text", "title" => "Text/Shortcode/HTML:", "home" => "yes" ),
			),
		),
		array(
			"title" => "Latest News & Text/Shortcodes",
			"type" => "homepage_latest_news_html",
			"options" => array(
				array( "type" => "title", "title" => "Latest News", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_html_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_html_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_latest_news_html_count", "title" => "Post Count:", "max" => "50", "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $OTfields->themeslug."_homepage_latest_news_html_news_cat",
					"taxonomy" => "category",
					"title" => "Category",
					"home" => "yes"
				),
				array( "type" => "title", "title" => "Text Field", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_html_title_html", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_html_subtitle_html", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_latest_news_html_text", "title" => "Text/Shortcode/HTML:", "home" => "yes" ),

			),
		),
		array(
			"title" => "Latest News & Latest Events",
			"type" => "homepage_latest_news_events",
			"options" => array(
				array( "type" => "title", "title" => "Latest News", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_events_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_events_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_latest_news_events_count", "title" => "Post Count:", "max" => "50", "home" => "yes" ),
				array(
					"type" => "categories",
					"id" => $OTfields->themeslug."_homepage_latest_news_events_news_cat",
					"taxonomy" => "category",
					"title" => "Category",
					"home" => "yes"
				),
				array( "type" => "title", "title" => "Latest Events", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_events_title_2", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_news_events_subtitle_2", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_latest_news_events_count_2", "title" => "Post Count:", "max" => "50", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $OTfields->themeslug."_homepage_latest_news_events_post_age", 
					"title" => __("How long show held events?", THEME_NAME), 
					"options"=>array(
						array("slug"=>"0", "name"=>"0 Days"), 
						array("slug"=>"1", "name"=>"1 Day"),
						array("slug"=>"2", "name"=>"2 Days"),
						array("slug"=>"3", "name"=>"3 Days"),
						array("slug"=>"4", "name"=>"4 Days"),
						array("slug"=>"5", "name"=>"5 Days"),
						array("slug"=>"6", "name"=>"6 Days"),
						array("slug"=>"7", "name"=>"7 Days"),
						array("slug"=>"14", "name"=>"14 Days"),
						array("slug"=>"30", "name"=>"30 Days"),
					),
					"home" => "yes" 
				),
			),
		),
		array(
			"title" => "Latest Events & Text/Shortcode",
			"type" => "homepage_latest_events_and_html",
			"options" => array(
				array( "type" => "title", "title" => "Latest Events", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_and_html_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_and_html_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "scroller", "id" => $OTfields->themeslug."_homepage_latest_events_and_html_count", "title" => "Post Count:", "max" => "50", "home" => "yes" ),
				array( 
					"type" => "select", 
					"id" => $OTfields->themeslug."_homepage_latest_events_and_html_post_age", 
					"title" => __("How long show held events?", THEME_NAME), 
					"options"=>array(
						array("slug"=>"0", "name"=>"0 Days"), 
						array("slug"=>"1", "name"=>"1 Day"),
						array("slug"=>"2", "name"=>"2 Days"),
						array("slug"=>"3", "name"=>"3 Days"),
						array("slug"=>"4", "name"=>"4 Days"),
						array("slug"=>"5", "name"=>"5 Days"),
						array("slug"=>"6", "name"=>"6 Days"),
						array("slug"=>"7", "name"=>"7 Days"),
						array("slug"=>"14", "name"=>"14 Days"),
						array("slug"=>"30", "name"=>"30 Days"),
					),
					"home" => "yes" 
				),
				array( "type" => "title", "title" => "Text Field", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_and_html_title_html", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_latest_events_and_html_subtitle_html", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_latest_events_and_html_text", "title" => "Text/Shortcode/HTML:", "home" => "yes" ),

			),
		),

		array(
			"title" => "HTML Code",
			"type" => "homepage_html",
			"options" => array(
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_html_title", "title" => "Title:", "home" => "yes" ),
				array( "type" => "input", "id" => $OTfields->themeslug."_homepage_html_subtitle", "title" => "Subtitle:", "home" => "yes" ),
				array( "type" => "textarea", "id" => $OTfields->themeslug."_homepage_html", "title" => "HTML Code:", "home" => "yes" ),
			),
		),
	)
),


 
 );


$OTfields->add_options($orangeThemes_general_options);
?>