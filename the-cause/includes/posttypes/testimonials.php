<?php

add_action( 'init', 'tb_custom_post_type_testimonial' );

function tb_custom_post_type_testimonial() {

    $labels = array( 
        'name' => _x( 'Testimonials', 'testimonial', 'the-cause' ),
        'singular_name' => _x( 'Testimonial', 'testimonial', 'the-cause' ),
        'add_new' => _x( 'Add New', 'testimonial', 'the-cause' ),
        'add_new_item' => _x( 'Add New Testimonial', 'testimonial', 'the-cause' ),
        'edit_item' => _x( 'Edit Testimonial', 'testimonial', 'the-cause' ),
        'new_item' => _x( 'New Testimonial', 'testimonial', 'the-cause' ),
        'view_item' => _x( 'View Testimonial', 'testimonial', 'the-cause' ),
        'search_items' => _x( 'Search Testimonials', 'testimonial', 'the-cause' ),
        'not_found' => _x( 'No testimonials found', 'testimonial', 'the-cause' ),
        'not_found_in_trash' => _x( 'No testimonials found in Trash', 'testimonial', 'the-cause' ),
        'parent_item_colon' => _x( 'Parent Testimonial:', 'testimonial', 'the-cause' ),
        'menu_name' => _x( 'Testimonials', 'testimonial', 'the-cause' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'What other said about us...?',
        'supports' => array( 'title', 'editor', 'thumbnail'),        
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

    register_post_type( 'testimonial', $args );
}

?>