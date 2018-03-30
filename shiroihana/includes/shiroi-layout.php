<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/* ==========================================================================
	Determine whether an entry has sidebar
============================================================================= */

if( ! function_exists( 'shiroi_get_sidebar' ) ):

function shiroi_get_sidebar() {

	// Cache result
	static $has_sidebar = null;
	if( ! is_null( $has_sidebar ) ) {
		return $has_sidebar;
	}
	
	if( is_page() ) {

		global $post;
		$meta = wp_parse_args( $post->layout, array(
			'layout'  => 'fullwidth', 
			'sidebar' => ''
		));

		$layout  = $meta['layout'];
		$sidebar = $meta['sidebar'];

	} elseif( is_singular( 'post' ) ) {

		global $post;
		$meta = wp_parse_args( $post->layout, array(
			'layout' => 'inherit', 
			'sidebar' => ''
		));

		if( 'inherit' === $meta['layout'] ) {
			$layout  = Youxi()->option->get( 'blog_single_layout' );
			$sidebar = Youxi()->option->get( 'blog_single_sidebar' );
		} else {
			$layout  = $meta['layout'];
			$sidebar = $meta['sidebar'];
		}

	} else {

		if( is_category() || is_tag() || is_author() || is_date() ) {

			$location = 'archive';

		} elseif( is_search() ) {

			$location = 'search';

		} else {

			$location = 'index';
		}

		$layout  = Youxi()->option->get( 'blog_' . $location . '_layout' );
		$sidebar = Youxi()->option->get( 'blog_' . $location . '_sidebar' );

	}
	
	if( 'left_sidebar' == $layout || 'right_sidebar' == $layout ) {

		if( is_active_sidebar( $sidebar ) ) {

			return ( $has_sidebar = array( 
				'layout'  => preg_replace( '/_sidebar$/', '', $layout ), 
				'sidebar' => $sidebar
			));
		}
	}

	return ( $has_sidebar = false );
}
endif;

/* ==========================================================================
	Available Sidebars excluding the Footer Sidebar
============================================================================= */

if( ! function_exists( 'shiroi_sidebar_choices' ) ): 

function shiroi_sidebar_choices() {
	global $wp_registered_sidebars;
	$sidebars = wp_list_pluck( $wp_registered_sidebars, 'name' );
	foreach( $sidebars as $id => $sidebar ) {
		if( preg_match( '/^footer_widget_area_/', $id ) ) {
			unset( $sidebars[$id] );
		}
	}

	return $sidebars;
}
endif;

/* ==========================================================================
	Available Post Layouts
============================================================================= */

if( ! function_exists( 'shiroi_available_post_layouts' ) ):

function shiroi_available_post_layouts( $layouts ) {
	$layouts['post'] = apply_filters( 'shiroi_available_post_layouts', array( 'default', 'grid', 'masonry' ) );
	return $layouts;
}
endif;
add_filter( 'youxi_templates_layouts', 'shiroi_available_post_layouts' );

/* ==========================================================================
	Post Thumbnail Size
============================================================================= */

if( ! function_exists( 'shiroi_thumbnail_size' ) ):

function shiroi_thumbnail_size() {
	return shiroi_get_sidebar() ? 'shiroi_medium' : 'shiroi_fullwidth';
}
endif;
