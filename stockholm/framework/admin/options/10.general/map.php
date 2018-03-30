<?php

$generalPage = new QodeAdminPage("", "General");
$qodeFramework->qodeOptions->addAdminPage("general",$generalPage);

// Design Style

$panel1 = new QodePanel("Design Style","design_style");
$generalPage->addChild("panel1",$panel1);

	$google_fonts = new QodeField("font","google_fonts","-1","Font Family","Choose a default Google font for your site");
	$panel1->addChild("google_fonts",$google_fonts);
	
	$first_color = new QodeField("color","first_color","","First Main Color","Choose the most dominant theme color. Default color is #e6ae48.");
	$panel1->addChild("first_color",$first_color);
	
	$background_color = new QodeField("color","background_color","","Content Background Color","Choose the background color for page content area. Default color is #f5f5f5.");
	$panel1->addChild("background_color",$background_color);
	
	$selection_color = new QodeField("color","selection_color","","Text Selection Color","Choose the color users see when selecting text");
	$panel1->addChild("selection_color",$selection_color);

	$content_top_padding = new QodeField("text","content_top_padding","0","Content Top Padding (px)","Enter top padding for content area. If you set this value then it's important to set also Content top padding for mobile header value.");
	$panel1->addChild("content_top_padding",$content_top_padding);

	$content_top_padding_default_template = new QodeField("text","content_top_padding_default_template","44","Content Top Padding for Templates in Grid (px)","Enter top padding for content area for Templates in grid. If you set this value then it's important to set also Content top padding for mobile header value.");
	$panel1->addChild("content_top_padding_default_template",$content_top_padding_default_template);

	$content_top_padding_mobile = new QodeField("text","content_top_padding_mobile","44","Content Top Padding for Mobile Header (px)","Enter top padding for content area for Mobile Header.");
	$panel1->addChild("content_top_padding_mobile",$content_top_padding_mobile);

	$boxed = new QodeField("yesno","boxed","no","Boxed layout","Enabling this option will display site content in grid", array(),
		array("dependence" => true,
		"dependence_hide_on_yes" => "",
		"dependence_show_on_yes" => "#qodef_boxed_container"));
	$panel1->addChild("boxed",$boxed);
	
	$boxed_container = new QodeContainer("boxed_container","boxed","no");
	$panel1->addChild("boxed_container",$boxed_container);
	
		$background_color_box = new QodeField("color","background_color_box","","Page Background Color","Choose the page background (body) color. Default color is #f5f5f5.");
		$boxed_container->addChild("background_color_box",$background_color_box);
		
		$background_image = new QodeField("image","background_image","","Background Image","Choose an image to be displayed in background");
		$boxed_container->addChild("background_image",$background_image);
		
		$pattern_background_image = new QodeField("image","pattern_background_image","","Background Pattern","Choose an image to be used as background pattern");
		$boxed_container->addChild("pattern_background_image",$pattern_background_image);

		$enable_content_top_margin = new QodeField("yesno","enable_content_top_margin","no","Put Content Below Header","Enabling this option  will put all of the content below header");
		$panel1->addChild("enable_content_top_margin",$enable_content_top_margin);

		$paspartu = new QodeField("yesno","paspartu","no","Enable Passepartout","Enabling this option will show passepartout", array(),
			array("dependence" => true,
				"dependence_hide_on_yes" => "",
				"dependence_show_on_yes" => "#qodef_paspartu_container"));
		$panel1->addChild("paspartu",$paspartu);

		$paspartu_container = new QodeContainer("paspartu_container","paspartu","no");
		$panel1->addChild("paspartu_container",$paspartu_container);

		$paspartu_color = new QodeField("color","paspartu_color","","Passepartout Color","Choose color for passepartout");
		$paspartu_container->addChild("paspartu_color",$paspartu_color);

		$paspartu_width = new QodeField("text","paspartu_width","","Passepartout Size (%)","Enter size amount for passepartout, default value is 2% (the percent is in relation to site width)");
		$paspartu_container->addChild("paspartu_width",$paspartu_width);





// Settings

