<?php

/* Create the Testimonial Custom Post Type */
if (!function_exists('create_testimonial_post_type')) {
    function create_testimonial_post_type()
    {
        $labels = array(
            'name' => __( 'Testimonials','framework'),
            'singular_name' => __( 'Testimonial','framework' ),
            'add_new' => __('Add New','framework'),
            'add_new_item' => __('Add New Testimonial','framework'),
            'edit_item' => __('Edit Testimonial','framework'),
            'new_item' => __('New Testimonial','framework'),
            'view_item' => __('View Testimonial','framework'),
            'search_items' => __('Search Testimonial','framework'),
            'not_found' =>  __('No Testimonial found','framework'),
            'not_found_in_trash' => __('No Testimonial found in Trash','framework'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-testimonial',
            'menu_position' => 5,
            'supports' => array('title','thumbnail')
        );

        register_post_type('testimonial',$args);
    }
}

add_action('init', 'create_testimonial_post_type');
?>