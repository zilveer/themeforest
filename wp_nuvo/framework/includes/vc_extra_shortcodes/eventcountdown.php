<?php
if (class_exists('EM_MS_Globals')) {
    vc_map(array(
        "name" => 'Next Event',
        "base" => "cs-next-event",
        "icon" => "cs_icon_for_vc",
        "category" => esc_html__('CS Hero', 'wp_nuvo'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__('Title', 'wp_nuvo'),
                "param_name" => "title"
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Description', 'wp_nuvo'),
                "param_name" => "description"
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Time Zones', 'wp_nuvo'),
                "param_name" => "timezone",
                "value" => "GMT"
            ),
            array(
                "type" => "attach_image",
                "heading" => esc_html__('Image', 'wp_nuvo'),
                "param_name" => "image"
            )
        )
    ));
}