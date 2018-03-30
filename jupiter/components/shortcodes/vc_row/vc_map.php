<?php
vc_map(array(
    "name" => __("Row", "mk_framework") ,
    'base' => 'vc_row',
    'is_container' => true,
    'icon' => 'icon-mk-row vc_mk_element-icon',
    'show_settings_on_create' => false,
    'category' => __('Content', 'mk_framework') ,
    'description' => __('Place content elements inside the row', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "toggle",
            "heading" => __("Full Width Row", "mk_framework") ,
            "param_name" => "fullwidth",
            "value" => "false",
            "description" => __("When enabled, this row will no longer follow the main grid width and will stretch 100% to screen width.", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Full Width Content?", "mk_framework") ,
            "param_name" => "fullwidth_content",
            "value" => "true",
            "description" => __("This option works if \"Full Width Row\" is enabled and it gives you the power to choose whether inside the row follows global grid width or be totally full width.", "mk_framework"),
            "dependency" => array(
                'element' => "fullwidth",
                'value' => array(
                    'true'
                )
            )
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Equal Columns", "mk_framework") ,
            "param_name" => "equal_columns",
            "value" => "false",
            "description" => __("When enabled, columns inside this row will stretch to the highest column.", "mk_framework")
        ) ,
        array(
            "type" => "toggle",
            "heading" => __("Attached Colums", "mk_framework") ,
            "param_name" => "attached",
            "value" => "false",
            "description" => __("When enabled, this option attachs child columns to each other. In other words columns inside this row will be stuck to each other.", "mk_framework")
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
        array(
            "type" => "textfield",
            "heading" => __("Row ID", "mk_framework") ,
            "param_name" => "id",
            "description" => __("This option comes handy when you are creating One page scroll website and here you can set ID which you used in your navigation anchor tag.", "mk_framework")
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
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ) ,
        array(
            'type' => 'css_editor',
            'heading' => __( 'CSS box', 'js_composer' ),
            'param_name' => 'css',
            'group' => __( 'Design Options', 'js_composer' )
        ),

    ) ,
    "js_view" => 'VcRowView'
));
