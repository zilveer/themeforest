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
 * Replace the "page_for_posts" option with the "post_index_page" theme option
 * 
 * @param 			mixed $value
 * @return			mixed
 */
function btp_page_pre_option_page_for_posts( $value ) {
	$value = btp_theme_get_option_value( 'post_index_page' );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$value = icl_object_id( $value, 'page', true );
  	}
 	
	return $value;
}	
add_filter( 'pre_option_page_for_posts', 'btp_page_pre_option_page_for_posts' );



/**
 * Replace the "page_on_front" option with the "page_home_page" theme option
 * 
 * @param 			mixed $value
 * @return			mixed
 */
function btp_pre_option_page_on_front( $value ) {
	$value = btp_theme_get_option_value( 'page_home_page' );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$value = icl_object_id( $value, 'page', true );
  	}	
	
	return $value;
}
add_filter( 'pre_option_page_on_front', 'btp_pre_option_page_on_front' );



/**
 * Replace the "show_on_front" option with the custom solution.
 * 
 * Determines the "show_on_front" option based on the "post_index_page" and
 * the "page_home_page" theme options.
 * 
 * @param 			mixed $value
 * @return			mixed
 */
function btp_pre_option_show_on_front( $value ) {		
	$page_on_front 	= absint( btp_theme_get_option_value( 'page_home_page' ) );
	$page_for_posts = absint( btp_theme_get_option_value( 'post_index_page' ) );
	
	if ( !$page_on_front ) {
		return 'posts'; 		
	}
	
	if ( $page_on_front === $page_for_posts ) {
		return 'posts';
	}
	
	return 'page';
}
add_filter( 'pre_option_show_on_front', 'btp_pre_option_show_on_front' );



/**
 * Gets pages as an associative array (id => name)
 * 
 * @return array
 */
function btp_page_get_choices() {
	static $result = null;
	
	if( $result !== null ) {
		return $result;
	}
	
	$result = array();
	$pages = wp_dropdown_pages( array(
    	'depth'            => 0,
    	'child_of'         => 0,
    	'selected'         => 0,
    	'echo'             => 0,
    	'name'             => 'page_id',    		 	
	));
	
	$key = null;
	$value = null;
	$pattern = '/value=(\")?[0-9]{1,}(\")?/';
	
	
	$pages = strip_tags( $pages, '<option>' );
	$pages = explode('<option', $pages);
			
	foreach( $pages as $page ) {			
		if ( preg_match($pattern, $page, $key) ) {				
			$key = $key[0];
			$key = intval( preg_replace('/[^0-9]/', '', $key ) );				
		}
		
		$value = strip_tags( '<option'. $page );

		if ( $key ) {
			$result[ $key ] = $value;
		}
	}
	
	return $result;
}



/**
 * Fixes CSS classes in custom navigation menus.
 * 
 * @param array $classes
 * @param object $item
 */
function btp_page_fix_nav_menu_css_class( $classes, $item ) {
	if ( is_404() || is_search() ) {
		/* Remove current_page_parent class from the blog index page */
		if ( get_option( 'page_for_posts' ) == $item->object_id && 'page' == $item->object ) {
			$classes = array_diff( $classes, array( 'current_page_parent') );
		}	
	}
					
	return $classes;
}
add_filter('nav_menu_css_class', 'btp_page_fix_nav_menu_css_class', 10, 2);



/**
 * Returns available elements for page collection.
 * 
 * @param			string $hide Comma-separated list of elements to hide
 * @return			array
 */
function btp_page_get_collection_elements( $hide = '' ) {
	$result = array(
		'title'				=> true,
		'featured_media'	=> true,		
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
 * Returns available templates for page collection (used by shortcodes, widgets).
 * 
 * If you want to add/delete some templates, hook into the btp_page_collection_templates custom filter.
 * 
 * @return			array
 */
function btp_page_get_collection_templates() {
	$templates = array(	
		'one_fourth'						=> 'one-fourth',
		'list_one_sixteenth'				=> 'list-one-sixteenth',
	);	
	
	return apply_filters( 'btp_page_collection_templates', $templates );
}



/**
 * Composes an array of elements on single work page.
 */
function btp_page_get_singular_elements( $elems, $id = null ) {
	$post = get_post( $id );	
	
	if ( 'page' !== get_post_type( $post ) ) {
		return $elems;	
	}
	
	foreach( array( 
				'date', 
				'author', 
				'comments_link', 
				'categories', 
				'tags', 
				'mediabox' ) 
	as $elem ) {
		if ( !isset( $elems[ $elem ] ) ) {
			$elems[ $elem ] = false;
		}
	}		
	
	$list = array(
		'sidebar_1',
		'breadcrumbs',
		'title',
	);

	foreach( $list as $elem ) {
		$value = btp_entry_get_option_value( $post->ID, 'elem_' . $elem );
			
		if ( !empty( $value ) ) {
			$elems[ $elem ] = $value;	
		}
	}
		
	return $elems;
}
add_filter( 'btp_elements_singular', 'btp_page_get_singular_elements', 10, 2 );



/**
 * Composes an array of elements on search results page.
 */
function btp_page_get_search_elements( $elems ) {
	if ( !is_search() ) {
		return $elems;	
	}
		
	$id = absint( btp_theme_get_option_value( 'page_search_page' ) );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$id = icl_object_id( $id, 'page', true );
  	}
	
	if ( $id ) {
		$elems = array_multimerge( $elems, btp_elements_get_singular( $id ) );
	}
		
	return $elems;
}
add_filter( 'btp_elements', 'btp_page_get_search_elements' );



/**
 * Composes an array of elements on error404 results page.
 */
function btp_page_get_error404_elements( $elems ) {
	if ( !is_404() ) {
		return $elems;	
	}
		
	$id = absint( btp_theme_get_option_value( 'page_error404_page' ) );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$id = icl_object_id( $id, 'page', true );
  	}	
	
	if ( $id ) {
		$elems = array_multimerge( $elems, btp_elements_get_singular( $id ) );
	}
		
	return $elems;
}
add_filter( 'btp_elements', 'btp_page_get_error404_elements' );



/*
 * Redirects to the custom 404 page
 */
function btp_page_redirect_error404() {
	if ( !is_404() ) {
		return;
	}	
	
	/* Get the page id of the custom 404 page */
	$id = absint( btp_theme_get_option_value('page_error404_page') );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$id = icl_object_id( $id, 'page', true );
  	}
	
	if ( $id ) {
		$permalink = get_permalink( $id );
		
		/* Prevent redirecting to a broken link */
		if ( !empty( $permalink ) ) {
			wp_redirect( $permalink, 301 );
			exit();
		}	
	}	
    
	return;
}
add_action( 'template_redirect', 'btp_page_redirect_error404' );
?>