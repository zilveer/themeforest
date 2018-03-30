<?php

$general_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_preloader_section",
    "name" => __("General / Site Preloader Settings", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
        array(
            "name" => __("Preloader", "mk_framework") ,
            "desc" => __("You can enable preloader globally for all pages of the site, or enable it from page/post metaboxes for a specific page.", "mk_framework") ,
            "id" => "preloader",
            "default" => 'false',
            "type" => "toggle",
        ) ,
        array(
            "name" => __("Retina Preloader", "mk_framework") ,
            "desc" => __("If you enabled this option, Please make sure to upload your logo 2x larger.", "mk_framework") ,
            "id" => "retina_preloader",
            "default" => 'false',
            "type" => "toggle",
        ) ,
        array(
            "name" => __("Preloader Logo", "mk_framework") ,
            "desc" => __("Using this option, You can upload logo to be shown in preloader.", "mk_framework") ,
            "id" => "preloader_logo",
            "default" => '',
            "type" => 'upload',
        ) ,
        array(
            "name" => __('Preloader Color', "mk_framework") ,
            "desc" => __("If left blank theme accent color will be used instead.", "mk_framework") ,
            "id" => "preloader_icon_color",
            "default" => "#7c7c7c",
            "type" => "color",
        ) ,
        array(
            "name" => __('Background Color', "mk_framework") ,
            "desc" => __("", "mk_framework") ,
            "id" => "preloader_bg_color",
            "default" => "#fff",
            "type" => "color",
        ) ,
        array(
            "name" => __("Preloader Animation", "mk_framework") ,
            "id" => "preloader_animation",
            "default" => "ball_pulse",
            "item_padding" => "30px 30px 0 0",
            "selector_type" => "html",
            "options" => array(
                "ball_pulse" => '<div class="visual_preloader"><div class="ball-pulse"><div></div><div></div><div></div></div></div>',
                "ball_clip_rotate_pulse" => '<div class="visual_preloader"><div class="ball-clip-rotate-pulse"><div></div><div></div></div></div>',
                "square_spin" => '<div class="visual_preloader"><div class="square-spin"><div></div></div></div>',
                "cube_transition" => '<div class="visual_preloader"><div class="cube-transition"><div></div><div></div></div></div>',
                "ball_scale" => '<div class="visual_preloader"><div class="ball-scale"><div></div></div></div>',
                "line_scale" => '<div class="visual_preloader"><div class="line-scale"><div></div><div></div><div></div><div></div><div></div></div></div>',
                "ball_scale_multiple" => '<div class="visual_preloader"><div class="ball-scale-multiple"><div></div><div></div><div></div></div></div>',
                "ball_pulse_sync" => '<div class="visual_preloader"><div class="ball-pulse-sync"><div></div><div></div><div></div></div></div>',
                "transparent_circle" => '<div class="visual_preloader"><div class="transparent-circle"></div></div>',
                "ball_spin_fade_loader" => '<div class="visual_preloader"><div class="ball-spin-fade-loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>'
            ) ,
            "type" => "visual_selector",
        ) ,
        array(
            "name" => __('Section Preloader Background Color', "mk_framework") ,
            "desc" => __("This option will affect Page Section and Edge Slider shortcodes.", "mk_framework") ,
            "id" => "section_preloader_color",
            "default" => "#fff",
            "type" => "color",
        ) ,
    
    ) ,
);