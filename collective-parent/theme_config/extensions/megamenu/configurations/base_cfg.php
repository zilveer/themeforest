<?php
if (!defined('TFUSE')) {
    exit('Direct access forbidden.');
}

$prefix = 'tf_megamenu_';

// the templates available for this theme
// note that the the keys must be valid templates
// from the $cfg['all_templates'] arr
$cfg['active_templates'] = array(
    'custom' => __('Custom', 'tfuse'),
    'from_children' => __('From Children', 'tfuse'),
    'html' => __('HTML/Shortcodes', 'tfuse'),
);

$cfg['commun_options'] = array(
    // 0 depth commun options
    array(

        array(
            'name'       => __('MegaMenu ON', 'tfuse'),
            'id'         => $prefix . 'is_mega',
            'type'       => 'checkbox',
            'properties' => array(
                'class'  => $prefix . 'nav_parent_switch'
            ),
            'options' => array(
                true  => 'yes',
                false => 'no'
            ),
            'value'      => false
        )

    ),


    // 1 depth commun options
    array(

        array(
            'name' => __('Select menu template', 'tfuse'),
            'id' => $prefix . 'menu_template',
            'type' => 'select',
            'properties' => array(
                'class' => $prefix . 'template_select'
            ),
            'options' => $cfg['active_templates'],
            'value' => false
        ),

    )

);

// the list of templates available
// for 1 depth menu nav items
$cfg['all_templates'] = array(

    'custom' => array(
        array(
            'name' => __('Column width', 'tfuse'),
            'id' => $prefix . 'column',
            'type' => 'select',
            'options' => array(
                'span3'  => __('Column 1/4', 'tfuse'),
                'span4'  => __('Column 1/3', 'tfuse'),
                'span5'  => __('Column 1/2', 'tfuse'),
            ),
            'value' => 'span3',
        ),
        array(
            'name' => __('Show list in:', 'tfuse'),
            'id' => $prefix . 'list',
            'type' => 'select',
            'options' => array(
                'one_col'  => __('One Column', 'tfuse'),
                'two_col'  => __('Two Columns', 'tfuse'),
            ),
            'value' => 'one_col',
        ),
    ),

    'from_children' => array(
        array(
            'name' => __('How many items to display', 'tfuse'),
            'id' => $prefix . 'num_items',
            'type' => 'text',
            'value' => '4'
        ),
        array(
            'name' => __('Column width', 'tfuse'),
            'id' => $prefix . 'column',
            'type' => 'select',
            'options' => array(
                'span3'  => __('Column 1/4', 'tfuse'),
                'span4'  => __('Column 1/3', 'tfuse'),
                'span5'  => __('Column 1/2', 'tfuse'),
            ),
            'value' => 'span3',
        ),
        array(
            'name' => __('Show list in:', 'tfuse'),
            'id' => $prefix . 'list',
            'type' => 'select',
            'options' => array(
                'one_col'  => __('One Column', 'tfuse'),
                'two_col'  => __('Two Columns', 'tfuse'),
            ),
            'value' => 'one_col',
        ),
    ),

    'without_img' => array(),

    'with_img' => array(
        array(
            'name' => 'Image URL',
            'id' => $prefix . 'image_url',
            'type' => 'text',
            'properties' => array(
                'placeholder' => 'Enter the imgae url here'
            ),
            'value' => ''
        ),
    ),

    'html' => array(
        array(
            'name' => __('Column width', 'tfuse'),
            'id' => $prefix . 'column',
            'type' => 'select',
            'options' => array(
                'span3'  => __('Column 1/4', 'tfuse'),
                'span4'  => __('Column 1/3', 'tfuse'),
                'span5'  => __('Column 1/2', 'tfuse'),
            ),
            'value' => 'span3',
        ),
        array(
            'name' => __('HTML', 'tfuse'),
            'id' => $prefix . 'html',
            'type' => 'textarea',
            'value' => ''
        )
    ),
);

$cfg['megafied_parent_li_css_classes'] = array(
    'mega-menu'
);

$cfg['megafied_child_li_css_classes'] = array(
    ''
);
