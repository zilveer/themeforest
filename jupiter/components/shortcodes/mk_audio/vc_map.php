<?php
    vc_map(array(
        "name" => __("Audio Player", "mk_framework") ,
        "base" => "mk_audio",
        'icon' => 'icon-mk-audio-player vc_mk_element-icon',
        'description' => __('Adds player to your audio files.', 'mk_framework') ,
        "category" => __('General', 'mk_framework') ,
        "params" => array(
            array(
                "type" => "upload",
                "heading" => __("Upload MP3 file format", "mk_framework") ,
                "param_name" => "mp3_file",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "upload",
                "heading" => __("Upload OGG file format", "mk_framework") ,
                "param_name" => "ogg_file",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "upload",
                "heading" => __("Upload A Thumbnail for this audio", "mk_framework") ,
                "param_name" => "thumb",
                "value" => "",
                "description" => __("It will automatically cropped to the correct size needed for the container.", "mk_framework")
            ) ,
            array(
                "type" => "textfield",
                "heading" => __("Sound Author", "mk_framework") ,
                "param_name" => "audio_author",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "colorpicker",
                "heading" => __("Player Background", "mk_framework"),
                "param_name" => "player_background",
                "value" => "",
                "description" => __("If left empty a random color will be shown in each page visit.", "mk_framework"),
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework") ,
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            )
        )
    ));