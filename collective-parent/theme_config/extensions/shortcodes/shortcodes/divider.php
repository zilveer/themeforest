<?php
/**
 * Divider Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: space, space_thin, dots, dots_full, thin  
 */

function tfuse_divider($atts)
{
    extract( shortcode_atts(array('type' => 'space'), $atts) );

    return '<div class="' . $type . '"></div>';
}

$atts = array(
    'name' => __('Dividers','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for this shortcode.','tfuse'),
    'category' => 9,
    'before_preview' => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','tfuse'),
    'after_preview' => __('Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','tfuse'),
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select divider type','tfuse'),
            'id' => 'tf_shc_divider_type',
            'value' => 'space',
            'options' => array(
                'space' => __('Divider Space','tfuse'),
                'space_thin' => __('Divider Space Thin','tfuse'),
                'space_big' => __('Divider Space Big','tfuse'),
                'divider_line' => __('Divider Line','tfuse'),
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('divider', 'tfuse_divider', $atts);

function tfuse_clear($atts)
{
    extract( shortcode_atts(array('type' => 'clear'), $atts) );
    return '<div class="' . $type . '"></div>';
}

$atts = array(
    'name' => __('Clear','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for this shortcode.','tfuse'),
    'category' => 9,
    'before_preview' => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry.','tfuse'),
    'after_preview' => __('Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','tfuse'),
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select clear type','tfuse'),
            'id' => 'tf_shc_clear_type',
            'value' => '',
            'options' => array(
                'clear' => __('Clear','tfuse'),
                'clearboth' => __('Clear Both','tfuse'),
            ),
            'type' => 'select'
        )
    )
);

tf_add_shortcode('clear', 'tfuse_clear', $atts);
tf_shortcode_alias('clearboth', 'clear', array('type' => 'clearboth'));