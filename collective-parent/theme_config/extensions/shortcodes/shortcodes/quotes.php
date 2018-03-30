<?php
/**
 * Quotes
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * author: e.g. MARISSA DOE
 * profession: e.g. MARKETING MANAGER
 */

function tfuse_quote_right($atts, $content = null) {
    return '<span class="quote_right">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Quote Right','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_right_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_right', 'tfuse_quote_right', $atts);

function tfuse_quote_left($atts, $content = null) {
    return '<span class="quote_left">' . do_shortcode($content) . '</span>';
}

$atts = array(
    'name' => __('Quote Left','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_left_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_left', 'tfuse_quote_left', $atts);

function tfuse_quote_frame($atts, $content = null) {
    return '<div class="frame_quote"><blockquote>' . do_shortcode($content) . '</blockquote></div>';
}

$atts = array(
    'name' => __('Quote Frame','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_quote_frame_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('quote_frame', 'tfuse_quote_frame', $atts);

function tfuse_blockquote($atts, $content = null)
{
    return '<blockquote><div class="inner">' . do_shortcode($content) . '</div></blockquote>';
}

$atts = array(
    'name' => __('BlockQuote','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Quotes Content','tfuse'),
            'id' => 'tf_shc_blockquote_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('blockquote', 'tfuse_blockquote', $atts);


function tfuse_text_box($atts, $content = null)
{
	extract(shortcode_atts(array('class' => ''), $atts));
    return '<div class="text_box '.$class.'">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Text Box','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 9,
    'options' => array(
		array(
            'name' => __('Class','tfuse'),
            'desc' => __('Enter Class. Ex: clearfix','tfuse'),
            'id' => 'tf_shc_text_box_class',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter Content','tfuse'),
            'id' => 'tf_shc_text_box_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('text_box', 'tfuse_text_box', $atts);