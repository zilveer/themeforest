<?php
//error_reporting(-1);

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}

		$favico_urls = get_template_directory_uri().'/img';
		$default_bg = get_template_directory_uri().'/img/';

		//Background Images Reader
		$bg_images_path = get_template_directory(). '/img/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 



		/*-----------------------------------------------------------------------------------*/
		/* Options/functions by ZERGE */
		/*-----------------------------------------------------------------------------------*/

		$ct_logotype = array ( "image" , "text" );
		$ct_logo_width = array ( "standard" , "wide" );

		$menu_position = array( "left" => "Left", "right" => "Right" );

		$post_content_excerpt = array ( "Content" , "Excerpt" );

		$ct_show_hide = array( "Show" , "Hide" );
		$ct_yes_no = array( "Yes" , "No" );
		$ct_enable_disable = array( "Enable" , "Disable" );

		$theme_bg_type = array ( "Color", "Uploaded", "Predefined" );
		$theme_bg_attachment = array ( "Scroll" , "Fixed" );

		$theme_bg_repeat = array ( "No-Repeat" , "Repeat", "Repeat-X" , "Repeat-Y" );
		$theme_bg_position = array ( "Left" , "Right", "Centered" , "Full Screen" );
		$show_top_banner = array ( "Upload" , "Code", "None" );

		$theme_bg_color = array ( "Background Image" , "Color", "Upload" );
		$theme_bg_attachment = array ( "Scroll" , "Fixed" );

		$ct_headline = array ( "Headline" , "Menu" );
		$pagination_type = array( "load_more" => "Show more button", "standard" => "Standard pagination" );

		$url =  ADMIN_DIR . 'assets/images/';


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
$prefix = 'ct_';

