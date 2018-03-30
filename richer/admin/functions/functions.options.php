<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
	

/*-----------------------------------------------------------------------------------*/
/* TO DO: Add options/functions that use these */
/*-----------------------------------------------------------------------------------*/

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array(__("Select a number:",'richer-framework'),"1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("Stretch Image"=>__("Stretch Image",'richer-framework'),"no-repeat"=>__("No repeat",'richer-framework'),"repeat-x"=>__("Horizontal repeat",'richer-framework'),"repeat-y"=>__("Vertical repeat", 'richer-framework'), "repeat"=>__("Repeat", 'richer-framework'));
$body_pos_x = array("left"=>__("Left",'richer-framework'),"center"=>__("Center", 'richer-framework'),"right"=>__("Right", 'richer-framework'));
$body_pos_y = array("top"=>__("Top",'richer-framework'),"center"=>__("Center", 'richer-framework'),"bottom"=>__("Bottom", 'richer-framework'));

$of_options_select = array("one","two","three","four","five"); 

// Image Alignment radio box
$of_options_thumb_align = array("alignleft" => __("Left",'richer-framework'),"alignright" => __("Right",'richer-framework'),"aligncenter" => __("Center",'richer-framework')); 

// Image Links to Options
$of_options_image_link_to = array("image" => __("The Image",'richer-framework'),"post" => __("The Post",'richer-framework')); 

/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$url =  ADMIN_DIR . 'assets/images/';

/* ------------------------------------------------------------------------ */
/* General
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("General",'richer-framework'),
					"id" => __("general",'richer-framework'),
					"type" => "heading");
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("General",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __('Import Demo Content'),
					"desc" => "",
					"id" => "import_info",
					"std" => __("Help you to import demo content. WARNING: This option overwrite your current theme options, widgets, sliders! If you get white screen, please refresh page(F5).",'richer-framework'),
					"type" => "info-desc");

$of_options[] = array( "name" => '',
		            "desc" => '',
		            "id" => "demo_data",
		            "std" => admin_url('themes.php?page=optionsframework&import_data_content=true&demo=main'),
		            "btntext" => 'Import Main Demo',
		            "type" => "button");

$of_options[] = array( "name" => "",
		            "desc" => "",
		            "id" => "demo_creative_data",
		            "std" => admin_url('themes.php?page=optionsframework&import_data_content=true&demo=creative'),
		            "btntext" => 'Import Creative Demo',
		            "type" => "button");

$of_options[] = array( "name" => __("Disable comments for all content pages (not blog)",'richer-framework'),
					"desc" => __("<strong>Be careful:</strong> page specific settings get overwritten.",'richer-framework'),
					"id" => "check_disablecomments",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Tracking code",'richer-framework'),
					"desc" => __("Paste your google analytics code (or other) here.",'richer-framework'),
					"id" => "textarea_trackingcode",
					"std" => "",
					"type" => "textarea"); 
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Favicons",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("Favicon Upload (16x16)",'richer-framework'),
					"desc" => __("Upload your favicon (16x16px ico/png - use www.favicon.cc to make sure it's fully compatible)",'richer-framework'),
					"id" => "media_favicon",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Search",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("Exclude pages from search.",'richer-framework'),
					"desc" => __("It allows you to exclude pages from search.",'richer-framework'),
					"id" => "check_excludepages",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("SEO",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("SEO default settings (meta-description, meta-keywords, etc.).",'richer-framework'),
					"desc" => __("Check to disable those settings.",'richer-framework'),
					"id" => "check_seodisable",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Meta Keywords",'richer-framework'),
					"desc" => __("Add relevant keywords separated with commas to improve SEO.",'asw-framework'),
					"id" => "meta_keywords",
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => __("Meta Description",'richer-framework'),
					"desc" => __("Enter a short description of the website for SEO.",'asw-framework'),
					"id" => "meta_description",
					"std" => "",
					"type" => "textarea");
/* ------------------------------------------------------------------------ */
/* Layout
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Layout",'richer-framework'),
					"id" => __("layout",'richer-framework'),
					"type" => "heading");
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Layout options",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Enable to show Style switcher",'richer-framework'),
					"desc" => __("Check to enable Style switcher",'richer-framework'),
					"id" => "check_styleswitcher",
					"std" => 0,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Enable responsive layout",'richer-framework'),
					"desc" => __("Check to enable Responsive Layout",'richer-framework'),
					"id" => "check_responsive",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Zoom on mobile devices",'richer-framework'),
					"desc" => __("Check to disable zoom on mobile devices",'richer-framework'),
					"id" => "check_mobilezoom",
					"std" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Disable Smooth Scrolling",'richer-framework'),
					"desc" => __("Check to disable smooth scrolling on your site.",'richer-framework'),
					"id" => "check_smooth_scrolling",
					"std" => 0,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Layout style",'richer-framework'),
					"desc" => __("Choose your layout style",'richer-framework'),
					"id" => "select_layoutstyle",
					"std" => "wide",
					"type" => "select",
					"options" => array('wide'=>__('Wide','richer-framework'), 'boxed'=>__('Boxed','richer-framework'))
					);	

$of_options[] = array( "name" => __("Container width option",'richer-framework'),
					"desc" => __("Specify your container width option. Container - is area with your content.",'richer-framework'),
					"id" => "container_width",
					"std"       => '1196', 
					"type"      => "sliderui",
					"edit" => true,
					'max'=>'1500',
					'min'=>'800',
					'step'=>'1'
					);
$of_options[] = array( "name" => __("Container background color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "color_containerbackground",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Container background color opacity",'richer-framework'),
					"desc" => __("Container background color opacity.",'richer-framework'),
					"id" => "text_containeropacity",
					"std" => 100,
					'max'=>100, 
					'min'=>0,
					"type" => "sliderui",
					'step'=>10
					);

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Boxed layout options (only work when boxed layout is enabled)",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Width for boxed layout",'richer-framework'),
					"desc" => __("Specify your boxed layout width",'richer-framework'),
					"id" => "main_boxed_width",
					"std"       => '1240', 
					"type"      => "sliderui",
					'max'=>'1600',
					'min'=>'800',
					'step'=>'10'
					);

$of_options[] = array( "name" => __("Default background image",'richer-framework'),
					"desc" => __("Upload default background image",'richer-framework'),
					"id" => "media_bg",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => __("Body background options",'richer-framework'),
					"desc" => "",
					"id" => "body_background_options",
					"std" => array('repeat' => 'no-repeat', 'position-x'=>'center', 'position-y'=>'center', 'attachment'=>'scroll'),
					"type" => "background");

$of_options[] = array( "name" => "",
					"desc" => __("Check if you need to have fullscreen background image.",'richer-framework'),
					"id" => "body_background_size",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Default background color",'richer-framework'),
					"desc" => __("Select color for default background",'richer-framework'),
					"id" => "color_bg",
					"std" => "#f6f6f6",
					"type" => "color"); 
																
/* ------------------------------------------------------------------------ */
/* Header
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Header",'richer-framework'),
					"id" => __("header",'richer-framework'),
					"type" => "heading");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Header variations",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Select a header layout",'richer-framework'),
					"desc" => "",
					"id" => "header_layout",
					"std" => "version1",
					"type" => "images",
					"options" => array(
						"version1" => get_template_directory_uri()."/admin/assets/images/h1.png",
						"version2" => get_template_directory_uri()."/admin/assets/images/h2.png",
						"version3" => get_template_directory_uri()."/admin/assets/images/h3.png",
						"version4" => get_template_directory_uri()."/admin/assets/images/h4.png",
						"version5" => get_template_directory_uri()."/admin/assets/images/h5.png")
					);

$of_options[] = array( "name" => __("Header content area",'richer-framework'),
					"desc" => __("Enter your text for header info (html allowed).",'richer-framework'),
					"id" => "header_content_info",
					'fold' => 'header_layout',
					'fold_value' => 'version4',
					"std" => "",
					"type" => "textarea");

$of_options[] = array( "name" => __("Top Line navigation color",'richer-framework'),
					"desc" => __("Default: #d8d8d8",'richer-framework'),
					'fold' => 'header_layout',
					'fold_value' => 'version4, version3',
					"id" => "h3_border_color",
					"std" => "#d8d8d8",
					"type" => "color");

$of_options[] = array( "name" => __("Navigation link divider color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					'fold' => 'header_layout',
					'fold_value' => 'version4, version3',
					"id" => "h3_nav_border_color",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Background navigation color",'richer-framework'),
					"desc" => __("Default: #ecf0f1",'richer-framework'),
					"id" => "h3_bg_color",
					'fold' => 'header_layout',
					'fold_value' => 'version4, version3',
					"std" => "#ecf0f1",
					"type" => "color");

$of_options[] = array( "name" => __("Header background color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					'fold' => 'header_layout',
					'fold_value' => 'version4, version3, version2, version1, version5',
					"id" => "color_headerbg",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Header background color opacity",'richer-framework'),
					"desc" => __("Header background color opacity.",'richer-framework'),
					"id" => "header_bg_opacity",
					"std" => 30,
					'max'=>100, 
					'min'=>0,
					"type" => "sliderui",
					'step'=>10
					);

$of_options[] = array( "name" => __("Header border bottom",'richer-framework'),
					"desc" => __("Default: 1px solid #d8d8d8",'richer-framework'),
					"id" => "border_header",
					"std" => array('width' => '1','style' => 'solid','color' => '#d8d8d8'),
					"type" => "border"); 

$of_options[] = array( "name" => __("Header border color opacity",'richer-framework'),
					"desc" => __("Header border color opacity.",'richer-framework'),
					"id" => "header_bor_opacity",
					"std" => 100,
					'max'=>100, 
					'min'=>0,
					"type" => "sliderui",
					'step'=>10
					);
					
$of_options[] = array( "name" => __("Header height (without px)",'richer-framework'),
					"desc" => __("Header height (default: 100)",'richer-framework'),
					"id" => "style_headerheight",
					'fold' => 'header_layout',
					'fold_value' => 'version1, version5',
					"std" => "100",
					'mod' => 'mini',
					"type" => "text");

$of_options[] = array( "name" => __("Show header searchform?",'richer-framework'),
					"desc" => __("If checked it shows instead header content area.", "richer-framework"),
					"id" => "check_header4_search",
					'fold' => 'header_layout',
					'fold_value' => 'version4',
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Fixed header",'richer-framework'),
					"desc" => __("Show header at the top of the page. Check to enable.",'richer-framework'),
					"id" => "check_fixed_header",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Header background image upload",'richer-framework'),
					"desc" => __("Upload your Header background image",'richer-framework'),
					"id" => "header_media_bg",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => __("Header background image options",'richer-framework'),
					"desc" => __("Select background repeat option.",'richer-framework'),
					"id" => "header_bg_options",
					"std" => array('repeat' => 'no-repeat', 'position-x'=>'center', 'position-y'=>'center', 'attachment'=>'scroll'),
					"type" => "background"
					);
$of_options[] = array( "name" => "",
					"desc" => __("Check if you need to have fullscreen background image.",'richer-framework'),
					"id" => "header_bg_size",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Header text color",'richer-framework'),
					"desc" => __("Default: #3b3f42",'richer-framework'),
					"id" => "color_headertext",
					"std" => "#3b3f42",
					"type" => "color");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Top bar",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Show top bar",'richer-framework'),
					"desc" => __("If you want to show top bar, you need to check it",'richer-framework'),
					"id" => "check_topbar",
					"std" => 0,
					"type" => "switch");


/*------------------------------*/
$of_topbar_blocks = array( 
	"disabled" => array (
		"placebo" 		=> "placebo",//REQUIRED!
		"menu"		=> "Navigation"
	), 
	"enabled" => array (
		"placebo" 	=> "placebo", //REQUIRED!
		"contact"	=> "Contact info",
		"socials"	=> "Socials"
		
	),
);
/*-------------------------*/

$of_options[] = array( "name" => __("Top bar layout",'richer-framework'),
					"desc" => "Organize how you want the layout to appear in the top bar.",
					"id" => "topbar_blocks",
					"std" => $of_topbar_blocks,
					"fold" => "check_topbar",
					"type" => "sorter");

$of_options[] = array( "name" => __("Contact information",'richer-framework'),
					"desc" => "",
					"id" => "",
					"std" => "",
					"icon" => false,
					"fold" => "check_topbar",
					"type" => "");

$of_options[] = array( "name" => __("Address",'richer-framework'),
					"desc" => __("Enter your location.",'richer-framework'),
					"id" => "contact_address",
					"std" => "271 Dominica Circle, Niceville, FL 32578, United States",
					"fold" => "check_topbar",
					"type" => "text");

$of_options[] = array( "name" => __("Phone",'richer-framework'),
					"desc" => __("Enter your phone number.",'richer-framework'),
					"id" => "contact_phone",
					"std" => "+1 703-697-1776",
					"fold" => "check_topbar",
					"type" => "text");

$of_options[] = array( "name" => __("Email address",'richer-framework'),
					"desc" => __("Enter email info.",'richer-framework'),
					"id" => "contact_email",
					"std" => "demolink@companyname.com",
					"fold" => "check_topbar",
					"type" => "text");

$of_options[] = array( "name" => __("Top bar text color",'richer-framework'),
					"desc" => __("Default: #3b3f42",'richer-framework'),
					"id" => "textcolor_topbar",
					"std" => "#3b3f42",
					"fold" => 'check_topbar',
					"type" => "color");

$of_options[] = array( "name" => __("Top bar background color",'richer-framework'),
					"desc" => __("Default: #fafafa",'richer-framework'),
					"id" => "color_topbar",
					"std" => "#fafafa",
					"fold" => 'check_topbar',
					"type" => "color");

$of_options[] = array( "name" => __("Top navigation link font options",'richer-framework'),
					"desc" => __("Default: #3b3f42",'richer-framework'),
					"fold" => 'check_topbar',
					"id" => "font_top_navigation",
					"std" => array('size' => '12px', 'height'=>'0', 'face' => 'Open Sans','style' => 'normal', 'transform'=>'none', 'color' => '#3b3f42'),
					"type" => "typography");

$of_options[] = array( "name" => __("Top navigation link hover color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"fold" => 'check_topbar',
					"id" => "topnav_color_navlinkhover",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Top navigation link active color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"fold" => 'check_topbar',
					"id" => "topnav_color_navlinkactive",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown background color",'richer-framework'),
					"fold" => 'check_topbar',
					"desc" => __("Default: #f4f4f4",'richer-framework'),
					"id" => "topnav_color_submenubg",
					"std" => "#f4f4f4",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown border color",'richer-framework'),
					"fold" => 'check_topbar',
					"desc" => __("Default: #e8e8e8",'richer-framework'),
					"id" => "topnav_color_submenuborder",
					"std" => "#e8e8e8",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown link color",'richer-framework'),
					"fold" => 'check_topbar',
					"desc" => __("Default: #333333",'richer-framework'),
					"id" => "topnav_color_submenulink",
					"std" => "#333333",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown link border color",'richer-framework'),
					"fold" => 'check_topbar',
					"desc" => __("Default: #e8e8e8",'richer-framework'),
					"id" => "topnav_color_submenulinkborder",
					"std" => "#e8e8e8",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown link hover and active color",'richer-framework'),
					"fold" => 'check_topbar',
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "topnav_color_submenulinkhover",
					"std" => "#43b4f9",
					"type" => "color");

/*-----------------------------------------------------------------*/

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Logo options",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Disable logo tagline",'richer-framework'),
					"desc" => __("Tagline is text under the main logo (e.g. Just another WordPress site)",'richer-framework'),
					"id" => "check_tagline",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Logo upload",'richer-framework'),
					"desc" => __("Upload your logo",'richer-framework'),
					"id" => "media_logo",
					"std" => "",
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => __("Logo width",'richer-framework'),
					"desc" => __("Enter your width value for the logo in pixels (default: 100). Suggestion: to load image with high dpi, and set width. It allows you to have good view on the retina displays.",'richer-framework'),
					"id" => "style_logomaxwidth",
					"std" => "100",
					'mod'=>'mini',
					"type" => "text"); 

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Search",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Show search?",'richer-framework'),
					"desc" => "",
					"id" => "check_searchform",
					"std" => 'main_nav',
					"type" => "radio",
					"options" => array( 
						'top_bar' => __('Show in top bar menu','richer-framework'), 
						'main_nav' => __('Show in main navigation','richer-framework'), 
						'no' => __('Disable search','richer-framework')
						)
					);
