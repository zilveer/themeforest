<?php
/**
 * Portfolio Post Type
 * @package VAN Framework
 */

/*Create Portfolio Post Type*/
function create_portfolio() {
	
  $labels = array(
    'name' => __('Portfolios','SimpleKey'),
    'singular_name' => __('All Portfolios','SimpleKey'),
    'add_new' => __('Add Portfolio','SimpleKey'),
    'add_new_item' => __('Add New Portfolio','SimpleKey'),
    'edit_item' => __('Edit Portfolio','SimpleKey'),
    'new_item' => __('Add New','SimpleKey'),
    'view_item' => __('Browse Portfolio','SimpleKey'),
    'search_items' => __('Search Portfolio','SimpleKey'),
    'not_found' =>  __('No portfolios found.','SimpleKey'),
    'not_found_in_trash' => __('No portfolios found in trash.','SimpleKey'),
    'parent_item_colon' => ''
  );
 
  $supports = array('title','thumbnail','editor','comments','author','excerpt');
 
  register_post_type( 'portfolio',
    array(
      'labels' => $labels,
      'public' => true,
	  'publicly_queryable' => true,
	  'query_var' => true,
      'supports' => $supports,
	  'menu_position' => 20,
	  'has_archive' => true,
	  'rewrite' => array( 'slug' => 'portfolio' ),
	  'capability_type' => 'post',
	  'show_in_nav_menus'=>false
    )
  );
}
add_action( 'init', 'create_portfolio' );

/*Portfolio Category*/
add_action( 'init', 'create_set' );
function create_set() {
 $labels = array(
    'name' => __( 'Portfolio category', 'SimpleKey'),
    'singular_name' => __( 'Portfolio category','SimpleKey'),
    'search_items' =>  __( 'Search category','SimpleKey'),
    'all_items' => __( 'All portfolio categories','SimpleKey'),
    'parent_item' => __( 'Parent portfolio category','SimpleKey'),
    'parent_item_colon' => __( 'Parent portfolio category','SimpleKey'),
    'edit_item' => __( 'Edit category','SimpleKey'),
    'update_item' => __( 'Update category','SimpleKey'),
    'add_new_item' => __( 'Add new category','SimpleKey'),
    'new_item_name' => __( 'New category name','SimpleKey'),
  );

  register_taxonomy('portfolios','portfolio',array(
    'hierarchical' => true,
    'labels' => $labels,
	'public'=>true,
	'show_ui' => true,
	'rewrite' => true,
	'rewrite' => array( 'slug' => 'portfolios' ),
	'query_var' => 'portfolios',
  ));
}
add_action('admin_init', 'flush_rewrite_rules');
?>