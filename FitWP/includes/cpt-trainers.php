<?php
function cpt_trainers(){
	global $options;
	$url_rewrite = $options['theme_trainers_item_url'];
	if( !$url_rewrite ) { $url_rewrite = 'trainers'; }
	register_post_type('post_trainers',
		array(
			'labels' => array(
				'name' => 'Trainers',
				'singular_name' => 'Trainers Item',
				'add_new' => 'Add New Trainer',
				'add_new_item' => 'Add New Trainer Item',
				'edit' => 'Edit',
				'edit_item' => 'Edit Trainers Item',
				'new_item' => 'New Trainers Item',
				'view' => 'View',
				'view_item' => 'View Trainers Item',
				'search_items' => 'Search Trainers Items',
				'not_found' => 'No trainers items found',
				'not_found_in_trash' => 'No trainers items found in Trash',
				'parent' => 'Parent Trainers Item'
			),
			'description' => 'Easily lets you create some beautiful trainers.',
			'public' => true,
			'show_ui' => true, 
			'_builtin' => false,
			'capability_type' => 'page',
			'hierarchical' => true,
			'rewrite' => array('slug' => $url_rewrite),
			'supports' => array('title', 'editor', 'thumbnail', 'comments'),
		)
	); 
	flush_rewrite_rules();
}
function tax_trainers() {
	global $options;
	$url_rewrite = $options['theme_trainers_item_type_url'];
	if( !$url_rewrite ) { $url_rewrite = 'trainers-cat'; }
	register_taxonomy('trainers_item_types', 'post_trainers', 
		array( 
			'hierarchical' => true, 
			'labels' => array(
				  'name' => 'Item Category',
				  'singular_name' => 'Item Categories',
				  'search_items' =>  'Search Categories',
				  'popular_items' => 'Popular Categories',
				  'all_items' => 'All Categories',
				  'parent_item' => 'Parent Categories',
				  'parent_item_colon' => 'Parent Category:',
				  'edit_item' => 'Edit Category',
				  'update_item' => 'Update Category',
				  'add_new_item' => 'Add New Category',
				  'new_item_name' => 'New Category Name'
			),
			'show_ui' => true,
			'query_var' => true, 
			'rewrite' => array('slug' => $url_rewrite)
		) 
	); 
	flush_rewrite_rules();	
}

add_action('init', 'cpt_trainers');
add_action('init', 'tax_trainers');