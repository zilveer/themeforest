<?php

function swm_breadcrumb_trail( $args = array() ) {

	/* Get the textdomain. */
	$textdomain = swm_breadcrumb_trail_textdomain();

	/* Create an empty variable for the breadcrumb. */
	$breadcrumb = '';

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'separator' => '<i class="fa fa-angle-right"></i>',
		'before' => '',
		'after' => false,
		'front_page' => true,
		'show_home' => __('Home','swmtranslate'),
		'echo' => true
	);	

	/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
	if ( is_singular() ) {
		$post = get_queried_object();
		$defaults["singular_{$post->post_type}_taxonomy"] = false;
	}

	/* Apply filters to the arguments. */
	$args = apply_filters( 'breadcrumb_trail_args', $args );

	/* Parse the arguments and extract them for easy variable naming. */
	$args = wp_parse_args( $args, $defaults );

	/* Get the trail items. */
	$trail = swm_breadcrumb_trail_get_items( $args );

	/* Connect the breadcrumb trail if there are items in the trail. */
	if ( !empty( $trail ) && is_array( $trail ) ) {

		/* Open the breadcrumb trail containers. */
		$breadcrumb = '<div class="swm_breadcrumbs">';

		/* If $before was set, wrap it in a container. */
		$breadcrumb .= ( !empty( $args['before'] ) ? '<span class="trail-before">' . $args['before'] . '</span> ' : '' );

		/* Wrap the $trail['trail_end'] value in a container. */
		$format = get_post_format();
		$title_char_length = 250;

		if ( $format == 'quote') {
			$title_char_length = 50;
		}

		if ( !empty( $trail['trail_end'] ) )
			$trail['trail_end'] = '<span class="trail-end">' . substr($trail['trail_end'],0,$title_char_length) . '</span>';

		/* Format the separator. */
		$separator = ( !empty( $args['separator'] ) ? '<span class="sep">' . $args['separator'] . '</span>' : '<span class="sep">/</span>' );

		/* Join the individual trail items into a single string. */
		$breadcrumb .= join( " {$separator} ", $trail );

		/* If $after was set, wrap it in a container. */
		$breadcrumb .= ( !empty( $args['after'] ) ? ' <span class="trail-after">' . $args['after'] . '</span>' : '' );

		/* Close the breadcrumb trail containers. */
		$breadcrumb .= '<div class="clear"></div></div>';
	}

	/* Allow developers to filter the breadcrumb trail HTML. */
	$breadcrumb = apply_filters( 'swm_breadcrumb_trail', $breadcrumb, $args );

	/* Output the breadcrumb. */
	if ( $args['echo'] )
		echo $breadcrumb;
	else
		return $breadcrumb;
}

