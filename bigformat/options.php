<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = 'BigFormat';
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	$shortname = 'of';
	
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
	$imagepath =  get_template_directory_uri() . '/admin/images/';
		
	$options = array();	
	

$options[] = array( "name" => "General",				 
					"type" => "heading");
					

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).<br /><br /> Image-size should be 200px wide and any height.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                              
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");    
					
					
$options[] = array( "name" => "Customize",				 
					"type" => "heading"); 

$url =  get_template_directory_uri() .'/images/skins/textures/';
$options[] = array( "name" => "Background Texture",
					"desc" => "Choose a texture overlay for your background. This will show when you don't have a &quot;Featured Image&quot; set for your page.",
					"id" => $shortname."_texture_bg",
					"std" => "none",
					"type" => "images",
					"options" => array(
						'none' => $url . 'call-none.png',
						$url . 'grain.png' => $url . 'grainthumb.png',
						$url . 'canvas.png' => $url . 'canvasthumb.png',
						$url . 'linen.png' => $url . 'linenthumb.png',
						$url . 'graphy.png' => $url . 'graphythumb.png',
						$url . 'vertical-stripes.png' => $url . 'vertical-stripesthumb.png',
						$url . 'cubes.png' => $url . 'cubesthumb.png'
						));

$options[] = array( "name" => "Custom Background Image",
					"desc" => "Upload a custom background image for your theme, or specify the image address of your online background image. (http://yoursite.com/background.png).<br /><br /> Image will be centered and horizontally tile in the featured background area. This will show when you don't have a &quot;Featured Image&quot; set for your page. To set page-specific backgrounds, set a featured image for each page.",
					"id" => $shortname."_background_image",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Top Logo Padding",
					"desc" => "Top Padding for the Logo Section.",
					"id" => $shortname."_logo_padding",
					"std" => "20",
					"type" => "text"); 

$options[] = array( "name" => "Dropdown Menu Text",
					"desc" => "Default Text Displayed in the Mobile Dropdown Menu",
					"id" => $shortname."_menu_text",
					"std" => "Select a Page:",
					"type" => "text");
					
$options[] = array( "name" => "Auto-Hide Navigation Panel",
					"desc" => "Select whether you want to automatically close the navigation panel on pages that display projects.",
					"id" => $shortname."_hide_nav",
					"std" => "no",
					"type" => "radio",
					"options" =>  array(
						'yes' => 'Yes',
						'no' => 'No'
					));
					
$options[] = array( "name" => "Protect Theme Images",
					"desc" => "Select whether you want to protect slide images and theme code from downloads. Disables right-clicking throughout site.",
					"id" => $shortname."_image_protect",
					"std" => "Off",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
					)); 

$options[] = array( "name" => "Overlay Texture",
					"desc" => "Select whether you want the overlay texture on your images.",
					"id" => $shortname."_image_overlay",
					"std" => "On",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
					)); 
					
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");


$options[] = array( "name" => "Buttons &amp; Links",				 
					"type" => "heading");   

$options[] = array( "name" => "Button Color",
					"desc" => "Select Your Theme's Button Color.",
					"id" => $shortname."_button_color",
					"std" => "#00A785",
					"type" => "color"); 

$options[] = array( "name" => "Button Hover Color",
					"desc" => "Select Your Theme's Button Hover Color.",
					"id" => $shortname."_button_hover_color",
					"std" => "#000000",
					"type" => "color"); 

$options[] = array( "name" => "Link Color",
					"desc" => "Select Your Theme's Link Color.",
					"id" => $shortname."_link_color",
					"std" => "#00A785",
					"type" => "color"); 

$options[] = array( "name" => "Link Hover Color",
					"desc" => "Select Your Theme's Link Hover Color.",
					"id" => $shortname."_link_hover_color",
					"std" => "#000000",
					"type" => "color"); 

$options[] = array( "name" => "Homepage",				 
					"type" => "heading");

