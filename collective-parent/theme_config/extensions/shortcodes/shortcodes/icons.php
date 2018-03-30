<?php
/**
 * Icons
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */
function tfuse_icon_check() {
    return '<img src="' . get_template_directory_uri() . '/images/icons/icon_check2.png" class="check_icon" />';
}

$atts = array(
    'name' => __('Icon Check','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
    )
);

tf_add_shortcode('icon_check', 'tfuse_icon_check', $atts);

function tfuse_icon_x() {
    return '<img src="' . get_template_directory_uri() . '/images/icons/icon_x2.png" class="check_icon" />';
}

$atts = array(
    'name' => __('Icon X','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
    )
);

tf_add_shortcode('icon_x', 'tfuse_icon_x', $atts);
