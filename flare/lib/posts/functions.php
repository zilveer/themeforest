<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code. *
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/**
 * Alternate main query and change posts_per_page property.
 * 
 * @param 			array $request
 * @return			array
 */
function btp_post_alter_index_query( $request ) {
	$posts_per_page = (int) btp_theme_get_option_value( 'post_index_posts_per_page' );
	
	/* The query isn't run if we don't pass any query vars */
    $query = new WP_Query(); 
    $query->parse_query( $request );
	
	/* Change request from page to post type archive */
	if ( $query->is_home() ) {
    	/* Change posts_per_page */
    	if( !is_feed() ) {
			if ( -1 === $posts_per_page  || $posts_per_page > 0 ) {
				$request[ 'posts_per_page' ] = $posts_per_page;
			}
    	}	
	}
	
    return $request;	
}
add_filter( 'request', 'btp_post_alter_index_query' );



function btp_pre_option_posts_per_page( $value ) {		
	$posts_per_page	= absint( btp_theme_get_option_value( 'post_archive_posts_per_page' ) );
	
	if ( -1 === $posts_per_page || $posts_per_page > 0 ) {
		return $posts_per_page;
	} else {
		return $value;
	}	
}
add_filter( 'pre_option_posts_per_page', 'btp_pre_option_posts_per_page' );


	
/**
 * Returns available templates for post collection (used by shortcodes, widgets).
 * 
 * If you want to add/delete some templates, hook into the btp_post_collection_templates custom filter.
 * 
 * @return			array
 */
function btp_post_get_collection_templates() {
	$templates = array(
		'list_one_twelfth'	=> 'list_one_twelfth',
		'one_fourth'			=> 'one_fourth',
	);	
	
	return apply_filters( 'btp_post_collection_templates', $templates );
}
	

/**
 * Returns available templates for post archive.
 *
 * If you want to add/delete some templates, hook into the btp_post_archive_templates custom filter.
 * 
 * @return			array
 */
function btp_post_get_archive_templates() {
	$path = get_template_directory_uri();
	$path = $path . '/lib/works/images';
	
	$templates = array(
		'1-column-sidebar-left'		=> $path.'/archive-1-column-sidebar-left.png',	
		'1-column-sidebar-right'	=> $path.'/archive-1-column-sidebar-right.png',
	);
	
	return apply_filters( 'btp_post_archive_templates', $templates );
}



/**
 * Returns available templates for single post page. 
 * 
 * If you want to add/delete some templates, hook into the btp_post_single_templates custom filter.
 * 
 *  @return			array
 */
function btp_post_get_single_templates() {
	$path = get_template_directory_uri();
	$path = $path . '/lib/works/images';
	
	$templates = array(
        'full'						=> $path.'/single-full.png',
		'two-third-sidebar-left'	=> $path.'/single-two-third-sidebar-left.png',
		'two-third-sidebar-right'	=> $path.'/single-two-third-sidebar-right.png',
	);
	
	return apply_filters( 'btp_post_single_templates', $templates );
}



/**
 * Filter to determine template for post index.
 * 
 * @param string $template
 */
function btp_post_index_template($template){
	$taxonomy_slug = get_query_var('taxonomy'); 

 	if ( is_home() ) { 		
 		$templates = array();
 	
		/*$term_slug = get_query_var('term');
		 
		if($term_slug) {
			
			if($taxonomy_slug == 'btp_product_category')					 	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_product_category');
		 	else	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_product_tag');

		 	if( $term ){
		 		$term_template = btp_get_tt_option($term->term_taxonomy_id, 'template');
		 		if ( !empty($term_template) )	
		 			$templates[] = "works-$term_template.php";
		 	}
		}*/
		 	
		$archive_template = btp_theme_get_option_value('post_index_template');
		if ( !empty($archive_template) )
			$templates[] = "/lib/posts/templates/archive-$archive_template.php";	 
		  
		$new_template = locate_template($templates);
		 
		if ( !empty($new_template) ) {
			add_filter( 'body_class', 'btp_post_archive_body_class' );
			
			return $new_template;	
		}	
 	}
 	
 	return $template;
}
add_filter('home_template', 'btp_post_index_template');



function btp_post_archive_body_class( $classes ) {
	global $_BTP;	
	$classes[] = 'archive-template';
	
	if ( isset( $_BTP[ 'current_theme_template' ] ) ) {
		$classes[] = sanitize_html_class( str_replace( '.', '-',  $_BTP[ 'current_theme_template' ] ) );
	}	
	
	return $classes;
}



/**
 * Filter to determine template for post archive.
 * 
 * @param string $template
 */
function btp_post_archive_template($template){	
	if( 'post' == get_post_type() && is_archive() ) {
		if ( !strlen( $template )  ) {
			$templates = array();	
		
		 	$archive_template = btp_theme_get_option_value('post_archive_template');
			if ( !empty($archive_template) )
				$templates[] = "/lib/posts/templates/archive-$archive_template.php";	 
			  
			$new_template = locate_template($templates);
		 		
		 	if ( strlen( $new_template ) )
				return $new_template;
		}
	}		
 	
 	return $template;
}

add_filter('category_template', 'btp_post_archive_template');
add_filter('tag_template', 'btp_post_archive_template');
add_filter('author_template', 'btp_post_archive_template');
add_filter('date_template', 'btp_post_archive_template');


/**
 * Determines template for single post page with single_template filter.
 * 
 * @param string $template
 */
