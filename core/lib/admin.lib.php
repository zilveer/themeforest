<?php
/*
	Begin creating admin options
*/

$themename = THEMENAME;
$shortname = SHORTNAME;

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page"
);
foreach ($pages as $page_list ) {
       $wp_pages[$page_list->ID] = $page_list->post_title;
}

$galleries = get_posts(array('parent' => -1, 'post_type' => 'gallery', 'numberposts' => -1));
$wp_galleries = array(
	0		=> "Choose a gallery"
);
foreach ($galleries as $gallery_list ) {
       $wp_galleries[$gallery_list->ID] = $gallery_list->post_title;
}


$pp_handle = opendir(TEMPLATEPATH.'/fonts');
$pp_font_arr = array();

while (false!==($pp_file = readdir($pp_handle))) {
	if ($pp_file != "." && $pp_file != ".." && $pp_file != ".DS_Store") {
		$pp_file_name = basename($pp_file, '.js');
		
		if($pp_file_name != 'Quicksand_300.font')
		{
			$pp_name = $pp_file_name;
		
			$pp_font_arr[$pp_file_name] = $pp_name;
		}
	}
}
closedir($pp_handle);
asort($pp_font_arr);


$options = array (
 
//Begin admin header
array( 
		"name" => $themename." Options",
		"type" => "title"
),
//End admin header
 

//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
)
,

array( "type" => "open"),

array( "name" => "Menu Logo",
	"desc" => "Image logo which shows above of main menu",
	"id" => $shortname."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Enable/disable stretch main menu layout",
	"desc" => "",
	"id" => $shortname."_enable_stretch_menu",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Theme Skins",
	"desc" => "Select theme's skin",
	"id" => $shortname."_skin",
	"type" => "select",
	"options" => array(
		'light' => 'Light',
		'dark' => 'Dark',
	),
	"std" => "ASC"
),
array( "name" => "Enable/disable right click (for image protection)",
	"desc" => "",
	"id" => $shortname."_enable_right_click",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable image dragging (for image protection)",
	"desc" => "",
	"id" => $shortname."_enable_dragging",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Right click alert text (If enable image protection)",
	"desc" => "It will displays this message when user do right click",
	"id" => $shortname."_right_click_text",
	"type" => "text",
	"std" => "Images are copyright by me :)"

),
array( "name" => "Google Analytics Domain ID ",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics Domain ID (something like UA-123456-1)",
	"id" => $shortname."_ga_id",
	"type" => "text",
	"std" => ""

),
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "image",
	"std" => "",
),
	
array( "type" => "close"),
//End first tab "General"

//Begin first tab "Font"
array( 
		"name" => "Font",
		"type" => "section",
		"icon" => "edit.png",
)
,

array( "type" => "open"),

