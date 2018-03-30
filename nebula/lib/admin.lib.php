<?php
/*
	Begin creating admin options
*/

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

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
)
,

array( "type" => "open"),

array( "name" => "<h2>Website Identity</h2>Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => SHORTNAME."_favicon",
	"type" => "image",
	"std" => "",
),
array( "name" => "<h2>Animation Settings</h2>Use effect in loading animation",
	"desc" => "Enable this to display content with animation",
	"id" => SHORTNAME."_animation",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Global Image Settings</h2>Enable/disable right click (for image protection)",
	"desc" => "",
	"id" => SHORTNAME."_enable_right_click",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Enable/disable image dragging (for image protection)",
	"desc" => "",
	"id" => SHORTNAME."_enable_dragging",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Advanced Settings</h2>Tracking Code",
	"desc" => "Paste your Google Analytics code (or other) tracking code here. This code will be added into the footer of theme",
	"id" => SHORTNAME."_ga_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Before &lt;/head&gt;",
	"desc" => "This code will be added before &lt;/head&gt; tag",
	"id" => SHORTNAME."_before_head_code",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Before &lt;/body&gt;",
	"desc" => "This code will be added before &lt;/body&gt; tag",
	"id" => SHORTNAME."_before_body_code",
	"type" => "textarea",
	"std" => ""
),
	
array( "type" => "close"),
//End first tab "General"

//Begin first tab "General"
/*array( 
		"name" => "Skins",
		"type" => "section",
		"icon" => "color-swatch.png",
),

array( "type" => "open"),

array( "name" => "Save current settings as Skin",
	"desc" => "Skin manager helps you save all settings (except homepage, contact fields and advanced settings) to a skin so you can easily enable it later. Below are your current available skins.",
	"id" => SHORTNAME."_skin",
	"type" => "skin",
	"std" => ""
),
	
array( "type" => "close"),*/
//End first tab "Skins"


//Begin tab "Header"
array( 	"name" => "Header",
		"type" => "section",
		"icon" => "layout-select-header.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Header Layouts and Styles Settings</h2>Header styles",
	"desc" => "",
	"id" => SHORTNAME."_header_style",
	"type" => "radio",
	"options" => array(
		'1' => '<img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/header1.png" style="max-width:475px;float:left;border: 1px solid #d5d5d5;margin-bottom: 30px;"/><br style="clear:both"/>',
		'2' => '<img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/header2.png" style="max-width:475px;float:left;border: 1px solid #d5d5d5;margin-bottom: 30px;"/><br style="clear:both"/>',
		'3' => '<img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/header3.png" style="max-width:475px;float:left;border: 1px solid #d5d5d5;margin-bottom: 30px;"/><br style="clear:both"/>',
		'4' => '<img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/header4.png" style="max-width:475px;float:left;border: 1px solid #d5d5d5;margin-bottom: 30px;"/><br style="clear:both"/>',
	),
),

array( "name" => "Header Background Color (For header style 2,3 and 4)",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_header_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f8f8f8"
),
array( "name" => "Header Border Color (For header style 2,3 and 4)",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_header_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e5e5e5"
),
array( "name" => "Header Font Color (For header style 2,3 and 4)",
	"desc" => "Select color for the font",
	"id" => SHORTNAME."_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#555555"
),

array( "name" => "<h2>Header Info Settings (For header style 2,3 and 4)</h2>Header Phone Number",
    "desc" => "Enter phone number to display in contact info section of header",
    "id" => SHORTNAME."_header_phone",
    "type" => "text",
    "std" => ""
),

array( "name" => "Header email address",
    "desc" => "Enter email address to display in contact info section of header",
    "id" => SHORTNAME."_header_email",
    "type" => "text",
    "std" => ""
),

array( "name" => "Header Social Icons Color Scheme (For header style 2,3 and 4)",
	"desc" => "Select color style for header social icons",
	"id" => SHORTNAME."_header_social_scheme",
	"type" => "select",
	"options" => array(
		'social' => 'Light',
		'social_black' => 'Dark',
	),
	"std" => "social_black"
),

array( "name" => "Open Header Social Icons link in new window",
	"desc" => "Check this to open header social icons link in new window",
	"id" => SHORTNAME."_header_social_link_blank",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Logo Settings</h2>Logo",
	"desc" => "Image logo which shows above of main menu",
	"id" => SHORTNAME."_logo",
	"type" => "image",
	"std" => "",
),
array( "name" => "Retina Logo",
	"desc" => "Retina Ready Image logo. It should be 2x size of normal logo",
	"id" => SHORTNAME."_retina_logo",
	"type" => "image",
	"std" => "",
),

