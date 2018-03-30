<?php
/**
 * This file contains all the functionality for the additional meta boxes for the pages and posts.
 * It contains functions for loading the meta data into arrays, displaying the meta boxes and
 * saving the meta data.
 *
 */

/**
 * ADD THE ACTIONS
 */
add_action('admin_menu', 'designare_load_meta_boxes');
add_action('admin_menu', 'create_meta_box');  
add_action('admin_menu', 'create_meta_post_box');  
add_action('admin_menu', 'create_meta_portfolio_box'); 
add_action('admin_menu', 'create_meta_testimonials_box');  
add_action('admin_menu', 'create_meta_partners_box');
add_action('admin_menu', 'create_meta_team_box');
add_action('save_post', 'save_postdata');  
add_action('save_post', 'save_post_postdata');  
add_action('save_post', 'save_portfolio_postdata'); 
add_action('save_post', 'save_testimonials_postdata');
add_action('save_post', 'save_partners_postdata');
add_action('save_post', 'save_team_postdata');
add_action('admin_footer','print_helper');

if (isset($_REQUEST['file'])) { 
    //check_admin_referer("des_gallery_options");
    $options = get_option('des_gallery_options', TRUE);
    $options['default_image'] = absint($_REQUEST['file']) ? absint($_REQUEST['file']) : "";
    update_option('des_gallery_options', $options);
}

function get_des_templates($type){
	global $wpdb, $table_prefix;
	$q = "SELECT * from ".$wpdb->prefix."options WHERE option_name LIKE 'des_template_[$type]_%'";
	$res = $wpdb->get_results($q, ARRAY_A);
	$output = array();
	foreach($res as $r){
		$options = $r['option_value'];
		while( gettype($options) === "string" ){
			$options = unserialize(trim($options));
		}
		$options = $options['des_template_tab'];
		array_push($output, array("id"=>$options['name'], "name"=>$options['nicename']));
	}
	return $output;
}

