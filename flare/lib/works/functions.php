<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 *
 * 1.  
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/**
 * Alternates btp_work archive link, so that it points to the Work Index Page.
 * 
 * @param 			string $link
 * @param 			string $post_type
 * @return			string
 */
function btp_work_post_type_archive_link( $link, $post_type ) {
	if ( 'btp_work' != $post_type ) {
		return $link;
	}
	
	$index = absint( btp_theme_get_option_value( 'btp_work_index_page' ) );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$index = absint( icl_object_id( $index, 'page', true ) );
  	}

	if ( $index ) {
		$link = apply_filters('the_permalink', get_permalink( $index ) );
	}
	
	return $link;
}
add_filter( 'post_type_archive_link', 'btp_work_post_type_archive_link', 100, 2);



/**
 * Fix post type archive links in the WPML language switcher
 *  
 * param			array $langs
 * return			$langs 
 */
function btp_work_fix_wpml_language_switcher( $langs ) {
	if ( !function_exists( 'icl_object_id' ) || !is_post_type_archive( 'btp_work' ) ) {
    	return $langs;
  	}
  	
  	$index = absint( btp_theme_get_option_value( 'btp_work_index_page' ) );
	
	foreach( $langs as $code => $def ) {
		/* Translate Work Index Page ID  */
		$translated_index = absint( icl_object_id( $index, 'page', true, $def[ 'language_code' ] ) );
		/* Replace link URL */
		$langs[ $code ][ 'url' ] = apply_filters( 'the_permalink', get_permalink( $translated_index ) );		
	}
	
	return $langs;
}
add_filter( 'icl_ls_languages', 'btp_work_fix_wpml_language_switcher');



/**
 * Alternates btp_work archive title, so that it points to the Work Index Page.
 * 
 * @param 			string $link
 * @param 			string $post_type
 * @return			string
 */
function btp_work_post_type_archive_title( $title, $post_type = '') {
	if( !is_post_type_archive( 'btp_work' ) && 'btp_work' !== $post_type ) {
		return $title;
	}
	
	$index = absint( btp_theme_get_option_value( 'btp_work_index_page' ) );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$index = icl_object_id( $index, 'page', true );
  	}	
  	
	if ( $index ) {
		$title = get_the_title( $index );
	}
	
	return $title;
}
add_filter( 'post_type_archive_title', 'btp_work_post_type_archive_title', 10, 2);



/**
 * Returns available templates for single work page.
 *  
 * If you want to add/delete some templates, hook into the btp_work_single_templates custom filter.
 * 
 * @return			array
 */
function btp_work_get_single_templates() {
	$path = get_template_directory_uri();
	$path = $path . '/lib/works/images';
	
	$templates = array(
		'full'							=> $path.'/single-full.png',
		'two-third-content-left'		=> $path.'/single-two-third-content-left.png',
		'two-third-content-right'		=> $path.'/single-two-third-content-right.png',
		'two-third-sidebar-left'		=> $path.'/single-two-third-sidebar-left.png',	
		'two-third-sidebar-right'		=> $path.'/single-two-third-sidebar-right.png',
	);
	
	return apply_filters( 'btp_work_single_templates', $templates );
}



/**
 * Returns available templates for work collection (used by shortcodes, widgets).
 * 
 * If you want to add/delete some templates, hook into the btp_work_collection_templates custom filter.
 * 
 * @return			array
 */
function btp_work_get_collection_templates() {
	$templates = array(	
		'one_fourth'						=> 'one_fourth',
		'one_third'							=> 'one_third',
		'one_half'							=> 'one_half',
		'list_one_twelfth'					=> 'list_one_twelfth',
		'list_two_third'					=> 'list_two_third',		
	);	
	
	return apply_filters( 'btp_work_collection_templates', $templates );
}
	


/**
 * Returns available templates for work archive.
 * 
 * If you want to add/delete some templates, hook into the btp_work_archive_templates custom filter.
 * 
 * @return			array
 */