function btp_post_single_template($template) {
	global $post;
	
	if ( get_post_type() == 'post' ) {
		$templates = array();
		
		/* Single post options */
		$temp = btp_entry_get_option_value( $post->ID, 'post_template', true );
		if( !empty( $temp ) )
			$templates[] = "/lib/posts/templates/single-$temp.php";
			
		/* General options */
		$temp = btp_theme_get_option_value('post_single_template');
		if ( !empty( $temp ) )
			$templates[] = "/lib/posts/templates/single-$temp.php";
			
		$new_template = locate_template($templates);		
		if ( !empty( $new_template ) ) {
			add_filter( 'body_class', 'btp_post_single_body_class' );
			
			return $new_template;
		}			
	}
	
	return $template;
}
add_filter('single_template', 'btp_post_single_template');



function btp_post_single_body_class( $classes ) {
	global $_BTP;	
	$classes[] = 'single-template';
	
	if ( isset( $_BTP[ 'current_theme_template' ] ) ) {
		$classes[] = sanitize_html_class( str_replace( '.', '-',  $_BTP[ 'current_theme_template' ] ) );
	}	
	
	return $classes;
}



/**
 * Returns available elements for post collection.
 * 
 * @param			string $hide Comma-separated list of elements to hide
 * @return			array
 */
function btp_post_get_collection_elements( $hide = '' ) {
	$result = array(
		'title'				=> true,
		'featured_media'	=> true,
		'date'				=> true,
		'author'			=> true,
		'comments_link'		=> true,
		'categories'		=> true,
		'tags'				=> true,
		'summary'			=> true,
		'button_1'			=> true,
	);
	
	$hide = preg_replace( '/[^0-9a-zA-Z,_-]/', '', $hide );
	if ( strlen( $hide ) ) {		
		$bools = explode( ',', $hide );			
		foreach ( $bools as $value ) {
			$result [$value ] = false; 
		}
	}

	return $result;
}



/**
 * Composes an array of visible elements on blog index page. 
 */
function btp_post_get_index_elements( $elems ) {
	if ( !is_home() ) {
		return $elems;
	}
	
	$new_elems = array(
		'collection'	=> array(),
	);	
	
	$index = absint( btp_theme_get_option_value( 'post_index_page' ) );
	if ( $index ) {
		$new_elems = array_multimerge( $new_elems, btp_elements_get_singular( $index ) );
	}	
	$collection_elems = btp_post_get_collection_elements();
	
	foreach ( $collection_elems as $key => $value ) {
		$new_elems[ 'collection' ][ $key ] = btp_theme_get_option_value( 'post_index_elem_'.$key );
	}
		
	/* Replace 'none' values with false */
	if ( count( $new_elems[ 'collection' ] ) ) {
		foreach( $collection_elems as $key => $value ) {
			if ( $new_elems[ 'collection' ][ $key ] === 'none' ) {
				$new_elems[ 'collection' ][ $key ] = false;
			}
		}
	}
		
	return array_multimerge( $elems, $new_elems );
}
add_filter( 'btp_elements_index', 'btp_post_get_index_elements' );



/**
 * Composes an array of visible elements on post archive pages.
 */
function btp_post_get_archive_elements( $elems ) {
	if ( !is_archive() || 'post' !== get_post_type() ) {
		return $elems;
	}
	
	$new_elems = array(
		'collection'	=> array(),
	);		
	$collection_elems = btp_post_get_collection_elements();	
		
	/* Take defaults into account */
	foreach ( $collection_elems as $key => $value ) {
		$new_elems[ 'collection' ][ $key ] = btp_theme_get_option_value( 'post_archive_elem_' . $key );
	}

    $new_sidebar_1 = btp_theme_get_option_value( 'post_archive_elem_sidebar_1');
    $elems['sidebar_1'] =  !empty( $new_sidebar_1 ) ? $new_sidebar_1 : $elems['sidebar_1'];

	/* Replace 'none' values with false */
	foreach( $collection_elems as $key => $value ) {		
		if ( $new_elems[ 'collection' ][ $key ] === 'none' ) {
			$new_elems[ 'collection' ][ $key ] = false;
		}
	}

    $elems['sidebar_1'] = 'none' === $elems['sidebar_1'] ? false: $elems['sidebar_1'];

	return array_multimerge( $elems, $new_elems );
}

add_filter( 'btp_elements_archive', 'btp_post_get_archive_elements' );

/**
 * Composes an array of elements on single post page.
 */
function btp_post_get_singular_elements( $elems, $id = null ) {
	$post = get_post( $id );	
	
	if ( 'post' !== get_post_type( $post ) ) {
		return $elems;	
	}
		
	if ( !isset( $elems[ 'related_posts' ] ) ) {
		$elems[ 'related_posts' ] = true;
	}
	
	$list = array(
		'sidebar_1',
		'breadcrumbs',
		'title',	
		'date',
		'author',
		'comments_link',
		'categories',
		'tags',
		'mediabox',
		'about_author',
		'related_posts',
	);

	foreach( $list as $elem ) {
		$value = btp_entry_get_option_value( $post->ID, 'elem_' . $elem );
		$value = empty( $value ) ? btp_theme_get_option_value( 'post_single_elem_'.$elem ) : $value;
			
		if ( !empty( $value ) ) {
			$elems[ $elem ] = $value;	
		}
	}
		
	return $elems;
}
add_filter( 'btp_elements_singular', 'btp_post_get_singular_elements', 10, 2 );
?>