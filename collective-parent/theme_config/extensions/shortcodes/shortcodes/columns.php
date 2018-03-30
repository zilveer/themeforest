<?php
/**
 * Columns
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 * 
 * Optional arguments:
 * type: span12,span6,span4,span3,span8,span9
 * class:

 */

function tfuse_col($atts, $content = null)
{
    extract(shortcode_atts(array('type' => 'span12', 'class' => ''), $atts));
    return '<div class="' .$type. ' ' . $class . '">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Columns','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the button shortcode.','tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Type','tfuse'),
            'desc' => __('Select column type','tfuse'),
            'id' => 'tf_shc_col_type',
            'value' => '_self',
            'options' => array(
                'span12' => __('One column','tfuse'),
                'span6' => __('One half column (1/2)','tfuse'),
                'span4' => __('One third column (1/3)','tfuse'),
                'span3' => __('A fourth column (1/4)','tfuse'),
                'span8' => __('Two thirds column (2/3)','tfuse'),
                'span9' => __('Three fourths column (3/4)','tfuse'),
            ),
            'type' => 'select'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specifies one or more class names for an shortcode:box box_border box_green,box box_border box_yellow,box box_border box_pink,box box_border box_blue...','tfuse'),
            'id' => 'tf_shc_col_class',
            'value' => '',
            'type' => 'text'
        ),
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_col_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('col', 'tfuse_col', $atts);