<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

final class Youxi_Pagination {

	public function posts_link( $before = '', $after = '', $args = array(), $query = null ) {

		global $wp_query;

		if( ! $query || ! is_a( $query, 'WP_Query' ) ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if( $query->max_num_pages < 2 ) {
			return;
		}

		$args = wp_parse_args( $args, array(
			'next_posts_link_label' => null, 
			'previous_posts_link_label' => null, 
			'list_class' => '', 
			'list_item_class' => ''
		));

		$output = '';

		$next_posts_link = get_next_posts_link( $args['next_posts_link_label'], $query->max_num_pages );
		$prev_posts_link = get_previous_posts_link( $args['previous_posts_link_label'], $query->max_num_pages );
		$list_class      = trim( $args['list_class'] );
		$list_item_class = trim( $args['list_item_class'] );

		if( $next_posts_link || $prev_posts_link ):

			if( isset( $before ) ) {
				$output .= $before;
			}

			$output .= '<ul' . ( ! empty( $list_class ) ? ' class="' . esc_attr( $list_class ) . '"' : '' ) . '>';

				if( $prev_posts_link ) {
					$output .= '<li class="prev' . ( ! empty( $list_item_class ) ? ' ' . esc_attr( $list_item_class ) : '' ) . '">' . $prev_posts_link . '</li>';
				}

				if( $next_posts_link ) {
					$output .= '<li class="next' . ( ! empty( $list_item_class ) ? ' ' . esc_attr( $list_item_class ) : '' ) . '">' . $next_posts_link . '</li>';
				}

			$output .= '</ul>';

			if( isset( $after ) ) {
				$output .= $after;
			}

		endif;

		return $output;
	}

	public function get_paginate_links( $args = array(), $query = null ) {

		global $wp_query, $wp_rewrite;

		if( ! $query || ! is_a( $query, 'WP_Query' ) ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if( $query->max_num_pages < 2 ) {
			return;
		}

		if( is_front_page() && ! is_home() ) {
			$current = get_query_var( 'page' ) ? intval( get_query_var( 'page' ) ) : 1;
		} else {
			$current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		}

		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		// Prepare paginate links args
		$paginate_links_args = wp_parse_args( $args, array(
			'base'     => $pagenum_link, 
			'format'   => $format, 
			'total'    => $query->max_num_pages, 
			'current'  => $current, 
			'mid_size' => 2, 
			'end_size' => 1, 
			'add_args' => array_map( 'urlencode', $query_args ), 
			'type'     => 'array'
		));

		// Return paginated links.
		return paginate_links( $paginate_links_args );
	}

	public function paginate_links( $before = '', $after = '', $args = array(), $query = null ) {

		// List and list item class
		$list_class = '';
		$list_item_class = '';

		if( isset( $args['list_class'] ) ) {
			$list_class = trim( $args['list_class'] );
			unset( $args['list_class'] );
		}
		if( isset( $args['list_item_class'] ) ) {
			$list_item_class = trim( $args['list_item_class'] );
			unset( $args['list_item_class'] );
		}

		$output = '';

		// Set up paginated links.
		if( $links = $this->get_paginate_links( $args, $query ) ):

			if( isset( $before ) ) {
				$output .= $before;
			}

			$output .= '<ul' . ( ! empty( $list_class ) ? ' class="' . esc_attr( $list_class ) . '"' : '' ) . '>';

			foreach( $links as $link ) {

				$output .= '<li';

				// Ugly hack to copy the link class
				if( preg_match( '/^<(?:a|span) class=(?:\'|")([^\'"]+)(?:\'|")/', $link, $matches ) ) {
					$class = trim( str_replace( 'page-numbers', '', $matches[1] ) );
					if( ! empty( $list_item_class ) ) {
						$class = trim( $class . ' ' . $list_item_class );
					}
					if( ! empty( $class ) ) {
						$output .= ' class="' . esc_attr( $class ) . '"';
					}
				} else if( ! empty( $list_item_class ) ) {
					$output .= ' class="' . esc_attr( $list_item_class ) . '"';
				}

				$output .= '>' . $link . '</li>';
			}

			$output .= '</ul>';

			if( isset( $after ) ) {
				$output .= $after;
			}

		endif;

		return $output;
	}
}
