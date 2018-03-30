<?php
vc_map(array(
    "name" => __("Title Box", "mk_framework") ,
    "base" => "mk_title_box",
    "category" => __('Typography', 'mk_framework') ,
    'icon' => 'icon-mk-title-box vc_mk_element-icon',
    'description' => __('Adds title text into a highlight box.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textarea_html",
            "rows" => 2,
            "holder" => "div",
            "heading" => __("Content.", "mk_framework") ,
            "param_name" => "content",
            "value" => __("", "mk_framework") ,
            "description" => __("Allowed Tags [br] [strong] [i] [u] [b] [a] [small]. Please note that [p] tags will be striped out.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "color",
            "value" => "#393836",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Highlight Background Color", "mk_framework") ,
            "param_name" => "highlight_color",
            "value" => "",
            "description" => __("The Highlight Background color. you can change color opacity from below option.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Highlight Color Opacity", "mk_framework") ,
            "param_name" => "highlight_opacity",
            "value" => "0.3",
            "min" => "0",
            "max" => "1",
            "step" => "0.01",
            "unit" => '',
            "description" => __("The Opacity of the highlight background", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Font Size", "mk_framework") ,
            "param_name" => "size",
            "value" => "18",
            "min" => "12",
            "max" => "70",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Line Height (Important)", "mk_framework") ,
            "param_name" => "line_height",
            "value" => "34",
            "min" => "12",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Since every font family with differnt sizes need different line heights to get a nice looking highlighted titles you should set them manually. as a hint generally (font-size * 2) - 2 works in many cases, but you may need to give more space in between, so we opened your hands with this option. :) ", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Letter Spacing", "mk_framework") ,
            "param_name" => "letter_spacing",
            "value" => "0",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Space between each character.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Stroke Width", "mk_framework") ,
            "param_name" => "stroke",
            "value" => "0",
            "min" => "0",
            "max" => "10",
            "step" => "1",
            "unit" => 'px',
            "description" => __("Using this option you can set a frame around the title.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Stroke Color", "mk_framework") ,
            "param_name" => "stroke_color",
            "value" => "",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Top", "mk_framework") ,
            "param_name" => "margin_top",
            "value" => "0",
            "min" => "-40",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("In some ocasions you may on need to define a top margin for this title.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Margin Bottom", "mk_framework") ,
            "param_name" => "margin_bottom",
            "value" => "20",
            "min" => "0",
            "max" => "500",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
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
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "width" => 150,
            "value" => array(
                __('Left', "mk_framework") => "left",
                __('Right', "mk_framework") => "right",
                __('Center', "mk_framework") => "center"
            ) ,
            "description" => __("", "mk_framework")
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
));