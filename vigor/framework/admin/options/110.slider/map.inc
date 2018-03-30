<?php

$sliderPage = new EdgeAdminPage("10", "Edge Slider", "fa fa-arrows-h");
$edgtFramework->edgtOptions->addAdminPage("slider",$sliderPage);

// General Style

$panel3 = new EdgePanel("General Style","navigation_control_style");
$sliderPage->addChild("panel3",$panel3);

    $qs_slider_height_mobile = new EdgeField("text","qs_slider_height_mobile","","Slider Height For Mobile Devices (px)","Define slider height for mobile devices");
    $panel3->addChild("qs_slider_height_mobile",$qs_slider_height_mobile);

	$qs_slider_preloader_background = new EdgeField("color","qs_slider_preloader_background","","Slider Preloader Background Color","Define background color for slider preloader");
	$panel3->addChild("qs_slider_preloader_background",$qs_slider_preloader_background);

 // Navigation Control Style

$panel2 = new EdgePanel("Navigation Bullets Style","navigation_control_style");
$sliderPage->addChild("panel2",$panel2);

	$qs_navigation_control_color = new EdgeField("color","qs_navigation_control_color","","Color","Choose color for navigation bullets controls", array(), array("col_width" => 3));
	$panel2->addChild("qs_navigation_control_color",$qs_navigation_control_color);

    $qs_navigation_control_size = new EdgeField("text","qs_navigation_control_size","","Size (px)","Define size for navigation bullets controls (w=h in px)", array(), array("col_width" => 3));
    $panel2->addChild("qs_navigation_control_size",$qs_navigation_control_size);

    $qs_navigation_control_border_radius = new EdgeField("text","qs_navigation_control_border_radius","","Border Radius (px)","Define border radius for navigation bullets controls", array(), array("col_width" => 3));
    $panel2->addChild("qs_navigation_control_border_radius",$qs_navigation_control_border_radius);



	$enable_slider_triangle = new EdgeField("yesno","enable_slider_triangle","no","Enable Triangle Shape in Pagination Background","Enabling this option will display a triangular shape in pagination background", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#Edgef_enable_slider_triangle_container"));
	$panel2->addChild("enable_slider_triangle",$enable_slider_triangle);

	$enable_slider_triangle_container = new EdgeContainer("enable_slider_triangle_container","enable_slider_triangle","no");
	$panel2->addChild("enable_slider_triangle_container",$enable_slider_triangle_container);

	$slider_triangle_section_color = new EdgeField("color","slider_triangle_section_color","","Background Color","Choose a background color for a triangular shape");
	$enable_slider_triangle_container->addChild("slider_triangle_section_color",$slider_triangle_section_color);





				
	