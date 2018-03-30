<?php
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {

	//update_option('mtheme_home_order','1,2,3,4,5');
	// Sortable Homepage
	if ( get_option('mtheme_home_order') ) {
		
	} else {
		update_option('mtheme_home_order','1,2,3,4,5');
	}
	
	$sort_order= get_option('mtheme_home_order');
	
	if ( ! of_get_option ('welcome_section_status') ) $welcome_section_status=" (Disabled)";
	if ( ! of_get_option ('fourstep_section_status') ) $fourstep_section_status=" (Disabled)";
	if ( ! of_get_option ('portfolio_section_status') ) $portfolio_section_status=" (Disabled)";
	if ( ! of_get_option ('services_section_status') ) $services_section_status=" (Disabled)";
	if ( ! of_get_option ('endmsg_section_status') ) $footermsg_section_status=" (Disabled)";	
	
	
	// Pull all Google Fonts using API into an array
	require ( TEMPLATEPATH . '/framework/options/google-fonts.php');
	//$fontArray = unserialize($fontsSeraliazed);
	$google_font_array = json_decode ($google_api_output,true) ;
	//print_r( json_decode ($google_api_output) );
	
	$items = $google_font_array['items'];
	
	$options_fonts=array();
	array_push($options_fonts, "Default Font");
	$fontID = 0;
	foreach ($items as $item) {
		$fontID++;
		$variants='';
		$variantCount=0;
		foreach ($item['variants'] as $variant) {
			$variantCount++;
			if ($variantCount>1) { $variants .= '|'; }
			$variants .= $variant;
		}
		$variantText = ' (' . $variantCount . ' Varaints' . ')';
		if ($variantCount <= 1) $variantText = '';
		$options_fonts[ $item['family'] . ':' . $variants ] = $item['family']. $variantText;
	}

	
	// Pull all the categories into an array
	$options_categories = array(); 
	array_push($options_categories, "All Categories");
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	if ($options_pages_obj) {
		foreach ($options_pages_obj as $page) {
			$options_pages[$page->ID] = $page->post_title;
		}
	}
	
	// Pull all the Featured into an array
	$featured_pages = get_posts('post_type=mtheme_featured&orderby=title&numberposts=-1&order=ASC');
	if ($featured_pages) {
		foreach($featured_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			if ( isset($custom["fullscreen_type"][0]) ) { 
				$slideshow_type=' ('.$custom["fullscreen_type"][0].')'; 
			} else {
			$slideshow_type="";
			}
			$options_featured[$list->ID] = $list->post_title . $slideshow_type;
		}
	}
	
	// Pull all the Featured into an array
	$bg_slideshow_pages = get_posts('post_type=mtheme_featured&orderby=title&numberposts=-1&order=ASC');
	if ($bg_slideshow_pages) {
		foreach($bg_slideshow_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			if ( isset($custom["fullscreen_type"][0]) ) { 
				$slideshow_type=$custom["fullscreen_type"][0]; 
			} else {
			$slideshow_type="";
			}
			if ($slideshow_type<>"Fullscreen-Video") {
				$options_bgslideshow[$list->ID] = $list->post_title;
			}
		}
	}
	
	// Pull all the Portfolio into an array
	$portfolio_pages = get_posts('post_type=mtheme_portfolio&orderby=title&numberposts=-1&order=ASC');
	if ($portfolio_pages) {
		foreach($portfolio_pages as $key => $list) {
			$custom = get_post_custom($list->ID);
			$portfolio_list[$list->ID] = $list->post_title;
		}
	}

	// Pull all the Portfolio Categories into an array
	$the_list = get_categories('taxonomy=types&title_li=');
	$portfolio_categories=array();
	foreach($the_list as $key => $list) {
		$portfolio_categories[$list->slug] = $list->name;
	}
	array_unshift($portfolio_categories, "All the items");
	
	if (! $options_portfolio ) $options_portfolio[0]="Portfolio pages not found.";
	if (! $options_featured ) $options_featured[0]="Featured pages not found.";
	if (! $options_bgslideshow ) $options_bgslideshow[0]="Featured pages not found.";
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/framework/options/images/';
	$theme_imagepath =  get_template_directory_uri() . '/images/';
		
	$options = array();
		
$options[] = array( "name" => "General",
					"type" => "heading");
						
	$options[] = array( "name" => "Activate Responsive features",
						"desc" => "Activate Responsive features that enable layout switching based on display resolution",
						"id" => "responsive_status",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Activate Menu description text",
						"desc" => "Display menu description text",
						"id" => "menudesc_status",
						"std" => "1",
						"type" => "checkbox");
						
				
$options[] = array( "name" => "Theme Skin",
					"desc" => "style_dark.css / style.css",
					"id" => "general_theme_style",
					"std" => "light",
					"type" => "select",
					"class" => "mini", //mini, tiny, small
					"options" => array(
						'light' => "Light theme",
						'dark' => "Dark theme")
					);
						
$options[] = array( "name" => "Custom WordPress Login Page Logo",
					"desc" => "Upload logo for WordPress Login Page",
					"id" => "wplogin_logo",
					"type" => "upload");
						
	$options[] = array( "name" => "Fav icon file",
						"desc" => "Customize with your fav icon",
						"id" => "general_fav_icon",
						"type" => "upload");
						
$options[] = array( "name" => "Logo",
					"type" => "heading");
					
	$options[] = array( "name" => "Site Logo",
						"desc" => "Upload logo for website",
						"id" => "main_logo",
						"type" => "upload");
						
	$options[] = array( "name" => "Top Margin Space",
						"desc" => "Top margin spacing for logo",
						"id" => "logo_topmargin",
						"min" => "0",
						"max" => "200",
						"step" => "0",
						"unit" => 'pixels',
						"std" => "20",
						"type" => "text");
						
	$options[] = array( "name" => "Bottom Margin Space",
						"desc" => "Bottom margin spacing for logo",
						"id" => "logo_bottommargin",
						"min" => "0",
						"max" => "200",
						"step" => "0",
						"unit" => 'pixels',
						"std" => "20",
						"type" => "text");
						
	$options[] = array( "name" => "Left Margin Space",
						"desc" => "Left margin spacing for logo",
						"id" => "logo_leftmargin",
						"min" => "0",
						"max" => "200",
						"step" => "0",
						"unit" => 'pixels',
						"std" => "50",
						"type" => "text");
						
$options[] = array( "name" => "Sort Homepage",
					"type" => "heading");

	$options[] = array( "name" => "Drag and Drop to rearrange homepage sections",
					"desc" => "Organize how you want the layout to appear on the homepage",
					"id" => "homepage_blocks",
					"std" => "",
					"type" => "sorter",
					"order" => $sort_order,
					"options" => array( 
						"1" 	=> 'Welcome Message' . $welcome_section_status,
						"2"		=> 'Four Steps' . $fourstep_section_status,
						"3"		=> 'Portfolio Section' . $portfolio_section_status,
						"4"		=> 'Services Section' . $services_section_status,
						"5"		=> 'Footer Message' . $footermsg_section_status
						)
					);
					
$options[] = array( "name" => "Featured",
					"type" => "heading");
						
	$options[] = array( "name" => "Show featured",
						"desc" => "Show featured section in mainpage",
						"id" => "featured_section_status",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Featured style",
						"desc" => "Featured style",
						"id" => "featured_style",
						"std" => "flexislider",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => array(
							'flexislider' => "Flexislider",
							'image' => "Image",
							'video' => "Video Embed")
						);
						
$options[] = array( "name" => "Featured Flexislider",
					"type" => "heading",
					"subheading" => 'featured');
					
	$options[] = array(
					"name" => __("Autoplay"),
					"desc" => __("Set autoplay"),
					"id" => "flexi_slideshow",
					"std" => "1",
					"type" => "checkbox"
					);	

				
	$options[] = array( 
					"name" => __("Transition style"),
					"desc" => __("Transition style for nivo"),
					"id" => "flexi_transition_style",
					"std" => 'slide',
					"options" => array(
						"slide" => "slide",
						"fade" => "fade"
					),
					"type" => "select"
				);
				
					
	$options[] = array(
					"name" => __("Slideshow speed"),
					"desc" => __("Set the speed of the slideshow cycling, in milliseconds"),
					"id" => "flexi_slideshow_speed",
						"min" => "100",
						"max" => "20000",
						"step" => "100",
						"unit" => 'milliseconds',
						"std" => "7000",
						"type" => "text"
					);
					
	$options[] = array(
					"name" => __("Animation duration"),
					"desc" => __("Set the speed of animations, in milliseconds"),
					"id" => "flexi_animation_duration",
						"min" => "100",
						"max" => "10000",
						"step" => "100",
						"unit" => 'milliseconds',
						"std" => "600",
						"type" => "text"
					);
				
			
$options[] = array( "name" => "Video Embed",
					"type" => "heading",
					"subheading" => 'featured');
					
	$options[] = array( "name" => "Embed Code",
						"desc" => "Embed code for featured section. Ideal for Videos and Maps",
						"id" => "featured_embed",
						"std" => "",
						"type" => "textarea");
					
$options[] = array( "name" => "Home Welcome Message",
					"type" => "heading");
					
	$options[] = array( "name" => "Show weclome message",
						"desc" => "Show weclome message in mainpage",
						"id" => "welcome_section_status",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Welcome message",
						"desc" => "Enter your welcome message for main page",
						"id" => "welcome_msg",
						"std" => '<h2>Rapidly build-up & customize using Helm theme!</h2><h3>Build your site using shortcodes,custom posts types and postformats with multimeida capabilities</h3>',
						"type" => "textarea");
						
	$options[] = array( "name" => "Button text",
						"desc" => "Text to display in button",
						"id" => "welcome_button_text",
						"std" => "Purchase",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Button link",
						"desc" => "Button link",
						"id" => "welcome_button_link",
						"std" => "#",
						"class" => "tiny",
						"type" => "text");
	


$options[] = array( "name" => "Home Step columns",
					"type" => "heading");

$options[] = array( "name" => "Section status",
					"desc" => "Toggle services on and off",
					"id" => "fourstep_section_status",
					"std" => "1",
					"type" => "checkbox");

$options[] = array( "name" => "Step 1",
					"type" => "info");

$options[] = array( "name" => "Icon",
				"desc" => "Upload icon for service",
				"id" => "step_1_icon",
				"type" => "upload");
				
$options[] = array( "name" => "Icon background color",
					"desc" => "Icon background color",
					"id" => "stepicon_1_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Step background color",
					"desc" => "Background color",
					"id" => "step_1_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Title",
					"desc" => "Title for service 1",
					"id" => "step_1_title",
					"std" => "Customize",
					"class" => "tiny",
					"type" => "text");

$options[] = array( "name" => "Description",
					"desc" => "Enter step description",
					"id" => "step_1_desc",
					"std" => "Aliquam purus purus, venenatis eu convallis quis, lacinia et dolor. Proin egestas consequat tempor. Aliquam sagittis enim sed elit.",
					"type" => "textarea");

$options[] = array( "name" => "Link text",
					"desc" => "Step button text",
					"id" => "step_1_link_text",
					"std" => "Learn more",
					"class" => "small",
					"type" => "text");

$options[] = array( "name" => "Link URL",
					"desc" => "Step link",
					"id" => "step_1_link",
					"std" => "#",
					"class" => "small",
					"type" => "text");

					

$options[] = array( "name" => "Step 2",
					"type" => "info");

$options[] = array( "name" => "Icon",
				"desc" => "Upload icon for service",
				"id" => "step_2_icon",
				"type" => "upload");
				
$options[] = array( "name" => "Icon background color",
					"desc" => "Icon background color",
					"id" => "stepicon_2_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Step background color",
					"desc" => "Background color",
					"id" => "step_2_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Title",
					"desc" => "Title for service 2",
					"id" => "step_2_title",
					"std" => "Extend",
					"class" => "tiny",
					"type" => "text");

$options[] = array( "name" => "Description",
					"desc" => "Enter step description",
					"id" => "step_2_desc",
					"std" => "Aliquam purus purus, venenatis eu convallis quis, lacinia et dolor. Proin egestas consequat tempor. Aliquam sagittis enim sed elit.",
					"type" => "textarea");

$options[] = array( "name" => "Link text",
					"desc" => "Step button text",
					"id" => "step_2_link_text",
					"std" => "Learn more",
					"class" => "small",
					"type" => "text");

$options[] = array( "name" => "Link URL",
					"desc" => "Step link",
					"id" => "step_2_link",
					"std" => "#",
					"class" => "small",
					"type" => "text");

					

$options[] = array( "name" => "Step 3",
					"type" => "info");

$options[] = array( "name" => "Icon",
				"desc" => "Upload icon for step",
				"id" => "step_3_icon",
				"type" => "upload");
				
$options[] = array( "name" => "Icon background color",
					"desc" => "Icon background color",
					"id" => "stepicon_3_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Step background color",
					"desc" => "Background color",
					"id" => "step_3_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Title",
					"desc" => "Title for step",
					"id" => "step_3_title",
					"std" => "Upgrade",
					"class" => "tiny",
					"type" => "text");

$options[] = array( "name" => "Description",
					"desc" => "Enter step description",
					"id" => "step_3_desc",
					"std" => "Aliquam purus purus, venenatis eu convallis quis, lacinia et dolor. Proin egestas consequat tempor. Aliquam sagittis enim sed elit.",
					"type" => "textarea");

$options[] = array( "name" => "Link text",
					"desc" => "Step button text",
					"id" => "step_3_link_text",
					"std" => "Learn more",
					"class" => "small",
					"type" => "text");

$options[] = array( "name" => "Link URL",
					"desc" => "Step link",
					"id" => "step_3_link",
					"std" => "#",
					"class" => "small",
					"type" => "text");

					


$options[] = array( "name" => "Step 4",
					"type" => "info");

$options[] = array( "name" => "Icon",
				"desc" => "Upload icon for service",
				"id" => "step_4_icon",
				"type" => "upload");
				
$options[] = array( "name" => "Icon background color",
					"desc" => "Icon background color",
					"id" => "stepicon_4_bgcolor",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Step background color",
					"desc" => "Background color",
					"id" => "step_4_bgcolor",
					"std" => "",
					"type" => "color");

$options[] = array( "name" => "Title",
					"desc" => "Title for service",
					"id" => "step_4_title",
					"std" => "Support",
					"class" => "tiny",
					"type" => "text");

$options[] = array( "name" => "Description",
					"desc" => "Enter step description",
					"id" => "step_4_desc",
					"std" => "Aliquam purus purus, venenatis eu convallis quis, lacinia et dolor. Proin egestas consequat tempor. Aliquam sagittis enim sed elit.",
					"type" => "textarea");

$options[] = array( "name" => "Link text",
					"desc" => "Step button text",
					"id" => "step_4_link_text",
					"std" => "Learn more",
					"class" => "small",
					"type" => "text");

$options[] = array( "name" => "Link URL",
					"desc" => "Step link",
					"id" => "step_4_link",
					"std" => "#",
					"class" => "small",
					"type" => "text");



											
$options[] = array( "name" => "Home Portfolio",
					"type" => "heading");
					
	$options[] = array( "name" => "Portfolio Section",
						"type" => "info");
						
	$options[] = array( "name" => "Show this section",
						"desc" => "Toggle section on and off",
						"id" => "portfolio_section_status",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Section title",
						"desc" => "Title for this section",
						"id" => "portfolio_title",
						"std" => "Some of our work",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Portfolio Columns",
						"type" => "info");
						
		$options[] = array(
				"name" => __("Portfolio Column Style"),
				"desc" => __("Portfolio column style"),
				"id" => "home_portfolio_column",
				"std" => '4col',
				"options" => array(
					"3col" => "3 Column",
					"2col" => "2 Column",
					"4col" => "4 Column"
				),
				"type" => "select"
			);
			
		$options[] = array( "name" => "Select Portfolio",
						"desc" => "Select portfolio category for carousel if your choice if Portfolio",
						"id" => "home_portfolio_category",
						"std" => "",
						"type" => "select",
						"class" => "small", //mini, tiny, small
						"options" => $portfolio_categories);
			
		$options[] = array( "name" => "Limit images",
						"desc" => "Set a limit to the number of images shown. 0 for Unlimited",
						"id" => "home_portfolio_limit",
						"min" => "0",
						"max" => "30",
						"step" => "0",
						"unit" => '0 for unlimited',
						"std" => "4",
						"type" => "text"
					);
			
		$options[] = array(
				"name" => __("Link Images"),
				"help" => __("Display the linked images to either the lightbox or link directly to the respective post or page."),
				"desc" => __("How to display the images"),
				"id" => "home_portfolio_link",
				"std" => 'lightbox',
				"options" => array(
					"Lightbox" => "Lightbox",
					"Direct" => "Direct"
				),
				"type" => "select"
			);
						
						
$options[] = array( "name" => "Home Service columns",
										"type" => "heading");
										
						$options[] = array( "name" => "Service section status",
											"desc" => "Toggle services on and off",
											"id" => "services_section_status",
											"std" => "1",
											"type" => "checkbox");

						$options[] = array( "name" => "Service Row 1 status",
											"desc" => "Toggle services row 1 on and off",
											"id" => "services_section1_status",
											"std" => "1",
											"type" => "checkbox");
											
						$options[] = array( "name" => "Service Row 2 status",
											"desc" => "Toggle services row 2 on and off",
											"id" => "services_section2_status",
											"std" => "1",
											"type" => "checkbox");
											
						$options[] = array( "name" => "Section title",
											"desc" => "Title for this section",
											"id" => "service_title",
											"std" => "Our Services",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 1 (Row 1 Col 1)",
											"type" => "info");

						$options[] = array( "name" => "Service 1 icon ( 16px X 16px )",
										"desc" => "Upload icon for service 1",
										"id" => "service_1_icon",
										"type" => "upload");

						$options[] = array( "name" => "Service 1 Title",
											"desc" => "Title for service 1",
											"id" => "service_1_title",
											"std" => "Advance options",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 1 Description",
											"desc" => "Enter service 1 description",
											"id" => "service_1_desc",
											"std" => "Praesent hendrerit, nunc ac lacinia vulputate, turpis odio pulvinar magna, sit amet iaculis quam diam at enim. Donec pretium rutrum augue sit amet adipiscing.",
											"type" => "textarea");

						$options[] = array( "name" => "Service 1 Button text",
											"desc" => "Service 1 button text",
											"id" => "service_1_button_text",
											"std" => "Read more",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 1 Link",
											"desc" => "Service 1 link",
											"id" => "service_1_link",
											"std" => "#",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 2 (Row 1 Col 2)",
											"type" => "info");

						$options[] = array( "name" => "Service 2 icon ( 16px X 16px )",
										"desc" => "Upload icon for service 2",
										"id" => "service_2_icon",
										"type" => "upload");

						$options[] = array( "name" => "Service 2 Title",
											"desc" => "Title for service 2",
											"id" => "service_2_title",
											"std" => "Multiple portfolios",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 2 Description",
											"desc" => "Enter service 2 description",
											"id" => "service_2_desc",
											"std" => "Praesent hendrerit, nunc ac lacinia vulputate, turpis odio pulvinar magna, sit amet iaculis quam diam at enim. Donec pretium rutrum augue sit amet adipiscing.",
											"type" => "textarea");

						$options[] = array( "name" => "Service 2 Button text",
											"desc" => "Service 2 button text",
											"id" => "service_2_button_text",
											"std" => "Read more",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 2 Link",
											"desc" => "Service 2 link",
											"id" => "service_2_link",
											"std" => "#",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 3 (Row 1 Col 3)",
											"type" => "info");

						$options[] = array( "name" => "Service 3 icon ( 16px X 16px )",
										"desc" => "Upload icon for service 3",
										"id" => "service_3_icon",
										"type" => "upload");

						$options[] = array( "name" => "Service 3 Title",
											"desc" => "Title for service 3",
											"id" => "service_3_title",
											"std" => "Multiple colors",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 3 Description",
											"desc" => "Enter service 3 description",
											"id" => "service_3_desc",
											"std" => "Praesent hendrerit, nunc ac lacinia vulputate, turpis odio pulvinar magna, sit amet iaculis quam diam at enim. Donec pretium rutrum augue sit amet adipiscing.",
											"type" => "textarea");

						$options[] = array( "name" => "Service 3 Button text",
											"desc" => "Service 3 button text",
											"id" => "service_3_button_text",
											"std" => "Read more",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 3 Link",
											"desc" => "Service 3 link",
											"id" => "service_3_link",
											"std" => "#",
											"class" => "small",
											"type" => "text");
											
											
											
											
						$options[] = array( "name" => "Service 4 (Row 2 Col 1)",
											"type" => "info");

						$options[] = array( "name" => "Service 4 icon ( 16px X 16px )",
										"desc" => "Upload icon for service 4",
										"id" => "service_4_icon",
										"type" => "upload");

						$options[] = array( "name" => "Service 4 Title",
											"desc" => "Title for service 4",
											"id" => "service_4_title",
											"std" => "Gui shortcodes",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 1 Description",
											"desc" => "Enter service 1 description",
											"id" => "service_4_desc",
											"std" => "Praesent hendrerit, nunc ac lacinia vulputate, turpis odio pulvinar magna, sit amet iaculis quam diam at enim. Donec pretium rutrum augue sit amet adipiscing.",
											"type" => "textarea");

						$options[] = array( "name" => "Service 4 Button text",
											"desc" => "Service 4 button text",
											"id" => "service_4_button_text",
											"std" => "Read more",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 4 Link",
											"desc" => "Service 4 link",
											"id" => "service_4_link",
											"std" => "#",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 5 (Row 2 Col 2)",
											"type" => "info");

						$options[] = array( "name" => "Service 5 icon ( 16px X 16px )",
										"desc" => "Upload icon for service 5",
										"id" => "service_5_icon",
										"type" => "upload");

						$options[] = array( "name" => "Service 5 Title",
											"desc" => "Title for service 5",
											"id" => "service_5_title",
											"std" => "Custom widgets",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 5 Description",
											"desc" => "Enter service 5 description",
											"id" => "service_5_desc",
											"std" => "Praesent hendrerit, nunc ac lacinia vulputate, turpis odio pulvinar magna, sit amet iaculis quam diam at enim. Donec pretium rutrum augue sit amet adipiscing.",
											"type" => "textarea");

						$options[] = array( "name" => "Service 5 Button text",
											"desc" => "Service 5 button text",
											"id" => "service_5_button_text",
											"std" => "Read more",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 5 Link",
											"desc" => "Service 5 link",
											"id" => "service_5_link",
											"std" => "#",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 6 (Row 2 Col 3)",
											"type" => "info");

						$options[] = array( "name" => "Service 6 icon ( 16px X 16px )",
										"desc" => "Upload icon for service 6",
										"id" => "service_6_icon",
										"type" => "upload");

						$options[] = array( "name" => "Service 6 Title",
											"desc" => "Title for service 6",
											"id" => "service_6_title",
											"std" => "Page templates",
											"class" => "tiny",
											"type" => "text");

						$options[] = array( "name" => "Service 6 Description",
											"desc" => "Enter service 6 description",
											"id" => "service_6_desc",
											"std" => "Praesent hendrerit, nunc ac lacinia vulputate, turpis odio pulvinar magna, sit amet iaculis quam diam at enim. Donec pretium rutrum augue sit amet adipiscing.",
											"type" => "textarea");

						$options[] = array( "name" => "Service 6 Button text",
											"desc" => "Service 6 button text",
											"id" => "service_6_button_text",
											"std" => "Read more",
											"class" => "small",
											"type" => "text");

						$options[] = array( "name" => "Service 6 Link",
											"desc" => "Service 6 link",
											"id" => "service_6_link",
											"std" => "#",
											"class" => "small",
											"type" => "text");


											
											
$options[] = array( "name" => "Home End Message",
					"type" => "heading");
					
	$options[] = array( "name" => "Show end message",
						"desc" => "Show end message in mainpage",
						"id" => "endmsg_section_status",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "End message",
						"desc" => "Enter your welcome message for main page",
						"id" => "end_msg",
						"std" => '<h2>Variety of portfolio styles and postformats using <a href="#">Helm theme</a></h2><h3>Helm theme is equipped is variety of portfolio styles and postformats to showcase your works</h3>',
						"type" => "textarea");
						
						

$options[] = array( "name" => "Fonts",
					"type" => "heading");
						
	$options[] = array(	"name" =>"Menu Font",
						"desc" => "Select menu font",
						"id" => "menu_font",
						"std" => '',
						"type" => "select",
						"class" => "small", //mini, tiny, small
						"options" => $options_fonts);
						
	$options[] = array(	"name" =>"Heading Font (applies to all headings)",
						"desc" => "Select heading font",
						"id" => "heading_font",
						"std" => '',
						"type" => "select",
						"class" => "small", //mini, tiny, small
						"options" => $options_fonts);	
						
	$options[] = array(	"name" =>"Contents post/page heading (overide)",
						"desc" => "Select font for headings inside posts and pages",
						"id" => "page_headings",
						"std" => '',
						"type" => "select",
						"class" => "small", //mini, tiny, small
						"options" => $options_fonts);
						
$options[] = array( "name" => "Blog",
					"type" => "heading");
					
	$options[] = array( "name" => "Display full content in post archives",
						"desc" => "Display full content in post archive pages",
						"id" => "postformat_fullcontent",
						"std" => "0",
						"type" => "checkbox");
					
	$options[] = array( "name" => "Display Post info after Post",
						"desc" => "Display post info after each post",
						"id" => "blog_postinfo",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Hide allowed HTML tags info",
						"desc" => "Hide allowed HTML tags info after comments box",
						"id" => "blog_allowedtags",
						"std" => "1",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Display Postformat icons",
						"desc" => "Display postformat icons next to title",
						"id" => "postformat_icons",
						"std" => "1",
						"type" => "checkbox");
					
	$options[] = array( "name" => "Time format for blog posts",
						"desc" => "Switch from traditional or modern time",
						"id" => "mtheme_datetime",
						"std" => "timeago",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => array(
							'modern' => "Time Ago Format",
							'traditional' => "Traditional")
						);
						
	$options[] = array( "name" => "Read more text",
						"desc" => "Enter text for Read more",
						"id" => "read_more",
						"std" => "Continue reading",
						"class" => "small",
						"type" => "text");
						
$options[] = array( "name" => "Contact Template",
					"type" => "heading");
					
	$options[] = array( "name" => "Section title",
						"desc" => "Title for this section",
						"id" => "ctemplate_title",
						"std" => "Use form below to contact us.",
						"class" => "tiny",
						"type" => "textarea");
						
	$options[] = array( "name" => "Email address",
						"desc" => "Email address to recieve mail",
						"id" => "ctemplate_email",
						"std" => "email@address.com",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Label- Name Field",
						"desc" => "Label for name field",
						"id" => "ctemplate_lname",
						"std" => "Name",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Label- Email Field",
						"desc" => "Label for email field",
						"id" => "ctemplate_lemail",
						"std" => "E-mail",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Label- Subject Field",
						"desc" => "Label for subject field",
						"id" => "ctemplate_lsubject",
						"std" => "Subject",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Label- Message Field",
						"desc" => "Label for message field",
						"id" => "ctemplate_lmessage",
						"std" => "Message",
						"class" => "tiny",
						"type" => "text");
						
	$options[] = array( "name" => "Error Notice - For no name input",
						"desc" => "Error Notice - For no name input",
						"id" => "ctemplate_errorname",
						"std" => "Please enter name",
						"class" => "small",
						"type" => "text");
						
	$options[] = array( "name" => "Error Notice - For no email input",
						"desc" => "Error Notice - For no email input",
						"id" => "ctemplate_erroremail",
						"std" => "Please enter email",
						"class" => "small",
						"type" => "text");
						
	$options[] = array( "name" => "Error Notice - For invalid email input",
						"desc" => "Error Notice - For invalid email input",
						"id" => "ctemplate_invalidemail",
						"std" => "Please provide a valid email",
						"class" => "small",
						"type" => "text");
						
	$options[] = array( "name" => "Error Notice - For no message input",
						"desc" => "Error Notice - For no message input",
						"id" => "ctemplate_errormsg",
						"std" => "Please enter message",
						"class" => "small",
						"type" => "text");
						
	$options[] = array( "name" => "Thank you message",
						"desc" => "Thank you message",
						"id" => "ctemplate_thankyou",
						"std" => "<h2>Thank you!</h2>Your message was sent! This message along with the contact form labels are editable from theme options.",
						"class" => "tiny",
						"type" => "textarea");
						
	$options[] = array( "name" => "Button text",
						"desc" => "Button text for form",
						"id" => "ctemplate_button",
						"std" => "Send",
						"class" => "tiny",
						"type" => "text");

$options[] = array( "name" => "Sidebars",
					"type" => "heading");
						
	$options[] = array( "name" => "Activate Sidebars by filling the text box with a custom name",
						"type" => "info");

				
	for ($sidebar_count=1; $sidebar_count <=MAX_SIDEBARS; $sidebar_count++ ) {
						
		$options[] = array( "name" => "Sidebar " . $sidebar_count,
						"desc" => $sidebar_message,
						"id" => "theme_sidebar".$sidebar_count,
						"std" => "",
						"class" => "small",
						"type" => "text");
	}
						
$options[] = array( "name" => "Colors",
					"type" => "heading");
					
$options[] = array( "name" => "General",
						"type" => "info");
						
$options[] = array( "name" => "Highlight Links / Accents hover color",
					"desc" => "Highlight Links / Accents hover color",
					"id" => "accent_color_hovers",
					"std" => "",
					"type" => "color");
						
$options[] = array( "name" => "Highlight Links / Accents color",
					"desc" => "Highlight Links / Accents color",
					"id" => "accent_color",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Menu",
						"type" => "info");
						
	$options[] = array( "name" => "Menu item description color",
						"desc" => "Menu item description color",
						"id" => "photomenu_desc_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Menu link color",
						"desc" => "Menu link color",
						"id" => "photomenu_link_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Menu link hover color",
						"desc" => "Menu link hover color",
						"id" => "photomenu_linkhover_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Menu item hover background color",
						"desc" => "Menu item hover background color",
						"id" => "photomenu_hover_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Menu subcategory background color",
						"desc" => "Menu subcategory background color",
						"id" => "photomenusubcat_color",
						"std" => "",
						"type" => "color");
						
						
$options[] = array( "name" => "Page",
						"type" => "info");
						
	$options[] = array( "name" => "Page background",
						"desc" => "Page background",
						"id" => "content_pagebg",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Page title color",
						"desc" => "Page title color",
						"id" => "content_title",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Page title background",
						"desc" => "Page title background",
						"id" => "content_titlebg",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Sidebar title",
						"desc" => "Sidebar title",
						"id" => "sidebar_title",
						"std" => "",
						"type" => "color");
						
$options[] = array( "name" => "Contents",
						"type" => "info");
						
	$options[] = array( "name" => "Content titles",
						"desc" => "Content titles",
						"id" => "content_titles",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Content text",
						"desc" => "Content text",
						"id" => "content_text",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Content title link color",
						"desc" => "Content title link color",
						"id" => "content_titlelinks",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Content title link hover color",
						"desc" => "Content title link hover color",
						"id" => "content_titlehover",
						"std" => "",
						"type" => "color");
						
$options[] = array( "name" => "Footer",
						"type" => "info");
						
	$options[] = array( "name" => "Footer background",
						"desc" => "Footer background",
						"id" => "footer_bgcolor",
						"std" => "",
						"type" => "color");
						
$options[] = array( "name" => "Footer Label text color",
					"desc" => "Footer Label text color",
					"id" => "footer_labeltext",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Footer text color",
					"desc" => "Footer text color",
					"id" => "footer_text",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Footer text link color",
					"desc" => "Footer text link color",
					"id" => "footer_link",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Footer text link hover color",
					"desc" => "Footer text link hover color",
					"id" => "footer_linkhover",
					"std" => "",
					"type" => "color");
					
$options[] = array( "name" => "Footer row horizontal line color",
					"desc" => "Footer row horizontal line color",
					"id" => "footer_hline",
					"std" => "",
					"type" => "color");
						
$options[] = array( "name" => "Footer copyright background",
					"desc" => "Footer copyright background",
					"id" => "footer_copyrightbg",
					"std" => "",
					"type" => "color");
						
	$options[] = array( "name" => "Footer copyright label text",
						"desc" => "Footer copyright label text",
						"id" => "footer_copyrighttext",
						"std" => "",
						"type" => "color");

$options[] = array( "name" => "Footer",
					"type" => "heading");
					
$options[] = array( "name" => "Enable Footer widget columns",
					"desc" => "Switch On/off footer widgetized column ",
					"id" => "footerwidget_status",
					"std" => "1",
					"type" => "checkbox");
					
	$options[] = array( "name" => "Copyright text",
						"desc" => "Enter your copyright and other texts to display in footer",
						"id" => "footer_copyright",
						"std" => "Copyright 2012",
						"type" => "textarea");
						
	$options[] = array( "name" => "Footer Scripts",
						"desc" => "Enter footer scripts. eg. Google Analytics. ",
						"id" => "footer_scripts",
						"std" => "",
						"type" => "textarea");


$options[] = array( "name" => "Export",
					"type" => "heading");

	$options[] = array( "name" => "Export Options ( Copy this ) Readonly.",
						"desc" => "Select All, copy and store your theme options backup. You can use these value to import theme options settings.",
						"id" => "exportpack",
						"std" => '',
						"class" => "big",
						"type" => "textarea");

$options[] = array( "name" => "Import Options",
					"type" => "heading",
					"subheading" => 'exportpack');

	$options[] = array( "name" => "Import Options ( Paste and Save )",
						"desc" => "CAUTION: Copy and Paste the Export Options settings into the window and Save to apply theme options settings.",
						"id" => "importpack",
						"std" => '',
						"class" => "big",
						"type" => "textarea");

	return $options;
}
?>