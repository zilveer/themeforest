<?php

$contentPage = new EdgeAdminPage("_content", "Content", "fa fa-align-justify");
$edgtFramework->edgtOptions->addAdminPage("content",$contentPage);

$panel_general = new EdgePanel("General Settings","general_settings");
$contentPage->addChild("panel1",$panel_general);

$background_color = new EdgeField("color","background_color","","Content Background Color","Choose the background color for page content area. Default color is #f5f5f5.");
$panel_general->addChild("background_color",$background_color);

$background_color_grid = new EdgeField("color","background_color_grid","","Content Background Color for Templates in Grid","Choose the background color for the page templates in grid.");
$panel_general->addChild("background_color_grid",$background_color_grid);

$content_top_padding = new EdgeField("text","content_top_padding","0","Content Top Padding (px)","Enter top padding for content area. If you set this value then it's important to set also Content top padding for mobile header value.", array(), array("col_width" => 3));
$panel_general->addChild("content_top_padding",$content_top_padding);

$content_top_padding_default_template = new EdgeField("text","content_top_padding_default_template","44","Content Top Padding for Templates in Grid (px)","Enter top padding for content area for Templates in grid. If you set this value then it's important to set also Content top padding for mobile header value.", array(), array("col_width" => 3));
$panel_general->addChild("content_top_padding_default_template",$content_top_padding_default_template);

$content_top_padding_mobile = new EdgeField("text","content_top_padding_mobile","44","Content Top Padding for Mobile Header (px)","Enter top padding for content area for Mobile Header.", array(), array("col_width" => 3));
$panel_general->addChild("content_top_padding_mobile",$content_top_padding_mobile);

$overlapping_content = new EdgeField("yesno","overlapping_content","no","Enable Overlapping Content","Enabling this option will make content overlap title area or slider for set amount of pixels", array(),
	array("dependence" => true,
		  "dependence_hide_on_yes" => "",
		  "dependence_show_on_yes" => "#edgtf_overlapping_content_container"));
$panel_general->addChild("overlapping_content",$overlapping_content);

$overlapping_content_container = new EdgeContainer("overlapping_content_container","overlapping_content","no");
$panel_general->addChild("overlapping_content_container",$overlapping_content_container);

$overlapping_content_amount = new EdgeField("text","overlapping_content_amount","","Overlapping amount (px)","Enter amount of pixels you would like content to overlap title area or slider", array(), array("col_width" => 1));
$overlapping_content_container->addChild("overlapping_content_amount",$overlapping_content_amount);

$overlapping_content_padding = new EdgeField("text","overlapping_content_padding","","Overlapping left/right padding (px)","This option takes effect only on Default (in grid) templates", array(), array("col_width" => 1));
$overlapping_content_container->addChild("overlapping_content_padding",$overlapping_content_padding);

$content_grid_position = new EdgeField("select","content_grid_position","","Position of Content in Grid","Set position of content in grid", array(
	"default" => "Default",
	"left" => "Left",
	"right" => "Right"
));
$panel_general->addChild("content_grid_position",$content_grid_position);

$content_predefined_width = new EdgeField("select","content_predefined_width","","Initial Width of Content","Choose the initial width of content which is in grid (Applies to pages set to 'Default Template' and rows set to 'In Grid' )", array(
	"" => "Default (1100px)",
	"big_grid" => "Large (1200px)",
	"small_grid" => "Small (800px)"
));
$panel_general->addChild("content_predefined_width",$content_predefined_width);


//Content Bottom Panel
$panel_content_bottom = new EdgePanel("Content Bottom Area","content_bottom_area_panel");
$contentPage->addChild("panel_content_bottom",$panel_content_bottom);

$enable_content_bottom_area = new EdgeField("yesno","enable_content_bottom_area","no","Enable Content Bottom Area","This option will enable Content Bottom area on pages", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_enable_content_bottom_area_container"));
$panel_content_bottom->addChild("enable_content_bottom_area",$enable_content_bottom_area);

$enable_content_bottom_area_container = new EdgeContainer("enable_content_bottom_area_container","enable_content_bottom_area","no");
$panel_content_bottom->addChild("enable_content_bottom_area_container",$enable_content_bottom_area_container);

$custom_sidebars = edgt_get_custom_sidebars();

$content_bottom_sidebar_custom_display = new EdgeField("selectblank","content_bottom_sidebar_custom_display","","Sidebar to Display","Choose a Content Bottom sidebar to display", $custom_sidebars);
$enable_content_bottom_area_container->addChild("content_bottom_sidebar_custom_display",$content_bottom_sidebar_custom_display);

$content_bottom_in_grid = new EdgeField("yesno","content_bottom_in_grid","yes","Display in Grid","Enabling this option will place Content Bottom in grid");
$enable_content_bottom_area_container->addChild("content_bottom_in_grid",$content_bottom_in_grid);

$content_bottom_background_color = new EdgeField("color","content_bottom_background_color","","Background Color","Choose a background color for Content Bottom area");
$enable_content_bottom_area_container->addChild("content_bottom_background_color",$content_bottom_background_color);