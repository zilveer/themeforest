<?php
/*
  Plugin Name: Magzilla Visual Composer Extensions
  Plugin URI: http://themeforest.net/user/favethemes
  Description: Extensions to Visual Composer for the Realto theme.
  Version: 1.0
  Author: Favethemes
  Author URI: http://themeforest.net/user/favethemes
  License: GPLv2 or later
 */

// don't load directly
if ( !defined( 'ABSPATH' ) )
    die( '-1' );


if (class_exists('WPBakeryVisualComposer')) {

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
		vc_remove_param('vc_row', 'gap');
		vc_remove_param('vc_row', 'video_bg');
		vc_remove_param('vc_row', 'full_height');
		vc_remove_param('vc_row', 'equal_height');
		vc_remove_param('vc_row', 'video_bg_url');
		vc_remove_param('vc_row', 'columns_placement');
		vc_remove_param('vc_row', 'content_placement');
	}
	


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
		Post Slider
	-----------------------------------------------------------------------------------*/

	vc_map( array(
			"name"					=> __( "Post Slider", 'js_composer' ),
			"description"			=> '',
			"base"					=> "fav-post-slider",
			'category'				=> "By Favethemes",
			"class"					=> "",
			'admin_enqueue_js'		=> "",
			'admin_enqueue_css'		=> "",
			"icon" 					=> "icon-post-slider-1",
			"params"				=> array(
				
				array(
                    "param_name" => "slider_type",
                    "type" => "dropdown",
                    "value" => array(' Grid Slider ' => 'grid_slider', 'Full Width Slider' => 'fullwidth_slider' ),
                    "heading" => __("Slider Type:", 'js_composer' ),
                    "description" => "",
					"save_always" => true,
                    
                ),

                array(
                    "param_name" => "slider_text_align",
                    "type" => "dropdown",
                    "value" => array(' Left Align ' => '', 'Center Align' => 'text-center' ),
                    "heading" => __("Text Align:", 'js_composer' ),
					"save_always" => true,
                    "dependency" => Array("element" => "slider_type", "value" => array("fullwidth_slider")),
                    
                ),

                array(
                     "param_name" => "post_from",
                     "type" => "dropdown",
                     "value" => array('Featured Posts' => 'featured', 'Category Posts' => 'category_posts'),
                     "heading" => __("Posts to display in slider:", 'js_composer' ),
					 "save_always" => true,
                     "description" => __( "Display featured posts from all categories or Posts from specific category", 'js_composer'),  
                ),
				array(
                    "param_name" => "category_id",
                    "type" => "dropdown",
                    "value" => fave_get_category_id_array(),
                    "heading" => __("Category filter:", 'js_composer' ),
                    "description" => "",
					"save_always" => true,
                    "dependency" => Array("element" => "post_from", "value" => array("category_posts")),
                    
                ),
                array(
                    "param_name" => "category_ids",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Multiple categories filter:", 'js_composer' ),
                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15)",
                    "dependency" => Array("element" => "post_from", "value" => array("category_posts")),
                    
                ),
                array(
                     "param_name" => "hide_cat",
                     "type" => "dropdown",
                     "value" => array('Show' => 'yes', 'Hide' => 'no'),
                     "heading" => __("Show/Hide Category Name:", 'js_composer' ),
					 "save_always" => true,
                ),
                array(
                     "param_name" => "image_crop",
                     "type" => "dropdown",
                     "value" => array('Yes' => 'yes', 'No' => 'no'),
                     "heading" => __("Crop Slider Images:", 'js_composer' ),
					 "save_always" => true,
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
                    "heading" => __("Sort order:", 'js_composer' ),
                    "description" => "",
                    
                ),
				array(
	                "param_name" => "posts_limit",
	                "type" => "textfield",
	                "value" => __("6", 'js_composer' ),
	                "heading" => __("Limit post number:", 'js_composer' ),
	                "description" => "",
					"save_always" => true,
	                
	            ),
	            array(
	                "param_name" => "slider_auto",
	                "type" => "dropdown",
	                "value" => array(
	                	'Yes' => 'true',
	                	'No' => 'false',
	                	),
	                "heading" => __("Auto Play:", 'js_composer' ),
	                "description" => "",
					"save_always" => true,
	                "group"	=> 'Carousel Settings',

	            ),
	            array(
	                "param_name" => "stop_on_hover",
	                "type" => "dropdown",
	                "value" => array(
	                	'Yes' => 'true',
	                	'No' => 'false'
	                	),
	                "heading" => __("Stop on Mouse Hover:", 'js_composer' ),
	                "description" => "",
					"save_always" => true,
	                "group"	=> 'Carousel Settings',

	            ),
	            array(
	                "param_name" => "navigation",
	                "type" => "dropdown",
	                "value" => array(
	                	'Yes' => 'true',
	                	'No' => 'false'
	                	),
	                "heading" => __("Navigation:", 'js_composer' ),
	                "description" => "",
					"save_always" => true,
	                "group"	=> 'Carousel Settings',

	            ),
	            array(
	                "param_name" => "bullets_pagination",
	                "type" => "dropdown",
	                "value" => array(
						'Yes' => 'true',
						'No' => 'false'
	                	),
	                "heading" => __("Bullets Pagination:", 'js_composer' ),
	                "description" => "",
	                "group"	=> 'Carousel Settings',
					"save_always" => true,
	            ),
				array(
					"param_name" => "touch_drag",
					"type" => "dropdown",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					),
					"heading" => __("Touch Drag:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Carousel Settings'
				),
				array(
					"param_name" => "slide_loop",
					"type" => "dropdown",
					"value" => array(
						'No' => 'false',
						'Yes' => 'true'
					),
					"heading" => __("Loop:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Carousel Settings'
				),
	            array(
	                "param_name" => "rewind_nav",
	                "type" => "dropdown",
	                "value" => array(
	                	'Yes' => 'true',
	                	'No' => 'false'
	                	),
	                "heading" => __("Rewind Nav:", 'js_composer' ),
	                "description" => "",
	                "group"	=> 'Carousel Settings',
					"save_always" => true,
	            ),
	            array(
	                "param_name" => "lazy_load",
	                "type" => "dropdown",
	                "value" => array(
	                	'Yes' => 'true',
	                	'No' => 'false'
	                	),
	                "heading" => __("Lazy Load:", 'js_composer' ),
	                "description" => "",
	                "group"	=> 'Carousel Settings',
					"save_always" => true,
	            ),
				array(
					"param_name" => "module_meta",
					"type" => "dropdown",
					"value" => array(
						'Disable' => 'false',
						'Enable' => 'true',
					),
					"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "author_name",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Author Name:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "time_diff",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Time Difference:", 'js_composer' ),
					"description" => "Enable or Disable Human Readable time difference",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_date",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Date:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_time",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Time:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_view_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Views Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_comment_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Comments Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)

			) // End params
		) );
	

	/*---------------------------------------------------------------------------------
		Post Grids
	-----------------------------------------------------------------------------------*/

	vc_map( array(
			"name"					=> __( "Post Grids", 'js_composer' ),
			"description"			=> __('Display posts in different girds', 'js_composer'),
			"base"					=> "fav-post-grids",
			'category'				=> "By Favethemes",
			"class"					=> "",
			'admin_enqueue_js'		=> "",
			'admin_enqueue_css'		=> "",
			"icon" 					=> "icon-post-grids",
			"params"				=> array(
				
				array(
                    "param_name" => "grid_type",
                    "type" => "dropdown",
                    "value" => array(' Grid 1 ' => 'grid_1', 'Grid 2' => 'grid_2' ),
                    "heading" => __("Grid Type:", 'js_composer' ),
                    "description" => "",
					"save_always" => true,
                    
                ),

                array(
                     "param_name" => "post_from",
                     "type" => "dropdown",
                     "value" => array('Featured Posts' => 'featured', 'Category Posts' => 'category_posts'),
                     "heading" => __("Posts to display in slider:", 'js_composer' ),
                     "description" => __( "Display featured posts from all categories or Posts from specific category", 'js_composer'),
					 "save_always" => true,
                ),
				array(
                    "param_name" => "category_id",
                    "type" => "dropdown",
                    "value" => fave_get_category_id_array(),
                    "heading" => __("Category filter:", 'js_composer' ),
                    "description" => "",
                    "dependency" => Array("element" => "post_from", "value" => array("category_posts")),
                    
                ),
                array(
                    "param_name" => "category_ids",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Multiple categories filter:", 'js_composer' ),
                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15)",
                    "dependency" => Array("element" => "post_from", "value" => array("category_posts")),
                    
                ),
                array(
                     "param_name" => "hide_cat",
                     "type" => "dropdown",
                     "value" => array('Show' => 'yes', 'Hide' => 'no'),
                     "heading" => __("Show/Hide Category Name:", 'js_composer' ),
					 "save_always" => true,
                ),
                array(
                     "param_name" => "hide_meta",
                     "type" => "dropdown",
                     "value" => array('Show' => 'yes', 'Hide' => 'no'),
                     "heading" => __("Show/Hide Meta Data:", 'js_composer' ),
					 "save_always" => true,
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
                    "heading" => __("Sort order:", 'js_composer' ),
                    "description" => "",
                    
                ),
				array(
	                "param_name" => "posts_limit",
	                "type" => "textfield",
	                "value" => __("6", 'js_composer' ),
	                "heading" => __("Limit post number:", 'js_composer' ),
	                "description" => "",
					"save_always" => true,
	                
	            ),
				array(
					"param_name" => "module_meta",
					"type" => "dropdown",
					"value" => array(
						'Disable' => 'false',
						'Enable' => 'true',
					),
					"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "author_name",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Author Name:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "time_diff",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Time Difference:", 'js_composer' ),
					"description" => "Enable or Disable Human Readable time difference",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_date",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Date:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_time",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Time:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_view_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Views Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_comment_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Comments Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)

			) // End params
		) );
	/*---------------------------------------------------------------------------------
		Ad Box
	-----------------------------------------------------------------------------------*/

	vc_map( array(
            "name" => __("Ad box", "js_composer" ),
            "base" => "favethemes-ad-box",
            "class" => "",
            "controls" => "full",
            "category" => __('By Favethemes', "js_composer" ),
            'icon' => 'icon-favethemes-ads',
            "params" => array(
                array(
                    "param_name" => "ad_spot_id",
                    "type" => "dropdown",
                    "value" => array(
                        'Custom Ad 1' => 'custom_ad_1',
                        'Custom Ad 2' => 'custom_ad_2',
                        'Custom Ad 3' => 'custom_ad_3'
                    ),
                    "heading" => __("Use adspot:", "js_composer" ),
                    "description" => __("You can find these adspot in Magazilla Options", 'js_composer' ),
					"save_always" => true,
                )
            )
        ));

	/*---------------------------------------------------------------------------------
		Module 1
	-----------------------------------------------------------------------------------*/

	vc_map( array(
			"name"					=> __( "Module 1", 'js_composer' ),
			"description"			=> '',
			"base"					=> "fav-module-1",
			'category'				=> "By Favethemes",
			"class"					=> "",
			'admin_enqueue_js'		=> "",
			'admin_enqueue_css'		=> "",
			"icon" 					=> "icon-module-1",
			"params"				=> array(
				
				array(
                    "param_name" => "category_id",
                    "type" => "dropdown",
                    "value" => fave_get_category_id_array(),
                    "heading" => __("Category filter:", 'js_composer' ),
                    "description" => "",
                    "save_always" => true,
                    
                ),
                array(
                    "param_name" => "category_ids",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Multiple categories filter:", 'js_composer' ),
                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15)",
                    
                ),
                array(
                    "param_name" => "tag_slug",
                    "type" => "textfield",
                    "value" => '',
                    "heading" => __("Filter by tag slug:", 'js_composer' ),
                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
                    
                ),
                array(
                    "param_name" => "sort",
                    "type" => "dropdown",
                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
                    "heading" => __("Sort order:", 'js_composer' ),
                    "description" => "",
                    
                ),
                array(
                    "param_name" => "autors_id",
                    "type" => "dropdown",
                    "value" => fave_create_array_authors(),
                    "heading" => "Autors Filter:",
                    "description" => "",
                    
                ),
                array(
                     "param_name" => "featured_posts",
                     "type" => "dropdown",
                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
                     "heading" => __("Featured Posts:", 'js_composer' ),
                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
                ),
                array(
                     "param_name" => "hide_title",
                     "type" => "dropdown",
                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
                     "heading" => __("Hide block title:", 'js_composer' ),
                     "description" => "",
					 "save_always" => true,
                ),

				array(
	                "param_name" => "posts_limit",
	                "type" => "textfield",
	                "value" => __("6", 'js_composer' ),
	                "heading" => __("Limit post number:", 'js_composer' ),
	                "description" => "",
					"save_always" => true,
	                
	            ),
	            array(
	                "param_name" => "offset",
	                "type" => "textfield",
	                "value" => __("", 'js_composer' ),
	                "heading" => __("Offset posts:", 'js_composer' ),
	                "description" => "",
	                
	            ),
	            array(
	                "type" => "colorpicker",
	                
	                "heading" => __("Header color", 'js_composer' ),
	                "param_name" => "header_color",
	                "value" => '', 
	                "description" => __("Choose a custom header color for this block", 'js_composer' )
	            ),
	            array(
	                "type" => "colorpicker",
	                
	                "heading" => __("Header text color", 'js_composer' ),
	                "param_name" => "header_text_color",
	                "value" => '', 
	                "description" => __("Choose a custom header color for this block", 'js_composer' )
	            ),
	            array(
	                "type" => "colorpicker",
	                
	                "heading" => __("Header text top border color", 'js_composer' ),
	                "param_name" => "header_border_color",
	                "value" => '', 
	                "description" => __("Choose a custom color for block title border top", 'js_composer' )
	            ),
	            array(
	                "param_name" => "custom_title",
	                "type" => "textfield",
	                "value" => "",
	                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
	                "description" => "",
	                
	            ),
	            array(
	                "param_name" => "custom_url",
	                "type" => "textfield",
	                "value" => "",
	                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
	                "description" => "",
	               
	            ),
	            array(
	                "param_name" => "title_style",
	                "type" => "dropdown",
	                "value" => array('- default style -' => ''),
	                "heading" => __("Title style:", 'js_composer' ),
	                "description" => "",
	                
	            ),
	            array(
	                "param_name" => "show_child_cat",
	                "type" => "dropdown",
	                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
	                "heading" => __("Show child categories menu:", 'js_composer' ),
	                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
	                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
	               
	            ),
	            array(
	                "param_name" => "excerpt_limit",
	                "type" => "textfield",
	                "value" => "150",
	                "heading" => __("Excerpt Limit:", 'js_composer' ),
	                "description" => __("How much characters want to show as excerpt: default 150", 'js_composer' ),
					"save_always" => true,
	            ),
	            array(
                     "param_name" => "read_more",
                     "type" => "dropdown",
                     "value" => array('- Show -' => "true", 'Hide' => "false"),
                     "heading" => __("Hide Continue Reading:", 'js_composer' ),
                     "description" => "",
					 "save_always" => true,
                ),
				array(
					"param_name" => "module_meta",
					"type" => "dropdown",
					"value" => array(
						'Disable' => 'false',
						'Enable' => 'true',
					),
					"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "author_name",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Author Name:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "time_diff",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Time Difference:", 'js_composer' ),
					"description" => "Enable or Disable Human Readable time difference",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_date",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Date:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_time",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Time:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_view_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Views Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_comment_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Comments Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)

			) // End params
		) );

		
		/*---------------------------------------------------------------------------------
		Module 2
		-----------------------------------------------------------------------------------*/

		vc_map( array(
				"name"					=> __( "Module 2", 'js_composer' ),
				"description"			=> '',
				"base"					=> "fav-module-2",
				'category'				=> "By Favethemes",
				"class"					=> "",
				'admin_enqueue_js'		=> "",
				'admin_enqueue_css'		=> "",
				"icon" 					=> "icon-module-1",
				"params"				=> array(
					
					array(
	                    "param_name" => "category_id",
	                    "type" => "dropdown",
	                    "value" => fave_get_category_id_array(),
	                    "heading" => __("Category filter:", 'js_composer' ),
	                    "description" => "",
	                    "save_always" => true,
	                    
	                ),
	                array(
	                    "param_name" => "category_ids",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Multiple categories filter:", 'js_composer' ),
	                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
	                    
	                ),
	                array(
	                    "param_name" => "tag_slug",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Filter by tag slug:", 'js_composer' ),
	                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
	                    
	                ),
	                array(
	                    "param_name" => "sort",
	                    "type" => "dropdown",
	                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
	                    "heading" => __("Sort order:", 'js_composer' ),
	                    "description" => "",
	                    
	                ),
	                array(
	                    "param_name" => "autors_id",
	                    "type" => "dropdown",
	                    "value" => fave_create_array_authors(),
	                    "heading" => "Autors Filter:",
	                    "description" => "",
	                    
	                ),
	                array(
	                     "param_name" => "featured_posts",
	                     "type" => "dropdown",
	                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
	                     "heading" => __("Featured Posts:", 'js_composer' ),
	                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
	                ),
	                array(
	                     "param_name" => "hide_title",
	                     "type" => "dropdown",
	                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
	                     "heading" => __("Hide block title:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     
	                ),

					array(
		                "param_name" => "posts_limit",
		                "type" => "textfield",
		                "value" => __("6", 'js_composer' ),
		                "heading" => __("Limit post number:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "offset",
		                "type" => "textfield",
		                "value" => __("", 'js_composer' ),
		                "heading" => __("Offset posts:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header color", 'js_composer' ),
		                "param_name" => "header_color",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' )
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text color", 'js_composer' ),
		                "param_name" => "header_text_color",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' )
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text top border color", 'js_composer' ),
		                "param_name" => "header_border_color",
		                "value" => '', 
		                "description" => __("Choose a custom color for block title border top", 'js_composer' )
		            ),
		            array(
		                "param_name" => "custom_title",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "param_name" => "custom_url",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
		                "description" => "",
		               
		            ),
		            array(
		                "param_name" => "title_style",
		                "type" => "dropdown",
		                "value" => array('- default style -' => ''),
		                "heading" => __("Title style:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "param_name" => "show_child_cat",
		                "type" => "dropdown",
		                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
		                "heading" => __("Show child categories menu:", 'js_composer' ),
		                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
		                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
		               
		            ),
		            array(
		                "param_name" => "excerpt_limit",
		                "type" => "textfield",
		                "value" => "150",
		                "heading" => __("Excerpt Limit:", 'js_composer' ),
		                "description" => __("How much characters want to show as excerpt: default 150", 'js_composer' ),
						"save_always" => true,
		            ),
		            array(
	                     "param_name" => "read_more",
	                     "type" => "dropdown",
	                     "value" => array('- Show -' => 'true', 'Hide' => 'false'),
	                     "heading" => __("Hide Continue Reading:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                ),
					array(
						"param_name" => "module_meta",
						"type" => "dropdown",
						"value" => array(
							'Disable' => 'false',
							'Enable' => 'true',
						),
						"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "author_name",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Author Name:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "time_diff",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Time Difference:", 'js_composer' ),
						"description" => "Enable or Disable Human Readable time difference",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_date",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Date:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_time",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Time:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_view_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Views Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_comment_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Comments Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "module_bg",
						"type" => "colorpicker",
						"value" => '',
						"heading" => __("Background Color:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Design Options',

					),
					array(
						"param_name" => "module_padding",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Padding:", 'js_composer' ),
						"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
						"save_always" => true,
						"group"	=> 'Design Options',
					)

				) // End params
		) );
		

		/*---------------------------------------------------------------------------------
		Module 3
		-----------------------------------------------------------------------------------*/

		vc_map( array(
				"name"					=> __( "Module 3", 'js_composer' ),
				"description"			=> '',
				"base"					=> "fav-module-3",
				'category'				=> "By Favethemes",
				"class"					=> "",
				'admin_enqueue_js'		=> "",
				'admin_enqueue_css'		=> "",
				"icon" 					=> "icon-module-3",
				"params"				=> array(
					
					array(
	                    "param_name" => "category_id",
	                    "type" => "dropdown",
	                    "value" => fave_get_category_id_array(),
	                    "heading" => __("Category filter:", 'js_composer' ),
	                    "description" => "",
	                    
	                ),
	                array(
	                    "param_name" => "category_ids",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Multiple categories filter:", 'js_composer' ),
	                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
	                    
	                ),
	                array(
	                    "param_name" => "tag_slug",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Filter by tag slug:", 'js_composer' ),
	                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
	                    
	                ),
	                array(
	                    "param_name" => "sort",
	                    "type" => "dropdown",
	                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
	                    "heading" => __("Sort order:", 'js_composer' ),
	                    "description" => "",
	                    
	                ),
	                array(
	                    "param_name" => "autors_id",
	                    "type" => "dropdown",
	                    "value" => fave_create_array_authors(),
	                    "heading" => "Autors Filter:",
	                    "description" => "",
	                    
	                ),
	                array(
	                     "param_name" => "featured_posts",
	                     "type" => "dropdown",
	                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
	                     "heading" => __("Featured Posts:", 'js_composer' ),
	                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
	                ),
	                array(
	                     "param_name" => "hide_title",
	                     "type" => "dropdown",
	                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
	                     "heading" => __("Hide block title:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     
	                ),

					array(
		                "param_name" => "posts_limit",
		                "type" => "textfield",
		                "value" => __("6", 'js_composer' ),
		                "heading" => __("Limit post number:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "offset",
		                "type" => "textfield",
		                "value" => __("", 'js_composer' ),
		                "heading" => __("Offset posts:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header color", 'js_composer' ),
		                "param_name" => "header_color",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' )
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text color", 'js_composer' ),
		                "param_name" => "header_text_color",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' )
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text top border color", 'js_composer' ),
		                "param_name" => "header_border_color",
		                "value" => '', 
		                "description" => __("Choose a custom color for block title border top", 'js_composer' )
		            ),
		            array(
		                "param_name" => "custom_title",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "param_name" => "custom_url",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
		                "description" => "",
		               
		            ),
		            array(
		                "param_name" => "title_style",
		                "type" => "dropdown",
		                "value" => array('- default style -' => ''),
		                "heading" => __("Title style:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "param_name" => "show_child_cat",
		                "type" => "dropdown",
		                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
		                "heading" => __("Show child categories menu:", 'js_composer' ),
		                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
		                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
		               
		            ),
		            array(
		                "param_name" => "module_excerpt",
		                "type" => "dropdown",
		                "value" => array('- Show Excerpt -' => 'show_excerpt', 'Hide Excerpt' => 'hide_excerpt' ),
		                "heading" => __("Posts Excerpt:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "excerpt_limit",
		                "type" => "textfield",
		                "value" => "150",
		                "heading" => __("Excerpt Limit:", 'js_composer' ),
		                "description" => __("How much characters want to show as excerpt: default 150", 'js_composer' ),
		                "dependency" => Array("element" => "module_excerpt", "value" => array("show_excerpt")),
						"save_always" => true,
		            ),
		            array(
	                     "param_name" => "read_more",
	                     "type" => "dropdown",
	                     "value" => array('- Show -' => 'true', 'Hide' => 'false'),
	                     "heading" => __("Hide Continue Reading:", 'js_composer' ),
	                     "description" => "",  
	                     "dependency" => Array("element" => "module_excerpt", "value" => array("show_excerpt")),
						 "save_always" => true,
	                ),
					array(
						"param_name" => "module_meta",
						"type" => "dropdown",
						"value" => array(
							'Disable' => 'false',
							'Enable' => 'true',
						),
						"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "author_name",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Author Name:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "time_diff",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Time Difference:", 'js_composer' ),
						"description" => "Enable or Disable Human Readable time difference",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_date",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Date:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_time",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Time:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_view_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Views Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_comment_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Comments Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "module_bg",
						"type" => "colorpicker",
						"value" => '',
						"heading" => __("Background Color:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Design Options',

					),
					array(
						"param_name" => "module_padding",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Padding:", 'js_composer' ),
						"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
						"save_always" => true,
						"group"	=> 'Design Options',
					)

				) // End params
			) );
			
		
		/*---------------------------------------------------------------------------------
		Module 4
		-----------------------------------------------------------------------------------*/

		vc_map( array(
				"name"					=> __( "Module 4", 'js_composer' ),
				"description"			=> '',
				"base"					=> "fav-module-4",
				'category'				=> "By Favethemes",
				"class"					=> "",
				'admin_enqueue_js'		=> "",
				'admin_enqueue_css'		=> "",
				"icon" 					=> "icon-module-4",
				"params"				=> array(
					array(
	                     "param_name" => "module_4_type",
	                     "type" => "dropdown",
	                     "value" => array('1 Columns' => 'one_columns', '2 Columns' => 'two_columns', '3 Columns ' => 'three_columns' ),
	                     "heading" => __("Module Columns:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     
	                ),

	                // For Column one *************************************************************************

					array(
	                    "param_name" => "category_id_1",
	                    "type" => "dropdown",
	                    "value" => fave_get_category_id_array(),
	                    "heading" => __("Category filter:", 'js_composer' ),
	                    "description" => "",
	                    "group"	=> "Column 1"
	                    
	                ),
	                array(
	                    "param_name" => "category_ids_1",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Multiple categories filter:", 'js_composer' ),
	                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
	                    "group"	=> "Column 1"
	                ),
	                array(
	                    "param_name" => "tag_slug_1",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Filter by tag slug:", 'js_composer' ),
	                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
	                    "group"	=> "Column 1"
	                ),
	                array(
	                    "param_name" => "sort_1",
	                    "type" => "dropdown",
	                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
	                    "heading" => __("Sort order:", 'js_composer' ),
	                    "description" => "",
	                    "group"	=> "Column 1"
	                ),
	                array(
	                    "param_name" => "autors_id_1",
	                    "type" => "dropdown",
	                    "value" => fave_create_array_authors(),
	                    "heading" => "Autors Filter:",
	                    "description" => "",
	                    "group"	=> "Column 1"
	                ),
	                array(
	                     "param_name" => "featured_posts_1",
	                     "type" => "dropdown",
	                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
	                     "heading" => __("Featured Posts:", 'js_composer' ),
	                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),
	                     "group" => "Column 1"
	                ),
	                array(
	                     "param_name" => "hide_title_1",
	                     "type" => "dropdown",
	                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
	                     "heading" => __("Hide block title:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     "group"	=> "Column 1"
	                ),
	                array(
		                "param_name" => "offset_1",
		                "type" => "textfield",
		                "value" => __("", 'js_composer' ),
		                "heading" => __("Offset posts:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 1"
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header color", 'js_composer' ),
		                "param_name" => "header_color_1",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' ),
		                "group"	=> "Column 1"

		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text color", 'js_composer' ),
		                "param_name" => "header_text_color_1",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' ),
		                "group"	=> "Column 1"
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text top border color", 'js_composer' ),
		                "param_name" => "header_border_color_1",
		                "value" => '', 
		                "description" => __("Choose a custom color for block title border top", 'js_composer' ),
		                "group"	=> "Column 1"
		            ),
		            array(
		                "param_name" => "custom_title_1",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 1"
		                
		            ),
		            array(
		                "param_name" => "custom_url_1",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 1"
		               
		            ),
		            array(
		                "param_name" => "title_style_1",
		                "type" => "dropdown",
		                "value" => array('- default style -' => ''),
		                "heading" => __("Title style:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 1"
		            ),


	                // For Column two *************************************************************************
	                
	                array(
	                    "param_name" => "category_id_2",
	                    "type" => "dropdown",
	                    "value" => fave_get_category_id_array(),
	                    "heading" => __("Category filter:", 'js_composer' ),
	                    "description" => "",
	                    "group"	=> "Column 2"
	                    
	                ),
	                array(
	                    "param_name" => "category_ids_2",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Multiple categories filter:", 'js_composer' ),
	                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
	                    "group"	=> "Column 2"
	                ),
	                array(
	                    "param_name" => "tag_slug_2",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Filter by tag slug:", 'js_composer' ),
	                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
	                    "group"	=> "Column 2"
	                ),
	                array(
	                    "param_name" => "sort_2",
	                    "type" => "dropdown",
	                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
	                    "heading" => __("Sort order:", 'js_composer' ),
	                    "description" => "",
	                    "group"	=> "Column 2"
	                ),
	                array(
	                    "param_name" => "autors_id_2",
	                    "type" => "dropdown",
	                    "value" => fave_create_array_authors(),
	                    "heading" => "Autors Filter:",
	                    "description" => "",
	                    "group"	=> "Column 2"
	                ),
	                array(
	                     "param_name" => "featured_posts_2",
	                     "type" => "dropdown",
	                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
	                     "heading" => __("Featured Posts:", 'js_composer' ),
	                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'), 
	                     "group" => "Column 2" 
	                ),
	                array(
	                     "param_name" => "hide_title_2",
	                     "type" => "dropdown",
	                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
	                     "heading" => __("Hide block title:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     "group"	=> "Column 2"
	                ),
	                array(
		                "param_name" => "offset_2",
		                "type" => "textfield",
		                "value" => __("", 'js_composer' ),
		                "heading" => __("Offset posts:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 2"
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header color", 'js_composer' ),
		                "param_name" => "header_color_2",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' ),
		                "group"	=> "Column 2"

		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text color", 'js_composer' ),
		                "param_name" => "header_text_color_2",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' ),
		                "group"	=> "Column 2"
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text top border color", 'js_composer' ),
		                "param_name" => "header_border_color_2",
		                "value" => '', 
		                "description" => __("Choose a custom color for block title border top", 'js_composer' ),
		                "group"	=> "Column 2"
		            ),
		            array(
		                "param_name" => "custom_title_2",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 2"
		                
		            ),
		            array(
		                "param_name" => "custom_url_2",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 2"
		               
		            ),
		            array(
		                "param_name" => "title_style_2",
		                "type" => "dropdown",
		                "value" => array('- default style -' => ''),
		                "heading" => __("Title style:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 2"
		            ),


	                // For Column three *************************************************************************
	                array(
	                    "param_name" => "category_id_3",
	                    "type" => "dropdown",
	                    "value" => fave_get_category_id_array(),
	                    "heading" => __("Category filter:", 'js_composer' ),
	                    "description" => "",
	                    "group"	=> "Column 3"
	                    
	                ),
	                array(
	                    "param_name" => "category_ids_3",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Multiple categories filter:", 'js_composer' ),
	                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
	                    "group"	=> "Column 3"
	                ),
	                array(
	                    "param_name" => "tag_slug_3",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Filter by tag slug:", 'js_composer' ),
	                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
	                    "group"	=> "Column 3"
	                ),
	                array(
	                    "param_name" => "sort_3",
	                    "type" => "dropdown",
	                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
	                    "heading" => __("Sort order:", 'js_composer' ),
	                    "description" => "",
	                    "group"	=> "Column 3"
	                ),
	                array(
	                    "param_name" => "autors_id_3",
	                    "type" => "dropdown",
	                    "value" => fave_create_array_authors(),
	                    "heading" => "Autors Filter:",
	                    "description" => "",
	                    "group"	=> "Column 3"
	                ),
	                array(
	                     "param_name" => "featured_posts_3",
	                     "type" => "dropdown",
	                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
	                     "heading" => __("Featured Posts:", 'js_composer' ),
	                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'), 
	                     "group" => "Column 3"
	                ),
	                array(
	                     "param_name" => "hide_title_3",
	                     "type" => "dropdown",
	                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
	                     "heading" => __("Hide block title:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     "group"	=> "Column 3"
	                ),
	                array(
		                "param_name" => "offset_3",
		                "type" => "textfield",
		                "value" => __("", 'js_composer' ),
		                "heading" => __("Offset posts:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 3"
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header color", 'js_composer' ),
		                "param_name" => "header_color_3",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' ),
		                "group"	=> "Column 3"

		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text color", 'js_composer' ),
		                "param_name" => "header_text_color_3",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' ),
		                "group"	=> "Column 3"
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text top border color", 'js_composer' ),
		                "param_name" => "header_border_color_3",
		                "value" => '', 
		                "description" => __("Choose a custom color for block title border top", 'js_composer' ),
		                "group"	=> "Column 3"
		            ),
		            array(
		                "param_name" => "custom_title_3",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 3"
		                
		            ),
		            array(
		                "param_name" => "custom_url_3",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 3"
		               
		            ),
		            array(
		                "param_name" => "title_style_3",
		                "type" => "dropdown",
		                "value" => array('- default style -' => ''),
		                "heading" => __("Title style:", 'js_composer' ),
		                "description" => "",
		                "group"	=> "Column 3"
		            ),

					
					// General Settings ***************************************************************************
					array(
		                "param_name" => "posts_limit",
		                "type" => "textfield",
		                "value" => __("6", 'js_composer' ),
		                "heading" => __("Limit post number:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "module_excerpt",
		                "type" => "dropdown",
		                "value" => array('- Show Excerpt -' => 'show_excerpt', 'Hide Excerpt' => 'hide_excerpt' ),
		                "heading" => __("Posts Excerpt:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "excerpt_limit",
		                "type" => "textfield",
		                "value" => "150",
		                "heading" => __("Excerpt Limit:", 'js_composer' ),
		                "description" => __("How much characters want to show as excerpt: default 150", 'js_composer' ),
		                "dependency" => Array("element" => "module_excerpt", "value" => array("show_excerpt")),
						"save_always" => true,
		            ),
		            array(
	                     "param_name" => "read_more",
	                     "type" => "dropdown",
	                     "value" => array('- Show -' => 'true', 'Hide' => 'false'),
	                     "heading" => __("Hide Continue Reading:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     "dependency" => Array("element" => "module_excerpt", "value" => array("show_excerpt")),
	                ),
					array(
						"param_name" => "module_meta",
						"type" => "dropdown",
						"value" => array(
							'Disable' => 'false',
							'Enable' => 'true',
						),
						"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "author_name",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Author Name:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "time_diff",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Time Difference:", 'js_composer' ),
						"description" => "Enable or Disable Human Readable time difference",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_date",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Date:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_time",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Time:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_view_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Views Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_comment_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Comments Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "module_bg",
						"type" => "colorpicker",
						"value" => '',
						"heading" => __("Background Color:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Design Options',

					),
					array(
						"param_name" => "module_padding",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Padding:", 'js_composer' ),
						"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
						"save_always" => true,
						"group"	=> 'Design Options',
					)

				) // End params
			) );


		/*---------------------------------------------------------------------------------
		Module 5
		-----------------------------------------------------------------------------------*/

		vc_map( array(
				"name"					=> __( "Module 5", 'js_composer' ),
				"description"			=> '',
				"base"					=> "fav-module-5",
				'category'				=> "By Favethemes",
				"class"					=> "",
				'admin_enqueue_js'		=> "",
				'admin_enqueue_css'		=> "",
				"icon" 					=> "icon-module-5",
				"params"				=> array(
					array(
	                     "param_name" => "module_5_type",
	                     "type" => "dropdown",
	                     "value" => array('2 Columns' => 'two_columns', '3 Columns ' => 'three_columns', '1 Columns' => 'one_columns' ),
	                     "heading" => __("Module Columns:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     
	                ),
					array(
						"param_name" => "module_title_size",
						"type" => "dropdown",
						"value" => array('Big Title' => 'module-big-title', 'Small Title ' => 'module-small-title' ),
						"heading" => __("Title Size:", 'js_composer' ),
						"description" => "",
						"save_always" => true,

					),
					array(
	                    "param_name" => "category_id",
	                    "type" => "dropdown",
	                    "value" => fave_get_category_id_array(),
	                    "heading" => __("Category filter:", 'js_composer' ),
	                    "description" => "",
	                    
	                ),
	                array(
	                    "param_name" => "category_ids",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Multiple categories filter:", 'js_composer' ),
	                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
	                    
	                ),
	                array(
	                    "param_name" => "tag_slug",
	                    "type" => "textfield",
	                    "value" => '',
	                    "heading" => __("Filter by tag slug:", 'js_composer' ),
	                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
	                    
	                ),
	                array(
	                    "param_name" => "sort",
	                    "type" => "dropdown",
	                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
	                    "heading" => __("Sort order:", 'js_composer' ),
	                    "description" => "",
	                    
	                ),
	                array(
	                    "param_name" => "autors_id",
	                    "type" => "dropdown",
	                    "value" => fave_create_array_authors(),
	                    "heading" => "Autors Filter:",
	                    "description" => "",
	                    
	                ),
	                array(
	                     "param_name" => "featured_posts",
	                     "type" => "dropdown",
	                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
	                     "heading" => __("Featured Posts:", 'js_composer' ),
	                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
	                ),
	                array(
	                     "param_name" => "hide_title",
	                     "type" => "dropdown",
	                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
	                     "heading" => __("Hide block title:", 'js_composer' ),
	                     "description" => "",
						 "save_always" => true,
	                     
	                ),

					array(
		                "param_name" => "posts_limit",
		                "type" => "textfield",
		                "value" => __("6", 'js_composer' ),
		                "heading" => __("Limit post number:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "offset",
		                "type" => "textfield",
		                "value" => __("", 'js_composer' ),
		                "heading" => __("Offset posts:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header color", 'js_composer' ),
		                "param_name" => "header_color",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' )
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text color", 'js_composer' ),
		                "param_name" => "header_text_color",
		                "value" => '', 
		                "description" => __("Choose a custom header color for this block", 'js_composer' )
		            ),
		            array(
		                "type" => "colorpicker",
		                
		                "heading" => __("Header text top border color", 'js_composer' ),
		                "param_name" => "header_border_color",
		                "value" => '', 
		                "description" => __("Choose a custom color for block title border top", 'js_composer' )
		            ),
		            array(
		                "param_name" => "custom_title",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "param_name" => "custom_url",
		                "type" => "textfield",
		                "value" => "",
		                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
		                "description" => "",
		               
		            ),
		            array(
		                "param_name" => "title_style",
		                "type" => "dropdown",
		                "value" => array('- default style -' => ''),
		                "heading" => __("Title style:", 'js_composer' ),
		                "description" => "",
		                
		            ),
		            array(
		                "param_name" => "show_child_cat",
		                "type" => "dropdown",
		                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
		                "heading" => __("Show child categories menu:", 'js_composer' ),
		                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
		                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
		               
		            ),
		            
		            array(
		                "param_name" => "module_excerpt",
		                "type" => "dropdown",
		                "value" => array('- Show Excerpt -' => 'show_excerpt', 'Hide Excerpt' => 'hide_excerpt' ),
		                "heading" => __("Posts Excerpt:", 'js_composer' ),
		                "description" => "",
						"save_always" => true,
		                
		            ),
		            array(
		                "param_name" => "excerpt_limit",
		                "type" => "textfield",
		                "value" => "150",
		                "heading" => __("Excerpt Limit:", 'js_composer' ),
		                "description" => __("How much characters want to show as excerpt: default 150", 'js_composer' ),
		                "dependency" => Array("element" => "module_excerpt", "value" => array("show_excerpt")),
						"save_always" => true,
		            ),
					array(
						"param_name" => "image_size",
						"type" => "dropdown",
						"value" => array('370 x 277' => '370_277', '570 x 427' => '570_427'),
						"heading" => __("Image Size:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
					),
		            array(
	                     "param_name" => "read_more",
	                     "type" => "dropdown",
	                     "value" => array('- Show -' => true, 'Hide' => false),
	                     "heading" => __("Hide Continue Reading:", 'js_composer' ),
	                     "description" => "",  
	                     "dependency" => Array("element" => "module_excerpt", "value" => array("show_excerpt")),
						 "save_always" => true,
	                ),
					array(
						"param_name" => "module_meta",
						"type" => "dropdown",
						"value" => array(
							'Disable' => 'false',
							'Enable' => 'true',
						),
						"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "author_name",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Author Name:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',
					),
					array(
						"param_name" => "time_diff",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Time Difference:", 'js_composer' ),
						"description" => "Enable or Disable Human Readable time difference",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_date",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Date:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_time",
						"type" => "dropdown",
						"value" => array(
							'No' => '0',
							'Yes' => '1',
						),
						"heading" => __("Post Time:", 'js_composer' ),
						"description" => "will only work when time difference will be disable",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_view_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Views Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "post_comment_count",
						"type" => "dropdown",
						"value" => array(
							'Yes' => '1',
							'No' => '0',
						),
						"heading" => __("Post Comments Count:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Post Meta Settings',

					),
					array(
						"param_name" => "text_align",
						"type" => "dropdown",
						"value" => array(
							'Left Align' => '',
							'Center Align' => 'text-center',
						),
						"heading" => __("Text Align:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Design Options',

					),
					array(
						"param_name" => "module_bg",
						"type" => "colorpicker",
						"value" => '',
						"heading" => __("Background Color:", 'js_composer' ),
						"description" => "",
						"save_always" => true,
						"group"	=> 'Design Options',

					),
					array(
						"param_name" => "module_padding",
						"type" => "textfield",
						"value" => '',
						"heading" => __("Padding:", 'js_composer' ),
						"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
						"save_always" => true,
						"group"	=> 'Design Options',
					)

				) // End params
			) );
			
			/*---------------------------------------------------------------------------------
			Module 6
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Module 6", 'js_composer' ),
					"description"			=> '',
					"base"					=> "fav-module-6",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-module-6",
					"params"				=> array(
						
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "category_ids",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Multiple categories filter:", 'js_composer' ),
		                    "description" => "To filter multiple categories, enter here the category IDs separated by commas (example: 4,21,15 )",
		                    
		                ),
		                array(
		                    "param_name" => "tag_slug",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Filter by tag slug:", 'js_composer' ),
		                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
		                    
		                ),
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("6", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "show_child_cat",
			                "type" => "dropdown",
			                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
			                "heading" => __("Show child categories menu:", 'js_composer' ),
			                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
			                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
			               
			            ),
			            array(
			                "param_name" => "excerpt_limit",
			                "type" => "textfield",
			                "value" => "170",
			                "heading" => __("Excerpt Limit:", 'js_composer' ),
			                "description" => __("How much characters want to show as excerpt: default 150", 'js_composer' ),
							"save_always" => true,
			            ),
						array(
							"param_name" => "image_size",
							"type" => "dropdown",
							"value" => array('370 x 277' => '370_277', '570 x 427' => '570_427'),
							"heading" => __("Image Size:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
						),
			            array(
		                     "param_name" => "read_more",
		                     "type" => "dropdown",
		                     "value" => array('- Show -' => 'true', 'Hide' => 'false'),
		                     "heading" => __("Hide Continue Reading:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)

					) // End params
				) );

			/*---------------------------------------------------------------------------------
			Module 7
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Module 7", 'js_composer' ),
					"description"			=> '',
					"base"					=> "fav-module-7",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-module-7",
					"params"				=> array(
						
						array(
		                     "param_name" => "module_7_type",
		                     "type" => "dropdown",
		                     "value" => array(' 3 Columns ' => 'three_columns', '2 Columns ( recommend when use sidebar )' => 'two_columns', ' 1 Columns ' => 'one_columns' ),
		                     "heading" => __("With or Without Sidebar:", 'js_composer' ),
		                     "description" => __( "If you select Visual Composer + Sidebar template then choose With Sidebar option", "js_composer" ),
							 "save_always" => true,
		                     
		                ),
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "category_ids",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Multiple categories filter:", 'js_composer' ),
		                    "description" => "To filter multiple categories, enter the category IDs separated by commas (example: 4,21,15)",
		                    
		                ),
		                array(
		                    "param_name" => "tag_slug",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Filter by tag slug:", 'js_composer' ),
		                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
		                    
		                ),
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("6", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "show_child_cat",
			                "type" => "dropdown",
			                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
			                "heading" => __("Show child categories menu:", 'js_composer' ),
			                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
			                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
			               
			            ),
						array(
							"param_name" => "image_size",
							"type" => "dropdown",
							"value" => array('370 x 277' => '370_277', '570 x 427' => '570_427'),
							"heading" => __("Image Size:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
						),
			            array(
		                     "param_name" => "module_space",
		                     "type" => "dropdown",
		                     "value" => array('- With Space -' => '', 'Without Space' => 'row-no-padding'),
		                     "heading" => __("Space:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "text_align",
							"type" => "dropdown",
							"value" => array(
								'Left Align' => '',
								'Center Align' => 'text-center',
							),
							"heading" => __("Text Align:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)
			       			            

					) // End params
				) );

				
			/*---------------------------------------------------------------------------------
			Module 8
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Module 8", 'js_composer' ),
					"description"			=> '',
					"base"					=> "fav-module-8",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-module-8",
					"params"				=> array(
						
						
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "category_ids",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Multiple categories filter:", 'js_composer' ),
		                    "description" => "To filter multiple categories, enter the category IDs separated by commas (example: 4,21,15)",
		                    
		                ),
		                array(
		                    "param_name" => "tag_slug",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Filter by tag slug:", 'js_composer' ),
		                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
		                    
		                ),
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),

		                array(
		                     "param_name" => "hide_meta",
		                     "type" => "dropdown",
		                     "value" => array('- Show Meta -' => 'show_meta', 'Hide Meta' => 'hide_meta'),
		                     "heading" => __("Hide Posts Meta:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("9", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),

			            array(
			                "param_name" => "slider_post_row",
			                "type" => "dropdown",
			                "value" => array(
			                	'2' => '2',
			                	'3' => '3',
			                	'4' => '4',
			                	'5' => '5',
			                	'6' => '6'
			                	),
			                "heading" => __("Post to Show:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "slider_auto",
			                "type" => "dropdown",
			                "value" => array(
			                	'No' => 'false',
			                	'Yes' => 'true'
			                	),
			                "heading" => __("Auto Play:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "stop_on_hover",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Stop on Mouse Hover:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "navigation",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Navigation:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
						array(
							"param_name" => "touch_drag",
							"type" => "dropdown",
							"value" => array(
								'Yes' => 'true',
								'No' => 'false'
							),
							"heading" => __("Touch Drag:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Carousel Settings'
						),
						array(
							"param_name" => "slide_loop",
							"type" => "dropdown",
							"value" => array(
								'No' => 'false',
								'Yes' => 'true'
							),
							"heading" => __("Loop:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Carousel Settings'
						),
			            array(
			                "param_name" => "rewind_nav",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Rewind Nav:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "lazy_load",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Lazy Load:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "text_align",
							"type" => "dropdown",
							"value" => array(
								'Left Align' => '',
								'Center Align' => 'text-center',
							),
							"heading" => __("Text Align:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)

					) // End params
				) );

			/*---------------------------------------------------------------------------------
			Module 9
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Module 9", 'js_composer' ),
					"description"			=> '',
					"base"					=> "fav-module-9",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-module-9",
					"params"				=> array(
						
						array(
		                     "param_name" => "module_9_type",
		                     "type" => "dropdown",
		                     "value" => array('- Full Width Template -' => 'full_width', 'Sidebar Template' => 'sidebar_template'),
		                     "heading" => __("Select where you want to use this module:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "category_ids",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Multiple categories filter:", 'js_composer' ),
		                    "description" => "To filter multiple categories, enter the category IDs separated by commas (example: 4,21,15)",
		                    
		                ),
		                array(
		                    "param_name" => "tag_slug",
		                    "type" => "textfield",
		                    "value" => '',
		                    "heading" => __("Filter by tag slug:", 'js_composer' ),
		                    "description" => "To filter multiple tag slug, enter here the tag slugs separated by commas (example: tag1,tag2,tag3)",
		                    
		                ),
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Highest rated (reviews)' => 'review_high', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("10", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
		                     "param_name" => "module_space",
		                     "type" => "dropdown",
		                     "value" => array('- With Space -' => '', 'Without Space' => 'row-no-padding'),
		                     "heading" => __("Space:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                     
		                ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)
			            

					) // End params
				) );


    if (is_plugin_active('favethemes-theme-functionality/favethemes-theme-functionality.php')) {
				
			/*---------------------------------------------------------------------------------
				Video Custom Post Module 1
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Video Module 1", 'js_composer' ),
					"description"			=> 'Video custom post type',
					"base"					=> "fav-video-module-1",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-video-module-1",
					"params"				=> array(
						
						array(
		                     "param_name" => "module_7_type",
		                     "type" => "dropdown",
		                     "value" => array(' 3 Columns ' => 'three_columns', '2 Columns ( recommend when use sidebar )' => 'two_columns', ' 1 Column ' => 'one_columns' ),
		                     "heading" => __("With or Without Sidebar:", 'js_composer' ),
		                     "description" => __( "If you select Visual Composer + Sidebar template then choose With Sidebar option", "js_composer" ),
							 "save_always" => true,
		                ),
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_video_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		            
		            
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("6", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "show_child_cat",
			                "type" => "dropdown",
			                "value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
			                "heading" => __("Show child categories menu:", 'js_composer' ),
			                "description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
			                "dependency" => Array("element" => "hide_title", "value" => array("show_title")),
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),
						array(
							"param_name" => "image_size",
							"type" => "dropdown",
							"value" => array('370 x 208' => '370_208', '570 x 320' => '570_320'),
							"heading" => __("Image Size:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
						),
			            array(
		                     "param_name" => "pagination",
		                     "type" => "dropdown",
		                     "value" => array('- No -' => '', 'Next/Prev' => 'prev-next', 'Numeric' => 'numeric', 'Load More' => 'load-more', 'Infinite Scroll' => 'infinite-scroll'),
		                     "heading" => __("Pagination:", 'js_composer' ),
		                     "description" => "",
		                     
		                ),
		                array(
		                     "param_name" => "module_space",
		                     "type" => "dropdown",
		                     "value" => array('- With Space -' => '', 'Without Space' => 'row-no-padding'),
		                     "heading" => __("Space:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "text_align",
							"type" => "dropdown",
							"value" => array(
								'Left Align' => '',
								'Center Align' => 'text-center',
							),
							"heading" => __("Text Align:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)
			            

					) // End params
				) );

			/*---------------------------------------------------------------------------------
			Video Module 2
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Video Module 2", 'js_composer' ),
					"description"			=> 'Video custom post type, Carousel',
					"base"					=> "fav-video-module-2",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-video-module-2",
					"params"				=> array(
						
						
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_video_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true
		                ),

		                array(
		                     "param_name" => "hide_meta",
		                     "type" => "dropdown",
		                     "value" => array('- Show Meta -' => 'show_meta', 'Hide Meta' => 'hide_meta'),
		                     "heading" => __("Hide Posts Meta:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("9", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),

			            array(
			                "param_name" => "slider_post_row",
			                "type" => "dropdown",
			                "value" => array(
			                	'2' => '2',
			                	'3' => '3',
			                	'4' => '4',
			                	'5' => '5',
			                	'6' => '6'
			                	),
			                "heading" => __("Post to Show:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "slider_auto",
			                "type" => "dropdown",
			                "value" => array(
			                	'No' => 'false',
			                	'Yes' => 'true'
			                	),
			                "heading" => __("Auto Play:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "stop_on_hover",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Stop on Mouse Hover:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "navigation",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Navigation:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
						array(
							"param_name" => "touch_drag",
							"type" => "dropdown",
							"value" => array(
								'Yes' => 'true',
								'No' => 'false'
							),
							"heading" => __("Touch Drag:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Carousel Settings'
						),
						array(
							"param_name" => "slide_loop",
							"type" => "dropdown",
							"value" => array(
								'No' => 'false',
								'Yes' => 'true'
							),
							"heading" => __("Loop:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Carousel Settings'
						),
			            array(
			                "param_name" => "rewind_nav",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Rewind Nav:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
			            array(
			                "param_name" => "lazy_load",
			                "type" => "dropdown",
			                "value" => array(
			                	'Yes' => 'true',
			                	'No' => 'false'
			                	),
			                "heading" => __("Lazy Load:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			                "group"	=> 'Carousel Settings'
			            ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "text_align",
							"type" => "dropdown",
							"value" => array(
								'Left Align' => '',
								'Center Align' => 'text-center',
							),
							"heading" => __("Text Align:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)
			            

					) // End params
				) );

			/*---------------------------------------------------------------------------------
			Video Module 3
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Video Module 3", 'js_composer' ),
					"description"			=> 'Video custom post type',
					"base"					=> "fav-video-module-3",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-video-module-3",
					"params"				=> array(
						
						array(
		                     "param_name" => "module_9_type",
		                     "type" => "dropdown",
		                     "value" => array('- Full Width Template -' => 'full_width', 'Sidebar Template' => 'sidebar_template'),
		                     "heading" => __("Select where you want to use this module:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                ),
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_video_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
		                    "param_name" => "autors_id",
		                    "type" => "dropdown",
		                    "value" => fave_create_array_authors(),
		                    "heading" => "Autors Filter:",
		                    "description" => "",
		                    
		                ),
		                array(
		                     "param_name" => "featured_posts",
		                     "type" => "dropdown",
		                     "value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
		                     "heading" => __("Featured Posts:", 'js_composer' ),
		                     "description" => __( "You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),  
		                ),
		                array(
		                     "param_name" => "hide_title",
		                     "type" => "dropdown",
		                     "value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
		                     "heading" => __("Hide block title:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                ),

						array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("10", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "",
							"save_always" => true,
			            ),
			            array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header color", 'js_composer' ),
			                "param_name" => "header_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text color", 'js_composer' ),
			                "param_name" => "header_text_color",
			                "value" => '', 
			                "description" => __("Choose a custom header color for this block", 'js_composer' )
			            ),
			            array(
			                "type" => "colorpicker",
			                
			                "heading" => __("Header text top border color", 'js_composer' ),
			                "param_name" => "header_border_color",
			                "value" => '', 
			                "description" => __("Choose a custom color for block title border top", 'js_composer' )
			            ),
			            array(
			                "param_name" => "custom_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this block:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "custom_url",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer' ),
			                "description" => "",
			               
			            ),
			            array(
			                "param_name" => "title_style",
			                "type" => "dropdown",
			                "value" => array('- default style -' => ''),
			                "heading" => __("Title style:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
		                     "param_name" => "module_space",
		                     "type" => "dropdown",
		                     "value" => array('- With Space -' => '', 'Without Space' => 'row-no-padding'),
		                     "heading" => __("Space:", 'js_composer' ),
		                     "description" => "",
							 "save_always" => true,
		                ),
						array(
							"param_name" => "module_meta",
							"type" => "dropdown",
							"value" => array(
								'Disable' => 'false',
								'Enable' => 'true',
							),
							"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "author_name",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Author Name:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',
						),
						array(
							"param_name" => "time_diff",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Time Difference:", 'js_composer' ),
							"description" => "Enable or Disable Human Readable time difference",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_date",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Date:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_time",
							"type" => "dropdown",
							"value" => array(
								'No' => '0',
								'Yes' => '1',
							),
							"heading" => __("Post Time:", 'js_composer' ),
							"description" => "will only work when time difference will be disable",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_view_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Views Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "post_comment_count",
							"type" => "dropdown",
							"value" => array(
								'Yes' => '1',
								'No' => '0',
							),
							"heading" => __("Post Comments Count:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Post Meta Settings',

						),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)
			            

					) // End params
				) );


			
			/*---------------------------------------------------------------------------------
				Video Custom Post video Gallery Module
			-----------------------------------------------------------------------------------*/

			vc_map( array(
					"name"					=> __( "Video Gallery", 'js_composer' ),
					"description"			=> 'Video custom post type',
					"base"					=> "fav-video-gallery",
					'category'				=> "By Favethemes",
					"class"					=> "",
					'admin_enqueue_js'		=> "",
					'admin_enqueue_css'		=> "",
					"icon" 					=> "icon-video-gallery",
					"params"				=> array(
						
						array(
			                "param_name" => "playlist_title",
			                "type" => "textfield",
			                "value" => "",
			                "heading" => __("Optional - custom title for this playlist:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
		                     "param_name" => "post_from",
		                     "type" => "dropdown",
		                     "value" => array('Featured Videos' => 'featured', 'Category Videos' => 'category_videos'),
		                     "heading" => __("Posts to display in slider:", 'js_composer' ),
		                     "description" => __( "Display featured videos from all categories or Videos from specific category", 'js_composer'),
							 "save_always" => true,
		                ),
						array(
		                    "param_name" => "category_id",
		                    "type" => "dropdown",
		                    "value" => fave_get_video_category_id_array(),
		                    "heading" => __("Category filter:", 'js_composer' ),
		                    "dependency" => Array("element" => "post_from", "value" => array("category_videos")),
		                    
		                ),
		            
		            
		                array(
		                    "param_name" => "sort",
		                    "type" => "dropdown",
		                    "value" => array('- Latest -' => '', 'Random posts Today' => 'random_today' , 'Random posts from last 7 Day' => 'random_7_day' , 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
		                    "heading" => __("Sort order:", 'js_composer' ),
		                    "description" => "",
		                    
		                ),
		                array(
			                "param_name" => "offset",
			                "type" => "textfield",
			                "value" => __("", 'js_composer' ),
			                "heading" => __("Offset posts:", 'js_composer' ),
			                "description" => "",
			                
			            ),
			            array(
			                "param_name" => "posts_limit",
			                "type" => "textfield",
			                "value" => __("10", 'js_composer' ),
			                "heading" => __("Limit post number:", 'js_composer' ),
			                "description" => "add -1 for all posts to show",
							"save_always" => true,
			            ),
						array(
							"param_name" => "module_bg",
							"type" => "colorpicker",
							"value" => '',
							"heading" => __("Background Color:", 'js_composer' ),
							"description" => "",
							"save_always" => true,
							"group"	=> 'Design Options',

						),
						array(
							"param_name" => "module_padding",
							"type" => "textfield",
							"value" => '',
							"heading" => __("Padding:", 'js_composer' ),
							"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
							"save_always" => true,
							"group"	=> 'Design Options',
						)

					) // End params
				) );


		/*---------------------------------------------------------------------------------
            Gallery Custom Post Type Module 1
        -----------------------------------------------------------------------------------*/

		vc_map(array(
			"name" => __("Gallery Module 1", 'js_composer'),
			"description" => 'Gallery custom post type',
			"base" => "fav-gallery-module-1",
			'category' => "By Favethemes",
			"class" => "",
			'admin_enqueue_js' => "",
			'admin_enqueue_css' => "",
			"icon" => "icon-gallery-module-1",
			"params" => array(

				array(
					"param_name" => "module_7_type",
					"type" => "dropdown",
					"value" => array(' 3 Columns ' => 'three_columns', '2 Columns ( recommend when use sidebar )' => 'two_columns', ' 1 Column ' => 'one_columns' ),
					"heading" => __("With or Without Sidebar:", 'js_composer'),
					"description" => __("If you select Visual Composer + Sidebar template then choose With Sidebar option", "js_composer"),
					"save_always" => true,
				),
				array(
					"param_name" => "category_id",
					"type" => "dropdown",
					"value" => fave_get_gallery_category_id_array(),
					"heading" => __("Category filter:", 'js_composer'),
					"description" => "",

				),


				array(
					"param_name" => "sort",
					"type" => "dropdown",
					"value" => array('- Latest -' => '', 'Random posts Today' => 'random_today', 'Random posts from last 7 Day' => 'random_7_day', 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
					"heading" => __("Sort order:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "autors_id",
					"type" => "dropdown",
					"value" => fave_create_array_authors(),
					"heading" => "Autors Filter:",
					"description" => "",

				),
				array(
					"param_name" => "featured_posts",
					"type" => "dropdown",
					"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
					"heading" => __("Featured Posts:", 'js_composer'),
					"description" => __("You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),
				),
				array(
					"param_name" => "hide_title",
					"type" => "dropdown",
					"value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
					"heading" => __("Hide block title:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),

				array(
					"param_name" => "posts_limit",
					"type" => "textfield",
					"value" => __("6", 'js_composer'),
					"heading" => __("Limit post number:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "offset",
					"type" => "textfield",
					"value" => __("", 'js_composer'),
					"heading" => __("Offset posts:", 'js_composer'),
					"description" => "",

				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header color", 'js_composer'),
					"param_name" => "header_color",
					"value" => '',
					"description" => __("Choose a custom header color for this block", 'js_composer')
				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header text color", 'js_composer'),
					"param_name" => "header_text_color",
					"value" => '',
					"description" => __("Choose a custom header color for this block", 'js_composer')
				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header text top border color", 'js_composer'),
					"param_name" => "header_border_color",
					"value" => '',
					"description" => __("Choose a custom color for block title border top", 'js_composer')
				),
				array(
					"param_name" => "custom_title",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom title for this block:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "custom_url",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "show_child_cat",
					"type" => "dropdown",
					"value" => array('- Hide -' => '', 'Show 1 category' => '1', 'Show 2 categories' => '2', 'Show 3 categories' => '3', 'Show 4 categories' => '4', 'Show 5 categories' => '5', 'Show 6 categories' => '6', 'Show 7 categories' => '7', 'Show 8 categories' => '8', 'Show all' => 'all'),
					"heading" => __("Show child categories menu:", 'js_composer'),
					"description" => "This will show a menu at the top of the block that contains the child categories of the selected category. It only works when you're using a single category filter form the dropdown. It doss't work with multiple categories IDs",
					"dependency" => Array("element" => "hide_title", "value" => array("show_title")),
					"save_always" => true,
				),
				array(
					"param_name" => "title_style",
					"type" => "dropdown",
					"value" => array('- default style -' => ''),
					"heading" => __("Title style:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "pagination",
					"type" => "dropdown",
					"value" => array('- No -' => '', 'Next/Prev' => 'prev-next', 'Numeric' => 'numeric', 'Load More' => 'load-more', 'Infinite Scroll' => 'infinite-scroll'),
					"heading" => __("Pagination:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "image_size",
					"type" => "dropdown",
					"value" => array('370 x 278' => '370_278', '570 x 428' => '570_428'),
					"heading" => __("Image Size:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "module_space",
					"type" => "dropdown",
					"value" => array('- With Space -' => '', 'Without Space' => 'row-no-padding'),
					"heading" => __("Space:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "module_meta",
					"type" => "dropdown",
					"value" => array(
						'Disable' => 'false',
						'Enable' => 'true',
					),
					"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "author_name",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Author Name:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "time_diff",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Time Difference:", 'js_composer' ),
					"description" => "Enable or Disable Human Readable time difference",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_date",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Date:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_time",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Time:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_view_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Views Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_comment_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Comments Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "text_align",
					"type" => "dropdown",
					"value" => array(
						'Left Align' => '',
						'Center Align' => 'text-center',
					),
					"heading" => __("Text Align:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)


			) // End params
		));

		/*---------------------------------------------------------------------------------
        Gallery Module 2
        -----------------------------------------------------------------------------------*/

		vc_map(array(
			"name" => __("Gallery Module 2", 'js_composer'),
			"description" => 'Gallery custom post type, Carousel',
			"base" => "fav-gallery-module-2",
			'category' => "By Favethemes",
			"class" => "",
			'admin_enqueue_js' => "",
			'admin_enqueue_css' => "",
			"icon" => "icon-gallery-module-2",
			"params" => array(


				array(
					"param_name" => "category_id",
					"type" => "dropdown",
					"value" => fave_get_gallery_category_id_array(),
					"heading" => __("Category filter:", 'js_composer'),
					"description" => "",

				),

				array(
					"param_name" => "sort",
					"type" => "dropdown",
					"value" => array('- Latest -' => '', 'Random posts Today' => 'random_today', 'Random posts from last 7 Day' => 'random_7_day', 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
					"heading" => __("Sort order:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "autors_id",
					"type" => "dropdown",
					"value" => fave_create_array_authors(),
					"heading" => "Autors Filter:",
					"description" => "",

				),
				array(
					"param_name" => "featured_posts",
					"type" => "dropdown",
					"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
					"heading" => __("Featured Posts:", 'js_composer'),
					"description" => __("You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),
				),
				array(
					"param_name" => "hide_title",
					"type" => "dropdown",
					"value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
					"heading" => __("Hide block title:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),

				array(
					"param_name" => "hide_meta",
					"type" => "dropdown",
					"value" => array('- Show Meta -' => 'show_meta', 'Hide Meta' => 'hide_meta'),
					"heading" => __("Hide Posts Meta:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),

				array(
					"param_name" => "posts_limit",
					"type" => "textfield",
					"value" => __("9", 'js_composer'),
					"heading" => __("Limit post number:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "offset",
					"type" => "textfield",
					"value" => __("", 'js_composer'),
					"heading" => __("Offset posts:", 'js_composer'),
					"description" => "",

				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header color", 'js_composer'),
					"param_name" => "header_color",
					"value" => '',
					"description" => __("Choose a custom header color for this block", 'js_composer')
				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header text color", 'js_composer'),
					"param_name" => "header_text_color",
					"value" => '',
					"description" => __("Choose a custom header color for this block", 'js_composer')
				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header text top border color", 'js_composer'),
					"param_name" => "header_border_color",
					"value" => '',
					"description" => __("Choose a custom color for block title border top", 'js_composer')
				),
				array(
					"param_name" => "custom_title",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom title for this block:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "custom_url",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "title_style",
					"type" => "dropdown",
					"value" => array('- default style -' => ''),
					"heading" => __("Title style:", 'js_composer'),
					"description" => "",

				),

				array(
					"param_name" => "slider_post_row",
					"type" => "dropdown",
					"value" => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6'
					),
					"heading" => __("Post to Show:", 'js_composer'),
					"description" => "",
					"save_always" => true,
					"group" => 'Carousel Settings'
				),
				array(
					"param_name" => "slider_auto",
					"type" => "dropdown",
					"value" => array(
						'No' => 'false',
						'Yes' => 'true'
					),
					"heading" => __("Auto Play:", 'js_composer'),
					"description" => "",
					"save_always" => true,
					"group" => 'Carousel Settings'
				),
				array(
					"param_name" => "stop_on_hover",
					"type" => "dropdown",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					),
					"heading" => __("Stop on Mouse Hover:", 'js_composer'),
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
					"heading" => __("Navigation:", 'js_composer'),
					"description" => "",
					"save_always" => true,
					"group" => 'Carousel Settings'
				),
				array(
					"param_name" => "touch_drag",
					"type" => "dropdown",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					),
					"heading" => __("Touch Drag:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Carousel Settings'
				),
				array(
					"param_name" => "slide_loop",
					"type" => "dropdown",
					"value" => array(
						'No' => 'false',
						'Yes' => 'true'
					),
					"heading" => __("Loop:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Carousel Settings'
				),
				array(
					"param_name" => "rewind_nav",
					"type" => "dropdown",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					),
					"heading" => __("Rewind Nav:", 'js_composer'),
					"description" => "",
					"save_always" => true,
					"group" => 'Carousel Settings'
				),
				array(
					"param_name" => "lazy_load",
					"type" => "dropdown",
					"value" => array(
						'Yes' => 'true',
						'No' => 'false'
					),
					"heading" => __("Lazy Load:", 'js_composer'),
					"description" => "",
					"save_always" => true,
					"group" => 'Carousel Settings'
				),
				array(
					"param_name" => "module_meta",
					"type" => "dropdown",
					"value" => array(
						'Disable' => 'false',
						'Enable' => 'true',
					),
					"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "author_name",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Author Name:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "time_diff",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Time Difference:", 'js_composer' ),
					"description" => "Enable or Disable Human Readable time difference",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_date",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Date:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_time",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Time:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_view_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Views Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_comment_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Comments Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "text_align",
					"type" => "dropdown",
					"value" => array(
						'Left Align' => '',
						'Center Align' => 'text-center',
					),
					"heading" => __("Text Align:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)


			) // End params
		));

		/*---------------------------------------------------------------------------------
        Gallery Module 3
        -----------------------------------------------------------------------------------*/

		vc_map(array(
			"name" => __("Gallery Module 3", 'js_composer'),
			"description" => 'Gallery custom post type',
			"base" => "fav-gallery-module-3",
			'category' => "By Favethemes",
			"class" => "",
			'admin_enqueue_js' => "",
			'admin_enqueue_css' => "",
			"icon" => "icon-gallery-module-3",
			"params" => array(

				array(
					"param_name" => "module_9_type",
					"type" => "dropdown",
					"value" => array('- Full Width Template -' => 'full_width', 'Sidebar Template' => 'sidebar_template'),
					"heading" => __("Select where you want to use this module:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "category_id",
					"type" => "dropdown",
					"value" => fave_get_gallery_category_id_array(),
					"heading" => __("Category filter:", 'js_composer'),
					"description" => "",

				),

				array(
					"param_name" => "sort",
					"type" => "dropdown",
					"value" => array('- Latest -' => '', 'Random posts Today' => 'random_today', 'Random posts from last 7 Day' => 'random_7_day', 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
					"heading" => __("Sort order:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "autors_id",
					"type" => "dropdown",
					"value" => fave_create_array_authors(),
					"heading" => "Autors Filter:",
					"description" => "",

				),
				array(
					"param_name" => "featured_posts",
					"type" => "dropdown",
					"value" => array('- Any -' => '', 'Exclude' => 'no', 'Include' => 'yes'),
					"heading" => __("Featured Posts:", 'js_composer'),
					"description" => __("You can make a post featured by clicking featured post checkbox while add/edit post", 'js_composer'),
				),
				array(
					"param_name" => "hide_title",
					"type" => "dropdown",
					"value" => array('- Show title -' => 'show_title', 'Hide title' => 'hide_title'),
					"heading" => __("Hide block title:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),

				array(
					"param_name" => "posts_limit",
					"type" => "textfield",
					"value" => __("10", 'js_composer'),
					"heading" => __("Limit post number:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "offset",
					"type" => "textfield",
					"value" => __("", 'js_composer'),
					"heading" => __("Offset posts:", 'js_composer'),
					"description" => "",

				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header color", 'js_composer'),
					"param_name" => "header_color",
					"value" => '',
					"description" => __("Choose a custom header color for this block", 'js_composer')
				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header text color", 'js_composer'),
					"param_name" => "header_text_color",
					"value" => '',
					"description" => __("Choose a custom header color for this block", 'js_composer')
				),
				array(
					"type" => "colorpicker",

					"heading" => __("Header text top border color", 'js_composer'),
					"param_name" => "header_border_color",
					"value" => '',
					"description" => __("Choose a custom color for block title border top", 'js_composer')
				),
				array(
					"param_name" => "custom_title",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom title for this block:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "custom_url",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom url for this block (when the module title is clicked):", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "title_style",
					"type" => "dropdown",
					"value" => array('- default style -' => ''),
					"heading" => __("Title style:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "module_space",
					"type" => "dropdown",
					"value" => array('- With Space -' => '', 'Without Space' => 'row-no-padding'),
					"heading" => __("Space:", 'js_composer'),
					"description" => "",
					"save_always" => true,
				),
				array(
					"param_name" => "module_meta",
					"type" => "dropdown",
					"value" => array(
						'Disable' => 'false',
						'Enable' => 'true',
					),
					"heading" => __("Enable/Disable module level meta settings:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "author_name",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Author Name:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',
				),
				array(
					"param_name" => "time_diff",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Time Difference:", 'js_composer' ),
					"description" => "Enable or Disable Human Readable time difference",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_date",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Date:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_time",
					"type" => "dropdown",
					"value" => array(
						'No' => '0',
						'Yes' => '1',
					),
					"heading" => __("Post Time:", 'js_composer' ),
					"description" => "will only work when time difference will be disable",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_view_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Views Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "post_comment_count",
					"type" => "dropdown",
					"value" => array(
						'Yes' => '1',
						'No' => '0',
					),
					"heading" => __("Post Comments Count:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Post Meta Settings',

				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)


			) // End params
		));


		/*---------------------------------------------------------------------------------
            Custom Post Gallery Module
        -----------------------------------------------------------------------------------*/

		vc_map(array(
			"name" => __("Custom Post Gallery", 'js_composer'),
			"description" => 'Gallery custom post type',
			"base" => "fav-custom-post-gallery",
			'category' => "By Favethemes",
			"class" => "",
			'admin_enqueue_js' => "",
			'admin_enqueue_css' => "",
			"icon" => "icon-custom-post-gallery",
			"params" => array(

				array(
					"param_name" => "gallery_title",
					"type" => "textfield",
					"value" => "",
					"heading" => __("Optional - custom title for this gallery:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "post_from",
					"type" => "dropdown",
					"value" => array('Featured Posts' => 'featured', 'Category Posts' => 'category_posts'),
					"heading" => __("Posts to display in slider:", 'js_composer'),
					"description" => __("Display featured posts from all categories or posts from specific category", 'js_composer'),
					"save_always" => true,
				),
				array(
					"param_name" => "category_id",
					"type" => "dropdown",
					"value" => fave_get_gallery_category_id_array(),
					"heading" => __("Category filter:", 'js_composer'),
					"dependency" => Array("element" => "post_from", "value" => array("category_posts")),

				),


				array(
					"param_name" => "sort",
					"type" => "dropdown",
					"value" => array('- Latest -' => '', 'Random posts Today' => 'random_today', 'Random posts from last 7 Day' => 'random_7_day', 'Alphabetical A -> Z' => 'alphabetical_order', 'Popular (all time)' => 'popular', 'Random Posts' => 'random_posts', 'Most Commented' => 'comment_count'),
					"heading" => __("Sort order:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "offset",
					"type" => "textfield",
					"value" => __("", 'js_composer'),
					"heading" => __("Offset posts:", 'js_composer'),
					"description" => "",

				),
				array(
					"param_name" => "posts_limit",
					"type" => "textfield",
					"value" => __("10", 'js_composer'),
					"heading" => __("Limit post number:", 'js_composer'),
					"description" => "add -1 for all posts to show",
					"save_always" => true,
				),
				array(
					"param_name" => "module_bg",
					"type" => "colorpicker",
					"value" => '',
					"heading" => __("Background Color:", 'js_composer' ),
					"description" => "",
					"save_always" => true,
					"group"	=> 'Design Options',

				),
				array(
					"param_name" => "module_padding",
					"type" => "textfield",
					"value" => '',
					"heading" => __("Padding:", 'js_composer' ),
					"description" => "Add padding top right bottom left. Example 10px 10px 10px 10px",
					"save_always" => true,
					"group"	=> 'Design Options',
				)

			) // End params
		));
	}



} // End Class_exists
?>