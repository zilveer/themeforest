<?php
/**
 * HighLight
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * class: custom css class e.g. highlight_yellow, highlight_brown, highlight_blue, highlight_black, highlight_purple
 * style: custom css style e.g. color:#ffffff; background:#cc1d00
 */
function tfuse_highlight($atts, $content) {
    extract(shortcode_atts(array('class' => '', 'style' => ''), $atts));

    if (!empty($class))
        $class = ' class="' . $class . '"';
    if (!empty($style))
        $style = ' style="' . $style . '"';

    return '<span' . $class . $style . '>' . strip_tags($content) . '</span>';
}

$atts = array(
    'name' => __('Highlight','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 9,
    'before_preview' => __('Lorem Ipsum is simply ','tfuse'),
    'after_preview' => __('. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','tfuse'),
    'options' => array(
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specify classes of the shortcode <br /><b>predefined classes:</b> highlight_yellow, highlight_brown, highlight_blue, highlight_black, highlight_purple','tfuse'),
            'id' => 'tf_shc_highlight_class',
            'value' => 'highlight_yellow',
            'type' => 'text'
        ),
        array(
            'name' => __('Style','tfuse'),
            'desc' => __('Specify an inline style for the shortcode <br /> e.g. color:#ffffff; background:#cc1d00','tfuse'),
            'id' => 'tf_shc_highlight_style',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_highlight_content',
            'value' => 'text of the printing',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('highlight', 'tfuse_highlight', $atts);
