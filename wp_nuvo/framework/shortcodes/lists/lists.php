<?php

function cshero_list_render($params, $content = null) {
    extract(shortcode_atts(array(
                'class' => ''
                    ), $params));
    $content = str_replace("]<br />", ']', $content);
    $content = str_replace("]<br />\n", ']', $content);
    $content = str_replace("<br />\n[", '[', $content);
    return '<ul class="' .  esc_attr($class) . '">' . do_shortcode($content) . '</ul>';
}

add_shortcode('cs-list', 'cshero_list_render');

function cshero_li_render($params, $content = null) {
    extract(shortcode_atts(array(
                'icon' => ''
                    ), $params));
    if ($icon != '') {
        $cs_class = '<span class="fa ' .  esc_attr($icon) . '"></span> ';
    } else {
        $cs_class = '';
    }
    return '<li>' . $cs_class . do_shortcode($content) . '</li>';
}

add_shortcode('cs-li', 'cshero_li_render');