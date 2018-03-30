<?php 
function faq_theme_custom_posts(){
	//faq
	$labels = array(
	  'name' => _x('FAQs', 'faq','templatemela'),
	  'singular_name' => _x('FAQ', 'faq','templatemela'),
	  'add_new' => _x('Add New', 'faq','templatemela'),
	  'add_new_item' => __('Add New FAQ','templatemela'),
	  'edit_item' => __('Edit FAQ','templatemela'),
	  'new_item' => __('New FAQ','templatemela'),
	  'view_item' => __('View FAQ','templatemela'),
	  'search_items' => __('Search FAQ','templatemela'),
	  'not_found' =>  __('No FAQ found','templatemela'),
	  'not_found_in_trash' => __('No FAQ found in Trash','templatemela'), 
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
	  'menu_icon' => 'dashicons-editor-help',
	  'rewrite' => array('slug'=>'faq','with_front'=>''),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('faq',$args);	
	
	// FAQ Categories
	$labels = array(
	  'name' => __( 'FAQ Categories', 'taxonomy general name' ,'templatemela'),
	  'singular_name' => __( 'FAQ Category', 'taxonomy singular name','templatemela' ),
	  'search_items' =>  __( 'Search FAQ Category' ,'templatemela'),
	  'all_items' => __( 'All FAQ Categories' ,'templatemela'),
	  'parent_item' => __( 'Parent FAQ Category' ,'templatemela'),
	  'parent_item_colon' => __( 'Parent FAQ Category:' ,'templatemela'),
	  'edit_item' => __( 'Edit FAQ Category','templatemela' ), 
	  'update_item' => __( 'Update FAQ Category' ,'templatemela'),
	  'add_new_item' => __( 'Add New FAQ Category','templatemela' ),
	  'new_item_name' => __( 'New Genre FAQ Category','templatemela' ),
	); 	
	
	register_taxonomy('faq_categories',array('faq'), array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'query_var' => true,
	  '_builtin' => false,
	  'paged'=>true,
	  'rewrite' => false,
	));
	
}
add_filter('init', 'faq_theme_custom_posts' );

function faq_filter_post_type_link($link, $post)
{
	if ($cats = get_the_terms($post->ID, 'faq_categories'))
	$link = str_replace('%faq%', 'array_pop($cats)->slug', $link);
	return $link;
}
add_filter('post_type_link', 'faq_filter_post_type_link', 10, 2); 