array( "name" => "<h2>Menu Settings</h2>Use sticky top menu",
	"desc" => "Enable this to display main menu fixed when scrolling",
	"id" => SHORTNAME."_fixed_menu",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Use background color for active menu item",
	"desc" => "check this to enable background color for active menu item",
	"id" => SHORTNAME."_menu_active_bg",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Menu Font Family",
	"desc" => "Select font style main menu",
	"id" => SHORTNAME."_menu_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Menu font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Sub Menu font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Make Menu font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_menu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Menu font bold",
	"desc" => "",
	"id" => SHORTNAME."_menu_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Sub Menu font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_submenu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Menu Font Color",
	"desc" => "Select color for menu font",
	"id" => SHORTNAME."_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Menu Hover State Color",
	"desc" => "Select color for menu in hover state",
	"id" => SHORTNAME."_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "Menu Active State Color",
	"desc" => "Select color for menu in active state",
	"id" => SHORTNAME."_menu_active_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "Menu Background Color",
	"desc" => "Select color for menu background",
	"id" => SHORTNAME."_menu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Menu Background Color For Fullscreen, Kenburns and Flip Galleries",
	"desc" => "Select background color for fullscreen, kenburns and flip slideshow",
	"id" => SHORTNAME."_menu_full_bg_color",
	"type" => "select",
	"options" => array(
		'light' => 'Light',
		'dark' => 'Dark',
	),
	"std" => "left"
),

array( "name" => "Menu Border Color",
	"desc" => "Select color for menu bottom border",
	"id" => SHORTNAME."_menu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#d5d5d5"
),

array( "name" => "Menu and Sub Menu Background Opacity",
	"desc" => "Select opacity value for main menu background",
	"id" => SHORTNAME."_menu_opacity_color",
	"type" => "jslider",
	"size" => "40px",
	"std" => "100",
	"from" => 10,
	"to" => 100,
	"step" => 5,
),

array( "name" => "Sub Menu Font Color",
	"desc" => "Select color for submenu font",
	"id" => SHORTNAME."_submenu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Hover State Color",
	"desc" => "Select color for menu in hover state",
	"id" => SHORTNAME."_submenu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#555555"
),

