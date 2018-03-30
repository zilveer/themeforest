<?php
if (class_exists('EM_MS_Globals')) {
    vc_map(array(
        "name" => 'Event Calendar',
        "base" => "cs-event-calendar",
        "icon" => "cs_icon_for_vc",
        "category" => esc_html__('CS Hero', 'wp_nuvo'),
        "params" => array(
        )
    ));
}