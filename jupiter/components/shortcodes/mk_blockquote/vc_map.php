<?php
    vc_map(array(
        "name" => __("Blockquote", "mk_framework") ,
        "base" => "mk_blockquote",
        "category" => __('Typography', 'mk_framework') ,
        'icon' => 'icon-mk-blockquote vc_mk_element-icon',
        'description' => __('Blockquote modules', 'mk_framework') ,
        "params" => array(
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Blockquote Message", "mk_framework") ,
                "param_name" => "content",
                "value" => __("", "mk_framework") ,
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "dropdown",
                "heading" => __("Style", "mk_framework") ,
                "param_name" => "style",
                "width" => 150,
                "value" => array(
                    __('Quote Style', "mk_framework") => "quote-style",
                    __('Line Style', "mk_framework") => "line-style"
                ) ,
                "description" => __("Using this option you can choose blockquote style.", "mk_framework")
            ) ,
            array(
                "type" => "theme_fonts",
                "heading" => __("Font Family", "mk_framework") ,
                "param_name" => "font_family",
                "value" => "",
                "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework")
            ) ,
            array(
                "type" => "hidden_input",
                "param_name" => "font_type",
                "value" => "",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "toggle",
                "heading" => __("Custom Font Size?", "mk_framework") ,
                "param_name" => "font_size_combat",
                "value" => 'false',
                "description" => __("If you need to set a different size enable this option and set it from below option.", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Text Size", "mk_framework") ,
                "param_name" => "text_size",
                "value" => "12",
                "min" => "12",
                "max" => "50",
                "step" => "1",
                "unit" => 'px',
                "description" => __("You can set blockquote text size from the below option.", "mk_framework"),
                "dependency" => array(
                'element' => "font_size_combat",
                'value' => array(
                    'true',
                )
            )
            ) ,
            array(
                "type" => "toggle",
                "heading" => __("Force Responsive Font Size?", "mk_framework") ,
                "param_name" => "force_font_size",
                "value" => "false",
                "description" => __("", "mk_framework")
            ) ,
            array(
                "type" => "range",
                "heading" => __("Font Size for Small Desktops", "mk_framework") ,
                "param_name" => "size_smallscreen",
                "value" => "0",
                "min" => "0",
                "max" => "70",
                "step" => "1",
                "unit" => 'px',
                "description" => __("For screens smaller than 1280px. If value is zero the font size not going to be affected.", "mk_framework"),
                "dependency" => array(
                    'element' => "force_font_size",
                    'value' => array(
                        'true'
                    )
                )
            ) ,
            array(
                "type" => "range",
                "heading" => __("Font Size for Tablet", "mk_framework") ,
                "param_name" => "size_tablet",
                "value" => "0",
                "min" => "0",
                "max" => "70",
                "step" => "1",
                "unit" => 'px',
                "description" => __("For screens between 768 and 1024px. If value is zero the font size not going to be affected.", "mk_framework"),
                "dependency" => array(
                    'element' => "force_font_size",
                    'value' => array(
                        'true'
                    )
                )
            ),
            array(
                "type" => "range",
                "heading" => __("Font Size for Mobile", "mk_framework") ,
                "param_name" => "size_phone",
                "value" => "0",
                "min" => "0",
                "max" => "70",
                "step" => "1",
                "unit" => 'px',
                "description" => __("For screens smaller than 768px. If value is zero the font size not going to be affected.", "mk_framework"),
                "dependency" => array(
                    'element' => "force_font_size",
                    'value' => array(
                        'true'
                    )
                )
            ) ,
            $add_css_animations,
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "mk_framework") ,
                "param_name" => "el_class",
                "value" => "",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
            )
        )
    )
);