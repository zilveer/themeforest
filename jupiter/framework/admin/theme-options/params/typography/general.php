<?php

$typography_section[] = array(
    "type" => "sub_group",
    "id" => "mk_options_general_typography",
    "name" => __("Typography / General Typography", "mk_framework") ,
    "desc" => __("", "mk_framework") ,
    "fields" => array(
       array(
        "name" => __('Body Text Size', "mk_framework"),
        "desc" => __("", "mk_framework"),
        "id" => "body_font_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "14",
        "type" => "range"
    ),
    array(
        "name" => __('Body Text Line Height', "mk_framework"),
        "desc" => __("This option will let you change the line height of texts in site. Please note that some elements has their own direct line height property, so you can not change them from here. The unit is in 'em'", "mk_framework"),
        "id" => "body_line_height",
        "min" => "1",
        "max" => "4",
        "step" => "0.01",
        "unit" => 'em',
        "default" => "1.66",
        "type" => "range"
    ),
    array(
        "name" => __('Body Text Weight', "mk_framework"),
        "id" => "body_weight",
        "default" => 400,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Paragraph (p) Text Size', "mk_framework"),
        "id" => "p_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "16",
        "type" => "range"
    ),
    array(
        "name" => __('Paragraph (p) Text Line Height', "mk_framework"),
        "desc" => __("This option will let you change the line height of paragraphs. The unit is in 'em'", "mk_framework"),
        "id" => "p_line_height",
        "min" => "1",
        "max" => "4",
        "step" => "0.01",
        "unit" => 'em',
        "default" => "1.66",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 1 (h1) Size', "mk_framework"),
        "id" => "h1_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "36",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 1 (h1) Weight', "mk_framework"),
        "id" => "h1_weight",
        "default" => 600,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Heading 1 (h1) Text Case', "mk_framework"),
        "id" => "h1_transform",
        "default" => 'uppercase',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    array(
        "name" => __('Heading 2 (h2) Size', "mk_framework"),
        "id" => "h2_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "30",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 2 (h2) Weight', "mk_framework"),
        "id" => "h2_weight",
        "default" => 600,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Heading 2 (h2) Text Case', "mk_framework"),
        "id" => "h2_transform",
        "default" => 'uppercase',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    array(
        "name" => __('Heading 3 (h3) Size', "mk_framework"),
        "id" => "h3_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "24",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 3 (h3) Weight', "mk_framework"),
        "id" => "h3_weight",
        "default" => 600,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Heading 3 (h3) Text Case', "mk_framework"),
        "id" => "h3_transform",
        "default" => 'uppercase',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    array(
        "name" => __('Heading 4 (h4) Size', "mk_framework"),
        "id" => "h4_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "18",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 4 (h4) Weight', "mk_framework"),
        "id" => "h4_weight",
        "default" => 600,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Heading 4 (h4) Text Case', "mk_framework"),
        "id" => "h4_transform",
        "default" => 'uppercase',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    array(
        "name" => __('Heading 5 (h5) Size', "mk_framework"),
        "id" => "h5_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "16",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 5 (h5) Weight', "mk_framework"),
        "id" => "h5_weight",
        "default" => 600,
        "type" => "font_weight"
    ),
    array(
        "name" => __('Heading 5 (h5) Text Case', "mk_framework"),
        "id" => "h5_transform",
        "default" => 'uppercase',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    array(
        "name" => __('Heading 6 (h6) Size', "mk_framework"),
        "id" => "h6_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "14",
        "type" => "range"
    ),
    array(
        "name" => __('Heading 6 (h6) Weight', "mk_framework"),
        "id" => "h6_weight",
        "default" => 600,
       "type" => "font_weight"
    ),
    array(
        "name" => __('Heading 6 (h6) Text Case', "mk_framework"),
        "id" => "h6_transform",
        "default" => 'uppercase',
        "options" => array(
            "none" => __('None', "mk_framework"),
            "uppercase" => __('Uppercase', "mk_framework"),
            "capitalize" => __('Capitalize', "mk_framework"),
            "lowercase" => __('Lower case', "mk_framework")
        ),
        "type" => "dropdown"
    ),
    array(
        "name" => __('Header Start Tour Link Font Size', "mk_framework"),
        "id" => "start_tour_size",
        "min" => "10",
        "max" => "50",
        "step" => "1",
        "unit" => 'px',
        "default" => "14",
        "type" => "range"
    ),
    ) ,
);