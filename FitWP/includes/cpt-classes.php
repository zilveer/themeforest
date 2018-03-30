<?php
function cpt_classes(){
	global $options;
	$url_rewrite = $options['theme_classes_item_url'];
	if( !$url_rewrite ) { $url_rewrite = 'classes'; }
	register_post_type('post_classes',
		array(
			'labels' => array(
				'name' => 'Classes',
				'singular_name' => 'Classes Item',
				'add_new' => 'Add New Classes',
				'add_new_item' => 'Add New Classes Item',
				'edit' => 'Edit',
				'edit_item' => 'Edit Classes Item',
				'new_item' => 'New Classes Item',
				'view' => 'View',
				'view_item' => 'View Classes Item',
				'search_items' => 'Search Classes Items',
				'not_found' => 'No classes items found',
				'not_found_in_trash' => 'No classes items found in Trash',
				'parent' => 'Parent Classes Item'
			),
			'description' => 'Easily lets you create some beautiful classes.',
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
function tax_classes() {
	global $options;
	$url_rewrite = $options['theme_classes_item_type_url'];
	if( !$url_rewrite ) { $url_rewrite = 'classes-cat'; }
	register_taxonomy('classes_item_types', 'post_classes', 
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

add_action('init', 'cpt_classes');
add_action('init', 'tax_classes');