function designare_load_meta_boxes(){
	//load the porftfolio categeories
	$sidebar_taxonomies=designare_get_custom_sidebars();
	$sidebar_categories=array(array('id'=>'none', 'name'=>'No Sidebar'), array('id'=>'sidebar-widgets', 'name'=>'Default Sidebar'));

	$sides = get_option('des_sidebar_name_names');
	$sides = explode(DESIGNARE_SEPARATOR, $sides);
	$outputsidebars = array();
	foreach ($sides as $s){
		if ($s != ""){
			array_push($outputsidebars, array("id"=>$s, "name"=>$s));
		}
	}
	
	foreach($sidebar_taxonomies as $taxonomy){
		$sidebar_categories[]=array("name"=>$taxonomy, "id"=>convert_to_class($taxonomy));
	}
	
	//load the porftfolio categeories
	$portf_taxonomies=designare_get_taxonomies('portfolio_type');
	$portf_categories=array(array('id'=>'all', 'name'=>'All Portfolios'));

	foreach($portf_taxonomies as $taxonomy){
		$portf_categories[]=array("name"=>$taxonomy->name, "id"=>$taxonomy->slug);
	}

	global $designare_data, $designare_new_meta_boxes, $designare_new_meta_portfolio_boxes, $new_meta_testimonials_boxes, $designare_new_meta_post_boxes, $new_meta_partners_boxes, $new_meta_team_boxes, $designare_new_meta_box_des_templater;
	
		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE PAGES
		 * ------------------------------------------------------------------------*/
	
	
		 if (get_option(DESIGNARE_SHORTNAME."_body_type") == "pattern") $varType = DESIGNARE_PATTERNS_URL.get_option(DESIGNARE_SHORTNAME."_body_pattern");
		 else $varType =  get_option(DESIGNARE_SHORTNAME."_header_body_pattern");
	
		//the meta data for pages
		$designare_new_meta_boxes =
		array(

			array(
				"title" => "Secondary Title",
				"name" => "secondaryTitle",
				"type" => "text",
				"std" => "",
				"description" => "If set, will display a second title below the main one. If you need to use classes use <strong style=\"font-style:normal;\">'</strong> instead of <strong style=\"font-style:normal;\">\"</strong>. You can also use <strong style=\"font-style:normal;\">br</strong> tags."
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Homepage Settings - available only for Homepage page templates',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Main Slider",
				"name" => "homepageslider",
				"std" => "",
				"type" => "select",
				"options" => designare_get_created_camera_sliders(),
				"description" => 'Choose one of your previously created sliders.'
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Portfolio Settings - available only for Portfolio page templates',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
	
			array(
				"name" => "postCategory",
				"title" => "Display items from portfolio",
				"type" => "select",
				"none" => true,
				"options" => $portf_categories,
				"std" => '-1',
				"description" => 'If "All Portfolios" selected, all the Portfolio items will be displayed. If another portfolio is selected, only the their items will be displayed.'
			),
			
			array(
				"title" => "Order Projects by",
				"name" => "orderby",
				"type" => "select",
				"options" => array(array("name"=>"Date - ASC", "id"=>"date_ASC"), array("name"=>"Date - DESC", "id"=>"date_DESC"), array("name"=>"Title - ASC", "id"=>"title_ASC"), array("name"=>"Title - DESC", "id"=>"title_DESC")),
				"description" => ""
			),		
	
			array(
				"name" => "column_number",
				"title" => "Number of columns",
				"type" => "select",
				"options" => array(array("name"=>"Two Columns", "id"=>"eight columns"),
				array("name"=>"Three Columns", "id"=>"one-third column"),
				array("name"=>"Four Columns", "id"=>"four columns")),
				"std" => 'four columns',
				"description" => ""
			),
			
			array(
				"name" => "postEfect",
				"title" => "Filter Efect",
				"type" => "select",
				"options" => array(array("name"=>"Opacity", "id"=>"opacity"),
				array("name"=>"Quicksand", "id"=>"quicksand")),
				"std" => 'opacity',
				"description" => ""
			),
			
			array(
				"title" => "<div class='ui-icon ui-icon-image no_show_hide_opts'></div>Fullwidth Google Map - Only available on template-contacts pages",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"name" => "googleLat",
				"title" => "Latitude",
				"description" => "Ex: 38.706932",
				"type" => "text",
				"std" => ""
			),
			
			array(
				"name" => "googleLong",
				"title" => "Longitude",
				"description" => "Ex: -9.135632",
				"type" => "text",
				"std" => ""
			),
			
			array(
				"name" => "mapHeight",
				"title" => "Map Height",
				"description" => "Ex: 300px",
				"type" => "text",
				"std" => ""
			),
		
			array(
				"title" => "Enable Custom Header Style Type",
				"name" => "des_custom_header_style",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Header Style Type",
				"name" => "headerStyleType",
				"type" => "select",
				"options" => array(array('id'=>'style1','name'=>'Style 1'), array('id'=>'style2', 'name'=>'Style 2'), array('id'=>'style3', 'name'=>'Style 3'), array('id'=>'style4', 'name'=>'Style 4')),
				"std" => get_option(DESIGNARE_SHORTNAME."_header_style_type"),
				"description" => "You can see a preview of the different header types on <strong>Appearance > Smartbox Options > Style Options > Header</strong>"
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Breadcrumbs',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Enable Custom Breadcrumbs",
				"name" => "des_custom_breadcrumbs",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Breadcrumbs",
				"name" => "breadcrumbs",
				"type" => "select",
				"options" => array(array('id'=>'on', 'name'=>'Yes'), array('id'=>'off', 'name'=>'No')),
				"std" => get_option(DESIGNARE_SHORTNAME."_breadcrumbs"),
				"description" => ""
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Newsletter',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Enable Custom Newsletter",
				"name" => "des_custom_newsletter",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Display Subscription Form on Pages",
				"name" => "newsletterEnabled",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"on"), array("name"=>"No", "id"=>"off")),
				"std" => get_option(DESIGNARE_SHORTNAME."_newsletter_enabled"),
			),
			
			array(
				"title" => "",
				"name" => "sidebar_for_default",
				"type" => "select",
				"options" => array(array("id"=>"none", "name" => "none"), array("id"=>"left", "name" => "left"), array("id"=>"right", "name" => "right")),
				"std" => "none"
			),
			
			array(
				"title" => "Choose your Sidebar",
				"name" => "sidebars_available",
				"type" => "select",
				"options" => $outputsidebars
			),
						
		);


		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE POSTS - POST_TYPES
		 * ------------------------------------------------------------------------*/

		$designare_new_meta_post_boxes =
		array(
		
			array(
				"title" => "Secondary Title",
				"name" => "secondaryTitle",
				"type" => "text",
				"std" => "",
				"description" => "If set, will display a second title below the main one."
			),
				
			array(
				"title" => "Post Type",
				"name" => "posttype",
				"std" => "text",
				"type" => "select",
				"options" => array(array('id'=> 'image', 'name'=> 'Featured Image'), array('id'=>'slider', 'name'=>'Images Slider'), array('id'=>'video', 'name'=>'Video'), array('id'=>'audio', 'name'=>'Audio'), array('id'=>'text', 'name'=>'Text'), array('id'=>'none', 'name'=>'None')),
				"description" => 'You can choose from the following five post types: Featured Image, Slider, Video, Audio, Text or None.'
			),
			
			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Images Slider",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
			
			array(
				"title"=> "Add Images",
				"name"=> "sliderImages",
				"type"=> "mediaupload"
			),
			
			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Video",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
			
			array(
				"title"=> "Video Source",
				"name"=> "videoSource",
				"type"=> "select",
				"options" => array(array("id"=>"youtube", "name"=>"Youtube"), array("id"=>"vimeo","name"=>"Vimeo"))
			),
			
			array(
				"title"=>"Video Code",
				"name"=>"videoCode",
				"type"=>"textarea",
				"description"=> "Paste <strong> just the ID of the video</strong> (E.g. http://www.youtube.com/watch?<strong>I83Xp7itj8c</strong>) you want to show, or insert own Embed Code. <br>If you need to show more than one video just paste de IDs separated by comas [ <strong>,</strong> ].<br>"
			),
			
			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Audio",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
			
			array(
				"title"=>"Audio Code",
				"name"=>"audioCode",
				"type"=>"textarea",
				"description"=> "Paste the Embed Code. <br>"
			),
						
			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Thumbnail Gallery",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
			
			array(
				"title"=> "Add Thumbnail Gallery",
				"name"=> "thumb_gallery",
				"type"=> "select",
				"options" => array()
			),
			
			array(
				"title" => "Sidebar",
				"name" => "sidebar",
				"std" => "right",
				"type" => "select",
				"options" => array(array('id'=>'left', 'name' => 'Left Sidebar'), array('id'=>'right', 'name' => 'Right Sidebar'), array('id'=>'none', 'name' => 'Without Sidebar (Full-Width)')),
				"description" => 'Place your sidebar to the left, to the right or without sidebar (full-width).'
			),
			
			array(
				"title" => "Enable Custom Header Style Type",
				"name" => "des_custom_header_style",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Header Style Type",
				"name" => "headerStyleType",
				"type" => "select",
				"options" => array(array('id'=>'style1','name'=>'Style 1'), array('id'=>'style2', 'name'=>'Style 2'), array('id'=>'style3', 'name'=>'Style 3'), array('id'=>'style4', 'name'=>'Style 4')),
				"std" => get_option(DESIGNARE_SHORTNAME."_header_style_type"),
				"description" => "You can see a preview of the different header types on <strong>Appearance > Smartbox Options > Style Options > Header</strong>"
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Breadcrumbs',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Enable Custom Breadcrumbs",
				"name" => "des_custom_breadcrumbs",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Breadcrumbs",
				"name" => "breadcrumbs",
				"type" => "select",
				"options" => array(array('id'=>'on', 'name'=>'Yes'), array('id'=>'off', 'name'=>'No')),
				"std" => get_option(DESIGNARE_SHORTNAME."_breadcrumbs"),
				"description" => ""
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Newsletter',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Enable Custom Newsletter",
				"name" => "des_custom_newsletter",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Display Subscription Form on Pages",
				"name" => "newsletterEnabled",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"on"), array("name"=>"No", "id"=>"off")),
				"std" => get_option(DESIGNARE_SHORTNAME."_newsletter_enabled"),
			)
			
		);


		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE PORTFOLIO POSTS
		 * ------------------------------------------------------------------------*/

		$designare_new_meta_portfolio_boxes =
		array(
		
			
			array(
				"title" => "Secondary Title",
				"name" => "secondaryTitle",
				"type" => "text",
				"std" => "",
				"description" => "If set, will display a second title below the main one."
			),
			
			array(
				"title" => "Thumbnail Hover Option",
				"name" => "thumbnailHoverOption",
				"type" => "select",
				"options" => array(array("id"=>"default", "name"=>"Default"),array("id"=>"link_magnifier","name"=>"Link + Magnifier"), array("id"=>"magnifier", "name"=>"Magnifier"), array("id"=>"link", "name"=>"Link"), array("id"=>"none", "name"=>"None")),
				"description"=>"If set to <strong>Default</strong> the hover on this Project's Thumbnail will be displayed as defined on the Panel Options > General > Projects.",
				"std" => "default"
			),
			
			array(
				"title" => "Project - Page Layout",
				"name" => "singleLayout",
				"type" => "select",
				"options" => array(array('id'=>'default','name'=>'Default'), array('id'=>'left_slider', 'name'=>'Left Slider'),array('id'=>'full_slider', 'name'=>'Full Slider'), array('id'=>'fullwidth_slider', 'name'=>'Full Width Slider')),
				"std" => "default",
				"description"=>"If set to <strong>Default</strong> the Project will be displayed as defined on the Panel Options > General > Projects."
			),

			
			array(
				"title" => "Portfolio Type",
				"name" => "portfolioType",
				"type" => "select",
				"options" => array(array("id"=>"image", "name"=>"Slider Images"),array("id"=>"video", "name"=>"Video"), array("id"=>"other", "name"=>"Other"))
			),

			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Slider Images",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
		
			array(
				"title"=> "Add Slider Image",
				"name"=> "sliderImages",
				"type"=> "mediaupload"
			),
			
			array(
				"title" => "Custom Flex Slider Options",
				"name" => "custom_slider_opts",
				"type" => "select",
				"options" => array(array("id"=>"on", "name"=>"ON"),array("id"=>"off","name"=>"OFF")),
				"description"=>"If set to <strong>ON</strong> this options will override the ones on the Panel Options > Slider Settings > Flex Slider > General > Projects.",
				"std" => "off"
			),
			
			array(
				"title" => "Show Direction Controls",
				"name" => "projs_flex_navigation",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_navigation"),
				"description" => ""
			),
		
			array(
				"title" => "Show Controls",
				"name" => "projs_flex_controls",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_controls"),
				"description" => ""
			),
			
			array(
				"title" => "Transition Effect",
				"name" => "projs_flex_transition",
				"type" => "select",
				"options" => array(array("name"=>"Slide", "id"=>"slide"), array("name"=>"Fade", "id"=>"fade")),
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_transition"),
				"description" => ""
			),
			
			array(
				"title" => "Transition Duration",
				"name" => "projs_flex_transition_duration",
				"type" => "text",
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_transition_duration"),
				"description" => "The duration of the transition between slides."
			),
			
			array(
				"title" => "Slide Duration",
				"name" => "projs_flex_slide_duration",
				"type" => "text",
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_slide_duration"),
				"description" => "The duration of each slide"
			),
			
			array(
				"title" => "Autoplay",
				"name" => "projs_flex_autoplay",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_autoplay"),
				"description" => ""
			),
			
			array(
				"title" => "Pause on Hover",
				"name" => "projs_flex_pause_hover",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"true"), array("name"=>"No", "id"=>"false")),
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_pause_hover"),
				"description" => "Play/Pause on mouse out/over"
			),
			
			array(
				"title" => "Slider Height",
				"name" => "projs_flex_height",
				"type" => "text",
				"std" => get_option(DESIGNARE_SHORTNAME."_projs_flex_height"),
				"description" => "The height of the slider."
			),
			
			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Video",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
			
			array(
				"title"=> "Video Source",
				"name"=> "videoSource",
				"type"=> "select",
				"options" => array(array("id"=>"youtube", "name"=>"Youtube"), array("id"=>"vimeo","name"=>"Vimeo"), array("id"=>"embed","name"=>"Embed"))
			),
			
			array(
				"title"=>"Video Code",
				"name"=>"videoCode",
				"type"=>"textarea",
				"description"=> "Paste <strong> just the ID of the video</strong> (E.g. http://www.youtube.com/watch?<strong>I83Xp7itj8c</strong>) you want to show, or insert own Embed Code. <br>If you need to show more than one video just paste de IDs separated by comas [ <strong>,</strong> ].<br>You can also insert your Audio Embed Code.<br><br><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.</p>"
			),
			
			array(
				"title" => "<div class='ui-icon ui-icon-image show_hide_opts'></div>Thumbnail Gallery",
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => "",
			),
			
			array(
				"title"=> "Add Thumbnail Gallery",
				"name"=> "thumb_gallery",
				"type"=> "select",
				"options" => array()
			),
			
			
			array(
				"title" => "Enable Custom Header Style Type",
				"name" => "des_custom_header_style",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Header Style Type",
				"name" => "headerStyleType",
				"type" => "select",
				"options" => array(array('id'=>'style1','name'=>'Style 1'), array('id'=>'style2', 'name'=>'Style 2'), array('id'=>'style3', 'name'=>'Style 3'), array('id'=>'style4', 'name'=>'Style 4')),
				"std" => get_option(DESIGNARE_SHORTNAME."_header_style_type"),
				"description" => "You can see a preview of the different header types on <strong>Appearance > Smartbox Options > Style Options > Header</strong>"
			),
						
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Breadcrumbs',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Enable Custom Breadcrumbs",
				"name" => "des_custom_breadcrumbs",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Breadcrumbs",
				"name" => "breadcrumbs",
				"type" => "select",
				"options" => array(array('id'=>'on', 'name'=>'Yes'), array('id'=>'off', 'name'=>'No')),
				"std" => get_option(DESIGNARE_SHORTNAME."_breadcrumbs"),
				"description" => ""
			),
			
			array(
				"title" => '<div class="ui-icon ui-icon-image no_show_hide_opts"></div>Newsletter',
				"type" => "heading",
				"name" => "",
				"std" => "",
				"description" => ""
			),
			
			array(
				"title" => "Enable Custom Newsletter",
				"name" => "des_custom_newsletter",
				"type" => "select",
				"description" => "If set to ON this options will override the ones from the panel.",
				"options" => array(array("id"=>"off", "name" => "OFF"), array("id"=>"on", "name" => "ON")),
				"std" => 'off'
			),
			
			array(
				"title" => "Display Subscription Form on Pages",
				"name" => "newsletterEnabled",
				"type" => "select",
				"options" => array(array("name"=>"Yes", "id"=>"on"), array("name"=>"No", "id"=>"off")),
				"std" => get_option(DESIGNARE_SHORTNAME."_newsletter_enabled"),
			)
		
		);
		
		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE TESTIMONIALS POSTS
		 * ------------------------------------------------------------------------*/

		$new_meta_testimonials_boxes =
		array(

			array(
				"title" => "Testimonial Author",
				"name" => "author",
				"std" => "",
				"type" => "text",
				"description" => 'Enter the name of the testimonial author.'
			),
			
			array(
				"title" => "Author HyperLink",
				"name" => "author_link",
				"std" => "",
				"type" => "text",
				"description" => 'Optional author hyperlink.'
			),


			array(
				"title" => "Testimonial Author Company",
				"name" => "company",
				"std" => "",
				"type" => "text",
				"description" => 'Enter the company\'s name of the testimonial author.'
			),

			array(
				"title" => "Compny HyperLink",
				"name" => "company_link",
				"std" => "",
				"type" => "text",
				"description" => 'Optional company hyperlink.'
			),
		
		);
		
		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE PARTNERS POSTS
		 * ------------------------------------------------------------------------*/

		$new_meta_partners_boxes =
		array(

			array(
				"title" => "Partners Hyperlink",
				"name" => "link",
				"std" => "",
				"type" => "text",
				"description" => 'Enter the Hyperlink to your Partner\'s website. Paste the entire URL \'http://\' included.'
			)
		
		);


		/* ------------------------------------------------------------------------*
		 * META BOXES FOR THE TEAM POSTS
		 * ------------------------------------------------------------------------*/

		$new_meta_team_boxes =
		array();

		/* meta box for the des_templater */
		$designare_new_meta_box_des_templater =
		array(
			
			array(
				"title" => "Load Template - General ?",
				"name" => "enable_general_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - General",
				"name" => "load_general_template",
				"type" => "select",
				"options" => get_des_templates('general'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			),
			
			array(
				"title" => "Load Template - Body ?",
				"name" => "enable_body_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - Body",
				"name" => "load_body_template",
				"type" => "select",
				"options" => get_des_templates('body'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			),
			
			array(
				"title" => "Load Template - Header & Top Contents ?",
				"name" => "enable_header_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - Header & Top Contents",
				"name" => "load_header_template",
				"type" => "select",
				"options" => get_des_templates('header'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			),
			
			array(
				"title" => "Load Template - Menu ?",
				"name" => "enable_menu_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - Menu",
				"name" => "load_menu_template",
				"type" => "select",
				"options" => get_des_templates('menu'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			),
			
			array(
				"title" => "Load Template - Page Title ?",
				"name" => "enable_pagetitle_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - Page Title",
				"name" => "load_pagetitle_template",
				"type" => "select",
				"options" => get_des_templates('pagetitle'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			),
			
			array(
				"title" => "Load Template - Footer ?",
				"name" => "enable_footer_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - Footer",
				"name" => "load_footer_template",
				"type" => "select",
				"options" => get_des_templates('footer'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			),
			
			array(
				"title" => "Load Template - Typography ?",
				"name" => "enable_text_template",
				"type" => "select",
				"options" => array(array("id"=>"yes", "name"=>"YES"), array("id"=>"no", "name"=>"NO")),
				"description" => "If set to NO the page will be styled by the current Panel Style Options.",
				"std" => "no"
			),
			
			array(
				"title" => "Select Template - Typography",
				"name" => "load_text_template",
				"type" => "select",
				"options" => get_des_templates('text'),
				"description" => "You can add / edit / remove your templates in the Theme Options > Style Editor."
			)
			
		);
}

/**
 * Creates a page meta box.
 */
function create_meta_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-box-des-templater', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' DESIGNARE TEMPLATER', 'designare_new_meta_box_des_templater', 'page', 'normal', 'high' );
		add_meta_box( 'new-meta-boxes', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' PAGE SETTINGS', 'designare_new_meta_boxes', 'page', 'normal', 'high' );
	}
}

/**
 * Creates a post meta box.
 */
function create_meta_post_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-box-des-templater', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' DESIGNARE TEMPLATER', 'designare_new_meta_box_des_templater', 'post', 'normal', 'high' );
		add_meta_box( 'new-meta-post-boxes', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' POST TYPE SETTINGS', 'designare_new_meta_post_boxes', 'post', 'normal', 'high' );
	}
}


/**
 * Creates a post meta box.
 */
function create_meta_portfolio_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-box-des-templater', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' DESIGNARE TEMPLATER', 'designare_new_meta_box_des_templater', DESIGNARE_PORTFOLIO_POST_TYPE, 'normal', 'high' );
		add_meta_box( 'new-meta-portfolio-boxes', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' PORTFOLIO ITEM SETTINGS', 'designare_new_meta_portfolio_boxes', DESIGNARE_PORTFOLIO_POST_TYPE, 'normal', 'high' );
	}
}

