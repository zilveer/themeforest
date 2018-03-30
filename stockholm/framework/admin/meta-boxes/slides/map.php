<?php
$qode_custom_sidebars = array();
foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
	if(isUserMadeSidebar(ucwords($sidebar['name']))){
		$qode_custom_sidebars[$sidebar['id']] = ucwords( $sidebar['name']);
	}
}


$qode_blog_categories = array();
$categories = get_categories(); 
foreach($categories as $category) {
	$qode_blog_categories[$category->term_id] = $category->name;
}

//Select Slide Type

$qodeSlideType = new QodeMetaBox("slides", "Select Slide Type", "slide-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_type",$qodeSlideType);

	$qode_slide_background_type = new QodeMetaField("imagevideo","qode_slide-background-type","image","Slide Background Type","Do you want to upload an image or video?", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef-meta-box-slides_video_settings", "dependence_show_on_yes" => "#qodef-meta-box-slides_image_settings"));
	$qodeSlideType->addChild("qode_slide-background-type",$qode_slide_background_type);

//Select Slide Image

$qodeSlideImageSettings = new QodeMetaBox("slides", "Select Slide Image", "slide-image-meta","qode_slide-background-type",array("video"));
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_image_settings",$qodeSlideImageSettings);

	$qode_slide_image = new QodeMetaField("image","qode_slide-image","","Slide Image","Choose background image");
	$qodeSlideImageSettings->addChild("qode_title-image",$qode_slide_image);
	
	$qode_slide_overlay_image = new QodeMetaField("image","qode_slide-overlay-image","","Overlay Image","Choose overlay image (pattern) for background image");
	$qodeSlideImageSettings->addChild("qode_slide-overlay-image",$qode_slide_overlay_image);

//Select Slide Video

$qodeSlideVideoSettings = new QodeMetaBox("slides", "Select Slide Video", "slide-video-meta","qode_slide-background-type",array("image"));
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_video_settings",$qodeSlideVideoSettings);

	$qode_slide_video_webm = new QodeMetaField("text","qode_slide-video-webm","","Video - webm","Path to the webm file that you have previously uploaded in Media Section");
	$qodeSlideVideoSettings->addChild("qode_slide-video-webm",$qode_slide_video_webm);
	
	$qode_slide_video_mp4 = new QodeMetaField("text","qode_slide-video-mp4","","Video - mp4","Path to the mp4 file that you have previously uploaded in Media Section");
	$qodeSlideVideoSettings->addChild("qode_slide-video-mp4",$qode_slide_video_mp4);
	
	$qode_slide_video_ogv = new QodeMetaField("text","qode_slide-video-ogv","","Video - ogv","Path to the ogv file that you have previously uploaded in Media Section");
	$qodeSlideVideoSettings->addChild("qode_slide-video-ogv",$qode_slide_video_ogv);

	$qode_slide_video_image = new QodeMetaField("image","qode_slide-video-image","","Video Preview Image","Choose background image that will be visible until video is loaded. This image will be shown on touch devices too.");
	$qodeSlideVideoSettings->addChild("qode_slide-video-image",$qode_slide_video_image);
	
	$qode_slide_video_overlay = new QodeMetaField("yesempty","qode_slide-video-overlay","","Video Overlay Image","Do you want to have a overlay image on video? ", array(),
			array("dependence" => true,
			"dependence_hide_on_yes" => "",
			"dependence_show_on_yes" => "#qodef_qode_slide-video-overlay_container"));
	$qodeSlideVideoSettings->addChild("qode_slide-video-overlay",$qode_slide_video_overlay);
	
	$qode_slide_video_overlay_container = new QodeContainer("qode_slide-video-overlay_container","qode_slide-video-overlay","");
	$qodeSlideVideoSettings->addChild("qode_slide_video_overlay_container",$qode_slide_video_overlay_container);
	
		$qode_slide_video_overlay_image = new QodeMetaField("image","qode_slide-video-overlay-image","","Overlay Image","Choose overlay image (pattern) for background video");
		$qode_slide_video_overlay_container->addChild("qode_slide-video-overlay-image",$qode_slide_video_overlay_image);

//Select Slide General

$qodeSlideGeneral = new QodeMetaBox("slides", "Select Slide General", "slide-general-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_layout",$qodeSlideGeneral);
	
	$qode_slide_header_style = new QodeMetaField("selectblank","qode_slide-header-style","","Header Style","Header style will be applied when this slide is in focus", array(
	    "light" => "Light",
	    "dark" => "Dark"
	));
	$qodeSlideGeneral->addChild("qode_slide-header-style",$qode_slide_header_style);
	
	$qode_slide_navigation_color = new QodeMetaField("color","qode_slide-navigation-color","","Navigation Color","Navigation color will be applied when this slide is in focus");
	$qodeSlideGeneral->addChild("qode_slide-navigation-color",$qode_slide_navigation_color);
	
	$qode_slide_scroll_to_section = new QodeMetaField("text","qode_slide-anchor-button","","Scroll to Section","An arrow will appear to take viewers to the next section of the page. Enter the section anchor here, for example, '#contact'");
	$qodeSlideGeneral->addChild("qode_slide-anchor-button",$qode_slide_scroll_to_section);

	$qode_slide_hide_title = new QodeMetaField("yesempty","qode_slide-hide-title","","Hide Slide Title","Do you want to hide slide title?", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef-meta-box-slides_title", "dependence_show_on_yes" => ""));
	$qodeSlideGeneral->addChild("qode_slide-hide-title",$qode_slide_hide_title);

    $qode_slide_hide_shadow = new QodeMetaField("yesempty","qode_slide-hide-shadow","","Show Slide Text Shadow","Do you want to show text shadow?");
    $qodeSlideGeneral->addChild("qode_slide-hide-shadow",$qode_slide_hide_shadow);

    $qode_slide_content_fading_out = new QodeMetaField("select","qode_slide-contnet-fading-out","on","Slide Content Fading-Out","Disabling this option will turn off parallax effect and fading-out on scrolling.", array(
		"fading_out_on" => "On",
    	"fading_out_off" => "Off"
	));
	$qodeSlideGeneral->addChild("qode_slide-contnet-fading-out",$qode_slide_content_fading_out);

    $qode_slide_thumbnail_animation = new QodeMetaField("select","qode_slide-thumbnail-animation","flip","Graphic Animation","This is how the graphic will enter the slide", array(
        "flip" => "Flip",
        "fade" => "Fade",
        "without_animation"	=>	"Without Animation"
    ));
    $qodeSlideGeneral->addChild("qode_slide-thumbnail-animation",$qode_slide_thumbnail_animation);

    $qode_slide_content_animation = new QodeMetaField("select","qode_slide-content-animation","all_at_once","Content Animation","This is how content (title, subtitle, text and buttons) will enter the slide", array(
        "all_at_once" => "All At Once",
        "one_by_one" => "One By One",
        "without_animation"	=>	"Without Animation"
    ));
    $qodeSlideGeneral->addChild("qode_slide-content-animation",$qode_slide_content_animation);

//Select Slide Title

$qodeSlideTitle = new QodeMetaBox("slides", "Select Slide Title", "slide-title-meta","qode_slide-hide-title",array("yes"));
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_title",$qodeSlideTitle);

	$title_group = new QodeGroup("Title Style","Define styles for title");
	$qodeSlideTitle->addChild("title_group",$title_group);
	    $row1 = new QodeRow();
	    $title_group->addChild("row1",$row1);
		    $title_color = new QodeMetaField("colorsimple","qode_slide-title-color","","Font Color","This is some description");
		    $row1->addChild("qode_slide-title-color",$title_color);
		    $title_fontsize = new QodeMetaField("textsimple","qode_slide-title-font-size","","Font Size (px)","This is some description");
		    $row1->addChild("qode_slide-title-font-size",$title_fontsize);
		    $title_lineheight = new QodeMetaField("textsimple","qode_slide-title-line-height","","Line Height (px)","This is some description");
		    $row1->addChild("qode_slide-title-line-height",$title_lineheight);
		    $title_letterspacing = new QodeMetaField("textsimple","qode_slide-title-letter-spacing","","Letter Spacing (px)","This is some description");
		    $row1->addChild("qode_slide-title-letter-spacing",$title_letterspacing);
	
	    $row2 = new QodeRow(true);
	    $title_group->addChild("row2",$row2);
		    $title_google_fonts = new QodeMetaField("Fontsimple","qode_slide-title-font-family","","Font Family","This is some description");
		    $row2->addChild("qode_slide-title-font-family",$title_google_fonts);
		    $title_fontstyle = new QodeMetaField("selectblanksimple","qode_slide-title-font-style","","Font Style","This is some description",$options_fontstyle);
		    $row2->addChild("qode_slide-title-font-style",$title_fontstyle);
		    $title_fontweight = new QodeMetaField("selectblanksimple","qode_slide-title-font-weight","","Font Weight","This is some description",$options_fontweight);
		    $row2->addChild("qode_slide-title-font-weight",$title_fontweight);
		    $title_texttransform = new QodeMetaField("selectblanksimple","qode_slide-title-text-transform","","Text Transform","This is some description",$options_texttransform);
		    $row2->addChild("qode_slide-title-text-transform",$title_texttransform);

		$row3 = new QodeRow(true);
		$title_group->addChild("row3",$row3);
			$title_bottom_margin = new QodeMetaField("textsimple","qode_slide-title-bottom-margin","","Bottom Margin","This is some description");
			$row3->addChild("qode_slide-title-bottom-margin",$title_bottom_margin);
			$title_background_color = new QodeMetaField("colorsimple","qode_slide-title-background-color","","Background Color","This is some description");
			$row3->addChild("qode_slide-title-background-color",$title_background_color);
			$title_background_opacity = new QodeMetaField("textsimple","qode_slide-title-background-opacity","","Background Opacity (0-1)","This is some description");
			$row3->addChild("qode_slide-title-background-opacity",$title_background_opacity);


//Select Slide Subtitle

$qodeSlideSubtitle = new QodeMetaBox("slides", "Select Slide Subtitle", "slide-subtitle-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_subtitle",$qodeSlideSubtitle);

	$qode_slide_subtitle = new QodeMetaField("text","qode_slide-subtitle","","Slide Subtitle","Enter slide subtitle");
	$qodeSlideSubtitle->addChild("qode_slide-subtitle",$qode_slide_subtitle);
	
	$subtitle_group = new QodeGroup("Subtitle Style","Define styles for subtitle");
	$qodeSlideSubtitle->addChild("subtitle_group",$subtitle_group);
	    $row1 = new QodeRow();
	    $subtitle_group->addChild("row1",$row1);
		    $subtitle_color = new QodeMetaField("colorsimple","qode_slide-subtitle-color","","Font Color","This is some description");
		    $row1->addChild("qode_slide-subtitle-color",$subtitle_color);
		    $subtitle_fontsize = new QodeMetaField("textsimple","qode_slide-subtitle-font-size","","Font Size (px)","This is some description");
		    $row1->addChild("qode_slide-subtitle-font-size",$subtitle_fontsize);
		    $subtitle_lineheight = new QodeMetaField("textsimple","qode_slide-subtitle-line-height","","Line Height (px)","This is some description");
		    $row1->addChild("qode_slide-subtitle-line-height",$subtitle_lineheight);
		    $subtitle_letterspacing = new QodeMetaField("textsimple","qode_slide-subtitle-letter-spacing","","Letter Spacing (px)","This is some description");
		    $row1->addChild("qode_slide-subtitle-letter-spacing",$subtitle_letterspacing);
	
	    $row2 = new QodeRow(true);
	    $subtitle_group->addChild("row2",$row2);
		    $subtitle_google_fonts = new QodeMetaField("Fontsimple","qode_slide-subtitle-font-family","","Font Family","This is some description");
		    $row2->addChild("qode_slide-subtitle-font-family",$subtitle_google_fonts);
		    $subtitle_fontstyle = new QodeMetaField("selectblanksimple","qode_slide-subtitle-font-style","","Font Style","This is some description",$options_fontstyle);
		    $row2->addChild("qode_slide-subtitle-font-style",$subtitle_fontstyle);
		    $subtitle_fontweight = new QodeMetaField("selectblanksimple","qode_slide-subtitle-font-weight","","Font Weight","This is some description",$options_fontweight);
		    $row2->addChild("qode_slide-subtitle-font-weight",$subtitle_fontweight);
		    $subtitle_transform = new QodeMetaField("selectblanksimple","qode_slide-subtitle-text-transform","","Text Transform","This is some description",$options_texttransform);
			$row2->addChild("qode_slide-subtitle-text-transform",$subtitle_transform);

		$row3 = new QodeRow(true);
		$subtitle_group->addChild("row3",$row3);
			$subtitle_bottom_margin = new QodeMetaField("textsimple","qode_slide-subtitle-bottom-margin","","Bottom Margin","This is some description");
			$row3->addChild("qode_slide-subtitle-bottom-margin",$subtitle_bottom_margin);

//Select Slide Text

$qodeSlideText = new QodeMetaBox("slides", "Select Slide Text", "slide-text-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_text",$qodeSlideText);

	$qode_slide_text = new QodeMetaField("textarea","qode_slide-text","","Slide Text","Enter slide text");
	$qodeSlideText->addChild("qode_slide-text",$qode_slide_text);

    $text_group = new QodeGroup("Text Style","Define styles for text");
    $qodeSlideText->addChild("title_group",$text_group);
    $row1 = new QodeRow();
    $text_group->addChild("row1",$row1);
        $text_color = new QodeMetaField("colorsimple","qode_slide-text-color","","Font Color","This is some description");
        $row1->addChild("qode_slide-text-color",$text_color);
        $text_fontsize = new QodeMetaField("textsimple","qode_slide-text-font-size","","Font Size (px)","This is some description");
        $row1->addChild("qode_slide-text-font-size",$text_fontsize);
        $text_lineheight = new QodeMetaField("textsimple","qode_slide-text-line-height","","Line Height (px)","This is some description");
        $row1->addChild("qode_slide-text-line-height",$text_lineheight);
        $text_letterspacing = new QodeMetaField("textsimple","qode_slide-text-letter-spacing","","Letter Spacing (px)","This is some description");
	    $row1->addChild("qode_slide-text-letter-spacing",$text_letterspacing);

    $row2 = new QodeRow(true);
    $text_group->addChild("row2",$row2);
        $text_google_fonts = new QodeMetaField("Fontsimple","qode_slide-text-font-family","","Font Family","This is some description");
        $row2->addChild("qode_slide-text-font-family",$text_google_fonts);
        $text_fontstyle = new QodeMetaField("selectblanksimple","qode_slide-text-font-style","","Font Style","This is some description",$options_fontstyle);
        $row2->addChild("qode_slide-text-font-style",$text_fontstyle);
        $text_fontweight = new QodeMetaField("selectblanksimple","qode_slide-text-font-weight","","Font Weight","This is some description",$options_fontweight);
        $row2->addChild("qode_slide-text-font-weight",$text_fontweight);
        $text_transform = new QodeMetaField("selectblanksimple","qode_slide-text-text-transform","","Text Transform","This is some description",$options_texttransform);
		$row2->addChild("qode_slide-text-text-transform",$text_transform);

	$row3 = new QodeRow(true);
	$text_group->addChild("row3",$row3);
		$text_bottom_margin = new QodeMetaField("textsimple","qode_slide-text-bottom-margin","","Bottom Margin","This is some description");
		$row3->addChild("qode_slide-text-bottom-margin",$text_bottom_margin);

//Select Slide Graphic

$qodeSlideGraphic = new QodeMetaBox("slides", "Select Slide Graphic", "slide-graphic-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_graphic",$qodeSlideGraphic);

	$qode_slide_graphic = new QodeMetaField("image","qode_slide-thumbnail","","Slide Graphic","Choose slide graphic");
	$qodeSlideGraphic->addChild("qode_slide-thumbnail",$qode_slide_graphic);
	
	$qode_slide_graphic_link = new QodeMetaField("text","qode_slide-thumbnail-link","","Link","Past link for slide graphic if you want to link it");
	$qodeSlideGraphic->addChild("qode_slide-thumbnail-link",$qode_slide_graphic_link);

//Select Slide Buttons

$qodeSlideButtons = new QodeMetaBox("slides", "Select Slide Buttons", "slide-button-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_buttons",$qodeSlideButtons);

	$button1_group = new QodeGroup("Button 1","");
	$qodeSlideButtons->addChild("button1_group",$button1_group);
	    $row1 = new QodeRow();
	    $button1_group->addChild("row1",$row1);
		    $button1_label = new QodeMetaField("textsimple","qode_slide-button-label","","Label","This is some description");
		    $row1->addChild("qode_slide-button-label",$button1_label);
		    $button1_link = new QodeMetaField("textsimple","qode_slide-button-link","","Link","This is some description");
		    $row1->addChild("qode_slide-button-link",$button1_link);
		    $button1_target = new QodeMetaField("selectsimple","qode_slide-button-target","_self","Target","This is some description", array(
			    "_self" => "Self",
			    "_blank" => "Blank"
			));
		    $row1->addChild("qode_slide-button-target",$button1_target);
	
	$button2_group = new QodeGroup("Button 2","");
	$qodeSlideButtons->addChild("button2_group",$button2_group);
	    $row1 = new QodeRow();
	    $button2_group->addChild("row1",$row1);
		    $button2_label = new QodeMetaField("textsimple","qode_slide-button-label2","","Label","This is some description");
		    $row1->addChild("qode_slide-button-label2",$button2_label);
		    $button2_link = new QodeMetaField("textsimple","qode_slide-button-link2","","Link","This is some description");
		    $row1->addChild("qode_slide-button-link2",$button2_link);
		    $button2_target = new QodeMetaField("selectsimple","qode_slide-button-target2","_self","Target","This is some description", array(
			    "_self" => "Self",
			    "_blank" => "Blank"
			));
		    $row1->addChild("qode_slide-button-target2",$button2_target);

//Select Slide Content Positioning

$qodeSlideContentPositioning = new QodeMetaBox("slides", "Select Slide Content Positioning", "slide-positioning-meta");
$qodeFramework->qodeMetaBoxes->addMetaBox("slides_content_positioning",$qodeSlideContentPositioning);

	$qode_slide_graphic_alignment = new QodeMetaField("selectblank","qode_slide-graphic-alignment","","Graphic Alignment","Choose an alignment for the slide graphic", array(
	    "left" => "Left",
	    "center" => "Center",
	    "right" => "Right"
	));
	$qodeSlideContentPositioning->addChild("qode_slide-graphic-alignment",$qode_slide_graphic_alignment);
	
	$qode_slide_text_alignment = new QodeMetaField("selectblank","qode_slide-content-alignment","","Text Alignment","Choose an alignment for the slide text", array(
	    "left" => "Left",
	    "center" => "Center",
	    "right" => "Right"
	));
	$qodeSlideContentPositioning->addChild("qode_slide-content-alignment",$qode_slide_text_alignment);

    $qode_slide_vertical_alignment = new QodeMetaField("yesno","qode_slide-vertical-alignment","no","Vertical alignment","Do you want to vertically center content?", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_qode_slide-vertical-alignment_container", "dependence_show_on_yes" => ""));
    $qodeSlideContentPositioning->addChild("qode_slide-vertical-alignment",$qode_slide_vertical_alignment);

    $qode_slide_vertical_alignment_container = new QodeContainer("qode_slide-vertical-alignment_container","qode_slide-vertical-alignment","yes");
    $qodeSlideContentPositioning->addChild("qode_slide-vertical-alignment_container",$qode_slide_vertical_alignment_container);

	$qode_slide_separate_text_graphic = new QodeMetaField("selectblank","qode_slide-separate-text-graphic","no","Separate Graphic and Text Positioning","Do you want to separately position graphic and text?", array(
	    "no" => "No",
	    "yes" => "Yes"
	), array("dependence" => true,
	         "hide" => array(
	            "" => "#qodef_qode_slide_graphic_positioning_container",
	            "no" => "#qodef_qode_slide_graphic_positioning_container"
	         ),
	         "show" => array(
	             "yes" => "#qodef_qode_slide_graphic_positioning_container"
	         )));
    $qode_slide_vertical_alignment_container->addChild("qode_slide-separate-text-graphic",$qode_slide_separate_text_graphic);

    $qode_slide_bottom_right_alignment = new QodeMetaField("yesno","qode_slide-bottom-right-alignment","no","Set Content To Bottom Right","Enabling this option you will set content position to the bottom right corner.");
	$qode_slide_vertical_alignment_container->addChild("qode_slide-bottom-right-alignment",$qode_slide_bottom_right_alignment);

	$content_positioning_group = new QodeGroup("Content Positioning","Positioning for slide title, subtitle, text and buttons (and graphic if positioning is not separated) ");
    $qode_slide_vertical_alignment_container->addChild("content_positioning_group",$content_positioning_group);
	    $row1 = new QodeRow();
	    $content_positioning_group->addChild("row1",$row1);
		    $qode_slide_content_width = new QodeMetaField("textsimple","qode_slide-content-width","","Width (%)","This is some description");
		    $row1->addChild("qode_slide-content-width",$qode_slide_content_width);
	
	    $row2 = new QodeRow(true);
	    $content_positioning_group->addChild("row2",$row2);
		    $qode_slide_content_top = new QodeMetaField("textsimple","qode_slide-content-top","","Content from top (%)","This is some description");
		    $row2->addChild("qode_slide-content-top",$qode_slide_content_top);
		    $qode_slide_content_left = new QodeMetaField("textsimple","qode_slide-content-left","","Content from left (%)","This is some description");
		    $row2->addChild("qode_slide-content-left",$qode_slide_content_left);
	
	    $row3 = new QodeRow(true);
	    $content_positioning_group->addChild("row3",$row3);
		    $qode_slide_content_bottom = new QodeMetaField("textsimple","qode_slide-content-bottom","","Content from bototm (%)","This is some description");
		    $row3->addChild("qode_slide-content-bottom",$qode_slide_content_bottom);
		    $qode_slide_content_right = new QodeMetaField("textsimple","qode_slide-content-right","","Content from right (%)","This is some description");
		    $row3->addChild("qode_slide-content-right",$qode_slide_content_right);

	$qode_slide_graphic_positioning_container = new QodeContainer("qode_slide_graphic_positioning_container","qode_slide-separate-text-graphic","no");
    $qode_slide_vertical_alignment_container->addChild("qode_slide_graphic_positioning_container",$qode_slide_graphic_positioning_container);

	$graphic_positioning_group = new QodeGroup("Graphic Positioning","Positioning for slide graphic");
	$qode_slide_graphic_positioning_container->addChild("graphic_positioning_group",$graphic_positioning_group);
	    $row1 = new QodeRow();
	    $graphic_positioning_group->addChild("row1",$row1);
		    $qode_slide_content_width = new QodeMetaField("textsimple","qode_slide-graphic-width","","Width (%)","This is some description");
		    $row1->addChild("qode_slide-graphic-width",$qode_slide_content_width);
	
	    $row2 = new QodeRow(true);
	    $graphic_positioning_group->addChild("row2",$row2);
		    $qode_slide_content_top = new QodeMetaField("textsimple","qode_slide-graphic-top","","Content from top (%)","This is some description");
		    $row2->addChild("qode_slide-graphic-top",$qode_slide_content_top);
		    $qode_slide_content_left = new QodeMetaField("textsimple","qode_slide-graphic-left","","Content from left (%)","This is some description");
		    $row2->addChild("qode_slide-graphic-left",$qode_slide_content_left);
	
	    $row3 = new QodeRow(true);
	    $graphic_positioning_group->addChild("row3",$row3);
		    $qode_slide_content_bottom = new QodeMetaField("textsimple","qode_slide-graphic-bottom","","Content from bototm (%)","This is some description");
		    $row3->addChild("qode_slide-graphic-bottom",$qode_slide_content_bottom);
		    $qode_slide_content_right = new QodeMetaField("textsimple","qode_slide-graphic-right","","Content from right (%)","This is some description");
		    $row3->addChild("qode_slide-graphic-right",$qode_slide_content_right);

	$qode_slide_content_background = new QodeMetaField("color","qode_slide-content-background-color","","Slide Content Background Color","This is some description");
    $qode_slide_vertical_alignment_container->addChild("qode_slide-content-background-color",$qode_slide_content_background);

    $qode_slide_content_padding = new QodeMetaField("text","qode_slide-content-text-padding","","Slide Content Text Padding","Define some padding around text (top right bottom left) - Default value is 0px 0px 0px 0px");
    $qode_slide_vertical_alignment_container->addChild("qode_slide-content-text-padding",$qode_slide_content_padding);