<?php

global $edgtIconCollections;

$edgt_custom_sidebars = edgt_get_custom_sidebars();

$edgtGeneral = new EdgeMetaBox("post", "Edge General");
$edgtFramework->edgtMetaBoxes->addMetaBox("post_general",$edgtGeneral);

	$edgt_page_background_color = new EdgeMetaField("color","edgt_page_background_color","","Page Background Color","Choose the page background (body) color");
	$edgtGeneral->addChild("edgt_page_background_color",$edgt_page_background_color);

	$group1 = new EdgeGroup("Content Style","Define styles for Content area");
	$edgtGeneral->addChild("group1",$group1);

		$row1 = new EdgeRow();
		$group1->addChild("row1",$row1);

			$edgt_content_top_padding = new EdgeMetaField("textsimple","edgt_content-top-padding","","Content Top Padding (px)","This option control content top padding.");
			$row1->addChild("edgt_content-top-padding",$edgt_content_top_padding);

			$edgt_content_top_padding_mobile = new EdgeMetaField("selectblanksimple","edgt_content-top-padding-mobile","","Set this top padding for mobile header","", array(
		       "no" => "No",
		       "yes" => "Yes"
		      ));
			$row1->addChild("edgt_content-top-padding-mobile",$edgt_content_top_padding_mobile);

	$edgt_show_animation = new EdgeMetaField("selectblank","edgt_show-animation","","Page Transition",'Choose a type of transition between loading pages.', array(
       "no_animation" => "No Animation",
       "updown" => "Up / Down",
       "fade" => "Fade",
		"updown_fade" => "Up/Down (In) / Fade (Out)",
       "leftright" => "Left / Right"
      ), array(), "enable_grid_elements", array("yes"));
	$edgtGeneral->addChild("edgt_show-animation",$edgt_show_animation);

	$page_transitions_notice = new EdgeNotice("Page Transition",'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', "AJAX Page transitions are disabled due to VC Grid Elements", "enable_grid_elements","no");
	$edgtGeneral->addChild("page_transitions_notice",$page_transitions_notice);

	$edgt_hide_featured_image = new EdgeMetaField("yesno","edgt_hide-featured-image","no","Hide Feature image","Do you want to hide feature image for this post?");
	$edgtGeneral->addChild("edgt_hide-featured-image",$edgt_hide_featured_image);

	$edgt_revolution_slider = new EdgeMetaField("text","edgt_revolution-slider","","Layer Slider or Edge Slider Shortcode","Copy and paste your shortcode located in Edge Slider -> Slider");
	$edgtGeneral->addChild("edgt_revolution-slider",$edgt_revolution_slider);
	
//Choose article type for blog masonry gallery template
	$edgtPostType = new EdgeMetaBox('post', 'Edge Post Size', 'edgt_show-page-title', array('no'));
	$edgtFramework->edgtMetaBoxes->addMetaBox('edgtPostType', $edgtPostType);

	$edgt_blog_masonry_gallery_article_size = new EdgeMetaField('select', 'edgt_blog_masonry_gallery_article_size', 'square_small', 'Size', 'Choose article size in blog list for blog masonry gallery template', array(
			'square_big' => 'Square Big',
			'square_small' => 'Square Small',
			'rectangle_portrait' => 'Rectangle Portrait',
			'rectangle_landscape' => 'Rectangle Landscape'
		));

	$edgtPostType->addChild('edgt_blog_masonry_gallery_article_size', $edgt_blog_masonry_gallery_article_size);	

// Left Menu Area

$edgtLeftMenuArea = new EdgeMetaBox("post", "Edge Side Menu Area","vertical_area",array("no"));
$edgtFramework->edgtMetaBoxes->addMetaBox("post_left_menu",$edgtLeftMenuArea);

	$edgt_page_vertical_area_transparency = new EdgeMetaField("selectblank","edgt_page_vertical_area_transparency","","Enable transparent left menu area","Enabling this option will make Left Menu background transparent ", array(
       "no" => "No",
       "yes" => "Yes"
      ));
	$edgtLeftMenuArea->addChild("edgt_page_vertical_area_transparency",$edgt_page_vertical_area_transparency);

	$edgt_page_vertical_area_background = new EdgeMetaField("color","edgt_page_vertical_area_background","","Side Menu Area Background Color","Choose a color for Left Menu background");
	$edgtLeftMenuArea->addChild("edgt_page_vertical_area_background",$edgt_page_vertical_area_background);
	
	$edgt_page_vertical_area_background_opacity = new EdgeMetaField("text","edgt_page_vertical_area_background_opacity","","Side Menu Area Background Opacity","Choose a opacity for the Side Menu Area Background (0 = fully transparent, 1 = opaque)", array(), array("col_width" => 3));
	$edgtLeftMenuArea->addChild("edgt_page_vertical_area_background_opacity",$edgt_page_vertical_area_background_opacity);

	$edgt_page_vertical_area_background_image = new EdgeMetaField("image","edgt_page_vertical_area_background_image","","Side Menu Area Background Image","Choose an image for Left Menu background");
	$edgtLeftMenuArea->addChild("edgt_page_vertical_area_background_image",$edgt_page_vertical_area_background_image);

// Header

