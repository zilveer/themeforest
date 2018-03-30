<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $differentThemes_meta_fields;

$differentThemes_meta_fields = new DifferentThemesManagment(THEME_FULL_NAME,THEME_NAME, "meta");

$differentThemes_meta_options= array(
	/* ------------------------------------------------------------------------*
	 * META SETTINGS
	 * ------------------------------------------------------------------------*/   
	array(
		"type" => "meta_block",
		"title" => THEME_NAME.esc_html__("Settings", THEME_NAME),
		"blocks" => array(
			array(
				"options" => array(
					array(
						"type" => "navigation",
					),					
					array(
						"type" => "meta_sub_navigation",
						"subname"=>array(
							array(
								"slug"=>"general", 
								"icon"=>"dashicons-admin-generic", 
								"name"=> esc_html__("General", THEME_NAME),
								/*"hide_in"=> array(DF_POST_GALLERY),//post/page type*/
								"page_type" => array("page","post","!blog",DF_POST_GALLERY),

							), 
							array(
								"slug"=>"post_settings", 
								"icon"=>"dashicons-list-view", 
								"name"=> esc_html__("Post/Page Settings", THEME_NAME),
								"hide_in"=> array("product"),//post/page type
								"page_type" => array("page","post"),
								//"skip_templates"=> array('homepage', 'gallery-1')//page template
							), 
							array(
								"slug"=>"sidebar", 
								"icon"=>"dashicons-admin-appearance", 
								"name"=>esc_html__("Sidebar", THEME_NAME),
								"skip_templates"=> array('homepage'),
							), 

						)
					),

					/* ------------------------------------------------------------------------*
					 * GENERAL SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'general',
						/*"hide_in"=> array(DF_POST_GALLERY),//post/page type*/
						"page_type" => array("page","post","!blog",DF_POST_GALLERY),
					),
	
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => df_get_option(THEME_NAME.'_show_single_thumb'),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Image In Single Post / News Page", THEME_NAME),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"page_type" => array("page","post","!blog"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_show_single_thumb",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"compare" => df_get_option(THEME_NAME.'_show_single_thumb'),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"compare" => df_get_option(THEME_NAME.'_show_single_thumb'),
					),
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => df_get_option(THEME_NAME.'_single_thumb_size'),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Image Size Post / News Page", THEME_NAME),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"page_type" => array("page","post","!blog"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_single_thumb_size",
						"radio" => array(
							array("title" => esc_html__("Full:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Cropped:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"compare" => df_get_option(THEME_NAME.'_single_thumb_size'),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"compare" => df_get_option(THEME_NAME.'_single_thumb_size'),
					),				
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => df_get_option(THEME_NAME.'_imagePopUp'),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Clickable Single Post/Page Image", THEME_NAME),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"page_type" => array("page","post","!blog"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_imagePopUp",
						"radio" => array(
							array("title" => esc_html__("Yes:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("No:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"compare" => df_get_option(THEME_NAME.'_imagePopUp'),
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","gallery-1","portfolio","archive"),
						"compare" => df_get_option(THEME_NAME.'_imagePopUp'),
					),					
						array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_showTumbIcon'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Icons on Thumbnails in Post Listing Pages", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_showTumbIcon",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_showTumbIcon'),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_showTumbIcon'),
					),					
		
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"compare" => df_get_option(THEME_NAME.'_show_single_title'),
						"skip_templates"=> array('homepage')//page template
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Title In Single Post/Page", THEME_NAME),
						"page_type" => array("page","post","!blog"),
						"skip_templates"=> array('homepage')//page template
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_show_single_title",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"page_type" => array("page","post","!blog"),
						"compare" => df_get_option(THEME_NAME.'_show_single_title'),
						"skip_templates"=> array('homepage')//page template
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"compare" => df_get_option(THEME_NAME.'_show_single_title'),
						"skip_templates"=> array('homepage')//page template
					),

					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_postControls'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Post Controls",'different_themes'),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_postControls",
						"radio" => array(
							array("title" => esc_html__("Show:",'different_themes'), "value" => "show"),
							array("title" => esc_html__("Hide:",'different_themes'), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_postControls'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_postAuthor'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Post Author", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_postAuthor",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_postAuthor'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),


					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_postDate'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Post Date", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_postDate",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_postDate'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_postViews'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Post Views", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_postViews",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_postViews'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_showLikes'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Like Count", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_showLikes",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_showLikes'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),

					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_share_buttons'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Share Buttons", THEME_NAME),
						"page_type" => array("post"),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_share_buttons",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_share_buttons'),
						"page_type" => array("post"),
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
					),
					
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_postComments'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Post Comments Count", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_postComments",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_postComments'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_postCategory'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Post Categories", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_postCategory",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_postCategory'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_post_tag_single'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Post Tags", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_post_tag",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_post_tag_single'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_similar_posts'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("\"Similar News\" Block In Post", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_similar_posts",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_similar_posts'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),
					array(
						"type" => "row",
						"page_type" => array("post"),
						"compare" => df_get_option(THEME_NAME.'_aboutPostAuthor'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("\"About Author\" Block In Post", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_aboutPostAuthor",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_aboutPostAuthor'),
						"page_type" => array("post")
					),

					array(
						"type" => "close",
						"page_type" => array("post")
					),

					array(
						"type" => "row",
						"page_type" => array("homepage"),
					),

					array(
						"type" => "title",
						"title" => esc_html__("Show Main Slider?", THEME_NAME),
						"page_type" => array("homepage"),
					),
					array(
						"type" => "multiple_select",
						"title" => esc_html__("Set Main News Slider Categories", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_main_slider",
						"taxonomy" => "category",
						"default" => array('slider_off', esc_html__("Off", THEME_NAME)),
						"std" => 'slider_off',
						"page_type" => array("homepage"),
					),

					array(
						"type" => "close",
						"page_type" => array("homepage"),
					),
					array(
						"type" => "row",
						"page_type" => array("homepage"),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Slider Style", THEME_NAME),
						"page_type" => array("homepage"),

					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_sliderStyle",
						"radio" => array(
							array("title" => esc_html__("Small:", THEME_NAME), "value" => "1"),
							array("title" => esc_html__("Full Width:", THEME_NAME), "value" => "2")
						),
						"std" => '1',
						"page_type" => array("homepage"),
					),

					array(
						"type" => "close",
						"page_type" => array("homepage"),
					),
					array(
						"type" => "row",
						"page_type" => array(DF_POST_GALLERY),
						"compare" => df_get_option(THEME_NAME.'_similar_posts_gallery'),
						"skip_templates"=> array('gallery-1')//page template*/
					),
					array(
						"type" => "title",
						"title" => esc_html__("\"Similar News\" Block In Gallery", THEME_NAME),
						"page_type" => array(DF_POST_GALLERY),
						"skip_templates"=> array('gallery-1')//page template*/
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_similar_posts",
						"radio" => array(
							array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
							array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide")
						),
						"std" => 'show',
						"compare" => df_get_option(THEME_NAME.'_similar_posts_gallery'),
						"page_type" => array(DF_POST_GALLERY),
						"skip_templates"=> array('gallery-1')//page template*/
					),

					array(
						"type" => "close",
						"page_type" => array(DF_POST_GALLERY),
						"skip_templates"=> array('gallery-1')//page template*/
					),
					array(
						"type" => "closesubtab",
						/*"hide_in"=> array(DF_POST_GALLERY),//post/page type*/
						"page_type" => array("page","post","!blog",DF_POST_GALLERY),

					),
					/* ------------------------------------------------------------------------*
					 * POST SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'post_settings',
						"hide_in"=> array("product"),//post/page type
						"page_type" => array("page","post"),
						/*"skip_templates"=> array('homepage', 'gallery-1')//page template*/
					),
					array(
						"type" => "row",
						"page_type" => array("page")
					),
					array(
						"type" => "title",
						"title" => esc_html__("Page Color For Main Menu", THEME_NAME),
						"page_type" => array("page")
					),
					array(
						"type" => "color",
						"title" => esc_html__("Color:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_title_color",
						"std" => "f85050",
						"page_type" => array("page")
					),	
					array(
						"type" => "close",
						"page_type" => array("page")
					),
					array(
						"type" => "row",
						"page_type" => array('blog'),
					),
					array(
						"type" => "title",
						"title" => esc_html__("Blog Style", THEME_NAME),
						"page_type" => array('blog'),

					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_blogStyle",
						"radio" => array(
							array("title" => esc_html__("Grid View:", THEME_NAME), "value" => "1"),
							array("title" => esc_html__("Grid View Without Excerpt:", THEME_NAME), "value" => "4"),
							array("title" => esc_html__("List With Small Images:", THEME_NAME), "value" => "2"),
							array("title" => esc_html__("List With Large Images:", THEME_NAME), "value" => "3"),
							array("title" => esc_html__("List With Large Images And Title Above Image:", THEME_NAME), "value" => "5")
						),
						"std" => '1',
						"page_type" => array('blog'),
					),

					array(
						"type" => "close",
						"page_type" => array('blog'),
					),
					/*
					array(
						"type" => "row",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","archive","gallery-1")
					),
					array(
						"type" => "title",
						"title" => esc_html__("Featured Image Credits", THEME_NAME),
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","archive","gallery-1")
					),
					array(
						"type" => "input",
						"title" => esc_html__("Credits", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_image_caption",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","archive","gallery-1")
					),

					array(
						"type" => "close",
						"page_type" => array("page","post","!blog"),
						"skip_templates" => array("homepage","contact","about","archive","gallery-1")
					),
					

					array(
						"type" => "row",
						"page_type" => array("post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_post", "value" => "on")
						)
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Breaking News Slider?", THEME_NAME),
						"page_type" => array("post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_post", "value" => "on")
						)
					),
					array(
						"type" => "multiple_select",
						"title" => esc_html__("Set Custom Breaking News Slider Categories", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_breaking_slider",
						"taxonomy" => "category",
						"default" => array('slider_off', esc_html__("Off", THEME_NAME)),
						"std" => 'slider_off',
						"page_type" => array("post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_post", "value" => "on")
						)
					),

					array(
						"type" => "close",
						"page_type" => array("post"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_post", "value" => "on")
						)
					),
					array(
						"type" => "row",
						"page_type" => array("page"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_page", "value" => "on")
						)
					),
					array(
						"type" => "title",
						"title" => esc_html__("Show Breaking News Slider?", THEME_NAME),
						"page_type" => array("page"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_page", "value" => "on")
						)
					),
					array(
						"type" => "multiple_select",
						"title" => esc_html__("Set Custom Breaking News Slider Categories", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_breaking_slider",
						"taxonomy" => "category",
						"default" => array('slider_off', esc_html__("Off", THEME_NAME)),
						"std" => 'slider_off',
						"page_type" => array("page"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_page", "value" => "on")
						)
					),

					array(
						"type" => "close",
						"page_type" => array("page"),
						"protected" => array(
							array("dataType" => 'option', "id" => $different_themes_managment->themeslug."_breaking_news_page", "value" => "on")
						)
					),

					*/

					array(
						"type" => "row",
						"page_type" => array("post")
					),	
					array(
						"type" => "title",
						"title" => esc_html__("Post Subtitle", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "input",
						"title" => esc_html__("Subtitle:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_sub_title",
						"page_type" => array("post")
					),
					array(
						"type" => "close",
						"page_type" => array("post")
					),	
					array(
						"type" => "row",
						"page_type" => array("post"),
						"skip_templates" => array("homepage","contact","about","gallery-1"),
					),	
					
					array(
						"type" => "title",
						"title" => esc_html__("Show This Post In Breaking News Slider?", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "checkbox",
						"title" => esc_html__("Show:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_breaking_post",
						"page_type" => array("post")
					),	
				
					array(
						"type" => "title",
						"title" => esc_html__("Show This Post In Main Slider?", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "checkbox",
						"title" => esc_html__("Show:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_main_slider_post",
						"page_type" => array("post")
					),

									
					array(
						"type" => "close",
						"page_type" => array("post")
					),						
					array(
						"type" => "row",
						"page_type" => array("post")
					),	
					array(
						"type" => "title",
						"title" => esc_html__("Featured Image Credits", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "input",
						"title" => esc_html__("Credits:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_imageCredits",
						"page_type" => array("post")
					),
					array(
						"type" => "input",
						"title" => esc_html__("Credits Link:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_imageCreditLink",
						"page_type" => array("post")
					),	
					array(
						"type" => "close",
						"page_type" => array("post")
					),	

					array(
						"type" => "row",
						"page_type" => array("post")
					),	
					array(
						"type" => "title",
						"title" => esc_html__("Video Embed Code", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "textarea",
						"title" => esc_html__("Vimeo, Youtube Embed Code:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_video_code",
						"page_type" => array("post")
					),	
					array(
						"type" => "close",
						"page_type" => array("post")
					),	
					array(
						"type" => "row",
						"page_type" => array("post")
					),	
					array(
						"type" => "title",
						"title" => esc_html__("SoundCloud Embed Code", THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "textarea",
						"title" => esc_html__("SoundCloud Embed Code:",THEME_NAME),
						"id"=> '_'.$differentThemes_meta_fields->themeslug."_audio",
						"page_type" => array("post")
					),	
					array(
						"type" => "close",
						"page_type" => array("post")
					),	

					array(
						"type" => "row",
						"page_type" => array("post")
					),
					array(
						"type" => "title",
						"title" => esc_html__("Review Settings", THEME_NAME),
						"page_type" => array("post")
					),


					array(
						"type" => "textarea",
						"title" => esc_html__('Ratings', THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_ratings",
						"info" => esc_html__('Enter the ratings like this - Graphics:5; Gameplay:4,5; Sound:3; Storyline:4',THEME_NAME),
						"page_type" => array("post")
					),
					array(
						"type" => "textarea",
						"title" => esc_html__('Summary', THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_overall",
						"page_type" => array("post")
					),
					array(
						"type" => "close",
						"page_type" => array("post")
					),

					array(
						"type" => "row",
						"page_type" => array("contact")
					),
					array(
						"type" => "title",
						"title" => esc_html__("Contact Page Email", THEME_NAME),
						"page_type" => array("contact")
					),
					array(
						"type" => "input",
						"title" => esc_html__("Email:", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_contact_mail",
						"page_type" => array("contact")
					),

					array(
						"type" => "close",
						"page_type" => array("contact")
					),
					array(
						"type" => "row",
						"page_type" => array("contact")
					),
					array(
						"type" => "title",
						"title" => esc_html__("Contact Page Google Map", THEME_NAME),
						"page_type" => array("contact")
					),
					array(
						"type" => "textarea",
						"title" => esc_html__("Embed Code:", THEME_NAME),
						"id" => "_".$differentThemes_meta_fields->themeslug."_map",
						"page_type" => array("contact")
					),

					array(
						"type" => "close",
						"page_type" => array("contact")
					),

					array(
						"type" => "closesubtab",
						"hide_in"=> array("product"),//post/page type
						"page_type" => array("page","post"),
						/*"skip_templates"=> array('homepage', 'gallery-1')//page template*/
					),
					/* ------------------------------------------------------------------------*
					 * SIDEBAR SETTINGS
					 * ------------------------------------------------------------------------*/   
					array(
						"type" => "meta_sub_tab",
						"slug"=>'sidebar',
						"skip_templates"=> array('homepage'),
					),
					array(
						"type" => "row",
						"skip_templates"=> array('homepage'),
					),
					array(
						"type" => "title",
						"title" => esc_html__('Main Sidebar Side', THEME_NAME),
						"skip_templates"=> array('homepage'),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_sidebar_position",
						"radio" => array(
							array("title" => esc_html__("Right:", THEME_NAME), "value" => "right"),
							array("title" => esc_html__("Left:", THEME_NAME), "value" => "left")
						),
						"std" => 'right',
						"compare" => df_get_option(THEME_NAME.'_sidebar_position'),
						"skip_templates"=> array('homepage'),
					),
					array(
						"type" => "title",
						"title" => esc_html__('Main Sidebar Name', THEME_NAME),
						"skip_templates"=> array('homepage'),
					),
					array(
						"type" => "sidebar_select",
						"title" => esc_html__('Sidebar', THEME_NAME),
						"default" => array(
										array('', esc_html__('Default', THEME_NAME)),
										array('off', esc_html__('Off', THEME_NAME)),
									),
						"id" => "_".$different_themes_managment->themeslug."_sidebar_select",
						"skip_templates"=> array('homepage'),
					),

					array(
						"type" => "close",
						"skip_templates"=> array('homepage'),
					),
					/*
					array(
						"type" => "row"
					),
					array(
						"type" => "title",
						"title" => esc_html__('Second Sidebar Side', THEME_NAME),
					),
					array(
						"type" => "radio",
						"id" => "_".$differentThemes_meta_fields->themeslug."_sidebar_position_2",
						"radio" => array(
							array("title" => esc_html__("Right:", THEME_NAME), "value" => "right"),
							array("title" => esc_html__("Left:", THEME_NAME), "value" => "left")
						),
						"std" => 'right',
						"compare" => df_get_option(THEME_NAME.'_sidebar_position_2'),
					),
					array(
						"type" => "title",
						"title" => esc_html__('Second Sidebar Name', THEME_NAME),
					),
					array(
						"type" => "sidebar_select",
						"title" => esc_html__('Sidebar', THEME_NAME),
						"default" => array(
										array('off', esc_html__('Off', THEME_NAME)),
										array('default', esc_html__('Default', THEME_NAME)),

									),
						"id" => "_".$different_themes_managment->themeslug."_sidebar_select_2",
					),

					array(
						"type" => "close"
					),
					*/
					array(
						"type" => "closesubtab",
						"skip_templates"=> array('homepage'),
					),
		 			array(
						"type" => "close"
					)
				),
			),

		),
	)
);


$differentThemes_meta_fields->add_options($differentThemes_meta_options);


$different_themes_meta_options = $differentThemes_meta_fields->get_options();


function different_themes_meta_box() {
	$image = '<img src="'.esc_url(THEME_IMAGE_CPANEL_URL.'logo-differentthemes-2.png').'"  style="margin: 0px 0px -5px 0px;" /> ';
    $screens = array( 'post', 'page', DF_POST_GALLERY, DF_POST_PORTFOLIO, "product" );
    foreach ( $screens as $screen ) {
        add_meta_box('different-themes-custom-'.$screen.'-data', ''.$image.esc_html__('Post Custom Settings', THEME_NAME), 'different_themes_meta_content', $screen, 'normal', 'high');
    }

}


 

function different_themes_meta_content($post) { 
	global $differentThemes_meta_fields;
	print $differentThemes_meta_fields->print_options();
}


add_action( 'admin_menu', 'different_themes_meta_box' );

function save_meta_data($value) {
		global $post_id;
		
		$nonsavable_types = array(
			'navigation', 
			'tab',
			'sub_navigation',
			'meta_sub_navigation',
			'sub_tab',
			'meta_sub_tab',
			'homepage_set_test',
			'save',
			'closesubtab',
			'closetab',
			'row',
			'close'
		);

		if(isset($value['id'])) {
			$old = get_post_meta($post_id, $value['id'], true);
			if(isset($_REQUEST[$value['id']])) {
				$new = $_REQUEST[$value['id']];
			} else {
				$new = false;
			}
		}
		


		if(isset($value['id']) && isset($new) && !in_array($value['type'],$nonsavable_types)) {
			
			
			if($value['type']=="checkbox" && $new=="on" && $new!=$old){
				update_post_meta($post_id, $value['id'], $new);
			} elseif($value['type']=="checkbox" && $new!="on" && $new!=$old){
				update_post_meta($post_id, $value['id'], $new);
			}

			if($value['type']!="checkbox") {
				update_post_meta($post_id, $value['id'], $new);
				
			}

		}  elseif(!in_array($value['type'], $nonsavable_types) && isset($value['id'])){
			delete_post_meta($post_id, $value['id'], $old);
		}

		//set average rating for easier post sorting
		if(isset($value['id']) && $value['id']=="_".THEME_NAME."_ratings") {
			$average = df_avarage_rating($post_id);
			update_post_meta($post_id, $value['id']."_average", $average[1]);
		}
		
	}

	// Save data from meta box
	function save_sticky_data($post_id) {

		global $different_themes_meta_options;
		$nonsavable_types = array(
			'navigation', 
			'tab',
			'sub_navigation',
			'meta_sub_navigation',
			'sub_tab',
			'meta_sub_tab',
			'homepage_set_test',
			'save',
			'closesubtab',
			'closetab',
			'row',
			'close'
		);
		
		// verify nonce
		if (isset($_POST['sticky_meta_box_nonce']) && !wp_verify_nonce($_POST['sticky_meta_box_nonce'], "different-themes")) {
			die( esc_html_e('Security check', THEME_NAME) );
		} else {

			// check autosave
			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return $post_id;
			}

			// check permissions
			if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
				if (!current_user_can('edit_page', $post_id)) {
					return $post_id;
				}
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
			}

			//insert the default values if the fields are empty

			foreach ($different_themes_meta_options[0]['blocks'][0]['options'] as $block) {
				if( isset( $block['id'] ) && get_post_meta($post_id,$block['id'],true)=='' && isset($block['std']) && !in_array($block['type'], $nonsavable_types)){
					update_post_meta($post_id, $block['id'], $block['std']);
				} else {
					save_meta_data($block);
					
				}
			}



		}
	}

	add_action('save_post', 'save_sticky_data');




$prefix = THEME_NAME.'_';
$image = '<img src="'.esc_url(THEME_IMAGE_CPANEL_URL.'logo-differentthemes-2.png').'" style="margin: 0px 0px -5px 0px;"/> ';

$homeID = df_get_page('homepage');




if(isset($_GET['post'])) {
	$currentID = $_GET['post'];
} else {
	$currentID = 0;
}

global $box_array;

$box_array = array();

$box_array[] = array('id' => 'post-0','title' => ''.$image.esc_html__("Main Slider Image", THEME_NAME),'page' => 'post', 'context' => 'side','priority' => 'low','fields' => array(array('name' => esc_html__("Image:", THEME_NAME),'std' => '','id' => $prefix. 'homepage_image','type'=> 'slider_image_box')),'size' => 10,'first' => 'yes');


//gallery images
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.esc_html__("Gallery Images", THEME_NAME), 'page' => DF_POST_GALLERY, 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => "", 'std' => '', 'id' => $prefix. 'gallery_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.esc_html__("Gallery Images", THEME_NAME), 'page' => 'post', 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => "", 'std' => '', 'id' => $prefix. 'gallery_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );


//portfolio images
$box_array[] = array( 'id' => 'post-slider-images', 'title' => ''.$image.esc_html__("Portfolio Images", THEME_NAME), 'page' => DF_POST_PORTFOLIO, 'context' => 'side', 'priority' => 'low', 'fields' => array(array('name' => "", 'std' => '', 'id' => $prefix. 'portfolio_images', 'type'=> 'image_select' ) ), 'size' => 0,'first' => 'no'  );


//homepage 
if(in_array($currentID, $homeID) || isset($_POST['post_type'])) {

	$box_array[] = array( 
		'id' => 'home-drag-drop', 
		'title' => ''.$image.esc_html__("Homepage Builder", THEME_NAME), 
		'page' => 'page', 
		'context' => 'normal', 
		'priority' => 'high', 
		'fields' => array(
			array(
				'name' => '', 
				'std' => '', 'id' => $prefix. 'home_drag_drop', 
				'type'=> 'home_drag_drop' 
				) 
			), 
		'size' => 0,
		'first' => 'no'  
	);
}

// Add meta box
function add_sticky_box() {
	global $box_array;
	
	foreach ($box_array as $box) {
		add_meta_box($box['id'], $box['title'], 'sticky_show_box', $box['page'], $box['context'], $box['priority'], array('content'=>$box, 'first'=>$box['first'], 'size'=>$box['size']));
	}

}

function sticky_show_box( $post, $metabox) {
	show_box_funtion($metabox['args']['content'], $metabox['args']['first'], $metabox['args']['size']);
}

// Callback function to show fields in meta box
function show_box_funtion($fields, $first='no', $width='60') {
	global $post, $post_id;



	foreach ($fields['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		echo '<label for="', $field['id'], '">', $field['name'], '</label>';
	
		switch ($field['type']) {
			case 'slider_image_box':
				echo '<input class="upload input-text-1 df-upload-field" type="text" name="', esc_attr__($field['id']), '" id="', esc_attr__($field['id']), '" value="',  $meta ? esc_attr__(df_remove_html_slashes($meta)) :  esc_attr__(df_remove_html_slashes($field['std'])), '" style="width: 140px;"/><a href="#" class="df-upload-button">Button</a>';
				break;
			case 'image_select':
				df_gallery_image_select($field['id'],$meta);
				break;
			case 'home_drag_drop':
				global $differentThemes_fields;
				$differentThemes_fields = new DifferentThemesManagment(THEME_FULL_NAME,THEME_NAME);
			
				get_template_part(THEME_FUNCTIONS."drag-drop");
				$options = $differentThemes_fields->get_options();

				echo '
					<div style="vertical-align:top;clear: both;">
						'.$differentThemes_fields->print_options().'
					</div>';
				break;
		}

	}

}

function save_data($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}//else if closer
		}
	}//foreach closer
	
}

function save_datepicker($fields) {
	global $post_id;

	foreach ($fields['fields'] as $field) {	
		$old = get_post_meta($post_id, $field['id'], true);
		if(isset($_POST[$field['id']])) {
			$new = $_POST[$field['id']];
			
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], strtotime($new));
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], strtotime($old));
			}//else if closer
		}
	}//foreach closer
	
}

function save_numbers($fields) { 
	global $post_id;
	foreach ($fields['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if(!is_numeric($new)) { 
			$new = preg_replace("/[^0-9]/","",$new);
		}
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}//else if closer
	}//foreach closer

}
// Save data from meta box
function save_meta_sticky_data($post_id) {
	global $box_array;

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($box_array as $box) {
		save_data($box);
	}

} //function closer
	add_action('admin_menu', 'add_sticky_box');	
	add_action('save_post', 'save_meta_sticky_data');

	
?>
