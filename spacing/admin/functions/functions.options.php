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
		$of_pages_obj = get_pages();   
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name;
			$of_id = $of_page->ID;
			 }
		$of_pages_tmp = array_unshift($of_id = $of_pages, "Select a page:");    
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"slider"		=> "Slider",
				"block_content"	=> "Content",
			), 
			"disabled" => array (
				"placebo" => "placebo", //REQUIRED!	
				"custom_content"	=> "Custom Content",			
			),
		);
		
		$of_options_homepage_blocks2 = array
		( 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!	
				"tagline"		=> "Tagline",
				"recent_work"	=> "Recent Work",			
				"divider_1"	=> "Dividing Line",			
				"page_content"	=> "Page Content",
				"clients"	=> "Clients",
			), 
			"disabled" => array (
				"placebo" => "placebo", //REQUIRED!				
				"recent_posts"	=> "Recent Posts",				
				"blog"	=> "Blog",
				"divider_2"	=> "Dividing Line",
				"divider_3"	=> "Dividing Line",		
				"divider_4"	=> "Dividing Line",		
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
		

		//-----------------------------------------------------------------------------------
		// TO DO: Add options/functions that use these 
		//-----------------------------------------------------------------------------------
		
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


//-----------------------------------------------------------------------------------
// The Options Array 
//-----------------------------------------------------------------------------------

// Set the Options Array
global $of_options;
$of_options = array();
$prefix = "st_";

//
//	General Settings
//

$of_options[] = array( "name" => "General",
                    "type" => "heading");
					
					$of_options[] = array( "name" => "Logo Image",
					"desc" => "Upload images using native media uploader. This is a min version, meaning it has no url to copy paste. Perfect for logo.",
					"id" => $prefix."logo_image",
					"std" => "http://thetauris.com/themes/spacing/wp-content/uploads/2012/06/logo4.png",
					"type" => "upload");
					
					$url =  ADMIN_DIR . 'assets/images/';
					$of_options[] = array( "name" => "Default Layout",
					"desc" => "Select the default content and sidebar alignment. Choose between 1, 2 or 3 column layout.",
					"id" => $prefix."main_layout",
					"std" => "sidebar-right",
					"type" => "images",
					"options" => array(
						'sidebar-right' => $url . '2cr.png',
						'sidebar-left' => $url . '2cl.png',
						'sidebar-both' => $url . '3cm.png',
						'fullwidth' => $url . '1col.png'),
					);
					
					$of_options[] = array( "name" => "Archives/Search Page Layout",
					"desc" => "Select main content and sidebar alignment. Choose between 1 and 2 column layout.",
					"id" => $prefix."archives_layout",
					"std" => "sidebar-right",
					"type" => "images",
					"options" => array(
						'sidebar-right' => $url . '2cr.png',
						'sidebar-left' => $url . '2cl.png',
						'fullwidth' => $url . '1col.png'),
					);
					
					$of_options[] = array( "name" => "Responsive Design",
					"desc" => "Enable the Theme Responsiveness",
					"id" => $prefix."responsive",
					"std" => 1,
					"type" => "checkbox");  
					
					$of_options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $prefix."custom_favicon",
					"std" => "",
					"type" => "upload");
                                               
					$of_options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $prefix."tracking_code",
					"std" => "",
					"rows" => "10",
					"type" => "textarea");

//
//	Homepage Settings
//					
					
