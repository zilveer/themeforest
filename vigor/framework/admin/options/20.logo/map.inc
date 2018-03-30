<?php

$logoPage = new EdgeAdminPage("1", "Logo", "fa fa-coffee");
$edgtFramework->edgtOptions->addAdminPage("logo",$logoPage);

$panel1 = new EdgePanel("Logo Upload", "logo");
$logoPage->addChild("panel1",$panel1);

	$show_logo = new EdgeField("yesno","show_logo","yes","Show Logo","Disabling this option will hide logo", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_show_logo_container"));
    $panel1->addChild("show_logo",$show_logo);
		$show_logo_container = new EdgeContainer("show_logo_container","show_logo","no");
		$panel1->addChild("show_logo_container",$show_logo_container);
		
			$logo_image = new EdgeField("image","logo_image",EDGE_ROOT."/img/logo.png","Logo Image - Normal","Choose a default logo image to display ");
			$show_logo_container->addChild("logo_image",$logo_image);
			
			$logo_image_light = new EdgeField("image","logo_image_light",EDGE_ROOT."/img/logo_white.png","Logo Image - Light",'Choose a logo image to display for "Light" header skin');
			$show_logo_container->addChild("logo_image_light",$logo_image_light);
			
			$logo_image_dark = new EdgeField("image","logo_image_dark",EDGE_ROOT."/img/logo_black.png","Logo Image - Dark",'Choose a logo image to display for "Dark" header skin');
			$show_logo_container->addChild("logo_image_dark",$logo_image_dark);
			
			$logo_image_sticky = new EdgeField("image","logo_image_sticky",EDGE_ROOT."/img/logo_black.png","Logo Image - Sticky Header",'Choose a logo image to display for "Sticky" header type');
			$show_logo_container->addChild("logo_image_sticky",$logo_image_sticky);
			
			$logo_image_fixed_hidden = new EdgeField("image","logo_image_fixed_hidden","","Logo Image - Fixed Advanced Header",'Choose a logo image to display for "Fixed Advanced" header type');
			$show_logo_container->addChild("logo_image_fixed_hidden",$logo_image_fixed_hidden);
			
			$logo_image_mobile = new EdgeField("image","logo_image_mobile","","Logo Image - Mobile Header",'Choose a logo image to display for "Mobile" header type');
			$show_logo_container->addChild("logo_image_mobile",$logo_image_mobile);

			$vertical_logo_bottom = new EdgeField("image","vertical_logo_bottom","","Side Menu Area Bottom Logo Image", 'Choose a logo image to display on the bottom of side menu area for "Initially Hidden" side menu area type');
			$show_logo_container->addChild("vertical_logo_bottom", $vertical_logo_bottom);
			
			$content_menu_logo_image = new EdgeField("image","content_menu_logo_image","","Content Menu Logo Image", 'Choose a logo image to display on the Content Menu');
			$show_logo_container->addChild("content_menu_logo_image", $content_menu_logo_image);

			