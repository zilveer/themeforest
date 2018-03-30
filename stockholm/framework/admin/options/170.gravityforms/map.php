<?php

$gravityformsPage = new QodeAdminPage("18", "Gravity Forms");
$qodeFramework->qodeOptions->addAdminPage("Gravity Forms",$gravityformsPage);

// General
$panel1 = new QodePanel("General","general_panel");
$gravityformsPage->addChild("panel1",$panel1);

	//Title style

	$group1 = new QodeGroup("Title Style","Define styles for forms Title");
	$panel1->addChild("group1",$group1);	

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);	

			$gf_title_color = new QodeField("colorsimple","gf_title_color","","Text Color","This is some description");
			$row1->addChild("gf_title_color",$gf_title_color);

			$gf_title_font_size = new QodeField("textsimple","gf_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("gf_title_font_size",$gf_title_font_size);

			$gf_title_line_height = new QodeField("textsimple","gf_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("gf_title_line_height",$gf_title_line_height);

			$gf_title_text_transform = new QodeField("selectblanksimple","gf_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("gf_title_text_transform",$gf_title_text_transform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$gf_title_font_family = new QodeField("Fontsimple","gf_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("gf_title_font_family",$gf_title_font_family);

			$gf_title_font_style = new QodeField("selectblanksimple","gf_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("gf_title_font_style",$gf_title_font_style);

			$gf_title_font_weight = new QodeField("selectblanksimple","gf_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("gf_title_font_weight",$gf_title_font_weight);

			$gf_title_letter_spacing = new QodeField("textsimple","gf_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("gf_title_letter_spacing",$gf_title_letter_spacing);

	//Input style		

	$group2 = new QodeGroup("Input Fields Style","Define styles for Input Fields");
	$panel1->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$gf_input_text_color = new QodeField("colorsimple","gf_input_text_color","","Text Color","This is some description");
			$row1->addChild("gf_input_text_color",$gf_input_text_color);		

			$gf_input_focus_text_color = new QodeField("colorsimple","gf_input_focus_text_color","","Focus Text Color","This is some description");
			$row1->addChild("gf_input_focus_text_color",$gf_input_focus_text_color);

			$gf_input_background_color = new QodeField("colorsimple","gf_input_background_color","","Background Color","This is some description");
			$row1->addChild("gf_input_background_color",$gf_input_background_color);

			$gf_input_focus_background_color = new QodeField("colorsimple","gf_input_focus_background_color","","Focus Background Color","This is some description");
			$row1->addChild("gf_input_focus_background_color",$gf_input_focus_background_color);

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);

			$gf_input_border_color = new QodeField("colorsimple","gf_input_border_color","","Border Color","This is some description");
			$row2->addChild("gf_input_border_color",$gf_input_border_color);

			$gf_input_focus_border_color = new QodeField("colorsimple","gf_input_focus_border_color","","Focus Border Color","This is some description");
			$row2->addChild("gf_input_focus_border_color",$gf_input_focus_border_color);

			$gf_input_border_width = new QodeField("textsimple","gf_input_border_width","","Border Width (px)","This is some description");
			$row2->addChild("gf_input_border_width",$gf_input_border_width);

	//Select Box style		

	$group3 = new QodeGroup("Drop Down Fields Style","Define styles for Drop Down fields");
	$panel1->addChild("group3",$group3);
		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);

			$gf_select_text_color = new QodeField("colorsimple","gf_select_text_color","","Text Color","This is some description");
			$row1->addChild("gf_select_text_color",$gf_select_text_color);

			$gf_select_background_color = new QodeField("colorsimple","gf_select_background_color","","Background Color","This is some description");
			$row1->addChild("gf_select_background_color",$gf_select_background_color);

			$gf_select_border_color = new QodeField("colorsimple","gf_select_border_color","","Border Color","This is some description");
			$row1->addChild("gf_select_border_color",$gf_select_border_color);	

	//Label style

	$group4 = new QodeGroup("Label Style","Define styles for input Labels");
	$panel1->addChild("group4",$group4);	

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);	

			$gf_label_color = new QodeField("colorsimple","gf_label_color","","Text Color","This is some description");
			$row1->addChild("gf_label_color",$gf_label_color);

			$gf_label_font_size = new QodeField("textsimple","gf_label_font_size","","Font Size (px)","This is some description");
			$row1->addChild("gf_label_font_size",$gf_label_font_size);

			$gf_label_line_height = new QodeField("textsimple","gf_label_line_height","","Line Height (px)","This is some description");
			$row1->addChild("gf_label_line_height",$gf_label_line_height);

			$gf_label_text_transform = new QodeField("selectblanksimple","gf_label_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("gf_label_text_transform",$gf_label_text_transform);

		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);

			$gf_label_font_family = new QodeField("Fontsimple","gf_label_font_family","-1","Font Family","This is some description");
			$row2->addChild("gf_label_font_family",$gf_label_font_family);

			$gf_label_font_style = new QodeField("selectblanksimple","gf_label_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("gf_label_font_style",$gf_label_font_style);

			$gf_label_font_weight = new QodeField("selectblanksimple","gf_label_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("gf_label_font_weight",$gf_label_font_weight);

			$gf_label_letter_spacing = new QodeField("textsimple","gf_label_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("gf_label_letter_spacing",$gf_label_letter_spacing);

		$row3 = new QodeRow(true);
		$group4->addChild("row3",$row3);

			$gf_label_require_color = new QodeField("colorsimple","gf_label_require_color","","Require Mark Color","This is some description");
			$row3->addChild("gf_label_require_color",$gf_label_require_color);
			
	//Description style

	$group5 = new QodeGroup("Description Style","Define styles for forms descriptions");
	$panel1->addChild("group5",$group5);	

		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);	

			$gf_description_color = new QodeField("colorsimple","gf_description_color","","Text Color","This is some description");
			$row1->addChild("gf_description_color",$gf_description_color);

			$gf_description_font_size = new QodeField("textsimple","gf_description_font_size","","Font Size (px)","This is some description");
			$row1->addChild("gf_description_font_size",$gf_description_font_size);

			$gf_description_line_height = new QodeField("textsimple","gf_description_line_height","","Line Height (px)","This is some description");
			$row1->addChild("gf_description_line_height",$gf_description_line_height);

			$gf_description_text_transform = new QodeField("selectblanksimple","gf_description_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("gf_description_text_transform",$gf_description_text_transform);

		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);

			$gf_description_font_family = new QodeField("Fontsimple","gf_description_font_family","-1","Font Family","This is some description");
			$row2->addChild("gf_description_font_family",$gf_description_font_family);

			$gf_description_font_style = new QodeField("selectblanksimple","gf_description_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("gf_description_font_style",$gf_description_font_style);

			$gf_description_font_weight = new QodeField("selectblanksimple","gf_description_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("gf_description_font_weight",$gf_description_font_weight);

			$gf_description_letter_spacing = new QodeField("textsimple","gf_description_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("gf_description_letter_spacing",$gf_description_letter_spacing);

	//Button style		

	$group6 = new QodeGroup("Button Style","Define styles for buttons");
	$panel1->addChild("group6",$group6);
		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);

			$gf_button_text_color = new QodeField("colorsimple","gf_button_text_color","","Text Color","This is some description");
			$row1->addChild("gf_button_text_color",$gf_button_text_color);		

			$gf_button_focus_text_color = new QodeField("colorsimple","gf_button_focus_text_color","","Focus Text Color","This is some description");
			$row1->addChild("gf_button_focus_text_color",$gf_button_focus_text_color);

			$gf_button_background_color = new QodeField("colorsimple","gf_button_background_color","","Background Color","This is some description");
			$row1->addChild("gf_button_background_color",$gf_button_background_color);

			$gf_button_focus_background_color = new QodeField("colorsimple","gf_button_focus_background_color","","Focus Background Color","This is some description");
			$row1->addChild("gf_button_focus_background_color",$gf_button_focus_background_color);

		$row2 = new QodeRow(true);
		$group6->addChild("row2",$row2);

			$gf_button_border_color = new QodeField("colorsimple","gf_button_border_color","","Border Color","This is some description");
			$row2->addChild("gf_button_border_color",$gf_button_border_color);

			$gf_button_focus_border_color = new QodeField("colorsimple","gf_button_focus_border_color","","Focus Border Color","This is some description");
			$row2->addChild("gf_button_focus_border_color",$gf_button_focus_border_color);

			$gf_button_border_width = new QodeField("textsimple","gf_button_border_width","","Border Width (px)","This is some description");
			$row2->addChild("gf_button_border_width",$gf_button_border_width);			