$of_options[] = array( "name" => "Homepage",
					"type" => "heading");				

					
					$of_options[] = array( "name" => "Main Blocks Manager",
					"desc" => "Organize the main blocks of your Homepage",
					"id" => $prefix."homepage_layout",
					"std" => $of_options_homepage_blocks,
					"type" => "sorter");
					
					$of_options[] = array( "name" => "Content Blocks Manager",
					"desc" => "Organize the content blocks of your Homepage",
					"id" => $prefix."homepage_layout2",
					"std" => $of_options_homepage_blocks2,
					"type" => "sorter");
					
					$of_options[] = array( "name" => "Homepage Tagline",
                    "desc" => "Supports HTML",
                    "id" => $prefix."homepage_tagline",
                    "std" => '<span>Welcome to Spacing</span> We are a Seattle based Photography Agency. Read more <a href="#">About Us</a> and check <a href="#">Our Work</a>.',
					"rows" => "6",
                    "type" => "textarea");
					
					$of_options[] = array( "name" => "Homepage Custom Content",
                    "desc" => "A place for a static image, video or any other HTML content",
                    "id" => $prefix."homepage_ccontent",
                    "std" => "",
					"rows" => "6",
                    "type" => "textarea");
					
					
					$of_options[] = array( "name" => "Recent Work",
					"id" => "subheading_214",
					"std" => "",
					"type" => "subheading");					
					
					
					$of_options[] = array( "name" => "Recent Work Title",
					"desc" => "",
					"id" => $prefix."tr_recent_work",
					"std" => "Our Work",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Recent Work Excerpt",
					"desc" => "Visible only Recent Work's layout is set to default",
					"id" => $prefix."tr_recent_work_excerpt",
					"std" => "Here are our few latest portfolio projects. You may also visit the whole gallery.",
					"rows" => 3,
					"type" => "textarea"); 
					
					$of_options[] = array( "name" => "Recent Work Link",
					"desc" => "",
					"id" => $prefix."tr_recent_work_link",
					"std" => "View Portfolio",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Recent Work links to:",
					"desc" => "Choose a page the 'Our Work' will be linked to",
					"id" => $prefix."recent_work_url",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);	
					
					$of_options[] = array( "name" => "Number of posts to show:",
					"desc" => "",
					"id" => $prefix."recent_work_nr",
					"std" => "4",
					"class" => "mini",
					"type" => "text"); 			
					
					$of_options[] = array( "name" => "Recent Work Layout",
					"desc" => "",
					"id" => $prefix."recent_work_layout",
					"std" => "4",
					"type" => "images",
					"options" => array(
						'4' => $url . 'home-4.png',
						'3' => $url . 'home-3.png'),
					);					
					
					$of_options[] = array( "name" => "Recent Posts",
					"id" => "subheading_213",
					"std" => "",
					"type" => "subheading");
					
					$of_options[] = array( "name" => "Recent Posts Title",
					"desc" => "",
					"id" => $prefix."tr_recent_posts",
					"std" => "From the Blog",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Recent Posts Excerpt",
					"desc" => "Visible only Recent Posts layout is set to default",
					"id" => $prefix."tr_recent_posts_excerpt",
					"std" => "Here are few from our latest portfolio works. You may also visit the whole gallery",
					"rows" => 3,
					"type" => "textarea"); 
					
					$of_options[] = array( "name" => "Recent Work Link",
					"desc" => "",
					"id" => $prefix."tr_recent_posts_link",
					"std" => "Go to the Blog",
					"type" => "text"); 	
					
					$of_options[] = array( "name" => "Recent Posts links to:",
					"desc" => "Choose a page the 'Go to the Blog' will be linked to",
					"id" => $prefix."recent_posts_url",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);						
					
					$of_options[] = array( "name" => "Recent Posts Layout",
					"desc" => "",
					"id" => $prefix."recent_posts_layout",
					"std" => "3",
					"type" => "images",
					"options" => array(
						'4' => $url . 'home-4.png',
						'3' => $url . 'home-3.png'),
					);	
					
					$of_options[] = array( "name" => "Clients",
					"id" => "subheading_212",
					"std" => "",					
					"type" => "subheading");
					
					$of_options[] = array( "name" => "Clients Title",
					"desc" => "",
					"id" => $prefix."tr_clients_title",
					"std" => "Our Clients",
					"type" => "text"); 
					
//
//	Portfolio Tab
//					
					
