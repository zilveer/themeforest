<?php

/* Create the Faq Custom Post Type */
if (!function_exists('create_faq_post_type')) {
    function create_faq_post_type()
    {

        $labels = array(
            'name' => __( 'FAQs','framework'),
            'singular_name' => __( 'FAQ','framework' ),
            'add_new' => __('Add New','framework'),
            'add_new_item' => __('Add New FAQ','framework'),
            'edit_item' => __('Edit FAQ','framework'),
            'new_item' => __('New FAQ','framework'),
            'view_item' => __('View FAQ','framework'),
            'search_items' => __('Search FAQ','framework'),
            'not_found' =>  __('No FAQs found','framework'),
            'not_found_in_trash' => __('No FAQs found in Trash','framework'),
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
            'menu_icon' => 'dashicons-format-chat',
            'menu_position' => 5,
            'supports' => array('title','editor')
        );

        register_post_type('faq', $args);
    }
}
add_action('init', 'create_faq_post_type');

/* Create FAQ Group Taxonomy */
if (!function_exists('create_faq_group_taxonomy')) {
    function create_faq_group_taxonomy()
    {
        $labels = array(
            'name' => __( 'FAQ Groups', 'framework' ),
            'singular_name' => __( 'FAQ Group', 'framework' ),
            'search_items' =>  __( 'Search FAQ Groups', 'framework' ),
            'popular_items' => __( 'Popular FAQ Groups', 'framework' ),
            'all_items' => __( 'All FAQ Groups', 'framework' ),
            'parent_item' => __( 'Parent FAQ Group', 'framework' ),
            'parent_item_colon' => __( 'Parent FAQ Group:', 'framework' ),
            'edit_item' => __( 'Edit FAQ Group', 'framework' ),
            'update_item' => __( 'Update FAQ Group', 'framework' ),
            'add_new_item' => __( 'Add New FAQ Group', 'framework' ),
            'new_item_name' => __( 'New FAQ Group Name', 'framework' ),
            'separate_items_with_commas' => __( 'Separate FAQ Groups with commas', 'framework' ),
            'add_or_remove_items' => __( 'Add or Remove FAQ Groups', 'framework' ),
            'choose_from_most_used' => __( 'Choose from the most used FAQ Groups', 'framework' ),
            'menu_name' => __( 'FAQ Groups', 'framework' )
        );

        register_taxonomy(
            'faq-group',
            array( 'faq' ),
            array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array('slug' => __('faq-group', 'framework'))
            )
        );
    }
}
add_action('init', 'create_faq_group_taxonomy', 0);


?>