$edgtHeader = new EdgeMetaBox("post", "Edge Header","vertical_area",array("yes"));
$edgtFramework->edgtMetaBoxes->addMetaBox("post_header",$edgtHeader);

	$edgt_header_style = new EdgeMetaField("selectblank","edgt_header-style","","Header Skin","Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style", array(
       "light" => "Light",
       "dark" => "Dark"
      ));
	$edgtHeader->addChild("edgt_header-style",$edgt_header_style);

    $edgt_header_style_on_scroll = new EdgeMetaField("selectblank","edgt_header-style-on-scroll","","Enable Header Style on Scroll","Enabling this option, header will change style on scroll (depending on row settings) to make header elements (logo, main menu, side menu button) in that style", array(
        "no" => "No",
        "yes" => "Yes"
    ));
    $edgtHeader->addChild("edgt_header-style-on-scroll",$edgt_header_style_on_scroll);

	$edgt_header_color_per_page = new EdgeMetaField("color","edgt_header_color_per_page","","Initial Header Background Color","Choose a background color for header area");
	$edgtHeader->addChild("edgt_header_color_per_page",$edgt_header_color_per_page);

	$edgt_header_color_transparency_per_page = new EdgeMetaField("text","edgt_header_color_transparency_per_page","","Initial Header Transparency","Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)", array(), array("col_width" => 3));
	$edgtHeader->addChild("edgt_header_color_transparency_per_page",$edgt_header_color_transparency_per_page);

	$edgt_header_bottom_border_color = new EdgeMetaField("color","edgt_header_bottom_border_color","","Initial Header Bottom Border Color","Choose a bottom border color for header area");
	$edgtHeader->addChild("edgt_header_bottom_border_color",$edgt_header_bottom_border_color);

	$edgt_page_scroll_amount_for_sticky = new EdgeMetaField("text","edgt_page_scroll_amount_for_sticky","","Scroll amount for sticky header appearance (px)","Define scroll amount for sticky header appearance", array(), array("col_width" => 3),"header_bottom_appearance",array( "regular","fixed","fixed_hiding") );
	$edgtHeader->addChild("edgt_page_scroll_amount_for_sticky",$edgt_page_scroll_amount_for_sticky);
	
	$edgt_page_hide_initial_sticky = new EdgeMetaField("selectblank","edgt_page_hide_initial_sticky","","Hide Sticky Header Initially","Enabling this option will initially hide the header, and it will only be displayed when the user scrolls down the page", array(
		"no" => "No",
		"yes" => "Yes"	
	));
	$edgtHeader->addChild("edgt_page_hide_initial_sticky",$edgt_page_hide_initial_sticky);
// Title

