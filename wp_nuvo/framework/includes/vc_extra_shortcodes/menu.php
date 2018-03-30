<?php
/* --------------------------------------------------------------------- */
/* Shortcode Menu */
/* --------------------------------------------------------------------- */
$custom_menus = array();
$menus = get_terms('nav_menu', array('hide_empty' => false));
if (is_array($menus)) {
    foreach ($menus as $single_menu) {
        $custom_menus[$single_menu->name] = $single_menu->term_id;
    }
}

vc_map(array(
    "name" => 'Menu',
    "base" => "cs-shortcode-menu",
    "icon" => "cs_icon_for_vc",
    "category" => esc_html__('CS Hero','wp_nuvo'),
    "class" => "wpb_vc_wp_widget",
    "description" => esc_html__("Load a menu", 'wp_nuvo'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => esc_html__('Title', 'wp_nuvo'),
            "param_name" => "title"
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Menu", 'wp_nuvo'),
            "param_name" => "nav_menu",
            "value" => $custom_menus,
            "admin_label" => true
        ),
        array(
            "type" => "dropdown",
            "heading" => esc_html__("Menu align", 'wp_nuvo'),
            "param_name" => "menu_align",
            "value" => array("None" => "", "Left" => "left", "Center" => "center", "Right" => "right"),
            "description" => esc_html__('Select your menu align.', 'wp_nuvo')
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__('Line height', 'wp_nuvo'),
            "param_name" => "menu_line_height",
            "value" => '80'
        ),
        array(
            "type" => "textfield",
            "heading" => esc_html__("Extra class name", 'wp_nuvo'),
            "param_name" => "el_class",
            "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'wp_nuvo')
        )
    )
));
?>