$of_options[] = array( "name" => "Portfolio",
					"type" => "heading");						
					
					$of_options[] = array( "name" => "Related Work",
					"desc" => "Enable the Related Work box",
					"id" => $prefix."related_enabled",
					"std" => 1,
					"type" => "checkbox"); 					
					
					$of_options[] = array( "name" => "Filtering Menu",
					"desc" => "Uncheck to disable the portfolio filtering menu",
					"id" => $prefix."filtering_enabled",
					"std" => 1,
					"folds" => 1,
					"type" => "checkbox"); 
					
					$of_options[] = array( "name" => "Filter:",
					"desc" => "Filtering menu name",
					"id" => $prefix."tr_filter",
					"std" => "Filter",
					"fold" => $prefix."filtering_enabled",
					"type" => "text");   
					
					$of_options[] = array( "name" => "Show All",
					"desc" => "Filtering menu element to display all project types",
					"id" => $prefix."tr_showall",
					"std" => "Show All",
					"fold" => $prefix."filtering_enabled",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Related Work",
					"desc" => "Related Work section title",
					"id" => $prefix."tr_related_work",
					"std" => "Related Work",
					"fold" => $prefix."related_enabled",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "View Portfolio",
					"desc" => "Title of the link connecting to the portfolio page",
					"id" => $prefix."tr_related_work_link",
					"std" => "View Portfolio",
					"fold" => $prefix."related_enabled",
					"type" => "text"); 
					
//
//	Blog Tab
//					
					
$of_options[] = array( "name" => "Blog",
					"type" => "heading");	
					
					$of_options[] = array( "name" => "Blog Style",
					"desc" => "",
					"id" => $prefix."blog_layout",
					"std" => "1",
					"type" => "radio",
					"options" => array("1" => "Default","2" => "Classic"));
					
//
//	Contact Tab
//					
					
$of_options[] = array( "name" => "Contact",
					"type" => "heading");	
					
					$of_options[] = array( "name" => "E-Mail Address",
					"desc" => "Your E-Mail for the Contact Form",
					"id" => $prefix."contact_email",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Form Success Message",
					"desc" => "Supports HTML",
					"id" => $prefix."contact_success",
					"rows" => "2",
					"std" => "<h2>Thank you, your message has been sent.</h2>",
					"type" => "textarea");
					
					$of_options[] = array( "name" => "Google Map",
					"desc" => "Enable the big Google Map.",
					"id" => $prefix."contact_map",
					"std" => 1,
					"folds" => 1,
					"type" => "checkbox"); 
					
					$of_options[] = array( "name" => "Map Location",
					"desc" => "A location for the big map on the Contact Page.",
					"id" => $prefix."map_location",
					"std" => "Mountlake, Seattle, USA",
          			"fold" => $prefix."contact_map",
					"type" => "text");
					
					$of_options[] = array( "name" => "Map Zoom:",
					"desc" => "",
					"id" => $prefix."map_zoom",
					"std" => "15",
					"class" => "mini",
					"fold" => $prefix."contact_map",
					"type" => "text"); 	
					
					$of_options[] = array( "name" => "Map Color",
					"desc" => "Black & White?",
					"id" => $prefix."map_color",
					"std" => 1,
					"fold" => $prefix."contact_map",
					"type" => "checkbox"); 	


//
//	Header Tab
//					
					
$of_options[] = array( "name" => "Header",
					"type" => "heading");
												
					$of_options[] = array( "name" => "Header Style",
					"desc" => "",
					"id" => $prefix."header_style",
					"std" => "1",
					"type" => "radio",
					"options" => array("1" => "Default","2" => "Centered"));					
					
					$of_options[] = array( "name" => "Navigation Top Margin",
					"desc" => "The space above the Navigation Bar in pixels. Modify to vertically align the bar to your logo. Default value: 35",
					"id" => $prefix."header_navspace",
					"std" => "35",
					"type" => "text");
					
					$of_options[] = array( "name" => "Animated Top Border",
					"desc" => "Enable the animated border above navigation elements.",
					"id" => $prefix."header_border",
					"std" => 1,
					"type" => "checkbox"); 					
					
					$of_options[] = array( "name" => "Breadcrumbs",
					"desc" => "Enable the breadcrumbs navigation.",
					"id" => $prefix."breadcrumbs",
					"std" => 1,
					"type" => "checkbox"); 	
					
					$of_options[] = array( "name" => "Header Search Bar",
					"desc" => "Disable the search bar located on the right side of the Page Title field.",
					"id" => $prefix."header_search",
					"std" => 0,
					"type" => "checkbox");
					
					$of_options[] = array( "name" => "Page Title",
					"desc" => "Disable the Page Title field globally.",
					"id" => $prefix."header_title",
					"std" => 0,
					"type" => "checkbox"); 	
					
					
