<?php

$elementsPage = new QodeAdminPage("6", "Elements");
$qodeFramework->qodeOptions->addAdminPage("elementsPage",$elementsPage);


//Back to top

$panel1 = new QodePanel("Back to Top","back_to_top_panel");
$elementsPage->addChild("panel1",$panel1);

	$group1 = new QodeGroup("Back to Top Style","Define Back to top style");
	$panel1->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$back_to_top_arrow_size = new QodeField("textsimple","back_to_top_arrow_size","14","Icon Arrow Size (px)","Default value is 14	");
			$row1->addChild("back_to_top_arrow_size",$back_to_top_arrow_size);

			$back_to_top_arrow_color = new QodeField("colorsimple","back_to_top_arrow_color","","Arrow Color","This is some description");
			$row1->addChild("back_to_top_arrow_color",$back_to_top_arrow_color);

			$back_to_top_arrow_hover_color = new QodeField("colorsimple","back_to_top_arrow_hover_color","","Arrow Hover Color","This is some description");
			$row1->addChild("back_to_top_arrow_hover_color",$back_to_top_arrow_hover_color);

			$back_to_top_background_color = new QodeField("colorsimple","back_to_top_background_color","","Background Color","This is some description");
			$row1->addChild("back_to_top_background_color",$back_to_top_background_color);
	$row2 = new QodeRow(true);
	$group1->addChild("row2",$row2);
			$back_to_top_background_hover_color = new QodeField("colorsimple","back_to_top_background_hover_color","","Background Hover Color","This is some description");
			$row2->addChild("back_to_top_background_hover_color",$back_to_top_background_hover_color);
	
			$back_to_top_border_color = new QodeField("colorsimple","back_to_top_border_color","","Border Color","This is some description");
			$row2->addChild("back_to_top_border_color",$back_to_top_border_color);

			$back_to_top_border_hover_color = new QodeField("colorsimple","back_to_top_border_hover_color","","Border Hover Color","This is some description");
			$row2->addChild("back_to_top_border_hover_color",$back_to_top_border_hover_color);

//Buttons

