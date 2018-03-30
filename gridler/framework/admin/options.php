<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
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
	
	// Get Cufon fonts into a drop-down list
$cufonts = array();
if(is_dir(TEMPLATEPATH . "/js/fonts/")) {
	if($open_dirs = opendir(TEMPLATEPATH . "/js/fonts")) {
		while(($cufontfonts = readdir($open_dirs)) !== false) {
			if(stristr($cufontfonts, ".js") !== false) {
				$cufonts[] = $cufontfonts;
			}
		}
	}
}
$cufonts_dropdown = $cufonts;
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();
								
	//General Settings Start					
	$options[] = array( "name" => __('General Settings','framework'),
						"type" => "heading");	
						
	$options[] = array( "name" => "",
						"desc" => __("Control and configure the general setup of your theme. Upload your logo, setup your feeds and insert your analytics tracking code.", 'framework'),
						"type" => "info");					
						
	$options[] = array( "name" => __('Custom Logo','framework'),
						"desc" => __("Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)", 'framework'),
						"id" => "logo",
						"type" => "upload");
						
	$options[] = array( "name" => __('Logo Height','framework'),
						"desc" => __('Enter the height of your logo image.','framework'),
						"id" => "logo_height",
						"class" => "small",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Logo Width','framework'),
						"desc" => __('Enter the width of your logo image.','framework'),
						"id" => "logo_width",
						"class" => "small",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Logo Alt Text','framework'),
						"desc" => __('Enter the alt text for the logo.','framework'),
						"id" => "logo_alt",
						"class" => "small",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Logo Title Text','framework'),
						"desc" => __('Enter the title text for the logo.','framework'),
						"id" => "logo_title",
						"class" => "small",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Custom Favicon','framework'),
						"desc" => __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.", 'framework'),
						"id" => "favicon",
						"type" => "upload");
						
	$options[] = array( "name" => __('FeedBurner URL','framework'),
						"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
						"id" => "feedburner",
						"std" => "",
						"type" => "text");					
						
	$options[] = array( "name" => __("Website Tagline", 'framework'),
						"desc" => __("The tagline is displayed beside the logo.", 'framework'),
						"id" => "tagline",
						"std" => "A beautiful portfolio",
						"class" => "small",
						"type" => "text");	
							
	$options[] = array( "name" => __("Disabled Tagline", 'framework'),
						"desc" => __("Check this option if you want to hide the tagline.", 'framework'),
						"id" => "tagline_visible",
						"std" => "0",
						"type" => "checkbox");									
											
	$options[] = array( "name" => __("Analytics Code", 'framework'),
						"desc" => __("Paste your Google Analytics (or other) tracking code here. This will be added into the footer of the theme.", 'framework'),
						"id" => "analytics_code",
						"std" => "",
						"type" => "textarea"); 
							
	$options[] = array( "name" => __("Footer Text", 'framework'),
						"desc" => __("Enter your site copyright information here.", 'framework'),
						"id" => "footer_text",
						"std" => "&copy; Copyright 2011 Gridler. Powered by <a href=\"http://wordpress.org/\">WordPress</a>. Theme by <a href=\"http://swishthemes.com\">Swish Themes</a>",
						"type" => "textarea"); 
						
						
	$options[] = array( "name" => __("Disabled Form Builder?", 'framework'),
						"desc" => __("Check this option if you want to disable the form builder (useful for some contact form plugin conflicts).", 'framework'),
						"id" => "form_builder",
						"std" => "0",
						"type" => "checkbox");						
													
	//General Settings End	
	
	//Styling Options Start							
	$options[] = array( "name" => __("Styling Options", 'framework'),
						"type" => "heading");
						
	$options[] = array( "name" => "",
						"desc" => __("Tweak the visual look of the theme with these handy options.", 'framework'),
						"type" => "info");	
						
	$options[] = array( "name" => __("Link Color", 'framework'),
						"desc" => __("Select the default link color. (Default #3397CB)", 'framework'),
						"id" => "link_color",
						"std" => "#26373F",
						"type" => "color");
						
	$options[] = array( "name" => __("Link Color (Hover)", 'framework'),
						"desc" => __("Select the default link hover color. (Default #3397CB)", 'framework'),
						"id" => "link_color_hover",
						"std" => "#26373F",
						"type" => "color");
						
										
	$options[] = array( "name" => __("Background Pattern", 'framework'),
						"desc" => __("Select the pattern that will overlay the background color.", 'framework'),
						"id" => "bg_pattern",
						"std" => "pattern45",
						"type" => "images",
						"options" => array(
							'pattern01' => $imagepath . 'bg/patterns/admin/pattern01.png',
							'pattern02' => $imagepath . 'bg/patterns/admin/pattern02.png',
							'pattern03' => $imagepath . 'bg/patterns/admin/pattern03.png',
							'pattern04' => $imagepath . 'bg/patterns/admin/pattern04.png',
							'pattern05' => $imagepath . 'bg/patterns/admin/pattern05.png',
							'pattern06' => $imagepath . 'bg/patterns/admin/pattern06.png',
							'pattern07' => $imagepath . 'bg/patterns/admin/pattern07.png',
							'pattern08' => $imagepath . 'bg/patterns/admin/pattern08.png',
							'pattern09' => $imagepath . 'bg/patterns/admin/pattern09.png',
							'pattern10' => $imagepath . 'bg/patterns/admin/pattern10.png',
							'pattern11' => $imagepath . 'bg/patterns/admin/pattern11.png',
							'pattern12' => $imagepath . 'bg/patterns/admin/pattern12.png',
							'pattern13' => $imagepath . 'bg/patterns/admin/pattern13.png',
							'pattern14' => $imagepath . 'bg/patterns/admin/pattern14.png',
							'pattern15' => $imagepath . 'bg/patterns/admin/pattern15.png',
							'pattern16' => $imagepath . 'bg/patterns/admin/pattern16.png',
							'pattern17' => $imagepath . 'bg/patterns/admin/pattern17.png',
							'pattern18' => $imagepath . 'bg/patterns/admin/pattern18.png',
							'pattern19' => $imagepath . 'bg/patterns/admin/pattern19.png',
							'pattern20' => $imagepath . 'bg/patterns/admin/pattern20.png',
							'pattern21' => $imagepath . 'bg/patterns/admin/pattern21.png',
							'pattern22' => $imagepath . 'bg/patterns/admin/pattern22.png',
							'pattern23' => $imagepath . 'bg/patterns/admin/pattern23.png',
							'pattern24' => $imagepath . 'bg/patterns/admin/pattern24.png',
							'pattern25' => $imagepath . 'bg/patterns/admin/pattern25.png',
							'pattern26' => $imagepath . 'bg/patterns/admin/pattern26.png',
							'pattern27' => $imagepath . 'bg/patterns/admin/pattern27.png',
							'pattern28' => $imagepath . 'bg/patterns/admin/pattern28.png',
							'pattern29' => $imagepath . 'bg/patterns/admin/pattern29.png',
							'pattern30' => $imagepath . 'bg/patterns/admin/pattern30.png',
							'pattern31' => $imagepath . 'bg/patterns/admin/pattern31.png',
							'pattern32' => $imagepath . 'bg/patterns/admin/pattern32.png',
							'pattern33' => $imagepath . 'bg/patterns/admin/pattern33.png',
							'pattern34' => $imagepath . 'bg/patterns/admin/pattern34.png',
							'pattern35' => $imagepath . 'bg/patterns/admin/pattern35.png',
							'pattern36' => $imagepath . 'bg/patterns/admin/pattern36.png',
							'pattern37' => $imagepath . 'bg/patterns/admin/pattern37.png',
							'pattern38' => $imagepath . 'bg/patterns/admin/pattern38.png',
							'pattern39' => $imagepath . 'bg/patterns/admin/pattern39.png',
							'pattern40' => $imagepath . 'bg/patterns/admin/pattern40.png',
							'pattern41' => $imagepath . 'bg/patterns/admin/pattern41.png',
							'pattern42' => $imagepath . 'bg/patterns/admin/pattern42.png',
							'pattern43' => $imagepath . 'bg/patterns/admin/pattern43.png',
							'pattern44' => $imagepath . 'bg/patterns/admin/pattern44.png',
							'pattern45' => $imagepath . 'bg/patterns/admin/pattern45.png')
						);
	
						
						
	$options[] = array( "name" => __("Google Fonts", 'framework'),
						"desc" => __("This theme utilizes the Google font library to intergrate great looking cross browser fonts. Browse fonts here: http://www.google.com/webfonts and just add the font link and CSS below.", 'framework'),
						"type" => "info");
					
	$options[] = array( "name" => __("Disabled Custom Fonts", 'framework'),
						"desc" => __("Check this option if you want to disable custom font feature.", 'framework'),
						"id" => "google_font",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Google Font HTML", 'framework'),
						"desc" => __("Default: <code>http://fonts.googleapis.com/css?family=Droid+Sans:700</code>", 'framework'),
						"id" => "google_font_html",
						"std" => "http://fonts.googleapis.com/css?family=Droid+Sans:400,700",
						"type" => "text",);		
						
	$options[] = array( "name" => __("Google Font CSS", 'framework'),
						"desc" => __("Default: <code>'Droid Sans', sans-serif</code>", 'framework'),
						"id" => "google_font_css",
						"std" => "'Droid Sans', sans-serif;",
						"type" => "text",);						
	
	$options[] = array( "name" => __("Custom CSS", 'framework'),
						"desc" => __("Enter any custom CSS here.", 'framework'),
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea"); 
						
	//Styling Options End
	
	
	
	//Portfolio Options Start
	$options[] = array( "name" => __("Blog &amp; Portfolio", 'framework'),
						"type" => "heading");
						
	$options[] = array( "name" => __("Enable Blog Lightbox", 'framework'),
					"desc" => __("Check this to enable the lightbox effect. If disabled, the images will link to their respective blog items.", 'framework'),
					"id" => "lightbox_blog",
					"std" => "1",
					"type" => "checkbox");		
					
	$options[] = array( "name" => __("Enable Portfolio Lightbox", 'framework'),
					"desc" => __("Check this to enable the lightbox effect. If disabled, the images will link to their respective portfolio items.", 'framework'),
					"id" => "lightbox",
					"std" => "1",
					"type" => "checkbox");	
					
	$options[] = array( "name" => __("Portfolio Order", 'framework'),
					"desc" => __("Select how you would like to order the items in your portfolo.", 'framework'),
					"id" => "portfolio_order",
					"std" => "date",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => array(
							'date' => 'Date',
							'title' => 'Title',
							'rand' => 'Random',
							'menu_order' => 'Order Attribute')
						);	
					
					
			
											
	//Portfolio Options End

								
	return $options;
}