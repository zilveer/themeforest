<?php
$qode_custom_sidebars = array();
foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
	if(isUserMadeSidebar(ucwords($sidebar['name']))){
		$qode_custom_sidebars[$sidebar['id']] = ucwords( $sidebar['name']);
	}
}


$qode_blog_categories = array();
$categories = get_categories(); 
foreach($categories as $category) {
	$qode_blog_categories[$category->term_id] = $category->name;
}

//General

$qodeGeneral = new QodeMetaBox("page", "Select General", "general-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("page_general",$qodeGeneral);

	$qode_page_background_color = new QodeMetaField("color","qode_page_background_color","","Page Background Color","Choose the page background (body) color");
	$qodeGeneral->addChild("qode_page_background_color",$qode_page_background_color);

	$group1 = new QodeGroup("Content Style","Define styles for Content area");
	$qodeGeneral->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$qode_content_top_padding = new QodeMetaField("textsimple","qode_content-top-padding","","Content Top Padding (px)","This option control content top padding.");
			$row1->addChild("qode_content-top-padding",$qode_content_top_padding);

			$qode_content_top_padding_mobile = new QodeMetaField("selectblanksimple","qode_content-top-padding-mobile","","Set this top padding for mobile header","", array(
		       "no" => "No",
		       "yes" => "Yes"
		      ));
			$row1->addChild("qode_content-top-padding-mobile",$qode_content_top_padding_mobile);

	$qode_show_animation = new QodeMetaField("selectblank", "qode_show-animation", "", "Page Transition", 'Choose a type of transition between loading pages.', array(
		"no_animation" => "No Animation",
		"updown" => "Up / Down",
		"fade" => "Fade",
		"updown_fade" => "Up/Down (In) / Fade (Out)",
		"leftright" => "Left / Right"
	), array(), "enable_grid_elements", array("yes"));
	$qodeGeneral->addChild("qode_show-animation", $qode_show_animation);

	$page_transitions_notice = new QodeNotice("Page Transition",'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', "AJAX Page transitions are disabled due to VC Grid Elements", "enable_grid_elements","no");
	$qodeGeneral->addChild("page_transitions_notice",$page_transitions_notice);

	$qode_revolution_slider = new QodeMetaField("text","qode_revolution-slider","","Layer Slider or Select Slider Shortcode","Copy and paste your shortcode located in Select Slider -> Slider");
	$qodeGeneral->addChild("qode_revolution-slider",$qode_revolution_slider);

	$qode_enable_content_top_margin = new QodeMetaField("selectblank","qode_enable_content_top_margin","","Put Content Below Header","Enabling this option will put all of the content below header", array(
		"no" => "No",
		"yes" => "Yes",
	));
	$qodeGeneral->addChild("qode_enable_content_top_margin",$qode_enable_content_top_margin);

// Left Menu Area

$qodeLeftMenuArea = new QodeMetaBox("page", "Select Left Menu Area", "left-menu-meta","vertical_area",array("no"));
$qodeFramework->qodeMetaBoxes->addMetaBox("page_left_menu",$qodeLeftMenuArea);

	$qode_page_vertical_area_transparency = new QodeMetaField("selectblank","qode_page_vertical_area_transparency","","Enable transparent left menu area","Enabling this option will make Left Menu background transparent ", array(
	   "no" => "No",
	   "yes" => "Yes"
	  ));
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_transparency",$qode_page_vertical_area_transparency);

	$qode_page_vertical_area_background = new QodeMetaField("color","qode_page_vertical_area_background","","Left Menu Area Background Color","Choose a color for Left Menu background");
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_background",$qode_page_vertical_area_background);

	$qode_page_vertical_area_background_image = new QodeMetaField("image","qode_page_vertical_area_background_image","","Left Menu Area Background Image","Choose an image for Left Menu background");
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_background_image",$qode_page_vertical_area_background_image);

// Header

$qodeHeader = new QodeMetaBox("page", "Select Header", "header-meta","vertical_area",array("yes"));
$qodeFramework->qodeMetaBoxes->addMetaBox("page_header",$qodeHeader);

	$qode_header_style = new QodeMetaField("selectblank","qode_header-style","","Header Skin","Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style", array(
	   "light" => "Light",
	   "dark" => "Dark"
	  ));
	$qodeHeader->addChild("qode_header-style",$qode_header_style);

	$qode_header_color_per_page = new QodeMetaField("color","qode_header_color_per_page","","Initial Header Background Color","Choose a background color for header area");
	$qodeHeader->addChild("qode_header_color_per_page",$qode_header_color_per_page);

	$qode_header_color_transparency_per_page = new QodeMetaField("text","qode_header_color_transparency_per_page","","Initial Header Transparency","Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)", array(), array("col_width" => 3));
	$qodeHeader->addChild("qode_header_color_transparency_per_page",$qode_header_color_transparency_per_page);

	$qode_header_bottom_border_color = new QodeMetaField("color","qode_header_bottom_border_color","","Initial Header Bottom Border Color","Choose a bottom border color for header area");
	$qodeHeader->addChild("qode_header_bottom_border_color",$qode_header_bottom_border_color);

	$qode_page_scroll_amount_for_sticky = new QodeMetaField("text","qode_page_scroll_amount_for_sticky","","Scroll amount for sticky header appearance (px)","Define scroll amount for sticky header appearance", array(), array("col_width" => 3),"header_bottom_appearance",array( "regular","fixed","fixed_hiding") );
	$qodeHeader->addChild("qode_page_scroll_amount_for_sticky",$qode_page_scroll_amount_for_sticky);

// Title


$qodeTitle = new QodeMetaBox("page", "Select Title", "title-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("page_title",$qodeTitle);

	$qode_show_page_title = new QodeMetaField("selectblank","qode_show-page-title","","Show Title Area","Disabling this option will turn off page title area", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#qodef_qode_page_title_area_container"),
			"show" => array(
				""=>"#qodef_qode_page_title_area_container",
				"yes"=>"#qodef_qode_page_title_area_container") ));
	$qodeTitle->addChild("qode_show-page-title",$qode_show_page_title);

	$qode_page_title_area_container = new QodeContainer("qode_page_title_area_container","qode_show-page-title","no");
	$qodeTitle->addChild("qode_page_title_area_container",$qode_page_title_area_container);

	$qode_page_title_type = new QodeMetaField("selectblank","qode_page_title_type","","Title Type","Choose title type for this page.",array(
		"standard_title" => "Standard",
		"breadcrumbs_title" => "Breadcrumbs"
	));
	$qode_page_title_area_container->addChild("qode_page_title_type",$qode_page_title_type);

	$qode_animate_page_title = new QodeMetaField("selectblank","qode_animate-page-title","no","Animations","Choose an animation for Title Area",array(
		"no" => "No animation",
		"text_right_left" => "Text right to left",
		"area_top_bottom" => "Title area top to bottom"
	));
	$qode_page_title_area_container->addChild("qode_animate_page_title",$qode_animate_page_title);

	$qode_show_page_title_text = new QodeMetaField("yesno","qode_show-page-title-text","no","Don't Show Title Text","Enable this option to hide the title text", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_qode_title_text_container", "dependence_show_on_yes" => ""));
	$qode_page_title_area_container->addChild("qode_show-page-title-text",$qode_show_page_title_text);

	$qode_title_text_container = new QodeContainer("qode_title_text_container","qode_show-page-title-text","yes");
	$qode_page_title_area_container->addChild("qode_title_text_container",$qode_title_text_container);

	$qode_page_title_position = new QodeMetaField("selectblank","qode_page_title_position","","Title Text Alignment","Specify Title text alignment",array(
		"left" => "Left",
		"center" => "Center",
		"right" => "Right"
	));
	$qode_title_text_container->addChild("qode_page_title_position",$qode_page_title_position);

	$group1 = new QodeGroup("Title Text Style","Define styles for text in Title Area");
	$qode_title_text_container->addChild("group1",$group1);

	$row1 = new QodeRow();
	$group1->addChild("row1",$row1);

	$qode_page_title_color = new QodeMetaField("colorsimple","qode_page-title-color","","Text Color","ThisIsDescription");
	$row1->addChild("qode_page-title-color",$qode_page_title_color);

	$qode_page_title_font_size = new QodeMetaField("selectblanksimple","qode_page_title_font_size","","Text Size","ThisIsDescription",array(
		"small" => "Small",
		"medium" => "Medium",
		"large" => "Large"
	));
	$row1->addChild("qode_page_title_font_size",$qode_page_title_font_size);

	$qode_title_text_shadow = new QodeMetaField("selectblanksimple","qode_title_text_shadow","","Text Shadow","ThisIsDescription",array(
		"no" => "No",
		"yes" => "yes"
	));
	$row1->addChild("qode_title_text_shadow",$qode_title_text_shadow);

	$row2 = new QodeRow();
	$group1->addChild("row2",$row2);

	$qode_page_title_text_background_color = new QodeMetaField("colorsimple","qode_page-title-text-background-color","","Text Background Color","ThisIsDescription");
	$row2->addChild("qode_page-title-text-background-color",$qode_page_title_text_background_color);

	$qode_page_title_text_background_opacity = new QodeMetaField("textsimple","qode_page-title-text-background-opacity","","Text Background Opacity (0-1)","ThisIsDescription", array(), array("col_width" => 3));
	$row2->addChild("qode_page-title-text-background-opacity",$qode_page_title_text_background_opacity);

	$qode_page_title_background_color = new QodeMetaField("color","qode_page-title-background-color","","Background Color","Choose background color for Title Area");
	$qode_page_title_area_container->addChild("qode_page-title-background-color",$qode_page_title_background_color);

	$qode_show_page_title_image = new QodeMetaField("yesno","qode_show-page-title-image","no","Don't Show Background Image","Enable this option to hide background image in Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_qode_background_image_container", "dependence_show_on_yes" => "#qodef_qode_title-height"));
	$qode_page_title_area_container->addChild("qode_show-page-title-image",$qode_show_page_title_image);

	$qode_background_image_container = new QodeContainer("qode_background_image_container","qode_show-page-title-image","yes");
	$qode_page_title_area_container->addChild("qode_background_image_container",$qode_background_image_container);

	$qode_title_image = new QodeMetaField("image","qode_title-image","","Background Image","Choose a background image for Title Area");
	$qode_background_image_container->addChild("qode_title-image",$qode_title_image);

	$qode_title_overlay_image = new QodeMetaField("image","qode_title-overlay-image","","Pattern Overlay Image","Choose an image to be used as pattern over Title Area");
	$qode_background_image_container->addChild("qode_title-overlay-image",$qode_title_overlay_image);

	$qode_responsive_title_image = new QodeMetaField("selectblank","qode_responsive-title-image","","Responsive Background Image","Do you want to make Title background image responsive?", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"yes"=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height"),
			"show" => array(
				""=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height",
				"no"=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height") ));
	$qode_background_image_container->addChild("qode_responsive-title-image",$qode_responsive_title_image);


	$qode_responsive_title_image_container = new QodeContainer("qode_responsive_title_image_container","qode_responsive-title-image","yes");
	$qode_background_image_container->addChild("qode_responsive_title_image_container",$qode_responsive_title_image_container);

	$qode_fixed_title_image = new QodeMetaField("selectblank","qode_fixed-title-image","","Parallax Background Image","Do you want background image to have parallax effect?", array(
		"no" => "No",
		"yes" => "Yes",
		"yes_zoom" => "Yes, with zoom out"
	));
	$qode_responsive_title_image_container->addChild("qode_fixed-title-image",$qode_fixed_title_image);

	$qode_title_height = new QodeMetaField("text","qode_title-height","","Title Height (px)","Set a height for Title Area in pixels", array(), array("col_width" => 3));
	$qode_page_title_area_container->addChild("qode_title-height",$qode_title_height);

	// $qode_separator_bellow_title = new QodeMetaField("select","qode_separator_bellow_title","","Separator Under Title Text","Do you want to have a separator under title text?", array( "" => "",
	// 	"no" => "No",
	// 	"yes" => "Yes"
	// ));
	// $qode_page_title_area_container->addChild("qode_separator_bellow_title",$qode_separator_bellow_title);

	// $qode_title_separator_color = new QodeMetaField("color","qode_title_separator_color","","Separator Color","Choose a color for separator");
	// $qode_page_title_area_container->addChild("qode_title_separator_color",$qode_title_separator_color);

	$qode_enable_breadcrumbs = new QodeMetaField("selectblank","qode_enable_breadcrumbs","","Enable Breadcrumbs","Do you want to display breadcrumbs in title area?", array(
		"no" => "No",
		"yes" => "Yes"
	));
	$qode_page_title_area_container->addChild("qode_enable_breadcrumbs",$qode_enable_breadcrumbs);

	$qode_page_breadcrumbs_color = new QodeMetaField("color","qode_page_breadcrumbs_color","","Breadcrumbs Color","Choose a color for breadcrumbs text ");
	$qode_page_title_area_container->addChild("qode_page_breadcrumbs_color",$qode_page_breadcrumbs_color);

	$qode_page_subtitle = new QodeMetaField("text","qode_page_subtitle","","Subtitle Text","Enter your subtitle text");
	$qode_page_title_area_container->addChild("qode_page_subtitle",$qode_page_subtitle);

	$qode_page_subtitle_color = new QodeMetaField("color","qode_page_subtitle_color","","Subtitle Text Color","Choose a color for subtitle text");
	$qode_page_title_area_container->addChild("qode_page_subtitle_color",$qode_page_subtitle_color);


// Content Bottom

$qodeContentBottom = new QodeMetaBox("page", "Select Content Bottom", "content-bottom-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("page_content_bottom",$qodeContentBottom);

	$qode_enable_content_bottom_area = new QodeMetaField("selectblank","qode_enable_content_bottom_area","","Show Content Bottom Area","Do you want to show content bottom area?", array(
	   "no" => "No",
	   "yes" => "Yes"
	  ),
	  array("dependence" => true,
		"hide" => array(
			"no"=>"#qodef_qode_enable_content_bottom_area_container",
			""=>"#qodef_qode_enable_content_bottom_area_container"),
		"show" => array(
			"yes"=>"#qodef_qode_enable_content_bottom_area_container") ));
	$qodeContentBottom->addChild("qode_enable_content_bottom_area",$qode_enable_content_bottom_area);
	
	$qode_enable_content_bottom_area_container = new QodeContainer("qode_enable_content_bottom_area_container","qode_enable_content_bottom_area","no",array("", "no"));
	$qodeContentBottom->addChild("qode_enable_content_bottom_area_container",$qode_enable_content_bottom_area_container);

		$qode_content_bottom_background_color = new QodeMetaField("color","qode_content_bottom_background_color","","Background Color","Choose a color for content bottom area");
		$qode_enable_content_bottom_area_container->addChild("qode_content_bottom_background_color",$qode_content_bottom_background_color);
	
		$qode_choose_content_bottom_sidebar = new QodeMetaField("selectblank","qode_choose_content_bottom_sidebar","","Custom Widget","Choose Custom Widget area to display",$qode_custom_sidebars);
		$qode_enable_content_bottom_area_container->addChild("qode_choose_content_bottom_sidebar",$qode_choose_content_bottom_sidebar);
	
		$qode_content_bottom_sidebar_in_grid = new QodeMetaField("selectblank","qode_content_bottom_sidebar_in_grid","","Display in Grid","Enabling this option will place Content Bottom in grid",array(
		   "no" => "No",
		   "yes" => "Yes"
		  ));
		$qode_enable_content_bottom_area_container->addChild("qode_content_bottom_sidebar_in_grid",$qode_content_bottom_sidebar_in_grid);


// Blog

$qodeBlog = new QodeMetaBox("page", "Select Blog", "blog-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("page_blog",$qodeBlog);

	$qode_choose_blog_category = new QodeMetaField("selectblank","qode_choose-blog-category","","Blog Category","Choose category of posts to display (leave empty to display all categories)",$qode_blog_categories);
	$qodeBlog->addChild("qode_choose-blog-category",$qode_choose_blog_category);

	$qode_show_posts_per_page = new QodeMetaField("text","qode_show-posts-per-page","","Number of Posts","Enter the number of posts to display", array(), array("col_width" => 3));
	$qodeBlog->addChild("qode_show-posts-per-page",$qode_show_posts_per_page);

	$qode_enable_page_comments = new QodeMetaField("yesno","qode_enable-page-comments","no","Show Comments","Enabling this option will show comments on your page ");
	$qodeBlog->addChild("qode_enable-page-comments",$qode_enable_page_comments);


// Side Bar Area

$qodeSideBar = new QodeMetaBox("page", "Select Sidebar", "sidebar-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("page_side_bar",$qodeSideBar);

	$qode_show_sidebar = new QodeMetaField("select","qode_show-sidebar","default","Layout","Choose the sidebar layout",array( "default" => "Default",
	   "1" => "Sidebar 1/3 right",
	   "2" => "Sidebar 1/4 right",
	   "3" => "Sidebar 1/3 left",
	   "4" => "Sidebar 1/4 left",
	  ));
	$qodeSideBar->addChild("qode_show-sidebar",$qode_show_sidebar);

	$qode_choose_sidebar = new QodeMetaField("selectblank","qode_choose-sidebar","default","Choose Widget Area in Sidebar","Choose Custom Widget area to display in Sidebar", $qode_custom_sidebars);
	$qodeSideBar->addChild("qode_choose-sidebar",$qode_choose_sidebar);

// SEO

$qodeSeo = new QodeMetaBox("page", "Select SEO", "seo-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("page_seo",$qodeSeo);

	$seo_title = new QodeMetaField("text","qode_seo_title","","SEO Title","Enter custom Title for this page");
	$qodeSeo->addChild("seo_title",$seo_title);

	$seo_keywords = new QodeMetaField("text","qode_seo_keywords","","Meta Keywords","Enter the list of keywords separated by commas");
	$qodeSeo->addChild("seo_keywords",$seo_keywords);

	$seo_description = new QodeMetaField("textarea","qode_seo_description","","Meta Description","Enter meta description for this page");
	$qodeSeo->addChild("seo_description",$seo_description);		