$edgtTitle = new EdgeMetaBox("post", "Edge Title");
$edgtFramework->edgtMetaBoxes->addMetaBox("post_title",$edgtTitle);

	$edgt_show_page_title = new EdgeMetaField("selectblank","edgt_show-page-title","","Show Title Area","Disabling this option will turn off page title area", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#edgtf_edgt_page_title_area_container, #edgtf-meta-box-post_title_animations"),
			"show" => array(
				""=>"#edgtf_edgt_page_title_area_container, #edgtf-meta-box-post_title_animations",
				"yes"=>"#edgtf_edgt_page_title_area_container, #edgtf-meta-box-post_title_animations") ));
	$edgtTitle->addChild("edgt_show-page-title",$edgt_show_page_title);

	$edgt_page_title_area_container = new EdgeContainer("edgt_page_title_area_container","edgt_show-page-title","no");
	$edgtTitle->addChild("edgt_page_title_area_container",$edgt_page_title_area_container);

	$edgt_page_title_type = new EdgeMetaField("selectblank","edgt_page_title_type","","Title Type","Choose title type for this page.",array(
		"standard_title" => "Standard",
		"breadcrumbs_title" => "Breadcrumbs"
	),array(
      	"dependence" => true,
      	"hide" => array("breadcrumbs_title" => "#edgtf_edgt_title_standard_container"),
      	"show" => array("standard_title" => "#edgtf_edgt_title_standard_container","" => "#edgtf_edgt_title_standard_container")
      ));
	$edgt_page_title_area_container->addChild("edgt_page_title_type",$edgt_page_title_type);

	$edgt_animate_page_title = new EdgeMetaField("selectblank","edgt_animate_page_title","","Animations","Choose an animation for Title Area",array(
		"no" => "No animation",
		"text_right_left" => "Text right to left",
		"area_top_bottom" => "Title area top to bottom"
	));
	$edgt_page_title_area_container->addChild("edgt_animate_page_title",$edgt_animate_page_title);
	
	$edgt_page_page_title_vertical_aligment = new EdgeMetaField("selectblank","edgt_page_page_title_vertical_aligment","","Vertical Alignment","Specify Title vertical alignment", array( 
		"header_bottom" => "From Bottom of Header",
		"window_top" => "From Window Top"
	 ));
	$edgt_page_title_area_container->addChild("edgt_page_page_title_vertical_aligment",$edgt_page_page_title_vertical_aligment);

	$edgt_show_page_title_text = new EdgeMetaField("selectblank","edgt_show_page_title_text","","Show Title Text","Disabling this option will turn off page title text", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#edgtf_edgt_title_text_container, #edgtf_animation_page_page_title_container"),
			"show" => array(
				""=>"#edgtf_edgt_title_text_container, #edgtf_animation_page_page_title_container",
				"yes"=>"#edgtf_edgt_title_text_container, #edgtf_animation_page_page_title_container") ));
	$edgt_page_title_area_container->addChild("edgt_show_page_title_text",$edgt_show_page_title_text);

	$edgt_title_text_container = new EdgeContainer("edgt_title_text_container","edgt_show_page_title_text","no");
	$edgt_page_title_area_container->addChild("edgt_title_text_container",$edgt_title_text_container);

	$edgt_page_title_position = new EdgeMetaField("selectblank","edgt_page_title_position","","Title Text Alignment","Specify Title text alignment",array(
		"left" => "Left",
		"center" => "Center",
		"right" => "Right"
	));
	$edgt_title_text_container->addChild("edgt_page_title_position",$edgt_page_title_position);

	$group1 = new EdgeGroup("Title Text Style","Define styles for text in Title Area");
	$edgt_title_text_container->addChild("group1",$group1);

	$row1 = new EdgeRow();
	$group1->addChild("row1",$row1);

	$edgt_page_title_color = new EdgeMetaField("colorsimple","edgt_page-title-color","","Text Color","ThisIsDescription");
	$row1->addChild("edgt_page-title-color",$edgt_page_title_color);

	$edgt_title_text_shadow = new EdgeMetaField("selectblanksimple","edgt_title_text_shadow","","Text Shadow","ThisIsDescription",array(
		"no" => "No",
		"yes" => "yes"
	));
	$row1->addChild("edgt_title_text_shadow",$edgt_title_text_shadow);

	$edgt_title_standard_container = new EdgeContainer("edgt_title_standard_container","edgt_page_title_type","breadcrumbs_title");
	$edgt_page_title_area_container->addChild("edgt_title_standard_container",$edgt_title_standard_container);

	$edgt_title_like_separator = new EdgeMetaField("selectblank","edgt_title_like_separator","","Show Separator Around Title Text","Choose if you want title to look like separator with text",array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
		 	"hide" => array(
				"" => "#edgtf_edgt_title_like_separator_container",
				"no" => "#edgtf_edgt_title_like_separator_container"
			),
		    "show" => array(
				"yes" => "#edgtf_edgt_title_like_separator_container",
			)
		  )
		);
	$edgt_title_standard_container->addChild("edgt_title_like_separator",$edgt_title_like_separator);

	$edgt_title_like_separator_container = new EdgeContainer("edgt_title_like_separator_container","edgt_title_like_separator","", array("", "no"));
	$edgt_title_standard_container->addChild("edgt_title_like_separator_container",$edgt_title_like_separator_container);

		$group1 = new EdgeGroup("Line Styles", "Choose style for separator line");
		$edgt_title_like_separator_container->addChild("group1",$group1);

			$row1 = new EdgeRow();
			$group1->addChild("row1",$row1);

				$edgt_title_like_separator_line_color = new EdgeMetaField("colorsimple","edgt_title_like_separator_line_color","","Color","This is some description");
				$row1->addChild("edgt_title_like_separator_line_color",$edgt_title_like_separator_line_color);

				$edgt_title_like_separator_line_width = new EdgeMetaField("textsimple","edgt_title_like_separator_line_width","","Width","This is some description");
				$row1->addChild("edgt_title_like_separator_line_width",$edgt_title_like_separator_line_width);

				$edgt_title_like_separator_line_thickness = new EdgeMetaField("textsimple","edgt_title_like_separator_line_thickness","","Thickness","This is some description");
				$row1->addChild("edgt_title_like_separator_line_thickness",$edgt_title_like_separator_line_thickness);

				$edgt_title_like_separator_line_style = new EdgeMetaField("selectsimple","edgt_title_like_separator_line_style","","Style","This is some description",array(
					"solid" => "Solid",
					"dashed" => "Dashed",
					"dotted" => "Dotted"
					));
				$row1->addChild("edgt_title_like_separator_line_style",$edgt_title_like_separator_line_style);

		$edgt_title_like_separator_margins = new EdgeMetaField("text","edgt_title_like_separator_margins","","Margins for Title","Define left/right margins for title from separator");
		$edgt_title_like_separator_container->addChild("edgt_title_like_separator_margins",$edgt_title_like_separator_margins);

		$edgt_title_like_separator_line_dots = new EdgeMetaField("selectblank","edgt_title_like_separator_line_dots","","Dots on The End of Lines","Enabling this option will give lines a dot next to title",array(
				"no" => "No",
				"yes" => "Yes"
			),array(
				"dependence" => true,
				"hide" => array("no" => "#edgtf_edgt_title_like_separator_dots_container"),
				"show" => array("yes" => "#edgtf_edgt_title_like_separator_dots_container","" => "#edgtf_edgt_title_like_separator_dots_container")
			));
		$edgt_title_like_separator_container->addChild("edgt_title_like_separator_line_dots",$edgt_title_like_separator_line_dots);

		$edgt_title_like_separator_dots_container = new EdgeContainer("edgt_title_like_separator_dots_container","edgt_title_like_separator_line_dots","no");
		$edgt_title_like_separator_container->addChild("edgt_title_like_separator_dots_container",$edgt_title_like_separator_dots_container);

			$group1 = new EdgeGroup("Dots Style","Choose style for dots");
			$edgt_title_like_separator_dots_container->addChild("group1",$group1);

				$row1 = new EdgeRow();
				$group1->addChild("row1",$row1);

					$edgt_title_like_separator_dots_size = new EdgeMetaField("textsimple","edgt_title_like_separator_dots_size","","Size (px)","This is some description");
					$row1->addChild("edgt_title_like_separator_dots_size",$edgt_title_like_separator_dots_size);

					$edgt_title_like_separator_dots_color = new EdgeMetaField("colorsimple","edgt_title_like_separator_dots_color","","Color","This is some description");
					$row1->addChild("edgt_title_like_separator_dots_color",$edgt_title_like_separator_dots_color);

	//Subtitle like separator with text
	$edgt_subtitle_like_separator = new EdgeMetaField("selectblank","edgt_subtitle_like_separator","","Show Separator Around Subtitle Text","Choose if you want title to look like separator with text",array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
		 	"hide" => array("no" => "#edgtf_edgt_subtitle_like_separator_container", "" => "#edgtf_edgt_subtitle_like_separator_container"),
		    "show" => array("yes" => "#edgtf_edgt_subtitle_like_separator_container")
		  )
		);
	$edgt_title_standard_container->addChild("edgt_subtitle_like_separator",$edgt_subtitle_like_separator);

	$edgt_subtitle_like_separator_container = new EdgeContainer("edgt_subtitle_like_separator_container","edgt_subtitle_like_separator","", array('no', ''));
	$edgt_title_standard_container->addChild("edgt_subtitle_like_separator_container",$edgt_subtitle_like_separator_container);

		$group1 = new EdgeGroup("Line Styles", "Choose style for separator line");
		$edgt_subtitle_like_separator_container->addChild("group1",$group1);

			$row1 = new EdgeRow();
			$group1->addChild("row1",$row1);

				$edgt_subtitle_like_separator_line_color = new EdgeMetaField("colorsimple","edgt_subtitle_like_separator_line_color","","Color","This is some description");
				$row1->addChild("edgt_subtitle_like_separator_line_color",$edgt_subtitle_like_separator_line_color);

				$edgt_subtitle_like_separator_line_width = new EdgeMetaField("textsimple","edgt_subtitle_like_separator_line_width","","Width","This is some description");
				$row1->addChild("edgt_subtitle_like_separator_line_width",$edgt_subtitle_like_separator_line_width);

				$edgt_subtitle_like_separator_line_thickness = new EdgeMetaField("textsimple","edgt_subtitle_like_separator_line_thickness","","Thickness","This is some description");
				$row1->addChild("edgt_subtitle_like_separator_line_thickness",$edgt_subtitle_like_separator_line_thickness);

				$edgt_subtitle_like_separator_line_style = new EdgeMetaField("selectsimple","edgt_subtitle_like_separator_line_style","","Style","This is some description",array(
					"solid" => "Solid",
					"dashed" => "Dashed",
					"dotted" => "Dotted"
					));
				$row1->addChild("edgt_subtitle_like_separator_line_style",$edgt_subtitle_like_separator_line_style);
	
	
	$edgt_page_title_background_color = new EdgeMetaField("color","edgt_page-title-background-color","","Background Color","Choose background color for Title Area");
	$edgt_page_title_area_container->addChild("edgt_page-title-background-color",$edgt_page_title_background_color);

	$edgt_show_page_title_image = new EdgeMetaField("yesno","edgt_show-page-title-image","no","Don't Show Background Image","Enable this option to hide background image in Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_edgt_background_image_container", "dependence_show_on_yes" => ""));
	$edgt_page_title_area_container->addChild("edgt_show-page-title-image",$edgt_show_page_title_image);

	$edgt_background_image_container = new EdgeContainer("edgt_background_image_container","edgt_show-page-title-image","yes");
	$edgt_page_title_area_container->addChild("edgt_background_image_container",$edgt_background_image_container);

	$edgt_title_image = new EdgeMetaField("image","edgt_title-image","","Background Image","Choose a background image for Title Area");
	$edgt_background_image_container->addChild("edgt_title-image",$edgt_title_image);

	$edgt_title_overlay_image = new EdgeMetaField("image","edgt_title-overlay-image","","Pattern Overlay Image","Choose an image to be used as pattern over Title Area");
	$edgt_background_image_container->addChild("edgt_title-overlay-image",$edgt_title_overlay_image);

	$edgt_responsive_title_image = new EdgeMetaField("selectblank","edgt_responsive-title-image","","Responsive Background Image","Do you want to make Title background image responsive?", array(
			"no" => "No",
			"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"yes"=>"#edgtf_edgt_responsive_title_image_container, #edgtf_edgt_title-height"),
			"show" => array(
				""=>"#edgtf_edgt_responsive_title_image_container, #edgtf_edgt_title-height",
				"no"=>"#edgtf_edgt_responsive_title_image_container, #edgtf_edgt_title-height") ));
	$edgt_background_image_container->addChild("edgt_responsive-title-image",$edgt_responsive_title_image);

	$edgt_responsive_title_image_container = new EdgeContainer("edgt_responsive_title_image_container","edgt_responsive-title-image","yes");
	$edgt_background_image_container->addChild("edgt_responsive_title_image_container",$edgt_responsive_title_image_container);

	$edgt_fixed_title_image = new EdgeMetaField("selectblank","edgt_fixed-title-image","","Parallax Background Image","Do you want background image to have parallax effect?", array(
		"no" => "No",
		"yes" => "Yes",
		"yes_zoom" => "Yes, with zoom out"
	));
	$edgt_responsive_title_image_container->addChild("edgt_fixed-title-image",$edgt_fixed_title_image);
	
	$edgt_enable_page_title_oblique = new EdgeMetaField("selectblank","edgt_enable_page_title_oblique","","Show Title Oblique","Enabling this option will show title oblique", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#edgtf_edgt_title_oblique_container",
				""=>"#edgtf_edgt_title_oblique_container"),
			"show" => array(
				"yes"=>"#edgtf_edgt_title_oblique_container") ));
	$edgt_page_title_area_container->addChild("edgt_enable_page_title_oblique",$edgt_enable_page_title_oblique);
	
		$edgt_title_oblique_container = new EdgeContainer("edgt_title_oblique_container","edgt_enable_page_title_oblique","");
		$edgt_page_title_area_container->addChild("edgt_title_oblique_container",$edgt_title_oblique_container);
	
			$edgt_title_oblique_section_position = new EdgeMetaField("selectblank","edgt_title_oblique_section_position","","Oblique Position","Choose a position for title oblique", array(
						"from_left_to_right" => "From Left To Right",
						"from_right_to_left" => "From Right To Left"
					));
			$edgt_title_oblique_container->addChild("edgt_title_oblique_section_position",$edgt_title_oblique_section_position);
			 
			$edgt_title_oblique_section_color = new EdgeMetaField("color","edgt_title_oblique_section_color","","Background Color","Choose a background color for Title Oblique");
			$edgt_title_oblique_container->addChild("edgt_title_oblique_section_color",$edgt_title_oblique_section_color);
	
	$edgt_enable_page_title_triangle = new EdgeMetaField("selectblank","edgt_enable_page_title_triangle","","Enable Triangle Shape in Background","Enabling this option will display a triangular shape in background", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#edgtf_edgt_title_triangle_container",
				""=>"#edgtf_edgt_title_triangle_container"),
			"show" => array(
				"yes"=>"#edgtf_edgt_title_triangle_container") ));
	$edgt_page_title_area_container->addChild("edgt_enable_page_title_triangle",$edgt_enable_page_title_triangle);
	
		$edgt_title_triangle_container = new EdgeContainer("edgt_title_triangle_container","edgt_enable_page_title_triangle","");
		$edgt_page_title_area_container->addChild("edgt_title_triangle_container",$edgt_title_triangle_container);
	
			$edgt_title_triangle_section_position = new EdgeMetaField("selectblank","edgt_title_triangle_section_position","","Triangle Shape Position","Choose a position for a triangular shape in title background", array(
				"top_and_bottom" => "Top and Bottom",
                "top" => "Top",
				"bottom" => "Bottom"
				));
			$edgt_title_triangle_container->addChild("edgt_title_triangle_section_position",$edgt_title_triangle_section_position);
			 
			$edgt_title_triangle_section_color = new EdgeMetaField("color","edgt_title_triangle_section_color","","Background Color","Choose a background color for a triangular shape");
			$edgt_title_triangle_container->addChild("edgt_title_triangle_section_color",$edgt_title_triangle_section_color);