/* ------------------------------------------------------------------------ */
/* Footer
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Footer",'richer-framework'),
					"id" => __("footer",'richer-framework'),
					"type" => "heading");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Footer options",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("Widgetized footer",'richer-framework'),
					"desc" => __("'On' - to show widgetized footer.",'richer-framework'),
					"id" => "check_footerwidgets",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => __("Footer widgets columns count",'richer-framework'),
					"desc" => __("Select how much columns do you need for your footer widgets area.",'richer-framework'),
					"id" => "footer_columns_count",
					"fold" => 'check_footerwidgets',
					"std" => "4",
					"type" => "select",
					"options" => array('1', '2', '3', '4')
					);
/* ------------------------------------------------------------------------ */
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Footer styling",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Footer background image",'richer-framework'),
					"desc" => __("Upload image or paste image URL",'richer-framework'),
					"id" => "footer_media_bg",
					"std" => get_template_directory_uri()."/framework/images/footer_bg_images.jpg",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => __("Footer background image options",'richer-framework'),
					"desc" => __("Select background repeat option for the default background.",'richer-framework'),
					"id" => "footer_bg_options",
					"std" => array('repeat' => 'no-repeat', 'position-x'=>'center', 'position-y'=>'center', 'attachment'=>'scroll'),
					"type" => "background"
					);	

