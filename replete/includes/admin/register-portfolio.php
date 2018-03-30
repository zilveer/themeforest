<?php
add_action('init', 'portfolio_register');

function portfolio_register() 
{
	global $avia_config;

	$labels = array(
		'name' => _x('Portfolio Items', 'post type general name'),
		'singular_name' => _x('Portfolio Entry', 'post type singular name'),
		'add_new' => _x('Add New', 'portfolio'),
		'add_new_item' => __('Add New Portfolio Entry','avia_framework'),
		'edit_item' => __('Edit Portfolio Entry','avia_framework'),
		'new_item' => __('New Portfolio Entry','avia_framework'),
		'view_item' => __('View Portfolio Entry','avia_framework'),
		'search_items' => __('Search Portfolio Entries','avia_framework'),
		'not_found' =>  __('No Portfolio Entries found','avia_framework'),
		'not_found_in_trash' => __('No Portfolio Entries found in Trash','avia_framework'), 
		'parent_item_colon' => ''
	);
	
	$slugRule = avia_get_option('portfolio-slug');
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug'=>$slugRule,'with_front'=>true),
		'query_var' => true,
		'show_in_nav_menus'=> false,
		'supports' => array('title','thumbnail','excerpt','editor','comments')
	);
	
	$avia_config['custom_post']['portfolio']['args'] = $args;
	
	register_post_type( 'portfolio' , $args );
	
	
	register_taxonomy("portfolio_entries", 
		array("portfolio"), 
		array(	"hierarchical" => true, 
		"label" => "Portfolio Categories", 
		"singular_label" => "Portfolio Categories", 
		"rewrite" => true,
		"query_var" => true
	));  
}

#portfolio_columns, <-  register_post_type then append _columns
add_filter("manage_edit-portfolio_columns", "prod_edit_columns");
add_action("manage_posts_custom_column",  "prod_custom_columns");

function prod_edit_columns($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"thumb column-comments" => "Image",
		"title" => "Title",
		"portfolio_entries" => "Categories"
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}

function prod_custom_columns($column)
{
	global $post;
	switch ($column)
	{
		case "thumb column-comments":
		if (has_post_thumbnail($post->ID)){
				echo get_the_post_thumbnail($post->ID, 'widget');
			}
		break;
	
		case "description":
		#the_excerpt();
		break;
		case "price":
		#$custom = get_post_custom();
		#echo $custom["price"][0];
		break;
		case "portfolio_entries":
		echo get_the_term_list($post->ID, 'portfolio_entries', '', ', ','');
		break;
	}
}
?>