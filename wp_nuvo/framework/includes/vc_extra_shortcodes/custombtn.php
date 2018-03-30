<?php

add_action('init', 'custombtn_integrateWithVC');

function custombtn_integrateWithVC() {
    vc_map(array(
        "name" => esc_html__("Custom Button", 'wp_nuvo'),
        "base" => "cs-custombtn",
        "class" => "cs-custombtn",
        "category" => esc_html__('CS Hero', 'wp_nuvo'),
        "icon" => "cs_icon_for_vc",
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Element Selector", 'wp_nuvo'),
                "param_name" => "el_selector",
                "value" => ".section-scroll-top",
                "description" => esc_html__("Element Selector.", 'wp_nuvo')
            ),
			array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Icon Class", 'wp_nuvo'),
                "param_name" => "icon_class",
                "value" => "fa fa-arrow-down",
                "description" => esc_html__("Icon Class.", 'wp_nuvo')
            ),
			array(
                "type" => "textfield",
                "class" => "",
                "heading" => esc_html__("Extra Class", 'wp_nuvo'),
                "param_name" => "el_class",
                "value" => "",
                "description" => esc_html__("Extra Class.", 'wp_nuvo')
            ),
        )
    ));
}
