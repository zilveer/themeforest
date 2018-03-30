<?php

/* Artists Options
 ------------------------------------------------------------------------*/
global $r_option, $artists_cp;

/* Slug */
$artists_slug = 'artists';
$artists_cat_slug = 'artists-genres';
$artists_group_slug = 'artists-category';
if ( isset( $r_option['artists_slug'] ) && $r_option['artists_slug'] != '' ) $artists_slug = $r_option['artists_slug'];
if ( isset( $r_option['artists_cat_slug'] ) && $r_option['artists_cat_slug'] != '' ) $artists_cat_slug = $r_option['artists_cat_slug'];
if ( isset( $r_option['artists_group_slug'] ) && $r_option['artists_group_slug'] != '' ) $artists_group_slug = $r_option['artists_group_slug'];


/* Class arguments */
$args = array( 
	'post_name' => 'wp_artists', 
	'sortable' => true,
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/custom_post',
	'textdomain' => SHORT_NAME
);


/* Post Labels */
$labels = array(
	'name' => _x( 'Artists', 'Artists', SHORT_NAME ),
	'singular_name' => _x( 'Artists', 'Artists', SHORT_NAME ),
	'add_new' => _x( 'Add New Artist', 'Artists', SHORT_NAME ),
	'add_new_item' => _x( 'Add New Artist', 'Artists', SHORT_NAME ),
	'edit_item' => _x( 'Edit Artist', 'Artists', SHORT_NAME ),
	'new_item' => _x( 'New Artist', 'Artists', SHORT_NAME ),
	'view_item' => _x( 'View Artist', 'Artists', SHORT_NAME ),
	'search_items' => _x( 'Search Items', 'Artists', SHORT_NAME ),
	'not_found' =>  _x( 'No artists found', 'Artists', SHORT_NAME ),
	'not_found_in_trash' => _x( 'No artists found in Trash', 'Artists', SHORT_NAME ), 
	'parent_item_colon' => ''
);

/* Post Options */
$options = array(
	'labels' => $labels,
	'public' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'rewrite' => array(
		'slug' => $artists_slug,
		'with_front' => true,
	),
	'supports' => array('title', 'editor', 'excerpt', 'comments', 'custom-fields', 'thumbnail'),
	'menu_icon' => 'dashicons-groups'
);

/* Add Taxonomy */
register_taxonomy('wp_artists_genres', array('wp_artists'), array(
	'hierarchical' => true,
	'label' => _x( 'Artists Genres', 'Artists', SHORT_NAME ),
	'singular_label' => _x( 'Genre', 'Artists', SHORT_NAME ),
	'query_var' => true,
	'rewrite' => array('slug' => $artists_cat_slug)
));

/* Add Taxonomy */
register_taxonomy('wp_artists_categories', array('wp_artists'), array(
	'hierarchical' => true,
	'label' => _x( 'Artists Categories', 'Artists', SHORT_NAME ),
	'singular_label' => _x( 'Category', 'Artists', SHORT_NAME ),
	'query_var' => true,
	'rewrite' => array('slug' => $artists_group_slug)
));


/* Add class instance */
$artists_cp = new R_Custom_Post( $args, $options );

/* Remove variables */
unset( $args, $options );


/*-------------------------------------------------------------------------------------*/


/* Column Layout
------------------------------------------------------------------------*/
add_filter('manage_edit-wp_artists_columns', 'artists_columns');

function artists_columns( $columns ) {
	
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => _x( 'Title', 'Artists', SHORT_NAME ),
		'artists_preview' => _x( 'Preview', 'Artists', SHORT_NAME ),
		'artists_genres' => _x( 'Genres', 'Artists', SHORT_NAME ),
		'artists_categories' => _x( 'Categories', 'Artists', SHORT_NAME ),
		'date' => 'Date'
	);

	return $columns;
}

add_action( 'manage_posts_custom_column', 'artists_display_columns' );

function artists_display_columns( $column ) {
	global $post, $artists_cp;
	
	switch ( $column ) {
		case 'artists_preview':
			$custom = get_post_custom();
			if ( isset( $custom['_artist_image'][0] ) && $artists_cp->image_exists( $custom['_artist_image'][0] ) )
		        echo '<img src="' . $artists_cp->image_resize('60', '60', $custom['_artist_image'][0]) . '" alt="' . esc_attr( get_the_title() ) . '" style="padding:5px"/>';
			break;
		case 'artists_genres' :
				$genres = get_the_terms( $post->ID, 'wp_artists_genres' );
				if ( $genres ) {
					foreach( $genres as $genre ) {
						echo $genre->name . ' ';
					}
				}
			break;
		case 'artists_categories' :
				$categories = get_the_terms( $post->ID, 'wp_artists_categories' );
				if ( $categories ) {
					foreach( $categories as $category ) {
						echo $category->name . ' ';
					}
				}
			break;
	}
}


/* Column Filter
------------------------------------------------------------------------*/

/* Genres filter */
add_action( 'restrict_manage_posts', 'add_artists_genres_filter' );

function add_artists_genres_filter() {

	global $typenow, $artists_cp;

	if ( $typenow == 'wp_artists' ) {
		$args = array( 'name' => 'wp_artists_genres' );

		$filters = get_taxonomies( $args );
		
		foreach ( $filters as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			
			echo '<select name="' . $tax_slug. '" id="' . $tax_slug . '" class="postform">';
			echo '<option value="">' . _x( 'Show All', 'Artists', SHORT_NAME ) . '</option>';
			$artists_cp->generate_taxonomy_options( $tax_slug, 0, 0 );
			echo "</select>";
		}
	}
}

/* Add Filter - Request */
add_action('request', 'artists_genres_request');

function artists_genres_request( $request ) {
	if ( is_admin() && isset( $request['post_type'] ) && $request['post_type'] == 'wp_artists' && isset( $request['wp_artists_genres'] ) ) {
		
	   	$term = get_term( $request['wp_artists_genres'], 'wp_artists_genres' );
		if ( isset( $term->name ) && $term ) {
			$term = $term->name;
			$request['term'] = $term;
		}
	}
	return $request;
}


/* Categories filter */
add_action( 'restrict_manage_posts', 'add_artists_cat_filter' );

function add_artists_cat_filter() {

	global $typenow, $artists_cp;

	if ( $typenow == 'wp_artists' ) {
		$args = array( 'name' => 'wp_artists_categories' );

		$filters = get_taxonomies( $args );
		
		foreach ( $filters as $tax_slug ) {
			// retrieve the taxonomy object
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			
			// output html for taxonomy dropdown filter
			echo '<select name="' . $tax_slug. '" id="' . $tax_slug . '" class="postform">';
			echo '<option value="">' . _x( 'Show All', 'Artists', SHORT_NAME ) . '</option>';
			$artists_cp->generate_taxonomy_options( $tax_slug, 0, 0 );
			echo "</select>";
		}
	}
}

/* Add Filter - Request */
add_action( 'request', 'artists_cat_request' );

function artists_cat_request( $request ) {
	if (is_admin() && isset( $request['post_type'] ) && $request['post_type'] == 'wp_artists' && isset( $request['wp_artists_categories'] ) ) {
		
	   	$term = get_term( $request['wp_artists_categories'], 'wp_artists_categories' );
		if ( isset( $term->name ) && $term ) {
			$term = $term->name;
			$request['term'] = $term;
		}
		
	}
	return $request;
}

?>