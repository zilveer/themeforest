<?php
/*-----------------------------------------------------------------------------------*/
/*	Gallery Post Type
/*-----------------------------------------------------------------------------------*/
function truethemes_post_type_gallery() 
{
	$labels = array(
		'name' => __( 'Gallery Posts' , 'tt_theme_framework'),
		'singular_name' => __( 'Gallery Post' , 'tt_theme_framework'),
		'rewrite' => array('slug' => __( 'gallery' , 'tt_theme_framework')),
		'add_new' => __('Add New' , 'tt_theme_framework'),
		'add_new_item' => __('Add New Gallery Post' , 'tt_theme_framework'),
		'edit_item' => __('Edit Gallery Post' , 'tt_theme_framework'),
		'new_item' => __('New Gallery Post' , 'tt_theme_framework'),
		'view_item' => __('View Gallery Post' , 'tt_theme_framework'),
		'search_items' => __('Search Gallery Posts' , 'tt_theme_framework'),
		'not_found' =>  __('No Gallery Posts found' , 'tt_theme_framework'),
		'not_found_in_trash' => __('No Gallery Posts found in Trash' , 'tt_theme_framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title')
	  ); 
	  
	  register_post_type( 'gallery' ,$args );
}
add_action( 'init', 'truethemes_post_type_gallery' );





/*-----------------------------------------------------------------------------------*/
/*	FAQ Post Type
/*-----------------------------------------------------------------------------------*/
function truethemes_post_type_faqs() 
{
	$labels = array(
		'name' => __( 'FAQs' , 'tt_theme_framework'),
		'singular_name' => __( 'FAQ' , 'tt_theme_framework'),
		'rewrite' => array('slug' => __( 'faq' , 'tt_theme_framework')),
		'add_new' => __('Add New' , 'tt_theme_framework'),
		'add_new_item' => __('Add New FAQ' , 'tt_theme_framework'),
		'edit_item' => __('Edit FAQ' , 'tt_theme_framework'),
		'new_item' => __('New FAQ' , 'tt_theme_framework'),
		'view_item' => __('View FAQ' , 'tt_theme_framework'),
		'search_items' => __('Search FAQs' , 'tt_theme_framework'),
		'not_found' =>  __('No FAQs found' , 'tt_theme_framework'),
		'not_found_in_trash' => __('No FAQs found in Trash' , 'tt_theme_framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 7,
		'supports' => array('title')
	  ); 
	  
	  register_post_type( 'faq', $args );
}
add_action( 'init', 'truethemes_post_type_faqs' );





/*-----------------------------------------------------------------------------------*/
/*	Slider Post Type
/*-----------------------------------------------------------------------------------*/
function truethemes_post_type_slider() 
{
	$labels = array(
		'name' => __( 'Slider Posts' , 'tt_theme_framework'),
		'singular_name' => __( 'Slider Post' , 'tt_theme_framework'),
		'rewrite' => array('slug' => __( 'slider' , 'tt_theme_framework')),
		'add_new' => __('Add New' , 'tt_theme_framework'),
		'add_new_item' => __('Add New Slider Post' , 'tt_theme_framework'),
		'edit_item' => __('Edit Slider Post' , 'tt_theme_framework'),
		'new_item' => __('New Slider Post' , 'tt_theme_framework'),
		'view_item' => __('View Slider Post' , 'tt_theme_framework'),
		'search_items' => __('Search Slider Posts' , 'tt_theme_framework'),
		'not_found' =>  __('No Slider Posts found' , 'tt_theme_framework'),
		'not_found_in_trash' => __('No Slider Posts found in Trash' , 'tt_theme_framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 6,
		'supports' => array('title' , 'editor')
	  ); 
	  
	  register_post_type( 'slider', $args );
}
add_action( 'init', 'truethemes_post_type_slider' );