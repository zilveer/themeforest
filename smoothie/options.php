<?php
/**
 * The theme option name is set as 'options-theme-customizer' here.
 * In your own project, you should use a different option name.
 * I'd recommend using the name of your theme.
 *
 * This option name will be used later when we set up the options
 * for the front end theme customizer.
 */

function optionsframework_option_name() {

	$optionsframework_settings = get_option('optionsframework');
	
	// Edit 'options-theme-customizer' and set your own theme name instead
	$optionsframework_settings['id'] = 'smoothie';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {

	// Alignment
	$bg_image = array("light" => "Light","dark" => "Dark");
	
	// Backgrounds
	$show_excerpt_scroll = array("yes" => "Yes","no" => "No");
	
	// Background Defaults
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/images/';
		
	$options = array();
		
	$options[] = array( "name" => __('General Settings', 'cr'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Logo Upload', 'cr'),
						"desc" => __('Upload your logo image to use in the header. Max height is 63px', 'cr'),
						"id" => "of_logo",
						"type" => "upload");
    
	$options[] = array( "name" => __('Favicon Upload', 'cr'),
						"desc" => __('Upload your .png or .ico image to use in the favicon.', 'cr'),
						"id" => "of_favicon",
						"type" => "upload");
    
    $options[] = array( "name" => __('Enable Masonry View For Homepage', 'cr'),
						"desc" => __('Check on for setup Masonry View for Homepage.', 'cr'),
						"id" => "of_masonryswitchhome",
						'std' => '0',
						"type" => "checkbox");
    
    $options[] = array( "name" => __('Enable Masonry View For Archives Pages', 'cr'),
						"desc" => __('Check on for setup Masonry View for Category, Author, Tag, Date, Search pages', 'cr'),
						"id" => "of_masonryswitch",
						'std' => '0',
						"type" => "checkbox");
    
    
    $options[] = array( "name" => __('Layouts Selector', 'cr'),
		                "desc" => __('Choose layout for posts', 'cr'),
		                "id" => "of_layout",
		                "std" => "right",
		                "type" => "images",
		                'options' => array(
			                'right' => $imagepath . 'right.png',
                            'left' => $imagepath . 'left.png',
                            'without' => $imagepath . 'without.png')
	                   );
    
    $options[] = array( "name" => __('Content Width', 'cr'),
						"desc" => __('Width of content (without sidebar) in px or %. Example: 790px or 56%. Only for media screens more than 1280px.', 'cr'),
						"id" => "of_contentwidth",
						"type" => "text");
    
    $options[] = array( "name" => __('Sidebar Width', 'cr'),
						"desc" => __('Width of content (without sidebar) in px or %. Example: 300px or 30%. Only for media screens more than 1280px.', 'cr'),
						"id" => "of_sidebarwidth",
						"type" => "text");
    
    $options[] = array( "name" => __('Retina Images', 'cr'),
                        "desc" => __('Enable or disable resizing images for Retina displays', 'cr'),
						"id" => "of_retina",
						"std" => "0",
						"type" => "radio",
						'options' => array(
							'1' => 'Enable',
							'0' => 'Disable')
						);	
    
    $options[] = array( "name" => __('Copyright', 'cr'),
						"desc" => __('Put your Copyright text to display it in footer area.', 'cr'),
						"id" => "of_copyright",
						"std" => "",
						"type" => "textarea"); 	
						
	$options[] = array( "name" => __('Tracking Code', 'cr'),
						"desc" => __('Put your Google Analytics or other tracking code here.', 'cr'),
						"id" => "of_tracking_code",
						"std" => "",
						"type" => "textarea"); 		
																					
	// ------------- Style Settings  ------------- //	
						
	$options[] = array( "name" => __('Style Settings', 'cr'),
						"type" => "heading");															
	
	$options[] = array( "name" => __('Background Color', 'cr'),
						"desc" => __('Select the color you would like your background to be.', 'cr'),
						"id" => "of_backgroundcolor",
						"std" => "",
						"type" => "color");	
	
	$options[] = array( "name" => __('Background Image', 'cr'),
						"desc" => __('Upload your image to use in the background.', 'cr'),
						"id" => "of_backgroundimage",
						"type" => "upload");
	
	$options[] = array( "name" => __('Background Repeat', 'cr'),
						"desc" => __('Check on for repeat.', 'cr'),
						"id" => "of_backgroundrepeat",
						'std' => '0',
						"type" => "checkbox");
    
    $options[] = array( "name" => __('Leftsidebar Background Color', 'cr'),
						"desc" => __('Select the color you would like your left sidebar background to be.', 'cr'),
						"id" => "of_leftsidebarcolor",
						"std" => "",
						"type" => "color");	

	$options[] = array( "name" => __('Link Color', 'cr'),
						"desc" => __('Select the color you would like your Links to be.', 'cr'),
						"id" => "of_colorpicker",
						"std" => "",
						"type" => "color");
    
	$options[] = array( "name" => __('Logo Text Color', 'cr'),
						"desc" => __('Select the color you would like your Logo Text to be.', 'cr'),
						"id" => "of_logocolor",
						"std" => "",
						"type" => "color");
    
    $options[] = array( "name" => __('Logo Text Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Logo Text Hover to be.', 'cr'),
						"id" => "of_logohovercolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Menu Link Color', 'cr'),
						"desc" => __('Select the color you would like your Menu Links to be.', 'cr'),
						"id" => "of_menucolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Menu Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Menu Hover to be.', 'cr'),
						"id" => "of_menuhovercolor",
						"std" => "",
						"type" => "color");	
						
						
	$options[] = array( "name" => __('Menu Hover Background Color', 'cr'),
						"desc" => __('Select the color you would like your Menu Hover Background to be.', 'cr'),
						"id" => "of_menubgcolor",
						"std" => "",
						"type" => "color");	
											
	$options[] = array( "name" => __('Buttons Color', 'cr'),
						"desc" => __('Select the color you would like your Buttons to be.', 'cr'),
						"id" => "of_buttonscolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Buttons Text Color', 'cr'),
						"desc" => __('Select the color you would like your Buttons Text to be.', 'cr'),
						"id" => "of_buttonstextcolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Buttons Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Buttons Hover to be.', 'cr'),
						"id" => "of_buttonshover",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Buttons Text Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Buttons Text Hover to be.', 'cr'),
						"id" => "of_buttonstexthovercolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Tags Text Color', 'cr'),
						"desc" => __('Select the color you would like your Tags to be. This option changes tags color in tagcloud.', 'cr'),
						"id" => "of_tagscolor",
						"std" => "",
						"type" => "color");	
    
    $options[] = array( "name" => __('Tags Background Color', 'cr'),
						"desc" => __('Select the color you would like your Tags Background to be. This option changes tags color in tagcloud.', 'cr'),
						"id" => "of_tagsbgcolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Tags Text Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Tags Hover to be. This option changes tags hover color in tagcloud.', 'cr'),
						"id" => "of_tagshovercolor",
						"std" => "",
						"type" => "color");	
    
    $options[] = array( "name" => __('Tags Background Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Tags Background Hover to be. This option changes tags background hover color in tagcloud.', 'cr'),
						"id" => "of_tagsbghvcolor",
						"std" => "",
						"type" => "color");	

	$options[] = array( "name" => __('Sidebar Background Color', 'cr'),
						"desc" => __('Select the color you would like your Sidebar Background to be.', 'cr'),
						"id" => "of_sdbrbckgrndcol",
						"std" => "",
						"type" => "color");			

	$options[] = array( "name" => __('Sidebar Text Color', 'cr'),
						"desc" => __('Select the color you would like your Sidebar Text to be.', 'cr'),
						"id" => "of_sdbrtxtcol",
						"std" => "",
						"type" => "color");
    
    $options[] = array( "name" => __('Sidebar Title Color', 'cr'),
						"desc" => __('Select the color you would like your Sidebar Title to be.', 'cr'),
						"id" => "of_sdbrttlcol",
						"std" => "",
						"type" => "color");

    $options[] = array( "name" => __('Footer Background Color', 'cr'),
						"desc" => __('Select the color you would like your Footer Background to be.', 'cr'),
						"id" => "of_ftrbgcol",
						"std" => "",
						"type" => "color");	
					
	$options[] = array( "name" => __('Footer Text Color', 'cr'),
						"desc" => __('Select the color you would like your Footer Text to be.', 'cr'),
						"id" => "of_ftrtxtcol",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Footer Title Color', 'cr'),
						"desc" => __('Select the color you would like your Footer Title to be.', 'cr'),
						"id" => "of_ftrtitlecol",
						"std" => "",
						"type" => "color");	

	// ------------- Post Style Settings  ------------- //	

	$options[] = array( "name" => __('Post Style Settings', 'cr'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Post Excerpt Settings', 'cr'),
						"id" => "of_excerptset",
						"std" => "1",
						"type" => "radio",
						'options' => array(
							'0' => 'Full text.',
							'1' => 'Excerpt.')
						);
						
	$options[] = array( "name" => __('Post Excerpt Length', 'cr'),
						"desc" => __('Type how many words show in exerpt.', 'cr'),
						"id" => "of_excerptlength",
						"std" => "40",
						"type" => "text");
						
	$options[] = array( "name" => __('Read More Link Name', 'cr'),
						"desc" => __('Write what you want to see instead of the "Read more".', 'cr'),
						"id" => "of_readmorename",
						"std" => "Read more",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Background Color', 'cr'),
						"desc" => __('Select the color you would like your Post Background to be.', 'cr'),
						"id" => "of_postbgcolor",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => __('Post Meta Links Color', 'cr'),
						"desc" => __('Select the color you would like your post Meta Links to be.', 'cr'),
						"id" => "of_postmetalinkscolor",
						"std" => "",
						"type" => "color");

	$options[] = array( "name" => __('Post Links Color', 'cr'),
						"desc" => __('Select the color you would like your Post Links to be.', 'cr'),
						"id" => "of_postlinkscolor",
						"std" => "",
						"type" => "color");	

	$options[] = array( "name" => __('Post Text Color', 'cr'),
						"desc" => __('Select the color you would like your Post Text to be.', 'cr'),
						"id" => "of_posttextcolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Post Title Color', 'cr'),
						"desc" => __('Select the color you would like your Post Title to be.', 'cr'),
						"id" => "of_posttitlecolor",
						"std" => "",
						"type" => "color");	

	$options[] = array( "name" => __('Post Title Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Post Title Hover to be.', 'cr'),
						"id" => "of_posttitlehovercolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Post Share Icons Color', 'cr'),
						"desc" => __('Select the color you would like your Post Share icons to be.', 'cr'),
						"id" => "of_postbariconscolor",
						"std" => "",
						"type" => "color");	
						
	$options[] = array( "name" => __('Post Share Icons Hover Color', 'cr'),
						"desc" => __('Select the color you would like your Post Share icons hover to be.', 'cr'),
						"id" => "of_postbariconshovercolor",
						"std" => "",
						"type" => "color");	
    
    // ------------- Fonts Settings  ------------- //	
    $options[] = array( "name" => __('Fonts Settings', 'cr'),
                        "type" => "heading");
    
    $options[] = array( "name" => __('Google Font Code', 'cr'),
						"desc" => __('Put your Google Font code here. You can paste here one or more codes. Dont forget enter the name of font in fields below. Example: &lt;link href="http://fonts.googleapis.com/css?family=Lato:400,700,300" rel="stylesheet" type="text/css"&gt;', 'cr'),
						"std" => "",
                        "id" => "of_googlefontcode",
						"type" => "textarea");
    
    $options[] = array( "name" => __('Text Logo Font Family', 'cr'),
						"desc" => __('Font Family of Logo', 'cr'),
						"id" => "of_logofont",
						"type" => "text");
    
    $options[] = array( "name" => __('Menu Font Family', 'cr'),
						"desc" => __('Font Family of Top Menu', 'cr'),
						"id" => "of_menufont",
						"type" => "text");
    
    $options[] = array( "name" => __('H1, H2, H3, H4, H5, H6 Font Family', 'cr'),
						"desc" => __('Font Family for headers', 'cr'),
						"id" => "of_hdrsfont",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Title Font Family', 'cr'),
						"desc" => __('Font Family for Titles', 'cr'),
						"id" => "of_posttitles",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Meta Font Family', 'cr'),
						"desc" => __('Font Family for Meta posts', 'cr'),
						"id" => "of_postmeta",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Font Family', 'cr'),
						"desc" => __('Font Family for Posts text and Sidebar text', 'cr'),
						"id" => "of_postfont",
						"type" => "text");
    
    $options[] = array( "name" => __('Text Logo Font Size', 'cr'),
						"desc" => __('Enter size of logo font. Example: 32px', 'cr'),
						"id" => "of_logofontsize",
						"type" => "text");
    
    $options[] = array( "name" => __('Menu Font Size', 'cr'),
						"desc" => __('Enter size of menu font. Example: 32px', 'cr'),
						"id" => "of_menufontsize",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Title Font Size', 'cr'),
						"desc" => __('Enter size of post title. Example: 32px', 'cr'),
						"id" => "of_titlefontsize",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Meta Font Size', 'cr'),
						"desc" => __('Font Size for Meta posts. Example: 32px', 'cr'),
						"id" => "of_postmetasz",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Meta Font Size for Masonry', 'cr'),
						"desc" => __('Font Size for Meta posts on Masonry pages. Example: 32px', 'cr'),
						"id" => "of_postmetaszmsnr",
						"type" => "text");
    
    $options[] = array( "name" => __('Post Text Font Size', 'cr'),
						"desc" => __('Enter size of text font for posts. Example: 32px', 'cr'),
						"id" => "of_postfontsize",
						"type" => "text");
    
    $options[] = array( "name" => __('Share Icons Size', 'cr'),
						"desc" => __('Enter size of share icons. Example: 32px', 'cr'),
						"id" => "of_sharefontsize",
						"type" => "text");
    
    $options[] = array( "name" => __('Masonry Share Icons Size', 'cr'),
						"desc" => __('Enter size of share icons in masonry page. Example: 32px', 'cr'),
						"id" => "of_sharefontsizemas",
						"type" => "text");
    
    // ------------- Custom CSS Tab  ------------- //
	
	$options[] = array( "name" => "Custom CSS",
						"type" => "heading");
	
	$options[] = array( "name" => __('Custom CSS', 'cr'),
						"desc" => __('If you would like to make styling modifications, you can do that here. Doing it here will prevent your modifications from being overwritten if/when you update the theme.', 'cr'),
						"id" => "of_theme_css",
						"type" => "textarea"); 
								
	return $options;
}

