<?php

vc_map(array(
    "name" => __("Diagram Progress Bar", "mk_framework") ,
    "base" => "mk_skill_meter_chart",
    "category" => __('General', 'mk_framework') ,
    'icon' => 'icon-mk-diagram-progress-bar vc_mk_element-icon',
    'description' => __('Show skills & data in diagram charts.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "range",
            "heading" => __("Data 1 : Percent", "mk_framework") ,
            "param_name" => "percent_1",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 1 : Arch Color", "mk_framework") ,
            "param_name" => "color_1",
            "value" => "#e74c3c",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 1 : Name", "mk_framework") ,
            "param_name" => "name_1",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Data 2 : Percent", "mk_framework") ,
            "param_name" => "percent_2",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 2 : Arch Color", "mk_framework") ,
            "param_name" => "color_2",
            "value" => "#8c6645",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 2 : Name", "mk_framework") ,
            "param_name" => "name_2",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Data 3 : Percent", "mk_framework") ,
            "param_name" => "percent_3",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 3 : Arch Color", "mk_framework") ,
            "param_name" => "color_3",
            "value" => "#265573",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 3 : Name", "mk_framework") ,
            "param_name" => "name_3",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Data 4 : Percent", "mk_framework") ,
            "param_name" => "percent_4",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 4 : Arch Color", "mk_framework") ,
            "param_name" => "color_4",
            "value" => "#008b83",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 4 : Name", "mk_framework") ,
            "param_name" => "name_4",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Data 5 : Percent", "mk_framework") ,
            "param_name" => "percent_5",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 5 : Arch Color", "mk_framework") ,
            "param_name" => "color_5",
            "value" => "#d96b52",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 5 : Name", "mk_framework") ,
            "param_name" => "name_5",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Data 6 : Percent", "mk_framework") ,
            "param_name" => "percent_6",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 6 : Arch Color", "mk_framework") ,
            "param_name" => "color_6",
            "value" => "#82bf56",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 6 : Name", "mk_framework") ,
            "param_name" => "name_6",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Data 7 : Percent", "mk_framework") ,
            "param_name" => "percent_7",
            "value" => "0",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("Measure your data in percent", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Data 7 : Arch Color", "mk_framework") ,
            "param_name" => "color_7",
            "value" => "#4ecdc4",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Data 7 : Name", "mk_framework") ,
            "param_name" => "name_7",
            "value" => "",
            "margin_bottom" => 40,
            "description" => __("The name of data you are demonstrating", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Default Text", "mk_framework") ,
            "param_name" => "default_text",
            "value" => "Skill",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Center Circle Background Color", "mk_framework") ,
            "param_name" => "center_color",
            "value" => "#1e3641",
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Default Text Color", "mk_framework") ,
            "param_name" => "default_text_color",
            "value" => "#fff",
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