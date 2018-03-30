<?php
/**
 * Plugin Name: Breadcumbs Plus
 * Plugin URI: http://snippets-tricks.org/proyectos/breadcrumbs-plus-plugin/
 * Description: Breadcrumbs Plus provide links back to each previous page the user navigated through to get to the current page or-in hierarchical site structures-the parent pages of the current one.
 * Version: 0.4
 * Author: Luis Alberto Ochoa Esparza
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
 * @version 0.4
 * @author Luis Alberto Ochoa Esparza <soy@luisalberto.org>
 * @copyright Copyright (c) 2010-2011, Luis Alberto Ochoa
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Poedit is a good tool to for translating.
 * 
 * @link http://poedit.net
 * @since 0.1
 */
//load_plugin_textdomain( 'striking-r', false, 'breadcrumbs-plus/languages' );

/**
 * Shows a breadcrumb for all types of pages.
 *
 * @since 0.1
 * @param array $args
 * @return string
 */
function breadcrumbs_plus( $args = '' ) {

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'prefix' => '<p>',
		'suffix' => '</p>',
		'title' => __( 'You are here: ', 'striking-r' ),
		'home' => __( 'Home', 'striking-r' ),
		'separator' => '&raquo;',
		'front_page' => false,
		'show_blog' => true,
		'singular_post_taxonomy' => 'category',
		'echo' => true
	);

	$args = apply_filters( 'breadcrumbs_plus_args', $args );

	$args = wp_parse_args( $args, $defaults );

	if ( is_front_page() && !$args['front_page'] )
		return apply_filters( 'breadcrumbs_plus', false );

	/* Format the title. */
	$title = ( !empty( $args['title'] ) ? '<span class="breadcrumbs-title">' . $args['title'] . '</span>': '' );

	$separator = ( !empty( $args['separator'] ) ) ? "<span class='separator'>{$args['separator']}</span>" : "<span class='separator'>/</span>";

	/* Get the items. */
	$items = breadcrumbs_plus_get_items( $args );

	
	$breadcrumbs = $args['prefix'];
	$breadcrumbs .= '<div class="breadcrumb breadcrumbs"><div class="breadcrumbs-plus">';
	$breadcrumbs .= $title;

	foreach($items as &$item){
		if ($item != $items['last']) 
		$item = '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">'.$item.'</span>';
	}
	$breadcrumbs .= join( " {$separator} ", $items );
	$breadcrumbs .= '</div></div>';
	$breadcrumbs .= $args['suffix'];

	$breadcrumbs = apply_filters( 'breadcrumbs_plus', $breadcrumbs );

	if ( !$args['echo'] )
		return $breadcrumbs;
	else
		echo $breadcrumbs;
}

/**
 * Gets the items for the breadcrumbs plus.
 *
 * @since 0.4
 */
