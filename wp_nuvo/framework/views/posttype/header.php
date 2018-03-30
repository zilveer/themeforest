<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
// Add custom post type header
function cs_add_post_type_header() {
    $labels = array(
        'name' => 'Headers',
        'singular_name' => 'Header',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Header',
        'edit_item' => 'Edit Header',
        'new_item' => 'New Header',
        'all_items' => 'Headers',
        'view_item' => 'View Header',
        'search_items' => 'Search Headers',
        'not_found' => 'No headers found',
        'not_found_in_trash' => 'No headers found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Headers'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'header'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 9,
        'menu_icon' => 'dashicons-admin-home',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
    );
    register_post_type('header', $args);
}
add_action('init', 'cs_add_post_type_header');