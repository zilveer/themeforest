<?php
/**
 * Loads all custom post code
 *
 * @package Smartbox
 * @subpackage Admin
 * @since 0.1
 *
 * @copyright (c) 2013 Oxygenna.com
 * @license http://wiki.envato.com/support/legal-terms/licensing-terms/
 * @version 1.5.8
 */

add_action('init', 'oxy_register_post_types');
function oxy_register_post_types() {


    /***************** SLIDESHOWS *******************/
    $labels = array(
        'name'               => __( 'Slideshow Images', THEME_ADMIN_TD ),
        'singular_name'      => __( 'Slideshow Image', THEME_ADMIN_TD ),
        'add_new'            => __( 'Add New', THEME_ADMIN_TD ),
        'add_new_item'       => __( 'Add New Image', THEME_ADMIN_TD ),
        'edit_item'          => __( 'Edit Image', THEME_ADMIN_TD ),
        'new_item'           => __( 'New Image', THEME_ADMIN_TD ),
        'view_item'          => __( 'View Image', THEME_ADMIN_TD ),
        'search_items'       => __( 'Search Images', THEME_ADMIN_TD ),
        'not_found'          => __( 'No images found', THEME_ADMIN_TD ),
        'not_found_in_trash' => __( 'No images found in Trash', THEME_ADMIN_TD ),
        'menu_name'          => __( 'Slider Images', THEME_ADMIN_TD )
    );

    $args = array(
        'labels'    => $labels,
        'public'    => false,
        'show_ui'   => true,
        'query_var' => false,
        'rewrite'   => false,
        'menu_icon' => ADMIN_ASSETS_URI . 'images/slideshow.png',
        'supports'  => array( 'title', 'thumbnail', 'page-attributes' )
    );

    // create custom post
    register_post_type( 'oxy_slideshow_image', $args );

    // Register slideshow taxonomy
    $labels = array(
        'name'          => __( 'Slideshows', THEME_ADMIN_TD ),
        'singular_name' => __( 'Slideshow', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Slideshows', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Slideshows', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Slideshow', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Slideshow', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Slideshow', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Slideshow Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_slideshow_categories',
        'oxy_slideshow_image',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => false,
            'rewrite'      => false
        )
    );

    // move featured image box on slideshow
    function oxy_move_slideshow_meta_box() {
        remove_meta_box( 'postimagediv', 'oxy_slideshow_image', 'side' );
        add_meta_box('postimagediv', __('Slideshow Image', THEME_ADMIN_TD), 'post_thumbnail_meta_box', 'oxy_slideshow_image', 'advanced', 'low');
    }
    add_action('do_meta_boxes', 'oxy_move_slideshow_meta_box');

    /***************** TIMELINES *******************/

    $labels = array(
        'name'               => __( 'Timeline', THEME_ADMIN_TD ),
        'singular_name'      => __( 'Timeline', THEME_ADMIN_TD ),
        'add_new'            => __( 'Add New', THEME_ADMIN_TD ),
        'add_new_item'       => __( 'Add New Timeline', THEME_ADMIN_TD ),
        'edit_item'          => __( 'Edit Timeline', THEME_ADMIN_TD ),
        'new_item'           => __( 'New Timeline', THEME_ADMIN_TD ),
        'view_item'          => __( 'View Timeline', THEME_ADMIN_TD ),
        'search_items'       => __( 'Search Timelines', THEME_ADMIN_TD ),
        'not_found'          => __( 'No timelines found', THEME_ADMIN_TD ),
        'not_found_in_trash' => __( 'No timelines found in Trash', THEME_ADMIN_TD ),
        'menu_name'          => __( 'Timelines', THEME_ADMIN_TD )
    );

    // fetch timeline slug
    $timeline_slug = trim( oxy_get_option( 'timeline_slug' ) );
    if( empty($timeline_slug) ) {
        $timeline_slug = 'timeline';
    }

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'show_ui'             => true,
        'exclude_from_search' => true,
        'has_archive'        => true,
        'menu_icon'           => ADMIN_ASSETS_URI . 'images/timeline.png',
        'supports'            => array( 'title' ),
        'rewrite'             => array( 'slug' => $timeline_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
    );

    // create custom post
    register_post_type( 'oxy_timeline', $args );

    /***************** PORTFOLIO *******************/

    $labels = array(
        'name'               => __('Portfolio Items', THEME_ADMIN_TD),
        'singular_name'      => __('Portfolio Item', THEME_ADMIN_TD),
        'add_new'            => __('Add New', THEME_ADMIN_TD),
        'add_new_item'       => __('Add New Portfolio Item', THEME_ADMIN_TD),
        'edit_item'          => __('Edit Portfolio Item', THEME_ADMIN_TD),
        'new_item'           => __('New Portfolio Item', THEME_ADMIN_TD),
        'view_item'          => __('View Portfolio Item', THEME_ADMIN_TD),
        'search_items'       => __('Search Portfolio Items', THEME_ADMIN_TD),
        'not_found'          => __('No images found', THEME_ADMIN_TD),
        'not_found_in_trash' => __('No images found in Trash', THEME_ADMIN_TD),
        'parent_item_colon'  => '',
        'menu_name'          => __('Portfolio Items', THEME_ADMIN_TD)
    );

    // fetch portfolio slug
    $permalink_slug = trim( oxy_get_option( 'portfolio_slug' ) );
    if( empty($permalink_slug) ) {
        $permalink_slug = 'portfolio';
    }

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => ADMIN_ASSETS_URI . 'images/portfolio.png',
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes', 'post-formats' ),
        'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
    );

    // create custom post
    register_post_type( 'oxy_portfolio_image', $args );

    // Register portfolio taxonomy
    $labels = array(
        'name'          => __( 'Categories', THEME_ADMIN_TD ),
        'singular_name' => __( 'Category', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Categories', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Categories', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Category', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Category', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Category', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Category Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_portfolio_categories',
        'oxy_portfolio_image',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
        )
    );


    $labels = array(
        'name'          => __( 'Skills', THEME_ADMIN_TD ),
        'singular_name' => __( 'Skill', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Skills', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Skills', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Skill', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Skill', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Skill', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Skill Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_portfolio_skills',
        'oxy_portfolio_image',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
        )
    );


    /* ------------------ TESTIMONIALS -----------------------*/

    $labels = array(
        'name'               => __('Testimonial', THEME_ADMIN_TD),
        'singular_name'      => __('Testimonial',  THEME_ADMIN_TD),
        'add_new'            => __('Add New',  THEME_ADMIN_TD),
        'add_new_item'       => __('Add New Testimonial',  THEME_ADMIN_TD),
        'edit_item'          => __('Edit Testimonial',  THEME_ADMIN_TD),
        'new_item'           => __('New Testimonial',  THEME_ADMIN_TD),
        'all_items'          => __('All Testimonial',  THEME_ADMIN_TD),
        'view_item'          => __('View Testimonial',  THEME_ADMIN_TD),
        'search_items'       => __('Search Testimonial',  THEME_ADMIN_TD),
        'not_found'          => __('No Testimonial found',  THEME_ADMIN_TD),
        'not_found_in_trash' => __('No Testimonial found in Trash', THEME_ADMIN_TD),
        'menu_name'          => __('Testimonials',  THEME_ADMIN_TD)
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => ADMIN_ASSETS_URI . 'images/testimonials.png',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
    );
    register_post_type('oxy_testimonial', $args);

    $labels = array(
        'name'          => __( 'Groups', THEME_ADMIN_TD ),
        'singular_name' => __( 'Group', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Groups', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Groups', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Group', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Group', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Group', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Group Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_testimonial_group',
        'oxy_testimonial',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
        )
    );

    /* --------------------- STAFF ------------------------*/

    $labels = array(
        'name'               => __('Staff', THEME_ADMIN_TD),
        'singular_name'      => __('Staff',  THEME_ADMIN_TD),
        'add_new'            => __('Add New',  THEME_ADMIN_TD),
        'add_new_item'       => __('Add New Staff',  THEME_ADMIN_TD),
        'edit_item'          => __('Edit Staff',  THEME_ADMIN_TD),
        'new_item'           => __('New Staff',  THEME_ADMIN_TD),
        'all_items'          => __('All Staff',  THEME_ADMIN_TD),
        'view_item'          => __('View Staff',  THEME_ADMIN_TD),
        'search_items'       => __('Search Staff',  THEME_ADMIN_TD),
        'not_found'          => __('No Staff found',  THEME_ADMIN_TD),
        'not_found_in_trash' => __('No Staff found in Trash', THEME_ADMIN_TD),
        'menu_name'          => __('Staff',  THEME_ADMIN_TD)
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => ADMIN_ASSETS_URI . 'images/staff.png',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
    );
    register_post_type('oxy_staff', $args);

    $labels = array(
        'name'          => __( 'Skills', THEME_ADMIN_TD ),
        'singular_name' => __( 'Skill', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Skills', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Skills', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Skill', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Skill', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Skill', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Skill Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_staff_skills',
        'oxy_staff',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
            'query_var'    => true,
        )
    );

    $labels = array(
        'name'          => __( 'Departments', THEME_ADMIN_TD ),
        'singular_name' => __( 'Department', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Departments', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Departments', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Department', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Department', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Department', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Department Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_staff_department',
        'oxy_staff',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
        )
    );

    /* --------------------- SERVICES ------------------------*/

    $labels = array(
        'name'               => __('Services', THEME_ADMIN_TD),
        'singular_name'      => __('Service',  THEME_ADMIN_TD),
        'add_new'            => __('Add New',  THEME_ADMIN_TD),
        'add_new_item'       => __('Add New Service',  THEME_ADMIN_TD),
        'edit_item'          => __('Edit Service',  THEME_ADMIN_TD),
        'new_item'           => __('New Service',  THEME_ADMIN_TD),
        'all_items'          => __('All Services',  THEME_ADMIN_TD),
        'view_item'          => __('View Service',  THEME_ADMIN_TD),
        'search_items'       => __('Search Services',  THEME_ADMIN_TD),
        'not_found'          => __('No Service found',  THEME_ADMIN_TD),
        'not_found_in_trash' => __('No Service found in Trash', THEME_ADMIN_TD),
        'menu_name'          => __('Services',  THEME_ADMIN_TD)
    );

    // fetch service slug
    $service_slug = trim( oxy_get_option( 'services_slug' ) );
    if( empty($service_slug) ) {
        $service_slug = 'our-services';
    }

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => ADMIN_ASSETS_URI . 'images/services.png',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'rewrite'            => array( 'slug' => $service_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
    );
    register_post_type( 'oxy_service', $args );

    $labels = array(
        'name'          => __( 'Categories', THEME_ADMIN_TD ),
        'singular_name' => __( 'Category', THEME_ADMIN_TD ),
        'search_items'  => __( 'Search Categories', THEME_ADMIN_TD ),
        'all_items'     => __( 'All Categories', THEME_ADMIN_TD ),
        'edit_item'     => __( 'Edit Category', THEME_ADMIN_TD),
        'update_item'   => __( 'Update Category', THEME_ADMIN_TD),
        'add_new_item'  => __( 'Add New Category', THEME_ADMIN_TD),
        'new_item_name' => __( 'New Category Name', THEME_ADMIN_TD)
    );

    register_taxonomy(
        'oxy_service_category',
        'oxy_service',
        array(
            'hierarchical' => true,
            'labels'       => $labels,
            'show_ui'      => true,
        )
    );
}