function swm_breadcrumb_trail_get_items( $args = array() ) {
	global $wp_rewrite;

	/* Get the textdomain. */
	$textdomain = swm_breadcrumb_trail_textdomain();

	/* Set up an empty trail array and empty path. */
	$trail = array();
	$path = '';

	/* If $show_home is set and we're not on the front page of the site, link to the home page. */
	if ( !is_front_page() && $args['show_home'] )
		$trail[] = '<a href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" class="trail-begin">' . $args['show_home'] . '</a>';

	/* If viewing the front page of the site. */
	if ( is_front_page() ) {
		if ( $args['show_home'] && $args['front_page'] )
			$trail['trail_end'] = "{$args['show_home']}";
	}

	/* If viewing the "home"/posts page. */
	elseif ( is_home() ) {
		$home_page = get_page( get_queried_object_id() );
		$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( $home_page->post_parent, '' ) );
		$trail['trail_end'] = get_the_title( $home_page->ID );
	}

	/* If viewing a singular post (page, attachment, etc.). */
	elseif ( is_singular() ) {

		/* Get singular post variables needed. */
		$post = get_queried_object();
		$post_id = absint( get_queried_object_id() );
		$post_type = $post->post_type;
		$parent = absint( $post->post_parent );

		/* Get the post type object. */
		$post_type_object = get_post_type_object( $post_type );		

		/* If viewing a singular 'post'. */
		if ( 'post' == $post_type ) {

			/* If $front has been set, add it to the $path. */
			$path .= trailingslashit( $wp_rewrite->front );

			/* If there's a path, check for parents. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $path ) );

			/* Map the permalink structure tags to actual links. */
			$trail = array_merge( $trail, swm_breadcrumb_trail_map_rewrite_tags( $post_id, get_option( 'permalink_structure' ), $args ) );
			
		}

		if ( class_exists( 'WPML_String_Translation' ) ) {
			$portfolio_pg_title = icl_translate('Theme Mod', 'swm_portfolio_page_title', get_theme_mod( 'swm_portfolio_page_title' ));
		} else {
			$portfolio_pg_title = do_shortcode( get_theme_mod('swm_portfolio_page_title') ); 
		}

		$swm_portfolio_page_url = get_theme_mod( 'swm_portfolio_page_url' );

		//  Main Portfolio
		if( $post_type == 'portfolio' ) {
			$trail[] = '<a href="'. $swm_portfolio_page_url .'" title="'. $portfolio_pg_title .'">'.$portfolio_pg_title.'</a>';
		}

		if ( class_exists( 'WPML_String_Translation' ) ) {
			$cause_pg_title = icl_translate('Theme Mod', 'swm_cause_page_title', get_theme_mod( 'swm_cause_page_title' ));
		} else {
			$cause_pg_title = do_shortcode( get_theme_mod('swm_cause_page_title') ); 
		}

		$swm_cause_page_url = get_theme_mod( 'swm_cause_page_url' );

		//  Main cause
		if( $post_type == 'cause' ) {
			$trail[] = '<a href="'. $swm_cause_page_url .'" title="'. $cause_pg_title .'">'.$cause_pg_title.'</a>';
		}

		if ( class_exists( 'WPML_String_Translation' ) ) {
			$sermons_pg_title = icl_translate('Theme Mod', 'swm_sermons_page_title', get_theme_mod( 'swm_sermons_page_title' ));
		} else {
			$sermons_pg_title = do_shortcode( get_theme_mod('swm_sermons_page_title') ); 
		}

		$swm_sermons_page_url = get_theme_mod( 'swm_sermons_page_url' );

		//  Main Sermons
		if( $post_type == 'sermons' ) {
			$trail[] = '<a href="'. $swm_sermons_page_url .'" title="'. $sermons_pg_title .'">'.$sermons_pg_title.'</a>';
		}
		
		/* WooCommerce */
		if ( class_exists('Woocommerce') ) {
			$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
			$shop_title = __('Shop','swmtranslate');
			$shop_title = apply_filters( 'swm_woo_breadcrumbs_shop_title', $shop_title );
		}

		if ( is_singular('page') && class_exists('woocommerce') ) {
			if ( is_cart() || is_checkout() ) {
				$trail[] = '<a href="' . $shop_page_url . '" title="' . $shop_title . '">' . $shop_title . '</a>';
			}
		}

		if( $post_type == 'product' ) {
			$trail[] = '<a href="' . $shop_page_url . '" title="' . $shop_title . '">' . $shop_title . '</a>';
		}


		/* If viewing a singular 'attachment'. */
		elseif ( 'attachment' == $post_type ) {

			/* If $front has been set, add it to the $path. */
			$path .= trailingslashit( $wp_rewrite->front );

			/* If there's a path, check for parents. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $path ) );

			/* Map the post (parent) permalink structure tags to actual links. */
			$trail = array_merge( $trail, swm_breadcrumb_trail_map_rewrite_tags( $post->post_parent, get_option( 'permalink_structure' ), $args ) );
		}

		/* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
		elseif ( 'page' !== $post_type ) {

			/* If $front has been set, add it to the $path. */
			if (  !empty( $post_type_object->rewrite['with_front'] ) && $wp_rewrite->front )
				$path .= trailingslashit( $wp_rewrite->front );

			/* If there's a slug, add it to the $path. */
			if ( !empty( $post_type_object->rewrite['slug'] ) )
				$path .= $post_type_object->rewrite['slug'];

			/* If there's a path, check for parents. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $path ) );

			/* If there's an archive page, add it to the trail. */
			if ( !empty( $post_type_object->has_archive ) )
				$trail[] = '<a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a>';
		}

		/* If the post type path returns nothing and there is a parent, get its parents. */
		if ( ( empty( $path ) && 0 !== $parent ) || ( 'attachment' == $post_type ) )
			$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( $parent, '' ) );

		/* Or, if the post type is hierarchical and there's a parent, get its parents. */
		elseif ( 0 !== $parent && is_post_type_hierarchical( $post_type ) )
			$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( $parent, '' ) );

		/* Display terms for specific post type taxonomy if requested. */
		if ( !empty( $args["singular_{$post_type}_taxonomy"] ) && $terms = get_the_term_list( $post_id, $args["singular_{$post_type}_taxonomy"], '', ', ', '' ) )
			$trail[] = $terms;

		/* End with the post title. */
		$post_title = get_the_title();
		if ( !empty( $post_title ) )
			$trail['trail_end'] = $post_title;
	}

	/* If we're viewing any type of archive. */
	elseif ( is_archive() ) {

		/* If viewing a taxonomy term archive. */
		if ( is_tax() || is_category() || is_tag() ) {

			/* Get some taxonomy and term variables. */
			$term = get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );

			/* Get the path to the term archive. Use this to determine if a page is present with it. */
			if ( is_category() )
				$path = get_option( 'category_base' );
			elseif ( is_tag() )
				$path = get_option( 'tag_base' );
			else {
				if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
					$path = trailingslashit( $wp_rewrite->front );
				$path .= $taxonomy->rewrite['slug'];
			}

			/* Get parent pages by path if they exist. */
			if ( $path )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $path ) );

			/* If the taxonomy is hierarchical, list its parent terms. */
			if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_term_parents( $term->parent, $term->taxonomy ) );

			/* Add the term name to the trail end. */
			$trail['trail_end'] = single_term_title( '', false );
		}

		/* If viewing a post type archive. */
		elseif ( is_post_type_archive() ) {

			/* Get the post type object. */
			$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

			/* If $front has been set, add it to the $path. */
			if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front )
				$path .= trailingslashit( $wp_rewrite->front );

			/* If there's a slug, add it to the $path. */
			if ( !empty( $post_type_object->rewrite['slug'] ) )
				$path .= $post_type_object->rewrite['slug'];

			/* If there's a path, check for parents. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $path ) );

			/* Add the post type [plural] name to the trail end. */
			$trail['trail_end'] = $post_type_object->labels->name;
		}

		/* If viewing an author archive. */
		elseif ( is_author() ) {

			/* If $front has been set, add it to $path. */
			if ( !empty( $wp_rewrite->front ) )
				$path .= trailingslashit( $wp_rewrite->front );

			/* If an $author_base exists, add it to $path. */
			if ( !empty( $wp_rewrite->author_base ) )
				$path .= $wp_rewrite->author_base;

			/* If $path exists, check for parent pages. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $path ) );

			/* Add the author's display name to the trail end. */
			$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
		}

		/* If viewing a time-based archive. */
		elseif ( is_time() ) {

			if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
				$trail['trail_end'] = get_the_time( __( 'g:i a', $textdomain ) );

			elseif ( get_query_var( 'minute' ) )
				$trail['trail_end'] = sprintf( __( 'Minute %1$s', $textdomain ), get_the_time( __( 'i', $textdomain ) ) );

			elseif ( get_query_var( 'hour' ) )
				$trail['trail_end'] = get_the_time( __( 'g a', $textdomain ) );
		}

		/* If viewing a date-based archive. */
		elseif ( is_date() ) {

			/* If $front has been set, check for parent pages. */
			if ( $wp_rewrite->front )
				$trail = array_merge( $trail, swm_breadcrumb_trail_get_parents( '', $wp_rewrite->front ) );

			if ( is_day() ) {
				$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
				$trail[] = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', $textdomain ) ) . '">' . get_the_time( __( 'F', $textdomain ) ) . '</a>';
				$trail['trail_end'] = get_the_time( __( 'd', $textdomain ) );
			}

			elseif ( get_query_var( 'w' ) ) {
				$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
				$trail['trail_end'] = sprintf( __( 'Week %1$s', $textdomain ), get_the_time( esc_attr__( 'W', $textdomain ) ) );
			}

			elseif ( is_month() ) {
				$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
				$trail['trail_end'] = get_the_time( __( 'F', $textdomain ) );
			}

			elseif ( is_year() ) {
				$trail['trail_end'] = get_the_time( __( 'Y', $textdomain ) );
			}
		}
	}

	/* If viewing search results. */
	elseif ( is_search() ) {		
		$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', $textdomain ), esc_attr( get_search_query() ) );
	}

	/* If viewing a 404 error page. */
	elseif ( is_404() ) {
		$trail['trail_end'] = __( '404 Not Found', 'swmtranslate');

	/* If viewing event calendar pages. */
	} elseif ( class_exists( 'Tribe__Events__Main' ) ) {
        if ( tribe_is_upcoming()) {
            $trail['trail_end'] = __( 'Events', $textdomain );              
        } elseif( tribe_is_past() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_month() && !is_tax() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_month() && is_tax() ) { 
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_event() && !tribe_is_day() && !is_single() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_event() && is_single() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_day() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_venue() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} 

	}elseif ( class_exists( 'TribeEventsPro' ) ) {
		if ( tribe_is_map() ) {
            $trail['trail_end'] = __( 'Events', $textdomain );              
        } elseif( tribe_is_photo() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		} elseif( tribe_is_week() ) {
			$trail['trail_end'] = __( 'Events', $textdomain );
		}
	}


	/* Allow devs to step in and filter the $trail array. */
	return apply_filters( 'breadcrumb_trail_items', $trail, $args );
}

