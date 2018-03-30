<?php
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
		$categories_tmp 	= array_unshift($of_categories, "Select a category:" );

		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:" );

		//Testing
		$of_options_select 	= array("one","two","three","four","five" );
		$of_options_radio 	= array("0" => "0","1" => "1","2" => "2","3" => "3","4" => "4","5" => "5","6" => "6","7" => "7" );
		$of_options_radio_2 	= array("0" => "0","1" => "1","2" => "2","3" => "3" );

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_team" => "Team",
				"block_testimonials" => "Testimonials",
				"block_about_us" => "About Us",
				"block_portfolio" => "Portfolio",
				"block_services" => "Services",
				"block_news" => "News",
				"block_twitter" => "Twitter Feed",
				"block_contact_page" => "Contact Page",
				"block_contact_map" => "Contact Map",
				"block_contact_details" => "Contact Details",
				"block_contact_form" => "Contact Form",
				"block_social_media" => "Social Media",
				"block_sharing_buttons_1"	=> "Sharing Buttons 1",
				"block_sharing_buttons_2"	=> "Sharing Buttons 2",
				"block_sharing_buttons_3"	=> "Sharing Buttons 3",
				"block_sharing_buttons_4"	=> "Sharing Buttons 4",
				"block_sharing_buttons_5"	=> "Sharing Buttons 5",
				"block_clean_page_1"	=> "Clean Page 1",
				"block_clean_page_2"	=> "Clean Page 2",
				"block_clean_page_3"	=> "Clean Page 3",
				"block_clean_page_4"	=> "Clean Page 4",
				"block_clean_page_5"	=> "Clean Page 5",
				"block_parallax_1" => "Parallax 1",
				"block_parallax_2" => "Parallax 2",
				"block_parallax_3" => "Parallax 3",
				"block_parallax_4" => "Parallax 4",
				"block_parallax_5" => "Parallax 5",
				"block_parallax_6" => "Parallax 6",
				"block_parallax_7" => "Parallax 7",
				"block_parallax_8" => "Parallax 8",
				"block_parallax_9" => "Parallax 9",
				"block_parallax_10" => "Parallax 10"
			),
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
			),
		);


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19" );
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat" );
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right" );

		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center" );

		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post" );


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( "name" => "General Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Facebook URL",
					"desc" => "Enter Your Facebook URL Here",
					"id" => "facebook_header",
					"std" => "",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter URL",
					"desc" => "Enter Your Twitter URL Here",
					"id" => "twitter_header",
					"std" => "",
					"type" => "text" );

$of_options[] = array( "name" => "Use Revolution Slider",
					"desc" => "Check if you want to use slider on your template!",
					"id" => "offline_favicon",
					"std" => 1,
          			"folds" => 1,
					"type" => "checkbox" );

$of_options[] = array( "name" => "Enter Shortcode here",
					"desc" => "Enter Shortcode",
					"id" => "uploaded_favicon",
					"std" => "[rev_slider dreamer_slider]",
          			"fold" => "offline_favicon", /* the checkbox hook */
					"type" => "text" );