//
//	Footer Tab
//					
					
$of_options[] = array( "name" => "Footer",
					"type" => "heading");
												
					$of_options[] = array( "name" => "Footer Color Scheme",
					"desc" => "",
					"id" => $prefix."footer_scheme",
					"std" => "1",
					"type" => "radio",
					"options" => array("1" => "Default Dark","2" => "White"));	
					
					$of_options[] = array( "name" => "Copyright Text",
					"desc" => "Supports HTML",
					"id" => $prefix."copyright",
					"rows" => "2",
					"std" => "© 2011 <a href='#'>Spacing</a> - All rights reserved.",
					"type" => "textarea");
					
//
//	Social Icons
//					
					
$of_options[] = array( "name" => "Social Icons",
					"type" => "heading");
					
					$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "info_10",
					"std" => "To disable a social icon just leave it's URL field blank.",
					"icon" => true,
					"type" => "info");	
					
					$of_options[] = array( "name" => "Display Social Icons in Footer",
					"desc" => "Enable the Social Icons area in Footer",
					"id" => $prefix."social_footer",
					"std" => 1,
					"type" => "checkbox");  		
					
					
					$of_options[] = array( "name" => "Twitter",
					"desc" => "URL address of your Twitter page",
					"id" => $prefix."social_1",
					"std" => "#",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Facebook",
					"desc" => "URL address of your Facebook page",
					"id" => $prefix."social_2",
					"std" => "#",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Google+",
					"desc" => "URL address of your Google+ page",
					"id" => $prefix."social_3",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Pinterest",
					"desc" => "URL address of your Pinterest page",
					"id" => $prefix."social_4",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "RSS",
					"desc" => "URL address of your RSS",
					"id" => $prefix."social_5",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Dribbble",
					"desc" => "URL address of your Dribbble page",
					"id" => $prefix."social_6",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "StumbleUpon",
					"desc" => "URL address of your StumbleUpon page",
					"id" => $prefix."social_7",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "YouTube",
					"desc" => "URL address of your YouTube channel",
					"id" => $prefix."social_8",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Vimeo",
					"desc" => "URL address of your Vimeo channel",
					"id" => $prefix."social_9",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Tumblr",
					"desc" => "URL address of your Tumblr",
					"id" => $prefix."social_10",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "LinkedIn",
					"desc" => "URL address of your LinkedIn profile",
					"id" => $prefix."social_11",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Digg",
					"desc" => "URL address of your Digg page",
					"id" => $prefix."social_12",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Dropbox",
					"desc" => "URL address of your Dropbox page",
					"id" => $prefix."social_13",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Delicious",
					"desc" => "URL address of your Delicious page",
					"id" => $prefix."social_14",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Myspace",
					"desc" => "URL address of your Myspace page",
					"id" => $prefix."social_15",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Skype",
					"desc" => "URL address of your Skype page",
					"id" => $prefix."social_16",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Plixi",
					"desc" => "URL address of your Plixi page",
					"id" => $prefix."social_17",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Last.fm",
					"desc" => "URL address of your Last.fm page",
					"id" => $prefix."social_18",
					"std" => "",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Mobypicture",
					"desc" => "URL address of your Mobypicture page",
					"id" => $prefix."social_19",
					"std" => "",
					"type" => "text"); 
					
					
//
//	Appearance Tab
//					
					
