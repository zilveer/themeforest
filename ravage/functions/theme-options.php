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

// image links to options
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
				
$options[] = array( "name" => __('Custom Logo','framework'),
					"desc" => __('Upload a logo to your theme, or specify the image address of your online logo. (http://example.com/logo.png)','framework'),
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");					

$options[] = array( "name" => __('Footer Copy','framework'),
					"desc" => __('Enter the text you would like to display in the footer of your site.','framework'),
					"id" => $shortname."_footer_text",
					"std" => "© 2012 <a href=\"http://icypixels.com\">Icy Pixels.</a> Designed with love, coded with care.",
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

$url = ICY_DIRECTORY . '/admin/images/';
$options[] = array( "name" => __('Sidebar Position','framework'),
					"desc" => __('Select sidebar alignment.','framework'),
					"id" => $shortname."_sidebar_position",
					"std" => "sidebar-right",
					"type" => "images",
					"options" => array(
						'sidebar-right' => $url . '2cr.png',
						'sidebar-left' => $url . '2cl.png')
					);

$options[] = array( "name" => __('Custom Highlight Color','framework'),
                    "desc" => __('Set the highlight color of your website.','framework'),
                    "id" => $shortname."_highlight_color",
                    "std" => "#c0a127",
                    "type" => "color");

$options[] = array( "name" => __('Custom CSS','framework'),
                    "desc" => __('Quickly add some CSS to your theme by adding it to this block.','framework'),
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

// Posts Settings

$options[] = array( "name" => __('Comments Text','framework'),
					"type" => "heading");

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
