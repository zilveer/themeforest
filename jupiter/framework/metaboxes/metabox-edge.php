<?php
$config = array(
    'title' => __('Add New Slider', 'mk_framework') ,
    'id' => 'mk-metaboxes-edge',
    'pages' => array(
        'edge'
    ) ,
    'callback' => '',
    'context' => 'normal', 
    'priority' => 'core'
);
$options = array(
    
    array(
        "name" => __("Content Animation", "mk_framework") ,
        "subtitle" => __("The type animation for this slide content", "mk_framework") ,
        "desc" => __("Using this option you can define specific animations for the content of this slider. This option will affect custom content that you create from above WP editor or the built-in captions and buttons.", "mk_framework") ,
        "id" => "_animation",
        "default" => '',
        "options" => array(
            "" => __("Default", 'mk_framework') ,
            "fade-in" => __("Fade in", 'mk_framework') ,
            "slide-top" => __('Slide from Top', 'mk_framework') ,
            "slide-left" => __('Slide from Left', 'mk_framework') ,
            "slide-bottom" => __('Slide from Bottom', 'mk_framework') ,
            "slide-right" => __('Slide from Right', 'mk_framework') ,
            "scale-down" => __('Scale Down', 'mk_framework') ,
            "flip-x" => __('Horizontally Flip', 'mk_framework') ,
            "flip-y" => __('Vertically Flip', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Slider Type", "mk_framework") ,
        "desc" => __("Do you want to have video or Image for this slide item?", "mk_framework") ,
        "id" => "_edge_type",
        "default" => 'image',
        "options" => array(
            "image" => __("Image", 'mk_framework') ,
            "video" => __('Video', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Upload Video (MP4 format)", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_video_mp4",
        "default" => '',
        "preview" => false,
        "type" => 'upload',
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'video',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Upload Video (WebM format)", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_video_webm",
        "default" => '',
        "preview" => false,
        "type" => 'upload',
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'video',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Upload Video (OGV format)", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_video_ogv",
        "default" => '',
        "preview" => false,
        "type" => 'upload',
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'video',
            )
        ) ,
    ) ,
    array(
        "name" => __("Upload Video Preview Image", "mk_framework") ,
        "desc" => __("This Image will be shown until the video load.", "mk_framework") ,
        "id" => "_video_preview",
        "default" => '',
        "type" => 'upload',
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'video',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Upload Image", "mk_framework") ,
        "desc" => __("Upload slideshow image. Image will fit to the container size however for better quality in all browsers recommded size is 1920px * 1080px.", "mk_framework") ,
        "id" => "_slide_image",
        "default" => '',
        "preview" => true,
        "type" => 'upload',
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'image',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Upload Portrait Image", "mk_framework") ,
        "desc" => __("Alternatively, this image could be shown in mobile devices with portrait orientation. It is recommended to use images with portrait ratio such as 2:3.", "mk_framework") ,
        "id" => "_slide_image_portrait",
        "default" => '',
        "preview" => true,
        "type" => 'upload',
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'image',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Cover whole background", "mk_framework") ,
        "subtitle" => __("This option is only when image is uploaded.", "mk_framework") ,
        "desc" => __("Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area.", "mk_framework") ,
        "id" => "_cover",
        "default" => "true",
        "type" => "toggle",
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'image',
            )
        ) ,
    ) ,
    
    array(
        "name" => __('background Color', 'mk_framework') ,
        "desc" => __("You can use solid color in slideshow instead of image", "mk_framework") ,
        "id" => "_bg_color",
        "default" => "",
        "type" => "color",
        "dependency" => array(
            'element' => "_edge_type",
            'value' => array(
                'image',
            )
        ) ,
    ) ,
    
    array(
        "name" => __("Show Pattern Mask", "mk_framework") ,
        "desc" => __("If you enable this option a pattern will overlay the video or image.", "mk_framework") ,
        "id" => "_video_pattern",
        "default" => "false",
        "type" => "toggle"
    ) ,
    
    array(
        "name" => __('Color Overlay', 'mk_framework') ,
        "id" => "_video_color_overlay",
        "default" => "",
        "type" => "color"
    ) ,
    array(
        "name" => __("Color Overlay Opacity", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_overlay_opacity",
        "default" => "0.3",
        "min" => "0",
        "max" => "1",
        "step" => "0.1",
        "unit" => 'alpha',
        "type" => "range"
    ) ,

    array(
        "type" => "select",
        "name" => __("Gradient Overlay Orientation", "mk_framework") ,
        "id" => "_gradient_layer",
        "default" => "false",
        "options" => array(
            "false" => __('-- No Gradient ↓', "mk_framework"),
            "vertical" => __('Vertical ', "mk_framework"),
            "horizontal" => __('Horizontal →', "mk_framework"),
            "left_top" => __('Diagonal ↘', "mk_framework"),
            "left_bottom" => __('Diagonal ↗', "mk_framework"),
            "radial" => __('Radial ○', "mk_framework")
        ) ,
        "desc" => __("Choose the orientation of gradient overlay", "mk_framework")
    ) ,

    array(
        "type" => "color",
        "name" => __("Gradient Layer Color Start", "mk_framework") ,
        "id" => "_gr_start",
        "default" => "",
        "description" => __("The ending color for gradient fill overlay. Use only with gradient option selected.", "mk_framework") ,
        "dependency" => array(
            'element' => "_gradient_layer",
            'value' => array(
                "vertical",
                "horizontal",
                "left_top",
                "left_bottom",
                "radial"
            )
        )
    ) ,
    array(
        "type" => "color",
        "name" => __("Gradient Layer Color End", "mk_framework") ,
        "id" => "_gr_end",
        "default" => "",
        "description" => __("The ending color for gradient fill overlay. Use only with gradient option selected.", "mk_framework") ,
        "dependency" => array(
            'element' => "_gradient_layer",
            'value' => array(
                "vertical",
                "horizontal",
                "left_top",
                "left_bottom",
                "radial"
            )
        )
    ) ,

    array(
        "name" => __("Content Align", "mk_framework") ,
        "desc" => __("Location of caption and buttons. Please note that if you add content via Visual Composer into this post, this option will only control the location of the container inside the main grid. So module-based horizontal alignments should be taken care inside the shortcode options.", "mk_framework") ,
        "id" => "_caption_align",
        "default" => 'left_center',
        "options" => array(
            "left_top" => __("Left Top", 'mk_framework') ,
            "center_top" => __('Center Top', 'mk_framework') ,
            "right_top" => __('Right Top', 'mk_framework') ,
            "left_center" => __('Left Center', 'mk_framework') ,
            "center_center" => __('Center Center', 'mk_framework') ,
            "right_center" => __('Right Center', 'mk_framework') ,
            "left_bottom" => __('Left Bottom', 'mk_framework') ,
            "center_bottom" => __('Center Bottom', 'mk_framework') ,
            "right_bottom" => __('Right Bottom', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Content Width", "mk_framework") ,
        "desc" => __("You can define the content width based on percent. Please note that this width will be defined percent width of main grid. default : 70%", "mk_framework") ,
        "id" => "_content_width",
        "default" => "70",
        "min" => "0",
        "max" => "100",
        "step" => "1",
        "unit" => '%',
        "type" => "range"
    ) ,
    array(
        "name" => __("Caption Title", "mk_framework") ,
        "id" => "_title",
        "default" => '',
        "rows" => "3",
        "type" => "textarea"
    ) ,
    
    array(
        "name" => __("Caption Description", "mk_framework") ,
        "id" => "_description",
        "default" => "",
        "rows" => "3",
        "type" => "textarea"
    ) ,
    array(
        "name" => __("Caption Title Font Size", "mk_framework") ,
        "subtitle" => __("Default : 50", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_title_size",
        "default" => "50",
        "min" => "12",
        "max" => "200",
        "step" => "1",
        "unit" => 'px',
        "type" => "range"
    ) ,
    array(
        "name" => __("Caption Title Letter Spacing", "mk_framework") ,
        "subtitle" => __("Default : 0", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_title_letter_spacing",
        "default" => "0",
        "min" => "0",
        "max" => "20",
        "step" => "1",
        "unit" => 'px',
        "type" => "range"
    ) ,
    array(
        "name" => __("Caption Title Font Weight", "mk_framework") ,
        "subtitle" => __("", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_caption_title_weight",
        "default" => '300',
        "options" => array(
            "inherit" => __('Default', "mk_framework") ,
            "600" => __('Semi Bold', "mk_framework") ,
            "bold" => __('Bold', "mk_framework") ,
            "bolder" => __('Bolder', "mk_framework") ,
            "normal" => __('Normal', "mk_framework") ,
            "300" => __('Light', "mk_framework")
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Caption Skin", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_caption_skin",
        "default" => 'light',
        "options" => array(
            "light" => __("Light", 'mk_framework') ,
            "dark" => __('Dark', 'mk_framework') ,
            "custom" => __('Custom Color (Change from below option)', 'mk_framework') ,
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __('Custom Caption Text Color', 'mk_framework') ,
        "subtitle" => __('This option will only work when you choose custom from "Caption Skin" option above.', 'mk_framework') ,
        "desc" => __("This option will affect both caption title & description.", "mk_framework") ,
        "id" => "_custom_caption_color",
        "default" => "",
        "type" => "color"
    ) ,
    
    array(
        "name" => __("Button 1 Style", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_1_style",
        "default" => 'outline',
        "options" => array(
            "outline" => __("Outline", 'mk_framework') ,
            "flat" => __('Flat', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Button 1 Corner Style", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_1_corner_style",
        "default" => 'pointed',
        "options" => array(
            "pointed" => __("Pointed", 'mk_framework') ,
            "rounded" => __('Rounded', 'mk_framework') ,
            "full_rounded" => __('Full Rounded', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Button 1 Skin", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_1_skin",
        "default" => '',
        "options" => array(
            "dark" => __("Dark", 'mk_framework') ,
            "light" => __('Light', 'mk_framework') ,
            "skin" => __('Theme Skin Color', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Button 1 Text", "mk_framework") ,
        "id" => "_btn_1_txt",
        "default" => '',
        "type" => "text"
    ) ,
    array(
        "name" => __("Button 1 URL", "mk_framework") ,
        "id" => "_btn_1_url",
        "default" => '',
        "type" => "text"
    ) ,
    array(
        "name" => __("Button 1 Target", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_1_target",
        "default" => '_self',
        "options" => array(
            "_self" => __("Same Window", 'mk_framework') ,
            "_blank" => __('New Wnidow', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Button 2 Style", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_2_style",
        "default" => 'outline',
        "options" => array(
            "outline" => __("Outline", 'mk_framework') ,
            "flat" => __('Flat', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Button 2 Corner Style", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_2_corner_style",
        "default" => 'pointed',
        "options" => array(
            "pointed" => __("Pointed", 'mk_framework') ,
            "rounded" => __('Rounded', 'mk_framework') ,
            "full_rounded" => __('Full Rounded', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    array(
        "name" => __("Button 2 Skin", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_2_skin",
        "default" => '',
        "options" => array(
            "dark" => __("Dark", 'mk_framework') ,
            "light" => __('Light', 'mk_framework') ,
            "skin" => __('Theme Skin Color', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Button 2 Text", "mk_framework") ,
        "id" => "_btn_2_txt",
        "default" => '',
        "type" => "text"
    ) ,
    array(
        "name" => __("Button 2 URL", "mk_framework") ,
        "id" => "_btn_2_url",
        "default" => '',
        "type" => "text"
    ) ,
    array(
        "name" => __("Button 2 Target", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_btn_2_target",
        "default" => '_self',
        "options" => array(
            "_self" => __("Same Window", 'mk_framework') ,
            "_blank" => __('New Wnidow', 'mk_framework')
        ) ,
        "type" => "select"
    ) ,
    
    array(
        "name" => __("Transparent Header Style Skin for this Slide", "mk_framework") ,
        "subtitle" => __("If this slide image or video is dark color then you should choose light otherwise dark.", "mk_framework") ,
        "desc" => __("", "mk_framework") ,
        "id" => "_edge_header_skin",
        "default" => 'dark',
        "options" => array(
            "dark" => __("Dark", 'mk_framework') ,
            "light" => __('Light', 'mk_framework') ,
        ) ,
        "type" => "select"
    ) ,
);
new mkMetaboxesGenerator($config, $options);
