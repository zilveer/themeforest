<?php

/*
	Get categories
*/
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}


/*
	Begin pages
*/
$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page",
);
foreach ($pages as $page_list ) {
	$template_name = get_post_meta( $page_list->ID, '_wp_page_template', true );
	
	//exclude contact template
	if($template_name != 'contact.php')
	{
       $wp_pages[$page_list->ID] = $page_list->post_title;
    }
}


/*
	Begin creating admin options
*/

$options = array (
 
//Begin admin header
array( 
		"name" => THEMENAME." Options",
		"type" => "title"
),
//End admin header
 

//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
),

array( "type" => "open"),

array( "name" => "Your Logo (Image URL)",
	"desc" => "Enter the URL of image that you want to use as the logo",
	"id" => SHORTNAME."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site",
	"id" => SHORTNAME."_favicon2",
	"type" => "image",
	"std" => "",
),
array( "name" => "Google Analytics Domain ID ",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics Domain ID (something like UA-123456-1)",
	"id" => SHORTNAME."_ga_id",
	"type" => "text",
	"std" => ""

),
array( "name" => "Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Enable style switcher",
	"desc" => "Display style switcher like you saw on live demo site",
	"id" => SHORTNAME."_advance_enable_switcher",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "General"


//Begin fifth tab "Advertisement"
array( 
	"name" => "Advertisement",
	"type" => "section",
	"icon" => "ads.png",
),
array( "type" => "open"),
	
array( "name" => "468x60 Top Banner Code",
	"desc" => "",
	"id" => SHORTNAME."_top_banner",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "125x125 Sidebar Banner Code",
	"desc" => "",
	"id" => SHORTNAME."_side_banner",
	"type" => "textarea",
	"std" => ""

),

array( "type" => "close"),
//End fifth tab "Advertisement"


//Begin first tab "Colors"
array( 
		"name" => "Menu-Colors",
		"type" => "section",
		"icon" => "color.png",
)
,

array( "type" => "open"),

array( "name" => "Menu Style",
	"desc" => "",
	"id" => SHORTNAME."_menu_style",
	"type" => "radio",
	"options" => array(
		1 => '<div style="float:left;width:230px;height:142px;"><img class="border" src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/menu1.png"/></div>',
		2 => '<div style="float:left;width:230px;height:142px;"><img class="border" src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/menu2.png"/></div>',
		3 => '<div style="float:left;width:230px;height:142px;"><img class="border" src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/menu3.png"/></div>',
		4 => '<div style="float:left;width:230px;height:142px;"><img class="border" src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/menu4.png"/></div>',
		5 => '<div style="float:left;width:230px;height:142px;"><img class="border" src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/menu5.png"/></div>',
		6 => '<div style="float:left;width:230px;height:142px;"><img class="border" src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/menu6.png"/></div>',
	),
),

array( "name" => "Skin Color",
	"desc" => "Select color for theme skin (default #E16020)",
	"id" => SHORTNAME."_skin",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E16020"

),

array( "type" => "close"),
//End first tab "Colors"


//Begin second tab "Homepage"
array( 
	"name" => "Homepage",
	"type" => "section",
	"icon" => "home.png",
),
array( "type" => "open"),

array( "name" => "Homepage featured posts category",
	"desc" => "Choose a category from which contents in featured posts are drawn",
	"id" => SHORTNAME."_featured_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"
),
array( "name" => "Select Slider transition",
	"desc" => "Select slider's transition",
	"id" => SHORTNAME."_homepage_slider_trans",
	"type" => "select",
	"options" => array(
		'sliceDown' => 'Slide down Effect',
		'fade' => 'Fade Effect',
		'fold' => 'Fold Effect',
	),
	"std" => 'fade'
),
array( "name" => "Slider timer (in second)",
	"desc" => "Enter number of seconds for slider timer",
	"id" => SHORTNAME."_slider_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "type" => "close"),
//End second tab "Homepage"


//Begin second tab "Blog"
array( 
	"name" => "Blog",
	"type" => "section",
	"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "Select page layout ",
	"desc" => "",
	"id" => SHORTNAME."_blog_layout",
	"type" => "select",
	"options" => array(
		1 => '1 Column',
		2 => '2 Columns',
	),
	"std" => 'fade'
),
array( "name" => "Enbale/disable Social share buttons",
	"desc" => "",
	"id" => SHORTNAME."_blog_display_social",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Show About author module",
	"desc" => "Select display about the author in single blog page ",
	"id" => SHORTNAME."_blog_display_author",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Show Related posts module",
	"desc" => "Select display related posts in single blog page ",
	"id" => SHORTNAME."_blog_display_related",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display full post content on list page",
	"desc" => "",
	"id" => SHORTNAME."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "type" => "close"),
//End second tab "Blog"

//Begin fifth tab "Social Profiles"
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "Facebook Page URL",
	"desc" => "",
	"id" => SHORTNAME."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Username",
	"desc" => "",
	"id" => SHORTNAME."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => ""
),

array( "name" => "Twitter Consumer Key",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_key",
	"type" => "text",
	"std" => ""
),

array( "name" => "Twitter Consumer Secret",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_secret",
	"type" => "text",
	"std" => ""
),

array( "name" => "Twitter Access Token",
	"desc" => "",
	"id" => SHORTNAME."_twitter_access_token",
	"type" => "text",
	"std" => ""
),

array( "name" => "Twitter Access Token Secret",
	"desc" => "",
	"id" => SHORTNAME."_twitter_access_token_secret",
	"type" => "text",
	"std" => ""
),

array( "type" => "close"),
//End fifth tab "Social Profiles"


//Begin second tab "Sidebar"
array( 
	"name" => "Sidebar",
	"type" => "section",
	"icon" => "application-sidebar-expand.png",
),
array( "type" => "open"),

array( "name" => "Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => SHORTNAME."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Sidebar"


//Begin fourth tab "Contact"
array( 
	"name" => "Contact",
	"type" => "section",
	"icon" => "mail-receive.png",	
),
array( "type" => "open"),
	
array( "name" => "Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => SHORTNAME."_contact_email",
	"type" => "text",
	"std" => ""
),
array( "name" => "Thank you message",
	"desc" => "Enter message display once form submitted",
	"id" => SHORTNAME."_contact_thankyou",
	"type" => "text",
	"std" => "Thank you! We will get back to you as soon as possible"
),
//End fourth tab "Contact"


//Begin fifth tab "Footer"
array( "type" => "close"),

array( 
	"name" => "Footer",
	"type" => "section",
	"icon" => "layout-select-footer.png",
),
array( "type" => "open"),
	
array( "name" => "Footer text",
	"desc" => "Enter footer text ex. copyright description",
	"id" => SHORTNAME."_footer_text",
	"type" => "textarea",
	"std" => ""

),
//End fifth tab "Footer"

 
array( "type" => "close")
 
);
?>