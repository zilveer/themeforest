<?php

$portfolioPage = new QodeAdminPage("9", "Portfolio", "fa fa-camera-retro");
$qodeFramework->qodeOptions->addAdminPage("portfolioPage",$portfolioPage);

//Portfolio List

$panel1 = new QodePanel("Portfolio List", "porfolio_list");
$portfolioPage->addChild("panel1",$panel1);

    $portfolio_qode_like = new QodeField("onoff","portfolio_qode_like","on","Likes",'Enabling this option will turn on "Likes"');
    $panel1->addChild("portfolio_qode_like",$portfolio_qode_like);

	$portfolio_disable_text_box = new QodeField("yesno","portfolio_disable_text_box","yes","Disable Boxed Style Project Description","Disabling boxed styled project description", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_enable_portfolio_list_box_container", "dependence_show_on_yes" => ""));
	$panel1->addChild("portfolio_disable_text_box",$portfolio_disable_text_box);

	$enable_portfolio_list_box_container = new QodeContainer("enable_portfolio_list_box_container","portfolio_disable_text_box","yes");
	$panel1->addChild("enable_portfolio_list_box_container",$enable_portfolio_list_box_container);

		$portfolio_list_box_background_color = new QodeField("color","portfolio_list_box_background_color","","Portfolio Box Background Color","Default color is #ffffff");
		$enable_portfolio_list_box_container->addChild("portfolio_list_box_background_color",$portfolio_list_box_background_color);

    $group1 = new QodeGroup("Image Hover Overlay Color","Define icons styles on project hover. Default hover color is #e27d23.");
    $panel1->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

            $portfolio_shader_color = new QodeField("colorsimple","portfolio_shader_color","","Color","This is some description");
            $row1->addChild("portfolio_shader_color",$portfolio_shader_color);

            $portfolio_shader_transparency = new QodeField("textsimple","portfolio_shader_transparency","","Transparency (0=full - 1=opaque)","This is some description", array(), array("col_width" => 3));
            $row1->addChild("portfolio_shader_transparency",$portfolio_shader_transparency);


// Portfolio List TEXT STYLES

$title_text_styles = new QodeTitle("title_text_styles","Title Text Styles");
$panel1->addChild("title_text_styles",$title_text_styles);

    $group7 = new QodeGroup("Title Style for Standard and Pinterest Lists","Define title styles for standard and pinterest portfolio lists.");
    $panel1->addChild("group7",$group7);

        $row1 = new QodeRow();
        $group7->addChild("row1",$row1);
            $portfolio_title_standard_list_color = new QodeField("colorsimple","portfolio_title_standard_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_standard_list_color",$portfolio_title_standard_list_color);
            $portfolio_title_standard_list_hover_color = new QodeField("colorsimple","portfolio_title_standard_list_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("portfolio_title_standard_list_hover_color",$portfolio_title_standard_list_hover_color);
            $portfolio_title_standard_list_font_size = new QodeField("textsimple","portfolio_title_standard_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_title_standard_list_font_size",$portfolio_title_standard_list_font_size);
            $portfolio_title_standard_list_line_height = new QodeField("textsimple","portfolio_title_standard_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_title_standard_list_line_height",$portfolio_title_standard_list_line_height);

        $row2 = new QodeRow(true);
        $group7->addChild("row2",$row2);
            $portfolio_title_standard_list_text_transform = new QodeField("selectblanksimple","portfolio_title_standard_list_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row2->addChild("portfolio_title_standard_list_text_transform",$portfolio_title_standard_list_text_transform);
            $portfolio_title_standard_list_font_family = new QodeField("fontsimple","portfolio_title_standard_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_title_standard_list_font_family",$portfolio_title_standard_list_font_family);
            $portfolio_title_standard_list_font_style = new QodeField("selectblanksimple","portfolio_title_standard_list_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_title_standard_list_font_style",$portfolio_title_standard_list_font_style);
            $portfolio_title_standard_list_font_weight = new QodeField("selectblanksimple","portfolio_title_standard_list_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_title_standard_list_font_weight",$portfolio_title_standard_list_font_weight);

        $row3 = new QodeRow(true);
        $group7->addChild("row3",$row3);
            $portfolio_title_standard_list_letter_spacing = new QodeField("textsimple","portfolio_title_standard_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_title_standard_list_letter_spacing",$portfolio_title_standard_list_letter_spacing);

    $group9 = new QodeGroup("Title Style for Text on Hover Image and Text before Hover Lists","Define title styles for text on hover image and text before hover portfolio lists.");
    $panel1->addChild("group9",$group9);

        $row1 = new QodeRow();
        $group9->addChild("row1",$row1);
            $portfolio_title_hover_box_list_color = new QodeField("colorsimple","portfolio_title_hover_box_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_color",$portfolio_title_hover_box_list_color);
            $portfolio_title_hover_box_list_hover_color = new QodeField("colorsimple","portfolio_title_hover_box_list_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_hover_color",$portfolio_title_hover_box_list_hover_color);
            $portfolio_title_hover_box_list_font_size = new QodeField("textsimple","portfolio_title_hover_box_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_font_size",$portfolio_title_hover_box_list_font_size);
            $portfolio_title_hover_box_list_line_height = new QodeField("textsimple","portfolio_title_hover_box_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_title_hover_box_list_line_height",$portfolio_title_hover_box_list_line_height);

        $row2 = new QodeRow(true);
        $group9->addChild("row2",$row2);
            $portfolio_title_hover_box_list_font_family = new QodeField("fontsimple","portfolio_title_hover_box_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_title_hover_box_list_font_family",$portfolio_title_hover_box_list_font_family);
            $portfolio_title_hover_box_list_text_transform = new QodeField("selectblanksimple","portfolio_title_hover_box_list_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row2->addChild("portfolio_title_hover_box_list_text_transform",$portfolio_title_hover_box_list_text_transform);
            $portfolio_title_hover_box_list_font_style = new QodeField("selectblanksimple","portfolio_title_hover_box_list_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_title_hover_box_list_font_style",$portfolio_title_hover_box_list_font_style);
            $portfolio_title_hover_box_list_font_weight = new QodeField("selectblanksimple","portfolio_title_hover_box_list_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_title_hover_box_list_font_weight",$portfolio_title_hover_box_list_font_weight);

        $row3 = new QodeRow(true);
        $group9->addChild("row3",$row3);
            $portfolio_title_hover_box_list_letter_spacing = new QodeField("textsimple","portfolio_title_hover_box_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_title_hover_box_list_letter_spacing",$portfolio_title_hover_box_list_letter_spacing);

    $group11 = new QodeGroup("Title Style for Portfolio Slider and Masonry Lists","Define title styles for slider and masonry portfolio lists.");
    $panel1->addChild("group11",$group11);

        $row1 = new QodeRow();
        $group11->addChild("row1",$row1);
            $portfolio_title_list_color = new QodeField("colorsimple","portfolio_title_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_list_color",$portfolio_title_list_color);
            $portfolio_title_list_hover_color = new QodeField("colorsimple","portfolio_title_list_hover_color","","Text Hover Color","This is some description");
            $row1->addChild("portfolio_title_list_hover_color",$portfolio_title_list_hover_color);
            $portfolio_title_list_font_size = new QodeField("textsimple","portfolio_title_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_title_list_font_size",$portfolio_title_list_font_size);
            $portfolio_title_list_line_height = new QodeField("textsimple","portfolio_title_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_title_list_line_height",$portfolio_title_list_line_height);

        $row2 = new QodeRow(true);
        $group11->addChild("row2",$row2);
            $portfolio_title_list_text_transform = new QodeField("selectblanksimple","portfolio_title_list_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row2->addChild("portfolio_title_list_text_transform",$portfolio_title_list_text_transform);
            $portfolio_title_list_font_family = new QodeField("fontsimple","portfolio_title_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_title_list_font_family",$portfolio_title_list_font_family);
            $portfolio_title_list_font_style = new QodeField("selectblanksimple","portfolio_title_list_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_title_list_font_style",$portfolio_title_list_font_style);
            $portfolio_title_list_font_weight = new QodeField("selectblanksimple","portfolio_title_list_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_title_list_font_weight",$portfolio_title_list_font_weight);

            $row3 = new QodeRow(true);
            $group11->addChild("row3",$row3);
            $portfolio_title_list_letter_spacing = new QodeField("textsimple","portfolio_title_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_title_list_letter_spacing",$portfolio_title_list_letter_spacing);

$category_text_styles = new QodeTitle("category_text_styles","Category Text Styles");
$panel1->addChild("category_text_styles",$category_text_styles);

    $group8 = new QodeGroup("Category Style for Standard and Pinterest Lists","Define category styles for standard and pinterest portfolio lists.");
    $panel1->addChild("group8",$group8);

         $row1 = new QodeRow();
         $group8->addChild("row1",$row1);
            $portfolio_category_standard_list_color = new QodeField("colorsimple","portfolio_category_standard_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_category_standard_list_color",$portfolio_category_standard_list_color);
            $portfolio_category_standard_list_font_size = new QodeField("textsimple","portfolio_category_standard_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_category_standard_list_font_size",$portfolio_category_standard_list_font_size);
            $portfolio_category_standard_list_line_height = new QodeField("textsimple","portfolio_category_standard_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_category_standard_list_line_height",$portfolio_category_standard_list_line_height);
            $portfolio_category_standard_list_text_transform = new QodeField("selectblanksimple","portfolio_category_standard_list_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row1->addChild("portfolio_category_standard_list_text_transform",$portfolio_category_standard_list_text_transform);

        $row2 = new QodeRow(true);
        $group8->addChild("row2",$row2);
            $portfolio_category_standard_list_font_family = new QodeField("fontsimple","portfolio_category_standard_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_category_standard_list_font_family",$portfolio_category_standard_list_font_family);
            $portfolio_category_standard_list_font_style = new QodeField("selectblanksimple","portfolio_category_standard_list_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_category_standard_list_font_style",$portfolio_category_standard_list_font_style);
            $portfolio_category_standard_list_font_weight = new QodeField("selectblanksimple","portfolio_category_standard_list_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_category_standard_list_font_weight",$portfolio_category_standard_list_font_weight);
            $portfolio_category_standard_list_letter_spacing = new QodeField("textsimple","portfolio_category_standard_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row2->addChild("portfolio_category_standard_list_letter_spacing",$portfolio_category_standard_list_letter_spacing);

    $group10 = new QodeGroup("Category Style for Text on Hover Image and Text before Hover Lists","Define category styles for standard and pinterest portfolio lists.");
    $panel1->addChild("group10",$group10);

        $row1 = new QodeRow();
        $group10->addChild("row1",$row1);
            $portfolio_category_hover_box_list_color = new QodeField("colorsimple","portfolio_category_hover_box_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_category_hover_box_list_color",$portfolio_category_hover_box_list_color);
            $portfolio_category_hover_box_list_font_size = new QodeField("textsimple","portfolio_category_hover_box_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_category_hover_box_list_font_size",$portfolio_category_hover_box_list_font_size);
            $portfolio_category_hover_box_list_line_height = new QodeField("textsimple","portfolio_category_hover_box_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_category_hover_box_list_line_height",$portfolio_category_hover_box_list_line_height);
            $portfolio_category_hover_box_list_text_transform = new QodeField("selectblanksimple","portfolio_category_hover_box_list_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row1->addChild("portfolio_category_hover_box_list_text_transform",$portfolio_category_hover_box_list_text_transform);

        $row2 = new QodeRow(true);
        $group10->addChild("row2",$row2);
            $portfolio_category_hover_box_list_font_family = new QodeField("fontsimple","portfolio_category_hover_box_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_category_hover_box_list_font_family",$portfolio_category_hover_box_list_font_family);
            $portfolio_category_hover_box_list_font_style = new QodeField("selectblanksimple","portfolio_category_hover_box_list_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_category_hover_box_list_font_style",$portfolio_category_hover_box_list_font_style);
            $portfolio_category_hover_box_list_font_weight = new QodeField("selectblanksimple","portfolio_category_hover_box_list_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_category_hover_box_list_font_weight",$portfolio_category_hover_box_list_font_weight);
            $portfolio_category_hover_box_list_letter_spacing = new QodeField("textsimple","portfolio_category_hover_box_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row2->addChild("portfolio_category_hover_box_list_letter_spacing",$portfolio_category_hover_box_list_letter_spacing);



    $group12 = new QodeGroup("Category Style for Portfolio Slider and Masonry Lists","Define category styles for slider and masonry portfolio lists.");
    $panel1->addChild("group12",$group12);

        $row1 = new QodeRow();
        $group12->addChild("row1",$row1);
            $portfolio_category_list_color = new QodeField("colorsimple","portfolio_category_list_color","","Text Color","This is some description");
            $row1->addChild("portfolio_category_list_color",$portfolio_category_list_color);
            $portfolio_category_list_font_size = new QodeField("textsimple","portfolio_category_list_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_category_list_font_size",$portfolio_category_list_font_size);
            $portfolio_category_list_line_height = new QodeField("textsimple","portfolio_category_list_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_category_list_line_height",$portfolio_category_list_line_height);
            $portfolio_category_list_text_transform = new QodeField("selectblanksimple","portfolio_category_list_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row1->addChild("portfolio_category_list_text_transform",$portfolio_category_list_text_transform);

        $row2 = new QodeRow(true);
        $group12->addChild("row2",$row2);
            $portfolio_category_list_font_family = new QodeField("fontsimple","portfolio_category_list_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_category_list_font_family",$portfolio_category_list_font_family);
            $portfolio_category_list_font_style = new QodeField("selectblanksimple","portfolio_category_list_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_category_list_font_style",$portfolio_category_list_font_style);
            $portfolio_category_list_font_weight = new QodeField("selectblanksimple","portfolio_category_list_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_category_list_font_weight",$portfolio_category_list_font_weight);
            $portfolio_category_list_letter_spacing = new QodeField("textsimple","portfolio_category_list_letter_spacing","","Letter Spacing (px)","This is some description");
            $row2->addChild("portfolio_category_list_letter_spacing",$portfolio_category_list_letter_spacing);


// Portfolio Filter
    $portfolio_filter = new QodeTitle("portfolio_filter","Category Filter");
    $panel1->addChild("portfolio_filter",$portfolio_filter);

    $portfolio_list_filter_background_color = new QodeField("color","portfolio_list_filter_background_color","","Background Color","Choose color for background of filter area",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_list_filter_background_color",$portfolio_list_filter_background_color);

    $portfolio_list_filter_height = new QodeField("text","portfolio_list_filter_height","","Height (px)","Enter height for filter area",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_list_filter_height",$portfolio_list_filter_height);

    $portfolio_filter_margin_bottom = new QodeField("text","portfolio_filter_margin_bottom","","Bottom Margin (px)","Enter bottom margin for filter area. Default value is 36",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_filter_margin_bottom",$portfolio_filter_margin_bottom);

        $group2 = new QodeGroup("Title","Define text styles for filter title");
        $panel1->addChild("group2",$group2);

            $row1 = new QodeRow();
            $group2->addChild("row1",$row1);
                $portfolio_filter_title_color = new QodeField("colorsimple","portfolio_filter_title_color","","Text Color","This is some description");
                $row1->addChild("portfolio_filter_title_color",$portfolio_filter_title_color);
                $portfolio_filter_title_font_size = new QodeField("textsimple","portfolio_filter_title_font_size","","Font Size (px)","This is some description");
                $row1->addChild("portfolio_filter_title_font_size",$portfolio_filter_title_font_size);
                $portfolio_filter_title_line_height = new QodeField("textsimple","portfolio_filter_title_line_height","","Line Height (px)","This is some description");
                $row1->addChild("portfolio_filter_title_line_height",$portfolio_filter_title_line_height);
                $portfolio_filter_title_text_transform = new QodeField("selectblanksimple","portfolio_filter_title_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
                $row1->addChild("portfolio_filter_title_text_transform",$portfolio_filter_title_text_transform);

                $row2 = new QodeRow(true);
                $group2->addChild("row2",$row2);
                $portfolio_filter_title_font_family = new QodeField("fontsimple","portfolio_filter_title_font_family","-1","Font Family","This is some description");
                $row2->addChild("portfolio_filter_title_font_family",$portfolio_filter_title_font_family);
                $portfolio_filter_title_font_style = new QodeField("selectblanksimple","portfolio_filter_title_font_style","","Font Style","This is some description",$qode_options_fontstyle);
                $row2->addChild("portfolio_filter_title_font_style",$portfolio_filter_title_font_style);
                $portfolio_filter_title_font_weight = new QodeField("selectblanksimple","portfolio_filter_title_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
                $row2->addChild("portfolio_filter_title_font_weight",$portfolio_filter_title_font_weight);
                $portfolio_filter_title_letter_spacing = new QodeField("textsimple","portfolio_filter_title_letter_spacing","","Letter Spacing (px)","This is some description");
                $row2->addChild("portfolio_filter_title_letter_spacing",$portfolio_filter_title_letter_spacing);

        $group3 = new QodeGroup("Categories","Define text styles for filter categories");
        $panel1->addChild("group3",$group3);

            $row1 = new QodeRow();
            $group3->addChild("row1",$row1);
            $portfolio_filter_color = new QodeField("colorsimple","portfolio_filter_color","","Text Color","This is some description");
            $row1->addChild("portfolio_filter_color",$portfolio_filter_color);
            $portfolio_filter_hovercolor = new QodeField("colorsimple","portfolio_filter_hovercolor","","Hover/Active Color","This is some description");
            $row1->addChild("portfolio_filter_hovercolor",$portfolio_filter_hovercolor);
            $portfolio_filter_font_size = new QodeField("textsimple","portfolio_filter_font_size","","Font Size (px)","This is some description");
            $row1->addChild("portfolio_filter_font_size",$portfolio_filter_font_size);
            $portfolio_filter_line_height = new QodeField("textsimple","portfolio_filter_line_height","","Line Height (px)","This is some description");
            $row1->addChild("portfolio_filter_line_height",$portfolio_filter_line_height);

            $row2 = new QodeRow(true);
            $group3->addChild("row2",$row2);
            $portfolio_filter_font_family = new QodeField("fontsimple","portfolio_filter_font_family","-1","Font Family","This is some description");
            $row2->addChild("portfolio_filter_font_family",$portfolio_filter_font_family);
            $portfolio_filter_font_style = new QodeField("selectblanksimple","portfolio_filter_font_style","","Font Style","This is some description",$qode_options_fontstyle);
            $row2->addChild("portfolio_filter_font_style",$portfolio_filter_font_style);
            $portfolio_filter_font_weight = new QodeField("selectblanksimple","portfolio_filter_font_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row2->addChild("portfolio_filter_font_weight",$portfolio_filter_font_weight);
            $portfolio_filter_text_transform = new QodeField("selectblanksimple","portfolio_filter_text_transform","","Text Transform","This is some description",$qode_options_texttransform);
            $row2->addChild("portfolio_filter_text_transform",$portfolio_filter_text_transform);

            $row3 = new QodeRow(true);
            $group3->addChild("row3",$row3);
            $portfolio_filter_letter_spacing = new QodeField("textsimple","portfolio_filter_letter_spacing","","Letter Spacing (px)","This is some description");
            $row3->addChild("portfolio_filter_letter_spacing",$portfolio_filter_letter_spacing);

    $portfolio_filter_disable_separator = new QodeField("yesno","portfolio_filter_disable_separator","yes","Disable Separator Between Categories","Disabling this option will remove separator between filter categories.",array(),array(
        "dependence" => true,
        "dependence_hide_on_yes" => "#qodef_portfolio_filter_separator_container",
        "dependence_show_on_yes" => "",
        ));
    $panel1->addChild("portfolio_filter_disable_separator",$portfolio_filter_disable_separator);

    $portfolio_filter_separator_container = new QodeContainer("portfolio_filter_separator_container","portfolio_filter_disable_separator","yes");
    $panel1->addChild("portfolio_filter_separator_container",$portfolio_filter_separator_container);

        $portfolio_filter_separator_color = new QodeField("color","portfolio_filter_separator_color","","Separator Between Categories Color","Choose a color for separator between categories in filter");
        $portfolio_filter_separator_container->addChild("portfolio_filter_separator_color",$portfolio_filter_separator_color);


//ICONS STYLE
    $icons_style = new QodeTitle("icons_style", "Icons");
    $panel1->addChild("icons_style", $icons_style);

    $portfolio_list_icons_pack = new QodeField("select","portfolio_list_icons_pack","font-awesome","Font Family",'Choose font family for hover icons on portfolio', array(
        "font-awesome" => "Font Awesome",
        "font-elegant" => "Font Elegant"
    ));
    $panel1->addChild("portfolio_list_icons_pack",$portfolio_list_icons_pack);

    $portfolio_list_icons_size = new QodeField("text","portfolio_list_icons_size","","Size (px)","Enter size for icons in portfolio list. Default value is 16",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_list_icons_size",$portfolio_list_icons_size);

	$group4 = new QodeGroup("Color","Choose color of the icons on project hover");
	$panel1->addChild("group4",$group4);

		$row1 = new QodeRow();
		$group4->addChild("row1",$row1);
			$portfolio_list_icons_color = new QodeField("colorsimple","portfolio_list_icons_color","","Color","This is some description");
			$row1->addChild("portfolio_list_icons_color",$portfolio_list_icons_color);
			$portfolio_list_icons_hover_color = new QodeField("colorsimple","portfolio_list_icons_hover_color","","Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_hover_color",$portfolio_list_icons_hover_color);

    $group5 = new QodeGroup("Background Color","Define icons background color styles on project hover");
    $panel1->addChild("group5",$group5);

        $row1 = new QodeRow();
        $group5->addChild("row1",$row1);
			$portfolio_list_icons_background_color = new QodeField("colorsimple","portfolio_list_icons_background_color","","Background Color","This is some description");
			$row1->addChild("portfolio_list_icons_background_color",$portfolio_list_icons_background_color);
			$portfolio_list_icons_background_hover_color = new QodeField("colorsimple","portfolio_list_icons_background_hover_color","","Background Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_background_hover_color",$portfolio_list_icons_background_hover_color);

    $group6 = new QodeGroup("Border","Define icons border styles on project hover");
    $panel1->addChild("group6",$group6);

		$row1 = new QodeRow(true);
		$group6->addChild("row1",$row1);

			$portfolio_list_icons_border_color = new QodeField("colorsimple","portfolio_list_icons_border_color","","Border Color","This is some description");
			$row1->addChild("portfolio_list_icons_border_color",$portfolio_list_icons_border_color);
			$portfolio_list_icons_border_hover_color = new QodeField("colorsimple","portfolio_list_icons_border_hover_color","","Border Hover Color","This is some description");
			$row1->addChild("portfolio_list_icons_border_hover_color",$portfolio_list_icons_border_hover_color);
			$portfolio_list_icons_border_width = new QodeField("textsimple","portfolio_list_icons_border_width","","Border Width (px)","This is some description");
			$row1->addChild("portfolio_list_icons_border_width",$portfolio_list_icons_border_width);
            $portfolio_list_icons_border_radius = new QodeField("textsimple","portfolio_list_icons_border_radius","","Border Radius (px)","This is some description");
            $row1->addChild("portfolio_list_icons_border_radius",$portfolio_list_icons_border_radius);

    $portfolio_masonry_style = new QodeTitle("portfolio_masonry_style", "Masonry");
    $panel1->addChild("portfolio_masonry_style", $portfolio_masonry_style);

    $portfolio_masonry_with_padding_width = new QodeField("text","portfolio_masonry_with_padding_width","","Space Width (px)","Enter space width for Masonry if space is enabled. Default value is 10",array(), array("col_width" => 3));
    $panel1->addChild("portfolio_masonry_with_padding_width",$portfolio_masonry_with_padding_width);

    $thin_plus_only_style = new QodeTitle("thin_plus_only_style", "Thin Plus Only");
    $panel1->addChild("thin_plus_only_style", $thin_plus_only_style);

    $group13 = new QodeGroup("Cursor","Define styles for Cursor on Thin Plus Only hover type");
    $panel1->addChild("group13",$group13);

        $row1 = new QodeRow();
        $group13->addChild("row1",$row1);
            $thin_plus_only_style_color = new QodeField("colorsimple","thin_plus_only_style_color","","Color","This is some description");
            $row1->addChild("thin_plus_only_style_color",$thin_plus_only_style_color);
            $thin_plus_only_style_size = new QodeField("textsimple","thin_plus_only_style_size","","Font Size (px)","This is some description");
            $row1->addChild("thin_plus_only_style_size",$thin_plus_only_style_size);
            $thin_plus_only_style_weight = new QodeField("selectblanksimple","thin_plus_only_style_weight","","Font Weight","This is some description",$qode_options_fontweight);
            $row1->addChild("thin_plus_only_style_weight",$thin_plus_only_style_weight);

    $group14 = new QodeGroup("Button Shadow","Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.");
    $panel1->addChild("group14",$group14);

        $row1 = new QodeRow();
        $group14->addChild("row1",$row1);

            $portfolio_with_btn_shadow_color = new QodeField("colorsimple","portfolio_with_btn_shadow_color","","Color","Choose color for box shadow");
            $row1->addChild("portfolio_with_btn_shadow_color",$portfolio_with_btn_shadow_color);

        $row2 = new QodeRow();
        $group14->addChild("row2",$row2);

            $portfolio_with_btn_h_shadow = new QodeField("textsimple","portfolio_with_btn_h_shadow","","Horizontal shadow (px)","");
            $row2->addChild("portfolio_with_btn_h_shadow",$portfolio_with_btn_h_shadow);

            $portfolio_with_btn_v_shadow = new QodeField("textsimple","portfolio_with_btn_v_shadow","","Vertical shadow (px)","");
            $row2->addChild("portfolio_with_btn_v_shadow",$portfolio_with_btn_v_shadow);

            $portfolio_with_btn_blur_shadow = new QodeField("textsimple","portfolio_with_btn_blur_shadow","","Blur (px)","");
            $row2->addChild("portfolio_with_btn_blur_shadow",$portfolio_with_btn_blur_shadow);

            $portfolio_with_btn_spread_shadow = new QodeField("textsimple","portfolio_with_btn_spread_shadow","","Spread (px)","");
            $row2->addChild("portfolio_with_btn_spread_shadow",$portfolio_with_btn_spread_shadow);

    $animated_border_hover_style = new QodeTitle("animated_border_hover_style", "Animated Border");
    $panel1->addChild("animated_border_hover_style", $animated_border_hover_style);

    $group23 = new QodeGroup("Border Hover","Define styles for border on Animated Border hover type");
    $panel1->addChild("group23",$group23);

        $row1 = new QodeRow();
        $group23->addChild("row1",$row1);
            $animated_border_hover_color = new QodeField("colorsimple","animated_border_hover_color","","Color","This is some description");
            $row1->addChild("animated_border_hover_color",$animated_border_hover_color);
            $animated_border_hover_width = new QodeField("textsimple","animated_border_hover_width","","Width (px)","This is some description");
            $row1->addChild("animated_border_hover_width",$animated_border_hover_width);



//Portfolio Single Project

$panel2 = new QodePanel("Portfolio Single", "porfolio_single_project");
$portfolioPage->addChild("panel2",$panel2);

	$portfolio_style = new QodeField("select","portfolio_style","small-images","Portfolio Type",'Choose a default type for Single Project pages', array(
		"small-images" => "Portfolio small images",
		"small-slider" => "Portfolio small slider",
		"big-images" => "Portfolio big images",
		"big-slider" => "Portfolio big slider",
		"custom" => "Portfolio custom",
		"full-width-custom" => "Portfolio full width custom",
		"gallery" => "Portfolio gallery"
      ));
	$panel2->addChild("portfolio_style",$portfolio_style);

    $group3 = new QodeGroup("Portfolio Overlay Color","Define color and opacity for overlay color");
    $panel2->addChild("group3",$group3);

        $row1 = new QodeRow();
        $group3->addChild("row1",$row1);

            $portfolio_gallery_overlay_color = new QodeField("colorsimple","portfolio_gallery_overlay_color","","Color","This is some description");
            $row1->addChild("portfolio_gallery_overlay_color",$portfolio_gallery_overlay_color);

            $portfolio_gallery_overlay_transparency = new QodeField("textsimple","portfolio_gallery_overlay_transparency","","Transparency (px)","This is some description");
            $row1->addChild("portfolio_gallery_overlay_transparency",$portfolio_gallery_overlay_transparency);


    $portfolio_gallery_image_hover_style = new QodeField("select","portfolio_gallery_image_hover_style","magnifier","Portfolio Image Hover",'Choose a default hover type for Single Project pages', array(
        "disable" => "None",
        "magnifier" => "Magnifier",
        "icon" => "Icon",
        "text" => "Image Title"
    ),
        array("dependence" => true,
            "hide" => array(
                "disable"=>"#qodef_portfolio_gallery_image_hover_separator_container,#qodef_portfolio_gallery_image_hover_icon_container",
                "magnifier"=>"#qodef_portfolio_gallery_image_hover_separator_container,#qodef_portfolio_gallery_image_hover_icon_container",
                "icon"=>"#qodef_portfolio_gallery_image_hover_separator_container",
                "text"=>"#qodef_portfolio_gallery_image_hover_icon_container"),
            "show" => array(
                "disable"=>"",
                "magnifier"=>"",
                "icon"=>"#qodef_portfolio_gallery_image_hover_icon_container",
                "text"=>"#qodef_portfolio_gallery_image_hover_separator_container")
        ));
    $panel2->addChild("portfolio_gallery_image_hover_style",$portfolio_gallery_image_hover_style);

        $portfolio_gallery_image_hover_separator_container = new QodeContainer("portfolio_gallery_image_hover_separator_container","portfolio_gallery_image_hover_style","magnifier",array("disable","magnifier","icon"));
        $panel2->addChild("portfolio_gallery_image_hover_separator_container",$portfolio_gallery_image_hover_separator_container);

            $portfolio_gallery_image_hover_separator = new QodeField("select","portfolio_gallery_image_hover_separator","","Separator below image title","This option will place separator below text", array(
                "yes" => "Yes",
                "no" => "No"
            ), array("col_width" => 3));
            $portfolio_gallery_image_hover_separator_container->addChild("portfolio_gallery_image_hover_separator",$portfolio_gallery_image_hover_separator);

            $portfolio_gallery_overlay_text_color = new QodeField("color","portfolio_gallery_overlay_text_color","","Text Color","Choose a color for overlay text in Single Project pages");
            $portfolio_gallery_image_hover_separator_container->addChild("portfolio_gallery_overlay_text_color",$portfolio_gallery_overlay_text_color);

        $portfolio_gallery_image_hover_icon_container = new QodeContainer("portfolio_gallery_image_hover_icon_container","portfolio_gallery_image_hover_style","magnifier",array("disable","magnifier","text"));
        $panel2->addChild("portfolio_gallery_image_hover_icon_container",$portfolio_gallery_image_hover_icon_container);

            $group4 = new QodeGroup("Portfolio Image Hover Icon","Define style for Portfolio Image Hover Icon");
            $portfolio_gallery_image_hover_icon_container->addChild("group4",$group4);

            $row1 = new QodeRow();
            $group4->addChild("row1",$row1);

                $portfolio_gallery_icon_pack = new QodeField("selectsimple","portfolio_gallery_icon_pack","font-awesome","Font Family",'This is some description', array(
                    "font-awesome" => "Font Awesome",
                    "font-elegant" => "Font Elegant"
                ));
                $group4->addChild("portfolio_gallery_icon_pack",$portfolio_gallery_icon_pack);

                    $portfolio_gallery_icon_size = new QodeField("textsimple","portfolio_gallery_icon_size","","Size","This is some description");
                $group4->addChild("portfolio_gallery_icon_size",$portfolio_gallery_icon_size);

                $portfolio_gallery_icon_color = new QodeField("colorsimple","portfolio_gallery_icon_color","","Color","This is some description");
                $group4->addChild("portfolio_gallery_icon_color",$portfolio_gallery_icon_color);

    $group1 = new QodeGroup("Title Style","Define title styles on project.");
    $panel2->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

            $portfolio_title_tag = new QodeField("selectsimple","portfolio_title_tag","h3","Tag element",'This is some description', array(
                "h2" => "h2",
                "h3" => "h3",
                "h4" => "h4",
                "h5" => "h5"
            ));
            $row1->addChild("portfolio_title_tag",$portfolio_title_tag);

            $portfolio_title_margin_bottom = new QodeField("textsimple","portfolio_title_margin_bottom","","Margin Bottom (px)","This is some description");
            $row1->addChild("portfolio_title_margin_bottom",$portfolio_title_margin_bottom);

            $portfolio_title_color = new QodeField("colorsimple","portfolio_title_color","","Text Color","This is some description");
            $row1->addChild("portfolio_title_color",$portfolio_title_color);

    $group2 = new QodeGroup("Additional Portfolio Titles","Define additional portfolio titles styles on project.");
    $panel2->addChild("group2",$group2);

        $row1 = new QodeRow();
        $group2->addChild("row1",$row1);

            $portfolio_info_tag = new QodeField("selectsimple","portfolio_info_tag","h6","Tag element",'This is some description', array(
                "h4" => "h4",
                "h5" => "h5",
                "h6" => "h6"
            ));
            $row1->addChild("portfolio_info_tag",$portfolio_info_tag);

            $portfolio_info_margin_bottom = new QodeField("textsimple","portfolio_info_margin_bottom","","Margin Bottom (px)","This is some description");
            $row1->addChild("portfolio_info_margin_bottom",$portfolio_info_margin_bottom);

            $portfolio_info_color = new QodeField("colorsimple","portfolio_info_color","","Text Color","This is some description");
            $row1->addChild("portfolio_info_color",$portfolio_info_color);

	$lightbox_single_project = new QodeField("yesno","lightbox_single_project","yes","Lightbox for Images","Enabling this option will turn on lightbox functionality for projects with images.");
	$panel2->addChild("lightbox_single_project",$lightbox_single_project);

	$lightbox_video_single_project = new QodeField("yesno","lightbox_video_single_project","no","Lightbox for Videos","Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects.");
	$panel2->addChild("lightbox_video_single_project",$lightbox_video_single_project);

	$portfolio_hide_categories = new QodeField("yesno","portfolio_hide_categories","no","Hide Categories","Enabling this option will disable category meta description on Single Projects.");
	$panel2->addChild("portfolio_hide_categories",$portfolio_hide_categories);

	$portfolio_hide_date = new QodeField("yesno","portfolio_hide_date","no","Hide Date","Enabling this option will disable date meta on Single Projects.");
	$panel2->addChild("portfolio_hide_date",$portfolio_hide_date);

	$portfolio_hide_comments = new QodeField("yesno","portfolio_hide_comments","yes","Hide Comments","Enabling this option will turn off comments functionality.");
	$panel2->addChild("portfolio_hide_comments",$portfolio_hide_comments);

	$portfolio_text_follow = new QodeField("portfoliofollow","portfolio_text_follow","portfolio_single_follow","Sticky Side Text ","Enabling this option will make side text sticky on Single Project pages");
	$panel2->addChild("portfolio_text_follow",$portfolio_text_follow);

	$portfolio_hide_pagination = new QodeField("yesno","portfolio_hide_pagination","no","Hide Pagination","Enabling this option will turn off portfolio pagination functionality.", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_portfolio_hide_pagination_container", "dependence_show_on_yes" => ""));
	$panel2->addChild("portfolio_hide_pagination",$portfolio_hide_pagination);

	$portfolio_hide_pagination_container = new QodeContainer("portfolio_hide_pagination_container","portfolio_hide_pagination","yes");
	$panel2->addChild("portfolio_hide_pagination_container",$portfolio_hide_pagination_container);

		$portfolio_navigation_through_same_category = new QodeField("yesno","portfolio_navigation_through_same_category","no","Enable Pagination Through Same Category","Enabling this option will make portfolio pagination sort through current category.");
		$portfolio_hide_pagination_container->addChild("portfolio_navigation_through_same_category",$portfolio_navigation_through_same_category);


    $portfolio_box = new QodeField("yesno","portfolio_box","yes","Enable Box Holder","Enabling this option will place box holder on project. This option works only if Portfolio style is Big Images, Big Slider or Gallery", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_portfolio_without_box_container", "dependence_show_on_yes" => "#qodef_portfolio_box_container"));
    $panel2->addChild("portfolio_box",$portfolio_box);

    $portfolio_box_container = new QodeContainer("portfolio_box_container","portfolio_box","no");
    $panel2->addChild("portfolio_box_container",$portfolio_box_container);

        $portfolio_box_background_color = new QodeField("color","portfolio_box_background_color","","Background Color","Default color is #ffffff");
        $portfolio_box_container->addChild("portfolio_box_background_color",$portfolio_box_background_color);

        $portfolio_box_lr_padding = new QodeField("text","portfolio_box_lr_padding","","Padding(px)","Format: 10px 5px 10px 8px (Default value is 46px 26px 45px 26px)", array(), array("col_width" => 3));
        $portfolio_box_container->addChild("portfolio_box_lr_padding",$portfolio_box_lr_padding);

    $portfolio_without_box_container = new QodeContainer("portfolio_without_box_container","portfolio_box","yes");
    $panel2->addChild("portfolio_without_box_container",$portfolio_without_box_container);

        $portfolio_box_top_padding = new QodeField("text","portfolio_box_top_padding","","Top Padding(px)","Default value is 46", array(), array("col_width" => 3));
        $portfolio_without_box_container->addChild("portfolio_box_top_padding",$portfolio_box_top_padding);

	$portfolio_columns_number = new QodeField("select","portfolio_columns_number","2","Number of Columns",'Enter the number of columns for Portfolio Gallery type', array( "2" => "2 columns",
       "3" => "3 columns",
       "4" => "4 columns"
      ));
	$panel2->addChild("portfolio_columns_number",$portfolio_columns_number);

	$portfolio_single_slug = new QodeField("text","portfolio_single_slug","","Portfolio Single Slug",'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect) ', array(), array("col_width" => 3));
	$panel2->addChild("portfolio_single_slug",$portfolio_single_slug);

    /*Navigation*/

    $portfolio_navigation_title = new QodeTitle("portfolio_navigation_title","Navigation");
    $panel2->addChild("portfolio_navigation_title",$portfolio_navigation_title);


    $group19 = new QodeGroup("Navigation Button Size","Define navigation button size");
    $panel2->addChild("group19",$group19);

        $row1 = new QodeRow();
        $group19->addChild("row1",$row1);

            $portfolio_single_navigation_button_width = new QodeField("textsimple","portfolio_single_navigation_button_width","","Width (px)","This is some description");
            $row1->addChild("portfolio_single_navigation_button_width",$portfolio_single_navigation_button_width);

            $portfolio_single_navigation_button_height = new QodeField("textsimple","portfolio_single_navigation_button_height","","Height (px)","This is some description");
            $row1->addChild("portfolio_single_navigation_button_height",$portfolio_single_navigation_button_height);

    $group20 = new QodeGroup("Navigation Button Position","Enter the amount of pixels you would like to move the navigation buttons towards the edges of the slider");
    $panel2->addChild("group20",$group20);

        $row1 = new QodeRow();
        $group20->addChild("row1",$row1);

            $portfolio_single_navigation_button_position = new QodeField("textsimple","portfolio_single_navigation_button_position","","Position (px)","This is some description");
            $row1->addChild("portfolio_single_navigation_button_position",$portfolio_single_navigation_button_position);

    $group16 = new QodeGroup("Icon Arrow Style","Define navigation arrow style");
    $panel2->addChild("group16",$group16);

        $row1 = new QodeRow();
        $group16->addChild("row1",$row1);

            $portfolio_single_navigation_arrow_size = new QodeField("textsimple","portfolio_single_navigation_arrow_size","","Arrow Size (px)","Default value is 14    ");
            $row1->addChild("portfolio_single_navigation_arrow_size",$portfolio_single_navigation_arrow_size);

            $portfolio_single_navigation_arrows_type = new QodeField("selectblanksimple", "portfolio_single_navigation_arrows_type", "", "Arrow Icon", "", $qode_options_arrows_type);
            $row1->addChild("portfolio_single_navigation_arrows_type", $portfolio_single_navigation_arrows_type);

            $portfolio_single_navigation_arrow_color = new QodeField("colorsimple","portfolio_single_navigation_arrow_color","","Arrow Color","This is some description");
            $row1->addChild("portfolio_single_navigation_arrow_color",$portfolio_single_navigation_arrow_color);

            $portfolio_single_navigation_arrow_transparency = new QodeField("textsimple","portfolio_single_navigation_arrow_transparency","","Arrow Transparency (0-1)","This is some description");
            $row1->addChild("portfolio_single_navigation_arrow_transparency",$portfolio_single_navigation_arrow_transparency);

        $row2 = new QodeRow(true);
        $group16->addChild("row2",$row2);

                $portfolio_single_navigation_arrow_hover_color = new QodeField("colorsimple","portfolio_single_navigation_arrow_hover_color","","Arrow Hover Color","This is some description");
                $row2->addChild("portfolio_single_navigation_arrow_hover_color",$portfolio_single_navigation_arrow_hover_color);

                $portfolio_single_navigation_arrow_hover_transparency = new QodeField("textsimple","portfolio_single_navigation_arrow_hover_transparency","","Arrow Hover Transparency (0-1)","This is some description");
                $row2->addChild("portfolio_single_navigation_arrow_hover_transparency",$portfolio_single_navigation_arrow_hover_transparency);

    $group17 = new QodeGroup("Navigation Button Background","Define navigation button background");
    $panel2->addChild("group17",$group17);

            $row1 = new QodeRow();
            $group17->addChild("row1",$row1);

                    $portfolio_single_navigation_background_color = new QodeField("colorsimple","portfolio_single_navigation_background_color","","Background Color","This is some description");
                    $row1->addChild("portfolio_single_navigation_background_color",$portfolio_single_navigation_background_color);

                    $portfolio_single_navigation_background_transparency = new QodeField("textsimple","portfolio_single_navigation_background_transparency","","Background Transparency (0-1)","This is some description");
                    $row1->addChild("portfolio_single_navigation_background_transparency",$portfolio_single_navigation_background_transparency);

                    $portfolio_single_navigation_background_hover_color = new QodeField("colorsimple","portfolio_single_navigation_background_hover_color","","Background Hover Color","This is some description");
                    $row1->addChild("portfolio_single_navigation_background_hover_color",$portfolio_single_navigation_background_hover_color);

                    $portfolio_single_navigation_background_hover_transparency = new QodeField("textsimple","portfolio_single_navigation_background_hover_transparency","","Background Hover Transparency (0-1)","This is some description");
                    $row1->addChild("portfolio_single_navigation_background_hover_transparency",$portfolio_single_navigation_background_hover_transparency);

    $group18 = new QodeGroup("Navigation Button Border","Define border style");
    $panel2->addChild("group18",$group18);

            $row1 = new QodeRow();
            $group18->addChild("row1",$row1);

                    $portfolio_single_navigation_border_width = new QodeField("textsimple","portfolio_single_navigation_border_width","","Border width (px)","");
                    $row1->addChild("portfolio_single_navigation_border_width",$portfolio_single_navigation_border_width);

                    $portfolio_single_navigation_border_radius = new QodeField("textsimple","portfolio_single_navigation_border_radius","","Border Radius (px)","This is some description");
                    $row1->addChild("portfolio_single_navigation_border_radius",$portfolio_single_navigation_border_radius);

                    $portfolio_single_navigation_border_color = new QodeField("colorsimple","portfolio_single_navigation_border_color","","Border Color","This is some description");
                    $row1->addChild("portfolio_single_navigation_border_color",$portfolio_single_navigation_border_color);

                    $portfolio_single_navigation_border_transparency = new QodeField("textsimple","portfolio_single_navigation_border_transparency","","Border Transparency (0-1)","This is some description");
                    $row1->addChild("portfolio_single_navigation_border_transparency",$portfolio_single_navigation_border_transparency);

            $row2 = new QodeRow(true);
            $group18->addChild("row2",$row2);

                    $portfolio_single_navigation_border_hover_color = new QodeField("colorsimple","portfolio_single_navigation_border_hover_color","","Border Hover Color","This is some description");
                    $row2->addChild("portfolio_single_navigation_border_hover_color",$portfolio_single_navigation_border_hover_color);

                    $portfolio_single_navigation_border_hover_transparency = new QodeField("textsimple","portfolio_single_navigation_border_hover_transparency","","Border Hover Transparency (0-1)","This is some description");
                    $row2->addChild("portfolio_single_navigation_border_hover_transparency",$portfolio_single_navigation_border_hover_transparency);



    $portfolio_single_navigation_show_button_shadow = new QodeField("yesno","portfolio_single_navigation_show_button_shadow","no","Show Button Shadow","Enabling this options will show button shadow", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_portfolio_single_navigation_button_shadow_container"));
    $panel2->addChild("portfolio_single_navigation_show_button_shadow",$portfolio_single_navigation_show_button_shadow);

    $portfolio_single_navigation_button_shadow_container = new QodeContainer("portfolio_single_navigation_button_shadow_container","portfolio_single_navigation_show_button_shadow","no");
    $panel2->addChild("portfolio_single_navigation_button_shadow_container",$portfolio_single_navigation_button_shadow_container);

    $group21 = new QodeGroup("Button Shadow","Set horizontal and vertical position of shadow (negative values are allowed), and define blur and spread.");
    $portfolio_single_navigation_button_shadow_container->addChild("group21",$group21);

        $row1 = new QodeRow();
        $group21->addChild("row1",$row1);

            $portfolio_single_navigation_button_shadow_color = new QodeField("colorsimple","portfolio_single_navigation_button_shadow_color","","Color","Choose color for  box shadow");
            $row1->addChild("portfolio_single_navigation_button_shadow_color",$portfolio_single_navigation_button_shadow_color);

        $row2 = new QodeRow();
        $group21->addChild("row2",$row2);

                $portfolio_single_navigation_button_h_shadow = new QodeField("textsimple","portfolio_single_navigation_button_h_shadow","","Horizontal shadow (px)","");
                $row2->addChild("portfolio_single_navigation_button_h_shadow",$portfolio_single_navigation_button_h_shadow);

                $portfolio_single_navigation_button_v_shadow = new QodeField("textsimple","portfolio_single_navigation_button_v_shadow","","Vertical shadow (px)","");
                $row2->addChild("portfolio_single_navigation_button_v_shadow",$portfolio_single_navigation_button_v_shadow);

                $portfolio_single_navigation_button_blur = new QodeField("textsimple","portfolio_single_navigation_button_blur","","Blur (px)","");
                $row2->addChild("portfolio_single_navigation_button_blur",$portfolio_single_navigation_button_blur);

                $portfolio_single_navigation_button_spread = new QodeField("textsimple","portfolio_single_navigation_button_spread","","Spread (px)","");
                $row2->addChild("portfolio_single_navigation_button_spread",$portfolio_single_navigation_button_spread);



    $portfolio_back_to_button_choice = new QodeField("select","portfolio_back_to_button_choice","icon","Back to Button Type","Choose Back to button type",array(
        "icon" => "Icon",
        "custom_icon" => "Custom Icon"
        ),
    array("dependence" => true,
        "show" => array("icon" => "#qodef_portfolio_back_to_button_icon_container","custom_icon" => "#qodef_portfolio_back_to_button_custom_container"),
        "hide" => array("custom_icon" => "#qodef_portfolio_back_to_button_icon_container", "icon" => "#qodef_portfolio_back_to_button_custom_container"))
    );

    $panel2->addChild("portfolio_back_to_button_choice",$portfolio_back_to_button_choice);

    $portfolio_back_to_button_icon_container = new QodeContainer("portfolio_back_to_button_icon_container","portfolio_back_to_button_choice","custom_icon");
    $panel2->addChild("portfolio_back_to_button_icon_container",$portfolio_back_to_button_icon_container);

        $group22 = new QodeGroup("Icon and Style","Choose icon and style for it");
        $portfolio_back_to_button_icon_container->addChild("group22",$group22);

            $row1 = new QodeRow();
            $group22->addChild("row1",$row1);

                $portfolio_back_to_button_icon_color = new QodeField("colorsimple","portfolio_back_to_button_icon_color","","Color","This is some description");
                $row1->addChild("portfolio_back_to_button_icon_color",$portfolio_back_to_button_icon_color);

                $portfolio_back_to_button_icon_hover_color = new QodeField("colorsimple","portfolio_back_to_button_icon_hover_color","","Hover Color","This is some description");
                $row1->addChild("portfolio_back_to_button_icon_hover_color",$portfolio_back_to_button_icon_hover_color);

                $portfolio_back_to_button_icon = new QodeField("selectsimple","portfolio_back_to_button_icon","","Icon","Choose icon for Back to button",array(
                    "fa fa-th" => "fa-th grid",
                    "icon_grid-3x3" => "icon_grid 3x3",
                    "ion-grid" => "ion-grid"
                    ));
                $row1->addChild("portfolio_back_to_button_icon",$portfolio_back_to_button_icon);

                $portfolio_back_to_button_icon_size = new QodeField("textsimple","portfolio_back_to_button_icon_size","","Size (px)","This is some description");
                $row1->addChild("portfolio_back_to_button_icon_size",$portfolio_back_to_button_icon_size);

    $portfolio_back_to_button_custom_container = new QodeContainer("portfolio_back_to_button_custom_container","portfolio_back_to_button_choice","icon");
    $panel2->addChild("portfolio_back_to_button_custom_container",$portfolio_back_to_button_custom_container);

        $portfolio_back_to_button_custom_icon = new QodeField("image","portfolio_back_to_button_custom_icon","","Custom Icon","Choose custom icon for Back to button");
        $portfolio_back_to_button_custom_container->addChild("portfolio_back_to_button_custom_icon",$portfolio_back_to_button_custom_icon);

        $portfolio_back_to_button_custom_hover_icon = new QodeField("image","portfolio_back_to_button_custom_hover_icon","","Custom Hover Icon","Choose custom hover icon for Back to button");
        $portfolio_back_to_button_custom_container->addChild("portfolio_back_to_button_custom_hover_icon",$portfolio_back_to_button_custom_hover_icon);

        $portfolio_back_to_button_custom_icon_retina_x15 = new QodeField("image","portfolio_back_to_button_custom_icon_retina_x15","","Custom Icon for Retina x1.5","Choose custom icon for Back to button for retina x1.5 (note that you must have Custom Icon first)");
        $portfolio_back_to_button_custom_container->addChild("portfolio_back_to_button_custom_icon_retina_x15",$portfolio_back_to_button_custom_icon_retina_x15);

        $portfolio_back_to_button_custom_hover_icon_retina_x15 = new QodeField("image","portfolio_back_to_button_custom_hover_icon_retina_x15","","Custom Hover Icon for Retina x1.5","Choose custom hover icon for Back to button for retina x1.5 (note that you must have Custom Icon first)");
        $portfolio_back_to_button_custom_container->addChild("portfolio_back_to_button_custom_hover_icon_retina_x15",$portfolio_back_to_button_custom_hover_icon_retina_x15);

        $portfolio_back_to_button_custom_icon_retina_x2 = new QodeField("image","portfolio_back_to_button_custom_icon_retina_x2","","Custom Icon for Retina x2","Choose custom icon for Back to button for retina x2 (note that you must have Custom Icon first)");
        $portfolio_back_to_button_custom_container->addChild("portfolio_back_to_button_custom_icon_retina_x2",$portfolio_back_to_button_custom_icon_retina_x2);

        $portfolio_back_to_button_custom_hover_icon_retina_x2 = new QodeField("image","portfolio_back_to_button_custom_hover_icon_retina_x2","","Custom Hover Icon for Retina x2","Choose custom hover icon for Back to button for retina x2 (note that you must have Custom Icon first)");
        $portfolio_back_to_button_custom_container->addChild("portfolio_back_to_button_custom_hover_icon_retina_x2",$portfolio_back_to_button_custom_hover_icon_retina_x2);