function btp_work_get_archive_templates() {
	$path = get_template_directory_uri();
	$path = $path . '/lib/works/images';
	
	$templates = array(
		'1-column'							=> $path.'/archive-1-column.png',			
		'1-column-sidebar-left'				=> $path.'/archive-1-column-sidebar-left.png',			
		'1-column-sidebar-right'			=> $path.'/archive-1-column-sidebar-right.png',
		'2-columns'							=> $path.'/archive-2-columns.png',
		'2-columns-filterable'				=> $path.'/archive-2-columns-filterable.png',	
		'2-columns-sidebar-left'			=> $path.'/archive-2-columns-sidebar-left.png',
		'2-columns-sidebar-right'			=> $path.'/archive-2-columns-sidebar-right.png',
		'3-columns'							=> $path.'/archive-3-columns.png',
		'3-columns-filterable'				=> $path.'/archive-3-columns-filterable.png',
		'3-columns-sidebar-left'			=> $path.'/archive-3-columns-sidebar-left.png',
		'3-columns-sidebar-right'			=> $path.'/archive-3-columns-sidebar-right.png',
		'4-columns'							=> $path.'/archive-4-columns.png',
		'4-columns-filterable'				=> $path.'/archive-4-columns-filterable.png',
		'list-two-third'					=> $path.'/archive-list-two-third.png',
	);
	
	return apply_filters( 'btp_work_archive_templates', $templates );
}



/**
 * Returns available elements for work collection.
 * 
 * @param			string $hide Comma-separated list of elements to hide
 * @return			array
 */