$options[] = array( "name" => "Homepage Slideshow Controls",
					"desc" => "Select wether you want homepage play/pause and thumbnail controls.",
					"id" => $shortname."_slide_controls",
					"std" => "block",
					"type" => "radio",
					"options" =>  array(
						'block' => 'On',
						'none' => 'Off'
						));


$options[] = array( "name" => "Homepage Slideshow Autoplay",
					"desc" => "Select whether you want the homepage thumbnails to automatically play as slideshows.",
					"id" => $shortname."_home_autoplay",
					"std" => "1 ",
					"type" => "radio",
					"options" =>  array(
						'1 ' => 'On',
						'0 ' => 'Off'
						));

$options[] = array( "name" => "Homepage Slideshow Progress Bar",
					"desc" => "Select whether you want to display the slide progress bar",
					"id" => $shortname."_progress_bar",
					"std" => "1 ",
					"type" => "radio",
					"options" =>  array(
						'1 ' => 'On',
						'0 ' => 'Off'
					)); 
$options[] = array( "name" => "Slideshow Interval Speed in Seconds",
					"desc" => "Speed of the slideshow autoplay in seconds. Whole numbers only.",
					"id" => $shortname."_homepage_autoplay_delay",
					"std" => "5",
					"type" => "text"); 

$options[] = array( "name" => "Portfolio",				 
					"type" => "heading");

$options[] = array( "name" => "Number of Portfolio Slides per Project",
					"desc" => "Keep this as low as you can for memory reasons to keep your load time fast.",
					"id" => $shortname."_thumbnail_number",
					"std" => "6",
					"type" => "text"); 
					
$options[] = array( "name" => "Number of Portfolio Portfolio Items Per Page",
					"desc" => "How many items will display before the 'infinite scroll' displays more.",
					"id" => $shortname."_projects_number",
					"std" => "8",
					"type" => "text"); 
					
$options[] = array( "name" => "Projects Page Lightbox",
					"desc" => "Select whether you want the image to link to single project page or a lightbox popup on the projects page",
					"id" => $shortname."_project_lightbox",
					"std" => "false",
					"type" => "radio",
					"options" =>  array(
						'true' => 'Lightbox',
						'false' => 'Single Project Page'
						));
						
$options[] = array( "name" => "More Info Default Display",
					"desc" => "Select whether you want the project description to display be default.",
					"id" => $shortname."_more_info",
					"std" => "false",
					"type" => "radio",
					"options" =>  array(
						'true' => 'Display',
						'false' => 'Hide'
						));

$options[] = array( "name" => "Project Slideshows Autoplay",
					"desc" => "Select whether you want your project slideshows to automatically play.",
					"id" => $shortname."_portfolio_autoplay",
					"std" => "false",
					"type" => "radio",
					"options" =>  array(
						'true' => 'On',
						'false' => 'Off'
						));
						
$options[] = array( "name" => "Project Slideshow Progress Bar",
					"desc" => "Select whether you want to display the slide progress bar",
					"id" => $shortname."_portfolio_progress_bar",
					"std" => "1 ",
					"type" => "radio",
					"options" =>  array(
						'1 ' => 'On',
						'0 ' => 'Off'
					)); 

$options[] = array( "name" => "Portfolio Slideshow Speed",
					"desc" => "Speed of the slideshow autoplay in seconds. Whole numbers only.",
					"id" => $shortname."_portfolio_autoplay_delay",
					"std" => "7",
					"type" => "text"); 

$options[] = array( "name" => "PrettyPhoto Skin",
					"desc" => "Choose the skin for your PrettyPhoto popups.",
					"id" => $shortname."_prettyphoto_skin",
					"std" => "pp_default",
					"type" => "select",
					"options" => array(
					'pp_default' => 'Default',	
					'facebook' => 'Facebook',	
					'dark_rounded' => 'Dark Rounded',	
					'dark_square' => 'Dark Square',	
					'light_rounded' => 'Light Rounded',	
					'light_square' => 'Light Square'	
					));

