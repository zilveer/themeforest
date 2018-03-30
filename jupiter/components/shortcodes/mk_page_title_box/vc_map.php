<?php

vc_map(array(
    "name" => __("Page Title Box", "mk_framework") ,
    "base" => "mk_page_title_box",
    'icon' => 'icon-mk-animated-columns vc_mk_element-icon',
    'description' => __('Page title area with effects.', 'mk_framework') ,
    "category" => __('General', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Enter Page Title", "mk_framework") ,
            "param_name" => "page_title",
            "value" => "",
            "description" => __("Enter the title of your page and adjust font settings below", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Enter Page Subtitle", "mk_framework") ,
            "param_name" => "page_subtitle",
            "value" => "",
            "description" => __("Enter the subtitle of your page and adjust font settings below", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Section Height", "mk_framework") ,
            "param_name" => "section_height",
            "value" => "400",
            "min" => "0",
            "max" => "1000",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Type", "mk_framework") ,
            "param_name" => "bg_type",
            "value" => array(
                __('Image', "mk_framework") => "image",
                __('Video', "mk_framework") => "video",
                __('Color', "mk_framework") => "color"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video (.MP4)", "mk_framework") ,
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Upload your video with .MP4 extension. (Compatibility for Safari and IE9)", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'video'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video (.WebM)", "mk_framework") ,
            "param_name" => "webm",
            "value" => "",
            "description" => __("Upload your video with .WebM extension. (Compatibility for Firefox4, Opera, and Chrome)", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'video'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video (.OGV)", "mk_framework") ,
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Upload your video with .OGV extension. (Compatibility for Firefox4, Opera, and Chrome)", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'video'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Video Preview Image", "mk_framework") ,
            "param_name" => "video_preview",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'video'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Image", "mk_framework") ,
            "param_name" => "bg_image",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'image'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Image (Portrait)", "mk_framework") ,
            "param_name" => "bg_image_portrait",
            "value" => "",
            "description" => __("Alternatively, this image could be shown in mobile devices with portrait orientation. It is recommended to use images with portrait ratio such as 2:3.", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'image'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'color'
                )
            )
        ) ,

        array(
            "type" => "dropdown",
            "heading" => __("Background Position", "mk_framework") ,
            "param_name" => "bg_position",
            "width" => 300,
            "value" => array(
                __('Left Top', "mk_framework") => "left top",
                __('Center Top', "mk_framework") => "center top",
                __('Right Top', "mk_framework") => "right top",
                __('Left Center', "mk_framework") => "left center",
                __('Center Center', "mk_framework") => "center center",
                __('Right Center', "mk_framework") => "right center",
                __('Left Bottom', "mk_framework") => "left bottom",
                __('Center Bottom', "mk_framework") => "center bottom",
                __('Right Bottom', "mk_framework") => "right bottom"
            ) ,
            "description" => __("First value defines horizontal position and second vertical position.", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'image'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __('Cover whole background', 'mk_framework') ,
            "description" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework") ,
            "param_name" => "bg_stretch",
            "value" => "false",
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'image'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Color Overlay", "mk_framework") ,
            "param_name" => "overlay",
            "value" => "",
            "description" => __("The overlay layer Color. You will need to change the alpha using this color picker to give an opacity to the color you choose.", "mk_framework") ,
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Effects", "mk_framework") ,
            "param_name" => "bg_effects",
            "width" => 300,
            "value" => array(
                __('-- No Effect', "mk_framework") => "",
                __('Parallax', "mk_framework") => "parallax",
                __('Parallax Zoom Out', "mk_framework") => "parallaxZoomOut",
                __('Gradient Fade In', "mk_framework") => "gradient"
            ) ,
            "description" => __("Choose effects for your page title. Please note that Smooth Scroll option should be enabled for this feature function correctly. Smooth Scroll option is loctated in Theme Options > General Settings > Global > Smooth Scroll.", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_type",
                'value' => array(
                    'image',
                    'video'
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Attachment", "mk_framework") ,
            "param_name" => "attachment",
            "width" => 150,
            "value" => array(
                __('Scroll', "mk_framework") => "scroll",
                __('Fixed', "mk_framework") => "fixed"
            ) ,
            "description" => __("This option sets whether the background image is fixed or scrolls with the rest of the page. <a href='http://www.w3schools.com/CSSref/pr_background-attachment.asp'>Read More</a>", "mk_framework") ,
            "dependency" => array(
                'element' => "bg_effects",
                'value' => array(
                    ''
                )
            )
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Text Align", "mk_framework") ,
            "param_name" => "text_align",
            "width" => 150,
            "value" => array(
                __('Center', "mk_framework") => "center",
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Title Font Size", "mk_framework") ,
            "param_name" => "font_size",
            "min" => "10",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "value" => "50"
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Title Force Responsive Font Size", "mk_framework") ,
            "param_name" => "title_force_font_size",
            "value" => "false",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size for Small Desktops", "mk_framework") ,
            "param_name" => "title_size_smallscreen",
            "value" => "0",
            "min" => "0",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("For screens smaller than 1280px. If value is zero the font size not going to be affected.", "mk_framework"),
            "dependency" => array(
                'element' => "title_force_font_size",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size for Tablet", "mk_framework") ,
            "param_name" => "title_size_tablet",
            "value" => "0",
            "min" => "0",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("For screens between 768 and 1024px. If value is zero the font size not going to be affected.", "mk_framework"),
            "dependency" => array(
                'element' => "title_force_font_size",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Font Size for Mobile", "mk_framework") ,
            "param_name" => "title_size_phone",
            "value" => "0",
            "min" => "0",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("For screens smaller than 768px. If value is zero the font size not going to be affected.", "mk_framework"),
            "dependency" => array(
                'element' => "title_force_font_size",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Title Letter Spacing", "mk_framework") ,
            "param_name" => "title_letter_spacing",
            "min" => "1",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "value" => "3"
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Title Color", "mk_framework") ,
            "param_name" => "font_color",
            "value" => "#ddd",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Title Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __('Title Underline', 'mk_framework') ,
            "description" => __("", "mk_framework") ,
            "param_name" => "underline",
            "value" => "true"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Title Padding", "mk_framework") ,
            "param_name" => "padding",
            "min" => "10",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "value" => "20"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Subtitle Font Size", "mk_framework") ,
            "param_name" => "sub_font_size",
            "min" => "10",
            "max" => "100",
            "step" => "1",
            "unit" => 'px',
            "value" => "30"
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Subtitle Force Responsive Font Size", "mk_framework") ,
            "param_name" => "subtitle_force_font_size",
            "value" => "false",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size for Small Desktops", "mk_framework") ,
            "param_name" => "subtitle_size_smallscreen",
            "value" => "0",
            "min" => "0",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("For screens smaller than 1280px. If value is zero the font size not going to be affected.", "mk_framework"),
            "dependency" => array(
                'element' => "subtitle_force_font_size",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size for Tablet", "mk_framework") ,
            "param_name" => "subtitle_size_tablet",
            "value" => "0",
            "min" => "0",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("For screens between 768 and 1024px. If value is zero the font size not going to be affected.", "mk_framework"),
            "dependency" => array(
                'element' => "subtitle_force_font_size",
                'value' => array(
                    'true'
                )
            )
        ),
        array(
            "type" => "range",
            "heading" => __("Font Size for Mobile", "mk_framework") ,
            "param_name" => "subtitle_size_phone",
            "value" => "0",
            "min" => "0",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("For screens smaller than 768px. If value is zero the font size not going to be affected.", "mk_framework"),
            "dependency" => array(
                'element' => "subtitle_force_font_size",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Subtitle Color", "mk_framework") ,
            "param_name" => "sub_font_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Subtitle Font Weight", "mk_framework") ,
            "param_name" => "sub_font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        )
    )
));