$of_options[] = array( "name" => "",
					"desc" => __("Check if you need to have fullscreen background image.",'richer-framework'),
					"id" => "footer_bg_size",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Footer background color",'richer-framework'),
					"desc" => __("Default: #223e50",'richer-framework'),
					"id" => "color_footerbg",
					"std" => "#223e50",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Footer border top color",'richer-framework'),
					"desc" => __("Default: 0px solid #142b3a",'richer-framework'),
					"id" => "border_footertop",
					"std" => array('width' => '0','style' => 'solid','color' => '#142b3a'),
					"type" => "border"); 
					
$of_options[] = array( "name" => __("Footer text color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "color_footertext",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Footer link color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_footerlink",
					"std" => "#43b4f9",
					"type" => "color"); 

$of_options[] = array( "name" => __("Footer link hover color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_footerlinkhover",
					"std" => "#43b4f9",
					"type" => "color");
					
$of_options[] = array( "name" => __("Footer headline",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "font_footerheadline",
					"std" => array('size' => '12px','face' => 'Open Sans','style' => '600', 'transform'=>'uppercase', 'color' => '#ffffff'),
					"type" => "typography");
					
$of_options[] = array( "name" => __("Footer headline border",'richer-framework'),
					"desc" => __("Default: 1px solid #e5eaec",'richer-framework'),
					"id" => "border_footerheadline",
					"std" => array('width' => '1','style' => 'solid','color' => '#e5eaec'),
					"type" => "border"); 

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Copyright options",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => "",
					"desc" => __("Check if you need to disable copyright section.",'richer-framework'),
					"id" => "check_copyright",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Small logo upload",'richer-framework'),
					"desc" => __("Upload your small logo",'richer-framework'),
					"id" => "media_small_logo",
					"std" => "",
					"mod" => "min",
					"type" => "media"); 

$of_options[] = array( "name" => __("Copyright text",'richer-framework'),
					"desc" => __("Enter your copyright text (html allowed)",'richer-framework'),
					"id" => "textarea_copyright",
					"std" => "by <a href='http://themeforest.net/user/ArtstudioWorks/portfolio'>ArtstudioWorks</a> &copy; All rights reserved",
					"type" => "textarea"); 

$of_options[] = array( "name" => __("Show navigation in copyright",'richer-framework'),
					"desc" => __("'On' - to show navigation in copyright",'richer-framework'),
					"id" => "check_socialfooter",
					"std" => 1,
					"type" => "switch"); 
/* ------------------------------------------------------------------------ */
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Copyright styling",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Copyright background color",'richer-framework'),
					"desc" => __("Default: #142b3a",'richer-framework'),
					"id" => "color_copyrightbg",
					"std" => "#142b3a",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Copyright text color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "color_copyrighttext",
					"std" => "#ffffff",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Copyright link color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_copyrightlink",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Copyright link hover Color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "color_copyrightlinkhover",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Copyright menu font option",'richer-framework'),
					"desc" => __("Specify font options for menu links",'richer-framework'),
					"id" => "font_copyright_menu",
					"std" => array('size' => '12px', 'height'=>'0', 'face' => 'Open Sans','style' => 'normal', 'transform'=>'none', 'color' => '#ffffff'),
					"type" => "typography");

