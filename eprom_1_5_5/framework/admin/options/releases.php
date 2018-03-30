<?php

/* Releases Options
 ------------------------------------------------------------------------*/
global $r_option, $releases_cp;

/* Slug */
$releases_slug = 'release';
$releases_genre_slug = 'releases-genre';
$releases_artist_slug = 'releases-artist';
if ( isset( $r_option['releases_slug']) && $r_option['releases_slug'] != '') 
	$releases_slug = $r_option['releases_slug'];
if ( isset( $r_option['releases_genre_slug']) && $r_option['releases_genre_slug'] != '') 
	$releases_genre_slug = $r_option['releases_genre_slug'];
if ( isset( $r_option['releases_artist_slug']) && $r_option['releases_artist_slug'] != '') 
	$releases_artist_slug = $r_option['releases_artist_slug'];

/* Order */
if ( isset( $r_option['releases_order'] ) && $r_option['releases_order'] == 'custom' ) 
	$releases_sortable = true;
else 
	$releases_sortable = false;

/* Class arguments */
$args = array( 
	'post_name' => 'wp_releases', 
	'sortable' => $releases_sortable,
	'admin_path'  => '',
	'admin_uri'	 => '',
	'admin_dir' => '/framework/admin/custom_post',
	'textdomain' => SHORT_NAME
);

/* Post Labels */
$labels = array(
	'name' => _x( 'Releases', 'Admin - Releases', SHORT_NAME ),
	'singular_name' => _x( 'Release', 'Admin - Releases', SHORT_NAME ),
	'add_new' => _x( 'Add New', 'Admin - Releases', SHORT_NAME ),
	'add_new_item' => _x( 'Add New Release', 'Admin - Releases', SHORT_NAME ),
	'edit_item' => _x( 'Edit Release', 'Admin - Releases', SHORT_NAME ),
	'new_item' => _x( 'New Release', 'Admin - Releases', SHORT_NAME ),
	'view_item' => _x( 'View Release', 'Admin - Releases', SHORT_NAME ),
	'search_items' => _x( 'Search Items', 'Admin - Releases', SHORT_NAME ),
	'not_found' =>  _x( 'No releases found', 'Admin - Releases', SHORT_NAME ),
	'not_found_in_trash' => _x( 'No releases found in Trash', 'Admin - Releases', SHORT_NAME ), 
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
		'slug' => $releases_slug,
		'with_front' => true,
	),
	'supports' => array('title', 'editor', 'excerpt', 'comments', 'thumbnail', 'custom-fields'),
	'menu_icon' => 'dashicons-portfolio'
);

/* Add Taxonomy */
register_taxonomy('wp_release_genres', array('wp_releases'), array(
	'hierarchical' => true,
	'label' => _x( 'Releases Genres', 'Admin - Releases', SHORT_NAME ),
	'singular_label' => _x( 'Genre', 'Admin - Releases', SHORT_NAME ),
	'query_var' => true,
	'rewrite' => array('slug' => $releases_genre_slug)
));

/* Add Taxonomy */
register_taxonomy('wp_release_artists', array('wp_releases'), array(
	'hierarchical' => true,
	'label' => _x( 'Releases Artists', 'Admin - Releases', SHORT_NAME ),
	'singular_label' => _x( 'Artist', 'Admin - Releases', SHORT_NAME ),
	'query_var' => true,
	'rewrite' => array('slug' => $releases_artist_slug)
));

/* Add class instance */
$releases_cp = new R_Custom_Post( $args, $options );

/* Remove variables */
unset( $args, $options );


/*-------------------------------------------------------------------------------------*/


/* Column Layout
------------------------------------------------------------------------*/
add_filter( 'manage_edit-wp_releases_columns', 'release_columns' );

