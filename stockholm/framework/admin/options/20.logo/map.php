<?php

$logoPage = new QodeAdminPage("1", "Logo");
$qodeFramework->qodeOptions->addAdminPage("logo",$logoPage);

$panel1 = new QodePanel("Logo", "logo");
$logoPage->addChild("panel1",$panel1);

	$logo_image = new QodeField("image","logo_image",QODE_ROOT."/img/logo.png","Logo Image - Normal","Choose a default logo image to display ");
	$panel1->addChild("logo_image",$logo_image);
	
	$logo_image_light = new QodeField("image","logo_image_light",QODE_ROOT."/img/logo_white.png","Logo Image - Light",'Choose a logo image to display for "Light" header skin');
	$panel1->addChild("logo_image_light",$logo_image_light);
	
	$logo_image_dark = new QodeField("image","logo_image_dark",QODE_ROOT."/img/logo_black.png","Logo Image - Dark",'Choose a logo image to display for "Dark" header skin');
	$panel1->addChild("logo_image_dark",$logo_image_dark);
	
	$logo_image_sticky = new QodeField("image","logo_image_sticky",QODE_ROOT."/img/logo_black.png","Logo Image - Sticky Header",'Choose a logo image to display for "Sticky" header type');
	$panel1->addChild("logo_image_sticky",$logo_image_sticky);
	
	$logo_image_fixed_hidden = new QodeField("image","logo_image_fixed_hidden","","Logo Image - Fixed Advanced Header",'Choose a logo image to display for "Fixed Advanced" header type');
	$panel1->addChild("logo_image_fixed_hidden",$logo_image_fixed_hidden);

	$logo_mobile_header_height = new QodeField("text","logo_mobile_header_height","","Logo Height For Mobile Header (px)","Define logo height for mobile header");
    $panel1->addChild("logo_mobile_header_height",$logo_mobile_header_height);

	$logo_mobile_height = new QodeField("text","logo_mobile_height","","Logo Height For Mobile Devices (px)","Define logo height for mobile devices");
    $panel1->addChild("logo_mobile_height",$logo_mobile_height);	