<?php
/* --------------------------------------------------------------------- */
/* Shortcode Logo */
/* --------------------------------------------------------------------- */
vc_map(array(
    "name" => esc_html__("Logo",'wp_nuvo'),
    "base" => "cs-shortcode-logo",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero','wp_nuvo'),
    "description" => esc_html__("Custom logo.", 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", 'wp_nuvo'),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wp_nuvo')
        ),
        array(
            "type" => "attach_image",
            "heading" => esc_html__("Logo", 'wp_nuvo'),
            "param_name" => "logo",
            "value" => "",
            "description" => esc_html__("Default get logo from admin.", 'wp_nuvo')
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Logo align", 'wp_nuvo'),
            "param_name" => "logo_align",
            "value" => array("Left" => "left", "Center" => "center", "Right" => "right"),
            "description" => esc_html__('Select your logo align.', 'wp_nuvo')
        )
    )
));
?>