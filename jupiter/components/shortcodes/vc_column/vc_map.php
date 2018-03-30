<?php
global $vc_column_width_list;
$vc_column_width_list = array(
    __('1 column - 1/12', 'js_composer') => '1/12',
    __('2 columns - 1/6', 'js_composer') => '1/6',
    __('3 columns - 1/4', 'js_composer') => '1/4',
    __('4 columns - 1/3', 'js_composer') => '1/3',
    __('5 columns - 5/12', 'js_composer') => '5/12',
    __('6 columns - 1/2', 'js_composer') => '1/2',
    __('7 columns - 7/12', 'js_composer') => '7/12',
    __('8 columns - 2/3', 'js_composer') => '2/3',
    __('9 columns - 3/4', 'js_composer') => '3/4',
    __('10 columns - 5/6', 'js_composer') => '5/6',
    __('11 columns - 11/12', 'js_composer') => '11/12',
    __('12 columns - 1/1', 'js_composer') => '1/1'
);

vc_map(array(
    "name" => __("Column", "mk_framework") ,
    "base" => "vc_column",
    "is_container" => true,
    "content_element" => false,
    "params" => array(
        array(
            "type" => "colorpicker",
            "heading" => __("Column Border Color", "mk_framework") ,
            "param_name" => "border_color",
            "value" => "",
            "description" => __("You can optionally add border color to columns.", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Background Blend Modes", "mk_framework") ,
            "param_name" => "blend_mode",
            "value" => array(
                __('None', "mk_framework") => "none",
                __('Multiply', "mk_framework") => "multiply",
                __('Screen', "mk_framework") => "screen",
                __('Overlay', "mk_framework") => "overlay",
                __('Darken', "mk_framework") => "darken",
                __('Lighten', "mk_framework") => "lighten",
                __('Soft Light', "mk_framework") => "soft-light",
                __('Luminosity', "mk_framework") => "luminosity"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        $add_device_visibility,
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "mk_framework")
        ) ,
        array(
            'type' => 'css_editor',
            'heading' => __('Css', 'mk_framework') ,
            'param_name' => 'css',
            'group' => __('Design options', 'mk_framework')
        ) ,
        array(
            'type' => 'dropdown',
            'heading' => __('Width', 'js_composer') ,
            'param_name' => 'width',
            'value' => $vc_column_width_list,
            'group' => __('Responsive Options', 'js_composer') ,
            'description' => __('Select column width.', 'js_composer') ,
            'std' => '1/1'
        ) ,
        array(
            'type' => 'column_offset',
            'heading' => __('Responsiveness', 'mk_framework') ,
            'param_name' => 'offset',
            'group' => __('Width & Responsiveness', 'mk_framework') ,
            'description' => __('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'mk_framework')
        )
    ) ,
    "js_view" => 'VcColumnView'
));
vc_map(array(
    "name" => __("Column", "js_composer") ,
    "base" => "vc_column_inner",
    "class" => "",
    "icon" => "",
    "wrapper_class" => "",
    "controls" => "full",
    "allowed_container_element" => false,
    "content_element" => false,
    "is_container" => true,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", "js_composer")
        ) ,
        array(
            "type" => "css_editor",
            "heading" => __('CSS box', "js_composer") ,
            "param_name" => "css",
            "group" => __('Design Options', 'js_composer')
        ) ,
        array(
            'type' => 'dropdown',
            'heading' => __('Width', 'js_composer') ,
            'param_name' => 'width',
            'value' => $vc_column_width_list,
            'group' => __('Responsive Options', 'js_composer') ,
            'description' => __('Select column width.', 'js_composer') ,
            'std' => '1/1'
        ) ,
        array(
            'type' => 'column_offset',
            'heading' => __('Responsiveness', 'js_composer') ,
            'param_name' => 'offset',
            'group' => __('Responsive Options', 'js_composer') ,
            'description' => __('Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer')
        )
    ) ,
    "js_view" => 'VcColumnView'
));
