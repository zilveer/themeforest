<?php
vc_map(array(
    "name" => __("Theatre Slider", "mk_framework") ,
    "base" => "mk_theatre_slider",
    'icon' => 'vc_mk_element-icon',
    "category" => __('Slideshows', 'mk_framework') ,
    'description' => __('', 'mk_framework') ,
    "params" => array(
        array(
            "heading" => __("Background Style", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "background_style",
            "value" => array(
                __("Desktop", 'mk_framework') => "desktop_style",
                __("Laptop", 'mk_framework') => "laptop_style"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Slider Max Width", "mk_framework") ,
            "param_name" => "max_width",
            "value" => "900",
            "min" => "320",
            "max" => "1200",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "heading" => __("Video Host", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "host",
            "value" => array(
                __("Self Hosted", 'mk_framework') => "self_hosted",
                __("Social Hosted", 'mk_framework') => "social_hosted"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "upload",
            "heading" => __("MP4 Format", "mk_framework") ,
            "param_name" => "mp4",
            "value" => "",
            "description" => __("Compatibility for Safari, IE9", "mk_framework") ,
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'self_hosted'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("WebM Format", "mk_framework") ,
            "param_name" => "webm",
            "value" => "",
            "description" => __("Compatibility for Firefox4, Opera, and Chrome", "mk_framework") ,
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'self_hosted'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("OGV Format", "mk_framework") ,
            "param_name" => "ogv",
            "value" => "",
            "description" => __("Compatibility for older Firefox and Opera versions", "mk_framework") ,
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'self_hosted'
                )
            )
        ) ,
        array(
            "type" => "upload",
            "heading" => __("Background Video Preview image (and fallback image)", "mk_framework") ,
            "param_name" => "poster_image",
            "value" => "",
            "description" => __("This Image will shown until video load. in case of video is not supported or did not load the image will remain as fallback.", "mk_framework") ,
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'self_hosted'
                )
            )
        ) ,
        array(
            "heading" => __("Stream Host Website", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "stream_host_website",
            "value" => array(
                __("Youtube", 'mk_framework') => "youtube",
                __("Vimeo", 'mk_framework') => "vimeo"
            ) ,
            "type" => "dropdown",
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'social_hosted'
                )
            ) ,
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Show Social Video Controls", "mk_framework") ,
            "param_name" => "video_controls",
            "value" => "true",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "stream_host_website",
                'value' => array(
                    'youtube'
                )
            )
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Video ID", "mk_framework") ,
            "param_name" => "stream_video_id",
            "value" => "",
            "description" => __("", "mk_framework") ,
            "dependency" => array(
                'element' => "host",
                'value' => array(
                    'social_hosted'
                )
            )
        ) ,
        array(
            "heading" => __("Slider Align", 'mk_framework') ,
            "description" => __("", 'mk_framework') ,
            "param_name" => "align",
            "value" => array(
                __("Left", 'mk_framework') => "left",
                __("Center", 'mk_framework') => "center",
                __("Right", 'mk_framework') => "right"
            ) ,
            "type" => "dropdown"
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "25",
            "min" => "10",
            "max" => "250",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));
