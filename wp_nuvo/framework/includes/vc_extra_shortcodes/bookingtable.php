<?php
vc_map(array(
    "name" => 'Booking Table',
    "base" => "cs-booking-form",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero', 'wp_nuvo'),
    "description" => esc_html__('Booking Table', 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Phone Number', 'wp_nuvo'),
            "param_name" => "phone",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            )
        ),
        array(
            "type" => "checkbox",
            "heading" => esc_html__('Message', 'wp_nuvo'),
            "param_name" => "message",
            "value" => array(
                esc_html__("Yes, please", 'wp_nuvo') => true
            )
        )
    )
));