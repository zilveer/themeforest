<?php

add_action( 'init', 'tb_custom_post_type_event' );

function tb_custom_post_type_event() {

    $labels = array( 
        'name' => _x( 'Events', 'event', 'the-cause' ),
        'singular_name' => _x( 'Event', 'event', 'the-cause' ),
        'add_new' => _x( 'Add New', 'event', 'the-cause' ),
        'add_new_item' => _x( 'Add New Event', 'event', 'the-cause' ),
        'edit_item' => _x( 'Edit Event', 'event', 'the-cause' ),
        'new_item' => _x( 'New Event', 'event', 'the-cause' ),
        'view_item' => _x( 'View Event', 'event', 'the-cause' ),
        'search_items' => _x( 'Search Events', 'event', 'the-cause' ),
        'not_found' => _x( 'No events found', 'event', 'the-cause' ),
        'not_found_in_trash' => _x( 'No events found in Trash', 'event', 'the-cause' ),
        'parent_item_colon' => _x( 'Parent Event:', 'event', 'the-cause' ),
        'menu_name' => _x( 'Events', 'event', 'the-cause' ),
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
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'event', $args );
}

?>