/*
=====================================================================================================================
					GENERAL SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "General Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"			=> "Select a layout for a Homepage",
						"desc"			=> "Select main content and sidebar alignment.",
						"id"			=>  "{$prefix}home_layout",
						"std"			=> "home_layout_1",
						"type"			=> "images",
						"options"		=> array(	'home_layout_1'		=> $url . 'home_layout_1.png',
													'home_layout_2'		=> $url . 'home_layout_2.png',
													'home_layout_3'		=> $url . 'home_layout_3.png',
													'home_layout_4'		=> $url . 'home_layout_4.png',
												)
				);

$of_options[] = array(	"name"		=> __( "RTL Styles" , "color-theme-framework" ),
						"desc"		=> __( "This option enables some RTL styles", "color-theme-framework" ),
						"id"		=> "{$prefix}rtl_styles",
						"std" 		=> 0,
						"on" 		=> __( "Enable" , "color-theme-framework" ),
						"off" 		=> __( "Disable" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Responsive Layout" , "color-theme-framework" ),
						"desc"		=> __( "Enable/Disable responsive layout", "color-theme-framework" ),
						"id"		=> "{$prefix}responsive_layout",
						"std" 		=> 1,
						"on" 		=> __( "Enable" , "color-theme-framework" ),
						"off" 		=> __( "Disable" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Retina JS" , "color-theme-framework" ),
						"desc"		=> __( "Enable/Disable JavaScript helper for rendering high-resolution image variants. retina.js makes it easy to serve high-resolution images to devices with retina displays.", "color-theme-framework" ),
						"id"		=> "{$prefix}is_retinajs",
						"std" 		=> 0,
						"on" 		=> __( "Enable" , "color-theme-framework" ),
						"off" 		=> __( "Disable" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Bootstrap JS" , "color-theme-framework" ),
						"desc"		=> __( "Enable/Disable Bootstrap JavaScript file.", "color-theme-framework" ),
						"id"		=> "{$prefix}is_bootstrapjs",
						"std" 		=> 0,
						"on" 		=> __( "Enable" , "color-theme-framework" ),
						"off" 		=> __( "Disable" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Custom Favicon" , "color-theme-framework" ),
						"desc"		=> __( "Upload a 16px x 16px Png/Gif image that will represent your website's favicon." , "color-theme-framework" ),
						"id" 		=> "{$prefix}custom_favicon",
						"std"		=> $favico_urls . "/favicon.ico",
						"type"		=> "upload"
				); 

$of_options[] = array(	"name"		=> __( "iOS icon 60x60 px" , "color-theme-framework" ),
						"desc"		=> __( "Upload iOS icon 60x60 px using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}ios_60_upload",
						"std"		=> get_template_directory_uri() . "/img/icons/apple-touch-icon.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "iOS icon 76x76 px" , "color-theme-framework" ),
						"desc"		=> __( "Upload iOS icon 76x76 px using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}ios_76_upload",
						"std"		=> get_template_directory_uri() . "/img/icons/apple-touch-icon-76x76.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "iOS icon 120x120 px" , "color-theme-framework" ),
						"desc"		=> __( "Upload iOS icon 120x120 px using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}ios_120_upload",
						"std"		=> get_template_directory_uri() . "/img/icons/apple-touch-icon-120x120.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "iOS icon 152x152 px" , "color-theme-framework" ),
						"desc"		=> __( "Upload iOS icon 152x152 px using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}ios_152_upload",
						"std"		=> get_template_directory_uri() . "/img/icons/apple-touch-icon-152x152.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Tracking Code" , "color-theme-framework" ),
						"desc"		=> __( "Paste your Google Analytics (or other) tracking code here." , "color-theme-framework" ),
						"id"		=> "{$prefix}google_analytics",
						"std"		=> "",
						"type"		=> "textarea"
				);


/*
=====================================================================================================================
					HEADER SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Header Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __( "Search Block" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide Search Block" , "color-theme-framework" ),
						"id" 		=> "{$prefix}show_search",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> "Logo & Menu Blocks Settings",
						"desc"		=> "",
						"id"		=> "introduction_logo_width",
						"std"		=> "<h3 style=\"margin: 0;\">Logo & Menu Blocks Settings</h3> Please note that width of logo+menu should be always col-lg-12 (for example: col-lg-3 + col-lg-9 = col-lg-12)",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array(	"name"		=> __( "Logo Block Width" , "color-theme-framework" ),
						"desc"		=> __( "Select your logo block width." , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_block_width",
						"std"		=> "col-lg-3",
						"type"		=> "select",
						"options" 	=> array(
											'col-lg-1'		=> 'col-lg-1',
											'col-lg-2'		=> 'col-lg-2',
											'col-lg-3'		=> 'col-lg-3',
											'col-lg-4'		=> 'col-lg-4',
											'col-lg-5'		=> 'col-lg-5',
											'col-lg-6'		=> 'col-lg-6',
											'col-lg-7'		=> 'col-lg-7',
											'col-lg-8'		=> 'col-lg-8',
											'col-lg-9'		=> 'col-lg-9'
						)
				);

$of_options[] = array(	"name"		=> __( "Search/Social/Banner Block Width" , "color-theme-framework" ),
						"desc"		=> __( "Select the block width." , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_block_width",
						"std"		=> "col-lg-9",
						"type"		=> "select",
						"options" 	=> array(
											'col-lg-1'		=> 'col-lg-1',
											'col-lg-2'		=> 'col-lg-2',
											'col-lg-3'		=> 'col-lg-3',
											'col-lg-4'		=> 'col-lg-4',
											'col-lg-5'		=> 'col-lg-5',
											'col-lg-6'		=> 'col-lg-6',
											'col-lg-7'		=> 'col-lg-7',
											'col-lg-8'		=> 'col-lg-8',
											'col-lg-9'		=> 'col-lg-9'
						)
				);

$of_options[] = array(	"name"		=> __( "Show banner or search/social icons" , "color-theme-framework" ),
						"desc"		=> __( "Select the block to display." , "color-theme-framework" ),
						"id"		=> "{$prefix}header_blocks",
						"std"		=> "Search-Social",
						"type"		=> "select",
						"options" 	=> array(
							'searchsocial'	=> 'Search-Social',
							'banner'		=> 'Banner'
						)
				);

$of_options[] = array(	"name"		=>  __( "Header Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #2b373f)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}header_background",
						"std"		=> "#2b373f",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Use Predefined Header Image / BG Color / Upload Your Image" , "color-theme-framework" ),
						"desc"		=> __( "Select the type of usage header background" , "color-theme-framework" ),
						"id"		=> "{$prefix}header_bg_type",
						"std"		=> 'Color',
						"type"		=> "select",
						"options"	=> $theme_bg_type
				);

$of_options[] = array(	"name"		=> __( "Header Background Repeat" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background repeat for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}header_bg_repeat",
						"std"		=> 'Repeat',
						"type"		=> "select",
						"options"	=> $theme_bg_repeat
				);

$of_options[] = array(	"name"		=> __( "Uploaded Header Background Image" , "color-theme-framework" ),
						"desc"		=> __( "Upload image for header background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}header_bg_image",
						"std"		=> $default_bg . "bg_default.jpg",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Predefined Header Background Images" , "color-theme-framework" ),
						"desc"		=> __( "Select a header background pattern." , "color-theme-framework" ),
						"id"		=> "{$prefix}header_predefined_bg",
						"std"		=> $bg_images_url."bg_default.jpg",
						"type"		=> "tiles",
						"options"	=> $bg_images,
				);


/*
=====================================================================================================================
					LOGO SETTINGS
=====================================================================================================================	
*/
$of_options[] = array(	"name"		=> __( "Logo Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __("Width of Logo","color-theme-framework"),
						"desc"		=> __("Select your logo width" , "color-theme-framework"),
						"id"		=> "{$prefix}logo_width",
						"std"		=> "standard",
						"type"		=> "select",
						"options"	=> $ct_logo_width
				);

$of_options[] = array(	"name"		=> __("Type of Logo","color-theme-framework"),
						"desc"		=> __("Select your logo type ( Image or Text )" , "color-theme-framework"),
						"id"		=> "{$prefix}type_logo",
						"std"		=> "image",
						"type"		=> "select",
						"options"	=> $ct_logotype
				);

$of_options[] = array(	"name"		=> __( "Logo Upload" , "color-theme-framework" ),
						"desc"		=> __( "Upload image using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_upload",
						"std"		=> get_template_directory_uri() . "/img/logo.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Retina Logo Upload" , "color-theme-framework" ),
						"desc"		=> __( "Upload image using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_retina_upload",
						"std"		=> get_template_directory_uri() . "/img/logo@2x.png",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Logo Text" , "color-theme-framework" ),
						"desc"		=> __( "Enter text for logo" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_text",
						"std"		=> "Your Logo",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Logo Text Settings" , "color-theme-framework" ),
						"desc"		=> "Specify the logo text font properties",
						"id"		=> "{$prefix}logo_font",
						"std"		=> array('size' => '36px','height' => '40px', 'style' => 'normal','color' => '#ff003c'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "Logo Slogan" , "color-theme-framework" ),
						"desc"		=> __( "Enter text for logo slogan" , "color-theme-framework" ),
						"id"		=> "{$prefix}logo_slogan",
						"std"		=> "Just some slogan text",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Logo Slogan Settings" , "color-theme-framework" ),
						"desc"		=> "Specify the logo slogan text font properties",
						"id"		=> "{$prefix}logo_slogan_font",
						"std"		=> array('size' => '14px','height' => '24px', 'style' => 'normal','color' => '#FFFFFF'),
						"type"		=> "typography"
				);

$of_options[] = array( 	"name" 		=> __( "Top Margin" , "color-theme-framework"),
						"desc" 		=> __("Set the top margin <br /> Min: 0, max: 100, step: 1, default value: 40" , "color-theme-framework"),
						"id" 		=> "{$prefix}logo_top_margin",
						"std" 		=> "40",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Right Margin" , "color-theme-framework"),
						"desc" 		=> __("Set the right margin <br /> Min: 0, max: 100, step: 1, default value: 0" , "color-theme-framework"),
						"id" 		=> "{$prefix}logo_right_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Bottom Margin" , "color-theme-framework"),
						"desc" 		=> __("Set the bottom margin <br /> Min: 0, max: 100, step: 1, default value: 0" , "color-theme-framework"),
						"id" 		=> "{$prefix}logo_bottom_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Left Margin" , "color-theme-framework"),
						"desc" 		=> __("Set the left margin <br /> Min: 0, max: 100, step: 1, default value: 0" , "color-theme-framework"),
						"id" 		=> "{$prefix}logo_left_margin",
						"std" 		=> "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

/*
=====================================================================================================================
					SOCIAL ICONS
=====================================================================================================================	
*/


$of_options[] = array(	"name"		=> __( "Social Icons" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __( "Social Icons Block" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide the Social Icons Block" , "color-theme-framework" ),
						"id" 		=> "{$prefix}sc_block",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=>  __( "Font Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a font color (default: #999999)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}social_font_color",
						"std"		=> "#FFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> "Social Icons Settings",
						"desc"		=> "",
						"id"		=> "introduction_social_icons",
						"std"		=> "<h3 style=\"margin: 0;\">Social Icons Settings</h3> To hide any icon, just remove the URL from the appropriate field",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array(	"name"		=> __( "Android" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}android_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Apple" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}apple_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Dribbble" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}dribbble_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "GitHub" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}github_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Flickr" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}flickr_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Youtube" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}youtube_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Linkedin" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}linkedin_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Instagram" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}instagram_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Skype" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}skype_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Pinterest" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}pinterest_url",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Google" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}google_url",
						"std"		=> "http://www.google.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Twitter" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}twitter_url",
						"std"		=> "http://www.twitter.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Facebook" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}facebook_url",
						"std"		=> "http://www.facebook.com",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "RSS" , "color-theme-framework" ),
						"desc"		=> __( "Enter the URL in the text field" , "color-theme-framework" ),
						"id"		=> "{$prefix}rss_url",
						"std"		=> "http://www.rss.com",
						"type"		=> "text"
				);
