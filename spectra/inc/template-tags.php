<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			template-tags.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

/* ----------------------------------------------------------------------
	POST PAGINATION
	Display navigation to next/previous set of posts when applicable.
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_paging_nav' ) ) :
function spectra_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', SPECTRA_THEME ),
		'next_text' => __( 'Next &rarr;', SPECTRA_THEME ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="pagination loop-pagination">
			<?php 
			echo paginate_links( array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map( 'urlencode', $query_args ),
				'prev_text' => __( '&larr; Previous', SPECTRA_THEME ),
				'next_text' => __( 'Next &rarr;', SPECTRA_THEME ),
			) );

			?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;


/* ----------------------------------------------------------------------
	POST NAVIGATION
	Display navigation to next/previous post when applicable.
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_post_nav' ) ) :
function spectra_post_nav() {
	global $post;
	
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$post_type = get_post_type( $post->ID );

	if ( ! $next && ! $previous ) {
		return;
	}

	$next_label = __( 'Next Post', SPECTRA_THEME );
	$prev_label = __( 'Previous Post', SPECTRA_THEME );

	// If gallery
	if ( $post_type == 'spectra_gallery' ) {
		$next_label = __( 'Next Album', SPECTRA_THEME );
		$prev_label = __( 'Previous Album', SPECTRA_THEME );
	}

	$next_post = get_next_post_link( '%link', '<span class="meta-nav">' . $next_label . '</span>' . __( '%title', SPECTRA_THEME ) );
	$prev_post = get_previous_post_link( '%link', '<span class="meta-nav">' . $prev_label . '</span>' . __( '%title', SPECTRA_THEME ) );
			
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', '<span class="meta-nav">' . __( 'Published In', SPECTRA_THEME ) . '</span>' . __( '%title', SPECTRA_THEME ) );
			else :
				if ( ! $prev_post && $next_post ) {
					echo '<a></a>';
					echo get_next_post_link( '%link', '<span class="meta-nav">' . $next_label . '</span>' . __( '%title', SPECTRA_THEME ) );
				} else if ( $prev_post && ! $next_post ) {
					echo get_previous_post_link( '%link', '<span class="meta-nav">' . $prev_label . '</span>' . __( '%title', SPECTRA_THEME ) );
					echo '<a></a>';
				} else if ( $prev_post && $next_post  ) {
					echo get_previous_post_link( '%link', '<span class="meta-nav">' . $prev_label . '</span>' . __( '%title', SPECTRA_THEME ) );
					echo get_next_post_link( '%link', '<span class="meta-nav">' . $next_label . '</span>' . __( '%title', SPECTRA_THEME ) );
				}
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


/* ----------------------------------------------------------------------
	POST NAVIGATION WITH CUSTOM ORDER
	Display navigation to next/previous post with custom order for special CP.
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_custom_post_nav' ) ) :
function spectra_custom_post_nav() {
	global $post;

	if ( isset( $post ) ) {
		$backup = $post;
	}

	$output = '';
	$post_type = get_post_type($post->ID);
	$id = $post->ID;
	$count = 0;
	$prev_id = '';
	$next_id = '';
	$posts = array();
	$next_label = __( 'Next Post', SPECTRA_THEME );
	$prev_label = __( 'Previous Post', SPECTRA_THEME );

	if ( $post_type == 'spectra_events' || $post_type == 'spectra_portfolio' ) {

		// Portfolio
		if ( $post_type == 'spectra_portfolio' ) {
			
			$args = array(
				'post_type' => 'spectra_portfolio',
				'showposts'=> '-1'
			);
		
			$args['orderby'] = 'menu_order';
			$args['order'] = 'ASC';

			$next_label = __( 'Next Release', SPECTRA_THEME );
			$prev_label = __( 'Previous Release', SPECTRA_THEME );
		}

		// Events
		if ( $post_type == 'spectra_events' ) {
			if ( is_object_in_term( $post->ID, 'spectra_event_type', 'Future events' ) ) {
				$event_type = 'Future events';
			} else {
				$event_type = 'Past events';
			}
			$order = $event_type == 'Future events' ? $order = 'ASC' : $order = 'DSC';
			$args = array(
				'post_type' => 'spectra_events',
				'tax_query' => 
					array(
						array(
						'taxonomy' => 'spectra_event_type',
						'field' => 'slug',
						'terms' => $event_type
						)
					),
				'showposts'=> '-1',
				'orderby' => 'meta_value',
				'meta_key' => '_event_date_start',
				'order' => $order
			);

			$next_label = __( 'Next Event', SPECTRA_THEME );
			$prev_label = __( 'Previous Event', SPECTRA_THEME );
		}

		// Nav loop
		$nav_query = new WP_Query();
		$nav_query->query( $args );
		if ( $nav_query->have_posts() )	{
			while ( $nav_query->have_posts() ) {
				$nav_query->the_post();
				$posts[] = get_the_id();
				if ( $count == 1 ) break;
				if ( $id == get_the_id() ) $count++;
			}
			$current = array_search( $id, $posts );

			// Check IDs
			if ( isset( $posts[$current-1] ) ) $prev_id = $posts[$current-1];
			if ( isset( $posts[$current+1] ) ) $next_id = $posts[$current+1];

			// Display nav
			$output .= '
			<nav class="navigation post-navigation" role="navigation">
			<div class="nav-links">';
			if ( $prev_id ) {
				$output .= '<a href="' . esc_url( get_permalink( $prev_id ) ) . '" class="nav-prev" title="' . esc_attr( get_the_title( $prev_id ) ) . '"><span class="meta-nav">'. $prev_label . '</span>' . get_the_title( $prev_id ) . '</a>';
			} else {
				$output .= '<a></a>';
			}
			if ( $next_id ) {
				$output .= '<a href="' . esc_url( get_permalink( $next_id ) ) . '" class="nav-next" title="' . esc_attr( get_the_title( $next_id ) ) . '"><span class="meta-nav">'. $next_label . '</span>' . get_the_title( $next_id ) . '</a>';
			} else {
				$output .= '<a></a>';
			}
			$output .= '</div></nav>';
		}

		if ( isset( $post ) ) {
			$post = $backup;
		}
		
		return $output;
	} else {
		return false;
	}
}
endif;