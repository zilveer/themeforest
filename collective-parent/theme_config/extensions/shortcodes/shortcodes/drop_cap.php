<?php
/**
 * Dropcaps
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */
function tfuse_drop_cap_1($atts, $content = null)
{
    return '<span class="dropcap1">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Drop Cap 1','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'after_preview' => __('orem Ipsum is simply dummy text of the printing and typesetting industry.','tfuse'),
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_dropcap1_content',
            'value' => 'L',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('dropcap1', 'tfuse_drop_cap_1', $atts);

function tfuse_drop_cap_2($atts, $content = null)
{
    return '<span class="dropcap2">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Drop Cap 2','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'after_preview' => __('orem Ipsum is simply dummy text of the printing and typesetting industry.','tfuse'),
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_dropcap2_content',
            'value' => 'L',
            'type' => 'text'
        )
    )
);

tf_add_shortcode('dropcap2', 'tfuse_drop_cap_2', $atts);