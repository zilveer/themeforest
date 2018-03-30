<?php

$sidebarPage = new QodeAdminPage("7", "Sidebar");
$qodeFramework->qodeOptions->addAdminPage("sidebar",$sidebarPage);

$panel2 = new QodePanel("General Style", "general_style");
$sidebarPage->addChild("panel2",$panel2);

	$sidebar_alignment = new QodeField("select","sidebar_alignment","default","Sidebar Text Alignment","Choose alignment for sidebar.", array(
		"" 			=> "Default",
		"left" 		=> "Left",
		"center" 	=> "Center",
		"right" 	=> "Right"
	));
	$panel2->addChild("sidebar_alignment",$sidebar_alignment);

	$sidebar_widget_border = new QodeField("select","sidebar_widget_border","default","Border Around Widgets","Enable this option to display border around widgets.", array(
		"" 			=> "Default",
		"no" 		=> "No",
		"yes" 		=> "Yes"
	));
	$panel2->addChild("sidebar_widget_border",$sidebar_widget_border);

$panel1 = new QodePanel("Widget Style","widget_style");
$sidebarPage->addChild("panel1",$panel1);

	$group1 = new QodeGroup("Title Style","Define styles for widgets title.");
	$panel1->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$sidebar_title_color = new QodeField("colorsimple","sidebar_title_color","","Text Color","This is some description");
			$row1->addChild("sidebar_title_color",$sidebar_title_color);

			$sidebar_title_font_size = new QodeField("textsimple","sidebar_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("sidebar_title_font_size",$sidebar_title_font_size);

			$sidebar_title_line_height = new QodeField("textsimple","sidebar_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("sidebar_title_line_height",$sidebar_title_line_height);

			$sidebar_title_text_transform = new QodeField("selectblanksimple","sidebar_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("sidebar_title_text_transform",$sidebar_title_text_transform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$sidebar_title_font_family = new QodeField("Fontsimple","sidebar_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("sidebar_title_font_family",$sidebar_title_font_family);

			$sidebar_title_font_style = new QodeField("selectblanksimple","sidebar_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("sidebar_title_font_style",$sidebar_title_font_style);

			$sidebar_title_font_weight = new QodeField("selectblanksimple","sidebar_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("sidebar_title_font_weight",$sidebar_title_font_weight);

			$sidebar_title_letter_spacing = new QodeField("textsimple","sidebar_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("sidebar_title_letter_spacing",$sidebar_title_letter_spacing);

		$row3 = new QodeRow(true);	
		$group1->addChild("row3",$row3);
			$sidebar_title_background = new QodeField("colorsimple","sidebar_title_background","","Background Color","This is some description");
			$row3->addChild("sidebar_title_background",$sidebar_title_background);

			$sidebar_title_border_color = new QodeField("colorsimple","sidebar_title_border_color","","Border Color","This is some description");
			$row3->addChild("sidebar_title_border_color",$sidebar_title_border_color);

	$group2 = new QodeGroup("Link Style","Define styles for widget links.");
	$panel1->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$sidebar_link_color = new QodeField("colorsimple","sidebar_link_color","","Text Color","This is some description");
			$row1->addChild("sidebar_link_color",$sidebar_link_color);

			$sidebar_link_font_size = new QodeField("textsimple","sidebar_link_font_size","","Font Size (px)","This is some description");
			$row1->addChild("sidebar_link_font_size",$sidebar_link_font_size);

			$sidebar_link_line_height = new QodeField("textsimple","sidebar_link_line_height","","Line Height (px)","This is some description");
			$row1->addChild("sidebar_link_line_height",$sidebar_link_line_height);

			$sidebar_link_text_transform = new QodeField("selectblanksimple","sidebar_link_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("sidebar_link_text_transform",$sidebar_link_text_transform);

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$sidebar_link_font_family = new QodeField("Fontsimple","sidebar_link_font_family","-1","Font Family","This is some description");
			$row2->addChild("sidebar_link_font_family",$sidebar_link_font_family);

			$sidebar_link_font_style = new QodeField("selectblanksimple","sidebar_link_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("sidebar_link_font_style",$sidebar_link_font_style);

			$sidebar_link_font_weight = new QodeField("selectblanksimple","sidebar_link_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("sidebar_link_font_weight",$sidebar_link_font_weight);

			$sidebar_link_letter_spacing = new QodeField("textsimple","sidebar_link_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("sidebar_link_letter_spacing",$sidebar_link_letter_spacing);

		$row3 = new QodeRow(true);	
		$group2->addChild("row3",$row3);
			$sidebar_link_hover_color = new QodeField("colorsimple","sidebar_link_hover_color","","Hover Color","This is some description");
			$row3->addChild("sidebar_link_hover_color",$sidebar_link_hover_color);