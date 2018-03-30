<?php
function cs_add_post_type_point_of_sale()
{
    $labels = array(
        'name' => esc_html__('Point of Sale', 'wp_nuvo'),
        'singular_name' => esc_html__('Point of Sale', 'wp_nuvo'),
        'add_new' => esc_html__('Add New', 'wp_nuvo'),
        'add_new_item' => esc_html__('Add New Point', 'wp_nuvo'),
        'edit_item' => esc_html__('Edit Point', 'wp_nuvo'),
        'new_item' => esc_html__('New Point', 'wp_nuvo'),
        'all_items' => esc_html__('Point of Sale', 'wp_nuvo'),
        'view_item' => esc_html__('View Point', 'wp_nuvo'),
        'search_items' => esc_html__('Search Point', 'wp_nuvo'),
        'not_found' => esc_html__('No Point found', 'wp_nuvo'),
        'not_found_in_trash' => esc_html__('No Point found in Trash', 'wp_nuvo'),
        'menu_name' => esc_html__('Point of Sale', 'wp_nuvo')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'pointofsale'
        ),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 9,
        'menu_icon' => 'dashicons-location',
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments'
        )
    );
    register_post_type('pointofsale', $args);
    register_taxonomy('pointofsale_category', 'pointofsale', array(
        'hierarchical' => true,
        'label' => esc_html__('Categories', 'wp_nuvo'),
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true
    ));

    register_taxonomy('pointofsale_tag', 'pointofsale', array(
        'hierarchical' => false,
        'label' => esc_html__('Tags', 'wp_nuvo'),
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'tag'
        )
    ));
}
add_action('init', 'cs_add_post_type_point_of_sale');