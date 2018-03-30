<?php

/* ==========================================================================
	Featured Slider
============================================================================= */

if( ! function_exists( 'shiroi_featured_slider' ) ):

function shiroi_featured_slider() {

	if( is_front_page() && is_home() && ! is_paged() && Youxi()->option->get( 'featured_slider_enabled' ) ) {
		Youxi()->templates->get( 'featured-slider' );
	}
}
endif;

/* ==========================================================================
	Site Logo
============================================================================= */

if( ! function_exists( 'shiroi_site_logo' ) ):

function shiroi_site_logo() {

	if( $logo_image = Youxi()->option->get( 'logo_image' ) ):
		if( $attachment_id = attachment_url_to_postid( $logo_image ) ):
			echo wp_get_attachment_image( $attachment_id, 'full' );
		else:
			echo '<img src="' . esc_url( $logo_image ) . '" alt="' . get_bloginfo( 'name' ) . '">';
		endif;
	else:
		echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/img/default-logo.png' ) . '" alt="' . get_bloginfo( 'name' ) . '">';
	endif;
}
endif;

/* ==========================================================================
	Before Entries
============================================================================= */

if( ! function_exists( 'shiroi_before_entries' ) ):

function shiroi_before_entries() {

	$sidebar = shiroi_get_sidebar();

	$column_class  = 'col-md-12';
	$wrapper_class = 'entries-wrap';

	if( $sidebar ) {

		$column_class = 'col-md-8';
		
		if( 'left' === $sidebar['layout'] ) {
			$column_class .= ' col-md-push-4';
		}

	} else {

		$wrapper_class .= ' entries-wrap-fullwidth';
	}

	if( is_home() || is_category() || is_tag() || is_author() || is_date() )  {

		if( is_home() ) {
			$entry_layout = Youxi()->option->get( 'blog_index_layout_mode' );
		} else {
			$entry_layout = Youxi()->option->get( 'blog_archive_layout_mode' );
		}

		if( in_array( $entry_layout, array( 'masonry', 'grid' ) ) ) {
			$wrapper_class .= ' entries-wrap-grid';
		}

		if( 'masonry' == $entry_layout ) {
			$wrapper_class .= ' masonry';
		}
	}

	echo '<div class="' . esc_attr( $column_class ) . '">';

		echo '<div class="' . esc_attr( $wrapper_class ) . '">';

		if( isset( $entry_layout ) && 'masonry' == $entry_layout ) {
			echo '<div class="hentry-sizer"></div>';
		}
}
endif;

/* ==========================================================================
	After Entries
============================================================================= */

if( ! function_exists( 'shiroi_after_entries' ) ):

function shiroi_after_entries() {

		echo '</div>';

		shiroi_pagination();

	echo '</div>';

	if( $sidebar = shiroi_get_sidebar() ) {

		$column_class  = 'col-md-4';
		if( 'left' == $sidebar['layout'] ) {
			$column_class .= ' col-md-pull-8';
		}

		echo '<div class="' . esc_attr( $column_class ) . '">';

			get_sidebar();

		echo '</div>';
	}
}
endif;

/* ==========================================================================
	Pagination
============================================================================= */

if( ! function_exists( 'shiroi_pagination' ) ):

function shiroi_pagination() {

	if( is_home() || is_category() || is_tag() || is_author() || is_date() ) {

		$pagination_type = Youxi()->option->get( 'blog_pagination' );

	} elseif( is_search() ) {

		$pagination_type = Youxi()->option->get( 'search_pagination' );

	}

	if( isset( $pagination_type ) ) {

		if( 'numbered' === $pagination_type ) {

			$before = '<nav class="entries-nav entries-nav-numbered">';
			$after  = '</nav>';
			$args   = array(
				'prev_text' => __( '&laquo; Previous', 'shiroi' ), 
				'next_text' => __( 'Next &raquo;', 'shiroi' )
			);

			echo Youxi()->pagination->paginate_links( $before, $after, $args );

		} elseif( 'pager' === $pagination_type ) {

			$before = '<nav class="entries-nav entries-nav-pager">';
			$after  = '</nav>';
			$args   = array(
				'next_posts_link_label'     => __( '&laquo; Older Posts', 'shiroi' ), 
				'previous_posts_link_label' => __( 'Newer Posts &raquo;', 'shiroi' )
			);

			echo Youxi()->pagination->posts_link( $before, $after, $args );

		}

	}

}
endif;