$of_options[] = array( "name" => __("Copyright menu link hover and active Color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "copyright_hover_menu_color",
					"std" => "#43b4f9",
					"type" => "color");

/* ------- Sliding top area options ----------------------------------------------------------------- */					
					
$of_options[] = array( "name" => __("Top area",'richer-framework'),
					"id" => __("toparea",'richer-framework'),
					"type" => "heading");

$of_options[] = array( "name" => __("Show top area?",'richer-framework'),
					"desc" => __("'On' - to show top area",'richer-framework'),
					"id" => "check_toparea",
					"std" => 0,
					"type" => "switch"); 

$of_options[] = array( "name" => __("Top area columns count",'richer-framework'),
					"desc" => __("Select how much columns do you need for your widgets in top area.",'richer-framework'),
					"id" => "toparea_columns_count",
					"std" => "3",
					"type" => "select",
					"options" => array('1', '2', '3', '4')
					);

$of_options[] = array( "name" => __("Top area background color",'richer-framework'),
					"desc" => __("Default: #515151",'richer-framework'),
					"id" => "bgcolor_toparea",
					"std" => "#515151",
					"type" => "color");

$of_options[] = array( "name" => __("Top area background opacity",'richer-framework'),
					"desc" => __("Use value from 0 -> 1 Default: 1",'richer-framework'),
					"id" => "bgopacity_toparea",
					"std" => "1",
					"type" => "text");

$of_options[] = array( "name" => __("Top area border top",'richer-framework'),
					"desc" => __("Default: 0px solid #142b3a",'richer-framework'),
					"id" => "border_top_toparea",
					"std" => array('width' => '0','style' => 'solid','color' => '#142b3a'),
					"type" => "border");

$of_options[] = array( "name" => __("Top area border bottom",'richer-framework'),
					"desc" => __("Default: 3px solid #43b4f9",'richer-framework'),
					"id" => "border_bottom_toparea",
					"std" => array('width' => '3','style' => 'solid','color' => '#43b4f9'),
					"type" => "border"); 

$of_options[] = array( "name" => __("Top area text color",'richer-framework'),
					"desc" => __("Default: #b5b5b5",'richer-framework'),
					"id" => "textcolor_toparea",
					"std" => "#b5b5b5",
					"type" => "color");

$of_options[] = array( "name" => __("Top area link color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_link_toparea",
					"std" => "#43b4f9",
					"type" => "color"); 

$of_options[] = array( "name" => __("Top area link hover color",'richer-framework'),
					"desc" => __("Default: #b5b5b5",'richer-framework'),
					"id" => "link_hover_color_toparea",
					"std" => "#b5b5b5",
					"type" => "color");
					
$of_options[] = array( "name" => __("Top area headline",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "font_headline_toparea",
					"std" => array('size' => '16px','face' => 'Open Sans','style' => '600', 'transform'=>'uppercase', 'color' => '#ffffff'),
					"type" => "typography");
					
$of_options[] = array( "name" => __("Top area headline border",'richer-framework'),
					"desc" => __("Default: 0px solid #777777",'richer-framework'),
					"id" => "border_headline_toparea",
					"std" => array('width' => '0','style' => 'solid','color' => '#777777'),
					"type" => "border"); 
/* ------------------------------------------------------------------------ */
/* Sidebar Navigation
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Side Navigation",'richer-framework'),
					"id" => "sidenav",
					"type" => "heading");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Side navigation parameters",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Sidebar Navigation Visibility",'richer-framework'),
					"desc" => __("Select how to display sidebar navigation.",'richer-framework'),
					"id" => "select_sidenav",
					"std" => 'hide',
					"type" => "select",
					"options" => array(
						'hide' => __('Hide','richer-framework'),
						'static' => __('Static','richer-framework'),
						'toggle' => __('Toggle','richer-framework'),
						)
					);

$of_options[] = array( "name" => __("Select sidebar navigation position",'richer-framework'),
					"desc" => "",
					"id" => "sidenav_position",
					"std" => "left",
					"type" => "images",
					"options" => array(
						"left" => get_template_directory_uri()."/admin/assets/images/2cl.png",
						"right" => get_template_directory_uri()."/admin/assets/images/2cr.png")
					);

$of_options[] = array( "name" => __("Disable header?",'richer-framework'),
					"desc" => __("You can disable your header if you enable sidebar navigation.", "richer-framework"),
					"id" => "disable_header",
					"std" => 0,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Text align in the sidebar navigation",'richer-framework'),
					"desc" => "",
					"id" => "select_sidenav_textalign",
					"std" => 'default',
					"type" => "select",
					"options" => array(
						'default' => __('Theme default','richer-framework'),
						'left' => __('Left','richer-framework'),
						'center' => __('Center','richer-framework'),
						'right' => __('Right','richer-framework')
						)
					);

$of_options[] = array( "name" => __("Disable dropdown menu indicator?",'richer-framework'),
					"desc" => __("You can disable indicator dropdown menu indicator.", "richer-framework"),
					"id" => "sidenav_disable_caret",
					"std" => 0,
					"type" => "checkbox");
$of_options[] = array( "name" => __("Sidebar navigation background image",'richer-framework'),
					"desc" => __("Upload your Sidebar navigation background image",'richer-framework'),
					"id" => "sidenav_media_bg",
					"std" => "",
					"mod" => "min",
					"type" => "media");

$of_options[] = array( "name" => __("Sidebar navigation background image options",'richer-framework'),
					"desc" => __("Select background options.",'richer-framework'),
					"id" => "sidenav_bg_options",
					"std" => array('repeat' => 'no-repeat', 'position-x'=>'center', 'position-y'=>'center', 'attachment'=>'scroll'),
					"type" => "background"
					);
$of_options[] = array( "name" => "",
					"desc" => __("Check if you need to have fullscreen background image.",'richer-framework'),
					"id" => "sidenav_bg_size",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Sidebar navigation background color.",'richer-framework'),
					"desc" => __("Default background color: #ffffff",'richer-framework'),
					"id" => "sidenav_bg_color",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Sidebar navigation text color.",'richer-framework'),
					"desc" => __("Default text color: #babdbf",'richer-framework'),
					"id" => "sidenav_text_color",
					"std" => "#babdbf",
					"type" => "color");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Sidebar navigation style",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Navigation items font options",'richer-framework'),
					"desc" => "",
					"id" => "sidenav_font_options",
					"std" => array('size' => '12px', 'height' => '36px','face' => 'Open Sans','style' => '600','transform'=>'uppercase','color' => '#3b3f42'),
					"type" => "typography");  					
					
$of_options[] = array( "name" => __("Navigation items hover/active color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "sidenav_active_color",
					"std" => "#43b4f9",
					"type" => "color");

$of_options[] = array( "name" => __("Dropdown Navigation background color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "sidenav_drop_bg_color",
					"std" => "#ffffff",
					"type" => "color");

$of_options[] = array( "name" => __("Dropdown Navigation items font options",'richer-framework'),
					"desc" => "",
					"id" => "sidenav_drop_font_options",
					"std" => array('size' => '13px', 'height' => '36px','face' => 'Open Sans','style' => '400','transform'=>'lowercase','color' => '#3b3f42'),
					"type" => "typography");  					
					
$of_options[] = array( "name" => __("Dropdown Navigation items hover/active color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "sidenav_drop_active_color",
					"std" => "#43b4f9",
					"type" => "color");	

$of_options[] = array( "name" => __("Logo for sidebar navigation.",'richer-framework'),
					"desc" => __("You can upload image logo for sidebar navigation (Toggle type). Logo should be squared. e.g 100x100",'richer-framework'),
					"id" => "square_media_logo",
					"std" => "",
					"mod" => "min",
					"type" => "media");				 
/* ------------------------------------------------------------------------ */
/* Titlebar
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Titlebar",'richer-framework'),
					"id" => __("titlebar",'richer-framework'),
					"type" => "heading");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Titlebar options",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Titlebar",'richer-framework'),
					"desc" => __("On/Off your titlebar by default",'richer-framework'),
					"id" => "switch_titlebar",
					"std" => 1,
					"on" => "On",
					"off" => "Off",
					"type" => "switch");

$of_options[] = array( "name" => __("Titlebar grid opacity",'richer-framework'),
					"desc" => __("Opacity of the grid. Between 0 (0%) and 1 (100%). Default: 0.8",'richer-framework'),
					"id" => "titlebar_gridopacity",
					"std" => "1",
					"type" => "text");

$of_options[] = array( "name" => __("Titlebar grid background color",'richer-framework'),
					"desc" => __("Grid background is overlay on your background image. Default: #f6f6f6",'richer-framework'),
					"id" => "titlebar_gridcolor",
					"std" => "#f6f6f6",
					"type" => "color");

$of_options[] = array( "name" => __("Titlebar padding outer",'richer-framework'),
					"desc" => __("You need to input padding parameters in 'px'",'richer-framework'),
					"id" => "titlebar_padding_outer",
					"std" => array('top' => '0', 'right'=>'0', 'bottom' => '0', 'left'=>'0'),
					"type" => "padding");

$of_options[] = array( "name" => __("Titlebar padding inner",'richer-framework'),
					"desc" => __("You need to input padding parameters in 'px'",'richer-framework'),
					"id" => "titlebar_padding_inner",
					"std" => array('top' => '25', 'right'=>'0', 'bottom' => '25', 'left'=>'0'),
					"type" => "padding");

$of_options[] = array( "name" => __("Titlebar background image",'richer-framework'),
					"desc" => __("This image is default titlebar background.",'richer-framework'),
					"id" => "media_titlebar",
					"std" => "",
					"mod" => "min",
					"type" => "media");	

$of_options[] = array( "name" => __("Titlebar background options",'richer-framework'),
					"desc" => "",
					"id" => "titlebar_background_options",
					"std" => array('repeat' => 'no-repeat', 'position-x'=>'center', 'position-y'=>'center', 'attachment'=>'scroll'),
					"type" => "background");

$of_options[] = array( "name" => "",
					"desc" => __("Check if you need to have fullscreen background image.",'richer-framework'),
					"id" => "titlebar_background_size",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Titlebar background color",'richer-framework'),
					"desc" => __("Default: #f6f6f6",'richer-framework'),
					"id" => "title_bg_color",
					"std" => "#f6f6f6",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Titlebar border top color",'richer-framework'),
					"desc" => __("Default: 1px solid #d8d8d8",'richer-framework'),
					"id" => "border_titletop",
					"std" => array('width' => '0','style' => 'solid','color' => '#d8d8d8'),
					"type" => "border"); 
					
$of_options[] = array( "name" => __("Titlebar border bottom color",'richer-framework'),
					"desc" => __("Default: 1px solid #d8d8d8",'richer-framework'),
					"id" => "border_titlebottom",
					"std" => array('width' => '1','style' => 'solid','color' => '#d8d8d8'),
					"type" => "border"); 

$of_options[] = array( "name" => __("Titlebar alignment",'richer-framework'),
					"desc" => "",
					"id" => "titlebar_alignment",
					"std" => 'left',
					"options" => array('left'=>__('Title left','richer-framework'), 'center'=>__('Center','richer-framework'), 'right'=>__('Title right','richer-framework')),
					"type" => "radio");

$of_options[] = array( "name" => __("Titlebar show breadcrumbs",'richer-framework'),
					"desc" => __("Check to show breadcrumbs on titlebar.",'richer-framework'),
					"id" => "check_breadcrumbs",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Title text font options",'richer-framework'),
					"desc" => "",
					"id" => "font_titleh1",
					"std" => array('size' => '18px','face' => 'Open Sans','style' => '600','transform'=>'uppercase','color' => '#333333'),
					"type" => "typography"); 
					
$of_options[] = array( "name" => __("Sub-title text font options",'richer-framework'),
					"desc" => "",
					"id" => "font_titleh2",
					"std" => array('size' => '13px','face' => 'Open Sans','style' => 'normal','transform'=>'uppercase','color' => '#999999'),
					"type" => "typography"); 
					
$of_options[] = array( "name" => __("Title breadcrumb color",'richer-framework'),
					"desc" => __("Default: #999999",'richer-framework'),
					"id" => "color_titlebreadcrumb",
					"std" => "#999999",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Title breadcrumb hover color",'richer-framework'),
					"desc" => __("Default: #333333",'richer-framework'),
					"id" => "color_titlebreadcrumbhover",
					"std" => "#333333",
					"type" => "color"); 

/* ------------------------------------------------------------------------ */
/* Typography
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Typography",'richer-framework'),
					"id" => "typography",
					"type" => "heading");
									
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Body",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Body text font options",'richer-framework'),
					"desc" => __("Specify the body font properties",'richer-framework'),
					"id" => "font_body",
					"std" => array('size' => '13px', 'height'=>'24px', 'face' => 'Open Sans', 'transform'=>'none', 'style' => 'normal','color' => '#717375'),
					"type" => "typography");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Headlines",'richer-framework'),
					"icon" => false,
					"type" => "info");
				
$of_options[] = array( "name" => __("H1 - headline font",'richer-framework'),
					"desc" => __("Specify the h1 headline font properties",'richer-framework'),
					"id" => "font_h1",
					"std" => array('size' => '46px','face' => 'Open Sans','style' => 'normal', 'transform'=>'uppercase', 'color' => '#333333'),
					"type" => "typography");  

$of_options[] = array( "name" => __("H2 - headline font",'richer-framework'),
					"desc" => __("Specify the h2 headline font properties",'richer-framework'),
					"id" => "font_h2",
					"std" => array('size' => '30px','face' => 'Open Sans','style' => 'normal', 'transform'=>'uppercase','color' => '#333333'),
					"type" => "typography");  
					
$of_options[] = array( "name" => __("H3 - headline font",'richer-framework'),
					"desc" => __("Specify the h3 headline font properties",'richer-framework'),
					"id" => "font_h3",
					"std" => array('size' => '24px','face' => 'Open Sans','style' => 'normal', 'transform'=>'uppercase','color' => '#333333'),
					"type" => "typography");  

$of_options[] = array( "name" => __("H4 - headline font",'richer-framework'),
					"desc" => __("Specify the h4 headline font properties",'richer-framework'),
					"id" => "font_h4",
					"std" => array('size' => '18px','face' => 'Open Sans','style' => 'normal', 'transform'=>'uppercase','color' => '#333333'),
					"type" => "typography");  
					
$of_options[] = array( "name" => __("H5 - headline font",'richer-framework'),
					"desc" => __("Specify the h5 headline font properties",'richer-framework'),
					"id" => "font_h5",
					"std" => array('size' => '14px','face' => 'Open Sans','style' => '600', 'transform'=>'uppercase','color' => '#333333'),
					"type" => "typography");  

$of_options[] = array( "name" => __("H6 - headline font",'richer-framework'),
					"desc" => __("Specify the h6 Headline font properties",'richer-framework'),
					"id" => "font_h6",
					"std" => array('size' => '13px','face' => 'Open Sans','style' => '600', 'transform'=>'uppercase','color' => '#333333'),
					"type" => "typography"); 
					
/* ------------------------------------------------------------------------ */
/* Styling
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Styling",'richer-framework'),
					"id" => "styling",
					"type" => "heading");
					
/* ------------------------------------------------------------------------ */

					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("General",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Accent color",'richer-framework'),
					"desc" => __("Specify the main theme color. Default: #43b4f9",'richer-framework'),
					"id" => "color_accent",
					"std" => "#43b4f9",
					"type" => "color"); 
					
/* ------------------------------------------------------------------------ */
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Links",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("Link color",'richer-framework'),
					"desc" => __("Specify the default link color. Default: #43b4f9",'richer-framework'),
					"id" => "color_link",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Link hover color",'richer-framework'),
					"desc" => __("Default: #89c603",'richer-framework'),
					"id" => "color_hover",
					"std" => "#89c603",
					"type" => "color"); 
					
/* ------------------------------------------------------------------------ */

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Buttons",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Buttons font style",'richer-framework'),
					"desc" => __("Specify the buttons font options.",'richer-framework'),
					"id" => "font_button",
					"std" => array('size' => '11px', 'height'=>'0', 'face' => 'Open Sans','style' => 'normal', 'transform'=>'uppercase', 'color' => '#ffffff'),
					"type" => "typography"); 