function swm_breadcrumb_trail_map_rewrite_tags( $post_id = '', $path = '', $args = array() ) {

	/* Set up an empty $trail array. */
	$trail = array();

	/* Make sure there's a $path and $post_id before continuing. */
	if ( empty( $path ) || empty( $post_id ) )
		return $trail;

	/* Get the post based on the post ID. */
	$post = get_post( $post_id );

	/* If no post is returned, an error is returned, or the post does not have a 'post' post type, return. */
	if ( empty( $post ) || is_wp_error( $post ) || 'post' !== $post->post_type )
		return $trail;

	/* Get the textdomain. */
	$textdomain = swm_breadcrumb_trail_textdomain();

	/* Trim '/' from both sides of the $path. */
	$path = trim( $path, '/' );

	/* Split the $path into an array of strings. */
	$matches = explode( '/', $path );

	/* If matches are found for the path. */
	if ( is_array( $matches ) ) {

		/* Loop through each of the matches, adding each to the $trail array. */
		foreach ( $matches as $match ) {

			/* Trim any '/' from the $match. */
			$tag = trim( $match, '/' );

			/* If using the %year% tag, add a link to the yearly archive. */
			if ( '%year%' == $tag )
				$trail[] = '<a href="' . get_year_link( get_the_time( 'Y', $post_id ) ) . '" title="' . get_the_time( esc_attr__( 'Y', $textdomain ), $post_id ) . '">' . get_the_time( __( 'Y', $textdomain ), $post_id ) . '</a>';

			/* If using the %monthnum% tag, add a link to the monthly archive. */
			elseif ( '%monthnum%' == $tag )
				$trail[] = '<a href="' . get_month_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ) ) . '" title="' . get_the_time( esc_attr__( 'F Y', $textdomain ), $post_id ) . '">' . get_the_time( __( 'F', $textdomain ), $post_id ) . '</a>';

			/* If using the %day% tag, add a link to the daily archive. */
			elseif ( '%day%' == $tag )
				$trail[] = '<a href="' . get_day_link( get_the_time( 'Y', $post_id ), get_the_time( 'm', $post_id ), get_the_time( 'd', $post_id ) ) . '" title="' . get_the_time( esc_attr__( 'F j, Y', $textdomain ), $post_id ) . '">' . get_the_time( __( 'd', $textdomain ), $post_id ) . '</a>';

			/* If using the %author% tag, add a link to the post author archive. */
			elseif ( '%author%' == $tag )
				$trail[] = '<a href="' . get_author_posts_url( $post->post_author ) . '" title="' . esc_attr( get_the_author_meta( 'display_name', $post->post_author ) ) . '">' . get_the_author_meta( 'display_name', $post->post_author ) . '</a>';

			/* If using the %category% tag, add a link to the first category archive to match permalinks. */
			elseif ( '%category%' == $tag && 'category' !== $args["singular_{$post->post_type}_taxonomy"] ) {

				/* Get the post categories. */
				$terms = get_the_category( $post_id );

				/* Check that categories were returned. */
				if ( $terms ) {

					/* Sort the terms by ID and get the first category. */
					usort( $terms, '_usort_terms_by_ID' );
					$term = get_term( $terms[0], 'category' );

					/* If the category has a parent, add the hierarchy to the trail. */
					if ( 0 !== $term->parent )
						$trail = array_merge( $trail, swm_breadcrumb_trail_get_term_parents( $term->parent, 'category' ) );

					/* Add the category archive link to the trail. */
					$trail[] = '<a href="' . get_term_link( $term, 'category' ) . '" title="' . esc_attr( $term->name ) . '">' . $term->name . '</a>';
				}
			}
		}
	}

	/* Return the $trail array. */
	return $trail;
}

