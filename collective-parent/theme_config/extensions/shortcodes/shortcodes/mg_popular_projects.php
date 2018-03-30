<?php
/**
 * MG Popular Projects
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_mgprojects($atts, $content = null)
{
    extract(shortcode_atts(array('title' => '', 'items' => '4', 'type' => 'recent'), $atts));
    $projects = tfuse_shortcode_posts(array(
        'sort' => $type,
        'items' => $items,
        'post_type' => 'portfolio',
        'image_post' => false,
        'date_post' => false,));
    $out = '<div class="widget_container widget_popular">';
    if($title != '') $out .= '<h3 class="widget_title">'.$title.'</h3>';
    $out .= '<ul>';

    foreach($projects as $item){
        $out .= '<li><a href="'.$item['post_link'].'">'.$item['post_title'].'</a></li>';
    }
    $out .= '</ul></div>';
    return $out;
}

$atts = array(
    'name' => __('MG Projects','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 12,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Enter the title','tfuse'),
            'id' => 'tf_shc_mgprojects_title',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Number of items','tfuse'),
            'desc' => __('Enter the number of items','tfuse'),
            'id' => 'tf_shc_mgprojects_items',
            'value' => '4',
            'type' => 'text'
        ),
        array(
            'name' => __('Select the type of projects','tfuse'),
            'desc' => __('Enter the type of projects','tfuse'),
            'id' => 'tf_shc_mgprojects_type',
            'value' => 'recent',
            'type' => 'select',
            'options' => array(
                'recent' => __('Recent','tfuse'),
                'popular' => __('Popular','tfuse'),
            ),
        ),
    )
);

tf_add_shortcode('mgprojects', 'tfuse_mgprojects', $atts);