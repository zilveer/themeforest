<?php

add_action( 'init', 'tb_custom_post_type_video' );

function tb_custom_post_type_video() {

    $labels = array( 
        'name' => _x( 'Videos', 'tb_video', 'the-cause' ),
        'singular_name' => _x( 'Video', 'tb_video', 'the-cause' ),
        'add_new' => _x( 'Add New', 'tb_video', 'the-cause' ),
        'add_new_item' => _x( 'Add New Video', 'tb_video', 'the-cause' ),
        'edit_item' => _x( 'Edit Video', 'tb_video', 'the-cause' ),
        'new_item' => _x( 'New Video', 'tb_video', 'the-cause' ),
        'view_item' => _x( 'View Video', 'tb_video', 'the-cause' ),
        'search_items' => _x( 'Search Videos', 'tb_video', 'the-cause' ),
        'not_found' => _x( 'No videos found', 'tb_video', 'the-cause' ),
        'not_found_in_trash' => _x( 'No videos found in Trash', 'tb_video', 'the-cause' ),
        'parent_item_colon' => _x( 'Parent Video:', 'tb_video', 'the-cause' ),
        'menu_name' => _x( 'Videos', 'tb_video', 'the-cause' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        
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

    register_post_type( 'tb_video', $args );
}