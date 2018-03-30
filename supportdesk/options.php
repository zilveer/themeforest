<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => get_template_directory_uri() . '/images/bg.gif',
		'repeat' => 'repeat',
		'position' => 'center center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories( array( 'hide_empty' => 0, ) );
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);
	
	$wp_editor_small = array(
		'wpautop' => true, // Default
		'textarea_rows' => 2,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/framework/images/';
		
	$options = array();
	
	$options[] = array( "name" => __("Homepage Options", "framework"),
						"type" => "heading");
						
						
	$options[] = array(
						'name' => __('Headline', 'framework'),
						'desc' => __('The big text that appears on the homepage', 'framework'),
						'id' => 'st_hp_headline',
						'std' => 'A Responsive Helpdesk Theme For WordPress',
						'type' => 'text');
						
	$options[] = array(
						'name' => __('Tagline', 'framework'),
						'desc' => __( 'The second line of text that appears below the headline on the homepage.', 'framework' ),
						'id' => 'st_hp_tagline',
						'std' => 'Now you can have your own support center without paying monthly fees.',
						'type' => 'editor',
						'settings' => $wp_editor_settings );
						
	$options[] = array(
						'name' => __('Show Search?', 'framework'),
						'desc' => __('Check to show the search on the homepage.', 'framework'),
						'id' => 'st_hp_search',
						'std' => '1',
						'type' => 'checkbox');	
						
	$options[] = array(
						'name' => __('Homepage Blocks', 'framework'),
						'desc' => '',
						'type' => 'info');
						
	$options[] = array( "name" => __("Homepage Blocks Layout", "framework"),
						"desc" => __("Select the layout of homepage blocks.", "framework"),
						"id" => "st_hpblock",
						"std" => "3col",
						"type" => "images",
						"options" => array(
						"2col" => $imagepath . "2col.png",
						"3col" => $imagepath . "3col.png",
						"4col" => $imagepath . "4col.png")
						);
						
						
	$options[] = array( "name" => __("Homepage Sidebar Position", "framework"),
						"desc" => __("Select the sidebar position for Knowledge Base pages.", "framework"),
						"id" => "st_hp_sidebar",
						"std" => "right",
						"type" => "images",
						"options" => array(
						"left" => $imagepath . "sidebar-left.png",
						"right" => $imagepath . "sidebar-right.png",
						"off" => $imagepath . "sidebar-off.png")
						);
						
						

	$options[] = array( "name" => __("Blog Options", "framework"),
						"type" => "heading");
						
	$options[] = array(
						'name' => __('Blog Meta', 'framework'),
						'desc' => __('Select which meta information to show with Blog posts.', 'framework'),
						'id' => 'st_blog_meta',
						'std' => array(
									'date' => '1',
									'author' => '1',
									'category' => '1',
									'comments' => '1'), // On my default
						'type' => 'multicheck',
						'options' => array(
										'date' => __('Date', 'framework'),
										'author' => __('Author', 'framework'),
										'category' => __('Category', 'framework'),
										'comments' => __('Comments', 'framework')),
						);
						
	
			
	$options[] = array(
						'name' => __('Show Author Box?', 'framework'),
						'desc' => __('Check to show an author box at the end of blog posts. (Note: The author must have a bio for the box to show).', 'framework'),
						'id' => 'st_single_authorbox',
						'std' => '1',
						'type' => 'checkbox');
	
	
	$options[] = array( "name" => __("Knowledgebase Options", "framework"),
						"type" => "heading");
						
	$options[] = array(	'name' => __('Knowledgebase Slug', 'framework'),
						'desc' => __('Enter the slug for your Knowledgebase articles. (Important: Set and resave your permalinks when you change this option).', 'framework'),
						'id' => 'st_kb_slug',
						'std' => 'knowledgebase',
						'class' => 'mini',
						'type' => 'text');
						
						
	$options[] = array(	'name' => __('Number of articles displayed below category', 'framework'),
						'desc' => __('The number of articles to show below each category.', 'framework'),
						'id' => 'st_kb_category_articles',
						'std' => '5',
						'class' => 'mini',
						'type' => 'text');
						
	$options[] = array(	'name' => __('Articles per page', 'framework'),
						'desc' => __('The number of articles to show', 'framework'),
						'id' => 'st_kb_articles_per_page',
						'std' => '8',
						'class' => 'mini',
						'type' => 'text');
						
	$options[] = array( "name" => __("Sidebar Position", "framework"),
						"desc" => __("Select the sidebar position for Knowledge Base pages.", "framework"),
						"id" => "st_kb_sidebar",
						"std" => "right",
						"type" => "images",
						"options" => array(
						"left" => $imagepath . "sidebar-left.png",
						"right" => $imagepath . "sidebar-right.png",
						"off" => $imagepath . "sidebar-off.png")
						);
						
	$options[] = array(
						'name' => __('Show Sidebar', 'framework'),
						'desc' => __('Select which Knowledge Base areas the should show the KB sidebar.', 'framework'),
						'id' => 'st_kb_sidebar_location',
						'std' => array(
									'index' => '0',
									'category' => '1',
									'single' => '1',
									'search' => '1'),
						'type' => 'multicheck',
						'options' => array(
										'index' => __('KB Index', 'framework'),
										'category' => __('KB Categories', 'framework'),
										'single' => __('KB Articles', 'framework'),
										'search' => __('KB Search Results', 'framework')
										),
						);
													
	$options[] = array(
						'name' => __('Article Meta', 'framework'),
						'desc' => __('Select which meta information to show with Knowledge Base Article.', 'framework'),
						'id' => 'st_kb_meta',
						'std' => array(
									'date' => '1',
									'author' => '1',
									'comments' => '1'), // On my default
						'type' => 'multicheck',
						'options' => array(
										'date' => __('Date', 'framework'),
										'author' => __('Author', 'framework'),
										'comments' => __('Comments', 'framework')),
						);
						
	$options[] = array( "name" => __("Forum Options", "framework"),
						"type" => "heading");
						
	$options[] = array(
						'name' => __('Forum Title', 'framework'),
						'desc' => __('The title of your forum.', 'framework'),
						'id' => 'st_forum_title',
						'std' => 'Community Forum',
						'type' => 'text');
						
						
	$options[] = array( "name" => __("Sidebar Position", "framework"),
						"desc" => __("Select the sidebar position for Knowledge Base pages.", "framework"),
						"id" => "st_forum_sidebar",
						"std" => "right",
						"type" => "images",
						"options" => array(
						"left" => $imagepath . "sidebar-left.png",
						"right" => $imagepath . "sidebar-right.png",
						"off" => $imagepath . "sidebar-off.png")
						);					
						

	$options[] = array( "name" => __("Advanced Options", "framework"),
						"type" => "heading");
						

	$options[] = array(	'name' => __('Disable Live Search', 'framework'),
						'desc' => __('Globally disable live search. Applies to Knowledge Base & Forums', 'framework'),
						'id' => 'st_live_search',
						'std' => '0',
						'type' => 'checkbox');
												
	$options[] = array( "name" => __("Custom CSS", "framework"),
						"desc" => __("Add some CSS to your theme by adding it to this block.", "framework"),
						"id" => "st_custom_css",
						"std" => "",
						"type" => "textarea");	

	return $options;
}



