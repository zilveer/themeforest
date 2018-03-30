<?php


if ( ! function_exists( 'mr_tailor_entry_meta' ) ) :
function mr_tailor_entry_meta() {
	
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'mr_tailor' ) . '</span>';

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( __( ' This entry was posted by ', 'mr_tailor' ) . '<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'mr_tailor' ), get_the_author() ) ),
			get_the_author()
		);
	}
	
	/*if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		mr_tailor_entry_date();*/

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( ', ' );
	if ( $categories_list ) {
		echo __( ' in ', 'mr_tailor' ) . $categories_list . '';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		echo __( ' and tagged ', 'mr_tailor' ) . $tag_list . '';
	}

	
	
}
endif;

if ( ! function_exists( 'mr_tailor_entry_date' ) ) :
function mr_tailor_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'mr_tailor' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( __( ' on ', 'mr_tailor' ) . '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'mr_tailor' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'mr_tailor_post_header_entry_date' ) ) :
function mr_tailor_post_header_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'mr_tailor' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'mr_tailor' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

function mr_tailor_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

?>