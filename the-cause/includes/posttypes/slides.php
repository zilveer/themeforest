<?php

add_action( 'init', 'tb_custom_post_type_slide' );

function tb_custom_post_type_slide() {

    $labels = array( 
        'name' => _x( 'Slides', 'slide', 'the-cause' ),
        'singular_name' => _x( 'Slide', 'slide', 'the-cause' ),
        'add_new' => _x( 'Add New', 'slide', 'the-cause' ),
        'add_new_item' => _x( 'Add New Slide', 'slide', 'the-cause' ),
        'edit_item' => _x( 'Edit Slide', 'slide', 'the-cause' ),
        'new_item' => _x( 'New Slide', 'slide', 'the-cause' ),
        'view_item' => _x( 'View Slide', 'slide', 'the-cause' ),
        'search_items' => _x( 'Search Slides', 'slide', 'the-cause' ),
        'not_found' => _x( 'No slides found', 'slide', 'the-cause' ),
        'not_found_in_trash' => _x( 'No slides found in Trash', 'slide', 'the-cause' ),
        'parent_item_colon' => _x( 'Parent Slide:', 'slide', 'the-cause' ),
        'menu_name' => _x( 'Slides', 'slide', 'the-cause' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Posts of this type will be used for HP slider...',
        'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => get_option('tb_menu_icon'),
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'slide', $args );
}

?>