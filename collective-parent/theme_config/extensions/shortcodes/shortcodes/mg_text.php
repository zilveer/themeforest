<?php
/**
 * Mega Menu Text
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_mgtext($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '',  'link' => '#'), $atts));

    return '<div class="widget_container widget_text">
        <h3 class="widget_title">'.$title.'</h3>'.$content.'<a href="'.$link.'" class="button">'.__('More','tfuse').'</a>
    </div>';
}

$atts = array(
    'name' => __('MG Text','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 12,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_mgtext_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the content','tfuse'),
            'id' => 'tf_shc_mgtext_content',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('More button link','tfuse'),
            'desc' => __('Enter the link for more button','tfuse'),
            'id' => 'tf_shc_mgtext_link',
            'value' => '#',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('mgtext', 'tfuse_mgtext', $atts);