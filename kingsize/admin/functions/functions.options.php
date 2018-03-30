<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
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
				"placebo" => "placebo", //REQUIRED!
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


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/
	

		##############################################
		// Load general common functions
		require_once (get_template_directory() . '/lib/general.php');

		$themename = "King Size WP Template";
		$shortname = "wm";
		$path = get_template_directory_uri();
		##############################################

		// Set the Options Array
		global $of_options;
		$of_options = array();

		//------------------------------------------------------------------------------------------
		
		$of_options[] = array( "name" => "General Settings",
							"type" => "heading");

		#-----------------------------------------------------------------------#
		###################### King Size *WP* Logo Options ######################
		#-----------------------------------------------------------------------#

		$of_options[] = array(  "name" => "Logo Upload",
					  "id" => $shortname."_logo",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Logo Upload &amp; Settings for Desktop Use</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					'name' => 'Logo image',
					'id' => $shortname . '_logo_upload',
					'type' => 'media',
					'img_w' => '220',
					'img_h' => '200',
					'std' => $path . '/images/logo_back.png',
					"helpicon"=> "help.png",
					'parent_heading'=> $shortname."_logo",
					'desc' => 'Upload a logo, or specify the image address. Best results when using 180(h) x 200(w) px. <br /><br /><strong>Note</strong> #1: If your logo is not transparent, we recommend you use a smaller width such as 195 instead of 200. <br /><br /><strong>Note</strong> #2: This logo does not apply to the mobile version of your site. It uses a smaller logo. Scroll down in these options to find the Mobile Logo upload options.'
				);
				
		$of_options[] =	array(  "name" => "Logo Height",
					  "id" => $shortname."_logo_height",
					  "std" => "180",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Default logo height is \"180\" px. If you are using a smaller logo and need to adjust the height of the logo area, you can do so here. <em>(Do NOT add \"px\" when inserting your height).</em>",
					  "parent_heading" => $shortname."_logo",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Enable Login Branding",
					  "desc" => "By checking this box you\'re enabling branding on the Login Page used by WordPress. This will make use of your Logo instead of WordPress' default logo, as well enables the optional styling options in Styling Settings.",
					  "id" => $shortname."_login_branding",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_logo",
					  "std" => "0");
					  
		// Responsive Mobile Logo Upload
		$of_options[] = array(  "name" => "Mobile Logo Upload",
					  "id" => $shortname."_mobile_logo",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Logo Upload &amp; Settings for Mobile Devices</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					'name' => 'Logo image',
					'id' => $shortname . '_mobile_logo_upload',
					'type' => 'media',
					'img_w' => '220',
					'img_h' => '200',
					'std' => $path . '/images/logo-top-bar.png',
					"helpicon"=> "help.png",
					'parent_heading'=> $shortname."_logo",
					'desc' => 'Upload a logo, or specify the image address. Best results when using 45(h) x 120(w) px. This logo is for Mobile / Tablet Devices. Width may vary for logo.'
				);

		#-----------------------------------------------------------------------#
		#################### King Size *WP* Favicon Options #####################
		#-----------------------------------------------------------------------#

		$of_options[] = array(  "name" => "Favicon Upload",
					  "id" => $shortname."_favicon",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Favicon Upload</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					'name' => 'Favicon image',
					'id' => $shortname . '_favicon_upload',
					'type' => 'media',
					'img_w' => '16',
					'img_h' => '16',
					'std' => $path . '/images/favicon.png',
					"helpicon"=> "help.png",
					'parent_heading'=> $shortname."_favicon",
					'desc' => 'Upload a favicon, or specify the png image address. Best results when using 16(h) x 16(w) px.'
				);
				
		$of_options[] = array(  "name" => "Enable / Disable Favicon",
					  "desc" => "Check this box if you want to disable the Favicon feature.",
					  "id" => $shortname."_favicon_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_favicon",
					  "std" => "1");
				
						
		#---------------------------------------------------------------------------------#
		###################### King Size *WP* Background Preferences ######################
		#---------------------------------------------------------------------------------#		

		$of_options[] = array(  "name" => "Global Background Preferences",
					  "id" => $shortname."_background",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Global Background Preferences</h3>",
					  "type" => "info");
			
		$of_options[] = array(
					  'name' => 'Background image',
					  'id' => $shortname . '_background_image',
					  'type' => 'media',
					  'img_w' => '250',
					  'img_h' => '150',
					  'std' => $path . '/images/background/default.jpg',
					  "helpicon"=> "help.png",
					  'parent_heading'=> $shortname."_background",
					  'desc' => 'Upload a global background, or specify the image address <i>[ie., http://www.yoursite.com/yourimage.jpg]</i> <br /><br /><strong>For best results</strong>, we recommend you optimize your images, using 1400(w) x 900(h) px, or 900(w) x 500(h) px and a max 1.5MB\'s size (though it is our recommendation you optimize your images and keep them smaller in size).'
					  );	
					  
		//$of_options[] = array(  "name" => "Enable Background Overlay on all Inner-pages",
					  //"desc" => "Check this box if you want to enable the Background Grid Overlay feature.",
					  //"id" => $shortname."_grid_hide_enabled",
					  //"type" => "checkbox",
					  //"helpicon"=> "help.png",
					  //"parent_heading" => $shortname."_background",
					  //"std" => "1");
					  
		$of_options[] =	array( "name" => "Background Grid Overlay Options",
					  "id" => $shortname."_grid_hide_enabled",
					  "type" => "select",
					  "options" => array("grid_hide_enabled"=>"Enable the Grid Overlay on All Inner Pages", "grid_disabled"=>"Disable Grid Overlay on All Pages", "grid_global_enable"=>"Enable the Grid Overlay on All Pages"),
					  "std" => "Enable the Grid Overlay on All Inner Pages",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose to enable the grid on \"ALL\" pages (including Homepage) or to only enable this on \"Inner\" pages, or to disable the Grid Overlay all together so it does not show.",
					  "parent_heading" => $shortname."_background");
					  


		#----------------------------------------------------------------------------------------#
		###################### King Size *WP* Navigation / Menu Preferences ######################
		#----------------------------------------------------------------------------------------#		

		$of_options[] = array(  "name" => "Navigation Menu Preferences",
					  "id" => $shortname."_navigation_menu",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Navigation / Menu Preferences</h3>",
					  "type" => "info");
					  
		//$of_options[] = array(  "name" => "Sublevel Navigation Width",
					 // "desc" => "Longer sublevel menu items? Change the default width of the sublevel menu.",
					 // "id" => $shortname."_subnav_width",
					 // "type" => "text",
					 // "mod" => "mini",
					 // "helpicon"=> "help.png",
					 // "parent_heading" => $shortname."_navigation_menu",
					 // "std" => "180");
					  
		$of_options[] =	array( "name" => "Hide/Show Navigation Options",
					  "id" => $shortname."_navigation_hide_enabled",
					  "type" => "select",
					  "options" => array("nav_default"=>"Show the Navigation on All Pages", "nav_all_hidden"=>"Hide the Navigation on All Pages", "nav_hide_home_only"=>"Hide the Navigation only on Homepage"),
					  "std" => "Show the Navigation on All Pages",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose how the Navigation should appear. <strong>A.)</strong> Shown by Default, <strong>B.)</strong> Hidden by Default, or <strong>C.)</strong> Hidden only on the Homepage but shown on all others.",
					  "parent_heading" => $shortname."_navigation_menu");
					  
		$of_options[] = array(  "name" => "Enable / Disable Fixed Navigation",
					  "desc" => "By default the navigation is in a \"Fixed\" position. Check this to change that to \"Absolute\" positioning which means it will no longer stay fixed in the browser window while scrolling. This is resourecful for longer navigations with multiple mneu items being displayed.",
					  "id" => $shortname."_menu_position_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_navigation_menu",
					  "std" => "0");
			
		$of_options[] = array(  "name" => "Enable Menu Hide / Show",
					  "desc" => "Check this box if you want to enable the Hide / Show menu feature.",
					  "id" => $shortname."_menu_hide_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_navigation_menu",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable the Menu Tooltip",
					  "desc" => "Check this box if you want to enable the Hide / Show menu tooltip.",
					  "id" => $shortname."_menu_tooltip_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_navigation_menu",
					  "std" => "1");
		
		$of_options[] =	array( "name" => "Image Thumbnail Options",
					  "id" => $shortname."_thumbnail_generator",
					  "type" => "select",
					  "options" => array("default"=>"Default: Enable Aqua-Resizer","enable_image_resize"=>"Enable WP Image Resize"),
					  "std" => "Thumbnail generator of Gallery/Portfolio",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose to use Aqua-Resizer or WP-Image Resizer as your default for handling thumbnail resizing.",
					  "parent_heading" => $shortname."_navigation_menu");
		
		
		$of_options[] = array(  "name" => "Do you wish to disable PrettyPhoto from loading?",
					  "desc" => "Check this box if you want to disable the PrettyPhoto.",
					  "id" => $shortname."_prettyphoto_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_navigation_menu",
					  "std" => "0");
		//----------------------------------------------------------------------------------------

		#----------------------------------------------------------------------------------------#
		###################### King Size *WP* Background Slider Preferences ######################
		#----------------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Home Settings",
					  "type" => "heading");
			
		$of_options[] = array( "name" => "Homepage Background Slider Preferences",
					  "desc" => "",
					  "id" => $shortname."_slider",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Homepage Background Slider Preferences</h3>",
					  "icon" => true,
					  "type" => "info");

		$of_options[] =	array( "name" => "Background Type for Homepage",
					  "id" => $shortname."_background_type",
					  "type" => "select",
					  "options" => array("slider_background"=>"Image Slider", "video_background"=>"Video Background"),
					  "std" => "slider_background",
					  "helpicon"=> "help.png",
					  "desc" => "Choose either image slider background or video background for the homepage.",
					  "parent_heading" => $shortname."_background");
					  
		$of_options[] =	array(  "name" => "Assign Homepage Slider Category",
					  "id" => $shortname."_slider_hp_category",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Assign the category of your choice for the use of the Homepage Slider. By leaving this area blank, you will display ALL slides added. To limit the slides by Category, insert the Slider Category ID here <i>(for multiple categories, separate with a comma - for example: 3,7,9)</i>.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");

		$of_options[] =	array(  "name" => "Assign the Number of Slider Items",
					  "id" => $shortname."_slider_show_number",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Assign the number of slider images you want to show on the homepage <i>(ie., 10)</i>. If blank then it will show all available slider images.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Slider Intrevals (Milliseconds) <i style=\"color: red;\">*REQUIRED*</i>",
					  "id" => $shortname."_slider_seconds",
					  "std" => "5000",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "This requires being defined in 'Milliseconds' otherwise the slider will not work properly <i style=\"color: red;\">(ie., 5 seconds = 5000 milliseconds)</i>.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Slider Transitions (Milliseconds) <i style=\"color: red;\">*REQUIRED*</i>",
					  "id" => $shortname."_slider_transition_seconds",
					  "std" => "700",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "This requires being defined in 'Milliseconds' otherwise the slider will not work properly <i style=\"color: red;\">(ie., 5 seconds = 5000 milliseconds)</i>.",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array( "name" => "Slider Transition Type",
					  "id" => $shortname."_slider_transition_type",
					  "type" => "select",
					  "options" => array("1"=>"Fade", "2"=>"Slide Top", "3"=>"Slide Right", "4"=>"Slide Bottom", "5"=>"Slide Left", "6"=>"Carousel Right", "7"=>"Carousel Left"),
					  "std" => "Fade",
					  "helpicon"=> "help.png",
					  "desc" => "Select the type of Transitions you're wanting your Slider to use <i>(ie., Fade, Caoursel, etc)</i>.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array( "name" => "Slider Order",
					  "id" => $shortname."_slider_display",
					  "type" => "select",
					  "options" => array("default"=>"Default DESC (by Date)", "rand"=>"Random Order", "custom_id"=>"Custom ID Order", "asc_order"=>"ASC (by Date)"),
					  "std" => "Default DESC (by Date)",
					  "helpicon"=> "help.png",
					  "desc" => "Displays by default in order of date posted. Select here if you wish to customize that preference <i>(ie., Random, by ID, ASC, etc)</i>.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array(  "name" => "Display Description at Top",
						"desc" => "Check this box if you want to display the slider descriptions at the top of your website (instead of the default bottom).",
						"id" => $shortname."_slider_placement",
						"type" => "checkbox",
						"helpicon"=> "help.png",
						"parent_heading" => $shortname."_slider",
						"std" => "1");
		
		$of_options[] =	array(  "name" => "Alignment (Top Placement)",
					  "id" => $shortname."_slider_alignment_top",
					  "std" => "60",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Here you can insert the pixels (numerical) to adjust the alignment of the slider description. By default when placement is at top, it displays 60px from top. Do not enter the 'px' when using this option. Only the numerical entry (ie., <strong>60</strong>).",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Alignment (Bottom Placement)",
					  "id" => $shortname."_slider_alignment_bottom",
					  "std" => "10",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Here you can insert the pixels (numerical) to adjust the alignment of the slider description. By default when placement is at top, it displays 10px from bottom. Do not enter the 'px' when using this option. Only the numerical entry (ie., <strong>10</strong>).",
					  "parent_heading" => $shortname."_slider",
					  "type" => "text");
					  
		$of_options[] =	array( "name" => "Slide Titles & Descriptions",
					  "id" => $shortname."_slider_contents",
					  "type" => "select",
					  "options" => array("no_contents"=>"Display only Slider Images", "display_contents"=>"Display Title & Description", "display_title"=>"Display Title", "display_description"=>"Display Description"),
					  "std" => "Display only Slider Images",
					  "helpicon"=> "help.png",
					  "desc" => "If you would like to include a 'Title' and 'Description' on your homepage slider images, you can modify the selection here to enable it.",
					  "parent_heading" => $shortname."_slider");
					  
		
					  
		$of_options[] =	array( "name" => "Slide Controllers",
					  "id" => $shortname."_slider_controllers",
					  "type" => "select",
					  "options" => array("no_controls"=>"Disable Slider Controls", "display_controls"=>"Enable Slider Controls"),
					  "std" => "Display Slider Controls",
					  "helpicon"=> "help.png",
					  "desc" => "If you wish to display the Slider Controls <i>(ie., Play/Pause, Next/Previous)</i> you can enable those here <i>(disabled by default)</i>.",
					  "parent_heading" => $shortname."_slider");
					  
		$of_options[] =	array( "name" => "Slide Controller Position",
					  "id" => $shortname."_slider_controller_position",
					  "type" => "select",
					  "options" => array("display_controls_top"=>"Display Controls on Top of Slider Content", "display_controls_bottom"=>"Display Controls on Bottom of Slider Content"),
					  "std" => "Display Controls on Top of Slider Content",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can assign where the controllers for the Slider are positioned. When using lots of text in your slider items, it's best to display this on the bottom of your Slider Content for better appearance <i>(default display is on top)</i>.",
					  "parent_heading" => $shortname."_slider");


		#----------------------------------------------------------------------------------------#
		###################### King Size *WP* Video Background Preferences #######################
		#----------------------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "Homepage Video Background Preferences",
					  "desc" => "",
					  "id" => $shortname."_video",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Homepage Video Background Preferences</h3>",
					  "icon" => true,
					  "type" => "info");

		$of_options[] =	array(  "name" => "Youtube / Vimeo / MP4 URL",
					  "id" => $shortname."_video_url",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_video",
					  "desc" => "Insert your Youtube/Vimeo/MP4 Video URL here. If you're using videos, be sure to enable that with the option defined at the very top of this <i>(ie., Slider Image or Background Video)</i>. <strong>Note</strong>: Does not support the use of Secure URLs, ie., \"https://\" Use only \"http://\" for this.",
					  "type" => "text");

		$of_options[] =	array(  "name" => "Enable / Disable AutoPlay",
					  "desc" => "Check this box if you want to enable auto play <i>(this option only applies to the homepage)</i>.",
					  "id" => $shortname."_autoplay_video",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_video",
					  "std" => "1");

		$of_options[] =	array(  "name" => "Enable / Disable Controlbar",
						"desc" => "Check this box to hide the video control bar <i>(this option only applies to YouTube)</i>.",
						"id" => $shortname."_controlbar_video",
						"type" => "checkbox",
						"helpicon"=> "help.png",
						"parent_heading" => $shortname."_video",
						"std" => "1");

		$of_options[] =	array(  "name" => "Enable / Disable Video Repeat",
						"desc" => "Check this box if you want to repeat / loop the video for continuous play <i>(homepage only)</i>.",
						"id" => $shortname."_repeat_video",
						"type" => "checkbox",
						"helpicon"=> "help.png",
						"parent_heading" => $shortname."_video",
						"std" => "1");
		
		$of_options[] =	array(  "name" => "Enable / Disable Mobile Image Video Background",
						"desc" => "When using a Dynamic Homepage, you can check this box to display a Single Image Background on Mobile Devices rather than a video. On desktop devices, it will still show a video, however on mobiles it will use the Global Background Image you have uploaded instead.",
						"id" => $shortname."_video_image_background_check",
						"type" => "checkbox",
						"helpicon"=> "help.png",
						"parent_heading" => $shortname."_video",
						"std" => "1");
		
		//----------------------------------------------------------------------------

		#----------------------------------------------------------------------------#
		###################### King Size *WP* Style Preferences ######################
		#----------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Style Options",
					  "type" => "heading");

		$of_options[] = array( "name" => "Style Preferences",
					  "desc" => "",
					  "id" => $shortname."_style_prefs",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">KingSize WordPress Style Overrides</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Google Web Fonts (URL)",
					  "id" => $shortname."_google_fonts",
					  "std" => "",
					  "desc" => "Go to <a href=\"http://www.google.com/webfonts/\" title=\"Google Web Fonts\" target=\"blank\">Google Web Fonts</a> and copy the font URL and paste here to customize your font preferences. Default font is PTSans Narrow.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "text");

		$of_options[] = array(  "name" => "Google Web Fonts Name (CSS)",
					  "id" => $shortname."_google_fonts_name",
					  "std" => "'PT Sans Narrow', 'Helvetica Neue', 'Verdana', sans-serif",
					  "desc" => "When using <a href=\"http://www.google.com/webfonts/\" title=\"Google Web Fonts\" target=\"blank\">Google Web Fonts</a> (with the option above) you're <em><strong>required</strong></em> to insert the font-name into the CSS. So when grabbing the font, it states 'Integrate Into CSS:', copy the font-family name, ie., <strong>'PT Sans'</strong> - Need help? Watch this <a href=\"http://screenr.com/lAb8\" target=\"blank\">Video Tutorial</a> for more details!",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "text");
					  
		#--------------------------------------------------------------------------------------#
		###################### King Size Font Size Preferences / Options #######################
		#--------------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Font Size Preferences",
					  "desc" => "",
					  "id" => $shortname."_font_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Font Size Preferences</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] =	array(  "name" => "Default Body / Paragraph Font Size",
					  "id" => $shortname."_font_size_body",
					  "std" => "12",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
		
		$of_options[] =	array(  "name" => "Main Menu Link Font Size",
					  "id" => $shortname."_font_size_menu",
					  "std" => "18",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Menu Description Font Size",
					  "id" => $shortname."_font_size_menu_desc",
					  "std" => "12",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Sub Menu Link Font Size",
					  "id" => $shortname."_font_size_sub_menu",
					  "std" => "12",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "H1 Font Size",
					  "id" => $shortname."_font_size_h1",
					  "std" => "40",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "H2 Font Size",
					  "id" => $shortname."_font_size_h2",
					  "std" => "30",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "H3 Font Size",
					  "id" => $shortname."_font_size_h3",
					  "std" => "20",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "H4 Font Size",
					  "id" => $shortname."_font_size_h4",
					  "std" => "16",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "H5 Font Size",
					  "id" => $shortname."_font_size_h5",
					  "std" => "14",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "H6 Font Size",
					  "id" => $shortname."_font_size_h6",
					  "std" => "14",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Enter the numerical number for your font size to override the original font sizes. Do not include the 'px', just numerical entry.",
					  "parent_heading" => $shortname."_font_style_prefs",
					  "type" => "text");
					  
	    #----------------------------------------------------------------------------------------#
		###################### King Size *WP* Default WP Login Preferences #######################
		#----------------------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "WordPress Login Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">WordPress Login Preferences</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Login Branding: Background Colour",
					  "id" => $shortname."_login_background_color",
					  "std" => "#F1F1F1",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		$of_options[] = array(  "name" => "Login Branding: Label Colour",
					  "id" => $shortname."_login_label_color",
					  "std" => "#777777",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		$of_options[] = array(  "name" => "Login Branding: Link Colour",
					  "id" => $shortname."_login_link_color",
					  "std" => "#999999",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
	    #-----------------------------------------------------------------------------------------#
		###################### King Size *WP* Menu / Navigation Preferences #######################
		#-----------------------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "Menu / Navigation Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Menu / Navigation Preferences</h3>",
					  "icon" => true,
					  "type" => "info");	
					  
		$of_options[] = array(  "name" => "Add Transparency / Opacity",
					  "id" => $shortname."_enable_opacity",
					  "std" => "Default",
					  "options" => array("default"=>"Default", "90"=>"0.9 Opacity", "80"=>"0.8 Opacity", "70"=>"0.7 Opacity"),
					  "desc" => "Included are 3 pre-defined Transparency / Opacity options. Here you can select from 0.7, 0.8, 0.9 or default (no opacity).",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "select");
					  
		/*$of_options[] =	array(  "name" => "Menu / Navigation Opacity Level (All Modern Browsers)",
					  "id" => $shortname."_menu_opacity",
					  "std" => "0.85",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Here you can define the Opacity / Transparency for the navigation. By default the opacity is defined as '<strong>0.85</strong>' but can be changed to anything. Use '<strong>1</strong>' to remove all opacity / transparency. The smaller the number means the more opacity / transparency <em>(1 = full color)</em>.",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "text");
					  
		$of_options[] =	array(  "name" => "Menu / Navigation Opacity Level (Internet Explorer)",
					  "id" => $shortname."_menu_opacity_ie",
					  "std" => "85",
					  "helpicon"=> "help.png",
					  "mod" => "mini",
					  "desc" => "Here you can define the Opacity / Transparency for the navigation in <strong>Internet Explorer</strong>. Instead of '<strong>0.85</strong>' you would use '<strong>85</strong>' instead. Using '<strong>100</strong>' will show full colour.",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "text");*/
					  
		$of_options[] = array(  "name" => "Menu Text Colour",
					  "id" => $shortname."_menu_text_color",
					  "std" => "#A3A3A3",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Active Menu",
					  "id" => $shortname."_menu_active_color",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Menu Description Colour",
					  "id" => $shortname."_menu_description_text_color",
					  "std" => "#555555",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Active Menu Description",
					  "id" => $shortname."_menu_active_description_color",
					  "std" => "#A3A3A3",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");

		$of_options[] = array(  "name" => "Sub-menu Colour",
					  "id" => $shortname."_submenu_color",
					  "std" => "#000000",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		$of_options[] = array(  "name" => "Sub-menu Border Colour",
					  "id" => $shortname."_submenu_border_color",
					  "std" => "#2F2F2F",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
	    #----------------------------------------------------------------------------#
		###################### King Size *WP* Link Preferences #######################
		#----------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "Link Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Link Preferences</h3>",
					  "icon" => true,
					  "type" => "info");

		$of_options[] = array(  "name" => "Global Link Colour",
					  "id" => $shortname."_link_color",
					  "std" => "#D2D2D2",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Global Link Mouse-over Colour",
					  "id" => $shortname."_link_color_hover",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
	    #-------------------------------------------------------------------------------#
		###################### King Size *WP* Heading Preferences #######################
		#-------------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "Header Tag Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Header Tag Preferences</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "h1",
					  "id" => $shortname."_heading_text_color_h1",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h2",
					  "id" => $shortname."_heading_text_color_h2",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h3",
					  "id" => $shortname."_heading_text_color_h3",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h4",
					  "id" => $shortname."_heading_text_color_h4",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h5",
					  "id" => $shortname."_heading_text_color_h5",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "h6",
					  "id" => $shortname."_heading_text_color_h6",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
	    #-----------------------------------------------------------------------------------------------#
		###################### King Size *WP* Page / Portfolio / Post Preferences #######################
		#-----------------------------------------------------------------------------------------------#
					  
		$of_options[] = array( "name" => "Page / Portfolio / Post Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Page / Portfolio / Post Preferences</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Body Text Colour",
					  "id" => $shortname."_color_text",
					  "std" => "#CCCCCC",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Section (Page / Post) Header Title Colour",
					  "id" => $shortname."_section_header_titles_color",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Portfolio / Post Title Colour",
					  "id" => $shortname."_post_title_color",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Portfolio / Post Title Mouse-over Colour",
					  "id" => $shortname."_post_title_color_hover",
					  "std" => "#D2D2D2",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");

					  
	    #-----------------------------------------------------------------------------------------------#
		###################### King Size *WP* Slider Preferences #######################
		#-----------------------------------------------------------------------------------------------#
					  
		$of_options[] = array( "name" => "Slider Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Slider Preferences</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "h2 - Slider Titles (Homepage)",
					  "id" => $shortname."_heading_text_color_h2_slider",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Slider Description Text (Homepage)",
					  "id" => $shortname."_text_color_slider",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Slider Link Colour (Homepage)",
					  "id" => $shortname."_text_color_slider_link",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Slider Mouse-over Link Colour (Homepage)",
					  "id" => $shortname."_text_color_slider_link_hover",
					  "std" => "#FFFFFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
	    #--------------------------------------------------------------------------------#
		###################### King Size *WP* Assorted Preferences #######################
		#--------------------------------------------------------------------------------#			

		$of_options[] = array( "name" => "Assorted Styling Preferences",
					  "desc" => "",
					  "id" => $shortname."_menu_style",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Assorted Styling Preferences</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Contact Success Message",
					  "id" => $shortname."_success_color",
					  "std" => "#05CA00",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");	
					  
		$of_options[] = array(  "name" => "Input Field Background Colour",
					  "id" => $shortname."_input_color",
					  "std" => "#1b1b1b",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Input Field Text Colour",
					  "id" => $shortname."_input_text_color",
					  "std" => "#7B7B71",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Input Field [On Focus] Background Colour",
					  "id" => $shortname."_input_focus_color",
					  "std" => "#222222",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Input Field [On Focus] Text Colour",
					  "id" => $shortname."_input_focus_text_color",
					  "std" => "#7B7B7B",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_style_prefs",
					  "type" => "color");
					  
		//------------------------------------------------------------------------------------

		#------------------------------------------------------------------------------------#
		###################### King Size *WP* Page and Post Preferences ######################
		#------------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Pages &frasl; Posts",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "Enable Rich Text Excerpts",
					  "desc" => "Check this box to enable Rich Text Formating in Blog Excerpts. <strong style=\"color: red;\">*WARNING*</strong> this will disable the default 'Excerpts' (with no formatting) and will enable the use of the '<strong>&lt;!--more--&gt;</strong>' tags in posts - allowing for the custom assigned excerpts and Rich Text Formatting (ie., Links, Images, lists, etc).",
					  "id" => $shortname."_enable_rtf_excerpts",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "");
					  
		$of_options[] = array(  "name" => "Enable / Disable Page / Post Headers",
					  "desc" => "Check this box if you want to disable the Page / Post Headers at the top.",
					  "id" => $shortname."_show_page_post_headers",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "0");
				
		$of_options[] = array(  "name" => "Enable / Disable the Blog / Post Sidebar",
					  "desc" => "Uncheck this to disable sidebars globally.",
					  "id" => $shortname."_sidebar_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable the Page Sidebar",
					  "desc" => "Check this to enable sidebars globally on pages. Can override via page write-panel.",
					  "id" => $shortname."_page_sidebar_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "0");
					  
		$of_options[] = array(  "name" => "Enable / Disable Post Dates",
					  "desc" => "Uncheck this to disable post dates.",
					  "id" => $shortname."_date_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Post Meta Comments",
					  "desc" => "Uncheck this to disable post comments. This is shown aligned right of the date on posts. If you want to disable comments you should also disable this option also.",
					  "id" => $shortname."_meta_comments_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Widget Ready Footer",
					  "desc" => "Uncheck this to disable the widget footer.",
					  "id" => $shortname."_show_footer",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Global Comments",
					  "desc" => "Check this box if you want to enable the Comments. With this checked, you can also manage comments via 'Screen Options > Discussions' within the write-panel of each page/post created.",
					  "id" => $shortname."_show_comments",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");

		$read_more_txt = __('Read more', 'kslang'); 			  
		$of_options[] = array(  "name" => "Custom Read More Text",
					  "id" => $shortname."_read_more_text",
					  "std" => $read_more_txt,
					  "desc" => "This, as well other common used labels can also be modified by editing the Language files with use of Poedit. For instructions on how to do this, please read the template documentation.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Default Excerpt - Character Count",
					  "desc" => "Define the number (default is 600) of characters used in the default Excerpts (not applicable when using RTF excerpts).",
					  "id" => $shortname."_blog_words_count",
					  "type" => "text",
					  "mod" => "mini",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "600");

		$of_options[] = array(  "name" => "Individual Page / Post Gallery Controls",
					  "id" => $shortname."_img_gallery_nxt_prev",
					  "std" => "1",
					  "helpicon"=> "help.png",
					  "desc" => "Uncheck to disable Left/Right navigation in Galleries when opened in lightbox.",
					  "parent_heading" => $shortname."_blog_prefs",
					  "type" => "checkbox");

		$of_options[] = array(  "name" => "Featured Image / Blog Archive Gallery Controls",
					  "id" => $shortname."_blog_img_gallery_nxt_prev",
					  "std" => "1",
					  "helpicon"=> "help.png",
					  "desc" => "Uncheck to disable Left/Right navigation in Featured Images and blog overviews.",
					  "parent_heading" => $shortname."_blog_prefs",
					  "type" => "checkbox");

		$of_options[] = array(  "name" => "Show Featured Images Inside Posts",
					  "desc" => "Check this box to disable the display of Feature Images inside the single posts used by the blog.",
					  "id" => $shortname."_show_featured_image",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Scroll Back to Top",
					  "desc" => "Uncheck to disable the Scroll Back to Top.",
					  "id" => $shortname."_backtotop_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
					  
		$of_options[] = array(  "name" => "Enable / Disable Next/Previous Post Links",
					  "desc" => "Uncheck to disable the Single Post Navigation (next and previous posts) when viewing Blog Posts at the bottom.",
					  "id" => $shortname."_nextprev_pagi_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_blog_prefs",
					  "std" => "1");
		
					  
		//--------------------------------------------------------------------------------
				  
		#--------------------------------------------------------------------------------#
		###################### King Size *WP* Portfolio Preferences ######################
		#--------------------------------------------------------------------------------#	
		
		$of_options[] = array( "name" => "Gallery &frasl; Portfolio",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "Portfolio Preferences",
					  "id" => $shortname."_portfolio_prefs",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Portfolio Preferences / Settings</h3>",
					  "type" => "info");
					  
		$of_options[] = array(  "name" => "Number of Items to Display",
					  "desc" => "Here you can define the number of Portfolio Items to display within your Portfolio pages.",
					  "id" => $shortname."_portfolio_num_items",
					  "type" => "text",
					  "mod" => "mini",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_portfolio_prefs",
					  "std" => "10");
					  
		/****** REMOVED IN VERSION 5.0
		$of_options[] = array(  "name" => "Portfolio Item Height",
					  "desc" => "Here you can define the height for Portfolio Items. This can be useful for when wanting larger excerpts or shorter excerpts (ie., 400px).",
					  "id" => $shortname."_portfolio_height",
					  "type" => "text",
					  "mod" => "mini",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_portfolio_prefs",
					  "std" => "400"); ******/
					  
		$of_options[] = array(  "name" => "Enable / Disable Portfolio Titles",
					  "desc" => "Check this box if you want to disable the Portfolio titles from showing.",
					  "id" => $shortname."_show_portfolio_title",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_portfolio_prefs",
					  "std" => "0");
					  
		#---------------------------------------------------------------------------------#
		###################### King Size *WP* Galleries Preferences #######################
		#---------------------------------------------------------------------------------#
		
		$of_options[] = array( "name" => "Gallery Preferences",
					  "desc" => "",
					  "id" => $shortname."_galleries_prefs",
					  "std" => "<h3 style=\"margin: 0 0 10px; text-align: center;\">Gallery Preferences / Settings</h3>",
					  "icon" => true,
					  "type" => "info");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>Colorbox</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_colorbox",
					  "type" => "select",
					  "options" => array("colorbox_titles_enabled"=>"Enable Colorbox Titles", "colorbox_titles_disabled"=>"Disable Colorbox Titles"),
					  "std" => "Enable Colorbox Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>Fancybox</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_fancybox",
					  "type" => "select",
					  "options" => array("fancybox_titles_enabled"=>"Enable Fancybox Titles", "fancybox_titles_disabled"=>"Disable Fancybox Titles"),
					  "std" => "Enable Fancybox Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>Galleria</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_galleria",
					  "type" => "select",
					  "options" => array("galleria_titles_enabled"=>"Enable Galleria Titles", "galleria_titles_disabled"=>"Disable Galleria Titles"),
					  "std" => "Enable Galleria Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		$of_options[] =	array( "name" => "Enable / Disable <strong>PrettyPhoto</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_prettyphoto",
					  "type" => "select",
					  "options" => array("prettyphoto_titles_enabled"=>"Enable PrettyPhoto Titles", "prettyphoto_titles_disabled"=>"Disable PrettyPhoto Titles"),
					  "std" => "Enable PrettyPhoto Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");
					  
		// Removed in Version 4.1.5 as this was an unnecessary option to include.
		/*$of_options[] =	array( "name" => "Enable / Disable <strong>SlideViewer</strong> Gallery Titles",
					  "id" => $shortname."_gallery_titles_slideviewer",
					  "type" => "select",
					  "options" => array("slideviewer_titles_enabled"=>"Enable SlideViewer Titles", "slideviewer_titles_disabled"=>"Disable SlideViewer Titles"),
					  "std" => "Enable SlideViewer Titles",
					  "helpicon"=> "help.png",
					  "desc" => "",
					  "parent_heading" => $shortname."_galleries_prefs");*/
					  
		$of_options[] = array(  "name" => "PrettyPhoto Share Options",
					  "id" => $shortname."_prettybox_share_option",
					  "options" => array("prettyphoto_share_enabled"=>"Enable PrettyPhoto Share", "prettyphoto_share_disabled"=>"Disable PrettyPhoto Share"),
					  "std" => "Enable PrettyPhoto Share",
					  "helpicon"=> "help.png",
					  "desc" => "Here you can choose to disable the 'Sharing' options whenever lightbox for PrettyPhoto galleries is opened. By default this is enabled.",
					  "parent_heading" => $shortname."_galleries_prefs",
					  "type" => "select");
		
		$of_options[] = array(  "name" => "Enable / Disable Image Lazyloader",
			  "id" => $shortname."_lazyloader_option",
			  "options" => array("lazyloader_disabled"=>"Disable Lazyloader","lazyloader_enabled"=>"Enable Lazyloader"),
			  "std" => "Disable Lazyloader",
			  "helpicon"=> "help.png",
			  "desc" => "Here you can choose to enable Lazyloader. By default this is disabled.",
			  "parent_heading" => $shortname."_galleries_prefs",
			  "type" => "select");
					  
		//--------------------------------------------------------------------------

		#--------------------------------------------------------------------------#
		###################### King Size *WP* Contact Options ######################
		#--------------------------------------------------------------------------#
		
		$of_options[] = array( "name" => "Contact Page",
					  "type" => "heading");

		$of_options[] = array(  "name" => "Your Email Address",
					  "id" => $shortname."_contact_email",
					  "std" => "",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc",
					  "type" => "text");
					  
					  
		$of_options[] = array(  "name" => "Contact Success Message",
					  "id" => $shortname."_contact_email_template",
					  "std" => "Thank you for contacting us! Your message has been successfully delivered and we will be getting in touch real soon!",
					  "helpicon"=> "help.png",
					  "parent_heading"=> $shortname."_misc",
					  "type" => "textarea");
					  
		//---------------------------------------------------------------------------------

		#---------------------------------------------------------------------------------#
		###################### King Size *WP* Social Network Options ######################
		#---------------------------------------------------------------------------------#		
		
		$of_options[] = array( "name" => "Social Networks",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "Social Networks in Menu",
					  "id" => $shortname."_show_social_header_icons",
					  "icon" => "",
					  "desc" => "Check this to disable Social Network icons (using <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='blank'>FontAwesome</a>) in the menu.",
					  "std" => "0",
					  "parent_heading" => $shortname."_misc_social",
					  "type" => "checkbox");
					  
		$of_options[] = array(  "name" => "Open Social Networks in New Window",
					  "id" => $shortname."_show_social_icon_url_tab",
					  "icon" => "",
					  "desc" => "Check this to disable opening social network links in a new browser tab.",
					  "std" => "0",
					  "parent_heading" => $shortname."_misc_social",
					  "type" => "checkbox");
					  
		$of_options[] = array(  "name" => "Social Icons Color",
					  "id" => $shortname."_social_link_color",
					  "std" => "#D2D2D2",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_social",
					  "type" => "color");
					  
		$of_options[] = array(  "name" => "Social Icons Color on Mouseover",
					  "id" => $shortname."_social_link_color_hover",
					  "std" => "#FFF",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_social",
					  "type" => "color");

		$of_options[] = array(  "name" => "Twitter URL",
					  "id" => $shortname."_social_twitter",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "parent_heading" => $shortname."_misc_social",
					  "type" => "text");		
					  
		$of_options[] = array(  "name" => "Facebook URL",
					  "id" => $shortname."_social_facebook",
					  "icon" => "",
					  "desc" => "",
					  "parent_heading" => $shortname."_misc_social",
					  "std" => "",
					  "type" => "text");	
					  
		$of_options[] = array(  "name" => "LinkedIn URL",
					  "id" => $shortname."_social_linkedin",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Google+ URL",
					  "id" => $shortname."_social_googleplus",
					  "icon" => "",
					  "desc" => "",
					  "parent_heading" => $shortname."_misc_social",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Pinterest URL",
					  "id" => $shortname."_social_pinterest",
					  "icon" => "",
					  "desc" => "",
					  "parent_heading" => $shortname."_misc_social",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Behance URL",
					  "id" => $shortname."_social_behance",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Delicious URL",
					  "id" => $shortname."_social_delicious",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Deviant Art URL",
					  "id" => $shortname."_social_deviant",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Digg URL",
					  "id" => $shortname."_social_digg",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Dribbble URL",
					  "id" => $shortname."_social_dribble",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Flickr URL",
					  "id" => $shortname."_social_flickr",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Four Square URL",
					  "id" => $shortname."_social_foursquare",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "GitHub URL",
					  "id" => $shortname."_social_github",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Google URL",
					  "id" => $shortname."_social_google",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "PayPal URL",
					  "id" => $shortname."_social_paypal",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Instagram",
					  "id" => $shortname."_social_instagram",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Reddit URL",
					  "id" => $shortname."_social_reddit",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "RSS URL",
					  "id" => $shortname."_social_rss",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Skype URL",
					  "id" => $shortname."_social_skype",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					   "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] =  array(  "name" => "SoundCloud URL",
					  "id" => $shortname."_social_soundcloud",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] =  array(  "name" => "Spotify URL",
					  "id" => $shortname."_social_spotify",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] =  array(  "name" => "Steam URL",
					  "id" => $shortname."_social_steam",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] =  array(  "name" => "Stumble Upon URL",
					  "id" => $shortname."_social_stumble",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Tumblr URL",
					  "id" => $shortname."_social_tumblr",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Vimeo URL",
					  "id" => $shortname."_social_vimeo",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Vine URL",
					  "id" => $shortname."_social_vine",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "WordPress URL",
					  "id" => $shortname."_social_wordpress",
					  "parent_heading" => $shortname."_misc_social",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Youtube URL",
					  "id" => $shortname."_social_youtube",
					  "parent_heading" => $shortname."_misc_social",
					  "icon" => "",
					  "desc" => "",
					  "std" => "",
					  "type" => "text");
					  
		$of_options[] = array(  "name" => "Add Your Own Networks",
					  "id" => $shortname."_social_custom_networks",
					  "parent_heading" => $shortname."_custom_social",
					  "icon" => "",
					  "desc" => "Add your own Social Networks using <a href=\"https://fortawesome.github.io/Font-Awesome/icons/\" target=\"blank\">FontAwesome</a> Just insert the link tag and icon tag like shown below, 1 per line. <br /><br />For example:<br/> <strong>&lt;a href=\"#\" target=\"blank\"&gt;&lt;i class=\"fa fa-github\"&gt;&lt;/i>&lt;/a&gt;</strong>",
					  "std" => "",
					  "type" => "textarea");
					  
		//--------------------------------------------------------------------------------

		#--------------------------------------------------------------------------------#
		###################### King Size *WP* Miscellaneous Options ######################
		#--------------------------------------------------------------------------------#
		
		$of_options[] = array( "name" => "Miscellaneous",
					  "type" => "heading");
					  
		$of_options[] = array(  "name" => "CSS Overrides / Overwrites",
					  "desc" => "Insert your custom CSS overrides here. CSS entered into this area will overwrite the defaults defined inside style.css - This is useful when updating so your CSS changes are not overwritten after updating the template files. This is the recommended use.",
					  "id" => $shortname."_custom_css",
					  "type" => "textarea",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_css_prefs",
					  "std" => "");

		$of_options[] = array(  "name" => "&lsaquo;head&rsaquo; Include Code",
					  "id" => $shortname."_head_include",
					  "std" => "",
					  "desc" => "This area is used for when you need to include new scripts into your header without needing to make changes to the \"header.php\" file. It's recommended you use this to avoid overwriting your changes when updating the template files during updates.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "textarea");
					  
		$of_options[] = array(  "name" => "404 Error Page Header",
					  "id" => $shortname."_custom_404_title",
					  "std" => "",
					  "desc" => "Personalize the 404 Header title.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "text");	
					  
		$of_options[] = array(  "name" => "404 Error Page Message",
					  "id" => $shortname."_custom_404",
					  "std" => "",
					  "desc" => "Personalize the 404 Error Message.",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "textarea");	
					  
		$of_options[] = array(  "name" => "Insert Google Analytics ID",
					  "id" => $shortname."_google_analytics_id",
					  "std" => "",
					  "desc" => "Insert the Google ID from your Google Analytics code. This is also known as the \"Property ID\" in Google Analytics. Should look similar to\"UA-10423610-7\".",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "type" => "text");	
					  
		$of_options[] = array(  "name" => "Enable / Disable Right-Clicks",
					  "desc" => "Check this box if you want to enable the No-Right-Click option.",
					  "id" => $shortname."_no_rightclick_enabled",
					  "type" => "checkbox",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_setting",
					  "std" => "1");

		#----------------------------------------------------------------------------#
		###################### King Size *WP* Copyright Options ######################
		#----------------------------------------------------------------------------#	

		$of_options[] = array(  "name" => "Small Footer Copyright",
					  "desc" => "Insert Footer text (ie., Copyrights).",
					  "id" => $shortname."_footer_copyright",
					  "std" => "&copy; 2010 - 2015 King Size Theme",
					  "helpicon"=> "help.png",
					  "parent_heading" => $shortname."_misc_Copyright",
					  "type" => "textarea");
					  
		//--------------------------------------------------------------------------------

		#--------------------------------------------------------------------------------#
		###################### King Size *WP* Core Backup + Options ######################
		#--------------------------------------------------------------------------------#
		
		// Backup Options
		$of_options[] = array( 	"name" 		=> "Backup Options",
								"type" 		=> "heading"
						);
						
		$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
								"id" 		=> "of_backup",
								"std" 		=> "",
								"type" 		=> "backup",
								"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
						);
						
		$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
								"id" 		=> "of_transfer",
								"std" 		=> "",
								"type" 		=> "transfer",
								"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
						);
					
	}
}
?>
