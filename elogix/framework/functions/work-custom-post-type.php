<?php

/* ----------------------------------------------------- */
/* Work Custom Post Type */
/* ----------------------------------------------------- */

define( 'TEMPLATE_URL', get_bloginfo('template_directory') . '/framework/images/' );

add_action( 'init', 'register_cpt_work' );

function register_cpt_work() {

    $labels = array( 
        'name' => _x( 'Works', 'work' ),
        'singular_name' => _x( 'Work', 'work' ),
        'add_new' => _x( 'Add New', 'work' ),
        'add_new_item' => _x( 'Add New Work', 'work' ),
        'edit_item' => _x( 'Edit Work', 'work' ),
        'new_item' => _x( 'New Work', 'work' ),
        'view_item' => _x( 'View Work', 'work' ),
        'search_items' => _x( 'Search Works', 'work' ),
        'not_found' => _x( 'No works found', 'work' ),
        'not_found_in_trash' => _x( 'No works found in Trash', 'work' ),
        'parent_item_colon' => _x( 'Parent Work:', 'work' ),
        'menu_name' => _x( 'Works', 'work' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Display all your works with this fantastic filterable Portfolio',
        'supports' => array( 'title', 'editor', 'comments', 'revisions', 'thumbnail' ),
        
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        'menu_icon' => TEMPLATE_URL . 'work.png',
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'work', $args );
}

/* ----------------------------------------------------- */
/* Filter Taxonomy */
/* ----------------------------------------------------- */

add_action( 'init', 'register_taxonomy_filters' );

function register_taxonomy_filters() {

    $labels = array( 
        'name' => _x( 'Filters', 'filters' ),
        'singular_name' => _x( 'Filter', 'filters' ),
        'search_items' => _x( 'Search Filters', 'filters' ),
        'popular_items' => _x( 'Popular Filters', 'filters' ),
        'all_items' => _x( 'All Filters', 'filters' ),
        'parent_item' => _x( 'Parent Filter', 'filters' ),
        'parent_item_colon' => _x( 'Parent Filter:', 'filters' ),
        'edit_item' => _x( 'Edit Filter', 'filters' ),
        'update_item' => _x( 'Update Filter', 'filters' ),
        'add_new_item' => _x( 'Add New Filter', 'filters' ),
        'new_item_name' => _x( 'New Filter', 'filters' ),
        'separate_items_with_commas' => _x( 'Separate Filters with commas', 'filters' ),
        'add_or_remove_items' => _x( 'Add or remove Filters', 'filters' ),
        'choose_from_most_used' => _x( 'Choose from the most used Filters', 'filters' ),
        'menu_name' => _x( 'Filters', 'filters' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'filters', array('work'), $args );
}

/* ----------------------------------------------------- */
/* EOF */
/* ----------------------------------------------------- */

?>