$of_options[] = array( "name" => __("Default button color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "button_color",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Default button hover color",'richer-framework'),
					"desc" => __("Default: #333333",'richer-framework'),
					"id" => "button_color_hover",
					"std" => "#333333",
					"type" => "color"); 
					
/* ------------------------------------------------------------------------ */
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Navigation",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Navigation font options",'richer-framework'),
					"desc" => __("Specify the main navigation font properties",'richer-framework'),
					"id" => "font_nav",
					"std" => array('size' => '13px', 'height'=>'0', 'face' => 'Open Sans','style' => '600','transform'=>'uppercase','color' => '#3b3f42'),
					"type" => "typography");


$of_options[] = array( "name" => __("Navigation link type",'richer-framework'),
					"desc" => __("Specify the main navigation link type.",'richer-framework'),
					"id" => "nav_link_type",
					"std" => 'text',
					"options" => array('text' => __('Text','richer-framework'),'button' => __('Button','richer-framework'),'button_hover' => __('Button when active','richer-framework')),
					"type" => "radio");

$of_options[] = array( "name" => __("Navigation link padding inner",'richer-framework'),
					"desc" => __("You need to input padding parameters in 'px'. Recommended to use with 'button' or 'button when active' navigation link type.",'richer-framework'),
					"id" => "nav_link_padding_inner",
					"std" => array('top' => '10', 'right'=>'15', 'bottom' => '10', 'left'=>'15'),
					"type" => "padding");

$of_options[] = array( "name" => __("Width between navigation links.",'richer-framework'),
					"desc" => __("Input your width between navigation links in 'px'.",'richer-framework'),
					"id" => "nav_link_width_between",
					"std" => "25",
					'mod' => 'mini',
					"type" => "text");

$of_options[] = array( "name" => __("Navigation link background color",'richer-framework'),
					"desc" => __("It works if you have selected 'button' type in previous option. Default: #43b4f9.",'richer-framework'),
					"id" => "nav_link_bg",
					"std" => "#43b4f9",
					"type" => "color");

$of_options[] = array( "name" => __("Navigation link hover Color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_navlinkhover",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Navigation link active color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_navlinkactive",
					"std" => "#43b4f9",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown menu background color",'richer-framework'),
					"desc" => __("Default: #f4f4f4",'richer-framework'),
					"id" => "color_submenubg",
					"std" => "#f4f4f4",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown menu top border",'richer-framework'),
					"desc" => __("Default: 3px solid #43b4f9",'richer-framework'),
					"id" => "color_submenuborder",
					"std" => array('width' => '3','style' => 'solid','color' => '#43b4f9'),
					"type" => "border"); 
					
$of_options[] = array( "name" => __("Dropdown menu link color",'richer-framework'),
					"desc" => __("Default: #3b3f42",'richer-framework'),
					"id" => "color_submenulink",
					"std" => "#3b3f42",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown menu link border color",'richer-framework'),
					"desc" => __("Specify the border beetwen dropdown menu items. Default: #dde2e5",'richer-framework'),
					"id" => "color_submenulinkborder",
					"std" => "#dde2e5",
					"type" => "color"); 
					
$of_options[] = array( "name" => __("Dropdown menu link hover and active color",'richer-framework'),
					"desc" => __("Default: #43b4f9",'richer-framework'),
					"id" => "color_submenulinkhover",
					"std" => "#43b4f9",
					"type" => "color"); 

$of_options[] = array( "name" => __("Dropdown menu link hover and active background color",'richer-framework'),
					"desc" => __("Default: #fafafa",'richer-framework'),
					"id" => "bgcolor_submenulinkhover",
					"std" => "#fafafa",
					"type" => "color");				

/* ------------------------------------------------------------------------ */
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Sidebar headlines",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("Sidebar widgets headline",'richer-framework'),
					"desc" => __("Specify the font options for sidebar titles.",'richer-framework'),
					"id" => "font_sidebarwidget",
					"std" => array('size' => '16px','face' => 'Open Sans','style' => '600', 'transform'=>'uppercase', 'color' => '#333333'),
					"type" => "typography"); 
					