//Separator
			
	$edgt_title_separator = new EdgeMetaField("selectblank","edgt_title_separator","","Show Title Separator","Enabling this option will display a separator underneath Title", array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
			"hide" => array(
				"no" => "#edgtf_edgt_title_separator_container",
				"" => "#edgtf_edgt_title_separator_container"
			),
			"show" => array(
				"yes" => "#edgtf_edgt_title_separator_container"
				)
		));
	$edgt_title_standard_container->addChild("edgt_title_separator",$edgt_title_separator);

	$edgt_title_separator_container = new EdgeContainer("edgt_title_separator_container","edgt_title_separator","", array('no', ''));
	$edgt_title_standard_container->addChild("edgt_title_separator_container",$edgt_title_separator_container);

		$edgt_title_separator_format = new EdgeMetaField("select","edgt_title_separator_format","","Format","Choose a format (type) of separator", array(
				"" => "",
                "normal" => "Normal",
                "with_icon" => "With Icon",
                "with_custom_icon" => "With Custom Icon"
        ), array(
        "dependence" => true,
        "hide" => array(
        	"" => "#edgtf_edgt_separator_with_icon_container, #edgtf_edgt_separator_with_custom_icon_container",
        	"normal" => "#edgtf_edgt_separator_with_icon_container, #edgtf_edgt_separator_with_custom_icon_container",
        	"with_custom_icon" => "#edgtf_edgt_separator_with_icon_container",
        	"with_icon" => "#edgtf_edgt_separator_with_custom_icon_container"),
        "show" => array("with_icon" => "#edgtf_edgt_separator_with_icon_container", "with_custom_icon" => "#edgtf_edgt_separator_with_custom_icon_container" )));

        $edgt_title_separator_container->addChild("edgt_title_separator_format",$edgt_title_separator_format);

        $edgt_separator_with_icon_container = new EdgeContainer("edgt_separator_with_icon_container","edgt_title_separator_format","normal",array("normal","with_custom_icon",""));
		$edgt_title_separator_container->addChild("edgt_separator_with_icon_container",$edgt_separator_with_icon_container);

             //init icon pack hide and show array. It will be populated dinamically from collections array
			$separator_icon_pack_hide_array = array();
			$separator_icon_pack_show_array = array();
			$separator_icon_pack_hide_array[""] = "";

			//do we have some collection added in collections array?
			if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
				//get collections params array. It will contain values of 'param' property for each collection
				$separator_icon_collections_params = $edgtIconCollections->getIconCollectionsParams();

				//foreach collection generate hide and show array
				foreach ($edgtIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
					$separator_icon_pack_hide_array[$dep_collection_key] = '';

					//we need to include only current collection in show string as it is the only one that needs to show
					$separator_icon_pack_show_array[$dep_collection_key] = '#edgtf_edgt_separator_icon_'.$dep_collection_object->param.'_container';
					$separator_icon_pack_hide_array[""] .= '#edgtf_edgt_separator_icon_'.$dep_collection_object->param.'_container,';

					//for all collections param generate hide string
					foreach ($separator_icon_collections_params as $separator_icon_collections_param) {
						//we don't need to include current one, because it needs to be shown, not hidden
						if($separator_icon_collections_param !== $dep_collection_object->param) {
							$separator_icon_pack_hide_array[$dep_collection_key].= '#edgtf_edgt_separator_icon_'.$separator_icon_collections_param.'_container,';
						}
					}

					//remove remaining ',' character
					$separator_icon_pack_hide_array[$dep_collection_key] = rtrim($separator_icon_pack_hide_array[$dep_collection_key], ',');

				}

				$separator_icon_pack_hide_array[""] = rtrim($separator_icon_pack_hide_array[""], ',');

			}


			$edgt_separator_icon_pack = new EdgeMetaField(
				"selectblank",
				"edgt_separator_icon_pack",
				"",
				"Separator Icon Pack",
				"Choose icon pack for separator",
				$edgtIconCollections->getIconCollections(),
				array(
					"dependence" => true,
					"hide" => $separator_icon_pack_hide_array,
					"show" => $separator_icon_pack_show_array
				));

			$edgt_separator_with_icon_container->addChild("edgt_separator_icon_pack", $edgt_separator_icon_pack);


			if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
				//foreach icon collection we need to generate separate container that will have dependency set
				//it will have one field inside with icons dropdown
				foreach ($edgtIconCollections->iconCollections as $collection_key => $collection_object) {
					$icons_array = $collection_object->getIconsArray();

					//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
					$icon_collections_keys = $edgtIconCollections->getIconCollectionsKeys();

					//unset current one, because it doesn't have to be included in dependency that hides icon container
					unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

					$separator_icon_hide_values = $icon_collections_keys;
					$separator_icon_hide_values[] = "";
					$edgt_separator_icon_container = new EdgeContainer("edgt_separator_icon_".$collection_object->param."_container", "edgt_separator_icon_pack", "", $separator_icon_hide_values);
					$edgt_separator_icon = new EdgeMetaField("select", "edgt_separator_icon_".$collection_object->param, "", "Separator Icon","Choose Separator Icon", $icons_array, array("col_width" => 3));
					$edgt_separator_icon_container->addChild("edgt_separator_icon_".$collection_object->param, $edgt_separator_icon);

					$edgt_separator_with_icon_container->addChild("edgt_separator_icon_".$collection_object->param."_container", $edgt_separator_icon_container);
				}

			}

			$group1 = new EdgeGroup("Icon Style", "Choose icon style");
			$edgt_separator_with_icon_container->addChild("group1",$group1);

				$row1 = new EdgeRow();
				$group1->addChild("row1",$row1);

					$edgt_title_separator_icon_color = new EdgeMetaField("colorsimple","edgt_title_separator_icon_color","","Color","Choose a color of icon for Title separator");
					$row1->addChild("edgt_title_separator_icon_color",$edgt_title_separator_icon_color);

					$edgt_title_separator_icon_hover_color = new EdgeMetaField("colorsimple","edgt_title_separator_icon_hover_color","","Hover Color","Choose a hover color of icon for Title separator");
					$row1->addChild("edgt_title_separator_icon_hover_color",$edgt_title_separator_icon_hover_color);

					$edgt_title_separator_icon_custom_size = new EdgeMetaField("textsimple","edgt_title_separator_icon_custom_size","","Icon Size","Choose size of icon");
					$row1->addChild("edgt_title_separator_icon_custom_size",$edgt_title_separator_icon_custom_size);

			$group2 = new EdgeGroup("Icon Position and Margin","Choose icon position and left(right) margin");
			$edgt_separator_with_icon_container->addChild("group2",$group2);

				$row1 = new EdgeRow();
				$group2->addChild("row1",$row1);

					$edgt_title_separator_icon_position = new EdgeMetaField("selectsimple","edgt_title_separator_icon_position","","Icon Position","Choose a position for an icon", array(
		                "left" => "Left",
		                "center" => "Center",
		                "right" => "Right"
		        	));
		        	$row1->addChild("edgt_title_separator_icon_position",$edgt_title_separator_icon_position);

		        	$edgt_title_separator_icon_margins = new EdgeMetaField("textsimple","edgt_title_separator_icon_margins","","Margins (px)","Enter margin that will refer to left and right margin of the icon");
		        	$row1->addChild("edgt_title_separator_icon_margins",$edgt_title_separator_icon_margins);

        	$edgt_title_separator_icon_type = new EdgeMetaField("selectblank","edgt_title_separator_icon_type","","Icon Type","Choose icon type", array(
                "normal" => "Normal",
                "circle" => "Circle",
                "square" => "Square"
        	),array("dependence" => true,
        		"hide" => array("normal" => "#edgtf_edgt_title_separator_types_container", "" => "#edgtf_edgt_title_separator_types_container"),
        		"show" => array("circle" => "#edgtf_edgt_title_separator_types_container","square" => "#edgtf_edgt_title_separator_types_container")));
        	$edgt_separator_with_icon_container->addChild("edgt_title_separator_icon_type",$edgt_title_separator_icon_type);

        	$edgt_title_separator_types_container = new EdgeContainer("edgt_title_separator_types_container","edgt_title_separator_icon_type","",array("","normal"));
			$edgt_separator_with_icon_container->addChild("edgt_title_separator_types_container",$edgt_title_separator_types_container);

				$group1 = new EdgeGroup("Border Style", "Define border style for icon");
				$edgt_title_separator_types_container->addChild("group1",$group1);

					$row1 = new EdgeRow();
					$group1->addChild("row1",$row1);

						$edgt_title_separator_icon_border_radius = new EdgeMetaField("textsimple","edgt_title_separator_icon_border_radius","","Border Radius (px)","Enter border radius for icon");
                		$row1->addChild("edgt_title_separator_icon_border_radius",$edgt_title_separator_icon_border_radius);

                		$edgt_title_separator_icon_border_width = new EdgeMetaField("textsimple","edgt_title_separator_icon_border_width","","Border Width (px)","Enter border width for icon");
                		$row1->addChild("edgt_title_separator_icon_border_width",$edgt_title_separator_icon_border_width);

                		$edgt_title_separator_icon_border_color = new EdgeMetaField("colorsimple","edgt_title_separator_icon_border_color","","Border Color","Enter border color for icon");
                		$row1->addChild("edgt_title_separator_icon_border_color",$edgt_title_separator_icon_border_color);

                		$edgt_title_separator_icon_border_hover_color = new EdgeMetaField("colorsimple","edgt_title_separator_icon_border_hover_color","","Border Hover Color","Enter border color for icon");
                		$row1->addChild("edgt_title_separator_icon_border_hover_color",$edgt_title_separator_icon_border_hover_color);

                $group2 = new EdgeGroup("Additional Icon Style","Choose adition icon styling");
                $edgt_title_separator_types_container->addChild("group2",$group2);

                	$row1 = new EdgeRow();
                	$group2->addChild("row1",$row1);

                		$edgt_title_separator_icon_shape_size = new EdgeMetaField("textsimple","edgt_title_separator_icon_shape_size","","Shape Size (px)","This is some description");
                		$row1->addChild("edgt_title_separator_icon_shape_size",$edgt_title_separator_icon_shape_size);

                		$edgt_title_separator_icon_background_color = new EdgeMetaField("colorsimple","edgt_title_separator_icon_background_color","","Background Color","This is some description");
                		$row1->addChild("edgt_title_separator_icon_background_color",$edgt_title_separator_icon_background_color);

                		$edgt_title_separator_icon_background_hover_color = new EdgeMetaField("colorsimple","edgt_title_separator_icon_background_hover_color","","Background Hover Color","This is some description");
                		$row1->addChild("edgt_title_separator_icon_background_hover_color",$edgt_title_separator_icon_background_hover_color);		                		

        $edgt_separator_with_custom_icon_container = new EdgeContainer("edgt_separator_with_custom_icon_container","edgt_title_separator_format","normal",array("normal","with_icon",""));
        $edgt_title_separator_container->addChild("edgt_separator_with_custom_icon_container",$edgt_separator_with_custom_icon_container);

        	$edgt_separator_custom_icon = new EdgeMetaField("image","edgt_separator_custom_icon","","Custom Icon","Choose custom icon for separator");
        	$edgt_separator_with_custom_icon_container->addChild("edgt_separator_custom_icon",$edgt_separator_custom_icon);

        $edgt_title_separator_type = new EdgeMetaField("select","edgt_title_separator_type","","Type","Choose a Title separator line style", array( "" => "",
                "solid" => "Solid",
                "dashed" => "Dashed"
        ));
        $edgt_title_separator_container->addChild("edgt_title_separator_type",$edgt_title_separator_type);

        $edgt_title_separator_position = new EdgeMetaField("select","edgt_title_separator_position","","Position","Choose a Title separator position", array( "" => "",
                "above" => "Above Title",
                "below" => "Below Title"
        ));
        $edgt_title_separator_container->addChild("edgt_title_separator_position",$edgt_title_separator_position);

        $edgt_title_separator_color = new EdgeMetaField("color","edgt_title_separator_color","","Color","Choose a color for Title separator");
        $edgt_title_separator_container->addChild("edgt_title_separator_color",$edgt_title_separator_color);

        $group1 = new EdgeGroup("Size",'Define size for Title separator');
        $edgt_title_separator_container->addChild("group1",$group1);

        $row1 = new EdgeRow();
        $group1->addChild("row1",$row1);

                $edgt_title_separator_thickness = new EdgeMetaField("textsimple","edgt_title_separator_thickness","","Thickness (px)","This is some description");
                $row1->addChild("edgt_title_separator_thickness",$edgt_title_separator_thickness);

                $edgt_title_separator_width = new EdgeMetaField("textsimple","edgt_title_separator_width","","Width (px)","This is some description");
                $row1->addChild("edgt_title_separator_width",$edgt_title_separator_width);

        $group2 = new EdgeGroup("Margin",'Add space at top and bottom of Title separator');
        $edgt_title_separator_container->addChild("group2",$group2);

        $row1 = new EdgeRow();
        $group2->addChild("row1",$row1);

                $edgt_title_separator_topmargin = new EdgeMetaField("textsimple","edgt_title_separator_topmargin","","Top Margin (px)","This is some description");
                $row1->addChild("edgt_title_separator_topmargin",$edgt_title_separator_topmargin);

                $edgt_title_separator_bottommargin = new EdgeMetaField("textsimple","edgt_title_separator_bottommargin","","Bottom Margin (px)","This is some description");
                $row1->addChild("edgt_title_separator_bottommargin",$edgt_title_separator_bottommargin);

	$edgt_title_graphics = new EdgeMetaField("image","edgt_title-graphics","","Title Graphics","Choose a graphic for Title Area, appearing above title");
	$edgt_title_standard_container->addChild("edgt_title-graphics",$edgt_title_graphics);
	
	$edgt_title_height = new EdgeMetaField("text","edgt_title-height","","Title Height (px)","Set a height for Title Area in pixels", array(), array("col_width" => 3));
	$edgt_page_title_area_container->addChild("edgt_title-height",$edgt_title_height);

	$edgt_enable_breadcrumbs = new EdgeMetaField("selectblank","edgt_enable_breadcrumbs","","Enable Breadcrumbs","Do you want to display breadcrumbs in title area?", array(
		"no" => "No",
		"yes" => "Yes"
	), array("dependence" => true,
		"hide" => array(
			"" => "#edgtf_animation_page_page_title_breadcrumbs_container",
			"no"=>"#edgtf_animation_page_page_title_breadcrumbs_container"),
		"show" => array(
			"yes"=>"#edgtf_animation_page_page_title_breadcrumbs_container") ));
	$edgt_page_title_area_container->addChild("edgt_enable_breadcrumbs",$edgt_enable_breadcrumbs);

	$edgt_page_breadcrumbs_color = new EdgeMetaField("color","edgt_page_breadcrumbs_color","","Breadcrumbs Color","Choose a color for breadcrumbs text ");
	$edgt_page_title_area_container->addChild("edgt_page_breadcrumbs_color",$edgt_page_breadcrumbs_color);

	$edgt_page_subtitle = new EdgeMetaField("text","edgt_page_subtitle","","Subtitle Text","Enter your subtitle text");
	$edgt_page_title_area_container->addChild("edgt_page_subtitle",$edgt_page_subtitle);
	
	$edgt_page_subtitle_position = new EdgeMetaField("selectblank","edgt_page_subtitle_position","","Subtitle Position","Choose a Subtitle position", array(
			"below_title" => "Below Title",
			"above_title" => "Above Title"
	));
	$edgt_page_title_area_container->addChild("edgt_page_subtitle_position",$edgt_page_subtitle_position);

	$edgt_page_subtitle_color = new EdgeMetaField("color","edgt_page_subtitle_color","","Subtitle Text Color","Choose a color for subtitle text");
	$edgt_page_title_area_container->addChild("edgt_page_subtitle_color",$edgt_page_subtitle_color);

	$edgt_title_content_style = new EdgeGroup("Title Content Style", "Define style for title area content");
	$edgt_page_title_area_container->addChild("edgt_title_content_style", $edgt_title_content_style);

		$row1 = new EdgeRow();
		$edgt_title_content_style->addChild("row1", $row1);

			$edgt_title_area_content_background_color = new EdgeMetaField("colorsimple","edgt_title_area_content_background_color","","Title Area Content Background Color","Choose a background color for Title Area Content");
			$row1->addChild("edgt_title_area_content_background_color",$edgt_title_area_content_background_color);

			$edgt_title_area_content_opacity = new EdgeMetaField("textsimple","edgt_title_area_content_opacity","","Title Area Content Background Color Opacity","Choose a transparency for the content area background color (0 = fully transparent, 1 = opaque)");
			$row1->addChild("edgt_title_area_content_opacity",$edgt_title_area_content_opacity);

	$edgt_title_style = new EdgeGroup("Title Style", "Define style for title");
	$edgt_page_title_area_container->addChild("edgt_title_style", $edgt_title_style);

		$row1 = new EdgeRow();
		$edgt_title_style->addChild("row1", $row1);

			$edgt_title_background_color = new EdgeMetaField("colorsimple","edgt_title_background_color","","Title Background Color","Choose a background color for Title");
			$row1->addChild("edgt_title_background_color",$edgt_title_background_color);

			$edgt_title_opacity = new EdgeMetaField("textsimple","edgt_title_opacity","","Title Background Color Opacity","Choose a transparency for the title background color (0 = fully transparent, 1 = opaque)");
			$row1->addChild("edgt_title_opacity",$edgt_title_opacity);

	$title_padding_group = new EdgeGroup("Padding","Define padding for title (When using separator around title, only right margin is counted for left/right margin)");
    $edgt_page_title_area_container->addChild("title_padding_group",$title_padding_group);
        
        $row1 = new EdgeRow(true);
        $title_padding_group->addChild("row1",$row1);

			$edgt_title_top_padding = new EdgeMetaField("textsimple","edgt_title_top_padding","","Top Padding (px)","This is some description.");
			$row1->addChild("edgt_title_top_padding",$edgt_title_top_padding);	

			$edgt_title_right_padding = new EdgeMetaField("textsimple","edgt_title_right_padding","","Right Padding (px)","This is some description.");
			$row1->addChild("edgt_title_right_padding",$edgt_title_right_padding);	

			$edgt_title_bottom_padding = new EdgeMetaField("textsimple","edgt_title_bottom_padding","","Bottom Padding (px)","This is some description.");
			$row1->addChild("edgt_title_bottom_padding",$edgt_title_bottom_padding);	

			$edgt_title_left_padding = new EdgeMetaField("textsimple","edgt_title_left_padding","","Left Padding (px)","This is some description.");
			$row1->addChild("edgt_title_left_padding",$edgt_title_left_padding);

	$edgt_subtitle_style = new EdgeGroup("Subtitle Style", "Define style for subtitle");
	$edgt_page_title_area_container->addChild("edgt_subtitle_style", $edgt_subtitle_style);

		$row1 = new EdgeRow();
		$edgt_subtitle_style->addChild("row1", $row1);	

			$edgt_subtitle_background_color = new EdgeMetaField("colorsimple","edgt_subtitle_background_color","","Subtitle Background Color","Choose a background color for Subtitle");
			$row1->addChild("edgt_subtitle_background_color",$edgt_subtitle_background_color);

			$edgt_subtitle_opacity = new EdgeMetaField("textsimple","edgt_subtitle_opacity","","Subtitle Background Color Opacity","Choose a transparency for the subtitle background color (0 = fully transparent, 1 = opaque)");
			$row1->addChild("edgt_subtitle_opacity",$edgt_subtitle_opacity);

	$subtitle_padding_group = new EdgeGroup("Padding","Define padding for subtitle (When using separator around subtitle, only right margin is counted for left/right margin)");
    $edgt_page_title_area_container->addChild("subtitle_padding_group",$subtitle_padding_group);
        $row1 = new EdgeRow(true);
        $subtitle_padding_group->addChild("row1",$row1);

			$edgt_subtitle_top_padding = new EdgeMetaField("textsimple","edgt_subtitle_top_padding","","Top Padding (px)","This is some description.");
			$row1->addChild("edgt_subtitle_top_padding",$edgt_subtitle_top_padding);

			$edgt_subtitle_right_padding = new EdgeMetaField("textsimple","edgt_subtitle_right_padding","","Right Padding (px)","This is some description.");
			$row1->addChild("edgt_subtitle_right_padding",$edgt_subtitle_right_padding);

			$edgt_subtitle_bottom_padding = new EdgeMetaField("textsimple","edgt_subtitle_bottom_padding","","Bottom Padding (px)","This is some description.");
			$row1->addChild("edgt_subtitle_bottom_padding",$edgt_subtitle_bottom_padding);

			$edgt_subtitle_left_padding = new EdgeMetaField("textsimple","edgt_subtitle_left_padding","","Left Padding (px)","This is some description.");
			$row1->addChild("edgt_subtitle_left_padding",$edgt_subtitle_left_padding);

