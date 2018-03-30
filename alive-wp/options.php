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
	
	$slider_transition_array = array("0" => "None","1" => "Fade","2" => "Slide Top","3" => "Slide Right","4" => "Slide Bottom","5" => "Slide Left","6" => "Carousel Right","7" => "Carousel Left");
	
	$easing_array = array("linear" => "Linear","swing" => "Swing","easeInQuad" => "Ease In Quad","easeOutQuad" => "Ease Out Quad","easeInCubic" => "Ease In Cubic","easeOutCubic" => "Ease Out Cubic","easeInOutCubic" => "Ease In Out Cubic","easeInQuart" => "Ease In Quart","easeOutQuart" => "Ease Out Quart","easeInOutQuart" => "Ease In Out Quart","easeInQuint" => "Ease In Quint","easeOutQuint" => "Ease Out Quint","easeInOutQuint" => "Ease In Out Quint","easeInSine" => "Ease In Sine","easeOutSine" => "Ease Out Sine","easeInOutSine" => "Ease In Out Sine","easeInExpo" => "Ease In Expo","easeOutExpo" => "Ease Out Expo","easeInOutExpo" => "Ease In Out Expo","easeInCirc" => "Ease In Circ","easeOutCirc" => "Ease Out Circ","easeInOutCirc" => "Ease In Out Circ","easeInElastic" => "Ease In Elastic","easeOutElastic" => "Ease Out Elastic","easeInOutElastic" => "Ease In Out Elastic","easeInBack" => "Ease In Back","easeOutBack" => "Ease Out Back","easeInOutBack" => "Ease In Out Back","easeInBounce" => "Ease In Bounce","easeOutBounce" => "Ease Out Bounce","easeInOutBounce" => "Ease In Out Bounce");
	
	$skin_array = array("light" => __("Light", "alive"), "dark" => __("Dark", "alive"));
	
	$color_array = array("teal" => __("Teal", "alive"), "navy" => __("Navy", "alive"), "red" => __("Red", "alive"), "magenta" => __("Magenta", "alive"), "orange" => __("Orange", "alive"), "yellow" => __("Yellow", "alive"), "green" => __("Green", "alive"),"black" => __("Black", "alive"),"white" => __("White", "alive"));
	
	// Multicheck Array
	$multicheck_array = array("facebook" => "Facebook", "twitter" => "Twitter", "myspace" => "Myspace", "flickr" => "Flickr", "youtube" => "Youtube", "vimeo" => "Vimeo", "rss" => "RSS");
	
	// Multicheck Defaults
	$multicheck_defaults = array("facebook" => "Facebook", "twitter" => "Twitter", "myspace" => "Myspace", "flickr" => "Flickr", "youtube" => "Youtube", "vimeo" => "Vimeo", "rss" => "RSS");
	
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
		
	$options[] = array( "name" => __("General", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Logo", "alive"),
						"desc" => __("Recommended height: 74px. Maximum width: 205px. Upload your logo using the button on the left. Once uploaded, click 'Use Image' to set your logo.", "alive"),
						"id" => "logo_url",
						"std" => THEME_URL . "/images/dark/logo.png",
						"type" => "upload");

	$options[] = array( "name" => __("Slogan", "alive"),
						"desc" => __("The text that appears under the logo.", "alive"),
						"id" => "slogan",
						"std" => "Feel The Web",
						"type" => "text");
						
	$options[] = array( "name" => __("Favicon URL", "alive"),
						"desc" => __("Upload your favicon image using the button on the left. Once uploaded, click 'Use Image' to set your favicon image.", "alive"),
						"id" => "favicon_url",
						"std" => THEME_URL . "/images/wpmini-grey.png",
						"type" => "upload");

	$options[] = array( "name" => "Twitter Username",
						"desc" => __("Enter your twitter username. This is used for the twitter widget enabled by the shortcode [twitter]", "alive"),
						"id" => "twitter_username",
						"std" => "iamspacehead",
						"type" => "text");
	
	$options[] = array( "name" => "Number of Twitter Posts",
						"desc" => __("Enter the number of Twitter posts you would like to display", "alive"),
						"id" => "twitter_posts",
						"std" => "5",
						"type" => "text");
	
	$options[] = array( "name" => __("Appearance", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Skin", "alive"),
						"desc" => __("Choose a colour scheme of either light or dark.", "alive"),
						"id" => "skin",
						"std" => "dark",
						"type" => "select",
						"options" => $skin_array);
											
	$options[] = array( "name" => __("Preloader Logo", "alive"),
						"desc" => __("The logo that appears before the website has loaded. Dimensions: 150px x 40px", "alive"),
						"id" => "preloader_image",
						"std" => THEME_URL . "/images/dark/logo-preloader.png",
						"type" => "upload");

	$options[] = array( "name" => __("Link Color", "alive"),
						"desc" => "The color of hyperlinks in the content area",
						"id" => "theme_color",
						"std" => "#FFFFFF",
						"type" => "color");
	
	$options[] = array( "name" => __("Button Color", "alive"),
						"desc" => __("The color of the theme's buttons.", "alive"),
						"id" => "blog_button_color",
						"std" => "black",
						"type" => "select",
						"options" => $color_array);

	$options[] = array( "name" => __("Background", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Slider Interval", "alive"),
						"desc" => __("The length between background slideshow transitions in milliseconds.", "alive"),
						"id" => "slider_interval",
						"std" => "5000",
						"type" => "text");

	$options[] = array( "name" => __("Slider Transition", "alive"),
						"desc" => __("The type of animation for the slideshow transitions.", "alive"),
						"id" => "slider_transition",
						"std" => "1",
						"type" => "select",
						"options" => $slider_transition_array);

	$options[] = array( "name" => __("Transition Speed", "alive"),
						"desc" => __("The speed of each slide transition in milliseconds.", "alive"),
						"id" => "slider_speed",
						"std" => "700",
						"type" => "text");

	$options[] = array( "name" => __("Pause Slideshow When Content Opened", "alive"),
						"desc" => __("Pause the slideshow when the user is viewing a content page.", "alive"),
						"id" => "slider_pause",
						"std" => "1",
						"options" => array("1" => "Yes", "0" => "No"),
						"type" => "select");

	$options[] = array( "name" => __("Background Overlay", "alive"),
						"desc" => __("Show the background overlay pattern.", "alive"),
						"id" => "image_overlay",
						"std" => "1",
						"options" => array ("1" => "Yes", "0" => "No"),
						"type" => "select");
	
	$options[] = array( "name" => __("Background Overlay Pattern", "alive"),
						"desc" => __("Choose the background pattern image.", "alive"),
						"id" => "image_overlay_pattern",
						"std" => "1",
						"options" => array ("1" => "Grid", "2" => "Open rectangle", "3" => "Diagonal", "4" => "Zig Zag"),
						"type" => "select");

	$options[] = array( "name" => __("Tile Settings", "alive"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Animate Tiles", "alive"),
						"desc" => __("Choose whether to have the tiles slide at random.", "alive"),
						"id" => "tile_animate",
						"std" => "true",
						"options" => array("true" => "Yes", "false" => "No"),
						"type" => "select");
											
	$options[] = array( "name" => __("Tile Slide Speed", "alive"),
						"desc" => __("The slide animation speed of the tiles in milliseconds.", "alive"),
						"id" => "tile_slide_speed",
						"std" => "400",
						"type" => "text");

	$options[] = array( "name" => __("Tile Update Speed", "alive"),
						"desc" => __("How often a random tile moves in milliseconds.", "alive"),
						"id" => "tile_update_speed",
						"std" => "4000",
						"type" => "text");

	$options[] = array( "name" => __("Home Tile Height", "alive"),
						"desc" => __("The height of all navigation tiles on the homepage in pixels.", "alive"),
						"id" => "home_tile_height",
						"std" => "180",
						"type" => "text");
	
	$options[] = array( "name" => __("Home Tile Width", "alive"),
						"desc" => __("The width of all navigation tiles on the homepage in pixels.", "alive"),
						"id" => "home_tile_width",
						"std" => "180",
						"type" => "text");
	
	$options[] = array( "name" => __("Tile Positions", "alive"),
						"type" => "heading");
						
	$default_tile_pos = array(
		array('110','310'),
		array('300','40'),
		array('350','280'),
		array('270','530'),
		array('160','750'),
		array('380','820'),
	);
	$menu_count = count_menu_items();
	
	for($i = 1; $i <= $menu_count; $i++) {
		$options[] = array( "name" =>  __("Tile ". $i . " top position", "alive"),
						"desc" => "Top position of the tile on the homepage (in pixels). Min: 0, Max: 560",
						"id" => "nav_tile_" . $i . "_top",
						"std" => $default_tile_pos[$i - 1][0],
						"class" => "mini",
						"type" => "text");
		
		$options[] = array( "name" =>  __("Tile ". $i . " left position", "alive"),
						"desc" => "Left position of the tile on the homepage (in pixels). Min: 0, Max: 1000",
						"id" => "nav_tile_" . $i . "_left",
						"std" => $default_tile_pos[$i - 1][1],
						"class" => "mini",
						"type" => "text");
		$options[] = array( "name" => __("Tile ". $i . " image", "alive"),
						"desc" => __("The image that appears on the tile", "alive"),
						"id" => "nav_tile_" . $i . "_image",
						"std" => "",
						"type" => "upload");
						
	}				
						
	$options[] = array( "name" => __("Music", "activate"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Enable music", "activate"),
						"desc" => __("Upload the song you want to have loaded in the music player.", "activate"),
						"id" => "music_toggle",
						"std" => "1",
						"options" => array ("1" => "Yes", "0" => "No"),
						"type" => "select");
						
	$options[] = array( "name" => __("Autoplay", "activate"),
						"desc" => __("Choose whether to start playing music on page load.", "activate"),
						"id" => "music_autoplay",
						"std" => "1",
						"options" => array ("1" => "Yes", "0" => "No"),
						"type" => "select");
						
	$options[] = array( "name" => __("Number of music files", "activate"),
						"desc" => __("Select how many music files you want to include in the playlist.", "activate"),
						"id" => "music_num",
						"std" => "1",
						"options" => array ("1" => "1", "2" => "2" , "3" => "3", "4" => "4", "5" => "5"),
						"type" => "select");
	
	$music_num = of_get_option("music_num");
	

	for($i = 1; $i <= $music_num; $i++) {
		
		$options[] = array( "name" => __("MP3 file #", "activate") . $i,
						"desc" => __("Upload the song you want to have loaded in the music player in MP3 format", "activate"),
						"id" => "music_url_mp3" . $i,
						"type" => "upload");
	
		$options[] = array( "name" => __("OGG file #", "activate") . $i,
						"desc" => __("Upload the song you want to have loaded in the music player in OGG format.", "activate"),
						"id" => "music_url_ogg" . $i,
						"type" => "upload");
	
	}
	
						
	$options[] = array( "name" => __("Footer", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Copyright", "alive"),
						"desc" => __("The copyright text/HTML appearing at the bottom left of the footer. ", "alive"),
						"id" => "copyright",
						"std" => '&copy; alive 2011. All rights reserved.',
						"type" => "text");
						
	$options[] = array( "name" => __("Show/Hide Social Icons", "alive"),
						"desc" => __("Check an icon to show it on your site and vice versa.", "alive"),
						"id" => "social_icons",
						"std" => $multicheck_defaults,
						"type" => "multicheck",
						"options" => $multicheck_array);

	$options[] = array( "name" => __("Facebook URL", "alive"),
						"desc" => __("Complete URL link to your Facebook page.", "alive"),
						"id" => "facebook_url",
						"std" => "#",
						"type" => "text");

	$options[] = array( "name" => __("Twitter URL", "alive"),
						"desc" => __("Complete URL link to your Twitter profile.", "alive"),
						"id" => "twitter_url",
						"std" => "#",
						"type" => "text");
						
	$options[] = array( "name" => __("Myspace URL", "alive"),
						"desc" => __("Complete URL link to your Facebook profile.", "alive"),
						"id" => "myspace_url",
						"std" => "#",
						"type" => "text");

	$options[] = array( "name" => __("Flickr URL", "alive"),
						"desc" => __("Complete URL link to your Flickr profile.", "alive"),
						"id" => "flickr_url",
						"std" => "#",
						"type" => "text");

	$options[] = array( "name" => __("Youtube URL", "alive"),
						"desc" => __("Complete URL link to your Youtube channel.", "alive"),
						"id" => "youtube_url",
						"std" => "#",
						"type" => "text");
						
	$options[] = array( "name" => __("Vimeo URL", "alive"),
						"desc" => __("Complete URL link to your Vimeo channel.", "alive"),
						"id" => "vimeo_url",
						"std" => "#",
						"type" => "text");

	$options[] = array( "name" => __("Animations", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Hover Fade Speed", "alive"),
						"desc" => __("The fade speed when hovering over images in milliseconds.", "alive"),
						"id" => "hover_fade",
						"std" => "400",
						"type" => "text");

	$options[] = array( "name" => __("Page Fade Speed", "alive"),
						"desc" => __("The fade speed of the page transition in milliseconds.", "alive"),
						"id" => "page_fade",
						"std" => "400",
						"type" => "text");

	$options[] = array( "name" => __("Menu Toggle Speed", "alive"),
						"desc" => __("The transition speed from the homepage menu to navigation menu in milliseconds.", "alive"),
						"id" => "menu_speed",
						"std" => "600",
						"type" => "text");

	$options[] = array( "name" => __("Menu Easing", "alive"),
						"desc" => __("The easing animation for the transition between the homepage menu and navigation menu.", "alive"),
						"id" => "menu_easing",
						"std" => "easeInOutQuart",
						"type" => "select",
						"options" => $easing_array);
	
	$options[] = array( "name" => __("Page Easing", "alive"),
						"desc" => __("The easing animation for the entrance and exit of the content page.", "alive"),
						"id" => "page_easing",
						"std" => "easeInCubic",
						"type" => "select",
						"options" => $easing_array);
	
	$options[] = array( "name" => __("Pagination", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Gallery Items Per Page", "alive"),
						"desc" => __("The default number of gallery items per page.", "alive"),
						"id" => "gallery_items_per_page",
						"std" => "12",
						"type" => "text");

	$options[] = array( "name" => __("Blog Posts Per Page", "alive"),
						"desc" => __("The number of blog posts per page.", "alive"),
						"id" => "blog_posts_per_page",
						"std" => "3",
						"type" => "text");
	
	$options[] = array( "name" => __("WooCommerce shop columns", "alive"),
						"desc" => __("Choose the number of columns to appear on the shop page for WooCommerce.", "alive"),
						"id" => "shop_columns",
						"std" => "1",
						"options" => array ("1" => "1", "2" => "2", "3" => "3"),
						"type" => "select");
	
	$options[] = array( "name" => __("Products Per Page", "alive"),
						"desc" => __("The number of products to show per page.", "alive"),
						"id" => "shop_products",
						"std" => "6",
						"type" => "text");
										
						
	$options[] = array( "name" => __("Contact", "alive"),
						"type" => "heading");

	$options[] = array( "name" => __("Admin Email", "alive"),
						"desc" => __("The email address linked to the contact form.", "alive"),
						"id" => "admin_email",
						"std" => "test@example.com",
						"type" => "text");
		
	$options[] = array( "name" => __("Form Message", "alive"),
						"desc" => __("The message initially displayed on the form.", "alive"),
						"id" => "form_message",
						"std" => 'Send any enquiry you may have using the form below.',
						"type" => "text");
		
	$options[] = array( "name" => __("Form Success Message", "alive"),
						"desc" => __("The message displayed when the email is successfully sent.", "alive"),
						"id" => "form_success",
						"std" => 'Thanks, we got your email and will respond as soon as possible.',
						"type" => "text");
	
	$options[] = array( "name" => __("Form Warning Message", "alive"),
						"desc" => __("The message displayed when an error occurs during form validation. ", "alive"),
						"id" => "form_warning",
						"std" => 'Verify fields and try again!',
						"type" => "text");
	
	$options[] = array( "name" => __("Form Error Message", "alive"),
						"desc" => __("The message displayed when the form fails to send an email.", "alive"),
						"id" => "form_error",
						"std" => 'There was an error sending your email. Please try again.',
						"type" => "text");										
	
	$options[] = array( "name" => __("Custom", "alive"),
						"type" => "heading");
	
	$options[] = array( "name" => __("Custom CSS", "alive"),
						"desc" => __("Make modifications to the CSS without editing the source files.", "alive"),
						"id" => "custom_css",
						"std" => '',
						"type" => "textarea");
	$options[] = array( "name" => __("Custom JS", "alive"),
						"desc" => __("Add javascript to the footer without editing the source files.", "alive"),
						"id" => "custom_js",
						"std" => '',
						"type" => "textarea");												

	return $options;
}