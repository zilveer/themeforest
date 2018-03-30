<?php
function tfuse_styled_box($atts, $content = null) {
    extract(shortcode_atts(array('title' => '', 'class' => ''), $atts));

    $return_html = '<div class="sb '.$class.'"><div class="box_title">'.$title.'</div>';
    $return_html.= '<div class="box_content">'.html_entity_decode(do_shortcode($content)).'<div class="clear"></div></div></div>';

    return $return_html;
}

$atts = array(
    'name' => __('Styled Box','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 7,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Text to display above the box','tfuse'),
            'id' => 'tf_shc_styled_box_title',
            'value' => 'Styled box',
            'type' => 'text'
        ),
        array(
            'name' => __('Class','tfuse'),
            'desc' => __('Specify a class for an shortcode, ex: sb_pink,sb_yellow,sb_blue,sb_green,sb_dark,<br>sb_purple,sb_orange,','tfuse'),
            'id' => 'tf_shc_styled_box_class',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter shortcode content','tfuse'),
            'id' => 'tf_shc_styled_box_content',
            'value' => 'Insert the content here',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('styled_box', 'tfuse_styled_box', $atts);