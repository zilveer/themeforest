<?php

/* Create the Service Custom Post Type */
if (!function_exists('create_service_post_type')) {
    function create_service_post_type()
    {
        $labels = array(
            'name' => __( 'Services','framework'),
            'singular_name' => __( 'Service','framework' ),
            'add_new' => __('Add New','framework'),
            'add_new_item' => __('Add New Service','framework'),
            'edit_item' => __('Edit Service','framework'),
            'new_item' => __('New Service','framework'),
            'view_item' => __('View Service','framework'),
            'search_items' => __('Search Service','framework'),
            'not_found' =>  __('No Service found','framework'),
            'not_found_in_trash' => __('No Service found in Trash','framework'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-portfolio',
            'menu_position' => 5,
            'supports' => array('title','editor','thumbnail'),
            'rewrite' => array( 'slug' => __('service', 'framework') )
        );

        register_post_type('service', $args);
    }
}
add_action('init', 'create_service_post_type');


?>