<?php
add_action('init', 'register_portfolio');

function register_portfolio() {
	$args = array(
		'labels' => array(
			'name' => __( 'Portfolio' ), 
			'singular_name' => __( 'Portfolio' ),
			'add_new' => _x('Add new', 'portfolio'),
			'add_new_item' => __('Add a new item'), 
			'edit_item' => __('Edit item'),
			'new_item' => __('New item'),
			'view_item' => __('View item'),
		  ),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 20,
		'public' => true,
		'rewrite' => true,
		'singular_label' => __('Portfolio'),
		'show_ui' => true,
		'supports' => array(
			'title',
			'thumbnail',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions')
	);

	register_post_type( 'portfolio' , $args );
}

add_action( 'init', 'create_portfolio_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_portfolio_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Galleries', 'taxonomy general name' ),
    'singular_name' => _x( 'Gallery', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Gallery' ),
    'all_items' => __( 'All Galleries' ),
    'parent_item' => __( 'Parent Gallery' ),
    'parent_item_colon' => __( 'Parent Gallery:' ),
    'edit_item' => __( 'Edit Gallery' ), 
    'update_item' => __( 'Update Gallery' ),
    'add_new_item' => __( 'Add New Gallery' ),
    'new_item_name' => __( 'New Gallery Name' ),
    'menu_name' => __( 'Galleries' ),
  ); 	

  register_taxonomy('gallery',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'gallery' ),
  ));

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Image tags', 'taxonomy general name' ),
    'singular_name' => _x( 'Image tag', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Image tags' ),
    'popular_items' => __( 'Popular Image tags' ),
    'all_items' => __( 'All Image tags' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Image tag' ), 
    'update_item' => __( 'Update Image tag' ),
    'add_new_item' => __( 'Add New Image tag' ),
    'new_item_name' => __( 'New Image tag Name' ),
    'separate_items_with_commas' => __( 'Separate image tags with commas. They will be used for filtering portfolio items' ),
    'add_or_remove_items' => __( 'Add or remove image tags' ),
    'choose_from_most_used' => __( 'Choose from the most used image tags' ),
    'menu_name' => __( 'Image tags' ),
  ); 

  register_taxonomy('image_tag','portfolio',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'image_tag' ),
  ));

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Relationships', 'taxonomy general name' ),
    'singular_name' => _x( 'Relationships', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Relationships' ),
    'popular_items' => __( 'Popular Relationships' ),
    'all_items' => __( 'All Relationships' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Relationship' ), 
    'update_item' => __( 'Update Relationship' ),
    'add_new_item' => __( 'Add New Relationship' ),
    'new_item_name' => __( 'New Relationship Name' ),
    'separate_items_with_commas' => __( 'Separate relationship with commas. They will be used for related items box' ),
    'add_or_remove_items' => __( 'Add or remove relationships' ),
    'choose_from_most_used' => __( 'Choose from the most used relationships' ),
    'menu_name' => __( 'Relationships' ),
  ); 

  register_taxonomy('relationship','portfolio',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'relationship' ),
  ));
}

/*=========================================================================================*/

?>