/* ------------------------------------------------------------------------ */
/* Blog
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Blog",'richer-framework'),
					"id" => "blog",
					"type" => "heading");
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Blog options",'richer-framework'),
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => __("Blog layout",'richer-framework'),
					"desc" => __("Choose your default blog layout",'richer-framework'),
					"id" => "select_bloglayout",
					"std" => "Blog Fullwidth",
					"type" => "select",
					"options" => array('Blog Fullwidth'=>__('Blog Fullwidth','richer-framework'), 'Blog Medium'=>__('Blog Medium','richer-framework'), 'Grid'=>__('Grid','richer-framework'), 'List'=>__('List','richer-framework')));	
					
$of_options[] = array( "name" => __("Blog sidebar position",'richer-framework'),
					"desc" => __("Blog listing sidebar position",'richer-framework'),
					"id" => "select_blogsidebar",
					"std" => "sidebar-right",
					"type" => "select",
					"options" => array('none'=>__('None sidebar','richer-framework'), 'sidebar-left'=>__('Left sidebar','richer-framework'), 'sidebar-right'=>__('Right sidebar','richer-framework')));

$of_options[] = array( "name" => __("Meta information",'richer-framework'),
					"desc" => __("Click 'Enable' to show meta info for blog posts (author, date, tags, etc.)",'richer-framework'),
					"id" => "check_meta",
					"std" => 1,
					"on"=> __("Enable",'richer-framework'),
      				"off"=> __("Disable",'richer-framework'),
					"type" => "switch");

$of_options[] = array( "name" => "",
					"desc" => __("Author",'richer-framework'),
					"id" => "check_author",
					"std" => 1,
					"fold" => 'check_meta',
					"type" => "checkbox");
$of_options[] = array( "name" => "",
					"desc" => __("Date",'richer-framework'),
					"id" => "check_date",
					"std" => 1,
					"fold" => 'check_meta',
					"type" => "checkbox");
$of_options[] = array( "name" => "",
					"desc" => __("Comments",'richer-framework'),
					"id" => "check_comments",
					"std" => 1,
					"fold" => 'check_meta',
					"type" => "checkbox");
$of_options[] = array( "name" => "",
					"desc" => __("Tags",'richer-framework'),
					"id" => "check_tags",
					"std" => 0,
					"fold" => 'check_meta',
					"type" => "checkbox");
$of_options[] = array( "name" => "",
					"desc" => __("Categories",'richer-framework'),
					"id" => "check_categories",
					"std" => 1,
					"fold" => 'check_meta',
					"type" => "checkbox");

$of_options[] = array( "name" => "Show or hide 'big' date info?",
					"desc" => "",
					"id" => "check_big_date",
					"std" => 1,
					"on"=> __("Show",'richer-framework'),
      				"off"=> __("Hide",'richer-framework'),
					"type" => "switch");

$of_options[] = array( "name" => __("Enable 'Read More' button?",'richer-framework'),
					"desc" =>"",
					"id" => "check_readmore",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => __("Author info",'richer-framework'),
					"desc" => __("Enable author info on single post view?",'richer-framework'),
					"id" => "check_authorinfo",
					"std" => 1,
					"type" => "switch"); 

$of_options[] = array( "name" => __("Related Posts",'richer-framework'),
					"desc" => __("Enable related posts on single post view?",'richer-framework'),
					"id" => "check_relatedposts",
					"std" => 1,
					"type" => "switch"); 

$of_options[] = array( "name" => __("Posts navigation",'richer-framework'),
					"desc" => __("Enable posts navigation on single post view?",'richer-framework'),
					"id" => "check_postnavigation",
					"std" => 1,
					"type" => "switch");
					
$of_options[] = array( "name" => __("Blog excerpt length",'richer-framework'),
					"desc" => __("Default: 90. Used for blog page, archives & search results.",'richer-framework'),
					"id" => "text_excerptlength",
					"std" => "90",
					"mod" => 'mini',
					"type" => "text"); 

/*$of_options[] = array( "name" => __("Show image in excerpt?",'richer-framework'),
					"desc" => __("Check to show image in excerpts.",'richer-framework'),
					"id" => "blog_showimg_excerpt",
					"std" => 0,
					"type" => "checkbox"); */
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Blog title settings",'richer-framework'),
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => __("Blog title",'richer-framework'),
					"desc" => __("Input your blog title, it used on the title bar on blog page.",'richer-framework'),
					"id" => "text_blogtitle",
					"std" => "Blog Title Here",
					"type" => "text");
					

$of_options[] = array( "name" => __("Blog breadcrumb name",'richer-framework'),
					"desc" => __("Input your blog breadcrumb name, it used on the title bar on blog page, as home element.",'richer-framework'),
					"id" => "text_blogbreadcrumb",
					"std" => "Blog",
					"type" => "text");		

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Social sharing box icons",'richer-framework'),
					"icon" => false,
					"type" => "info"); 
$of_options[] = array( "name" => __("Enable social share-box on single post view?",'richer-framework'),
					"desc" =>"",
					"id" => "check_sharebox",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => __("Enable Facebook in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Facebook in social sharing box",'richer-framework'),
					"id" => "check_sharingboxfacebook",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Twitter in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Twitter in social sharing box",'richer-framework'),
					"id" => "check_sharingboxtwitter",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable LinkedIn in Social sharing box",'richer-framework'),
					"desc" => __("Check to enable LinkedIn in social sharing box",'richer-framework'),
					"id" => "check_sharingboxlinkedin",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Reddit in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Reddit in social sharing box",'richer-framework'),
					"id" => "check_sharingboxreddit",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Digg in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Digg in social sharing box",'richer-framework'),
					"id" => "check_sharingboxdigg",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Delicious in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Delicious in social sharing box",'richer-framework'),
					"id" => "check_sharingboxdelicious",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Enable Google in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Google in social sharing box",'richer-framework'),
					"id" => "check_sharingboxgoogle",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Enable E-Mail in social sharing box",'richer-framework'),
					"desc" => __("Check to enable E-Mail in social sharing box",'richer-framework'),
					"id" => "check_sharingboxemail",
					"fold" => "check_sharebox",
					"std" => 1,
					"type" => "checkbox"); 
					
