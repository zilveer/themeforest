<?php
/**
 * Accordion toggle
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 *
 */

function tfuse_accordion($atts, $content = null) {
    global $c;
    $c = rand(1,100);
    $out = '';
    extract(shortcode_atts(array('title' => ''), $atts));
    $get_accordion = do_shortcode($content);

    if($title != '') $out .= '<h6>'.$title.'</h6>';
    $out .= '<div class="accordion clearfix" id="accordion'.$c.'">';
    $out .= $get_accordion.'</div>';

    return $out;
}

$atts = array(
    'name' => __('Accordion toggle','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Title for accordion','tfuse'),
            'id' => 'tf_shc_accordion_title',
            'value' => '',
            'divider' => TRUE,
            'type' => 'text'
        ),
        array(
            'name' => __('Name','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_accordion_name',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Post','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_accordion_post',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_accordion_content',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'divider' => TRUE,
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('accordion', 'tfuse_accordion', $atts);

function tfuse_ac_tab($atts, $content = null) {
    global $c;
    extract(shortcode_atts(array('name' => '', 'post' => ''), $atts));
    $uniq_ac = rand(101,200);
    return '<div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion'.$c.'" href="#collapse'.$uniq_ac.'"><span class="toogle_ico"></span><span class="guest-name">'.$name.'</span><span class="guest-post">'.$post.'</span></a>
        </div>
        <div id="collapse'.$uniq_ac.'" class="accordion-body collapse"><div class="accordion-inner">'.do_shortcode($content).'</div></div>
    </div>';
}

$atts = array(
    'name' => __('Tab','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the shortcode.','tfuse'),
    'category' => 8,
    'options' => array(
        array(
            'name' => __('Name','tfuse'),
            'desc' => __('Specifies the name of the person','tfuse'),
            'id' => 'tf_shc_ac_tab_name',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Post','tfuse'),
            'desc' => __('Specifies the post of the person','tfuse'),
            'id' => 'tf_shc_ac_tab_post',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Enter the toggle in this format:<i>[ac_tab]Tab content[/ac_tab]...</i>','tfuse'),
            'id' => 'tf_shc_ac_tab_content',
            'value' => '',
            'type' => 'textarea'
        )
    )
);

add_shortcode('ac_tab', 'tfuse_ac_tab', $atts);