<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//Theme Shortname
$themename = "launch";
$shortname = "launch";


//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');


//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:"); 


//Access the WordPress Categories via an Array
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");


//Sample Array for demo purposes
$sample_array = array("1","2","3","4","5");


//Sample Advanced Array - The actual value differs from what the user sees
$sample_advanced_array = array("image" => "The Image","post" => "The Post"); 


//Folder Paths for "type" => "images"
$sampleurl =  get_template_directory_uri() . '/admin/images/sample-layouts/';




/*-----------------------------------------------------------------------------------*/
/* Create The Custom Theme Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall



/* Option Page 1 - Header Options */
$options[] = array( "name" => __('Header','framework'),
			"type" => "heading");
			

$options[] = array( "name" => __('Logo','framework'),
			"desc" => __('Upload a custom logo for your Website.','framework'),
			"id" => $shortname."_sitelogo",
			"std" => "",
			"type" => "upload");
			
			
$options[] = array( "name" => __('Favicon','framework'),
			"desc" => __('Upload a 16px x 16px PNG image that will represent your website\'s favicon.','framework','framework'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Tagline','framework'),
			"desc" => __("Tagline text will appear infront of your logo.",'framework'),
			"id" => $shortname."_tagline",
			"std" => "",
			"type" => "text");		

$options[] = array( "name" => __('Twitter Icon URL','framework'),
			"desc" => __("Enter the URL that will appear under twitter icon in header.",'framework'),
			"id" => $shortname."_twitter_url",
			"std" => "#",
			"type" => "text");					

$options[] = array( "name" => __('Facebook Icon URL','framework'),
			"desc" => __("Enter the URL that will appear under facebook icon in header.",'framework'),
			"id" => $shortname."_facebook_url",
			"std" => "#",
			"type" => "text");

$options[] = array( "name" => __('Google Plus Icon URL','framework'),
    "desc" => __("Enter the URL that will appear under google Plus icon in header.",'framework'),
    "id" => $shortname."_google_url",
    "std" => "#",
    "type" => "text");

$options[] = array( "name" => __('Youtube Icon URL','framework'),
    "desc" => __("Enter the URL that will appear under Youtube icon in header.",'framework'),
    "id" => $shortname."_youtube_url",
    "std" => "#",
    "type" => "text");

$options[] = array( "name" => __('Flickr Icon URL','framework'),
			"desc" => __("Enter the URL that will appear under flickr icon in header.",'framework'),
			"id" => $shortname."_flickr_url",
			"std" => "#",
			"type" => "text");

$options[] = array( "name" => __('Linkedin URL','framework'),
    "desc" => __("Enter the URL that will appear under Linkedin icon in header.",'framework'),
    "id" => $shortname."_inkedin_url",
    "std" => "#",
    "type" => "text");

$options[] = array( "name" => __('RSS Icon URL','framework'),
			"desc" => __("Enter the URL that will appear under RSS icon in header.",'framework'),
			"id" => $shortname."_rss_url",
			"std" => "#",
			"type" => "text");
																		   
$options[] = array( "name" => __('Tracking Code','framework'),
			"desc" => __('Paste Google Analytics (or other) tracking code here.','framework'),
			"id" => $shortname."_google_analytics",
			"std" => "",
			"type" => "textarea");


/* Option Page 2 - Timer Options */
$options[] = array( "name" => __('Timer','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Show Timer','framework'),
			"desc" => __('Yes','framework'),
			"id" => $shortname."_show_timer",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Timer Target Date','framework'),
			"desc" => __("Enter the target date for timer. <br> Date should be in following format '2014,7,20' (year,month,day).",'framework'),
			"id" => $shortname."_date",
			"std" => "2015,7,20",
			"type" => "text");	

/* Option Page 3 - Launch Info */
$options[] = array( "name" => __('Launch Info','framework'),
			"type" => "heading");
			
$options[] = array( "name" => __('Launch Info Heading','framework'),
			"desc" => __("Enter Launch Info Heading Text.",'framework'),
			"id" => $shortname."_info_heading",
			"std" => "We are Launching A <span>Nice &amp; Cool</span> Site Soon!",
			"type" => "text");

$options[] = array( "name" => __('Launch Info Text','framework'),
			"desc" => __('Text to display below Launch Info Heading.','framework'),
			"id" => $shortname."_info_text",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Simple Subscribe','framework'),
    "desc" => __('show Simple Subscribe form.','framework'),
    "id" => $shortname."_show_subscribe",
    "std" => "true",
    "type" => "checkbox");



    /* Option Page 4 - Twitter */
$options[] = array( "name" => __('Twitter Feed','framework'),
			"type" => "heading");

$options[] = array( "name" => __('Twitter Section Heading','framework'),
			"desc" => __("Enter Twitter Section Heading Text.",'framework'),
			"id" => $shortname."_twitter_heading",
			"std" => "<span>Tweets</span> FROM <span>envato</span>",
			"type" => "text");
						

/* Option Page 5 - News and Updates */
$options[] = array( "name" => __('News and Updates','framework'),
			"type" => "heading");
			
$options[] = array( "name" => __('News and Updates Heading','framework'),
			"desc" => __("Enter News and Updates Section Heading Text.",'framework'),
			"id" => $shortname."_news_title",
			"std" => "LATEST <span>NEWS &amp; UPDATES</span>",
			"type" => "text");

/* Option Page 6 - Contact Us */
$options[] = array( "name" => __('Contact Us','framework'),
			"type" => "heading");
			
$options[] = array( "name" => __('Contact Us Heading','framework'),
			"desc" => __("Enter Contact Us Section Heading Text.",'framework'),
			"id" => $shortname."_contact_title",
			"std" => "FEEL FREE TO <span>CONTACT US</span>",
			"type" => "text" );	

$options[] = array( "name" => __('Company Name','framework'),
			"desc" => __("Enter Your Company Name.",'framework'),
			"id" => $shortname."_company_name",
			"std" => "Envato",
			"type" => "text" );	

$options[] = array( "name" => __('Address','framework'),
			"desc" => __("Enter Your Address Text.",'framework'),
			"id" => $shortname."_address",
			"std" => "",
			"type" => "textarea" );					

$options[] = array( "name" => __('Email for display and contact form','framework'),
			"desc" => __("Enter your email address. This email will be displayed on contact us section and contact form messages will be sent to you on this email address.",'framework'),
			"id" => $shortname."_contact_email",
			"std" => "info@yourdomain.com",
			"type" => "text" );	

$options[] = array( "name" => __('Phone','framework'),
			"desc" => __("Enter Your Phone Number.",'framework'),
			"id" => $shortname."_phone",
			"std" => "",
			"type" => "text" );	

/* Option Page 7 - Footer */
$options[] = array( "name" => __('Footer','framework'),
			"type" => "heading");
			
$options[] = array( "name" => __('Copyright Text','framework'),
			"desc" => __("Enter Footer Copyright Text here.",'framework'),
			"id" => $shortname."_copyright_text",
			"std" => "&copy; 2012",
			"type" => "text");
																											

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>