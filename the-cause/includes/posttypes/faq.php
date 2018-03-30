<?php

add_action( 'init', 'tb_custom_post_type_faq' );

function tb_custom_post_type_faq() {

    $labels = array( 
        'name' => _x( 'Questions', 'tb_faq', 'the-cause' ),
        'singular_name' => _x( 'Question', 'tb_faq', 'the-cause' ),
        'add_new' => _x( 'Add New', 'tb_faq', 'the-cause' ),
        'add_new_item' => _x( 'Add New Question', 'tb_faq', 'the-cause' ),
        'edit_item' => _x( 'Edit Question', 'tb_faq', 'the-cause' ),
        'new_item' => _x( 'New Question', 'tb_faq', 'the-cause' ),
        'view_item' => _x( 'View Question', 'tb_faq', 'the-cause' ),
        'search_items' => _x( 'Search Questions', 'tb_faq', 'the-cause' ),
        'not_found' => _x( 'No questions found', 'tb_faq', 'the-cause' ),
        'not_found_in_trash' => _x( 'No questions found in Trash', 'tb_faq', 'the-cause' ),
        'parent_item_colon' => _x( 'Parent Question:', 'tb_faq', 'the-cause' ),
        'menu_name' => _x( 'FAQ', 'tb_faq', 'the-cause' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        
        'supports' => array( 'title', 'editor', 'page-attributes' ),
        
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

    register_post_type( 'tb_faq', $args );
}

?>