$panel2 = new QodePanel("Buttons","buttons_panel");
$elementsPage->addChild("panel2",$panel2);
	
	$group1 = new QodeGroup("Default Button Style","Define Default button style.");
	$panel2->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$button_title_color = new QodeField("colorsimple","button_title_color","","Color","This is some description");
			$row1->addChild("button_title_color",$button_title_color);

			$button_title_fontsize = new QodeField("textsimple","button_title_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("button_title_fontsize",$button_title_fontsize);

			$button_title_lineheight = new QodeField("textsimple","button_title_lineheight","","Line Height (px)","This is some description");
			$row1->addChild("button_title_lineheight",$button_title_lineheight);

			$button_title_texttransform = new QodeField("selectblanksimple","button_title_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("button_title_texttransform",$button_title_texttransform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$button_title_google_fonts = new QodeField("Fontsimple","button_title_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("button_title_google_fonts",$button_title_google_fonts);

			$button_title_fontstyle = new QodeField("selectblanksimple","button_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("button_title_fontstyle",$button_title_fontstyle);

			$button_title_fontweight = new QodeField("selectblanksimple","button_title_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("button_title_fontweight",$button_title_fontweight);

			$button_title_letter_spacing = new QodeField("textsimple","button_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("button_title_letter_spacing",$button_title_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);
			$button_title_hovercolor = new QodeField("colorsimple","button_title_hovercolor","","Hover Color","This is some description");
			$row3->addChild("button_title_hovercolor",$button_title_hovercolor);

			$button_backgroundcolor = new QodeField("colorsimple","button_backgroundcolor","","Background Color","This is some description");
			$row3->addChild("button_backgroundcolor",$button_backgroundcolor);

			$button_backgroundcolor_hover = new QodeField("colorsimple","button_backgroundcolor_hover","","Background Hover Color","This is some description");
			$row3->addChild("button_backgroundcolor_hover",$button_backgroundcolor_hover);

			$button_border_color = new QodeField("colorsimple","button_border_color","","Border Color","This is some description");
			$row3->addChild("button_border_color",$button_border_color);

		$row4 = new QodeRow(true);
		$group1->addChild("row4",$row4);
			$button_border_hover_color = new QodeField("colorsimple","button_border_hover_color","","Border Hover Color","This is some description");
			$row4->addChild("button_border_hover_color",$button_border_hover_color);

			$button_border_width = new QodeField("textsimple","button_border_width","","Border Width (px)","This is some description");
			$row4->addChild("button_border_width",$button_border_width);

			$button_border_radius = new QodeField("textsimple","button_border_radius","","Border radius (px)","This is some description");
			$row4->addChild("button_border_radius",$button_border_radius);

	$group3 = new QodeGroup("Predifined White Button","Define white button style.");
	$panel2->addChild("group3",$group3);
		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);

			$button_white_text_color = new QodeField("colorsimple","button_white_text_color","","Text Color","This is some description");
			$row1->addChild("button_white_text_color",$button_white_text_color);

			$button_white_text_color_hover = new QodeField("colorsimple","button_white_text_color_hover","","Text Hover Color","This is some description");
			$row1->addChild("button_white_text_color_hover",$button_white_text_color_hover);

			$button_white_background_color = new QodeField("colorsimple","button_white_background_color","","Background Color","This is some description");
			$row1->addChild("button_white_background_color",$button_white_background_color);

			$button_white_background_color_hover = new QodeField("colorsimple","button_white_background_color_hover","","Background Hover Color","This is some description");
			$row1->addChild("button_white_background_color_hover",$button_white_background_color_hover);

		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);

			$button_white_border_color = new QodeField("colorsimple","button_white_border_color","","Border Color","This is some description");
			$row2->addChild("button_white_border_color",$button_white_border_color);

			$button_white_border_color_hover = new QodeField("colorsimple","button_white_border_color_hover","","Border Hover Color","This is some description");
			$row2->addChild("button_white_border_color_hover",$button_white_border_color_hover);	

	$group4 = new QodeGroup("Small Button","Define small button style.");
	$panel2->addChild("group4",$group4);
		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);

			$small_button_lineheight = new QodeField("textsimple","small_button_lineheight","","Height (px)","This is some description");
			$row1->addChild("small_button_lineheight",$small_button_lineheight);

			$small_button_fontsize = new QodeField("textsimple","small_button_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("small_button_fontsize",$small_button_fontsize);

			$small_button_fontweight = new QodeField("selectblanksimple","small_button_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row1->addChild("small_button_fontweight",$small_button_fontweight);

			$small_button_padding = new QodeField("textsimple","small_button_padding","","Padding left/right (px) ","This is some description");
			$row1->addChild("small_button_padding",$small_button_padding);

		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$small_button_border_radius = new QodeField("textsimple","small_button_border_radius","","Border radius (px)","This is some description");
			$row2->addChild("small_button_border_radius",$small_button_border_radius);

	$group5 = new QodeGroup("Large Button","Define large button style.");
	$panel2->addChild("group5",$group5);
		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);

			$large_button_lineheight = new QodeField("textsimple","large_button_lineheight","","Height (px)","This is some description");
			$row1->addChild("large_button_lineheight",$large_button_lineheight);

			$large_button_fontsize = new QodeField("textsimple","large_button_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("large_button_fontsize",$large_button_fontsize);

			$large_button_fontweight = new QodeField("selectblanksimple","large_button_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row1->addChild("large_button_fontweight",$large_button_fontweight);

			$large_button_padding = new QodeField("textsimple","large_button_padding","","Padding left/right (px) ","This is some description");
			$row1->addChild("large_button_padding",$large_button_padding);

		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);

			$large_button_border_radius = new QodeField("textsimple","large_button_border_radius","","Border radius (px)","This is some description");
			$row2->addChild("large_button_border_radius",$large_button_border_radius);

	$group6 = new QodeGroup("Extra Large Button","Define Extra large button style.");
	$panel2->addChild("group6",$group6);
		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);

			$big_large_button_lineheight = new QodeField("textsimple","big_large_button_lineheight","","Height (px)","This is some description");
			$row1->addChild("big_large_button_lineheight",$big_large_button_lineheight);

			$big_large_button_fontsize = new QodeField("textsimple","big_large_button_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("big_large_button_fontsize",$big_large_button_fontsize);

			$big_large_button_fontweight = new QodeField("selectblanksimple","big_large_button_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row1->addChild("big_large_button_fontweight",$big_large_button_fontweight);

			$big_large_button_padding = new QodeField("textsimple","big_large_button_padding","","Padding left/right (px) ","This is some description");
			$row1->addChild("big_large_button_padding",$big_large_button_padding);

		$row2 = new QodeRow(true);
		$group6->addChild("row2",$row2);

			$big_large_button_border_radius = new QodeField("textsimple","big_large_button_border_radius","","Border radius (px)","This is some description");
			$row2->addChild("big_large_button_border_radius",$big_large_button_border_radius);

//Blockquote

$panel3 = new QodePanel("Blockquote","blockquote_panel");
$elementsPage->addChild("panel3",$panel3);

	$group1 = new QodeGroup("Blockquote Style","Define Blockquote style");
	$panel3->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$blockquote_color = new QodeField("colorsimple","blockquote_color","","Text Color","This is some description");
			$row1->addChild("blockquote_font_color",$blockquote_color);

			$blockquote_font_size = new QodeField("textsimple","blockquote_font_size","","Font Size (px)","This is some description");
			$row1->addChild("blockquote_font_size",$blockquote_font_size);

			$blockquote_line_height = new QodeField("textsimple","blockquote_line_height","","Line Height (px)","This is some description");
			$row1->addChild("blockquote_line_height",$blockquote_line_height);

			$blockquote_text_transform = new QodeField("selectblanksimple","blockquote_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("blockquote_text_transform",$blockquote_text_transform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$blockquote_font_family = new QodeField("Fontsimple","blockquote_font_family","-1","Font Family","This is some description");
			$row2->addChild("blockquote_font_family",$blockquote_font_family);

			$blockquote_font_style = new QodeField("selectblanksimple","blockquote_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("blockquote_font_style",$blockquote_font_style);

			$blockquote_font_weight = new QodeField("selectblanksimple","blockquote_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("blockquote_font_weight",$blockquote_font_weight);

			$blockquote_letter_spacing = new QodeField("textsimple","blockquote_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("blockquote_letter_spacing",$blockquote_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$blockquote_background_color = new QodeField("colorsimple","blockquote_background_color","","Background Color","This is some description");
			$row3->addChild("blockquote_background_color",$blockquote_background_color);

			$blockquote_border_color = new QodeField("colorsimple","blockquote_border_color","","Border Color","This is some description");
			$row3->addChild("blockquote_border_color",$blockquote_border_color);

			$blockquote_quote_icon_color = new QodeField("colorsimple","blockquote_quote_icon_color","","Quote Icon Color","This is some description");
			$row3->addChild("blockquote_quote_icon_color",$blockquote_quote_icon_color);	

//Counters

$panel4 = new QodePanel("Counters","counters_panel");
$elementsPage->addChild("panel4",$panel4);

	$group1 = new QodeGroup("Counters Style","Define styles for Counters");
	$panel4->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$counter_color = new QodeField("colorsimple","counter_color","","Numeral Color","This is some description");
			$row1->addChild("counter_color",$counter_color);

			$counter_text_color = new QodeField("colorsimple","counter_text_color","","Text Color","This is some description");
			$row1->addChild("counter_text_color",$counter_text_color);

			$counter_separator_color = new QodeField("colorsimple","counter_separator_color","","Separator Color","This is some description");
			$row1->addChild("counter_separator_color",$counter_separator_color);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$counters_font_family = new QodeField("Fontsimple","counters_font_family","-1","Numeral Font Family","This is some description");
			$row2->addChild("counters_font_family",$counters_font_family);

			$counters_font_size = new QodeField("textsimple","counters_font_size","","Numeral Font Size (px)","This is some description");
			$row2->addChild("counters_font_size",$counters_font_size);

			$counters_fontweight = new QodeField("selectblanksimple","counters_fontweight","","Numeral Font Weight","This is some description",$options_fontweight);
			$row2->addChild("counters_fontweight",$counters_fontweight);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$counters_text_font_size = new QodeField("textsimple","counters_text_font_size","","Text Font Size (px)","This is some description");
			$row3->addChild("counters_text_font_size",$counters_text_font_size);

			$counters_text_fontweight = new QodeField("selectblanksimple","counters_text_fontweight","","Text Font Weight","This is some description",$options_fontweight);
			$row3->addChild("counters_text_fontweight",$counters_text_fontweight);

			$counters_text_texttransform = new QodeField("selectblanksimple","counters_text_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row3->addChild("counters_text_texttransform",$counters_text_texttransform);

			$counters_text_letterspacing = new QodeField("textsimple","counters_text_letterspacing","","Text Letter Spacing (px)","This is some description");
			$row3->addChild("counters_text_letterspacing",$counters_text_letterspacing);

//Countdown

$panel20 = new QodePanel("Countdown","countdown_panel");
$elementsPage->addChild("panel20",$panel20);

	$group1 = new QodeGroup("Countdown Style","Define styles for Countdown");
	$panel20->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$countdown_color = new QodeField("colorsimple","countdown_color","","Numeral Color","This is some description");
			$row1->addChild("countdown_color",$countdown_color);

			$countdown_text_color = new QodeField("colorsimple","countdown_text_color","","Text Color","This is some description");
			$row1->addChild("countdown_text_color",$countdown_text_color);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$countdown_font_size = new QodeField("textsimple","countdown_font_size","","Numeral Font Size (px)","This is some description");
			$row2->addChild("countdown_font_size",$countdown_font_size);

			$countdown_fontweight = new QodeField("selectblanksimple","countdown_fontweight","","Numeral Font Weight","This is some description",$options_fontweight);
			$row2->addChild("countdown_fontweight",$countdown_fontweight);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$countdown_text_font_size = new QodeField("textsimple","countdown_text_font_size","","Text Font Size (px)","This is some description");
			$row3->addChild("countdown_text_font_size",$countdown_text_font_size);

			$countdown_text_fontweight = new QodeField("selectblanksimple","countdown_text_fontweight","","Text Font Weight","This is some description",$options_fontweight);
			$row3->addChild("countdown_text_fontweight",$countdown_text_fontweight);

			$countdown_text_texttransform = new QodeField("selectblanksimple","countdown_text_texttransform","","Text Transform","This is some description",$options_texttransform);
			$row3->addChild("countdown_text_texttransform",$countdown_text_texttransform);

			$countdown_text_letterspacing = new QodeField("textsimple","countdown_text_letterspacing","","Text Letter Spacing (px)","This is some description");
			$row3->addChild("countdown_text_letterspacing",$countdown_text_letterspacing);

//Expandable Section

$panel5 = new QodePanel("Expandable Section","expandable_section_panel");
$elementsPage->addChild("panel5",$panel5);

	$group1 = new QodeGroup("Title Style","Define Expandable Section title style");
	$panel5->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$expandable_label_color = new QodeField("colorsimple","expandable_label_color","","Text Color","This is some description");
			$row1->addChild("expandable_label_color",$expandable_label_color);

			$expandable_label_font_size = new QodeField("textsimple","expandable_label_font_size","","Font Size (px)","This is some description");
			$row1->addChild("expandable_label_font_size",$expandable_label_font_size);

			$expandable_label_text_transform = new QodeField("selectblanksimple","expandable_label_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("expandable_label_text_transform",$expandable_label_text_transform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$expandable_label_font_family = new QodeField("Fontsimple","expandable_label_font_family","-1","Font Family","This is some description");
			$row2->addChild("expandable_label_font_family",$expandable_label_font_family);

			$expandable_label_font_weight = new QodeField("selectblanksimple","expandable_label_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("expandable_label_font_weight",$expandable_label_font_weight);

			$expandable_label_letter_spacing = new QodeField("textsimple","expandable_label_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("expandable_label_letter_spacing",$expandable_label_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$expandable_background_color = new QodeField("colorsimple","expandable_background_color","","Background Color","This is some description");
			$row3->addChild("expandable_background_color",$expandable_background_color);

			$expandable_label_hover_color = new QodeField("colorsimple","expandable_label_hover_color","","Text Hover Color","This is some description");
			$row3->addChild("expandable_label_hover_color",$expandable_label_hover_color);		

//Highlight

$panel17 = new QodePanel("Highlight","highlight_panel");
$elementsPage->addChild("panel17",$panel17);
	$highlight_color = new QodeField("color","highlight_color","","Highlight Color","Set color for Highlight");
	$panel17->addChild("highlight_color",$highlight_color);	

//Horizontal Progress Bars

$panel6 = new QodePanel("Horizontal Progress Bars", "horizontal_progress_bars_panel");
$elementsPage->addChild("panel6",$panel6);
	
	$group1 = new QodeGroup("Progress Bar Style","Define styles for Horizontal Progress Bars");
	$panel6->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$progress_bar_horizontal_fontsize = new QodeField("textsimple","progress_bar_horizontal_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("progress_bar_horizontal_fontsize",$progress_bar_horizontal_fontsize);

			$progress_bar_horizontal_fontweight = new QodeField("selectblanksimple","progress_bar_horizontal_fontweight","","Text Font Weight","This is some description",$options_fontweight);
			$row1->addChild("progress_bar_horizontal_fontweight",$progress_bar_horizontal_fontweight);

//Input Fields

$panel7 = new QodePanel("Input Fields","input_fields_panel");
$elementsPage->addChild("panel7",$panel7);

	$group1 = new QodeGroup("Input Fields Style","Define styles for Input Fields");
	$panel7->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$input_background_color = new QodeField("colorsimple","input_background_color","","Background Color","This is some description");
			$row1->addChild("input_background_color",$input_background_color);

			$input_focus_background_color = new QodeField("colorsimple","input_focus_background_color","","Focus Background Color","This is some description");
			$row1->addChild("input_focus_background_color",$input_focus_background_color);

			$input_border_color = new QodeField("colorsimple","input_border_color","","Border Color","This is some description");
			$row1->addChild("input_border_color",$input_border_color);

			$input_focus_border_color = new QodeField("colorsimple","input_focus_border_color","","Focus Border Color","This is some description");
			$row1->addChild("input_focus_border_color",$input_focus_border_color);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$input_text_color = new QodeField("colorsimple","input_text_color","","Text Color","This is some description");
			$row2->addChild("input_text_color",$input_text_color);		

			$input_focus_text_color = new QodeField("colorsimple","input_focus_text_color","","Focus Text Color","This is some description");
			$row2->addChild("input_focus_text_color",$input_focus_text_color);

//Interactive Banners

$panel71 = new QodePanel("Interactive Banners","interactive_banners_panel");
$elementsPage->addChild("panel71",$panel71);

	$group1 = new QodeGroup("Interactive Banners Style","Define styles for Interactive Banners");
	$panel71->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$input_background_color = new QodeField("colorsimple","interactive_banners_background_color","","Image Overlay Background Color","This is some description");
			$row1->addChild("input_background_color",$input_background_color);

			$input_focus_background_color = new QodeField("colorsimple","interactive_banners_hover_background_color","","Image Overlay Hover Background Color","This is some description");
			$row1->addChild("input_focus_background_color",$input_focus_background_color);	

//Message Boxes

$panel8 = new QodePanel("Message Boxes", "message_boxes_panel");
$elementsPage->addChild("panel8",$panel8);

	$group1 = new QodeGroup("Message Box Style","Define Message Box Style");
	$panel8->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$message_title_color = new QodeField("colorsimple","message_title_color","","Text Color","This is some description");
			$row1->addChild("message_title_color",$message_title_color);

			$message_backgroundcolor = new QodeField("colorsimple","message_backgroundcolor","","Background color","This is some description");
			$row1->addChild("message_backgroundcolor",$message_backgroundcolor);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$message_title_google_fonts = new QodeField("Fontsimple","message_title_google_fonts","-1","Font Family","This is some description");
			$row2->addChild("message_title_google_fonts",$message_title_google_fonts);

			$message_title_fontsize = new QodeField("textsimple","message_title_fontsize","","Font Size (px)","This is some description");
			$row2->addChild("message_title_fontsize",$message_title_fontsize);

			$message_title_lineheight = new QodeField("textsimple","message_title_lineheight","","Line Height (px)","This is some description");
			$row2->addChild("message_title_lineheight",$message_title_lineheight);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$message_title_fontstyle = new QodeField("selectblanksimple","message_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
			$row3->addChild("message_title_fontstyle",$message_title_fontstyle);

			$message_title_fontweight = new QodeField("selectblanksimple","message_title_fontweight","","Font Weight","This is some description",$options_fontweight);
			$row3->addChild("message_title_fontweight",$message_title_fontweight);
			
	$group2 = new QodeGroup("Message Icon Style","Define styles for Message Box icons");
	$panel8->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$message_icon_color = new QodeField("colorsimple","message_icon_color","","Text Color","This is some description");
			$row1->addChild("message_icon_color",$message_icon_color);

			$message_icon_fontsize = new QodeField("textsimple","message_icon_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("message_icon_fontsize",$message_icon_fontsize);

//Pagination

$panel10 = new QodePanel("Pagination","pagination_panel");
$elementsPage->addChild("panel10",$panel10);
	
	$group1 = new QodeGroup("Pagination Style","Define Pagination styles.");
	$panel10->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$pagination_color = new QodeField("colorsimple","pagination_color","","Color","This is some description");
			$row1->addChild("pagination_color",$pagination_color);

			$pagination_hover_color = new QodeField("colorsimple","pagination_hover_color","","Hover Color","This is some description");
			$row1->addChild("pagination_hover_color",$pagination_hover_color);

			$pagination_font_size = new QodeField("textsimple","pagination_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pagination_font_size",$pagination_font_size);

			$pagination_line_height = new QodeField("textsimple","pagination_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pagination_line_height",$pagination_line_height);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$pagination_text_transform = new QodeField("selectblanksimple","pagination_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("pagination_text_transform",$pagination_text_transform);

			$pagination_font_family = new QodeField("Fontsimple","pagination_font_family","-1","Font Family","This is some description");
			$row2->addChild("pagination_font_family",$pagination_font_family);

			$pagination_font_style = new QodeField("selectblanksimple","pagination_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pagination_font_style",$pagination_font_style);

			$pagination_font_weight = new QodeField("selectblanksimple","pagination_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pagination_font_weight",$pagination_font_weight);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$pagination_letter_spacing = new QodeField("textsimple","pagination_letter_spacing","","Letter Spacing (px)","This is some description");
			$row3->addChild("pagination_letter_spacing",$pagination_letter_spacing);

	$group2 = new QodeGroup("Portfolio Pagination Style","Define Pagination styles for portfolio single.");
	$panel10->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$portfolio_pagination_color = new QodeField("colorsimple","portfolio_pagination_color","","Color","This is some description");
			$row1->addChild("portfolio_pagination_color",$portfolio_pagination_color);

			$portfolio_pagination_hover_color = new QodeField("colorsimple","portfolio_pagination_hover_color","","Hover Color","This is some description");
			$row1->addChild("portfolio_pagination_hover_color",$portfolio_pagination_hover_color);

			$portfolio_pagination_font_size = new QodeField("textsimple","portfolio_pagination_font_size","","Font Size (px)","This is some description");
			$row1->addChild("portfolio_pagination_font_size",$portfolio_pagination_font_size);
				
//Pie Charts

$panel11 = new QodePanel("Pie Charts","pie_charts_panel");
$elementsPage->addChild("panel11",$panel11);

	$group1 = new QodeGroup("Pie Chart Style","Define styles for Pie Charts");
	$panel11->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$pie_charts_fontsize = new QodeField("textsimple","pie_charts_fontsize","","Font Size (px)","This is some description");
			$row1->addChild("pie_charts_fontsize",$pie_charts_fontsize);

			$pie_charts_fontweight = new QodeField("selectblanksimple","pie_charts_fontweight","","Text Font Weight","This is some description",$options_fontweight);
			$row1->addChild("pie_charts_fontweight",$pie_charts_fontweight);

//Pricing table

$panel12 = new QodePanel("Pricing Table","pricing_table_panel");
$elementsPage->addChild("panel12",$panel12);	

	$group1 = new QodeGroup("Pricing tables Style","Define Pricing tables style");
	$panel12->addChild("group1",$group1);		
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);			

			$pricing_table_background_color = new QodeField("colorsimple","pricing_table_background_color","","Content Background Color","This is some description");
			$row1->addChild("pricing_table_background_color",$pricing_table_background_color);

			$pricing_table_separator_color = new QodeField("colorsimple","pricing_table_separator_color","","Content Separator Color","This is some description");
			$row1->addChild("pricing_table_separator_color",$pricing_table_separator_color);

			$pricing_table_separator_thickness = new QodeField("textsimple","pricing_table_separator_thickness","","Content Separator Thickness (px)","Default value is 14	");
			$row1->addChild("pricing_table_separator_thickness",$pricing_table_separator_thickness);


	$group2 = new QodeGroup("Pricing tables active text","DefinePricing tables active text style.");
	$panel12->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$pricing_tables_active_text_color = new QodeField("colorsimple","pricing_tables_active_text_color","","Color","This is some description");
			$row1->addChild("pricing_tables_active_text_color",$pricing_tables_active_text_color);

			$pricing_tables_active_text_font_size = new QodeField("textsimple","pricing_tables_active_text_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pricing_tables_active_text_font_size",$pricing_tables_active_text_font_size);

			$pricing_tables_active_text_line_height = new QodeField("textsimple","pricing_tables_active_text_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pricing_tables_active_text_line_height",$pricing_tables_active_text_line_height);

			$pricing_tables_active_text_text_transform = new QodeField("selectblanksimple","pricing_tables_active_text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("pricing_tables_active_text_text_transform",$pricing_tables_active_text_text_transform);

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);

			$pricing_tables_active_text_font_family = new QodeField("Fontsimple","pricing_tables_active_text_font_family","-1","Font Family","This is some description");
			$row2->addChild("pricing_tables_active_text_font_family",$pricing_tables_active_text_font_family);

			$pricing_tables_active_text_font_style = new QodeField("selectblanksimple","pricing_tables_active_text_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pricing_tables_active_text_font_style",$pricing_tables_active_text_font_style);

			$pricing_tables_active_text_font_weight = new QodeField("selectblanksimple","pricing_tables_active_text_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pricing_tables_active_text_font_weight",$pricing_tables_active_text_font_weight);

			$pricing_tables_active_text_letter_spacing = new QodeField("textsimple","pricing_tables_active_text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pricing_tables_active_text_letter_spacing",$pricing_tables_active_text_letter_spacing);	


	$group3 = new QodeGroup("Pricing tables title","Define Pricing tables title style.");
	$panel12->addChild("group3",$group3);
		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);

			$pricing_tables_title_color = new QodeField("colorsimple","pricing_tables_title_color","","Color","This is some description");
			$row1->addChild("pricing_tables_title_color",$pricing_tables_title_color);

			$pricing_tables_title_font_size = new QodeField("textsimple","pricing_tables_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pricing_tables_title_font_size",$pricing_tables_title_font_size);

			$pricing_tables_title_line_height = new QodeField("textsimple","pricing_tables_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pricing_tables_title_line_height",$pricing_tables_title_line_height);

			$pricing_tables_title_text_transform = new QodeField("selectblanksimple","pricing_tables_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("pricing_tables_title_text_transform",$pricing_tables_title_text_transform);

		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);

			$pricing_tables_title_font_family = new QodeField("Fontsimple","pricing_tables_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("pricing_tables_title_font_family",$pricing_tables_title_font_family);

			$pricing_tables_title_font_style = new QodeField("selectblanksimple","pricing_tables_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pricing_tables_title_font_style",$pricing_tables_title_font_style);

			$pricing_tables_title_font_weight = new QodeField("selectblanksimple","pricing_tables_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pricing_tables_title_font_weight",$pricing_tables_title_font_weight);

			$pricing_tables_title_letter_spacing = new QodeField("textsimple","pricing_tables_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pricing_tables_title_letter_spacing",$pricing_tables_title_letter_spacing);

	$group4 = new QodeGroup("Pricing tables period","DefinePricing tables period style.");
	$panel12->addChild("group4",$group4);
		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);

			$pricing_tables_period_color = new QodeField("colorsimple","pricing_tables_period_color","","Color","This is some description");
			$row1->addChild("pricing_tables_period_color",$pricing_tables_period_color);

			$pricing_tables_period_font_size = new QodeField("textsimple","pricing_tables_period_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pricing_tables_period_font_size",$pricing_tables_period_font_size);

			$pricing_tables_period_line_height = new QodeField("textsimple","pricing_tables_period_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pricing_tables_period_line_height",$pricing_tables_period_line_height);

			$pricing_tables_period_text_transform = new QodeField("selectblanksimple","pricing_tables_period_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("pricing_tables_period_text_transform",$pricing_tables_period_text_transform);

		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);

			$pricing_tables_period_font_family = new QodeField("Fontsimple","pricing_tables_period_font_family","-1","Font Family","This is some description");
			$row2->addChild("pricing_tables_period_font_family",$pricing_tables_period_font_family);

			$pricing_tables_period_font_style = new QodeField("selectblanksimple","pricing_tables_period_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pricing_tables_period_font_style",$pricing_tables_period_font_style);

			$pricing_tables_period_font_weight = new QodeField("selectblanksimple","pricing_tables_period_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pricing_tables_period_font_weight",$pricing_tables_period_font_weight);

			$pricing_tables_period_letter_spacing = new QodeField("textsimple","pricing_tables_period_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pricing_tables_period_letter_spacing",$pricing_tables_period_letter_spacing);

	$group5 = new QodeGroup("Pricing tables price","Define Pricing Tables Price Style.");
	$panel12->addChild("group5",$group5);
		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);

			$pricing_tables_price_color = new QodeField("colorsimple","pricing_tables_price_color","","Color","This is some description");
			$row1->addChild("pricing_tables_price_color",$pricing_tables_price_color);

			$pricing_tables_price_font_size = new QodeField("textsimple","pricing_tables_price_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pricing_tables_price_font_size",$pricing_tables_price_font_size);

			$pricing_tables_price_line_height = new QodeField("textsimple","pricing_tables_price_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pricing_tables_price_line_height",$pricing_tables_price_line_height);

			$pricing_tables_price_text_transform = new QodeField("selectblanksimple","pricing_tables_price_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("pricing_tables_price_text_transform",$pricing_tables_price_text_transform);

		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);

			$pricing_tables_price_font_family = new QodeField("Fontsimple","pricing_tables_price_font_family","-1","Font Family","This is some description");
			$row2->addChild("pricing_tables_price_font_family",$pricing_tables_price_font_family);

			$pricing_tables_price_font_style = new QodeField("selectblanksimple","pricing_tables_price_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pricing_tables_price_font_style",$pricing_tables_price_font_style);

			$pricing_tables_price_font_weight = new QodeField("selectblanksimple","pricing_tables_price_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pricing_tables_price_font_weight",$pricing_tables_price_font_weight);

			$pricing_tables_price_letter_spacing = new QodeField("textsimple","pricing_tables_price_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pricing_tables_price_letter_spacing",$pricing_tables_price_letter_spacing);		

	$group6 = new QodeGroup("Pricing tables currency","Define Pricing tables currency style.");
	$panel12->addChild("group6",$group6);
		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);

			$pricing_tables_currency_color = new QodeField("colorsimple","pricing_tables_currency_color","","Color","This is some description");
			$row1->addChild("pricing_tables_currency_color",$pricing_tables_currency_color);

			$pricing_tables_currency_font_size = new QodeField("textsimple","pricing_tables_currency_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pricing_tables_currency_font_size",$pricing_tables_currency_font_size);

			$pricing_tables_currency_line_height = new QodeField("textsimple","pricing_tables_currency_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pricing_tables_currency_line_height",$pricing_tables_currency_line_height);

			$pricing_tables_currency_text_transform = new QodeField("selectblanksimple","pricing_tables_currency_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("pricing_tables_currency_text_transform",$pricing_tables_currency_text_transform);

		$row2 = new QodeRow(true);
		$group6->addChild("row2",$row2);

			$pricing_tables_currency_font_family = new QodeField("Fontsimple","pricing_tables_currency_font_family","-1","Font Family","This is some description");
			$row2->addChild("pricing_tables_currency_font_family",$pricing_tables_currency_font_family);

			$pricing_tables_currency_font_style = new QodeField("selectblanksimple","pricing_tables_currency_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pricing_tables_currency_font_style",$pricing_tables_currency_font_style);

			$pricing_tables_currency_font_weight = new QodeField("selectblanksimple","pricing_tables_currency_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pricing_tables_currency_font_weight",$pricing_tables_currency_font_weight);

			$pricing_tables_currency_letter_spacing = new QodeField("textsimple","pricing_tables_currency_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pricing_tables_currency_letter_spacing",$pricing_tables_currency_letter_spacing);
			
	$group7 = new QodeGroup("Pricing tables button","Define Pricing tables button style.");
	$panel12->addChild("group7",$group7);
		$row1 = new QodeRow();
		$group7->addChild("row1",$row1);

			$pricing_tables_button_color = new QodeField("colorsimple","pricing_tables_button_color","","Color","This is some description");
			$row1->addChild("pricing_tables_button_color",$pricing_tables_button_color);

			$pricing_tables_button_font_size = new QodeField("textsimple","pricing_tables_button_font_size","","Font Size (px)","This is some description");
			$row1->addChild("pricing_tables_button_font_size",$pricing_tables_button_font_size);

			$pricing_tables_button_line_height = new QodeField("textsimple","pricing_tables_button_line_height","","Line Height (px)","This is some description");
			$row1->addChild("pricing_tables_button_line_height",$pricing_tables_button_line_height);

			$pricing_tables_button_text_transform = new QodeField("selectblanksimple","pricing_tables_button_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("pricing_tables_button_text_transform",$pricing_tables_button_text_transform);

		$row2 = new QodeRow(true);
		$group7->addChild("row2",$row2);

			$pricing_tables_button_font_family = new QodeField("Fontsimple","pricing_tables_button_font_family","-1","Font Family","This is some description");
			$row2->addChild("pricing_tables_button_font_family",$pricing_tables_button_font_family);

			$pricing_tables_button_font_style = new QodeField("selectblanksimple","pricing_tables_button_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("pricing_tables_button_font_style",$pricing_tables_button_font_style);

			$pricing_tables_button_font_weight = new QodeField("selectblanksimple","pricing_tables_button_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("pricing_tables_button_font_weight",$pricing_tables_button_font_weight);

			$pricing_tables_button_letter_spacing = new QodeField("textsimple","pricing_tables_button_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("pricing_tables_button_letter_spacing",$pricing_tables_button_letter_spacing);


//Pricing list

	$panel19 = new QodePanel("Pricing Lists","pricing_list_panel");
	$elementsPage->addChild("panel19",$panel19);

		$group1 = new QodeGroup("Pricing lists title","Define Pricing lists title style.");
		$panel19->addChild("group1",$group1);

			$row1 = new QodeRow();
			$group1->addChild("row1",$row1);

				$pricing_lists_title_color = new QodeField("colorsimple","pricing_lists_title_color","","Color","This is some description");
				$row1->addChild("pricing_lists_title_color",$pricing_lists_title_color);

				$pricing_lists_title_font_size = new QodeField("textsimple","pricing_lists_title_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_lists_title_font_size",$pricing_lists_title_font_size);

				$pricing_lists_title_line_height = new QodeField("textsimple","pricing_lists_title_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_lists_title_line_height",$pricing_lists_title_line_height);

				$pricing_lists_title_text_transform = new QodeField("selectblanksimple","pricing_lists_title_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_lists_title_text_transform",$pricing_lists_title_text_transform);

			$row2 = new QodeRow(true);
			$group1->addChild("row2",$row2);

				$pricing_lists_title_font_family = new QodeField("Fontsimple","pricing_lists_title_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_lists_title_font_family",$pricing_lists_title_font_family);

				$pricing_lists_title_font_style = new QodeField("selectblanksimple","pricing_lists_title_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_lists_title_font_style",$pricing_lists_title_font_style);

				$pricing_lists_title_font_weight = new QodeField("selectblanksimple","pricing_lists_title_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_lists_title_font_weight",$pricing_lists_title_font_weight);

				$pricing_lists_title_letter_spacing = new QodeField("textsimple","pricing_lists_title_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_lists_title_letter_spacing",$pricing_lists_title_letter_spacing);


		$group2 = new QodeGroup("Pricing lists price","Define Pricing lists Price Style.");
		$panel19->addChild("group2",$group2);

			$row1 = new QodeRow();
			$group2->addChild("row1",$row1);

				$pricing_lists_price_color = new QodeField("colorsimple","pricing_lists_price_color","","Color","This is some description");
				$row1->addChild("pricing_lists_price_color",$pricing_lists_price_color);

				$pricing_lists_price_font_size = new QodeField("textsimple","pricing_lists_price_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_lists_price_font_size",$pricing_lists_price_font_size);

				$pricing_lists_price_line_height = new QodeField("textsimple","pricing_lists_price_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_lists_price_line_height",$pricing_lists_price_line_height);

				$pricing_lists_price_text_transform = new QodeField("selectblanksimple","pricing_lists_price_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_lists_price_text_transform",$pricing_lists_price_text_transform);

			$row2 = new QodeRow(true);
			$group2->addChild("row2",$row2);

				$pricing_lists_price_font_family = new QodeField("Fontsimple","pricing_lists_price_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_lists_price_font_family",$pricing_lists_price_font_family);

				$pricing_lists_price_font_style = new QodeField("selectblanksimple","pricing_lists_price_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_lists_price_font_style",$pricing_lists_price_font_style);

				$pricing_lists_price_font_weight = new QodeField("selectblanksimple","pricing_lists_price_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_lists_price_font_weight",$pricing_lists_price_font_weight);

				$pricing_lists_price_letter_spacing = new QodeField("textsimple","pricing_lists_price_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_lists_price_letter_spacing",$pricing_lists_price_letter_spacing);

		$group3 = new QodeGroup("Pricing lists text","DefinePricing lists text style.");
		$panel19->addChild("group3",$group3);

			$row1 = new QodeRow();
			$group3->addChild("row1",$row1);

				$pricing_lists_text_color = new QodeField("colorsimple","pricing_lists_text_color","","Color","This is some description");
				$row1->addChild("pricing_lists_text_color",$pricing_lists_text_color);

				$pricing_lists_text_font_size = new QodeField("textsimple","pricing_lists_text_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_lists_text_font_size",$pricing_lists_text_font_size);

				$pricing_lists_text_line_height = new QodeField("textsimple","pricing_lists_text_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_lists_text_line_height",$pricing_lists_text_line_height);

				$pricing_lists_text_text_transform = new QodeField("selectblanksimple","pricing_lists_text_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_lists_text_text_transform",$pricing_lists_text_text_transform);

			$row2 = new QodeRow(true);
			$group3->addChild("row2",$row2);

				$pricing_lists_text_font_family = new QodeField("Fontsimple","pricing_lists_text_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_lists_text_font_family",$pricing_lists_text_font_family);

				$pricing_lists_text_font_style = new QodeField("selectblanksimple","pricing_lists_text_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_lists_text_font_style",$pricing_lists_text_font_style);

				$pricing_lists_text_font_weight = new QodeField("selectblanksimple","pricing_lists_text_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_lists_text_font_weight",$pricing_lists_text_font_weight);

				$pricing_lists_text_letter_spacing = new QodeField("textsimple","pricing_lists_text_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_lists_text_letter_spacing",$pricing_lists_text_letter_spacing);

		$group4 = new QodeGroup("Pricing lists highlighted text","DefinePricing lists highlighted text style.");
		$panel19->addChild("group4",$group4);

			$row1 = new QodeRow();
			$group4->addChild("row1",$row1);

				$pricing_lists_highlighted_text_color = new QodeField("colorsimple","pricing_lists_highlighted_text_color","","Color","This is some description");
				$row1->addChild("pricing_lists_highlighted_text_color",$pricing_lists_highlighted_text_color);

				$pricing_lists_highlighted_text_font_size = new QodeField("textsimple","pricing_lists_highlighted_text_font_size","","Font Size (px)","This is some description");
				$row1->addChild("pricing_lists_highlighted_text_font_size",$pricing_lists_highlighted_text_font_size);

				$pricing_lists_highlighted_text_line_height = new QodeField("textsimple","pricing_lists_highlighted_text_line_height","","Line Height (px)","This is some description");
				$row1->addChild("pricing_lists_highlighted_text_line_height",$pricing_lists_highlighted_text_line_height);

				$pricing_lists_highlighted_text_text_transform = new QodeField("selectblanksimple","pricing_lists_highlighted_text_text_transform","","Text Transform","This is some description",$options_texttransform);
				$row1->addChild("pricing_lists_highlighted_text_text_transform",$pricing_lists_highlighted_text_text_transform);

			$row2 = new QodeRow(true);
			$group4->addChild("row2",$row2);

				$pricing_lists_highlighted_text_font_family = new QodeField("Fontsimple","pricing_lists_highlighted_text_font_family","-1","Font Family","This is some description");
				$row2->addChild("pricing_lists_highlighted_text_font_family",$pricing_lists_highlighted_text_font_family);

				$pricing_lists_highlighted_text_font_style = new QodeField("selectblanksimple","pricing_lists_highlighted_text_font_style","","Font Style","This is some description",$options_fontstyle);
				$row2->addChild("pricing_lists_highlighted_text_font_style",$pricing_lists_highlighted_text_font_style);

				$pricing_lists_highlighted_text_font_weight = new QodeField("selectblanksimple","pricing_lists_highlighted_text_font_weight","","Font Weight","This is some description",$options_fontweight);
				$row2->addChild("pricing_lists_highlighted_text_font_weight",$pricing_lists_highlighted_text_font_weight);

				$pricing_lists_highlighted_text_letter_spacing = new QodeField("textsimple","pricing_lists_highlighted_text_letter_spacing","","Letter Spacing (px)","This is some description");
				$row2->addChild("pricing_lists_highlighted_text_letter_spacing",$pricing_lists_highlighted_text_letter_spacing);

			$row3 = new QodeRow();
			$group4->addChild("row3",$row3);

				$pricing_lists_highlighted_background_color = new QodeField("colorsimple","pricing_lists_highlighted_background_color","","Background Color","This is some description");
				$row3->addChild("pricing_lists_highlighted_background_color",$pricing_lists_highlighted_background_color);


//Separators

$panel13 = new QodePanel("Separators","separators_panel");
$elementsPage->addChild("panel13",$panel13);

	$group1 = new QodeGroup("Normal",'Define styles for separator of type "Normal"');
	$panel13->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$separator_color = new QodeField("colorsimple","separator_color","","Text Color","This is some description");
			$row1->addChild("separator_color",$separator_color);

			$separator_thickness = new QodeField("textsimple","separator_thickness","","Thickness (px)","This is some description");
			$row1->addChild("separator_thickness",$separator_thickness);
			

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$separator_topmargin = new QodeField("textsimple","separator_topmargin","","Top Margin (px)","This is some description");
			$row2->addChild("separator_topmargin",$separator_topmargin);

			$separator_bottommargin = new QodeField("textsimple","separator_bottommargin","","Bottom Margin (px)","This is some description");
			$row2->addChild("separator_bottommargin",$separator_bottommargin);

			$separator_type = new QodeField("selectsimple","separator_type","","Separator type","", array( "" => "",
		       "solid" => "Solid",
		       "dashed" => "Dashed"
		      ));
			$row2->addChild("separator_type",$separator_type);

	$group2 = new QodeGroup("Small",'Define styles for separator of type "Small"');
	$panel13->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$separator_small_color = new QodeField("colorsimple","separator_small_color","","Text Color","This is some description");
			$row1->addChild("separator_small_color",$separator_small_color);

			$separator_small_thickness = new QodeField("textsimple","separator_small_thickness","","Thickness (px)","This is some description");
			$row1->addChild("separator_small_thickness",$separator_small_thickness);

			$separator_small_width = new QodeField("textsimple","separator_small_width","","Width (px)","This is some description");
			$row1->addChild("separator_small_width",$separator_small_width);			

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);

			$separator_small_topmargin = new QodeField("textsimple","separator_small_topmargin","","Top Margin (px)","This is some description");
			$row2->addChild("separator_small_topmargin",$separator_small_topmargin);

			$separator_small_bottommargin = new QodeField("textsimple","separator_small_bottommargin","","Bottom Margin (px)","This is some description");
			$row2->addChild("separator_small_bottommargin",$separator_small_bottommargin);	

			$separator_small_type = new QodeField("selectsimple","separator_small_type","","Separator type","", array( "" => "",
		       "solid" => "Solid",
		       "dashed" => "Dashed"
		      ));
			$row2->addChild("separator_small_type",$separator_small_type);

//Slider Navigation

$panel9 = new QodePanel("Slider Navigation","navigation_panel");
$elementsPage->addChild("panel9",$panel9);

	$group1 = new QodeGroup("Navigation Style","Define navigation styles for element sliders");
	$panel9->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$navigation_arrow_size = new QodeField("textsimple","navigation_arrow_size","14","Icon Arrow Size (px)","Default value is 14	");
			$row1->addChild("navigation_arrow_size",$navigation_arrow_size);

			$navigation_arrow_color = new QodeField("colorsimple","navigation_arrow_color","","Arrow Color","This is some description");
			$row1->addChild("navigation_arrow_color",$navigation_arrow_color);

			$navigation_arrow_hover_color = new QodeField("colorsimple","navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
			$row1->addChild("navigation_arrow_hover_color",$navigation_arrow_hover_color);

			$navigation_background_color = new QodeField("colorsimple","navigation_background_color","","Background Color","This is some description");
			$row1->addChild("navigation_background_color",$navigation_background_color);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$navigation_background_hover_color = new QodeField("colorsimple","navigation_background_hover_color","","Background Hover Color","This is some description");
			$row2->addChild("navigation_background_hover_color",$navigation_background_hover_color);
	
			$navigation_border_color = new QodeField("colorsimple","navigation_border_color","","Border Color","This is some description");
			$row2->addChild("navigation_border_color",$navigation_border_color);

			$navigation_border_hover_color = new QodeField("colorsimple","navigation_border_hover_color","","Border Hover Color","This is some description");
			$row2->addChild("navigation_border_hover_color",$navigation_border_hover_color);

	$group2 = new QodeGroup("Full Screen Navigation Style","Define styles for Full Screen Section template navigation");
	$panel9->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$fs_navigation_arrow_size = new QodeField("textsimple","fs_navigation_arrow_size","","Icon Arrow Size (px)","Default value is 50.");
			$row1->addChild("fs_navigation_arrow_size",$fs_navigation_arrow_size);

			$fs_navigation_arrow_color = new QodeField("colorsimple","fs_navigation_arrow_color","","Arrow Color","This is some description");
			$row1->addChild("fs_navigation_arrow_color",$fs_navigation_arrow_color);

			$fs_navigation_arrow_hover_color = new QodeField("colorsimple","fs_navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
			$row1->addChild("fs_navigation_arrow_hover_color",$fs_navigation_arrow_hover_color);		
			
//Social Icon

$panel14 = new QodePanel("Social Icon", "social_icon_panel");
$elementsPage->addChild("panel14",$panel14);

	$group1 = new QodeGroup("Normal Icons","Define Normal Social Icons style");
	$panel14->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$social_color = new QodeField("colorsimple","social_color","","Icon Color","This is some description");
			$row1->addChild("social_color",$social_color);

			$social_hover_color = new QodeField("colorsimple","social_hover_color","","Icon Hover Color","This is some description");
			$row1->addChild("social_hover_color",$social_hover_color);

	$group2 = new QodeGroup("Social circle/square Icon","Define Social circle/square Icons style");
	$panel14->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$social_icon_color = new QodeField("colorsimple","social_icon_color","","Icon Color","This is some description");
			$row1->addChild("social_icon_color",$social_icon_color);

			$social_icon_hover_color = new QodeField("colorsimple","social_icon_hover_color","","Icon Hover Color","This is some description");
			$row1->addChild("social_icon_hover_color",$social_icon_hover_color);

			$social_icon_background_color = new QodeField("colorsimple","social_icon_background_color","","Icon Background Color","This is some description");
			$row1->addChild("social_icon_background_color",$social_icon_background_color);

			$social_icon_hover_background_color = new QodeField("colorsimple","social_icon_hover_background_color","","Icon Hover Background Color","This is some description");
			$row1->addChild("social_icon_hover_background_color",$social_icon_hover_background_color);

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);

			$social_icon_border_color = new QodeField("colorsimple","social_icon_border_color","","Icon Border Color","This is some description");
			$row2->addChild("social_icon_border_color",$social_icon_border_color);

			$social_icon_hover_border_color = new QodeField("colorsimple","social_icon_hover_border_color","","Icon Hover Border Color","This is some description");
			$row2->addChild("social_icon_hover_border_color",$social_icon_hover_border_color);		

//Tabs Panel

$panel15 = new QodePanel("Tabs", "tabs_panel");
$elementsPage->addChild("panel15",$panel15);

	$group1 = new QodeGroup("Tabs style","Define Tabs style");
	$panel15->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$tabs_text_size = new QodeField("textsimple","tabs_text_size","","Tab text Size","This is some description");
			$row1->addChild("tabs_text_size",$tabs_text_size);

			$tabs_fontweight = new QodeField("selectblanksimple","tabs_fontweight","","Tab Font Weight","This is some description",$options_fontweight);
			$row1->addChild("tabs_fontweight",$tabs_fontweight);

			$tabs_nav_font_family = new QodeField("Fontsimple","tabs_nav_font_family","-1","Tabs navigation font family","This is some description");
			$row1->addChild("tabs_nav_font_family",$tabs_nav_font_family);
			
		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);	

			$tab_text_color = new QodeField("colorsimple","tab_text_color","","Tab text color","This is some description");
			$row2->addChild("tab_text_color",$tab_text_color);

			$tab_background_color = new QodeField("colorsimple","tab_background_color","","Tab background color","This is some description");
			$row2->addChild("tab_background_color",$tab_background_color);

			$tab_active_text_color = new QodeField("colorsimple","tab_active_text_color","","Active tab text color","This is some description");
			$row2->addChild("tab_active_text_color",$tab_active_text_color); 

			$tab_active_background_color = new QodeField("colorsimple","tab_active_background_color","","Active tab background color","This is some description");
			$row2->addChild("tab_active_background_color",$tab_active_background_color);

			$tab_text_text_transform = new QodeField("selectblanksimple","tab_text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("tab_text_text_transform",$tab_text_text_transform);

	$group2 = new QodeGroup("Tabs content style","Define content styles for Tabs");
	$panel15->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);

			$tabs_content_text_size = new QodeField("textsimple","tabs_content_text_size","","Tab content text Size","This is some description");
			$row1->addChild("tabs_content_text_size",$tabs_content_text_size);

			$tabs_content_background_color = new QodeField("colorsimple","tabs_content_background_color","","Tab content background color","This is some description");
			$row1->addChild("tabs_content_background_color",$tabs_content_background_color);

//Tags 

$panel18 = new QodePanel("Tags", "tags_panel");
$elementsPage->addChild("panel18",$panel18);

	$group1 = new QodeGroup("Tags style","Define Tags style");
	$panel18->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$tags_color = new QodeField("colorsimple","tags_color","","Color","This is some description");
			$row1->addChild("tags_color",$tags_color);

			$tags_font_size = new QodeField("textsimple","tags_font_size","","Font Size (px)","This is some description");
			$row1->addChild("tags_font_size",$tags_font_size);

			$tags_line_height = new QodeField("textsimple","tags_line_height","","Line Height (px)","This is some description");
			$row1->addChild("tags_line_height",$tags_line_height);

			$tags_text_transform = new QodeField("selectblanksimple","tags_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("tags_text_transform",$tags_text_transform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$tags_font_family = new QodeField("Fontsimple","tags_font_family","-1","Font Family","This is some description");
			$row2->addChild("tags_font_family",$tags_font_family);

			$tags_font_style = new QodeField("selectblanksimple","tags_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("tags_font_style",$tags_font_style);

			$tags_font_weight = new QodeField("selectblanksimple","tags_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("tags_font_weight",$tags_font_weight);

			$tags_letter_spacing = new QodeField("textsimple","tags_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("tags_letter_spacing",$tags_letter_spacing);

		$row3 = new QodeRow(true);
		$group1->addChild("row3",$row3);

			$tags_hover_color = new QodeField("colorsimple","tags_hover_color","","Hover color","This is some description");
			$row3->addChild("tags_hover_color",$tags_hover_color);

			$tags_background_color = new QodeField("colorsimple","tags_background_color","","Background color","This is some description");
			$row3->addChild("tags_background_color",$tags_background_color);

			$tags_background_hover_color = new QodeField("colorsimple","tags_background_hover_color","","Hover background color","This is some description");
			$row3->addChild("tags_background_hover_color",$tags_background_hover_color);

//Testimonials

$panel16 = new QodePanel("Testimonials","testimonials_panel");
$elementsPage->addChild("panel16",$panel16);

	$group4 = new QodeGroup("Testimonials Title Style","Define Testimonials Title style");
	$panel16->addChild("group4",$group4);
		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);

			$testimonials_title_color = new QodeField("colorsimple","testimonials_title_color","","Color","This is some description");
			$row1->addChild("testimonials_title_color",$testimonials_title_color);

			$testimonials_title_font_size = new QodeField("textsimple","testimonials_title_font_size","","Font Size (px)","This is some description");
			$row1->addChild("testimonials_title_font_size",$testimonials_title_font_size);

			$testimonials_title_line_height = new QodeField("textsimple","testimonials_title_line_height","","Line Height (px)","This is some description");
			$row1->addChild("testimonials_title_line_height",$testimonials_title_line_height);

			$testimonials_title_text_transform = new QodeField("selectblanksimple","testimonials_title_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("testimonials_title_text_transform",$testimonials_title_text_transform);

		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);

			$testimonials_title_font_family = new QodeField("Fontsimple","testimonials_title_font_family","-1","Font Family","This is some description");
			$row2->addChild("testimonials_title_font_family",$testimonials_title_font_family);

			$testimonials_title_font_style = new QodeField("selectblanksimple","testimonials_title_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("testimonials_title_font_style",$testimonials_title_font_style);

			$testimonials_title_font_weight = new QodeField("selectblanksimple","testimonials_title_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("testimonials_title_font_weight",$testimonials_title_font_weight);

			$testimonials_title_letter_spacing = new QodeField("textsimple","testimonials_title_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("testimonials_title_letter_spacing",$testimonials_title_letter_spacing);

	$group1 = new QodeGroup("Testimonials Text Style","Define Testimonials Text style");
	$panel16->addChild("group1",$group1);
		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$testimonials_text_color = new QodeField("colorsimple","testimonials_text_color","","Color","This is some description");
			$row1->addChild("testimonials_text_color",$testimonials_text_color);

			$testimonials_text_font_size = new QodeField("textsimple","testimonials_text_font_size","","Font Size (px)","This is some description");
			$row1->addChild("testimonials_text_font_size",$testimonials_text_font_size);

			$testimonials_text_line_height = new QodeField("textsimple","testimonials_text_line_height","","Line Height (px)","This is some description");
			$row1->addChild("testimonials_text_line_height",$testimonials_text_line_height);

			$testimonials_text_text_transform = new QodeField("selectblanksimple","testimonials_text_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("testimonials_text_text_transform",$testimonials_text_text_transform);

		$row2 = new QodeRow(true);
		$group1->addChild("row2",$row2);

			$testimonials_text_font_family = new QodeField("Fontsimple","testimonials_text_font_family","-1","Font Family","This is some description");
			$row2->addChild("testimonials_text_font_family",$testimonials_text_font_family);

			$testimonials_text_font_style = new QodeField("selectblanksimple","testimonials_text_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("testimonials_text_font_style",$testimonials_text_font_style);

			$testimonials_text_font_weight = new QodeField("selectblanksimple","testimonials_text_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("testimonials_text_font_weight",$testimonials_text_font_weight);

			$testimonials_text_letter_spacing = new QodeField("textsimple","testimonials_text_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("testimonials_text_letter_spacing",$testimonials_text_letter_spacing);	

	$group2 = new QodeGroup("Testimonials Author Style","Define Testimonials Author style");
	$panel16->addChild("group2",$group2);
		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			
			$testimonials_author_color = new QodeField("colorsimple","testimonials_author_color","","Color","This is some description");
			$row1->addChild("testimonials_author_color",$testimonials_author_color);

			$testimonials_author_font_size = new QodeField("textsimple","testimonials_author_font_size","","Font Size (px)","This is some description");
			$row1->addChild("testimonials_author_font_size",$testimonials_author_font_size);

			$testimonials_author_line_height = new QodeField("textsimple","testimonials_author_line_height","","Line Height (px)","This is some description");
			$row1->addChild("testimonials_author_line_height",$testimonials_author_line_height);

			$testimonials_author_text_transform = new QodeField("selectblanksimple","testimonials_author_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("testimonials_author_text_transform",$testimonials_author_text_transform);

		$row2 = new QodeRow(true);
		$group2->addChild("row2",$row2);

			$testimonials_author_font_family = new QodeField("Fontsimple","testimonials_author_font_family","-1","Font Family","This is some description");
			$row2->addChild("testimonials_author_font_family",$testimonials_author_font_family);

			$testimonials_author_font_style = new QodeField("selectblanksimple","testimonials_author_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("testimonials_author_font_style",$testimonials_author_font_style);

			$testimonials_author_font_weight = new QodeField("selectblanksimple","testimonials_author_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("testimonials_author_font_weight",$testimonials_author_font_weight);

			$testimonials_author_letter_spacing = new QodeField("textsimple","testimonials_author_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("testimonials_author_letter_spacing",$testimonials_author_letter_spacing);

	$group5 = new QodeGroup("Testimonials Author Job Style","Define Testimonials Author Job Position style");
	$panel16->addChild("group5",$group5);
		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);

			$testimonials_author_job_color = new QodeField("colorsimple","testimonials_author_job_color","","Color","This is some description");
			$row1->addChild("testimonials_author_job_color",$testimonials_author_job_color);

			$testimonials_author_job_font_size = new QodeField("textsimple","testimonials_author_job_font_size","","Font Size (px)","This is some description");
			$row1->addChild("testimonials_author_job_font_size",$testimonials_author_job_font_size);

			$testimonials_author_job_line_height = new QodeField("textsimple","testimonials_author_job_line_height","","Line Height (px)","This is some description");
			$row1->addChild("testimonials_author_job_line_height",$testimonials_author_job_line_height);

			$testimonials_author_job_text_transform = new QodeField("selectblanksimple","testimonials_author_job_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row1->addChild("testimonials_author_job_text_transform",$testimonials_author_job_text_transform);

		$row2 = new QodeRow(true);
		$group5->addChild("row2",$row2);

			$testimonials_auhtor_job_font_family = new QodeField("Fontsimple","testimonials_author_job_font_family","-1","Font Family","This is some description");
			$row2->addChild("testimonials_author_job_font_family",$testimonials_auhtor_job_font_family);

			$testimonials_author_job_font_style = new QodeField("selectblanksimple","testimonials_author_job_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("testimonials_author_job_font_style",$testimonials_author_job_font_style);

			$testimonials_author_job_font_weight = new QodeField("selectblanksimple","testimonials_author_job_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("testimonials_author_job_font_weight",$testimonials_author_job_font_weight);

			$testimonials_author_job_letter_spacing = new QodeField("textsimple","testimonials_author_job_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("testimonials_author_job_letter_spacing",$testimonials_author_job_letter_spacing);

	$group3 = new QodeGroup("Testimonials Navigation Style","Define Testimonials Navigation Style");
	$panel16->addChild("group3",$group3);
		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);	

			$testimonials_navigation_color = new QodeField("colorsimple","testimonials_navigation_color","","Color","This is some description");
			$row1->addChild("testimonials_navigation_color",$testimonials_navigation_color);

			$testimonials_navigation_active_color = new QodeField("colorsimple","testimonials_navigation_active_color","","Active Color","This is some description");
			$row1->addChild("testimonials_navigation_active_color",$testimonials_navigation_active_color);

			$testimonaials_navigation_border_radius = new QodeField("textsimple","testimonaials_navigation_border_radius","","Border radius (px)","This is some description");
			$row1->addChild("testimonaials_navigation_border_radius",$testimonaials_navigation_border_radius);

	$group6 = new QodeGroup("Grouped Testimonials Style","Define Basic Layout for Grouped Testimonial Type");
	$panel16->addChild("group6",$group6);

		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);

			$testimonials_grouped_background_color = new QodeField("colorsimple","testimonials_grouped_background_color","","Background Color","This is some description");
			$row1->addChild("testimonials_grouped_background_color",$testimonials_grouped_background_color);

			$testimonials_grouped_background_transparency = new QodeField("textsimple","testimonials_grouped_background_transparency","","Transparency","This is some description");
			$row1->addChild("testimonials_grouped_background_transparency",$testimonials_grouped_background_transparency);

		$row2 = new QodeRow();
		$group6->addChild("row2",$row2);

			$testimonials_grouped_border_color = new QodeField("colorsimple","testimonials_grouped_border_color","","Border Color","This is some description");
			$row2->addChild("testimonials_grouped_border_color",$testimonials_grouped_border_color);

			$testimonials_grouped_border_width = new QodeField("textsimple","testimonials_grouped_border_width","","Border Width","This is some description");
			$row2->addChild("testimonials_grouped_border_width",$testimonials_grouped_border_width);
