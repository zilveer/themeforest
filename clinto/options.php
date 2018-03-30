<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace( "/\W/", "_", strtolower( $themename ) );

	$optionsframework_settings       = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
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
	$options_categories_obj = get_categories();
	$options_categories[] = 'Select a category';
	foreach ($options_categories_obj as $category) {
		//$options_categories[$category->cat_ID] = $category->cat_name;
		$options_categories[$category->slug] = $category->cat_name;
	}
	
	// Pull all the event categories into an array
	$options_event_categories = array();
	$options_event_categories_obj = get_categories(array('taxonomy'=>'event-category'));
	$options_event_categories[] = 'Select an event category';
	foreach ($options_event_categories_obj as $category) {
		//print_r($category);
		$options_event_categories[$category->cat_ID] = $category->cat_name;
		//$options_event_categories[$category->slug] = $category->cat_name.$category->cat_ID;
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

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/option-framework';

	$options = array();

	$options[] = array(
		'name' => __('Home', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Favicon', 'options_check'),
		'desc' => __('Upload a 16x16 favicon image (.ico, .png or .gif).', 'options_check'),
		'id' => 'favicon_img',
		'std' => get_template_directory_uri() .'/favicon.ico',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Slideshow', 'options_framework_theme'),
		'desc' => __('<img src="'.$imagepath.'/home-slides.png" />', 'options_framework_theme'),
		'type' => 'info');		

	$options[] = array(
		'name' => __('Select a slides category', 'options_check'),
		'desc' => __('Choose the category to show in the home slides show', 'options_check'),
		'id' => 'home_slides_category',
		'type' => 'select',
		'options' => $options_categories);
		
		
	$options[] = array(
		'name' => __('Event options', 'options_framework_theme'),
		'desc' => __('<img src="'.$imagepath.'/home-events.png" />', 'options_framework_theme'),
		'type' => 'info');		

	$options[] = array(
		'name' => __('A. Select an event category to slide', 'options_check'),
		'desc' => __('Choose the event category to show in the box slides', 'options_check'),
		'id' => 'event_highlight_category',
		'type' => 'select',
		'options' => $options_event_categories);

	$options[] = array(
		'name' => __('B. Event Tab 1', 'options_check'),
		'desc' => __('Choose the event category to show in the tab pane', 'options_check'),
		'id' => 'event_tab1_category',
		'type' => 'select',
		'options' => $options_event_categories);

	$options[] = array(
		'name' => __('C. Event Tab 2', 'options_check'),
		'desc' => __('Choose the event category to show in the tab pane', 'options_check'),
		'id' => 'event_tab2_category',
		'type' => 'select',
		'options' => $options_event_categories);
		
	$options[] = array(
		'name' => __('D. Citation', 'options_framework_theme'),
		'desc' => __('Write a sentence', 'options_framework_theme'),
		'id' => 'citation',
		'std' => 'Style is what separates the good from the great.',
		'type' => 'text');		
		
	$options[] = array(
		'name' => __('E. Citation Author', 'options_framework_theme'),
		'desc' => __('Write the citation author', 'options_framework_theme'),
		'id' => 'citation_author',
		'std' => 'Bozhidar Batsov',
		'type' => 'text');
						
	$options[] = array(
		'name' => __('Blog', 'options_check'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Blog archive header', 'options_check'),
		'desc' => __('It will shown in the blog archive header', 'options_check'),
		'id' => 'blog_header_image',
		'std' => get_template_directory_uri() . '/img/blog-header.jpg',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Author Box?', 'options_check'),
		'desc' => __('Do you want the author box below the posts?', 'options_check'),
		'id' => 'author_box',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Events', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Event Organizer Box?', 'options_check'),
		'desc' => __('Do you want the event organizer box below the event description?', 'options_check'),
		'id' => 'author_event_box',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Social Settings', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Facebook Fan Page', 'options_check'),
		'desc' => __('The URL of your Facebook fan page', 'options_check'),
		'id' => 'facebook_url',
		'std' => 'http://www.facebook.com/dynamick.it',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter Page', 'options_check'),
		'desc' => __('The url of your Twitter page.', 'options_check'),
		'id' => 'twitter_url',
		'std' => 'https://twitter.com/dynamick',
		'type' => 'text');

		$options[] = array(
		'name' => __('Feed URL', 'options_check'),
		'desc' => __('Leave blank for the default wordpress url', 'options_check'),
		'id' => 'feed_url',
		'std' => '/feed',
		'type' => 'text');

	$options[] = array(
		'name' => __('Mailchimp signup form link url', 'options_check'),
		'desc' => __('The url of your mailchimp signup form. You could specify any other newsletter signup url.', 'options_check'),
		'id' => 'mailchimp_link_url',
		'std' => 'http://eepurl.com/sgukr',
		'type' => 'text');

	$options[] = array(
		'name' => __('External API', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Google Analytics Account ID', 'options_check'),
		'desc' => __('Paste here your UA-XXXXXXXX-X code', 'options_check'),
		'id' => 'analytics_uid',
		'std' => 'UA-795127-3',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Facebook App ID', 'options_check'),
		'desc' => __('Paste here your Facebook app id', 'options_check'),
		'id' => 'facebook_app_id',
		'std' => '235354229916474',
		'type' => 'text');

	return $options;
}