<?php
/*
  Plugin Name: Houzez Visual Composer Extensions
  Plugin URI: http://themeforest.net/user/favethemes
  Description: Extensions to Visual Composer for the Houzez theme.
  Version: 1.0
  Author: Favethemes
  Author URI: http://themeforest.net/user/favethemes
  License: GPLv2 or later
 */

// don't load directly
if ( !defined( 'ABSPATH' ) )
    die( '-1' );


if (class_exists('WPBakeryVisualComposer')) {

	$allowed_html_array = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
			'target' => array()
		)
	);

	vc_remove_element( "vc_wp_search" );
	vc_remove_element( "vc_wp_meta" );
	vc_remove_element( "vc_wp_recentcomments" );
	vc_remove_element( "vc_wp_calendar" );
	vc_remove_element( "vc_wp_pages" );
	vc_remove_element( "vc_wp_tagcloud" );
	vc_remove_element( "vc_wp_custommenu" );
	vc_remove_element( "vc_wp_text" );
	vc_remove_element( "vc_wp_posts" );
	vc_remove_element( "vc_wp_links" );
	vc_remove_element( "vc_wp_categories" );
	vc_remove_element( "vc_wp_archives" );
	vc_remove_element( "vc_wp_rss" );
	vc_remove_element( "vc_carousel" );
	vc_remove_element( "vc_posts_slider" );
	vc_remove_element( "vc_posts_grid" );
	vc_remove_element( "vc_basic_grid" );
	vc_remove_element( "vc_media_grid" );
	vc_remove_element( "vc_progress_bar" );
	vc_remove_element( "vc_pie" );
	vc_remove_element( "vc_flickr" );
	vc_remove_element( "vc_images_carousel" );
	vc_remove_element( "vc_masonry_grid" );
	vc_remove_element( "vc_masonry_media_grid" );

	/*** Remove unused parameters ***/
	if (function_exists('vc_remove_param')) {
		vc_remove_param('vc_row', 'font_color');
		//vc_remove_param('vc_row', 'vc_color-picker');
		//vc_remove_param('vc_tabs', 'interval');
		//vc_remove_param('vc_tabs', 'title');
	}

	$fontawesomeIcons = array(
		"fa-adn"                => "fa fa-adn",
		"fa-android"            => "fa-Android",
		"fa-apple"              => "fa-Apple",
		"fa-behance"            => "fa-Behance",
		"fa-bitbucket"          => "fa-Bitbucket",
		"fa-bitbucket-sign"     => "fa-Bitbucket-Sign",
		"fa-bitcoin"            => "fa-Bitcoin",
		"fa-btc"                => "fa-BTC",
		"fa-css3"               => "fa-CSS3",
		"fa-codepen"            => "fa-Codepen",
		"fa-digg"            	=> "fa-Digg",
		"fa-drupal"            	=> "fa-Drupal",
		"fa-dribbble"           => "fa-Dribbble",
		"fa-dropbox"            => "fa-Dropbox",
		"fa-envelope"           => "fa-E-mail",
		"fa-facebook"           => "fa-Facebook",
		"fa-facebook-sign"      => "fa-Facebook-Sign",
		"fa-flickr"             => "fa-Flickr",
		"fa-foursquare"         => "fa-Foursquare",
		"fa-github"             => "fa-GitHub",
		"fa-github-alt"         => "fa-GitHub-Alt",
		"fa-github-sign"        => "fa-GitHub-Sign",
		"fa-gittip"             => "fa-Gittip",
		"fa-google"             => "fa-Google",
		"fa-google-plus"        => "fa-Google Plus",
		"fa-google-plus-sign"   => "fa-Google Plus-Sign",
		"fa-html5"              => "fa-HTML5",
		"fa-instagram"          => "fa-Instagram",
		"fa-linkedin"           => "fa-LinkedIn",
		"fa-linkedin-sign"      => "fa-LinkedIn-Sign",
		"fa-linux"              => "fa-Linux",
		"fa-maxcdn"             => "fa-MaxCDN",
		"fa-paypal"             => "fa-Paypal",
		"fa-pinterest"          => "fa-Pinterest",
		"fa-pinterest-sign"     => "fa-Pinterest-Sign",
		"fa-reddit"     		=> "fa-Reddit",
		"fa-renren"             => "fa-Renren",
		"fa-skype"              => "fa-Skype",
		"fa-stackexchange"      => "fa-StackExchange",
		"fa-soundcloud"      	=> "fa-Soundcloud",
		"fa-spotify"      		=> "fa-Spotify",
		"fa-trello"             => "fa-Trello",
		"fa-tumblr"             => "fa-Tumblr",
		"fa-tumblr-sign"        => "fa-Tumblr-Sign",
		"fa-twitter"            => "fa-Twitter",
		"fa-twitter-sign"       => "fa-Twitter-Sign",
		"fa-vimeo-square"       => "fa-Vimeo-Square",
		"fa-vk"                 => "fa-VK",
		"fa-weibo"              => "fa-Weibo",
		"fa-windows"            => "fa-Windows",
		"fa-xing"               => "fa-Xing",
		"fa-xing-sign"          => "Xing-Sign",
		"fa-yahoo"          	=> "Yahoo",
		"fa-youtube"            => "YouTube",
		"fa-youtube-play"       => "YouTube Play",
		"fa-youtube-sign"       => "YouTube-Sign"
	);

	$of_categories 			= array();
	$of_categories_obj 		= get_categories( array( 'hide_empty' => 1, 'hierarchical' => true ) );

	foreach ( $of_categories_obj as $of_category ) {
	    $of_categories[$of_category->name] = $of_category->term_id; 
	}
	$categories_buffer['- All categories -'] = '';

	$of_categories = array_merge(
            $categories_buffer,
            $of_categories
        );
	//$of_categories_tmp 		= array_unshift($of_categories, "All");

	$of_tags 			= array();
	$of_tags_obj 		= get_tags( array( 'hide_empty' => 1 ) );

	foreach ( $of_tags_obj as $of_tag ) {
	    $of_tags[$of_tag->name] = $of_tag->term_id; 
	}

	/*---------------------------------------------------------------------------------
		Section Title
	-----------------------------------------------------------------------------------*/
	vc_map( array(
		"name"	=>	esc_html__( "Section Title", "houzez" ),
		"description"			=> '',
		"base"					=> "hz-section-title",
		'category'				=> "By Favethemes",
		"class"					=> "",
		'admin_enqueue_js'		=> "",
		'admin_enqueue_css'		=> "",
		"icon" 					=> "icon-section-title",
		"params"				=> array(
			array(
				"param_name" => "hz_section_title",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Title:", "houzez" ),
				"description" => esc_html__( "Enter section title", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "hz_section_subtitle",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Sub Title:", "houzez" ),
				"description" => esc_html__( "Enter section sub title", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "hz_section_title_align",
				"type" => "dropdown",
				"value" => array( 'Center Align' => 'text-center', 'Left Align' => 'text-left', 'Right Align' => 'text-right' ),
				"heading" => esc_html__("Align:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "hz_section_title_color",
				"type" => "dropdown",
				"value" => array( 'Default' => '', 'Light' => 'houzez-section-title-light', 'Dark' => 'houzez-section-title-dark' ),
				"heading" => esc_html__("Title Color Scheme", "houzez" ),
				"save_always" => true
			),
		) // end params
	) );

	/*---------------------------------------------------------------------------------
		Space
	-----------------------------------------------------------------------------------*/
	vc_map( array(
		"name" => __("Empty Space", "houzez"),
		"icon" => "icon-wpb-ui-empty_space",
		"base" => "houzez-space",
		"description" => "Add space between elements, Also can be use for clear floating",
		"class" => "space_extended",
		"category" => __("By Favethemes", "houzez"),
		"params" => array(
			array(
				"type" => "textfield",
				"admin_label" => true,
				"heading" => __("Height of the space(px)", "houzez"),
				"param_name" => "height",
				"value" => 50,
				"description" => __("Set height of the space. You can add white space between elements to separate them beautifully.", "houzez")
			)
		)
	) );

	/*---------------------------------------------------------------------------------
		Section Search
	-----------------------------------------------------------------------------------*/
	vc_map( array(
		"name"	=>	esc_html__( "Advanced Search", "houzez" ),
		"description"			=> '',
		"base"					=> "hz-advance-search",
		'category'				=> "By Favethemes",
		"class"					=> "",
		'admin_enqueue_js'		=> "",
		'admin_enqueue_css'		=> "",
		"icon" 					=> "icon-advance-search",
		"params"				=> array(
			array(
				"param_name" => "search_title",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Title:", "houzez" ),
				"description" => esc_html__( "Enter section title", "houzez" ),
				"save_always" => true
			)
		) // end params
	) );

	/*---------------------------------------------------------------------------------
		Location Grid Section
	-----------------------------------------------------------------------------------*/
	vc_map( array(
		"name"	=>	esc_html__( "Houzez Grids", "houzez" ),
		"description"			=> 'Show Locations, Property Types, Cities, States in grid',
		"base"					=> "hz-grids",
		'category'				=> "By Favethemes",
		"class"					=> "",
		'admin_enqueue_js'		=> "",
		'admin_enqueue_css'		=> "",
		"icon" 					=> "icon-hz-grid",
		"params"				=> array(

			array(
				"param_name" => "houzez_grid_type",
				"type" => "dropdown",
				"value" => array( 'Grid v1' => 'grid_v1', 'Grid v2' => 'grid_v2'/*, 'Grid v3' => 'grid_v3'*/ ),
				"heading" => esc_html__("Choose Grid:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "houzez_grid_from",
				"type" => "dropdown",
				"value" => array( 'Property Types' => 'property_type', 'Property City' => 'property_city', 'Property State/County' => 'property_state', 'Property Neighborhood' => 'property_area' ),
				"heading" => esc_html__("Taxonomy:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "houzez_show_child",
				"type" => "dropdown",
				"value" => array( 'No' => '0', 'Yes' => '1' ),
				"heading" => esc_html__("Show Child:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "orderby",
				"type" => "dropdown",
				"value" => array( 'Name' => 'name', 'Count' => 'count', 'ID' => 'id' ),
				"heading" => esc_html__("Order By:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "order",
				"type" => "dropdown",
				"value" => array( 'ASC' => 'ASC', 'DESC' => 'DESC' ),
				"heading" => esc_html__("Order:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "houzez_hide_empty",
				"type" => "dropdown",
				"value" => array( 'Yes' => '1', 'No' => '0' ),
				"heading" => esc_html__("Hide Empty:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "no_of_terms",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Number of Items to Show:", "houzez" ),
				"save_always" => true
			),
			array(
				"param_name" => "property_type_exc",
				"type" => "checkbox",
				"value" => houzez_get_property_type_id_array(false),
				"heading" => esc_html__("Exclude Types:", "houzez"),
				"description" => "",
				"save_always" => true,
				"dependency" => Array("element" => "houzez_grid_from", "value" => array("property_type")),
				"group" => 'Exclude'
			),
			array(
				"param_name" => "property_city_exc",
				"type" => "checkbox",
				"value" => houzez_get_property_city_id_array(false),
				"heading" => esc_html__("Exclude Cities:", "houzez"),
				"description" => "",
				"save_always" => true,
				"dependency" => Array("element" => "houzez_grid_from", "value" => array("property_city")),
				"group" => 'Exclude'
			),
			/*array(
				"param_name" => "property_area_exc",
				"type" => "checkbox",
				"value" => houzez_get_property_area_id_array(false),
				"heading" => esc_html__("Exclude Neighborhood:", "houzez"),
				"description" => "",
				"save_always" => true,
				"dependency" => Array("element" => "houzez_grid_from", "value" => array("property_area")),
				"group" => 'Exclude'
			),*/
			array(
				"param_name" => "property_state_exc",
				"type" => "checkbox",
				"value" => houzez_get_property_state_slug_array(false),
				"heading" => esc_html__("Exclude County/State:", "houzez"),
				"description" => "",
				"save_always" => true,
				"dependency" => Array("element" => "houzez_grid_from", "value" => array("property_state")),
				"group" => 'Exclude'
			),

		) // end params
	) );

	/*---------------------------------------------------------------------------------
	 Property Carousel
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Properties Carousel V1", "houzez"),
		"description" => '',
		"base" => "houzez-prop-carousel",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-carousel",
		"params" => array(


			array(
				"param_name" => "property_type",
				"type" => "dropdown",
				"value" => houzez_get_property_type_slug_array(),
				"heading" => esc_html__("Property Type filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_status",
				"type" => "dropdown",
				"value" => houzez_get_property_status_slug_array(),
				"heading" => esc_html__("Property Status filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_city",
				"type" => "dropdown",
				"value" => houzez_get_property_city_slug_array(),
				"heading" => esc_html__("Property City filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "property_area",
				"type" => "dropdown",
				"value" => houzez_get_property_area_slug_array(),
				"heading" => esc_html__("Property Area filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "featured_prop",
				"type" => "dropdown",
				"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
				"heading" => esc_html__("Featured Properties:", "houzez"),
				"description" => esc_html__("You can make a post featured by clicking featured properties checkbox while add/edit post", "houzez"),
			),

			array(
				"param_name" => "property_ids",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Properties IDs:", "houzez"),
				"description" => esc_html__("Enter properties ids comma separated. Ex 12,305,34", "houzez"),
				"save_always" => true
			),

			array(
				"param_name" => "slides_meta_position",
				"type" => "dropdown",
				"value" => array(
					'Above Image' => 'caption-above',
					'Bottom ( Recommended for more then 3 columns )' => 'caption-bottom'
				),
				"heading" => esc_html__("Meta Position:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "9",
				"heading" => esc_html__("Limit post number:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "custom_title",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Title:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "all_btn",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("All - Button Text:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "all_url",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("All - button url:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "slides_to_show",
				"type" => "dropdown",
				"value" => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6'
				),
				"heading" => esc_html__("Slides To Show:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slides_to_scroll",
				"type" => "dropdown",
				"value" => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6'
				),
				"heading" => esc_html__("Slides To Scroll:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slide_infinite",
				"type" => "dropdown",
				"value" => array(
					'Yes' => 'true',
					'No' => 'false'
				),
				"heading" => esc_html__("Infinite Scroll:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slide_auto",
				"type" => "dropdown",
				"value" => array(
					'No' => 'false',
					'Yes' => 'true'
				),
				"heading" => esc_html__("Auto Play:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "auto_speed",
				"type" => "textfield",
				"value" => '3000',
				"heading" => esc_html__("Auto Play Speed:", "houzez"),
				"description" => "Autoplay Speed in milliseconds. Default 3000",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "navigation",
				"type" => "dropdown",
				"value" => array(
					'Yes' => 'true',
					'No' => 'false'
				),
				"heading" => esc_html__("Next/Prev Navigation:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slide_dots",
				"type" => "dropdown",
				"value" => array(
					'Yes' => 'true',
					'No' => 'false'
				),
				"heading" => esc_html__("Dots Nav:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			)



		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property Carousel Version 2
	-----------------------------------------------------------------------------------*/

	vc_map(array(
		"name" => esc_html__("Properties Carousel V2", "houzez"),
		"description" => '',
		"base" => "houzez-prop-carousel-v2",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-carousel-v2",
		"params" => array(

			array(
				"param_name" => "prop_grid_style",
				"type" => "dropdown",
				"value" => array('Version 1' => 'v_1', 'Version 2' => 'v_2'),
				"heading" => esc_html__("Grid Style:", "houzez"),
				"description" => esc_html__("Choose grid style, default will be version 1", "houzez"),
				"save_always" => true
			),

			array(
				"param_name" => "property_type",
				"type" => "dropdown",
				"value" => houzez_get_property_type_slug_array(),
				"heading" => esc_html__("Property Type filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_status",
				"type" => "dropdown",
				"value" => houzez_get_property_status_slug_array(),
				"heading" => esc_html__("Property Status filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_city",
				"type" => "dropdown",
				"value" => houzez_get_property_city_slug_array(),
				"heading" => esc_html__("Property City filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_area",
				"type" => "dropdown",
				"value" => houzez_get_property_area_slug_array(),
				"heading" => esc_html__("Property Area filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "featured_prop",
				"type" => "dropdown",
				"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
				"heading" => esc_html__("Featured Properties:", "houzez"),
				"description" => esc_html__("You can make a post featured by clicking featured properties checkbox while add/edit post", "houzez"),
				"save_always" => true
			),

			array(
				"param_name" => "property_ids",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Properties IDs:", "houzez"),
				"description" => esc_html__("Enter properties ids comma separated. Ex 12,305,34", "houzez"),
				"save_always" => true
			),

			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "9",
				"heading" => esc_html__("Limit post number:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "custom_title",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Title:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "all_btn",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("All - Button Text:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "all_url",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("All - button url:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "slide_auto",
				"type" => "dropdown",
				"value" => array(
					'No' => 'false',
					'Yes' => 'true'
				),
				"heading" => esc_html__("Auto Play:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slide_infinite",
				"type" => "dropdown",
				"value" => array(
					'Yes' => 'true',
					'No' => 'false'
				),
				"heading" => esc_html__("Infinite Scroll:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "auto_speed",
				"type" => "textfield",
				"value" => '3000',
				"heading" => esc_html__("Auto Play Speed:", "houzez"),
				"description" => "Autoplay Speed in milliseconds. Default 3000",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slides_to_scroll",
				"type" => "dropdown",
				"value" => array(
					'1' => '1',
					'2' => '2',
					'3' => '3'
				),
				"heading" => esc_html__("Slides To Scroll:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "navigation",
				"type" => "dropdown",
				"value" => array(
					'Yes' => 'true',
					'No' => 'false'
				),
				"heading" => esc_html__("Next/Prev Navigation:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			),
			array(
				"param_name" => "slide_dots",
				"type" => "dropdown",
				"value" => array(
					'Yes' => 'true',
					'No' => 'false'
				),
				"heading" => esc_html__("Dots Nav:", "houzez"),
				"description" => "",
				"save_always" => true,
				"group" => 'Carousel Settings'
			)



		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property grids
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Properties", "houzez"),
		"description" => '',
		"base" => "houzez-properties",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-properties",
		"params" => array(
			array(
				"param_name" => "prop_grid_style",
				"type" => "dropdown",
				"value" => array('Version 1' => 'v_1', 'Version 2' => 'v_2'),
				"heading" => esc_html__("Grid/List Style:", "houzez"),
				"description" => esc_html__("Choose grid/list style, default will be version 1", "houzez"),
				"save_always" => true
			),
			array(
				"param_name" => "module_type",
				"type" => "dropdown",
				"value" => array(' Grid 3 Columns ' => 'grid_3_cols', 'Grid 2 Columns' => 'grid_2_cols', 'list' => 'list'),
				"heading" => esc_html__("Layout:", "houzez"),
				"description" => '',
				"save_always" => true,
			),

			array(
				"param_name" => "property_type",
				"type" => "dropdown",
				"value" => houzez_get_property_type_slug_array(),
				"heading" => esc_html__("Property Type filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_status",
				"type" => "dropdown",
				"value" => houzez_get_property_status_slug_array(),
				"heading" => esc_html__("Property Status filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_city",
				"type" => "dropdown",
				"value" => houzez_get_property_city_slug_array(),
				"heading" => esc_html__("Property City filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_area",
				"type" => "dropdown",
				"value" => houzez_get_property_area_slug_array(),
				"heading" => esc_html__("Property Area filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "featured_prop",
				"type" => "dropdown",
				"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
				"heading" => esc_html__("Featured Properties:", "houzez"),
				"description" => esc_html__("You can make a post featured by clicking featured properties checkbox while add/edit post", "houzez"),
				"save_always" => true
			),

			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "3",
				"heading" => esc_html__("Limit post number:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			)

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property By ID
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Property by ID", "houzez"),
		"description" => esc_html__('Show single property by id', "houzez"),
		"base" => "houzez-prop-by-id",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-by-id",
		"params" => array(
			array(
				"param_name" => "prop_grid_style",
				"type" => "dropdown",
				"value" => array('Version 1' => 'v_1', 'Version 2' => 'v_2'),
				"heading" => esc_html__("Grid/List Style:", "houzez"),
				"description" => esc_html__("Choose grid/list style, default will be version 1", "houzez"),
				"save_always" => true
			),
			array(
				"param_name" => "property_id",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Property ID:", "houzez"),
				"description" => esc_html__("Enter property ID. Ex 305", "houzez"),
				"save_always" => true
			)

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property By ID
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Properties by IDs", "houzez"),
		"description" => esc_html__("Show properties by IDs", "houzez"),
		"base" => "houzez-prop-by-ids",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-by-ids",
		"params" => array(
			array(
				"param_name" => "prop_grid_style",
				"type" => "dropdown",
				"value" => array('Version 1' => 'v_1', 'Version 2' => 'v_2'),
				"heading" => esc_html__("Grid/List Style:", "houzez"),
				"description" => esc_html__("Choose grid/list style, default will be version 1", "houzez"),
				"save_always" => true
			),
			array(
				"param_name" => "property_ids",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Properties IDs:", "houzez"),
				"description" => esc_html__("Enter properties ids comma separated. Ex 12,305,34", "houzez"),
				"save_always" => true
			)

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property grids
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Properties Grids", "houzez"),
		"description" => '',
		"base" => "houzez-prop-grids",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-grids",
		"params" => array(


			array(
				"param_name" => "prop_grid_type",
				"type" => "dropdown",
				"value" => array(' Grid 1 ' => 'grid_1', 'Grid 2' => 'grid_2', 'Grid 3' => 'grid_3', 'Grid 4' => 'grid_4'),
				"heading" => esc_html__("Grid Style:", "houzez"),
				"description" => '',
				"save_always" => true,
			),
			array(
				"param_name" => "property_type",
				"type" => "dropdown",
				"value" => houzez_get_property_type_slug_array(),
				"heading" => esc_html__("Property Type filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_status",
				"type" => "dropdown",
				"value" => houzez_get_property_status_slug_array(),
				"heading" => esc_html__("Property Status filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_city",
				"type" => "dropdown",
				"value" => houzez_get_property_city_slug_array(),
				"heading" => esc_html__("Property City filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "property_area",
				"type" => "dropdown",
				"value" => houzez_get_property_area_slug_array(),
				"heading" => esc_html__("Property Area filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "featured_prop",
				"type" => "dropdown",
				"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
				"heading" => esc_html__("Featured Properties:", "houzez"),
				"description" => esc_html__("You can make a post featured by clicking featured properties checkbox while add/edit post", "houzez"),
				"save_always" => true
			),

			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "9",
				"heading" => esc_html__("Limit post number:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "custom_title",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Title:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "all_btn",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("All - Button Text:", "houzez"),
				"description" => "",

			),
			array(
				"param_name" => "all_url",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("All - button url:", "houzez"),
				"description" => "",
				"save_always" => true

			)



		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property Carousel
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Properties Map", "houzez"),
		"description" => '',
		"base" => "houzez-properties-map",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-map",
		"params" => array(

			array(
				"param_name" => "property_city",
				"type" => "dropdown",
				"value" => houzez_get_property_city_slug_array(),
				"heading" => esc_html__("Property City filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "property_status",
				"type" => "dropdown",
				"value" => houzez_get_property_status_slug_array(),
				"heading" => esc_html__("Property Status filter:", "houzez"),
				"description" => "",
				"save_always" => true

			),

			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Limit post number:", "houzez"),
				"description" => esc_html__("Enter -1 to show all", "houzez"),
				"save_always" => true
			)

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Price Tables
	-----------------------------------------------------------------------------------*/
	$packages_array = array( esc_html__('None', 'houzez') => '');
	$packages_posts = get_posts(array('post_type' => 'houzez_packages', 'posts_per_page' => -1, 'suppress_filters' => 0));
	if (!empty($packages_posts)) {
		foreach ($packages_posts as $package_post) {
			$packages_array[$package_post->post_title] = $package_post->ID;
		}
	}

	vc_map(array(
		"name" => esc_html__("Price Table", "houzez"),
		"description" => '',
		"base" => "houzez-price-table",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-price",
		"params" => array(

			array(
				"param_name" => "package_id",
				"type" => "dropdown",
				"value" => $packages_array,
				"heading" => esc_html__("Select Package:", "houzez"),
				"description" => "",
				"save_always" => true
			),

			array(
				"param_name" => "package_data",
				"type" => "dropdown",
				"value" => array('Get Data From Package' => 'dynamic', 'Add Custom Data' => 'custom'),
				"heading" => esc_html__("Data Type:", "houzez"),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "package_popular",
				"type" => "dropdown",
				"value" => array('No' => 'no', 'Yes' => 'yes'),
				"heading" => esc_html__("Popular?", "houzez"),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "package_name",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Package Name:", "houzez"),
				"description" => '',
				"dependency" => Array("element" => "package_data", "value" => array("custom")),
				"save_always" => true
			),
			array(
				"param_name" => "package_price",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Package Price:", "houzez"),
				"description" => '',
				"dependency" => Array("element" => "package_data", "value" => array("custom")),
				"save_always" => true
			),
			array(
				"param_name" => "package_decimal",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Package Decimal:", "houzez"),
				"description" => esc_html__("Enter price decimal, IE .99", "houzez"),
				"dependency" => Array("element" => "package_data", "value" => array("custom")),
				"save_always" => true
			),
			array(
				"param_name" => "package_currency",
				"type" => "textfield",
				"value" => "$",
				"heading" => esc_html__("Package Currency:", "houzez"),
				"description" => '',
				"dependency" => Array("element" => "package_data", "value" => array("custom")),
				"save_always" => true
			),
			array(
				"param_name" => "content",
				"type" => "textarea_html",
				"value" => '<ul>
 	<li><i class="fa fa-check"></i> Time Period: <strong>10 days</strong></li>
 	<li><i class="fa fa-check"></i> Properties: <strong>2</strong></li>
 	<li><i class="fa fa-check"></i> Featured Listings: <strong>2</strong></li>
</ul>',
				"heading" => esc_html__("Content:", "houzez"),
				"description" => '',
				"dependency" => Array("element" => "package_data", "value" => array("custom")),
				"save_always" => true
			),
			array(
				"param_name" => "package_btn_text",
				"type" => "textfield",
				"value" => "Get Started",
				"heading" => esc_html__("Button Text:", "houzez"),
				"description" => '',
				"dependency" => Array("element" => "package_data", "value" => array("custom")),
				"save_always" => true
			),

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Property Carousel
	-----------------------------------------------------------------------------------*/
	vc_map(array(
		"name" => esc_html__("Team", "houzez"),
		"description" => '',
		"base" => "houzez-team",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-team",
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => "Image",
				"param_name" => "team_image",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Name", "houzez"),
				"param_name" => "team_name",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Position", "houzez"),
				"param_name" => "team_position",
				"save_always" => true
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Description", "houzez"),
				"param_name" => "team_description",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Custom Link", "houzez"),
				"param_name" => "team_link",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Facebook Profile Link", "houzez"),
				"param_name" => "team_social_facebook",
				"save_always" => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Facebook Target",
				"param_name" => "team_social_facebook_target",
				"value" => array(
					"" => "",
					"Self" => "_self",
					"Blank" => "_blank",
					"Parent" => "_parent"
				),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Twitter Profile Link", "houzez"),
				"param_name" => "team_social_twitter",
				"save_always" => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Twitter Target",
				"param_name" => "team_social_twitter_target",
				"value" => array(
					"" => "",
					"Self" => "_self",
					"Blank" => "_blank",
					"Parent" => "_parent"
				),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("LinkedIn Profile Link", "houzez"),
				"param_name" => "team_social_linkedin",
				"save_always" => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "LinkedIn Target",
				"param_name" => "team_social_linkedin_target",
				"value" => array(
					"" => "",
					"Self" => "_self",
					"Blank" => "_blank",
					"Parent" => "_parent"
				),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Pinterest Profile Link", "houzez"),
				"param_name" => "team_social_pinterest",
				"save_always" => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Pinerest Target",
				"param_name" => "team_social_pinterest_target",
				"value" => array(
					"" => "",
					"Self" => "_self",
					"Blank" => "_blank",
					"Parent" => "_parent"
				),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__("Google Plus Profile Link", "houzez"),
				"param_name" => "team_social_googleplus",
				"save_always" => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Google Plus Target",
				"param_name" => "team_social_googleplus_target",
				"value" => array(
					"" => "",
					"Self" => "_self",
					"Blank" => "_blank",
					"Parent" => "_parent"
				),
				"description" => "",
				"save_always" => true
			),

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Testimonials
	-----------------------------------------------------------------------------------*/

	vc_map(array(
		"name" => esc_html__("Testimonials", "houzez"),
		"description" => 'Show testimonials grid or slides',
		"base" => "houzez-testimonials",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-testimonials",
		"params" => array(

			array(
				"param_name" => "testimonials_type",
				"type" => "dropdown",
				"value" => array('Grid' => 'grid', 'Slides' => 'slides'),
				"heading" => esc_html__("Testimonials Type:", "houzez"),
				"description" => '',
				"save_always" => true,
			),
			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "6",
				"heading" => esc_html__("Limit:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "orderby",
				"type" => "dropdown",
				"value" => array('None' => 'none', 'ID' => 'ID', 'title' => 'title', 'Date' => 'date', 'Random' => 'rand', 'Menu Order' => 'menu_order' ),
				"heading" => esc_html__("Order By:", "houzez"),
				"description" => '',
				"save_always" => true,
			),
			array(
				"param_name" => "order",
				"type" => "dropdown",
				"value" => array('ASC' => 'ASC', 'DESC' => 'DESC' ),
				"heading" => esc_html__("Order:", "houzez"),
				"description" => '',
				"save_always" => true,
			),

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Agents
	-----------------------------------------------------------------------------------*/

	vc_map(array(
		"name" => esc_html__("Agents", "houzez"),
		"description" => 'Show agents grid or carousel',
		"base" => "houzez-agents",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-agents",
		"params" => array(

			array(
				"param_name" => "agents_type",
				"type" => "dropdown",
				"value" => array('Grid' => 'grid', 'Carousel' => 'Carousel'),
				"heading" => esc_html__("Agents Type:", "houzez"),
				"description" => '',
				"save_always" => true,
			),
			array(
				"param_name" => "agent_category",
				"type" => "dropdown",
				"value" => houzez_get_agent_category_slug_array(),
				"heading" => esc_html__("Category filter:", "houzez"),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "custom_title",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Title:", "houzez"),
				"description" => "",
				"dependency" => Array("element" => "agents_type", "value" => array("Carousel")),
				"save_always" => true
			),
			array(
				"param_name" => "custom_subtitle",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Sub Title:", "houzez"),
				"description" => "",
				"dependency" => Array("element" => "agents_type", "value" => array("Carousel")),
				"save_always" => true
			),
			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "8",
				"heading" => esc_html__("Limit:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "orderby",
				"type" => "dropdown",
				"value" => array('None' => 'none', 'ID' => 'ID', 'title' => 'title', 'Date' => 'date', 'Random' => 'rand', 'Menu Order' => 'menu_order' ),
				"heading" => esc_html__("Order By:", "houzez"),
				"description" => '',
				"save_always" => true,
			),
			array(
				"param_name" => "order",
				"type" => "dropdown",
				"value" => array('ASC' => 'ASC', 'DESC' => 'DESC' ),
				"heading" => esc_html__("Order:", "houzez"),
				"description" => '',
				"save_always" => true,
			),

		) // End params
	));

	/*---------------------------------------------------------------------------------
	 Agents
	-----------------------------------------------------------------------------------*/

	vc_map(array(
		"name" => esc_html__("Partners", "houzez"),
		"description" => '',
		"base" => "houzez-partners",
		'category' => "By Favethemes",
		"class" => "",
		'admin_enqueue_js' => "",
		'admin_enqueue_css' => "",
		"icon" => "icon-prop-partners",
		"params" => array(

			array(
				"param_name" => "custom_title",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Title:", "houzez"),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "custom_subtitle",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Optional - Custom Sub Title:", "houzez"),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => "8",
				"heading" => esc_html__("Limit:", "houzez"),
				"description" => "",
				"save_always" => true,
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => "",
				"heading" => esc_html__("Offset posts:", "houzez"),
				"description" => "",
				"save_always" => true

			),
			array(
				"param_name" => "orderby",
				"type" => "dropdown",
				"value" => array('None' => 'none', 'ID' => 'ID', 'title' => 'title', 'Date' => 'date', 'Random' => 'rand', 'Menu Order' => 'menu_order' ),
				"heading" => esc_html__("Order By:", "houzez"),
				"description" => '',
				"save_always" => true,
			),
			array(
				"param_name" => "order",
				"type" => "dropdown",
				"value" => array('ASC' => 'ASC', 'DESC' => 'DESC' ),
				"heading" => esc_html__("Order:", "houzez"),
				"description" => '',
				"save_always" => true,
			),

		) // End params
	));

	class WPBakeryShortCode_Text_With_Icons  extends WPBakeryShortCodesContainer {}

	vc_map( array(
		"name" => "Text With Icons",
		"base" => "text_with_icons",
		"as_parent" => array('only' => 'text_with_icon'),
		"content_element" => true,
		"category" => 'By Favethemes',
		"icon" => "icon-text_with_icon",
		"show_settings_on_create" => true,
		"params" => array(

			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Style",
				"param_name" => "style",
				"value" => array(
					"Style One"     => "style_one",
					"Style Two"      => "style_two"
				),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Columns",
				"param_name" => "columns",
				"value" => array(
					"Three"     => "three_columns",
					"Four"      => "four_columns"
				),
				"description" => "",
				"save_always" => true
			)
		),
		"js_view" => 'VcColumnView'
	) );

	class WPBakeryShortCode_Text_With_Icon extends WPBakeryShortCode {}
	vc_map( array(
		"name" => "Text with icon",
		"base" => "text_with_icon",
		"icon" => "icon-text_with_icon",
		"content_element" => true,
		"as_child" => array('only' => 'text_with_icons'),
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => "Icon Type",
				"param_name" => "icon_type",
				"value" => array(
					"Font Awesome"   => "fontawesome_icon",
					"Custom Icon"   => "custom_icon"
				),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => "Icon",
				"param_name" => "font_awesome_icon",
				"value" => $fontawesomeIcons,
				"description" => wp_kses(__("Please set an icon. The entire list of icons can be found at <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>FontAwesome project page</a>. For example, if an icon is named 'fa-angle-right', the value you have to add inside the field is 'angle-right'.", "houzez"), $allowed_html_array),
				"dependency" => Array('element' => "icon_type", 'value' => array('fontawesome_icon')),
				"save_always" => true
			),
			array(
				"type" => "attach_image",
				"class" => "",
				"heading" => "Icon",
				"param_name" => "custom_icon",
				"description" => "",
				"dependency" => Array('element' => "icon_type", 'value' => array('custom_icon')),
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Title",
				"param_name" => "title",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => "Text",
				"param_name" => "text",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Read More Text",
				"param_name" => "read_more_text",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => "Read More Link",
				"param_name" => "read_more_link",
				"description" => "",
				"save_always" => true
			),
		)
	) );

	/*---------------------------------------------------------------------------------
		Blog Posts Grids
	-----------------------------------------------------------------------------------*/
	vc_map( array(
		"name"					=> esc_html__( "Blog Posts Grid", "houzez" ),
		"description"			=> '',
		"base"					=> "houzez-blog-posts",
		'category'				=> "By Favethemes",
		"class"					=> "",
		'admin_enqueue_js'		=> "",
		'admin_enqueue_css'		=> "",
		"icon" 					=> "icon-blog-posts",
		"params"				=> array(
			array(
				"param_name" => "grid_style",
				"type" => "dropdown",
				"value" => array(
					"Style 1"   => "style_1",
					"Style 2"   => "style_2"
				),
				"heading" => esc_html__("Grid Style:", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "category_id",
				"type" => "dropdown",
				"value" => houzez_get_category_id_array(),
				"heading" => esc_html__("Category filter:", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Offset", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Number of posts to show", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title", "houzez" ),
				"param_name" => "title",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Subtitle", "houzez" ),
				"param_name" => "sub_title",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"value" => 'All',
				"heading" => esc_html__("All Posts Text", "houzez" ),
				"param_name" => "all_btn",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"value" => '',
				"heading" => esc_html__("All Posts Link", "houzez" ),
				"param_name" => "all_url",
				"description" => "",
				"save_always" => true
			),
		) // End params
	) );

	/*---------------------------------------------------------------------------------
		Blog Posts Carousels
	-----------------------------------------------------------------------------------*/
	vc_map( array(
		"name"					=> esc_html__( "Blog Posts Carousel", "houzez" ),
		"description"			=> '',
		"base"					=> "houzez-blog-posts-carousel",
		'category'				=> "By Favethemes",
		"class"					=> "",
		'admin_enqueue_js'		=> "",
		'admin_enqueue_css'		=> "",
		"icon" 					=> "icon-blog-posts-carousel",
		"params"				=> array(
			array(
				"param_name" => "grid_style",
				"type" => "dropdown",
				"value" => array(
					"Style 1"   => "style_1",
					"Style 2"   => "style_2"
				),
				"heading" => esc_html__("Grid Style:", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "category_id",
				"type" => "dropdown",
				"value" => houzez_get_category_id_array(),
				"heading" => esc_html__("Category filter:", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "offset",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Offset", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"param_name" => "posts_limit",
				"type" => "textfield",
				"value" => '',
				"heading" => esc_html__("Number of posts to show", "houzez" ),
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Title", "houzez" ),
				"param_name" => "title",
				"description" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => esc_html__("Subtitle", "houzez" ),
				"param_name" => "sub_title",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"value" => 'All',
				"heading" => esc_html__("All Posts Text", "houzez" ),
				"param_name" => "all_btn",
				"description" => "",
				"save_always" => true
			),
			array(
				"type" => "textfield",
				"class" => "",
				"value" => '',
				"heading" => esc_html__("All Posts Link", "houzez" ),
				"param_name" => "all_url",
				"description" => "",
				"save_always" => true
			),
		) // End params
	) );



} // End Class_exists
?>