array( "name" => "Sub Menu Background Color",
	"desc" => "Select color for sub menu background",
	"id" => SHORTNAME."_submenu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "<h2>Search Settings</h2>Use instant search",
	"desc" => "Select to enable AJAX instant search result",
	"id" => SHORTNAME."_ajax_search",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Use display search in header",
	"desc" => "Select to display search form in header next to the main menu",
	"id" => SHORTNAME."_ajax_search_header",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Page Title Settings</h2>Page Title Text Alignment",
	"desc" => "Select text alignment for page title",
	"id" => SHORTNAME."_page_title_align",
	"type" => "select",
	"options" => array(
		'left' => 'Align Left',
		'center' => 'Align Center',
	),
	"std" => "left"
),
array( "name" => "Page Title font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_page_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 14,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Make Page Title font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_page_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Page Title font bold",
	"desc" => "",
	"id" => SHORTNAME."_page_title_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Page Title Padding Top (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_page_title_paddingtop",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 0,
	"to" => 200,
	"step" => 1,
),
array( "name" => "Page Title Padding Bottom (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_page_title_paddingbottom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 0,
	"to" => 200,
	"step" => 1,
),
array( "name" => "Page Title Background Color",
	"desc" => "Select color for page title background",
	"id" => SHORTNAME."_page_title_bgcolor",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3facd6"
),
array( "name" => "Page Title Font Color",
	"desc" => "Select color for page title font",
	"id" => SHORTNAME."_page_title_fontcolor",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "<h2>Breadcrumbs Settings</h2>Display breadcrumbs",
	"desc" => "Check this to display breadcrumbs in page title area",
	"id" => SHORTNAME."_breadcrumbs_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Breadcrumbs Font Color",
	"desc" => "Select color for breadcrumbs font",
	"id" => SHORTNAME."_breadcrumbs_fontcolor",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

//End tab "Header"
array( "type" => "close"),


//Begin second tab "Sidebar"
array( 	"name" => "Sidebar",
		"type" => "section",
		"icon" => "application-sidebar-expand.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Custom Sidebar Settings</h2>Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => SHORTNAME."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "name" => "<h2>Sidebar Font Settings</h2>Widget Title font size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_sidebar_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "13",
	"from" => 13,
	"to" => 40,
	"step" => 1,
),
array( "name" => "Make Widget Title font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_sidebar_title_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Widget Title font bold",
	"desc" => "",
	"id" => SHORTNAME."_sidebar_title_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Widget Title Font",
	"desc" => "Select global font family for all sidebar widget's titlet",
	"id" => SHORTNAME."_sidebar_title_font",
	"type" => "font",
	"std" => ""
),

array( "name" => "<h2>Sidebar Content Colors Settings</h2>Sidebar Font Color",
	"desc" => "Select color for the font in sidebar",
	"id" => SHORTNAME."_sidebar_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#666666"
),

array( "name" => "Sidebar Link Color",
	"desc" => "Select color for the link in sidebar",
	"id" => SHORTNAME."_sidebar_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Sidebar Hover Link Color",
	"desc" => "Select color for the hover font in sidebar",
	"id" => SHORTNAME."_sidebar_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "type" => "close"),
//End second tab "Sidebar"


//Begin fifth tab "Footer"
array( 	"name" => "Footer",
		"type" => "section",
		"icon" => "layout-select-footer.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Footer Widgets Area Settings</h2>Show Footer Sidebar",
	"desc" => "If you enable this option, you can add widgets to \"Footer Sidebar\" using Appearance > Widgets",
	"id" => SHORTNAME."_footer_display_sidebar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Footer Sidebar styles",
	"desc" => "Select the style for Footer Sidebar",
	"id" => SHORTNAME."_footer_style",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:70px;height:60px"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/1column.png"/></div>',
		'2' => '<div style="float:left;width:70px;height:60px"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/2columns.png"/></div>',
		'3' => '<div style="float:left;width:70px;height:60px"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/3columns.png"/></div>',
		'4' => '<div style="float:left;width:70px;height:60px"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/4columns.png"/></div>',
	),
),
array( "name" => "<h2>Copyright and Social Icons Settings</h2>Copyright text",
	"desc" => "Enter copyright text",
	"id" => SHORTNAME."_footer_text",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "Footer Social Icons Color Scheme",
	"desc" => "Select color style for footer social icons",
	"id" => SHORTNAME."_footer_social_scheme",
	"type" => "select",
	"options" => array(
		'social' => 'Light',
		'social_black' => 'Dark',
	),
	"std" => "social"
),
array( "name" => "Open Footer Social Icons link in new window",
	"desc" => "Check this to open footer social icons link in new window",
	"id" => SHORTNAME."_footer_social_link_blank",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display social icons",
	"desc" => "Check this to display social icons in footer",
	"id" => SHORTNAME."_footer_social_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Display go to top button",
	"desc" => "Check this to display go to top button in footer",
	"id" => SHORTNAME."_footer_totop_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Footer Content Colors Settings</h2>Footer Background Color",
	"desc" => "Select background color for footer area",
	"id" => SHORTNAME."_footer_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#222222"
),

array( "name" => "Footer Widget Header Font Color",
	"desc" => "Select color for the widget header font in footer",
	"id" => SHORTNAME."_footer_header_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Footer Font Color",
	"desc" => "Select color for the font in footer",
	"id" => SHORTNAME."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#777777"
),

array( "name" => "Footer Link Color",
	"desc" => "Select color for the link in footer",
	"id" => SHORTNAME."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

array( "name" => "Footer Hover Link Color",
	"desc" => "Select color for the hover font in footer",
	"id" => SHORTNAME."_footer_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Copyright Bar Colors Settings</h2>Copyright Bar Background Color",
	"desc" => "Select background color for copyright bar",
	"id" => SHORTNAME."_copyright_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Copyright Bar Font Color",
	"desc" => "Select font color for copyright bar",
	"id" => SHORTNAME."_copyright_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#777777"
),

array( "name" => "Copyright Bar Link Color",
	"desc" => "Select link color for copyright bar",
	"id" => SHORTNAME."_copyright_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Copyright Bar Hover Link Color",
	"desc" => "Select hover state link color for copyright bar",
	"id" => SHORTNAME."_copyright_hover_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

//End fifth tab "Footer"
array( "type" => "close"),

//Begin second tab "Mobile"
array( 	"name" => "Mobile",
		"type" => "section",
		"icon" => "phone.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Responsive Layout Settings</h2>Use responsive layout",
	"desc" => "",
	"id" => SHORTNAME."_enable_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Animation Settings</h2>Disable loading animation on mobile",
	"desc" => "",
	"id" => SHORTNAME."_disable_mobile_animation",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Mobile Menu Settings</h2>Mobile Menu Background Color",
	"desc" => "Select color for mobile menu background",
	"id" => SHORTNAME."_mobile_menu_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Mobile Menu Font Color",
	"desc" => "Select color for mobile menu font",
	"id" => SHORTNAME."_mobile_menu_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Mobile Menu Hover State Color",
	"desc" => "Select color for mobile menu in hover state",
	"id" => SHORTNAME."_mobile_menu_hover_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#222222"
),

array( "name" => "Mobile Menu Border Color",
	"desc" => "Select color for mobile menu bottom border",
	"id" => SHORTNAME."_mobile_menu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#d5d5d5"
),

array( "name" => "Make Mobile Menu font uppercase",
	"desc" => "",
	"id" => SHORTNAME."_mobile_menu_upper",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Make Mobile Menu font bold",
	"desc" => "",
	"id" => SHORTNAME."_mobile_menu_bold",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Mobile"


//Begin first tab "Background"
array( 
		"name" => "Background",
		"type" => "section",
		"icon" => "paintcan.png",
),

array( "type" => "open"),

array( "name" => "<h2>Layout Settings</h2>Layout",
	"desc" => "Select main content layout style",
	"id" => SHORTNAME."_layout",
	"type" => "select",
	"options" => array(
		'wide' => 'Wide',
		'boxed' => 'Boxed',
	),
	"std" => "wide"
),

array( "name" => "<h2>Boxed Layout Background Settings</h2>Background Image For Outer Areas in Boxed Layout",
	"desc" => "Please upload or insert full image URL to use for background",
	"id" => SHORTNAME."_boxed_bg_image",
	"type" => "image",
	"std" => "",
),

array( "name" => "Use 100% Background Image",
	"desc" => "Check this option to have the background image display at 100% in width and height, scaled according to visitor screen resolution",
	"id" => SHORTNAME."_boxed_bg_image_cover",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Background Repeat",
	"desc" => "Select how background image repeat",
	"id" => SHORTNAME."_boxed_bg_image_repeat",
	"type" => "select",
	"options" => array(
		'no-repeat' => 'No Repeat',
		'repeat' => 'Repeat',
	),
	"std" => "no-repeat"
),

array( "name" => "Background Color",
	"desc" => "Select background color for boxed layout option",
	"id" => SHORTNAME."_boxed_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#d6d6d6"
),

array( "name" => "<h2>Main Content Background Settings</h2>Main Content Background Color",
	"desc" => "Select background color for main content area",
	"id" => SHORTNAME."_content_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
	
array( "type" => "close"),
//End first tab "Background"


//Begin first tab "Typography"
array( 
		"name" => "Typography",
		"type" => "section",
		"icon" => "text_dropcaps.png",
),

array( "type" => "open"),

array( "name" => "<h2>Google Web Fonts Settings</h2>You can add additional Google Web Font.",
	"desc" => "Enter font name ex. Courgette <a href=\"http://www.google.com/webfonts\">Checkout Google Web Font Directory</a>",
	"id" => SHORTNAME."_ggfont0",
	"type" => "text",
	"std" => "",
),
array( "name" => "<h2>Header Font Settings</h2>Header Font",
	"desc" => "Select font style your header",
	"id" => SHORTNAME."_header_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "32",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "22",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "<h2>Body Font Settings</h2>Main Content Font",
	"desc" => "Select font style your main content",
	"id" => SHORTNAME."_body_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Main Content Font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_body_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "16",
	"from" => 11,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Page and Content Builder Header font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_ppb_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "30",
	"from" => 16,
	"to" => 100,
	"step" => 1,
),
array( "name" => "Page and Content Builder Tagline font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_ppb_tagline_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "18",
	"from" => 12,
	"to" => 30,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Typography"


//Begin first tab "Styling"
array( 
		"name" => "Styling",
		"type" => "section",
		"icon" => "palette.png",
),

array( "type" => "open"),

array( "name" => "<h2>Page Content Colors Settings</h2>Font Color",
	"desc" => "Select color for the font",
	"id" => SHORTNAME."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#555555"
),
array( "name" => "Page Content Link and Highlight Color",
	"desc" => "Select color for the link",
	"id" => SHORTNAME."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3facd6"
),

array( "name" => "Page Content Hover Link Color",
	"desc" => "Select color for the hover background color",
	"id" => SHORTNAME."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "H1, H2, H3, H4, H5, H6 Font Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6",
	"id" => SHORTNAME."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Horizontal Line Color",
	"desc" => "Select color for default page horizontal line",
	"id" => SHORTNAME."_hr_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#d5d5d5"
),

array( "name" => "<h2>Portfolio & Gallery Settings</h2>Portfolio & Gallery Info Background Color",
	"desc" => "Select background color for portfolio & gallery image info",
	"id" => SHORTNAME."_portfolio_info_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),
array( "name" => "Portfolio & Gallery Info Font Color",
	"desc" => "Select color for portfolio & gallery image info text",
	"id" => SHORTNAME."_portfolio_info_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),
array( "name" => "Portfolio & Gallery Hover Icon Background Color",
	"desc" => "Select background color for portfolio & gallery item hover state",
	"id" => SHORTNAME."_portfolio_hover_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),
array( "name" => "Portfolio & Gallery Hover Icon Color",
	"desc" => "Select color for portfolio & gallery icon hover state",
	"id" => SHORTNAME."_portfolio_hover_icon_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Input Elements and Button Colors Settings</h2>Input and Textarea Background Color",
	"desc" => "Select color for input and textarea background",
	"id" => SHORTNAME."_input_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Input and Textarea Font Color",
	"desc" => "Select font color for input and textarea",
	"id" => SHORTNAME."_input_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#555555"
),

array( "name" => "Input and Textarea Border Color",
	"desc" => "Select border color for input and textarea",
	"id" => SHORTNAME."_input_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#cccccc"
),

array( "name" => "Input and Textarea On Focus State Color",
	"desc" => "Select color for input and textarea in focused state",
	"id" => SHORTNAME."_input_focus_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Button Background Color",
	"desc" => "Select color for the button background",
	"id" => SHORTNAME."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font",
	"id" => SHORTNAME."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border",
	"id" => SHORTNAME."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "<h2>Shop Colors Settings</h2>Shop Highlight Color",
	"desc" => "Select highlight color for shop pages",
	"id" => SHORTNAME."_shop_highlight_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),


array( "type" => "close"),
//End first tab "Styling"


//Begin second tab "Shortcode"
array( 	"name" => "Shortcode",
		"type" => "section",
		"icon" => "color_swatch.png",	
),
array( "type" => "open"),

array( "name" => "<h2>Pricing Shortcode Settings</h2>Pricing Header Background Color",
	"desc" => "Select background color for pricing header",
	"id" => SHORTNAME."_pricing_header_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Pricing Header Font Color",
	"desc" => "Select font color for pricing header",
	"id" => SHORTNAME."_pricing_header_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Pricing Header Font Family",
	"desc" => "Select font style pricing header",
	"id" => SHORTNAME."_pricing_header_font",
	"type" => "font",
	"std" => ''
),

array( "name" => "Pricing Border Color",
	"desc" => "Select border color for pricing table",
	"id" => SHORTNAME."_pricing_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#dddddd"
),

array( "name" => "Featured Pricing Header Background Color",
	"desc" => "Select background color for featured pricing header",
	"id" => SHORTNAME."_pricing_featured_header_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "<h2>Service Shortcode Settings</h2>Service Style 1 Icon Background Color",
	"desc" => "Select background color for service icon style 1",
	"id" => SHORTNAME."_service_icon1_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f0f0f0"
),

array( "name" => "Service Style 1 Icon Color",
	"desc" => "Select color for service icon style 1",
	"id" => SHORTNAME."_service_icon1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "Service Style 2 Icon Background Color",
	"desc" => "Select background color for service icon style 2",
	"id" => SHORTNAME."_service_icon2_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "name" => "Service Style 2 Icon Color",
	"desc" => "Select color for service icon style 2",
	"id" => SHORTNAME."_service_icon2_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Team Shortcode Settings</h2>Team Info Background Color",
	"desc" => "Select background color for team info",
	"id" => SHORTNAME."_team_info_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3fabd6"
),

array( "name" => "Team Info Font Color",
	"desc" => "Select color for team info text",
	"id" => SHORTNAME."_team_info_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "<h2>Social Share Shortcode Settings</h2>Social Share Background Color",
	"desc" => "Select background color for social share shortcode",
	"id" => SHORTNAME."_social_share_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f0f0f0"
),

array( "name" => "Social Share Font Color",
	"desc" => "Select color for social share text",
	"id" => SHORTNAME."_social_share_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#333333"
),

array( "type" => "close"),
//End second tab "Shortcode"


//Begin second tab "Gallery"
array( 	"name" => "Gallery",
		"type" => "section",
		"icon" => "pictures.png",
),
array( "type" => "open"),

array( "name" => "<h2>Global Gallery Settings</h2>Gallery Images Sorting",
	"desc" => "Select how you want to sort gallery images",
	"id" => SHORTNAME."_gallery_sort",
	"type" => "select",
	"options" => array(
		'drag' => 'By Drag&drop',
		'post_date' => 'By Newest',
		'post_date_old' => 'By Oldest',
		'rand' => 'By Random',
		'title' => 'By Title',
	),
	"std" => ""
),

array( "name" => "Use social media sharing",
	"desc" => "",
	"id" => SHORTNAME."_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Use display sidebar gallery info by default",
	"desc" => "",
	"id" => SHORTNAME."_gallery_auto_info",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Use display image title and description in lightbox",
	"desc" => "Check if you want to display image title and description under the image in lightbox mode",
	"id" => SHORTNAME."_portfolio_enable_slideshow_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Gallery Font Settings</h2>Fullscreen Content Page Title font size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_fullscreen_image_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "32",
	"from" => 16,
	"to" => 60,
	"step" => 1,
),
array( "name" => "<h2>Full Screen Slideshow Settings</h2>Use autoplay slideshow",
	"desc" => "Slideshow starts playing automatically",
	"id" => SHORTNAME."_full_autoplay",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Full Screen Slideshow timer",
	"desc" => "Enter number of seconds for Full Screen Slideshow timer",
	"id" => SHORTNAME."_full_slideshow_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Full Screen Slideshow Transition Effect",
	"desc" => "Select transition type for contents in Full Screen slideshow",
	"id" => SHORTNAME."_full_slideshow_trans",
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
array( "name" => "Full Screen Slideshow Transition Timer",
	"desc" => "Enter number of seconds for transition between each image",
	"id" => SHORTNAME."_full_slideshow_trans_speed",
	"type" => "jslider",
	"size" => "40px",
	"std" => "400",
	"from" => 100,
	"to" => 10000,
	"step" => 100,
),
array( "name" => "Use gallery images fill screen resolution",
	"desc" => "",
	"id" => SHORTNAME."_enable_fit_image",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Use image title and description",
	"desc" => "",
	"id" => SHORTNAME."_full_enable_slideshow_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Image Flow Slideshow Settings</h2>Use image reflection",
	"desc" => "It will displays mirror refelction effect in flow gallery",
	"id" => SHORTNAME."_flow_enable_reflection",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Use image title and description",
	"desc" => "",
	"id" => SHORTNAME."_flow_enable_slideshow_title",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Kenburns Slideshow Settings</h2>Kenburns Slideshow timer",
	"desc" => "Enter number of seconds for Kenburns Slideshow timer",
	"id" => SHORTNAME."_kenburns_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 20,
	"step" => 1,
),
array( "name" => "Kenburns Zoom Level",
	"desc" => "Select zoom level for Kenburns slideshow",
	"id" => SHORTNAME."_kenburns_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "2",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Fade Transition Timer",
	"desc" => "Enter number of seconds for transition between each image",
	"id" => SHORTNAME."_kenburns_trans",
	"type" => "jslider",
	"size" => "40px",
	"std" => "1000",
	"from" => 100,
	"to" => 10000,
	"step" => 100,
),

array( "type" => "close"),
//End second tab "Gallery"


//Begin second tab "Portfolio"
array( 	"name" => "Portfolio",
		"type" => "section",
		"icon" => "folder-open-image.png",
),
array( "type" => "open"),

array( "name" => "<h2>Filterable Settings</h2>Filterable options sorting",
	"desc" => "Select how you want to sort filterable sets",
	"id" => SHORTNAME."_portfolio_set_sort",
	"type" => "select",
	"options" => array(
		'name' => 'By Name',
		'slug' => 'By Slug',
		'id' => 'By ID',
		'count' => 'By Number of Portfolios',
	),
	"std" => 'name'
),
array( "name" => "Filterable Bar Background Color",
	"desc" => "Select background color for filterable bar",
	"id" => SHORTNAME."_filterable_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f0f0f0"
),
array( "name" => "Filterable Bar Font Color",
	"desc" => "Select color for the filterable text",
	"id" => SHORTNAME."_filterable_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#666666"
),
array( "name" => "Filterable Bar Active State Color",
	"desc" => "Select active state color for the filterable text",
	"id" => SHORTNAME."_filterable_active_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#3facd6"
),
array( "name" => "Filterable Bar Font Family",
	"desc" => "Select font style for filterable bar",
	"id" => SHORTNAME."_filterable_font",
	"type" => "font",
	"std" => ''
),
array( "name" => "Filterable Bar font Size (in pixels)",
	"desc" => "",
	"id" => SHORTNAME."_filterable_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 11,
	"to" => 30,
	"step" => 1,
),

array( "name" => "<h2>Portfolio Items Settings</h2>Portfolio page show at most",
	"desc" => "Enter number of portfolio items you want to display per page",
	"id" => SHORTNAME."_portfolio_items_page",
	"type" => "jslider",
	"size" => "40px",
	"std" => "9",
	"from" => 1,
	"to" => 100,
	"step" => 1,
),

array( "name" => "<h2>Portfolio Category Settings</h2>Portfolio Category Layout",
	"desc" => "Select page template for displaying portfolio category contents",
	"id" => SHORTNAME."_set_page_template",
	"type" => "select",
	"options" => array(
		'2' => 'Portfolio 2 Columns',
		'3' => 'Portfolio 3 Columns',
		'4' => 'Portfolio 4 Columns',
	),
	"std" => 1
),

array( "name" => "<h2>Single Portfolio Settings</h2>Display Comments",
	"desc" => "Check to display comment on single portfolio page",
	"id" => SHORTNAME."_portfolio_comment",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Use display recent portfolio items",
	"desc" => "This option will displays recent portfolio items at the bottom of single portfolio page",
	"id" => SHORTNAME."_portfolio_single_recent",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Recent portfolio items",
	"desc" => "Enter number of items you want for recent portfolio",
	"id" => SHORTNAME."_portfolio_recent_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "4",
	"from" => 1,
	"to" => 28,
	"step" => 1,
),
array( "name" => "Use social media sharing",
	"desc" => "",
	"id" => SHORTNAME."_portfolio_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Portfolio"


array( 	"name" => "Blog",
		"type" => "section",
		"icon" => "book-open-bookmark.png",
),
array( "type" => "open"),

array( "name" => "<h2>Blog Layout Settings</h2>Archive Page Layout",
	"desc" => "Select page layout for displaying archive page",
	"id" => SHORTNAME."_blog_archive_layout",
	"type" => "select",
	"options" => array(
		'blog_r' => 'With Right Sidebar',
		'blog_l' => 'With Left Sidebar',
		'blog_f' => 'Fullwidth',
	),
	"std" => 'blog_r'
),
array( "name" => "Category Page Layout",
	"desc" => "Select page layout for displaying category page",
	"id" => SHORTNAME."_blog_category_layout",
	"type" => "select",
	"options" => array(
		'blog_r' => 'With Right Sidebar',
		'blog_l' => 'With Left Sidebar',
		'blog_f' => 'Fullwidth',
	),
	"std" => 'blog_r'
),
array( "name" => "Tag Page Layout",
	"desc" => "Select page layout for displaying tag page",
	"id" => SHORTNAME."_blog_tag_layout",
	"type" => "select",
	"options" => array(
		'blog_r' => 'With Right Sidebar',
		'blog_l' => 'With Left Sidebar',
		'blog_f' => 'Fullwidth',
	),
	"std" => 'blog_r'
),
array( "name" => "<h2>Single Post Page Settings</h2>Use social media sharing",
	"desc" => "",
	"id" => SHORTNAME."_blog_social_sharing",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Show featured content on single post",
	"desc" => "Select to display featured content (image or gallery) in single post page",
	"id" => SHORTNAME."_blog_feat_content",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Show Related posts module",
	"desc" => "Select to display related posts in single post page",
	"id" => SHORTNAME."_blog_display_related",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Show more story module",
	"desc" => "Select to display more story popup in single post page",
	"id" => SHORTNAME."_blog_more_story",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Other Settings</h2>Use display full blog post content on blog page",
	"desc" => "",
	"id" => SHORTNAME."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),


array( "type" => "close"),


/*array( 	"name" => "Shop",
		"type" => "section",
		"icon" => "store.png",
),
array( "type" => "open"),

array( "name" => "Shop Pages Background Image",
	"desc" => "Select image for shop background (Recommended size 1440x900 pixels)",
	"id" => SHORTNAME."_shop_bg",
	"type" => "image",
	"size" => "290px",
),


array( "type" => "close"),*/


//Begin fourth tab "Contact"
array( 	"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
),
array( "type" => "open"),
	

array( "name" => "<h2>Contact Form Settings</h2>Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => SHORTNAME."_contact_email",
	"type" => "text",
	"std" => ""

),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => SHORTNAME."_contact_form",
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
array( "name" => "<h2>Address and Map Settings</h2>Show map in contact page",
	"desc" => "Select display map in contact page",
	"id" => SHORTNAME."_contact_display_map",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Map Type",
	"desc" => "Select map display type",
	"id" => SHORTNAME."_contact_map_type",
	"type" => "select",
	"options" => array(
	    'MapTypeId.ROADMAP' => 'Roadmap',
	    'MapTypeId.SATELLITE' => 'Satellite',
	    'MapTypeId.HYBRID' => 'Hybrid',
	    'MapTypeId.TERRAIN' => 'Terrain',
	),
	"std" => 'MapTypeId.TERRAIN'
),
array( "name" => "Office Name, address",
	"desc" => "Enter your office name, brand or address. It displays as popup inside the map",
	"id" => SHORTNAME."_contact_map_popup",
	"type" => "text",
	"std" => ""
),
array( "name" => "Address Latitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => SHORTNAME."_contact_lat",
	"type" => "text",
	"std" => ""
),
array( "name" => "Address Longtitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => SHORTNAME."_contact_long",
	"type" => "text",
	"std" => ""
),
array( "name" => "Map Zoom level",
	"desc" => "Select zoom level of main contact map.",
	"id" => SHORTNAME."_contact_map_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 18,
	"step" => 1,
),

array( "name" => "<h2>Captcha Settings</h2>Enable Captcha",
	"desc" => "If you enable this option, contact page will display captcha image to prevent possible spam",
	"id" => SHORTNAME."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1,
),
array( "type" => "close"),

//End fourth tab "Contact"

//Begin fifth tab "Social Profiles"
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook Profile ID",
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
array( "name" => "Google Plus URL",
	"desc" => "",
	"id" => SHORTNAME."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => SHORTNAME."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Channel ID",
	"desc" => "",
	"id" => SHORTNAME."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "",
	"id" => SHORTNAME."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "",
	"id" => SHORTNAME."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "",
	"id" => SHORTNAME."_linkedin_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Pinterest Username",
	"desc" => "",
	"id" => SHORTNAME."_pinterest_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Instagram Username",
	"desc" => "",
	"id" => SHORTNAME."_instagram_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "<h2>Twitter API Settings</h2>Twitter Consumer Key <a href=\"http://support.themegoods.com/?knowledgebase=fix-twitter-widget\">See instructions</a>",
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
array( "name" => "Twitter Consumer Token",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_token",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Consumer Token Secret",
	"desc" => "",
	"id" => SHORTNAME."_twitter_consumer_token_secret",
	"type" => "text",
	"std" => ""
),
array( "type" => "close"),

//End fifth tab "Social Profiles"


//Begin second tab "Script"
array( "name" => "Script",
	"type" => "section",
	"icon" => "css.png",
),

array( "type" => "open"),

array( "name" => "<h2>CSS Settings</h2>Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "<h2>CSS and Javascript Optimisation Settings</h2>Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Cache Settings</h2>Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => SHORTNAME."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.SHORTNAME.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close"),


//Begin second tab "Backup"
array( "name" => "Backup",
	"type" => "section",
	"icon" => "drive_disk.png",
),

array( "type" => "open"),

array( "name" => "<h2>Import Settings</h2>",
	"desc" => "Choose theme export file (.json) from your computer and click \"Import\" button",
	"id" => SHORTNAME."_import_current",
	"type" => "html",
	"html" => '<input type="file" id="'.SHORTNAME.'_import_current" name="'.SHORTNAME.'_import_current"/><input type="submit" id="'.SHORTNAME.'_import_current_button" class="button" value="Import"/>',
),

array( "name" => "<h2>Export Settings</h2>",
	"desc" => "You can click below button to save current backup into .json file so you can import it back any time using restore form below.",
	"id" => SHORTNAME."_export_current",
	"type" => "html",
	"html" => '<input type="submit" id="'.SHORTNAME.'_export_current_button" class="button" value="Export Current Theme Settings"/><input type="hidden" id="'.SHORTNAME.'_export_current" name="'.SHORTNAME.'_export_current" value="0"/>',
),
 
array( "type" => "close")
 
);
?>