/* ------------------------------------------------------------------------ */
/* Portfolio
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Portfolio",'richer-framework'),
					"id" => 'portfolio',
					"type" => "heading");
					
$of_options[] = array( "name" => __("Portfolio Singular Name",'richer-framework'),
					"desc" => __("Enter portfolio singular name. Name for one object of portfolio.",'richer-framework'),
					"id" => "text_portfolio_singular",
					"std" => "Portfolio Item",
					"type" => "text");

$of_options[] = array( "name" => __("Portfolio slug",'richer-framework'),
					"desc" => __("Enter the URL slug for your portfolio (Default: portfolio-item) <br /><strong>Go save your permalinks after changing this.</strong>",'richer-framework'),
					"id" => "text_portfolioslug",
					"std" => "portfolio-item",
					"type" => "text");

$of_options[] = array( "name" => __("Enable 'Singular name'",'richer-framework'),
					"desc" => __("Check to enable 'Singular name' in breadcrumbs. e.g. Home / <strong>Portfolio Item</strong> / Portfolio post #1 ",'richer-framework'),
					"id" => "check_singular_name",
					"std" => 1,
					"type" => "checkbox");  
					
$of_options[] = array( "name" => __("Items on portfolio one column",'richer-framework'),
					"desc" => __("Enter how many items you want to show on portfolio one column before pagination shows up (Default: 4)",'richer-framework'),
					"id" => "text_portfolioitems_1",
					"std" => "4",
					"mod" => 'mini',
					"type" => "text"); 
$of_options[] = array( "name" => __("Items on portfolio two column",'richer-framework'),
					"desc" => __("Enter how many items you want to show on portfolio two column before pagination shows up (Default: 6)",'richer-framework'),
					"id" => "text_portfolioitems_2",
					"std" => "6",
					"mod" => 'mini',
					"type" => "text"); 

$of_options[] = array( "name" => __("Items on portfolio three column",'richer-framework'),
					"desc" => __("Enter how many items you want to show on portfolio three column before pagination shows up (Default: 9)",'richer-framework'),
					"id" => "text_portfolioitems_3",
					"std" => "9",
					"mod" => 'mini',
					"type" => "text");

$of_options[] = array( "name" => __("Items on portfolio four column",'richer-framework'),
					"desc" => __("Enter how many items you want to show on portfolio four column before pagination shows up (Default: 12)",'richer-framework'),
					"id" => "text_portfolioitems_4",
					"std" => "12",
					"mod" => 'mini',
					"type" => "text"); 

$of_options[] = array( "name" => __("Portfolio filter",'richer-framework'),
					"desc" => __("Check to disable portfolio filter",'richer-framework'),
					"id" => "check_folio_filter",
					"fold" => "check_sharebox",
					"std" => 0,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Portfolio load more button",'richer-framework'),
					"desc" => __("Check to show load more button",'richer-framework'),
					"id" => "check_load_more_btn",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Load more button text",'richer-framework'),
					"desc" => '',
					"id" => "load_more_btn",
					"std" => "Load more",
					"type" => "text");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Social sharing box",'richer-framework'),
					"icon" => false,
					"type" => "info"); 

$of_options[] = array( "name" => __("Enable social share-box on single portfolio view?",'richer-framework'),
					"desc" =>"",
					"id" => "check_sharebox_folio",
					"std" => 1,
					"type" => "switch");

$of_options[] = array( "name" => __("Enable Facebook in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Facebook in social sharing box",'richer-framework'),
					"id" => "check_sharingboxfacebook_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Twitter in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Twitter in social sharing box",'richer-framework'),
					"id" => "check_sharingboxtwitter_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable LinkedIn in Social sharing box",'richer-framework'),
					"desc" => __("Check to enable LinkedIn in social sharing box",'richer-framework'),
					"id" => "check_sharingboxlinkedin_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Reddit in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Reddit in social sharing box",'richer-framework'),
					"id" => "check_sharingboxreddit_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Digg in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Digg in social sharing box",'richer-framework'),
					"id" => "check_sharingboxdigg_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 
					
$of_options[] = array( "name" => __("Enable Delicious in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Delicious in social sharing box",'richer-framework'),
					"id" => "check_sharingboxdelicious_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Enable Google in social sharing box",'richer-framework'),
					"desc" => __("Check to enable Google in social sharing box",'richer-framework'),
					"id" => "check_sharingboxgoogle_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Enable E-Mail in social sharing box",'richer-framework'),
					"desc" => __("Check to enable E-Mail in social sharing box",'richer-framework'),
					"id" => "check_sharingboxemail_folio",
					"fold" => "check_sharebox_folio",
					"std" => 1,
					"type" => "checkbox"); 
/* ------------------------------------------------------------------------ */
/* Woocommerce
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("WooCommerce",'richer-framework'),
					"id" => 'woocommerce',
					"type" => "heading");
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("WooCommerce settings",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => "",
					"desc" => '',
					"id" => "woocommerce_desc",
					"std" => __("Options below works only if you have installed and activated WooCommerce plugin.",'richer-framework'),
					"type" => "info-desc");

$of_options[] = array( "name" => __("Woocommerce items per page",'richer-framework'),
					"desc" => __("Enter how many items you want to show per page (Default: 12)",'richer-framework'),
					"id" => "woocommerce_items_per_page",
					"std" => "12",
					"mod" =>'mini',
					"type" => "text"); 

$of_options[] = array( "name" => __("Woocommerce sidebar position",'richer-framework'),
					"desc" => __("Woocommerce listing sidebar position",'richer-framework'),
					"id" => "select_shopsidebar",
					"std" => "sidebar-right",
					"type" => "select",
					"options" => array('none'=>__('None sidebar','richer-framework'), 'sidebar-left'=>__('Left sidebar','richer-framework'), 'sidebar-right'=>__('Right sidebar','richer-framework')));

$of_options[] = array( "name" => __("Disable sorting options",'richer-framework'),
					"desc" => __("Check to disable",'richer-framework'),
					"id" => "woocommerce_disable_sorting_options",
					"std" => 0,
					"type" => "checkbox"); 

$of_options[] = array( "name" => __("Show woocommerce cart link?",'richer-framework'),
					"desc" => __("Check to show dropdown shopping cart.",'richer-framework'),
					"id" => "woocommerce_show_cart",
					"std" => 'no_cart',
					"type" => "radio",
					"options" => array( 'top_bar' => __('Show in top bar menu','richer-framework'), 'main_nav' => __('Show in main navigation','richer-framework'), 'no_cart' => __('Disable shopping cart','richer-framework'))
					);

$of_options[] = array( "name" => __("Shop title",'richer-framework'),
					"desc" => __("Input your shop title, it used on the title bar on shop page.",'richer-framework'),
					"id" => "text_shoptitle",
					"std" => "Shop Title Here",
					"type" => "text");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Product item settings",'richer-framework'),
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Add-to-cart button options",'richer-framework'),
					"desc" => __("Select your button color from existing buttons list.",'richer-framework'),
					"id" => "select_shop_button",
					"std" => "lightgray",
					"type" => "select",
					"options" => array(
						'default'=>__('Default','richer-framework'), 
						'white'=>__('White','richer-framework'), 
						'lightgray'=>__('Light gray','richer-framework'),
						'blue'=>__('Blue','richer-framework'), 
						'lightgreen'=>__('Light green','richer-framework'), 
						'green'=>__('Green','richer-framework'),
						'pink'=>__('Pink','richer-framework'), 
						'red'=>__('Red','richer-framework'), 
						'orange'=>__('Orange','richer-framework'), 
						'yellow'=>__('Yellow','richer-framework'),
						'ginger'=>__('Ginger','richer-framework'), 
						'brown'=>__('Brown','richer-framework'), 
						'turquoise'=>__('Turquoise','richer-framework'), 
						'gray'=>__('Gray','richer-framework'), 
						'black'=>__('Black','richer-framework')
						)
					);

$of_options[] = array( "name" => __("Product item price color",'richer-framework'),
					"desc" => __("Default: #e52626",'richer-framework'),
					"id" => "shop_color_price",
					"std" => "#e52626",
					"type" => "color");

$of_options[] = array( "name" => __("Product item background color",'richer-framework'),
					"desc" => __("Default: #ffffff",'richer-framework'),
					"id" => "shop_item_bg_color",
					"std" => "#ffffff",
					"type" => "color");

/* ------------------------------------------------------------------------ */
/* Contact page
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Contact page",'richer-framework'),
					"id" => "contactpage",
					"type" => "heading");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Contact page",'richer-framework'),
					"icon" => false,
					"type" => "info"); 
					
$of_options[] = array( "name" => __("Contact Map",'richer-framework'),
					"desc" => __("Enter your address for embed google map.",'richer-framework'),
					"id" => "contact_map",
					"std" => "NY, USA",
					"type" => "text");

$of_options[] = array( "name" => __("Contact map zoom",'richer-framework'),
					"desc" => __("Enter your zoom level for google map.",'richer-framework'),
					"id" => "contact_map_zoom",
					"std" => "15",
					"mod" => 'mini',
					"type" => "text");

$of_options[] = array( "name" => __("Map Layout",'richer-framework'),
					"desc" => __("Choose your contact map layout",'richer-framework'),
					"id" => "select_map_layout",
					"std" => "Wide",
					"type" => "select",
					"options" => array('Wide'=>__('Fullwidth','richer-framework'), 'Boxed'=>__('Container width')));

$of_options[] = array( "name" => __("Disable contact map",'richer-framework'),
					"desc" => __("Check to disable contact map on contact page",'richer-framework'),
					"id" => "check_disablemap",
					"std" => 0,
					"type" => "checkbox");
/* ------------------------------------------------------------------------ */
/* Lightbox Settings
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Lightbox",'richer-framework'),
					"id" => 'lightbox',
					"type" => "heading");

$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => "Lightbox settings",
					"icon" => false,
					"type" => "info");

$of_options[] = array( "name" => __("Disable lightbox",'richer-framework'),
					"desc" => __("Check to disable lightbox. This will link directly to the image.",'richer-framework'),
					"id" => "lightbox_disable",
					"std" => 0,
					"type" => "checkbox");	

$of_options[] = array( "name" => __("Lightbox Theme",'richer-framework'),
					"desc" => "",
					"id" => "lightbox_theme",
					"std" => "pp_default",
					"type" => "select",
					"options" => array(
						'pp_default' => __('Default','richer-framework'),
						'light_rounded' => __('Light rounded','richer-framework'),
						'dark_rounded' => __('Dark rounded','richer-framework'),
						'light_square' => __('Light square','richer-framework'),
						'dark_square' => __('Dark square','richer-framework'),
						'facebook' => __('Facebook','richer-framework')
					));
					
$of_options[] = array( "name" => __("Animation speed",'richer-framework'),
					"desc" => "",
					"id" => "lightbox_animation_speed",
					"std" => "fast",
					"type" => "select",
					"options" => array('fast' => __('Fast','richer-framework'), 'slow' => __('Slow','richer-framework'), 'normal' => __('Normal','richer-framework'))
					);

$of_options[] = array( "name" => __("Background opacity",'richer-framework'),
					"desc" => "",
					"id" => "lightbox_opacity",
					"std" => "0.8",
					"mod" => 'mini',
					"type" => "text");

$of_options[] = array( "name" => __("Show title",'richer-framework'),
					"desc" => __("Check to show the title.",'richer-framework'),
					"id" => "lightbox_title",
					"std" => 1,
					"type" => "checkbox");
					
$of_options[] = array( "name" => __("Show gallery thumbnails",'richer-framework'),
					"desc" => __("Check to show gallery thumbnails.",'richer-framework'),
					"id" => "lightbox_gallery",
					"std" => 1,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Autoplay gallery",'richer-framework'),
					"desc" => __("Check to autoplay the lightbox gallery.",'richer-framework'),
					"id" => "lightbox_autoplay",
					"std" => 0,
					"type" => "checkbox");

$of_options[] = array( "name" => __("Autoplay gallery speed",'richer-framework'),
					"desc" => __("If autoplay is set to true, select the slideshow speed in ms. (Default: 5000, 1000 ms = 1 second)",'richer-framework'),
					"id" => "lightbox_slideshow_speed",
					"std" => "5000",
					"mod" => 'mini',
					"type" => "text");

$of_options[] = array( "name" => __("Social icons",'richer-framework'),
					"desc" => __("Check to show social sharing icons",'richer-framework'),
					"id" => "lightbox_social",
					"std" => 0,
					"type" => "checkbox");		
					
$of_options[] = array( "name" => __("Disable lightbox on smartphone",'richer-framework'),
					"desc" => __("Check to disable lightbox on smartphones. This will link directly to the image",'richer-framework'),
					"id" => "lightbox_smartphones",
					"std" => 0,
					"type" => "checkbox");		
/* ------------------------------------------------------------------------ */
/* Social
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Social media",'richer-framework'),
					"id" => 'socialmedia',
					"type" => "heading");
					
$of_options[] = array( "name" => "",
					"desc" => "",
					"id" => "general_heading",
					"std" => __("Enter your username / URL, leave blank to hide social icons",'richer-framework'),
					"icon" => false,
					"type" => "info");
					
$of_options[] = array( "name" => __("Twitter username",'richer-framework'),
					"desc" => __("Enter your Twitter username",'richer-framework'),
					"id" => "social_twitter",
					"std" => "wordpress",
					"type" => "text"); 

$of_options[] = array( "name" => __("Forrst URL",'richer-framework'),
					"desc" => __("Enter URL to your Forrst account",'richer-framework'),
					"id" => "social_forrst",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => __("Instagram URL",'richer-framework'),
					"desc" => __("Enter URL to your Instagram account",'richer-framework'),
					"id" => "social_instagram",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => __("Dribbble URL",'richer-framework'),
					"desc" => __("Enter URL to your Dribbble account",'richer-framework'),
					"id" => "social_dribbble",
					"std" => "#",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Flickr URL",'richer-framework'),
					"desc" => __("Enter URL to your Flickr account",'richer-framework'),
					"id" => "social_flickr",
					"std" => "#",
					"type" => "text"); 

$of_options[] = array( "name" => __("Facebook URL",'richer-framework'),
					"desc" => __("Enter URL to your Facebook account",'richer-framework'),
					"id" => "social_facebook",
					"std" => "#",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Skype URL",'richer-framework'),
					"desc" => __("Enter URL to your Skype account",'richer-framework'),
					"id" => "social_skype",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Digg URL",'richer-framework'),
					"desc" => __("Enter URL to your Digg account",'richer-framework'),
					"id" => "social_digg",
					"std" => "",
					"type" => "text"); 

$of_options[] = array( "name" => __("Google+ URL",'richer-framework'),
					"desc" => __("Enter URL to your Google+ account",'richer-framework'),
					"id" => "social_google_plus",
					"std" => "#",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("LinkedIn URL",'richer-framework'),
					"desc" => __("Enter URL to your LinkedIn account",'richer-framework'),
					"id" => "social_linkedin",
					"std" => "#",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Vimeo URL",'richer-framework'),
					"desc" => __("Enter URL to your Vimeo account",'richer-framework'),
					"id" => "social_vimeo",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Yahoo URL",'richer-framework'),
					"desc" => __("Enter URL to your Yahoo account",'richer-framework'),
					"id" => "social_yahoo",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Tumblr URL",'richer-framework'),
					"desc" => __("Enter URL to your Tumblr account",'richer-framework'),
					"id" => "social_tumblr",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("YouTube URL",'richer-framework'),
					"desc" => __("Enter URL to your YouTube account",'richer-framework'),
					"id" => "social_youtube",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Picasa URL",'richer-framework'),
					"desc" => __("Enter URL to your Picasa account",'richer-framework'),
					"id" => "social_picasa",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("DeviantArt URL",'richer-framework'),
					"desc" => __("Enter URL to your DeviantArt account",'richer-framework'),
					"id" => "social_deviantart",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Behance URL",'richer-framework'),
					"desc" => __("Enter URL to your Behance account",'richer-framework'),
					"id" => "social_behance",
					"std" => "",
					"type" => "text");
					
$of_options[] = array( "name" => __("Pinterest URL",'richer-framework'),
					"desc" => __("Enter URL to your Pinterest account",'richer-framework'),
					"id" => "social_pinterest",
					"std" => "#",
					"type" => "text");  
					
$of_options[] = array( "name" => __("PayPal URL",'richer-framework'),
					"desc" => __("Enter URL to your PayPal account",'richer-framework'),
					"id" => "social_paypal",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Delicious URL",'richer-framework'),
					"desc" => __("Enter URL to your Delicious account",'richer-framework'),
					"id" => "social_delicious",
					"std" => "",
					"type" => "text"); 
					
$of_options[] = array( "name" => __("Show RSS",'richer-framework'),
					"desc" => __("Check to show RSS icon",'richer-framework'),
					"id" => "social_rss",
					"std" => 1,
					"type" => "checkbox"); 
														
/* ------------------------------------------------------------------------ */
/* Custom CSS
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Custom CSS",'richer-framework'),
					"id" => 'customcss',
					"type" => "heading");
					
$of_options[] = array( "name" => __("Custom CSS",'richer-framework'),
					"desc" => __("Advanced CSS options. Paste your CSS code and it reload existing code style.",'richer-framework'),
					"id" => "textarea_csscode",
					"std" => "",
					"type" => "textarea"); 
/* ------------------------------------------------------------------------ */
/* Custom Font
/* ------------------------------------------------------------------------ */