/*
=====================================================================================================================
					MENU SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Menu Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Sticky Menu?" , "color-theme-framework" ),
						"desc"		=> __( "Use sticky menu?", "color-theme-framework" ),
						"id"		=> "{$prefix}sticky_menu",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"						
				);

$of_options[] = array(	"name"		=> __( "Menu Position" , "color-theme-framework" ),
						"desc"		=> __( "Select menu position", "color-theme-framework" ),
						"id"		=> "{$prefix}menu_position",
						"std"		=> "Left",
						"type"		=> "select",
						"options"	=> $menu_position
				);

$of_options[] = array(	"name"		=> __( "Use Google Font for the Menu " , "color-theme-framework" ),
						"desc"		=> __( "Use Google Font for the Menu" , "color-theme-framework" ),
						"id"		=> "{$prefix}use_menu_gf",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=>  __( "Google Font for the Menu" , "color-theme-framework"),
						"desc"		=> __("Select the Google Font for the Menu" , "color-theme-framework"),
						"id"		=> "{$prefix}menu_google_fonts",
						"std"		=> array('face' =>'Maven Pro'),
						"type"		=> "typography",
						"fold" 		=> "{$prefix}use_menu_gf"
				);

$of_options[] = array(	"name"		=> __( "Menu Default Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a default background color for menu (default: #434d54)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}menu_default_bg_color",
						"std"		=> "#434d54",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Top-level Menu Font" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for top-level menu font" , "color-theme-framework"),
						"id"		=> "{$prefix}menu_font",
						"std"		=> array(
											'size'	=> '18px',
											'style'	=> 'bold',
											'color'	=> '#FFF'
										),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "Top-level Menu Font Hover Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a font hover color for the top-level menu (default: #363636)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}menu_hover_color",
						"std"		=> "#363636",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Top-level Menu Hover Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a hover background color (default: #FFFFFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}menu_hover_background",
						"std"		=> "#FFFFFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Top-level Menu Text-Transform" , "color-theme-framework" ),
						"desc"		=> __( "The text-transform property controls the capitalization of text." , "color-theme-framework" ),
						"id"		=> "{$prefix}menu_transform",
						"std"		=> "Uppercase",
						"type"		=> "select",
						"options" 	=> array(
							'uppercase'		=> 'Uppercase',
							'capitalize'	=> 'Capitalize',
							'lowercase'		=> 'Lowercase',
							'none'			=> 'None'
						)
				);

$of_options[] = array(	"name"		=> __( "Drop-Down Menu Font" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for submenu font" , "color-theme-framework"),
						"id"		=> "{$prefix}dd_menu_font",
						"std"		=> array(
											'size'	=> '12px',
											'style'	=> 'normal',
											'color'	=> '#363636'
										),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "Drop-Down Menu Font Hover Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a font hover color for the drop-down menu (default: #ff003c)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}dd_menu_hover_color",
						"std"		=> "#ff003c",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Drop-Down Menu Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #FFFFFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}dd_menu_background",
						"std"		=> "#FFFFFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Drop-Down Menu Hover Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a hover background color (default: #EBEBEB)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}dd_menu_hover_background",
						"std"		=> "#EBEBEB",
						"type"		=> "color"
				);

$of_options[] = array( 	"name" 		=> __( "Background Opacity for Drop-Down Menu" , "color-theme-framework"),
						"desc" 		=> __("Set opacity for drop-down menu<br /> Min: 0, max: 1, step: 0.01, default value: 1" , "color-theme-framework"),
						"id" 		=> "{$prefix}dd_menu_opacity",
						"std"		=> "1",
						"type"		=> "text"
				);

$of_options[] = array( 	"name" 		=> __( "Menu Item Top Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the top padding for top-level menu item <br /> Min: 0, max: 100, step: 1, default value: 29" , "color-theme-framework"),
						"id" 		=> "{$prefix}menu_top_padding",
						"std" 		=> "29",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Menu Item Right Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the right padding for top-level menu item <br /> Min: 0, max: 100, step: 1, default value: 28" , "color-theme-framework"),
						"id" 		=> "{$prefix}menu_right_padding",
						"std" 		=> "28",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Menu Item Bottom Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the bottom padding for top-level menu item <br /> Min: 0, max: 100, step: 1, default value: 29" , "color-theme-framework"),
						"id" 		=> "{$prefix}menu_bottom_padding",
						"std" 		=> "29",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Menu Item Left Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the left padding for top-level menu item <br /> Min: 0, max: 100, step: 1, default value: 28" , "color-theme-framework"),
						"id" 		=> "{$prefix}menu_left_padding",
						"std" 		=> "28",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);


/*
=====================================================================================================================
					STYLING SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Styling Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Body Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #f5f5f5)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}body_background",
						"std"		=> "#f5f5f5",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Links color" , "color-theme-framework"),
						"desc"		=> __("Pick a color for the links (default: #ff003c)" , "color-theme-framework"),
						"id"		=> "{$prefix}links_color",
						"std"		=> "#ff003c",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Links color (alternative)" , "color-theme-framework"),
						"desc"		=> __("Pick a color for the alternative links (widgets, etc) (default: #455058)" , "color-theme-framework"),
						"id"		=> "{$prefix}links_alt_color",
						"std"		=> "#455058",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Links hover color" , "color-theme-framework"),
						"desc"		=> __("Pick a color for the links hover (default: #ff003c)" , "color-theme-framework"),
						"id"		=> "{$prefix}links_hover_color",
						"std"		=> "#ff003c",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Meta Font Settings" , "color-theme-framework" ),
						"desc"		=> __( "Define a meta font settings (author, date, icons, etc.)" , "color-theme-framework" ), 
						"id"		=> "{$prefix}meta_font",
						"std"		=> array('size' => '11px','style' => 'normal','color' => '#A7A7A7'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> "Default Background Settings",
						"desc"		=> "",
						"id"		=> "introduction",
						"std"		=> "<h3 style=\"margin: 0 0 10px;\">Default Background Settings.</h3> The following settings allow you to set the default background behavior for each page. Each of these options can be overridden on the individual post/page/ level. You are in complete control.",
						"icon"		=> true,
						"type"		=> "info"
				);

$of_options[] = array(	"name"		=> __( "Use Predefined Background Image / BG Color / Upload Your Image" , "color-theme-framework" ),
						"desc"		=> __( "Select the type of usage background" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_type",
						"std"		=> 'Color',
						"type"		=> "select",
						"options"	=> $theme_bg_type
				);

$of_options[] = array(	"name"		=> __( "Background Attachment" , "color-theme-framework" ),
						"desc"		=> __( "Select the background image property" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_attachment",
						"std"		=> 'Fixed',
						"type"		=> "select",
						"options"	=> $theme_bg_attachment
				);

$of_options[] = array(	"name"		=> __( "Background Repeat" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background repeat for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_repeat",
						"std"		=> 'Repeat',
						"type"		=> "select",
						"options"	=> $theme_bg_repeat
				);

$of_options[] = array(	"name"		=> __( "Background Position" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background position for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_position",
						"std"		=> 'Left',
						"type"		=> "select",
						"options"	=> $theme_bg_position
				);

$of_options[] = array(	"name"		=> __( "Uploaded Background Image" , "color-theme-framework" ),
						"desc"		=> __( "Upload image for background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}default_bg_image",
						"std"		=> $default_bg . "default-bg.jpg",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Predefined Background Images" , "color-theme-framework" ),
						"desc"		=> __( "Select a background pattern." , "color-theme-framework" ),
						"id"		=> "{$prefix}default_predefined_bg",
						"std"		=> $bg_images_url."bg01.jpg",
						"type"		=> "tiles",
						"options"	=> $bg_images,
				);

$of_options[] = array(	"name"		=> __( "Custom CSS" , "color-theme-framework" ),
						"desc"		=> __( "Quickly add some CSS to your theme by adding it to this block." , "color-theme-framework" ),
						"id"		=> "{$prefix}custom_css",
						"std"		=> "",
						"type"		=> "textarea"
				);

/*
=====================================================================================================================
					Headings Styles
=====================================================================================================================	
*/
					
