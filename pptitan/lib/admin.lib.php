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

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

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
array( "name" => "Retina Logo",
	"desc" => "Retina Ready Image logo. It should be 2x size of normal logo",
	"id" => $shortname."_retina_logo",
	"type" => "image",
	"std" => "",
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
array( "name" => "Enable/disable image dragging (for image protection)",
	"desc" => "",
	"id" => $shortname."_enable_dragging",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Advanced Settings</h2>Google Analytics Code",
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

//Begin first tab "Typography"
array( 
		"name" => "Typography",
		"type" => "section",
		"icon" => "text_dropcaps.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Header Font Settings</h2>Header Font (using Google Webfonts API)",
	"desc" => "Select font style your header",
	"id" => $shortname."_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Main Content Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_body_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 11,
	"to" => 20,
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
array( "name" => "<h2>Main Menu Font Settings</h2>Menu font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 11,
	"to" => 24,
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
array( "name" => "Make Menu font lowercase",
	"desc" => "",
	"id" => $shortname."_menu_lower",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Page Content Font Settings</h2>Page Header font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_page_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "30",
	"from" => 16,
	"to" => 60,
	"step" => 1,
),
array( "name" => "<h2>Gallery Font Settings</h2>Fullscreen Image Title font size (in pixels)",
	"desc" => "",
	"id" => $shortname."_image_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 16,
	"to" => 30,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Typography"


//Begin second tab "Google Web Fonts"
array( "name" => "Google-Fonts",
	"type" => "section",
	"icon" => "ggwebfont.png",
),

array( "type" => "open"),

array( "name" => "<h2>Google Web Fonts Settings</h2>You can add additional Google Web Font.",
	"desc" => "Enter font name ex. Courgette <a href=\"http://www.google.com/webfonts\">Checkout Google Web Font Directory</a>",
	"id" => $shortname."_ggfont0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Google Web Fonts"


//Begin first tab "Styling"
array( 
		"name" => "Styling",
		"type" => "section",
		"icon" => "palette.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Page Content Colors Settings</h2>Page Content Background Color",
	"desc" => "Select background color style for main content",
	"id" => $shortname."_content_bg_color",
	"type" => "select",
	"options" => array(
		'dark' => 'Dark',
		'light' => 'Light',
	),
	"std" => 1
),
array( "name" => "Font Color",
	"desc" => "Select color for the font",
	"id" => $shortname."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ebebeb"
),
array( "name" => "Page Content Link Color",
	"desc" => "Select color for the link",
	"id" => $shortname."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Page Content Hover Link Color",
	"desc" => "Select color for the hover background color",
	"id" => $shortname."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "H1, H2, H3, H4, H5, H6 Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6",
	"id" => $shortname."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Sidebar Content Colors Settings</h2>Sidebar Font Color",
	"desc" => "Select color for the font in sidebar",
	"id" => $shortname."_sidebar_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Sidebar Link Color",
	"desc" => "Select color for the link in sidebar",
	"id" => $shortname."_sidebar_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

array( "name" => "Sidebar Hover Link Color",
	"desc" => "Select color for the hover font in sidebar",
	"id" => $shortname."_sidebar_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ff0000"
),

array( "name" => "<h2>Footer Content Colors Settings</h2>Footer Font Color",
	"desc" => "Select color for the font in footer",
	"id" => $shortname."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Footer Link Color",
	"desc" => "Select color for the link in footer",
	"id" => $shortname."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

array( "name" => "Footer Hover Link Color",
	"desc" => "Select color for the hover font in footer",
	"id" => $shortname."_footer_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ff0000"
),

array( "name" => "<h2>Main Menu Colors Settings</h2>Menu Font Color",
	"desc" => "Select color for menu font",
	"id" => $shortname."_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Hover Font Color",
	"desc" => "Select color for menu font in hover state",
	"id" => $shortname."_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "Menu Active Font Color",
	"desc" => "Select color for menu font in active state",
	"id" => $shortname."_menu_active_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "Menu Background Color",
	"desc" => "Select color for menu background",
	"id" => $shortname."_menu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu and Sub Menu Background Opacity",
	"desc" => "Select opacity value for main menu background",
	"id" => $shortname."_menu_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "100",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Sub Menu Font Color",
	"desc" => "Select color for submenu font",
	"id" => $shortname."_submenu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Hover Font Color",
	"desc" => "Select color for menu font in hover state",
	"id" => $shortname."_submenu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Sub Menu Background Color",
	"desc" => "Select color for sub menu background",
	"id" => $shortname."_submenu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Border Color",
	"desc" => "Select color for sub menu border",
	"id" => $shortname."_submenu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ebebeb"
),

array( "name" => "<h2>Portfolios Colors Settings</h2>Portfolios Hover Background Color",
	"desc" => "Select color for the portfolio item background in hover state",
	"id" => $shortname."_portfolio_hover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ff0000"
),

array( "name" => "Portfolios Hover Font Color",
	"desc" => "Select font color for the portfolio item in hover state",
	"id" => $shortname."_portfolio_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Button Colors Settings</h2>Button Background Color",
	"desc" => "Select color for the button background",
	"id" => $shortname."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font",
	"id" => $shortname."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border",
	"id" => $shortname."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#fff200"
),


array( "type" => "close"),
//End first tab "Styling"


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
		'fullscreen' => 'Fullscreen Slideshow',
		'kenburns' => 'Kenburns',
		'wall' => 'Photo Wall Gallery',
		'flip' => 'Flip Gallery',
		'flow' => 'Flow Gallery',
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
array( "name" => "Background Music .mp3 file ",
	"desc" => "<strong>MP3 format for Older browsers</strong><br/><a href=\"http://www.google.co.th/search?q=mp3+format&ie=utf-8&oe=utf-8&aq=t&rls=org.mozilla:en-US:official&client=firefox-a\">More info</a>",
	"id" => $shortname."_homepage_music_mp3",
	"type" => "music",
	"std" => "",
),
array( "name" => "<h2>Static Background Image Settings</h2>Hompage Background Image",
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

array( "name" => "<h2>Gallery Settings</h2>Gallery Images Sorting",
	"desc" => "Select how you want to sort gallery images",
	"id" => $shortname."_gallery_sort",
	"type" => "select",
	"options" => array(
		'' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	),
	"std" => ""
),

array( "name" => "<h2>Full Screen Slideshow Settings</h2>Enable/disable autoplay",
	"desc" => "Slideshow starts playing automatically(If you select homepage style as Full Screen Slideshow)",
	"id" => $shortname."_portfolio_autoplay",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Full Screen Slideshow timer",
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
array( "name" => "Enable/disable image cropping to screen resolution",
	"desc" => "(If you select homepage style as Full Screen Slideshow)",
	"id" => $shortname."_enable_fit_image",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable image title and description",
	"desc" => "",
	"id" => $shortname."_portfolio_enable_slideshow_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Image Flow Slideshow Settings</h2>Enable/disable image reflection",
	"desc" => "(if select image flow template)",
	"id" => $shortname."_enable_reflection",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable scrollbar in Flow Gallery",
	"desc" => "",
	"id" => $shortname."_flow_enable_flow_scroll",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Sharing Settings</h2>Enable/disable social media sharing",
	"desc" => "",
	"id" => $shortname."_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Portfolio Set Settings</h2>Portfolio Set Templates",
	"desc" => "Select page template for displaying portfolio set contents",
	"id" => $shortname."_set_page_template",
	"type" => "select",
	"options" => array(
		'2' => 'Page 2 Columns',
		'3' => 'Page 3 Columns',
		'4' => 'Page 4 Columns',
	),
	"std" => 1
),
array( "name" => "Portfolio Set pages Background Image",
	"desc" => "Select image for portfolio set page background (Recommended size 1440x900 pixels)",
	"id" => $shortname."_set_bg",
	"type" => "image",
	"size" => "290px",
),
array( "name" => "<h2>Fullscreen Youtube Video Settings</h2>Video Ratio",
	"desc" => "Select default video ratio for Fullscreen Youtube Video",
	"id" => $shortname."_youtube_video_ratio",
	"type" => "select",
	"options" => array(
		'4/3' => '4/3',
		'16/9' => '16/9',
	),
	"std" => '16/9',
),


array( "type" => "close"),
//End second tab "Portfolios"


array( 	"name" => "Blog",
		"type" => "section",
		"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "<h2>Single Post Page Settings</h2>Single Post Page Layout",
	"desc" => "",
	"id" => $shortname."_blog_single_layout",
	"type" => "select",
	"options" => array(
		'page_sidebar' => 'With Sidebar',
		'fullwidth' => 'Fullwidth',
	),
	"std" => 1
),
array( "name" => "Enable/disable social media sharing",
	"desc" => "",
	"id" => $shortname."_blog_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
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


array( 	"name" => "Shop",
		"type" => "section",
		"icon" => "store.png",
),
array( "type" => "open"),

array( "name" => "Shop Pages Background Image",
	"desc" => "Select image for shop background (Recommended size 1440x900 pixels)",
	"id" => $shortname."_shop_bg",
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
	
array( "name" => "<h2>Footer Layouts and Styles Settings</h2>Show Footer Sidebar",
	"desc" => "If you enable this option, you can add widgets to \"Footer Sidebar\" using Appearance > Widgets",
	"id" => $shortname."_footer_display_sidebar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Footer Sidebar styles",
	"desc" => "Select the style for Footer Sidebar",
	"id" => $shortname."_footer_style",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/1column.png"/></div>',
		'2' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/2columns.png"/></div>',
		'3' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/3columns.png"/></div>',
		'4' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/4columns.png"/></div>',
	),
),
array( "name" => "Footer text",
	"desc" => "Enter footer text ex. copyright description",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""
),
//End fifth tab "Footer"
array( "type" => "close"),

//Begin second tab "Utilities"
array( "name" => "Utilities",
	"type" => "section",
	"icon" => "wrench-screwdriver.png",
),

array( "type" => "open"),

array( "name" => "Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => $shortname."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.$shortname.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close")
 
);
?>