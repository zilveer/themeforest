<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	// CHANGED BY THEME BLOSSOM
	$themename = wp_get_theme();
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */


// Shortname
$shortname = 'themeblossom_';

// float
$float = array(
	"center"	=> "Center",
	"left"		=> "Left",
	"right"		=> "Right"
);

function optionsframework_options() {
		
	// If using image radio buttons, define a directory path
	$imagepath =  PARENT_URL . '/images/';

	// Background Defaults	
	$body_background_defaults = array(
	'color' => BODY_BACKGROUND_COLOR,
	'image' => BODY_BACKGROUND_IMAGE,
	'repeat' => BODY_BACKGROUND_REPEAT,
	'position' => BODY_BACKGROUND_POSITION,
	'attachment'=> BODY_BACKGROUND_ATTACHMENT);
		
	$options = array();
						
	/****************************************************************/
	/*							GENERAL								*/
	/****************************************************************/
	$options[] = array( "name" => "General",
						"type" => "heading");

						
	$options[] = array( "name" => "Site Layout",
						"desc" => "",
						"id" => "site_layout",
						"std" => DEFAULT_LAYOUT,
						"type" => "radio",
						"options" => array(
							'wide' => 'Wide',
							'box' => 'Box')
						);
						
	$options[] = array( "name" =>  "Body Background",
						"desc" => "Change the background CSS.",
						"id" => "body_background",
						"std" => $body_background_defaults, 
						"type" => "background");
  
	$options[] = array( "name" => "Set Background Height",
						"desc" => "Check this if you want to set a specific background height.<br>Not recommended on boxed layout.",
						"id" => "specific_background_height",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => "Background Height",
						"desc" => "Height (in px) of background.",
						"id" => "background_height",
						"std" => "480",
						"class" => "mini hidden",
						"type" => "text"); 
						
	$options[] = array( "name" => "Favicon",
						"desc" => "16x16, please",
						"id" => "favicon",
						"std" => $imagepath . "favicon.png",
						"type" => "upload");

						
	$options[] = array( "name" => "Apple Touch Icon",
						"desc" => "57x57, please",
						"id" => "apple_touch_icon",
						"std" => $imagepath . "apple-touch-icon.png",
						"type" => "upload");

						
	$options[] = array( "name" => "Sidebar Position",
						"desc" => "Select a sidebar layout position (left or right).",
						"id" => "page_layout",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'left' => $imagepath . '2cl.png',
							'right' => $imagepath . '2cr.png')
						);
  
	$options[] = array( "name" => "Show Logo",
						"desc" => "Display a custom image/logo image in place of title header.",
						"id" => "use_logo_image",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Logo Style",
						"desc" => "This option will be used only on wide layout.",
						"id" => "logo_style",
						"std" => "default",
						"options" => array('default' => 'Inline with navigation', 'above1' => 'Above navigation - centered', 'above2' => 'Above navigation - left'),
						"class" => "hidden",
						"type" => "select");

	$options[] = array( "name" => "Header Logo",
						"desc" => "If you prefer to show a graphic logo in place of the header, you can upload or paste the URL here. Set the width and height. <strong>Your logo should be resized prior to uploading</strong>",
						"id" => "header_logo",
						"class" => "hidden",
						"std" => $imagepath . "logo.png",
						"type" => "upload");
						
	$options[] = array( "name" => "Logo Width",
						"desc" => "Width (in px) of Your logo.",
						"id" => "logo_width",
						"std" => "259",
						"class" => "mini hidden",
						"type" => "text");
						
	$options[] = array( "name" => "Logo Height",
						"desc" => "Height (in px) of Your logo.",
						"id" => "logo_height",
						"std" => "221",
						"class" => "mini hidden",
						"type" => "text");  
						
	$options[] = array( "name" => "Logo Top Margin",
						"desc" => "Margin (in px) of Your logo.",
						"id" => "logo_top",
						"std" => "15",
						"class" => "mini hidden",
						"type" => "text"); 
						
	$options[] = array( "name" => "Logo Bottom Margin",
						"desc" => "Margin (in px) of Your logo.",
						"id" => "logo_bottom",
						"std" => "15",
						"class" => "mini hidden",
						"type" => "text"); 
  
	$options[] = array( "name" => "Footer Text",
						"desc" => "You can use html tags.",
						"id" => "footer_text",
						"std" => "Copyright &copy; 2012 <a href='http://www.themeblossom.com'>ThemeBlossom.com</a>. All Rights Reserved",
						"type" => "textarea");
  
	$options[] = array( "name" => "Footer Scripts",
						"desc" => "Paste all except <script></script> tags.",
						"id" => "footer_scripts",
						"std" => "",
						"type" => "textarea");

	/****************************************************************/
	/*							TYPOGRAPHY							*/
	/****************************************************************/
	$options[] = array( "name" => "Typography",
						"type" => "heading");

	$options[] = array( "name" => "Main Body Typography",
					"desc" => "Body Typography.",
					"id" => "body_typography",
					"std" => array('size' => BODY_TYPOGRAPHY_SIZE, 'face' => BODY_TYPOGRAPHY_FACE, 'style' => BODY_TYPOGRAPHY_STYLE, 'color' => BODY_TYPOGRAPHY_COLOR),
					"type" => "typography");	
						
	$options[] = array( "name" => "Use Google fonts",
						"desc" => "Would you like to use Google fonts on your site?",
						"id" => "use_google_fonts",
						"type" => "checkbox",
						"std" => USE_GOOGLE_FONTS);		

						
	$options[] = array( "name" => "(H1) Heading Typography",
					"desc" => "Heading typography.",
					"id" => "h1_typography",
					"class" => "hidden",
					"std" => array('size' => DEFAULT_H1_SIZE,  'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => DEFAULT_H1_COLOR),
					"type" => "gtypography");
  
  	$options[] = array( "name" => "(H2) Heading Typography",
					"desc" => "Heading Two typography.",
					"id" => "h2_typography",
					"class" => "hidden",
					"std" => array('size' => DEFAULT_H2_SIZE, 'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => DEFAULT_HEADING_COLOR),
					"type" => "gtypography");			
				  

  	$options[] = array( "name" => "(H3) Heading Typography",
					"desc" => "Heading Three typography.",
					"id" => "h3_typography",
					"class" => "hidden",
					"std" => array('size' => DEFAULT_H3_SIZE, 'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => DEFAULT_H1_COLOR),
					"type" => "gtypography");

	$options[] = array( "name" => "Sidebar Title Color",
					"desc" => "It will be used in sidebar titles and for section titles (on home page, i.e.).",
					"id" => "sidebar_title_color",
					"std" => DEFAULT_H1_COLOR,
					"type" => "color");

	$options[] = array( "name" => "Index Page Heading Color",
					"desc" => "It will be used on blog page i.e..",
					"id" => "index_title_color",
					"std" => DEFAULT_INDEX_HEADING_COLOR,
					"type" => "color");
						
	$options[] = array( "name" => "(H4) Heading Typography",
					"desc" => "Heading Four typography.",
					"id" => "h4_typography",
					"class" => "hidden",
					"std" => array('size' => DEFAULT_H4_SIZE, 'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => DEFAULT_HEADING_COLOR),
					"type" => "gtypography");
	
 	$options[] = array( "name" => "(H5) Heading Typography",
	 				"desc" => "Heading Five typography.",
	 				"id" => "h5_typography",
					"class" => "hidden",
	 				"std" => array('size' => DEFAULT_H5_SIZE, 'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => DEFAULT_HEADING_COLOR),
	 				"type" => "gtypography");
	
 	$options[] = array( "name" => "Comments area - (H3) Heading Typography",
	 				"desc" => "It will be applied ONLY on comments area.",
	 				"id" => "h3_typography_comments",
					"class" => "hidden",
	 				"std" => array('size' => DEFAULT_COMMENTS_H3_SIZE, 'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => DEFAULT_H1_COLOR),
	 				"type" => "gtypography");
	
 	$options[] = array( "name" => "Blockquote Typography",
	 				"desc" => "It will be applied ONLY on blockquotes.",
	 				"id" => "blockquote_typography",
					"class" => "hidden",
	 				"std" => array('size' => DEFAULT_BLOCKQUOTE_SIZE, 'face' => DEFAULT_QUOTE_FONT, 'style' => 'normal', 'color' => DEFAULT_QUOTE_COLOR),
	 				"type" => "gtypography");

 	$options[] = array( "name" => "Quote Typography",
	 				"desc" => "It will be applied ONLY on short inline quotes.",
	 				"id" => "quote_typography",
					"class" => "hidden",
	 				"std" => array('size' => DEFAULT_QUOTE_SIZE, 'face' => DEFAULT_QUOTE_FONT,'style' => 'normal', 'color' => DEFAULT_QUOTE_COLOR),
	 				"type" => "gtypography");
  
 	$options[] = array( "name" => "Button Font",
	 				"desc" => "It will be applied on buttons and pagination.",
	 				"id" => "button_font",
					"class" => "hidden",
	 				"std" => array('face' => DEFAULT_FONT),
	 				"type" => "gfont");
  
 	$options[] = array( "name" => "Date Box Font",
	 				"desc" => "It will be applied on date info box.",
	 				"id" => "date_font",
					"class" => "hidden",
	 				"std" => array('face' => DEFAULT_FONT),
	 				"type" => "gfont");	
  
 	$options[] = array( "name" => "Promo Line Font",
	 				"desc" => "It will be applied on promo line above content.",
	 				"id" => "promo_line_font",
					"class" => "hidden",
	 				"std" => array('face' => DEFAULT_FONT),
	 				"type" => "gfont");		
						
 	$options[] = array( "name" => "Widget Links Font",
	 				"desc" => "It will be applied on widget links in sidebar (on archive/category widget, i.e.).",
	 				"id" => "widget_link_font",
					"class" => "hidden",
	 				"std" => array('face' => 'default'),
	 				"type" => "gfont");
  
	$options[] = array( "name" => "Navigation Typography",
					"desc" => "Navigation typography.",
					"id" => "navigation_typography",
					"class" => "hidden",
					"std" => array('size' => '12px',  'face' => DEFAULT_FONT, 'style' => 'normal', 'color' => NAVIGATION_COLOR),
					"type" => "gtypography");	
				
	/****************************************************************/
	/*					COLORS AND BACKGROUNDS						*/
	/****************************************************************/
	$options[] = array( "name" => "Colors and Backgrounds",
						"type" => "heading");
						
	$options[] = array( "name" => "Link Color - Link Color Hover",
						"desc" => "Default hyperlink color.",
						"id" => "link_color_set",
						"std" => array('color1' => LINK_COLOR, 'color2' => LINK_COLOR_HOVER),
						"type" => "color2");

	$options[] = array( "name" => "Footer Link Color",
						"desc" => "Default footer hyperlink color.",
						"id" => "footer_link_color_set",
						"std" => array('color1' => FOOTER_LINK_COLOR, 'color2' => FOOTER_LINK_COLOR_HOVER),
						"type" => "color2");

	$options[] = array( "name" => "Sidebar Link Color",
						"desc" => "Default sidebar hyperlink color.",
						"id" => "sidebar_link_color_set",
						"std" => array('color1' => SIDEBAR_LINK_COLOR, 'color2' => SIDEBAR_LINK_COLOR_HOVER),
						"type" => "color2");

	$options[] = array( "name" => "Default Button",
						"desc" => "Background - Color - Hover Color<br><br>Text shadow - Border color - Inset shadow.",
						"id" => "button_color_set",
						"std" => array('color1' => BUTTON_BCKG, 'color2' => BUTTON_COLOR, 'color3' => BUTTON_COLOR, 'color4' => BUTTON_TEXT_SHADOW, 'color5' => BUTTON_BORDER, 'color6' => BUTTON_INSET_SHADOW),
						"type" => "color6");

	$options[] = array( "name" => "Pagination",
						"desc" => "Background - Color - Text shadow<br><br>Border color - Inset shadow.",
						"id" => "pagination_color_set",
						"std" => array('color1' => PAGINATION_BCKG, 'color2' => PAGINATION_COLOR, 'color3' => PAGINATION_TEXT_SHADOW, 'color4' => PAGINATION_BORDER, 'color5' => PAGINATION_INSET_SHADOW),
						"type" => "color5");

	$options[] = array( "name" => "Pagination - Active/Hover",
						"desc" => "Background - Color - Text shadow<br><br>Border color - Inset shadow.",
						"id" => "pagination_color_set_active",
						"std" => array('color1' => PAGINATION_BCKG_ACTIVE, 'color2' => PAGINATION_COLOR_ACTIVE, 'color3' => PAGINATION_TEXT_SHADOW_ACTIVE, 'color4' => PAGINATION_BORDER_ACTIVE, 'color5' => PAGINATION_INSET_SHADOW),
						"type" => "color5");

	$options[] = array( "name" => "Date Box",
						"desc" => "Color - Hover Color<br><br>Background - Background Hover (also color of titles).",
						"id" => "date_color_set",
						"std" => array('color1' => DATE_BOX_COLOR, 'color2' => DATE_BOX_COLOR_HOVER, 'color3' => DATE_BOX_BCKG, 'color4' => DATE_BOX_BCKG_HOVER),
						"type" => "color4");

	$options[] = array( "name" => "Heading Background and Border",
						"desc" => "It will be used for section titles, sidebar headings, author info, blockquote...",
						"id" => "heading_bckg_set",
						"std" => array('color1' => DEFAULT_SECTION_TITLE_BCKG_COLOR, 'color2' => DEFAULT_SECTION_TITLE_BORDER_COLOR),
						"type" => "color2");

	$options[] = array( "name" => "Main Header (text) Color",
						"desc" => "Main Header Colors.",
						"id" => "header_color",
						"std" => "#000000",
						"type" => "color");
  
	$options[] = array( "name" => "Main menu",
						"desc" => "Background - Bckg Hover - Bckg Hover 2<br><br>Border Hover - Color Hover.",
						"id" => "navigation_color_set",
						"std" => array('color1' => NAVIGATION_BCKG, 'color2' => NAVIGATION_BCKG_HOVER, 'color3' => NAVIGATION_BCKG_HOVER_COLOR2, 'color4' => NAVIGATION_BORDER_HOVER, 'color5' => NAVIGATION_COLOR_HOVER),
						"type" => "color5");
  
	$options[] = array( "name" => "Navigation Background Image",
						"desc" => "Choose background image.",
						"id" => "navigation_bckg_image",
						"class" => "mini",
						"options" => tb_use_files('/images/patterns_bckg/'),
						"type" => "select");
  
	$options[] = array( "name" => "Main menu - submenu",
						"desc" => "Background - Background Hover<br><br>Color - Color Hover.",
						"id" => "navigation_submenu_color_set",
						"std" => array('color1' => NAVIGATION_SUBMENU_BCKG, 'color2' => NAVIGATION_SUBMENU_BCKG_HOVER, 'color3' => NAVIGATION_SUBMENU_COLOR, 'color4' => NAVIGATION_SUBMENU_COLOR_HOVER),
						"type" => "color4");
  
	$options[] = array( "name" => "Show navigation ornament line",
						"desc" => "Would you like to show ornament line under navigation?",
						"id" => "show_ornament_line",
						"std" => "1",
						"type" => "checkbox");
  
	$options[] = array( "name" => "Ornament Line Background Image",
						"desc" => "Choose background image.",
						"id" => "ornament_line_bckg_image",
						"std" => PARENT_URL . '/images/patterns/default.png',
						"options" => tb_use_files('/images/patterns/'),
						"class" => "hidden mini",
						"type" => "select");
  
	$options[] = array( "name" => "Horizontal Content Spacer/Divider",
						"desc" => "Choose background image.",
						"id" => "hscontent_bckg",
						"class" => 'mini',
						"std" => PARENT_URL . '/images/dividers/divider_01.png',
						"options" => tb_use_files('/images/dividers/'),
						"type" => "select");	
  
	$options[] = array( "name" => "Show promo line",
						"desc" => "Would you like to show promo line above content?",
						"id" => "show_promo_line",
						"std" => "1",
						"type" => "checkbox");	

	$options[] = array( "name" => "Promo line background color",
						"desc" => "",
						"id" => "promo_line_bckg_color",
						"std" => PROMO_LINE_BCKG_COLOR,
						"class" => "hidden",
						"type" => "color");
  
	$percentArray = array();
	$percent = 10;
	while ($percent < 101) {
		$percentArray[$percent] = "$percent%";
		$percent += 5;
	}

	$options[] = array( "name" => "Promo line opacity",
						"desc" => "Choose opacity, please.",
						"id" => "promo_line_opacity",
						"std" => PROMO_LINE_OPACITY,
						"class" => "hidden mini",
						"options" => $percentArray,
						"type" => "select");

	$options[] = array( "name" => "Promo line colors",
						"desc" => "Color - Link Color - Link Color Hover.",
						"id" => "promo_line_colors",
						"std" => array('color1' => PROMO_LINE_COLOR, 'color2' => PROMO_LINE_LINK_COLOR, 'color3' => PROMO_LINE_LINK_COLOR_HOVER),
						"class" => "hidden",
						"type" => "color3");

	$options[] = array( "name" => "Promo line content",
						"desc" => "Keep it in one line, please.",
						"id" => "promo_line_content",
						"std" => '',
						"class" => "hidden",
						"type" => "textarea");

	$options[] = array( "name" => "Promo line icon colors",
						"desc" => "Color - Background<br>Color Hover - Background Hover.",
						"id" => "promo_line_icon_colors",
						"std" => array('color1' => PROMO_LINE_ICON_COLOR, 'color2' => PROMO_LINE_ICON_BCKG, 'color3' => PROMO_LINE_ICON_COLOR_HOVER, 'color4' => PROMO_LINE_ICON_BCKG_HOVER),
						"class" => "hidden",
						"type" => "color4");

 	$options[] = array( "name" => "Archive/Post",
						"type" => "heading");

  
	$options[] = array(
					"name" => "Show featured image",
					"desc" => "Do you want to show featured image on a single post? - it can be overriden on each single post -",
					"id" => "show_featured_image",
					"std" => "show",
					"class" => "mini",
					"type" => "select",
					"options" => array(
						'show' => 'Show',
						'hide' => 'Hide'
					)
				);

  
	$options[] = array(
					"name" => "Show previous/next post link",
					"desc" => "Do you want to show previous/next post navigation on a single post.",
					"id" => "show_previous_next_post",
					"std" => "hide",
					"class" => "mini",
					"type" => "select",
					"options" => array(
						'show' => 'Show',
						'hide' => 'Hide'
					)
				);
  
	$colorArray = array('Custom', 'White', 'Gray', 'Black', 'Light Blue', 'Blue', 'Dark Blue', 'Light Green', 'Green', 'Dark Green', 'Light Red', 'Red', 'Dark Red', 'Yellow', 'Orange', 'Brown');
	$buttonColor = array();
	foreach ($colorArray as $color) {
		$buttonColor[strtolower(str_replace(' ', '', $color))] = $color;
	}
	
	$options[] = array( "name" => "Navigation search button",
						"desc" => "Do you want to show search button in your main navigation?",
						"id" => "show_search_in_navigation",
						"std" => "hide",
						"class" => "mini",
						"type" => "select",
						"options" => array(
							'show' => 'Show',
							'hide' => 'Hide'
						)
				);

	$options[] = array( "name" => "Sermons - default sidebar",
						"desc" => "It will be used on the sermon-archive page",
						"id" => "default_sidebar_sermon",
						"std" => "default",
						"class" => 'mini',
						"options" => tb_get_custom_sidebars(0, 1),
						"type" => "select");

	$options[] = array( "name" => "Churches - default sidebar",
						"desc" => "It will be used on the church-archive page",
						"id" => "default_sidebar_church",
						"std" => "default",
						"class" => 'mini',
						"options" => tb_get_custom_sidebars(0, 1),
						"type" => "select");

	$options[] = array( "name" => "Events - default sidebar",
						"desc" => "It will be used on the event-archive page",
						"id" => "default_sidebar_event",
						"std" => "default",
						"class" => 'mini',
						"options" => tb_get_custom_sidebars(0, 1),
						"type" => "select");

	$options[] = array( "name" => "Priests - default sidebar",
						"desc" => "It will be used on the priest-archive page",
						"id" => "default_sidebar_priest",
						"std" => "default",
						"class" => 'mini',
						"options" => tb_get_custom_sidebars(0, 1),
						"type" => "select");
	

 	$options[] = array( "name" => "About",
						"type" => "heading"); 
						
	$options[] = array( "name" => "Facebook",
						"desc" => "URL of your account.",
						"id" => "social_link_facebook",
						"type" => "text"); 
						
	$options[] = array( "name" => "Twitter",
						"desc" => "URL of your account.",
						"id" => "social_link_twitter",
						"type" => "text"); 
						
	$options[] = array( "name" => "Google+",
						"desc" => "URL of your account.",
						"id" => "social_link_google_plus",
						"type" => "text");  
						
	$options[] = array( "name" => "Instagram",
						"desc" => "URL of your account.",
						"id" => "social_link_instagram",
						"type" => "text"); 
						
	$options[] = array( "name" => "Tumblr",
						"desc" => "URL of your account.",
						"id" => "social_link_tumblr",
						"type" => "text"); 
						
	$options[] = array( "name" => "Pinterest",
						"desc" => "URL of your account.",
						"id" => "social_link_pinterest",
						"type" => "text"); 
						
	$options[] = array( "name" => "Picassa",
						"desc" => "URL of your account.",
						"id" => "social_link_picassa",
						"type" => "text"); 
						
	$options[] = array( "name" => "Flickr",
						"desc" => "URL of your account.",
						"id" => "social_link_flickr",
						"type" => "text"); 
						
	$options[] = array( "name" => "Youtube",
						"desc" => "URL of your account.",
						"id" => "social_link_youtube",
						"type" => "text"); 
						
	$options[] = array( "name" => "Vimeo",
						"desc" => "URL of your account.",
						"id" => "social_link_vimeo",
						"type" => "text"); 
						
	$options[] = array( "name" => "DeviantART",
						"desc" => "URL of your account.",
						"id" => "social_link_deviantart",
						"type" => "text"); 
						
	$options[] = array( "name" => "Forrst",
						"desc" => "URL of your account.",
						"id" => "social_link_forrst",
						"type" => "text");  
						
	$options[] = array( "name" => "Email",
						"desc" => "Valid email address, please.",
						"id" => "social_link_email",
						"type" => "text"); 
						
	$options[] = array( "name" => "Phone Number",
						"desc" => "",
						"id" => "social_link_phone",
						"type" => "text"); 

 	$options[] = array( "name" => "Pages",
						"type" => "heading");
  
	$options[] = array( "name" => "Listen Audio",
						"desc" => "It contains only player - Page Template: Listen Audio",
						"id" => "_tb_listen_audio",
						"std" => "0",
						"type" => "select",
						"options" => tb_get_pages("page", "options"));

	$options[] = array( "name" => "Priests Page",
						"desc" => "Priests Listing",
						"id" => "_tb_priests_listing",
						"std" => "0",
						"type" => "select",
						"options" => tb_get_pages("page", "options"));

	$options[] = array( "name" => "Events Page",
						"desc" => "Events Listing",
						"id" => "_tb_events_listing",
						"std" => "0",
						"type" => "select",
						"options" => tb_get_pages("page", "options"));

	$options[] = array( "name" => "Sermons Page",
						"desc" => "Sermons Listing",
						"id" => "_tb_sermons_listing",
						"std" => "0",
						"type" => "select",
						"options" => tb_get_pages("page", "options"));

	return $options;
}

?>