$options[] = array( "name" => "Forms",				 
					"type" => "heading");

$options[] = array( "name" => "Contact Email Address",
					"desc" => "Type in the email address you want the contact and quote request forms to mail to.",
					"id" => $shortname."_mail_address",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Successfully Sent Heading",
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_heading",
					"std" => "Thank you for your email.",
					"type" => "text"); 

$options[] = array( "name" => "Successfully Sent Description",
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_description",
					"std" => "It will be answered as soon as possible.",
					"type" => "text"); 
	
$options[] = array( "name" => __("Basic Spam Question", "framework"),
					"desc" => "Do you want to add a basic spam question to your form?",
					"id" => $shortname."_spam_question",
					"std" => "off",
					"type" => "radio",
					"options" => array(
						'on' => 'On',	
						'off' => 'Off'	
					));	

$options[] = array( "name" => "Fonts",				 
					"type" => "heading");

$options[] = array( "name" => "Slideshow Fonts",
						"desc" => "Show Slideshow Font Options",
						"id" => "example_showhidden",
						"type" => "checkbox");

$options[] = array( "name" => "Homepage Caption Title Font",
						"desc" => "Font used for the Caption Title.",
						"id" => $shortname."_slide_header",
						"std" => array('size' => '62px','face' => 'PT Sans Narrow','style' => 'bold','style2' => 'uppercase'),
						"class" => "hidden",
						"type" => "typography_nosize");

$options[] = array( "name" => "Homepage Caption SubTitle Font",
						"desc" => "Font used for the Caption Sub-Title.",
						"id" => $shortname."_slide_subtitle",
						"class" => "hidden",
						"std" => array('size' => '16px','face' => 'Droid Serif','style' => 'bold'),
						"type" => "typography_nosize");

$options[] = array( "name" => "Navigation Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_sf_font",
					"std" => array('face' => 'PT Sans Narrow','style' => 'normal','color' => '#123456', 'style2' => 'uppercase'),
					"type" => "typography_nosize");

$options[] = array( "name" => "Primary Heading Font",
					"desc" => "Font Settings for sitewide primary heading fonts. Page Titles, Portfolio Titles, h1, h2 fonts. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_heading_font",
					"std" => array('face' => 'PT Sans Narrow','style' => 'bold','color' => '#123456', 'style2' => 'uppercase'),
					"type" => "typography_nosize");

$options[] = array( "name" => "Secondary Heading Font",
					"desc" => "Font Settings for sitewide secondary heading fonts. Article Titles, Smaller Titles, h3, h4, h5 fonts. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_heading_font2",
					"std" => array('face' => 'Droid Sans','style' => 'bold','color' => '#ffffff', 'style2' => 'normal'),
					"type" => "typography_nosize");

$options[] = array( "name" => "Tiny Details Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_tiny_font",
					"std" => "Open Sans",
					"std" => array('face' => 'Droid Sans','style' => 'normal','color' => '#123456'),
					"type" => "typography_nosize");

$options[] = array( "name" => "Paragraph Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_p_font",
					"std" => array('size' => '12px','face' => 'Droid Sans','style' => 'normal','color' => '#123456'),
					"type" => "typography_nosize");	
	
$options[] = array( "name" => __("Updates", "framework"),				 
					"type" => "heading");

$options[] = array( "name" => __("Themeforest Username", "framework"),
					"desc" => "Enter your Themeforest Username that you used to purchase the this theme.",
					"id" => $shortname."_tf_username",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => __("Themeforest API Key", "framework"),
					"desc" => "You can find your API key by Logging into Themeforest, visiting your Dashboard page then clicking the My Settings tab. At the bottom of the page you will find your account API key and a button to regenerate it as needed.",
					"id" => $shortname."_tf_api",
					"std" => "",
					"type" => "text"); 	
	return $options;
}