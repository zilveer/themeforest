<?php

/* ------------------------------------------------- */
/* 	Populating the Theme Options Panel with options
/* ------------------------------------------------- */

add_action('init','icy_options');

if (!function_exists('icy_options')) {
	
function icy_options() {
	
// define the template path for further use	
$GLOBALS['template_path'] = ICY_DIRECTORY;	
	
// variables
	$themename = wp_get_theme();
	$shortname = "icy";

// populating option in array for use in theme
	global $icy_options;
		$icy_options = get_option('icy_options');

// access the WordPress Pages via an Array
	$icy_pages = array();
	
	$icy_pages_obj = get_pages('sort_column=post_parent,menu_order');    
	
	foreach ($icy_pages_obj as $icy_page) {
    	$icy_pages[$icy_page->ID] = $icy_page->post_name; }
	
	$icy_pages_tmp = array_unshift($icy_pages, "Select a page:");  
	     
// access the WordPress Categories via an Array
	$icy_categories = array();  
	
	$icy_categories_obj = get_categories('hide_empty=0');
	
	foreach ($icy_categories_obj as $icy_cat) {
    	$icy_categories[$icy_cat->cat_ID] = $icy_cat->cat_name;}
	
	$categories_tmp = array_unshift($icy_categories, "Select a category:");
// testing 
	$options_select = array("one","two","three","four","five"); 
	$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

// image linicy to options
	$options_image_link_to = array("image" => "Image","post" => "Post"); 

// image alignment radio box
	$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 


//
	$uploads_arr = wp_upload_dir();
	$all_uploads = get_option('icy_uploads');
	$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");	
	$all_uploads_path = $uploads_arr['path'];
	$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
	$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");



$options = array();


// General Settings

$options[] = array( "name" => __('General Settings','framework'),
                    "type" => "heading");

$options[] = array( "name" => __('Your Username','framework'),
					"desc" => __('Enter an username to receive auto-updates straight from the WordPress Dashboard.','framework'),
					"id" => $shortname."_buyer_user",
					"std" => "",
					"type" => "text");	

$options[] = array( "name" => __('Your API','framework'),
					"desc" => __('Enter an API key to receive auto-updates straight from the WordPress Dashboard.','framework'),
					"id" => $shortname."_buyer_api",
					"std" => "",
					"type" => "text");	
					
$options[] = array( "name" => __('Custom Favicon','framework'),
					"desc" => __('Upload a 16px x 16px .png/.gif image that will represent your site\'s favicon.','framework'),
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => __('Email Address for Contact Page','framework'),
					"desc" => __('Enter the mail address where you\'d like to receive emails from the contact form. Leave blank to use admin email.','framework'),
					"id" => $shortname."_email",
					"std" => "example@icypixels.com",
					"type" => "text");	
					
$options[] = array( "name" => __('Enable a Plain Text Logo','framework'),
					"desc" => __('Check this to enable a plain text logo instead of an image.','framework'),
					"id" => $shortname."_plain_logo",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo to your theme, or specify the image address of your online logo. (http://example.com/logo.png)','framework'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");					

$options[] = array( "name" => __('Donate Button Text','framework'),
					"desc" => __('Type in the donate button text','framework'),
					"id" => $shortname."_donate_text",
					"std" => "Support Us",
					"type" => "text");

$options[] = array( "name" => __('Donate Button URL','framework'),
					"desc" => __('Type in the donate button link','framework'),
					"id" => $shortname."_donate_url",
					"std" => "#",
					"type" => "text");

$options[] = array( "name" => __('Footer Copy','framework'),
					"desc" => __('Enter the text you would like to display in the footer of your site.','framework'),
					"id" => $shortname."_footer_text",
					"std" => "© 2012 <a href=\"http://icypixels.com\">Politic by Icy Pixels.</a><br />Powered by <a href=\"http://www.wordpress.org\">Wordpress</a>.",
					"type" => "textarea");

$options[] = array( "name" => __('Tracking Code','framework'),
					"desc" => __('Paste in your Analytics (Google or other) tracking code in here. It will be inserted just before the closing body tag of your theme.','framework'),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");                                                    
					
$options[] = array( "name" => __('FeedBurner URL','framework'),
					"desc" => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere','framework'),
					"id" => $shortname."_feedburner",
					"std" => "",
					"type" => "text");

// Styling Options

$options[] = array( "name" => __('Styling Options','framework'),
					"type" => "heading");
					

$options[] = array( "name" => __('Global Link Color', 'framework'),
					"message" => __('This following section can be used for customising the link color', 'framework'),
					"type" => "note"
					);				

$options[] = array( "name" => __('Link Color - Normal','framework'),
					"desc" => __('Choose a custom colour for your links.','framework'),
					"id" => $shortname."_link_color_normal",
					"std" => "#333",
					"type" => "color");		

$options[] = array( "name" => __('Link Color - Hover','framework'),
					"desc" => __('Choose a custom colour for your links.','framework'),
					"id" => $shortname."_link_color_hover",
					"std" => "#888",
					"type" => "color");		

$options[] = array( "name" => __('Navigation Colors', 'framework'),
					"message" => __('This following section can be used for customising the navigation colors', 'framework'),
					"type" => "note"
					);

$options[] = array( "name" => __('Nav Link Color - Normal','framework'),
					"desc" => __('Choose a custom colour for your navigation link.','framework'),
					"id" => $shortname."_navlink_color_normal",
					"std" => "#fff",
					"type" => "color");							
					
$options[] = array( "name" => __('Nav Link Color - Hover','framework'),
					"desc" => __('Choose a custom colour for your navigation link on hover','framework'),
					"id" => $shortname."_navlink_color_hover",
					"std" => "#e9dbdd",
					"type" => "color");					

$options[] = array( "name" => __('Nav Link Color - Current','framework'),
					"desc" => __('Choose a custom colour for your current navigation link','framework'),
					"id" => $shortname."_navlink_color_current",
					"std" => "#d5b7bb",
					"type" => "color");	

$options[] = array( "name" => __('Custom CSS','framework'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','framework'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");


// Slider Options	

$options[] = array( "name" => __('Slider Options','framework'),
					"type" => "heading");

$options[] = array( "name" => __('Enable Slider','framework'),
					"desc" => __('Check this to enable the slider on the homepage.','framework'),
					"id" => $shortname."_enable_slider",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __('Slider Speed','framework'),
					"desc" => __('Input a slide speed for the slider (e.g. 5000 for 5s ).','framework'),
					"id" => $shortname."_slider_speed",
					"std" => "5000",
					"type" => "text");
										
$options[] = array( "name" => __('Slider Animation', 'framework'),
					"desc" => __('Set a slider animation.', 'framework'),
					"id" => $shortname."_slider_animation",
					"std" => "slide",
					"type" => "select",
					"options" => array(
								"slide" => "slide",
								"fade"	=> "fade"),
					);
					
$options[] = array( "name" => __('Slider Image 1','framework'),
					"desc" => __('Image must be 632px x 291px','framework'),
					"id" => $shortname."_slider_1",
					"std" => "",
					"type" => "upload_min");

$options[] = array( "name" => __('Slider Image 1 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_1",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 1 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_1",
					"std" => "",
					"type" => "text");					
					
$options[] = array( "name" => __('Slider Image 2','framework'),
					"desc" => __('Image must be 632px x 291px','framework'),
					"id" => $shortname."_slider_2",
					"std" => "",
					"type" => "upload_min");
$options[] = array( "name" => __('Slider Image 2 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_2",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 2 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_2",
					"std" => "",
					"type" => "text");										
					
$options[] = array( "name" => __('Slider Image 3','framework'),
					"desc" => __('Image must be 632px x 291px','framework'),
					"id" => $shortname."_slider_3",
					"std" => "",
					"type" => "upload_min");
$options[] = array( "name" => __('Slider Image 3 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_3",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 3 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_3",
					"std" => "",
					"type" => "text");							
					
$options[] = array( "name" => __('Slider Image 4','framework'),
					"desc" => __('Image must be 632px x 291px','framework'),
					"id" => $shortname."_slider_4",
					"std" => "",
					"type" => "upload_min");
$options[] = array( "name" => __('Slider Image 4 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_4",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 4 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_4",
					"std" => "",
					"type" => "text");							
					
$options[] = array( "name" => __('Slider Image 5','framework'),
					"desc" => __('Image must be 632px x 291px','framework'),
					"id" => $shortname."_slider_5",
					"std" => "",
					"type" => "upload_min");

$options[] = array( "name" => __('Slider Image 5 URL','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_slider_url_5",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => __('Slider Image 5 Caption','framework'),
					"desc" => __('Type in a caption that you would like to be displayed at the same time as the slide.','framework'),
					"id" => $shortname."_slider_cap_5",
					"std" => "",
					"type" => "text");


// Social Media

$options[] = array( "name" => __('Social Media','framework'),
                    "type" => "heading");

$options[] = array( "name" => __('Enable RSS icon','framework'),
					"desc" => __('Check this to enable the RSS icon to be displayed.','framework'),
					"id" => $shortname."_enable_rss_icon",
					"std" => "true",
					"type" => "checkbox");					

$options[] = array( "name" => __('Enable FaceBook icon','framework'),
					"desc" => __('Check this to enable the FaceBook icon to be displayed.','framework'),
					"id" => $shortname."_enable_facebook_icon",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => __('FaceBook link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_facebook_link",
					"std" => "http://www.facebook.com/theicythemes",
					"type" => "text");					

$options[] = array( "name" => __('Enable Linkedin icon','framework'),
					"desc" => __('Check this to enable the LinkedIn icon to be displayed.','framework'),
					"id" => $shortname."_enable_linkedin_icon",
					"std" => "true",
					"type" => "checkbox");

$options[] = array( "name" => __('Linkedin link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_linkedin_link",
					"std" => "#",
					"type" => "text");

$options[] = array( "name" => __('Enable Twitter icon','framework'),
					"desc" => __('Check this to enable the Twitter icon to be displayed.','framework'),
					"id" => $shortname."_enable_twitter_icon",
					"std" => "true",
					"type" => "checkbox");			

$options[] = array( "name" => __('Twitter link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_twitter_link",
					"std" => "https://twitter.com/icywebfactory",
					"type" => "text");	
																	
$options[] = array( "name" => __('Enable Dribbble icon','framework'),
					"desc" => __('Check this to enable the dribbble icon to be displayed.','framework'),
					"id" => $shortname."_enable_dribbble_icon",
					"std" => "true",
					"type" => "checkbox");		
					
$options[] = array( "name" => __('Dribbble Link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_dribbble_link",
					"std" => "#",
					"type" => "text");						

$options[] = array( "name" => __('Enable Google+ icon','framework'),
					"desc" => __('Check this to enable the Google+ icon to be displayed.','framework'),
					"id" => $shortname."_enable_googleplus_icon",
					"std" => "true",
					"type" => "checkbox");			
					
$options[] = array( "name" => __('Google+ link','framework'),
					"desc" => __('Choose a link URL for this image.','framework'),
					"id" => $shortname."_googleplus_link",
					"std" => "#",
					"type" => "text");							
// Posts Settings

$options[] = array( "name" => __('Post Options','framework'),
					"type" => "heading");

$options[] = array( "name" => __('Comments Title','framework'),
					"desc" => __('Enter a title to be displayed next to the comments section','framework'),
					"id" => $shortname."_comments_title",
					"std" => "Our readers said:",
					"type" => "text");

$options[] = array( "name" => __('Comments Message','framework'),
					"desc" => __('Enter a message to be displayed next to the comments section','framework'),
					"id" => $shortname."_comments_message",
					"std" => "Write us your thoughts about this post. Be kind & Play nice.",
					"type" => "text");
					

update_option('icy_themename',$themename);   

update_option('icy_shortname',$shortname);

update_option('icy_template',$options); 					  

}
}
?>
