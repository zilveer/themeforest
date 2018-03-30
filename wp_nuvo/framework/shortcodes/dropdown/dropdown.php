<?php

function cshero_dropdown($params, $content = null) {
    extract(shortcode_atts(array(
                'dropup' => '',
                'class' => ''
                    ), $params));
    $content = str_replace("]<br />", ']', $content);
    $content = str_replace("]<br />\n", ']', $content);
    $content = str_replace("<br />\n[", '[', $content);
    if ($dropup != 'dropup') {
        $dropup = '';
    }
    $out = '<div class="btn-group ' .  esc_attr($dropup) . ' ' .  esc_attr($class) . '">' . do_shortcode($content) . '</div>';
    return $out;
}

add_shortcode('dropdown', 'cshero_dropdown');

function cshero_dropdown_head($params, $content = null) {
    extract(shortcode_atts(array(
                'size' => '',
                'style' => '',
                'split' => ''), $params));
    $out = '';
    if ($split == "split") {
        $out = '<button type="button" class="btn ' .  esc_attr($size) . ' ' .  esc_attr($style) . '">' .  esc_attr($content) . '</button>';

        $out .= '<button type="button" class="btn ' .  esc_attr($size) . ' ' .  esc_attr($style) . ' dropdown-toggle" data-toggle="dropdown">';
        $out .= '<span class="caret"></span></button>';
    } else {
        $out = ' <button type="button" class="btn ' .  esc_attr($size) . ' ' .  esc_attr($style) . ' dropdown-toggle" data-toggle="dropdown">';
        $out .=  esc_attr($content) . ' <span class="caret"></span> </button>';
    }

    return $out;
}

add_shortcode('dropdownhead', 'cshero_dropdown_head');

function cshero_dropdown_body($params, $content = null) {
    $content = str_replace("]<br />", ']', $content);
    $content = str_replace("]<br />\n", ']', $content);
    $content = str_replace("<br />\n[", '[', $content);
    $out = '<ul class="dropdown-menu" role="menu">' . do_shortcode($content) . '</ul>';
    return $out;
}

add_shortcode('dropdownbody', 'cshero_dropdown_body');

function cshero_dropdown_items($params, $content = null) {
    extract(shortcode_atts(array(
                'type' => '',
                'link' => '',
                'disabled' => ''), $params));
    $out = '';
    $out = '';
    if ($type == "divider") {
        $out = '<li class="divider"></li>';
    } elseif ($type == "menuitem") {
        if ($disabled == 'disabled') {
            $out = '<li class="disabled"><a class="" href="' . esc_url($link) . '">' . do_shortcode($content) . '</a></li>';
        } else {
            $out = '<li><a class="" href="' . esc_url($link) . '">' . do_shortcode($content) . '</a></li>';
        }
    }
    return $out;
}

add_shortcode('dropdownitem', 'cshero_dropdown_items');