$of_options[] = array( "name" => "Appearance",
					"type" => "heading");
				
					$of_options[] = array( "name" => "Website Background",
					"id" => "subheading_211",
					"std" => "",
					"type" => "subheading");	
					
					$of_options[] = array( "name" => "Background Color",
					"desc" => "",
					"id" => $prefix."background_color",
					"std" => "#f2f2f2",
					"type" => "color");
				
					$of_options[] = array( "name" => "Background Image",
					"desc" => "",
					"id" => $prefix."background_img",
					"std" => "http://thetauris.com/themes/spacing/wp-content/themes/spacing/img/bg/subtle.png",
					"type" => "upload"); 
					
					$of_options[] = array( "name" => "Big Background Image",
					"desc" => "Enable if you are going to use a large image as your website background",
					"id" => $prefix."background_fixed",
					"std" => 0,
					"type" => "checkbox");   
					
					$of_options[] = array( "name" => "Font Colors",
					"id" => "subheading_203",
					"std" => "",
					"type" => "subheading");	
					
					$of_options[] = array( "name" =>  "Main Color",
					"desc" => "Color of links, current navigation elements",
					"id" => $prefix."color_main",
					"std" => "#ff3333",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Titles Hover Color",
					"desc" => "Color of links, current navigation elements",
					"id" => $prefix."color_hover_title",
					"std" => "#ff3333",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Links Hover Color",
					"desc" => "Color of links hover status",
					"id" => $prefix."color_hover_links",
					"std" => "#222",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Footer Links Hover Color",
					"desc" => "Color of the footer links hover status",
					"id" => $prefix."color_hover_flinks",
					"std" => "#fff",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Headings & Post Titles Color",
					"desc" => "H1, H2, ..., H6 & Titles",
					"id" => $prefix."color_headings",
					"std" => "#444",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Page Title Color",
					"desc" => "Page Title heading",
					"id" => $prefix."color_pagetitle",
					"std" => "#fff",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Body Text Color",
					"desc" => "Color of all the page content text",
					"id" => $prefix."color_body",
					"std" => "#666",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Borders, Dividers",
					"desc" => "Date, Comments Boxes, Line Dividers",
					"id" => $prefix."color_borders",
					"std" => "#f4f4f4",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Copyright Color",
					"desc" => "Color of the copyright text",
					"id" => $prefix."color_copyright",
					"std" => "#666",
					"type" => "color");
					
					$of_options[] = array( "name" => "Page Background Colors",
					"id" => "subheading_210",
					"std" => "",
					"type" => "subheading");	
					
					$of_options[] = array( "name" =>  "Header Background Color",
					"desc" => "Background color of the Header area",
					"id" => $prefix."background_header",
					"std" => "#fff",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Page Title Background Color",
					"desc" => "Background color of the Page Title area",
					"id" => $prefix."background_pagetitle",
					"std" => "#ff3333",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Page Content Background Color",
					"desc" => "Background color of the page content areas",
					"id" => $prefix."background_content",
					"std" => "#fff",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Footer Background Color",
					"desc" => "Background color of the page content areas",
					"id" => $prefix."background_footer",
					"std" => "#222",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Copyright Background Color",
					"desc" => "Leave blank for transparent background",
					"id" => $prefix."background_copyright",
					"std" => "#1a1a1a",
					"type" => "color");
					
					$of_options[] = array( "name" =>  "Page Holder Background Color",
					"desc" => "'Wrapper' background color. Leave blank for default transparency",
					"id" => $prefix."background_wrapper",
					"std" => "",
					"type" => "color");
					
//
//	Typography Tab
//					
					
