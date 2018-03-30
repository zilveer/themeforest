<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme();
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 *  
 */

function optionsframework_options() {	
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
	$imgpatternspath =  get_template_directory_uri() . '/images/patterns/admin/';
	
	// Pull all the portfolio categories into an array
	$options_portfolio_categories = array();
	$options_portfolio_categories_obj = get_terms("portfolio_category");
	$options_portfolio_categories[''] = 'All posts';
	foreach ($options_portfolio_categories_obj as $portfolio_category) {
		$options_portfolio_categories[$portfolio_category->name] = $portfolio_category->name;
	}
	
	// Pull all the slideshow categories into an array
	$options_slideshow_categories = array();
	$options_slideshow_categories_obj = get_terms("slideshow_category");
	$options_slideshow_categories[''] = 'All posts';
	foreach ($options_slideshow_categories_obj as $slideshow_category) {
		$options_slideshow_categories[$slideshow_category->name] = $slideshow_category->name;
	}
	
	// Defined Stylesheet Paths
	// Use get_template_directory_uri if it's a parent theme
	
	$defined_stylesheets = array(
		"0" => "Default", // There is no "default" stylesheet to load
		get_stylesheet_directory_uri() . '/styles/colors/blue.css' => "Blue",
		get_stylesheet_directory_uri() . '/styles/colors/orange.css' => "Orange",
		get_stylesheet_directory_uri() . '/styles/colors/green.css' => "Green",
		get_stylesheet_directory_uri() . '/styles/colors/yellow.css' => "Yellow",
		get_stylesheet_directory_uri() . '/styles/colors/brown.css' => "Brown",
		get_stylesheet_directory_uri() . '/styles/colors/pink.css' => "Pink",
		get_stylesheet_directory_uri() . '/styles/colors/purple.css' => "Purple",
		get_stylesheet_directory_uri() . '/styles/colors/grey.css' => "Grey",
		get_stylesheet_directory_uri() . '/styles/colors/cyan.css' => "Cyan",
		get_stylesheet_directory_uri() . '/styles/colors/autumn.css' => "Autumn"
	);
	
	// Slideshow data
	$slideshow_array = array(
		'classic' => __('Classic', 'okthemes'),
		'sequence' => __('Sequence', 'okthemes'),
		'camera' => __('Camera', 'okthemes'),
		'none' => __('None', 'okthemes')
	);
	
	// Portfolio Hover
	$porthover_array = array(
		'first' => __('Style 1', 'okthemes'),
		'second' => __('Style 2', 'okthemes'),
		'third' => __('Style 3', 'okthemes')
	);
	
	// Layout style
	$layout_style_array = array(
		'full' => __('Full width', 'okthemes'),
		'boxed' => __('Boxed', 'okthemes')
	);

	// Background Defaults	
	$body_background_defaults = array(
		'color' => '#ffffff',
		'image' => '',
		'repeat' => '',
		'position' => '',
		'attachment'=>''
	);
		
	$options = array();
	
	// Style options						
	$options[] = array( "name" => __('Style Options', 'okthemes'),
						"type" => "heading");
	
	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	
	asort($typography_mixed_fonts);
	
	$options[] = array( "name" => __('Select a Stylesheet to be Loaded', 'okthemes'),
						"desc" => __('Select your theme color style', 'okthemes'),
						"id" => "stylesheet",
						"std" => "0",
						"type" => "select",
						"options" => $defined_stylesheets );
	
	$options[] = array(
						'name' => __('Select layout style', 'okthemes'),
						'desc' => __('Select between full width and boxed layout', 'okthemes'),
						'id' => 'layout_style',
						'std' => 'full',
						'type' => 'select',
						'options' => $layout_style_array);
	
	$options[] = array( "name" => __('Body Background', 'okthemes'),
						"desc" => __('Change the background CSS.', 'okthemes'),
						"id" => "body_background",
						"class" => "hidden subpanel",
						"std" => $body_background_defaults, 
						"type" => "background");
	
	$options[] = array( "name" => __('Select pattern', 'okthemes'),
						"desc" => __('Select a pattern for your boxed layout', 'okthemes'),
						"id" => "pattern_background",
						"class" => "hidden subpanel",
						"std" => "pat09",
						"type" => "images",
						"options" => array(
							'pat01' => $imgpatternspath . 'pat01.png',
							'pat02' => $imgpatternspath . 'pat02.png',
							'pat03' => $imgpatternspath . 'pat03.png',
							'pat04' => $imgpatternspath . 'pat04.png',
							'pat05' => $imgpatternspath . 'pat05.png',
							'pat06' => $imgpatternspath . 'pat06.png',
							'pat07' => $imgpatternspath . 'pat07.png',
							'pat08' => $imgpatternspath . 'pat08.png',
							'pat09' => $imgpatternspath . 'pat09.png',
							'pat10' => $imgpatternspath . 'pat10.png',
							'none' => $imgpatternspath . 'none.png'
							)
						);																
	
	$options[] = array( "name" => __('Site tagline', 'okthemes'),
						"desc" => __('Display site tagline?', 'okthemes'),
						"id" => "display_site_tagline",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Logo Style', 'okthemes'),
						"desc" => __('Display a custom image/logo image in place of title header.', 'okthemes'),
						"id" => "use_logo_image",
						"type" => "checkbox");


	$options[] = array( "name" => __('Header Logo', 'okthemes'),
						"desc" => __('If you prefer to show a graphic logo in place of the header, you can upload or paste the URL here. Set the width and height below. <strong>Your logo should be resized prior to uploading</strong>', 'okthemes'),
						"id" => "header_logo",
						"class" => "hidden subpanel",
						"type" => "upload");
						
	$options[] = array( "name" => __('Logo Width', 'okthemes'),
						"desc" => __('Width (in px) of your logo.', 'okthemes'),
						"id" => "logo_width",
						"std" => "300",
						"class" => "mini hidden subpanel",
						"type" => "text");
						
	$options[] = array( "name" => __('Logo Height', 'okthemes'),
						"desc" => __('Height (in px) of your logo.', 'okthemes'),
						"id" => "logo_height",
						"std" => "80",
						"class" => "mini hidden subpanel",
						"type" => "text");
	
	$options[] = array( "name" => __('Favicon Style', 'okthemes'),
						"desc" => __('Display a custom image/logo favicon.', 'okthemes'),
						"id" => "use_favicon",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Favicon Logo', 'okthemes'),
						"desc" => __('Upload or paste the URL here. <strong>Your logo should be resized prior to uploading</strong>', 'okthemes'),
						"id" => "favicon_logo",
						"class" => "hidden subpanel",
						"type" => "upload");
						
	$options[] = array( "name" => __('WP admin logo style', 'okthemes'),
						"desc" => __('Display a custom image/logo when you wp login page.', 'okthemes'),
						"id" => "use_wp_admin_logo",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('WP admin logo', 'okthemes'),
						"desc" => __('Upload or paste the URL here. <strong>Your logo should be resized prior to uploading</strong>', 'okthemes'),
						"id" => "wp_admin_logo",
						"class" => "hidden subpanel",
						"type" => "upload");															
  	
	$options[] = array( "name" => __('Sidebar Position', 'okthemes'),
						"desc" => __('Select a sidebar layout position (left or right). You can also select a wide page layout on a per-page basis.', 'okthemes'),
						"id" => "page_layout",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'left' => $imagepath . '2cl.png',
							'right' => $imagepath . '2cr.png')
						);

    $options[] = array( "name" => __('Main Body Typography', 'okthemes'),
						"desc" => __('Body Typography.', 'okthemes'),
						"id" => "body_typography",
						"std" => array('size' => '12px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#747779'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));
	
	$options[] = array( "name" => __('Main Menu Typography', 'okthemes'),
						"desc" => __('Menu Typography.', 'okthemes'),
						"id" => "menu_typography",
						"std" => array('size' => '16px','face' => 'Oswald, sans-serif','style' => 'normal','color' => '#000000'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));				

	$options[] = array( "name" => __('(H1) Heading Typography', 'okthemes'),
						"desc" => __('Heading typography.', 'okthemes'),
						"id" => "h1_typography",
						"std" => array('size' => '30px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#000000'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));
  
  	$options[] = array( "name" => __('(H2) Heading Typography', 'okthemes'),
						"desc" => __('Heading Two typography.', 'okthemes'),
						"id" => "h2_typography",
						"std" => array('size' => '24px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#000000'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));			
				  

  	$options[] = array( "name" => __('(H3) Heading Typography', 'okthemes'),
						"desc" => __('Heading Three typography.', 'okthemes'),
						"id" => "h3_typography",
						"std" => array('size' => '18px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'normal','color' => '#000000'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));
	
	$options[] = array( "name" => __('(H4) Heading Typography', 'okthemes'),
						"desc" => __('Heading Four typography.', 'okthemes'),
						"id" => "h4_typography",
						"std" => array('size' => '14px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'bold','color' => '#000000'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));			
	
 	$options[] = array( "name" => __('(H5) Heading Typography', 'okthemes'),
						"desc" => __('Heading Five typography.', 'okthemes'),
						"id" => "h5_typography",
						"std" => array('size' => '12px','face' => 'Lucida Sans Unicode, Lucida Grande, sans-serif','style' => 'bold','color' => '#000000'),
						'type' => 'typography',
						'options' => array('faces' => $typography_mixed_fonts));

	//Homepage options
	$options[] = array( "name" => __('Homepage', 'okthemes'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Homepage first section', 'okthemes'),
						"desc" => __('Display first homepage section', 'okthemes'),
						"id" => "homepage_first_section",
						"type" => "checkbox");						
						
	$options[] = array( "name" => __('Homepage first section (About us)', 'okthemes'),
						"desc" => __('Insert the homepage first section title', 'okthemes'),
						"id" => "homepage_first_section_title",
						"class" => "hidden subpanel",
						"std" => __('CHERYY INC', 'okthemes'),
						"type" => "text");
	
	$options[] = array( "name" => __('Homepage left module (Our history)', 'okthemes'),
						"desc" => __('Insert the homepage left module title', 'okthemes'),
						"id" => "homepage_left_module_title",
						"class" => "hidden subpanel",
						"std" => __('Our history', 'okthemes'),
						"type" => "text");
						
	// Start editor
	$wp_editor_settings = array(
						'wpautop' => false, // Default
						'teeny' => true, // Default
						'textarea_rows' => 5,
						'tinymce' => false);
	
	$options[] = array(	'name' => __('Homepage left module text editor', 'okthemes'),
						'desc' => __('Insert your content here', 'okthemes'),
						'id' => 'homepage_left_module_editor',
						"class" => "hidden subpanel",
						'type' => 'editor',
						'settings' => $wp_editor_settings );					
						
	$options[] = array( "name" => __('Homepage right module (Our approach)', 'okthemes'),
						"desc" => __('Insert the homepage right module title', 'okthemes'),
						"id" => "homepage_right_module_title",
						"class" => "hidden subpanel",
						"std" => __('Our approach', 'okthemes'),
						"type" => "text");

	$options[] = array(	'name' => __('Homepage right module text editor', 'okthemes'),
						'desc' => __('Insert your content here', 'okthemes'),
						'id' => 'homepage_right_module_editor',
						"class" => "hidden subpanel",
						'type' => 'editor',
						'settings' => $wp_editor_settings );
	
	$options[] = array( "name" => __('Homepage second section', 'okthemes'),
						"desc" => __('Display second homepage section', 'okthemes'),
						"id" => "homepage_second_section",
						"type" => "checkbox");					
					
	
	$options[] = array( "name" => __('Homepage second section (Our works)', 'okthemes'),
						"desc" => __('Insert the homepage second section title', 'okthemes'),
						"id" => "homepage_second_section_title",
						"class" => "hidden subpanel",
						"std" => __('Our works', 'okthemes'),
						"type" => "text");
						
	$options[] = array( "name" => __('Homepage portfolio title (Latest works)', 'okthemes'),
						"desc" => __('Insert the homepage portfolio title', 'okthemes'),
						"id" => "homepage_portfolio_title",
						"class" => "hidden subpanel",
						"std" => __('Latest works', 'okthemes'),
						"type" => "text");	
				
	$options[] = array(	'name' => __('Homepage portfolio text editor', 'okthemes'),
						'desc' => __('Insert your content here', 'okthemes'),
						'id' => 'homepage_portfolio_editor',
						"class" => "hidden subpanel",
						'type' => 'editor',
						'settings' => $wp_editor_settings );														

	$options[] = array(	'name' => __('Select a Category', 'okthemes'),
						'desc' => __('Select a portfolio category to display', 'okthemes'),
						'id' => 'portfolio_select_categories',
						"class" => "hidden subpanel",
						'type' => 'select',
						'options' =>$options_portfolio_categories);
		
	$options[] = array( "name" => __('Number of posts to show', 'okthemes'),
						"desc" => __('Insert number of portfolio posts to show', 'okthemes'),
						"id" => "portfolio_nr_posts",
						"class" => "hidden subpanel",
						"std" => "6",
						"type" => "text");				
	
	$options[] = array(	'name' => __('Select a hover effect', 'okthemes'),
						'desc' => __('Select portfolio post hover effect', 'okthemes'),
						'id' => 'home_portfolio_hover',
						"class" => "hidden subpanel",
						'std' => 'first',
						'type' => 'select',
						'options' => $porthover_array);
	
	$options[] = array( "name" => __('Homepage third section', 'okthemes'),
						"desc" => __('Display third homepage section', 'okthemes'),
						"id" => "homepage_third_section",
						"type" => "checkbox");											
	
	$options[] = array( "name" => __('Homepage third section (Our partners)', 'okthemes'),
						"desc" => __('Insert the homepage third section title', 'okthemes'),
						"id" => "homepage_third_section_title",
						"class" => "hidden subpanel",
						"std" => __('Our partners', 'okthemes'),
						"type" => "text");	
	
	$options[] = array( "name" => __('Number of posts to show', 'okthemes'),
						"desc" => __('Insert number of sponsors posts to show', 'okthemes'),
						"id" => "sponsors_nr_posts",
						"class" => "hidden subpanel",
						"std" => "10",
						"type" => "text");								
	
	//Slideshow Options
	$options[] = array( "name" => __('Slideshows', 'okthemes'),
						"type" => "heading");
	
	$options[] = array(	'name' => __('Select slideshow', 'okthemes'),
						'desc' => __('Select your slideshow', 'okthemes'),
						'id' => 'slideshow_select',
						'std' => 'classic',
						'type' => 'select',
						'options' => $slideshow_array);	
	
	$options[] = array(	'name' => __('Select a Category', 'okthemes'),
						'desc' => __('Select a slideshow category to display', 'okthemes'),
						'id' => 'slideshow_select_categories',
						'type' => 'select',
						'options' =>$options_slideshow_categories);									
						
	$options[] = array( "name" => __('Number of posts to show', 'okthemes'),
						"desc" => __('Insert number of sponsors posts to show', 'okthemes'),
						"id" => "slideshow_nr_posts",
						"std" => "5",
						"type" => "text");
	
	$options[] = array(	'name' => __('Animate automatically?', 'okthemes'),
						'desc' => __('Select true/false if you want the slideshow to start automatically', 'okthemes'),
						'id' => 'auto_animate',
						'std' => 'false',
						'type' => 'select',
						'options' => array(
									'false' => __('False', 'okthemes'),
									'true' => __('True', 'okthemes')
									)
						);
	
	$options[] = array(	'name' => __('Randomize the order of the slides?', 'okthemes'),
						'desc' => __('Select true/false if you want to randomize the order of the slides', 'okthemes'),
						'id' => 'randomize_order',
						'std' => 'false',
						'type' => 'select',
						'options' => array(
									'false' => __('False', 'okthemes'),
									'true' => __('True', 'okthemes')
									)
						);
	
	$options[] = array(	'name' => __('Display navigation?', 'okthemes'),
						'desc' => __('Select true/false if you want to display navigation', 'okthemes'),
						'id' => 'display_navigation',
						'std' => 'true',
						'type' => 'select',
						'options' => array(
									'true' => __('True', 'okthemes'),
									'false' => __('False', 'okthemes')
									)
						);
	
	$options[] = array(	'name' => __('Display pager?', 'okthemes'),
						'desc' => __('Select true/false if you want to display pager navigation', 'okthemes'),
						'id' => 'display_pager',
						'std' => 'false',
						'type' => 'select',
						'options' => array(
									'false' => __('False', 'okthemes'),
									'true' => __('True', 'okthemes')
									)
						);
						
	
	$options[] = array(	'name' => __('Display thumbnails on pager hover?', 'okthemes'),
						'desc' => __('Select true/false if you want to display thumbnails on pager hover', 'okthemes'),
						'id' => 'camera_display_thumb_pager',
						'std' => 'false',
						'type' => 'select',
						'options' => array(
									'false' => __('False', 'okthemes'),
									'true' => __('True', 'okthemes')
									)
						);
	
	$options[] = array(	'name' => __('Loader style', 'okthemes'),
						'desc' => __('Choose to display the loader bar.', 'okthemes'),
						'id' => 'camera_loader',
						'std' => 'bar',
						'type' => 'select',
						'options' => array(
									'bar' => __('Bar', 'okthemes'),
									'none' => __('None', 'okthemes')
									)
						);					
	
	$options[] = array(
						'name' => __('Select slide effect?', 'okthemes'),
						'desc' => __('Select a slide effect', 'okthemes'),
						'id' => 'camera_effect',
						'std' => 'random',
						'type' => 'select',
						'options' => array(
									'random' => __('Random', 'okthemes'),
									'simpleFade' => __('simpleFade', 'okthemes'),
									'curtainTopLeft' => __('curtainTopLeft', 'okthemes'),
									'curtainSliceLeft' => __('curtainSliceLeft', 'okthemes'),
									'blindCurtainTopLeft' => __('blindCurtainTopLeft', 'okthemes'),
									'blindCurtainSliceTop' => __('blindCurtainSliceTop', 'okthemes'),
									'mosaic' => __('mosaic', 'okthemes'),
									'stampede' => __('stampede', 'okthemes'),
									'topLeftBottomRight' => __('topLeftBottomRight', 'okthemes'),
									'bottomRightTopLeft' => __('bottomRightTopLeft', 'okthemes'),
									'scrollLeft' => __('scrollLeft', 'okthemes'),
									'scrollRight' => __('scrollRight', 'okthemes'),
									'scrollHorz' => __('scrollHorz', 'okthemes'),
									'scrollBottom' => __('scrollBottom', 'okthemes'),
									'scrollTop' => __('scrollTop', 'okthemes')
									)
						);										
																								
	//Social Media Options					
	$options[] = array( "name" => __('Social Media', 'okthemes'),
						"type" => "heading");
						
	$options[] = array( "name" => __('RSS Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "rss_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Facebook Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "facebook_link",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Twitter Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "twitter_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Skype Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "skype_link",
						"std" => "",
						"type" => "text");


	$options[] = array( "name" => __('Vimeo Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "vimeo_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('LinkedIn Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "linkedin_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Dribble Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "dribble_link",
						"std" => "",
						"type" => "text");
												

	$options[] = array( "name" => __('Forrst Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "forrst_link",
						"std" => "",
						"type" => "text");
												
	$options[] = array( "name" => __('Flickr Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "flickr_link",
						"std" => "",
						"type" => "text");


	$options[] = array( "name" => __('Google Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "google_link",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => __('Youtube Link (Widget)', 'okthemes'),
						"desc" => __('Social Icon will display/hide automatically in the social icon widget.', 'okthemes'),
						"id" => "youtube_link",
						"std" => "",
						"type" => "text");										
	
	//SEO Options					
	$options[] = array( "name" => __('SEO Options', 'okthemes'),
						"type" => "heading");
					
	$options[] = array( "name" => __('Meta Description', 'okthemes'),
						"desc" => __('Enter a brief description for your site. This is what gets displayed on a Search Engine results page.', 'okthemes'),
						"id" => "seo_meta_desc",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => __('Meta Keywords', 'okthemes'),
						"desc" => __('Enter a comma separated list of keywords for your site (E.g.: keyword1, keyword2, keyword3)', 'okthemes'),
						"id" => "seo_meta_keywords",
						"std" => "",
						"type" => "textarea");
	
	//Misc Options					
	$options[] = array( "name" => __('Sidebars', 'okthemes'),
						"type" => "heading");
	
	$options[] = array( "name" => "Create new custom sidebar:",
						"desc" => "",
						"id" => "sidebar_create",
						"type" => "sidebar_create",
						"std" => "");

	$options[] = array( "name" => "Available custom sidebars:",
						"desc" => "",
						"id" => "sidebar_list",
						"type" => "sidebar_list",
						"std" => "");					
	
	//Misc Options					
	$options[] = array( "name" => __('Misc', 'okthemes'),
						"type" => "heading");
						
	$options[] = array(
						'name' => __('Display header search form on pages?', 'okthemes'),
						'desc' => __('Select yes/no if you want to display/hide the header search form', 'okthemes'),
						'id' => 'header_search_form',
						'std' => 'yes',
						'type' => 'select',
						'options' => array(
									'yes' => __('Yes', 'okthemes'),
									'no' => __('No', 'okthemes')
									)
						);
	
	$options[] = array(
						'name' => __('Display breadcrumbs on pages?', 'okthemes'),
						'desc' => __('Select yes/no if you want to display/hide the breadcrumbs', 'okthemes'),
						'id' => 'header_breadcrumbs',
						'std' => 'yes',
						'type' => 'select',
						'options' => array(
									'yes' => __('Yes', 'okthemes'),
									'no' => __('No', 'okthemes')
									)
						);											
	
	$options[] = array( "name" => __('Footer copyright title', 'okthemes'),
						"desc" => __('Enter your copyright informations here', 'okthemes'),
						"id" => "footer_copyright",
						"std" => __('Copyright 2012 - All rights reserved', 'okthemes'),
						"type" => "text");
						
	$options[] = array( "name" => __('Footer Scripts', 'okthemes'),
						"desc" => __('Add custom footer scripts such as Google Analytics. Do not include the &lt;script&gt; tag. This is already done for you.', 'okthemes'),
						"id" => "footer_scripts",
						"std" => "",
						"type" => "textarea");
		
	return $options;
}