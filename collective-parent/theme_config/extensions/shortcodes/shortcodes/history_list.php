<?php
/**
 * History List
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_history($atts, $content = null) {
    $out = '';
    extract(shortcode_atts(array('title' => ''), $atts));
    $get_history = do_shortcode($content);

    if($title != '') $out .= '<div class="title clearfix"><h2>'.$title.'</h2></div>';
    $out .= '<div class="history_list">';
    $out .= $get_history.'</div>';

    return $out;
}

$atts = array(
    'name' => __('History List','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Title for history','tfuse'),
            'id' => 'tf_shc_history_title',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        array(
            'name' => __('Name','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_history_name',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Year','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_history_year',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_history_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('history', 'tfuse_history', $atts);

function tfuse_history_item($atts, $content = null) {
    extract(shortcode_atts(array('name' => '', 'year' => ''), $atts));
    return '<div class="history_item clearfix">
                <div class="history_inner"><span class="history_year">'.$year.'</span><h5>'.$name.'</h5>'.do_shortcode($content).'</div>
            </div>';
}

$atts = array(
    'name' => __('Tab','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Name','tfuse'),
            'desc' => __('Specifies the name.','tfuse'),
            'id' => 'tf_shc_history_item_name',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Year','tfuse'),
            'desc' => __('Specifies the year.','tfuse'),
            'id' => 'tf_shc_history_item_year',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the content.','tfuse'),
            'id' => 'tf_shc_history_item_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

add_shortcode('history_item', 'tfuse_history_item', $atts);