$of_options[] = array(	"name"		=> __( "Headings Styles" , "color-theme-framework"),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=>  __( "Google Fonts for Headings" , "color-theme-framework"),
						"desc"		=> __("Select Google Font for H1-H6 Headings " , "color-theme-framework"),
						"id"		=> "{$prefix}google_fonts",
						"std"		=> array('face' =>'Maven Pro'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> "Body Font",
						"desc"		=> "Define the body font properties",
						"id"		=> "{$prefix}body_font",
						"std"		=> array('size' => '14px','height' => '24px', 'color' => '#363636'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H1 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for H1 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_one",
						"std"		=> array('size' => '36px','height' => '40px', 'style' => 'normal','color' => '#363636'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H2 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for H2 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_two",
						"std"		=> array('size' => '30px', 'height' => '40px', 'style' => 'normal','color' => '#363636'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H3 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for H3 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_three",
						"std"		=> array('size' => '24px','height' => '28px','style' => 'normal','color' => '#363636'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H4 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for H4 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_four",
						"std"		=> array('size' => '18px','height' => '20px','style' => 'normal','color' => '#363636'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "H5 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for H5 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_five",
						"std"		=> array('size' => '14px','height' => '16px','style' => 'normal','color' => '#363636'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=>  __( "H6 Heading" , "color-theme-framework"),
						"desc"		=> __("Choose the parameters for H6 Heading" , "color-theme-framework"),
						"id"		=> "{$prefix}h_six",
						"std"		=> array('size' => '12px','height' => '16px','style' => 'normal','color' => '#363636'),
						"type"		=> "typography"
				);


/*
=====================================================================================================================
					BLOG SETTINGS
=====================================================================================================================	
*/


$of_options[] = array(	"name"		=> __( "Blog Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"			=> "Select a layout for a Blog page",
						"desc"			=> "Select main content and sidebar alignment.",
						"id"			=>  "{$prefix}blog_layout",
						"std"			=> "right-wide",
						"type"			=> "images",
						"options"		=> array(	'right-wide'		=> $url . 'category_layout_2.png',
													'right-narrow'		=> $url . 'category_layout_1.png',
													'left-wide'			=> $url . 'category_layout_4.png',
													'left-narrow'		=> $url . 'category_layout_3.png',
												)
				);


$of_options[] = array(	"name"		=> __( "Type of pagination for a Blog page" , "color-theme-framework" ),
						"desc"		=> __( "Select a pagination type for a Blog" , "color-theme-framework" ),
						"id"		=> "{$prefix}blog_pagination_type",
						"std"		=> "load_more",
						"type"		=> "select",
						"options"	=> $pagination_type
					);

$of_options[] = array( 	"name" 		=> __( "Length of the Excerpt for a Blog page " , "color-theme-framework"),
						"desc" 		=> __("Set the length of the excerpt in chars<br /> Min: 1, max: 500, step: 1, default value: 200" , "color-theme-framework"),
						"id" 		=> "{$prefix}blog_excerpt_lenght",
						"std" 		=> "200",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "500",
						"type" 		=> "sliderui" 
				);

$of_options[] = array(	"name"		=> __( "Blog Page Title Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #2b373f)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}blog_title_color",
						"std"		=> "#2b373f",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Number of posts to display for a Blog widget:" , "color-theme-framework" ),
						"id"		=> "{$prefix}blog_num_posts",
						"std"		=> "3",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Blog Post Meta Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #35a6e0)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}meta_background",
						"std"		=> "#35a6e0",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Blog Post Meta Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a color (text, icons) (default: #FFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}meta_color",
						"std"		=> "#FFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Blog Post Meta Color (Hover)" , "color-theme-framework" ),
						"desc"		=> __( "Pick a hover color (text, icons) (default: #363636)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}meta_color_hover",
						"std"		=> "#363636",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> "Blog Post Title",
						"desc"		=> "Specify the blog post title font properties",
						"id"		=> "{$prefix}post_title_font",
						"std"		=> array('size' => '18px','height' => '26px', 'style' => 'bold','color' => '#333333'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=> __( "Blog Post Title Text-Transform" , "color-theme-framework" ),
						"desc"		=> __( "The text-transform property controls the capitalization of text." , "color-theme-framework" ),
						"id"		=> "{$prefix}post_title_transform",
						"std"		=> "Uppercase",
						"type"		=> "select",
						"options" 	=> array(
							'none'			=> 'None',
							'capitalize'	=> 'Capitalize',
							'uppercase'		=> 'Uppercase',
							'lowercase'		=> 'Lowercase'
						)
				);

$of_options[] = array( "name"		=> "Blog Post Meta Settings",
					"desc"			=> "",
					"id"			=> "introduction_blog_post",
					"std"			=> "<h3 style=\"margin: 0;\">Blog Post Meta Settings.</h3>",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array( 	"name" 		=> __( "Size of the Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the size of the padding (left and right) for the meta blocks" , "color-theme-framework"),
						"id" 		=> "{$prefix}lr_padding_meta",
						"std" 		=> "20",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "50",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Author" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post author" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_author_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Views" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post views" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_views_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Likes" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post likes" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_likes_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Date" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post date" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_date_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Categories" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post categories" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_categories_meta",
						"std" 		=> 0,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Comments" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post comments" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_comments_meta",
						"std" 		=> 0,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Share" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post share" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_share_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Readmore Button" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post Readmore button" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_readmore_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Show iframe player for audio & video posts" , "color-theme-framework" ),
						"id" 		=> "{$prefix}blog_show_iframe",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"
				);


/*
=====================================================================================================================
					Category Page Settings
=====================================================================================================================	
*/
$of_options[] = array(	"name"		=> __( "Category Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"			=> "Select a layout for Categories (tags, archives, etc.) pages",
						"desc"			=> "Select main content and sidebar alignment.",
						"id"			=>  "{$prefix}category_layout",
						"std"			=> "right-wide",
						"type"			=> "images",
						"options"		=> array(	'right-wide'		=> $url . 'category_layout_2.png',
													'right-narrow'		=> $url . 'category_layout_1.png',
													'left-wide'			=> $url . 'category_layout_4.png',
													'left-narrow'		=> $url . 'category_layout_3.png',
												)
				);

$of_options[] = array(	"name"		=> __( "Type of pagination" , "color-theme-framework" ),
						"desc"		=> __( "Select a pagination type for blog, category, tags, etc." , "color-theme-framework" ),
						"id"		=> "{$prefix}cat_pagination_type",
						"std"		=> "load_more",
						"type"		=> "select",
						"options"	=> $pagination_type
					);

$of_options[] = array( 	"name" 		=> __( "Length of the Excerpt for Category (tag, archive, etc.) page " , "color-theme-framework"),
						"desc" 		=> __("Set the length of the excerpt in chars<br /> Min: 1, max: 500, step: 1, default value: 200" , "color-theme-framework"),
						"id" 		=> "{$prefix}cat_excerpt_lenght",
						"std" 		=> "200",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "500",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( "name"		=> "Category Post Meta Settings",
					"desc"			=> "",
					"id"			=> "introduction_single_post",
					"std"			=> "<h3 style=\"margin: 0;\">Category Post Meta Settings.</h3>",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array( 	"name" 		=> __( "Author" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post author" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_author_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Views" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post views" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_views_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Likes" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post likes" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_likes_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Date" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post date" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_date_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Categories" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post categories" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_categories_meta",
						"std" 		=> 0,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Comments" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post comments" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_comments_meta",
						"std" 		=> 0,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Share" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post share" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_share_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Readmore Button" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide category post Readmore button" , "color-theme-framework" ),
						"id" 		=> "{$prefix}category_readmore_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Show iframe player for audio & video posts" , "color-theme-framework" ),
						"id" 		=> "{$prefix}cat_show_iframe",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"
				);


/*
=====================================================================================================================
					Single Page Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Single Page Options" , "color-theme-framework" ),
						"type"		=> "heading");

$of_options[] = array(	"name"		=> __( "Featured image" , "color-theme-framework" ),
						"desc"		=> __( "Show or Hide featured image in the single post" , "color-theme-framework" ),
						"id"		=> "{$prefix}featured_image_post",
						"std"		=> 1,
						"on"		=> __( "Show" , "color-theme-framework" ),
						"off"		=> __( "Hide" , "color-theme-framework" ),
						"type"		=> "switch"
				);

$of_options[] = array( 	"name"		=> __( "Stretch thumbnail post images" , "color-theme-framework" ),
						"desc" 		=> __( "Stretch or Not thumbnail post images" , "color-theme-framework" ),
						"id" 		=> "{$prefix}thumb_posts_stretch",
						"std" 		=> 1,
						"on" 		=> __( "Yes" , "color-theme-framework" ),
						"off" 		=> __( "No" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( "name"		=> __( "Add PrettyPhoto feature to all post images" , "color-theme-framework" ),
						"desc"		=> __( "Add PrettyPhoto feature to all post images with links" , "color-theme-framework" ),
						"id"		=> "{$prefix}add_prettyphoto",
						"std"		=> 1,
						"on"		=> __( "Yes" , "color-theme-framework" ),
						"off"		=> __( "No" , "color-theme-framework" ),
						"type"		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "About Author" , "color-theme-framework" ),
						"desc"		=> __( "Show or Hide about author information in the single post" , "color-theme-framework" ),
						"id"		=> "{$prefix}about_author",
						"std"		=> 1,
						"on"		=> __( "Show" , "color-theme-framework" ),
						"off"		=> __( "Hide" , "color-theme-framework" ),
						"type"		=> "switch"
				);

$of_options[] = array( "name"		=> "Single Post Meta Settings",
					"desc"			=> "",
					"id"			=> "introduction_single_post",
					"std"			=> "<h3 style=\"margin: 0;\">Single Post Meta Settings.</h3>",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array( 	"name" 		=> __( "Author" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post author" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_author_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Views" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post views" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_views_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Likes" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post likes" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_likes_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Date" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post date" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_date_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Categories" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post categories" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_categories_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Comments" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post comments" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_comments_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> __( "Share" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide blog post share" , "color-theme-framework" ),
						"id" 		=> "{$prefix}single_share_meta",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

/*$of_options[] = array(	"name"		=> __( "Code for bookmarking and sharing services" , "color-theme-framework" ),
						"desc"		=> __( "Paste code for bookmarking and sharing services (for example: www.addthis.com, www.sharethis.com, etc. )" , "color-theme-framework" ),
						"id"		=> "{$prefix}code_single_post_sharing",
						"std"		=> "",
						"type"		=> "textarea"
				);*/

/*
=====================================================================================================================
					Woocommerce
=====================================================================================================================	
*/
$of_options[] = array( 	"name" 		=> __( "Woocommerce Settings" , "color-theme-framework" ),
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> __( "Title for Shop Page" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide title for shop page" , "color-theme-framework" ),
						"id" 		=> "{$prefix}shop_show_title",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array( 	"name" 		=> __( "Woocommerce Breadcrumbs" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide breadcrumbs for Shop" , "color-theme-framework" ),
						"id" 		=> "{$prefix}woo_show_breadcrumb",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array(	"name"		=> __( "Sidebar Position for Woocommerce" , "color-theme-framework" ),
						"desc"		=> __( "Select sidebar position" , "color-theme-framework" ),
						"id"		=> "{$prefix}shop_sidebar_position",
						"std"		=> "right",
						"type"		=> "select",
						"options" 	=> array( 'right' => 'Right' , 'left' => 'Left')
				);

$of_options[] = array( 	"name" 		=> __( "Length of Excerpt for Product Short Description" , "color-theme-framework"),
						"desc" 		=> __("Set length of excerpt in chars<br /> Min: 1, max: 500, step: 1, default value: 110" , "color-theme-framework"),
						"id" 		=> "{$prefix}shop_excerpt_lenght",
						"std" 		=> "110",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "500",
						"type" 		=> "sliderui" 
				);

/*$of_options[] = array(	"name"		=> __( "Product Columns" , "color-theme-framework" ),
						"desc"		=> __( "The number of columns for Shop page" , "color-theme-framework" ),
						"id"		=> "{$prefix}shop_columns",
						"std"		=> "2",
						"type"		=> "select",
						"options" 	=> array( '2' => '2' , '3' => '3', '4' => '4')
				);*/

$of_options[] = array( 	"name" 		=> __( "Related Products per Page" , "color-theme-framework"),
						"desc" 		=> __("Set the number of related products to display on product page<br /> Min: 0, max: 10, step: 1, default value: 120" , "color-theme-framework"),
						"id" 		=> "{$prefix}shop_posts_per_page",
						"std" 		=> "2",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "10",
						"type" 		=> "sliderui" 
				);

/*$of_options[] = array(	"name"		=> __( "Related Products per Row" , "color-theme-framework" ),
						"desc"		=> __( "Select the number of related products to display per row on product page" , "color-theme-framework" ),
						"id"		=> "{$prefix}shop_posts_per_row",
						"std"		=> "3",
						"type"		=> "select",
						"options" 	=> array( '2' => '2' , '3' => '3')
				);*/

/*$of_options[] = array(	"name"		=> __( "Products per Row" , "color-theme-framework" ),
						"desc"		=> __( "Select the number of products to display per row on shop page" , "color-theme-framework" ),
						"id"		=> "{$prefix}shop_products_per_row",
						"std"		=> "2",
						"type"		=> "select",
						"options" 	=> array( '2' => '2' , '3' => '3')
				);*/

$of_options[] = array(	"name"		=> __( "Background Color for 'On Sale'" , "color-theme-framework"),
						"desc"		=> __("Pick a background color for the 'Sale!' (default: #ff003c)" , "color-theme-framework"),
						"id"		=> "{$prefix}shop_onsale_color",
						"std"		=> "#ff003c",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Background Color for 'In Stock'" , "color-theme-framework"),
						"desc"		=> __("Pick a background color for the 'In Stock' (default: #5fa03f)" , "color-theme-framework"),
						"id"		=> "{$prefix}shop_instock_color",
						"std"		=> "#5fa03f",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Background Color for 'Out Of Stock'" , "color-theme-framework"),
						"desc"		=> __("Pick a background color for the 'Out Of Stock' (default: #303030)" , "color-theme-framework"),
						"id"		=> "{$prefix}shop_outofstock_color",
						"std"		=> "#303030",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Background Color for Shop Page Title" , "color-theme-framework"),
						"desc"		=> __("Pick a background color for shop page title (default: #2B373F)" , "color-theme-framework"),
						"id"		=> "{$prefix}shop_bg_title_color",
						"std"		=> "#2B373F",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Font Color for Shop Page Title" , "color-theme-framework"),
						"desc"		=> __("Pick a font color for shop page title (default: #FFF)" , "color-theme-framework"),
						"id"		=> "{$prefix}shop_font_title_color",
						"std"		=> "#FFF",
						"type"		=> "color"
				);


/*
=====================================================================================================================
					Breadcrumb Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Breadcrumb Settings" , "color-theme-framework" ),
						"type"		=> "heading");

$of_options[] = array( 	"name" 		=> __( "Breadcrumb Block" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide breadcrumb block" , "color-theme-framework" ),
						"id" 		=> "{$prefix}breadcrumb",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch",
				);

$of_options[] = array(	"name"		=>  __( "Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #FFFFFF)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}breadcrumb_background",
						"std"		=> "#FFFFFF",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> "Breadcrumb Font Color",
						"desc"		=> "Specify the breadcrumb font properties",
						"id"		=> "{$prefix}breadcrumb_font",
						"std"		=> array('size' => '14px','height' => '38px', 'style' => 'normal','color' => '#455058'),
						"type"		=> "typography"
				);

$of_options[] = array(	"name"		=>  __( "Breadcrumb Links Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a breadcrumb links color (default: #ff003c)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}breadcrumb_links_color",
						"std"		=> "#ff003c",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Use Predefined Breadcrumb Image / BG Color / Upload Your Image" , "color-theme-framework" ),
						"desc"		=> __( "Select the type of usage breadcrumb background" , "color-theme-framework" ),
						"id"		=> "{$prefix}breadcrumb_bg_type",
						"std"		=> 'Color',
						"type"		=> "select",
						"options"	=> $theme_bg_type
				);

$of_options[] = array(	"name"		=> __( "Breadcrumb Background Repeat" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background repeat for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}breadcrumb_bg_repeat",
						"std"		=> 'Repeat',
						"type"		=> "select",
						"options"	=> $theme_bg_repeat
				);

$of_options[] = array(	"name"		=> __( "Uploaded Breadcrumb Background Image" , "color-theme-framework" ),
						"desc"		=> __( "Upload image for breadcrumb background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}breadcrumb_bg_image",
						"std"		=> $default_bg . "bg_footer.jpg",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Predefined Breadcrumb Background Images" , "color-theme-framework" ),
						"desc"		=> __( "Select a breadcrumb background pattern." , "color-theme-framework" ),
						"id"		=> "{$prefix}breadcrumb_predefined_bg",
						"std"		=> $bg_images_url."bg_default.jpg",
						"type"		=> "tiles",
						"options"	=> $bg_images,
				);

/*
=====================================================================================================================
					Widgets Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Widgets Settings" , "color-theme-framework" ),
						"type"		=> "heading");

$of_options[] = array(	"name"		=> __( "Widget Title Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color for the standard widgets title (default: #2b373f)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}widget_title_bg_color",
						"std"		=> "#2b373f",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> "Widget Title Font",
						"desc"		=> "Specify the widget title font properties",
						"id"		=> "{$prefix}widget_title_font",
						"std"		=> array('size' => '18px','height' => '20px', 'style' => 'bold','color' => '#FFFFFF'),
						"type"		=> "typography"
				);

$of_options[] = array( 	"name" 		=> __( "Widget Title Arrow" , "color-theme-framework" ),
						"desc" 		=> __( "Show/Hide widget title arrow" , "color-theme-framework" ),
						"id" 		=> "{$prefix}widget_arrow",
						"std" 		=> 1,
						"on" 		=> __( "Show" , "color-theme-framework" ),
						"off" 		=> __( "Hide" , "color-theme-framework" ),
						"type" 		=> "switch"
				);

$of_options[] = array(	"name"		=> __( "Get the custom color for posts from:" , "color-theme-framework" ),
						"desc"		=> __( "Choose how to define the color for posts (only for Carousel widget)" , "color-theme-framework" ),
						"id"		=> "{$prefix}post_color_type",
						"std"		=> "Post settings",
						"type"		=> "select",
						"options" 	=> array(
							'post'			=> 'Post settings',
							'category'		=> 'Category settings'
						)
				);

$of_options[] = array( 	"name" 		=> __( "Vertical gap between widgets" , "color-theme-framework"),
						"desc" 		=> __("Set the vertical gap between widgets in pixels<br /> Min: 1, max: 100, step: 1, default value: 40" , "color-theme-framework"),
						"id" 		=> "{$prefix}widget_gap",
						"std" 		=> "40",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Title Top Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the top margin <br /> Min: 0, max: 30, step: 1, default value: 12" , "color-theme-framework"),
						"id" 		=> "{$prefix}widget_title_top_padding",
						"std" 		=> "12",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "30",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Title Right Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the right margin <br /> Min: 0, max: 30, step: 1, default value: 12" , "color-theme-framework"),
						"id" 		=> "{$prefix}widget_title_right_padding",
						"std" 		=> "12",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "30",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Title Bottom Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the bottom margin <br /> Min: 0, max: 30, step: 1, default value: 12" , "color-theme-framework"),
						"id" 		=> "{$prefix}widget_title_bottom_padding",
						"std" 		=> "12",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "30",
						"type" 		=> "sliderui" 
				);

$of_options[] = array( 	"name" 		=> __( "Title Left Padding" , "color-theme-framework"),
						"desc" 		=> __("Set the left margin <br /> Min: 0, max: 30, step: 1, default value: 12" , "color-theme-framework"),
						"id" 		=> "{$prefix}widget_title_left_padding",
						"std" 		=> "12",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "30",
						"type" 		=> "sliderui" 
				);


/*
=====================================================================================================================
					Ads &Banner Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Ads Banner Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=> __( "Show banner: " , "color-theme-framework" ),
						"desc"		=> __( "Show or hide banner" , "color-theme-framework" ),
						"id"		=> "{$prefix}top_banner",
						"std"		=> 'Upload',
						"type"		=> "select",
						"options"	=> $show_top_banner
				);

$of_options[] = array(	"name"		=> __( "Site Header Banner Upload" , "color-theme-framework" ),
						"desc"		=> __( "Upload images using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_upload",
						"std"		=> get_template_directory_uri() . "/img/banner_460.jpg",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Site Header Banner URL" , "color-theme-framework" ),
						"desc"		=> __( "Enter clickthrough url for banner in top section" , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_link",
						"std"		=> "http://themeforest.net/user/ZERGE?ref=zerge",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Site Header Ads\Banner Code" , "color-theme-framework" ),
						"desc"		=> __( "Paste your Google Adsense (or other) code here." , "color-theme-framework" ),
						"id"		=> "{$prefix}banner_code",
						"std"		=> "",
						"type"		=> "textarea"
				);

/*
=====================================================================================================================
					FOOTER SETTINGS
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Footer Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array(	"name"		=>  __( "Footer Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a background color (default: #2b373f)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}footer_background",
						"std"		=> "#2b373f",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> "Copyrights Font Color",
						"desc"		=> "Specify the footer font properties (default: #FFFFFF)",
						"id"		=> "{$prefix}footer_font",
						"std"		=> array('size' => '12px', 'color' => '#FFFFFF'),
						"type"		=> "typography"
				); 

$of_options[] = array(	"name"		=>  __( "Copyrights Links Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a font color (default: #ff003c)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}footer_font_link",
						"std"		=> "#ff003c",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=>  __( "Footer Widget Title Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a border color (default: #FF0000)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}footer_title_color",
						"std"		=> "#FF0000",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=>  __( "Footer Copyright Background Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a border color (default: #222A30)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}footer_bg_copyright_color",
						"std"		=> "#222A30",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=>  __( "Footer Widget Links Color" , "color-theme-framework" ),
						"desc"		=> __( "Pick a border color (default: #A7A7A7)." , "color-theme-framework" ), 
						"id"		=> "{$prefix}footer_widgets_color",
						"std"		=> "#A7A7A7",
						"type"		=> "color"
				);

$of_options[] = array(	"name"		=> __( "Use Predefined Footer Image / BG Color / Upload Your Image" , "color-theme-framework" ),
						"desc"		=> __( "Select the type of usage footer background" , "color-theme-framework" ),
						"id"		=> "{$prefix}footer_bg_type",
						"std"		=> 'Color',
						"type"		=> "select",
						"options"	=> $theme_bg_type
				);

$of_options[] = array(	"name"		=> __( "Footer Background Repeat" , "color-theme-framework" ),
						"desc"		=> __( "Select the default background repeat for the background image" , "color-theme-framework" ),
						"id"		=> "{$prefix}footer_bg_repeat",
						"std"		=> 'Repeat',
						"type"		=> "select",
						"options"	=> $theme_bg_repeat
				);

$of_options[] = array(	"name"		=> __( "Uploaded Footer Background Image" , "color-theme-framework" ),
						"desc"		=> __( "Upload image for the footer background using the native media uploader, or define the URL directly" , "color-theme-framework" ),
						"id"		=> "{$prefix}footer_bg_image",
						"std"		=> $default_bg . "bg_footer.jpg",
						"type"		=> "upload"
				);

$of_options[] = array(	"name"		=> __( "Predefined Footer Background Images" , "color-theme-framework" ),
						"desc"		=> __( "Select a footer background pattern." , "color-theme-framework" ),
						"id"		=> "{$prefix}footer_predefined_bg",
						"std"		=> $bg_images_url."bg_footer.jpg",
						"type"		=> "tiles",
						"options"	=> $bg_images,
				);

$of_options[] = array(	"name"		=> __( "Copyrights for your theme" , "color-theme-framework" ),
						"desc"		=> __( "Enter your copyrights." , "color-theme-framework" ),
						"id"		=> "{$prefix}copyright_info",
						"std"		=> '&copy; 2016 Copyright. Proudly powered by <a href="http://wordpress.org/">WordPress</a>.',
						"type"		=> "textarea"
				);

$of_options[] = array(	"name"		=> __( "Additional Info" , "color-theme-framework" ),
						"desc"		=> __( "Enter you additional info" , "color-theme-framework" ),
						"id"		=> "{$prefix}add_info",
						"std"		=> '<a href="http://themeforest.net/user/ZERGE?ref=zerge">InTouch</a> WordPress Theme <br/>by  <a href="http://themeforest.net/user/ZERGE">ZERGE</a> at <a href="http://color-theme.com/">Color Theme</a>',
						"type"		=> "textarea"
				);


/*
=====================================================================================================================
					Twitter Settings
=====================================================================================================================	
*/

$of_options[] = array(	"name"		=> __( "Twitter Settings" , "color-theme-framework" ),
						"type"		=> "heading"
				);

$of_options[] = array( "name"		=> "OAuth Settings",
					"desc"			=> "",
					"id"			=> "introduction_oauth_settings",
					"std"			=> "<h3 style=\"margin: 0;\">OAuth Settings</h3> Visit <a target=\"_target\" href=\"https://dev.twitter.com/apps/\" title=\"Twitter\" rel=\"nofollow\">this link</a> in a new tab, sign in with your account, click on \"Create a new application\" and create your own keys in case you don't have already.",
					"icon"			=> true,
					"type"			=> "info"
				);

$of_options[] = array(	"name"		=> __( "Consumer Key:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Key" , "color-theme-framework" ),
						"id"		=> "{$prefix}consumer_key",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Consumer Secret:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Consumer Secret" , "color-theme-framework" ),
						"id"		=> "{$prefix}consumer_secret",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Access Token:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Access Token" , "color-theme-framework" ),
						"id"		=> "{$prefix}user_token",
						"std"		=> "",
						"type"		=> "text"
				);

$of_options[] = array(	"name"		=> __( "Access Token Secret:" , "color-theme-framework" ),
						"desc"		=> __( "Enter Your Twitter App Access Token Secret" , "color-theme-framework" ),
						"id"		=> "{$prefix}user_secret",
						"std"		=> "",
						"type"		=> "text"
				);


/*
=====================================================================================================================
					Backup Options
=====================================================================================================================	
*/
$of_options[] = array(	"name"		=> __( "Backup Options" , "color-theme-framework" ),
						"type"		=> "heading"
				);
					
$of_options[] = array(	"name"		=> __( "Backup and Restore Options" , "color-theme-framework" ),
						"id"		=> "of_backup",
						"std"		=> "",
						"type"		=> "backup",
						"desc"		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
					
$of_options[] = array(	"name"		=> __( "Transfer Theme Options Data" , "color-theme-framework" ),
						"id"		=> "of_transfer",
						"std"		=> "",
						"type"		=> "transfer",
						"desc"		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);
	}
}
?>