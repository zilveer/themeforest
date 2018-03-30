<?php

vc_map(array(
    'name' => __('Row', 'js_composer') ,
    'base' => 'vc_row_inner',
    'content_element' => false,
    'is_container' => true,
    'icon' => 'icon-wpb-row',
    'weight' => 1000,
    'show_settings_on_create' => false,
    'description' => __('Place content elements inside the row', 'js_composer') ,
    'params' => array(
        array(
            'type' => 'el_id',
            'heading' => __('Row ID', 'js_composer') ,
            'param_name' => 'el_id',
            'description' => sprintf(__('Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'js_composer') , '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . __('link', 'js_composer') . '</a>') ,
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Attached Colums", "mk_framework") ,
            "param_name" => "attached",
            "value" => "false",
            "description" => __("When enabled, this option attachs child columns to each other. In other words columns inside this row will be stuck to each other.", "mk_framework")
        ) ,
         array(
            "type" => "toggle",
            "heading" => __("Fullwidth Content", "mk_framework") ,
            "param_name" => "is_fullwidth_content",
            "value" => "true",
            "description" => __("When enabled, this row will no longer follow the main grid width and will stretch 100% to screen width.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Column Paddings", "mk_framework") ,
            "param_name" => "column_padding",
            "value" => "0",
            "min" => "0",
            "max" => "5",
            "step" => "1",
            "unit" => '%',
            "description" => __("This option creates pading space inside columns. This option will work when 'Attached Colums' option is enabled. Note that padding unit is by percent and will be applied to all directions.", "mk_framework")
        ) ,

        $add_device_visibility,
        $add_css_animations,
        array(
            'type' => 'checkbox',
            'heading' => __( 'Disable row', 'js_composer' ),
            'param_name' => 'disable_element', // Inner param name.
            'description' => __( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'js_composer' ),
            'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('Extra class name', 'js_composer') ,
            'param_name' => 'el_class',
            'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer')
        ) ,
        array(
            'type' => 'css_editor',
            'heading' => __('CSS box', 'js_composer') ,
            'param_name' => 'css',
            'group' => __('Design Options', 'js_composer')
        ) ,
    ) ,
    'js_view' => 'VcRowView'
));