$of_options[] = array( "name" => "Typography",
					"type" => "heading");	
					
					
					$of_options[] = array( "name" => "Font Families",
					"id" => "subheading_209",
					"std" => "",
					"type" => "subheading");
					
					$of_options[] = array( "name" => "Hello there!",
					"desc" => "",
					"id" => "info_10",
					"std" => "You may preview the fonts at <a target='blank_' href='http://www.google.com/webfonts'>http://www.google.com/webfonts</a>.",
					"icon" => true,
					"type" => "info");
					
					$of_options[] = array( "name" => "Page Title & Tagline",
					"desc" => "Default: Pontano Sans",
					"id" => $prefix."font_page_title",
					"std" => "Pontano+Sans",
					"type" => "select",
					"options" => array(							
							
					"Pontano+Sans" => "Pontano Sans",
					"Helvetica" => "Helvetica/Arial",	
					"Open+Sans+Condensed" => "Open Sans Condensed",
					"Quattrocento" => "Quattrocento",
					"Droid+Sans" => "Droid Sans",
					"Droid+Serif" => "Droid Serif",
					"Lobster" => "Lobster",
					"Lato" => "Lato",
					"Arimo" => "Arimo",					
					"PT+Sans" => "PT Sans",
					"Yanone+Kaffeesatz" => "Yanone Kaffeesatz",
					"Arvo" => "Arvo",
					"Ubuntu" => "Ubuntu",
					"Open+Sans" => "Open Sans",
					"Pacifico" => "Pacifico",
					"Calligraffitti" => "Calligraffitti",
					"Reenie+Beanie" => "Reenie Beanie",
					"Crafty+Girls" => "Crafty Girls",
					"Tangerine" => "Tangerine",
					"Oswald" => "Oswald",
					"Shadows+Into+Light" => "Shadows Into Light",
					"Nobile" => "Nobile",
					"Raleway" => "Raleway",
					"Rock+Salt" => "Rock Salt",
					"Copse" => "Copse",
					"Anton" => "Anton"
					
					));
					
					$of_options[] = array( "name" => "Heading Font",
					"desc" => "Navigation, Headings, Page Titles etc",
					"id" => $prefix."font_heading",
					"std" => "Helvetica",
					"type" => "select",
					"options" => array(	
					
					"Helvetica" => "Helvetica/Arial",				
					"Pontano+Sans" => "Pontano Sans",
					"Open+Sans+Condensed" => "Open Sans Condensed",
					"Quattrocento" => "Quattrocento",
					"Droid+Sans" => "Droid Sans",
					"Droid+Serif" => "Droid Serif",
					"Lobster" => "Lobster",
					"Lato" => "Lato",
					"Arimo" => "Arimo",					
					"PT+Sans" => "PT Sans",
					"Yanone+Kaffeesatz" => "Yanone Kaffeesatz",
					"Arvo" => "Arvo",
					"Ubuntu" => "Ubuntu",
					"Open+Sans" => "Open Sans",
					"Pacifico" => "Pacifico",
					"Calligraffitti" => "Calligraffitti",
					"Reenie+Beanie" => "Reenie Beanie",
					"Crafty+Girls" => "Crafty Girls",
					"Tangerine" => "Tangerine",
					"Oswald" => "Oswald",
					"Shadows+Into+Light" => "Shadows Into Light",
					"Nobile" => "Nobile",
					"Raleway" => "Raleway",
					"Rock+Salt" => "Rock Salt",
					"Copse" => "Copse",
					"Anton" => "Anton"					
					));
					
					$of_options[] = array( "name" => "Body Font",
					"desc" => "Page content font family",
					"id" => $prefix."font_body",
					"std" => "default",
					"type" => "select",
					"options" => array(	
									
					"Helvetica" => "Helvetica/Arial",
					"Times New Roman" => "Times New Roman"
					
					));
					
					$of_options[] = array( "name" => "Font Sizes",
					"id" => "subheading_208",
					"std" => "",
					"type" => "subheading");	
					
					$of_options[] = array( "name" => "Body Font Size",
					"desc" => "Font size of all the page content text",
					"id" => $prefix."fontsize_body",
					"std" => array('size' => '12px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Navigation Font Size",
					"desc" => "Font size of the Navigation Bar",
					"id" => $prefix."fontsize_navigation",
					"std" => array('size' => '12px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Homepage Tagline Font Size",
					"desc" => "Font size of the Homepage Tagline",
					"id" => $prefix."fontsize_hometagline",
					"std" => array('size' => '22px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Page Title Font Size",
					"desc" => "Font size of the Page Title",
					"id" => $prefix."fontsize_pagetitle",
					"std" => array('size' => '20px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Page Tagline Font Size",
					"desc" => "Font size of the Page Title's Tagline",
					"id" => $prefix."fontsize_pagetagline",
					"std" => array('size' => '11px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Heading H1 Font Size",
					"desc" => "Font size of the H1 Heading",
					"id" => $prefix."fontsize_h1",
					"std" => array('size' => '22px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Heading H2 Font Size",
					"desc" => "Font size of the H2 Heading",
					"id" => $prefix."fontsize_h2",
					"std" => array('size' => '18px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Heading H3 Font Size",
					"desc" => "Font size of the H3 Heading",
					"id" => $prefix."fontsize_h3",
					"std" => array('size' => '16px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Heading H4 Font Size",
					"desc" => "Font size of the H4 Heading",
					"id" => $prefix."fontsize_h4",
					"std" => array('size' => '14px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Heading H5 Font Size",
					"desc" => "Font size of the H5 Heading",
					"id" => $prefix."fontsize_h5",
					"std" => array('size' => '11px'),
					"type" => "typography");
					
					$of_options[] = array( "name" => "Heading H6 Font Size",
					"desc" => "Font size of the H6 Heading",
					"id" => $prefix."fontsize_h6",
					"std" => array('size' => '10px'),
					"type" => "typography");					

//
//	Slider Tab
//					
					
$of_options[] = array( "name" => "Slider",
					"type" => "heading");	
					
					$of_options[] = array( "name" => "Animation Speed",
					"desc" => "Animation Speed in miliseconds",
					"id" => $prefix."slider_animation",
					"std" => "500",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Pause Time",
					"desc" => "Slide Pause Time in miliseconds",
					"id" => $prefix."slider_pause",
					"std" => "3000",
					"type" => "text"); 					
					
					$of_options[] = array( "name" => "Normal Select",
					"desc" => "Normal Select Box.",
					"id" => $prefix."slider_effect",
					"std" => "fade",
					"type" => "select",
					"options" => array('fade' => 'Fade','slide' => 'Slide'));  
					
					$of_options[] = array( "name" => "Bullet Navigation",
					"desc" => "Enable slider Bullet Nav",
					"id" => $prefix."slider_bullets",
					"std" => "true",
					"type" => "radio",
					"options" => array("true" => "True","false" => "False"));	
					
					$of_options[] = array( "name" => "Direction Navigation",
					"desc" => "Enable slider Diection Nav (arrows)",
					"id" => $prefix."slider_arrows",
					"std" => "true",
					"type" => "radio",
					"options" => array("true" => "True","false" => "False"));
					

//
//	Translate Tab
//					
					
$of_options[] = array( "name" => "Translate",
					"type" => "heading");	
					
					$of_options[] = array( "name" => "Enable Translation",
					"desc" => "Enable Translation through the Theme Options Panel",
					"id" => $prefix."translate",
					"std" => 1,
					"type" => "checkbox"); 
					
					$of_options[] = array( "name" => "Translate Info",
					"desc" => "",
					"id" => "info_9",
					"std" => "If you disable the Translation Panel, you'll need to modify all the Theme's text through the .po file.",
					"icon" => true,
					"type" => "info"); 
					
					$of_options[] = array( "name" => "Blog",
					"id" => "subheading_205",
					"std" => "",
					"type" => "subheading");
					
					$of_options[] = array( "name" => "Author",
					"desc" => "",
					"id" => $prefix."tr_author",
					"std" => "Author",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Posted in",
					"desc" => "",
					"id" => $prefix."tr_posted_in",
					"std" => "Posted in",
					"type" => "text"); 					
					
					$of_options[] = array( "name" => "Tags",
					"desc" => "",
					"id" => $prefix."tr_tags",
					"std" => "Tags",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Read more",
					"desc" => "",
					"id" => $prefix."tr_read_more",
					"std" => "Read more",
					"type" => "text");					
					
					$of_options[] = array( "name" => "Posted by (Classic Layout)",
					"desc" => "",
					"id" => $prefix."tr_posted_by",
					"std" => "Posted by",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "In (Classic Layout)",
					"desc" => "",
					"id" => $prefix."tr_in",
					"std" => "In",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "On (Classic Layout)",
					"desc" => "",
					"id" => $prefix."tr_on",
					"std" => "On",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Comment (singular)",
					"desc" => "",
					"id" => $prefix."tr_comment",
					"std" => "Comment",
					"type" => "text");
					
					$of_options[] = array( "name" => "Comments",
					"desc" => "",
					"id" => $prefix."tr_comments",
					"std" => "Comments",
					"type" => "text");
					
					$of_options[] = array( "name" => "No Comments",
					"desc" => "",
					"id" => $prefix."tr_no_comments",
					"std" => "No comments",
					"type" => "text");
					
					$of_options[] = array( "name" => "No Comments Message",
					"desc" => "",
					"id" => $prefix."tr_no_comments_msg",
					"std" => "There are no comments on this post yet.",
					"rows" => "2",
					"type" => "textarea");
						
					
					$of_options[] = array( "name" => "Leave a Reply",
					"desc" => "",
					"id" => $prefix."tr_leave_reply",
					"std" => "Leave a Reply",
					"type" => "text");	
					
					$of_options[] = array( "name" => "Cancel Reply",
					"desc" => "",
					"id" => $prefix."tr_cancel_reply",
					"std" => "Cancel reply",
					"type" => "text");	
					
					
					
								
					$of_options[] = array( "name" => "404 Page & No Results",
					"id" => "subheading_204",
					"std" => "",
					"type" => "subheading");					
										
					$of_options[] = array( "name" => "404 Page Title",
					"desc" => "",
					"id" => $prefix."tr_404_title",
					"std" => "Page not found",
					"type" => "text");
					
					$of_options[] = array( "name" => "404 Page Content",
					"desc" => "Supports HTML",
					"id" => $prefix."tr_404_content",
					"std" => "Sorry, what you are looking for isn't here.",
					"rows" => "3",
					"type" => "textarea");	
					
					$of_options[] = array( "name" => "No results message",
					"desc" => "Supports HTML",
					"id" => $prefix."tr_no_results",
					"std" => "<h3>Nothing found.</h3> Sorry, no posts matched your criteria.",
					"rows" => "3",
					"type" => "textarea");	
					
					
					
					
					$of_options[] = array( "name" => "Forms",
					"id" => "subheading_207",
					"std" => "",
					"type" => "subheading");
					
					$of_options[] = array( "name" => "Name",
					"desc" => "",
					"id" => $prefix."tr_name",
					"std" => "Name",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "E-Mail",
					"desc" => "",
					"id" => $prefix."tr_email",
					"std" => "E-Mail",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Subject",
					"desc" => "",
					"id" => $prefix."tr_subject",
					"std" => "Subject",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Website (Comments)",
					"desc" => "",
					"id" => $prefix."tr_website",
					"std" => "Website",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Message",
					"desc" => "",
					"id" => $prefix."tr_message",
					"std" => "Message",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Send",
					"desc" => "",
					"id" => $prefix."tr_send",
					"std" => "Send",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Submit",
					"desc" => "",
					"id" => $prefix."tr_submit",
					"std" => "Submit",
					"type" => "text"); 	
					
					$of_options[] = array( "name" => "Search",
					"desc" => "",
					"id" => $prefix."tr_search",
					"std" => "Search..",
					"type" => "text"); 	
									
					
					
					$of_options[] = array( "name" => "Misc",
					"id" => "subheading_206",
					"std" => "",
					"type" => "subheading");	
					
					$of_options[] = array( "name" => "Top",
					"desc" => "",
					"id" => $prefix."tr_top",
					"std" => "Top",
					"type" => "text"); 
					
					$of_options[] = array( "name" => "Select Page",
					"desc" => "Title of the dropdown navigation menu while in mobile mode",
					"id" => $prefix."tr_select_page",
					"std" => "Select page:",
					"type" => "text"); 
					
					
                                                    
    
//					
// Backup Tab
//


$of_options[] = array( "name" => "Backup Options",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
	}
}
?>
