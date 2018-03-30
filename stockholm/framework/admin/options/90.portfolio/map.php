<?php

$portfolioPage = new QodeAdminPage("9", "Portfolio");
$qodeFramework->qodeOptions->addAdminPage("portfolioPage",$portfolioPage);

//Portfolio List

$panel1 = new QodePanel("Portfolio List", "porfolio_list");
$portfolioPage->addChild("panel1",$panel1);

	$portfolio_disable_text_box = new QodeField("yesno","portfolio_disable_text_box","no","Disable Text Box","Enabling this option will disable box around project text.", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_enable_portfolio_list_box_container", "dependence_show_on_yes" => ""));
	$panel1->addChild("portfolio_disable_text_box",$portfolio_disable_text_box);

	$enable_portfolio_list_box_container = new QodeContainer("enable_portfolio_list_box_container","portfolio_disable_text_box","yes");
	$panel1->addChild("enable_portfolio_list_box_container",$enable_portfolio_list_box_container);

		$portfolio_list_box_background_color = new QodeField("color","portfolio_list_box_background_color","","Portfolio Box Background Color","Default color is #ffffff.");
		$enable_portfolio_list_box_container->addChild("portfolio_list_box_background_color",$portfolio_list_box_background_color);

	$portfolio_shader_color = new QodeField("color","portfolio_shader_color","","Portfolio Image Hover Color","Default color is #e6ae48.");
	$panel1->addChild("portfolio_shader_color",$portfolio_shader_color);

	$portfolio_shader_transparency = new QodeField("text","portfolio_shader_transparency","","Portfolio Image Hover Color Transparnecy","Choose a transparency for image hover color (0 = fully transparent, 1 = opaque). Note: If image hover color has not been chosen, transparency will not be displayed", array(), array("col_width" => 3));
	$panel1->addChild("portfolio_shader_transparency",$portfolio_shader_transparency);

	$portfolio_qode_like = new QodeField("onoff","portfolio_qode_like","on","Likes",'Enabling this option will turn on "Likes"');
	$panel1->addChild("portfolio_qode_like",$portfolio_qode_like);

	$portfolio_list_hide_category = new QodeField("yesno","portfolio_list_hide_category","no","Hide Category","Enabling this option will disable categories on Portfolio list and Portfolio Slider.");
	$panel1->addChild("portfolio_list_hide_category",$portfolio_list_hide_category);

	$group1 = new QodeGroup("Icons Style","Define icons styles on project hover.");
	$panel1->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$portfolio_list_icons_color = new QodeField("colorsimple","portfolio_list_icons_color","","Color","This is some description");
			$row1->addChild("portfolio_list_icons_color",$portfolio_list_icons_color);
			$portfolio_list_icons_hover_color = new QodeField("colorsimple","portfolio_list_icons_hover_color","","Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_hover_color",$portfolio_list_icons_hover_color);
			$portfolio_list_icons_background_color = new QodeField("colorsimple","portfolio_list_icons_background_color","","Background Color","This is some description");
			$row1->addChild("portfolio_list_icons_background_color",$portfolio_list_icons_background_color);
			$portfolio_list_icons_background_hover_color = new QodeField("colorsimple","portfolio_list_icons_background_hover_color","","Background Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_background_hover_color",$portfolio_list_icons_background_hover_color);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$portfolio_list_icons_border_color = new QodeField("colorsimple","portfolio_list_icons_border_color","","Border Color","This is some description");
			$row2->addChild("portfolio_list_icons_border_color",$portfolio_list_icons_border_color);
			$portfolio_list_icons_border_hover_color = new QodeField("colorsimple","portfolio_list_icons_border_hover_color","","Border Hover Color","This is some description");
			$row2->addChild("portfolio_list_icons_border_hover_color",$portfolio_list_icons_border_hover_color);
			$portfolio_list_icons_border_radius = new QodeField("textsimple","portfolio_list_icons_border_radius","","Border Radius (px)","This is some description");
			$row2->addChild("portfolio_list_icons_border_radius",$portfolio_list_icons_border_radius);	

//Portfolio Single Project

$panel2 = new QodePanel("Portfolio Single", "porfolio_single_project");
$portfolioPage->addChild("panel2",$panel2);

	$portfolio_style = new QodeField("select","portfolio_style","small-images","Portfolio Type",'Choose a default type for Single Project pages', array( 
		"small-images" => "Portfolio small images",
		"small-slider" => "Portfolio small slider",
		"big-images" => "Portfolio big images",
		"big-slider" => "Portfolio big slider",
		"custom" => "Portfolio custom",
		"full-width-custom" => "Portfolio full width custom",
		"gallery" => "Portfolio gallery",
		"gallery-right" => "Portfolio gallery right",
		"fullscreen-slider" => "Portfolio full screen slider",
		"fullwidth-slider" => "Portfolio full width slider",
		"masonry-gallery" => "Portfolio masonry gallery",
		"fixed-right" => "Portfolio fixed right",
		"fixed-left" => "Portfolio fixed left"

      ));
	$panel2->addChild("portfolio_style",$portfolio_style);

	$lightbox_single_project = new QodeField("yesno","lightbox_single_project","yes","Lightbox for Images","Enabling this option will turn on lightbox functionality for projects with images. (Note that Full Screen Slider and Full Width Slider single portfolio types don't use light boxes)");
	$panel2->addChild("lightbox_single_project",$lightbox_single_project);

	$lightbox_video_single_project = new QodeField("yesno","lightbox_video_single_project","no","Lightbox for Videos","Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects. (Note that Full Screen Slider and Full Width Slider single portfolio types don't use light boxes)");
	$panel2->addChild("lightbox_video_single_project",$lightbox_video_single_project);

	$portfolio_hide_categories = new QodeField("yesno","portfolio_hide_categories","no","Hide Categories","Enabling this option will disable category meta description on Single Projects.");
	$panel2->addChild("portfolio_hide_categories",$portfolio_hide_categories);

	$portfolio_hide_date = new QodeField("yesno","portfolio_hide_date","no","Hide Date","Enabling this option will disable date meta on Single Projects.");
	$panel2->addChild("portfolio_hide_date",$portfolio_hide_date);

	$portfolio_hide_comments = new QodeField("yesno","portfolio_hide_comments","yes","Hide Comments","Enabling this option will turn off comments functionality.");
	$panel2->addChild("portfolio_hide_comments",$portfolio_hide_comments);

	$group1 = new QodeGroup("Social Share Style","Define icons styles for social share on Single Project.");
	$panel2->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$portfolio_social_share_type = new QodeField("select","portfolio_social_share_type","circle","Social Share Type",'Select social share type for display on Single Projects. Social Share for Portfolio Item must be enabled. ', array(
				"circle" 	=> "Circle",
				"regular" 	=> "Regular"
			), array(), array("col_width" => 3));
			$row1->addChild("portfolio_social_share_type",$portfolio_social_share_type);
			$portfolio_single_social_color = new QodeField("colorsimple","portfolio_single_social_color","","Color","This is some description");
			$row1->addChild("portfolio_single_social_color",$portfolio_single_social_color);
			$portfolio_single_social_hover_color = new QodeField("colorsimple","portfolio_single_social_hover_color","","Hover Color","This is some description");
			$row1->addChild("portfolio_single_social_hover_color",$portfolio_single_social_hover_color);

	$portfolio_text_follow = new QodeField("portfoliofollow","portfolio_text_follow","portfolio_single_follow","Sticky Side Text ","Enabling this option will make side text sticky on Single Project pages");
	$panel2->addChild("portfolio_text_follow",$portfolio_text_follow);

	$portfolio_hide_pagination = new QodeField("yesno","portfolio_hide_pagination","no","Hide Pagination","Enabling this option will turn off portfolio pagination functionality.", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_portfolio_hide_pagination_container", "dependence_show_on_yes" => ""));
	$panel2->addChild("portfolio_hide_pagination",$portfolio_hide_pagination);

	$portfolio_hide_pagination_container = new QodeContainer("portfolio_hide_pagination_container","portfolio_hide_pagination","yes");
	$panel2->addChild("portfolio_hide_pagination_container",$portfolio_hide_pagination_container);

		$portfolio_navigation_through_same_category = new QodeField("yesno","portfolio_navigation_through_same_category","no","Enable Pagination Through Same Category","Enabling this option will make portfolio pagination sort through current category.");
		$portfolio_hide_pagination_container->addChild("portfolio_navigation_through_same_category",$portfolio_navigation_through_same_category);

		$portfolio_navigation_reverse_order = new QodeField("yesno","portfolio_navigation_reverse_order","no","Revert Pagination Order","Enabling this option will revert next/prev pagination order.");
		$portfolio_hide_pagination_container->addChild("portfolio_navigation_reverse_order",$portfolio_navigation_reverse_order);

	$portfolio_box_background_color = new QodeField("color","portfolio_box_background_color","","Portfolio Box Background Color","This color only works when Portfolio style is (Big Images, Big Slider or Gallery). Default color is #ffffff.");
	$panel2->addChild("portfolio_box_background_color",$portfolio_box_background_color);

	$portfolio_box_lr_padding = new QodeField("text","portfolio_box_lr_padding","","Portfolio Box Left/Right Padding(px)","This padding only works when Portfolio style is (Big Images, Big Slider or Gallery). Default value is 45.", array(), array("col_width" => 3));
	$panel2->addChild("portfolio_box_lr_padding",$portfolio_box_lr_padding);

	$portfolio_columns_number = new QodeField("select","portfolio_columns_number","2","Number of Columns",'Enter the number of columns for Portfolio Gallery type', array( "2" => "2 columns",
       "3" => "3 columns",
       "4" => "4 columns"
      ));
	$panel2->addChild("portfolio_columns_number",$portfolio_columns_number);

	$portfolio_hide_image_title = new QodeField("yesno","portfolio_hide_image_title","no","Hide Image Title","Enabling this option will hide image title from portfolio images hover in Portfolio Gallery Type.");
	$panel2->addChild("portfolio_hide_image_title",$portfolio_hide_image_title);

	$portfolio_single_gallery_color = new QodeField("color","portfolio_single_gallery_color","","Gallery Image Hover Color","Select color for image overlay in Single Project Gallery Type.");
	$panel2->addChild("portfolio_single_gallery_color",$portfolio_single_gallery_color);

	$portfolio_single_gallery_transparency = new QodeField("text","portfolio_single_gallery_transparency","","Gallery Image Hover Color Transparnecy","Enter a transparency for image overlay in Single Project Gallery Type. (0 = fully transparent, 1 = opaque). Note: If image hover color has not been chosen, transparency will not be displayed", array(), array("col_width" => 3));
	$panel2->addChild("portfolio_single_gallery_transparency",$portfolio_single_gallery_transparency);

	$portfolio_single_sidebar = new QodeField("select","portfolio_single_sidebar","default","Sidebar Layout","Choose a sidebar layout for Single Project pages. (Note that Full Screen Slider and Full Width Slider single portfolio types don't use  sidebar)", array(
		"default" => "No Sidebar",
		"1" => "Sidebar 1/3 right",
		"2" => "Sidebar 1/4 right",
		"3" => "Sidebar 1/3 left",
		"4" => "Sidebar 1/4 left"
      ));
	$panel2->addChild("portfolio_single_sidebar",$portfolio_single_sidebar);
	
	$custom_sidebars = array();
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		if(isUserMadeSidebar(ucwords($sidebar['name']))){
			$custom_sidebars[$sidebar['id']] = ucwords( $sidebar['name']);
		}
	}
	$portfolio_single_sidebar_custom_display = new QodeField("selectblank","portfolio_single_sidebar_custom_display","","Sidebar to Display","Choose a sidebar to display on Single Project pages", $custom_sidebars);
	$panel2->addChild("portfolio_single_sidebar_custom_display",$portfolio_single_sidebar_custom_display);

	$portfolio_single_slug = new QodeField("text","portfolio_single_slug","","Portfolio Single Slug",'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect) ', array(), array("col_width" => 3));
	$panel2->addChild("portfolio_single_slug",$portfolio_single_slug);