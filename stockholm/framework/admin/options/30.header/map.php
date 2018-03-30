<?php

$headerandfooterPage = new QodeAdminPage("2", "Header");
$qodeFramework->qodeOptions->addAdminPage("headerandfooter",$headerandfooterPage);

// Header Position

$panel6 = new QodePanel("Header Position", "header_position");
$headerandfooterPage->addChild("panel6",$panel6);
	$vertical_area = new QodeField("yesno","vertical_area","no","Switch to Left Menu","Enabling this option will switch to a Left Menu area (default is Top Menu)", array(),
		array("dependence" => true,
		"dependence_hide_on_yes" => "#qodef_header_panel,#qodef_menu_panel,#qodef_header_top_panel,#qodef_enable_search_panel,#qodef_enable_side_area_panel,#qodef_enable_popup_menu_panel,#qodef_language_switcher",
		"dependence_show_on_yes" => "#qodef_vertical_areas_panel"));
	$panel6->addChild("vertical_area",$vertical_area);

// Header

$panel5 = new QodePanel("Header","header_panel","vertical_area","yes");
$headerandfooterPage->addChild("panel5",$panel5);

	$header_in_grid = new QodeField("yesno","header_in_grid","yes","Header in Grid","Enabling this option will display header content in grid");
	$panel5->addChild("header_in_grid",$header_in_grid);

	$header_bottom_appearance = new QodeField("select","header_bottom_appearance","fixed","Header Type","Choose the header layout & behavior", array( 
        "regular" => "Regular",
        "fixed" => "Fixed",
        "fixed_hiding" => "Fixed Advanced",
        "stick" => "Sticky",
        "stick menu_bottom" => "Sticky Expanded",
        "stick_with_left_right_menu" => "Sticky Divided"
      ),
      array("dependence" => true,
      	"hide" => array(
      		"regular"=>"#qodef_scroll_amount_for_sticky_container,#qodef_header_height_scroll,#qodef_header_height_sticky,#qodef_header_height_scroll_hidden,#qodef_header_background_color_scroll,#qodef_header_background_color_sticky,#qodef_header_background_transparency_scroll,#qodef_header_background_transparency_sticky,#qodef_scroll_amount_for_fixed_hiding_container",
	        "fixed"=>"#qodef_scroll_amount_for_sticky_container,#qodef_header_height_sticky,#qodef_header_height_scroll_hidden,#qodef_header_background_color_sticky,#qodef_header_background_transparency_sticky,#qodef_scroll_amount_for_fixed_hiding_container",
	        "fixed_hiding"=>"#qodef_scroll_amount_for_sticky_container,#qodef_menu_position_container,#qodef_header_height_scroll,#qodef_header_height_sticky,#qodef_header_background_color_sticky,#qodef_header_background_transparency_sticky",
      		"stick menu_bottom"=>"#qodef_menu_position_container,#qodef_header_height_scroll,#qodef_header_height_scroll_hidden,#qodef_header_background_transparency_scroll,#qodef_header_background_color_scroll,#qodef_scroll_amount_for_fixed_hiding_container",
            "stick_with_left_right_menu"=>"#qodef_menu_position_container,#qodef_header_height_scroll,#qodef_header_height_scroll_hidden,#qodef_header_background_transparency_scroll,#qodef_header_background_color_scroll,#qodef_scroll_amount_for_fixed_hiding_container",
      		"stick"=>"#qodef_header_height_scroll,#qodef_header_height_scroll_hidden,#qodef_header_background_color_scroll,#qodef_header_background_transparency_scroll,#qodef_scroll_amount_for_fixed_hiding_container"),
      	"show" => array(
      		"regular"=>"#qodef_menu_position_container",
      		"fixed"=>"#qodef_menu_position_container,#qodef_header_height_scroll,#qodef_header_background_color_scroll,#qodef_header_background_transparency_scroll",
      		"stick"=>"#qodef_scroll_amount_for_sticky_container,#qodef_menu_position_container,#qodef_header_height_sticky,#qodef_header_background_color_sticky,#qodef_header_background_transparency_sticky",
      		"stick menu_bottom"=>"#qodef_scroll_amount_for_sticky_container,#qodef_header_height_sticky,#qodef_header_background_color_sticky,#qodef_header_background_transparency_sticky",
            "stick_with_left_right_menu"=>"#qodef_scroll_amount_for_sticky_container,#qodef_header_height_sticky,#qodef_header_background_color_sticky,#qodef_header_background_transparency_sticky",
      		"fixed_hiding"=>"#qodef_header_height_scroll_hidden,#qodef_header_background_color_scroll,#qodef_header_background_transparency_scroll,#qodef_scroll_amount_for_fixed_hiding_container") ));
	$panel5->addChild("header_bottom_appearance",$header_bottom_appearance);

	$scroll_amount_for_sticky_container = new QodeContainer("scroll_amount_for_sticky_container","header_bottom_appearance","fixed", array( "regular","fixed","fixed_hiding") );
	$panel5->addChild("scroll_amount_for_sticky_container",$scroll_amount_for_sticky_container);
		$scroll_amount_for_sticky = new QodeField("text","scroll_amount_for_sticky","","Scroll Amount for Sticky (px)","Enter scroll amount (in pixels) for Sticky Menu to appear", array(), array("col_width" => 3));
		$scroll_amount_for_sticky_container->addChild("scroll_amount_for_sticky",$scroll_amount_for_sticky);

    $scroll_amount_for_fixed_hiding_container = new QodeContainer("scroll_amount_for_fixed_hiding_container","header_bottom_appearance","fixed", array( "regular","fixed","stick", "stick menu_bottom", "stick_with_left_right_menu") );
    $panel5->addChild("scroll_amount_for_fixed_hiding_container",$scroll_amount_for_fixed_hiding_container);
        $scroll_amount_for_fixed_hiding = new QodeField("text","scroll_amount_for_fixed_hiding","","Scroll Amount (px)","Enter scroll amount (in pixels) for menu to hide", array(), array("col_width" => 3));
        $scroll_amount_for_fixed_hiding_container->addChild("scroll_amount_for_fixed_hiding",$scroll_amount_for_fixed_hiding);

	$menu_position_container = new QodeContainer("menu_position_container","header_bottom_appearance","fixed_hiding", array( "stick menu_bottom","stick_with_left_right_menu","fixed_hiding") );
	$panel5->addChild("menu_position_container",$menu_position_container);

		$menu_position = new QodeField("select","menu_position","","Menu Position","Choose a menu position (default is right alignment)", array( "-1" => "Default",
       "center" => "Center"
      ));
		$menu_position_container->addChild("menu_position",$menu_position);

	    $center_logo_image = new QodeField("yesno","center_logo_image","no","Center Logo","Enabling this option will center logo and position it above menu", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_center_logo_image_container"));
	    $menu_position_container->addChild("center_logo_image",$center_logo_image);

    	$center_logo_image_container = new QodeContainer("center_logo_image_container","center_logo_image","no");
    	$menu_position_container->addChild("center_logo_image_container",$center_logo_image_container);

		$center_logo_image_animate = new QodeField("yesno","center_logo_image_animate","no","Animate Centered Logo","Enabling this option will animate logo upon loading");
		$center_logo_image_container->addChild("center_logo_image_animate",$center_logo_image_animate);

        $enable_border_top_bottom_menu = new QodeField("yesno","enable_border_top_bottom_menu","no","Enable Top/Bottom Border in Menu","Enabling this option will display top and bottom border in menu.", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_menu_border_container"));
        $center_logo_image_container->addChild("enable_border_top_bottom_menu",$enable_border_top_bottom_menu);

            $menu_border_container = new QodeContainer("menu_border_container","enable_border_top_bottom_menu","no");
            $center_logo_image_container->addChild("menu_border_container",$menu_border_container);

                $color_border_top_bottom_menu = new QodeField("color","color_border_top_bottom_menu","","Border Color","Choose a color for the top/bottom border in menu.");
                $menu_border_container->addChild("color_border_top_bottom_menu",$color_border_top_bottom_menu); 

    $disable_text_shadow_for_sticky = new QodeField("yesno","disable_text_shadow_for_sticky","yes","Disable Dropdown Shadow For Scrolled Header","Enabling this option will display text shadow for scrolled/sticky header");
    $panel5->addChild("disable_text_shadow_for_sticky",$disable_text_shadow_for_sticky);            

    $group1 = new QodeGroup("Header Height","Enter header height in pixels");
    $panel5->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

            $header_height = new QodeField("textsimple","header_height","","Initial (px)","Initial header (px)");
            $row1->addChild("header_height",$header_height);

            $header_height_scroll = new QodeField("textsimple","header_height_scroll","","After Scroll (px)","This is some description", array(), array(),"header_bottom_appearance", array( "regular","stick","stick menu_bottom","stick_with_left_right_menu","fixed_hiding"));
            $row1->addChild("header_height_scroll",$header_height_scroll);

            $header_height_sticky = new QodeField("textsimple","header_height_sticky","","After Scroll (px)","This is some description", array(), array(),"header_bottom_appearance", array( "regular","fixed","fixed_hiding"));
            $row1->addChild("header_height_sticky",$header_height_sticky);

            $header_height_scroll_hidden = new QodeField("textsimple","header_height_scroll_hidden","","After Scroll (px)","This is some description", array(), array(),"header_bottom_appearance", array( "regular","fixed","stick","stick menu_bottom","stick_with_left_right_menu"));
            $row1->addChild("header_height_scroll_hidden",$header_height_scroll_hidden);

            $header_height_mobile = new QodeField("textsimple","header_height_mobile","","Mobile (px)","Mobile header height (px)");
            $row1->addChild("header_height_mobile",$header_height_mobile);

    $header_style = new QodeField("select","header_style","","Header Skin","Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style", array(
        "-1" => "",
        "light" => "Light",
        "dark" => "Dark"
    ));
    $panel5->addChild("header_style",$header_style);

    $group2 = new QodeGroup("Header Background Color","Choose a background color for header area");
    $panel5->addChild("group2",$group2);

        $row1 = new QodeRow();
        $group2->addChild("row1",$row1);

            $header_background_color = new QodeField("colorsimple","header_background_color","","Initial","This is some description");
            $row1->addChild("header_background_color",$header_background_color);

            $header_background_color_scroll = new QodeField("colorsimple","header_background_color_scroll","","After Scroll","This is some description", array(), array(),"header_bottom_appearance", array( "regular","stick","stick menu_bottom","stick_with_left_right_menu"));
            $row1->addChild("header_background_color_scroll",$header_background_color_scroll);

            $header_background_color_sticky = new QodeField("colorsimple","header_background_color_sticky","","After Scroll","This is some description", array(), array(),"header_bottom_appearance", array( "regular","fixed","fixed_hiding"));
            $row1->addChild("header_background_color_sticky",$header_background_color_sticky);

    $group3 = new QodeGroup("Header Transparency","Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)");
    $panel5->addChild("group3",$group3);

        $row1 = new QodeRow();
        $group3->addChild("row1",$row1);

            $header_background_transparency_initial = new QodeField("textsimple","header_background_transparency_initial","","Initial","This is some description");
            $row1->addChild("header_background_transparency_initial",$header_background_transparency_initial);

            $header_background_transparency_scroll = new QodeField("textsimple","header_background_transparency_scroll","","After Scroll","This is some description", array(), array(),"header_bottom_appearance", array( "regular","stick","stick menu_bottom","stick_with_left_right_menu"));
            $row1->addChild("header_background_transparency_scroll",$header_background_transparency_scroll);

            $header_background_transparency_sticky = new QodeField("textsimple","header_background_transparency_sticky","","After Scroll","This is some description", array(), array(),"header_bottom_appearance", array( "regular","fixed","fixed_hiding"));
            $row1->addChild("header_background_transparency_sticky",$header_background_transparency_sticky);

    $enable_header_bottom_border = new QodeField("yesno","enable_header_bottom_border","no","Enable Header Bottom Border","This option displays a border under the header", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_header_bottom_border_container"));
    $panel5->addChild("enable_header_bottom_border",$enable_header_bottom_border);

        $header_bottom_border_container = new QodeContainer("header_bottom_border_container","enable_header_bottom_border","no");
        $panel5->addChild("header_bottom_border_container",$header_bottom_border_container);

            $header_bottom_border_color = new QodeField("color","header_bottom_border_color","","Header Bottom Border Color","Choose a color for the header bottom border. Note: If color has not been chosen, border bottom will not be displayed");
            $header_bottom_border_container->addChild("header_bottom_border_color",$header_bottom_border_color);

            $header_botom_border_transparency = new QodeField("text","header_botom_border_transparency","","Header Bottom Border Transparency","Choose a transparency for the header border color (0 = fully transparent, 1 = opaque). Note: Works only if Header Bottom Border Color is filled", array(), array("col_width" => 3));
            $header_bottom_border_container->addChild("header_botom_border_transparency",$header_botom_border_transparency);

            $header_botom_border_in_grid = new QodeField("yesno","header_botom_border_in_grid","no","Enable Header Bottom Border in Grid","Enabling this option will set header border bottom width in grid.");
            $header_bottom_border_container->addChild("header_botom_border_in_grid",$header_botom_border_in_grid);     
   
// Menu

$panel4 = new QodePanel("Menu", "menu_panel","vertical_area","yes");
$headerandfooterPage->addChild("panel4",$panel4);

    $enable_menu_hover_animation = new QodeField("yesno","enable_menu_hover_animation","no","Enable 1st Level Menu Hover Animation","This option will enable hover animation for first level in main menu", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_menu_hover_animation_container"));
    $panel4->addChild("enable_menu_hover_animation",$enable_menu_hover_animation);

        $enable_menu_hover_animation_container = new QodeContainer("enable_menu_hover_animation_container","enable_menu_hover_animation","no");
        $panel4->addChild("enable_menu_hover_animation_container",$enable_menu_hover_animation_container);

            $menu_hover_type = new QodeField("select","menu_hover_type","","Menu Hover Animation Type","Choose a hover animation type for firsl level in main menu", array(
                "underline" => "Underline",
                "line-through" => "Line Through",
                "underline-bottom" => "Underline Bottom of Header",
            ));
            $enable_menu_hover_animation_container->addChild("menu_hover_type",$menu_hover_type);

            $menu_hover_animation_color = new QodeField("color","menu_hover_animation_color","","Color","Chose a color");
            $enable_menu_hover_animation_container->addChild("menu_hover_animation_color",$menu_hover_animation_color);



        $menu_dropdown_appearance = new QodeField("select","menu_dropdown_appearance","","Dropdown Appearance","Choose appearance for dropdown menu", array(
            "" => "Default",
            "animate_height" => "Animate Height"
        ));
        $panel4->addChild("menu_dropdown_appearance",$menu_dropdown_appearance);


    $group1 = new QodeGroup("Main Dropdown Menu","Choose a color and transparency for the main menu background (0 = fully transparent, 1 = opaque)");
    $panel4->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

            $dropdown_background_color = new QodeField("colorsimple","dropdown_background_color","","Background Color","This is some description");
            $row1->addChild("dropdown_background_color",$dropdown_background_color);

            $dropdown_background_transparency = new QodeField("textsimple","dropdown_background_transparency","","Transparency","This is some description");
            $row1->addChild("dropdown_background_transparency",$dropdown_background_transparency);

            $dropdown_separator_color = new QodeField("colorsimple","dropdown_separator_color","","Item Separator Bottom Color","This is some description");
            $row1->addChild("dropdown_separator_color",$dropdown_separator_color);

            $header_separator_color = new QodeField("colorsimple","header_separator_color","","Vertical Separator Color for Wide Menu","");
            $row1->addChild("header_separator_color",$header_separator_color);

    $disable_dropdown_top_separator = new QodeField("yesno","disable_dropdown_top_separator","no","Disable Dropdown Top Separator","This option removes separator on top of dropdown menu", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_disable_dropdown_top_separator_container", "dependence_show_on_yes" => ""));
    $panel4->addChild("disable_dropdown_top_separator",$disable_dropdown_top_separator);

        $disable_dropdown_top_separator_container = new QodeContainer("disable_dropdown_top_separator_container","disable_dropdown_top_separator","yes");
        $panel4->addChild("disable_dropdown_top_separator_container",$disable_dropdown_top_separator_container);

            $group1 = new QodeGroup("Dropdown Top Separator Style","Define style for the top separator");
            $disable_dropdown_top_separator_container->addChild("group1",$group1);

                $row1 = new QodeRow();
                $group1->addChild("row1",$row1);

                $dropdown_top_separator_color = new QodeField("colorsimple","dropdown_top_separator_color","","Color","This is some description");
                $row1->addChild("dropdown_top_separator_color",$dropdown_top_separator_color);

                $dropdown_top_separator_thickness = new QodeField("textsimple","dropdown_top_separator_thickness","","Thickness (px)","This is some description");
                $row1->addChild("dropdown_top_separator_thickness",$dropdown_top_separator_thickness);

    $dropdown_border_around = new QodeField("yesno","dropdown_border_around","no","Border","Enabling this option will display border around dropdown menu");
    $panel4->addChild("dropdown_border_around",$dropdown_border_around);

    $group2 = new QodeGroup("Mobile Menu","Define styles for Mobile Menu (as seen on small screens)");
    $panel4->addChild("group2",$group2);
        $row1 = new QodeRow();
        $group2->addChild("row1",$row1);
            $mobile_separator_color = new QodeField("colorsimple","mobile_separator_color","","Separator Color","This is some description");
            $row1->addChild("mobile_separator_color",$mobile_separator_color);
            $mobile_background_color = new QodeField("colorsimple","mobile_background_color","","Background Color","This is some description");
            $row1->addChild("mobile_background_color",$mobile_background_color);

// Select Search
                
$panel3 = new QodePanel("Select Search","enable_search_panel","vertical_area","yes");
$headerandfooterPage->addChild("panel3",$panel3);

        $enable_search = new QodeField("yesno","enable_search","no","Enable Select Search Bar","This option enables Select Search functionality (search icon will appear next to main navigation)
        ", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_search_container"));
        $panel3->addChild("enable_search",$enable_search);

            $enable_search_container = new QodeContainer("enable_search_container","enable_search","no");
            $panel3->addChild("enable_search_container",$enable_search_container);

                $search_type = new QodeField("select","search_type","from_window_top","Search Type","Choose a search type", array(
                    "from_window_top" => "Slide from Window Top",
                    "fullscreen_search" => "Fullscreen"
                ));
                $enable_search_container->addChild("search_type",$search_type);

                $search_background_color = new QodeField("color","search_background_color","","Select Search Background Color","Choose a background color for Select search bar");
                $enable_search_container->addChild("search_background_color",$search_background_color);

                $group1 = new QodeGroup("Select Search Text Style","Define styles for Search Text input field");
                $enable_search_container->addChild("group1",$group1);

                $row1 = new QodeRow();
                $group1->addChild("row1",$row1);
                $search_text_color = new QodeField("colorsimple","search_text_color","","Select Search Text Color","Choose a text color for Select search bar");
                $row1->addChild("search_text_color",$search_text_color);
                $search_text_font_size = new QodeField("textsimple","search_text_font_size","","Font Size (px)","This is some description");
                $row1->addChild("search_text_font_size",$search_text_font_size);
                $search_text_line_height = new QodeField("textsimple","search_text_line_height","","Line Height (px)","This is some description");
                $row1->addChild("search_text_line_height",$search_text_line_height);
                $search_text_text_transform = new QodeField("selectblanksimple","search_text_text_transform","","Text Transform","This is some description",$options_texttransform);
                $row1->addChild("search_text_text_transform",$search_text_text_transform);
                $row2 = new QodeRow(true);
                $group1->addChild("row2",$row2);
                $search_text_google_fonts = new QodeField("Fontsimple","search_text_google_fonts","-1","Font Family","This is some description");
                $row2->addChild("search_text_google_fonts",$search_text_google_fonts);
                $search_text_font_style = new QodeField("selectblanksimple","search_text_font_style","","Font Style","This is some description",$options_fontstyle);
                $row2->addChild("search_text_font_style",$search_text_font_style);
                $search_text_font_weight = new QodeField("selectblanksimple","search_text_font_weight","","Font Weight","This is some description",$options_fontweight);
                $row2->addChild("search_text_font_weight",$search_text_font_weight);
                $search_text_letter_spacing = new QodeField("textsimple","search_text_letter_spacing","","Letter Spacing (px)","This is some description");
                $row2->addChild("search_text_letter_spacing",$search_text_letter_spacing);

                $group2 = new QodeGroup("Select Search Icon Style","Define styles for Search Icon input field");
                $enable_search_container->addChild("group2",$group2);
                    $row1 = new QodeRow();
                    $group2->addChild("row1",$row1);
                    $search_icon_color = new QodeField("colorsimple","search_icon_color","","Icon Color","Choose a text color for Select search bar");
                    $row1->addChild("search_icon_color",$search_icon_color);
                    $search_icon_hover_color = new QodeField("colorsimple","search_icon_hover_color","","Icon Hover Color","Choose a text color for Select search bar");
                    $row1->addChild("search_icon_hover_color",$search_icon_hover_color);
                    $search_icon_font_size = new QodeField("textsimple","search_icon_font_size","","Font Size (px)","This is some description");
                    $row1->addChild("search_icon_font_size",$search_icon_font_size);
                    $search_icon_line_height = new QodeField("textsimple","search_icon_line_height","","Line Height (px)","This is some description");
                    $row1->addChild("search_icon_line_height",$search_icon_line_height);

                $group3 = new QodeGroup("Select Search Close Icon Style","Define styles for Search Close Icon");
                $enable_search_container->addChild("group3",$group3);
                    $row1 = new QodeRow();
                    $group3->addChild("row1",$row1);
                        $search_colose_icon_color = new QodeField("colorsimple","search_colose_icon_color","","Icon Color","Choose a text color for Select search bar");
                        $row1->addChild("search_colose_icon_color",$search_colose_icon_color);



// Side Area

$panel11 = new QodePanel("Side Area","enable_side_area_panel","vertical_area","yes");
$headerandfooterPage->addChild("panel11",$panel11);

    $enable_side_area = new QodeField("yesno","enable_side_area","yes","Enable Side Area","This option enables a side area to be opened from main menu navigation", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_side_area_container"));
    $panel11->addChild("enable_side_area",$enable_side_area);

    $enable_side_area_container = new QodeContainer("enable_side_area_container","enable_side_area","no");
    $panel11->addChild("enable_side_area_container",$enable_side_area_container);

        $side_area_appear_type = new QodeField("select","side_area_appear_type","side_area_uncovered","Side Area Type","Choose a type of Side Area",array(
            'side_area_uncovered'   => 'Uncovered from Content',
            'side_area_over_content'      => 'Move from Right Over Content',
            'side_area_slide_with_content' => 'Slide from Right With Content',
        ));
        $enable_side_area_container->addChild("side_area_appear_type",$side_area_appear_type);

        $side_area_title = new QodeField("text","side_area_title","","Side Area Title","Enter a title to appear in Side Area");
        $enable_side_area_container->addChild("side_area_title",$side_area_title);

        $side_area_background_color = new QodeField("color","side_area_background_color","","Background Color","Choose a background color for Side Area");
        $enable_side_area_container->addChild("side_area_background_color",$side_area_background_color);

        $group1 = new QodeGroup("Title","Define styles for Side Area titles");
        $enable_side_area_container->addChild("group1",$group1);

            $row1 = new QodeRow();
            $group1->addChild("row1",$row1);
                $side_area_title_color = new QodeField("colorsimple","side_area_title_color","","Text Color","This is some description");
                $row1->addChild("side_area_title_color",$side_area_title_color);
                $side_area_title_fontsize = new QodeField("textsimple","side_area_title_fontsize","","Font Size (px)","This is some description");
                $row1->addChild("side_area_title_fontsize",$side_area_title_fontsize);
                $side_area_title_lineheight = new QodeField("textsimple","side_area_title_lineheight","","Line Height (px)","This is some description");
                $row1->addChild("side_area_title_lineheight",$side_area_title_lineheight);
                $side_area_title_texttransform = new QodeField("selectblanksimple","side_area_title_texttransform","","Text Transform","This is some description",$options_texttransform);
                $row1->addChild("side_area_title_texttransform",$side_area_title_texttransform);
            $row2 = new QodeRow(true);
            $group1->addChild("row2",$row2);
                $side_area_title_google_fonts = new QodeField("Fontsimple","side_area_title_google_fonts","-1","Font Family","This is some description");
                $row2->addChild("side_area_title_google_fonts",$side_area_title_google_fonts);
                $side_area_title_fontstyle = new QodeField("selectblanksimple","side_area_title_fontstyle","","Font Style","This is some description",$options_fontstyle);
                $row2->addChild("side_area_title_fontstyle",$side_area_title_fontstyle);
                $side_area_title_fontweight = new QodeField("selectblanksimple","side_area_title_fontweight","","Font Weight","This is some description",$options_fontweight);
                $row2->addChild("side_area_title_fontweight",$side_area_title_fontweight);
                $side_area_title_letterspacing = new QodeField("textsimple","side_area_title_letterspacing","","Letter Spacing (px)","This is some description");
                $row2->addChild("side_area_title_letterspacing",$side_area_title_letterspacing);

        $side_area_text_color = new QodeField("color","side_area_text_color","","Text Color","Choose a text color for Side Area");
        $enable_side_area_container->addChild("side_area_text_color",$side_area_text_color);

        $group2 = new QodeGroup("Link Style","Define styles for side area widget links");
        $enable_side_area_container->addChild("group2",$group2);
            $row1 = new QodeRow();
            $group2->addChild("row1",$row1);
                $sidearea_link_color = new QodeField("colorsimple","sidearea_link_color","","Text Color","This is some description");
                $row1->addChild("sidearea_link_color",$sidearea_link_color);

                $sidearea_link_font_size = new QodeField("textsimple","sidearea_link_font_size","","Font Size (px)","This is some description");
                $row1->addChild("sidearea_link_font_size",$sidearea_link_font_size);

                $sidearea_link_line_height = new QodeField("textsimple","sidearea_link_line_height","","Line Height (px)","This is some description");
                $row1->addChild("sidearea_link_line_height",$sidearea_link_line_height);

                $sidearea_link_text_transform = new QodeField("selectblanksimple","sidearea_link_text_transform","","Text Transform","This is some description",$options_texttransform);
                $row1->addChild("sidearea_link_text_transform",$sidearea_link_text_transform);

            $row2 = new QodeRow(true);
            $group2->addChild("row2",$row2);
                $sidearea_link_font_family = new QodeField("Fontsimple","sidearea_link_font_family","-1","Font Family","This is some description");
                $row2->addChild("sidearea_link_font_family",$sidearea_link_font_family);

                $sidearea_link_font_style = new QodeField("selectblanksimple","sidearea_link_font_style","","Font Style","This is some description",$options_fontstyle);
                $row2->addChild("sidearea_link_font_style",$sidearea_link_font_style);

                $sidearea_link_font_weight = new QodeField("selectblanksimple","sidearea_link_font_weight","","Font Weight","This is some description",$options_fontweight);
                $row2->addChild("sidearea_link_font_weight",$sidearea_link_font_weight);

                $sidearea_link_letter_spacing = new QodeField("textsimple","sidearea_link_letter_spacing","","Letter Spacing (px)","This is some description");
                $row2->addChild("sidearea_link_letter_spacing",$sidearea_link_letter_spacing);

            $row3 = new QodeRow(true);  
            $group2->addChild("row3",$row3);
                $sidearea_link_hover_color = new QodeField("colorsimple","sidearea_link_hover_color","","Hover Color","This is some description");
                $row3->addChild("sidearea_link_hover_color",$sidearea_link_hover_color);

        $group3 = new QodeGroup("Close Icon Style","Define styles for side area close icon");
        $enable_side_area_container->addChild("group3",$group3);

            $row1 = new QodeRow();
            $group3->addChild("row1",$row1);

                $sidearea_close_icon_type = new QodeField("selectsimple","sidearea_close_icon_type","","Icon Type","This is some description",array(
                    'default'   => 'Default',
                    'fold'      => 'Fold'
                ));
                $row1->addChild("sidearea_close_icon_type",$sidearea_close_icon_type);

                $sidearea_close_icon_color = new QodeField("colorsimple","sidearea_close_icon_color","","Fold Icon Color","This is some description");
                $row1->addChild("sidearea_close_icon_color",$sidearea_close_icon_color);

        $group5 = new QodeGroup("Close Icon Position","Define position for close icon in side area  (enter value with unit, px or %) Default value is 30px for top and right");
        $enable_side_area_container->addChild("group5",$group5);

            $sidearea_close_icon_position_top = new QodeField("textsimple","sidearea_close_icon_position_top","","Top Position","Set top position for Close Icon in Side Area");
            $group5->addChild("sidearea_close_icon_position_top",$sidearea_close_icon_position_top);

            $sidearea_close_icon_position_right = new QodeField("textsimple","sidearea_close_icon_position_right","","Right Position","Set right position for Close Icon in Side Area");
            $group5->addChild("sidearea_close_icon_position_right",$sidearea_close_icon_position_right);

        $sidearea_text_alignment = new QodeField("select","sidearea_text_alignment","","Text Alignment","Choose side area text alignment", array(
            "left" => "Left",
            "center" => "Center",
            "right" => "Right"
        ));
        $enable_side_area_container->addChild("sidearea_text_alignment",$sidearea_text_alignment);

        $group4 = new QodeGroup("Side Area Padding","Define padding for side area (enter value with unit, px or %). Default is 30px.");
        $enable_side_area_container->addChild("group4",$group4);

        $sidearea_padding_top = new QodeField("textsimple","sidearea_padding_top","","Padding Top","Set padding top for Side Area. Default value is 30px");
        $group4->addChild("sidearea_padding_top",$sidearea_padding_top);

        $sidearea_padding_right = new QodeField("textsimple","sidearea_padding_right","","Padding Right","Set padding right for Side Area. Default value is 30px");
        $group4->addChild("sidearea_padding_right",$sidearea_padding_right);

        $sidearea_padding_bottom = new QodeField("textsimple","sidearea_padding_bottom","","Padding Bottom","Set padding bottom for Side Area. Default value is 30px");
        $group4->addChild("sidearea_padding_bottom",$sidearea_padding_bottom);

        $sidearea_padding_left = new QodeField("textsimple","sidearea_padding_left","","Padding Left","Set padding left for Side Area. Default value is 30px");
        $group4->addChild("sidearea_padding_left",$sidearea_padding_left);



// Fullscreen Menu

$panel12 = new QodePanel("Fullscreen Menu","enable_popup_menu_panel","vertical_area","yes");
$headerandfooterPage->addChild("panel12",$panel12);

    $enable_popup_menu = new QodeField("yesno","enable_popup_menu","no","Enable Fullscreen Menu","This option enables a fullscreen menu to be opened from main menu navigation", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_popup_menu_container"));
    $panel12->addChild("enable_popup_menu",$enable_popup_menu);

    $enable_popup_menu_container = new QodeContainer("enable_popup_menu_container","enable_popup_menu","no");
    $panel12->addChild("enable_popup_menu_container",$enable_popup_menu_container);

    $logo_image_popup = new QodeField("image","logo_image_popup","","Logo image for Fullscreen menu","Choose a logo for Fullscreen Menu");
    $enable_popup_menu_container->addChild("logo_image_popup",$logo_image_popup);

    $popup_menu_appearance = new QodeField("select","popup_menu_appearance","fade","Popup Menu Appearance","Choose type of appearance for popup menu", array(
        "fade" => "Fade",
        "slide-from-left" => "Slide from Left",
        "text-from-top" => "Text Appears from Top"
    ));
    $enable_popup_menu_container->addChild("popup_menu_appearance",$popup_menu_appearance);



        $enable_fullscreen_menu_hover_animation = new QodeField("yesno","enable_fullscreen_menu_hover_animation","no","Enable Fullscreen Menu Hover Animation","This option will enable hover animation for fullscreen menu", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_fullscreen_menu_hover_animation_container"));
        $enable_popup_menu_container->addChild("enable_fullscreen_menu_hover_animation",$enable_fullscreen_menu_hover_animation);

        $enable_fullscreen_menu_hover_animation_container = new QodeContainer("enable_fullscreen_menu_hover_animation_container","enable_fullscreen_menu_hover_animation","no");
        $enable_popup_menu_container->addChild("enable_fullscreen_menu_hover_animation_container",$enable_fullscreen_menu_hover_animation_container);

        $fullscreen_menu_hover_type = new QodeField("select","fullscreen_menu_hover_type","","Menu Hover Animation Type","Choose a hover animation type for fullscreen menu", array(
            "underline" => "Underline",
            "line-through" => "Line Through"
        ));
        $enable_fullscreen_menu_hover_animation_container->addChild("fullscreen_menu_hover_type",$fullscreen_menu_hover_type);

        $fullscreen_menu_hover_animation_color = new QodeField("color","fullscreen_menu_hover_animation_color","","Color","Chose a color");
        $enable_fullscreen_menu_hover_animation_container->addChild("fullscreen_menu_hover_animation_color",$fullscreen_menu_hover_animation_color);



    $group1 = new QodeGroup("1st Level Style","Define styles for 1st level in Fullscreen Menu");
    $enable_popup_menu_container->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

            $popup_menu_color = new QodeField("colorsimple","popup_menu_color","","Text Color","This is some description");
            $row1->addChild("popup_menu_color",$popup_menu_color);
            $popup_menu_hover_color = new QodeField("colorsimple","popup_menu_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("popup_menu_hover_color",$popup_menu_hover_color);
            $popup_menu_hover_background_color = new QodeField("colorsimple","popup_menu_hover_background_color","","Background Hover Color","This is some description");
            $row1->addChild("popup_menu_hover_background_color",$popup_menu_hover_background_color);

        $row2 = new QodeRow(true);
        $group1->addChild("row2",$row2);

            $popup_menu_google_fonts = new QodeField("Fontsimple","popup_menu_google_fonts","-1","Font Family","This is some description");
            $row2->addChild("popup_menu_google_fonts",$popup_menu_google_fonts);
            $popup_menu_fontsize = new QodeField("textsimple","popup_menu_fontsize","","Font Size (px)","This is some description");
            $row2->addChild("popup_menu_fontsize",$popup_menu_fontsize);
            $popup_menu_lineheight = new QodeField("textsimple","popup_menu_lineheight","","Line Height (px)","This is some description");
            $row2->addChild("popup_menu_lineheight",$popup_menu_lineheight);

        $row3 = new QodeRow(true);
        $group1->addChild("row3",$row3);

            $popup_menu_fontstyle = new QodeField("selectblanksimple","popup_menu_fontstyle","","Font Style","This is some description",$options_fontstyle);
            $row3->addChild("popup_menu_fontstyle",$popup_menu_fontstyle);
            $popup_menu_fontweight = new QodeField("selectblanksimple","popup_menu_fontweight","","Font Weight","This is some description",$options_fontweight);
            $row3->addChild("popup_menu_fontweight",$popup_menu_fontweight);
            $popup_menu_letterspacing = new QodeField("textsimple","popup_menu_letterspacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("popup_menu_letterspacing",$popup_menu_letterspacing);
            $popup_menu_texttransform = new QodeField("selectblanksimple","popup_menu_texttransform","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("popup_menu_texttransform",$popup_menu_texttransform);

    $group2 = new QodeGroup("2nd Level Style","Define styles for 2nd level in Fullscreen Menu");
    $enable_popup_menu_container->addChild("group2",$group2);

        $row1 = new QodeRow();
        $group2->addChild("row1",$row1);

            $popup_menu_color_2nd = new QodeField("colorsimple","popup_menu_color_2nd","","Text Color","This is some description");
            $row1->addChild("popup_menu_color_2nd",$popup_menu_color_2nd);
            $popup_menu_hover_color_2nd = new QodeField("colorsimple","popup_menu_hover_color_2nd","","Text Hover Color","This is some description");
            $row1->addChild("popup_menu_hover_color_2nd",$popup_menu_hover_color_2nd);
            $popup_menu_hover_background_color_2nd = new QodeField("colorsimple","popup_menu_hover_background_color_2nd","","Background Hover Color","This is some description");
            $row1->addChild("popup_menu_hover_background_color_2nd",$popup_menu_hover_background_color_2nd);

        $row2 = new QodeRow(true);
        $group2->addChild("row2",$row2);

            $popup_menu_google_fonts_2nd = new QodeField("Fontsimple","popup_menu_google_fonts_2nd","-1","Font Family","This is some description");
            $row2->addChild("popup_menu_google_fonts_2nd",$popup_menu_google_fonts_2nd);
            $popup_menu_fontsize_2nd = new QodeField("textsimple","popup_menu_fontsize_2nd","","Font Size (px)","This is some description");
            $row2->addChild("popup_menu_fontsize_2nd",$popup_menu_fontsize_2nd);
            $popup_menu_lineheight_2nd = new QodeField("textsimple","popup_menu_lineheight_2nd","","Line Height (px)","This is some description");
            $row2->addChild("popup_menu_lineheight_2nd",$popup_menu_lineheight_2nd);

        $row3 = new QodeRow(true);
        $group2->addChild("row3",$row3);

            $popup_menu_fontstyle_2nd = new QodeField("selectblanksimple","popup_menu_fontstyle_2nd","","Font Style","This is some description",$options_fontstyle);
            $row3->addChild("popup_menu_fontstyle_2nd",$popup_menu_fontstyle_2nd);
            $popup_menu_fontweight_2nd = new QodeField("selectblanksimple","popup_menu_fontweight_2nd","","Font Weight","This is some description",$options_fontweight);
            $row3->addChild("popup_menu_fontweight_2nd",$popup_menu_fontweight_2nd);
            $popup_menu_letterspacing_2nd = new QodeField("textsimple","popup_menu_letterspacing_2nd","","Letter Spacing (px)","This is some description");
            $row3->addChild("popup_menu_letterspacing_2nd",$popup_menu_letterspacing_2nd);
            $popup_menu_texttransform_2nd = new QodeField("selectblanksimple","popup_menu_texttransform_2nd","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("popup_menu_texttransform_2nd",$popup_menu_texttransform_2nd);

    $group3 = new QodeGroup("3rd Level Style","Define styles for 3rd level in Fullscreen Menu");
    $enable_popup_menu_container->addChild("group3",$group3);

        $row1 = new QodeRow();
        $group3->addChild("row1",$row1);

            $popup_menu_3rd_color = new QodeField("colorsimple","popup_menu_3rd_color","","Text Color","This is some description");
            $row1->addChild("popup_menu_3rd_color",$popup_menu_3rd_color);
            $popup_menu_3rd_hover_color = new QodeField("colorsimple","popup_menu_3rd_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("popup_menu_3rd_hover_color",$popup_menu_3rd_hover_color);
            $popup_menu_3rd_hover_background_color = new QodeField("colorsimple","popup_menu_3rd_hover_background_color","","Background Hover Color","This is some description");
            $row1->addChild("popup_menu_3rd_hover_background_color",$popup_menu_3rd_hover_background_color);

        $row2 = new QodeRow(true);
        $group3->addChild("row2",$row2);

            $popup_menu_3rd_google_fonts = new QodeField("Fontsimple","popup_menu_3rd_google_fonts","-1","Font Family","This is some description");
            $row2->addChild("popup_menu_3rd_google_fonts",$popup_menu_3rd_google_fonts);
            $popup_menu_3rd_fontsize = new QodeField("textsimple","popup_menu_3rd_fontsize","","Font Size (px)","This is some description");
            $row2->addChild("popup_menu_3rd_fontsize",$popup_menu_3rd_fontsize);
            $popup_menu_3rd_lineheight = new QodeField("textsimple","popup_menu_3rd_lineheight","","Line Height (px)","This is some description");
            $row2->addChild("popup_menu_3rd_lineheight",$popup_menu_3rd_lineheight);

        $row3 = new QodeRow(true);
        $group3->addChild("row3",$row3);

            $popup_menu_3rd_fontstyle = new QodeField("selectblanksimple","popup_menu_3rd_fontstyle","","Font Style","This is some description",$options_fontstyle);
            $row3->addChild("popup_menu_3rd_fontstyle",$popup_menu_3rd_fontstyle);
            $popup_menu_3rd_fontweight = new QodeField("selectblanksimple","popup_menu_3rd_fontweight","","Font Weight","This is some description",$options_fontweight);
            $row3->addChild("popup_menu_3rd_fontweight",$popup_menu_3rd_fontweight);
            $popup_menu_3rd_letterspacing = new QodeField("textsimple","popup_menu_3rd_letterspacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("popup_menu_3rd_letterspacing",$popup_menu_3rd_letterspacing);
            $popup_menu_3rd_texttransform = new QodeField("selectblanksimple","popup_menu_3rd_texttransform","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("popup_menu_3rd_texttransform",$popup_menu_3rd_texttransform);        

    $group4 = new QodeGroup("Background","Select a background color for Fullscreen Menu");
    $enable_popup_menu_container->addChild("group4",$group4);

        $row1 = new QodeRow();
        $group4->addChild("row1",$row1);

            $popup_menu_background_color = new QodeField("colorsimple","popup_menu_background_color","","Color","This is some description");
            $row1->addChild("popup_menu_background_color",$popup_menu_background_color);
            $pattern_image_popup = new QodeField("image","pattern_image_popup","","Pattern Background Image","Choose a pattern image for Fullscreen Menu background");
            $row1->addChild("pattern_image_popup",$pattern_image_popup);

// Header Top

$panel2 = new QodePanel("Header Top","header_top_panel","vertical_area","yes");
$headerandfooterPage->addChild("panel2",$panel2);

    $header_top_area = new QodeField("yesno","header_top_area","no","Show Header Top Area","Enabling this option will show Header Top area (this setting applies to Header Left and Header Right widgets)
    ", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_header_top_area_container"));
    $panel2->addChild("header_top_area",$header_top_area);

    $header_top_area_container = new QodeContainer("header_top_area_container","header_top_area","no");
    $panel2->addChild("header_top_area_container",$header_top_area_container);

        $header_top_area_scroll = new QodeField("yesno","header_top_area_scroll","no","Hide on Scroll","Enabling this option will hide Header Top on scroll (if Fixed, Sticky or Sticky Expanded menu is chosen)");
        $header_top_area_container->addChild("header_top_area_scroll",$header_top_area_scroll);

        $header_top_background_color = new QodeField("color","header_top_background_color","","Background Color","Choose a background color for Header Top area");
        $header_top_area_container->addChild("header_top_background_color",$header_top_background_color);

        $top_header_border_color = new QodeField("color","top_header_border_color","","Border Bottom Color","Choose a color for the bottom border");
        $header_top_area_container->addChild("top_header_border_color",$top_header_border_color);

        $top_header_border_weight = new QodeField("text","top_header_border_weight","","Border Width (px)","Enter a width for the bottom border");
        $header_top_area_container->addChild("top_header_border_weight",$top_header_border_weight);

// Left Menu Area

$panel7 = new QodePanel("Left Menu Area","vertical_areas_panel","vertical_area","no");
$headerandfooterPage->addChild("panel7",$panel7);

    $vertical_area_transparency = new QodeField("yesno","vertical_area_transparency","no","Enable transparent left menu area","Enabling this option will make Left Menu background transparent
    ");
    $panel7->addChild("vertical_area_transparency",$vertical_area_transparency);

    $vertical_area_background = new QodeField("color","vertical_area_background","","Left Menu Area Background Color","Choose a color for Left Menu background");
    $panel7->addChild("vertical_area_background",$vertical_area_background);

    $vertical_area_background_image = new QodeField("image","vertical_area_background_image","","Left Menu Area Background Image","Choose an image for Left Menu background");
    $panel7->addChild("vertical_area_background_image",$vertical_area_background_image);

    $vertical_area_dropdown_event = new QodeField("select","vertical_area_dropdown_event","hover_event","Sub-menu Display Behavior","Choose the way sub-menu items show", array(
        "hover_event" => "Hover Event",
        "click_event" => "Click Event"
    ));
    $panel7->addChild("vertical_area_dropdown_event",$vertical_area_dropdown_event);


    $enable_vertical_menu_hover_animation = new QodeField("yesno","enable_vertical_menu_hover_animation","no","Enable 1st Level Menu Hover Animation","This option will enable hover animation for first level in vertical menu", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_enable_vertical_menu_hover_animation_container"));
    $panel7->addChild("enable_vertical_menu_hover_animation",$enable_vertical_menu_hover_animation);

        $enable_vertical_menu_hover_animation_container = new QodeContainer("enable_vertical_menu_hover_animation_container","enable_vertical_menu_hover_animation","no");
        $panel7->addChild("enable_vertical_menu_hover_animation_container",$enable_vertical_menu_hover_animation_container);

            $vertical_menu_hover_type = new QodeField("select","vertical_menu_hover_type","","Menu Hover Animation Type","Choose a hover animation type for firsl level in vertical menu", array(
                "underline" => "Underline",
                "line-through" => "Line Through"
            ));
            $enable_vertical_menu_hover_animation_container->addChild("vertical_menu_hover_type",$vertical_menu_hover_type);

                $vertical_menu_hover_animation_color = new QodeField("color","vertical_menu_hover_animation_color","","Color","Chose a color");
                $enable_vertical_menu_hover_animation_container->addChild("vertical_menu_hover_animation_color",$vertical_menu_hover_animation_color);


    $vertical_area_padding = new QodeField("text","vertical_area_padding","","Padding (top right bottom left)","Set padding for Left Area. Default value is 20px 40px 20px 40px.");
    $panel7->addChild("vertical_area_padding",$vertical_area_padding);

    $vertical_area_text_color = new QodeField("color","vertical_area_text_color","","Left Menu Area Text Color (for Widgets)","Choose a text color for widgets in Left Menu");
    $panel7->addChild("vertical_area_text_color",$vertical_area_text_color);

    $vertical_area_alignment = new QodeField("selectblank","vertical_area_alignment","","Left Menu Area Aligment","Specify alignment for logo, menu and widgets.", array(
        "left" => "Left",
        "center" => "Center",
        "right" => "Right"
    ));
    $panel7->addChild("vertical_area_alignment",$vertical_area_alignment);

    $group1 = new QodeGroup("1st Level Menu Style","Define styles for 1st level in Left Menu");
    $panel7->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

            $vertical_menu_color = new QodeField("colorsimple","vertical_menu_color","","Text Color","This is some description");
            $row1->addChild("vertical_menu_color",$vertical_menu_color);
            $vertical_menu_hovercolor = new QodeField("colorsimple","vertical_menu_hovercolor","","Hover/Active color","This is some description");
            $row1->addChild("vertical_menu_hovercolor",$vertical_menu_hovercolor);

            $vertical_menu_hover_background_color = new QodeField("colorsimple","vertical_menu_hover_background_color","","Hover/Active background color","This is some description");
            $row1->addChild("vertical_menu_hover_background_color",$vertical_menu_hover_background_color);

        $row2 = new QodeRow(true);
        $group1->addChild("row2",$row2);

            $vertical_menu_google_fonts = new QodeField("fontsimple","vertical_menu_google_fonts","-1","Font family","This is some description");
            $row2->addChild("vertical_menu_google_fonts",$vertical_menu_google_fonts);
            $vertical_menu_fontsize = new QodeField("textsimple","vertical_menu_fontsize","","Font size (px)","This is some description");
            $row2->addChild("vertical_menu_fontsize",$vertical_menu_fontsize);
            $vertical_menu_lineheight = new QodeField("textsimple","vertical_menu_lineheight","","Line Height (px)","This is some description");
            $row2->addChild("vertical_menu_lineheight",$vertical_menu_lineheight);
        
        $row3 = new QodeRow(true);
        $group1->addChild("row3",$row3);

            $vertical_menu_fontstyle = new QodeField("selectblanksimple","vertical_menu_fontstyle","","Font Style","This is some description",$options_fontstyle);
            $row3->addChild("vertical_menu_fontstyle",$vertical_menu_fontstyle);
            $vertical_menu_fontweight = new QodeField("selectblanksimple","vertical_menu_fontweight","","Font Weight","This is some description",$options_fontweight);
            $row3->addChild("vertical_menu_fontweight",$vertical_menu_fontweight);
            $vertical_menu_letterspacing = new QodeField("textsimple","vertical_menu_letterspacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("vertical_menu_letterspacing",$vertical_menu_letterspacing);
            $vertical_menu_texttransform = new QodeField("selectblanksimple","vertical_menu_texttransform","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("vertical_menu_texttransform",$vertical_menu_texttransform);

    $group2 = new QodeGroup("2nd Level Menu Style","Define styles for 2nd level in Left Menu");
    $panel7->addChild("group2",$group2);

        $row1 = new QodeRow();
        $group2->addChild("row1",$row1);

            $vertical_dropdown_color = new QodeField("colorsimple","vertical_dropdown_color","","Text Color","This is some description");
            $row1->addChild("vertical_dropdown_color",$vertical_dropdown_color);
            $vertical_dropdown_hovercolor = new QodeField("colorsimple","vertical_dropdown_hovercolor","","Hover/Active Color","This is some description");
            $row1->addChild("vertical_dropdown_hovercolor",$vertical_dropdown_hovercolor);

        $row2 = new QodeRow(true);
        $group2->addChild("row2",$row2);

            $vertical_dropdown_google_fonts = new QodeField("fontsimple","vertical_dropdown_google_fonts","-1","Font Family","This is some description");
            $row2->addChild("vertical_dropdown_google_fonts",$vertical_dropdown_google_fonts);
            $vertical_dropdown_fontsize = new QodeField("textsimple","vertical_dropdown_fontsize","","Font Size (px)","This is some description");
            $row2->addChild("vertical_dropdown_fontsize",$vertical_dropdown_fontsize);
            $vertical_dropdown_lineheight = new QodeField("textsimple","vertical_dropdown_lineheight","","Line Height (px)","This is some description");
            $row2->addChild("vertical_dropdown_lineheight",$vertical_dropdown_lineheight);
        
        $row3 = new QodeRow(true);
        $group2->addChild("row3",$row3);

            $vertical_dropdown_fontstyle = new QodeField("selectblanksimple","vertical_dropdown_fontstyle","","Font Style","This is some description",$options_fontstyle);
            $row3->addChild("vertical_dropdown_fontstyle",$vertical_dropdown_fontstyle);
            $vertical_dropdown_fontweight = new QodeField("selectblanksimple","vertical_dropdown_fontweight","","Font Weight","This is some description",$options_fontweight);
            $row3->addChild("vertical_dropdown_fontweight",$vertical_dropdown_fontweight);
            $vertical_dropdown_letterspacing = new QodeField("textsimple","vertical_dropdown_letterspacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("vertical_dropdown_letterspacing",$vertical_dropdown_letterspacing);
            $vertical_dropdown_texttransform = new QodeField("selectblanksimple","vertical_dropdown_texttransform","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("vertical_dropdown_texttransform",$vertical_dropdown_texttransform);

    $group3 = new QodeGroup("3rd Level Menu Style","Define styles for 3rd level in Left Menu");
    $panel7->addChild("group3",$group3);

        $row1 = new QodeRow();
        $group3->addChild("row1",$row1);

            $vertical_dropdown_color_thirdlvl = new QodeField("colorsimple","vertical_dropdown_color_thirdlvl","","Text Color","This is some description");
            $row1->addChild("vertical_dropdown_color_thirdlvl",$vertical_dropdown_color_thirdlvl);
            $vertical_dropdown_hovercolor_thirdlvl = new QodeField("colorsimple","vertical_dropdown_hovercolor_thirdlvl","","Hover/Active Color","This is some description");
            $row1->addChild("vertical_dropdown_hovercolor_thirdlvl",$vertical_dropdown_hovercolor_thirdlvl);

        $row2 = new QodeRow(true);
        $group3->addChild("row2",$row2);

            $vertical_dropdown_google_fonts_thirdlvl = new QodeField("fontsimple","vertical_dropdown_google_fonts_thirdlvl","-1","Font Family","This is some description");
            $row2->addChild("vertical_dropdown_google_fonts_thirdlvl",$vertical_dropdown_google_fonts_thirdlvl);
            $vertical_dropdown_fontsize_thirdlvl = new QodeField("textsimple","vertical_dropdown_fontsize_thirdlvl","","Font Size (px)","This is some description");
            $row2->addChild("vertical_dropdown_fontsize_thirdlvl",$vertical_dropdown_fontsize_thirdlvl);
            $vertical_dropdown_lineheight_thirdlvl = new QodeField("textsimple","vertical_dropdown_lineheight_thirdlvl","","Line Height (px)","This is some description");
            $row2->addChild("vertical_dropdown_lineheight_thirdlvl",$vertical_dropdown_lineheight_thirdlvl);
        
        $row3 = new QodeRow(true);
        $group3->addChild("row3",$row3);

            $vertical_dropdown_fontstyle_thirdlvl = new QodeField("selectblanksimple","vertical_dropdown_fontstyle_thirdlvl","","Font Style","This is some description",$options_fontstyle);
            $row3->addChild("vertical_dropdown_fontstyle_thirdlvl",$vertical_dropdown_fontstyle_thirdlvl);
            $vertical_dropdown_fontweight_thirdlvl = new QodeField("selectblanksimple","vertical_dropdown_fontweight_thirdlvl","","Font Weight","This is some description",$options_fontweight);
            $row3->addChild("vertical_dropdown_fontweight_thirdlvl",$vertical_dropdown_fontweight_thirdlvl);
            $vertical_dropdown_letterspacing_thirdlvl = new QodeField("textsimple","vertical_dropdown_letterspacing_thirdlvl","","Letter Spacing (px)","This is some description");
            $row3->addChild("vertical_dropdown_letterspacing_thirdlvl",$vertical_dropdown_letterspacing_thirdlvl);
            $vertical_dropdown_texttransform_thirdlvl = new QodeField("selectblanksimple","vertical_dropdown_texttransform_thirdlvl","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("vertical_dropdown_texttransform_thirdlvl",$vertical_dropdown_texttransform_thirdlvl);

    $vertical_mobile_background_color = new QodeField("color","vertical_mobile_background_color","","Mobile Background Color","Define background color for mobile header");
    $panel7->addChild("vertical_mobile_background_color",$vertical_mobile_background_color);        

// Header Button Icons

$panel9 = new QodePanel("Header Button Icons","header_buttons_panel");
$headerandfooterPage->addChild("panel9",$panel9);

    $header_buttons_color = new QodeField("color","header_buttons_color","","Color","Choose a color for Header icons");
    $panel9->addChild("header_buttons_color",$header_buttons_color);

    $header_buttons_hover_color = new QodeField("color","header_buttons_hover_color","","Hover Color","Choose a hover color for Header icons");
    $panel9->addChild("header_buttons_hover_color",$header_buttons_hover_color);

    $header_buttons_font_size = new QodeField("text","header_buttons_font_size","","Icon Size (px)","Choose a size for Header icons", array(), array("col_width" => 3));
    $panel9->addChild("header_buttons_font_size",$header_buttons_font_size);

    $header_buttons_size = new QodeField("select","header_buttons_size","normal","Side Menu / Fullscreen Menu Icon Size","Choose a size for Side Menu / Fullscreen Menu icons", array( "normal" => "Normal",
           "medium" => "Medium",
           "large" => "Large"
          ));
    $panel9->addChild("header_buttons_size",$header_buttons_size);

if(qode_is_wpml_installed()) {
    $wpml_panel = new QodePanel('Language Switcher' , 'language_switcher', 'vertical_area', 'yes');

    $headerandfooterPage->addChild('language_switcher', $wpml_panel);

    $lang_items_padding = new QodeField('text', 'header_bottom_lang_items_padding', '', 'Left / Right Spacing Between Languages in List (px)', 'Set spacing between languages when horizontal language switcher is added to main menu', array(), array("col_width" => 3));
    $wpml_panel->addChild('header_bottom_lang_items_padding', $lang_items_padding);
}