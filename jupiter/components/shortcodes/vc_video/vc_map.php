<?php
vc_map(array(
    "name" => __("Video player", "mk_framework") ,
    "base" => "vc_video",
    'icon' => 'icon-mk-video-player vc_mk_element-icon',
    'description' => __('Youtube, Vimeo,..', 'mk_framework') ,
    "category" => __('Social', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Video link", "mk_framework") ,
            "param_name" => "link",
            "value" => "",
            "description" => __('Link to the video. For YouTube HD videos add this snippet at the of a link "&vq=1080" (video quality set to 1080p). More about supported formats at <a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>.', "mk_framework")
        ) ,
        $add_css_animations,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your CSS file.", "mk_framework")
        )
    )
));
