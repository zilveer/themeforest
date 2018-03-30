<?php
/**
 * Link more
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * url:
 * text:
 */

function tfuse_link_more($atts, $content = null) {
    extract(shortcode_atts(array('link' => '#', 'text' => ''), $atts));

    if (empty($text))
        $text = 'more details';

    return '<a class="link-more" href="' . $link . '">' . $text . '</a>';
}

$atts = array(
    'name' => __('Link More','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the URL of the page the link goes to','tfuse'),
            'id' => 'tf_shc_link_more_link',
            'value' => '#',
            'type' => 'text'
        ),
        array(
            'name' => __('Text','tfuse'),
            'desc' => __('Specifies the the text for shoh an shortcode','tfuse'),
            'id' => 'tf_shc_link_more_text',
            'value' => 'more details',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('link_more', 'tfuse_link_more', $atts);