// Content Bottom

$edgtContentBottom = new EdgeMetaBox("post", "Edge Content Bottom");
$edgtFramework->edgtMetaBoxes->addMetaBox("post_content_bottom_page",$edgtContentBottom);

	$edgt_enable_content_bottom_area = new EdgeMetaField("selectblank","edgt_enable_content_bottom_area","","Show Content Bottom Area","Do you want to show content bottom area?", array(
       "no" => "No",
       "yes" => "Yes"
      ),
      array("dependence" => true,
      	"hide" => array(
      		"no"=>"#edgtf_edgt_enable_content_bottom_area_container",
			""=>"#edgtf_edgt_enable_content_bottom_area_container"),
      	"show" => array(
      		"yes"=>"#edgtf_edgt_enable_content_bottom_area_container") ));
	$edgtContentBottom->addChild("edgt_enable_content_bottom_area",$edgt_enable_content_bottom_area);
	
	$edgt_enable_content_bottom_area_container = new EdgeContainer("edgt_enable_content_bottom_area_container","edgt_enable_content_bottom_area","no",array("", "no"));
	$edgtContentBottom->addChild("edgt_enable_content_bottom_area_container",$edgt_enable_content_bottom_area_container);

		$edgt_content_bottom_background_color = new EdgeMetaField("color","edgt_content_bottom_background_color","","Background Color","Choose a color for content bottom area");
		$edgt_enable_content_bottom_area_container->addChild("edgt_content_bottom_background_color",$edgt_content_bottom_background_color);
	
		$edgt_choose_content_bottom_sidebar = new EdgeMetaField("selectblank","edgt_choose_content_bottom_sidebar","","Custom Widget","Choose Custom Widget area to display",$edgt_custom_sidebars);
		$edgt_enable_content_bottom_area_container->addChild("edgt_choose_content_bottom_sidebar",$edgt_choose_content_bottom_sidebar);
	
		$edgt_content_bottom_sidebar_in_grid = new EdgeMetaField("selectblank","edgt_content_bottom_sidebar_in_grid","","Display in Grid","Enabling this option will place Content Bottom in grid",array(
	       "no" => "No",
	       "yes" => "Yes"
	      ));
		$edgt_enable_content_bottom_area_container->addChild("edgt_content_bottom_sidebar_in_grid",$edgt_content_bottom_sidebar_in_grid);


