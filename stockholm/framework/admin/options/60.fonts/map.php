<?php

$fontsPage = new QodeAdminPage("5", "Fonts");
$qodeFramework->qodeOptions->addAdminPage("fonts",$fontsPage);

// Headings

$panel1 = new QodePanel("Headings", "headings_panel");
$fontsPage->addChild("panel1",$panel1);

	$group1 = new QodeGroup("H1 Style","Define styles for H1 heading");
	$panel1->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$h1_color = new QodeField("colorsimple","h1_color","","Text Color","This is some description");
			$row1->addChild("h1_color",$h1_color);
			$h1_fontsize = new QodeField("textsimple","h1_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("h1_fontsize",$h1_fontsize);
			$h1_lineheight = new QodeField("textsimple","h1_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("h1_lineheight",$h1_lineheight);
			$h1_texttransform = new QodeField("selectblanksimple","h1_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("h1_texttransform",$h1_texttransform);
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$h1_google_fonts = new QodeField("Fontsimple","h1_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("h1_google_fonts",$h1_google_fonts);
			$h1_fontstyle = new QodeField("selectblanksimple","h1_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("h1_fontstyle",$h1_fontstyle);
			$h1_fontweight = new QodeField("selectblanksimple","h1_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("h1_fontweight",$h1_fontweight);
			$h1_letterspacing = new QodeField("textsimple","h1_letterspacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("h1_letterspacing",$h1_letterspacing);
			
	$group2 = new QodeGroup("H2 Style","Define styles for H2 heading");
	$panel1->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$h2_color = new QodeField("colorsimple","h2_color","","Text Color","This is some description");
			$row1->addChild("h2_color",$h2_color);
			$h2_fontsize = new QodeField("textsimple","h2_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("h2_fontsize",$h2_fontsize);
			$h2_lineheight = new QodeField("textsimple","h2_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("h2_lineheight",$h2_lineheight);
			$h2_texttransform = new QodeField("selectblanksimple","h2_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("h2_texttransform",$h2_texttransform);
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$h2_google_fonts = new QodeField("Fontsimple","h2_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("h2_google_fonts",$h2_google_fonts);
			$h2_fontstyle = new QodeField("selectblanksimple","h2_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("h2_fontstyle",$h2_fontstyle);
			$h2_fontweight = new QodeField("selectblanksimple","h2_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("h2_fontweight",$h2_fontweight);
			$h2_letterspacing = new QodeField("textsimple","h2_letterspacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("h2_letterspacing",$h2_letterspacing);
			
	$group3 = new QodeGroup("H3 Style","Define styles for H3 heading");
	$panel1->addChild("group3",$group3);
		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$h3_color = new QodeField("colorsimple","h3_color","","Text Color","This is some description");
			$row1->addChild("h3_color",$h3_color);
			$h3_fontsize = new QodeField("textsimple","h3_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("h3_fontsize",$h3_fontsize);
			$h3_lineheight = new QodeField("textsimple","h3_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("h3_lineheight",$h3_lineheight);
			$h3_texttransform = new QodeField("selectblanksimple","h3_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("h3_texttransform",$h3_texttransform);
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$h3_google_fonts = new QodeField("Fontsimple","h3_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("h3_google_fonts",$h3_google_fonts);
			$h3_fontstyle = new QodeField("selectblanksimple","h3_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("h3_fontstyle",$h3_fontstyle);
			$h3_fontweight = new QodeField("selectblanksimple","h3_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("h3_fontweight",$h3_fontweight);
			$h3_letterspacing = new QodeField("textsimple","h3_letterspacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("h3_letterspacing",$h3_letterspacing);
			
	$group4 = new QodeGroup("H4 Style","Define styles for H4 heading");
	$panel1->addChild("group4",$group4);
		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$h4_color = new QodeField("colorsimple","h4_color","","Text Color","This is some description");
			$row1->addChild("h4_color",$h4_color);
			$h4_fontsize = new QodeField("textsimple","h4_fontsize","","Font size (px)","This is some description");
			$row1->addChild("h4_fontsize",$h4_fontsize);
			$h4_lineheight = new QodeField("textsimple","h4_lineheight","","Line height (px)","This is some description");
			$row1->addChild("h4_lineheight",$h4_lineheight);
			$h4_texttransform = new QodeField("selectblanksimple","h4_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("h4_texttransform",$h4_texttransform);
		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$h4_google_fonts = new QodeField("Fontsimple","h4_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("h4_google_fonts",$h4_google_fonts);
			$h4_fontstyle = new QodeField("selectblanksimple","h4_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("h4_fontstyle",$h4_fontstyle);
			$h4_fontweight = new QodeField("selectblanksimple","h4_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("h4_fontweight",$h4_fontweight);
			$h4_letterspacing = new QodeField("textsimple","h4_letterspacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("h4_letterspacing",$h4_letterspacing);
			
	$group5 = new QodeGroup("H5 style","Define styles for H5 heading");
	$panel1->addChild("group5",$group5);
		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);
			$h5_color = new QodeField("colorsimple","h5_color","","Text Color","This is some description");
			$row1->addChild("h5_color",$h5_color);
			$h5_fontsize = new QodeField("textsimple","h5_fontsize","","Font size (px)","This is some description");
			$row1->addChild("h5_fontsize",$h5_fontsize);
			$h5_lineheight = new QodeField("textsimple","h5_lineheight","","Line height (px)","This is some description");
			$row1->addChild("h5_lineheight",$h5_lineheight);
			$h5_texttransform = new QodeField("selectblanksimple","h5_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("h5_texttransform",$h5_texttransform);
		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);
			$h5_google_fonts = new QodeField("Fontsimple","h5_google_fonts","-1","Font family","This is some description");
			$row2->addChild("h5_google_fonts",$h5_google_fonts);
			$h5_fontstyle = new QodeField("selectblanksimple","h5_fontstyle","","Font style","This is some description",$options_fontstyle);
			$row2->addChild("h5_fontstyle",$h5_fontstyle);
			$h5_fontweight = new QodeField("selectblanksimple","h5_fontweight","","Font weight","This is some description",$options_fontweight);
			$row2->addChild("h5_fontweight",$h5_fontweight);
			$h5_letterspacing = new QodeField("textsimple","h5_letterspacing","","Letter spacing (px)","This is some description");
			$row2->addChild("h5_letterspacing",$h5_letterspacing);
			
	$group6 = new QodeGroup("H6 Style","Define styles for H6 heading");
	$panel1->addChild("group6",$group6);
		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);
			$h6_color = new QodeField("colorsimple","h6_color","","Text Color","This is some description");
			$row1->addChild("h6_color",$h6_color);
			$h6_fontsize = new QodeField("textsimple","h6_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("h6_fontsize",$h6_fontsize);
			$h6_lineheight = new QodeField("textsimple","h6_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("h6_lineheight",$h6_lineheight);
			$h6_texttransform = new QodeField("selectblanksimple","h6_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("h6_texttransform",$h6_texttransform);
		$row2 = new QodeRow(true);
		$group6->addChild("row2",$row2);
			$h6_google_fonts = new QodeField("Fontsimple","h6_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("h6_google_fonts",$h6_google_fonts);
			$h6_fontstyle = new QodeField("selectblanksimple","h6_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("h6_fontstyle",$h6_fontstyle);
			$h6_fontweight = new QodeField("selectblanksimple","h6_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("h6_fontweight",$h6_fontweight);
			$h6_letterspacing = new QodeField("textsimple","h6_letterspacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("h6_letterspacing",$h6_letterspacing);

// Text

$panel2 = new QodePanel("Text", "text_panel");
$fontsPage->addChild("panel2",$panel2);

	$group1 = new QodeGroup("Paragraph","Define styles for paragraph text");
	$panel2->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$text_color = new QodeField("colorsimple","text_color","","Text Color","This is some description");
			$row1->addChild("text_color",$text_color);
			$text_fontsize = new QodeField("textsimple","text_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("text_fontsize",$text_fontsize);
			$text_lineheight = new QodeField("textsimple","text_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("text_lineheight",$text_lineheight);
			$text_text_transform = new QodeField("selectblanksimple","text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("text_text_transform",$text_text_transform);
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$text_google_fonts = new QodeField("Fontsimple","text_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("text_google_fonts",$text_google_fonts);
			$text_fontstyle = new QodeField("selectblanksimple","text_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("text_fontstyle",$text_fontstyle);
			$text_fontweight = new QodeField("selectblanksimple","text_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("text_fontweight",$text_fontweight);
			$text_letter_spacing = new QodeField("textsimple","text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("text_letter_spacing",$text_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);	
			$text_margin = new QodeField("textsimple","text_margin","","Top/Bottom Margin (px)","This is some description");
			$row3->addChild("text_margin",$text_margin);

	$group2 = new QodeGroup("Links","Define styles for link text");
	$panel2->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$link_color = new QodeField("colorsimple","link_color","","Text Color","This is some description");
			$row1->addChild("link_color",$link_color);
			$link_hovercolor = new QodeField("colorsimple","link_hovercolor","","Hover Text Color","This is some description");
			$row1->addChild("link_hovercolor",$link_hovercolor);
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$link_fontstyle = new QodeField("selectblanksimple","link_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("link_fontstyle",$link_fontstyle);
			$link_fontweight = new QodeField("selectblanksimple","link_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("link_fontweight",$link_fontweight);
			$link_fontdecoration = new QodeField("selectblanksimple","link_fontdecoration","","Font Decoration","This is some description",$options_fontdecoration);
			$row2->addChild("link_fontdecoration",$link_fontdecoration);

// Header & Menu

$panel4 = new QodePanel("Header & Menu", "header_and_menu_panel");
$fontsPage->addChild("panel4",$panel4);

	$group1 = new QodeGroup("1st Level Menu","Define styles for 1st level in Top Navigation Menu");
	$panel4->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$menu_color = new QodeField("colorsimple","menu_color","","Text Color","This is some description");
			$row1->addChild("menu_color",$menu_color);
			$menu_hovercolor = new QodeField("colorsimple","menu_hovercolor","","Hover Text Color","This is some description");
			$row1->addChild("menu_hovercolor",$menu_hovercolor);
			$menu_activecolor = new QodeField("colorsimple","menu_activecolor","","Active Text Color","This is some description");
			$row1->addChild("menu_activecolor",$menu_activecolor);
			$menu_hover_background_color = new QodeField("colorsimple","menu_hover_background_color","","Hover Text Background Color","This is some description");
			$row1->addChild("menu_hover_background_color",$menu_hover_background_color);
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$menu_google_fonts = new QodeField("Fontsimple","menu_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("menu_google_fonts",$menu_google_fonts);
			$menu_fontsize = new QodeField("textsimple","menu_fontsize","","Font Size (px)","This is some description");
			$row2->addChild("menu_fontsize",$menu_fontsize);
			$menu_lineheight = new QodeField("textsimple","menu_lineheight","","Line Height (px)","This is some description");
			$row2->addChild("menu_lineheight",$menu_lineheight);
			$menu_hover_background_color_transparency = new QodeField("textsimple","menu_hover_background_color_transparency","","Hover Background Color Transparency","This is some description");
			$row2->addChild("menu_hover_background_color_transparency",$menu_hover_background_color_transparency);
		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);
			$menu_fontstyle = new QodeField("selectblanksimple","menu_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("menu_fontstyle",$menu_fontstyle);
			$menu_fontweight = new QodeField("selectblanksimple","menu_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("menu_fontweight",$menu_fontweight);
			$menu_letterspacing = new QodeField("textsimple","menu_letterspacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("menu_letterspacing",$menu_letterspacing);
			$menu_texttransform = new QodeField("selectblanksimple","menu_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row3->addChild("menu_texttransform",$menu_texttransform);
		$row4 = new QodeRow(true);
		$group1->addChild("row4",$row4);
			$menu_padding_left_right = new QodeField("textsimple","menu_padding_left_right","","Padding Left/Right(px)","This is some description");
			$row4->addChild("menu_padding_left_right",$menu_padding_left_right);
			$menu_separator_color = new QodeField("colorsimple","menu_separator_color","","Separator Color","This is some description");
			$row4->addChild("menu_separator_color",$menu_separator_color);
			$menu_remove_separator_between_items = new QodeField("yesnosimple","menu_remove_separator_between_items","no","Remove Separator Between Items","");
			$row4->addChild("menu_remove_separator_between_items",$menu_remove_separator_between_items);	

	$group2 = new QodeGroup("2nd Level Menu","Define styles for 2nd level in Top Navigation Menu");
	$panel4->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$dropdown_color = new QodeField("colorsimple","dropdown_color","","Text Color","This is some description");
			$row1->addChild("dropdown_color",$dropdown_color);
			$dropdown_hovercolor = new QodeField("colorsimple","dropdown_hovercolor","","Hover/Active Color","This is some description");
			$row1->addChild("dropdown_hovercolor",$dropdown_hovercolor);
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$dropdown_google_fonts = new QodeField("Fontsimple","dropdown_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("dropdown_google_fonts",$dropdown_google_fonts);
			$dropdown_fontsize = new QodeField("textsimple","dropdown_fontsize","","Font Size (px)","This is some description");
			$row2->addChild("dropdown_fontsize",$dropdown_fontsize);
			$dropdown_lineheight = new QodeField("textsimple","dropdown_lineheight","","Line Height (px)","This is some description");
			$row2->addChild("dropdown_lineheight",$dropdown_lineheight);
			$dropdown_padding_top_bottom = new QodeField("textsimple","dropdown_padding_top_bottom","","Padding Top/Bottom","This is some description");
			$row2->addChild("dropdown_padding_top_bottom",$dropdown_padding_top_bottom);
		$row3 = new QodeRow(true);
		$group2->addChild("row3",$row3);
			$dropdown_fontstyle = new QodeField("selectblanksimple","dropdown_fontstyle","","Font style","This is some description",$options_fontstyle);
			$row3->addChild("dropdown_fontstyle",$dropdown_fontstyle);
			$dropdown_fontweight = new QodeField("selectblanksimple","dropdown_fontweight","","Font weight","This is some description",$options_fontweight);
			$row3->addChild("dropdown_fontweight",$dropdown_fontweight);
			$dropdown_letterspacing = new QodeField("textsimple","dropdown_letterspacing","","Letter spacing (px)","This is some description");
			$row3->addChild("dropdown_letterspacing",$dropdown_letterspacing);
			$dropdown_texttransform = new QodeField("selectblanksimple","dropdown_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row3->addChild("dropdown_texttransform",$dropdown_texttransform);

	$group3 = new QodeGroup("2nd Level Wide Menu","Define styles for 2nd level in Wide Menu");
	$panel4->addChild("group3",$group3);
		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$dropdown_wide_color = new QodeField("colorsimple","dropdown_wide_color","","Text Color","This is some description");
			$row1->addChild("dropdown_wide_color",$dropdown_wide_color);
			$dropdown_wide_hovercolor = new QodeField("colorsimple","dropdown_wide_hovercolor","","Hover Text Color","This is some description");
			$row1->addChild("dropdown_wide_hovercolor",$dropdown_wide_hovercolor);
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$dropdown_wide_google_fonts = new QodeField("Fontsimple","dropdown_wide_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("dropdown_wide_google_fonts",$dropdown_wide_google_fonts);
			$dropdown_wide_fontsize = new QodeField("textsimple","dropdown_wide_fontsize","","Font Size (px)","This is some description");
			$row2->addChild("dropdown_wide_fontsize",$dropdown_wide_fontsize);
			$dropdown_wide_lineheight = new QodeField("textsimple","dropdown_wide_lineheight","","Line Height (px)","This is some description");
			$row2->addChild("dropdown_wide_lineheight",$dropdown_wide_lineheight);
		$row3 = new QodeRow(true);
		$group3->addChild("row3",$row3);
			$dropdown_wide_fontstyle = new QodeField("selectblanksimple","dropdown_wide_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("dropdown_wide_fontstyle",$dropdown_wide_fontstyle);
			$dropdown_wide_fontweight = new QodeField("selectblanksimple","dropdown_wide_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("dropdown_wide_fontweight",$dropdown_wide_fontweight);
			$dropdown_wide_letterspacing = new QodeField("textsimple","dropdown_wide_letterspacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("dropdown_wide_letterspacing",$dropdown_wide_letterspacing);
			$dropdown_wide_texttransform = new QodeField("selectblanksimple","dropdown_wide_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row3->addChild("dropdown_wide_texttransform",$dropdown_wide_texttransform);

	$group4 = new QodeGroup("3rd Level Menu","Define styles for 3nd level in Top Navigation Menu");
	$panel4->addChild("group4",$group4);
		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$dropdown_color_thirdlvl = new QodeField("colorsimple","dropdown_color_thirdlvl","","Text Color","This is some description");
			$row1->addChild("dropdown_color_thirdlvl",$dropdown_color_thirdlvl);
			$dropdown_hovercolor_thirdlvl = new QodeField("colorsimple","dropdown_hovercolor_thirdlvl","","Hover/Active Color","This is some description");
			$row1->addChild("dropdown_hovercolor_thirdlvl",$dropdown_hovercolor_thirdlvl);
		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$dropdown_google_fonts_thirdlvl = new QodeField("Fontsimple","dropdown_google_fonts_thirdlvl","-1","Font Family","This is some description");
			$row2->addChild("dropdown_google_fonts_thirdlvl",$dropdown_google_fonts_thirdlvl);
			$dropdown_fontsize_thirdlvl = new QodeField("textsimple","dropdown_fontsize_thirdlvl","","Font Size (px)","This is some description");
			$row2->addChild("dropdown_fontsize_thirdlvl",$dropdown_fontsize_thirdlvl);
			$dropdown_lineheight_thirdlvl = new QodeField("textsimple","dropdown_lineheight_thirdlvl","","Line Height (px)","This is some description");
			$row2->addChild("dropdown_lineheight_thirdlvl",$dropdown_lineheight_thirdlvl);
		$row3 = new QodeRow(true);
		$group4->addChild("row3",$row3);
			$dropdown_fontstyle_thirdlvl = new QodeField("selectblanksimple","dropdown_fontstyle_thirdlvl","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("dropdown_fontstyle_thirdlvl",$dropdown_fontstyle_thirdlvl);
			$dropdown_fontweight_thirdlvl = new QodeField("selectblanksimple","dropdown_fontweight_thirdlvl","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("dropdown_fontweight_thirdlvl",$dropdown_fontweight_thirdlvl);
			$dropdown_letterspacing_thirdlvl = new QodeField("textsimple","dropdown_letterspacing_thirdlvl","","Letter Spacing (px)","This is some description");
			$row3->addChild("dropdown_letterspacing",$dropdown_letterspacing_thirdlvl);
			$dropdown_texttransform_thirdlvl = new QodeField("selectblanksimple","dropdown_texttransform_thirdlvl","","Text Transform","This is some description",$options_texttransform);
			$row3->addChild("dropdown_texttransform_thirdlvl",$dropdown_texttransform_thirdlvl);

	$group5 = new QodeGroup("Fixed Menu","Define styles for Fixed Menu");
	$panel4->addChild("group5",$group5);
		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);
			$fixed_color = new QodeField("colorsimple","fixed_color","","Text Color","This is some description");
			$row1->addChild("fixed_color",$fixed_color);
			$fixed_hovercolor = new QodeField("colorsimple","fixed_hovercolor","","Hover/Active Color","This is some description");
			$row1->addChild("fixed_hovercolor",$fixed_hovercolor);
		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);
			$fixed_google_fonts = new QodeField("Fontsimple","fixed_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("fixed_google_fonts",$fixed_google_fonts);
			$fixed_fontsize = new QodeField("textsimple","fixed_fontsize","","Font Size (px)","This is some description");
			$row2->addChild("fixed_fontsize",$fixed_fontsize);
			$fixed_lineheight = new QodeField("textsimple","fixed_lineheight","","Line height (px)","This is some description");
			$row2->addChild("fixed_lineheight",$fixed_lineheight);
			$fixed_texttransform = new QodeField("selectblanksimple","fixed_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("fixed_texttransform",$fixed_texttransform);
		$row3 = new QodeRow(true);
		$group5->addChild("row3",$row3);
			$fixed_fontstyle = new QodeField("selectblanksimple","fixed_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("fixed_fontstyle",$fixed_fontstyle);
			$fixed_fontweight = new QodeField("selectblanksimple","fixed_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("fixed_fontweight",$fixed_fontweight);
			$fixed_letterspacing = new QodeField("textsimple","fixed_letterspacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("fixed_letterspacing",$fixed_letterspacing);

	$group6 = new QodeGroup("Sticky Menu","Define styles for Sticky Menu");
	$panel4->addChild("group6",$group6);
		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);
			$sticky_color = new QodeField("colorsimple","sticky_color","","Text Color","This is some description");
			$row1->addChild("sticky_color",$sticky_color);
			$sticky_hovercolor = new QodeField("colorsimple","sticky_hovercolor","","Hover/Active color","This is some description");
			$row1->addChild("sticky_hovercolor",$sticky_hovercolor);
		$row2 = new QodeRow(true);
		$group6->addChild("row2",$row2);
			$sticky_google_fonts = new QodeField("Fontsimple","sticky_google_fonts","-1","Font family","This is some description");
			$row2->addChild("sticky_google_fonts",$sticky_google_fonts);
			$sticky_fontsize = new QodeField("textsimple","sticky_fontsize","","Font size (px)","This is some description");
			$row2->addChild("sticky_fontsize",$sticky_fontsize);
			$sticky_lineheight = new QodeField("textsimple","sticky_lineheight","","Line height (px)","This is some description");
			$row2->addChild("sticky_lineheight",$sticky_lineheight);
			$sticky_texttransform = new QodeField("selectblanksimple","sticky_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("sticky_texttransform",$sticky_texttransform);
		$row3 = new QodeRow(true);
		$group6->addChild("row3",$row3);
			$sticky_fontstyle = new QodeField("selectblanksimple","sticky_fontstyle","","Font style","This is some description",$options_fontstyle);
			$row3->addChild("sticky_fontstyle",$sticky_fontstyle);
			$sticky_fontweight = new QodeField("selectblanksimple","sticky_fontweight","","Font weight","This is some description",$options_fontweight);
			$row3->addChild("sticky_fontweight",$sticky_fontweight);
			$sticky_letterspacing = new QodeField("textsimple","sticky_letterspacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("sticky_letterspacing",$sticky_letterspacing);

	$group7 = new QodeGroup("Mobile Menu","Define styles for Mobile Menu (as seen on small screens)");
	$panel4->addChild("group7",$group7);
		$row1 = new QodeRow();
		$group7->addChild("row1",$row1);
			$mobile_color = new QodeField("colorsimple","mobile_color","","Text Color","This is some description");
			$row1->addChild("mobile_color",$mobile_color);
			$mobile_hovercolor = new QodeField("colorsimple","mobile_hovercolor","","Hover/Active Color","This is some description");
			$row1->addChild("mobile_hovercolor",$mobile_hovercolor);
		$row2 = new QodeRow(true);
		$group7->addChild("row2",$row2);
			$mobile_google_fonts = new QodeField("Fontsimple","mobile_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("mobile_google_fonts",$mobile_google_fonts);
			$mobile_fontsize = new QodeField("textsimple","mobile_fontsize","","Font Size (px)","This is some description");
			$row2->addChild("mobile_fontsize",$mobile_fontsize);
			$mobile_lineheight = new QodeField("textsimple","mobile_lineheight","","Line Height (px)","This is some description");
			$row2->addChild("mobile_lineheight",$mobile_lineheight);
			$mobile_texttransform = new QodeField("selectblanksimple","mobile_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("mobile_texttransform",$mobile_texttransform);
		$row3 = new QodeRow(true);
		$group7->addChild("row3",$row3);
			$mobile_fontstyle = new QodeField("selectblanksimple","mobile_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("mobile_fontstyle",$mobile_fontstyle);
			$mobile_fontweight = new QodeField("selectblanksimple","mobile_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("mobile_fontweight",$mobile_fontweight);
			$mobile_letter_spacing = new QodeField("textsimple","mobile_letter_spacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("mobile_letter_spacing",$mobile_letter_spacing);

	$group8 = new QodeGroup("Header Top","Define styles for Header Top area");
	$panel4->addChild("group8",$group8);
		$row1 = new QodeRow();
		$group8->addChild("row1",$row1);
			$top_header_text_color = new QodeField("colorsimple","top_header_text_color","","Text Color","This is some description");
			$row1->addChild("top_header_text_color",$top_header_text_color);
			$top_header_text_hover_color = new QodeField("colorsimple","top_header_text_hover_color","","Hover Text Color","This is some description");
			$row1->addChild("top_header_text_hover_color",$top_header_text_hover_color);
		$row2 = new QodeRow(true);
		$group8->addChild("row2",$row2);
			$top_header_text_font_family = new QodeField("Fontsimple","top_header_text_font_family","-1","Font Family","This is some description");
			$row2->addChild("top_header_text_font_family",$top_header_text_font_family);
			$top_header_text_font_size = new QodeField("textsimple","top_header_text_font_size","","Font Size (px)","This is some description");
			$row2->addChild("top_header_text_font_size",$top_header_text_font_size);
			$top_header_text_line_height = new QodeField("textsimple","top_header_text_line_height","","Line Height (px)","This is some description");
			$row2->addChild("top_header_text_line_height",$top_header_text_line_height);
			$top_header_text_texttransform = new QodeField("selectblanksimple","top_header_text_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("top_header_text_texttransform",$top_header_text_texttransform);
		$row3 = new QodeRow(true);
		$group8->addChild("row3",$row3);
		$group8->addChild("row3",$row3);
			$top_header_text_font_style = new QodeField("selectblanksimple","top_header_text_font_style","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("top_header_text_font_style",$top_header_text_font_style);
			$top_header_text_font_weight = new QodeField("selectblanksimple","top_header_text_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("top_header_text_font_weight",$top_header_text_font_weight);
			$top_header_text_letter_spacing = new QodeField("textsimple","top_header_text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("top_header_text_letter_spacing",$top_header_text_letter_spacing);

// Page title, subtitle and breadcrumbs

$panel3 = new QodePanel("Page Title Style","page_title_panel");
$fontsPage->addChild("panel3",$panel3);

	$group1 = new QodeGroup("Title","Define styles for page title");
	$panel3->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$page_title_color = new QodeField("colorsimple","page_title_color","","Text Color","This is some description");
			$row1->addChild("page_title_color",$page_title_color);
			$page_title_fontsize = new QodeField("textsimple","page_title_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("page_title_fontsize",$page_title_fontsize);
			$page_title_lineheight = new QodeField("textsimple","page_title_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("page_title_lineheight",$page_title_lineheight);
			$page_title_texttransform = new QodeField("selectblanksimple","page_title_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("page_title_texttransform",$page_title_texttransform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$page_title_google_fonts = new QodeField("Fontsimple","page_title_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("page_title_google_fonts",$page_title_google_fonts);
			$page_title_fontstyle = new QodeField("selectblanksimple","page_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("page_title_fontstyle",$page_title_fontstyle);
			$page_title_fontweight = new QodeField("selectblanksimple","page_title_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("page_title_fontweight",$page_title_fontweight);
			$page_title_letter_spacing = new QodeField("textsimple","page_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("page_title_letter_spacing",$page_title_letter_spacing);

	$group2 = new QodeGroup("Subtitle","Define styles for page subtitle");
	$panel3->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$page_subtitle_color = new QodeField("colorsimple","page_subtitle_color","","Text Color","This is some description");
			$row1->addChild("page_subtitle_color",$page_subtitle_color);
			$page_subtitle_fontsize = new QodeField("textsimple","page_subtitle_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("page_subtitle_fontsize",$page_subtitle_fontsize);
			$page_subtitle_lineheight = new QodeField("textsimple","page_subtitle_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("page_subtitle_lineheight",$page_subtitle_lineheight);
			$page_subtitle_texttransform = new QodeField("selectblanksimple","page_subtitle_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("page_subtitle_texttransform",$page_subtitle_texttransform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$page_subtitle_google_fonts = new QodeField("Fontsimple","page_subtitle_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("page_subtitle_google_fonts",$page_subtitle_google_fonts);
			$page_subtitle_fontstyle = new QodeField("selectblanksimple","page_subtitle_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("page_subtitle_fontstyle",$page_subtitle_fontstyle);
			$page_subtitle_fontweight = new QodeField("selectblanksimple","page_subtitle_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("page_subtitle_fontweight",$page_subtitle_fontweight);
			$page_subtitle_letter_spacing = new QodeField("textsimple","page_subtitle_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("page_subtitle_letter_spacing",$page_subtitle_letter_spacing);

	$group3 = new QodeGroup("Breadcrumbs","Define styles for page breadcrumbs");
	$panel3->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$page_breadcrumb_color = new QodeField("colorsimple","page_breadcrumb_color","","Text Color","This is some description");
			$row1->addChild("page_breadcrumb_color",$page_breadcrumb_color);
			$page_breadcrumb_fontsize = new QodeField("textsimple","page_breadcrumb_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("page_breadcrumb_fontsize",$page_breadcrumb_fontsize);
			$page_breadcrumb_lineheight = new QodeField("textsimple","page_breadcrumb_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("page_breadcrumb_lineheight",$page_breadcrumb_lineheight);
			$page_breadcrumb_texttransform = new QodeField("selectblanksimple","page_breadcrumb_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("page_breadcrumb_texttransform",$page_breadcrumb_texttransform);
			
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$page_breadcrumb_google_fonts = new QodeField("Fontsimple","page_breadcrumb_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("page_breadcrumb_google_fonts",$page_breadcrumb_google_fonts);
			$page_breadcrumb_fontstyle = new QodeField("selectblanksimple","page_breadcrumb_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("page_breadcrumb_fontstyle",$page_breadcrumb_fontstyle);
			$page_breadcrumb_fontweight = new QodeField("selectblanksimple","page_breadcrumb_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("page_breadcrumb_fontweight",$page_breadcrumb_fontweight);
			$page_breadcrumb_letter_spacing = new QodeField("textsimple","page_breadcrumb_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("page_breadcrumb_letter_spacing",$page_breadcrumb_letter_spacing);

		$row3 = new QodeRow(true);
		$group3->addChild("row3",$row3);
			$page_breadcrumb_hovercolor = new QodeField("colorsimple","page_breadcrumb_hovercolor","","Hover/Active Color","This is some description");
			$row3->addChild("page_breadcrumb_hovercolor",$page_breadcrumb_hovercolor);					

// Portfolio List and Blog List

$panel5 = new QodePanel("Filter Style for Portfolio and Blog Masonry Lists","portfolio_blog_panel");
$fontsPage->addChild("panel5",$panel5);

	$portfolio_filter_margin_bottom = new QodeField("text","portfolio_filter_margin_bottom","","Filter Bottom Margin (px)","This option define bottom margin for filter area. Default value is 36.");
	$panel5->addChild("portfolio_filter_margin_bottom",$portfolio_filter_margin_bottom);

	$group1 = new QodeGroup("Filter Title","Define styles for filter title");
	$panel5->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$portfolio_filter_title_color = new QodeField("colorsimple","portfolio_filter_title_color","","Text Color","This is some description");
			$row1->addChild("portfolio_filter_title_color",$portfolio_filter_title_color);
			$portfolio_filter_title_font_size = new QodeField("textsimple","portfolio_filter_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_filter_title_font_size",$portfolio_filter_title_font_size);
			$portfolio_filter_title_line_height = new QodeField("textsimple","portfolio_filter_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_filter_title_line_height",$portfolio_filter_title_line_height);
			$portfolio_filter_title_text_transform = new QodeField("selectblanksimple","portfolio_filter_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_filter_title_text_transform",$portfolio_filter_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$portfolio_filter_title_font_family = new QodeField("Fontsimple","portfolio_filter_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_filter_title_font_family",$portfolio_filter_title_font_family);
			$portfolio_filter_title_font_style = new QodeField("selectblanksimple","portfolio_filter_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_filter_title_font_style",$portfolio_filter_title_font_style);
			$portfolio_filter_title_font_weight = new QodeField("selectblanksimple","portfolio_filter_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_filter_title_font_weight",$portfolio_filter_title_font_weight);
			$portfolio_filter_title_letter_spacing = new QodeField("textsimple","portfolio_filter_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_filter_title_letter_spacing",$portfolio_filter_title_letter_spacing);

	$group2 = new QodeGroup("Filter Categories","Define styles for filter categories");
	$panel5->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$portfolio_filter_color = new QodeField("colorsimple","portfolio_filter_color","","Text Color","This is some description");
			$row1->addChild("portfolio_filter_color",$portfolio_filter_color);
			$portfolio_filter_font_size = new QodeField("textsimple","portfolio_filter_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_filter_font_size",$portfolio_filter_font_size);
			$portfolio_filter_line_height = new QodeField("textsimple","portfolio_filter_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_filter_line_height",$portfolio_filter_line_height);
			$portfolio_filter_text_transform = new QodeField("selectblanksimple","portfolio_filter_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_filter_text_transform",$portfolio_filter_text_transform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$portfolio_filter_font_family = new QodeField("Fontsimple","portfolio_filter_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_filter_font_family",$portfolio_filter_font_family);
			$portfolio_filter_font_style = new QodeField("selectblanksimple","portfolio_filter_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_filter_font_style",$portfolio_filter_font_style);
			$portfolio_filter_font_weight = new QodeField("selectblanksimple","portfolio_filter_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_filter_font_weight",$portfolio_filter_font_weight);
			$portfolio_filter_letter_spacing = new QodeField("textsimple","portfolio_filter_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_filter_letter_spacing",$portfolio_filter_letter_spacing);

		$row3 = new QodeRow(true);
		$group2->addChild("row3",$row3);
			$portfolio_filter_hovercolor = new QodeField("colorsimple","portfolio_filter_hovercolor","","Hover/Active Color","This is some description");
			$row3->addChild("portfolio_filter_hovercolor",$portfolio_filter_hovercolor);
			
	$portfolio_filter_disable_separator = new QodeField("yesno","portfolio_filter_disable_separator","yes","Disable Separator Between Categories","Disabling this option will remove separator between filter categories.");
	$panel5->addChild("portfolio_filter_disable_separator",$portfolio_filter_disable_separator);

// Portfolio List

$panel6 = new QodePanel("Portfolio List","portfolio_panel");
$fontsPage->addChild("panel6",$panel6);

	$group1 = new QodeGroup("Title Style for Standard and Pinterest Lists","Define title styles for standard and pinterest portfolio lists.");
	$panel6->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$portfolio_title_standard_list_color = new QodeField("colorsimple","portfolio_title_standard_list_color","","Text Color","This is some description");
			$row1->addChild("portfolio_title_standard_list_color",$portfolio_title_standard_list_color);
			$portfolio_title_standard_list_font_size = new QodeField("textsimple","portfolio_title_standard_list_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_title_standard_list_font_size",$portfolio_title_standard_list_font_size);
			$portfolio_title_standard_list_line_height = new QodeField("textsimple","portfolio_title_standard_list_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_title_standard_list_line_height",$portfolio_title_standard_list_line_height);
			$portfolio_title_standard_list_text_transform = new QodeField("selectblanksimple","portfolio_title_standard_list_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_title_standard_list_text_transform",$portfolio_title_standard_list_text_transform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$portfolio_title_standard_list_font_family = new QodeField("Fontsimple","portfolio_title_standard_list_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_title_standard_list_font_family",$portfolio_title_standard_list_font_family);
			$portfolio_title_standard_list_font_style = new QodeField("selectblanksimple","portfolio_title_standard_list_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_title_standard_list_font_style",$portfolio_title_standard_list_font_style);
			$portfolio_title_standard_list_font_weight = new QodeField("selectblanksimple","portfolio_title_standard_list_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_title_standard_list_font_weight",$portfolio_title_standard_list_font_weight);
			$portfolio_title_standard_list_letter_spacing = new QodeField("textsimple","portfolio_title_standard_list_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_title_standard_list_letter_spacing",$portfolio_title_standard_list_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);
			$portfolio_title_standard_list_hover_color = new QodeField("colorsimple","portfolio_title_standard_list_hover_color","","Hover Color","This is some description");
			$row3->addChild("portfolio_title_standard_list_hover_color",$portfolio_title_standard_list_hover_color);

	$group2 = new QodeGroup("Category Style for Standard and Pinterest Lists","Define category styles for standard and pinterest portfolio lists.");
	$panel6->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$portfolio_category_standard_list_color = new QodeField("colorsimple","portfolio_category_standard_list_color","","Text Color","This is some description");
			$row1->addChild("portfolio_category_standard_list_color",$portfolio_category_standard_list_color);
			$portfolio_category_standard_list_font_size = new QodeField("textsimple","portfolio_category_standard_list_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_category_standard_list_font_size",$portfolio_category_standard_list_font_size);
			$portfolio_category_standard_list_line_height = new QodeField("textsimple","portfolio_category_standard_list_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_category_standard_list_line_height",$portfolio_category_standard_list_line_height);
			$portfolio_category_standard_list_text_transform = new QodeField("selectblanksimple","portfolio_category_standard_list_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_category_standard_list_text_transform",$portfolio_category_standard_list_text_transform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$portfolio_category_standard_list_font_family = new QodeField("Fontsimple","portfolio_category_standard_list_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_category_standard_list_font_family",$portfolio_category_standard_list_font_family);
			$portfolio_category_standard_list_font_style = new QodeField("selectblanksimple","portfolio_category_standard_list_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_category_standard_list_font_style",$portfolio_category_standard_list_font_style);
			$portfolio_category_standard_list_font_weight = new QodeField("selectblanksimple","portfolio_category_standard_list_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_category_standard_list_font_weight",$portfolio_category_standard_list_font_weight);
			$portfolio_category_standard_list_letter_spacing = new QodeField("textsimple","portfolio_category_standard_list_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_category_standard_list_letter_spacing",$portfolio_category_standard_list_letter_spacing);
			
	$group3 = new QodeGroup("Title Style for Gallery and Masonry Lists","Define title styles for gallery and masonry portfolio lists.");
	$panel6->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$portfolio_title_list_color = new QodeField("colorsimple","portfolio_title_list_color","","Text Color","This is some description");
			$row1->addChild("portfolio_title_list_color",$portfolio_title_list_color);
			$portfolio_title_list_font_size = new QodeField("textsimple","portfolio_title_list_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_title_list_font_size",$portfolio_title_list_font_size);
			$portfolio_title_list_line_height = new QodeField("textsimple","portfolio_title_list_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_title_list_line_height",$portfolio_title_list_line_height);
			$portfolio_title_list_text_transform = new QodeField("selectblanksimple","portfolio_title_list_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_title_list_text_transform",$portfolio_title_list_text_transform);
			
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$portfolio_title_list_font_family = new QodeField("Fontsimple","portfolio_title_list_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_title_list_font_family",$portfolio_title_list_font_family);
			$portfolio_title_list_font_style = new QodeField("selectblanksimple","portfolio_title_list_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_title_list_font_style",$portfolio_title_list_font_style);
			$portfolio_title_list_font_weight = new QodeField("selectblanksimple","portfolio_title_list_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_title_list_font_weight",$portfolio_title_list_font_weight);
			$portfolio_title_list_letter_spacing = new QodeField("textsimple","portfolio_title_list_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_title_list_letter_spacing",$portfolio_title_list_letter_spacing);
			
	$group4 = new QodeGroup("Category Style for Gallery and Masonry Lists","Define category styles for gallery and masonry portfolio lists.");
	$panel6->addChild("group4",$group4);

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$portfolio_category_list_color = new QodeField("colorsimple","portfolio_category_list_color","","Text Color","This is some description");
			$row1->addChild("portfolio_category_list_color",$portfolio_category_list_color);
			$portfolio_category_list_font_size = new QodeField("textsimple","portfolio_category_list_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_category_list_font_size",$portfolio_category_list_font_size);
			$portfolio_category_list_line_height = new QodeField("textsimple","portfolio_category_list_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_category_list_line_height",$portfolio_category_list_line_height);
			$portfolio_category_list_text_transform = new QodeField("selectblanksimple","portfolio_category_list_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_category_list_text_transform",$portfolio_category_list_text_transform);
			
		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$portfolio_category_list_font_family = new QodeField("Fontsimple","portfolio_category_list_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_category_list_font_family",$portfolio_category_list_font_family);
			$portfolio_category_list_font_style = new QodeField("selectblanksimple","portfolio_category_list_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_category_list_font_style",$portfolio_category_list_font_style);
			$portfolio_category_list_font_weight = new QodeField("selectblanksimple","portfolio_category_list_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_category_list_font_weight",$portfolio_category_list_font_weight);
			$portfolio_category_list_letter_spacing = new QodeField("textsimple","portfolio_category_list_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_category_list_letter_spacing",$portfolio_category_list_letter_spacing);
			
// Portfolio Single

$panel61 = new QodePanel("Portfolio Single","portfolio_single_panel");
$fontsPage->addChild("panel61",$panel61);

	$group1 = new QodeGroup("Title Style for Big Images, Big Slider and Gallery Layout","Define title styles for portfolio single big images, big slider and gallery layout.");
	$panel61->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$portfolio_single_big_title_color = new QodeField("colorsimple","portfolio_single_big_title_color","","Text Color","This is some description");
			$row1->addChild("portfolio_single_big_title_color",$portfolio_single_big_title_color);
			$portfolio_single_big_title_font_size = new QodeField("textsimple","portfolio_single_big_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_single_big_title_font_size",$portfolio_single_big_title_font_size);
			$portfolio_single_big_title_line_height = new QodeField("textsimple","portfolio_single_big_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_single_big_title_line_height",$portfolio_single_big_title_line_height);
			$portfolio_single_big_title_text_transform = new QodeField("selectblanksimple","portfolio_single_big_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_single_big_title_text_transform",$portfolio_single_big_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$portfolio_single_big_title_font_family = new QodeField("Fontsimple","portfolio_single_big_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_single_big_title_font_family",$portfolio_single_big_title_font_family);
			$portfolio_single_big_title_font_style = new QodeField("selectblanksimple","portfolio_single_big_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_single_big_title_font_style",$portfolio_single_big_title_font_style);
			$portfolio_single_big_title_font_weight = new QodeField("selectblanksimple","portfolio_single_big_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_single_big_title_font_weight",$portfolio_single_big_title_font_weight);
			$portfolio_single_big_title_letter_spacing = new QodeField("textsimple","portfolio_single_big_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_single_big_title_letter_spacing",$portfolio_single_big_title_letter_spacing);

	$group2 = new QodeGroup("Title Style for Small Images and Small Slider Layout","Define title styles for portfolio single small images and small slider layout.");
	$panel61->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$portfolio_single_small_title_color = new QodeField("colorsimple","portfolio_single_small_title_color","","Text Color","This is some description");
			$row1->addChild("portfolio_single_small_title_color",$portfolio_single_small_title_color);
			$portfolio_single_small_title_font_size = new QodeField("textsimple","portfolio_single_small_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_single_small_title_font_size",$portfolio_single_small_title_font_size);
			$portfolio_single_small_title_line_height = new QodeField("textsimple","portfolio_single_small_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_single_small_title_line_height",$portfolio_single_small_title_line_height);
			$portfolio_single_small_title_text_transform = new QodeField("selectblanksimple","portfolio_single_small_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_single_small_title_text_transform",$portfolio_single_small_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$portfolio_single_small_title_font_family = new QodeField("Fontsimple","portfolio_single_small_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_single_small_title_font_family",$portfolio_single_small_title_font_family);
			$portfolio_single_small_title_font_style = new QodeField("selectblanksimple","portfolio_single_small_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_single_small_title_font_style",$portfolio_single_small_title_font_style);
			$portfolio_single_small_title_font_weight = new QodeField("selectblanksimple","portfolio_single_small_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_single_small_title_font_weight",$portfolio_single_small_title_font_weight);
			$portfolio_single_small_title_letter_spacing = new QodeField("textsimple","portfolio_single_small_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_single_small_title_letter_spacing",$portfolio_single_small_title_letter_spacing);
			
	$group3 = new QodeGroup("Title Info Style","Define info title (date, categories, custom) styles.");
	$panel61->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$portfolio_single_meta_title_color = new QodeField("colorsimple","portfolio_single_meta_title_color","","Text Color","This is some description");
			$row1->addChild("portfolio_single_meta_title_color",$portfolio_single_meta_title_color);
			$portfolio_single_meta_title_font_size = new QodeField("textsimple","portfolio_single_meta_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_single_meta_title_font_size",$portfolio_single_meta_title_font_size);
			$portfolio_single_meta_title_line_height = new QodeField("textsimple","portfolio_single_meta_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_single_meta_title_line_height",$portfolio_single_meta_title_line_height);
			$portfolio_single_meta_title_text_transform = new QodeField("selectblanksimple","portfolio_single_meta_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_single_meta_title_text_transform",$portfolio_single_meta_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$portfolio_single_meta_title_font_family = new QodeField("Fontsimple","portfolio_single_meta_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_single_meta_title_font_family",$portfolio_single_meta_title_font_family);
			$portfolio_single_meta_title_font_style = new QodeField("selectblanksimple","portfolio_single_meta_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_single_meta_title_font_style",$portfolio_single_meta_title_font_style);
			$portfolio_single_meta_title_font_weight = new QodeField("selectblanksimple","portfolio_single_meta_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_single_meta_title_font_weight",$portfolio_single_meta_title_font_weight);
			$portfolio_single_meta_title_letter_spacing = new QodeField("textsimple","portfolio_single_meta_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_single_meta_title_letter_spacing",$portfolio_single_meta_title_letter_spacing);

	$group4 = new QodeGroup("Text Info Style","Define info text styles.");
	$panel61->addChild("group4",$group4);

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$portfolio_single_meta_text_color = new QodeField("colorsimple","portfolio_single_meta_text_color","","Text Color","This is some description");
			$row1->addChild("portfolio_single_meta_text_color",$portfolio_single_meta_text_color);
			$portfolio_single_meta_text_font_size = new QodeField("textsimple","portfolio_single_meta_text_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_single_meta_text_font_size",$portfolio_single_meta_text_font_size);
			$portfolio_single_meta_text_line_height = new QodeField("textsimple","portfolio_single_meta_text_line_height","","Line Height (px)","This is some description");
			$row1->addChild("portfolio_single_meta_text_line_height",$portfolio_single_meta_text_line_height);
			$portfolio_single_meta_text_text_transform = new QodeField("selectblanksimple","portfolio_single_meta_text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("portfolio_single_meta_text_text_transform",$portfolio_single_meta_text_text_transform);
			
		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$portfolio_single_meta_text_font_family = new QodeField("Fontsimple","portfolio_single_meta_text_font_family","-1","Font Family","This is some description");
			$row2->addChild("portfolio_single_meta_text_font_family",$portfolio_single_meta_text_font_family);
			$portfolio_single_meta_text_font_style = new QodeField("selectblanksimple","portfolio_single_meta_text_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("portfolio_single_meta_text_font_style",$portfolio_single_meta_text_font_style);
			$portfolio_single_meta_text_font_weight = new QodeField("selectblanksimple","portfolio_single_meta_text_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("portfolio_single_meta_text_font_weight",$portfolio_single_meta_text_font_weight);
			$portfolio_single_meta_text_letter_spacing = new QodeField("textsimple","portfolio_single_meta_text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("portfolio_single_meta_text_letter_spacing",$portfolio_single_meta_text_letter_spacing);			

// Blog List and Single

$panel9 = new QodePanel("Blog Info","blog_list_single_panel");
$fontsPage->addChild("panel9",$panel9);

	$group1 = new QodeGroup("Blog Info Style","Applied to both blog list and single. Define info (date, categories, author, etc.) styles.");
	$panel9->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$blog_list_info_color = new QodeField("colorsimple","blog_list_info_color","","Text Color","This is some description");
			$row1->addChild("blog_list_info_color",$blog_list_info_color);
			$blog_list_info_font_size = new QodeField("textsimple","blog_list_info_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_list_info_font_size",$blog_list_info_font_size);
			$blog_list_info_line_height = new QodeField("textsimple","blog_list_info_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_list_info_line_height",$blog_list_info_line_height);
			$blog_list_info_text_transform = new QodeField("selectblanksimple","blog_list_info_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_list_info_text_transform",$blog_list_info_text_transform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$blog_list_info_font_family = new QodeField("Fontsimple","blog_list_info_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_list_info_font_family",$blog_list_info_font_family);
			$blog_list_info_font_style = new QodeField("selectblanksimple","blog_list_info_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_list_info_font_style",$blog_list_info_font_style);
			$blog_list_info_font_weight = new QodeField("selectblanksimple","blog_list_info_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_list_info_font_weight",$blog_list_info_font_weight);
			$blog_list_info_letter_spacing = new QodeField("textsimple","blog_list_info_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_list_info_letter_spacing",$blog_list_info_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);
			$blog_list_info_hover_color = new QodeField("colorsimple","blog_list_info_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_list_info_hover_color",$blog_list_info_hover_color);

// Blog List

$panel7 = new QodePanel("Blog List","blog_panel");
$fontsPage->addChild("panel7",$panel7);	

	$group2 = new QodeGroup("Blog Large Image Title Style","Define title styles for Blog Large Image template.");
	$panel7->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$blog_large_image_title_color = new QodeField("colorsimple","blog_large_image_title_color","","Text Color","This is some description");
			$row1->addChild("blog_large_image_title_color",$blog_large_image_title_color);
			$blog_large_image_title_fontsize = new QodeField("textsimple","blog_large_image_title_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("blog_large_image_title_fontsize",$blog_large_image_title_fontsize);
			$blog_large_image_title_lineheight = new QodeField("textsimple","blog_large_image_title_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("blog_large_image_title_lineheight",$blog_large_image_title_lineheight);
			$blog_large_image_title_texttransform = new QodeField("selectblanksimple","blog_large_image_title_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_large_image_title_texttransform",$blog_large_image_title_texttransform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$blog_large_image_title_google_fonts = new QodeField("Fontsimple","blog_large_image_title_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("blog_large_image_title_google_fonts",$blog_large_image_title_google_fonts);
			$blog_large_image_title_fontstyle = new QodeField("selectblanksimple","blog_large_image_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_large_image_title_fontstyle",$blog_large_image_title_fontstyle);
			$blog_large_image_title_fontweight = new QodeField("selectblanksimple","blog_large_image_title_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_large_image_title_fontweight",$blog_large_image_title_fontweight);
			$blog_large_image_title_letter_spacing = new QodeField("textsimple","blog_large_image_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_large_image_title_letter_spacing",$blog_large_image_title_letter_spacing);

		$row3 = new QodeRow(true);
		$group2->addChild("row3",$row3);
			$blog_large_image_title_hover_color = new QodeField("colorsimple","blog_large_image_title_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_large_image_title_hover_color",$blog_large_image_title_hover_color);

	$group1 = new QodeGroup("Blog Large Image Quote/Link Title Style","Define title styles for Quote/Link articles on Blog Large Image template.");
	$panel7->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$blog_large_image_ql_title_color = new QodeField("colorsimple","blog_large_image_ql_title_color","","Text Color","This is some description");
			$row1->addChild("blog_large_image_ql_title_color",$blog_large_image_ql_title_color);
			$blog_large_image_ql_title_font_size = new QodeField("textsimple","blog_large_image_ql_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_large_image_ql_title_font_size",$blog_large_image_ql_title_font_size);
			$blog_large_image_ql_title_line_height = new QodeField("textsimple","blog_large_image_ql_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_large_image_ql_title_line_height",$blog_large_image_ql_title_line_height);
			$blog_large_image_ql_title_text_transform = new QodeField("selectblanksimple","blog_large_image_ql_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_large_image_ql_title_text_transform",$blog_large_image_ql_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$blog_large_image_ql_title_font_family = new QodeField("Fontsimple","blog_large_image_ql_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_large_image_ql_title_font_family",$blog_large_image_ql_title_font_family);
			$blog_large_image_ql_title_font_style = new QodeField("selectblanksimple","blog_large_image_ql_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_large_image_ql_title_font_style",$blog_large_image_ql_title_font_style);
			$blog_large_image_ql_title_font_weight = new QodeField("selectblanksimple","blog_large_image_ql_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_large_image_ql_title_font_weight",$blog_large_image_ql_title_font_weight);
			$blog_large_image_ql_title_letter_spacing = new QodeField("textsimple","blog_large_image_ql_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_large_image_ql_title_letter_spacing",$blog_large_image_ql_title_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);
			$blog_large_image_ql_title_hover_color = new QodeField("colorsimple","blog_large_image_ql_title_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_large_image_ql_title_hover_color",$blog_large_image_ql_title_hover_color);		

	$group3 = new QodeGroup("Blog Masonry/Pinterest Title Style","Define title styles for Blog Masonry/Pinterest template.");
	$panel7->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$blog_masonry_title_color = new QodeField("colorsimple","blog_masonry_title_color","","Text Color","This is some description");
			$row1->addChild("blog_masonry_title_color",$blog_masonry_title_color);
			$blog_masonry_title_font_size = new QodeField("textsimple","blog_masonry_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_masonry_title_font_size",$blog_masonry_title_font_size);
			$blog_masonry_title_line_height = new QodeField("textsimple","blog_masonry_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_masonry_title_line_height",$blog_masonry_title_line_height);
			$blog_masonry_title_text_transform = new QodeField("selectblanksimple","blog_masonry_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_masonry_title_text_transform",$blog_masonry_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$blog_masonry_title_font_family = new QodeField("Fontsimple","blog_masonry_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_masonry_title_font_family",$blog_masonry_title_font_family);
			$blog_masonry_title_font_style = new QodeField("selectblanksimple","blog_masonry_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_masonry_title_font_style",$blog_masonry_title_font_style);
			$blog_masonry_title_font_weight = new QodeField("selectblanksimple","blog_masonry_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_masonry_title_font_weight",$blog_masonry_title_font_weight);
			$blog_masonry_title_letter_spacing = new QodeField("textsimple","blog_masonry_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_masonry_title_letter_spacing",$blog_masonry_title_letter_spacing);

		$row3 = new QodeRow(true);
		$group3->addChild("row3",$row3);
			$blog_masonry_title_hover_color = new QodeField("colorsimple","blog_masonry_title_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_masonry_title_hover_color",$blog_masonry_title_hover_color);

	$group4 = new QodeGroup("Blog Masonry/Pinterest Quote/Link Title Style","Define title styles for Quote/Link articles on Blog Masonry/Pinterest template.");
	$panel7->addChild("group4",$group4);

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$blog_masonry_ql_title_color = new QodeField("colorsimple","blog_masonry_ql_title_color","","Text Color","This is some description");
			$row1->addChild("blog_masonry_ql_title_color",$blog_masonry_ql_title_color);
			$blog_masonry_ql_title_font_size = new QodeField("textsimple","blog_masonry_ql_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_masonry_ql_title_font_size",$blog_masonry_ql_title_font_size);
			$blog_masonry_ql_title_line_height = new QodeField("textsimple","blog_masonry_ql_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_masonry_ql_title_line_height",$blog_masonry_ql_title_line_height);
			$blog_masonry_ql_title_text_transform = new QodeField("selectblanksimple","blog_masonry_ql_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_masonry_ql_title_text_transform",$blog_masonry_ql_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$blog_masonry_ql_title_font_family = new QodeField("Fontsimple","blog_masonry_ql_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_masonry_ql_title_font_family",$blog_masonry_ql_title_font_family);
			$blog_masonry_ql_title_font_style = new QodeField("selectblanksimple","blog_masonry_ql_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_masonry_ql_title_font_style",$blog_masonry_ql_title_font_style);
			$blog_masonry_ql_title_font_weight = new QodeField("selectblanksimple","blog_masonry_ql_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_masonry_ql_title_font_weight",$blog_masonry_ql_title_font_weight);
			$blog_masonry_ql_title_letter_spacing = new QodeField("textsimple","blog_masonry_ql_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_masonry_ql_title_letter_spacing",$blog_masonry_ql_title_letter_spacing);

		$row3 = new QodeRow(true);
		$group4->addChild("row3",$row3);
			$blog_masonry_ql_title_hover_color = new QodeField("colorsimple","blog_masonry_ql_title_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_masonry_ql_title_hover_color",$blog_masonry_ql_title_hover_color);

	$group7 = new QodeGroup("Blog Masonry/Pinterest Quote/Link Icon Style","Define icon styles for Quote/Link articles on Blog Masonry/Pinterest template.");
	$panel7->addChild("group7",$group7);

		$row1 = new QodeRow();
		$group7->addChild("row1",$row1);
			$blog_masonry_ql_icon_color = new QodeField("colorsimple","blog_masonry_ql_icon_color","","Text Color","This is some description");
			$row1->addChild("blog_masonry_ql_icon_color",$blog_masonry_ql_icon_color);
			$blog_masonry_ql_icon_background_color = new QodeField("colorsimple","blog_masonry_ql_icon_background_color","","Background Color","This is some description");
			$row1->addChild("blog_masonry_ql_icon_background_color",$blog_masonry_ql_icon_background_color);
			$blog_masonry_ql_icon_hover_color = new QodeField("colorsimple","blog_masonry_ql_icon_hover_color","","Hover Color","This is some description");
			$row1->addChild("blog_masonry_ql_icon_hover_color",$blog_masonry_ql_icon_hover_color);
			$blog_masonry_ql_icon_background_hover_color = new QodeField("colorsimple","blog_masonry_ql_icon_background_hover_color","","Hover Background Color","This is some description");
			$row1->addChild("blog_masonry_ql_icon_background_hover_color",$blog_masonry_ql_icon_background_hover_color);			

	$group8 = new QodeGroup("Blog Large Image Quote Author Style","Define author styles for Quote articles on Blog Large Image template.");
	$panel7->addChild("group8",$group8);

		$row1 = new QodeRow();
		$group8->addChild("row1",$row1);
			$blog_large_image_ql_author_color = new QodeField("colorsimple","blog_large_image_ql_author_color","","Text Color","This is some description");
			$row1->addChild("blog_large_image_ql_author_color",$blog_large_image_ql_author_color);
			$blog_large_image_ql_author_font_size = new QodeField("textsimple","blog_large_image_ql_author_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_large_image_ql_author_font_size",$blog_large_image_ql_author_font_size);
			$blog_large_image_ql_author_line_height = new QodeField("textsimple","blog_large_image_ql_author_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_large_image_ql_author_line_height",$blog_large_image_ql_author_line_height);
			$blog_large_image_ql_author_text_transform = new QodeField("selectblanksimple","blog_large_image_ql_author_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_large_image_ql_author_text_transform",$blog_large_image_ql_author_text_transform);
			
		$row2 = new QodeRow(true);
		$group8->addChild("row2",$row2);
			$blog_large_image_ql_author_font_family = new QodeField("Fontsimple","blog_large_image_ql_author_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_large_image_ql_author_font_family",$blog_large_image_ql_author_font_family);
			$blog_large_image_ql_author_font_style = new QodeField("selectblanksimple","blog_large_image_ql_author_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_large_image_ql_author_font_style",$blog_large_image_ql_author_font_style);
			$blog_large_image_ql_author_font_weight = new QodeField("selectblanksimple","blog_large_image_ql_author_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_large_image_ql_author_font_weight",$blog_large_image_ql_author_font_weight);
			$blog_large_image_ql_author_letter_spacing = new QodeField("textsimple","blog_large_image_ql_author_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_large_image_ql_author_letter_spacing",$blog_large_image_ql_author_letter_spacing);

		$row3 = new QodeRow(true);
		$group8->addChild("row3",$row3);
			$blog_large_image_ql_author_hover_color = new QodeField("colorsimple","blog_large_image_ql_author_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_large_image_ql_author_hover_color",$blog_large_image_ql_author_hover_color);

	$group5 = new QodeGroup("Blog Masonry/Pinterest Author and Comments Style","Define author and comments styles for Blog Masonry/Pinterest template.");
	$panel7->addChild("group5",$group5);

		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);
			$blog_masonry_author_color = new QodeField("colorsimple","blog_masonry_author_color","","Text Color","This is some description");
			$row1->addChild("blog_masonry_author_color",$blog_masonry_author_color);
			$blog_masonry_author_font_size = new QodeField("textsimple","blog_masonry_author_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_masonry_author_font_size",$blog_masonry_author_font_size);
			$blog_masonry_author_line_height = new QodeField("textsimple","blog_masonry_author_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_masonry_author_line_height",$blog_masonry_author_line_height);
			$blog_masonry_author_text_transform = new QodeField("selectblanksimple","blog_masonry_author_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_masonry_author_text_transform",$blog_masonry_author_text_transform);
			
		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);
			$blog_masonry_author_font_family = new QodeField("Fontsimple","blog_masonry_author_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_masonry_author_font_family",$blog_masonry_author_font_family);
			$blog_masonry_author_font_style = new QodeField("selectblanksimple","blog_masonry_author_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_masonry_author_font_style",$blog_masonry_author_font_style);
			$blog_masonry_author_font_weight = new QodeField("selectblanksimple","blog_masonry_author_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_masonry_author_font_weight",$blog_masonry_author_font_weight);
			$blog_masonry_author_letter_spacing = new QodeField("textsimple","blog_masonry_author_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_masonry_author_letter_spacing",$blog_masonry_author_letter_spacing);

		$row3 = new QodeRow(true);
		$group5->addChild("row3",$row3);
			$blog_masonry_author_hover_color = new QodeField("colorsimple","blog_masonry_author_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_masonry_author_hover_color",$blog_masonry_author_hover_color);

	$group6 = new QodeGroup("Blog Large Image Icons Style","Define icons styles in articles for Blog Large Image template.");
	$panel7->addChild("group6",$group6);

		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);
			$blog_large_image_icon_color = new QodeField("colorsimple","blog_large_image_icon_color","","Text Color","This is some description");
			$row1->addChild("blog_large_image_icon_color",$blog_large_image_icon_color);
			$blog_large_image_icon_hover_color = new QodeField("colorsimple","blog_large_image_icon_hover_color","","Hover Color","This is some description");
			$row1->addChild("blog_large_image_icon_hover_color",$blog_large_image_icon_hover_color);
			$blog_large_image_icon_background_color = new QodeField("colorsimple","blog_large_image_icon_background_color","","Background Color","This is some description");
			$row1->addChild("blog_large_image_icon_background_color",$blog_large_image_icon_background_color);
			$blog_large_image_icon_background_hover_color = new QodeField("colorsimple","blog_large_image_icon_background_hover_color","","Background Hover Color","This is some description");
			$row1->addChild("blog_large_image_icon_background_hover_color",$blog_large_image_icon_background_hover_color);

	$group9 = new QodeGroup("Blog Chequered With Background Image Visible Title Style","Define title styles for Blog Chequered template when background image of post is visible.");
	$panel7->addChild("group9",$group9);

		$row1 = new QodeRow();
		$group9->addChild("row1",$row1);
			$blog_chequered_with_image_title_color = new QodeField("colorsimple","blog_chequered_with_image_title_color","","Text Color","This is some description");
			$row1->addChild("blog_chequered_with_image_title_color",$blog_chequered_with_image_title_color);
			$blog_chequered_with_image_title_font_size = new QodeField("textsimple","blog_chequered_with_image_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_chequered_with_image_title_font_size",$blog_chequered_with_image_title_font_size);
			$blog_chequered_with_image_title_line_height = new QodeField("textsimple","blog_chequered_with_image_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_chequered_with_image_title_line_height",$blog_chequered_with_image_title_line_height);
			$blog_chequered_with_image_title_text_transform = new QodeField("selectblanksimple","blog_chequered_with_image_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_chequered_with_image_title_text_transform",$blog_chequered_with_image_title_text_transform);

		$row2 = new QodeRow(true);
		$group9->addChild("row2",$row2);
			$blog_chequered_with_image_title_font_family = new QodeField("Fontsimple","blog_chequered_with_image_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_chequered_with_image_title_font_family",$blog_chequered_with_image_title_font_family);
			$blog_chequered_with_image_title_font_style = new QodeField("selectblanksimple","blog_chequered_with_image_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_chequered_with_image_title_font_style",$blog_chequered_with_image_title_font_style);
			$blog_chequered_with_image_title_font_weight = new QodeField("selectblanksimple","blog_chequered_with_image_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_chequered_with_image_title_font_weight",$blog_chequered_with_image_title_font_weight);
			$blog_chequered_with_image_title_letter_spacing = new QodeField("textsimple","blog_chequered_with_image_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_chequered_with_image_title_letter_spacing",$blog_chequered_with_image_title_letter_spacing);

	$group10 = new QodeGroup("Blog Chequered With Background Color Visible Title Style","Define title styles for Blog Chequered template when background color of post is visible.");
	$panel7->addChild("group10",$group10);

		$row1 = new QodeRow();
		$group10->addChild("row1",$row1);
			$blog_chequered_with_bgcolor_title_color = new QodeField("colorsimple","blog_chequered_with_bgcolor_title_color","","Text Color","This is some description");
			$row1->addChild("blog_chequered_with_bgcolor_title_color",$blog_chequered_with_bgcolor_title_color);
			$blog_chequered_with_bgcolor_title_font_size = new QodeField("textsimple","blog_chequered_with_bgcolor_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_chequered_with_bgcolor_title_font_size",$blog_chequered_with_bgcolor_title_font_size);
			$blog_chequered_with_bgcolor_title_line_height = new QodeField("textsimple","blog_chequered_with_bgcolor_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_chequered_with_bgcolor_title_line_height",$blog_chequered_with_bgcolor_title_line_height);
			$blog_chequered_with_bgcolor_title_text_transform = new QodeField("selectblanksimple","blog_chequered_with_bgcolor_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_chequered_with_bgcolor_title_text_transform",$blog_chequered_with_bgcolor_title_text_transform);

		$row2 = new QodeRow(true);
		$group10->addChild("row2",$row2);
			$blog_chequered_with_bgcolor_title_font_family = new QodeField("Fontsimple","blog_chequered_with_bgcolor_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_chequered_with_bgcolor_title_font_family",$blog_chequered_with_bgcolor_title_font_family);
			$blog_chequered_with_bgcolor_title_font_style = new QodeField("selectblanksimple","blog_chequered_with_bgcolor_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_chequered_with_bgcolor_title_font_style",$blog_chequered_with_bgcolor_title_font_style);
			$blog_chequered_with_bgcolor_title_font_weight = new QodeField("selectblanksimple","blog_chequered_with_bgcolor_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_chequered_with_bgcolor_title_font_weight",$blog_chequered_with_bgcolor_title_font_weight);
			$blog_chequered_with_bgcolor_title_letter_spacing = new QodeField("textsimple","blog_chequered_with_bgcolor_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_chequered_with_bgcolor_title_letter_spacing",$blog_chequered_with_bgcolor_title_letter_spacing);

	$group11 = new QodeGroup("Blog Animated Title Style","Define title styles for Blog Animated template.");
	$panel7->addChild("group11",$group11);

		$row1 = new QodeRow();
		$group11->addChild("row1",$row1);
			$blog_animated_title_color = new QodeField("colorsimple","blog_animated_title_color","","Text Color","This is some description");
			$row1->addChild("blog_animated_title_color",$blog_animated_title_color);
			$blog_animated_title_font_size = new QodeField("textsimple","blog_animated_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_animated_title_font_size",$blog_animated_title_font_size);
			$blog_animated_title_line_height = new QodeField("textsimple","blog_animated_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_animated_title_line_height",$blog_animated_title_line_height);
			$blog_animated_title_text_transform = new QodeField("selectblanksimple","blog_animated_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_animated_title_text_transform",$blog_animated_title_text_transform);

		$row2 = new QodeRow(true);
		$group11->addChild("row2",$row2);
			$blog_animated_title_font_family = new QodeField("Fontsimple","blog_animated_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_animated_title_font_family",$blog_animated_title_font_family);
			$blog_animated_title_font_style = new QodeField("selectblanksimple","blog_animated_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_animated_title_font_style",$blog_animated_title_font_style);
			$blog_animated_title_font_weight = new QodeField("selectblanksimple","blog_animated_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_animated_title_font_weight",$blog_animated_title_font_weight);
			$blog_animated_title_letter_spacing = new QodeField("textsimple","blog_animated_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_animated_title_letter_spacing",$blog_animated_title_letter_spacing);

	$group12 = new QodeGroup("Blog Centered Title Style","Define title styles for Blog Centered template.");
	$panel7->addChild("group12",$group12);

		$row1 = new QodeRow();
		$group12->addChild("row1",$row1);
			$blog_centered_title_color = new QodeField("colorsimple","blog_centered_title_color","","Text Color","This is some description");
			$row1->addChild("blog_centered_title_color",$blog_centered_title_color);
			$blog_centered_title_font_size = new QodeField("textsimple","blog_centered_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_centered_title_font_size",$blog_centered_title_font_size);
			$blog_centered_title_line_height = new QodeField("textsimple","blog_centered_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_centered_title_line_height",$blog_centered_title_line_height);
			$blog_centered_title_text_transform = new QodeField("selectblanksimple","blog_centered_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_centered_title_text_transform",$blog_centered_title_text_transform);

		$row2 = new QodeRow(true);
		$group12->addChild("row2",$row2);
			$blog_centered_title_font_family = new QodeField("Fontsimple","blog_centered_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_centered_title_font_family",$blog_centered_title_font_family);
			$blog_centered_title_font_style = new QodeField("selectblanksimple","blog_centered_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_centered_title_font_style",$blog_centered_title_font_style);
			$blog_centered_title_font_weight = new QodeField("selectblanksimple","blog_centered_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_centered_title_font_weight",$blog_centered_title_font_weight);
			$blog_centered_title_letter_spacing = new QodeField("textsimple","blog_centered_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_centered_title_letter_spacing",$blog_centered_title_letter_spacing);

	$group13 = new QodeGroup("Blog Centered Info Style","Define styles for date, categories and author info on Blog Centered template.");
	$panel7->addChild("group13",$group13);

		$row1 = new QodeRow();
		$group13->addChild("row1",$row1);
			$blog_centered_info_color = new QodeField("colorsimple","blog_centered_info_color","","Text Color","This is some description");
			$row1->addChild("blog_centered_info_color",$blog_centered_info_color);
			$blog_centered_info_font_size = new QodeField("textsimple","blog_centered_info_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_centered_info_font_size",$blog_centered_info_font_size);
			$blog_centered_info_line_height = new QodeField("textsimple","blog_centered_info_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_centered_info_line_height",$blog_centered_info_line_height);
			$blog_centered_info_text_transform = new QodeField("selectblanksimple","blog_centered_info_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_centered_info_text_transform",$blog_centered_info_text_transform);

		$row2 = new QodeRow(true);
		$group13->addChild("row2",$row2);
			$blog_centered_info_font_family = new QodeField("Fontsimple","blog_centered_info_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_centered_info_font_family",$blog_centered_info_font_family);
			$blog_centered_info_font_style = new QodeField("selectblanksimple","blog_centered_info_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_centered_info_font_style",$blog_centered_info_font_style);
			$blog_centered_info_font_weight = new QodeField("selectblanksimple","blog_centered_info_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_centered_info_font_weight",$blog_centered_info_font_weight);
			$blog_centered_info_letter_spacing = new QodeField("textsimple","blog_centered_info_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_centered_info_letter_spacing",$blog_centered_info_letter_spacing);

// Blog Single

$panel8 = new QodePanel("Blog Single","blog_single_panel");
$fontsPage->addChild("panel8",$panel8);

	$group1 = new QodeGroup("Blog Single Title Style","Define title styles for Blog Single.");
	$panel8->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$blog_single_title_color = new QodeField("colorsimple","blog_single_title_color","","Text Color","This is some description");
			$row1->addChild("blog_single_title_color",$blog_single_title_color);
			$blog_single_title_font_size = new QodeField("textsimple","blog_single_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_single_title_font_size",$blog_single_title_font_size);
			$blog_single_title_line_height = new QodeField("textsimple","blog_single_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_single_title_line_height",$blog_single_title_line_height);
			$blog_single_title_text_transform = new QodeField("selectblanksimple","blog_single_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_single_title_text_transform",$blog_single_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$blog_single_title_font_family = new QodeField("Fontsimple","blog_single_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_single_title_font_family",$blog_single_title_font_family);
			$blog_single_title_font_style = new QodeField("selectblanksimple","blog_single_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_single_title_font_style",$blog_single_title_font_style);
			$blog_single_title_font_weight = new QodeField("selectblanksimple","blog_single_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_single_title_font_weight",$blog_single_title_font_weight);
			$blog_single_title_letter_spacing = new QodeField("textsimple","blog_single_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_single_title_letter_spacing",$blog_single_title_letter_spacing);

	$group2 = new QodeGroup("Blog Single Quote/Link Title Style","Define title styles for Quote/Link articles on Blog Single.");
	$panel8->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$blog_single_ql_title_color = new QodeField("colorsimple","blog_single_ql_title_color","","Text Color","This is some description");
			$row1->addChild("blog_single_ql_title_color",$blog_single_ql_title_color);
			$blog_single_ql_title_font_size = new QodeField("textsimple","blog_single_ql_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blog_single_ql_title_font_size",$blog_single_ql_title_font_size);
			$blog_single_ql_title_line_height = new QodeField("textsimple","blog_single_ql_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blog_single_ql_title_line_height",$blog_single_ql_title_line_height);
			$blog_single_ql_title_text_transform = new QodeField("selectblanksimple","blog_single_ql_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blog_single_ql_title_text_transform",$blog_single_ql_title_text_transform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$blog_single_ql_title_font_family = new QodeField("Fontsimple","blog_single_ql_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("blog_single_ql_title_font_family",$blog_single_ql_title_font_family);
			$blog_single_ql_title_font_style = new QodeField("selectblanksimple","blog_single_ql_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blog_single_ql_title_font_style",$blog_single_ql_title_font_style);
			$blog_single_ql_title_font_weight = new QodeField("selectblanksimple","blog_single_ql_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blog_single_ql_title_font_weight",$blog_single_ql_title_font_weight);
			$blog_single_ql_title_letter_spacing = new QodeField("textsimple","blog_single_ql_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blog_single_ql_title_letter_spacing",$blog_single_ql_title_letter_spacing);

		$row3 = new QodeRow(true);
		$group2->addChild("row3",$row3);
			$blog_single_ql_title_hover_color = new QodeField("colorsimple","blog_single_ql_title_hover_color","","Hover Color","This is some description");
			$row3->addChild("blog_single_ql_title_hover_color",$blog_single_ql_title_hover_color);	

// Contact Page

$panel10 = new QodePanel("Contact Page","contact_page_panel");
$fontsPage->addChild("panel10",$panel10);

	$group1 = new QodeGroup("Heading Style","Define heading styles above contact form.");
	$panel10->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$contact_form_heading_color = new QodeField("colorsimple","contact_form_heading_color","","Text Color","This is some description");
			$row1->addChild("contact_form_heading_color",$contact_form_heading_color);
			$contact_form_heading_fontsize = new QodeField("textsimple","contact_form_heading_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("contact_form_heading_fontsize",$contact_form_heading_fontsize);
			$contact_form_heading_lineheight = new QodeField("textsimple","contact_form_heading_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("contact_form_heading_lineheight",$contact_form_heading_lineheight);
			$contact_form_heading_texttransform = new QodeField("selectblanksimple","contact_form_heading_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("contact_form_heading_texttransform",$contact_form_heading_texttransform);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);
			$contact_form_heading_google_fonts = new QodeField("Fontsimple","contact_form_heading_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("contact_form_heading_google_fonts",$contact_form_heading_google_fonts);
			$contact_form_heading_fontstyle = new QodeField("selectblanksimple","contact_form_heading_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("contact_form_heading_fontstyle",$contact_form_heading_fontstyle);
			$contact_form_heading_fontweight = new QodeField("selectblanksimple","contact_form_heading_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("contact_form_heading_fontweight",$contact_form_heading_fontweight);
			$contact_form_heading_letter_spacing = new QodeField("textsimple","contact_form_heading_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("contact_form_heading_letter_spacing",$contact_form_heading_letter_spacing);

	$group2 = new QodeGroup("Title Style","Define title styles in section above form.");
	$panel10->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$contact_form_section_title_color = new QodeField("colorsimple","contact_form_section_title_color","","Text Color","This is some description");
			$row1->addChild("contact_form_section_title_color",$contact_form_section_title_color);
			$contact_form_section_title_fontsize = new QodeField("textsimple","contact_form_section_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("contact_form_section_title_fontsize",$contact_form_section_title_fontsize);
			$contact_form_section_title_lineheight = new QodeField("textsimple","contact_form_section_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("contact_form_section_title_lineheight",$contact_form_section_title_lineheight);
			$contact_form_section_title_texttransform = new QodeField("selectblanksimple","contact_form_section_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("contact_form_section_title_texttransform",$contact_form_section_title_texttransform);
			
		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);
			$contact_form_section_title_google_fonts = new QodeField("Fontsimple","contact_form_section_title_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("contact_form_section_title_google_fonts",$contact_form_section_title_google_fonts);
			$contact_form_section_title_fontstyle = new QodeField("selectblanksimple","contact_form_section_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("contact_form_section_title_fontstyle",$contact_form_section_title_fontstyle);
			$contact_form_section_title_fontweight = new QodeField("selectblanksimple","contact_form_section_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("contact_form_section_title_fontweight",$contact_form_section_title_fontweight);
			$contact_form_section_title_letter_spacing = new QodeField("textsimple","contact_form_section_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("contact_form_section_title_letter_spacing",$contact_form_section_title_letter_spacing);

	$group3 = new QodeGroup("Subtitle Style","Define subtitle styles in section above form.");
	$panel10->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$contact_form_section_subtitle_color = new QodeField("colorsimple","contact_form_section_subtitle_color","","Text Color","This is some description");
			$row1->addChild("contact_form_section_subtitle_color",$contact_form_section_subtitle_color);
			$contact_form_section_subtitle_fontsize = new QodeField("textsimple","contact_form_section_subtitle_font_size","","Font Size (px)","This is some description");
			$row1->addChild("contact_form_section_subtitle_fontsize",$contact_form_section_subtitle_fontsize);
			$contact_form_section_subtitle_lineheight = new QodeField("textsimple","contact_form_section_subtitle_line_height","","Line Height (px)","This is some description");
			$row1->addChild("contact_form_section_subtitle_lineheight",$contact_form_section_subtitle_lineheight);
			$contact_form_section_subtitle_texttransform = new QodeField("selectblanksimple","contact_form_section_subtitle_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("contact_form_section_subtitle_texttransform",$contact_form_section_subtitle_texttransform);
			
		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$contact_form_section_subtitle_google_fonts = new QodeField("Fontsimple","contact_form_section_subtitle_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("contact_form_section_subtitle_google_fonts",$contact_form_section_subtitle_google_fonts);
			$contact_form_section_subtitle_fontstyle = new QodeField("selectblanksimple","contact_form_section_subtitle_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("contact_form_section_subtitle_fontstyle",$contact_form_section_subtitle_fontstyle);
			$contact_form_section_subtitle_fontweight = new QodeField("selectblanksimple","contact_form_section_subtitle_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("contact_form_section_subtitle_fontweight",$contact_form_section_subtitle_fontweight);
			$contact_form_section_subtitle_letter_spacing = new QodeField("textsimple","contact_form_section_subtitle_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("contact_form_section_subtitle_letter_spacing",$contact_form_section_subtitle_letter_spacing);	