<?php
/**
 * Progress Bar
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_progressbar($atts, $content = null) {
    $out = '';
    extract(shortcode_atts(array('title' => ''), $atts));
    $get_progressbar = do_shortcode($content);

    if($title != '') $out .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
    $out .= '<div class="progressbar-list clearfix">'.$get_progressbar.'</div>';

    return $out;
}

$atts = array(
    'name' => __('Progress Bar','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Title for Progress Bar','tfuse'),
            'id' => 'tf_shc_progressbar_title',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        array(
            'name' => __('Name','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_progressbar_name',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Percentage','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_progressbar_percentage',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable tf_shc_addable_last'),
            'type' => 'text'
        )
    )
);

tf_add_shortcode('progressbar', 'tfuse_progressbar', $atts);

function tfuse_bar_tab($atts, $content = null) {
    extract(shortcode_atts(array('name' => '', 'percentage' => ''), $atts));
    $percentage = (int)$content;

    return '<span class="progress_title">'.$name.'</span>
    <div class="progress_bar"><div class="bar" style="width: '.$percentage.'%"><span>'.do_shortcode($percentage).'%</span></div></div>';
}

$atts = array(
    'name' => __('Bar Tab','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Name','tfuse'),
            'desc' => __('Specifies the name of the person','tfuse'),
            'id' => 'tf_shc_bar_tab_name',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Percentage','tfuse'),
            'desc' => __('Specifies the percentage','tfuse'),
            'id' => 'tf_shc_bar_tab_percentage',
            'value' => '',
            'type' => 'text'
        )
    )
);

add_shortcode('bar_tab', 'tfuse_bar_tab', $atts);