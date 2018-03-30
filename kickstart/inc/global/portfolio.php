<?php
/*	
*	---------------------------------------------------------------------
*	Add custom post type for portfolio
*	--------------------------------------------------------------------- 
*/

 
// Register portfolio post type
add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() {

    $labels = array( 
        'name' => __( 'Portfolio Items', 'mnky-admin' ),
        'singular_name' => __( 'Portfolio Items', 'mnky-admin' ),
        'add_new' => __( 'Add New', 'mnky-admin' ),
        'add_new_item' => __( 'Add New Item', 'mnky-admin' ),
        'edit_item' => __( 'Edit Item', 'mnky-admin' ),
        'new_item' => __( 'New Portfolio Item', 'mnky-admin' ),
        'view_item' => __( 'View Portfolio Item', 'mnky-admin' ),
        'search_items' => __( 'Search in Portfolio', 'mnky-admin' ),
        'not_found' => __( 'No portfolio found', 'mnky-admin' ),
        'not_found_in_trash' => __( 'No Items found in Trash', 'mnky-admin' ),
        'parent_item_colon' => __( 'Parent Portfolio:', 'mnky-admin' ),
        'menu_name' => __( 'Portfolio', 'mnky-admin' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
		'menu_icon' => MNKY_IMAGES . '/wp-portfolio-icon.png',
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug' => 'portfolio-item'),
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

// Register custom taxonomie
add_action( 'init', 'create_portfolio_taxonomies', 0 );

function create_portfolio_taxonomies() 
{
// Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => __( 'Category', 'mnky-admin' ),
    'singular_name' => __( 'Category', 'mnky-admin' ),
    'search_items' =>  __( 'Search Categories', 'mnky-admin' ),
    'all_items' => __( 'All Categories', 'mnky-admin' ),
    'parent_item' => __( 'Parent Category', 'mnky-admin' ),
    'parent_item_colon' => __( 'Parent Category:', 'mnky-admin' ),
    'edit_item' => __( 'Edit Category', 'mnky-admin' ), 
    'update_item' => __( 'Update Category', 'mnky-admin' ),
    'add_new_item' => __( 'Add New Category', 'mnky-admin' ),
    'new_item_name' => __( 'New Category Name', 'mnky-admin' ),
    'menu_name' => __( 'Categories', 'mnky-admin' ),
  ); 	

  register_taxonomy('portfolio_category',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
	'rewrite' => true  
	));  
}

// Custom portfolio column
add_filter('manage_edit-portfolio_columns', 'add_new_portfolio_columns');

function add_new_portfolio_columns($gallery_columns) {
	$new_columns['cb'] = '<input type="checkbox" />';
 
	$new_columns['thumbnail'] = __('Thumbnail', 'mnky-admin' );
	$new_columns['title'] = __('Title', 'mnky-admin');
	$new_columns['author'] = __('Author', 'mnky-admin' );
 
	$new_columns['portfolio_categories'] = __('Categories', 'mnky-admin' );
 
	$new_columns['date'] = __('Date', 'mnky-admin');
	 
	return $new_columns;
}

add_action('manage_portfolio_posts_custom_column', 'manage_portfolio_columns', 10, 2);
 
function manage_portfolio_columns($column_name) {
	global $post;
	switch ($column_name) {
	
	case 'thumbnail':
		echo get_the_post_thumbnail( $post->ID, 'thumbnail' );
	break;
	
	case 'portfolio_categories':
		$terms = wp_get_post_terms($post->ID, 'portfolio_category');  
		foreach ($terms as $term) {  
			echo $term->name .'&nbsp;&nbsp; ';  
		}  
	break;
	
	} // end switch
}	

?>