// Side Bar Area

$edgtSideBar = new EdgeMetaBox("post", "Edge Sidebar");
$edgtFramework->edgtMetaBoxes->addMetaBox("post_side_bar",$edgtSideBar);

	$edgt_show_sidebar = new EdgeMetaField("select","edgt_show-sidebar","default","Layout","Choose the sidebar layout",array( "default" => "Default",
       "1" => "Sidebar 1/3 right",
       "2" => "Sidebar 1/4 right",
       "3" => "Sidebar 1/3 left",
       "4" => "Sidebar 1/4 left",
      ));
	$edgtSideBar->addChild("edgt_show-sidebar",$edgt_show_sidebar);

	$edgt_choose_sidebar = new EdgeMetaField("selectblank","edgt_choose-sidebar","default","Choose Widget Area in Sidebar","Choose Custom Widget area to display in Sidebar", $edgt_custom_sidebars);
	$edgtSideBar->addChild("edgt_choose-sidebar",$edgt_choose_sidebar);

// SEO

$edgtSeo = new EdgeMetaBox("post", "Edge SEO");
$edgtFramework->edgtMetaBoxes->addMetaBox("post_seo",$edgtSeo);

	$seo_title = new EdgeMetaField("text","seo_title","","SEO Title","Enter custom Title for this page");
	$edgtSeo->addChild("seo_title",$seo_title);

	$seo_keywords = new EdgeMetaField("text","seo_keywords","","SEO Keywords","Enter the list of keywords separated by commas");
	$edgtSeo->addChild("seo_keywords",$seo_keywords);

	$seo_description = new EdgeMetaField("textarea","seo_description","","SEO Description","Enter meta description for this page");
	$edgtSeo->addChild("seo_description",$seo_description);		