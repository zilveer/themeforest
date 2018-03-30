<?php
vc_map(array(
    "name" => __("Highlight Text", "mk_framework") ,
    "base" => "mk_highlight",
    'icon' => 'icon-mk-highlight vc_mk_element-icon',
    "category" => __('Typography', 'mk_framework') ,
    'description' => __('adds highlight to an inline text.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Highlight Text", "mk_framework") ,
            "param_name" => "text",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Background Color", "mk_framework") ,
            "param_name" => "bg_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,

        /*        array(
                  "type" => "fonts",
                  "heading" => __("Font Family", "mk_framework"),
                  "param_name" => "font_family",
                  "value" => "",
                  "description" => __("You can choose a font for this shortcode, however using non-safe fonts can affect page load and performance.", "mk_framework")
              ),
              array(
                  "type" => "hidden_input",
                  "param_name" => "font_type",
                  "value" => "",
                  "description" => __("", "mk_framework")
              ),
        */
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));