function swm_breadcrumb_trail_get_parents( $post_id = '', $path = '' ) {

	/* Set up an empty trail array. */
	$trail = array();

	/* Trim '/' off $path in case we just got a simple '/' instead of a real path. */
	$path = trim( $path, '/' );

	/* If neither a post ID nor path set, return an empty array. */
	if ( empty( $post_id ) && empty( $path ) )
		return $trail;

	/* If the post ID is empty, use the path to get the ID. */
	if ( empty( $post_id ) ) {

		/* Get parent post by the path. */
		$parent_page = get_page_by_path( $path );

		/* If a parent post is found, set the $post_id variable to it. */
		if ( !empty( $parent_page ) )
			$post_id = $parent_page->ID;
	}

	/* If a post ID and path is set, search for a post by the given path. */
	if ( $post_id == 0 && !empty( $path ) ) {

		/* Separate post names into separate paths by '/'. */
		$path = trim( $path, '/' );
		preg_match_all( "/\/.*?\z/", $path, $matches );

		/* If matches are found for the path. */
		if ( isset( $matches ) ) {

			/* Reverse the array of matches to search for posts in the proper order. */
			$matches = array_reverse( $matches );

			/* Loop through each of the path matches. */
			foreach ( $matches as $match ) {

				/* If a match is found. */
				if ( isset( $match[0] ) ) {

					/* Get the parent post by the given path. */
					$path = str_replace( $match[0], '', $path );
					$parent_page = get_page_by_path( trim( $path, '/' ) );

					/* If a parent post is found, set the $post_id and break out of the loop. */
					if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
						$post_id = $parent_page->ID;
						break;
					}
				}
			}
		}
	}

	/* While there's a post ID, add the post link to the $parents array. */
	while ( $post_id ) {

		/* Get the post by ID. */
		$page = get_page( $post_id );

		/* Add the formatted post link to the array of parents. */
		$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';

		/* Set the parent post's parent to the post ID. */
		$post_id = $page->post_parent;
	}

	/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
	if ( isset( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent posts. */
	return $trail;
}

function swm_breadcrumb_trail_get_term_parents( $parent_id = '', $taxonomy = '' ) {

	/* Set up some default arrays. */
	$trail = array();
	$parents = array();

	/* If no term parent ID or taxonomy is given, return an empty array. */
	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $trail;

	/* While there is a parent ID, add the parent term link to the $parents array. */
	while ( $parent_id ) {

		/* Get the parent term. */
		$parent = get_term( $parent_id, $taxonomy );

		/* Add the formatted term link to the array of parent terms. */
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';

		/* Set the parent term's parent as the parent ID. */
		$parent_id = $parent->parent;
	}

	/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
	if ( !empty( $parents ) )
		$trail = array_reverse( $parents );

	/* Return the trail of parent terms. */
	return $trail;
}

/**
 * Returns the textdomain used by the script and allows it to be filtered by plugins/themes.
 *
 * @since 0.4.0
 * @returns string The textdomain for the script.
 */
function swm_breadcrumb_trail_textdomain() {
	return apply_filters( 'swm_breadcrumb_trail_textdomain', 'swmtranslate' );
}

?>