<?php
/**
 * Theme options > COLOR OPTIONS
 */

$admin_options[]         = array (
    'slug'        => 'color_options_palette',
    'parent'      => 'color_options',
    "name"        => __( "Add Colors for Palette", 'zn_framework' ),
    "description" => sprintf(__( 'Here you can add colors that will be displayed in the <strong style="color:#121212">bottom\'s colorpicker palette</strong>:<br><br> <img width="140" src="%s/images/zn_add_pallette_lq.png" alt="">. <br><br>Color resources:', 'zn_framework' ), THEME_BASE_URI) .'<br><a href="'.esc_url('http://colorhunt.co/tab/').'" title="">ColorHunt</a><br><a href="'.esc_url('http://www.colourlovers.com/').'" title="">ColourLovers</a>',
    "id"          => "zn_add_colors",
    "std"         => "",
    "type"        => "group",
    "element_title"    => "zn_color",
    "add_text"    => __( "Color", 'zn_framework' ),
    "remove_text" => __( "Color", 'zn_framework' ),
    "subelements" => array (
        array (
            "name"        => __( "Add Color", 'zn_framework' ),
            "description" => __( "Choose the color", 'zn_framework' ),
            "id"          => "zn_color",
            "std"         => "",
            "type"        => "colorpicker"
        ),
    ),
    "class"       => "zn_not_full"
);
