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
		
	// Background Defaults
	$background_defaults = array('color' => '#ffffff', 'image' => '', 'repeat' => 'repeat', 'position' => 'top left','attachment' => 'scroll');
	
	$bg_patterns = array("scan-lines.png" => "Scan Lines", "crossed_stripes.png" => "Crossed Stripes", "subtle_emboss.png" => "Cross Stripes Small",
						 "zig_zag_diagonal.png" => "Zig Zag Diagonal", "zig_zag_horizontal.png" => "Zig Zag Horizontal", "zig_zag_vertical.png" => "Zig Zag Vertical", 
						 "left_strip.png" => "Left Strip", "right_strip.png" => "Right Strip", "horizontal_strip.png" => "Horizontal Strip", "vertical_strip.png" => "Vertical Strip", 
						 "small_dots.png" => "Small Dots", "grid.png" => "Grid",
						 "subtle_freckles.png" => "Subtle Freckles",
						 "white_texture.png" => "White Texture", "brushed_alu.png" => "Brushed Aluminium", "little_pluses.png" => "Little Pluses", 
						 "subtle_orange_emboss.png" => "Subtle Orange Emboss", "none" => "None");
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __( 'Select a page:', 'onioneye' );
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/admin/';
		
	$options = array();
	
	
	
	/*-----------------------------------------------------------------------------------*/
	/* General Settings */
	/*-----------------------------------------------------------------------------------*/
		
	$options[] = array( "name" => __("General Settings", 'onioneye'),
						"type" => "heading");
						
	$options[] = array( "name" => __("Custom Logo", 'onioneye'),
						"desc" => __("Upload a logo for your theme. If you leave this option blank, the title that you have defined under the Settings &raquo; General tab in " . 
									 "your WordPress admin panel, will be displayed instead of the logo image.", 'onioneye'),
						"id" => "custom_logo",
						"type" => "upload");
	
	$options[] = array( "name" => __("Custom Footer Logo", 'onioneye'),
						"desc" => __("Upload a logo, preferably a smaller version of the original custom logo, for the footer of your theme. " .
						             "Leave this field blank, if you don't want a footer logo.", 'onioneye'),
						"id" => "custom_footer_logo",
						"type" => "upload");
						
	$options[] = array( "name" => __("Custom Favicon", 'onioneye'),
						"desc" => __("Upload a 16px x 16px or a 32px x 32px PNG/GIF/ICO image that will represent your website's favicon. " . 
								 	 "A favicon is an icon that gets displayed in the address bar of every browser.", 'onioneye'),
						"id" => "custom_favicon",
						"type" => "upload");
						
	$options[] = array( "name" => __("Custom Header Text", 'onioneye'),
			          	"desc" => __("Put any custom text here, like your telephone number and email address, that will appear in the top left corner of the theme. " .
			          				 'Note: you may use these HTML tags and attributes: a (href, title, class, id), br, em (class, id), strong (class, id), span (class, id), abbr (title), cite, code, strike.', 'onioneye'),
			          	"id" => "header_text",
			          	"std" => "",
			          	"type" => "textarea"); 
	
	$options[] = array( "name" => __("Email Address", "onioneye"),
			          	"desc" => __("Enter your email address, which will receive emails sent from the popup modal contact form. If you don&rsquo;t want " . 
			          			     "to use a popup modal contact form, leave this field blank.", 'onioneye'),
			          	"id" => "email_address",
			          	"std" => "",
			          	"type" => "text");
	
	
	
	/*-----------------------------------------------------------------------------------*/
	/* Homepage Settings */
	/*-----------------------------------------------------------------------------------*/
		
	$options[] = array( "name" => __("Homepage Settings", 'onioneye'),
						"type" => "heading");
						
	$options[] = array( "name" => __("Headline Introduction Text", 'onioneye'),
			          	"desc" => __("Put the custom headline text here, that will appear below the logo and the menu of the theme. " .
			          				 "Leave this field blank if you don't want a custom introduction text. " .
			          				 'Note: you may use these HTML tags and attributes: a (href, title, class, id), br, em (class, id), strong (class, id), span (class, id), abbr (title), cite, code, strike.', 'onioneye'),
			          	"id" => "intro_text",
			          	"std" => "",
			          	"type" => "textarea"); 
	
	$options[] = array( "name" => __("The Number of Latest Projects Per Row", 'onioneye'),
			          	"desc" => __("Pick the number of projects you want to show per row in the portfolio section of the homepage.", 'onioneye'),
			          	"id" => "number_of_featured_projects_per_row",
			          	"std" => 3,
			          	"type" => "radio",
			          	"options" => array(2 => __("Two", 'onioneye'), 3 => __("Three", 'onioneye'), 4 => __("Four", 'onioneye')));
						
	$options[] = array( "name" => __("Number of Latest Project Rows", 'onioneye'),
			          	"desc" => __("Pick how many number of rows of latest projects do you want to show in the portfolio section of the homepage.", 'onioneye'),
			          	"id" => "number_of_featured_project_rows",
			          	"std" => 3,
			          	"type" => "radio",
			          	"options" => array(1 => __("One", 'onioneye'), 2 => __("Two", 'onioneye'), 3 => __("Three", 'onioneye')));
			          	
	$options[] = array( "name" => __("Portfolio Page Link", 'onioneye'),
			          	"desc" => __("Choose the portfolio page that displays all the portfolio items, so it is properly linked to from the homepage.", 'onioneye'),
			          	"id" => "portfolio_link",
			          	"std" => "Select a Page:",
			          	"type" => "select",
			          	"options" => $options_pages);
						
	$options[] = array( "name" => __("Enable the Latest Articles Section?", 'onioneye'),
			          	"desc" => __("Check this box to show the latest articles on the homepage.", 'onioneye'),
			          	"id" => "latest_articles_enabled",
			          	"std" => "0",
			          	"type" => "checkbox");
						
						
						
	/*-----------------------------------------------------------------------------------*/
	/* Blog Settings */
	/*-----------------------------------------------------------------------------------*/
		
	$options[] = array( "name" => __("Blog Settings", 'onioneye'),
						"type" => "heading");
	
	$options[] = array( "name" => __("Display Full Blog Posts or Display Excerpt?", 'onioneye'),
	          			"desc" => __("This option controls whether the blog index page displays the full posts, making use of the WordPress more quicktag to designate the &ldquo;cut-off&rdquo; " .
	          			   			 "point for the post to be excerpted, or displays the excerpt of the current post which refers to the first 90 words of the post's content.", 'onioneye'),
	          			"id" => "post_type",
	          			"std" => "excerpt",
	          			"type" => "radio",
	          			"options" => array("full" => __("Full Post", 'onioneye'), "excerpt" => __("Excerpt Post", 'onioneye'))); 
						
	$options[] = array( "name" => __("Disable the Sidebar on the Blog Page?", 'onioneye'),
			          	"desc" => __("Check this box to disable the sidebar on the blog page.", 'onioneye'),
			          	"id" => "blog_page_sidebar_disabled",
			          	"std" => "0",
			          	"type" => "checkbox");
          
	$options[] = array( "name" => __("Disable the Sidebar on Individual Blog Posts?", 'onioneye'),
			          	"desc" => __("Check this box to disable the sidebar on individual blog posts.", 'onioneye'),
			          	"id" => "single_post_sidebar_disabled",
			          	"std" => "0",
			          	"type" => "checkbox");
					
					
															
	/*-----------------------------------------------------------------------------------*/
	/* Styling Settings */
	/*-----------------------------------------------------------------------------------*/
	
	$options[] = array( "name" => "Styling Options",
						"type" => "heading");
						
	$options[] = array( "name" => __("Background Pattern/Image", 'onioneye'),
			          	"desc" => __("Select your theme's background pattern. If you want to define your own, in the option below, or use a plain color for the background, select &ldquo;None.&rdquo;", 'onioneye'),
			          	"id" => "alt_pattern",
			          	"std" => "scan-lines.png",
			          	"type" => "select",
			          	"options" => $bg_patterns);
						
	$options[] = array( "name" => __("Body Background Color and Background Image", 'onioneye'),
						"desc" => __("Change the background color and/or the background image.", 'onioneye'),
						"id" => "body_bg",
						"std" => $background_defaults, 
						"type" => "background");
						
	$options[] = array( "name" => "Main Layout",
						"desc" => "Choose the position of the sidebar and the main content.",
						"id" => "sidebar_alignment",
						"std" => "two-cols-right-fixed",
						"type" => "images",
						"options" => array(
							'two-cols-right-fixed' => $imagepath . '2cr.png',
							'two-cols-left-fixed' => $imagepath . '2cl.png')
						);
	
	
	
	/*-----------------------------------------------------------------------------------*/
	/* Homepage Slider options */
	/*-----------------------------------------------------------------------------------*/
							        
	$options[] = array( "name" => __("Homepage Slider", 'onioneye'),
	          			"type" => "heading"); 
	          
	$options[] = array( "name" => __("Disable The Homepage Slider?", 'onioneye'),
			          	"desc" => __("Check this box if you want to disable the slider.", 'onioneye'),
			          	"id" => "slider_disabled",
			          	"std" => "0",
			          	"type" => "checkbox");
	
	$options[] = array( "name" => __("Slider Type", 'onioneye'),
	          			"desc" => __("This option controls the type of slider that your homepage will use. With the first option &ldquo;Fading Slider&rdquo; " .
	          			 			 "selected, your homepage slider will fade from one frame to the next. With the second option &ldquo;Tabbed Slider&rdquo; selected your homepage slider will tab from one frame to the next.", 'onioneye'),
	          			"id" => "slider_type",
	          			"std" => "fade",
	          			"type" => "radio",
	          			"options" => array("fade" => __("Fading Slider", 'onioneye'), "slide" => __("Tabbed Slider", 'onioneye'))); 
			  
	$options[] = array( "name" => __("Slider Height", 'onioneye'),
			          	"desc" => __("Adjust the height of the slider in pixels. The maximum value of this field is 1000 and the minimum 100 pixels.", 'onioneye'),
			          	"id" => "slider_height",
			          	"std" => "450",
			          	"type" => "number"); 
						
	$options[] = array( "name" => __("Autoplay Slideshow", 'onioneye'),
			          	"desc" => __("Autoplay slideshow, a positive number (anything other than a zero) will set to true and be the time between slide animation in milliseconds (1 Second = 1000 milliseconds).", 'onioneye'),
			          	"id" => "transition_speed",
			          	"std" => "5000",
			          	"type" => "number"); 
			  
	$options[] = array( "name" => __("Slider Pause", 'onioneye'),
			          	"desc" => __("Pause slideshow on click of next/prev or pagination. A positive number will set to true and be the time of pause in milliseconds, while a zero will cancel the pause.", 'onioneye'),
			          	"id" => "slider_pause",
			          	"std" => "2500",
			          	"type" => "number");  
			  
	$options[] = array( "name" => __("Hover Pause", 'onioneye'),
			          	"desc" => __("Set to true and hovering over slideshow will pause it.", 'onioneye'),
			          	"id" => "pause_enabled",
			          	"std" => "1",
			          	"type" => "checkbox");  
			  
	$options[] = array( "name" => __("Disable Slider Pagination?", 'onioneye'),
			          	"desc" => __("Check to disable the pagination.", 'onioneye'),
			          	"id" => "disable_pagination",
			          	"std" => "0",
			          	"type" => "checkbox"); 
	          
	$options[] = array( "name" => __("Randomize Slides?", 'onioneye'),
			          	"desc" => __("Check to randomize slides in the slideshow.", 'onioneye'),
			          	"id" => "randomize",
			          	"std" => "0",
			          	"type" => "checkbox"); 
	          
	$options[] = array( "name" => __("Slider Fade Speed", 'onioneye'),
			         	"desc" => __("Set the speed of the fading animation in milliseconds.", 'onioneye'),
			          	"id" => "fade_speed",
			          	"std" => "350",
			          	"type" => "number");
	          
	$options[] = array( "name" => __("Slider Slide Speed", 'onioneye'),
			          	"desc" => __("Set the speed of the sliding animation in milliseconds.", 'onioneye'),
			          	"id" => "slide_speed",
			          	"std" => "350",
			          	"type" => "number");
			  
	$options[] = array( "name" => __("Auto Height Adjust?", 'onioneye'),
	          			"desc" => __("Check to make the slider auto adjust its height every time a new slide is displayed. " .
	          						 "The height of the content in each slide will be the height of the slider.", 'onioneye'),
	          			"id" => "auto_height_enabled",
			          	"std" => "0",
			          	"type" => "checkbox"); 
			  
	$options[] = array( "name" => __("Auto Height Speed", 'onioneye'),
			          	"desc" => __("Set auto height animation time in milliseconds.", 'onioneye'),
			          	"id" => "auto_height_speed",
			          	"std" => "350",
			          	"type" => "number");
	
	
	
	/*-----------------------------------------------------------------------------------*/
	/* Portfolio Slider options */
	/*-----------------------------------------------------------------------------------*/
							        
	$options[] = array( "name" => __("Portfolio Slider", 'onioneye'),
	          			"type" => "heading"); 
	
	$options[] = array( "name" => __("Slider Type", 'onioneye'),
	          			"desc" => __("This option controls the type of slider that your homepage will use. With the first option &ldquo;Fading Slider&rdquo; " .
	          			 			 "selected, your homepage slider will fade from one frame to the next. With the second option &ldquo;Tabbed Slider&rdquo; selected your homepage slider will tab from one frame to the next.", 'onioneye'),
	          			"id" => "pf_slider_type",
	          			"std" => "slide",
	          			"type" => "radio",
	          			"options" => array("fade" => __("Fading Slider", 'onioneye'), "slide" => __("Tabbed Slider", 'onioneye'))); 
						
	$options[] = array( "name" => __("Autoplay Slideshow", 'onioneye'),
			          	"desc" => __("Autoplay slideshow, a positive number (anything other than a zero) will set to true and be the time between slide animation in milliseconds (1 Second = 1000 milliseconds).", 'onioneye'),
			          	"id" => "pf_transition_speed",
			          	"std" => "0",
			          	"type" => "number"); 
			  
	$options[] = array( "name" => __("Slider Pause", 'onioneye'),
			          	"desc" => __("Pause slideshow on click of next/prev or pagination. A positive number will set to true and be the time of pause in milliseconds, while a zero will cancel the pause.", 'onioneye'),
			          	"id" => "pf_slider_pause",
			          	"std" => "2500",
			          	"type" => "number");  
			  
	$options[] = array( "name" => __("Hover Pause", 'onioneye'),
			          	"desc" => __("Set to true and hovering over slideshow will pause it.", 'onioneye'),
			          	"id" => "pf_pause_enabled",
			          	"std" => "1",
			          	"type" => "checkbox");  
			  
	$options[] = array( "name" => __("Disable Slider Pagination?", 'onioneye'),
			          	"desc" => __("Check to disable the pagination.", 'onioneye'),
			          	"id" => "pf_disable_pagination",
			          	"std" => "0",
			          	"type" => "checkbox"); 
	          
	$options[] = array( "name" => __("Randomize Slides?", 'onioneye'),
			          	"desc" => __("Check to randomize slides in the slideshow.", 'onioneye'),
			          	"id" => "pf_randomize",
			          	"std" => "0",
			          	"type" => "checkbox"); 
	          
	$options[] = array( "name" => __("Slider Fade Speed", 'onioneye'),
			         	"desc" => __("Set the speed of the fading animation in milliseconds.", 'onioneye'),
			          	"id" => "pf_fade_speed",
			          	"std" => "350",
			          	"type" => "number");
	          
	$options[] = array( "name" => __("Slider Slide Speed", 'onioneye'),
			          	"desc" => __("Set the speed of the sliding animation in milliseconds.", 'onioneye'),
			          	"id" => "pf_slide_speed",
			          	"std" => "350",
			          	"type" => "number");
			  
	$options[] = array( "name" => __("Auto Height Speed", 'onioneye'),
			          	"desc" => __("Set auto height animation time in milliseconds.", 'onioneye'),
			          	"id" => "pf_auto_height_speed",
			          	"std" => "350",
			          	"type" => "number");
			
			
	          
	/*-----------------------------------------------------------------------------------*/
	/* Sociables options */
	/*-----------------------------------------------------------------------------------*/	
	
	$options[] = array( "name" => __("Social Networking", 'onioneye'),
	          			"type" => "heading"); 
	          
	$options[] = array( "name" => __("Twitter URL", 'onioneye'),
			          	"desc" => __("Enter your Twitter URL here.", 'onioneye'),
			          	"id" => "twitter_url",
			          	"std" => "",
			          	"type" => "text"); 
	          
	$options[] = array( "name" => __("Facebook URL", 'onioneye'),
			          	"desc" => __("Enter your Facebook URL here.", 'onioneye'),
			          	"id" => "facebook_url",
			          	"std" => "",
			          	"type" => "text"); 
	          
	$options[] = array( "name" => __("Flickr URL", 'onioneye'),
			          	"desc" => __("Enter your Facebook URL here.", 'onioneye'),
			          	"id" => "flickr_url",
			          	"std" => "",
			          	"type" => "text"); 
						
	$options[] = array( "name" => __("Vimeo URL", 'onioneye'),
			          	"desc" => __("Enter your Vimeo URL here.", 'onioneye'),
			          	"id" => "vimeo_url",
			          	"std" => "",
			          	"type" => "text");
						
	$options[] = array( "name" => __("YouTube URL", 'onioneye'),
			          	"desc" => __("Enter your YouTube URL here.", 'onioneye'),
			          	"id" => "youtube_url",
			          	"std" => "",
			          	"type" => "text");
			          	
	$options[] = array( "name" => __("LinkedIn URL", 'onioneye'),
			          	"desc" => __("Enter your LinkedIn URL here.", 'onioneye'),
			          	"id" => "linkedin_url",
			          	"std" => "",
			          	"type" => "text");
			          	
	$options[] = array( "name" => __("Google+ URL", 'onioneye'),
			          	"desc" => __("Enter your Google+ URL here.", 'onioneye'),
			          	"id" => "googleplus_url",
			          	"std" => "",
			          	"type" => "text");
						
	$options[] = array( "name" => __("Dribbble URL", 'onioneye'),
			          	"desc" => __("Enter your Dribbble URL here.", 'onioneye'),
			          	"id" => "dribbble_url",
			          	"std" => "",
			          	"type" => "text"); 
						
	$options[] = array( "name" => __("Tumblr URL", 'onioneye'),
			          	"desc" => __("Enter your Tumblr URL here.", 'onioneye'),
			          	"id" => "tumblr_url",
			          	"std" => "",
			          	"type" => "text");
						
	$options[] = array( "name" => __("Skype URL", 'onioneye'),
			          	"desc" => __("Enter your Skype URL here.", 'onioneye'),
			          	"id" => "skype_url",
			          	"std" => "",
			          	"type" => "text");
						
	$options[] = array( "name" => __("Delicious URL", 'onioneye'),
			          	"desc" => __("Enter your Delicious URL here.", 'onioneye'),
			          	"id" => "delicious_url",
			          	"std" => "",
			          	"type" => "text"); 
						
	$options[] = array( "name" => __("Digg URL", 'onioneye'),
			          	"desc" => __("Enter your Digg URL here.", 'onioneye'),
			          	"id" => "digg_url",
			          	"std" => "",
			          	"type" => "text");
	          
	$options[] = array( "name" => __("Feedburner RSS URL", 'onioneye'),
			          	"desc" => __("Enter your Feedburner URL here.", 'onioneye'),
			          	"id" => "rss_url",
			          	"std" => "",
			          	"type" => "text"); 
	            
	
	            
	/*-----------------------------------------------------------------------------------*/
	/* Footer options */
	/*-----------------------------------------------------------------------------------*/	
	
	$options[] = array( "name" => __("Footer", 'onioneye'),
	          			"type" => "heading"); 
	          
	$options[] = array( "name" => __("Footer Column Layout", 'onioneye'),
			          	"desc" => __("Select the number of footer columns/widget areas. The footer widget areas are named Bottom 1, Bottom 2, Bottom 3, and Bottom 4 " .
					  			   	 "accordingly and are so aligned from left to right, with Bottom 1 being the leftmost widget area and Bottom 4 the righmost widget area. " .
					  			   	 "If you choose two widget areas for example, Bottom 1 and Bottom 2 are going to be displayed, while Bottom 3 and Bottom 4 are going to be ignored.", 'onioneye'),
			          	"id" => "footer_columns",
			          	"std" => 4,
			          	"type" => "radio",
			          	"options" => array(1 => __("One", 'onioneye'), 2 => __("Two", 'onioneye'), 3 => __("Three", 'onioneye'), 4 => __("Four", 'onioneye'))); 
	 
	$options[] = array( "name" => __("Disable Footer Widgets?", 'onioneye'),
			          	"desc" => __("Check this box if you'd like to disable the footer widgets. This will completely remove the widgetized footer area at the bottom of every page.", 'onioneye'),
			          	"id" => "footer_widgets_disabled",
			          	"std" => "0",
			          	"type" => "checkbox");
	          
	$options[] = array( "name" => __("Copyright Footer Text", 'onioneye'),
			          	"desc" => __("Whatever text you enter here will be displayed in your website's footer area. The primary purpose of this option is to display your website's Copyright text, but you can enter whatever text you like.", 'onioneye'),
			          	"id" => "copyright_text",
			          	"std" => "&copy; " . date("Y") . ' ' . get_bloginfo('name') . ". All rights reserved.",
			          	"type" => "textarea");
		
	return $options;
	
	
}