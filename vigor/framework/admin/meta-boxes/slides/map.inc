<?php

global $edgtIconCollections;

$edgt_blog_categories = array();
$categories = get_categories(); 
foreach($categories as $category) {
	$edgt_blog_categories[$category->term_id] = $category->name;
}

//Edge Slide Type

$edgtSlideType = new EdgeMetaBox("slides", "Edge Slide Background Type");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_type",$edgtSlideType);

	$edgt_slide_background_type = new EdgeMetaField("imagevideo","edgt_slide-background-type","image","Slide Background Type","Do you want to upload an image or video?", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf-meta-box-slides_video_settings", "dependence_show_on_yes" => "#edgtf-meta-box-slides_image_settings"));
	$edgtSlideType->addChild("edgt_slide-background-type",$edgt_slide_background_type);

//Edge Slide Image

$edgtSlideImageSettings = new EdgeMetaBox("slides", "Edge Slide Background Image","edgt_slide-background-type",array("video"));
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_image_settings",$edgtSlideImageSettings);

	$edgt_slide_image = new EdgeMetaField("image","edgt_slide-image","","Slide Image","Choose background image");
	$edgtSlideImageSettings->addChild("edgt_title-image",$edgt_slide_image);
	
	$edgt_slide_overlay_image = new EdgeMetaField("image","edgt_slide-overlay-image","","Overlay Image","Choose overlay image (pattern) for background image");
	$edgtSlideImageSettings->addChild("edgt_slide-overlay-image",$edgt_slide_overlay_image);

//Edge Slide Video

$edgtSlideVideoSettings = new EdgeMetaBox("slides", "Edge Slide Background Video","edgt_slide-background-type",array("image"));
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_video_settings",$edgtSlideVideoSettings);

	$edgt_slide_video_webm = new EdgeMetaField("text","edgt_slide-video-webm","","Video - webm","Path to the webm file that you have previously uploaded in Media Section");
	$edgtSlideVideoSettings->addChild("edgt_slide-video-webm",$edgt_slide_video_webm);
	
	$edgt_slide_video_mp4 = new EdgeMetaField("text","edgt_slide-video-mp4","","Video - mp4","Path to the mp4 file that you have previously uploaded in Media Section");
	$edgtSlideVideoSettings->addChild("edgt_slide-video-mp4",$edgt_slide_video_mp4);
	
	$edgt_slide_video_ogv = new EdgeMetaField("text","edgt_slide-video-ogv","","Video - ogv","Path to the ogv file that you have previously uploaded in Media Section");
	$edgtSlideVideoSettings->addChild("edgt_slide-video-ogv",$edgt_slide_video_ogv);

	$edgt_slide_video_image = new EdgeMetaField("image","edgt_slide-video-image","","Video Preview Image","Choose background image that will be visible until video is loaded. This image will be shown on touch devices too.");
	$edgtSlideVideoSettings->addChild("edgt_slide-video-image",$edgt_slide_video_image);
	
	$edgt_slide_video_overlay = new EdgeMetaField("yesempty","edgt_slide-video-overlay","","Video Overlay Image","Do you want to have a overlay image on video? ", array(),
			array("dependence" => true,
			"dependence_hide_on_yes" => "",
			"dependence_show_on_yes" => "#edgtf_edgt_slide-video-overlay_container"));
	$edgtSlideVideoSettings->addChild("edgt_slide-video-overlay",$edgt_slide_video_overlay);
	
	$edgt_slide_video_overlay_container = new EdgeContainer("edgt_slide-video-overlay_container","edgt_slide-video-overlay","");
	$edgtSlideVideoSettings->addChild("edgt_slide_video_overlay_container",$edgt_slide_video_overlay_container);
	
		$edgt_slide_video_overlay_image = new EdgeMetaField("image","edgt_slide-video-overlay-image","","Overlay Image","Choose overlay image (pattern) for background video");
		$edgt_slide_video_overlay_container->addChild("edgt_slide-video-overlay-image",$edgt_slide_video_overlay_image);

//Edge Slide General

$edgtSlideGeneral = new EdgeMetaBox("slides", "Edge Slide General");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_layout",$edgtSlideGeneral);

    $section_title_1 = new EdgeTitle('section_title_1', 'Edge Slide Text Content');
    $edgtSlideGeneral->addChild('section_title_1', $section_title_1);

    $edgt_slide_hide_title = new EdgeMetaField("yesempty","edgt_slide-hide-title","","Hide Slide Title","Do you want to hide slide title?", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf-meta-box-slides_title, #edgtf_edgt_slide_hide_title_container, #edgtf_edgt_slide_scroll_title_container", "dependence_show_on_yes" => ""));
    $edgtSlideGeneral->addChild("edgt_slide-hide-title",$edgt_slide_hide_title);

    $edgt_slide_hide_title_container = new EdgeContainer('edgt_slide_hide_title_container', 'edgt_slide-hide-title', 'yes');
    $edgtSlideGeneral->addChild('edgt_slide_hide_title_container', $edgt_slide_hide_title_container);

    $title_link_group = new EdgeGroup("Title Link","Define styles for title");
    $edgt_slide_hide_title_container->addChild("title_link_group",$title_link_group);
        $row1 = new EdgeRow();
        $title_link_group->addChild("row1",$row1);

        $title_link = new EdgeMetaField("textsimple","edgt_slide-title-link","","Link","This is some description");
        $row1->addChild("edgt_slide-title-link",$title_link);
        $title_target = new EdgeMetaField("selectsimple","edgt_slide-title-target","_self","Target","This is some description", array(
            "_self" => "Self",
            "_blank" => "Blank"
        ));
        $row1->addChild("edgt_slide-title-target",$title_target);

    $edgt_slide_subtitle = new EdgeMetaField("text","edgt_slide-subtitle","","Subtitle Text","Enter text for subtitle");
    $edgtSlideGeneral->addChild("edgt_slide-subtitle",$edgt_slide_subtitle);

    $edgt_slide_text = new EdgeMetaField("text","edgt_slide-text","","Body Text","Enter slide body text");
    $edgtSlideGeneral->addChild("edgt_slide-text",$edgt_slide_text);

    $button1_label = new EdgeMetaField("text","edgt_slide-button-label","","Button 1 Text"," Enter text to be displayed on button 1");
    $edgtSlideGeneral->addChild("edgt_slide-button-label",$button1_label);

$button1_group1 = new EdgeGroup("Button 1 Link", "");
$edgtSlideGeneral->addChild("button1_group1",$button1_group1);

$row1 = new EdgeRow();
$button1_group1->addChild("row1",$row1);

$button1_link = new EdgeMetaField("textsimple","edgt_slide-button-link","","Link","This is some description");
$row1->addChild("edgt_slide-button-link",$button1_link);
$button1_target = new EdgeMetaField("selectsimple","edgt_slide-button-target","_self","Target","This is some description", array(
    "_self" => "Self",
    "_blank" => "Blank"
));
$row1->addChild("edgt_slide-button-target",$button1_target);

    $button2_label = new EdgeMetaField("text","edgt_slide-button-label2","","Button 2 Text"," Enter text to be displayed on button 2");
    $edgtSlideGeneral->addChild("edgt_slide-button-label2",$button2_label);

$button2_group1 = new EdgeGroup("Button 2 Link","");
$edgtSlideGeneral->addChild("button2_group1",$button2_group1);
$row1 = new EdgeRow();
$button2_group1->addChild("row1",$row1);

$button2_link = new EdgeMetaField("textsimple","edgt_slide-button-link2","","Link","This is some description");
$row1->addChild("edgt_slide-button-link2",$button2_link);
$button2_target = new EdgeMetaField("selectsimple","edgt_slide-button-target2","_self","Target","This is some description", array(
    "_self" => "Self",
    "_blank" => "Blank"
));
$row1->addChild("edgt_slide-button-target",$button2_target);

    $section_title_2 = new EdgeTitle('section_title_2', 'Edge Slide Graphics');
    $edgtSlideGeneral->addChild('section_title_2', $section_title_2);

    $edgt_slide_graphic = new EdgeMetaField("image","edgt_slide-thumbnail","","Slide Graphic","Choose slide graphic");
    $edgtSlideGeneral->addChild("edgt_slide-thumbnail",$edgt_slide_graphic);

    $edgt_slide_graphic_link = new EdgeMetaField("text","edgt_slide-thumbnail-link","","Graphic Link","Enter URL to link slide graphic");
    $edgtSlideGeneral->addChild("edgt_slide-thumbnail-link",$edgt_slide_graphic_link);

    $section_title_3 = new EdgeTitle('section_title_3', 'General Styling');
    $edgtSlideGeneral->addChild('section_title_3', $section_title_3);
	
	$edgt_slide_header_style = new EdgeMetaField("selectblank","edgt_slide-header-style","","Header Style","Header style will be applied when this slide is in focus", array(
	    "light" => "Light",
	    "dark" => "Dark"
	));
	$edgtSlideGeneral->addChild("edgt_slide-header-style",$edgt_slide_header_style);

    $edgt_slide_content_background = new EdgeMetaField("color","edgt_slide-content-background-color","","Slide Content Background Color","Choose background color for slide content");
    $edgtSlideGeneral->addChild("edgt_slide-content-background-color",$edgt_slide_content_background);
/*
	$edgt_slide_navigation_color = new EdgeMetaField("color","edgt_slide-navigation-color","","Navigation Color","Navigation color will be applied when this slide is in focus");
	$edgtSlideGeneral->addChild("edgt_slide-navigation-color",$edgt_slide_navigation_color);
*/

    $edgt_slide_hide_shadow = new EdgeMetaField("yesempty","edgt_slide-hide-shadow","","Show Slide Text Shadow","Do you want to show text shadow?");
    $edgtSlideGeneral->addChild("edgt_slide-hide-shadow",$edgt_slide_hide_shadow);


$edgtSlideBehaviour = new EdgeMetaBox("slides", "Edge Slide Behaviours");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_behaviour", $edgtSlideBehaviour);

    $edgt_slide_scroll_to_section = new EdgeMetaField("text","edgt_slide-anchor-button","","Scroll to Section","An arrow will appear to take viewers to the next section of the page. Enter the section anchor here, for example, '#contact'");
    $edgtSlideBehaviour->addChild("edgt_slide-anchor-button",$edgt_slide_scroll_to_section);
	
	$section_title_2 = new EdgeTitle('section_title_2', 'Slide Image Animation');
    $edgtSlideBehaviour->addChild('section_title_2', $section_title_2);
	
	$edgt_enable_image_animation = new EdgeMetaField("yesno", "edgt_enable_image_animation", "no", "Enable Image Animation", "Enabling this option will turn on a motion animation on the slide image");
	$edgtSlideBehaviour->addChild('edgt_enable_image_animation', $edgt_enable_image_animation);
	
	$edgt_enable_image_animation_container = new EdgeContainer("edgt_enable_image_animation_container", "edgt_enable_image_animation", "no");
	$edgtSlideBehaviour->addChild("edgt_enable_image_animation_container", $edgt_enable_image_animation_container);
	
	$edgt_enable_image_animation_type = new EdgeMetaField("select","edgt_enable_image_animation_type","zoom_center","Animation Type","", array(
        "zoom_center" => "Zoom In Center",
        "zoom_top_left" => "Zoom In to Top Left",
        "zoom_top_right" => "Zoom In to Top Right",
        "zoom_bottom_left" => "Zoom In to Bottom Left",
        "zoom_bottom_right" => "Zoom In to Bottom Right"
    ));
    $edgt_enable_image_animation_container->addChild("edgt_enable_image_animation_type",$edgt_enable_image_animation_type);
	
    $section_title_3 = new EdgeTitle('section_title_3', 'Slide Content Entry Animations');
    $edgtSlideBehaviour->addChild('section_title_3', $section_title_3);

    $edgt_slide_thumbnail_animation = new EdgeMetaField("select","edgt_slide-thumbnail-animation","flip","Graphic Entry Animation","Choose entry animation for graphic", array(
        "flip" => "Flip",
        "fade" => "Fade In",
        "from_bottom" => "From Bottom",
        "from_top" => "From Top",
        "from_left" => "From Left",
        "from_right" => "From Right",
        "clip_anim_hor" => "Clip Animation Horizontal",
        "clip_anim_ver" => "Clip Animation Vertical",
        "clip_anim_puzzle" => "Clip Animation Puzzle",
        "without_animation"	=>	"No Animation"
    ));
    $edgtSlideBehaviour->addChild("edgt_slide-thumbnail-animation",$edgt_slide_thumbnail_animation);

    $edgt_slide_content_animation = new EdgeMetaField("select","edgt_slide-content-animation","all_at_once","Content Entry Animation","Choose entry animation for whole slide content group (title, subtitle, text, button)", array(
        "all_at_once" => "All At Once",
        "one_by_one" => "One By One",
        "without_animation"	=>	"No Animation"
    ),
        array("dependence" => true,
            "hide" => array(
                "all_at_once"=>"",
                "one_by_one"=>"",
                "without_animation"=>"#edgtf_edgt_slide_content_animation_container"),
            "show" => array(
                "all_at_once"=>"#edgtf_edgt_slide_content_animation_container",
                "one_by_one"=>"#edgtf_edgt_slide_content_animation_container",
                "without_animation"=>""
            )
        ));
    $edgtSlideBehaviour->addChild("edgt_slide-content-animation",$edgt_slide_content_animation);

    $edgt_slide_content_animation_container = new EdgeContainer("edgt_slide_content_animation_container","edgt_slide-content-animation","without_animation");
    $edgtSlideBehaviour->addChild("edgt_slide_content_animation_container",$edgt_slide_content_animation_container);

    $edgt_slide_content_animation_direction = new EdgeMetaField("select","edgt_slide-content-animation-direction","from_bottom","Animation Direction","", array(
        "from_bottom" => "From Bottom",
        "from_top" => "From Top",
        "from_left" => "From Left",
        "from_right" => "From Right",
        "fade" => "Fade In"

    ));
    $edgt_slide_content_animation_container->addChild("edgt_slide-content-animation-direction",$edgt_slide_content_animation_direction);

//Edge Slide Title

$edgtSlideTitle = new EdgeMetaBox("slides", "Edge Slide Title Style","edgt_slide-hide-title",array("yes"));
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_title",$edgtSlideTitle);

    $title_text_group = new EdgeGroup("Title Text Style","Define styles for title text");
    $edgtSlideTitle->addChild("title_text_group",$title_text_group);
        $row1 = new EdgeRow();
        $title_text_group->addChild("row1",$row1);
            $title_color = new EdgeMetaField("colorsimple","edgt_slide-title-color","","Font Color","This is some description");
            $row1->addChild("edgt_slide-title-color",$title_color);
            $title_fontsize = new EdgeMetaField("textsimple","edgt_slide-title-font-size","","Font Size (px)","This is some description");
            $row1->addChild("edgt_slide-title-font-size",$title_fontsize);
            $title_lineheight = new EdgeMetaField("textsimple","edgt_slide-title-line-height","","Line Height (px)","This is some description");
            $row1->addChild("edgt_slide-title-line-height",$title_lineheight);
            $title_letterspacing = new EdgeMetaField("textsimple","edgt_slide-title-letter-spacing","","Letter Spacing (px)","This is some description");
            $row1->addChild("edgt_slide-title-letter-spacing",$title_letterspacing);

        $row2 = new EdgeRow(true);
        $title_text_group->addChild("row2",$row2);
            $title_google_fonts = new EdgeMetaField("Fontsimple","edgt_slide-title-font-family","","Font Family","This is some description");
            $row2->addChild("edgt_slide-title-font-family",$title_google_fonts);
            $title_fontstyle = new EdgeMetaField("selectblanksimple","edgt_slide-title-font-style","","Font Style","This is some description",$options_fontstyle);
            $row2->addChild("edgt_slide-title-font-style",$title_fontstyle);
            $title_fontweight = new EdgeMetaField("selectblanksimple","edgt_slide-title-font-weight","","Font Weight","This is some description",$options_fontweight);
            $row2->addChild("edgt_slide-title-font-weight",$title_fontweight);
            $title_texttransform = new EdgeMetaField("selectblanksimple","edgt_slide-title-text-transform","","Text Transform","This is some description",$options_texttransform);
            $row2->addChild("edgt_slide-title-text-transform",$title_texttransform);

    $title_background_group = new EdgeGroup("Background","Define background for title");
    $edgtSlideTitle->addChild("title_background_group",$title_background_group);
        $row1 = new EdgeRow();
        $title_background_group->addChild("row1",$row1);
            $title_background_color = new EdgeMetaField("colorsimple","edgt_slide-title-background-color","","Background Color","This is some description");
            $row1->addChild("edgt_slide-title-background-color",$title_background_color);
            $title_background_color_transparency = new EdgeMetaField("textsimple","edgt_slide-title-bg-color-transparency","","Background Color Transparency (values 0-1)","This is some description");
            $row1->addChild("edgt_slide-title-bg-color-transparency",$title_background_color_transparency);

    $title_margin_group = new EdgeGroup("Margin Bottom (px)","Enter value for title bottom margin (default value is 14)");
    $edgtSlideTitle->addChild("title_margin_group",$title_margin_group);
        $row1 = new EdgeRow();
        $title_margin_group->addChild("row1",$row1);
            $title_margin_bottom = new EdgeMetaField("textsimple","edgt_slide_title_margin_bottom","","","This is some description");
            $row1->addChild("edgt_slide_title_margin_bottom",$title_margin_bottom);

    $title_padding_group = new EdgeGroup("Padding","Define padding for title");
    $edgtSlideTitle->addChild("title_padding_group",$title_padding_group);
        $row1 = new EdgeRow();
        $title_padding_group->addChild("row1",$row1);
            $title_padding_top = new EdgeMetaField("textsimple","edgt_slide_title_padding_top","","Top Padding (px)","This is some description");
            $row1->addChild("edgt_slide_title_padding_top",$title_padding_top);
            $title_padding_right = new EdgeMetaField("textsimple","edgt_slide_title_padding_right","","Right Padding (px)","This is some description");
            $row1->addChild("edgt_slide_title_padding_right",$title_padding_right);
            $title_padding_bottom = new EdgeMetaField("textsimple","edgt_slide_title_padding_bottom","","Bottom Padding (px)","This is some description");
            $row1->addChild("edgt_slide_title_padding_bottom",$title_padding_bottom);
            $title_padding_left = new EdgeMetaField("textsimple","edgt_slide_title_padding_left","","Left Padding (px)","This is some description");
            $row1->addChild("edgt_slide_title_padding_left",$title_padding_left);

    $edgt_slide_title_border = new EdgeMetaField('yesno', 'edgt_slide_title_border', 'no', 'Border', 'Do you want to have a title border?', array(), array(
        'dependence' => true,
        'dependence_hide_on_yes' => '',
        'dependence_show_on_yes' => '#edgtf_title_border_container'
    ));
    $edgtSlideTitle->addChild('edgt_slide_title_border', $edgt_slide_title_border);

    $title_border_container = new EdgeContainer('title_border_container', 'edgt_slide_title_border', 'no');
    $edgtSlideTitle->addChild('title_border_container', $title_border_container);


    $title_border_group = new EdgeGroup("Title Border", "Define border for title");
    $title_border_container->addChild("title_border_group", $title_border_group);
        $row1 = new EdgeRow();
        $title_border_group->addChild("row1", $row1);
            $title_border_thickness = new EdgeMetaField("textsimple", "edgt_slide_title_border_thickness", "", "Thickness (px)", "");
            $row1->addChild("title_border_thickness", $title_border_thickness);
            $title_border_style = new EdgeMetaField("selectsimple", "edgt_slide_title_border_style", "", "Style", "", array(
                "solid" => "solid",
                "dashed" => "dashed",
                "dotted" => "dotted",
                "double" => "double",
                "groove" => "groove",
                "ridge" => "ridge",
                "inset" => "inset",
                "outset" => "outset"
            ));
            $row1->addChild("title_border_style", $title_border_style);
            $title_border_color = new EdgeMetaField("colorsimple", "edgt_slider_title_border_color", "", "Color", "");
            $row1->addChild("edgt_slider_title_border_color", $title_border_color);

    $edgt_slide_title_separator = new EdgeMetaField("yesno","edgt_slide-separator-title","no","Title Separator","Do you want to have a title separator?", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#edgtf_edgt_slide_title_separator_container, #edgtf_edgt_slide_scroll_separator_container"));
    $edgtSlideTitle->addChild("edgt_slide-separator-title",$edgt_slide_title_separator);

    $edgt_slide_title_separator_container = new EdgeContainer("edgt_slide_title_separator_container","edgt_slide-separator-title","no");
    $edgtSlideTitle->addChild("edgt_slide_title_separator_container",$edgt_slide_title_separator_container);


    //Separator with or without icon
    $edgt_slide_title_separator_type = new EdgeMetaField('select', 'edgt_slide_title_separator_type', '', 'Separator Type', '', array(
        'without_icon' => 'Without Icon',
        'with_icon' => 'With Icon',
        'with_custom_icon' => 'With Custom Icon'
    ), array(
        'dependence' => true,
        'hide' => array(
            'without_icon' => '#edgtf_edgt_slide_title_separator_with_icon_container, #edgtf_edgt_slide_title_separator_with_custom_icon_container',
            'with_icon' => '#edgtf_edgt_slide_title_separator_without_icon_container, #edgtf_edgt_slide_title_separator_with_custom_icon_container',
            'with_custom_icon' => '#edgtf_edgt_slide_title_separator_with_icon_container, #edgtf_edgt_slide_title_separator_without_icon_container'
        ),
        'show' => array(
            'without_icon' => '#edgtf_edgt_slide_title_separator_without_icon_container',
            'with_icon' => '#edgtf_edgt_slide_title_separator_with_icon_container',
            'with_custom_icon' => '#edgtf_edgt_slide_title_separator_with_custom_icon_container'
        )
    ));
    $edgt_slide_title_separator_container->addChild('edgt_slide_title_separator_type', $edgt_slide_title_separator_type);

    //Separator without Icon Container
    $edgt_slide_title_separator_without_icon_container = new EdgeContainer('edgt_slide_title_separator_without_icon_container', 'edgt_slide_title_separator_type', '', array('with_icon', 'with_custom_icon'));
    $edgt_slide_title_separator_container->addChild('edgt_slide_title_separator_without_icon_container', $edgt_slide_title_separator_without_icon_container);


    $edgt_slide_title_separator_align_container = new EdgeContainerNoStyle('edgt_slide_title_separator_align_container', 'edgt_slide-title-separator-position', 'left_right');
    $edgt_slide_title_separator_without_icon_container->addChild('edgt_slide_title_separator_align_container', $edgt_slide_title_separator_align_container);

    $edgt_slide_title_separator_align = new EdgeMetaField("select","edgt_slide-title-separator-align","both","Alignment","Choose alignment of slider separator", array(
        "none" => "Center",
        "left" => "Left",
        "right" => "Right"
    ));
    $edgt_slide_title_separator_align_container->addChild("edgt_slide-title-separator-align",$edgt_slide_title_separator_align);

        $edgt_slide_separator_color_group = new EdgeGroup("Separator Color","Define color for slider separator");
        $edgt_slide_title_separator_without_icon_container->addChild("edgt_slide_separator_color_group",$edgt_slide_separator_color_group);

            $row1 = new EdgeRow();
            $edgt_slide_separator_color_group->addChild("row1",$row1);

                $edgt_slide_title_separator_color = new EdgeMetaField("colorsimple","edgt_slide-separator-color","","Separator Color","Choose a color for the separator");
                $row1->addChild("edgt_slide-separator-color",$edgt_slide_title_separator_color);

                    $edgt_slide_title_separator_transparency = new EdgeMetaField("textsimple","edgt_slide-separator-transparency","","Separator transparency (values 0-1)","This is some description");
                    $row1->addChild("edgt_slide-separator-transparency",$edgt_slide_title_separator_transparency);

        $edgt_slide_separator_border_group = new EdgeGroup("Separator Border","Define border for slider separator");
        $edgt_slide_title_separator_without_icon_container->addChild("edgt_slide_separator_border_group",$edgt_slide_separator_border_group);

            $row1 = new EdgeRow();
            $edgt_slide_separator_border_group->addChild("row1",$row1);

                $edgt_slide_separator_border_color = new EdgeMetaField("colorsimple","edgt_slide-separator-border-color","","Color","Choose a color for the separator");
                $row1->addChild("edgt_slide-separator-border-color",$edgt_slide_separator_border_color);

                $edgt_slide_separator_border_width = new EdgeMetaField("textsimple","edgt_slide-separator-border-width","","Thickness (px)","This is some description");
                $row1->addChild("edgt_slide-separator-border-width",$edgt_slide_separator_border_width);

                $edgt_slide_separator_border_style = new EdgeMetaField('selectsimple', 'edgt_slide-separator-border-style', 'solid', 'Style', '', array(
                    "solid" => "Solid",
                    "dashed" => "Dashed",
                    "dotted" => "Dotted",
                    "transparent" => "Transparent"
                ));
                $row1->addChild("edgt_slide-separator-border-style",$edgt_slide_separator_border_style);


        $edgt_slide_separator_size_group = new EdgeGroup("Separator Size","Define size for slider separator");
        $edgt_slide_title_separator_without_icon_container->addChild("edgt_slide_separator_size_group",$edgt_slide_separator_size_group);

            $row1 = new EdgeRow();
            $edgt_slide_separator_size_group->addChild("row1",$row1);

                $edgt_slide_title_separator_width = new EdgeMetaField("textsimple","edgt_slide-separator-width","","Separator Width (%)","Enter value from 0% to 100%. Enter just number.");
                $row1->addChild("edgt_slide-separator-width",$edgt_slide_title_separator_width);

                $edgt_slide_title_separator_thickness = new EdgeMetaField("textsimple","edgt_slide-separator-thickness","","Separator Thickness (px)","This is some description");
                $row1->addChild("edgt_slide-separator-thickness",$edgt_slide_title_separator_thickness);

    //Separator with icon container
    $edgt_slide_title_separator_with_icon_container = new EdgeContainer('edgt_slide_title_separator_with_icon_container', 'edgt_slide_title_separator_type', '', array('without_icon', 'with_custom_icon'));
    $edgt_slide_title_separator_container->addChild('edgt_slide_title_separator_with_icon_container', $edgt_slide_title_separator_with_icon_container);

        $edgt_slide_separator_icon_hide_array = array();
        $edgt_slide_separator_icon_show_array = array();

        if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {

            $edgt_slide_separator_icon_collections_params = $edgtIconCollections->getIconCollectionsParams();

            foreach ($edgtIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
                $edgt_slide_separator_icon_hide_array[$dep_collection_key] = '';

                $edgt_slide_separator_icon_show_array[$dep_collection_key] = '#edgtf_edgt_slide_title_separator_with_icon_'.$dep_collection_object->param.'_container';

                foreach ($edgt_slide_separator_icon_collections_params as $edgt_slide_separator_icon_collections_param) {

                    if($edgt_slide_separator_icon_collections_param !== $dep_collection_object->param) {
                        $edgt_slide_separator_icon_hide_array[$dep_collection_key].= '#edgtf_edgt_slide_title_separator_with_icon_'.$edgt_slide_separator_icon_collections_param.'_container,';
                    }

                }

                $edgt_slide_separator_icon_hide_array[$dep_collection_key] = rtrim($edgt_slide_separator_icon_hide_array[$dep_collection_key], ',');
            }

        }

        $edgt_slide_title_separator_with_icon_icon_pack = new EdgeMetaField(
            'select',
            'edgt_slide_title_separator_with_icon_icon_pack',
            'font_awesome',
            'Icon Package',
            'Choose Icon Package',
            $edgtIconCollections->getIconCollections(),
            array(
                'dependence' => true,
                'hide' => $edgt_slide_separator_icon_hide_array,
                'show' => $edgt_slide_separator_icon_show_array
            )
        );
        $edgt_slide_title_separator_with_icon_container->addChild('edgt_slide_title_separator_with_icon_icon_pack', $edgt_slide_title_separator_with_icon_icon_pack);

        if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {

            foreach ($edgtIconCollections->iconCollections as $collection_key => $collection_object) {
                $icons_array = $collection_object->getIconsArray();

                $icon_collections_keys = $edgtIconCollections->getIconCollectionsKeys();

                unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

                $edgt_slide_title_separator_icon_hide_values = $icon_collections_keys;

                $edgt_slide_title_separator_with_icon_icon_pack_container = new EdgeContainer('edgt_slide_title_separator_with_icon_'.$collection_object->param.'_container', 'edgt_slide_title_separator_with_icon_icon_pack', '', $edgt_slide_title_separator_icon_hide_values);
                $edgt_slide_title_separator_with_icon_container->addChild('edgt_slide_title_separator_with_icon_'.$collection_object->param.'_container', $edgt_slide_title_separator_with_icon_icon_pack_container);

                $edgt_slide_title_separator_with_icon_icon_type = new EdgeMetaField('select', 'edgt_slide_title_separator_with_icon_'.$collection_object->param, '', $collection_object->title, 'Icon Package', $icons_array);
                $edgt_slide_title_separator_with_icon_icon_pack_container->addChild('edgt_slide_title_separator_with_icon_'.$collection_object->param, $edgt_slide_title_separator_with_icon_icon_type);

            }

        }

        $edgt_slide_title_separator_with_icon_separator_size_group = new EdgeGroup('Separator Size and Style', 'Define size, color and margins');
        $edgt_slide_title_separator_with_icon_container->addChild('edgt_slide_title_separator_with_icon_separator_size_group', $edgt_slide_title_separator_with_icon_separator_size_group);

            $row1 = new EdgeRow();
            $edgt_slide_title_separator_with_icon_separator_size_group->addChild('row1', $row1);

                $edgt_slide_title_separator_with_icon_line_style = new EdgeMetaField('selectsimple', 'edgt_slide_title_separator_with_icon_line_style', 'normal', 'Separator Line Style', '', array(
                    "solid" => "Solid",
                    "dashed" => "Dashed",
                    "dotted" => "Dotted",
                    "transparent" => "Transparent"
                ));
                $row1->addChild('edgt_slide_title_separator_with_icon_line_style', $edgt_slide_title_separator_with_icon_line_style);

                $edgt_slide_title_separator_with_icon_separator_width = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_separator_width', '', 'Width (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_icon_separator_width', $edgt_slide_title_separator_with_icon_separator_width);

                $edgt_slide_title_separator_with_icon_separator_margin_top = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_separator_margin_top', '', 'Top Margin (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_icon_separator_margin_top', $edgt_slide_title_separator_with_icon_separator_margin_top);

                $edgt_slide_title_separator_with_icon_separator_margin_bottom = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_separator_margin_bottom', '', 'Bottom Margin (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_icon_separator_margin_bottom', $edgt_slide_title_separator_with_icon_separator_margin_bottom);



            $row2 = new EdgeRow(true);
            $edgt_slide_title_separator_with_icon_separator_size_group->addChild('row2', $row2);

                $edgt_slide_title_separator_with_icon_separator_thickness = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_separator_thickness', '', 'Thickness (px)', '');
                $row2->addChild('edgt_slide_title_separator_with_icon_separator_thickness', $edgt_slide_title_separator_with_icon_separator_thickness);

                $edgt_slide_title_separator_with_icon_separator_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_separator_color', '', 'Separator Color', '');
                $row2->addChild('edgt_slide_title_separator_with_icon_separator_color', $edgt_slide_title_separator_with_icon_separator_color);


        $edgt_slide_title_separator_with_icon_icon_size_group = new EdgeGroup('Icon Position and Size', 'Define icon position, size and type');
        $edgt_slide_title_separator_with_icon_container->addChild('edgt_slide_title_separator_with_icon_icon_size_group', $edgt_slide_title_separator_with_icon_icon_size_group);

            $row1 = new EdgeRow();
            $edgt_slide_title_separator_with_icon_icon_size_group->addChild('row1', $row1);

                $edgt_slide_title_separator_with_icon_icon_type = new EdgeMetaField('selectsimple', 'edgt_slide_title_separator_with_icon_icon_type', 'normal', 'Icon Type', '', array(
                    'normal' => 'Normal',
                    'circle' => 'Circle',
                    'square' => 'Square'
                ));
                $row1->addChild('edgt_slide_title_separator_with_icon_icon_type', $edgt_slide_title_separator_with_icon_icon_type);

                $edgt_slide_title_separator_with_icon_icon_postition = new EdgeMetaField('selectsimple', 'edgt_slide_title_separator_with_icon_icon_postition', 'normal', 'Icon Position', '', array(
                    'center' => 'Center',
                    'left' => 'Left',
                    'right' => 'Right'
                ));
                $row1->addChild('edgt_slide_title_separator_with_icon_icon_postition', $edgt_slide_title_separator_with_icon_icon_postition);

                $edgt_slide_title_separator_with_icon_icon_custom_size = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_icon_custom_size', '', 'Icon Custom Size (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_icon_icon_custom_size', $edgt_slide_title_separator_with_icon_icon_custom_size);

                $edgt_slide_title_separator_with_icon_icon_shape_size = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_icon_shape_size', '', 'Icon Shape Size (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_icon_icon_shape_size', $edgt_slide_title_separator_with_icon_icon_shape_size);

            $row2 = new EdgeRow(true);
            $edgt_slide_title_separator_with_icon_icon_size_group->addChild('row2', $row2);

                $edgt_slide_title_separator_with_icon_icon_margin = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_icon_margin', '', 'Icon Margin (px)', '');
                $row2->addChild('edgt_slide_title_separator_with_icon_icon_margin', $edgt_slide_title_separator_with_icon_icon_margin);

                $edgt_slide_title_separator_with_icon_icon_border_radius = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_icon_border_radius', '', 'Icon Border Radius (px)', '');
                $row2->addChild('edgt_slide_title_separator_with_icon_icon_border_radius', $edgt_slide_title_separator_with_icon_icon_border_radius);

                $edgt_slide_title_separator_with_icon_icon_border_width = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_icon_icon_border_width', '', 'Icon Border Width (px)', '');
                $row2->addChild('edgt_slide_title_separator_with_icon_icon_border_width', $edgt_slide_title_separator_with_icon_icon_border_width);


        $edgt_slide_title_separator_with_icon_icon_colour_group = new EdgeGroup('Icon Color', 'Define icon, icon background and icon hover colors');
        $edgt_slide_title_separator_with_icon_container->addChild('edgt_slide_title_separator_with_icon_icon_colour_group', $edgt_slide_title_separator_with_icon_icon_colour_group);

            $row3 = new EdgeRow();
            $edgt_slide_title_separator_with_icon_icon_colour_group->addChild('row3', $row3);

                $edgt_slide_title_separator_with_icon_icon_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_icon_color', '', 'Icon Color', '');
                $row3->addChild('edgt_slide_title_separator_with_icon_icon_color', $edgt_slide_title_separator_with_icon_icon_color);

                $edgt_slide_title_separator_with_icon_icon_border_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_icon_border_color', '', 'Icon Border Color', '');
                $row3->addChild('edgt_slide_title_separator_with_icon_icon_border_color', $edgt_slide_title_separator_with_icon_icon_border_color);


                $edgt_slide_title_separator_with_icon_icon_background_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_icon_background_color', '', 'Icon Background Color', '');
                $row3->addChild('edgt_slide_title_separator_with_icon_icon_background_color', $edgt_slide_title_separator_with_icon_icon_background_color);

                $edgt_slide_title_separator_with_icon_icon_hover_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_icon_hover_color', '', 'Icon Hover Color', '');
                $row3->addChild('edgt_slide_title_separator_with_icon_icon_hover_color', $edgt_slide_title_separator_with_icon_icon_hover_color);

            $row4 = new EdgeRow(true);
            $edgt_slide_title_separator_with_icon_icon_colour_group->addChild('row4', $row4);

                $edgt_slide_title_separator_with_icon_icon_hover_border_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_icon_hover_border_color', '', 'Icon Hover Border Color', '');
                $row4->addChild('edgt_slide_title_separator_with_icon_icon_hover_border_color', $edgt_slide_title_separator_with_icon_icon_hover_border_color);

                $edgt_slide_title_separator_with_icon_icon_hover_background_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_icon_icon_hover_background_color', '', 'Icon Hover Background Color', '');
                $row4->addChild('edgt_slide_title_separator_with_icon_icon_hover_background_color', $edgt_slide_title_separator_with_icon_icon_hover_background_color);

    //Separator with custom icon container
    $edgt_slide_title_separator_with_custom_icon_container = new EdgeContainer('edgt_slide_title_separator_with_custom_icon_container', 'edgt_slide_title_separator_type', '', array('without_icon', 'with_icon'));
    $edgt_slide_title_separator_container->addChild('edgt_slide_title_separator_with_custom_icon_container', $edgt_slide_title_separator_with_custom_icon_container);

        $edgt_slide_title_separator_with_custom_icon_custom_icon = new EdgeMetaField('image', 'edgt_slide_title_separator_with_custom_icon_custom_icon', '', 'Custom Icon', '');
        $edgt_slide_title_separator_with_custom_icon_container->addChild('edgt_slide_title_separator_with_custom_icon_custom_icon', $edgt_slide_title_separator_with_custom_icon_custom_icon);

        $edgt_slide_title_separator_with_custom_icon_separator_style_group = new EdgeGroup('Style', '');
        $edgt_slide_title_separator_with_custom_icon_container->addChild('edgt_slide_title_separator_with_custom_icon_separator_style_group', $edgt_slide_title_separator_with_custom_icon_separator_style_group);

            $row1 = new EdgeRow();
            $edgt_slide_title_separator_with_custom_icon_separator_style_group->addChild('row1', $row1);

                $edgt_slide_title_separator_with_custom_icon_line_style = new EdgeMetaField('selectsimple', 'edgt_slide_title_separator_with_custom_icon_line_style', 'normal', 'Separator Line Style', '', array(
                    "solid" => "Solid",
                    "dashed" => "Dashed",
                    "dotted" => "Dotted",
                    "transparent" => "Transparent"
                ));
                $row1->addChild('edgt_slide_title_separator_with_custom_icon_line_style', $edgt_slide_title_separator_with_custom_icon_line_style);

                $edgt_slide_title_separator_with_custom_icon_separator_width = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_custom_icon_separator_width', '', 'Width (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_custom_icon_separator_width', $edgt_slide_title_separator_with_custom_icon_separator_width);

                $edgt_slide_title_separator_with_custom_icon_separator_margin_top = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_custom_icon_separator_margin_top', '', 'Top Margin (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_custom_icon_separator_margin_top', $edgt_slide_title_separator_with_custom_icon_separator_margin_top);

                $edgt_slide_title_separator_with_custom_icon_separator_margin_bottom = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_custom_icon_separator_margin_bottom', '', 'Bottom Margin (px)', '');
                $row1->addChild('edgt_slide_title_separator_with_custom_icon_separator_margin_bottom', $edgt_slide_title_separator_with_custom_icon_separator_margin_bottom);

            $row2 = new EdgeRow(true);
            $edgt_slide_title_separator_with_custom_icon_separator_style_group->addChild('row2', $row2);

                $edgt_slide_title_separator_with_custom_icon_separator_thickness = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_custom_icon_separator_thickness', '', 'Thickness (px)', '');
                $row2->addChild('edgt_slide_title_separator_with_custom_icon_separator_thickness', $edgt_slide_title_separator_with_custom_icon_separator_thickness);

                $edgt_slide_title_separator_with_custom_icon_separator_color = new EdgeMetaField('colorsimple', 'edgt_slide_title_separator_with_custom_icon_separator_color', '', 'Separator Color', '');
                $row2->addChild('edgt_slide_title_separator_with_custom_icon_separator_color', $edgt_slide_title_separator_with_custom_icon_separator_color);

                $edgt_slide_title_separator_with_custom_icon_icon_postition = new EdgeMetaField('selectsimple', 'edgt_slide_title_separator_with_custom_icon_icon_postition', 'normal', 'Icon Position', '', array(
                    'center' => 'Center',
                    'left' => 'Left',
                    'right' => 'Right'
                ));
                $row2->addChild('edgt_slide_title_separator_with_custom_icon_icon_postition', $edgt_slide_title_separator_with_custom_icon_icon_postition);

                $edgt_slide_title_separator_with_custom_icon_icon_margin = new EdgeMetaField('textsimple', 'edgt_slide_title_separator_with_custom_icon_icon_margin', '', 'Icon Margin (px)', '');
                $row2->addChild('edgt_slide_title_separator_with_custom_icon_icon_margin', $edgt_slide_title_separator_with_custom_icon_icon_margin);

        //Separator Position Without Icon
        $edgt_slide_title_separator_position = new EdgeMetaField("select","edgt_slide-title-separator-position","both","Position","Choose position of slider separator", array(
            "both" => "Top and Bottom",
            "left_right" => "Left and Right",
            "top" => "Top",
            "bottom" => "Bottom"
        ),
        array("dependence" => true,
            "hide" => array(
                "both"=>"#edgtf_edgt_slide_left_right_separator_container",
                "left_right" => "#edgtf_edgt_slide_top_separator_container, #edgtf_edgt_slide_bottom_separator_container, #edgtf_edgt_slide_title_separator_align_container",
                "top"=>"#edgtf_edgt_slide_bottom_separator_container, #edgtf_edgt_slide_left_right_separator_container",
                "bottom"=>"#edgtf_edgt_slide_top_separator_container, #edgtf_edgt_slide_left_right_separator_container"),
            "show" => array(
                "both"=>"#edgtf_edgt_slide_top_separator_container,#edgtf_edgt_slide_bottom_separator_container, #edgtf_edgt_slide_title_separator_align_container",
                "top"=>"#edgtf_edgt_slide_top_separator_container, #edgtf_edgt_slide_title_separator_align_container",
                "bottom"=>"#edgtf_edgt_slide_bottom_separator_container, #edgtf_edgt_slide_title_separator_align_container",
                "left_right" => "#edgtf_edgt_slide_left_right_separator_container"
            )
        ));
        $edgt_slide_title_separator_without_icon_container->addChild("edgt_slide-title-separator-position",$edgt_slide_title_separator_position);

        $edgt_slide_top_separator_container = new EdgeContainer("edgt_slide_top_separator_container","edgt_slide-title-separator-position","", array("bottom", "left_right"));
        $edgt_slide_title_separator_without_icon_container->addChild("edgt_slide_top_separator_container",$edgt_slide_top_separator_container);

            $group1 = new EdgeGroup("Top Separator Margins","Enter top separator margins");
            $edgt_slide_top_separator_container->addChild("group1",$group1);

                $row1 = new EdgeRow();
                $group1->addChild("row1",$row1);

                    $edgt_slide_top_separator_margin_top = new EdgeMetaField("textsimple","edgt_slide-top-separator-margin-top","","Margin Top (px)","This is some description");
                    $row1->addChild("edgt_slide-top-separator-margin-top",$edgt_slide_top_separator_margin_top);

                    $edgt_slide_top_separator_margin_bottom = new EdgeMetaField("textsimple","edgt_slide-top-separator-margin-bottom","","Margin Bottom (px)","This is some description");
                    $row1->addChild("edgt_slide-top-separator-margin-bottom",$edgt_slide_top_separator_margin_bottom);

        $edgt_slide_bottom_separator_container = new EdgeContainer("edgt_slide_bottom_separator_container","edgt_slide-title-separator-position","", array("top", "left_right"));
        $edgt_slide_title_separator_without_icon_container->addChild("edgt_slide_bottom_separator_container",$edgt_slide_bottom_separator_container);

            $group2 = new EdgeGroup("Bottom Separator Margins","Enter bottom separator margins");
            $edgt_slide_bottom_separator_container->addChild("group2",$group2);

                $row1 = new EdgeRow();
                $group2->addChild("row1",$row1);

                    $edgt_slide_bottom_separator_margin_top = new EdgeMetaField("textsimple","edgt_slide-bottom-separator-margin-top","","Margin Top (px)","This is some description");
                    $row1->addChild("edgt_slide-bottom-separator-margin-top",$edgt_slide_bottom_separator_margin_top);

                    $edgt_slide_bottom_separator_margin_bottom = new EdgeMetaField("textsimple","edgt_slide-bottom-separator-margin-bottom","","Margin Bottom (px)","This is some description");
                    $row1->addChild("edgt_slide-bottom-separator-margin-bottom",$edgt_slide_bottom_separator_margin_bottom);

        $edgt_slide_left_right_separator_container = new EdgeContainer("edgt_slide_left_right_separator_container","edgt_slide-title-separator-position","", array("top", "bottom", "both"));
        $edgt_slide_title_separator_without_icon_container->addChild('edgt_slide_left_right_separator_container', $edgt_slide_left_right_separator_container);

            $edgt_slide_left_right_separator_style = new EdgeMetaField('select', 'edgt_slide_left_right_separator_style', 'solid', 'Line Style', 'Separator Line Style', array(
                "solid" => "Solid",
                "dashed" => "Dashed",
                "dotted" => "Dotted"
            ));
            $edgt_slide_left_right_separator_container->addChild('edgt_slide_left_right_separator_style', $edgt_slide_left_right_separator_style);

            $group3 = new EdgeGroup('Left/Right Separator Margins', 'Enter left and right separator margins');
            $edgt_slide_left_right_separator_container->addChild('group3', $group3);

                $row1 = new EdgeRow();
                $group3->addChild('row1',$row1);

                    $edgt_slide_left_separator_margin_right = new EdgeMetaField("textsimple","edgt_slide_left_separator_margin_right","","Left Separator Margin Right (px)","");
                    $row1->addChild("edgt_slide_left_separator_margin_right",$edgt_slide_left_separator_margin_right);

                    $edgt_slide_right_separator_margin_left = new EdgeMetaField("textsimple","edgt_slide_right_separator_margin_left","","Right Separator Margin Right (px)","");
                    $row1->addChild("edgt_slide_right_separator_margin_left",$edgt_slide_right_separator_margin_left);

            $group4 = new EdgeGroup('Dots on Line End', 'Add dots on line end');
            $edgt_slide_left_right_separator_container->addChild('group4', $group4);

                $row2 = new EdgeRow();
                $group4->addChild('row2', $row2);

                    $edgt_slide_left_right_separator_linedots = new EdgeMetaField('selectsimple', 'edgt_slide_left_right_separator_linedots', 'no', 'Dots on line end', '', array(
                        'no' => 'No',
                        'yes' => 'Yes',
                    ));
                    $row2->addChild('edgt_slide_left_right_separator_linedots', $edgt_slide_left_right_separator_linedots);

                    $edgt_slide_left_right_separator_line_dots_size = new EdgeMetaField('textsimple', 'edgt_slide_left_right_separator_line_dots_size', '', 'Dots Size (px)', '');
                    $row2->addChild('edgt_slide_left_right_separator_line_dots_size', $edgt_slide_left_right_separator_line_dots_size);

                    $edgt_slide_left_right_separator_dots_color = new EdgeMetaField('colorsimple', 'edgt_slide_left_right_separator_dots_color', '', 'Dots Color', '');
                    $row2->addChild('edgt_slide_left_right_separator_dots_color', $edgt_slide_left_right_separator_dots_color);

        //Separator Position With Icon
        $edgt_slide_title_separator_with_icon_position = new EdgeMetaField("select","edgt_slide_title_separator_with_icon_position","both","Position","Choose position of slider separator", array(
            "top" => "Top",
            "bottom" => "Bottom"
        ));
        $edgt_slide_title_separator_with_icon_container->addChild("edgt_slide_title_separator_with_icon_position",$edgt_slide_title_separator_with_icon_position);

        //Separator Position With Custom Icon
        $edgt_slide_title_separator_with_custom_icon_position = new EdgeMetaField("select","edgt_slide_title_separator_with_custom_icon_position","both","Position","Choose position of slider separator", array(
            "top" => "Top",
            "bottom" => "Bottom"
        ));
        $edgt_slide_title_separator_with_custom_icon_container->addChild('edgt_slide_title_separator_with_custom_icon_position', $edgt_slide_title_separator_with_custom_icon_position);

//Edge Slide Subtitle

$edgtSlideSubtitle = new EdgeMetaBox("slides", "Edge Slide Subtitle Style");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_subtitle",$edgtSlideSubtitle);

    $subtitle_text_group = new EdgeGroup("Subtitle Text Style","Define styles for subtitle text");
    $edgtSlideSubtitle->addChild("subtitle_text_group",$subtitle_text_group);
        $row1 = new EdgeRow();
        $subtitle_text_group->addChild("row1",$row1);
            $subtitle_color = new EdgeMetaField("colorsimple","edgt_slide-subtitle-color","","Font Color","This is some description");
            $row1->addChild("edgt_slide-subtitle-color",$subtitle_color);
            $subtitle_fontsize = new EdgeMetaField("textsimple","edgt_slide-subtitle-font-size","","Font Size (px)","This is some description");
            $row1->addChild("edgt_slide-subtitle-font-size",$subtitle_fontsize);
            $subtitle_lineheight = new EdgeMetaField("textsimple","edgt_slide-subtitle-line-height","","Line Height (px)","This is some description");
            $row1->addChild("edgt_slide-subtitle-line-height",$subtitle_lineheight);
            $subtitle_letterspacing = new EdgeMetaField("textsimple","edgt_slide-subtitle-letter-spacing","","Letter Spacing (px)","This is some description");
            $row1->addChild("edgt_slide-subtitle-letter-spacing",$subtitle_letterspacing);

        $row2 = new EdgeRow(true);
        $subtitle_text_group->addChild("row2",$row2);
            $subtitle_google_fonts = new EdgeMetaField("Fontsimple","edgt_slide-subtitle-font-family","","Font Family","This is some description");
            $row2->addChild("edgt_slide-subtitle-font-family",$subtitle_google_fonts);
            $subtitle_fontstyle = new EdgeMetaField("selectblanksimple","edgt_slide-subtitle-font-style","","Font Style","This is some description",$options_fontstyle);
            $row2->addChild("edgt_slide-subtitle-font-style",$subtitle_fontstyle);
            $subtitle_fontweight = new EdgeMetaField("selectblanksimple","edgt_slide-subtitle-font-weight","","Font Weight","This is some description",$options_fontweight);
            $row2->addChild("edgt_slide-subtitle-font-weight",$subtitle_fontweight);
            $subtitle_transform = new EdgeMetaField("selectblanksimple","edgt_slide-subtitle-text-transform","","Text Transform","This is some description",$options_texttransform);
            $row2->addChild("edgt_slide-subtitle-text-transform",$subtitle_transform);

    $subtitle_background_group = new EdgeGroup("Background","Define background for subtitle");
    $edgtSlideSubtitle->addChild("subtitle_background_group",$subtitle_background_group);
        $row1 = new EdgeRow(true);
        $subtitle_background_group->addChild("row1",$row1);
            $subtitle_background_color = new EdgeMetaField("colorsimple","edgt_slide-subtitle-background-color","","Background Color","This is some description");
            $row1->addChild("edgt_slide-subtitle-background-color",$subtitle_background_color);
            $subtitle_background_color_transparency = new EdgeMetaField("textsimple","edgt_slide-subtitle-bg-color-transparency","","Background Color Transparency (values: 0-1)","This is some description");
            $row1->addChild("edgt_slide-subtitle-bg-color-transparency",$subtitle_background_color_transparency);

    $subtitle_margin_group = new EdgeGroup("Margin Bottom (px)","Enter value for subtitle bottom margin (default value is 14)");
    $edgtSlideSubtitle->addChild("subtitle_margin_group",$subtitle_margin_group);
        $row1 = new EdgeRow(true);
        $subtitle_margin_group->addChild("row1",$row1);
            $subtitle_margin_bottom = new EdgeMetaField("textsimple","edgt_slide_subtitle_margin_bottom","","","This is some description");
            $row1->addChild("edgt_slide_subtitle_margin_bottom",$subtitle_margin_bottom);

    $subtitle_padding_group = new EdgeGroup("Padding","Define padding for subtitle");
    $edgtSlideSubtitle->addChild("subtitle_padding_group",$subtitle_padding_group);
        $row1 = new EdgeRow(true);
        $subtitle_padding_group->addChild("row1",$row1);
            $subtitle_padding_top = new EdgeMetaField("textsimple","edgt_slide_subtitle_padding_top","","Top Padding (px)","This is some description");
            $row1->addChild("edgt_slide_subtitle_padding_top",$subtitle_padding_top);
            $subtitle_padding_right = new EdgeMetaField("textsimple","edgt_slide_subtitle_padding_right","","Right Padding (px)","This is some description");
            $row1->addChild("edgt_slide_subtitle_padding_right",$subtitle_padding_right);
            $subtitle_padding_bottom = new EdgeMetaField("textsimple","edgt_slide_subtitle_padding_bottom","","Bottom Padding (px)","This is some description");
            $row1->addChild("edgt_slide_subtitle_padding_bottom",$subtitle_padding_bottom);
            $subtitle_padding_left = new EdgeMetaField("textsimple","edgt_slide_subtitle_padding_left","","Left Padding (px)","This is some description");
            $row1->addChild("edgt_slide_subtitle_padding_left",$subtitle_padding_left);

//Edge Slide Text

$edgtSlideText = new EdgeMetaBox("slides", "Edge Slide Text Style");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_text",$edgtSlideText);

    $text_common_text_group = new EdgeGroup('Text Color and Size', 'Define text color and size');
    $edgtSlideText->addChild('text_common_text_group', $text_common_text_group);

        $row1 = new EdgeRow();
        $text_common_text_group->addChild('row1', $row1);

            $text_color = new EdgeMetaField("colorsimple","edgt_slide-text-color","","Font Color","This is some description");
            $row1->addChild("edgt_slide-text-color",$text_color);
            $text_background_color = new EdgeMetaField("colorsimple","edgt_slide-text-background-color","","Background Color","This is some description");
            $row1->addChild("edgt_slide-text-background-color",$text_background_color);
            $text_fontsize = new EdgeMetaField("textsimple","edgt_slide-text-font-size","","Font Size (px)","This is some description");
            $row1->addChild("edgt_slide-text-font-size",$text_fontsize);
            $text_lineheight = new EdgeMetaField("textsimple","edgt_slide-text-line-height","","Line Height (px)","This is some description");
            $row1->addChild("edgt_slide-text-line-height",$text_lineheight);

    $text_separator_text = new EdgeMetaField('yesno', 'text_separator_text', 'no', 'Separator Around Text', 'Do you want to have a separator around text', array(), array(
        'dependence' => true,
        'dependence_hide_on_yes' => '#edgtf_text_without_separator_container',
        'dependence_show_on_yes' => '#edgtf_text_with_separator_container'
    ));
    $edgtSlideText->addChild('text_separator_text', $text_separator_text);

    $text_without_separator_container = new EdgeContainerNoStyle('text_without_separator_container', 'text_separator_text', 'yes');
    $edgtSlideText->addChild('text_without_separator_container', $text_without_separator_container);

        $text_without_separator_padding_group = new EdgeGroup("Padding","Define padding for text");
        $text_without_separator_container->addChild("text_without_separator_padding_group",$text_without_separator_padding_group);

            $row1 = new EdgeRow(true);
            $text_without_separator_padding_group->addChild("row1",$row1);

                $text_padding_top = new EdgeMetaField("textsimple","edgt_slide_text_padding_top","","Top Padding (px)","This is some description");
                $row1->addChild("edgt_slide_text_padding_top",$text_padding_top);
                $text_padding_right = new EdgeMetaField("textsimple","edgt_slide_text_padding_right","","Right Padding (px)","This is some description");
                $row1->addChild("edgt_slide_text_padding_right",$text_padding_right);
                $text_padding_bottom = new EdgeMetaField("textsimple","edgt_slide_text_padding_bottom","","Bottom Padding (px)","This is some description");
                $row1->addChild("edgt_slide_text_padding_bottom",$text_padding_bottom);
                $text_padding_left = new EdgeMetaField("textsimple","edgt_slide_text_padding_left","","Left Padding (px)","This is some description");
                $row1->addChild("edgt_slide_text_padding_left",$text_padding_left);

        $text_without_separator_text_group = new EdgeGroup("Text Text Style","Define styles for text text");
        $text_without_separator_container->addChild("text_without_separator_text_group",$text_without_separator_text_group);

            $row1 = new EdgeRow();
            $text_without_separator_text_group->addChild("row1",$row1);

                $text_letterspacing = new EdgeMetaField("textsimple","edgt_slide-text-letter-spacing","","Letter Spacing (px)","This is some description");
                $row1->addChild("edgt_slide-text-letter-spacing",$text_letterspacing);

            $row2 = new EdgeRow(true);
            $text_without_separator_text_group->addChild("row2",$row2);

                $text_google_fonts = new EdgeMetaField("Fontsimple","edgt_slide-text-font-family","","Font Family","This is some description");
                $row2->addChild("edgt_slide-text-font-family",$text_google_fonts);
                $text_fontstyle = new EdgeMetaField("selectblanksimple","edgt_slide-text-font-style","","Font Style","This is some description",$options_fontstyle);
                $row2->addChild("edgt_slide-text-font-style",$text_fontstyle);
                $text_fontweight = new EdgeMetaField("selectblanksimple","edgt_slide-text-font-weight","","Font Weight","This is some description",$options_fontweight);
                $row2->addChild("edgt_slide-text-font-weight",$text_fontweight);
                $text_transform = new EdgeMetaField("selectblanksimple","edgt_slide-text-text-transform","","Text Transform","This is some description",$options_texttransform);
                $row2->addChild("edgt_slide-text-text-transform",$text_transform);

        $text_without_separator_background_group = new EdgeGroup("Background","Define background for text");
        $text_without_separator_container->addChild("text_without_separator_background_group",$text_without_separator_background_group);

            $row1 = new EdgeRow(true);
            $text_without_separator_background_group->addChild("row1",$row1);

                $text_background_color_transparency = new EdgeMetaField("textsimple","edgt_slide-text-bg-color-transparency","","Background Color Transparency (values 0-1)","This is some description");
                $row1->addChild("edgt_slide-text-bg-color-transparency",$text_background_color_transparency);

    $text_with_separator_container = new EdgeContainer('text_with_separator_container', 'text_separator_text', 'no');
    $edgtSlideText->addChild('text_with_separator_container', $text_with_separator_container);

        $text_with_separator_border_styles = new EdgeGroup('Separator Line Style', 'Define separator line style');
        $text_with_separator_container->addChild('text_with_separator_border_styles', $text_with_separator_border_styles);

            $row1 = new EdgeRow();
            $text_with_separator_border_styles->addChild('row1', $row1);

                $edgt_separator_line_border_style = new EdgeMetaField('selectsimple', 'edgt_separator_line_border_style', 'solid', 'Line Border Style', '', array(
                    'solid' => 'Solid',
                    'dashed' => 'Dashed',
                    'dotted' => 'Dotted',
                    'transparent' => 'Transparent'
                ));
                $row1->addChild('edgt_separator_line_border_style', $edgt_separator_line_border_style);

                $edgt_separator_line_width = new EdgeMetaField('textsimple', 'edgt_separator_line_width', '', 'Line Width (px)', '');
                $row1->addChild('edgt_separator_line_width', $edgt_separator_line_width);

                $edgt_separator_line_thickness = new EdgeMetaField('textsimple', 'edgt_separator_line_thickness', '', 'Line Thickness (px)', '');
                $row1->addChild('edgt_separator_line_thickness', $edgt_separator_line_thickness);

                $edgt_separator_line_color = new EdgeMetaField('colorsimple', 'edgt_separator_line_color', '', 'Line Color', '');
                $row1->addChild('edgt_separator_line_color', $edgt_separator_line_color);

        $text_with_separator_boxed = new EdgeGroup('Boxed Text', 'Add box around text');
        $text_with_separator_container->addChild('text_with_separator_boxed', $text_with_separator_boxed);

            $row1 = new EdgeRow();
            $text_with_separator_boxed->addChild('row1', $row1);

                $edgt_separator_text_in_box = new EdgeMetaField('selectsimple', 'edgt_separator_text_in_box', 'no', 'Text in Box', '', array(
                    'yes' => 'Yes',
                    'no' => 'No'
                ));
                $row1->addChild('edgt_separator_text_in_box', $edgt_separator_text_in_box);

                $edgt_separator_box_border_style = new EdgeMetaField('selectsimple', 'edgt_separator_box_border_style', 'solid', 'Box Border Style', '', array(
                    'solid' => 'Solid',
                    'dashed' => 'Dashed',
                    'dotted' => 'Dotted',
                    'transparent' => 'Transparent'
                ));
                $row1->addChild('edgt_separator_box_border_style', $edgt_separator_box_border_style);

                $edgt_separator_box_border_width = new EdgeMetaField('textsimple', 'edgt_separator_box_border_width', '', 'Box Border Width (px)', '');
                $row1->addChild('edgt_separator_box_border_width', $edgt_separator_box_border_width);

                $edgt_separator_box_border_radius = new EdgeMetaField('textsimple', 'edgt_separator_box_border_radius', '', 'Box Border Radius (px)', '');
                $row1->addChild('edgt_separator_box_border_radius', $edgt_separator_box_border_radius);

            $row2 = new EdgeRow(true);
            $text_with_separator_boxed->addChild('row2', $row2);

                $edgt_separator_box_border_color = new EdgeMetaField('colorsimple', 'edgt_separator_box_border_color', '', 'Box Border Color', '');
                $row2->addChild('edgt_separator_box_border_color', $edgt_separator_box_border_color);

        $text_with_separator_position = new EdgeGroup('Text Position', 'Define position of text');
        $text_with_separator_container->addChild('text_with_separator_position', $text_with_separator_position);

            $row1 = new EdgeRow();
            $text_with_separator_position->addChild('row1', $row1);

                $edgt_separator_text_position = new EdgeMetaField('selectsimple', 'edgt_separator_text_position', 'center', 'Text position', '', array(
                    'center' => 'Center',
                    'left' => 'Left',
                    'right' => 'Right'
                ));
                $row1->addChild('edgt_separator_text_position', $edgt_separator_text_position);

                $edgt_separator_text_leftright_padding = new EdgeMetaField('textsimple', 'edgt_separator_text_leftright_padding', '', 'Left/Right Text padding (px)', '');
                $row1->addChild('edgt_separator_text_leftright_padding', $edgt_separator_text_leftright_padding);

                $edgt_separator_text_top_margin = new EdgeMetaField('textsimple', 'edgt_separator_text_top_margin', '', 'Top Margin (px)', '');
                $row1->addChild('edgt_separator_text_top_margin', $edgt_separator_text_top_margin);

                $edgt_separator_text_bottom_margin = new EdgeMetaField('textsimple', 'edgt_separator_text_bottom_margin', '', 'Bottom Margin (px)', '');
                $row1->addChild('edgt_separator_text_bottom_margin', $edgt_separator_text_bottom_margin);

            $row2= new EdgeRow(true);
            $text_with_separator_position->addChild('row2', $row2);

                $edgt_separator_box_margin = new EdgeMetaField('textsimple', 'edgt_separator_box_margin', '', 'Box Margins Left/Right (px)', '');
                $row2->addChild('edgt_separator_box_margin', $edgt_separator_box_margin);

        $text_with_separator_linedots = new EdgeGroup('Dots on Line End', 'Add dots on line end');
        $text_with_separator_container->addChild('text_with_separator_linedots', $text_with_separator_linedots);

            $row1 = new EdgeRow();
            $text_with_separator_linedots->addChild('row1', $row1);

                $edgt_separator_linedots = new EdgeMetaField('selectsimple', 'edgt_separator_linedots', 'no', 'Dots on line end', '', array(
                    'no' => 'No',
                    'yes' => 'Yes',
                ));
                $row1->addChild('edgt_separator_linedots', $edgt_separator_linedots);

                $edgt_separator_line_dots_size = new EdgeMetaField('textsimple', 'edgt_separator_line_dots_size', '', 'Dots Size (px)', '');
                $row1->addChild('edgt_separator_line_dots_size', $edgt_separator_line_dots_size);

                $edgt_separator_dots_color = new EdgeMetaField('colorsimple', 'edgt_separator_dots_color', '', 'Dots Color', '');
                $row1->addChild('edgt_separator_dots_color', $edgt_separator_dots_color);


//Edge Slide Buttons
//Button 1
$edgtSlideButtons = new EdgeMetaBox("slides", "Edge Slide Buttons Style");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_buttons",$edgtSlideButtons);

$button1_section = new EdgeTitle("button1_section", "Button 1");
$edgtSlideButtons->addChild("button1_section", $button1_section);

$button1_group2 = new EdgeGroup("Text Style","Define text style");
$edgtSlideButtons->addChild("button1_group2",$button1_group2);

        $row1 = new EdgeRow();
        $button1_group2->addChild("row1",$row1);
            $button1_font_family = new EdgeMetaField("Fontsimple","edgt_slide-button_font_family","-1","Font Family","This is some description");
            $row1->addChild("edgt_slide-button_font_family",$button1_font_family);
            $button1_font_size = new EdgeMetaField("textsimple","edgt_slide-button_font_size","","Text Size(px)","This is some description");
            $row1->addChild("edgt_slide-button_font_size",$button1_font_size);
            $button1_font_style = new EdgeMetaField("selectblanksimple","edgt_slide-button_font_style","","Font Style","This is some description",$options_fontstyle);
            $row1->addChild("edgt_slide-button_font_style",$button1_font_style);
            $button1_font_weight = new EdgeMetaField("selectblanksimple","edgt_slide-button_font_weight","","Font Weight","This is some description",$options_fontweight);
            $row1->addChild("edgt_slide-button_font_weight",$button1_font_weight);

        $row2 = new EdgeRow();
        $button1_group2->addChild("row2",$row2);

            $button1_letter_spacing= new EdgeMetaField("textsimple","edgt_slide-button_letter_spacing","","Letter Spacing(px)","This is some description");
            $row2->addChild("edgt_slide-button_letter_spacing",$button1_letter_spacing);

            $button1_line_height = new EdgeMetaField("textsimple","edgt_slide-button_line_height","","Line Height (px)","This is some description");
            $row2->addChild("edgt_slide-button_line_height",$button1_line_height);

            $button1_text_color = new EdgeMetaField("colorsimple","edgt_slide-button_text_color","","Text Color","This is some description");
            $row2->addChild("edgt_slide-button_text_color",$button1_text_color);

            $button1_text_hover_color = new EdgeMetaField("colorsimple","edgt_slide-button_text_hover_color","","Text Hover Color","This is some description");
            $row2->addChild("edgt_slide-button_text_hover_color",$button1_text_hover_color);

        $row3 = new EdgeRow();
        $button1_group2->addChild("row3",$row3);

            $button1_text_align = new EdgeMetaField("selectblanksimple","edgt_slide-button_text_align","","Text Align","This is some description", array(
                "left" => "Left",
                "center" => "Center",
                "right" => "Right"
            ));
            $row3->addChild("edgt_slide-button_text_align",$button1_text_align);
            $button1_text_transform = new EdgeMetaField("selectblanksimple","edgt_slide-button_text_transform","","Text Transform","This is some description",$options_texttransform);
            $row3->addChild("edgt_slide-button_text_transform",$button1_text_transform);

    $button1_group3 = new EdgeGroup("Background","Define background");
    $edgtSlideButtons->addChild("button1_group3",$button1_group3);

            $row1 = new EdgeRow();
            $button1_group3->addChild("row1",$row1);

                $button1_background_color = new EdgeMetaField("colorsimple","edgt_slide-button_background_color","","Background Color","This is some description");
                $row1->addChild("edgt_slide-button_background_color",$button1_background_color);

                $button1_background_hover_color = new EdgeMetaField("colorsimple","edgt_slide-button_background_hover_color","","Background Hover Color","This is some description");
                $row1->addChild("edgt_slide-button_background_hover_color",$button1_background_hover_color);

    $button1_group4 = new EdgeGroup("Size","Define button size");
    $edgtSlideButtons->addChild("button1_group4",$button1_group4);

        $row1 = new EdgeRow();
        $button1_group4->addChild("row1",$row1);

            $button1_width = new EdgeMetaField("textsimple","edgt_slide-button_width","","Width (px)","This is some description");
            $row1->addChild("edgt_slide-button_width",$button1_width);

            $button1_height = new EdgeMetaField("textsimple","edgt_slide-button_height","","Height (px)","This is some description");
            $row1->addChild("edgt_slide-button_height",$button1_height);

    $button1_group5 = new EdgeGroup("Border","Define border style");
    $edgtSlideButtons->addChild("button1_group5",$button1_group5);

        $row1 = new EdgeRow();
        $button1_group5->addChild("row1",$row1);

            $button1_border_width = new EdgeMetaField("textsimple","edgt_slide-button_border_width","","Border Width (px)","This is some description");
            $row1->addChild("edgt_slide-button_border_width",$button1_border_width);

            $button1_border_radius = new EdgeMetaField("textsimple","edgt_slide-button_border_radius","","Border Radius (px)","This is some description");
            $row1->addChild("edgt_slide-button_border_radius",$button1_border_radius);

            $button1_border_color = new EdgeMetaField("colorsimple","edgt_slide-button_border_color","","Border Color","This is some description");
            $row1->addChild("edgt_slide-button_border_color",$button1_border_color);

            $button1_border_hover_color = new EdgeMetaField("colorsimple","edgt_slide-button_border_hover_color","","Border Hover Color","This is some description");
            $row1->addChild("edgt_slide-button_border_hover_color",$button1_border_hover_color);

            $button1_margin = new EdgeMetaField("text","edgt_slide-button_margin1","","Margin (px)","Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px",array(), array("col_width" => 3));
            $edgtSlideButtons->addChild("edgt_slide-button_margin1",$button1_margin);

    $button1_group6 = new EdgeGroup("Padding","Define left/right padding for button (px)");
    $edgtSlideButtons->addChild("button1_group6",$button1_group6);

        $row1 = new EdgeRow(true);
        $button1_group6->addChild("row1",$row1);

        $button1_padding = new EdgeMetaField("textsimple","edgt_slide-button_padding","","","This is some description");
        $row1->addChild("edgt_slide-button_padding",$button1_padding);

    //init icon pack hide and show array. It will be populated dinamically from collections array
    $button1_icon_pack_hide_array = array();
    $button1_icon_pack_show_array = array();

    //do we have some collection added in collections array?
    if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
        //get collections params array. It will contain values of 'param' property for each collection
        $button1_icon_collections_params = $edgtIconCollections->getIconCollectionsParams();

        //foreach collection generate hide and show array
        foreach ($edgtIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
            $button1_icon_pack_hide_array[$dep_collection_key] = '';
            $button1_icon_pack_hide_array["no_icon"] = "";

            //we need to include only current collection in show string as it is the only one that needs to show
            $button1_icon_pack_show_array[$dep_collection_key] = '#edgtf_button1_icon_'.$dep_collection_object->param.'_container';

            //for all collections param generate hide string
            foreach ($button1_icon_collections_params as $button1_icon_collections_param) {
                //we don't need to include current one, because it needs to be shown, not hidden
                if($button1_icon_collections_param !== $dep_collection_object->param) {
                    $button1_icon_pack_hide_array[$dep_collection_key].= '#edgtf_button1_icon_'.$button1_icon_collections_param.'_container,';
                }

                $button1_icon_pack_hide_array["no_icon"] .= '#edgtf_button1_icon_'.$button1_icon_collections_param.'_container,';
            }

            //remove remaining ',' character
            $button1_icon_pack_hide_array[$dep_collection_key] = rtrim($button1_icon_pack_hide_array[$dep_collection_key], ',');
            $button1_icon_pack_hide_array["no_icon"] = rtrim($button1_icon_pack_hide_array["no_icon"], ',');
        }

    }

    $button1_icon_pack = new EdgeMetaField(
        "select",
        "button1_icon_pack",
        "no_icon",
        "Button 1 Icon Pack",
        "Choose icon pack for first button",
        $edgtIconCollections->getIconCollectionsEmpty("no_icon"),
        array(
            "dependence" => true,
            "hide" => $button1_icon_pack_hide_array,
            "show" => $button1_icon_pack_show_array
        ));

    $edgtSlideButtons->addChild("button1_icon_pack", $button1_icon_pack);

    if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
        //foreach icon collection we need to generate separate container that will have dependency set
        //it will have one field inside with icons dropdown
        foreach ($edgtIconCollections->iconCollections as $collection_key => $collection_object) {
            $icons_array = $collection_object->getIconsArray();

            //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
            $icon_collections_keys = $edgtIconCollections->getIconCollectionsKeys();

            //unset current one, because it doesn't have to be included in dependency that hides icon container
            unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

            $button1_icon_hide_values = $icon_collections_keys;
            $button1_icon_hide_values[] = "no_icon";
            $button1_icon_container = new EdgeContainer("button1_icon_".$collection_object->param."_container", "button1_icon_pack", "", $button1_icon_hide_values);
            $button1_icon = new EdgeMetaField("select", "button1_icon_".$collection_object->param, "", "Button 1 Icon","Choose First Button Icon", $icons_array, array("col_width" => 3));
            $button1_icon_container->addChild("button1_icon_".$collection_object->param, $button1_icon);

            $edgtSlideButtons->addChild("button1_icon_".$collection_object->param."_container", $button1_icon_container);
        }

    }

//Button 2
    $button2_section = new EdgeTitle("button2_section", "Button 2");
    $edgtSlideButtons->addChild("button2_section", $button2_section);

        $button2_group2 = new EdgeGroup("Text Style","Define text style");
        $edgtSlideButtons->addChild("button2_group2",$button2_group2);
            $row1 = new EdgeRow();
            $button2_group2->addChild("row1",$row1);

                $button2_font_family = new EdgeMetaField("Fontsimple","edgt_slide-button_font_family2","-1","Font Family","This is some description");
                $row1->addChild("edgt_slide-button_font_family2",$button2_font_family);
                $button2_font_size = new EdgeMetaField("textsimple","edgt_slide-button_font_size2","","Font Size (px)","This is some description");
                $row1->addChild("edgt_slide-button_font_size2",$button2_font_size);
                $button2_font_style = new EdgeMetaField("selectblanksimple","edgt_slide-button_font_style2","","Font Style","This is some description",$options_fontstyle);
                $row1->addChild("edgt_slide-button_font_style2",$button2_font_style);
                $button2_font_weight = new EdgeMetaField("selectblanksimple","edgt_slide-button_font_weight2","","Font Weight","This is some description",$options_fontweight);
                $row1->addChild("edgt_slide-button_font_weight2",$button2_font_weight);

            $row2 = new EdgeRow();
            $button2_group2->addChild("row2",$row2);
                $button2_letter_spacing= new EdgeMetaField("textsimple","edgt_slide-button_letter_spacing2","","Letter Spacing(px)","This is some description");
                $row2->addChild("edgt_slide-button_letter_spacing2",$button2_letter_spacing);
                $button2_line_height = new EdgeMetaField("textsimple","edgt_slide-button_line_height2","","Line Height (px)","This is some description");
                $row2->addChild("edgt_slide-button_line_height2",$button2_line_height);
                $button2_text_color = new EdgeMetaField("colorsimple","edgt_slide-button_text_color2","","Text Color","This is some description");
                $row2->addChild("edgt_slide-button_text_color2",$button2_text_color);
                $button2_text_hover_color = new EdgeMetaField("colorsimple","edgt_slide-button_text_hover_color2","","Text Hover Color","This is some description");
                $row2->addChild("edgt_slide-button_text_hover_color2",$button2_text_hover_color);

            $row3 = new EdgeRow();
            $button2_group2->addChild("row3",$row3);
                $button2_text_align = new EdgeMetaField("selectblanksimple","edgt_slide-button_text_align2","","Text Align","This is some description", array(
                    "left" => "Left",
                    "center" => "Center",
                    "right" => "Right"
                ));
                $row3->addChild("edgt_slide-button_text_align2",$button2_text_align);
                $button2_text_transform = new EdgeMetaField("selectblanksimple","edgt_slide-button_text_transform2","","Text Transform","This is some description",$options_texttransform);
                $row3->addChild("edgt_slide-button_text_transform2",$button2_text_transform);

        $button2_group3 = new EdgeGroup("Background","Define background");
        $edgtSlideButtons->addChild("button2_group3",$button2_group3);
            $row4 = new EdgeRow();
        $button2_group3->addChild("row4",$row4);
                $button2_background_color = new EdgeMetaField("colorsimple","edgt_slide-button_background_color2","","Background Color","This is some description");
                $row4->addChild("edgt_slide-button_background_color2",$button2_background_color);
                $button2_background_hover_color = new EdgeMetaField("colorsimple","edgt_slide-button_background_hover_color2","","Background Hover Color","This is some description");
                $row4->addChild("edgt_slide-button_background_hover_color2",$button2_background_hover_color);

        $button2_group4 = new EdgeGroup("Size","Define button size");
        $edgtSlideButtons->addChild("button2_group4",$button2_group4);
            $row1 = new EdgeRow();
            $button2_group4->addChild("row1",$row1);
                $button2_width = new EdgeMetaField("textsimple","edgt_slide-button_width2","","Width (px)","This is some description");
                $row1->addChild("edgt_slide-button_width2",$button2_width);
                $button2_height = new EdgeMetaField("textsimple","edgt_slide-button_height2","","Height (px)","This is some description");
                $row1->addChild("edgt_slide-button_height2",$button2_height);

        $button2_group5 = new EdgeGroup("Border","Define border style");
        $edgtSlideButtons->addChild("button2_group5",$button2_group5);
            $row1 = new EdgeRow();
            $button2_group5->addChild("row1",$row1);
                $button2_border_width = new EdgeMetaField("textsimple","edgt_slide-button_border_width2","","Border Width (px)","This is some description");
                $row1->addChild("edgt_slide-button_border_width2",$button2_border_width);
                $button2_border_radius = new EdgeMetaField("textsimple","edgt_slide-button_border_radius2","","Border Radius (px)","This is some description");
                $row1->addChild("edgt_slide-button_border_radius2",$button2_border_radius);
                $button2_border_color = new EdgeMetaField("colorsimple","edgt_slide-button_border_color2","","Border Color","This is some description");
                $row1->addChild("edgt_slide-button_border_color2",$button2_border_color);
                $button2_border_hover_color = new EdgeMetaField("colorsimple","edgt_slide-button_border_hover_color2","","Border Hover Color","This is some description");
                $row1->addChild("edgt_slide-button_border_hover_color2",$button2_border_hover_color);

        $button2_margin = new EdgeMetaField("text","edgt_slide-button_margin2","","Margin (px)","Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px", array(), array("col_width" => 3));
        $edgtSlideButtons->addChild("edgt_slide-button_margin2",$button2_margin);

        $button2_group6 = new EdgeGroup("Padding","Define left/right padding for button (px)");
        $edgtSlideButtons->addChild("button2_group6",$button2_group6);

            $row1 = new EdgeRow(true);
            $button2_group6->addChild("row1",$row1);

            $button2_padding = new EdgeMetaField("textsimple","edgt_slide-button_padding2","","","This is some description");
            $row1->addChild("edgt_slide-button_padding2",$button2_padding);

    //init icon pack hide and show array. It will be populated dinamically from collections array
    $button2_icon_pack_hide_array = array();
    $button2_icon_pack_show_array = array();
    
    //do we have some collection added in collections array?
    if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
        //get collections params array. It will contain values of 'param' property for each collection
        $button2_icon_collections_params = $edgtIconCollections->getIconCollectionsParams();
    
        //foreach collection generate hide and show array
        foreach ($edgtIconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
            $button2_icon_pack_hide_array[$dep_collection_key] = '';
            $button2_icon_pack_hide_array["no_icon"] = "";
    
            //we need to include only current collection in show string as it is the only one that needs to show
            $button2_icon_pack_show_array[$dep_collection_key] = '#edgtf_button2_icon_'.$dep_collection_object->param.'_container';
    
            //for all collections param generate hide string
            foreach ($button2_icon_collections_params as $button2_icon_collections_param) {
                //we don't need to include current one, because it needs to be shown, not hidden
                if($button2_icon_collections_param !== $dep_collection_object->param) {
                    $button2_icon_pack_hide_array[$dep_collection_key].= '#edgtf_button2_icon_'.$button2_icon_collections_param.'_container,';
                }
    
                $button2_icon_pack_hide_array["no_icon"] .= '#edgtf_button2_icon_'.$button2_icon_collections_param.'_container,';
            }
    
            //remove remaining ',' character
            $button2_icon_pack_hide_array[$dep_collection_key] = rtrim($button2_icon_pack_hide_array[$dep_collection_key], ',');
            $button2_icon_pack_hide_array["no_icon"] = rtrim($button2_icon_pack_hide_array["no_icon"], ',');
        }
    
    }
    
    $button2_icon_pack = new EdgeMetaField(
        "select",
        "button2_icon_pack",
        "no_icon",
        "Button 2 Icon Pack",
        "Choose icon pack for first button",
        $edgtIconCollections->getIconCollectionsEmpty("no_icon"),
        array(
            "dependence" => true,
            "hide" => $button2_icon_pack_hide_array,
            "show" => $button2_icon_pack_show_array
        ));
    
    $edgtSlideButtons->addChild("button2_icon_pack", $button2_icon_pack);
    
    if(is_array($edgtIconCollections->iconCollections) && count($edgtIconCollections->iconCollections)) {
        //foreach icon collection we need to generate separate container that will have dependency set
        //it will have one field inside with icons dropdown
        foreach ($edgtIconCollections->iconCollections as $collection_key => $collection_object) {
            $icons_array = $collection_object->getIconsArray();
    
            //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
            $icon_collections_keys = $edgtIconCollections->getIconCollectionsKeys();
    
            //unset current one, because it doesn't have to be included in dependency that hides icon container
            unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);
    
            $button2_icon_hide_values = $icon_collections_keys;
            $button2_icon_hide_values[] = "no_icon";
            $button2_icon_container = new EdgeContainer("button2_icon_".$collection_object->param."_container", "button2_icon_pack", "", $button2_icon_hide_values);
            $button2_icon = new EdgeMetaField("select", "button2_icon_".$collection_object->param, "", "Button 2 Icon","Choose First Button Icon", $icons_array, array("col_width" => 3));
            $button2_icon_container->addChild("button2_icon_".$collection_object->param, $button2_icon);
    
            $edgtSlideButtons->addChild("button2_icon_".$collection_object->param."_container", $button2_icon_container);
        }
    
    }

//Edge Slide Content Positioning

$edgtSlideContentPositioning = new EdgeMetaBox("slides", "Edge Slide Content Positioning");
$edgtFramework->edgtMetaBoxes->addMetaBox("slides_content_positioning",$edgtSlideContentPositioning);
	
	$edgt_slide_predefined_content_position = new EdgeMetaField("selectblank","edgt_slide_predefined_content_position","","Predefined content position","Choose position of slide content", array(
	    "" => "",
		"content_bottom_left" => "Bottom Left",
		"content_bottom_right" => "Bottom Right"
	),
	array("dependence" => true,
      	"hide" => array(
      		""=>"#edgtf_edgt_slide_predefined_content_position_width_container",
			"content_bottom_left" => "#edgtf_edgt_slide_predefined_content_position_container",
			"content_bottom_right" => "#edgtf_edgt_slide_predefined_content_position_container"),
      	"show" => array(
      		""=>"#edgtf_edgt_slide_predefined_content_position_container",
			"content_bottom_left" => "#edgtf_edgt_slide_predefined_content_position_width_container",
			"content_bottom_right" => "#edgtf_edgt_slide_predefined_content_position_width_container")
	));
	$edgtSlideContentPositioning->addChild("edgt_slide_predefined_content_position",$edgt_slide_predefined_content_position);
	
	$edgt_slide_predefined_content_position_width_container = new EdgeContainerNoStyle("edgt_slide_predefined_content_position_width_container","edgt_slide_predefined_content_position","");
    $edgtSlideContentPositioning->addChild("edgt_slide_predefined_content_position_width_container",$edgt_slide_predefined_content_position_width_container);
	
		$edgt_slide_predefined_content_position_width = new EdgeMetaField("text","edgt_slide_predefined_content_position_width","","Content Width","Enter Width for Content Area (px)",array(), array("col_width" => 3));
		$edgt_slide_predefined_content_position_width_container->addChild("edgt_slide_predefined_content_position_width",$edgt_slide_predefined_content_position_width);
	
	$edgt_slide_predefined_content_position_container = new EdgeContainerNoStyle("edgt_slide_predefined_content_position_container","edgt_slide_predefined_content_position","content_bottom_left",array( "content_bottom_left","content_bottom_right"));
    $edgtSlideContentPositioning->addChild("edgt_slide_predefined_content_position_container",$edgt_slide_predefined_content_position_container);
	
		$edgt_slide_text_alignment = new EdgeMetaField("selectblank","edgt_slide-content-alignment","","Text Alignment","Choose an alignment for the slide text", array(
			"left" => "Left",
			"center" => "Center",
			"right" => "Right"
		));
		$edgt_slide_predefined_content_position_container->addChild("edgt_slide-content-alignment",$edgt_slide_text_alignment);
		
		$edgt_slide_separate_text_graphic = new EdgeMetaField("selectblank","edgt_slide-separate-text-graphic","no","Separate Graphic and Text Positioning","Do you want to separately position graphic and text?", array(
			"no" => "No",
			"yes" => "Yes"
		), array("dependence" => true,
				 "hide" => array(
					"" => "#edgtf_edgt_slide_graphic_positioning_container, #edgtf_edgt_slide_general_animation_separate_container",
					"no" => "#edgtf_edgt_slide_graphic_positioning_container, #edgtf_edgt_slide_general_animation_separate_container"
				 ),
				 "show" => array(
					 "yes" => "#edgtf_edgt_slide_graphic_positioning_container, #edgtf_edgt_slide_general_animation_separate_container"
				 )));
		$edgt_slide_predefined_content_position_container->addChild("edgt_slide-separate-text-graphic",$edgt_slide_separate_text_graphic);



		$edgt_slide_content_vertical_middle = new EdgeMetaField("yesno","edgt_slide-content-vertical-middle","no","Vertically Align Content to Middle","", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_edgt_slide-content-vertical-middle-container", "dependence_show_on_yes" => "#edgtf_edgt_slide-content-vertical-middle-type-container"));
		$edgt_slide_predefined_content_position_container->addChild("edgt_slide-content-vertical-middle",$edgt_slide_content_vertical_middle);

		$edgt_slide_content_vertical_middle_type_container = new EdgeContainer("edgt_slide-content-vertical-middle-type-container","edgt_slide-content-vertical-middle","no");
		$edgt_slide_predefined_content_position_container->addChild("edgt_slide-content-vertical-middle-type-container",$edgt_slide_content_vertical_middle_type_container);

			$edgt_slide_content_vertical_middle_type = new EdgeMetaField("selectblank","edgt_slide-content-vertical-middle-type","","Align Content Vertically Relative to the Height Measured From","", array(
				"bottom_of_header" => "Bottom of Header",
				"window_top" => "Window Top"
			));
			$edgt_slide_content_vertical_middle_type_container->addChild("edgt_slide-content-vertical-middle-type",$edgt_slide_content_vertical_middle_type);


		$edgt_slide_content_vertical_middle_container = new EdgeContainer("edgt_slide-content-vertical-middle-container","edgt_slide-content-vertical-middle","yes");
		$edgt_slide_predefined_content_position_container->addChild("edgt_slide-content-vertical-middle-container",$edgt_slide_content_vertical_middle_container);

			$edgt_slide_content_full_width = new EdgeMetaField("yesno","edgt_slide-content-full-width","no","Content Full Width","Do you want to set slide content to full width?", array(), array("dependence" => true, "dependence_hide_on_yes" => "#edgtf_edgt_slide_content_width_container", "dependence_show_on_yes" => ""));
			$edgt_slide_content_vertical_middle_container->addChild("edgt_slide-content-full-width",$edgt_slide_content_full_width);

			$edgt_slide_content_width_container = new EdgeContainer("edgt_slide_content_width_container","edgt_slide-content-full-width","yes");
			$edgt_slide_content_vertical_middle_container->addChild("edgt_slide_content_width_container",$edgt_slide_content_width_container);

			$edgt_slide_content_width = new EdgeMetaField("text","edgt_slide-content-width","","Content Width","Enter Width for Content Area (%)",array(), array("col_width" => 3));
			$edgt_slide_content_width_container->addChild("edgt_slide-content-width",$edgt_slide_content_width);

			$content_positioning_group = new EdgeGroup("Space Around Content in Slide","Enter values for margins around slide content");
			$edgt_slide_content_vertical_middle_container->addChild("content_positioning_group",$content_positioning_group);
				$row1 = new EdgeRow(true);
				$content_positioning_group->addChild("row1",$row1);
					$edgt_slide_content_top = new EdgeMetaField("textsimple","edgt_slide-content-top","","From Top (%)","This is some description");
					$row1->addChild("edgt_slide-content-top",$edgt_slide_content_top);
					$edgt_slide_content_left = new EdgeMetaField("textsimple","edgt_slide-content-left","","From Left (%)","This is some description");
					$row1->addChild("edgt_slide-content-left",$edgt_slide_content_left);
					$edgt_slide_content_bottom = new EdgeMetaField("textsimple","edgt_slide-content-bottom","","From Bottom (%)","This is some description");
					$row1->addChild("edgt_slide-content-bottom",$edgt_slide_content_bottom);
					$edgt_slide_content_right = new EdgeMetaField("textsimple","edgt_slide-content-right","","From Right (%)","This is some description");
					$row1->addChild("edgt_slide-content-right",$edgt_slide_content_right);


		$edgt_slide_graphic_positioning_container = new EdgeContainer("edgt_slide_graphic_positioning_container","edgt_slide-separate-text-graphic","no");
		$edgt_slide_content_vertical_middle_container->addChild("edgt_slide_graphic_positioning_container",$edgt_slide_graphic_positioning_container);


		$edgt_slide_graphic_alignment = new EdgeMetaField("selectblank","edgt_slide-graphic-alignment","","Graphic Alignment","Choose an alignment for the slide graphic", array(
			"left" => "Left",
			"center" => "Center",
			"right" => "Right"
		));
		$edgt_slide_graphic_positioning_container->addChild("edgt_slide-graphic-alignment",$edgt_slide_graphic_alignment);

		$graphic_positioning_group = new EdgeGroup("Graphic Positioning","Positioning for slide graphic");
		$edgt_slide_graphic_positioning_container->addChild("graphic_positioning_group",$graphic_positioning_group);

		
			$row1 = new EdgeRow();
			$graphic_positioning_group->addChild("row1",$row1);

				$edgt_slide_content_top = new EdgeMetaField("textsimple","edgt_slide-graphic-top","","From Top (%)","This is some description");
				$row1->addChild("edgt_slide-graphic-top",$edgt_slide_content_top);

				$edgt_slide_content_left = new EdgeMetaField("textsimple","edgt_slide-graphic-left","","From Left (%)","This is some description");
				$row1->addChild("edgt_slide-graphic-left",$edgt_slide_content_left);

				$edgt_slide_content_bottom = new EdgeMetaField("textsimple","edgt_slide-graphic-bottom","","From Bottom (%)","This is some description");
				$row1->addChild("edgt_slide-graphic-bottom",$edgt_slide_content_bottom);

				$edgt_slide_content_right = new EdgeMetaField("textsimple","edgt_slide-graphic-right","","From Right (%)","This is some description");
				$row1->addChild("edgt_slide-graphic-right",$edgt_slide_content_right);

			$row2 = new EdgeRow(true);
			$graphic_positioning_group->addChild("row2",$row2);

				$edgt_slide_content_width = new EdgeMetaField("textsimple","edgt_slide-graphic-width","","Width (%)","This is some description");
				$row2->addChild("edgt_slide-graphic-width",$edgt_slide_content_width);

    $edgt_slide_content_padding = new EdgeMetaField("text","edgt_slide-content-text-padding","","Slide Content Text Padding","Define some padding around text (top right bottom left) - Default value is 0px 0px 0px 0px");
    $edgtSlideContentPositioning->addChild("edgt_slide-content-text-padding",$edgt_slide_content_padding);    