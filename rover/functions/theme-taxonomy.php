<?php
/**
 * @package by Theme Record
 * @auther: MattMao
 *
 *1--Create post type for portfolio
 *2--Prod edit columns for portfolio
 *3--Prod custom columns for portfolio
 *4--Create post type for product
 *5
 *6
*/

//Portfolio
add_action('init', 'theme_create_post_type_portfolio');
add_filter('manage_edit-portfolio_columns', 'prod_edit_columns_portfolio');
add_action('manage_posts_custom_column',  'prod_custom_columns_portfolio');

//Product
add_action('init', 'theme_create_post_type_product');
add_filter('manage_edit-product_columns', 'prod_edit_columns_product');
add_action('manage_posts_custom_column',  'prod_custom_columns_product');

//Gallery
add_action('init', 'theme_create_post_type_gallery');
add_filter('manage_edit-gallery_columns', 'prod_edit_columns_gallery');
add_action('manage_posts_custom_column',  'prod_custom_columns_gallery');


#
#Create post type for portfolio
#
function theme_create_post_type_portfolio() 
{
	$labels = array(
		'name' => __( 'Portfolios', 'TR'),
		'singular_name' => __( 'Portfolio', 'TR' ),
		'add_new' => __('Add New', 'TR'),
		'add_new_item' => __('Add New Portfolio', 'TR'),
		'edit_item' => __('Edit Portfolio', 'TR'),
		'new_item' => __('New Portfolio', 'TR'),
		'view_item' => __('View Portfolio', 'TR'),
		'search_items' => __('Search Portfolio', 'TR'),
		'not_found' => __('No portfolio found', 'TR'),
		'not_found_in_trash' => __('No portfolio found in Trash', 'TR'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array('slug'=>'portfolio-item','with_front'=>true),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 57.6,
		'menu_icon' => FUNCTIONS_URI . '/assets/images/icon-portfolio.png',
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
	); 

	register_post_type( 'portfolio' , $args );
	
	register_taxonomy('portfolio-category','portfolio',array(
		'hierarchical' => true, 
		'label' => 'Categories', 
		'singular_label' => 'Category', 
		'rewrite' => true,
		'query_var' => true
	));
}


#
#Prod edit columns for portfolio
#
function prod_edit_columns_portfolio($columns)
{
	$newcolumns = array(
		'cb' => '<input type=\"checkbox\" />',
		'portfolio_thumbnail' => __('Thumbnail',  'TR'),
		'title' => __('Title',  'TR'),
		'type' => __('Type',  'TR'),
		'client' => __('Client',  'TR'),
		'portfolio_categories' => __('Categories',  'TR')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}


#
#Prod custom columns for portfolio
#
function prod_custom_columns_portfolio($column)
{
	
	global $post;
	$type = get_meta_option('portfolio_type');
	$client = get_meta_option('portfolio_client');

	switch ($column)
	{
		case 'portfolio_categories':
		$terms = get_the_terms($post->ID, 'portfolio-category');				
		if (! empty($terms)) {
			foreach($terms as $t)
				$output[] = '<a href="edit.php?post_type=portfolio&portfolio-category='.$t->slug.'">'. esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'portfolio-category', 'display')) . '</a>';
			$output = implode(', ', $output);
		} else {
			$t = get_taxonomy('portfolio-category');
			$output = 'No '.$t->label;
		}
		echo $output;
		break;

		case 'type':
		echo $type;
		break;	

		case 'client':
		echo $client;
		break;	

		case 'portfolio_thumbnail':
		if ( has_post_thumbnail() ) { the_post_thumbnail('admin-thumbnail'); } else { echo __('No featured image',  'TR'); }
		break;	
	}
	
}




