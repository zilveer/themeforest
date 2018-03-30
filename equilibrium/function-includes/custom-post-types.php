<?php

/* add custom post types for the portfolio and the slider */
add_action( 'init', 'yy_portfolio_register' );
add_action( 'init', 'yy_slider_register' );
 

function yy_portfolio_register() {
	 
	$labels = array(
		'name' => _x( "Portfolio", "post type general name", 'onioneye' ),
		'singular_name' => _x( "Portfolio Item", "post type singular name", 'onioneye' ),
		'add_new' => _x( "Add New", "portfolio item", 'onioneye' ),
		'add_new_item' => __( "Add New Portfolio Item", 'onioneye' ),
		'edit_item' => __( "Edit Portfolio Item", 'onioneye' ),
		'new_item' => __( "New Portfolio Item", 'onioneye' ),
		'view_item' => __( "View Portfolio Item", 'onioneye' ),
		'search_items' => __( "Search Portfolio", 'onioneye' ),
		'not_found' =>  __( "Nothing found", 'onioneye' ),
		'not_found_in_trash' => __( "Nothing found in Trash", 'onioneye' ),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 25,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	  ); 
 
	register_post_type( 'portfolio' , $args );
	flush_rewrite_rules();
}

function yy_slider_register() {
 
	$labels = array(
		'name' => _x( "Slider", "post type general name", 'onioneye' ),
		'singular_name' => _x( "Slider Item", "post type singular name", 'onioneye' ),
		'add_new' => _x( "Add New", "slider item", 'onioneye' ),
		'add_new_item' => __( "Add New Slider Item", 'onioneye' ),
		'edit_item' => __( "Edit Slider Item", 'onioneye' ),
		'new_item' => __( "New Slider Item", 'onioneye' ),
		'view_item' => __( "View Slider Item", 'onioneye' ),
		'search_items' => __( "Search Slider", 'onioneye' ),
		'not_found' =>  __( "Nothing found", 'onioneye' ),
		'not_found_in_trash' => __( "Nothing found in Trash", 'onioneye' ),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'menu_position' => 20,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	  ); 
 
	register_post_type( 'slider' , $args );
	flush_rewrite_rules();
	
}


register_taxonomy( "portfolio_categories", array( "portfolio" ), array( "hierarchical" => true, "label" => __( "Categories", 'onioneye' ), "singular_label" => __( "Portfolio Category", 'onioneye' ), "rewrite" => true ) );


/* Display the categories on the Portfolio page */
add_action( "manage_posts_custom_column",  "yy_portfolio_custom_columns" );
add_filter( "manage_edit-portfolio_columns", "yy_portfolio_edit_columns" );
 
 
function yy_portfolio_edit_columns( $columns ) {
  
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => __( "Portfolio Title", 'onioneye' ),
    "portfoliocategories" => __( "Categories", 'onioneye' ),
    "date" => __( "Date", 'onioneye' )
  );
 
  return $columns;
  
}


function yy_portfolio_custom_columns( $column ) {
	
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "portfoliocategories":
      echo get_the_term_list( $post->ID, 'portfolio_categories', '', ', ','' );
      break;
  }
  
}

?>