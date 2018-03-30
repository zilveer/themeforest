<?php
/**
 * Plugin Name: Breadcumbs Plus
 * Plugin URI: http://snippets-tricks.org/proyectos/breadcrumbs-plus-plugin/
 * Description: Breadcrumbs Plus provide links back to each previous page the user navigated through to get to the current page or-in hierarchical site structures-the parent pages of the current one.
 * Version: 0.3
 * Author: Luis Alberto Ochoa
 * Author URI: http://luisalberto.org
 * License: GPL2
 * 
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 * 
 * @package Breadcrumbs Plus
 * @version 0.3
 * @author Luis Alberto Ochoa <soy@luisalberto.org>
 * @copyright Copyright (c) 2010, Luis Alberto Ochoa
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Poedit is a good tool to for translating.
 * 
 * @link http://poedit.net
 * @since 0.1
 */
//load_plugin_textdomain( 'breadcrumbs-plus', false, 'breadcrumbs-plus/languages' );

/**
 * Shows a breadcrumb for all types of pages.
 *
 * @since 0.1
 * @param array $args
 * @return string
 */
function breadcrumbs_plus( $args = '' ) {
	global $wp_query;
	
	$breadcrumb_delimiter = mysite_get_setting( 'breadcrumb_delimiter' );
	$delimiter = ( !empty( $breadcrumb_delimiter ) ) ? html_entity_decode(htmlentities( $breadcrumb_delimiter )) : '&raquo';

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'prefix' => '',
		'suffix' => '',
		'title' => '',
		'home' => __( 'Home', MYSITE_TEXTDOMAIN ),
		'sep' => $delimiter,
		'front_page' => false,
		'bold' => true,
		'show_blog' => true,
		'singular_post_taxonomy' => null,
		'echo' => false
	);

	$args = apply_filters( 'breadcrumbs_plus_args', $args );

	$args = wp_parse_args( $args, $defaults );

	if ( is_front_page() && !$args['front_page'] )
		return apply_filters( 'breadcrumbs_plus', false );

	/* Format the title. */
	$html = ( !empty( $args['title'] ) ? '<span class="breadcrumbs-title">' . $args['title'] . '</span>': '' );

	/* Format the separator. */
	$separator = ( !empty( $args['sep'] ) ? ' <span class="delimiter">' . $args['sep'] . '</span> ' : ' <span class="delimiter">/</span> ' );

	$show_on_front = get_option('show_on_front');

	$home = '<a href="'. home_url( '/' ) .'" rel="home" class="home_breadcrumb">' . $args['home'] . '</a>';

	if ( 'page' == $show_on_front && $args['show_blog'] )
		$bloglink = $home . $separator . '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a>';

	else
		$bloglink = $home;
	
	if ( is_front_page() )
		$html .= _bold_( $home, $args['bold'] );
	
	elseif ( is_home() )
		$html .= $home . $separator . _bold_( get_the_title( get_option( 'page_for_posts' ) ), $args['bold'] );
	
	/* If viewing a portfolio post. */	
	elseif( is_singular( 'portfolio' ) ) {
		
		$html .= $home . $separator;
		
		$gallery_name = get_query_var( 'gallery' );
		
		if( !empty( $gallery_name ) ) {
			global $wpdb;
			$gallery_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_name = '" . $gallery_name . "'" );
			$html .= '<a href="' . get_permalink( $gallery_id ) . '" title="' . esc_attr( get_the_title( $gallery_id ) ) . '">' . get_the_title( $gallery_id ) . '</a>' . $separator;
		}
		
		$html .= _bold_( get_the_title(), $args['bold'] );
	}
	
	/* Added to refect mysite_blog_page() */
	elseif ( is_singular( 'post' ) ) {
		$html .= $bloglink . $separator;
		
		$blog_page = mysite_blog_page();
		if( is_numeric( $blog_page ) )
			$html .= '<a href="' . get_permalink( $blog_page ) . '" title="' . esc_attr( get_the_title( $blog_page ) ) . '">' . get_the_title( $blog_page ) . '</a>' . $separator;
		
		$html .= _bold_( get_the_title(), $args['bold'] );
	}

	/* If viewing a singular post. */
	elseif ( is_singular() ) {
		$post_id = (int) $wp_query->get_queried_object_id();

		if ( 'page' === $wp_query->post->post_type )
			$html .= $home . $separator;

		elseif ( 'page' !== $wp_query->post->post_type ) {
			$html .= $bloglink . $separator;

			if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
				$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
				$html .= breadcrumbs_plus_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"], $separator ) . $separator;
			}

			elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
				$html .= get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' ) . $separator;
		}

		if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = breadcrumbs_plus_get_parents( $wp_query->post->post_parent, $separator ) )
			$html .= $parents . $separator;

		$html .= _bold_( get_the_title(), $args['bold'] );
	}

	/* If viewing any type of archive. */
	elseif ( is_archive() ) {

		$html .= $bloglink . $separator;

		if ( is_category() || is_tag() || is_tax() ) {

			$term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );

			if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = breadcrumbs_plus_get_term_parents( $term->parent, $term->taxonomy, $separator ) )
				$html .= $parents . $separator;

			$html .= _bold_( $term->name, $args['bold'] );
		}

		elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
			$html .= _bold_( $post_type_object->labels->name, $args['bold'] );
		}

		elseif ( is_date() ) {

			if ( is_day() )
				$html .= _bold_( __( 'Archives for ', MYSITE_TEXTDOMAIN ) . get_the_time( 'F j, Y' ), $args['bold'] );
			
			elseif ( is_month() )
				$html .= _bold_( __( 'Archives for ', MYSITE_TEXTDOMAIN ) . single_month_title( ' ', false ), $args['bold'] );
					
			elseif ( is_year() )
				$html .= _bold_( __( 'Archives for ', MYSITE_TEXTDOMAIN ) . get_the_time( 'Y' ), $args['bold'] );
		}

		elseif ( is_author() )
			$html .= _bold_( __( 'Archives by: ', MYSITE_TEXTDOMAIN ) . get_the_author_meta( 'display_name', $wp_query->post->post_author ), $args['bold'] );
	}

	/* If viewing search results. */
	elseif ( is_search() )
		$html .= $home . $separator . _bold_( __( 'Search results for "', MYSITE_TEXTDOMAIN ) . stripslashes( strip_tags( get_search_query() ) ) . '"', $args['bold'] );

	/* If viewing a 404 error page. */
	elseif ( is_404() )
		$html .= $home . $separator . _bold_( __( 'Page Not Found', MYSITE_TEXTDOMAIN ), $args['bold'] );

	//$breadcrumbs = '<div class="breadcrumb breadcrumbs"><div class="breadcrumbs-plus">';
	$breadcrumbs = $args['prefix'];
	$breadcrumbs .= $html;
	$breadcrumbs .= $args['suffix'];
	//$breadcrumbs .= '</div></div>';

	$breadcrumbs = apply_filters( 'breadcrumbs_plus', $breadcrumbs );

	if ( !$args['echo'] )
		return $breadcrumbs;

	echo $breadcrumbs;
}

/**
 * Gets parent pages of any post type.
 *
 * @since 0.3
 * @param int $post_id ID of the post whose parents we want.
 * @param string $separator.
 * @return string $html String of parent page links.
 */
function breadcrumbs_plus_get_parents( $post_id = '', $separator = '/' ) {

	$html = array();

	if ( $post_id == 0 )
		return;

	while ( $post_id ) {
		$page = get_page( $post_id );
		$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
		$post_id = $page->post_parent;
	}

	if ( $parents )
		$html = array_reverse( $parents );

	return join( $separator, $html );
}

/**
 * Searches for term parents of hierarchical taxonomies.
 *
 * @since 0.3
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return string $html String of links to parent terms.
 */
function breadcrumbs_plus_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {

	$html = array();
	$parents = array();

	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return;

	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';
		$parent_id = $parent->parent;
	}

	if ( $parents )
		$html = array_reverse( $parents );

	return join( $separator, $html );
}

/**
 * Return a Input with <strong> tag.
 *
 * @since 0.1
 * @return string
 */
function _bold_( $input, $bold ) {
	if ( $bold )
		return '<span class="current_breadcrumb">'. $input . '</span>';

	return $input;
}

?>