function btp_work_get_collection_elements( $hide = '' ) {
	$result = array(
		'title'				=> true,
		'featured_media'	=> true,
		'date'				=> true,
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
 * Composes an array of visible elements on work index page. 
 */
function btp_work_get_index_elements( $elems ) {
	if ( !is_post_type_archive( 'btp_work' ) || is_date() || is_author() || is_category() || is_tax() || is_tax() ) {
		return $elems;
	}
	
	$new_elems = array(
		'collection'	=> array(),
	);	
	
	$index = absint( btp_theme_get_option_value( 'btp_work_index_page' ) );
	
	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$index = icl_object_id( $index, 'page', true);
  	}
	
	if ( $index ) {
		$new_elems = array_multimerge( $new_elems, btp_elements_get_singular( $index ) );
	}	
	$collection_elems = btp_work_get_collection_elements();
	
	foreach ( $collection_elems as $key => $value ) {
		$new_elems[ 'collection' ][ $key ] = btp_theme_get_option_value('btp_work_index_elem_'.$key );
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
add_filter( 'btp_elements_index', 'btp_work_get_index_elements' );



/**
 * Composes an array of visible elements on work archive pages.
 */
function btp_work_get_archive_elements( $elems ) {
	if ( !is_archive() || 'btp_work' !== get_post_type() ) {
		return $elems;
	}
	
	$new_elems = array(
		'collection'	=> array(),
	);		
	$collection_elems = btp_work_get_collection_elements();	
		
	/* Take defaults into account */
	foreach ( $collection_elems as $key => $value ) {
		$new_elems[ 'collection' ][ $key ] = btp_theme_get_option_value( 'btp_work_archive_elem_' . $key );
	}
	
	$new_sidebar_1 = btp_theme_get_option_value( 'btp_work_archive_elem_sidebar_1');
	$elems['sidebar_1'] =  !empty( $new_sidebar_1 ) ? $new_sidebar_1 : $elems['sidebar_1'];	

	/* Cascade with individual values */
	if ( is_tax( 'btp_work_category' ) || is_tax( 'btp_work_tag' ) ) {
 		$term_slug = get_query_var('term');
 			
 		if ( $term_slug ) {			
			if ( is_tax( 'btp_work_category' ) ) {					 	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_work_category');
			} else {	
		 		$term = get_term_by( 'slug', $term_slug, 'btp_work_tag');
			}	
	 		
 			foreach ( $collection_elems as $key => $value ) {
				$t = btp_term_get_option_value( $term->term_taxonomy_id, 'elem_' . $key );
				if ( strlen($t) ) {
					$new_elems[ 'collection' ][ $key ] = $t;
				}		
			}	
			$new_sidebar_1 = btp_term_get_option_value( $term->term_taxonomy_id, 'elem_sidebar_1' );
			$elems['sidebar_1'] =  !empty( $new_sidebar_1 ) ? $new_sidebar_1 : $elems['sidebar_1'];	
		} 				
	}
	
	
	/* Replace 'none' values with false */	
	foreach( $collection_elems as $key => $value ) {		
		if ( $new_elems[ 'collection' ][ $key ] === 'none' ) {
			$new_elems[ 'collection' ][ $key ] = false;
		}
	}	

	$elems['sidebar_1'] = 'none' === $elems['sidebar_1'] ? false: $elems['sidebar_1'];	
	
	return array_multimerge( $elems, $new_elems );
}
add_filter( 'btp_elements_archive', 'btp_work_get_archive_elements' );


/**
 * Composes an array of elements on single work page.
 */
function btp_work_get_singular_elements( $elems, $id = null ) {
	$post = get_post( $id );	
	
	if ( 'btp_work' !== get_post_type( $post ) ) {
		return $elems;	
	}
	
	if ( !isset( $elems[ 'author' ] ) ) {
		$elems[ 'author' ] = false;
	}	
	if ( !isset( $elems[ 'related_works' ] ) ) {
		$elems[ 'related_works' ] = true;
	}
	
	$list = array(
		'sidebar_1',
		'breadcrumbs',
		'title',	
		'date',
		'comments_link',
		'categories',
		'tags',
		'mediabox',
		'related_works',
	);

	foreach( $list as $elem ) {
		$value = btp_entry_get_option_value( $post->ID, 'elem_' . $elem );
		$value = empty( $value ) ? btp_theme_get_option_value( 'btp_work_single_elem_'.$elem ) : $value;
			
		if ( !empty( $value ) ) {
			$elems[ $elem ] = $value;	
		}
	}
		
	return $elems;
}
add_filter( 'btp_elements_singular', 'btp_work_get_singular_elements', 10, 2 );



/**
 * Alternate main query and change posts_per_page property.
 * 
 * @param 			array $request
 * @return			array
 */
function btp_work_alter_index_query( $query ) {
	if ( !$query->is_main_query() || !is_page() ) {
		return $query;
	}	
	
	/* Work Index Page Configuration */
	$index = absint( btp_theme_get_option_value( 'btp_work_index_page' ) );
	$posts_per_page = absint( btp_theme_get_option_value('btp_work_index_posts_per_page') );

	/* WPML fallback */
	if ( function_exists( 'icl_object_id' ) ) {
    	$index = icl_object_id( $index, 'page', true );
  	}
  	
  	if ( !$index ) {
  		return;
  	}
  	  	
	if ( 
		( $query->get( 'page_id' ) == $index ) 
		||
		( strlen( $query->get('pagename') && $query->get_queried_object_id() == $index ) ) 
	) {		

		/* Compose new query arguments */
        $paged = get_query_var('paged');

        if ( empty( $paged ) ) {
            $paged = get_query_var('page');
        }

		$new_args = array(
			'post_type'		=> 'btp_work',
			'paged'			=> $paged,
		);
		
		/* Adjust the number of items to display */
		if ( $posts_per_page ) {
			$new_args['posts_per_page'] = $posts_per_page;
		}		
		
		/* Reparse the main query */
		$query->parse_query( $new_args );
	}
	
	return $query;
}
add_filter( 'pre_get_posts', 'btp_work_alter_index_query' );



//function btp_work_index_page_rewrite() {
//	global $wp_rewrite;  
//	$rules = array(
//	'page_id=28'	=> 'index.php?post_type=btp_work',
//	
//	);
//	
//    $wp_rewrite->rules = $rules + $wp_rewrite->rules;  
//}
//add_filter( 'generate_rewrite_rules', 'btp_work_index_page_rewrite', 999);




/**
 * Alternate request: change posts_per_page variable
 * 
 * @param 			array $request
 * @return
 */
function btp_work_alter_archive_query( $request ) {
	/* The query isn't run if we don't pass any query vars */	
    $query = new WP_Query();
    $query->parse_query( $request );    
    
    if ( $query->is_post_type_archive( 'btp_work' ) || $query->is_tax( 'btp_work_category' ) || $query->is_tax( 'btp_work_tag' ) ) {
    	if ( $query->is_date() || $query->is_author() || $query->is_category() || $query->is_tag() || $query->is_tax() ) {
	    	/* Defaults for all archive pages */	    
		    $posts_per_page = (int) btp_theme_get_option_value( 'btp_work_archive_posts_per_page' );	
			if ( -1 === $posts_per_page || $posts_per_page > 0 ) {
				$request[ 'posts_per_page' ] = $posts_per_page;
			}
				
			/* Individual value for single term */
			if ( $query->is_tax( 'btp_work_category' ) || $query->is_tax( 'btp_work_tag' ) ) {
				$posts_per_page = (int) btp_term_get_option_value( $query->get_queried_object()->term_taxonomy_id, 'posts_per_page' );
				if ( -1 === $posts_per_page || $posts_per_page > 0 ) {
					$request[ 'posts_per_page' ] = $posts_per_page;
				}	
			}
    	}	
    }	
	
    return $request;	
}
add_filter( 'request', 'btp_work_alter_archive_query' );



/**
 * Fixes CSS classes in custom navigation menus.
 * 
 * @param array $classes
 * @param object $item
 */
function btp_work_fix_nav_menu_css_class( $classes, $item ) {	
	if ( 'btp_work' == get_post_type() ) {		
		/* Remove current_page_parent class from the blog index page */
		if ( get_option( 'page_for_posts' ) == $item->object_id && 'page' == $item->object ) {
			$classes = array_diff( $classes, array( 'current_page_parent') );
		}					
		
		/* Add current_page_parent class to the work index page */
		$index = absint( btp_theme_get_option_value( 'btp_work_index_page' ) );
		
		/* WPML fallback */
	 	if ( function_exists( 'icl_object_id' ) ) {
    		$index = icl_object_id( $index, 'page', true );
  	 	}
 		
		if ( $index == $item->object_id && 'page' == $item->object ) {		
			$classes[] = 'current_page_parent';
		}
	}
					
	return $classes;
}
add_filter('nav_menu_css_class', 'btp_work_fix_nav_menu_css_class', 10, 2);


/**
 * archive_template filter to determine template for work archive.
 * 
 * @param string $template
 */
function btp_work_archive_template($template){
 	if ( is_post_type_archive( 'btp_work' ) || is_tax( 'btp_work_category' ) || is_tax( 'btp_work_tag' ) ) { 		
 		/* Index page */
 		if ( !is_date() && !is_author() && !is_category() && !is_tag() && !is_tax() ) {
 			$templates = array();
		
			$index_template = btp_theme_get_option_value('btp_work_index_template');
			if ( !empty($index_template) )
				$templates[] = "/lib/works/templates/archive-$index_template.php";
				
			$new_template = locate_template($templates);
			
			if ( !empty($new_template) ) {
				add_filter( 'body_class', 'btp_work_archive_body_class' );
				
				return $new_template;	
			}	

		/* Archive page */
 		} else {
 			$templates = array();
 			
 			/* Individual template for single term */
		 	if ( is_tax( 'btp_work_category' ) || is_tax( 'btp_work_tag' ) ) {
				if ( get_query_var('term') ) {					
					if ( is_tax( 'btp_work_category' ) ) {					 	
				 		$term = get_term_by( 'slug', get_query_var('term'), 'btp_work_category');
					} else {	
				 		$term = get_term_by( 'slug', get_query_var('term'), 'btp_work_tag');
					}	
				 		
				 	if ( $term ){
				 		$term_template = btp_term_get_option_value($term->term_taxonomy_id, 'template');
				 		if ( !empty($term_template) ) {	
				 			$templates[] = "/lib/works/templates/archive-$term_template.php";
				 		}	
				 	}
				}
		 	}	

		 	/* Default template for all work archives */
			$archive_template = btp_theme_get_option_value('btp_work_archive_template');
			if ( !empty($archive_template) ) {
				$templates[] = "/lib/works/templates/archive-$archive_template.php";
			}		 
			  
			$new_template = locate_template($templates);
			 
			if ( !empty($new_template) ) {
				add_filter( 'body_class', 'btp_work_archive_body_class' );
				
				return $new_template;	
			}	
 		}	
 	}
 	
 	return $template;
}
add_filter('archive_template', 'btp_work_archive_template');



function btp_work_archive_body_class( $classes ) {
	global $_BTP;	
	$classes[] = 'archive-template';
	
	if ( isset( $_BTP[ 'current_theme_template' ] ) ) {
		$classes[] = sanitize_html_class( str_replace( '.', '-',  $_BTP[ 'current_theme_template' ] ) );
	}	
	
	return $classes;
}



/**
 * Determines template for single work page with single_template filter.
 * 
 * @param 				string $template
 */
function btp_work_single_template($template) {	
	global $post;	
	
	if ( get_post_type() == 'btp_work' ) {
		$templates = array();
		
		
		/* Single work options */
		$temp = btp_entry_get_option_value($post->ID, 'work_template', true);
		$temp = preg_replace('/[^0-9a-zA-Z_-]/', '', $temp);
		
		if( !empty( $temp ) )
			$templates[] = "/lib/works/templates/single-$temp.php";
				
		/* General options */
		$temp = btp_theme_get_option_value('btp_work_single_template');
		$temp = preg_replace('/[^0-9a-zA-Z_-]/', '', $temp);
		
		if ( !empty( $temp ) )
			$templates[] = "/lib/works/templates/single-$temp.php";
			
		$new_template = locate_template($templates);
		 
		if ( !empty( $new_template ) ) {
			add_filter( 'body_class', 'btp_work_single_body_class' );
			
			return $new_template;		
		}	
	}
	
	return $template;
}
add_filter( 'single_template', 'btp_work_single_template' );


function btp_work_single_body_class( $classes ) {
	global $_BTP;	
	$classes[] = 'single-template';
	
	if ( isset( $_BTP[ 'current_theme_template' ] ) ) {
		$classes[] = sanitize_html_class( str_replace( '.', '-',  $_BTP[ 'current_theme_template' ] ) );
	}	
	
	return $classes;
}



/* Customize appearance of work listing page (admin panel). 
 * Add/remove some columns */
function btp_work_edit_columns($columns){		
	$columns['btp_work_categories'] 	= __('Work Categories', 'btp_theme');
	$columns['btp_work_tags'] 			= __('Work Tags', 'btp_theme');
	$columns['btp_work_featured_image'] = __('Featured Image', 'btp_theme');
	
	
	return $columns;
}
add_filter('manage_btp_work_posts_columns', 'btp_work_edit_columns');
 
/* Customize appearance of work listing page (admin panel). 
 * Render columns */
function btp_work_columns_display($column_name){
	global $post;
	
	switch ( $column_name ) {
		case 'btp_work_categories':
			echo get_the_term_list( $post->ID, 'btp_work_category', '<p>', ',', '</p>' );
			break;
						
		case 'btp_work_tags':
			echo get_the_term_list( $post->ID, 'btp_work_tag', '<p>', ',', '</p>' );
			break;	
		
		case 'btp_work_featured_image':			
			the_post_thumbnail( 'thumbnail' );
			break;
									
		default:	
			return;
			break;	
	}
}
add_action('manage_posts_custom_column',  'btp_work_columns_display');



/**
 * A little filter to extend wp_get_archives() with custom post type
 * 
 * @since			1.0.1
 * @param 			string $where
 * @param 			array $r
 * @return			string
 */
function btp_work_get_archives_where_filter( $where , $r ) {  
  return str_replace( "post_type = 'post'" , "post_type = 'btp_work'" , $where );
}
?>