function breadcrumbs_plus_get_items( $args ) {
	global $wp_query;
	$item = array();

	$show_on_front = get_option( 'show_on_front' );

	/* Front page. */
	if ( is_front_page() ) {
		$item['last'] = $args['home'];
	}

	/* Link to front page. */
	if ( !is_front_page() )
		$item[] = '<a href="'. home_url( '/' ) .'" class="home" itemprop="url"><span itemprop="title">' . $args['home'] . '</span></a>';

	/* If bbPress is installed and we're on a bbPress page. */
	if ( function_exists( 'is_bbpress' ) && is_bbpress() )
		$item = array_merge( $item, breadcrumbs_plus_get_bbpress_items() );

	/* If viewing a home/post page. */
	elseif ( is_home() ) {
		$home_page = get_page( $wp_query->get_queried_object_id() );
		$item = array_merge( $item, breadcrumbs_plus_get_parents( $home_page->post_parent ) );
		$item['last'] = get_the_title( $home_page->ID );
	}

	/* If viewing a singular post. */
	elseif ( is_singular() ) {

		$post = $wp_query->get_queried_object();
		$post_id = (int) $wp_query->get_queried_object_id();
		$post_type = $post->post_type;

		$post_type_object = get_post_type_object( $post_type );

		$page_for_posts = theme_get_option('blog','blog_page');
		$page_for_posts = wpml_get_object_id($page_for_posts, 'page');
		if ( 'post' === $wp_query->post->post_type && $args['show_blog'] && !empty($page_for_posts)) {
			$item[] = '<a href="' . get_permalink( $page_for_posts ) . '" itemprop="url"><span itemprop="title">' . get_the_title( $page_for_posts ) . '</span></a>';
		}
		if ( 'portfolio' === $wp_query->post->post_type ) {
			$parent_page = get_post_meta($post_id, '_breadcrumbs_page', true);
			if (empty($parent_page)){
				$parent_page = theme_get_option('portfolio','breadcrumbs_page');
			}
			$parent_page = wpml_get_object_id($parent_page,'page');

			if(!empty($parent_page)){
				$parents = breadcrumbs_plus_get_parents( $parent_page );
				$item = array_merge( $item, $parents );
			}			
		}elseif ( 'page' !== $wp_query->post->post_type ) {

			/* If there's an archive page, add it. */
			if ( function_exists( 'get_post_type_archive_link' ) && !empty( $post_type_object->has_archive ) )
				$item[] = '<a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '" itemprop="url"><span itemprop="title">' . $post_type_object->labels->name . '</span></a>';

			if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
				$terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
				$item = array_merge( $item, breadcrumbs_plus_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
			}

			elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
				$item[] = get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
		}

		if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = breadcrumbs_plus_get_parents( $wp_query->post->post_parent ) ) {
			$item = array_merge( $item, $parents );
		}

		$item['last'] = get_the_title();
	}

	/* If viewing any type of archive. */
	else if ( is_archive() ) {
		$page_for_posts = theme_get_option('blog','blog_page');
		$page_for_posts = wpml_get_object_id($page_for_posts, 'page');
		if ( is_post_type_archive('post') && $args['show_blog'] && !empty($page_for_posts)) {
			$item[] = '<a href="' . get_permalink( $page_for_posts ) . '" itemprop="url"><span itemprop="title">' . get_the_title( $page_for_posts ) . '</span></a>';
		}
		
		if ( is_category() || is_tag() || is_tax() ) {

			$term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );

			if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = breadcrumbs_plus_get_term_parents( $term->parent, $term->taxonomy ) )
				$item = array_merge( $item, $parents );

			$item['last'] = $term->name;
		}

		else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
			$item['last'] = $post_type_object->labels->name;
		}

		else if ( is_date() ) {
			if(is_numeric(get_query_var('w') && 0 !== get_query_var('w') ))
				$item['last'] =  sprintf( __("Weekly Archive for: '%s'",'striking-r'),get_the_time('W'));
			elseif ( is_day() )
				$item['last'] = sprintf( __("Daily Archive for: '%s'",'striking-r'),get_the_time('F jS, Y'));
			elseif ( is_month() )
				$item['last'] =  sprintf( __("Monthly Archive for: '%s'",'striking-r'),get_the_time('F jS, Y'));
			elseif ( is_year() )
				$item['last'] =  sprintf(__("Yearly Archive for: '%s'",'striking-r'),get_the_time('Y'));
		}

		else if ( is_author() ) {
			$author_obj = $wp_query->get_queried_object();
			$item['last'] =  sprintf(__("Author Archive for: '%s'",'striking-r'),get_the_author_meta( 'display_name', $author_obj->ID ));
		}
	}

	/* If viewing search results. */
	else if ( is_search() )
		$item['last'] =  sprintf(__("Search Results for: '%s'",'striking-r'),stripslashes( strip_tags( get_search_query() ) ));

	/* If viewing a 404 error page. */
	else if ( is_404() )
		$item['last'] = __( 'Page Not Found', 'striking-r' );

	if ( class_exists( 'Tribe__Events__Main' ) ) {
		if ( tribe_is_list_view() || tribe_is_showing_all() || tribe_is_month() || tribe_is_day()) {
			//$item['last'] = wp_title( '', false);
			global $wp_version;
			if ( ! function_exists( '_wp_render_title_tag' ) || version_compare(preg_replace("/[^0-9\.]/","",$wp_version), '4.4', '<')  ) {
				$item['last']  = wp_title( '', false);
			} else 	$item['last']  =  wp_get_document_title(); 
		}
	}

	if(isset($item['last'])) {
			$item['last'] = '<span itemprop="text">'.$item['last'].'</span>';
	}
	
	return apply_filters( 'breadcrumbs_plus_items', $item );
}

