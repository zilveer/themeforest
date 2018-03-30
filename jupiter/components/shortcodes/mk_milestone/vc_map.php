<?php
vc_map(array(
    "name" => __("Milestones", "mk_framework") ,
    "base" => "mk_milestone",
    'icon' => 'icon-mk-milestone vc_mk_element-icon',
    'description' => __('Milestone numbers to show statistics.', 'mk_framework') ,
    "category" => __('General', 'mk_framework') ,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Add Icon Class Name", "mk_framework") ,
            "param_name" => "icon",
            "value" => "",
            "description" => __("<a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name (or any other font icons library that you have installed in the theme)", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Icon & Text Size", "mk_framework") ,
            "param_name" => "icon_size",
            "value" => array(
                __("Small", "mk_framework") => "small",
                __("Medium", "mk_framework") => "medium",
                __("Large", "mk_framework") => "large"
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "dropdown",
            "heading" => __("Align", "mk_framework") ,
            "param_name" => "align",
            "value" => array(
                __("Left", "mk_framework") => "left",
                __("center", "mk_framework") => "center",
                __("right", "mk_framework") => "right",
            ) ,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Icon Color", "mk_framework") ,
            "param_name" => "icon_color",
            "value" => $skin_color,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Number Starts at:", "mk_framework") ,
            "param_name" => "start",
            "value" => "0",
            "min" => "0",
            "max" => "100000",
            "step" => "1",
            "unit" => '',
            "description" => __("Choose at which number it should start.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Number Stops at:", "mk_framework") ,
            "param_name" => "stop",
            "value" => "100",
            "min" => "0",
            "max" => "100000",
            "step" => "1",
            "unit" => '',
            "description" => __("Choose at which number it should Stop.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Speed", "mk_framework") ,
            "param_name" => "speed",
            "value" => "2000",
            "min" => "0",
            "max" => "10000",
            "step" => "1",
            "unit" => 'ms',
            "description" => __("Speed of the animation from start to stop in milliseconds.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Number Prefix", "mk_framework") ,
            "param_name" => "prefix",
            "value" => "",
            "description" => __("This text goes before the Number.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Number Suffix", "mk_framework") ,
            "param_name" => "suffix",
            "value" => "",
            "description" => __("This text goes after the Number.", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Description", "mk_framework") ,
            "param_name" => "text",
            "value" => "",
            "description" => __("Description that goes below the Number.", "mk_framework")
        ) ,
        array(
            "type" => "colorpicker",
            "heading" => __("Text Color", "mk_framework") ,
            "param_name" => "text_color",
            "value" => "",
            "description" => __("This option will affect Prefix, suffix, number and description.", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Number Text Size (Number, Prefix and Suffix)", "mk_framework") ,
            "param_name" => "text_size",
            "value" => "0",
            "min" => "12",
            "max" => "100",
            "step" => "1",
            "unit" => '',
            "description" => __("Text Size will change based on \"Icon & Text Size\" option, however you can set a custom size using this option.", "mk_framework")
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
            "heading" => __("Number Font Weight", "mk_framework") ,
            "param_name" => "font_weight",
            "value" => $font_weight,
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "range",
            "heading" => __("Description Text Size", "mk_framework") ,
            "param_name" => "desc_size",
            "value" => "14",
            "min" => "10",
            "max" => "100",
            "step" => "1",
            "unit" => '',
            "description" => __("", "mk_framework")
        ) ,
        array(
            "type" => "textfield",
            "heading" => __("Link (optional)", "mk_framework") ,
            "param_name" => "link",
            "value" => "",
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