<?php

$footerPage = new QodeAdminPage("3", "Footer");
$qodeFramework->qodeOptions->addAdminPage("footer",$footerPage);

	$panel10 = new QodePanel("Footer","footer_panel");
	$footerPage->addChild("panel10",$panel10);

	$uncovering_footer = new QodeField("yesno","uncovering_footer","no","Uncovering Footer","Enabling this option will make Footer gradually appear on scroll");
	$panel10->addChild("uncovering_footer",$uncovering_footer);

	$footer_in_grid = new QodeField("yesno","footer_in_grid","yes","Footer in Grid","Enabling this option will place Footer content in grid");
	$panel10->addChild("footer_in_grid",$footer_in_grid);

	$show_footer_top = new QodeField("yesno","show_footer_top","yes","Show Footer Top","Enabling this option will show Footer Top area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_show_footer_top_container"));
	$panel10->addChild("show_footer_top",$show_footer_top);

	$show_footer_top_container = new QodeContainer("show_footer_top_container","show_footer_top","no");
	$panel10->addChild("show_footer_top_container",$show_footer_top_container);

	$footer_top_columns = new QodeField("select","footer_top_columns","4","Footer Top Columns","Choose number of columns for Footer Top area", array( 
			"1" => "1",
			"2" => "2",
			"3" => "3",
			"5" => "3(25%+25%+50%)",
			"6" => "3(50%+25%+25%)",
			"4" => "4"
	      ));
	$show_footer_top_container->addChild("footer_top_columns",$footer_top_columns);

	$footer_border_columns = new QodeField("yesno","footer_border_columns","yes","Border Between Columns","Disabling this option will remove border between footer columns.");
	$show_footer_top_container->addChild("footer_border_columns",$footer_border_columns);

	$group1 = new QodeGroup("Footer Top Area Style","Configure style for Footer Top area");
	$show_footer_top_container->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$footer_top_background_color = new QodeField("colorsimple","footer_top_background_color","","Background Color","This is some description");
			$row1->addChild("footer_top_background_color",$footer_top_background_color);
			$footer_top_border_color = new QodeField("colorsimple","footer_top_border_color","","Top Border Color","This is some description");
			$row1->addChild("footer_top_border_color",$footer_top_border_color);
			$footer_top_border_in_grid = new QodeField("yesnosimple","footer_top_border_in_grid","no","Set Top Border In Grid","");
			$row1->addChild("footer_top_border_in_grid",$footer_top_border_in_grid);
			$footer_columns_border_color = new QodeField("colorsimple","footer_columns_border_color","","Columns Border Color","This is some description");
			$row1->addChild("footer_columns_border_color",$footer_columns_border_color);
		$row2 = new QodeRow();
		$group1->addChild("row2",$row2);	
			$footer_top_padding = new QodeField("textsimple","footer_top_padding","","Top Padding(px)","This is some description");
			$row2->addChild("footer_top_padding",$footer_top_padding);
			$footer_bottom_padding = new QodeField("textsimple","footer_bottom_padding","","Bottom Padding(px)","This is some description");
			$row2->addChild("footer_bottom_padding",$footer_bottom_padding);

	$group2 = new QodeGroup("Footer Top Title Style","Configure style for Footer Top title");
	$show_footer_top_container->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$footer_title_color = new QodeField("colorsimple","footer_title_color","","Text Color","This is some description");
			$row1->addChild("footer_title_color",$footer_title_color);

			$footer_title_font_size = new QodeField("textsimple","footer_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("footer_title_font_size",$footer_title_font_size);

			$footer_title_line_height = new QodeField("textsimple","footer_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("footer_title_line_height",$footer_title_line_height);

			$footer_title_text_transform = new QodeField("selectblanksimple","footer_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("footer_title_text_transform",$footer_title_text_transform);

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$footer_title_font_family = new QodeField("Fontsimple","footer_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("footer_title_font_family",$footer_title_font_family);

			$footer_title_font_style = new QodeField("selectblanksimple","footer_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("footer_title_font_style",$footer_title_font_style);

			$footer_title_font_weight = new QodeField("selectblanksimple","footer_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("footer_title_font_weight",$footer_title_font_weight);

			$footer_title_letter_spacing = new QodeField("textsimple","footer_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("footer_title_letter_spacing",$footer_title_letter_spacing);

	$group3 = new QodeGroup("Footer Top Text Style","Configure style for Footer Top text");
	$show_footer_top_container->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$footer_top_text_color = new QodeField("colorsimple","footer_top_text_color","","Text Color","This is some description");
			$row1->addChild("footer_top_text_color",$footer_top_text_color);

			$footer_top_text_font_size = new QodeField("textsimple","footer_top_text_font_size","","Font Size (px)","This is some description");
			$row1->addChild("footer_top_text_font_size",$footer_top_text_font_size);

			$footer_top_text_line_height = new QodeField("textsimple","footer_top_text_line_height","","Line Height (px)","This is some description");
			$row1->addChild("footer_top_text_line_height",$footer_top_text_line_height);

			$footer_top_text_text_transform = new QodeField("selectblanksimple","footer_top_text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("footer_top_text_text_transform",$footer_top_text_text_transform);

		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$footer_top_text_font_family = new QodeField("Fontsimple","footer_top_text_font_family","-1","Font Family","This is some description");
			$row2->addChild("footer_top_text_font_family",$footer_top_text_font_family);

			$footer_top_text_font_style = new QodeField("selectblanksimple","footer_top_text_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("footer_top_text_font_style",$footer_top_text_font_style);

			$footer_top_text_font_weight = new QodeField("selectblanksimple","footer_top_text_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("footer_top_text_font_weight",$footer_top_text_font_weight);

			$footer_top_text_letter_spacing = new QodeField("textsimple","footer_top_text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("footer_top_text_letter_spacing",$footer_top_text_letter_spacing);
			
	$group4 = new QodeGroup("Footer Top Link Style","Configure style for Footer Top link");
	$show_footer_top_container->addChild("group4",$group4);

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$footer_top_link_color = new QodeField("colorsimple","footer_top_link_color","","Text Color","This is some description");
			$row1->addChild("footer_top_link_color",$footer_top_link_color);

			$footer_top_link_font_size = new QodeField("textsimple","footer_top_link_font_size","","Font Size (px)","This is some description");
			$row1->addChild("footer_top_link_font_size",$footer_top_link_font_size);

			$footer_top_link_line_height = new QodeField("textsimple","footer_top_link_line_height","","Line Height (px)","This is some description");
			$row1->addChild("footer_top_link_line_height",$footer_top_link_line_height);

			$footer_top_link_text_transform = new QodeField("selectblanksimple","footer_top_link_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("footer_top_link_text_transform",$footer_top_link_text_transform);

		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$footer_top_link_font_family = new QodeField("Fontsimple","footer_top_link_font_family","-1","Font Family","This is some description");
			$row2->addChild("footer_top_link_font_family",$footer_top_link_font_family);

			$footer_top_link_font_style = new QodeField("selectblanksimple","footer_top_link_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("footer_top_link_font_style",$footer_top_link_font_style);

			$footer_top_link_font_weight = new QodeField("selectblanksimple","footer_top_link_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("footer_top_link_font_weight",$footer_top_link_font_weight);

			$footer_top_link_letter_spacing = new QodeField("textsimple","footer_top_link_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("footer_top_link_letter_spacing",$footer_top_link_letter_spacing);

		$row3 = new QodeRow(true);
		$group4->addChild("row3",$row3);
			$footer_top_link_hover_color = new QodeField("colorsimple","footer_top_link_hover_color","","Text Hover Color","This is some description");
			$row3->addChild("footer_top_link_hover_color",$footer_top_link_hover_color);				


	$footer_text = new QodeField("yesno","footer_text","yes","Show Footer Bottom","Enabling this option will show Footer Bottom area", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_footer_text_container"));
	$panel10->addChild("footer_text",$footer_text);
	$footer_text_container = new QodeContainer("footer_text_container","footer_text","no");
	$panel10->addChild("footer_text_container",$footer_text_container);


	$group5 = new QodeGroup("Footer Bottom Area Style","Configure style for Footer Bottom area");
	$footer_text_container->addChild("group5",$group5);

		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);
			$footer_bottom_height = new QodeField("textsimple","footer_bottom_height","","Height (px)","This is some description");
			$row1->addChild("footer_bottom_height",$footer_bottom_height);
			$footer_bottom_background_color = new QodeField("colorsimple","footer_bottom_background_color","","Background Color","This is some description");
			$row1->addChild("footer_bottom_background_color",$footer_bottom_background_color);
			$footer_bottom_border_color = new QodeField("colorsimple","footer_bottom_border_color","","Top Border Color","This is some description");
			$row1->addChild("footer_bottom_border_color",$footer_bottom_border_color);
			$footer_bottom_border_in_grid = new QodeField("yesnosimple","footer_bottom_border_in_grid","no","Set Top Border In Grid","");
			$row1->addChild("footer_bottom_border_in_grid",$footer_bottom_border_in_grid);

	$group6 = new QodeGroup("Footer Bottom Text Style","Configure style for Footer Bottom text");
	$footer_text_container->addChild("group6",$group6);

		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);
			$footer_bottom_text_color = new QodeField("colorsimple","footer_bottom_text_color","","Text Color","This is some description");
			$row1->addChild("footer_bottom_text_color",$footer_bottom_text_color);

			$footer_bottom_text_font_size = new QodeField("textsimple","footer_bottom_text_font_size","","Font Size (px)","This is some description");
			$row1->addChild("footer_bottom_text_font_size",$footer_bottom_text_font_size);

			$footer_bottom_text_line_height = new QodeField("textsimple","footer_bottom_text_line_height","","Line Height (px)","This is some description");
			$row1->addChild("footer_bottom_text_line_height",$footer_bottom_text_line_height);

			$footer_bottom_text_text_transform = new QodeField("selectblanksimple","footer_bottom_text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("footer_bottom_text_text_transform",$footer_bottom_text_text_transform);

		$row2 = new QodeRow(true);
		$group6->addChild("row2",$row2);
			$footer_bottom_text_font_family = new QodeField("Fontsimple","footer_bottom_text_font_family","-1","Font Family","This is some description");
			$row2->addChild("footer_bottom_text_font_family",$footer_bottom_text_font_family);

			$footer_bottom_text_font_style = new QodeField("selectblanksimple","footer_bottom_text_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("footer_bottom_text_font_style",$footer_bottom_text_font_style);

			$footer_bottom_text_font_weight = new QodeField("selectblanksimple","footer_bottom_text_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("footer_bottom_text_font_weight",$footer_bottom_text_font_weight);

			$footer_bottom_text_letter_spacing = new QodeField("textsimple","footer_bottom_text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("footer_bottom_text_letter_spacing",$footer_bottom_text_letter_spacing);
			
	$group7 = new QodeGroup("Footer Bottom Link Style","Configure style for Footer Bottom link");
	$footer_text_container->addChild("group7",$group7);

		$row1 = new QodeRow();
		$group7->addChild("row1",$row1);
			$footer_bottom_link_color = new QodeField("colorsimple","footer_bottom_link_color","","Text Color","This is some description");
			$row1->addChild("footer_bottom_link_color",$footer_bottom_link_color);

			$footer_bottom_link_font_size = new QodeField("textsimple","footer_bottom_link_font_size","","Font Size (px)","This is some description");
			$row1->addChild("footer_bottom_link_font_size",$footer_bottom_link_font_size);

			$footer_bottom_link_line_height = new QodeField("textsimple","footer_bottom_link_line_height","","Line Height (px)","This is some description");
			$row1->addChild("footer_bottom_link_line_height",$footer_bottom_link_line_height);

			$footer_bottom_link_text_transform = new QodeField("selectblanksimple","footer_bottom_link_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("footer_bottom_link_text_transform",$footer_bottom_link_text_transform);

		$row2 = new QodeRow(true);
		$group7->addChild("row2",$row2);
			$footer_bottom_link_font_family = new QodeField("Fontsimple","footer_bottom_link_font_family","-1","Font Family","This is some description");
			$row2->addChild("footer_bottom_link_font_family",$footer_bottom_link_font_family);

			$footer_bottom_link_font_style = new QodeField("selectblanksimple","footer_bottom_link_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("footer_bottom_link_font_style",$footer_bottom_link_font_style);

			$footer_bottom_link_font_weight = new QodeField("selectblanksimple","footer_bottom_link_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("footer_bottom_link_font_weight",$footer_bottom_link_font_weight);

			$footer_bottom_link_letter_spacing = new QodeField("textsimple","footer_bottom_link_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("footer_bottom_link_letter_spacing",$footer_bottom_link_letter_spacing);

		$row3 = new QodeRow(true);
		$group7->addChild("row3",$row3);
			$footer_bottom_link_hover_color = new QodeField("colorsimple","footer_bottom_link_hover_color","","Text Hover Color","This is some description");
			$row3->addChild("footer_bottom_link_hover_color",$footer_bottom_link_hover_color);		