$of_options[] = array( "name" => __("Custom Font",'richer-framework'),
					"id" => 'customfont',
					"type" => "heading");

$of_options[] = array( "name" => __('Font adding'),
					"desc" => "",
					"id" => "import_info",
					"std" => __("Notice: After adding the files please press 'Save All Changes'. Then refresh the page and your custom font will be available for the typography option in the end of the list.",'richer-framework'),
					"type" => "info-desc");
					
$of_options[] = array( "name" => __("Custom Font Name",'richer-framework'),
					"desc" => "",
					"id" => "custom_font_name",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __("Custom Font .eot",'richer-framework'),
					"desc" => __("Enter url to your font file",'richer-framework'),
					"id" => "custom_font_eot",
					"std" => "",
					"mod" => "min",
					"type" => "upload");
$of_options[] = array( "name" => __("Custom Font .woff",'richer-framework'),
					"desc" => __("Enter the path to your font file",'richer-framework'),
					"id" => "custom_font_woff",
					"std" => "",
					"mod" => "min",
					"type" => "upload");
$of_options[] = array( "name" => __("Custom Font .ttf",'richer-framework'),
					"desc" => __("Enter the path to your font file",'richer-framework'),
					"id" => "custom_font_ttf",
					"std" => "",
					"mod" => "min",
					"type" => "upload");
$of_options[] = array( "name" => __("Custom Font .svg",'richer-framework'),
					"desc" => __("Enter the path to your font file",'richer-framework'),
					"id" => "custom_font_svg",
					"std" => "",
					"mod" => "min",
					"type" => "upload");

										
/* ------------------------------------------------------------------------ */
/* Backup
/* ------------------------------------------------------------------------ */
$of_options[] = array( "name" => __("Backup options",'richer-framework'),
					"id" => 'backupoptions',
					"type" => "heading");
					
$of_options[] = array( "name" => __("Backup and restore options",'richer-framework'),
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => __("You can backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.",'richer-framework'),
					);
					
$of_options[] = array( "name" => __("Transfer theme options data",'richer-framework'),
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => __("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'import options'.
						",'richer-framework'),
					);

$of_options[] = array( "name" => "",
					"desc" => '',
					"id" => "theme_update",
					"std" => __("To get theme updates automatically, please fill settings below.<br /> <b>REMEBER:</b> Any customizations you have made to theme files will be lost after updating. Please, consider using child themes for modifications.",'richer-framework'),
					"type" => "info-desc");

$of_options[] = array( "name" => __("Your envato username",'richer-framework'),
					"desc" => __("Enter your enavto username",'richer-framework'),
					"id" => "username",
					"std" => "",
					"type" => "text");

$of_options[] = array( "name" => __("Your envato API key",'richer-framework'),
					"desc" => __("You can find API key by visiting your Envato Account page, then clicking the My Settings tab. At the bottom of the page you will find your accounts API key.",'richer-framework'),
					"id" => "apikey",
					"std" => "",
					"type" => "text");
					
	}
}
?>
