<?php

global $qodeIconCollections;

$qode_custom_sidebars = qode_get_custom_sidebars();

$qodeGeneral = new QodeMetaBox("post", "General");
$qodeFramework->qodeMetaBoxes->addMetaBox("post_general",$qodeGeneral);

	$qode_page_background_color = new QodeMetaField("color","qode_page_background_color","","Page Background Color","Choose the page background (body) color");
	$qodeGeneral->addChild("qode_page_background_color",$qode_page_background_color);

	$group1 = new QodeGroup("Content Style","Define styles for Content area");
	$qodeGeneral->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

			$qode_content_top_padding = new QodeMetaField("textsimple","qode_content-top-padding","","Content Top Padding (px)","This option control content top padding.");
			$row1->addChild("qode_content-top-padding",$qode_content_top_padding);

			$qode_content_top_padding_mobile = new QodeMetaField("selectblanksimple","qode_content-top-padding-mobile","","Set this top padding for mobile header","", array(
		       "no" => "No",
		       "yes" => "Yes"
		      ));
			$row1->addChild("qode_content-top-padding-mobile",$qode_content_top_padding_mobile);

	$qode_show_animation = new QodeMetaField("selectblank","qode_show-animation","","Page Transition",'Choose a type of transition between loading pages.', array(
       "no_animation" => "No Animation",
       "updown" => "Up / Down",
       "fade" => "Fade",
		"updown_fade" => "Up/Down (In) / Fade (Out)",
       "leftright" => "Left / Right"
      ), array(), "enable_grid_elements", array("yes"));
	$qodeGeneral->addChild("qode_show-animation",$qode_show_animation);

	$page_transitions_notice = new QodeNotice("Page Transition",'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', "AJAX Page transitions are disabled due to VC Grid Elements", "enable_grid_elements","no");
	$qodeGeneral->addChild("page_transitions_notice",$page_transitions_notice);

	$qode_hide_featured_image = new QodeMetaField("yesno","qode_hide-featured-image","no","Hide Feature image","Do you want to hide feature image for this post?");
	$qodeGeneral->addChild("qode_hide-featured-image",$qode_hide_featured_image);

	$qode_revolution_slider = new QodeMetaField("text","qode_revolution-slider","","Layer Slider or Select Slider Shortcode","Copy and paste your shortcode located in Select Slider -> Slider");
	$qodeGeneral->addChild("qode_revolution-slider",$qode_revolution_slider);
	
//Choose article type for blog masonry gallery template
	$qodePostType = new QodeMetaBox('post', 'Post Size', 'qode_show-page-title', array('no'));
	$qodeFramework->qodeMetaBoxes->addMetaBox('qodePostType', $qodePostType);

	$qode_blog_masonry_gallery_article_size = new QodeMetaField('select', 'qode_blog_masonry_gallery_article_size', 'square_small', 'Size', 'Choose article size in blog list for blog masonry gallery template', array(
			'square_big' => 'Square Big',
			'square_small' => 'Square Small',
			'rectangle_portrait' => 'Rectangle Portrait',
			'rectangle_landscape' => 'Rectangle Landscape'
		));

	$qodePostType->addChild('qode_blog_masonry_gallery_article_size', $qode_blog_masonry_gallery_article_size);	

// Side Menu Area

$qodeLeftMenuArea = new QodeMetaBox("post", "Side Menu Area","vertical_area",array("no"));
$qodeFramework->qodeMetaBoxes->addMetaBox("post_left_menu",$qodeLeftMenuArea);

	$qode_page_vertical_area_transparency = new QodeMetaField("selectblank","qode_page_vertical_area_transparency","","Enable transparent side menu area","Enabling this option will make Left Menu background transparent ", array(
       "no" => "No",
       "yes" => "Yes"
      ));
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_transparency",$qode_page_vertical_area_transparency);

	$qode_page_vertical_area_background = new QodeMetaField("color","qode_page_vertical_area_background","","Side Menu Area Background Color","Choose a color for Left Menu background");
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_background",$qode_page_vertical_area_background);
	
	$qode_page_vertical_area_background_opacity = new QodeMetaField("text","qode_page_vertical_area_background_opacity","","Side Menu Area Background Opacity","Choose a opacity for the Side Menu Area Background (0 = fully transparent, 1 = opaque)", array(), array("col_width" => 3));
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_background_opacity",$qode_page_vertical_area_background_opacity);

	$qode_page_vertical_area_background_image = new QodeMetaField("image","qode_page_vertical_area_background_image","","Side Menu Area Background Image","Choose an image for Left Menu background");
	$qodeLeftMenuArea->addChild("qode_page_vertical_area_background_image",$qode_page_vertical_area_background_image);

// Header

$qodeHeader = new QodeMetaBox("post", "Header","vertical_area",array("yes"));
$qodeFramework->qodeMetaBoxes->addMetaBox("post_header",$qodeHeader);

	$qode_header_style = new QodeMetaField("selectblank","qode_header-style","","Header Skin","Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style", array(
       "light" => "Light",
       "dark" => "Dark"
      ));
	$qodeHeader->addChild("qode_header-style",$qode_header_style);

    $qode_header_style_on_scroll = new QodeMetaField("selectblank","qode_header-style-on-scroll","","Enable Header Style on Scroll","Enabling this option, header will change style on scroll (depending on row settings) to make header elements (logo, main menu, side menu button) in that style", array(
        "no" => "No",
        "yes" => "Yes"
    ));
    $qodeHeader->addChild("qode_header-style-on-scroll",$qode_header_style_on_scroll);

	$qode_header_color_per_page = new QodeMetaField("color","qode_header_color_per_page","","Initial Header Background Color","Choose a background color for header area");
	$qodeHeader->addChild("qode_header_color_per_page",$qode_header_color_per_page);

	$qode_header_color_transparency_per_page = new QodeMetaField("text","qode_header_color_transparency_per_page","","Initial Header Transparency","Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)", array(), array("col_width" => 3));
	$qodeHeader->addChild("qode_header_color_transparency_per_page",$qode_header_color_transparency_per_page);

	$qode_header_bottom_border_color = new QodeMetaField("color","qode_header_bottom_border_color","","Initial Header Bottom Border Color","Choose a bottom border color for header area");
	$qodeHeader->addChild("qode_header_bottom_border_color",$qode_header_bottom_border_color);

	$qode_page_scroll_amount_for_sticky = new QodeMetaField("text","qode_page_scroll_amount_for_sticky","","Scroll amount for sticky header appearance (px)","Define scroll amount for sticky header appearance", array(), array("col_width" => 3),"header_bottom_appearance",array( "regular","fixed","fixed_hiding") );
	$qodeHeader->addChild("qode_page_scroll_amount_for_sticky",$qode_page_scroll_amount_for_sticky);
	
	$qode_page_hide_initial_sticky = new QodeMetaField("selectblank","qode_page_hide_initial_sticky","","Hide Sticky Header Initially","Enabling this option will initially hide the header, and it will only be displayed when the user scrolls down the page", array(
		"no" => "No",
		"yes" => "Yes"	
	));
	$qodeHeader->addChild("qode_page_hide_initial_sticky",$qode_page_hide_initial_sticky);
	
// Title

