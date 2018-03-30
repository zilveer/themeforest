<?php
/**
 * Technologies
 *
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_technologies($atts, $content = null) {
    $out = '';
    extract(shortcode_atts(array('title' => ''), $atts));
    $get_technologies = do_shortcode($content);
    $out .= '<div class="technologies clearfix">';
    if($title != '')$out .= '<h4>'.$title.'</h4>';
    $out .= '<ul>'.$get_technologies.'</ul>
    </div>';
    return $out;
}

$atts = array(
    'name' => __('Technologies','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Title for Technologies','tfuse'),
            'id' => 'tf_shc_technologies_title',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_technologies_image',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_technologies_link',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'text'
        )
    )
);

tf_add_shortcode('technologies', 'tfuse_technologies', $atts);

function tfuse_technology($atts, $content = null) {
    extract(shortcode_atts(array('image' => '','link' => '#'), $atts));

    return '<li><a target="_blank" href="'.$link.'"><img src="'.$content.'" alt=""></a></li>';
}

$atts = array(
    'name' => __('Technology','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Specifies the source of the image','tfuse'),
            'id' => 'tf_shc_technology_image',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Link','tfuse'),
            'desc' => __('Specifies the link for technology','tfuse'),
            'id' => 'tf_shc_technology_link',
            'value' => '',
            'type' => 'text',
            'divider' => true
        )
    )
);

add_shortcode('technology', 'tfuse_technology', $atts);