#
#Create post type for product
#
function theme_create_post_type_product() 
{
	$labels = array(
		'name' => __( 'Products', 'TR'),
		'singular_name' => __( 'Product', 'TR' ),
		'add_new' => __('Add New', 'TR'),
		'add_new_item' => __('Add New Product', 'TR'),
		'edit_item' => __('Edit Product', 'TR'),
		'new_item' => __('New Product', 'TR'),
		'view_item' => __('View Product', 'TR'),
		'search_items' => __('Search Product', 'TR'),
		'not_found' => __('No product found', 'TR'),
		'not_found_in_trash' => __('No product found in Trash', 'TR'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array('slug'=>'product-item','with_front'=>true),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 57.5,
		'menu_icon' => FUNCTIONS_URI . '/assets/images/icon-product.png',
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
	); 

	register_post_type( 'product' , $args );
	
	register_taxonomy('product-category','product',array(
		'hierarchical' => true, 
		'label' => 'Categories', 
		'singular_label' => 'Category', 
		'rewrite' => true,
		'query_var' => true
	));
}



#
#Prod edit columns for product
#
function prod_edit_columns_product($columns)
{
	$newcolumns = array(
		'cb' => '<input type=\"checkbox\" />',
		'product_thumbnail' => __('Thumbnail',  'TR'),
		'title' => __('Title',  'TR'),
		'price' => __('Price',  'TR'),
		'product_categories' => __('Categories',  'TR')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}



#
#Prod custom columns for product
#
function prod_custom_columns_product($column)
{
	
	global $post;

	$price = get_meta_option('product_price');

	switch ($column)
	{
		case 'product_categories':
		$terms = get_the_terms($post->ID, 'product-category');				
		if (! empty($terms)) {
			foreach($terms as $t)
				$output[] = '<a href="edit.php?post_type=product&product-category='.$t->slug.'">'. esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'product-category', 'display')) . '</a>';
			$output = implode(', ', $output);
		} else {
			$t = get_taxonomy('product-category');
			$output = 'No '.$t->label;
		}
		echo $output;
		break;

		case 'price':
		echo $price;
		break;	

		case 'product_thumbnail':
		if ( has_post_thumbnail() ) { the_post_thumbnail('admin-thumbnail'); } else { echo __('No featured image',  'TR'); }
		break;	
	}
	
}



#
#Create post type for gallery
#
function theme_create_post_type_gallery() 
{
	$labels = array(
		'name' => __( 'Galleries', 'TR'),
		'singular_name' => __( 'Gallery', 'TR' ),
		'add_new' => __('Add New', 'TR'),
		'add_new_item' => __('Add New Gallery', 'TR'),
		'edit_item' => __('Edit Gallery', 'TR'),
		'new_item' => __('New Gallery', 'TR'),
		'view_item' => __('View Gallery', 'TR'),
		'search_items' => __('Search Gallery', 'TR'),
		'not_found' => __('No gallery found', 'TR'),
		'not_found_in_trash' => __('No gallery found in Trash', 'TR'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array('slug'=>'gallery-item','with_front'=>true),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 57.4,
		'menu_icon' => FUNCTIONS_URI . '/assets/images/icon-gallery.png',
		'supports' => array('title', 'editor', 'thumbnail')
	); 

	register_post_type( 'gallery' , $args );
}



#
#Prod edit columns for gallery
#
function prod_edit_columns_gallery($columns)
{
	$newcolumns = array(
		'cb' => '<input type=\"checkbox\" />',
		'gallery_thumbnail' => __('Thumbnail',  'TR'),
		'title' => __('Title',  'TR'),
		'gallery_count' => __('Image Count',  'TR')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}




#
#Prod custom columns for gallery
#
function prod_custom_columns_gallery($column)
{
	switch ($column)
	{
		case 'gallery_thumbnail':
		if ( has_post_thumbnail() ) { the_post_thumbnail('admin-thumbnail'); } else { echo __('No featured image',  'TR'); }
		break;
		
		case 'gallery_count':
		global $post;
		$post_id = $post->ID;

		$args = array(
			'post_parent' => $post_id,
			'post_type' => 'attachment',
			'post_mime_type' => 'image'
		);

		$attachments = get_posts( $args );

		echo count($attachments);
		break;

	}	
}

?>