/**
 * Gets the items for the breadcrumb item if bbPress is installed.
 *
 * @since 0.4
 *
 * @param array $args Mixed arguments for the menu.
 * @return array List of items to be shown in the item.
 */
function breadcrumbs_plus_get_bbpress_items( $args = array() ) {

	$item = array();

	$post_type_object = get_post_type_object( bbp_get_forum_post_type() );

	if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() )
		$item[] = '<a href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '">' . bbp_get_forum_archive_title() . '</a>';

	if ( bbp_is_forum_archive() )
		$item[] = bbp_get_forum_archive_title();

	elseif ( bbp_is_topic_archive() )
		$item[] = bbp_get_topic_archive_title();

	elseif ( bbp_is_single_view() )
		$item[] = bbp_get_view_title();

	elseif ( bbp_is_single_topic() ) {

		$topic_id = get_queried_object_id();

		$item = array_merge( $item, breadcrumbs_plus_get_parents( bbp_get_topic_forum_id( $topic_id ) ) );

		if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() )
			$item[] = '<a href="' . bbp_get_topic_permalink( $topic_id ) . '" itemprop="url"><span itemprop="title">' . bbp_get_topic_title( $topic_id ) . '</span></a>';
		else
			$item[] = bbp_get_topic_title( $topic_id );

		if ( bbp_is_topic_split() )
			$item[] = __( 'Split', 'striking-r' );

		elseif ( bbp_is_topic_merge() )
			$item[] = __( 'Merge', 'striking-r' );

		elseif ( bbp_is_topic_edit() )
			$item[] = __( 'Edit', 'striking-r' );
	}

	elseif ( bbp_is_single_reply() ) {

		$reply_id = get_queried_object_id();

		$item = array_merge( $item, breadcrumbs_plus_get_parents( bbp_get_reply_topic_id( $reply_id ) ) );

		if ( !bbp_is_reply_edit() ) {
			$item[] = bbp_get_reply_title( $reply_id );

		} else {
			$item[] = '<a href="' . bbp_get_reply_url( $reply_id ) . '" itemprop="url"><span itemprop="title">' . bbp_get_reply_title( $reply_id ) . '</span></a>';
			$item[] = __( 'Edit', 'striking-r' );
		}

	}

	elseif ( bbp_is_single_forum() ) {

		$forum_id = get_queried_object_id();
		if(function_exists('bbp_get_forum_parent')){
			$forum_parent_id = bbp_get_forum_parent( $forum_id );
		} else{
			$forum_parent_id = bbp_get_forum_parent_id( $forum_id );
		}

		if ( 0 !== $forum_parent_id)
			$item = array_merge( $item, breadcrumbs_plus_get_parents( $forum_parent_id ) );

		$item[] = bbp_get_forum_title( $forum_id );
	}

	elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {

		if ( bbp_is_single_user_edit() ) {
			$item[] = '<a href="' . bbp_get_user_profile_url() . '" itemprop="url"><span itemprop="title">' . bbp_get_displayed_user_field( 'display_name' ) . '</span></a>';
			$item[] = __('Edit','striking-r');
		} else {
			$item[] = bbp_get_displayed_user_field( 'display_name' );
		}
	}

	return apply_filters( 'breadcrumbs_plus_get_bbpress_items', $item, $args );
}

/**
 * Gets parent pages of any post type.
 *
 * @since 0.1
 * @param int $post_id ID of the post whose parents we want.
 * @param string $separator.
 * @return string $html String of parent page links.
 */
function breadcrumbs_plus_get_parents( $post_id = '', $separator = '/' ) {

	$parents = array();

	if ( $post_id == 0 )
		return $parents;

	while ( $post_id ) {
		$page = get_page( $post_id );
		$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '" itemprop="url"><span itemprop="title">' . get_the_title( $post_id ) . '</span></a>';
		$post_id = $page->post_parent;
	}

	if ( $parents )
		$parents = array_reverse( $parents );

	return $parents;
}

/**
 * Searches for term parents of hierarchical taxonomies.
 *
 * @since 0.1
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return string $html String of links to parent terms.
 */
function breadcrumbs_plus_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {

	$html = array();
	$parents = array();

	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $parents;

	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '" itemprop="url"><span itemprop="title">' . $parent->name . '</span></a>';
		$parent_id = $parent->parent;
	}

	if ( $parents )
		$parents = array_reverse( $parents );

	return $parents;
}