/**
 * Creates a testimonials meta box.
 */
function create_meta_testimonials_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-testimonials-boxes', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' TESTIMONIALS ITEM SETTINGS', 'new_meta_testimonials_boxes', DESIGNARE_TESTIMONIALS_POST_TYPE, 'normal', 'high' );
	}
}

/**
 * Creates a partners meta box.
 */
function create_meta_partners_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box( 'new-meta-partners-boxes', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' PARTNERS ITEM SETTINGS', 'new_meta_partners_boxes', DESIGNARE_PARTNERS_POST_TYPE, 'normal', 'high' );
	}
}

function create_meta_team_box() {
	if ( function_exists('add_meta_box') ) {
		//add_meta_box( 'new-meta-team-boxes', '<div class="icon-small"></div> '.DESIGNARE_THEMENAME.' TEAM ITEM SETTINGS', 'new_meta_team_boxes', DESIGNARE_TEAM_POST_TYPE, 'normal', 'high' );
	}
}


/**
 * Calls the print method for page meta boxes.
 */
function designare_new_meta_boxes() {
	global $post, $designare_new_meta_boxes;

	foreach($designare_new_meta_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

function designare_new_meta_box_des_templater() {
	global $post, $designare_new_meta_box_des_templater;

	foreach($designare_new_meta_box_des_templater as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for post meta boxes.
 */
function designare_new_meta_post_boxes() {
	global $post, $designare_new_meta_post_boxes;

	foreach($designare_new_meta_post_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for portfolio meta boxes.
 */
function designare_new_meta_portfolio_boxes() {
	global $post, $designare_new_meta_portfolio_boxes;

	foreach($designare_new_meta_portfolio_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for portfolio meta boxes.
 */
function new_meta_testimonials_boxes() {
	global $post, $new_meta_testimonials_boxes;

	foreach($new_meta_testimonials_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for partners meta boxes.
 */
function new_meta_partners_boxes() {
	global $post, $new_meta_partners_boxes;

	foreach($new_meta_partners_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Calls the print method for partners meta boxes.
 */
function new_meta_team_boxes() {
	global $post, $new_meta_team_boxes;

	foreach($new_meta_team_boxes as $meta_box) {
		print_meta_box($meta_box, $post);
	}
}

/**
 * Prints the meta box
 * @param $meta_box the meta box to be printed
 * @param $post the post to contain the meta box
 */
function print_meta_box($meta_box, $post){
	
	$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

	if($meta_box_value == ""){
		if (isset($meta_box['std']))
			$meta_box_value = $meta_box['std'];
		else $meta_box_value = "";
	}


	switch($meta_box['type']){
		case 'heading':
			echo'<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
<h4>'.$meta_box['title'].'</h4></div>';
			break;
		case 'text':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" class="option-input"/><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
			
		case 'color':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<labe>#</label><input type="text" style="width: 100px; background: #'.$meta_box_value.'" id="'.$meta_box['name'].'" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" class="option-input"/><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			
			echo '<script type="text/javascript">jQuery(document).ready(function($){
				$("#'.$meta_box['name'].'").ColorPicker({
					onSubmit: function(hsb, hex, rgb, el) {
						$(el).val(hex);
						$(el).css("background", "#"+hex);
						$(el).ColorPickerHide();
					},
					onBeforeShow: function () {
						$(this).ColorPickerSetColor(this.value);
					},
					onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
					}
				})
				.bind("keyup", function(){
					$(this).ColorPickerSetColor(this.value);
				});
			});</script>'; 
			break;
		case 'upload':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" id="designare-'.$meta_box['name'].'" class="option-input upload"/>';

			echo '<div id="designare-'.$meta_box['name'].'_button" class="upload-button upload-logo" ><a class="button button-upload"><span>Upload</span></a></div><br/>';

			//call the script for this upload button particularly
			echo '<script type="text/javascript">jQuery(document).ready(function($){
				designareOptions.loadUploader(jQuery("div#designare-'.$meta_box['name'].'_button"), "'.DESIGNARE_UTILS_URL.'upload-handler.php", "'.DESIGNARE_UPLOADS_URL.'");
			});</script>'; 
			
			echo '<ul><li><img src="' . $meta_box_value . '" width="200px"></li></ul>';
				
			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
			
		case 'textarea':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<textarea name="'.$meta_box['name'].'_value" class="option-textarea" />'.$meta_box_value.'</textarea><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
		case 'select':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';
			echo '<select name="'.$meta_box['name'].'_value" id="'.$meta_box['name'].'_value">';

				
			if(sizeof($meta_box['options'])>0){
				foreach ($meta_box['options'] as $option) { ?>
					<option
					<?php if ( $meta_box_value == $option['id']) {
						echo ' selected="selected"';
					}
					if ($option['id']=='disabled') {
						echo ' disabled="disabled"';
					}
					
					if (isset($option['class'])){
						if ($option['class']!=null) {
							echo ' class="'.$option['class'].'"';
						}
					}
					?>
						value="<?php echo($option['id']);?>"><?php echo $option['name']; ?></option>
					<?php

				}
			}
			echo '</select>';
			if (isset($meta_box['description']))
				echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;
			
		case 'textarea':
			echo '<div class="option-container">';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

			echo'<h4 class="page-option-title">'.$meta_box['title'].'</h4>';

			echo'<textarea name="'.$meta_box['name'].'_value" class="option-textarea" />'.$meta_box_value.'</textarea><br />';

			echo'<span class="option-description">'.$meta_box['description'].'</span>';
			echo '</div>';
			break;	
			
		
		case 'mediaupload':
		
			echo '<div class="option-container">';
			?>
			<h4 class="page-option-title"><?php echo $meta_box['title']; ?></h4>
			<div class="description" style="margin-bottom:10px;">
				<strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.
			</div>
			<?php echo '<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />'; ?>
			<div class="thumb_slides_container" style="position:relative;float:left;width:100%;clear:both;padding-bottom:40px;"></div>
			<div class="uploader">
			  <textarea type="textarea" name="<?php echo $meta_box['name']."_value" ?>" id="_slider_images" style="display:none;"><?php echo $meta_box_value; ?></textarea>
			  <input class="button buttonUploader" name="_slider_images_button" id="_slider_images_button" value="Insert Images" style="width:auto;text-align:center;"/>
			</div>
			
			<script type="text/javascript">
				jQuery(document).ready(function($){
								
				  var _custom_media = true,
				      _orig_send_attachment = wp.media.editor.send.attachment;
				  
				  var thumbs = jQuery('#_slider_images').val().split('|*|');
				  for (var i = 0; i < thumbs.length; i++){
					  if (thumbs[i] != ""){
						  var url = thumbs[i].split("|!|")[1];
						  var id = thumbs[i].split("|!|")[0];
						  jQuery('.thumb_slides_container').append('<div class="thumb_cont elem-'+id+'" style="border: 4px solid #ededed;position:relative;display:inline-block;float:left;width:160px;height:145px;margin:5px;cursor: move;"><img src='+url+' style="width:100%;height:100%;" /><a href="post.php?post='+id+'&action=edit" style="position:absolute;top:5px;right:35px;width:26px;height:23px;background:url(<?php echo get_template_directory_uri(); ?>/img/admin-edit-icon.png) no-repeat;cursor:pointer;" title="Edit Image" class="editImage" target="_blank"></a><a title="Delete Image" class="removeImage" style="position:absolute;top:5px;right:5px;width:26px;height:23px;background:url(<?php echo get_template_directory_uri(); ?>/img/admin-delete-icon.png) no-repeat;cursor:pointer;" onclick="jQuery(this).parent(\'.thumb_cont\').remove(); var newVal = jQuery(\'#_slider_images\').val(); newVal = newVal.replace(\''+id+'|!|'+url+'|*|\', \'\'); jQuery(\'#_slider_images\').val(newVal);" ></a></div>');
					  }
				  }
				  
				  jQuery('.thumb_slides_container').sortable({
				  	placeholder: '.thumb_slides_container',
				  	items: 'div.thumb_cont',
				  	dropOnEmpty: true,
				  	forceHelperSize: true,
				  	appendTo: "parent",
				  	start: function(event,ui){
					  	ui.item.css({
						  	'transition': 'none',
							'-webkit-transition': 'none',
							'-moz-transition': 'none',
							'-ms-transition': 'none',
							'-o-transition': 'none'
					  	});
				  	},
					stop: function(event,ui){
						var newVal = "";
						jQuery('.thumb_slides_container .thumb_cont').each(function(){
							newVal += jQuery(this).attr('class').split('thumb_cont elem-')[1] + '|!|' + jQuery(this).find('img').attr('src') + '|*|';
						});
						jQuery('#_slider_images').val(newVal);
					}
				  });
				  
				  
				  $('.buttonUploader').click(function(e) {
				    var send_attachment_bkp = wp.media.editor.send.attachment;
				    var button = $(this);
				    var id = button.attr('id').replace('_button', '');
				    _custom_media = true;
				    wp.media.editor.send.attachment = function(props, attachment){
				    	jQuery('.thumb_slides_container').append('<div class="thumb_cont elem-'+attachment.id+'" style="border: 4px solid #ededed;position:relative;display:inline-block;float:left;width:160px;height:145px;margin:5px;cursor: move;"><img src='+attachment.url+' style="width:100%;height:100%;" /><a href="post.php?post='+attachment.id+'&action=edit" style="position:absolute;top:5px;right:35px;width:26px;height:23px;background:url(<?php echo get_template_directory_uri(); ?>/img/admin-edit-icon.png) no-repeat;cursor:pointer;" title="Edit Image" class="editImage" target="_blank"></a><a title="Delete Image" class="removeImage" style="position:absolute;top:5px;right:5px;width:26px;height:23px;background:url(<?php echo get_template_directory_uri(); ?>/img/admin-delete-icon.png) no-repeat;cursor:pointer;" onclick="jQuery(this).parent(\'.thumb_cont\').remove(); var newVal = jQuery(\'#_slider_images\').val(); newVal = newVal.replace(\''+attachment.id+'|!|'+attachment.url+'|*|\', \'\'); jQuery(\'#_slider_images\').val(newVal);" ></a></div>');
				      if ( _custom_media ) {
				        jQuery("#"+id).val(jQuery("#"+id).val() + attachment.id + "|!|" + attachment.url + "|*|");
				      } else {
				        return _orig_send_attachment.apply( this, [props, attachment] );
				      };
				    }
				
				    wp.media.editor.open(button);
				    return false;
				  });
				
				  $('.add_media').on('click', function(){
				    _custom_media = false;
				  });
				});
				
				
			</script>
			
			<?php
			echo "</div>";
			break;
	}
}


/**
 * Saves the meta box content of a page
 * @param $post_id the ID of the page that contains the meta box
 */
function save_postdata( $post_id ) {
	global $post, $designare_new_meta_boxes;

	if(get_post($post_id)->post_type=='page'){
		$designare_new_meta_boxes=$GLOBALS['designare_new_meta_boxes'];
		designare_save_meta_data($designare_new_meta_boxes, $post_id);
		$designare_new_meta_box_des_templater=$GLOBALS['designare_new_meta_box_des_templater'];
		designare_save_meta_data($designare_new_meta_box_des_templater, $post_id);
	}
}

function save_des_templater( $post_id ) {
	global $post, $designare_new_meta_box_des_templater;

	if(get_post($post_id)->post_type=='page'){
		$designare_new_meta_box_des_templater=$GLOBALS['designare_new_meta_box_des_templater'];
		designare_save_meta_data($designare_new_meta_box_des_templater, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_portfolio_postdata( $post_id ) {
	global $post, $designare_new_meta_portfolio_boxes;
	
	if(get_post($post_id)->post_type==DESIGNARE_PORTFOLIO_POST_TYPE){
		designare_save_meta_data($designare_new_meta_portfolio_boxes, $post_id);
		$designare_new_meta_box_des_templater=$GLOBALS['designare_new_meta_box_des_templater'];
		designare_save_meta_data($designare_new_meta_box_des_templater, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_testimonials_postdata( $post_id ) {
	global $post, $new_meta_testimonials_boxes;
	
	if(get_post($post_id)->post_type==DESIGNARE_TESTIMONIALS_POST_TYPE){
		designare_save_meta_data($new_meta_testimonials_boxes, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_partners_postdata( $post_id ) {
	global $post, $new_meta_partners_boxes;
	
	if(get_post($post_id)->post_type==DESIGNARE_PARTNERS_POST_TYPE){
		designare_save_meta_data($new_meta_partners_boxes, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_team_postdata( $post_id ) {
	global $post, $new_meta_team_boxes;
	
	if(get_post($post_id)->post_type==DESIGNARE_TEAM_POST_TYPE){
		designare_save_meta_data($new_meta_team_boxes, $post_id);
	}
}

/**
 * Saves the meta box content of a post
 * @param $post_id the ID of the post that contains the meta box
 */
function save_post_postdata( $post_id ) {
	global $post, $designare_new_meta_post_boxes;

	if(get_post($post_id)->post_type=='post'){
		designare_save_meta_data($designare_new_meta_post_boxes, $post_id);
		$designare_new_meta_box_des_templater=$GLOBALS['designare_new_meta_box_des_templater'];
		designare_save_meta_data($designare_new_meta_box_des_templater, $post_id);
	}
}

/**
 * Saves the post meta for all types of posts.
 * @param $designare_new_meta_boxes the meta data array
 * @param $post_id the ID of the post
 */
function designare_save_meta_data($designare_new_meta_boxes, $post_id){

	if ($designare_new_meta_boxes){
		foreach($designare_new_meta_boxes as $meta_box) {

			if($meta_box['type']!='heading'){
				// Verify
				if (isset($_POST[$meta_box['name'].'_noncename'])){
					if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
						return $post_id;
					}	
				}
				
				if (isset($_POST['post_type'])){
					if ( 'page' == $_POST['post_type'] ) {
						if ( !current_user_can( 'edit_page', $post_id ))
						return $post_id;
					} else {
						if ( !current_user_can( 'edit_post', $post_id ))
						return $post_id;
					}
	
				}
				
				if (isset($_POST[$meta_box['name'].'_value'])) $data = $_POST[$meta_box['name'].'_value'];
				
				//$data = mysql_escape_string($data);
	
				if (isset($data)){
					if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
					add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
					elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
					update_post_meta($post_id, $meta_box['name'].'_value', $data);
					elseif($data == "")
					delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));		
				}
			
	
			}
		}
	}
}

function print_helper(){
	echo '<div class="temppath" style="display:none;">'.get_template_directory_uri().'</div>';
	echo '<style>.mce-i-des-shortcode-icon{background: url('.get_template_directory_uri().'/images/shortcode-icon.png) no-repeat 3px 0px}</style>';
}