$qodeTitle = new QodeMetaBox("post", "Title");
$qodeFramework->qodeMetaBoxes->addMetaBox("post_title",$qodeTitle);

	$qode_show_page_title = new QodeMetaField("selectblank","qode_show-page-title","","Show Title Area","Disabling this option will turn off page title area", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#qodef_qode_page_title_area_container, #qodef-meta-box-post_title_animations"),
			"show" => array(
				""=>"#qodef_qode_page_title_area_container, #qodef-meta-box-post_title_animations",
				"yes"=>"#qodef_qode_page_title_area_container, #qodef-meta-box-post_title_animations") ));
	$qodeTitle->addChild("qode_show-page-title",$qode_show_page_title);

	$qode_page_title_area_container = new QodeContainer("qode_page_title_area_container","qode_show-page-title","no");
	$qodeTitle->addChild("qode_page_title_area_container",$qode_page_title_area_container);

	$qode_page_title_type = new QodeMetaField("selectblank","qode_page_title_type","","Title Type","Choose title type for this page.",array(
		"standard_title" => "Standard",
		"breadcrumbs_title" => "Breadcrumbs"
	),array(
      	"dependence" => true,
      	"hide" => array("breadcrumbs_title" => "#qodef_qode_title_standard_container"),
      	"show" => array("standard_title" => "#qodef_qode_title_standard_container","" => "#qodef_qode_title_standard_container")
      ));
	$qode_page_title_area_container->addChild("qode_page_title_type",$qode_page_title_type);

	$qode_animate_page_title = new QodeMetaField("selectblank","qode_animate_page_title","","Animations","Choose an animation for Title Area",array(
		"no" => "No animation",
		"text_right_left" => "Text right to left",
		"area_top_bottom" => "Title area top to bottom"
	));
	$qode_page_title_area_container->addChild("qode_animate_page_title",$qode_animate_page_title);
	
	$qode_page_page_title_vertical_aligment = new QodeMetaField("selectblank","qode_page_page_title_vertical_aligment","","Vertical Alignment","Specify Title vertical alignment", array( 
		"header_bottom" => "From Bottom of Header",
		"window_top" => "From Window Top"
	 ));
	$qode_page_title_area_container->addChild("qode_page_page_title_vertical_aligment",$qode_page_page_title_vertical_aligment);

	$qode_show_page_title_text = new QodeMetaField("selectblank","qode_show_page_title_text","","Show Title Text","Disabling this option will turn off page title text", array(
		"no" => "No",
		"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"no"=>"#qodef_qode_title_text_container, #qodef_animation_page_page_title_container"),
			"show" => array(
				""=>"#qodef_qode_title_text_container, #qodef_animation_page_page_title_container",
				"yes"=>"#qodef_qode_title_text_container, #qodef_animation_page_page_title_container") ));
	$qode_page_title_area_container->addChild("qode_show_page_title_text",$qode_show_page_title_text);

	$qode_title_text_container = new QodeContainer("qode_title_text_container","qode_show_page_title_text","no");
	$qode_page_title_area_container->addChild("qode_title_text_container",$qode_title_text_container);

	$qode_page_title_position = new QodeMetaField("selectblank","qode_page_title_position","","Title Text Alignment","Specify Title text alignment",array(
		"left" => "Left",
		"center" => "Center",
		"right" => "Right"
	));
	$qode_title_text_container->addChild("qode_page_title_position",$qode_page_title_position);

	$group1 = new QodeGroup("Title Text Style","Define styles for text in Title Area");
	$qode_title_text_container->addChild("group1",$group1);

	$row1 = new QodeRow();
	$group1->addChild("row1",$row1);

	$qode_page_title_color = new QodeMetaField("colorsimple","qode_page-title-color","","Text Color","ThisIsDescription");
	$row1->addChild("qode_page-title-color",$qode_page_title_color);

	$qode_title_text_shadow = new QodeMetaField("selectblanksimple","qode_title_text_shadow","","Text Shadow","ThisIsDescription",array(
		"no" => "No",
		"yes" => "yes"
	));
	$row1->addChild("qode_title_text_shadow",$qode_title_text_shadow);

	$qode_title_standard_container = new QodeContainer("qode_title_standard_container","qode_page_title_type","breadcrumbs_title");
	$qode_page_title_area_container->addChild("qode_title_standard_container",$qode_title_standard_container);

	$qode_title_like_separator = new QodeMetaField("selectblank","qode_title_like_separator","","Show Separator Around Title Text","Choose if you want title to look like separator with text",array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
		 	"hide" => array(
				"" => "#qodef_qode_title_like_separator_container",
				"no" => "#qodef_qode_title_like_separator_container"
			),
		    "show" => array(
				"yes" => "#qodef_qode_title_like_separator_container",
			)
		  )
		);
	$qode_title_standard_container->addChild("qode_title_like_separator",$qode_title_like_separator);

	$qode_title_like_separator_container = new QodeContainer("qode_title_like_separator_container","qode_title_like_separator","", array("", "no"));
	$qode_title_standard_container->addChild("qode_title_like_separator_container",$qode_title_like_separator_container);

		$group1 = new QodeGroup("Line Styles", "Choose style for separator line");
		$qode_title_like_separator_container->addChild("group1",$group1);

			$row1 = new QodeRow();
			$group1->addChild("row1",$row1);

				$qode_title_like_separator_line_color = new QodeMetaField("colorsimple","qode_title_like_separator_line_color","","Color","This is some description");
				$row1->addChild("qode_title_like_separator_line_color",$qode_title_like_separator_line_color);

				$qode_title_like_separator_line_width = new QodeMetaField("textsimple","qode_title_like_separator_line_width","","Width","This is some description");
				$row1->addChild("qode_title_like_separator_line_width",$qode_title_like_separator_line_width);

				$qode_title_like_separator_line_thickness = new QodeMetaField("textsimple","qode_title_like_separator_line_thickness","","Thickness","This is some description");
				$row1->addChild("qode_title_like_separator_line_thickness",$qode_title_like_separator_line_thickness);

				$qode_title_like_separator_line_style = new QodeMetaField("selectsimple","qode_title_like_separator_line_style","","Style","This is some description",array(
					"solid" => "Solid",
					"dashed" => "Dashed",
					"dotted" => "Dotted"
					));
				$row1->addChild("qode_title_like_separator_line_style",$qode_title_like_separator_line_style);

		$qode_title_like_separator_margins = new QodeMetaField("text","qode_title_like_separator_margins","","Margins for Title","Define left/right margins for title from separator");
		$qode_title_like_separator_container->addChild("qode_title_like_separator_margins",$qode_title_like_separator_margins);

		$qode_title_like_separator_line_dots = new QodeMetaField("selectblank","qode_title_like_separator_line_dots","","Dots on The End of Lines","Enabling this option will give lines a dot next to title",array(
				"no" => "No",
				"yes" => "Yes"
			),array(
				"dependence" => true,
				"hide" => array("no" => "#qodef_qode_title_like_separator_dots_container"),
				"show" => array("yes" => "#qodef_qode_title_like_separator_dots_container","" => "#qodef_qode_title_like_separator_dots_container")
			));
		$qode_title_like_separator_container->addChild("qode_title_like_separator_line_dots",$qode_title_like_separator_line_dots);

		$qode_title_like_separator_dots_container = new QodeContainer("qode_title_like_separator_dots_container","qode_title_like_separator_line_dots","no");
		$qode_title_like_separator_container->addChild("qode_title_like_separator_dots_container",$qode_title_like_separator_dots_container);

			$group1 = new QodeGroup("Dots Style","Choose style for dots");
			$qode_title_like_separator_dots_container->addChild("group1",$group1);

				$row1 = new QodeRow();
				$group1->addChild("row1",$row1);

					$qode_title_like_separator_dots_size = new QodeMetaField("textsimple","qode_title_like_separator_dots_size","","Size (px)","This is some description");
					$row1->addChild("qode_title_like_separator_dots_size",$qode_title_like_separator_dots_size);

					$qode_title_like_separator_dots_color = new QodeMetaField("colorsimple","qode_title_like_separator_dots_color","","Color","This is some description");
					$row1->addChild("qode_title_like_separator_dots_color",$qode_title_like_separator_dots_color);

	//Subtitle like separator with text
	$qode_subtitle_like_separator = new QodeMetaField("selectblank","qode_subtitle_like_separator","","Show Separator Around Subtitle Text","Choose if you want title to look like separator with text",array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
		 	"hide" => array("no" => "#qodef_qode_subtitle_like_separator_container", "" => "#qodef_qode_subtitle_like_separator_container"),
		    "show" => array("yes" => "#qodef_qode_subtitle_like_separator_container")
		  )
		);
	$qode_title_standard_container->addChild("qode_subtitle_like_separator",$qode_subtitle_like_separator);

	$qode_subtitle_like_separator_container = new QodeContainer("qode_subtitle_like_separator_container","qode_subtitle_like_separator","", array('no', ''));
	$qode_title_standard_container->addChild("qode_subtitle_like_separator_container",$qode_subtitle_like_separator_container);

		$group1 = new QodeGroup("Line Styles", "Choose style for separator line");
		$qode_subtitle_like_separator_container->addChild("group1",$group1);

			$row1 = new QodeRow();
			$group1->addChild("row1",$row1);

				$qode_subtitle_like_separator_line_color = new QodeMetaField("colorsimple","qode_subtitle_like_separator_line_color","","Color","This is some description");
				$row1->addChild("qode_subtitle_like_separator_line_color",$qode_subtitle_like_separator_line_color);

				$qode_subtitle_like_separator_line_width = new QodeMetaField("textsimple","qode_subtitle_like_separator_line_width","","Width","This is some description");
				$row1->addChild("qode_subtitle_like_separator_line_width",$qode_subtitle_like_separator_line_width);

				$qode_subtitle_like_separator_line_thickness = new QodeMetaField("textsimple","qode_subtitle_like_separator_line_thickness","","Thickness","This is some description");
				$row1->addChild("qode_subtitle_like_separator_line_thickness",$qode_subtitle_like_separator_line_thickness);

				$qode_subtitle_like_separator_line_style = new QodeMetaField("selectsimple","qode_subtitle_like_separator_line_style","","Style","This is some description",array(
					"solid" => "Solid",
					"dashed" => "Dashed",
					"dotted" => "Dotted"
					));
				$row1->addChild("qode_subtitle_like_separator_line_style",$qode_subtitle_like_separator_line_style);
	
	
	$qode_page_title_background_color = new QodeMetaField("color","qode_page-title-background-color","","Background Color","Choose background color for Title Area");
	$qode_page_title_area_container->addChild("qode_page-title-background-color",$qode_page_title_background_color);

	$qode_show_page_title_image = new QodeMetaField("yesno","qode_show-page-title-image","no","Don't Show Background Image","Enable this option to hide background image in Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_qode_background_image_container", "dependence_show_on_yes" => ""));
	$qode_page_title_area_container->addChild("qode_show-page-title-image",$qode_show_page_title_image);

	$qode_background_image_container = new QodeContainer("qode_background_image_container","qode_show-page-title-image","yes");
	$qode_page_title_area_container->addChild("qode_background_image_container",$qode_background_image_container);

	$qode_title_image = new QodeMetaField("image","qode_title-image","","Background Image","Choose a background image for Title Area");
	$qode_background_image_container->addChild("qode_title-image",$qode_title_image);

	$qode_title_overlay_image = new QodeMetaField("image","qode_title-overlay-image","","Pattern Overlay Image","Choose an image to be used as pattern over Title Area");
	$qode_background_image_container->addChild("qode_title-overlay-image",$qode_title_overlay_image);

	$qode_responsive_title_image = new QodeMetaField("selectblank","qode_responsive-title-image","","Responsive Background Image","Do you want to make Title background image responsive?", array(
			"no" => "No",
			"yes" => "Yes"),
		array("dependence" => true,
			"hide" => array(
				"yes"=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height"),
			"show" => array(
				""=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height",
				"no"=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height") ));
	$qode_background_image_container->addChild("qode_responsive-title-image",$qode_responsive_title_image);

	$qode_responsive_title_image_container = new QodeContainer("qode_responsive_title_image_container","qode_responsive-title-image","yes");
	$qode_background_image_container->addChild("qode_responsive_title_image_container",$qode_responsive_title_image_container);

	$qode_fixed_title_image = new QodeMetaField("selectblank","qode_fixed-title-image","","Parallax Background Image","Do you want background image to have parallax effect?", array(
		"no" => "No",
		"yes" => "Yes",
		"yes_zoom" => "Yes, with zoom out"
	));
	$qode_responsive_title_image_container->addChild("qode_fixed-title-image",$qode_fixed_title_image);

//Separator
			
	$qode_title_separator = new QodeMetaField("selectblank","qode_title_separator","","Show Title Separator","Enabling this option will display a separator underneath Title", array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
			"hide" => array(
				"no" => "#qodef_qode_title_separator_container",
				"" => "#qodef_qode_title_separator_container"
			),
			"show" => array(
				"yes" => "#qodef_qode_title_separator_container"
				)
		));
	$qode_title_standard_container->addChild("qode_title_separator",$qode_title_separator);

	$qode_title_separator_container = new QodeContainer("qode_title_separator_container","qode_title_separator","", array('no', ''));
	$qode_title_standard_container->addChild("qode_title_separator_container",$qode_title_separator_container);

		$qode_title_separator_format = new QodeMetaField("select","qode_title_separator_format","","Format","Choose a format (type) of separator", array(
				"" => "",
                "normal" => "Normal",
                "with_icon" => "With Icon",
                "with_custom_icon" => "With Custom Icon"
        ), array(
        "dependence" => true,
        "hide" => array(
        	"" => "#qodef_qode_separator_with_icon_container, #qodef_qode_separator_with_custom_icon_container",
        	"normal" => "#qodef_qode_separator_with_icon_container, #qodef_qode_separator_with_custom_icon_container",
        	"with_custom_icon" => "#qodef_qode_separator_with_icon_container",
        	"with_icon" => "#qodef_qode_separator_with_custom_icon_container"),
        "show" => array("with_icon" => "#qodef_qode_separator_with_icon_container", "with_custom_icon" => "#qodef_qode_separator_with_custom_icon_container" )));

        $qode_title_separator_container->addChild("qode_title_separator_format",$qode_title_separator_format);

        $qode_separator_with_icon_container = new QodeContainer("qode_separator_with_icon_container","qode_title_separator_format","normal",array("normal","with_custom_icon",""));
		$qode_title_separator_container->addChild("qode_separator_with_icon_container",$qode_separator_with_icon_container);

             //init icon pack hide and show array. It will be populated dinamically from collections array
			$separator_icon_pack_hide_array = array();
			$separator_icon_pack_show_array = array();
			$separator_icon_pack_hide_array[""] = "";

			//do we have some collection added in collections array?
			if(is_array($qodeIconCollections->iconCollections) && count($qodeIconCollections->iconCollections)) {
				//get collections params array. It will contain values of 'param' property for each collection
				$separator_icon_collections_params = $qodeIconCollections->getIconCollectionsParams();

				//foreach collection generate hide and show array
				foreach ($qodeIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
					$separator_icon_pack_hide_array[$dep_collection_key] = '';

					//we need to include only current collection in show string as it is the only one that needs to show
					$separator_icon_pack_show_array[$dep_collection_key] = '#qodef_qode_separator_icon_'.$dep_collection_object->param.'_container';
					$separator_icon_pack_hide_array[""] .= '#qodef_qode_separator_icon_'.$dep_collection_object->param.'_container,';

					//for all collections param generate hide string
					foreach ($separator_icon_collections_params as $separator_icon_collections_param) {
						//we don't need to include current one, because it needs to be shown, not hidden
						if($separator_icon_collections_param !== $dep_collection_object->param) {
							$separator_icon_pack_hide_array[$dep_collection_key].= '#qodef_qode_separator_icon_'.$separator_icon_collections_param.'_container,';
						}
					}

					//remove remaining ',' character
					$separator_icon_pack_hide_array[$dep_collection_key] = rtrim($separator_icon_pack_hide_array[$dep_collection_key], ',');

				}

				$separator_icon_pack_hide_array[""] = rtrim($separator_icon_pack_hide_array[""], ',');

			}


			$qode_separator_icon_pack = new QodeMetaField(
				"selectblank",
				"qode_separator_icon_pack",
				"",
				"Separator Icon Pack",
				"Choose icon pack for separator",
				$qodeIconCollections->getIconCollections(),
				array(
					"dependence" => true,
					"hide" => $separator_icon_pack_hide_array,
					"show" => $separator_icon_pack_show_array
				));

			$qode_separator_with_icon_container->addChild("qode_separator_icon_pack", $qode_separator_icon_pack);


			if(is_array($qodeIconCollections->iconCollections) && count($qodeIconCollections->iconCollections)) {
				//foreach icon collection we need to generate separate container that will have dependency set
				//it will have one field inside with icons dropdown
				foreach ($qodeIconCollections->iconCollections as $collection_key => $collection_object) {
					$icons_array = $collection_object->getIconsArray();

					//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
					$icon_collections_keys = $qodeIconCollections->getIconCollectionsKeys();

					//unset current one, because it doesn't have to be included in dependency that hides icon container
					unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

					$separator_icon_hide_values = $icon_collections_keys;
					$separator_icon_hide_values[] = "";
					$qode_separator_icon_container = new QodeContainer("qode_separator_icon_".$collection_object->param."_container", "qode_separator_icon_pack", "", $separator_icon_hide_values);
					$qode_separator_icon = new QodeMetaField("select", "qode_separator_icon_".$collection_object->param, "", "Separator Icon","Choose Separator Icon", $icons_array, array("col_width" => 3));
					$qode_separator_icon_container->addChild("qode_separator_icon_".$collection_object->param, $qode_separator_icon);

					$qode_separator_with_icon_container->addChild("qode_separator_icon_".$collection_object->param."_container", $qode_separator_icon_container);
				}

			}

			$group1 = new QodeGroup("Icon Style", "Choose icon style");
			$qode_separator_with_icon_container->addChild("group1",$group1);

				$row1 = new QodeRow();
				$group1->addChild("row1",$row1);

					$qode_title_separator_icon_color = new QodeMetaField("colorsimple","qode_title_separator_icon_color","","Color","Choose a color of icon for Title separator");
					$row1->addChild("qode_title_separator_icon_color",$qode_title_separator_icon_color);

					$qode_title_separator_icon_hover_color = new QodeMetaField("colorsimple","qode_title_separator_icon_hover_color","","Hover Color","Choose a hover color of icon for Title separator");
					$row1->addChild("qode_title_separator_icon_hover_color",$qode_title_separator_icon_hover_color);

					$qode_title_separator_icon_custom_size = new QodeMetaField("textsimple","qode_title_separator_icon_custom_size","","Icon Size","Choose size of icon");
					$row1->addChild("qode_title_separator_icon_custom_size",$qode_title_separator_icon_custom_size);

			$group2 = new QodeGroup("Icon Position and Margin","Choose icon position and left(right) margin");
			$qode_separator_with_icon_container->addChild("group2",$group2);

				$row1 = new QodeRow();
				$group2->addChild("row1",$row1);

					$qode_title_separator_icon_position = new QodeMetaField("selectsimple","qode_title_separator_icon_position","","Icon Position","Choose a position for an icon", array(
		                "left" => "Left",
		                "center" => "Center",
		                "right" => "Right"
		        	));
		        	$row1->addChild("qode_title_separator_icon_position",$qode_title_separator_icon_position);

		        	$qode_title_separator_icon_margins = new QodeMetaField("textsimple","qode_title_separator_icon_margins","","Margins (px)","Enter margin that will refer to left and right margin of the icon");
		        	$row1->addChild("qode_title_separator_icon_margins",$qode_title_separator_icon_margins);

        	$qode_title_separator_icon_type = new QodeMetaField("selectblank","qode_title_separator_icon_type","","Icon Type","Choose icon type", array(
                "normal" => "Normal",
                "circle" => "Circle",
                "square" => "Square"
        	),array("dependence" => true,
        		"hide" => array("normal" => "#qodef_qode_title_separator_types_container", "" => "#qodef_qode_title_separator_types_container"),
        		"show" => array("circle" => "#qodef_qode_title_separator_types_container","square" => "#qodef_qode_title_separator_types_container")));
        	$qode_separator_with_icon_container->addChild("qode_title_separator_icon_type",$qode_title_separator_icon_type);

        	$qode_title_separator_types_container = new QodeContainer("qode_title_separator_types_container","qode_title_separator_icon_type","",array("","normal"));
			$qode_separator_with_icon_container->addChild("qode_title_separator_types_container",$qode_title_separator_types_container);

				$group1 = new QodeGroup("Border Style", "Define border style for icon");
				$qode_title_separator_types_container->addChild("group1",$group1);

					$row1 = new QodeRow();
					$group1->addChild("row1",$row1);

						$qode_title_separator_icon_border_radius = new QodeMetaField("textsimple","qode_title_separator_icon_border_radius","","Border Radius (px)","Enter border radius for icon");
                		$row1->addChild("qode_title_separator_icon_border_radius",$qode_title_separator_icon_border_radius);

                		$qode_title_separator_icon_border_width = new QodeMetaField("textsimple","qode_title_separator_icon_border_width","","Border Width (px)","Enter border width for icon");
                		$row1->addChild("qode_title_separator_icon_border_width",$qode_title_separator_icon_border_width);

                		$qode_title_separator_icon_border_color = new QodeMetaField("colorsimple","qode_title_separator_icon_border_color","","Border Color","Enter border color for icon");
                		$row1->addChild("qode_title_separator_icon_border_color",$qode_title_separator_icon_border_color);

                		$qode_title_separator_icon_border_hover_color = new QodeMetaField("colorsimple","qode_title_separator_icon_border_hover_color","","Border Hover Color","Enter border color for icon");
                		$row1->addChild("qode_title_separator_icon_border_hover_color",$qode_title_separator_icon_border_hover_color);

                $group2 = new QodeGroup("Additional Icon Style","Choose adition icon styling");
                $qode_title_separator_types_container->addChild("group2",$group2);

                	$row1 = new QodeRow();
                	$group2->addChild("row1",$row1);

                		$qode_title_separator_icon_shape_size = new QodeMetaField("textsimple","qode_title_separator_icon_shape_size","","Shape Size (px)","This is some description");
                		$row1->addChild("qode_title_separator_icon_shape_size",$qode_title_separator_icon_shape_size);

                		$qode_title_separator_icon_background_color = new QodeMetaField("colorsimple","qode_title_separator_icon_background_color","","Background Color","This is some description");
                		$row1->addChild("qode_title_separator_icon_background_color",$qode_title_separator_icon_background_color);

                		$qode_title_separator_icon_background_hover_color = new QodeMetaField("colorsimple","qode_title_separator_icon_background_hover_color","","Background Hover Color","This is some description");
                		$row1->addChild("qode_title_separator_icon_background_hover_color",$qode_title_separator_icon_background_hover_color);		                		

        $qode_separator_with_custom_icon_container = new QodeContainer("qode_separator_with_custom_icon_container","qode_title_separator_format","normal",array("normal","with_icon",""));
        $qode_title_separator_container->addChild("qode_separator_with_custom_icon_container",$qode_separator_with_custom_icon_container);

        	$qode_separator_custom_icon = new QodeMetaField("image","qode_separator_custom_icon","","Custom Icon","Choose custom icon for separator");
        	$qode_separator_with_custom_icon_container->addChild("qode_separator_custom_icon",$qode_separator_custom_icon);

        $qode_title_separator_type = new QodeMetaField("select","qode_title_separator_type","","Type","Choose a Title separator line style", array( "" => "",
                "solid" => "Solid",
                "dashed" => "Dashed"
        ));
        $qode_title_separator_container->addChild("qode_title_separator_type",$qode_title_separator_type);

        $qode_title_separator_position = new QodeMetaField("select","qode_title_separator_position","","Position","Choose a Title separator position", array( "" => "",
                "above" => "Above Title",
                "below" => "Below Title"
        ));
        $qode_title_separator_container->addChild("qode_title_separator_position",$qode_title_separator_position);

        $qode_title_separator_color = new QodeMetaField("color","qode_title_separator_color","","Color","Choose a color for Title separator");
        $qode_title_separator_container->addChild("qode_title_separator_color",$qode_title_separator_color);

        $group1 = new QodeGroup("Size",'Define size for Title separator');
        $qode_title_separator_container->addChild("group1",$group1);

        $row1 = new QodeRow();
        $group1->addChild("row1",$row1);

                $qode_title_separator_thickness = new QodeMetaField("textsimple","qode_title_separator_thickness","","Thickness (px)","This is some description");
                $row1->addChild("qode_title_separator_thickness",$qode_title_separator_thickness);

                $qode_title_separator_width = new QodeMetaField("textsimple","qode_title_separator_width","","Width (px)","This is some description");
                $row1->addChild("qode_title_separator_width",$qode_title_separator_width);

        $group2 = new QodeGroup("Margin",'Add space at top and bottom of Title separator');
        $qode_title_separator_container->addChild("group2",$group2);

        $row1 = new QodeRow();
        $group2->addChild("row1",$row1);

                $qode_title_separator_topmargin = new QodeMetaField("textsimple","qode_title_separator_topmargin","","Top Margin (px)","This is some description");
                $row1->addChild("qode_title_separator_topmargin",$qode_title_separator_topmargin);

                $qode_title_separator_bottommargin = new QodeMetaField("textsimple","qode_title_separator_bottommargin","","Bottom Margin (px)","This is some description");
                $row1->addChild("qode_title_separator_bottommargin",$qode_title_separator_bottommargin);

	$qode_title_graphics = new QodeMetaField("image","qode_title-graphics","","Title Graphics","Choose a graphic for Title Area, appearing above title");
	$qode_title_standard_container->addChild("qode_title-graphics",$qode_title_graphics);
	
	$qode_title_height = new QodeMetaField("text","qode_title-height","","Title Height (px)","Set a height for Title Area in pixels", array(), array("col_width" => 3));
	$qode_page_title_area_container->addChild("qode_title-height",$qode_title_height);

	$qode_enable_breadcrumbs = new QodeMetaField("selectblank","qode_enable_breadcrumbs","","Enable Breadcrumbs","Do you want to display breadcrumbs in title area?", array(
		"no" => "No",
		"yes" => "Yes"
	), array("dependence" => true,
		"hide" => array(
			"" => "#qodef_animation_page_page_title_breadcrumbs_container",
			"no"=>"#qodef_animation_page_page_title_breadcrumbs_container"),
		"show" => array(
			"yes"=>"#qodef_animation_page_page_title_breadcrumbs_container") ));
	$qode_page_title_area_container->addChild("qode_enable_breadcrumbs",$qode_enable_breadcrumbs);

	$qode_page_breadcrumbs_color = new QodeMetaField("color","qode_page_breadcrumbs_color","","Breadcrumbs Color","Choose a color for breadcrumbs text ");
	$qode_page_title_area_container->addChild("qode_page_breadcrumbs_color",$qode_page_breadcrumbs_color);

	$qode_page_subtitle = new QodeMetaField("text","qode_page_subtitle","","Subtitle Text","Enter your subtitle text");
	$qode_page_title_area_container->addChild("qode_page_subtitle",$qode_page_subtitle);
	
	$qode_page_subtitle_position = new QodeMetaField("selectblank","qode_page_subtitle_position","","Subtitle Position","Choose a Subtitle position", array(
			"below_title" => "Below Title",
			"above_title" => "Above Title"
	));
	$qode_page_title_area_container->addChild("qode_page_subtitle_position",$qode_page_subtitle_position);

	$qode_page_subtitle_color = new QodeMetaField("color","qode_page_subtitle_color","","Subtitle Text Color","Choose a color for subtitle text");
	$qode_page_title_area_container->addChild("qode_page_subtitle_color",$qode_page_subtitle_color);

	$qode_title_content_style = new QodeGroup("Title Content Style", "Define style for title area content");
	$qode_page_title_area_container->addChild("qode_title_content_style", $qode_title_content_style);

		$row1 = new QodeRow();
		$qode_title_content_style->addChild("row1", $row1);

			$qode_title_area_content_background_color = new QodeMetaField("colorsimple","qode_title_area_content_background_color","","Title Area Content Background Color","Choose a background color for Title Area Content");
			$row1->addChild("qode_title_area_content_background_color",$qode_title_area_content_background_color);

			$qode_title_area_content_opacity = new QodeMetaField("textsimple","qode_title_area_content_opacity","","Title Area Content Background Color Opacity","Choose a transparency for the content area background color (0 = fully transparent, 1 = opaque)");
			$row1->addChild("qode_title_area_content_opacity",$qode_title_area_content_opacity);

	$qode_title_style = new QodeGroup("Title Style", "Define style for title");
	$qode_page_title_area_container->addChild("qode_title_style", $qode_title_style);

		$row1 = new QodeRow();
		$qode_title_style->addChild("row1", $row1);

			$qode_title_background_color = new QodeMetaField("colorsimple","qode_title_background_color","","Title Background Color","Choose a background color for Title");
			$row1->addChild("qode_title_background_color",$qode_title_background_color);

			$qode_title_opacity = new QodeMetaField("textsimple","qode_title_opacity","","Title Background Color Opacity","Choose a transparency for the title background color (0 = fully transparent, 1 = opaque)");
			$row1->addChild("qode_title_opacity",$qode_title_opacity);

	$title_padding_group = new QodeGroup("Padding","Define padding for title (When using separator around title, only right margin is counted for left/right margin)");
    $qode_page_title_area_container->addChild("title_padding_group",$title_padding_group);
        
        $row1 = new QodeRow(true);
        $title_padding_group->addChild("row1",$row1);

			$qode_title_top_padding = new QodeMetaField("textsimple","qode_title_top_padding","","Top Padding (px)","This is some description.");
			$row1->addChild("qode_title_top_padding",$qode_title_top_padding);	

			$qode_title_right_padding = new QodeMetaField("textsimple","qode_title_right_padding","","Right Padding (px)","This is some description.");
			$row1->addChild("qode_title_right_padding",$qode_title_right_padding);	

			$qode_title_bottom_padding = new QodeMetaField("textsimple","qode_title_bottom_padding","","Bottom Padding (px)","This is some description.");
			$row1->addChild("qode_title_bottom_padding",$qode_title_bottom_padding);	

			$qode_title_left_padding = new QodeMetaField("textsimple","qode_title_left_padding","","Left Padding (px)","This is some description.");
			$row1->addChild("qode_title_left_padding",$qode_title_left_padding);

	$qode_subtitle_style = new QodeGroup("Subtitle Style", "Define style for subtitle");
	$qode_page_title_area_container->addChild("qode_subtitle_style", $qode_subtitle_style);

		$row1 = new QodeRow();
		$qode_subtitle_style->addChild("row1", $row1);	

			$qode_subtitle_background_color = new QodeMetaField("colorsimple","qode_subtitle_background_color","","Subtitle Background Color","Choose a background color for Subtitle");
			$row1->addChild("qode_subtitle_background_color",$qode_subtitle_background_color);

			$qode_subtitle_opacity = new QodeMetaField("textsimple","qode_subtitle_opacity","","Subtitle Background Color Opacity","Choose a transparency for the subtitle background color (0 = fully transparent, 1 = opaque)");
			$row1->addChild("qode_subtitle_opacity",$qode_subtitle_opacity);

	$subtitle_padding_group = new QodeGroup("Padding","Define padding for subtitle (When using separator around subtitle, only right margin is counted for left/right margin)");
    $qode_page_title_area_container->addChild("subtitle_padding_group",$subtitle_padding_group);
        $row1 = new QodeRow(true);
        $subtitle_padding_group->addChild("row1",$row1);

			$qode_subtitle_top_padding = new QodeMetaField("textsimple","qode_subtitle_top_padding","","Top Padding (px)","This is some description.");
			$row1->addChild("qode_subtitle_top_padding",$qode_subtitle_top_padding);

			$qode_subtitle_right_padding = new QodeMetaField("textsimple","qode_subtitle_right_padding","","Right Padding (px)","This is some description.");
			$row1->addChild("qode_subtitle_right_padding",$qode_subtitle_right_padding);

			$qode_subtitle_bottom_padding = new QodeMetaField("textsimple","qode_subtitle_bottom_padding","","Bottom Padding (px)","This is some description.");
			$row1->addChild("qode_subtitle_bottom_padding",$qode_subtitle_bottom_padding);

			$qode_subtitle_left_padding = new QodeMetaField("textsimple","qode_subtitle_left_padding","","Left Padding (px)","This is some description.");
			$row1->addChild("qode_subtitle_left_padding",$qode_subtitle_left_padding);		
		

//Post Title Animations
$qodeTitleAnimations = new QodeMetaBox('post', 'Title Animations', 'qode_show-page-title', array('no'));
$qodeFramework->qodeMetaBoxes->addMetaBox('post_title_animations', $qodeTitleAnimations);

	//Whole title content animation
	$page_page_title_whole_content_animations = new QodeMetaField('selectblank', 'page_page_title_whole_content_animations', '', 'Enable Whole Title Content Animation', 'This option will enable whole title content animation', array(
		'no' => 'No',
		'yes' => 'Yes'
	),
		array(
			'dependence' => true,
			'hide' => array(
				'' => '#qodef_page_page_title_whole_content_animations_container',
				'no' => '#qodef_page_page_title_whole_content_animations_container'
			),
			'show' => array(
				'yes' => '#qodef_page_page_title_whole_content_animations_container'
			)
		));
	$qodeTitleAnimations->addChild('page_page_title_whole_content_animations', $page_page_title_whole_content_animations);

	$page_page_title_whole_content_animations_container = new QodeContainer('page_page_title_whole_content_animations_container', 'page_page_title_whole_content_animations', '', array('', 'no'));
	$qodeTitleAnimations->addChild('page_page_title_whole_content_animations_container', $page_page_title_whole_content_animations_container);

		$page_page_title_whole_content_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_whole_content_animations_container->addChild('page_page_title_whole_content_animations_data_start', $page_page_title_whole_content_animations_data_start);

			$row1 = new QodeRow();
			$page_page_title_whole_content_animations_data_start->addChild('row1', $row1);

				$page_page_title_whole_content_data_start = new QodeMetaField('textsimple', 'page_page_title_whole_content_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_page_title_whole_content_data_start', $page_page_title_whole_content_data_start);

				$page_page_title_whole_content_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_whole_content_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_page_title_whole_content_start_custom_style', $page_page_title_whole_content_start_custom_style);

		$page_page_title_whole_content_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_whole_content_animations_container->addChild('page_page_title_whole_content_animations_data_end', $page_page_title_whole_content_animations_data_end);

			$row2 = new QodeRow();
			$page_page_title_whole_content_animations_data_end->addChild('row2', $row2);

				$page_page_title_whole_content_data_end = new QodeMetaField('textsimple', 'page_page_title_whole_content_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_page_title_whole_content_data_end', $page_page_title_whole_content_data_end);

				$page_page_title_whole_content_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_whole_content_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_page_title_whole_content_end_custom_style', $page_page_title_whole_content_end_custom_style);


	//Title Animations
	$animation_page_page_title_container = new QodeContainerNoStyle('animation_page_page_title_container', 'qode_show_page_title_text', 'no');
	$qodeTitleAnimations->addChild('animation_page_page_title_container', $animation_page_page_title_container);

	$page_page_title_animations = new QodeMetaField('selectblank', 'page_page_title_animations', '', 'Enable Page Title Animations', 'This option will enable Page Title Scroll Animations',
		array(
			'no' => 'No',
			'yes' => 'Yes'
		),
		array(
			'dependence' => true,
			'hide' => array(
				'' => '#qodef_page_page_title_animations_container',
				'no' => '#qodef_page_page_title_animations_container'
			),
			'show' => array(
				'yes' => '#qodef_page_page_title_animations_container'
			) ));

	$animation_page_page_title_container->addChild('page_page_title_animations', $page_page_title_animations);

	$page_page_title_animations_container = new QodeContainer('page_page_title_animations_container', 'page_page_title_animations', '', array('', 'no'));
	$animation_page_page_title_container->addChild('page_page_title_animations_container', $page_page_title_animations_container);

		$page_page_title_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_animations_container->addChild('page_page_title_animations_data_start', $page_page_title_animations_data_start);

			$row1 = new QodeRow();
			$page_page_title_animations_data_start->addChild('row1', $row1);

				$page_page_title_data_start = new QodeMetaField('textsimple', 'page_page_title_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_page_title_data_start', $page_page_title_data_start);

				$page_page_title_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_page_title_start_custom_style', $page_page_title_start_custom_style);

		$page_page_title_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_animations_container->addChild('page_page_title_animations_data_end', $page_page_title_animations_data_end);

			$row2 = new QodeRow();
			$page_page_title_animations_data_end->addChild('row2', $row2);

				$page_page_title_data_end = new QodeMetaField('textsimple', 'page_page_title_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_page_title_data_end', $page_page_title_data_end);

				$page_page_title_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_page_title_end_custom_style', $page_page_title_end_custom_style);

	//Title Separator Animations
	$page_page_title_separator_animations = new QodeMetaField('selectblank', 'page_page_title_separator_animations', '', 'Enable Page Separator Title Animations', 'This option will enable Page Title Separator Scroll Animations',
		array(
			'no' => 'No',
			'yes' => 'Yes'
		),
		array(
			'dependence' => true,
			'hide' => array(
				'' => '#qodef_page_page_title_separator_animations_container',
				'no' => '#qodef_page_page_title_separator_animations_container'
			),
			'show' => array(
				'yes' => '#qodef_page_page_title_separator_animations_container'
			)
		));
	$qodeTitleAnimations->addChild('page_page_title_separator_animations', $page_page_title_separator_animations);

	$page_page_title_separator_animations_container = new QodeContainer('page_page_title_separator_animations_container', 'page_page_title_separator_animations', '', array('no', ''));
	$qodeTitleAnimations->addChild('page_page_title_separator_animations_container', $page_page_title_separator_animations_container);

		$page_page_title_separator_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_separator_animations_container->addChild('page_page_title_separator_animations_data_start', $page_page_title_separator_animations_data_start);

			$row1 = new QodeRow();
			$page_page_title_separator_animations_data_start->addChild('row1', $row1);

				$page_page_title_separator_data_start = new QodeMetaField('textsimple', 'page_page_title_separator_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_page_title_separator_data_start', $page_page_title_separator_data_start);

				$page_page_title_separator_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_separator_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_page_title_separator_start_custom_style', $page_page_title_separator_start_custom_style);

		$page_page_title_separator_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_separator_animations_container->addChild('page_page_title_separator_animations_data_end', $page_page_title_separator_animations_data_end);

			$row2 = new QodeRow();
			$page_page_title_separator_animations_data_end->addChild('row2', $row2);

				$page_page_title_separator_data_end = new QodeMetaField('textsimple', 'page_page_title_separator_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_page_title_separator_data_end', $page_page_title_separator_data_end);

				$page_page_title_separator_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_separator_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_page_title_separator_end_custom_style', $page_page_title_separator_end_custom_style);

	//Subtitle Animations
	$page_page_subtitle_animations = new QodeMetaField('selectblank', 'page_page_subtitle_animations', '', 'Enable Page Subtitle Animations', 'This option will enable Page Subtitle Scroll Animations',
		array(
			'no' => 'No',
			'yes' => 'Yes'
		),
		array(
			'dependence' => true,
			'hide' => array(
				'' => '#qodef_page_page_subtitle_animations_container',
				'no' => '#qodef_page_page_subtitle_animations_container'
			),
			'show' => array(
				'yes' => '#qodef_page_page_subtitle_animations_container'
			)
		));
	$qodeTitleAnimations->addChild('page_page_subtitle_animations', $page_page_subtitle_animations);

	$page_page_subtitle_animations_container = new QodeContainer('page_page_subtitle_animations_container', 'page_page_subtitle_animations', '', array('', 'no'));
	$qodeTitleAnimations->addChild('page_page_subtitle_animations_container', $page_page_subtitle_animations_container);

		$page_page_subtitle_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_subtitle_animations_container->addChild('page_page_subtitle_animations_data_start', $page_page_subtitle_animations_data_start);

			$row1 = new QodeRow();
			$page_page_subtitle_animations_data_start->addChild('row1', $row1);

				$page_page_subtitle_data_start = new QodeMetaField('textsimple', 'page_page_subtitle_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_page_subtitle_data_start', $page_page_subtitle_data_start);

				$page_page_subtitle_start_custom_style = new QodeMetaField('textareasimple', 'page_page_subtitle_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_page_subtitle_start_custom_style', $page_page_subtitle_start_custom_style);

		$page_page_subtitle_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_subtitle_animations_container->addChild('page_page_subtitle_animations_data_end', $page_page_subtitle_animations_data_end);

			$row2 = new QodeRow();
			$page_page_subtitle_animations_data_end->addChild('row2', $row2);

				$page_page_subtitle_data_end = new QodeMetaField('textsimple', 'page_page_subtitle_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_page_subtitle_data_end', $page_page_subtitle_data_end);

				$page_page_subtitle_end_custom_style = new QodeMetaField('textareasimple', 'page_page_subtitle_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_page_subtitle_end_custom_style', $page_page_subtitle_end_custom_style);

	//Graphic Animations
	$page_page_title_graphic_animations = new QodeMetaField('selectblank', 'page_page_title_graphic_animations', '', 'Enable Page Title Graphic Animations', 'This option will enable Page Title Graphic Scroll Animations',
		array(
			'no' => 'No',
			'yes' => 'Yes'
		),
		array(
			'dependence' => true,
			'hide' => array(
				'' => '#qodef_page_page_title_graphic_animations_container',
				'no' => '#qodef_page_page_title_graphic_animations_container'
			),
			'show' => array(
				'yes' => '#qodef_page_page_title_graphic_animations_container'
			)
		));
	$qodeTitleAnimations->addChild('page_page_title_graphic_animations', $page_page_title_graphic_animations);

	$page_page_title_graphic_animations_container = new QodeContainer('page_page_title_graphic_animations_container', 'page_page_title_graphic_animations', '', array('', 'no'));
	$qodeTitleAnimations->addChild('page_page_title_graphic_animations_container', $page_page_title_graphic_animations_container);

		$page_page_title_graphic_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_graphic_animations_container->addChild('page_page_title_graphic_animations_data_start', $page_page_title_graphic_animations_data_start);

			$row1 = new QodeRow();
			$page_page_title_graphic_animations_data_start->addChild('row1', $row1);

				$page_page_title_graphic_data_start = new QodeMetaField('textsimple', 'page_page_title_graphic_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_page_title_graphic_data_start', $page_page_title_graphic_data_start);

				$page_page_title_graphic_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_graphic_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_page_title_graphic_start_custom_style', $page_page_title_graphic_start_custom_style);

		$page_page_title_graphic_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_graphic_animations_container->addChild('page_page_title_graphic_animations_data_end', $page_page_title_graphic_animations_data_end);

			$row2 = new QodeRow();
			$page_page_title_graphic_animations_data_end->addChild('row2', $row2);

				$page_page_title_graphic_data_end = new QodeMetaField('textsimple', 'page_page_title_graphic_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_page_title_graphic_data_end', $page_page_title_graphic_data_end);

				$page_page_title_graphic_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_graphic_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_page_title_graphic_end_custom_style', $page_page_title_graphic_end_custom_style);

	//Breadcrumb animations
	$animation_page_page_title_breadcrumbs_container = new QodeContainerNoStyle('animation_page_page_title_breadcrumbs_container', 'qode_enable_breadcrumbs', 'no');
	$qodeTitleAnimations->addChild('animation_page_page_title_breadcrumbs_container', $animation_page_page_title_breadcrumbs_container);

	$page_page_title_breadcrumbs_animations = new QodeMetaField('selectblank', 'page_page_title_breadcrumbs_animations', '', 'Enable Page Title Breadcrumbs Animations', 'This option will enable Page Title Breadcrumbs Scroll Animations',
		array(
			'no' => 'No',
			'yes' => 'Yes'
		),
		array(
			'dependence' => true,
			'hide' => array(
				'' => '#qodef_page_page_title_breadcrumbs_animations_container',
				'no' => '#qodef_page_page_title_breadcrumbs_animations_container'
			),
			'show' => array(
				'yes' => '#qodef_page_page_title_breadcrumbs_animations_container'
			)
		));
	$animation_page_page_title_breadcrumbs_container->addChild('page_page_title_breadcrumbs_animations', $page_page_title_breadcrumbs_animations);

	$page_page_title_breadcrumbs_animations_container = new QodeContainer('page_page_title_breadcrumbs_animations_container', 'page_page_title_breadcrumbs_animations', '', array('', 'no'));
	$animation_page_page_title_breadcrumbs_container->addChild('page_page_title_breadcrumbs_animations_container', $page_page_title_breadcrumbs_animations_container);

		$page_page_title_breadcrumbs_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_breadcrumbs_animations_container->addChild('page_page_title_breadcrumbs_animations_data_start', $page_page_title_breadcrumbs_animations_data_start);

			$row1 = new QodeRow();
			$page_page_title_breadcrumbs_animations_data_start->addChild('row1', $row1);

				$page_page_title_breadcrumbs_data_start = new QodeMetaField('textsimple', 'page_page_title_breadcrumbs_data_start', '', 'Scrollbar Top Distance (px)');
				$row1->addChild('page_page_title_breadcrumbs_data_start', $page_page_title_breadcrumbs_data_start);

				$page_page_title_breadcrumbs_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_breadcrumbs_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row1->addChild('page_page_title_breadcrumbs_start_custom_style', $page_page_title_breadcrumbs_start_custom_style);

		$page_page_title_breadcrumbs_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_breadcrumbs_animations_container->addChild('page_page_title_breadcrumbs_animations_data_end', $page_page_title_breadcrumbs_animations_data_end);

			$row2 = new QodeRow();
			$page_page_title_breadcrumbs_animations_data_end->addChild('row2', $row2);

				$page_page_title_breadcrumbs_data_end = new QodeMetaField('textsimple', 'page_page_title_breadcrumbs_data_end', '', 'Scrollbar Top Distance (px)');
				$row2->addChild('page_page_title_breadcrumbs_data_end', $page_page_title_breadcrumbs_data_end);

				$page_page_title_breadcrumbs_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_breadcrumbs_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
				$row2->addChild('page_page_title_breadcrumbs_end_custom_style', $page_page_title_breadcrumbs_end_custom_style);


// Content Bottom

$qodeContentBottom = new QodeMetaBox("post", "Content Bottom");
$qodeFramework->qodeMetaBoxes->addMetaBox("post_content_bottom_page",$qodeContentBottom);

	$qode_enable_content_bottom_area = new QodeMetaField("selectblank","qode_enable_content_bottom_area","","Show Content Bottom Area","Do you want to show content bottom area?", array(
       "no" => "No",
       "yes" => "Yes"
      ),
      array("dependence" => true,
      	"hide" => array(
      		"no"=>"#qodef_qode_enable_content_bottom_area_container",
			""=>"#qodef_qode_enable_content_bottom_area_container"),
      	"show" => array(
      		"yes"=>"#qodef_qode_enable_content_bottom_area_container") ));
	$qodeContentBottom->addChild("qode_enable_content_bottom_area",$qode_enable_content_bottom_area);
	
	$qode_enable_content_bottom_area_container = new QodeContainer("qode_enable_content_bottom_area_container","qode_enable_content_bottom_area","no",array("", "no"));
	$qodeContentBottom->addChild("qode_enable_content_bottom_area_container",$qode_enable_content_bottom_area_container);

		$qode_content_bottom_background_color = new QodeMetaField("color","qode_content_bottom_background_color","","Background Color","Choose a color for content bottom area");
		$qode_enable_content_bottom_area_container->addChild("qode_content_bottom_background_color",$qode_content_bottom_background_color);
	
		$qode_choose_content_bottom_sidebar = new QodeMetaField("selectblank","qode_choose_content_bottom_sidebar","","Custom Widget","Choose Custom Widget area to display",$qode_custom_sidebars);
		$qode_enable_content_bottom_area_container->addChild("qode_choose_content_bottom_sidebar",$qode_choose_content_bottom_sidebar);
	
		$qode_content_bottom_sidebar_in_grid = new QodeMetaField("selectblank","qode_content_bottom_sidebar_in_grid","","Display in Grid","Enabling this option will place Content Bottom in grid",array(
	       "no" => "No",
	       "yes" => "Yes"
	      ));
		$qode_enable_content_bottom_area_container->addChild("qode_content_bottom_sidebar_in_grid",$qode_content_bottom_sidebar_in_grid);


// Side Bar Area

$qodeSideBar = new QodeMetaBox("post", "Sidebar");
$qodeFramework->qodeMetaBoxes->addMetaBox("post_side_bar",$qodeSideBar);

	$qode_show_sidebar = new QodeMetaField("select","qode_show-sidebar","default","Layout","Choose the sidebar layout",array( "default" => "Default",
       "1" => "Sidebar 1/3 right",
       "2" => "Sidebar 1/4 right",
       "3" => "Sidebar 1/3 left",
       "4" => "Sidebar 1/4 left",
      ));
	$qodeSideBar->addChild("qode_show-sidebar",$qode_show_sidebar);

	$qode_choose_sidebar = new QodeMetaField("selectblank","qode_choose-sidebar","default","Choose Widget Area in Sidebar","Choose Custom Widget area to display in Sidebar", $qode_custom_sidebars);
	$qodeSideBar->addChild("qode_choose-sidebar",$qode_choose_sidebar);

// Footer

$qodeFooter = new QodeMetaBox("post", "Footer");
$qodeFramework->qodeMetaBoxes->addMetaBox("post_footer",$qodeFooter);

    $qode_footer_disable = new QodeMetaField("yesno","qode_footer-disable","no","Disable Footer for this Page",
        "Enabling this option will hide footer on your page");
    $qodeFooter->addChild("qode_footer-disable",$qode_footer_disable);


// SEO

$qodeSeo = new QodeMetaBox("post", "SEO");
$qodeFramework->qodeMetaBoxes->addMetaBox("post_seo",$qodeSeo);

	$seo_title = new QodeMetaField("text","seo_title","","SEO Title","Enter custom Title for this page");
	$qodeSeo->addChild("seo_title",$seo_title);

	$seo_keywords = new QodeMetaField("text","seo_keywords","","SEO Keywords","Enter the list of keywords separated by commas");
	$qodeSeo->addChild("seo_keywords",$seo_keywords);

	$seo_description = new QodeMetaField("textarea","seo_description","","SEO Description","Enter meta description for this page");
	$qodeSeo->addChild("seo_description",$seo_description);

// Link Post Format

$qodeLinkPostFormat = new QodeMetaBox("post", "Link Post Format");
$qodeFramework->qodeMetaBoxes->addMetaBox("post-format-link",$qodeLinkPostFormat);

$title_link = new QodeMetaField("text","title_link","","Link","Enter link");
$qodeLinkPostFormat->addChild("title_link",$title_link);

// Quote Post Format

$qodeQuotePostFormat = new QodeMetaBox("post", "Quote Post Format");
$qodeFramework->qodeMetaBoxes->addMetaBox("post-format-quote",$qodeQuotePostFormat);

$quote_format = new QodeMetaField("text","quote_format","","Quote","Enter Quote");
$qodeQuotePostFormat->addChild("quote_format",$quote_format);

// Audio Post Format

$qodeAudioPostFormat = new QodeMetaBox("post", "Audio Post Format");
$qodeFramework->qodeMetaBoxes->addMetaBox("post-format-audio",$qodeAudioPostFormat);

$audio_link = new QodeMetaField("text","audio_link","","Link","Enter audion link");
$qodeAudioPostFormat->addChild("audio_link",$audio_link);

// Video Post Format

$qodeVideoPostFormat = new QodeMetaBox("post", "Video Post Format");
$qodeFramework->qodeMetaBoxes->addMetaBox("post-format-video",$qodeVideoPostFormat);


$video_format_choose = new QodeMetaField("select","video_format_choose","youtube","Video Type","Choose video type",array(
	"youtube" => "Youtube",
	"vimeo" => "Vimeo",
	"self" => "Self Hosted"
),array(
	"dependence" => true,
	"hide" => array("youtube" => "#qodef_video_self_hosted_container", "vimeo" => "#qodef_video_self_hosted_container", "self" => "#qodef_video_y_and_v_container"),
	"show" => array("youtube" => "#qodef_video_y_and_v_container", "vimeo" => "#qodef_video_y_and_v_container", "self" => "#qodef_video_self_hosted_container")
));
$qodeVideoPostFormat->addChild("video_format_choose",$video_format_choose);

$video_y_and_v_container = new QodeContainer("video_y_and_v_container","video_format_choose","self");
$qodeVideoPostFormat->addChild("video_y_and_v_container",$video_y_and_v_container);

$video_self_hosted_container = new QodeContainer("video_self_hosted_container","video_format_choose","", array("youtube", "vimeo"));
$qodeVideoPostFormat->addChild("video_self_hosted_container",$video_self_hosted_container);

$video_format_link = new QodeMetaField("text","video_format_link","","Video ID","Enter Video ID");
$video_y_and_v_container->addChild("video_format_link",$video_format_link);

$video_format_image = new QodeMetaField("image","video_format_image","","Video Image","Upload video image");
$video_self_hosted_container->addChild("video_format_image",$video_format_image);

$video_format_webm = new QodeMetaField("text","video_format_webm","","Video webm","Enter video URL");
$video_self_hosted_container->addChild("video_format_webm",$video_format_webm);

$video_format_mp4 = new QodeMetaField("text","video_format_mp4","","Video mp4","Enter video URL");
$video_self_hosted_container->addChild("video_format_mp4",$video_format_mp4);

$video_format_ogv = new QodeMetaField("text","video_format_ogv","","Video ogv","Enter video URL");
$video_self_hosted_container->addChild("video_format_ogv",$video_format_ogv);