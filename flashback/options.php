<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	/* This gets the theme name from the stylesheet (lowercase and without spaces)
    $themename = get_option( 'stylesheet' );
    $themename = $themename['Name'];
    $themename = preg_replace("/\W/", "", strtolower($themename));*/
    
    $themename = "flashback"; // DO NOT EDIT THIS LINE! :)

    $optionsframework_settings = get_option('optionsframework');
    $optionsframework_settings['id'] = $themename;
    update_option('optionsframework', $optionsframework_settings);

    // echo $themename;

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();
	
	
	
	/******* General *******/
	
	$options[] = array( "name" => "General",
						"type" => "heading");

	// logo image (regular)
	$options[] = array( "name" => "Logo Image (Regular)",
						"desc" => "",
						"id" => "logo_reg",
						"std" => get_stylesheet_directory_uri()."/images/logo.png",
						"type" => "upload");
						
	// logo width
	$options[] = array( "name" => "Logo Width",
						"desc" => "Width of regular size logo image",
						"id" => "logo_width",
						"std" => "170",
						"type" => "text");
						
	// logo height
	$options[] = array( "name" => "Logo Height",
						"desc" => "Height of regular size logo image",
						"id" => "logo_height",
						"std" => "36",
						"type" => "text");
						
	// logo image (retina)
	$options[] = array( "name" => "Logo Image (Retina)",
						"desc" => "",
						"id" => "logo_ret",
						"std" => get_stylesheet_directory_uri()."/images/logo_retina.png",
						"type" => "upload");
						
	// plain text logo
	$options[] = array( "name" => "Plain Text Logo",
						"desc" => "This will display the name of the blog instead of an image.",
						"id" => "plain_text",
						"std" => "0",
						"type" => "checkbox");
						
	// show widgets
	$options[] = array( "name" => "Show Widgets",
						"desc" => 'If checked, all the widgets you add under "Appearance > Widgets" will show up underneath the navigation.',
						"id" => "show_widgets",
						"std" => "1",
						"type" => "checkbox");
						
	// body font
	$body_fonts = array("serif" => "Droid Serif","sans" => "Droid Sans","opensans" => "Open Sans");
	
	$options[] = array( "name" => "Body Font",
						"desc" => "Main font throughout the theme (default Droid Serif)",
						"id" => "style_body_font",
						"std" => "opensans",
						"type" => "select",
						"class" => "mini",
						"options" => $body_fonts);
						
	// heading font
	$heading_fonts = array("montserrat" => "Montserrat","francois" => "Francois One","voltaire" => "Voltaire");
	
	$options[] = array( "name" => "Heading Font",
						"desc" => "Font for the main headings (default Montserrat)",
						"id" => "style_heading_font",
						"std" => "montserrat",
						"type" => "select",
						"class" => "mini",
						"options" => $heading_fonts);
						
	// custom styles (css)
	$options[] = array( "name" => "Custom Styles (CSS)",
						"desc" => "",
						"id" => "custom_styles",
						"std" => "",
						"type" => "textarea");
						
	// footer copyright					
	$options[] = array( "name" => "Footer Copyright",
						"desc" => "",
						"id" => "footer_copy",
						"std" => "All rights reserved. Powered by WordPress.",
						"type" => "text");
						
						
						
	/******* Background *******/
	
	$options[] = array( "name" => "Background",
						"type" => "heading");
	
	// background image 1
	$options[] = array( "name" => "Background Image 1",
						"desc" => "",
						"id" => "back1",
						"std" => "",
						"type" => "upload");
						
	// background image 2
	$options[] = array( "name" => "Background Image 2",
						"desc" => "",
						"id" => "back2",
						"std" => "",
						"type" => "upload");
						
	// background image 3
	$options[] = array( "name" => "Background Image 3",
						"desc" => "",
						"id" => "back3",
						"std" => "",
						"type" => "upload");
						
	// background image 4
	$options[] = array( "name" => "Background Image 4",
						"desc" => "",
						"id" => "back4",
						"std" => "",
						"type" => "upload");
						
	// background image 5
	$options[] = array( "name" => "Background Image 5",
						"desc" => "",
						"id" => "back5",
						"std" => "",
						"type" => "upload");
						
	// 404 error image
	$options[] = array( "name" => "404 Error Background",
						"desc" => "",
						"id" => "error_back",
						"std" => "",
						"type" => "upload");
						
	// image duration				
	$options[] = array( "name" => "Image Duration",
						"desc" => "",
						"id" => "duration",
						"std" => "5000",
						"type" => "text");
						
	// fade speed			
	$options[] = array( "name" => "Fade Speed",
						"desc" => "",
						"id" => "fade",
						"std" => "1000",
						"type" => "text");
						
						
						
	/******* Portfolio *******/
	
	$options[] = array( "name" => "Portfolio",
						"type" => "heading");
						
	// title				
	$options[] = array( "name" => "Title",
						"desc" => "",
						"id" => "portfolio_title",
						"std" => "A Jaw-Dropping Portfolio Theme.",
						"type" => "text");
						
	// subtitle				
	$options[] = array( "name" => "Subtitle",
						"desc" => "",
						"id" => "portfolio_subtitle",
						"std" => "Packed With Powerful Features &amp; Options",
						"type" => "text");
						
	// project shape
	$portfolio_shape = array("rounded" => "Rounded Edges","circle" => "Circle","square" => "Square");
	
	$options[] = array( "name" => "Project Shape",
						"desc" => "Shape for projects on portfolio summary page",
						"id" => "portfolio_shape",
						"std" => "rounded",
						"type" => "select",
						"class" => "mini",
						"options" => $portfolio_shape);
						
	// item count			
	$options[] = array( "name" => "Portfolio Projects Count ",
						"desc" => "Projects to display on portfolio page.",
						"id" => "portfolio_count",
						"std" => "9",
						"type" => "text");
						
						
						
	/******* Blog *******/
	
	$options[] = array( "name" => "Blog",
						"type" => "heading");
						
	// background image
	$options[] = array( "name" => "Background Image",
						"desc" => "",
						"id" => "blog_bg",
						"std" => "",
						"type" => "upload");
						
						
	
	/******* Contact *******/

	$options[] = array( "name" => "Contact",
						"type" => "heading");
						
	// email				
	$options[] = array( "name" => "Email",
						"desc" => "Email address for the contact form.  Uses admin email by default.",
						"id" => "contact_email",
						"std" => "me@johndoe.com",
						"type" => "text");
						
	// show map
	$options[] = array( "name" => "Show Map",
						"desc" => 'If checked, contact page template will show map.',
						"id" => "show_map",
						"std" => "1",
						"type" => "checkbox");
						
	// latitude				
	$options[] = array( "name" => "Map Latitude",
						"desc" => "",
						"id" => "contact_map_lat",
						"std" => "42.672421",
						"type" => "text");
						
	// longitude			
	$options[] = array( "name" => "Map Longitude",
						"desc" => "",
						"id" => "contact_map_lon",
						"std" => "21.16453899999999",
						"type" => "text");
						
	// twitter username				
	$options[] = array( "name" => "Twitter Username",
						"desc" => "",
						"id" => "social_twitter",
						"std" => "envato",
						"type" => "text");
						
	// facebook id				
	$options[] = array( "name" => "Facebook ID",
						"desc" => "",
						"id" => "social_facebook",
						"std" => "envato",
						"type" => "text");
		
	return $options;
}