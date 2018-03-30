<?php
/**
 * List Styles
 * 
 * To override this shortcode in a child theme, copy this file to your child theme's
 * theme_config/extensions/shortcodes/shortcodes/ folder.
 */

function tfuse_plus_list($atts, $content = null)
{
    return '<div class="list_plus">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Plus List','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create plus lists','tfuse'),
            'id' => 'tf_shc_plus_list_content',
            'value' => '
                <ul>
                    <li>Plus list item 1</li>
                    <li>Plus list item 2</li>
                    <li>Plus list item 3</li>
                </ul>',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('plus_list', 'tfuse_plus_list', $atts);


function tfuse_check_list($atts, $content = null)
{
    return '<div class="list_check">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Check List','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create check lists','tfuse'),
            'id' => 'tf_shc_check_list_content',
            'value' => '
                <ul>
                    <li>item 1</li>
                    <li>item 2</li>
                    <li>item 3</li>
                </ul>',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('check_list', 'tfuse_check_list', $atts);


function tfuse_delete_list($atts, $content = null) {
    return '<div class="list_delete">' . do_shortcode($content) . '</div>';
}

$atts = array(
    'name' => __('Delete List','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create delete lists','tfuse'),
            'id' => 'tf_shc_delete_list_content',
            'value' => '
                <ul>
                    <li>item 1</li>
                    <li>item 2</li>
                    <li>item 3</li>
                </ul>',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('delete_list', 'tfuse_delete_list', $atts);


function tfuse_default_list($atts, $content = null) {
    return   '<div class="list_dots"> '.do_shortcode($content).'</div>';
}

$atts = array(
    'name' => __('Default List','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 2,
    'options' => array(
        /* add the fllowing option in case shortcode has content */
        array(
            'name' => __('Content','tfuse'),
            'desc' => __('Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create delete lists','tfuse'),
            'id' => 'tf_shc_default_list_content',
            'value' => '
                <ul>
                    <li>item 1</li>
                    <li>item 2</li>
                    <li>item 3</li>
                </ul>',
            'type' => 'textarea'
        )
    )
);

tf_add_shortcode('default_list', 'tfuse_default_list', $atts);