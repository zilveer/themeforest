<?php 
add_action('init', 'teo_post_types');
function teo_post_types() {
  $labels = array(
    'name' => _x('Portfolio items', 'post type general name', 'Proma'),
    'singular_name' => _x('Portfolio item', 'post type singular name', 'Proma'),
    'add_new' => _x('Add', 'portfolio_item', 'Proma'),
    'add_new_item' => __('Add a new portfolio item', 'Proma'),
    'edit_item' => __('Edit portfolio item', 'Proma'),
    'new_item' => __('New portfolio item', 'Proma'),
    'all_items' => __('All portfolio items', 'Proma'),
    'view_item' => __('View portfolio item details', 'Proma'),
    'search_items' => __('Search portfolio item', 'Proma'),
    'not_found' =>  __('No portfolio item found', 'Proma'),
    'not_found_in_trash' => __('No portfolio item in the trash.' , 'Proma'), 
    'parent_item_colon' => '',
    'menu_name' => 'Portfolio'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title')
  ); 
  
  register_post_type('portfolio',$args);
  register_taxonomy_for_object_type( 'category', 'portfolio' ); 
}
?>