$of_options[] = array( "name" => "Custom Logo",
					"desc" => "Check this if you want to upload your own custom logo.",
					"id" => "offline_logo",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox" );

$of_options[] = array( "name" => "Upload Your Logo",
					"desc" => "Here you can upload your logo. *Note: Maximum logo size should be 260x80px",
					"id" => "uploaded_logo",
					"std" => "",
          			"fold" => "offline_logo", /* the checkbox hook */
					"type" => "media" );

$of_options[] = array( "name" => "Hide Loader",
					"desc" => "Check this if you want to hide loader on the homepage.",
					"id" => "hide_loader",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox" );

$of_options[] = array( "name" => "Custom Loader",
					"desc" => "Check this if you want to upload your own custom loader.",
					"id" => "offline_loader",
					"std" => 0,
          			"folds" => 1,
					"type" => "checkbox" );

$of_options[] = array( "name" => "Custom Loader",
					"desc" => "Here you can upload your loader. Keep in mind that the image has to be 50x50px and in .gif",
					"id" => "uploaded_loader",
					"std" => "",
          			"fold" => "offline_loader", /* the checkbox hook */
					"type" => "media" );

// Homepage Slideshow
$of_options[] = array( "name" => "Homepage Slideshow Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Slider Options",
					"desc" => "Unlimited slider with drag and drop sortings.",
					"id" => "homepage_supersized_slideshow",
					"type" => "slider" );

$of_options[] = array( "name" => "Slideshow on/off",
					"desc" => "If you switch to OFF the homepage will have only one photo!",
					"id" => "slideshow_on_off",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Autoplay",
					"desc" => "Slideshow starts playing automatically!",
					"id" => "slideshow_autoplay",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Start slide",
					"desc" => "Switch to OFF if you want a random start slide!",
					"id" => "slideshow_start_slide",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Stop Loop",
					"desc" => "Switch to ON if you want the slideshow to stop on the last slide",
					"id" => "slideshow_stop_loop",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Random Order",
					"desc" => "Switch to ON if you want the slideshow to ignore the order of the slides you've set up.",
					"id" => "slideshow_random",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Slideshow Interval",
					"desc" => "Length between transitions",
					"id" => "slideshow_interval",
					"std" => "3000",
					"min" => "0",
					"step" => "100",
					"max" => "10000",
					"type" => "sliderui" );

$of_options[] = array( "name" => "Transition Effect",
					"desc" => "Choose the transition effect for the homepage slideshow:<br>0-None,<br>1-Fade,<br>2-Slide Top,<br>3-Slide Right,<br>4-Slide Bottom,<br>5-Slide Left,<br>6-Carousel Right,<br>7-Carousel Left",
					"id" => "slideshow_transition_effect",
					"std" => "1",
					"type" => "select",
					"class" 	=> "tiny", //mini, tiny, small
					"options" 	=> $of_options_radio );

$of_options[] = array( "name" => "Slideshow Transition Speed",
					"desc" => "Transition Speed",
					"id" => "slideshow_transition_speed",
					"std" => "1500",
					"min" => "0",
					"step" => "100",
					"max" => "10000",
					"type" => "sliderui" );

$of_options[] = array( "name" => "Links Open",
					"desc" => "Switch to ON if you want image links to open in new window/tab",
					"id" => "slideshow_links_open",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Pause slideshow on hover",
					"desc" => "Switch to ON if you want to pause slideshow on hover",
					"id" => "slideshow_pause_on_hover",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Keyboard navigation",
					"desc" => "Turn the keyboard navigation on or off",
					"id" => "slideshow_keyboard_navigation",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Performance",
					"desc" => "Choose the performance of the slideshow. Only works for Firefox/IE, not Webkit:<br>0-Normal,<br>1-Hybrid speed/quality,<br>2-Optimizes image quality,<br>3-Optimizes transition speed",
					"id" => "slideshow_performance",
					"std" => "1",
					"type" => "select",
					"class" 	=> "tiny", //mini, tiny, small
					"options" 	=> $of_options_radio_2 );

$of_options[] = array( "name" => "Image Protect",
					"desc" => "Disables image dragging and right click with Javascript",
					"id" => "slideshow_image_protect",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Show Slideshow Pattern",
					"desc" => "Switch to OFF to hide the slideshow pattern",
					"id" => "slideshow_pattern",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Upload Slideshow Pattern",
					"desc" => "Upload the slideshow_pattern",
					"id" => "slideshow_pattern_image",
					// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
					"fold" => "slideshow_pattern",
					"type" => "media" );

$of_options[] = array( "name" => "Show Slideshow Overlay",
					"desc" => "Switch to OFF to hide the slideshow overlay",
					"id" => "slideshow_overlay",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Slideshow Overlay Color",
					"desc" => "Choose the homepage slideshow overlay color:",
					"id" => "slideshow_overlay_color",
					"fold" => "slideshow_overlay",
					"type" => "color" );

$of_options[] = array( "name" => "Slideshow Overlay Color Opacity",
					"desc" => "Choose the slideshow overlay color opacity:",
					"id" => "slideshow_overlay_color_opacity",
					"std" => "10",
					"min" => "0",
					"step" => "1",
					"max" => "100",
					"fold" => "slideshow_overlay",
					"type" => "sliderui" );

$of_options[] = array( "name" => "Show Slideshow Triangles Overlay",
					"desc" => "Switch to OFF to hide the slideshow triangles overlay",
					"id" => "slideshow_triangles_overlay",
					"std" => 1,
					"type" => "switch" );

// Homepage Big Video
$of_options[] = array( "name" => "Homepage Big Video Settings",
					"type" => "heading" );


$of_options[] = array( "name" => "Homepage Background Image",
					"desc" => "Upload Big Image for Touch Devices. Note: Video doesn't work on touch devices!",
					"id" => "homepage_big_video_image",
					"std" => "",
					"type" => "media" );

$of_options[] = array( "name" => "Homepage Background Video mp4",
					"desc" => "Upload your Background Big Video!",
					"id" => "homepage_big_video_src_mp4",
					"std" => "http://vjs.zencdn.net/v/oceans.mp4",
					"type" => "text" );


$of_options[] = array( "name" => "Homepage Background Video ogv",
					"desc" => "Upload your Background Big Video!",
					"id" => "homepage_big_video_src_ogv",
					"std" => "",
					"type" => "text" );

// Homepage Content
$of_options[] = array( "name" => "Homepage Content",
					"type" => "heading" );

$of_options[] = array( "name" => "Show Homepage Content",
					"desc" => "Switch to OFF to hide homepage content",
					"id" => "homepage_content",
					"std" => 1,
					"type" => "switch" );

$of_options[] = array( "name" => "Upload Top Icon",
					"desc" => "Upload the top icon. Recommended size is 76x76px",
					"id" => "homepage_top_icon",
					// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
					"fold" => "homepage_content",
					"type" => "media" );

$of_options[] = array( "name" => "Homepage Title",
					"desc" => "This is the main homepage title!",
					"id" => "homepage_main_title",
					"std" => "Hi, I\'m just a text input - nr 1",
					"fold" => "homepage_content",
					"type" => "text" );

$of_options[] = array( "name" => "Homepage Text Row One",
					"desc" => "Enter the text for the homepage text row one!",
					"id" => "homepage_text_row_one",
					"std" => "Hi, I\'m just a text input - nr 1",
					"fold" => "homepage_content",
					"type" => "text" );

$of_options[] = array( "name" => "Homepage Text Row Two",
					"desc" => "Enter the text for the homepage text row two!",
					"id" => "homepage_text_row_two",
					"std" => "Hi, I\'m just a text input - nr 1",
					"fold" => "homepage_content",
					"type" => "text" );

$of_options[] = array( "name" => "Upload Bottom Icon",
					"desc" => "Upload the bottom icon. Recommended size is 30x30px",
					"id" => "homepage_bottom_icon",
					"fold" => "homepage_content",
					"type" => "media" );

// Homepage Layout Manager
$of_options[] = array( "name" => "Homepage Layout Manager",
					"type" => "heading" );

$of_options[] = array( "name" => "Homepage Layout Manager",
					"desc" => "Organize how you want the layout to appear on the homepage",
					"id" => "parallax_homepage_layout",
					"std" => $of_options_homepage_blocks,
					"type" => "sorter" );

// Pages Section
$of_options[] = array( "name" => "Pages Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "About Page Title",
					"desc" => "Enter the title for the about page!",
					"id" => "about_page_title",
					"std" => "About Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "About Page Description",
					"desc" => "Your about page description goes here. Format description with SPAN tags!",
					"id" => "about_page_description",
					"std" => "Your about page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Team Page Title",
					"desc" => "Enter the title for the team page!",
					"id" => "team_page_title",
					"std" => "Team Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "Team Page Description",
					"desc" => "Your team page description goes here. Format description with SPAN tags!",
					"id" => "team_page_description",
					"std" => "Your team page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Testimonials Page Title",
					"desc" => "Enter the title for the testimonials page!",
					"id" => "testimonials_page_title",
					"std" => "Testimonials Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "Testimonials Page Description",
					"desc" => "Your testimonials page description goes here. Format description with SPAN tags!",
					"id" => "testimonials_page_description",
					"std" => "Your testimonials page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Services Page Title",
					"desc" => "Enter the title for the services page!",
					"id" => "services_page_title",
					"std" => "Services Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "Services Page Description",
					"desc" => "Your services page description goes here. Format description with SPAN tags!",
					"id" => "services_page_description",
					"std" => "Your services page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Upload Services Banner",
					"desc" => "Upload services banner. Recommended size is 980x485px",
					"id" => "services_banner_image",
					"type" => "media" );

// News Section
$of_options[] = array( "name" => "News Page Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "News Page Title",
					"desc" => "Enter the title for the news page!",
					"id" => "news_page_title",
					"std" => "News Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "News Page Description",
					"desc" => "Your news page description goes here. Format description with SPAN tags!",
					"id" => "news_page_description",
					"std" => "Your news page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Image Post Icon",
					"desc" => "Upload image post icon. Recommended size is 40x40px",
					"id" => "news_image_post_icon",
					"std" => "",
					"type" => "media" );

$of_options[] = array( "name" => "Video Post Icon",
					"desc" => "Upload video post icon. Recommended size is 40x40px",
					"id" => "news_video_post_icon",
					"std" => "",
					"type" => "media" );

$of_options[] = array( "name" => "Audio Post Icon",
					"desc" => "Upload audio post icon. Recommended size is 40x40px",
					"id" => "news_audio_post_icon",
					"std" => "",
					"type" => "media" );

$of_options[] = array( "name" => "View More Blog Posts URL",
					"desc" => "Insert URL for more blog posts!",
					"id" => "more_blog_posts",
					"type" => "text" );


// News Section
$of_options[] = array( "name" => "Twitter Page Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Twitter Page Title",
					"desc" => "Enter the title for the twitter page!",
					"id" => "twitter_page_title",
					"std" => "Twitter Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Page Description",
					"desc" => "Your twitter page description goes here. Format description with SPAN tags!",
					"id" => "twitter_page_description",
					"std" => "Your twitter page description goes here!",
					"type" => "textarea" );



// Portfolio Section
$of_options[] = array( "name" => "Portfolio Page Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Portfolio Page Title",
					"desc" => "Enter the title for the Portfolio page!",
					"id" => "portfolio_page_title",
					"std" => "portfolio Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "Portfolio Page Description",
					"desc" => "Your Portfolio page description goes here. Format description with SPAN tags!",
					"id" => "portfolio_page_description",
					"std" => "Your Portfolio page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Portfolio Menu Icon one",
					"desc" => "Insert Menu Icon!",
					"id" => "portfolio_menu_icon_one",
					"type" => "media" );

$of_options[] = array( "name" => "Portfolio Menu Icon two",
					"desc" => "Insert Menu Icon!",
					"id" => "portfolio_menu_icon_two",
					"type" => "media" );

$of_options[] = array( "name" => "Portfolio Menu Icon three",
					"desc" => "Insert Menu Icon!",
					"id" => "portfolio_menu_icon_three",
					"type" => "media" );

$of_options[] = array( "name" => "Portfolio Menu Icon four",
					"desc" => "Insert Menu Icon!",
					"id" => "portfolio_menu_icon_four",
					"type" => "media" );

$of_options[] = array( "name" => "Portfolio Menu Icon five",
					"desc" => "Insert Menu Icon!",
					"id" => "portfolio_menu_icon_five",
					"type" => "media" );

// Social Media Section
$of_options[] = array( "name" => "Social Media Icons Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Social Media Page Title",
					"desc" => "Enter the title for the Social page!",
					"id" => "social_page_title",
					"std" => "social Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "Social Media Page Description",
					"desc" => "Your Social page description goes here. Format description with SPAN tags!",
					"id" => "social_page_description",
					"std" => "Your Social page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Social Media Icon",
					"desc" => "Upload image post icon. Recommended size is 60x60px",
					"id" => "social_image_post_icon",
					"type" => "media" );

$of_options[] = array( "name" => "Behance Social Link",
					"desc" => "Enter the URL of your Behance link!",
					"id" => "social_link_one",
					"type" => "text" );

$of_options[] = array( "name" => "Blogger Social Link",
					"desc" => "Enter the URL of your Blogger link!",
					"id" => "social_link_two",
					"type" => "text" );

$of_options[] = array( "name" => "Digg Social Link",
					"desc" => "Enter the URL of your Digg link!",
					"id" => "social_link_three",
					"type" => "text" );

$of_options[] = array( "name" => "Dribble Social Link",
					"desc" => "Enter the URL of your Dribble link!",
					"id" => "social_link_four",
					"type" => "text" );

$of_options[] = array( "name" => "Email Social Link",
					"desc" => "Enter the URL of your Email link!",
					"id" => "social_link_five",
					"type" => "text" );

$of_options[] = array( "name" => "Facebook Social Link",
					"desc" => "Enter the URL of your Facebook link!",
					"id" => "social_link_six",
					"type" => "text" );

$of_options[] = array( "name" => "Flickr Social Link",
					"desc" => "Enter the URL of your Flickr link!",
					"id" => "social_link_seven",
					"type" => "text" );

$of_options[] = array( "name" => "Google Plus Social Link",
					"desc" => "Enter the URL of your Google Plus link!",
					"id" => "social_link_eight",
					"type" => "text" );

$of_options[] = array( "name" => "Instagram Social Link",
					"desc" => "Enter the URL of your Instagram link!",
					"id" => "social_link_nine",
					"type" => "text" );

$of_options[] = array( "name" => "Last.Fm Social Link",
					"desc" => "Enter the URL of your Last.Fm link!",
					"id" => "social_link_ten",
					"type" => "text" );

$of_options[] = array( "name" => "LinkedIn Social Link",
					"desc" => "Enter the URL of your LinkedIn link!",
					"id" => "social_link_eleven",
					"type" => "text" );

$of_options[] = array( "name" => "LiveJournal Social Link",
					"desc" => "Enter the URL of your LiveJournal link!",
					"id" => "social_link_twelve",
					"type" => "text" );

$of_options[] = array( "name" => "MySpace Social Link",
					"desc" => "Enter the URL of your MySpace link!",
					"id" => "social_link_thirteen",
					"type" => "text" );

$of_options[] = array( "name" => "Paypal Social Link",
					"desc" => "Enter the URL of your Paypal link!",
					"id" => "social_link_fourteen",
					"type" => "text" );

$of_options[] = array( "name" => "Pinterest Social Link",
					"desc" => "Enter the URL of your Pinterest link!",
					"id" => "social_link_fifteen",
					"type" => "text" );

$of_options[] = array( "name" => "Reddit Social Link",
					"desc" => "Enter the URL of your Reddit link!",
					"id" => "social_link_sixteen",
					"type" => "text" );

$of_options[] = array( "name" => "Sound Cloud Social Link",
					"desc" => "Enter the URL of your Sound Cloud link!",
					"id" => "social_link_seventeen",
					"type" => "text" );

$of_options[] = array( "name" => "Spotify Social Link",
					"desc" => "Enter the URL of your Spotify link!",
					"id" => "social_link_eighteen",
					"type" => "text" );

$of_options[] = array( "name" => "StumbleUpon Social Link",
					"desc" => "Enter the URL of your StumbleUpon link!",
					"id" => "social_link_nineteen",
					"type" => "text" );

$of_options[] = array( "name" => "Tumblr Social Link",
					"desc" => "Enter the URL of your Tumblr link!",
					"id" => "social_link_twenty",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Social Link",
					"desc" => "Enter the URL of your Twitter link!",
					"id" => "social_link_twentyone",
					"type" => "text" );

$of_options[] = array( "name" => "Vimeo Social Link",
					"desc" => "Enter the URL of your Vimeo link!",
					"id" => "social_link_twentytwo",
					"type" => "text" );

$of_options[] = array( "name" => "Wordpress Social Link",
					"desc" => "Enter the URL of your Wordpress link!",
					"id" => "social_link_twentythree",
					"type" => "text" );

$of_options[] = array( "name" => "Youtube Social Link",
					"desc" => "Enter the URL of your Youtube link!",
					"id" => "social_link_twentyfour",
					"type" => "text" );

// Sharing Buttons Section
$of_options[] = array( "name" => "Sharing Buttons Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Sharing Buttons Title",
					"desc" => "Enter the title for the Sharing buttons!",
					"id" => "sharing_buttons_title",
					"type" => "text" );

$of_options[] = array( "name" => "Show Sharing Buttons One Settings",
					"desc" => "If you switch to ON you'll see the options for the Sharing Buttons settings!",
					"id" => "buttons_one_settings",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Facebook Sharing Button URL",
					"desc" => "Enter the URL of your Facebook",
					"id" => "facebook_link_one",
					"fold" => "buttons_one_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Button URL",
					"desc" => "Enter the URL of your Twitter",
					"id" => "twitter_link_one",
					"fold" => "buttons_one_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Username",
					"desc" => "Enter the username of your Twitter",
					"id" => "twitter_user_one",
					"fold" => "buttons_one_settings",
					"type" => "text" );

$of_options[] = array( "name" => "LinkedIn Sharing URL",
					"desc" => "Enter the URL of your LinkedIn",
					"id" => "linkedin_link_one",
					"fold" => "buttons_one_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Show Sharing Buttons Two Settings",
					"desc" => "If you switch to ON you'll see the options for the Sharing Buttons settings!",
					"id" => "buttons_two_settings",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Facebook Sharing Button URL",
					"desc" => "Enter the URL of your Facebook",
					"id" => "facebook_link_two",
					"fold" => "buttons_two_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Button URL",
					"desc" => "Enter the URL of your Twitter",
					"id" => "twitter_link_two",
					"fold" => "buttons_two_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Username",
					"desc" => "Enter the username of your Twitter",
					"id" => "twitter_user_two",
					"fold" => "buttons_two_settings",
					"type" => "text" );

$of_options[] = array( "name" => "LinkedIn Sharing URL",
					"desc" => "Enter the URL of your LinkedIn",
					"id" => "linkedin_link_two",
					"fold" => "buttons_two_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Show Sharing Buttons Three Settings",
					"desc" => "If you switch to ON you'll see the options for the Sharing Buttons settings!",
					"id" => "buttons_three_settings",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Facebook Sharing Button URL",
					"desc" => "Enter the URL of your Facebook",
					"id" => "facebook_link_three",
					"fold" => "buttons_three_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Button URL",
					"desc" => "Enter the URL of your Twitter",
					"id" => "twitter_link_three",
					"fold" => "buttons_three_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Username",
					"desc" => "Enter the username of your Twitter",
					"id" => "twitter_user_three",
					"fold" => "buttons_three_settings",
					"type" => "text" );

$of_options[] = array( "name" => "LinkedIn Sharing URL",
					"desc" => "Enter the URL of your LinkedIn",
					"id" => "linkedin_link_three",
					"fold" => "buttons_three_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Show Sharing Buttons Four Settings",
					"desc" => "If you switch to ON you'll see the options for the Sharing Buttons settings!",
					"id" => "buttons_four_settings",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Facebook Sharing Button URL",
					"desc" => "Enter the URL of your Facebook",
					"id" => "facebook_link_four",
					"fold" => "buttons_four_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Button URL",
					"desc" => "Enter the URL of your Twitter",
					"id" => "twitter_link_four",
					"fold" => "buttons_four_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Username",
					"desc" => "Enter the username of your Twitter",
					"id" => "twitter_user_four",
					"fold" => "buttons_four_settings",
					"type" => "text" );

$of_options[] = array( "name" => "LinkedIn Sharing URL",
					"desc" => "Enter the URL of your LinkedIn",
					"id" => "linkedin_link_four",
					"fold" => "buttons_four_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Show Sharing Buttons Five Settings",
					"desc" => "If you switch to ON you'll see the options for the Sharing Buttons settings!",
					"id" => "buttons_five_settings",
					"std" => 0,
					"type" => "switch" );

$of_options[] = array( "name" => "Facebook Sharing Button URL",
					"desc" => "Enter the URL of your Facebook",
					"id" => "facebook_link_five",
					"fold" => "buttons_five_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Button URL",
					"desc" => "Enter the URL of your Twitter",
					"id" => "twitter_link_five",
					"fold" => "buttons_five_settings",
					"type" => "text" );

$of_options[] = array( "name" => "Twitter Sharing Username",
					"desc" => "Enter the username of your Twitter",
					"id" => "twitter_user_five",
					"fold" => "buttons_five_settings",
					"type" => "text" );

$of_options[] = array( "name" => "LinkedIn Sharing URL",
					"desc" => "Enter the URL of your LinkedIn",
					"id" => "linkedin_link_five",
					"fold" => "buttons_five_settings",
					"type" => "text" );

// Contact Section
$of_options[] = array( "name" => "Contact Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Contact Page Title",
					"desc" => "Enter the title for the Contact page!",
					"id" => "contact_page_title",
					"std" => "Contact Page Title",
					"type" => "text" );

$of_options[] = array( "name" => "contact Page Description",
					"desc" => "Your Contact page description goes here. Format description with SPAN tags!",
					"id" => "contact_page_description",
					"std" => "Your Contact page description goes here!",
					"type" => "textarea" );

$of_options[] = array( "name" => "Contact Map Iframe",
					"desc" => "Insert Iframe of your Google Map!",
					"id" => "contact_page_map",
					"std" => "",
					"type" => "textarea" );

$of_options[] = array( "name" => "Contact Place One",
					"desc" => "Enter your contact title!",
					"id" => "contact_details_title_one",
					"std" => "Contact Title",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Place Image One",
					"desc" => "Insert picture of your place!",
					"id" => "contact_details_image_one",
					"std" => "",
					"type" => "media" );

$of_options[] = array( "name" => "Contact Address One",
					"desc" => "Enter your contact address!",
					"id" => "contact_details_address_one",
					"std" => "Contact Adress One",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Email One",
					"desc" => "Enter your contact email!",
					"id" => "contact_details_email_one",
					"std" => "Contact Email One",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Phone One",
					"desc" => "Enter your contact phone!",
					"id" => "contact_details_phone_one",
					"std" => "Contact Phone One",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Place Two",
					"desc" => "Enter your contact title!",
					"id" => "contact_details_title_two",
					"std" => "Contact Title",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Place Image Two",
					"desc" => "Insert picture of your place!",
					"id" => "contact_details_image_two",
					"std" => "",
					"type" => "media" );


$of_options[] = array( "name" => "Contact Address Two",
					"desc" => "Enter your contact address!",
					"id" => "contact_details_address_two",
					"std" => "Contact Adress Two",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Email Two",
					"desc" => "Enter your contact email!",
					"id" => "contact_details_email_two",
					"std" => "Contact Email Two",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Phone Two",
					"desc" => "Enter your contact phone!",
					"id" => "contact_details_phone_two",
					"std" => "Contact Phone Two",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Place Three",
					"desc" => "Enter your contact title!",
					"id" => "contact_details_title_three",
					"std" => "Contact Title",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Place Image Three",
					"desc" => "Insert picture of your place!",
					"id" => "contact_details_image_three",
					"std" => "",
					"type" => "media" );

$of_options[] = array( "name" => "Contact Address Three",
					"desc" => "Enter your contact address!",
					"id" => "contact_details_address_three",
					"std" => "Contact Adress Three",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Email Three",
					"desc" => "Enter your contact email!",
					"id" => "contact_details_email_three",
					"std" => "Contact Email Three",
					"type" => "text" );

$of_options[] = array( "name" => "Contact Phone Three",
					"desc" => "Enter your contact phone!",
					"id" => "phone_three",
					"std" => "Contact Phone Three",
					"type" => "text" );

// Contact Form Section
$of_options[] = array( "name" => "Contact Form Settings",
					"type" => "heading" );


$of_options[] = array( "name" => "Form Icon one",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_one",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder one",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_one",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Form Icon two",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_two",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder two",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_two",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Form Icon three",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_three",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder three",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_three",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Form Icon four",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_four",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder four",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_four",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );


$of_options[] = array( "name" => "Form Icon five",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_five",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder five",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_five",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Form Icon six",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_six",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder six",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_six",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Form Icon seven",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_seven",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder seven",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_seven",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Form Icon eight",
					"desc" => "Insert your contact icon!",
					"id" => "form_icon_eight",
					"std" =>  "",
					"type" => "media" );

$of_options[] = array( "name" => "Input placeholder eight",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_eight",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

$of_options[] = array( "name" => "Input placeholder nine",
					"desc" => "Enter text for your placeholder!",
					"id" => "placeholder_nine",
					"std" =>  "Enter text for your placeholder!",
					"type" => "text" );

// Clean Pages
$of_options[] = array( "name" => "Clean Pages Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Select the Clean Page One",
					"desc" => "A list of all pages on the site.",
					"id" => "first_content_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Select the Clean Page Two",
					"desc" => "A list of all pages on the site.",
					"id" => "second_content_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Select the Clean Page Three",
					"desc" => "A list of all pages on the site.",
					"id" => "third_content_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Select the Clean Page Four",
					"desc" => "A list of all pages on the site.",
					"id" => "fourth_content_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Select the Clean Page Five",
					"desc" => "A list of all pages on the site.",
					"id" => "fifth_content_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

// Parallax Settings
$of_options[] = array( "name" => "Parallax Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Select the page for the first parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_one_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax One Icon",
					"desc" => "Upload the icon for the parallax one!",
					"id" => "parallax_one_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the second parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_two_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Two Icon",
					"desc" => "Upload the icon for the parallax two!",
					"id" => "parallax_two_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the third parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_three_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Three Icon",
					"desc" => "Upload the icon for the parallax three!",
					"id" => "parallax_three_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the fourth parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_four_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Four Icon",
					"desc" => "Upload the icon for the parallax four!",
					"id" => "parallax_four_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the fifth parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_five_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Five Icon",
					"desc" => "Upload the icon for the parallax five!",
					"id" => "parallax_five_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the sixth parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_six_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Six Icon",
					"desc" => "Upload the icon for the parallax six!",
					"id" => "parallax_six_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the seventh parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_seven_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Seven Icon",
					"desc" => "Upload the icon for the parallax seven!",
					"id" => "parallax_seven_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the eight parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_eight_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Eight Icon",
					"desc" => "Upload the icon for the parallax eight!",
					"id" => "parallax_eight_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the ninth parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_nine_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Nine Icon",
					"desc" => "Upload the icon for the parallax nine!",
					"id" => "parallax_nine_icon",
					"std"  => "",
					"type"  => "media" );

$of_options[] = array( "name" => "Select the page for the tenth parallax section",
					"desc" => "A list of all pages on the site.",
					"id" => "parallax_ten_page",
					"std" => "Select page:",
					"type" => "select",
					"options" => $of_pages);

$of_options[] = array( "name" => "Parallax Ten Icon",
					"desc" => "Upload the icon for the parallax ten!",
					"id" => "parallax_ten_icon",
					"std"  => "",
					"type"  => "media" );


// Footer Section
$of_options[] = array( "name" => "Footer Settings",
					"type" => "heading" );

$of_options[] = array( "name" => "Footer Copyright",
					"desc" => "Copyright text",
					"id" => "footer_description_one_text",
					"std" => "Copyright by AvaThemes",
					"type" => "text" );

$of_options[] = array( "name" => "Created By",
					"desc" => "Created By text",
					"id" => "footer_description_two_text",
					"std" => "Website designed by AvaThemes",
					"type" => "text" );

$of_options[] = array( "name" => "Footer Link",
					"desc" => "Insert URL for your footer link!",
					"id" => "footer_link_url",
					"std" => "http://themeforest.net/user/AVAThemes",
					"type" => "text" );

// SEO Options
$of_options[] = array( "name" => "Twitter Username",
					"type" => "heading" );

$of_options[] = array( "name" => "Twitter Username",
                    "desc" => "Enter your Twitter Username",
                    "id" => "google_analytics_snippet",
                    "std" => "avathemes",
                    "type" => "text" );

// Backup Options
$of_options[] = array( "name" => "Backup Options",
					"type" => "heading"
				);

$of_options[] = array( "name" => "Backup and Restore Options",
					"id" => "of_backup",
					"type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);

$of_options[] = array( "name" => "Transfer Theme Options Data",
					"id" => "of_transfer",
					"type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>