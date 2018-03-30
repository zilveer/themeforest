<?php
vc_map(array(
    "name" => __("Skill Meter", "mk_framework") ,
    "base" => "mk_skill_meter",
    'icon' => 'icon-mk-skill-meter vc_mk_element-icon',
    'description' => __('Show skills in bars by percent.', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "mk_framework") ,
            "param_name" => "title",
            "value" => "",
            "description" => __("What skill are you demonstrating?", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Percent", "mk_framework") ,
            "param_name" => "percent",
            "value" => "50",
            "min" => "0",
            "max" => "100",
            "step" => "1",
            "unit" => '%',
            "description" => __("How many percent would you like to show for this skill bar?", "mk_framework")
        ) ,
        
        array(
            "type" => "range",
            "heading" => __("Bar Thickness", "mk_framework") ,
            "param_name" => "line_height",
            "value" => "22",
            "min" => "1",
            "max" => "50",
            "step" => "1",
            "unit" => 'px',
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "colorpicker",
            "heading" => __("Title Text Color", "mk_framework") ,
            "param_name" => "txt_color",
            "value" => '',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Percentage Text Color", "mk_framework") ,
            "param_name" => "percent_color",
            "value" => 'rgba(0,0,0,0.5)',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Bar Track Color", "mk_framework") ,
            "param_name" => "bar_color",
            "value" => 'rgba(0,0,0,0.12)',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Bar Progress Color", "mk_framework") ,
            "param_name" => "color",
            "value" => $skin_color,
            "description" => __("", "mk_framework")
        ) ,
        
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "mk_framework") ,
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in Custom CSS Shortcode or Masterkey Custom CSS option.", "mk_framework")
        )
    )
));