$panel4 = new QodePanel("Settings","settings");
$generalPage->addChild("panel4",$panel4);

	$page_transitions = new QodeField("select", "page_transitions", "0", "Page Transition", 'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', array(0 => "No animation",
		1 => "Up/Down",
		2 => "Fade",
		3 => "Up/Down (In) / Fade (Out)",
		4 => "Left/Right"
	), array(), "enable_grid_elements", array("yes"));
	$panel4->addChild("page_transitions", $page_transitions);

	$page_transitions_notice = new QodeNotice("Page Transition",'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', "Page transition is disabled because VC Grid is Enabled", "enable_grid_elements","no");
	$panel4->addChild("page_transitions_notice",$page_transitions_notice);

	$loading_animation = new QodeField("onoff","loading_animation","off","Loading Animation","Enabling this option will display animation while page loads", array(),
		array("dependence" => true,
		"dependence_hide_on_yes" => "",
		"dependence_show_on_yes" => "#qodef_loading_animation_container"));
	$panel4->addChild("loading_animation",$loading_animation);
	
	$loading_animation_container = new QodeContainer("loading_animation_container","loading_animation","off");
	$panel4->addChild("loading_animation_container",$loading_animation_container);
	
		$group1 = new QodeGroup("Loading Animation Graphic","Choose type and color of preload graphic animation");
		$loading_animation_container->addChild("group1",$group1);
		
			$row1 = new QodeRow();
			$group1->addChild("row1",$row1);
			
			$loading_animation_spinner = new QodeField("selectsimple","loading_animation_spinner","pulse","Spinner","This is some description", array( "pulse" => "Pulse",
			   "double_pulse" => "Double Pulse",
			   "cube" => "Cube",
			   "rotating_cubes" => "Rotating Cubes",
			   "stripes" => "Stripes",
			   "wave" => "Wave",
			   "two_rotating_circles" => "2 Rotating Circles",
			   "five_rotating_circles" => "5 Rotating Circles",
			   "pulsating_circle" => "Pulsating Circle",
			   "ripples" => "Ripples",
			   "spinner" => "Spinner",
				"cubes" => "Cubes",
				"indeterminate" => "Indeterminate"
	      ));
				$row1->addChild("loading_animation_spinner",$loading_animation_spinner);
				
				$spinner_color = new QodeField("colorsimple","spinner_color","","Spinner Color","This is some description");
				$row1->addChild("spinner_color",$spinner_color);
				
		$loading_image = new QodeField("image","loading_image","","Loading Image",'Upload custom image to be displayed while page loads (Note: Page Transition must not be set to "No Animation")');
		$loading_animation_container->addChild("loading_image",$loading_image);
		
	$smooth_scroll = new QodeField("yesno","smooth_scroll","yes","Smooth Scroll","Enabling this option will perform a smooth scrolling effect on every page (for Chrome and Opera browsers)");
	$panel4->addChild("smooth_scroll",$smooth_scroll);
	
	$elements_animation_on_touch = new QodeField("yesno","elements_animation_on_touch","no","Elements Animation on Mobile/Touch Devices","Enabling this option will allow elements (shortcodes) to animate on mobile / touch devices");
	$panel4->addChild("elements_animation_on_touch",$elements_animation_on_touch);
	
	$show_back_button = new QodeField("yesno","show_back_button","yes","Show 'Back To Top Button'","Enabling this option will display a Back to Top button on every page");
	$panel4->addChild("show_back_button",$show_back_button);
	
	$responsiveness = new QodeField("yesno","responsiveness","yes","Responsiveness","Enabling this option will make all pages responsive");
	$panel4->addChild("responsiveness",$responsiveness);
	
	$favicon_image = new QodeField("image","favicon_image",QODE_ROOT."/img/favicon.ico","Favicon Image","Choose a favicon image to be displayed");
	$panel4->addChild("favicon_image",$favicon_image);
	
	$internal_no_ajax_links = new QodeField("textarea","internal_no_ajax_links","","List of Internal URLs Loaded Without AJAX (Separated With Comma)","To disable AJAX transitions on certain pages, enter their full URLs here (for example: http://www.mydomain.com/forum/)");
	$panel4->addChild("internal_no_ajax_links",$internal_no_ajax_links);

// Custom Code

$panel3 = new QodePanel("Custom Code","custom_code");
$generalPage->addChild("panel3",$panel3);

	$custom_css = new QodeField("textarea","custom_css","","Custom CSS","Enter your custom CSS here");
	$panel3->addChild("custom_css",$custom_css);
	
	$custom_js = new QodeField("textarea","custom_js","","Custom JS",'Enter your custom Javascript here (jQuery selector is "$j" because of the conflict mode)');
	$panel3->addChild("custom_js",$custom_js);

// SEO

$panel2 = new QodePanel("SEO","seo");
$generalPage->addChild("panel2",$panel2);

	$google_analytics_code = new QodeField("text","google_analytics_code","","Google Analytics Account ID","With this field you can monitor traffic on your website. Example UA-000000-01");
	$panel2->addChild("google_analytics_code",$google_analytics_code);
	
	$disable_qode_seo = new QodeField("yesno","disable_qode_seo","no","Disable Select SEO","Enabling this option will turn off Select SEO", array(),
		array("dependence" => true,
		"dependence_hide_on_yes" => "#qodef_disable_qode_seo_container",
		"dependence_show_on_yes" => ""));
	$panel2->addChild("disable_qode_seo",$disable_qode_seo);
	
	$disable_qode_seo_container = new QodeContainer("disable_qode_seo_container","disable_qode_seo","yes");
	$panel2->addChild("disable_qode_seo_container",$disable_qode_seo_container);
	
		$meta_keywords = new QodeField("textarea","meta_keywords","","Meta Keywords","Add relevant keywords separated with commas to improve SEO");
		$disable_qode_seo_container->addChild("meta_keywords",$meta_keywords);
		
		$meta_description = new QodeField("textarea","meta_description","","Meta Description","Enter a short description of the website for SEO");
		$disable_qode_seo_container->addChild("meta_description",$meta_description);