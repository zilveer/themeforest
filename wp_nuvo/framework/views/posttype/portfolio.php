<?php
function cs_add_post_type_portfolio() {
    $portfolio_labels = array(
        'name' => esc_html__('Portfolio', 'wp_nuvo'),
        'singular_name' => esc_html__('Portfolio Item', 'wp_nuvo'),
        'search_items' => esc_html__('Search Portfolio Items', 'wp_nuvo'),
        'all_items' => esc_html__('Portfolio', 'wp_nuvo'),
        'parent_item' => esc_html__('Parent Portfolio Item', 'wp_nuvo'),
        'edit_item' => esc_html__('Edit Portfolio Item', 'wp_nuvo'),
        'update_item' => esc_html__('Update Portfolio Item', 'wp_nuvo'),
        'add_new_item' => esc_html__('Add New Portfolio Item', 'wp_nuvo'),
        'not_found' => esc_html__('No portfolio found', 'wp_nuvo')
    );

    $args = array(
        'labels' => $portfolio_labels,
        'rewrite' => array('slug' => 'portfolio'),
        'singular_label' => esc_html__('Project', 'wp_nuvo'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'hierarchical' => true,
        'menu_position' => 9,
    	'capability_type'=>'post',
        'menu_icon' => 'dashicons-welcome-view-site',
        'supports' => array('title', 'editor', 'thumbnail', 'comments')
    );

    register_post_type('portfolio', $args);
    register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true, 'label' => esc_html__('Portfolio Categories', 'wp_nuvo'), 'query_var' => true,'show_ui' => true, 'rewrite' => true));

    $labels = array(
        'name' => esc_html__('Portfolio Tags', 'wp_nuvo'),
        'singular_name' => esc_html__('Tag', 'wp_nuvo'),
        'search_items' => esc_html__('Search Tags', 'wp_nuvo'),
        'popular_items' => esc_html__('Popular Tags', 'wp_nuvo'),
        'all_items' => esc_html__('All Tags', 'wp_nuvo'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => esc_html__('Edit Tag', 'wp_nuvo'),
        'update_item' => esc_html__('Update Tag', 'wp_nuvo'),
        'add_new_item' => esc_html__('Add New Tag', 'wp_nuvo'),
        'new_item_name' => esc_html__('New Tag Name', 'wp_nuvo'),
        'separate_items_with_commas' => esc_html__('Separate tags with commas', 'wp_nuvo'),
        'add_or_remove_items' => esc_html__('Add or remove tags', 'wp_nuvo'),
        'choose_from_most_used' => esc_html__('Choose from the most used tags', 'wp_nuvo'),
        'menu_name' => esc_html__('Portfolio Tags', 'wp_nuvo'),
    );

    register_taxonomy('portfolio_tag', 'portfolio', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'tag'),
    ));

}

add_action('init', 'cs_add_post_type_portfolio');