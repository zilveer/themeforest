<?php

function slider_theme_custom_posts(){

	//Portfolio
	$labels = array(
	  'name' =>

__('Portfolios', 'Portfolio','templatemela'),
	  'singular_name' => __('Portfolio', 'Portfolio','templatemela'),
	  'add_new' => __('Add New', 'Portfolio item','templatemela'),
	  'add_new_item' => __('Add New Portfolio item','templatemela'),
	  'edit_item' => __('Edit Portfolio Item','templatemela'),
	  'new_item' => __('New Portfolio Item','templatemela'),
	  'view_item' => __('View Portfolio Item','templatemela'),
	  'search_items' => __('Search Portfolio Item','templatemela'),
	  'not_found' =>  __('No Portfolio item found','templatemela'),
	  'not_found_in_trash' => __('No Portfolio item found in Trash','templatemela'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'menu_icon' => 'dashicons-images-alt2',
	  'rewrite' => array('slug'=>'portfolio','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('portfolio',$args);
	
	// Portfolio Categories
	$labels = array(
	  'name' => __( 'Portfolio Categories', 'taxonomy general name' ,'templatemela'),
	  'singular_name' => __( 'Portfolio Category', 'taxonomy singular name','templatemela' ),
	  'search_items' =>  __( 'Search Portfolio Category' ,'templatemela'),
	  'all_items' => __( 'All Portfolio Categories' ,'templatemela'),
	  'parent_item' => __( 'Parent Portfolio Category' ,'templatemela'),
	  'parent_item_colon' => __( 'Parent Portfolio Category:' ,'templatemela'),
	  'edit_item' => __( 'Edit Portfolio Category','templatemela' ), 
	  'update_item' => __( 'Update Portfolio Category' ,'templatemela'),
	  'add_new_item' => __( 'Add New Portfolio Category','templatemela' ),
	  'new_item_name' => __( 'New Genre Portfolio Category','templatemela' ),
	); 	
	
	register_taxonomy('portfolio_categories',array('portfolio'), array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'query_var' => true,
	  '_builtin' => false,
	  'paged'=>true,
	  'rewrite' => false,
	));
}
add_filter('init', 'slider_theme_custom_posts' );

function filter_post_type_link($link, $post)
{
	if ($cats = get_the_terms($post->ID, 'portfolio_categories'))
	$link = str_replace('%portfolio%', 'array_pop($cats)->slug', $link);
	return $link;
}
add_filter('post_type_link', 'filter_post_type_link', 10, 2); 