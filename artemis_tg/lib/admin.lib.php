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

array( "name" => "<h2>Website Identity</h2>Logo",
	"desc" => "Image logo which shows above of main menu",
	"id" => $shortname."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Logo Margin left (in pixels)",
	"desc" => "",
	"id" => $shortname."_logo_margin_left",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Logo Margin right (in pixels)",
	"desc" => "",
	"id" => $shortname."_logo_margin_right",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Logo Margin top (in pixels)",
	"desc" => "",
	"id" => $shortname."_logo_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "image",
	"std" => "",
),
array( "name" => "<h2>Global Image Settings</h2>Enable/disable right click (for image protection)",
	"desc" => "",
	"id" => $shortname."_enable_right_click",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Right click alert text (If enable image protection)",
	"desc" => "It will displays this message when user do right click",
	"id" => $shortname."_right_click_text",
	"type" => "text",
	"std" => "Images are copyright by me :)"
),
array( "name" => "<h2>Advanced Settings</h2>Google Analytics Domain ID ",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics code",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Enable/disable responsive layout",
	"desc" => "",
	"id" => $shortname."_enable_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "General"

//Begin first tab "General"
array( 
		"name" => "Skins",
		"type" => "section",
		"icon" => "color-swatch.png",
),

array( "type" => "open"),

array( "name" => "Save current settings as Skin",
	"desc" => "Skin manager helps you save all settings (except homepage, contact fields and advanced settings) to a skin so you can easily enable it later. Below are your current available skins.",
	"id" => $shortname."_skin",
	"type" => "skin",
	"std" => ""
),
	
array( "type" => "close"),
//End first tab "Skins"

//Begin first tab "Font"
array( 
		"name" => "Font",
		"type" => "section",
		"icon" => "edit.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Header Font Settings</h2>Header Font (using Google Webfonts API)",
	"desc" => "Select font style your header",
	"id" => $shortname."_font",
	"type" => "font",
	"std" => ''
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
array( "name" => "<h2>Main Menu Font Settings</h2>Menu font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 11,
	"to" => 30,
	"step" => 1,
),
array( "name" => "Sub Menu font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Enable/Disable Menu font lowercase",
	"desc" => "",
	"id" => $shortname."_menu_lower",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "Font"


//Begin first tab "Colors"
array( 
		"name" => "Colors",
		"type" => "section",
		"icon" => "color.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Global Colors Settings</h2>Font Color",
	"desc" => "Select color for the font (default #cccccc)",
	"id" => $shortname."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

array( "name" => "Page Frame Background Color",
	"desc" => "Select color for page background frame (default #ffffff)",
	"id" => $shortname."_frame_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Content Background Color",
	"desc" => "Select color for content background (default #000000)",
	"id" => $shortname."_content_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Content Background Opacity",
	"desc" => "Select opacity value for content background (default 80%)",
	"id" => $shortname."_content_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "80",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Link Color",
	"desc" => "Select color for the link (default #ffffff)",
	"id" => $shortname."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Hover Link Color",
	"desc" => "Select color for the hover background color (default #999999)",
	"id" => $shortname."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "H1, H2, H3, H4, H5, H6 Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6 (default #ffffff)",
	"id" => $shortname."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Background Color",
	"desc" => "Select color for the button background (default #ffffff)",
	"id" => $shortname."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font (default #000000)",
	"id" => $shortname."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border (default #000000)",
	"id" => $shortname."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "<h2>Main Menu Colors Settings</h2>Menu Font Color",
	"desc" => "Select color for menu font (default #666666)",
	"id" => $shortname."_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#666666"
),

array( "name" => "Active Menu Font Color",
	"desc" => "Select color for active menu font (default #000000)",
	"id" => $shortname."_active_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),


array( "type" => "close"),
//End first tab "Colors"


//Begin fifth tab "Music"
array( 	"name" => "Music",
		"type" => "section",
		"icon" => "music-beam-16.png",
),
array( "type" => "open"),
	
array( "name" => "Background Music .mp3 file ",
	"desc" => "<strong>MP3 format for Older browsers</strong><br/><a href=\"http://www.google.co.th/search?q=mp3+format&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_mp3",
	"type" => "music",
	"std" => "",
),
array( "name" => "Background Music .m4a file ",
	"desc" => "<strong>M4A format for Chrome, Safari</strong><br/><a href=\"http://www.google.co.th/search?q=m4a+format&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_m4a",
	"type" => "music",
	"std" => "",
),
array( "name" => "Background Music .ogg file ",
	"desc" => "<strong>OGG media for Firefox, Opera</strong><br/><a href=\"http://www.google.co.th/search?q=ogg+media&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_ogg",
	"type" => "music",
	"std" => "",
),
array( "name" => "Auto play Background Music ",
	"desc" => "",
	"id" => $shortname."_homepage_music_play",
	"type" => "iphone_checkboxes",
	"std" => 1
),
//End fifth tab "Music"

 
array( "type" => "close"),


//Begin second tab "Homepage"
array( 	"name" => "Homepage",
		"type" => "section",
		"icon" => "home.png",
),
array( "type" => "open"),

array( "name" => "<h2>Content Settings</h2>Homepage styles",
	"desc" => "Select the style for homepage",
	"id" => $shortname."_homepage_style",
	"type" => "select",
	"options" => array(
		'kenburns' => 'Kenburns Slideshow',
		'f' => 'Full Screen Slideshow',
		'flip' => 'Flip Slideshow',
		'flow' => 'Image Flow Slideshow',
		'static' => 'Static Image',
	),
	"std" => 1
),
array( "name" => "Choose Homepage Gallery",
	"desc" => "",
	"id" => $shortname."_homepage_slideshow_cat",
	"type" => "select",
	"options" => $wp_galleries,
	"std" => ""
),
array( "name" => "<h2>Slideshow Settings</h2>Homepage Slideshow timer ",
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
array( "name" => "<h2>Background Image Settings</h2>Hompage Background Image",
	"desc" => "Select image for homepage background (if select Static Image style)",
	"id" => $shortname."_homepage_bg",
	"type" => "image",
	"size" => "290px",
),

array( "type" => "close"),
//End second tab "Homepage"


//Begin second tab "Portfolios"
array( 	"name" => "Gallery-Portfolio",
		"type" => "section",
		"icon" => "folder-open-image.png",
),
array( "type" => "open"),

array( "name" => "<h2>Full Screen Slideshow Settings</h2>Full Screen Slideshow timer",
	"desc" => "Enter number of seconds for Full Screen Slideshow timer (if select Full Screen template)",
	"id" => $shortname."_portfolio_slideshow_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Full Screen Slideshow Transition Effect",
	"desc" => "Select transition type for contents in Full Screen slideshow (if select Full Screen template)",
	"id" => $shortname."_portfolio_slideshow_trans",
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
array( "name" => "Enable/disable auto fit image to screen",
	"desc" => "(if select Full Screen template)",
	"id" => $shortname."_portfolio_enable_fit_image",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable gallery title and description",
	"desc" => "",
	"id" => $shortname."_portfolio_enable_gallery_info",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable image title",
	"desc" => "",
	"id" => $shortname."_portfolio_enable_slideshow_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable image reflection",
	"desc" => "(if select image flow template)",
	"id" => $shortname."_enable_reflection",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Other Settings</h2>Enable/disable social media sharing",
	"desc" => "",
	"id" => $shortname."_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Portfolio Set pages Background Image",
	"desc" => "Select image for portfolio set page background (Recommended size 1440x900 pixels)",
	"id" => $shortname."_set_bg",
	"type" => "image",
	"size" => "290px",
),


array( "type" => "close"),
//End second tab "Portfolios"


array( 	"name" => "Blog",
		"type" => "section",
		"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "<h2>Other Settings</h2>Display full blog post content on blog page",
	"desc" => "",
	"id" => $shortname."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Archive, Category, Search, Tag pages Background Image",
	"desc" => "Select image for blog background (Recommended size 1440x900 pixels)",
	"id" => $shortname."_blog_bg",
	"type" => "image",
	"size" => "290px",
),


array( "type" => "close"),


//Begin second tab "Sidebar"
array( 	"name" => "Sidebar",
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
/*array( "name" => "<h2>Captcha Settings</h2>Enable/disable Captcha",
	"desc" => "",
	"id" => $shortname."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1
),*/

//End fourth tab "Contact"

//Begin fifth tab "Social Profiles"
array( "type" => "close"),
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook Profile ID",
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
array( "name" => "Google Plus URL",
	"desc" => "",
	"id" => $shortname."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => $shortname."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Username",
	"desc" => "",
	"id" => $shortname."_youtube_username",
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
array( "name" => "Digg Username",
	"desc" => "",
	"id" => $shortname."_digg_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "",
	"id" => $shortname."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "",
	"id" => $shortname."_linkedin_username",
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
array( "name" => "Enable/disable Social profiles on footer",
	"desc" => "",
	"id" => $shortname."_footer_social",
	"type" => "iphone_checkboxes",
	"std" => 1
),
//End fifth tab "Footer"

 
array( "type" => "close")
 
);
?>