array( "name" => "Header Font",
	"desc" => "Select font for header text",
	"id" => $shortname."_font",
	"type" => "font",
	"options" => $pp_font_arr,
	"std" => ""
),
array( "name" => "Page Font size (in pixels)",
	"desc" => "Select font for normal text",
	"id" => $shortname."_page_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 11,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Page header font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_page_header_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "120",
	"from" => 20,
	"to" => 120,
	"step" => 1,
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "32",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "Menu font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 13,
	"to" => 24,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Font"


//Begin second tab "Homepage"
array( 	"name" => "Homepage",
		"type" => "section",
		"icon" => "home.png",
),
array( "type" => "open"),

array( "name" => "Choose Homepage Gallery",
	"desc" => "",
	"id" => $shortname."_homepage_slideshow_cat",
	"type" => "select",
	"options" => $wp_galleries,
	"std" => ""
),
array( "name" => "Homepage slideshow style",
	"desc" => "Select style for contents in homepage slideshow",
	"id" => $shortname."_homepage_slideshow_style",
	"type" => "select",
	"options" => array(
		'flow' => 'Flow',
		'fullscreen' => 'Fullscreen',
		'kenburns' => 'KenBurns',
		'youtube_video' => 'Youtube Video Background',
	),
	"std" => "ASC"
),array( "name" => "Homepage Youtube Video ID (if select Youtube Video Background style)",
	"desc" => "For example: iIyfibIBpnM",
	"id" => $shortname."_homepage_youtube_video_id",
	"type" => "text",
	"std" => "iIyfibIBpnM"
),

array( "type" => "close"),
//End second tab "Homepage"

//Begin fifth tab "Music"
array( 	"name" => "Music",
		"type" => "section",
		"icon" => "music-beam-16.png",
),
array( "type" => "open"),
	
array( "name" => "Homepage Background Music .mp3 file",
	"desc" => "<strong>MP3 format for Older browsers</strong><br/><a href=\"http://www.google.co.th/search?q=mp3+format&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_mp3",
	"type" => "music",
	"std" => "",
),
array( "name" => "Homepage Background Music .m4a file",
	"desc" => "<strong>M4A format for Chrome, Safari</strong><br/><a href=\"http://www.google.co.th/search?q=m4a+format&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_m4a",
	"type" => "music",
	"std" => "",
),
array( "name" => "Homepage Background Music .ogg file",
	"desc" => "<strong>OGG media for Firefox, Opera</strong><br/><a href=\"http://www.google.co.th/search?q=ogg+media&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_ogg",
	"type" => "music",
	"std" => "",
),
array( "name" => "Auto play Background Music",
	"desc" => "",
	"id" => $shortname."_homepage_music_play",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "type" => "close"),
//End fifth tab "Music"


//Begin second tab "Portfolios"
array( 	"name" => "Blog-Portfolio",
		"type" => "section",
		"icon" => "folder-open-image.png",
),
array( "type" => "open"),

array( "name" => "<h2>Gallery Layout Settings</h2>Gallery styles",
	"desc" => "Select the layout style for the gallery",
	"id" => $shortname."_portfolio_style",
	"type" => "select",
	"options" => array(
		't' => 'Thumbnails',
		'2' => '2 Columns',
		'3' => '3 Columns',
		'4' => '4 Columns',
		'flow' => 'Image Flow',
	),
	"std" => 1
),
array( "name" => "<h2>Fullscreen Slideshow Settings</h2>Homepage Slideshow timer ",
	"desc" => "Enter number of seconds for Homepage Slideshow timer",
	"id" => $shortname."_homepage_slideshow_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Homepage Gallery Transition Effect ",
	"desc" => "Select transition type for contents in homepage slideshow (If you select homepage style as Full Screen Slideshow)",
	"id" => $shortname."_homepage_slideshow_trans",
	"type" => "select",
	"options" => array(
		1 => 'Fade',
		2 => 'Slide Top',
		3 => 'Slide Right',
		4 => 'Slide Bottom',
		5 => 'Slide Left',
		6 => 'Carousel Right',
		7 => 'Carousel Left',
	),
	"std" => "Fade"
),
array( "name" => "Enable/disable auto fit image to screen ",
	"desc" => "(If you select homepage style as Full Screen Slideshow)",
	"id" => $shortname."_enable_fit_image",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable main menu and footer auto hiding ",
	"desc" => "(If you select homepage style as Full Screen Slideshow)",
	"id" => $shortname."_enable_menu_hide",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Other Gallery Settings</h2>Display full blog post content on blog page",
	"desc" => "",
	"id" => $shortname."_blog_full_post",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display image title in lightbox",
	"desc" => "",
	"id" => $shortname."_display_image_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable Flow gallery scroll bar",
	"desc" => "",
	"id" => $shortname."_flow_scroll_bar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable image reflection (for image flow)",
	"desc" => "",
	"id" => $shortname."_enable_reflection",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable Autostart (if select Flow style)",
	"desc" => "If you enable this feature, please make sure you have more than 3 images in each gallery",
	"id" => $shortname."_auto_start",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enbale Social share buttons",
	"desc" => "",
	"id" => $shortname."_blog_display_social",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Portfolios"


//Begin second tab "Sidebar"
array( "name" => "Sidebar",
		"type" => "section",
		"icon" => "application-sidebar-expand.png",	
),
array( "type" => "open"),

array( "name" => "Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => $shortname."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Sidebar"


//Begin fourth tab "Contact"
array( 	"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
),
array( "type" => "open"),
	

array( "name" => "Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""

),
array( "name" => "Thank you message",
	"desc" => "Enter message display once form submitted",
	"id" => $shortname."_contact_thankyou",
	"type" => "text",
	"std" => "Thank you! We will get back to you as soon as possible"
),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => $shortname."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),
array( "name" => "Enable/disable Captcha",
	"desc" => "",
	"id" => $shortname."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1
),
//End fourth tab "Contact"

//Begin fifth tab "Social Profiles"
array( "type" => "close"),
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "Facebook Profile ID",
	"desc" => "",
	"id" => $shortname."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => $shortname."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Pinterest Username",
	"desc" => "",
	"id" => $shortname."_pinterest_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Instagram Username",
	"desc" => "",
	"id" => $shortname."_instagram_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => $shortname."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "",
	"id" => $shortname."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => $shortname."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin Profile URL",
	"desc" => "",
	"id" => $shortname."_linkedin_url",
	"type" => "text",
	"std" => ""
),
//End fifth tab "Social Profiles"

//Begin fifth tab "Footer"
array( "type" => "close"),
array( 	"name" => "Footer",
		"type" => "section",
		"icon" => "layout-select-footer.png",
),
array( "type" => "open"),
	
array( "name" => "Footer text",
	"desc" => "Enter footer text ex. copyright description",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""

),
//End fifth tab "Footer"

 
array( "type" => "close")
 
);
?>