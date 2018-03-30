<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
        $shortname = "pkb";

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

        // Pull all the pages into an array (Custom)
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }

		//Testing
		$of_options_select 	= array("one","two","three","four","five");
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");

		//Sample Homepage blocks for the layout manager (sorter)
		$homepage_mods = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
                "content_mod"   => "Content ",
                "home_widget"   => "Widget"
            ),
            "enabled" => array (
                "placebo"   => "placebo", //REQUIRED!
                "cta_mod"       => "CTA Mod",
                "post_mod"    => "Featured Posts",
                "headline_mod"  => "Headline",
                "list_mod"      => "List ",
                "testimonials_mod"   => "Testimonial Mod"
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

        $url =  ADMIN_DIR . 'assets/images/';

/*----------------------------------------------------------------------------------*/
/* The Options Array */
/*----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

/*====== GENERAL =====*/
$of_options[] = array( "name" => __('General','peekaboo'),
                    "type" => "heading");


$of_options[] = array( "name" => __('Subpages Navigation','peekaboo'),
                    "desc" => __('Display subpages navigation.','peekaboo'),
                    "id" => $shortname."_subpages_nav",
                    "Std" => '1',
                    "type" => "switch");

$of_options[] = array( "name" => __('Sticky Navigation Bar','peekaboo'),
                    "desc" => __('Sticky navigation bar on mobile.','peekaboo'),
                    "id" => $shortname."_sticky_nav",
                    "std" => "1",
                    "type" => "switch");

$of_options[] = array( "name" => __('Footer Text','peekaboo'),
                    "desc" => __('Copyright note in the footer.','peekaboo'),
                    "id" => $shortname."_credit",
                    "std" => "",
                    "type" => "textarea");

$of_options[] = array( "name" => __('Scroll to Top','peekaboo'),
                    "desc" => __('Display scroll to top button in the footer.','peekaboo'),
                    "id" => $shortname."_totop",
                    "std" => "1",
                    "type" => "switch");

$of_options[] = array( "name" => __('Google Analytics','peekaboo'),
                    "desc" => __('Enter Google Analytics code.','peekaboo'),
                    "id" =>  $shortname."_ga_code",
                    "std" => "",
                    "type" => "textarea");


/*====== APPEARANCE =====*/
$of_options[] = array( "name" => __('Appearance','peekaboo'),
                    "type" => "heading");

$of_options[] = array( "name" => __('Background','peekaboo'),
                    "desc" => __('Upload background image.','peekaboo'),
                    "id" => $shortname."_bg_image",
                    "type" => "upload");

$of_options[] = array(  "desc"      => __('Body background color (default: #fff).','peekaboo'),
                        "id"        => $shortname."_bg_color",
                        "std"       => "",
                        "type"      => "color"
                );

$of_options[] = array(  "desc"      => __('Background repeat.','peekaboo'),
                        "id"        => $shortname."_bg_repeat",
                        "std"       => 'no-repeat',
                        "type"      => "select",
                        "options"   =>  array("repeat" => "repeat","repeat-x" => "repeat x", "repeat-y" => "repeat y","no-repeat" => "no-repeat") );

$of_options[] = array( "desc" => __('Full screen background.','peekaboo'),
                    "id" => $shortname."_bg_full",
                    "std" => "1",
                    "on"        =>  __('Enable','peekaboo'),
                    "off"       =>  __('Disable','peekaboo'),
                    "type"      => "switch");

$of_options[] = array( "name" => __('Logo','peekaboo'),
                    "desc" => __('Upload main logo image.','peekaboo'),
                    "id" => $shortname."_custom_logo",
                    "type" => "upload");

$of_options[] = array( "desc" => __('Upload WordPress login image (80px x 80px).','peekaboo'),
                    "id" => $shortname."_custom_login",
                    "type" => "upload");

$of_options[] = array( "desc" => __('Upload custom favicon image (.ico).','peekaboo'),
                    "id" => $shortname."_custom_favicon",
                    "type" => "upload");

$of_options[] = array( "name" => __('Theme Stylesheet','peekaboo'),
                    "desc" => __('Select theme alternative color scheme.','peekaboo'),
                    "std" => "default",
                    "id" => $shortname."_stylesheet",
                    "type" => "images",
                    "options" => array(
                        'default' => $url . 'style-default.jpg',
                        'alpha' => $url . 'style-a.jpg',
                        'beta' => $url . 'style-b.jpg',
                        'gamma' => $url . 'style-c.jpg',
                        'delta' => $url . 'style-d.jpg')
                    );

/*====== STYLING =====*/
$of_options[] = array(  "name"      => __('Styling','peekaboo'),
                        "type"      => "heading"
                );

$of_options[] = array(  "name"      => __('Body Font','peekaboo'),
                        "desc"      => __('Specify the body font properties (Default: 16px Arial Normal #555555).','peekaboo'),
                        "id"        => $shortname."_body_font",
                        "std"       => array('size' => '16px','face' => 'arial','style' => 'normal','color' => '#555555'),
                        "type"      => "typography"
                );

$of_options[] = array(  "name"      => __('Main Background Color ','peekaboo'),
                        "desc"      => __('Pick a background color for the header. No color selected by default.','peekaboo'),
                        "id"        => $shortname."_main_background",
                        "std"       => "",
                        "type"      => "color"
                );


$of_options[] = array(  "name"      => __('Page Title Background Color','peekaboo'),
                        "desc"      => __('Pick a background color for the page title. No color selected by default.','peekaboo'),
                        "id"        => $shortname."_page_title_background",
                        "std"       => "",
                        "type"      => "color"
                );

$of_options[] = array(  "name"      => __('Footer Background Color','peekaboo'),
                        "desc"      => __('Pick a background color for the footer. No color selected by default.','peekaboo'),
                        "id"        => $shortname."_footer_background",
                        "std"       => "",
                        "type"      => "color"
                );

$of_options[] = array( "name" => __('Custom CSS','peekaboo'),
                    "desc" => __('Add custom CSS stylesheet.','peekaboo'),
                    "id" =>  $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$of_options[] = array( "name" => __('Main Heading Color','peekaboo'),
                    "desc" => __('Select the color of headings in the Main page. No color selected by default.','peekaboo'),
                    "id" => $shortname."_main_heading_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "name" => __('Page Title Heading Color','peekaboo'),
                    "desc" => __('Select the color of page title headings. No color selected by default.','peekaboo'),
                    "id" => $shortname."_page_title_heading_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "name" => __('Footer Heading Color','peekaboo'),
                    "desc" => __('Select the color of headings in the footer. No color selected by default.','peekaboo'),
                    "id" => $shortname."_footer_heading_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "name" => __('Link Color','peekaboo'),
                    "desc" => __('Select the color of links. No color selected by default.','peekaboo'),
                    "id" => $shortname."_links_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "name" => __('Buttons','peekaboo'),
                    "desc" => __('Select the color of Learn More button background. No color selected by default.','peekaboo'),
                    "id" => $shortname."_learn_more_bg_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "desc" => __('Select the color of Learn More button background on hover. No color selected by default.','peekaboo'),
                    "id" => $shortname."_learn_more_bg_hover_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "desc" => __('Select the color of Learn More text. No color selected by default.','peekaboo'),
                    "id" => $shortname."_learn_more_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "desc" => __('Select the background color of Secondary Navigation. No color selected by default.','peekaboo'),
                    "id" => $shortname."_cta_mod_bg_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "desc" => __('Select the background color of Secondary Navigation on hover. No color selected by default.','peekaboo'),
                    "id" => $shortname."_cta_mod_bg_hover_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array( "desc" => __('Select the color of Secondary Navigation. No color selected by default.','peekaboo'),
                    "id" => $shortname."_cta_mod_color",
                    "std" => "",
                    "type" => "color");

$of_options[] = array(  "name" => __('Google Web Fonts','peekaboo'),
                        "desc" => __('Select font type for the headings (default: Raleway). ','peekaboo'),
                        "id" => $shortname."_google_font",
                        "std"       => "Raleway",
                        "type"      => "select_google_font",
                        "preview"   => array(
                                        "text" => "The quick brown fox jumps over the lazy dog.", //this is the text from preview box
                                        "size" => "28px" //this is the text size from preview box
                        ),
                        "options"   => array(
                                        "none" => "Select a font",//please, always use this key: "none"
                                        "PT Sans" => "PT Sans",
                                        "Lato" => "Lato",
                                        "Oswald" =>  "Oswald",
                                        "Droid Sans" => "Droid Sans",
                                        "Lato" => "Lato",
                                        "Open Sans Condensed" => "Open Sans Condensed",
                                        "Droid Serif" => "Droid Serif",
                                        "Ubuntu" => "Ubuntu",
                                        "Arvo" => "Arvo",
                                        "Lora" => "Lora",
                                        "Nunito" => "Nunito",
                                        "Rokkitt" => "Rokkitt",
                                        "Raleway" => "Raleway",
                                        "Lobster" => "Lobster",
                                        "Francois One" => "Francois One",
                                        "Montserrat" => "Montserrat",
                                        "Oxygen" =>  "Oxygen",
                                        "PT Serif" => "PT Serif",
                                        "Arimo" => "Arimo",
                                        "Shadows Into Light" => "Shadows Into Light",
                                        "Crafty Girls" => "Crafty Girls"
                        )
                );


/*====== HOME PAGE =====*/
$of_options[] = array(  "name"      => __('Home Page','peekaboo'),
                        "type"      => "heading"
                );

$of_options[] = array(  "name"      => __('Home Page Layout Manager','peekaboo'),
                        "desc"      => __('Organize how you want the layout to appear on the homepage.','peekaboo'),
                        "id"        => "homepage_blocks",
                        "std"       => $homepage_mods,
                        "type"      => "sorter"
                );


/*====== FEATURED POST =====*/
$of_options[] = array( "name" => __('- Featured Posts','peekaboo'),
                        "type" => "heading");

$of_options[] = array(  "name"      => __('Section Title','peekaboo'),
                        "desc"      => __('Section title.','peekaboo'),
                        "id"        => $shortname."_post_mod_title",
                        "std"       => "",
                        "type"      => "text"
                );

$of_options[] = array(  "name"      => __('Read More Text','peekaboo'),
                        "desc"      => __('Replace read more with custom text.','peekaboo'),
                        "id"        => $shortname."_post_mod_more_link",
                        "std"       => "",
                        "type"      => "text"
                );

$of_options[] = array(  "name"      => __('Section Title URL','peekaboo'),
                        "desc"      => __('Select a page where the button linked to.','peekaboo'),
                        "id"        => $shortname."_post_mod_url",
                        "std"       => "",
                        "type"      => "select",
                        "options"   => $options_pages
                );

$of_options[] = array(  "name"      => __('Posts Columns','peekaboo'),
                        "desc"      => __('Amount of columns','peekaboo'),
                        "id"        => $shortname."_post_mod_number",
                        "std"       => "3",
                        "min"       => "2",
                        "step"      => "1",
                        "max"       => "4",
                        "type"      => "sliderui"
                );

$of_options[] = array( "name" => __('Column 1 Query','peekaboo'),
                    "desc" => __('Enter the query parameter for the first column ,e.g., page_id=7, p=7, etc. <a href="http://goo.gl/7pPJ4" target="_blank">More Info</a>.','peekaboo'),
                    "id" => $shortname."_homepage_post_1",
                    "std" => '',
                    "type" => "text");

$of_options[] = array( "name" => __('Column 2 Query','peekaboo'),
                    "desc" => __('Enter the query parameter for the second column ,e.g., page_id=7, p=7, etc. <a href="http://goo.gl/7pPJ4" target="_blank">More Info</a>.','peekaboo'),
                    "id" => $shortname."_homepage_post_2",
                    "std" => '',
                    "type" => "text");

$of_options[] = array( "name" => __('Column 3 Query','peekaboo'),
                    "desc" => __('Enter the query parameter for the first column ,e.g., page_id=7, p=7, etc. <a href="http://goo.gl/7pPJ4" target="_blank">More Info</a>.','peekaboo'),
                    "id" => $shortname."_homepage_post_3",
                    "std" => '',
                    "type" => "text");

$of_options[] = array( "name" => __('Column 4 Query','peekaboo'),
                    "desc" => __('Enter the query parameter for the first column ,e.g., page_id=7, p=7, etc. <a href="http://goo.gl/7pPJ4" target="_blank">More Info</a>.','peekaboo'),
                    "id" => $shortname."_homepage_post_4",
                    "std" => '',
                    "type" => "text");


/*====== CTA MOD =====*/

$of_options[] = array( "name"       => __('- CTA','peekaboo'),
                    "type"          => "heading");

$of_options[] = array( "name"       => __('Section  Title','peekaboo'),
                    "desc"          => __('Section title.','peekaboo'),
                    "id"            => $shortname."_cta_mod_title",
                    "std"           => '',
                    "type"          => "text");

$of_options[] = array(  "name"      => __('Section  Title URL','peekaboo'),
                        "desc" => __('Select a page where the button linked to.','peekaboo'),
                        "id"        => $shortname."_cta_mod_url",
                        "std"       => "Select a page:",
                        "type"      => "select",
                        "options"   => $options_pages );

$of_options[] = array(  "name"       => __('Read More Text','peekaboo'),
                        "desc"       => __('Replace read more with custom text.','peekaboo'),
                        "id"         => $shortname."_cta_mod_more_link",
                        "std"        => "",
                        "type"       => "text");

$of_options[] = array(  "name"      => __('CTA Columns','peekaboo'),
                        "desc"      => __('Amount of columns.','peekaboo'),
                        "id"        => $shortname."_cta_number",
                        "std"       => "3",
                        "min"       => "2",
                        "step"      => "1",
                        "max"       => "4",
                        "type"      => "sliderui"
                );

$of_options[] = array( "name"       =>  __('CTA Image','peekaboo'),
                    "desc"          =>  __('Upload image. Recommended size: 280px x 280px.','peekaboo'),
                    "id"            => $shortname."_cta_img",
                    "std"           => "",
                    "type"          => "slider");

$of_options[] = array( "name"       => __('CTA Read More Text','peekaboo'),
                    "desc"          => __('Replace read more with custom text.','peekaboo'),
                    "id"            => $shortname."_cta_more_link",
                    "std"           => "Read more",
                    "type"          => "text");


/*====== HEADLINE MOD =====*/

$of_options[] = array(  "name"      => __('- Headline','peekaboo'),
                        "type"      => "heading");

$of_options[] = array(  "name"      => __('Headline Title','peekaboo'),
                        "desc"      => __('Section title.','peekaboo'),
                        "id"        => $shortname."_headline_title",
                        "std"       => '',
                        "type"      => "text");

$of_options[] = array(  "name"      => __('Headline Subheader','peekaboo'),
                        "desc"      => __('Section subheader.','peekaboo'),
                        "id"        => $shortname."_headline_subtitle",
                        "std"       => '',
                        "type"      => "textarea");

$of_options[] = array(  "name"      => __('Headline Content','peekaboo'),
                        "desc"      => __('Headline section content.','peekaboo'),
                        "id"        => $shortname."_headline_content",
                        "std"       => '',
                        "type"      => "textarea");

$of_options[] = array( "name"       => __('Headline Button','peekaboo'),
                        "desc"      => __('Headline section button text.','peekaboo'),
                        "id"        => $shortname."_headline_button",
                        "std"       => '',
                        "type"      => "text");

$of_options[] = array( "name"       => __('Headline Page','peekaboo'),
                        "desc"      => __('Select a page where the button linked to.','peekaboo'),
                        "id"        => $shortname."_headline_page",
                        "std"       => 'Select a page:',
                        "type"      => "select",
                        "options"   => $options_pages);

$of_options[] = array(  "name"      => __('Media','peekaboo'),
                        "desc"      => __('Select media type.','peekaboo'),
                        "id"        => $shortname."_headline_media",
                        "std"       => 'image',
                        "type"      => "radio",
                        "options"   => array("image" => "Image","video" => "Video")
                    );

$of_options[] = array(  "name"      => __('Headline Image','peekaboo'),
                        "desc"      => __('Upload headline image.','peekaboo'),
                        "id"        => $shortname."_headline_img",
                        // Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
                        "std"       => "",
                        "type"      => "upload"
                );

$of_options[] = array(  "name"      => __('Headline Video Code','peekaboo'),
                        "desc"      => __('Video embed code.','peekaboo'),
                        "id"        => $shortname."_headline_vid_code",
                        "std"       => '',
                        "type"      => "textarea");

$of_options[] = array(  "name"      => __('Video Ratio','peekaboo'),
                        "desc"      => __('Select the video ratio.','peekaboo'),
                        "id"        => $shortname."_headline_vid_ratio",
                        "std"       => "",
                        "type"      => "select",
                        "options"   => array("" => "4:3","widescreen" => "Widescreen", "vimeo" => "Vimeo 4:3","widescreen vimeo" => "Vimeo Widescreen")
                );


/*====== DEFINITION LIST MOD =====*/
$of_options[] = array(  "name"      => __('- Definition List','peekaboo'),
                        "type"      => "heading");

$of_options[] = array( "name"       => __('Section Title','peekaboo'),
                        "desc"      => __('Section title.','peekaboo'),
                        "id"        => $shortname."_list_mod_title",
                        "std"       => '',
                        "type"      => "text");

$of_options[] = array(  "name"      => __('Section Title URL','peekaboo'),
                        "desc"      => __('Select a page where the button linked to.','peekaboo'),
                        "id"        => $shortname."_list_mod_url",
                        "std"       => "Select a page:",
                        "type"      => "select",
                        "options"   => $options_pages );

$of_options[] = array(  "name"       => __('Read More Text','peekaboo'),
                        "desc"       => __('Replace read more with custom text.','peekaboo'),
                        "id"         => $shortname."_list_mod_more_link",
                        "std"        => "",
                        "type"       => "text");

$of_options[] = array(  "name"       => __('Section Content','peekaboo'),
                        "desc"       => __('Section content.','peekaboo'),
                        "id"         => $shortname."_list_mod_content",
                        "std"        => '',
                        "type"       => "textarea");

$of_options[] = array(  "name"       =>  __('List Columns','peekaboo'),
                        "desc"       =>__('Amount of definition list columns.','peekaboo'),
                        "id"         => $shortname."_list_mod_col",
                        "std"       => "3",
                        "min"       => "2",
                        "step"      => "1",
                        "max"       => "5",
                        "type"      => "sliderui");

$of_options[] = array( "name" => __('Definition List Item','peekaboo'),
                        "desc" =>  __('','peekaboo'),
                        "id" => $shortname."_list_mod_item",
                        "std" => "",
                        "type" => "slider");


/*====== TESTIMONIAL MOD =====*/
$of_options[] = array(  "name" => __('- Testimonials','peekaboo'),
                        "type" => "heading");

$of_options[] = array( "name" => __('Section Title','peekaboo'),
                        "desc" => __('Section title.','peekaboo'),
                        "id" => $shortname."_testimonial_mod_title",
                        "std" => '',
                        "type" => "text");

$of_options[] = array(  "name"      => __('Section Title URL','peekaboo'),
                        "desc"      => __('Select a page where the button linked to.','peekaboo'),
                        "id"        => $shortname."_testimonial_mod_url",
                        "std"       => "Select a page:",
                        "type"      => "select",
                        "options"   => $options_pages );

$of_options[] = array(  "name"      => __('Read More Text','peekaboo'),
                        "desc"      => __('Replace read more with custom text.','peekaboo'),
                        "id"        => $shortname."_testimonial_mod_more_link",
                        "std"       => "",
                        "type"      => "text");

$of_options[] = array(  "name"      =>  __('Testimonial Columns','peekaboo'),
                        "desc"      =>__('Amount of testimonials columns.','peekaboo'),
                        "id"        => $shortname."_testimonial_mod_col",
                        "std"       => "2",
                        "min"       => "2",
                        "step"      => "1",
                        "max"       => "4",
                        "type"      => "sliderui");

$of_options[] = array( "name"       => __('Random Order','peekaboo'),
                    "desc"          => __('Display in random order.','peekaboo'),
                    "id"            => $shortname."_testimonial_mod_rand",
                    "Std"           => '0',
                    "type"          => "switch");


/*====== SECONDARY NAV  =====*/
$of_options[] = array(  "name" => __('Secondary Nav','peekaboo'),
                        "type" => "heading");

$of_options[] = array(  "name"      => __('Menu Columns','peekaboo'),
                        "desc"      => __('Amount of columns.','peekaboo'),
                        "id"        => $shortname."_secondary_menu_number",
                        "std"       => "4",
                        "min"       => "2",
                        "step"      => "1",
                        "max"       => "4",
                        "type"      => "sliderui"
                );

$of_options[] = array(  "name"      => __('Menu 1','peekaboo'),
                        "desc"      => __('Upload image. Recommended size: 40px x 40px.','peekaboo'),
                        "id"        => $shortname."_menu_item_img_1",
                        "std"       => "",
                        "type"      => "upload"
                );

$of_options[] = array(  "name"      => __('Menu 2','peekaboo'),
                        "desc"      => __('Upload image. Recommended size: 40px x 40px.','peekaboo'),
                        "id"        => $shortname."_menu_item_img_2",
                        "std"       => "",
                        "type"      => "upload"
                );

$of_options[] = array(  "name"      => __('Menu 3','peekaboo'),
                        "desc"      => __('Upload image. Recommended size: 40px x 40px.','peekaboo'),
                        "id"        => $shortname."_menu_item_img_3",
                        "std"       => "",
                        "type"      => "upload"
                );

$of_options[] = array(  "name"      => __('Menu 4','peekaboo'),
                        "desc"      => __('Upload image. Recommended size: 40px x 40px.','peekaboo'),
                        "id"        => $shortname."_menu_item_img_4",
                        "std"       => "",
                        "type"      => "upload"
                );


/*====== SLIDER =====*/
$of_options[] = array( "name" => __('Slider','peekaboo'),
                        "type" => "heading");

$of_options[] = array(  "name"      => __('Slider Type','peekaboo'),
                        "desc"      =>  __('','peekaboo'),
                        "id"        => $shortname."_slide_type",
                        "std"       => "flexslider",
                        "type"      => "radio",
                        "options" => array(
                            "orbit" => "Foundation Orbit Slider",
                            "flexslider" => "Flexslider"
                            )
                        );

$of_options[] = array( "name" => __('Slider Effect','peekaboo'),
                        "desc" => __('Select slide animation effect.','peekaboo'),
                        "id" => $shortname."_slide_effect",
                        "std" => "fade",
                        "type" => "select",
                        "options" => array(
                            "slide" => "Slide",
                            "fade" => "Fade"
                            )
                        );

$of_options[] = array( "name" => __('Slideshow Speed','peekaboo'),
                        "desc" => __('Set the speed of the slideshow cycling, in milliseconds. Default: 7000.','peekaboo'),
                        "id" => $shortname."_slideshow_speed",
                        "std" => "7000",
                        "class" => "mini",
                        "type" => "text");

$of_options[] = array( "name" => __('Animation Speed','peekaboo'),
                        "desc" => __('Set the speed of animations, in milliseconds. Default: 600.','peekaboo'),
                        "id" => $shortname."_animation_speed",
                        "std" => "600",
                        "class" => "mini",
                        "type" => "text");

$of_options[] = array( "name" => __('Control Navigation','peekaboo'),
                        "desc" => __('Display the slide bullet navigation.','peekaboo'),
                        "id" => $shortname."_control_nav",
                        "std" => "0",
                        "type" => "switch");

$of_options[] = array( "name" => __('Direction Navigation','peekaboo'),
                        "desc" => __('Display Previous / Next Navigation. Uncheck to disable it.','peekaboo'),
                        "id" => $shortname."_direction_nav",
                        "std" => "1",
                        "type" => "switch");

$of_options[] = array( "name" => __('Pause on Hover','peekaboo'),
                        "desc" => __('Pause the slideshow when hovering over slider.','peekaboo'),
                        "id" => $shortname."_pause_On_Hover",
                        "std" => "1",
                        "type" => "switch");


/*====== PAGE =====*/
$of_options[] = array( "name" => __('Page','peekaboo'),
                        "type" => "heading");

$of_options[] = array( "name" => __('Breadcrumbs','peekaboo'),
                        "desc" => __('Display breadcrumbs on pages.','peekaboo'),
                        "id" => $shortname."_breadcrumbs_bar",
                        "std" => "1",
                        "type" => "switch");

$of_options[] = array(  "desc" => __('Select gallery page parent.','peekaboo'),
                        "id"        => $shortname."_gallery_page",
                        "std"       => "",
                        "type"      => "select",
                        "options"   => $options_pages );

$of_options[] = array(  "desc" => __('Select testimonial page parent.','peekaboo'),
                        "id"        => $shortname."_testimonial_page",
                        "std"       => "",
                        "type"      => "select",
                        "options"   => $options_pages );

$of_options[] = array( "name" => __('Featured Image','peekaboo'),
                        "desc" => __('Display the featured image at the beginning of the post in the single page.','peekaboo'),
                        "id" => $shortname."_single_img",
                        "std" => "1",
                        "type" => "checkbox");

$of_options[] = array( "name" => __('Thumbnail Image','peekaboo'),
                        "desc" => __('Display the thumbnail image in Blog page.','peekaboo'),
                        "id" => $shortname."_post_img",
                        "std" => "1",
                        "type" => "checkbox");

$of_options[] = array( "name" => __('Custom Read More','peekaboo'),
                        "desc" => __('Change the default Learn More text.','peekaboo'),
                        "id" => $shortname."_more_link",
                        "std" => "Learn more",
                        "type" => "text");


/*====== GALLERY =====*/
$of_options[] = array(  "name" => __('Gallery','peekaboo'),
                        "type" => "heading");

$of_options[] = array(  "name"      => __('Gallery Columns','peekaboo'),
                        "desc"      => __('Amount of columns.','peekaboo'),
                        "id"        => $shortname."_gallery_col_thumb",
                        "std"       => "4",
                        "min"       => "2",
                        "step"      => "1",
                        "max"       => "5",
                        "type"      => "sliderui"
                );


/*====== MISC =====*/
$of_options[] = array( "name" => __('Miscellaneous','peekaboo'),
                        "type" => "heading");

$of_options[] = array( "name" => __('404 Page Title','peekaboo'),
                        "desc" => __('Page title of the 404 Error Page.','peekaboo'),
                        "id" => $shortname."_custom_404_title",
                        "std" => "",
                        "type" => "text");

$of_options[] = array( "name" => __('404 Page Message','peekaboo'),
                        "desc" => __('Content of the 404 Error Page.','peekaboo'),
                        "id" => $shortname."_custom_404_msg",
                        "std" => "",
                        "type" => "textarea");

$of_options[] = array( "name" => __('Search Page Title','peekaboo'),
                        "desc" => __('Page title of the Search Page when there is no results.','peekaboo'),
                        "id" => $shortname."_custom_search_title",
                        "std" => "",
                        "type" => "text");

$of_options[] = array( "name" => __('Search Page Message','peekaboo'),
                        "desc" => __('Content of the Search Page when there is no results.','peekaboo'),
                        "id" => $shortname."_custom_search_msg",
                        "std" => "",
                        "type" => "textarea");


/*====== SOCIAL =====*/
$of_options[] = array( "name" => __('Social Media','peekaboo'),
                        "type" => "heading");

$of_options[] = array(  "name"      => __('Social Media URL','peekaboo'),
                        "desc"      => __('RSS','peekaboo'),
                        "id"        => $shortname."_sm_rss",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Email','peekaboo'),
                        "id"        => $shortname."_sm_email",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Facebook','peekaboo'),
                        "id"        => $shortname."_sm_facebook",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Flickr','peekaboo'),
                        "id"        => $shortname."_sm_flickr",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Four Square','peekaboo'),
                        "id"        => $shortname."_sm_foursquare",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Instagram','peekaboo'),
                        "id"        => $shortname."_sm_instagram",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Twitter','peekaboo'),
                        "id"        => $shortname."_sm_twitter",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Vimeo','peekaboo'),
                        "id"        => $shortname."_sm_vimeo",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('YouTube','peekaboo'),
                        "id"        => $shortname."_sm_youtube",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Google +','peekaboo'),
                        "id"        => $shortname."_sm_gplus",
                        "std"       => "",
                        "type"      => "text" );
$of_options[] = array(  "desc"      => __('Skype','peekaboo'),
                        "id"        => $shortname."_sm_skype",
                        "std"       => "",
                        "type"      => "text" );
$of_options[] = array(  "desc"      => __('Tumblr','peekaboo'),
                        "id"        => $shortname."_sm_tumblr",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Linkedin','peekaboo'),
                        "id"        => $shortname."_sm_linkedin",
                        "std"       => "",
                        "type"      => "text" );

$of_options[] = array(  "desc"      => __('Pinterest','peekaboo'),
                        "id"        => $shortname."_sm_pinterest",
                        "std"       => "",
                        "type"      => "text" );


// Backup Options
$of_options[] = array(  "name"      => "Backup Options",
                        "type"      => "heading",
                        "icon"      => ADMIN_IMAGES . "icon-slider.png"
                );

$of_options[] = array(  "name"      => "Backup and Restore Options",
                        "id"        => "of_backup",
                        "std"       => "",
                        "type"      => "backup",
                        "desc"      => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
                );

$of_options[] = array(  "name"      => "Transfer Theme Options Data",
                        "id"        => "of_transfer",
                        "std"       => "",
                        "type"      => "transfer",
                        "desc"      => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
                );

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
