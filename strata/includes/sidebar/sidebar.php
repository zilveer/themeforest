<?php

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'description' => 'Default Sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));

    register_sidebar(array(
        'name' => 'Sidebar Page',
        'id' => 'sidebar_page',
        'description' => 'Sidebar for Page',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));

    register_sidebar(array(
        'name' => 'Header Left',
        'id' => 'header_left',
        'description' => 'Header Left',
        'before_widget' => '<div class="header-widget %2$s header-left-widget">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'Header Right',
        'id' => 'header_right',
        'description' => 'Header Right',
        'before_widget' => '<div class="header-widget %2$s header-right-widget">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'Side Area',
        'id' => 'sidearea',
        'description' => 'Side Area',
        'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
        'after_widget' => '</div>',
        'before_title' => '<h5>',
        'after_title' => '</h5>'
    ));

    register_sidebar(array(
        'name' => 'Footer Column 1',
        'id' => 'footer_column_1',
        'description' => 'Footer Column 1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));

    register_sidebar(array(
        'name' => 'Footer Column 2',
        'id' => 'footer_column_2',
        'description' => 'Footer Column 2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));

    register_sidebar(array(
        'name' => 'Footer column 3',
        'id' => 'footer_column_3',
        'description' => 'Footer Column 3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));

    register_sidebar(array(
        'name' => 'Footer column 4',
        'id' => 'footer_column_4',
        'description' => 'Footer Column 4',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));

    register_sidebar(array(
        'name' => 'Footer text',
        'id' => 'footer_text',
        'description' => 'Footer Text',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

    register_sidebar(array(
        'name' => 'Header fixed right',
        'id' => 'header_fixed_right',
        'description' => 'This widget area is used only with sticky with menu on bottom menu type',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));

    if(function_exists('is_woocommerce')) {

        register_sidebar(array(
            'name' => 'WooCommerce Dropdown Widget Area',
            'id' => 'woocommerce_dropdown',
            'description' => 'This widget area should be used only for WooCommerce dropdown cart widget',
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        ));

    }
}

// register custom sidebars to theme
add_theme_support('qode_sidebar');
if (get_theme_support('qode_sidebar')) new qode_sidebar();

if (!function_exists('isUserMadeSidebar')) {
    function isUserMadeSidebar($name)
    {

        //this have to be changed depending on theme
        if ($name == 'Sidebar') {
            return false;
        } else if ($name == 'Sidebar Page') {
            return false;
        } else if ($name == 'Header Left') {
            return false;
        } else if ($name == 'Header Right') {
            return false;
        } else if ($name == 'Side Area') {
            return false;
        } else if ($name == 'Footer Column 1') {
            return false;
        } else if ($name == 'Footer Column 2') {
            return false;
        } else if ($name == 'Footer Column 3') {
            return false;
        } else if ($name == 'Footer Column 4') {
            return false;
        } else if ($name == 'Footer Text') {
            return false;
        } else {
            return true;
        }
    }
}
?>