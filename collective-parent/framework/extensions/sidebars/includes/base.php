<?php

$_inc_['type_opts'] =
        array(
            'name' => __('Add Sidebar for', 'tfuse'),
            'desc' => __('Choose what to add sidebars for. Ex: Posts, Pages, Category...', 'tfuse'),
            'id' => 'sidebars_choose_type',
            'value' => '',
            'type' => 'callback',
            'callback' => array(&$this->ext->sidebars, 'sidebars_choose_type_cb'),
            'divider' => TRUE
);
$_inc_['subtype_opts'] =
        array(
            'name' => __('Choose subtype', 'tfuse'),
            'desc' => __('Choose subtype', 'tfuse'),
            'id' => 'sidebars_choose_subtype',
            'value' => '',
            'type' => 'callback',
            'callback' => array(&$this->ext->sidebars, 'sidebars_choose_subtype_cb')
);
$_inc_['multi_opts'] =
        array(
            'name' => __('&nbsp;', 'tfuse'),
            'desc' => __('Type and search automatically', 'tfuse'),
            'id' => 'sidebars_choose_multi',
            'value' => '',
            'type' => 'callback',
            'callback' => array(&$this->ext->sidebars, 'sidebars_choose_multi_cb')
);
$_inc_['sidebars_positions'] =
        array(
            'name' => __('Sidebar position', 'tfuse'),
            'desc' => __('Choose the position for your sidebars.', 'tfuse'),
            'id' => 'sidebars_positions',
            'value' => '',
            'type' => 'callback',
            'callback' => array(&$this->ext->sidebars, 'sidebars_positions_cb')
);
$_inc_['sidebars_placeholders'] =
        array(
            'name' => __('Sidebar add/edit', 'tfuse'),
            'desc' => '',
            'id' => 'sidebars_placeholders',
            'value' => '',
            'type' => 'callback',
            'callback' => array(&$this->ext->sidebars, 'sidebars_placeholders_cb')
);

$_inc_['multi_options'] =
        array(
            'post' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_',
                'type' => 'multi',
                'subtype' => 'post'
            ),
            'page' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_',
                'type' => 'multi',
                'subtype' => 'page'
            ),
            'category' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_',
                'type' => 'multi',
                'subtype' => 'category'
            ),
            'taxonomy' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_',
                'type' => 'multi',
                'subtype' => 'taxonomy'
            ),
            'templates' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_templates',
                'value' => '',
                'type' => 'select',
                'options' => tf_get_templates()
            ),
            'custom_post' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_',
                'type' => 'multi',
                'subtype' => ''
            ),
            'custom_category' => array(
                'name' => __('Name', 'tfuse'),
                'desc' => __('Test description', 'tfuse'),
                'id' => 'sidebar_multi_select_',
                'type' => 'multi',
                'subtype' => ''
            )
);