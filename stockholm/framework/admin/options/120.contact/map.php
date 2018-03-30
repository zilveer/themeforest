<?php

$contactPage = new QodeAdminPage("13", "Contact Page");
$qodeFramework->qodeOptions->addAdminPage("Contact Page",$contactPage);

//Contact Form

$panel1 = new QodePanel("Contact Page","contact_page_panel");
$contactPage->addChild("panel1",$panel1);

	$enable_google_map = new QodeField("yesno","enable_google_map","no","Enable Google Map","Enabling this option will display a Google Map on your Contact page", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_google_map_settings_panel"));
	$panel1->addChild("enable_google_map",$enable_google_map);

	$section_between_map_form = new QodeField("yesno","section_between_map_form","yes","Show Upper Section","Enabling this option will display a section above the Contact Form", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_upper_section_settings_panel"));
	$panel1->addChild("section_between_map_form",$section_between_map_form);

	$enable_contact_form = new QodeField("yesno","enable_contact_form","no","Enable Contact Form","This option will display a Contact Form on Contact page", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_contact_form_settings_panel"));
	$panel1->addChild("enable_contact_form",$enable_contact_form);

//Google Map Settings

$panel3 = new QodePanel("Google Map Settings","google_map_settings_panel","enable_google_map","no");
$contactPage->addChild("panel3",$panel3);

	$google_map_position = new QodeField("select","google_map_position","","Google map position","Choose position for google map", array( 
       "bottom_position" => "Bottom - Between Content and Footer",
       "top_position" => "Top - Between Title and Content",
       "right_position" => "Right From Contact Form",
       "left_position" => "Left From Contact Form"
      ));

    $google_maps_api_key = new QodeField("text","google_maps_api_key","","Google Maps Api Key","Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our documentation.");
    $panel3->addChild("google_maps_api_key",$google_maps_api_key);

	$google_maps_height = new QodeField("text","google_maps_height","750","Map Height (px)","Enter a height for Google Map in pixels. Default value is 750.");
	$panel3->addChild("google_maps_height",$google_maps_height);

	$panel3->addChild("google_map_position",$google_map_position);

	$google_maps_address = new QodeField("text","google_maps_address","","Google Map Address",'Enter address to be pinned on Google Map (Example: "Louvre Museum, Paris, France');
	$panel3->addChild("google_maps_address",$google_maps_address);

	$google_maps_address2 = new QodeField("text","google_maps_address2","","Google Map Address 2","Enter additional address to be pinned on Google Map");
	$panel3->addChild("google_maps_address2",$google_maps_address2);

	$google_maps_address3 = new QodeField("text","google_maps_address3","","Google Map Address 3","Enter additional address to be pinned on Google Map");
	$panel3->addChild("google_maps_address3",$google_maps_address3);

	$google_maps_address4 = new QodeField("text","google_maps_address4","","Google Map Address 4","Enter additional address to be pinned on Google Map");
	$panel3->addChild("google_maps_address4",$google_maps_address4);

	$google_maps_address5 = new QodeField("text","google_maps_address5","","Google Map Address 5","Enter additional address to be pinned on Google Map");
	$panel3->addChild("google_maps_address5",$google_maps_address5);

	$google_maps_pin_image = new QodeField("image","google_maps_pin_image",QODE_ROOT."/img/pin.png","Pin Image","Select a pin image to be used on Google Map ");
	$panel3->addChild("google_maps_pin_image",$google_maps_pin_image);

	$google_maps_zoom = new QodeField("range","google_maps_zoom","12","Map Zoom","Enter a zoom factor for Google Map (0 = whole worlds, 19 = individual buildings)", array(), array( "range_min" => "3",
       "range_max" => "19",
       "range_step" => "1",
       "range_decimals" => "0"
      ));
	$panel3->addChild("google_maps_zoom",$google_maps_zoom);

	$google_maps_scroll_wheel = new QodeField("yesno","google_maps_scroll_wheel","no","Zoom Map on Mouse Wheel","Enabling this option will allow users to zoom in on Map using mouse wheel");
	$panel3->addChild("google_maps_scroll_wheel",$google_maps_scroll_wheel);

	$google_maps_style = new QodeField("yesno","google_maps_style","yes","Custom Map Style","Enabling this option will allow Map editing", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_google_maps_style_container"));
	$panel3->addChild("google_maps_style",$google_maps_style);
	
	$google_maps_style_container = new QodeContainer("google_maps_style_container","google_maps_style","no");
	$panel3->addChild("google_maps_style_container",$google_maps_style_container);

		$google_maps_color = new QodeField("color","google_maps_color","","Color Overlay","Choose a Map color overlay");
		$google_maps_style_container->addChild("google_maps_color",$google_maps_color);
		
		$google_maps_saturation = new QodeField("range","google_maps_saturation","","Saturation","Choose a level of saturation (-100 = least saturated, 100 = most saturated)", array(), array( "range_min" => "-100",
	       "range_max" => "100",
	       "range_step" => "1",
	       "range_decimals" => "0"
	      ));
		$google_maps_style_container->addChild("google_maps_saturation",$google_maps_saturation);
		
		$google_maps_lightness = new QodeField("range","google_maps_lightness","","Lightness","Choose a level of lightness (-100 = darkest, 100 = lightest)", array(), array( "range_min" => "-100",
	       "range_max" => "100",
	       "range_step" => "1",
	       "range_decimals" => "0"
	      ));
		$google_maps_style_container->addChild("google_maps_lightness",$google_maps_lightness);

//Upper Section Settings

$panel4 = new QodePanel("Upper Section Settings","upper_section_settings_panel","section_between_map_form","no");
$contactPage->addChild("panel4",$panel4);

	$contact_section_text_align = new QodeField("select","contact_section_text_align","","Section Alignment","Choose an alignment for Upper Section", array( "" => "Default",
       "left_align" => "Left",
       "right_align" => "Right",
       "center_align" => "Center"
      ));
	$panel4->addChild("contact_section_text_align",$contact_section_text_align);

	$contact_section_above_form_title = new QodeField("text","contact_section_above_form_title","","Title","Enter a title to be displayed in Upper Section");
	$panel4->addChild("contact_section_above_form_title",$contact_section_above_form_title);

	$contact_section_above_form_subtitle = new QodeField("text","contact_section_above_form_subtitle","","Subtitle","Enter a subtitle to be displayed in Upper Section");
	$panel4->addChild("contact_section_above_form_subtitle",$contact_section_above_form_subtitle);

//Contact Form Settings

$panel2 = new QodePanel("Contact Form Settings","contact_form_settings_panel","enable_contact_form","no");
$contactPage->addChild("panel2",$panel2);

	$receive_mail = new QodeField("text","receive_mail","","Mail Send To","Enter email address for receiving messages submitted through Contact Form");
	$panel2->addChild("receive_mail",$receive_mail);
	
	$email_from = new QodeField("text","email_from","","Email From",'Enter a default email address to appear in "From" field when receiving emails through Contact Form');
	$panel2->addChild("email_from",$email_from);

	$email_subject = new QodeField("text","email_subject","","Email Subject",'Enter a default message to appear in "Subject" field when receiving emails through Contact Form');
	$panel2->addChild("email_subject",$email_subject);

	$hide_contact_form_website = new QodeField("yesno","hide_contact_form_website","no","Hide Website Field",'Enabling this option will hide the "Website" field on Contact Form');
	$panel2->addChild("hide_contact_form_website",$hide_contact_form_website);

	$contact_heading_above = new QodeField("text","contact_heading_above","","Contact Form Heading","Enter a heading to be displayed above Contact Form");
	$panel2->addChild("contact_heading_above",$contact_heading_above);

	$use_recaptcha = new QodeField("yesno","use_recaptcha","no","Use reCAPTCHA","Enabling this option will place a reCAPTCHA box under Contact Form", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_use_recaptcha_container"));
	$panel2->addChild("use_recaptcha",$use_recaptcha);
	
	$use_recaptcha_container = new QodeContainer("use_recaptcha_container","use_recaptcha","no");
	$panel2->addChild("use_recaptcha_container",$use_recaptcha_container);

		$recaptcha_public_key = new QodeField("text","recaptcha_public_key","","reCAPTCHA Public Key","Enter reCAPTCHA public key. For more info, see https://www.google.com/recaptcha");
		$use_recaptcha_container->addChild("recaptcha_public_key",$recaptcha_public_key);
	
		$recaptcha_private_key = new QodeField("text","recaptcha_private_key","","reCAPTCHA Private Key","Enter reCAPTCHA private key. For more info, see https://www.google.com/recaptcha");
		$use_recaptcha_container->addChild("recaptcha_private_key",$recaptcha_private_key);

	$use_custom_style = new QodeField("yesno","use_custom_style","no","Use Custom Style","Enabling this option will use custom style set for contact form on contact page", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => ""));
	$panel2->addChild("use_custom_style",$use_custom_style);

//Contact Form 7 Settings

$panel5 = new QodePanel("Custom Style 1 Settings","contact_form_custom_style_1_panel");
$contactPage->addChild("panel5",$panel5);

	$group1 = new QodeGroup("Form Elements' Background","Define background for form elements (input, textarea, select)");
	$panel5->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);
			$cf7_custom_style_1_element_background_color = new QodeField("colorsimple","cf7_custom_style_1_element_background_color","","Background Color","This is some description");
			$row1->addChild("cf7_custom_style_1_element_background_color",$cf7_custom_style_1_element_background_color);
			$cf7_custom_style_1_element_focus_background_color = new QodeField("colorsimple","cf7_custom_style_1_element_focus_background_color","","Focus Background Color","This is some description");
			$row1->addChild("cf7_custom_style_1_element_focus_background_color",$cf7_custom_style_1_element_focus_background_color);
			$cf7_custom_style_1_element_background_transparency = new QodeField("textsimple","cf7_custom_style_1_element_background_transparency","","Background Transparency (values: 0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_background_transparency",$cf7_custom_style_1_element_background_transparency);
			$cf7_custom_style_1_element_focus_background_transparency = new QodeField("textsimple","cf7_custom_style_1_element_focus_background_transparency","","Focus Background Transparency (0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_focus_background_transparency",$cf7_custom_style_1_element_focus_background_transparency);

	$group2 = new QodeGroup("Form Elements' Border","Define border style for form elements (text input fields, textarea, select)");
	$panel5->addChild("group2",$group2);

		$row1 = new QodeRow();
		$group2->addChild("row1",$row1);
			$cf7_custom_style_1_element_border_color = new QodeField("colorsimple","cf7_custom_style_1_element_border_color","","Border Color","This is some description");
			$row1->addChild("cf7_custom_style_1_element_border_color",$cf7_custom_style_1_element_border_color);
			$cf7_custom_style_1_element_focus_border_color = new QodeField("colorsimple","cf7_custom_style_1_element_focus_border_color","","Focus Border Color","This is some description");
			$row1->addChild("cf7_custom_style_1_element_focus_border_color",$cf7_custom_style_1_element_focus_border_color);
			$cf7_custom_style_1_border_transparency = new QodeField("textsimple","cf7_custom_style_1_border_transparency","","Border Transparency (values: 0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_border_transparency",$cf7_custom_style_1_border_transparency);
			$cf7_custom_style_1_focus_border_transparency = new QodeField("textsimple","cf7_custom_style_1_focus_border_transparency","","Focus Border Transparency (values: 0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_focus_border_transparency",$cf7_custom_style_1_focus_border_transparency);

		$row2 = new QodeRow();
		$group2->addChild("row2",$row2);
			$cf7_custom_style_1_element_border_width = new QodeField("textsimple","cf7_custom_style_1_element_border_width","","Border Width (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_element_border_width",$cf7_custom_style_1_element_border_width);
			$cf7_custom_style_1_element_border_radius = new QodeField("textsimple","cf7_custom_style_1_element_border_radius","","Border Radius (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_element_border_radius",$cf7_custom_style_1_element_border_radius);
			$cf7_custom_style_1_element_border_bottom = new QodeField("yesnosimple","cf7_custom_style_1_element_border_bottom","no","Show Only Border Bottom","This is some description");
			$row2->addChild("cf7_custom_style_1_element_border_bottom",$cf7_custom_style_1_element_border_bottom);

	$group3 = new QodeGroup("Form Elements' Text Style","Define text style for form elements (text input fields, textarea, select)");
	$panel5->addChild("group3",$group3);

		$row1 = new QodeRow();
		$group3->addChild("row1",$row1);
			$cf7_custom_style_1_element_font_color = new QodeField("colorsimple","cf7_custom_style_1_element_font_color","","Text Color","This is some description");
			$row1->addChild("cf7_custom_style_1_element_font_color",$cf7_custom_style_1_element_font_color);
			$cf7_custom_style_1_element_font_focus_color = new QodeField("colorsimple","cf7_custom_style_1_element_font_focus_color","","Focus Text Color","This is some description");
			$row1->addChild("cf7_custom_style_1_element_font_focus_color",$cf7_custom_style_1_element_font_focus_color);
			$cf7_custom_style_1_element_font_size = new QodeField("textsimple","cf7_custom_style_1_element_font_size","","Font Size (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_font_size",$cf7_custom_style_1_element_font_size);
			$cf7_custom_style_1_element_line_height = new QodeField("textsimple","cf7_custom_style_1_element_line_height","","Line Height (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_line_height",$cf7_custom_style_1_element_line_height);

		$row2 = new QodeRow(true);
		$group3->addChild("row2",$row2);
			$cf7_custom_style_1_element_font_family = new QodeField("fontsimple","cf7_custom_style_1_element_font_family","-1","Font Family","This is some description");
			$row2->addChild("cf7_custom_style_1_element_font_family",$cf7_custom_style_1_element_font_family);
			$cf7_custom_style_1_element_font_style = new QodeField("selectblanksimple","cf7_custom_style_1_element_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("cf7_custom_style_1_element_font_style",$cf7_custom_style_1_element_font_style);
			$cf7_custom_style_1_element_font_weight = new QodeField("selectblanksimple","cf7_custom_style_1_element_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("cf7_custom_style_1_element_font_weight",$cf7_custom_style_1_element_font_weight);
			$cf7_custom_style_1_element_text_transform = new QodeField("selectblanksimple","cf7_custom_style_1_element_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("cf7_custom_style_1_element_text_transform",$cf7_custom_style_1_element_text_transform);

		$row3 = new QodeRow(true);
		$group3->addChild("row3",$row3);
			$cf7_custom_style_1_element_letter_spacing = new QodeField("textsimple","cf7_custom_style_1_element_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_element_letter_spacing",$cf7_custom_style_1_element_letter_spacing);

	$group4 = new QodeGroup("Form Elements' Labels Style","Define labels style for form elements (text input fields, textarea, select)");
	$panel5->addChild("group4",$group4);

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$cf7_custom_style_1_label_font_color = new QodeField("colorsimple","cf7_custom_style_1_label_font_color","","Text Color","This is some description");
			$row1->addChild("cf7_custom_style_1_label_font_color",$cf7_custom_style_1_label_font_color);
			$cf7_custom_style_1_label_font_size = new QodeField("textsimple","cf7_custom_style_1_label_font_size","","Font Size (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_label_font_size",$cf7_custom_style_1_label_font_size);
			$cf7_custom_style_1_label_line_height = new QodeField("textsimple","cf7_custom_style_1_label_line_height","","Line Height (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_label_line_height",$cf7_custom_style_1_label_line_height);
			$cf7_custom_style_1_label_font_family = new QodeField("fontsimple","cf7_custom_style_1_label_font_family","-1","Font Family","This is some description");
			$row1->addChild("cf7_custom_style_1_label_font_family",$cf7_custom_style_1_label_font_family);

		$row2 = new QodeRow(true);
		$group4->addChild("row2",$row2);
			$cf7_custom_style_1_label_font_style = new QodeField("selectblanksimple","cf7_custom_style_1_label_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("cf7_custom_style_1_label_font_style",$cf7_custom_style_1_label_font_style);
			$cf7_custom_style_1_label_font_weight = new QodeField("selectblanksimple","cf7_custom_style_1_label_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("cf7_custom_style_1_label_font_weight",$cf7_custom_style_1_label_font_weight);
			$cf7_custom_style_1_label_text_transform = new QodeField("selectblanksimple","cf7_custom_style_1_label_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("cf7_custom_style_1_label_text_transform",$cf7_custom_style_1_label_text_transform);
			$cf7_custom_style_1_label_letter_spacing = new QodeField("textsimple","cf7_custom_style_1_label_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_label_letter_spacing",$cf7_custom_style_1_label_letter_spacing);

	$group5 = new QodeGroup("Form Elements' Padding","Define padding for form elements (text input fields, textarea, select)");
	$panel5->addChild("group5",$group5);
		$row1 = new QodeRow();
		$group5->addChild("row1",$row1);
			$cf7_custom_style_1_element_padding_top = new QodeField("textsimple","cf7_custom_style_1_element_padding_top","","Padding Top (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_padding_top",$cf7_custom_style_1_element_padding_top);
			$cf7_custom_style_1_element_padding_right = new QodeField("textsimple","cf7_custom_style_1_element_padding_right","","Padding Right (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_padding_right",$cf7_custom_style_1_element_padding_right);
			$cf7_custom_style_1_element_padding_bottom = new QodeField("textsimple","cf7_custom_style_1_element_padding_bottom","","Padding Bottom (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_padding_bottom",$cf7_custom_style_1_element_padding_bottom);
			$cf7_custom_style_1_element_padding_left = new QodeField("textsimple","cf7_custom_style_1_element_padding_left","","Padding Left (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_padding_left",$cf7_custom_style_1_element_padding_left);

	$group6 = new QodeGroup("Form Elements' Margin","Define margin for form elements (text input fields, textarea, select)");
	$panel5->addChild("group6",$group6);
		$row1 = new QodeRow();
		$group6->addChild("row1",$row1);
			$cf7_custom_style_1_element_margin_top = new QodeField("textsimple","cf7_custom_style_1_element_margin_top","","Margin Top (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_margin_top",$cf7_custom_style_1_element_margin_top);
			$cf7_custom_style_1_element_margin_bottom = new QodeField("textsimple","cf7_custom_style_1_element_margin_bottom","","Margin Bottom (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_element_margin_bottom",$cf7_custom_style_1_element_margin_bottom);

	$cf7_custom_style_1_element_textarea_height = new QodeField("text","cf7_custom_style_1_element_textarea_height","","Textarea Height (px)","Enter height for textarea form element", array(), array("col_width" => 3));
	$panel5->addChild("cf7_custom_style_1_element_textarea_height",$cf7_custom_style_1_element_textarea_height);


	$group7 = new QodeGroup("Button Background","Define background for button");
	$panel5->addChild("group7",$group7);

		$row1 = new QodeRow();
		$group7->addChild("row1",$row1);
			$cf7_custom_style_1_button_background_color = new QodeField("colorsimple","cf7_custom_style_1_button_background_color","","Background Color","This is some description");
			$row1->addChild("cf7_custom_style_1_button_background_color",$cf7_custom_style_1_button_background_color);
			$cf7_custom_style_1_button_hover_background_color = new QodeField("colorsimple","cf7_custom_style_1_button_hover_background_color","","Hover Background Color","This is some description");
			$row1->addChild("cf7_custom_style_1_button_hover_background_color",$cf7_custom_style_1_button_hover_background_color);
			$cf7_custom_style_1_button_background_transparency = new QodeField("textsimple","cf7_custom_style_1_button_background_transparency","","Background Transparency (values: 0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_button_background_transparency",$cf7_custom_style_1_button_background_transparency);
			$cf7_custom_style_1_button_hover_background_transparency = new QodeField("textsimple","cf7_custom_style_1_button_hover_background_transparency","","Hover Background Transparency (0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_button_hover_background_transparency",$cf7_custom_style_1_button_hover_background_transparency);

	$group8 = new QodeGroup("Button Border","Define border style for button");
	$panel5->addChild("group8",$group8);

		$row1 = new QodeRow();
		$group8->addChild("row1",$row1);
			$cf7_custom_style_1_button_border_color = new QodeField("colorsimple","cf7_custom_style_1_button_border_color","","Border Color","This is some description");
			$row1->addChild("cf7_custom_style_1_button_border_color",$cf7_custom_style_1_button_border_color);
			$cf7_custom_style_1_button_hover_border_color = new QodeField("colorsimple","cf7_custom_style_1_button_hover_border_color","","Border Hover Color","This is some description");
			$row1->addChild("cf7_custom_style_1_button_hover_border_color",$cf7_custom_style_1_button_hover_border_color);
			$cf7_custom_style_1_button_border_transparency = new QodeField("textsimple","cf7_custom_style_1_button_border_transparency","","Border Transparency (values: 0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_button_border_transparency",$cf7_custom_style_1_button_border_transparency);
			$cf7_custom_style_1_button_hover_border_transparency = new QodeField("textsimple","cf7_custom_style_1_button_hover_border_transparency","","Hover Border Transparency (values: 0-1)","This is some description");
			$row1->addChild("cf7_custom_style_1_button_hover_border_transparency",$cf7_custom_style_1_button_hover_border_transparency);

		$row2 = new QodeRow();
		$group8->addChild("row2",$row2);
			$cf7_custom_style_1_button_border_width = new QodeField("textsimple","cf7_custom_style_1_button_border_width","","Border Width (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_button_border_width",$cf7_custom_style_1_button_border_width);
			$cf7_custom_style_1_button_border_radius = new QodeField("textsimple","cf7_custom_style_1_button_border_radius","","Border Radius (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_button_border_radius",$cf7_custom_style_1_button_border_radius);

	$group9 = new QodeGroup("Button Text Style","Define text style for button");
	$panel5->addChild("group9",$group9);

		$row1 = new QodeRow();
		$group9->addChild("row1",$row1);
			$cf7_custom_style_1_button_font_color = new QodeField("colorsimple","cf7_custom_style_1_button_font_color","","Text Color","This is some description");
			$row1->addChild("cf7_custom_style_1_button_font_color",$cf7_custom_style_1_button_font_color);
			$cf7_custom_style_1_button_font_hover_color = new QodeField("colorsimple","cf7_custom_style_1_button_font_hover_color","","Hover Text Color","This is some description");
			$row1->addChild("cf7_custom_style_1_button_font_hover_color",$cf7_custom_style_1_button_font_hover_color);
			$cf7_custom_style_1_button_font_size = new QodeField("textsimple","cf7_custom_style_1_button_font_size","","Font Size (px)","This is some description");
			$row1->addChild("cf7_custom_style_1_button_font_size",$cf7_custom_style_1_button_font_size);
			$cf7_custom_style_1_button_font_family = new QodeField("fontsimple","cf7_custom_style_1_button_font_family","-1","Font Family","This is some description");
			$row1->addChild("cf7_custom_style_1_button_font_family",$cf7_custom_style_1_button_font_family);

		$row2 = new QodeRow(true);
		$group9->addChild("row2",$row2);
			$cf7_custom_style_1_button_font_style = new QodeField("selectblanksimple","cf7_custom_style_1_button_font_style","","Font Style","This is some description",$options_fontstyle);
			$row2->addChild("cf7_custom_style_1_button_font_style",$cf7_custom_style_1_button_font_style);
			$cf7_custom_style_1_button_font_weight = new QodeField("selectblanksimple","cf7_custom_style_1_button_font_weight","","Font Weight","This is some description",$options_fontweight);
			$row2->addChild("cf7_custom_style_1_button_font_weight",$cf7_custom_style_1_button_font_weight);
			$cf7_custom_style_1_button_text_transform = new QodeField("selectblanksimple","cf7_custom_style_1_button_text_transform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("cf7_custom_style_1_button_text_transform",$cf7_custom_style_1_button_text_transform);
			$cf7_custom_style_1_button_letter_spacing = new QodeField("textsimple","cf7_custom_style_1_button_letter_spacing","","Letter Spacing (px)","This is some description");
			$row2->addChild("cf7_custom_style_1_button_letter_spacing",$cf7_custom_style_1_button_letter_spacing);

	$group10 = new QodeGroup("Button Dimensions","Define dimensions for button");
	$panel5->addChild("group10",$group10);

		$row1 = new QodeRow();
		$group10->addChild("row1",$row1);
			$cf7_custom_style_1_button_height = new QodeField("textsimple","cf7_custom_style_1_button_height","","Button Height (px)","Enter button height in px");
			$row1->addChild("cf7_custom_style_1_button_height",$cf7_custom_style_1_button_height);
			$cf7_custom_style_1_button_padding = new QodeField("textsimple","cf7_custom_style_1_button_padding","","Button Padding (px)","Enter value for button left and right padding in px");
			$row1->addChild("cf7_custom_style_1_button_padding",$cf7_custom_style_1_button_padding);
			$cf7_custom_style_1_button_margin = new QodeField("textsimple","cf7_custom_style_1_button_margin","","Button Top Margin (px)","Enter value for button top margin in px");
			$row1->addChild("cf7_custom_style_1_button_margin",$cf7_custom_style_1_button_margin);

	$cf7_custom_style_1_error_validation_messages_color = new QodeField("color","cf7_custom_style_1_error_validation_messages_color","","Validation Error Text Color","Choose color for error form validation text messages");
	$panel5->addChild("cf7_custom_style_1_error_validation_messages_color",$cf7_custom_style_1_error_validation_messages_color);