function release_columns( $columns ) {
		
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => _x( 'Title', 'Admin - Releases', SHORT_NAME ),
		'release_preview' => _x( 'Preview', 'Admin - Releases', SHORT_NAME ),
		'genres' => _x( 'Genres', 'Admin - Releases', SHORT_NAME ),
		'artists' => _x( 'Artists', 'Admin - Releases', SHORT_NAME ),
		'date' => 'Date'
	);

	return $columns;
}

add_action('manage_posts_custom_column', 'release_display_columns');

function release_display_columns( $column ) {
	global $post, $releases_cp;
	
	switch ( $column ) {
		case 'release_preview':
			$custom = get_post_custom();
			if ( isset( $custom['_release_image'][0] ) && $releases_cp->image_exists( $custom['_release_image'][0] ) )
		        echo '<img src="' . $releases_cp->image_resize('80', '80', $custom['_release_image'][0]) . '" alt="' . esc_attr( get_the_title() ) . '" style="padding:5px"/>';
			break;
		case 'genres' :
			$genres = get_the_terms( $post->ID, 'wp_release_genres' );
			if ($genres) {
				foreach( $genres as $taxonomy ) {
					echo $taxonomy->name . ' ';
				}
			}
		break;
		case 'artists' :
			$artists = get_the_terms( $post->ID, 'wp_release_artists' );
			if ( $artists ) {
				foreach( $artists as $taxonomy ) {
					echo $taxonomy->name . ' ';
				}
			}
		break;
	}
}


/* Column Filters
------------------------------------------------------------------------*/

/* Genres Filter */
add_action('restrict_manage_posts', 'add_genres_filter');

function add_genres_filter() {

	global $typenow, $releases_cp;

	if ($typenow == 'wp_releases') {
		$args = array( 'name' => 'wp_release_genres' );
		$filters = get_taxonomies( $args );
		
		foreach ( $filters as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			
			echo '<select name="' . $tax_slug. '" id="' . $tax_slug . '" class="postform">';
			echo '<option value="">' . _x( 'Show All', 'Admin - Releases', SHORT_NAME ) . '</option>';
			$releases_cp->generate_taxonomy_options( $tax_slug, 0, 0 );
			echo "</select>";
		}
	}
}

/* Add Filter - Request */
add_action('request', 'release_genres');

function release_genres( $request ) {
	if ( is_admin() && isset( $request['post_type'] ) && $request['post_type'] == 'wp_releases' && isset( $request['wp_release_genres'] ) ) {
		
	  	$term = get_term( $request['wp_release_genres'], 'wp_release_genres' );
		if ( isset( $term->name ) && $term) {
			$term = $term->name;
			$request['term'] = $term;
		}
		
	}
	return $request;
}


/* Artists Filter */
add_action('restrict_manage_posts', 'add_releases_artists_filter');

function add_releases_artists_filter() {

	global $typenow, $releases_cp;

	if ( $typenow == 'wp_releases' ) {
		$args = array( 'name' => 'wp_release_artists' );
		$filters = get_taxonomies( $args );
		
		foreach ( $filters as $tax_slug ) {
			$tax_obj = get_taxonomy( $tax_slug );
			$tax_name = $tax_obj->labels->name;
			
			echo '<select name="' . $tax_slug. '" id="' . $tax_slug . '" class="postform">';
			echo '<option value="">' . _x( 'Show All', 'Admin - Releases', SHORT_NAME ) . '</option>';
			$releases_cp->generate_taxonomy_options( $tax_slug, 0, 0 );
			echo "</select>";
		}
	}
}

/* Add Filter - Request */
add_action( 'request', 'release_artists' );

function release_artists( $request ) {
	if ( is_admin() && isset( $request['post_type'] ) && $request['post_type'] == 'wp_releases' && isset( $request['wp_release_artists'] ) ) {
		
	   	$term = get_term( $request['wp_release_artists'], 'wp_release_artists' );
		if ( isset( $term->name ) && $term ) {
			$term = $term->name;
			$request['term'] = $term;
		}
		
	}
	return $request;
}
?>