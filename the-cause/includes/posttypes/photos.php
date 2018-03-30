<?php

add_action( 'init', 'tb_custom_post_type_photo' );

function tb_custom_post_type_photo() {

    $labels = array( 
        'name' => _x( 'Photos', 'photo', 'the-cause' ),
        'singular_name' => _x( 'Photo', 'photo', 'the-cause' ),
        'add_new' => _x( 'Add New', 'photo', 'the-cause' ),
        'add_new_item' => _x( 'Add New Photo', 'photo', 'the-cause' ),
        'edit_item' => _x( 'Edit Photo', 'photo', 'the-cause' ),
        'new_item' => _x( 'New Photo', 'photo', 'the-cause' ),
        'view_item' => _x( 'View Photo', 'photo', 'the-cause' ),
        'search_items' => _x( 'Search Photos', 'photo', 'the-cause' ),
        'not_found' => _x( 'No photos found', 'photo', 'the-cause' ),
        'not_found_in_trash' => _x( 'No photos found in Trash', 'photo', 'the-cause' ),
        'parent_item_colon' => _x( 'Parent Photo:', 'photo', 'the-cause' ),
        'menu_name' => _x( 'Photos', 'photo', 'the-cause' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'page-attributes', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => get_option('tb_menu_icon'),
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'photo', $args );
}
?>